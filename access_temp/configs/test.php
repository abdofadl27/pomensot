<?php
$aaa = '123';
$pass = hash("sha512",$aaa);
echo '<br> ped:'.$pass;