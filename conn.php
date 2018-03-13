<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('setting.php');

$db_conn = new mysqli($db_host, $db_id, $db_pwd, $db_name);
if (!$db_conn) {
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n";
    exit();
}
?>