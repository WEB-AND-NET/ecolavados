<?php

/**
 * Description of ErrorController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ErrorController extends DooController {

    public function index() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'error/404.php';
        $login = $_SESSION['login'];
        $id_usuario = $login->id_usuario;
        $rol = $login->role;
        if($rol == "1"){
            $this->renderc('index', $this->data, true);
        }else{
            if($rol == "3"){
                $this->renderc('index_propietarios', $this->data, true);
            }
            if($rol == "4"){
                $this->renderc('index_clientes', $this->data, true);
            }
        }        
    }

}

