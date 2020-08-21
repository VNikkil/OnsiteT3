<?php
                    session_start();

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
                    $headers = array();
                    $headers[] = 'Authorization: Basic ZWJmZTcyMzViMzhkNDQ0YmE3YmZiNjgwNmMwMzBkZDk6MWExMGM5YmQ4NmI1NGEzYjkxYmFjNWRhYzk1MTIxNzU=';
                    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        echo 'Error:' . curl_error($ch);
                    }
                    curl_close($ch);

                    $array = json_decode($result, true);
                    
                    $_SESSION['access_token'] = $array['access_token'];
/*
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/artists/246dkjvS1zLTtiykXe5h60/related-artists');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


                    $headers = array();
                    $headers[] = 'Authorization: Bearer '.$array['access_token'].'';
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        echo 'Error:' . curl_error($ch);
                    }
                    curl_close($ch);

                    echo $result;

*/

?>