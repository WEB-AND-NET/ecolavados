<?php

/**
 * Description of ProductosController
 *
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class ProductosController extends DooController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }

        if (!isset($_SESSION['permisos'])) {
            return Doo::conf()->APP_URL;
        } else {
            
        }
    }

    public function index() {
        $login = $_SESSION['login'];
        $rol = $login->role;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $sql = "SELECT p.id,p.nombre,p.cantidad,tp.tipo as tipo, um.nombre unidad_medida FROM productos p
        INNER JOIN tipos_productos tp on (tp.id=p.tipo)
        INNER JOIN unidades_medida um on(um.id=p.unidad_medida)
        WHERE p.deleted=1 ORDER BY nombre ASC";
        $this->data['productos'] = Doo::db()->query($sql)->fetchAll();
        $this->data["item"] = Doo::db()->query("SELECT id,tipo  FROM tipos_productos  ")->fetchAll();
        $this->data['content'] = 'productos/list.php';
        $this->renderc('index', $this->data, true);
    }
    
    public function productsPrinter(){
        Doo::loadClass("pdf/fpdf");
        Doo::loadClass("reportes/ProductsPrinterPDF");
        $pdf = new ProductsPrinterPDF();
        $id = $this->params["pindex"];
        $response=Doo::db()->query("SELECT p.id,p.nombre,p.cantidad,tp.tipo as tipo, um.nombre unidad_medida 
        FROM productos p
        INNER JOIN tipos_productos tp on (tp.id=p.tipo)
        INNER JOIN unidades_medida um on(um.id=p.unidad_medida)
        WHERE p.deleted=1 and tp.id='$id' ORDER BY nombre ASC")->fetchAll();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->body($response);
        $pdf->Output();
    }
    
    public function history(){
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;


        $sql = "SELECT p.description,p.grupo,p.precio_compra,p.id,p.nombre,p.cantidad,tp.tipo as tipo, um.nombre unidad_medida FROM productos p
        INNER JOIN tipos_productos tp on (tp.id=p.tipo)
        INNER JOIN unidades_medida um on(um.id=p.unidad_medida)
        WHERE p.deleted=1 and p.id='$id' ORDER BY nombre ASC";
        $this->data['productos'] = Doo::db()->query($sql)->fetch();

        $this->data["movimientos"] = Doo::db()->query("SELECT * FROM movimientos where productos_id='$id';")->fetchAll();

        $this->data['grupos']=Doo::db()->find("Grupos",array("where"=>"deleted = 1"));
       // $this->data["productos"] = Doo::db()->find("Productos",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['content'] = 'productos/history.php';
        $this->renderc('index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Productos");
        $login = $_SESSION['login'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['productos'] = new Productos();
        $this->data['unidades']=Doo::db()->find("UnidadesMedida",array("where"=>"deleted = 1"));
        $this->data['grupos']=Doo::db()->find("Grupos",array("where"=>"deleted = 1"));
        $this->data['content'] = 'productos/form.php';
        $this->renderc('index', $this->data, true);
    }

    public function movimientos(){
        $id=$this->params["id"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;


        $sql = "SELECT p.description,p.grupo,p.precio_compra,p.id,p.nombre,p.cantidad,tp.tipo as tipo, um.nombre unidad_medida FROM productos p
        INNER JOIN tipos_productos tp on (tp.id=p.tipo)
        INNER JOIN unidades_medida um on(um.id=p.unidad_medida)
        WHERE p.deleted=1 and p.id='$id' ORDER BY nombre ASC";
        $this->data['productos'] = Doo::db()->query($sql)->fetch();

        $this->data['grupos']=Doo::db()->find("Grupos",array("where"=>"deleted = 1"));
       // $this->data["productos"] = Doo::db()->find("Productos",array("where"=>"id = ?","limit"=>1,"param"=>array($id)));
        $this->data['content'] = 'productos/movements.php';
        $this->renderc('index', $this->data, true);
    }

    public function getTipo (){
        if(isset($_REQUEST["search"])){
            $param=$_REQUEST["search"];
            $json["item"] = Doo::db()->query("SELECT id,tipo  FROM tipos_productos WHERE tipo  LIKE '%$param%'  ")->fetchAll();
            echo json_encode($json);
        }
    }

    public function saveTipo(){
        Doo::loadModel("TiposProductos");
        $TiposProductos = new TiposProductos($_POST);
        $fecha = new DateTime();
        $TiposProductos->create_at =$fecha->format('Y-m-d H:i:s');
        $TiposProductos->update_at = $fecha->format('Y-m-d H:i:s');;
        echo  Doo::db()->insert($TiposProductos);        
    }

    
    public function save(){
        Doo::loadModel("Productos");
        $Productos = new Productos($_POST);
        $fecha = new DateTime();
        if($Productos->id==""){
            $Productos->id=null;
            $Productos->create_at =$fecha->format('Y-m-d H:i:s');
            $Productos->update_at = $fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($Productos);
        }else{
            if($_POST["movement"]!="U"){
                $Productos->update_at =$fecha->format('Y-m-d H:i:s');
                Doo::loadModel("Movimientos");
                $Movimientos = new Movimientos();
                $Movimientos->update_at = $fecha->format('Y-m-d H:i:s');
                $Movimientos->tipo = "I";
                $Movimientos->cantidad = $_POST["cantidad"];
                $Movimientos->precio = $Productos->precio_compra;
                $Movimientos->productos_id = $Productos->id;
                Doo::db()->insert($Movimientos);
            }
                $Productos = Doo::db()->find("Productos",array("where"=>"id = ?","limit"=>1,"param"=>array($_POST["id"])));
                if($_POST["movement"]!="U"){
                    $Productos->precio_compra = ($Productos->precio_compra==$Movimientos->precio?$Productos->precio_compra:$Movimientos->precio);
                    $total = $Productos->cantidad + $_POST["cantidad"];
                    $Productos->cantidad = $total; 
                }
                
                $Productos->nombre=$_POST["nombre"];
                $Productos->grupo=$_POST["group"];
                $Productos->description=$_POST["description"];
                Doo::db()->update($Productos);
           
        }
        
        return Doo::conf()->APP_URL . 'products';   
    }
    public function desactivate(){
        $id = $this->params["pindex"];       
        Doo::db()->query("UPDATE productos SET deleted=0 WHERE id = ?", array($id));
        return Doo::conf()->APP_URL . 'products';  
    }    
    public function categoriasIndex(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data["categorys"]= Doo::db()->query("SELECT id,tipo FROM tipos_productos WHERE deleted='1'")->fetchAll();
        $this->data['content'] = 'productos/category_list.php';
        $this->renderc('index', $this->data, true);
    }    
    public function categoriaAdd(){
        Doo::loadModel('TiposProductos');
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data["categorys"]= new TiposProductos();
        $this->data['content'] = 'productos/category_form.php';
        $this->renderc('index', $this->data, true);
    }

    public function categoriasEdit(){
        $id = $this->params["id"];
        Doo::loadModel('TiposProductos');
        $TiposProductos = new TiposProductos();
        $TiposProductos->id=$id;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data["categorys"]=Doo::db()->find($TiposProductos,array("limit"=>1));
        $this->data['content'] = 'productos/category_form.php';
        $this->renderc('index', $this->data, true);
    }
    public function categoriaSave(){
        Doo::loadModel('TiposProductos');
        $TiposProductos = new TiposProductos($_POST);
        $fecha = new DateTime();
        $TiposProductos->update_at = $fecha->format('Y-m-d H:i:s');;
        
        if($TiposProductos->id==""){
            $TiposProductos->id=NULL;
            $TiposProductos->create_at =$fecha->format('Y-m-d H:i:s');
            Doo::db()->insert($TiposProductos);
        }else{
            Doo::db()->update($TiposProductos);
        }
        return  Doo::conf()->APP_URL. 'products/categorys';

    }
    public function IndexProcedures(){    
        $id_producto = $this->params["id"];
        if (isset($_SESSION["items_p"])) {
            $_SESSION["items_p"]=null;
        }   

        $productos_data = Doo::db()->query("SELECT id FROM productos_data WHERE id_producto='$id_producto'")->fetch();
        if(!$productos_data){
            Doo::db()->query("INSERT INTO `productos_data` (`id_producto` )VALUES( $id_producto);");
        }

        $this->data['productos_data'] = Doo::db()->find("ProductosData",array("where"=>"id_producto = ?","limit"=>1,"param"=>array($id_producto)));
        
        
        $this->loadP($id_producto);
            $sql = "SELECT p.id,p.nombre,p.cantidad,tp.tipo as tipo, um.nombre unidad_medida FROM productos p
            INNER JOIN tipos_productos tp on (tp.id=p.tipo)
            INNER JOIN unidades_medida um on(um.id=p.unidad_medida)
            WHERE p.deleted=1 ORDER BY nombre ASC";

            $this->data["id_producto"]=$id_producto;
            
            $this->data['productos'] = Doo::db()->query($sql)->fetchAll();
            $this->data['unidades']=Doo::db()->find("UnidadesMedida",array("where"=>"deleted = 1"));
            $this->data['content'] = 'productos/procedures.php';
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->renderc('index', $this->data, true);
    }

    public function ProceduresViewActivities(){    
        $id_producto = $this->params["id"];
        $this->data['imagenes']=array(
            "GHS01"=>array("imagen"=>"GHS01-EXPLOSIVO.jpg","Nombre"=>"GHS01 EXPLOSIVO"),
            "GHS02"=>array("imagen"=>"GHS02-INFLAMABLE.jpg","Nombre"=>"GHS02 INFLAMABLE"),
            "GHS03"=>array("imagen"=>"GHS03-OXIDANTE.jpg","Nombre"=>"GHS03-OXIDANTE.jpg"),
            "GHS04"=>array("imagen"=>"GHS04-GAS PRESURIZADO.jpg","Nombre"=>"GHS04-GAS PRESURIZADO"),
            "GHS05"=>array("imagen"=>"GHS05-CORROSIVO.jpg","Nombre"=>"GHS05-CORROSIVO"),
            "GHS06"=>array("imagen"=>"GHS06-TOXICIDAD CATEGORIAS 1,2,3.jpg","Nombre"=>"GHS06-TOXICIDAD CATEGORIAS 1,2,3"),
            "GHS07"=>array("imagen"=>"GHS07-TOXICIDAD RESTO DE CATEGORIAS.jpg","Nombre"=>"GHS07-TOXICIDAD RESTO DE CATEGORIAS"),
            "GHS08"=>array("imagen"=>"GHS08-PELIGROSO PARA EL CUERPO.jpg","Nombre"=>"GHS08-PELIGROSO PARA EL CUERPO"),
            "GHS09"=>array("imagen"=>"GHS09-PELIGRO PARA EL MEDIO AMBIENTE.jpg","Nombre"=>"GHS09 PELIGRO PARA EL MEDIO AMBIENTE"),
        );
        $sql = "SELECT p.id,p.nombre,p.cantidad,tp.tipo as tipo, um.nombre unidad_medida FROM productos p
            INNER JOIN tipos_productos tp on (tp.id=p.tipo)
            INNER JOIN unidades_medida um on(um.id=p.unidad_medida)
            WHERE p.deleted=1 ORDER BY nombre ASC";
             $this->data["id_producto"]=$id_producto;
        $this->data['productos_data'] = Doo::db()->find("ProductosData",array("where"=>"id_producto = ?","limit"=>1,"param"=>array($id_producto)));
        $this->data['productos'] = Doo::db()->query($sql)->fetchAll();
        $this->data['unidades']=Doo::db()->find("UnidadesMedida",array("where"=>"deleted = 1"));
        $this->data['productos_riesgos'] = Doo::db()->query("SELECT * FROM `productos_riesgos` WHERE id_producto='$id_producto'")->fetchAll();
        $this->data['content'] = 'productos/viewProcedures.php';
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('index', $this->data, true);
    }

    public function loadP($id_producto){
        $_SESSION["items_p"]= serialize(Doo::db()->query("SELECT pr.id,p.nombre productos_name,pr.cantidad, um.nombre unidad FROM productos p
        INNER JOIN productos_relacion pr ON (pr.id_producto_a=p.id)
        INNER JOIN unidades_medida um ON(um.id=p.unidad_medida)
        WHERE pr.id_producto='$id_producto'")->fetchAll());
    }

    
    public function ProceduresGetItems(){ 
        if (isset($_SESSION["items_p"])) {
            $datos = unserialize($_SESSION["items_p"]);
        } else {
            $datos = array();
        }
        $data=array("data"=>$datos);
        echo json_encode($data);    
    }
    public function ProceduresGetActivities(){     
        $id_producto=$this->params["id"];
        $datos = Doo::db()->query("SELECT * FROM `productos_actividad` WHERE id_producto='$id_producto'")->fetchAll();
        $data=array("data"=>$datos);
        echo json_encode($data);    
    }

    

    public function ProceduresSetItems(){
        Doo::loadModel("ProductosRelacion");
        $ProductosRelacion = new ProductosRelacion($_POST);
        Doo::db()->insert($ProductosRelacion);
        $this->loadP($ProductosRelacion->id_producto);
    }

    public function SetProceduresGetActivities(){
        Doo::loadModel("ProductosActividad");
        $ProductosActividad = new ProductosActividad($_POST);
        Doo::db()->insert($ProductosActividad);
    }

    public function ProceduresSetData(){
        $id_producto = $_POST["id_producto"];
        $val = $_POST["val"];
        $clave = $_POST["clave"];
        Doo::db()->query("update productos_data set $clave = '$val' where id_producto='$id_producto'");
    }
     public function deleteActivity(){
        $id = $_POST["id"];
        Doo::db()->query("delete from productos_actividad where id='$id'");
    }

    
    public function deleteRelacion(){
        $id = $_POST["id"];
        $idp = $_POST["id_producto"];
        
        Doo::db()->query("delete from productos_relacion where id='$id'");
        $this->loadP($idp);
    }

    public function setDangers(){
        $dangerr=$_POST["dangerr"];
        $id_producto=$_POST["id_producto"];        
        $datos = Doo::db()->query("SELECT * FROM `productos_riesgos` WHERE id_producto='$id_producto' and riesgo='$dangerr'")->fetchAll();
        if($datos){
            Doo::db()->query("delete from productos_riesgos where id_producto='$id_producto' and riesgo='$dangerr'");
        }else{
            Doo::db()->query("INSERT INTO `productos_riesgos`(`id_producto`,riesgo )VALUES($id_producto,'$dangerr');");
        }


    }
 
    public function getdangers(){
        $id_producto=$_POST["id_producto"];  
        $datos = Doo::db()->query("SELECT * FROM `productos_riesgos` WHERE id_producto='$id_producto'")->fetchAll();
        echo json_encode($datos);  
    }
    
    


}





?>