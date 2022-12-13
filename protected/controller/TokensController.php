<?php

/**
 * Description of TokensController
 *
 * @author Maykel Rhenals 
 */
class TokensController extends DooController {
    public function generate($modulo){
        Doo::loadModel("Tokens");
        $token= new Tokens();
        $repet = false;
        do {
            $token->token = $this->generateRandomString(6);
            $repet = $this->exist($token->token);
        }while($repet);
        
        $token->modulo = $modulo;
        $token->estado = 1;
        Doo::db()->insert($token);
        return $token->token;
    }

    public function exist($token){
        $sql = "SELECT * FROM tokens WHERE token = '$token' AND estado = 1";
        $sql = Doo::db()->query($sql)->fetchAll();
        if(!$sql){
            return false;
        }
        return true;
    }

    public function desactivate($token){
        if($this->exist($token)){
            $sql = "UPDATE tokens SET estado = 0 WHERE token = '$token' AND estado = 1";
            $sql = Doo::db()->query($sql)->execute();
            return $sql;
        }
        return false;
    }



    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

?>