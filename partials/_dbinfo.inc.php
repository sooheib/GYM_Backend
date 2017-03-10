<?php
//    // $dbusername = 'phpproj';
//    // $dbpassword = 'kHc16289!';
//    // $dbhost = 'phpproj.db.10521321.hostedresource.com';
//    // $dbdatabase = 'phpproj';
//    $dbusername = 'bf0159e2d750c0';
//    $dbpassword = '22c2d784';
//    $dbhost = 'us-cdbr-azure-southcentral-f.cloudapp.net';
//    $dbdatabase = 'acsm_93cc7376b391fec';

$dbusername = 'root';
$dbpassword = 'root';
$dbhost = 'localhost';
$dbdatabase = 'SPARTAGYM';

    $bd = mysql_connect($dbhost, $dbusername, $dbpassword)
        or die("Oops some thing went wrong");
    mysql_select_db($dbdatabase, $bd) or die("Oops some thing went wrong");



function select($table, $params){
    if($params==='')
        $sql="SELECT * FROM " . $table;
    else
	   $sql="SELECT * FROM " . $table . " WHERE " . $params;
    $result=mysql_query($sql);
    return $result;
}
?>