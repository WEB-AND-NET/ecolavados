<?php

/*
http://micodigobeta.com.ar
http://dreamcoders.com.ar
 */
/*!
  @function num2letras ()
  @abstract Dado un n?mero lo devuelve escrito.
  @param $num number - N?mero a convertir.
  @param $fem bool - Forma femenina (true) o no (false).
  @param $dec bool - Con decimales (true) o no (false).
  @result string - Devuelve el n?mero escrito en letra.

/**
 * Description of FormatoFecha
 *
 * @author Usuario
 */
class Utilidades {

    public static function FormatearFecha($fecha) {
        $fs = new DateTime($fecha);
        return $fs->format('d') . "/" . $fs->format('m') . "/" . $fs->format('Y') . " " . $fs->format('h') . ":" . $fs->format('i') . ":" . $fs->format('s') . ' ' . $fs->format('A');
    }

    public static function FormatearFechaSimple($fecha) {
        $fs = new DateTime($fecha);
        return $fs->format('d') . "/" . $fs->format('m') . "/" . $fs->format('Y');
    }

    public static function Estados($estado) {
        $out = "";
        if ($estado == "P") {
            $out = "Pendiente";
        } else if ($estado == "O") {
            $out = "Programado";
        } else if ($estado == "R") {
            $out = "Reprogramado";
        } else if ($estado == "T") {
            $out = "Terminado";
        } else if ($estado == "N") {
            $out = "Anulado";
        }
        return $out;
    }

}
