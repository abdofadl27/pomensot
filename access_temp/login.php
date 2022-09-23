<?php
include 'configs/headl.inc.php';
include 'configs/config.php';
if(isset($_POST['loginaaa']))
{  
$pass = hash("sha512",$_POST['pwd']);
$sql = "SELECT `id` FROM `lecturer` WHERE `email`= '".$_POST['email']."' AND `pass` = '".$pass."' AND `level` < 5 LIMIT 1";
//$query = $db->query($sql);
if($query = $db->query($sql)){
if($query->num_rows > 0)
{
$sessionID = session_id();

$hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);

$userData = $query->fetch_assoc();

$expires = time()+(60*60);

//if the user in the active update only

$ck = "SELECT `id` FROM `active_users` WHERE `active_users`.`user`= '".$userData['id']."' LIMIT 1";

$ck_r = $db->query($ck);

if($ck_r->num_rows < 1)

$new_sql = "INSERT INTO `active_users`(`user`, `session_id`, `hash`, `expires`, `level`) VALUES ('".$userData['id']."','".$sessionID."','".$hash."','".$expires."','".$userData['level']."')";

else $new_sql = "UPDATE `active_users` SET `"

        . "session_id` = '".$sessionID."' , `hash` = '".$hash."', `expires` = '".$expires."' WHERE `active_users`.`user` = ".$userData['id'];

$db->query($new_sql);

$f = getUser();

if($f['level'] < 5) {header("Location:index.php"); }

else if($f['level'] == 1) {header("location:../index.php#contact?err='errore[3]'#log-in");}

else if($f['level'] == 3){header("Location:system.php");}

else header("location:../index.php#contact?err='errore[2]'#log-in");

}else {header("location:../index.php?err='errore[9][".$sql."]'#contact");
}} else header("location:../index.php?err='error[0][".$sql."]'#contact");
}
if(isset($_POST['signup']))
{
    
   $pass1 = hash("sha512",$_POST['pwd1']); 
   $pass2 = hash("sha512",$_POST['pwd2']);
   if(strcmp($pass1,$pass2) == 0)
   {
       
   }else header("location:../index.php#signup");
}