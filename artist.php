<?php

    require 'getAT.php';
    
    class Artist{

        public $artistId;
        public $artistName;
        public $XartistName;                                //Name of the artist from whom he got linked
        public $XartistId;                                  //ID of the artist from whom he got linked

        public function __construct($artistId){
            $this->artistId = $artistId;
            $this->artistName = $this->getName($artistId);
        }

        function getName($Id){
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/artists/'.$Id.'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            
           // echo $_SESSION['access_token'];
            $headers = array();
            $headers[] = 'Authorization: Bearer '.$_SESSION['access_token'].'';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            
            $details_arr = json_decode($result,true);
            return $details_arr["name"];
             }

          function getRelatedArtists(){
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/artists/'.$this->artistId.'/related-artists');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            
            
            $headers = array();
            $headers[] = 'Authorization: Bearer '.$_SESSION['access_token'].'';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            $RelArtists_Details = json_decode($result,true);

            $RelArtists_name = array();

           
            for($i =0; $i < count($RelArtists_Details["artists"]) ; $i++){
                $RelArtists_name[] = $RelArtists_Details["artists"][$i]["name"];
            }

            $RelArtists_id = array();

           
            for($i =0; $i < count($RelArtists_Details["artists"]) ; $i++){
                $RelArtists_id[] = $RelArtists_Details["artists"][$i]["id"];
            }
            
            return $RelArtists_id;
            
          }   

    }

?>