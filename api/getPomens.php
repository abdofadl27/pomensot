<?php
if(isset($_GET['app_id']))
{
    include 'config.php';
    $sql = "SELECT a.`id`,a.`name`,a.`email`,a.`image`,a.`location`,a.`address`  FROM `user` AS a INNER JOIN `poment_type` AS b "
            . "WHERE a.pomen = b.id AND b.weight = ".$_GET['weight']." ;";
     $stmt = $dbo->prepare($sql);
            $stmt->execute();           
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {          
                 $data[] = $row;  
            } 
           $response         = [];
           $response['data'] =  $data;
           echo json_encode($response, JSON_PRETTY_PRINT);           
    }else echo 'ER2';
