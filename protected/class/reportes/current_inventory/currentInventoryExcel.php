<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class currentInventoryExcel {


    public function getCurrentInventoryCsv($currentInventory){
        $delimiter = ",";
        $filename = "current_inventory" . date('Y-m-d') . ".csv";
        //create a file pointer
        $f = fopen('php://memory', 'w');
        //set column headers
        $fields = array('ID', 'Tank', 'Type', 'Client-Assign', 'Client', 'Status','Entry Date','Test 2.5','Test 5','Gate out','Departure','Damage','Observation');
        fputcsv($f, $fields, $delimiter);
        $entradas = $currentInventory;
        foreach($entradas as $entrada){
            $lineData = array(  $entrada['id'], 
                                $entrada['serial'], 
                                $entrada['type'], 
                                $entrada['name_client_send'], 
                                $entrada['nombre'], 
                                $entrada['status_name'], 
                                $entrada['fecha'], 
                                $entrada['test30'], 
                                $entrada['test60'],
                                $entrada['salida'], 
                                $entrada['fecha_salida'], 
                                $entrada['damage'], 
                                $entrada['observation']);
            fputcsv($f, $lineData, $delimiter);
        }
        fseek($f, 0);    
        //set headers to download file rather than displayed
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');        
        //output all remaining data on a file pointer
        fpassthru($f);
    }
}




