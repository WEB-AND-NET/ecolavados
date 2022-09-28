<?php

/**
 * Description of EntrysServicios
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class EntrysServicios {


    /***
     * Con este metodo obtenemos la informacion basica que debe tener una entrada se le debe mandar el id de entrada
     */
    public function getEntry($id){
        if($id){
            return Doo::db()->query("SELECT e.fecha, t.serial,c.nombre,e.id,s.status_name,
                                    test30,test60,group_concat(concat(i.descripcion,'-',ie.valor)) as damage,e.status FROM entrada e 
                                    INNER  JOIN status s on (s.id=e.status)
                                    INNER  JOIN items_entrada ie  on (ie.id_entrada=e.id)
                                    INNER JOIN autorizacion_ingreso ai on  (ai.id=e.autorizacion_ingreso_id)
                                    INNER JOIN tanques  t on (t.id=ai.tanques_id)
                                    INNER JOIN clientes  c on (c.id=ai.clientes_id)
                                    INNER JOIN items i ON (i.id = ie.items_id)
                                    LEFT JOIN  items it ON (it.id = i.depende)
                                    LEFT JOIN  calificaciones ca ON (ca.descripcion = ie.valor and ca.goodorbad = 'B' AND ca.causes_log='S')
                                    where e.id='$id' group by e.id; ")->fetch();
        }
    }
}