<?php session_start(); 
 include 'config.php';
function isLecturerLoggedIn()
{
    require 'configdbo.php';
    $sessionID = session_id();
    $expr = time()+(60*15);
    $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);
    $stmt = $db->prepare('SELECT * FROM `omr_active_lecturer` WHERE `session_id` = :sesid '
            . 'AND `hash` = :hash AND `level` = "staff" LIMIT 1');
    $ret = $stmt->execute(array('sesid' => $sessionID,'hash'=>$hash));
    if($u=$stmt->fetch())
    {
      $stmtx = $db->prepare('UPDATE`omr_active_lecturer` SET expires = :exp WHERE `id` = :uid ');
           $stmtx->execute(['uid' =>$u['id'], 'exp'=>$expr]);
                   return $u['user'];
       
    }else{
        return false;
    }
}
function doLoginAdminSession($admin)
{
include 'configdbo.php';
    $stmt = $db->prepare('SELECT id FROM `omr_active_lecturer` WHERE user= :user AND level= "admin" LIMIT 1 ');
    $stmt->execute(['user' => $admin['id']]);
    $ll = $stmt->fetch(PDO::FETCH_ASSOC);
    $uexp = time()+(60*20);
    $sesid = session_id();
    $uhas = hash("sha512",$sesid.$_SERVER['HTTP_USER_AGENT']);
    if($ll)//already in active
    {
        $actstat = $db->prepare('UPDATE omr_active_lecturer SET user = :user, session_id = :sesid, '
        . 'hash = :uhash, expires = :uexp WHERE id  = :sid');
        $actstat->execute(['user' => $admin['id'],'sesid'=>$sesid,'uhash'=>$uhas,'uexp'=>$uexp,'sid'=>$ll['user']]);
    }else{
       $actstat = $db->prepare('INSERT INTO omr_active_lecturer (id, user, session_id, hash, expires, level) '
        . 'VALUES (NULL, :user, :sesid, :uhash, :uexp, "admin")');
        $actstat->execute(['user' => $admin['id'],'sesid'=>$sesid,'uhash'=>$uhas,'uexp'=>$uexp]); 
    }
}
function doLoginLecturerSession($admin)
{
    
    include 'configdbo.php';
    $ll = isLecturerLoggedIn();
    //$stmt = $db->prepare('SELECT id FROM `omr_active_lecturer` WHERE user= :user AND level = "staff" LIMIT 1 ');
    //$stmt->execute(['user' => $admin['id']]);
    //$ll = $stmt->fetch(PDO::FETCH_ASSOC);
    $uexp = time()+(60*20);
    $sesid = session_id();
    $uhas = hash("sha512",$sesid.$_SERVER['HTTP_USER_AGENT']);
    if($ll)//already in active
    {
        $actstat = $db->prepare('UPDATE omr_active_lecturer SET user = :user, session_id = :sesid, '
        . 'hash = :uhash, expires = :uexp WHERE id  = :sid AND level = "staff"');
        $actstat->execute(['user' => $admin['id'],'sesid'=>$sesid,'uhash'=>$uhas,'uexp'=>$uexp,'sid'=>$ll['user']]);
    }else{
       $actstat = $db->prepare('INSERT INTO omr_active_lecturer (id, user, level, session_id, hash, expires) '
        . 'VALUES (NULL, :user, "staff" ,:sesid, :uhash, :uexp)');
        $actstat->execute(['user' => $admin['id'],'sesid'=>$sesid,'uhash'=>$uhas,'uexp'=>$uexp]); 
    }
}
function getUser()
{
    include 'config.php';
    $sql = "SELECT * FROM `lecturer` WHERE `id` = '". isUserLoggedIn()."' LIMIT 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        $data = $query->fetch_assoc();
          return $data;    
    }return NULL;   
}
function getUserByID($sid)
{
    include 'config.php';
    $sql = "SELECT * FROM `lecturer` WHERE `id` = '". $sid."' LIMIT 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        $data = $query->fetch_assoc();
          return $data;    
    }return NULL;   
}
function getStaffByID($st_id)
{
    include 'config.php';
    $sql = "SELECT * FROM `lecturer` WHERE `id` = '".$st_id."' LIMIT 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        $data = $query->fetch_assoc();
          return $data;    
    }return NULL; 
}
function getLecScopusByLecId($lid)
{
    include 'config.php';
    $sql = "SELECT * FROM `scopusdata` WHERE `lec_id` = '".$lid."' LIMIT 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        $data = $query->fetch_assoc();
          return $data;    
    }return NULL;
}
function getProfessorCount()
{
    include 'config.php';
    $sql = "SELECT * FROM lecturer WHERE job LIKE '%Professor%' AND `short_name` <> 'passive'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
          return $nr;    
    }else return 0;
}
function getActiveStaffCount()
{
    include 'config.php';
    $sql = "SELECT * FROM lecturer WHERE `short_name` <> 'passive' ";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
          return $nr;    
    }else return 0;
}
function getAssocProfcount()
{
    include 'config.php';
    $sql = "SELECT * FROM lecturer WHERE job LIKE '%Associate%'  AND `short_name` <> 'passive'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
          return $nr;    
    }else return 0;
}
function getSeniorLeccount()
{
    include 'config.php';
    $sql = "SELECT * FROM lecturer WHERE job LIKE '%Dr.%'  AND `short_name` <> 'passive'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
          return $nr;    
    }else return 0;
}
function getAllStaff()
{
    include 'config.php';
    $sql = "SELECT * FROM `lecturer` WHERE  1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {       
          return $query;    
    }return NULL; 
}
function getAllStaffByName()
{
  include 'config.php';
    $sql = "SELECT * FROM `lecturer` WHERE  1 ORDER BY `name` ASC";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {       
          return $query;    
    }return NULL;   
}
function getAllStaffByLastUpdate()
{
   include 'config.php';
    $sql = "SELECT A.* FROM `lecturer` AS A INNER JOIN `scopusdata` AS B WHERE  A.`id` = B.`lec_id` ORDER BY B.`last_update` DESC";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {       
          return $query;    
    }return NULL;   
}
function getAllStaffByHindex(){
   include 'config.php';
    $sql = "SELECT A.* FROM `lecturer` AS A INNER JOIN `scopusdata` AS B WHERE  A.`id` = B.`lec_id` ORDER BY B.`hindex` DESC";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {       
          return $query;    
    }return NULL; 
}
function getActiveStaff()
{
    include 'config.php';
    $sql = "SELECT * FROM `lecturer` WHERE  `short_name` <> 'not active'";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {       
          return $query;    
    }return NULL; 
}
function getStaffPublicationsByStaffID($sid)
{
    include 'config.php';
    $sql = "SELECT * FROM `papers_scopus_lec` WHERE  `lec_id` = '".$sid."' ORDER BY `doc_id` DESC ";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {       
          return $query;    
    }return NULL; 
}
function logougt()
{
    $crnt = getUser();
    include 'config.php';
    $sql = "DELETE FROM `active_users` WHERE `active_users`.`user` = ".$crnt['id'];
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        $data = $query->fetch_assoc();
          return $data;    
    }return NULL;   
}
function isUserLoggedIn()
{
    include 'config.php';
    $sessionID = session_id();//mysqli_real_escape_string();
    $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);//mysqli_real_escape_string();
    $sql = "SELECT * FROM `active_users` WHERE `session_id` = '".$sessionID."' AND `hash` ='".$hash."' AND `expires` > ".time()." LIMIT 1";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
        {      
        $data = $query->fetch_assoc();
        $expires = time()+(60*60);
        $new_sql = "UPDATE `active_users` SET `"
        . "session_id` = '".$sessionID."' , `hash` = '".$hash."', `expires` = '".$expires."' WHERE `active_users`.`user` = ".$data['user'];
        $db->query($new_sql);
          return $data['user'];
        }
        else
        {
            return false;
        }
} 
function getAllGalleryByCat($type) //video, product and testimony
{
     include 'config.php';
     switch ($type)
     {
         case 'video':$type = '300'; break;
         case 'product':$type = '200'; break;
         case 'testimony':$type = '100'; break;
         case 'news':$type = '400'; break;
         default: $type='100';
     }
    $sql = "SELECT G.* FROM `gallery` AS G INNER JOIN `gallery_cats` AS T WHERE T.points = '".$type."' AND G.cat_id = T.id";
//    $sql = "SELECT G.* FROM `gallery` AS G INNER JOIN `gallery_cats` AS T WHERE T.points = '200' AND G.cat_id = T.id";
    $query = $db->query($sql);
    //echo $sql;
    $nr = $query->num_rows;
    if($nr  > 0)
    {
        //$data = $query->fetch_assoc();
          return $query;    
    }return NULL;  
}
function getGalleryCats()
{
    include 'config.php';
   $sql = "SELECT * FROM `gallery_cats` WHERE 1";
    $query = $db->query($sql);
    if($query) return $query; else return NULL;
}
function getGalleryTypes()
{
    include 'config.php';
   $sql = "SELECT * FROM `gallery_types` WHERE 1";
    $query = $db->query($sql);
    if($query) return $query; else return NULL;
}
function getAllsensors(){
     include 'config.php';
   $sql = "SELECT * FROM `sensors` WHERE 1";
    $query = $db->query($sql);
    if($query) return $query; else return NULL;
}
function getAllFarms(){
     include 'config.php';
   $sql = "SELECT * FROM `farms` WHERE 1";
    $query = $db->query($sql);
    if($query) return $query; else return NULL;
}
function addSensor($s_name,$farm)
{
  include 'config.php';
   $sql = "INSERT INTO `sensors` (`id`, `name`, `farm`) "
           . "VALUES (NULL, '".$s_name."', '".$farm."');";
    $query = $db->query($sql);
    if($query) return true; else return false;  
}