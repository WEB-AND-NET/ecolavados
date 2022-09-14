<?php

/**
 * Description of UsuariosController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class UsuariosController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["502"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL . "home";
            }
        }
    }

    public function index() {
        $sql = "SELECT u.id,usuario,nombre,r.descripcion AS rol FROM usuarios u INNER JOIN roles r ON(u.role=r.id) WHERE u.deleted=1 ";                
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['usuarios'] = Doo::db()->query($sql)->fetchAll();
        $this->data['content'] = 'usuarios/usuarios.php';      

        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Usuarios");
        $usuario = new Usuarios();
        $roles = Doo::db()->find("Roles", array("select" => "id,role", "desc" => "id"));
        $this->data['roles'] = $roles;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['usuario'] = $usuario;
        $this->data['content'] = 'usuarios/frm_usuarios.php';
        $this->renderc('index', $this->data);
    }
    
    public function edit() {
        $id = $this->params["pindex"];
        $usuario = Doo::db()->find("Usuarios", array("select" => "id,usuario,imagen,nombre,identificacion,role", 'where' => 'id = ?', 'limit' => 1, 'param' => array($id)));
        $roles = Doo::db()->find("Roles", array("select" => "id,role", "desc" => "id"));
        $this->data['roles'] = $roles;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['usuario'] = $usuario;
        $this->data['content'] = 'usuarios/frm_usuarios.php';
        $this->renderc('index', $this->data);
    }

    public function save() {
        Doo::loadModel("Usuarios");
        Doo::loadHelper('DooFile');
        $usuario = new Usuarios($_POST);
        if ($usuario->id == "") {
            $usuario->id = Null;
        }
        if ($usuario->id == Null) {
            // Guardar la imagen de la Firma
            $gd2 = new DooFile();
            $type2 = $gd2->getUploadFormat('imagen');
            if ($type2 == "image/png" || $type2 == "image/jpeg") {
                $img = $gd2->upload(Doo::conf()->IMG_DIR . 'users/', 'imagen', 'user_image_' . date('Ymdhis'));
            } else {
                $img = "";
                //throw new Exception('Formato del Archivo no Valido!');
            }
            $usuario->imagen = $img;
            $usuario->password = md5($_POST["password"]);
            $usuario->created_at = $usuario->updated_at = date("Y-m-d H:i:s");
            Doo::db()->insert($usuario);
            /*
            $query = "INSERT INTO usuarios (usuario,identificacion,nombre,password,role,imagen,deleted,created_at,updated_at) VALUES ";
            $query.= " ('$usuario->usuario','$usuario->identificacion','$usuario->nombre',MD5('$usuario->password'),";
            $query.= "'$usuario->role','$usuario->imagen','0','$usuario->created_at','$usuario->updated_at')";
            Doo::db()->query($query);*/
        } else {
            $img = "";
            // Validacion si existe la imagen de l Firma
            if ($_FILES["imagen"]["name"] != "") {
                $gd2 = new DooFile();
                $type2 = $gd2->getUploadFormat('imagen');
                if ($type2 == "image/png" || $type2 == "image/jpeg") {
                    $img = $gd2->upload(Doo::conf()->IMG_DIR . 'users/', 'imagen', 'user_image_' . $usuario->id);
                } else {
                    $img = "";
                    //throw new Exception('Formato del Archivo no Valido!');
                }
            }

            $include = "";
            if ($img != "") {
                $include = ", imagen='$img'";
            }
            $fecha_update = date("Y-m-d H:i:s");
            Doo::db()->query("UPDATE usuarios SET usuario='$usuario->usuario',identificacion='$usuario->identificacion',nombre='$usuario->nombre',role='$usuario->role', updated_at='$fecha_update' $include where id='$usuario->id'");
        }
        return Doo::conf()->APP_URL . "usuarios";
    }
    
    public function perfil(){
        $login = $_SESSION["login"];
        $usuario = Doo::db()->find("Usuarios", array("select" => "id,usuario,imagen,nombre,identificacion", 'where' => 'id = ?', 'limit' => 1, 'param' => array($login->id)));        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['usuario'] = $usuario;
        $this->data['content'] = 'usuarios/perfil.php';
        $this->renderc('index', $this->data);
    }
    
    public function perfil_save() {
        Doo::loadModel("Usuarios");
        Doo::loadHelper('DooFile');
        $usuario = new Usuarios($_POST);
        if ($usuario->id == "") {
            $usuario->id = Null;
        }
        if ($usuario->id == Null) {
            
        } else {
            $img = "";
            // Validacion si existe la imagen de l Firma
            if ($_FILES["imagen"]["name"] != "") {
                $gd2 = new DooFile();
                $type2 = $gd2->getUploadFormat('imagen');
                if ($type2 == "image/png" || $type2 == "image/jpeg") {
                    $img = $gd2->upload(Doo::conf()->IMG_DIR . 'users/', 'imagen', 'user_image_' . $usuario->id);
                } else {
                    $img = "";
                    //throw new Exception('Formato del Archivo no Valido!');
                }
            }

            $include = "";
            if ($img != "") {
                $include = ", imagen='$img'";
            }
            $fecha_update = date("Y-m-d H:i:s");
            Doo::db()->query("UPDATE usuarios SET updated_at='$fecha_update' $include where id='$usuario->id'"); //usuario='$usuario->usuario',identificacion='$usuario->identificacion',nombre='$usuario->nombre',
        }
        return Doo::conf()->APP_URL;
    }

    public function deactivate() {
        $id = $this->params["pindex"];
        Doo::db()->query("UPDATE usuarios SET estado=0 WHERE id=?", array($id));
        return Doo::conf()->APP_URL . "usuarios";
    }

    public function validar() {
        $usuario = $_POST["usuario"];
        $id = $_POST["id"];
        $count = Doo::db()->query("select * from usuarios where usuario = '$usuario' and id <> '$id'")->rowCount();
        if ($count > 0)
            echo true;
        else
            echo false;
    }

//    public function Cambiar(){
//
//        //$this->data['usuarios'] = $usuarios;        
//        $this->data['rootUrl'] = Doo::conf()->APP_URL;
//        $this->data['content'] = 'usuarios/cambiar.php';
//        $this->renderc('index', $this->data, true);
//        
//    }
//    public function Cambiar_password(){
//        $login=$_SESSION['login'];
//        $key=$_POST["key"];
//        Doo::db()->query("UPDATE usuarios SET PASSWORD=MD5('$key') WHERE id='$login->id'");
//    }
}

?>
