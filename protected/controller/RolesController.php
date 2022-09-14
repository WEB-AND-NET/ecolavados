<?php
/**
 * Description of RolesController
 *
 * @author web.
 */

class RolesController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["501"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "panel/home";
            }
        }
    }

    public function index(){

         if (!isset($_POST["filtro"]))
            $filtro = "role";
        else
            $filtro = $_POST["filtro"];

        if (!isset($_POST["texto"]))
            $texto = "";
        else
            $texto = $_POST["texto"];

        $roles = Doo::db()->find("Roles", array("where" => "$filtro like ?",
                                                "desc" => "id",
                                                "asArray" => true,
                                                "param" => array($texto.'%')));

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'roles/roles.php';
        $this->data['roles'] = $roles;
        $this->data['filtro'] = $filtro;
        $this->data['texto']  = $texto;
        $this->renderc('index', $this->data,true);

    }

    public function add(){

        Doo::loadModel("Roles");
        $role = new Roles();

        
        $this->data['rootUrl']   = Doo::conf()->APP_URL;
        $this->data['role'] = $role;
        $this->data['opciones'] = $this->getOpciones();
        $this->data['content'] = 'roles/frm_role.php';
        $this->renderc('index', $this->data);

    }

   public function save(){

        Doo::loadModel("Roles");
        Doo::loadModel("RolesOpciones");

        $role = new Roles($_POST);

        if ($role->id == "") {
          $role->id = Null;
        }
         
        
        if(isset($_POST["opcion"])){
            $opciones = $_POST["opcion"];
            
            foreach ($opciones as $opcion){
                $ro = new RolesOpciones();
                $ro->opcion  = $opcion;
                $ro->acceso=(isset($_POST[$opcion.'access'])?$_POST[$opcion.'access']:'N');
                $a_op[] = $ro;
            }
        }else{
            //$opciones = array();
            $a_op = array();
        }                

        if ($role->id == Null){
            Doo::db()->relatedInsert($role,$a_op);
        }else {
            Doo::db()->query("DELETE FROM roles_opciones WHERE role_id = ?",array($role->id));
            //Doo::db()->update($role);
            Doo::db()->query("UPDATE roles SET role='$role->role',descripcion='$role->descripcion' WHERE id='$role->id'");
            foreach ($a_op as $o){
                $o->role_id  = $role->id;
                Doo::db()->insert($o);
            };
        }
       return Doo::conf()->APP_URL."roles";

    }

    public function edit(){

        $id    = $this->params["pindex"];
        $role  = Doo::db()->find("Roles",
                                 array('where' => 'id = ?','limit' => 1,
                                        'param' => array($id)));
        $this->data['rootUrl']   = Doo::conf()->APP_URL;
        $this->data['role']      = $role;
        $this->data['opciones']  = $this->getOpciones($id);
        $this->data['content']   = 'roles/frm_role.php';
        $this->renderc('index', $this->data);
    }

    private function getOpciones($role="") {

        if ($role == "") {
            $sql = "select codigo, CONCAT(REPEAT('&nbsp;',LENGTH(codigo)), menuitem) AS menuitem, '' as opcion  FROM opciones";
        } else {
            $sql = "select
                       o.codigo,CONCAT(REPEAT('&nbsp;',LENGTH(codigo)), menuitem) AS menuitem,r.opcion,r.acceso
                    from opciones o
                    left JOIN
                       roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')";
        }

        $rs = Doo::db()->query($sql);

        return $rs->fetchAll();
    }

}
?>
