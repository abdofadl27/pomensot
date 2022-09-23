<?php
$pp = '12345';
$pass = hash("sha512",$pp);
echo "[".$pass."]";