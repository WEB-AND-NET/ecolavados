<?php 

class ProfilesController extends DooController {

    function index () {
        $id = $_SESSION['login']->id;
        $user = $this->db()->find("Usuarios", array("where"=>"id = $id","limit" => 1));
        $this->data['imagen'] = $user->imagen;
        $this->data['tipo'] = $user->tipo;
        $this->data['email'] = $user->email;
        $this->data['identificacion'] = $user->identificacion;
        $this->data['nombre'] = $user->nombre;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $login=$_SESSION["login"];
        $sql = "SELECT COUNT(*) as cantidad FROM tanques t  INNER JOIN clientes c on c.id=t.clientes_id WHERE t.deleted='1' and t.clientes_id='$login->id_usuario' GROUP BY t.clientes_id";
        $this->data['allTanks'] = $this->allTanks($login);
        $this->data['entrys'] = $this->entrys($login);
        $this->data['tanques'] = Doo::db()->query($sql)->fetch();
        $this->data['prods'] = $this->cantidadProds($login->id_usuario);
        $this->data['content'] = 'profiles/form.php';
        $this->renderc('index',$this->data,true);
    }

    function getProds() {
        $id = $this->params['id'];
        $sql = "SELECT cp.`id`, cp.`precio`, p.`nombre`, p.`description`
        FROM clientes_productos cp
        INNER JOIN clientes c ON (c.`id`=cp.`clientes_id`)
        INNER JOIN productos p ON (p.`id`=cp.`productos_id`)
        WHERE c.`id` = '$id'
        GROUP BY cp.`id` ";
        $res = Doo::db()->query($sql)->fetchAll();
        $datos = [];
        foreach ($res as $row) {
            $datos["data"][] = $row;
        }
        echo json_encode($datos);

    }


    function allTanks($login) {
        $where='';
        if($login->role=='13'){
            $where="where ai.clientes_id='$login->id_usuario'  ";
        }
        return Doo::db()->query("SELECT COUNT(*) AS cantidad
        from salida s
        INNER join tanques t on (t.id=s.id_tanque) 
        INNER join entrada e on (e.id=s.id_entrada)
        INNER join autorizacion_ingreso ai on (ai.id=s.id_autorizacion)
        INNER JOIN clientes  c on (c.id=ai.clientes_id) $where
        group by '$login->id_usuario' ")->fetch();
    
}

    function cantidadProds () {
        $id = $_SESSION['login']->id_usuario;
        $sql = "SELECT COUNT(*) AS cant
        FROM clientes_productos cp
        INNER JOIN clientes c ON (c.`id`=cp.`clientes_id`)
        INNER JOIN productos p ON (p.`id`=cp.`productos_id`)
        WHERE c.`id` = '$id'
        GROUP BY c.id ";
        return Doo::db()->query($sql)->fetch();
    }


    function entrys ($login) {
        $this->data["role"]=$login->role;
        $where='';
        if($login->role=='13'){
            $where=" c.id='$login->id_usuario' AND ";
        }
        $sql="SELECT COUNT(*) AS cantidad
        FROM entrada e
        INNER  JOIN status s ON (s.id=e.status)
        INNER JOIN autorizacion_ingreso ai on(ai.id=e.autorizacion_ingreso_id)
    	INNER JOIN tanques  t on (t.id=ai.tanques_id)
        INNER JOIN clientes  c on (c.id=ai.clientes_id)
    	LEFT  JOIN items_entrada ie  on (ie.id_entrada=e.id  and ie.causes_log='S')
        left JOIN  items it ON (ie.items_id = it.id) where
    	$where e.estado='A' group by '$login->id_usuario'";
        return Doo::db()->query($sql)->fetch();

    }


    function cambiarImg () {
        $id=$_SESSION['login']->id;
        Doo::loadHelper('DooGdImage');
        $gd   = new DooGdImage(Doo::conf()->IMG_PROFILE);
        $file = $gd->uploadImage('dataimagen', "imagen_".$id);
        $_SESSION['login']->imagen=$file;
        Doo::db()->query("update usuarios set imagen='$file' where id_usuario='$id' ");
    }

    


}

?>