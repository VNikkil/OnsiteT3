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
                echo "inside";
                $Artist1 = new Artist($_GET['ID1']);
                $Artist2 = new Artist($_GET['ID2']);

                $Artist_dist_1 = array();               // Array containing the list of related artists of Artist A
                $Artist_dist_2 = array();
                $Artist_dist_3 = array();
                $Artist_dist_4 = array();

                $remove = array($Artist1);

                echo "<p> Artist 1 Name :".$Artist1->artistName."</p> <p> Artist 2 Name :".$Artist2->artistName."</p> <br>";
                $Artist_dist_1 = $Artist1->getRelatedArtists();

                if(in_array ($_GET['ID2'] , $Artist1->RelArtists_IDs))     // Checking whether B is in the array 
                    {
                        echo " Path Length = 1";
                        echo "<br><p>".$Artist1->artistName."</p>";
                        echo "<p>".$Artist2->artistName."</p>";
                    }
    

                else{

                    foreach ($Artist_dist_1 as $Temp_Artist)
                    {
                        $Temp_array = array();
                        //$Temp_Artist = new Artist($Temp_ID);
                        $Temp_array =  $Temp_Artist->getRelatedArtists();

                        foreach ($Temp_array as $temporaryartist)
                        {
                            $temporaryartist->XartistName = $Temp_Artist->artistName;
                            $temporaryartist->XartistId = $Temp_Artist->artistId;
                        }
                        $Temp_Artist->XartistName = $Artist1->artistName;
                        $Temp_Artist->XartistId = $Artist1->artistId;
                        if(in_array ($_GET['ID2'], $Temp_Artist->RelArtists_IDs))
                            {
                                
                                echo " Path Length = 2 ";
                                
                                echo "<br><p>".$Artist1->artistName."</p>";
                               echo "<p>".$Temp_Artist->artistName."</p>"; 
                               echo "<p>".$Artist2->artistName."</p>";

                                exit();
                            }

                        else{
                            $temparray= array();
                            $temparray = array_udiff($Temp_array, $Artist_dist_1,$Artist_dist_2,$remove,
                            function($artA,$artB){
                                if($artA->artistId != $artB->artistId)
                                return -1;

                                else
                                return 0;
                            });     //Adds the artist who are not in  $Artist_dist_1 to  $Artist_dist_2
                            $Artist_dist_2 = array_merge($Artist_dist_2, $temparray); 
                          }    
                    }
         
          
                    ////////////////////////////////////////////////////////////////////////////////////////////////

                
                    foreach($Artist_dist_2 as $Temp_Artist)
                    {
                        $Temp_array = array();

                        $Temp_array =  $Temp_Artist->getRelatedArtists();
                        
                        foreach ($Temp_array as $temporaryartist)
                        {
                            $temporaryartist->XartistName = $Temp_Artist->artistName;
                            $temporaryartist->XartistId = $Temp_Artist->artistId;
                        }

                        if(in_array ($_GET['ID2'] , $Temp_Artist->RelArtists_IDs))
                            {
                                echo " Path Length = 3";
                                echo "<br><p>".$Artist1->artistName."</p>";
                                
                                echo "<p>".$Temp_Artist->artistName."</p>";
                                echo "<p>".$Temp_Artist->XartistName."</p>";
                               echo "<p>".$Artist2->artistName."</p>"; 
                               exit();
                            }

                        else{
                            $temparray= array();
                            $temparray = array_udiff($Temp_array, $Artist_dist_1,$Artist_dist_2,$Artist_dist_3,$remove,
                            function($artA,$artB){
                                if($artA->artistId != $artB->artistId)
                                return -1;

                                else
                                return 0;
                            }); 
                            $Artist_dist_3 = array_merge($Artist_dist_3, $temparray);  
                          } 
                    }

                    ////////////////////////////////////////////////////////////////////////////////////////////

                    foreach ($Artist_dist_3 as $Temp_Artist)
                    {
                        $Temp_array = array();

                        $Temp_array =  $Temp_Artist->getRelatedArtists();

                        if(in_array ($_GET['ID2'] , $Temp_Artist->RelArtists_IDs))
                            {
                                echo " Path length = 4";
                                echo "<br><p>".$Artist1->artistName."</p>";
                                 //SOME CODE NEEDS TO BE ADDED HERE
                                echo "<p>".$Temp_Artist->artistName."</p>";
                                echo "<p>".$Temp_Artist->XartistName."</p>";
                                echo "<p>".$Artist2->artistName."</p>";
                               
                                exit();
                            }

                         else{
                            $temparray= array();
                            $temparray = array_udiff($Temp_array, $Artist_dist_1,$Artist_dist_2,$Artist_dist_3,$Artist_dist_4,$remove, function($artA,$artB){
                                if($artA->artistId != $artB->artistId)
                                return -1;

                                else
                                return 0;
                            }); 
                            $Artist_dist_4 = array_merge($Artist_dist_4, $temparray);  
                         }   
                    }

                    //////////////////////////////////////////////////////////////////////////////////////////////
                    
                    foreach ($Artist_dist_4 as $Temp_Artist)
                    {
                        $Temp_array = array();

                        $Temp_array =  $Temp_Artist->getRelatedArtists();

                        if(in_array ($_GET['ID2'] , $Temp_Artist->RelArtists_IDs))
                            {
                                echo " Path Length = 5";
                                echo "<br><p>".$Artist1->artistName."</p>";
                                //SOME CODE NEEDS TO BE ADDED HERE
                               echo "<p>".$Temp_Artist->artistName."</p>";
                               echo "<p>".$Temp_Artist->XartistName."</p>";
                               echo "<p>".$Artist2->artistName."</p>";

                            
                                exit();
                            }
                    }

                    echo " Path Limit Exceeded";
                }
            }
             
        ?>
       
</body>
