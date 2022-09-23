<?php
//$db = mysqli_connect("localhost","scceunim_mano","123456","scceunim_rms");
//$db = mysqli_connect("fdb29.awardspace.net","4178737_pomendb01	","unimapintek22","4178737_pomendb01");
try {
$database_name     = '4178737_pomendb01';
$database_user     = '4178737_pomendb01';
$database_password = 'unimapintek22';
//$database_host     = 'fdb29.awardspace.net';
$database_host     = 'localhost';
$electricWeight = 1;
$pipingWeigt = 2;
$carServiceWeigt = 3;
$constructionWeigt = 4;
$gardiningWeigt = 5;

$dbo = new PDO('mysql:host=' . $database_host . '; dbname=' . $database_name, $database_user, $database_password);
$dbo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
$dbo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
} catch (PDOException $e) {
            echo 'Database error. ' . $e->getMessage();
        }    
//$db = new mysqli("fdb29.awardspace.net","4178737_pomendb01","unimapintek22");
//if($db->connect_errno > 0){
 //   die('Unable to connect to database [' . $dbo->connect_error . ']');}
?>