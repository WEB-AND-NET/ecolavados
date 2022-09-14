/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function esBisiesto(ano) {
    if (ano % 4 === 0)
        return true;
    return false;
}

function getDays(month, year) {

    var ar = new Array(12);
    ar[0] = 31; // Enero
    if (esBisiesto(year)) {
        ar[1] = 29;
    } else {
        ar[1] = 28;
    }
    ar[2] = 31; // Marzo
    ar[3] = 30; // Abril
    ar[4] = 31; // Mayo
    ar[5] = 30; // Junio
    ar[6] = 31; // Julio
    ar[7] = 31; // Agosto
    ar[8] = 30; // Septiembre
    ar[9] = 31; // Octubre
    ar[10] = 30; // Noviembre
    ar[11] = 31; // Diciembre

    return ar[month];
}
    
var vdia = 24*60*60*1000;
var fecha  = new Date();
var diasmes = getDays(fecha.getMonth(),fecha.getFullYear());
//alert("Valor dia = "+vdia+" Hora dia de hoy "+((fecha.getHours()*fecha.getMinutes()*fecha.getSeconds()*fecha.getMilliseconds())));
//    var fecha2  = new Date();
//    fecha2.setHours(07,00,00,00);
//    alert(fecha2);alert(fecha.getMonth()+1);
var manana = new Date(fecha.getTime() + vdia);
//var laProximaSemana=new Date(fecha.getTime() + (24*60*60*1000)*7);
//alert("Año = "+fecha.getFullYear()+" Mes = "+(fecha.getMonth()+1)+"  #Dias = "+getDays(fecha.getMonth(),fecha.getFullYear()));
var diasr = diasmes - fecha.getDate();
//if(diasr < 7){
//    diasr = getDays(fecha.getMonth()+1,fecha.getFullYear())+diasr;
//}
var finMes = new Date(fecha.getTime() + vdia * diasr);   

function getHoy(){
    return new Date(fecha.getTime());
}

function getManana(){
    return manana;
}

function getFinMes(){
    return finMes;
}
