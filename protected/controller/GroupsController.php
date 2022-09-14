<?php

class GroupsController extends DooController {


    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
          
        }
    }

    public function index(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'groups/list.php';
        $this->renderc('index', $this->data, true);
    }

    public function getGroups(){
        $datos=Doo::db()->find("Grupos",array("where"=>"deleted = 1"));
        $data=array("data"=>$datos);
        echo json_encode($data);
    }

    public function save(){
        Doo::loadModel("Grupos");
        $group = new Grupos($_POST);
        if($group->id==""){
            $group->id=null;
            return Doo::db()->insert($group);
        }else{
            Doo::db()->update($group);
        }
    }


    public function deleteItem(){
        $id=$_POST["id"];
        Doo::db()->query("UPDATE grupos set deleted='0' WHERE id='$id'");        
    }
}

?>