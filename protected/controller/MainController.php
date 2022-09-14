<?php

/**
 * Description of MainController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class MainController extends DooController {

    public $data;
    private $permisos;
    private $accesos;

    public function index() {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL . "login";
        } else {

            $login = $_SESSION['login'];
            $rol = $login->role;
        
            if($rol=='13'){
            $sql="SELECT c.id,e.estado,ai.state,e.id as entrada,ai.id,transportista,placa,conductor,fecha_estimada,t.serial,c.nombre as nombre_cliente
                    FROM autorizacion_ingreso ai 
                    left join entrada e on (e.autorizacion_ingreso_id=ai.id)
                    inner join tanques t on (t.id=ai.tanques_id) 
                    inner join clientes c on (c.id=ai.clientes_id) 
                    where c.id=$login->id_usuario and ai.state!='T'";
            $this->data['autorizaciones'] = Doo::db()->query($sql)->fetchAll();
                $this->data['content'] = 'autorizaciones/listClient.php'; 
            }else{
                $this->data['content'] = 'home.php'; 
            }
            
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->renderc('index', $this->data);            
        }
    }

    public function rutalogin() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('login', $this->data);
    }

    public function login() {
        if (isset($_POST['usuario']) && isset($_POST['password'])) {
            if (!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['tipo'])) {
                $user = trim($_POST['usuario']);
                $pass = md5(trim($_POST['password']));
                $tipo = $_POST['tipo'];

                $u = $this->db()->find("Usuarios", array("where" => "deleted = '1' and usuario = ? and password = ? and tipo = ? ",
                    "limit" => 1,
                    "param" => array($user, $pass, $tipo)));
                 
           
                $this->data['rootUrl'] = Doo::conf()->APP_URL;

                if ($u == Null) { // o $u == false
                    $this->data['error'] = "Acceso denegado";
                    $this->renderc('login', $this->data);
                } else {
                    unset($_SESSION['login']);
                    $this->buildMenu($u->role);
                    $login = new stdclass();
                    if ( $u->imagen != null)
                        $login->imagen = $u->imagen;
                    else
                        $login->imagen = "default.jpg";
                    $login->tipo = $u->tipo;
                    $login->usuario = $u->usuario;
                    $login->role = $u->role;
                    $login->nombre = $u->nombre;
                    $login->id_usuario = $u->id_usuario;
                    $login->id = $u->id;
                    $r = $this->db()->find("Roles", array("where" => "id = ? ",
                        "limit" => 1,
                        "param" => array($u->role)
                            )
                    );
                    if ($r != null) {
                        $login->perfil = $r->role;
                    } else {
                        $login->perfil = "Sin Perfil";
                    }
                    $login->menu = $this->data["htmlmenu"];
                    $login->toolbar = $this->data["toolbar"];
                    $_SESSION['login'] = $login;
                    $_SESSION['permisos'] = $this->permisos;
                    $_SESSION['accesos'] = $this->accesos;
                    //$this->home();
                    if ($tipo == "A") {
                        return Doo::conf()->APP_URL;
                    } else {
                        return Doo::conf()->APP_URL . "panel/home";
                    }
                }
            } else {
                if ($tipo == "A") {
                    return Doo::conf()->APP_URL;
                } else {
                    return Doo::conf()->APP_URL . 'admpropietarios';
                }
//                return Doo::conf()->APP_URL;
            }
        } else {
            if ($tipo == "A") {
                return Doo::conf()->APP_URL;
            } else {
                return Doo::conf()->APP_URL . 'admpropietarios';
            }
        }
    }

    public function logout() {

        session_unset();
        // Destruir la session PHP
        session_destroy();
        // retornar al sitio de inicio
        return Doo::conf()->APP_URL;
    }

     public function  notificaciones(){
        $notificaciones=Doo::db()->query("SELECT * FROM notificaciones where leida='N';")->fetchAll();
        echo json_encode($notificaciones);
    }

    public function desactive(){
        $id = $_POST["id"];
        Doo::db()->query("update notificaciones set leida='S' WHERE id='$id'");
    }

    private function buildMenu($role) {

        $this->data["role"] = $role;

        $sql = "select o.codigo,o.codigo, o.menuitem, o.depende, o.submenu, o.url, r.opcion, o.toolbar,r.acceso
        from opciones o
        inner join roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')
        where depende = '' ORDER BY orden";
        //and estado = 1

        $rs = Doo::db()->query($sql);
        $parentMenu = $rs->fetchAll();

        $this->data["toolbar"] = "";
        $this->data["permisos"] = array();
        $this->data["accesos"] = array();

        $this->data["htmlmenu"] = '<ul class="sidebar-menu">';
        $this->buildChildMenu($parentMenu);
        $this->data["htmlmenu"].= '</ul>';
        //$this->data["htmlmenu"].= '<br class="clear" />';
    }

    private function buildChildMenu($parentMenu) {

        $role = $this->data["role"];

        foreach ($parentMenu as $row):

            $submenu = $row["submenu"];
            $depende = $row["depende"];
            $codigo = $row["codigo"];
            $opcion = $row["opcion"];
            $toolbar = $row["toolbar"];

            if (strlen($opcion) == Null) {
                $a = 0;
                $access = "N";
            } else {
                $a = 1;
                $access = $row["acceso"];
            }
            $this->permisos[$row["codigo"]] = $a;
            $this->accesos[$row["codigo"]] = $access;

            if ($submenu == 'S') {

                $this->data["htmlmenu"].= '<li class="treeview">';
                $this->data["htmlmenu"].= '<a href="#"><i class="' . $toolbar . '"></i> <span>' . ($row["menuitem"]) . '</span> <i class="fa fa-angle-left pull-right"></i></a>';

                $sql = "select o.codigo,o.codigo, o.menuitem, o.depende, o.submenu, o.url, r.opcion,o.toolbar,r.acceso
      from opciones o
      inner join roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')
      where depende = '$codigo'  ORDER BY orden";
                //and estado = 1

                $rs = Doo::db()->query($sql);
                $childMenu = $rs->fetchAll();

                $this->data["htmlmenu"].= '<ul class="treeview-menu">';
                $this->buildChildMenu($childMenu);
                $this->data["htmlmenu"].= '</ul>';
            } else {

                if (strlen($opcion) == Null) {
                    $this->data["htmlmenu"].= '<li class="treeview">';
                    $this->data["htmlmenu"].= '<a class="disabled" href="javascript:void(0);"><i class="fa fa-pie-chart"></i><span>' . $row["menuitem"] . '</span><i class="fa fa-angle-left pull-right"></i></a>';
                } else {
                    $this->data["htmlmenu"].= '<li class="treeview">';
                    $this->data["htmlmenu"].= '<a href="' . Doo::conf()->APP_URL . $row["url"] . '">' . ($row["menuitem"]) . '</a>';
                }

                if ($toolbar != "" & strlen($opcion) != Null) {
                    $toolbar = $this->data["rootUrl"] . "global/img/" . $toolbar;
                    $this->data["toolbar"].='<div class="icon">
        <a href="' . Doo::conf()->APP_URL . $row["url"] . '"><img src="' . $toolbar . '" width="48" height="48" border="0"  alt="' . ($row["menuitem"]) . '"/><span>' . ($row["menuitem"]) . '</span></a>
        </div>';
                }
            }
            $this->data["htmlmenu"].= '</li>';

        endforeach;
    }
    
    

}
