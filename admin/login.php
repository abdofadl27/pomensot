<?php
include '../api/headl.inc.php';
include '../api/config.php';
if(isset($_POST['loginaaa']))
{  
    $pass = hash("sha512",$_POST['pwd']);
    $sql = "SELECT * FROM `user` WHERE `email`= '".$_POST['email']."' AND `password` = '".$pass."' LIMIT 1";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();    
    if($stmt)
    {
        if($stmt->rowCount() > 0)
        {
            $sessionID = session_id();
            $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            //$userData = $query->fetch_assoc();
            $expires = time()+(60*60);
            //if the user in the active update only
            $ck = "SELECT `id` FROM `active_users` WHERE `active_users`.`user`= '".$userData['id']."' LIMIT 1";
            $stmt2 = $dbo->prepare($ck);
            $stmt2->execute();  
            //$ck_r = $dbo->query($ck);
            if($stmt2->rowCount() < 1)
            $new_sql = "INSERT INTO `active_users`(`user`, `session_id`, `hash`, `expires`, `level`) VALUES ('".$userData['id']."','".$sessionID."','".$hash."','".$expires."','".$userData['level']."')";
            else $new_sql = "UPDATE `active_users` SET `"
                    . "session_id` = '".$sessionID."' , `hash` = '".$hash."', `expires` = '".$expires."' WHERE `active_users`.`user` = ".$userData['id'];
            $dbo->query($new_sql);
            $f = getUser();
            if($f['level'] < 5) {header("Location:index.php"); }
            else if($f['level'] == 1) {header("location:../index.php#contact?err='errore[3]'#log-in");}
            else if($f['level'] == 3){header("Location:system.php");}
            else header("location:../index.php#contact?err='errore[2]'#log-in");
        }else {header("location:../index.php?err='errore[9][".$sql."]'#contact");}    
    } else header("location:../index.php?err='error[0][".$sql."]'#contact");
}
if(isset($_POST['signup']))
{
    
   $pass1 = hash("sha512",$_POST['pwd1']); 
   $pass2 = hash("sha512",$_POST['pwd2']);
   if(strcmp($pass1,$pass2) == 0)
   {
       
   }else header("location:../index.php#signup");
}