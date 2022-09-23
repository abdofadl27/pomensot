<?php 

function check_for_session()
{
session_start();
if($_SESSION['id'])
{
     $id=$_SESSION['id'];
    echo $id;
    
}
else {
    header("Location: http://www.example.com/another-page.php");
exit();}
}

?>