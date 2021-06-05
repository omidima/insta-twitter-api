<?php

namespace App\Libraries;

class ApiParser{
    public function insta_userPost($username){
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://instagram47.p.rapidapi.com/user_posts?username=".$username,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: instagram47.p.rapidapi.com",
                "x-rapidapi-key: 04337aa2c7mshdb6436d96d77a73p155b5ejsn13a8a28a462e"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return $response;
        }
    }
}