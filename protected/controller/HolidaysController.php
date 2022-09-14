<?php 

class HolidaysController extends DooController{

    public function index(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['festivos'] = Doo::db()->find("Festivos");
        $this->data['content'] = 'holidays/list.php';
        $this->renderc('index',$this->data,true);   
    }

    public function add(){
        Doo::loadModel("Festivos");
        $this->data['festivo'] = new Festivos();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'holidays/form.php';
        $this->renderc('index',$this->data,true);   
    }

    public function edit(){
        $id = $this->params['id'];
        $festivo = Doo::db()->find("Festivos",array("where"=>"id=?","param"=>array($id)));
        $this->data['festivo'] = $festivo[0];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'holidays/form.php';
        $this->renderc('index',$this->data,true);   
    }
    public function delete(){
        $id = $this->params['id'];
        $festivo = Doo::db()->query("DELETE FROM festivos WHERE id = '$id'");
        return Doo::conf()->APP_URL."holidays";
    }

    public function save(){
        //var_dump($festivo);
        //exit();
        Doo::loadModel("Festivos");
        $festivo = new Festivos($_POST);
        if($festivo->id == ""){
            $festivo->id = null;
            Doo::db()->insert($festivo);
        }else{
            Doo::db()->update($festivo);
        }
        return Doo::conf()->APP_URL."holidays";
    }

}

?>