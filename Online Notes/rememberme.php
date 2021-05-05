<?php
//If the user is not logged in & rememberme cookie exists
if(!isset($_SESSION['user_id']) && !empty($_COOKIE['rememberme'])){
    //f1: COOKIE:  $a . "," . bin2hex($b)
    //f2:  hash('sha256', $a)
    
    //extract $authentificators 1&2 from the cookie 
    list($authentificator1, $authentificator2) = explode(',',  $_COOKIE['rememberme']);
    
    $authentificator2 = hex2bin($authentificator2);
    
    $f2authentificator2 = hash('sha256', $authentificator2);
    
    //Look for authentificator1 in the rememberme table
    $sql = "SELECT * FROM rememberme where authentificator1= '$authentificator1'";
    $result = mysqli_query($link, $sql);
    if(!$result){
         echo '<div class="alert alert-danger">There was an error running the query!</div>';
         exit;
    }
    $count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="alert alert-danger">Remember me process failed!</div>';
        exit;
    }
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    //If authentificator2 does not match 
    if(!hash_equals($row['f2authentificator2'], $f2authentificator2)){
          echo '<div class="alert alert-danger">hash_equals returned false.</div>';
    }
    else{
        //generate new authentificators
        //Store them in cookie and remembermetable
            $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10)); //od binarno u heksaceimalno
            //10 bajta po 8 bita toa e 2*2*2*...*2 80 puta
            //posho u heksadecimalen go reprezentiramo treba da vidimo 16 kako se dobiva
            // 2*2*2*2 = 16 znaci 4-4ke ime
            // ima 80 : 4 = 20 znaci 20 cifre ce ni trebaa za taa kolona
            $authentificator2 = openssl_random_pseudo_bytes(20); 
            
            //Store them in cookie
            function f1($a, $b){
                $c = $a . "," . bin2hex($b); //concatinanting 2 variables i tesko e so e a so e b da se znae, so , kje znameo deka a e levo od , a b e desno od , Ama za da e potesko za b kje ja ostae gore da ne bide heksadecimalna ama unutra u funckijata kje ja naprae
                
                return $c;
            }
            $cookieValue = f1($authentificator1, $authentificator2);
            setcookie(
                "rememberme", //name of cookie
                $cookieValue,
                time()+1296000 //experation date and time (time function za time denesno i sea sakamo da expire-ne za 15 dena od sea ama mora u sekunde i imamo 15 po 24 saata po 60 minuta po 60 sekunde -> 15*24*60*60 = 1296000)
                
            );
            //Run query to store them in rememberme table
            function f2($a){
                $b = hash('sha256', $a); 
                //ova ni dava 256 bita ovja 256 bita treba so 4 da se podeli i toa ni dava 64
                return $b;
            }
            $f2authentificator2 = f2($authentificator2);
            $user_id = $_SESSION['user_id'];
            $expiration = date('Y-m-d H:i:s', time() + 1296000);
            $sql = "INSERT INTO  rememberme 
            (`authentificator1`, `f2authentificator2`, `user_id`, `expires`)
            VALUES
            ('$authentificator1', '$f2authentificator2', '$user_id', '$expiration')";
            
            $result = mysqli_query($link, $sql);
            if(!$result){
                echo '<div class="alert alert-danger">There was an error storing data to remember you next time!</div>';
            }
            
        
            $_SESSION['user_id']=$row['user_id'];
            header("location:mainpageloggedin.php");
        }
        
    }

?>