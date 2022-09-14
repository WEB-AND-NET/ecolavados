<?php

/**
 * Description of CambiarController
 *
 * @author web.
 */
class CambiarController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            if ($_SESSION["permisos"]["503"] != 1) {
                $_SESSION["msg_error"] = "No tiene Permiso para esta Opci&oacute;n";
                return Doo::conf()->APP_URL;
            }
        }
    }

    public function index() {
        $login = $_SESSION['login'];
        $rol = $login->role;
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($rol != "1") {
            $this->data['content'] = 'usuarios/cambiar.php';
            $this->renderc('index_propietarios', $this->data, true);
        } else {
            $this->data['content'] = 'usuarios/cambiar.php';
            $this->renderc('index', $this->data, true);
        }
    }

    public function update() {
        $login = $_SESSION['login'];
        $key = $_POST["key"];
        Doo::db()->query("UPDATE usuarios SET password=MD5('$key') WHERE id='$login->id'");
        return Doo::conf()->APP_URL;
    }

    public function validar() {
        $key = $_POST["oldkey"];
        $login = $_SESSION['login'];
        $id = $login->id;
        $count = Doo::db()->query("SELECT id FROM usuarios WHERE id='$id' AND password=MD5('$key')")->rowCount();
        if ($count > 0) {
            echo true;
        } else {
            echo false;
        }
    }

}

?>
