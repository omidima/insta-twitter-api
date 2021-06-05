<?php
namespace App\Libraries;


class Auth {

    public function authCheckKey(){
        $key = $_SERVER['HTTP_AUTHORIZATION'];

        $news = db_connect()->table('keyed')->where("auth_key =",$key)->get()->getRow(1);
        if (empty($news)){
            return false;
        }else{
            return true;
        }
        
    }

    public function authUpdate(){
        $key = $_SERVER['HTTP_AUTHORIZATION'];

        $before = db_connect()->table('keyed')->where("auth_key =",$key)->get()->getRow(1);
        if (!empty($before)){
            $new = $this->createAuth();
            db_connect()->table('keyed')->where("user_id =",$before->user_id)->update(array(
                'auth_key'      => "Bearer " . $new,
            ));
            return $new;
        }else{
            return false;
        }
    }

     // create auth key hash
    public function createAuth(){
        return bin2hex(random_bytes(64));
    }
}