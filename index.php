<?php
    require 'artist.php';

?>

<!DOCTYPE html>
<body>
    <form action="" method="get">
        <label for="ID1">ARTIST 1 ID : </label>
        <input type="text" name="ID1"><br>
        <label for="ID2">ARTIST 2 ID : </label>
        <input type="text" name="ID2">
        <input type="submit" name="submit" value="submit" ><br>
        </form>
        <?php
            if(isset($_GET['ID1']) && isset($_GET['ID2']))
            {
                $Artist1 = new Artist($_GET['ID1']);
                $Artist2 = new Artist($_GET['ID2']);

                $Artist_dist_1 = array();               // Array containing the list of related artists of Artist A
                $Artist_dist_2 = array();
                $Artist_dist_3 = array();
                $Artist_dist_4 = array();

                $remove = array($_GET['ID1']);

                echo "<p> Artist 1 Name :".$Artist1->artistName."</p> <p> Artist 2 Name :".$Artist2->artistName."</p> <br>";
                $Artist_dist_1 = $Artist1->getRelatedArtists();

                if(in_array ($_GET['ID2'] ,  $Artist_dist_1))     // Checking whether B is in the array 
                    echo " Path distance = 1";
    

                else{

                    foreach ($Artist_dist_1 as $Temp_ID)
                    {
                        $Temp_array = array();
                        $Temp_Artist = new Artist($Temp_ID);
                        $Temp_array =  $Temp_Artist->getRelatedArtists();

                        if(in_array ($_GET['ID2'] , $Temp_array))
                            {
                                echo " Path Distance = 2";
                                exit();
                            }

                        else{
                            $temparray= array();
                            $temparray = array_diff($Temp_array, $Artist_dist_1,$Artist_dist_2,$remove);     //Adds the artist who are not in  $Artist_dist_1 to  $Artist_dist_2
                            $Artist_dist_2 = array_merge($Artist_dist_2, $temparray); 
                          }    
                    }
                    ////////////////////////////////////////////////////////////////////////////////////////////////


                    foreach($Artist_dist_2 as $Temp_ID)
                    {
                        $Temp_array = array();

                        $Temp_Artist = new Artist($Temp_ID);
                        $Temp_array =  $Temp_Artist->getRelatedArtists();

                        if(in_array ($_GET['ID2'] , $Temp_array))
                            {
                                echo " Path Distance = 3";
                                exit();
                            }

                        else{
                            $temparray= array();
                            $temparray = array_diff($Temp_array, $Artist_dist_1,$Artist_dist_2,$Artist_dist_3,$remove);
                            $Artist_dist_3 = array_merge($Artist_dist_3, $temparray);  
                          } 
                    }

                    ////////////////////////////////////////////////////////////////////////////////////////////

                    foreach ($Artist_dist_3 as $Temp_ID)
                    {
                        $Temp_array = array();

                        $Temp_Artist = new Artist($Temp_ID);
                        $Temp_array =  $Temp_Artist->getRelatedArtists();

                        if(in_array ($_GET['ID2'] , $Temp_array))
                            {
                                echo " Path Distance = 4";
                                exit();
                            }

                         else{
                            $temparray= array();
                            $temparray = array_diff($Temp_array, $Artist_dist_1,$Artist_dist_2,$Artist_dist_3,$Artist_dist_4,$remove);
                            $Artist_dist_4 = array_merge($Artist_dist_4, $temparray);  
                         }   
                    }

                    //////////////////////////////////////////////////////////////////////////////////////////////
                    
                    foreach ($Artist_dist_4 as $Temp_ID)
                    {
                        $Temp_array = array();

                        $Temp_Artist = new Artist($Temp_ID);
                        $Temp_array =  $Temp_Artist->getRelatedArtists();

                        if(in_array ($_GET['ID2'] , $Temp_array))
                            {
                                echo " Path Distance = 5";
                                exit();
                            }
                    }

                    echo " Path Limit Exceeded";
                }
            }
             


















/*

                if(!check($_GET['ID1'],$_GET['ID2']))
                {
                    $CheckedIds_1[] = $_GET['ID1'];
                    //$CheckedIds_2[] = $_GET['ID2'];
          
                    foreach ($RelArtists_1_id as $Temp_1_ID)
                    { 
                        if(! in_array ( $Temp_1_ID, $CheckedIds_1))
                        {
                            
                                foreach( $RelArtists_2_id as $Temp_2_ID)
                            {
                                if(! in_array ( $Temp_2_ID, $CheckedIds_2))
                                 {    
                                     if(check($Temp_1_ID,$Temp_2_ID))
                                        {
                                            echo " Yes They are linked";
                                            break;
                                        }
                                       // $CheckedIds_2[] = $Temp_2_ID;
                                    }  
                            }

                            $CheckedIds_1[] = $Temp_1_ID;
                        }
                    } 
                }
                else
                echo " Between them 1 person ";

                echo " Out of the IF function";
               
            }

            function check($Id1,$Id2)
            {
                    $Artist1 = new Artist($Id1);
                    $Artist2 = new Artist($Id2);
                    echo "<p> Artist 1 Name :".$Artist1->artistName."</p>  <p> Artist 2 Name :".$Artist2->artistName."</p> <br>";
                    $RelArtists_1_id = $Artist1->getRelatedArtists();
                    $RelArtists_2_id = $Artist2->getRelatedArtists();

                /*   for($i =0; $i < count($RelArtists_name) ; $i++){
                        echo  $RelArtists_name[$i].'<br>';
                    }

                    $result = (count(array_intersect($RelArtists_1_id, $RelArtists_2_id))) ? true : false;

                    if($result)
                    echo "true";

                    else
                    echo "false";

                    return $result;

            }
*/
        ?>
       
</body>
