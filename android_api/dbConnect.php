<?php
// define('HOST','us-cdbr-azure-southcentral-f.cloudapp.net');
// define('USER','bf0159e2d750c0');
// define('PASS','22c2d784');
// define('DB','acsm_93cc7376b391fec');

define("HOST", "localhost");
define("USER", "root");
define("PASS", "root");
define("DB", "SPARTAGYM");
 
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
 ?>