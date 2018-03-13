<?php
require_once('conn.php');

$title = addslashes($_POST['title']);
$article = addslashes($_POST['article']);
$author = addslashes($_POST['author']);
$time = date("Y-m-d H:i:s");

$sql = "INSERT INTO hm_contents (`title`, `article`, `date`, `author`) VALUES (?,?,'".$time."',?)";

if($query = $db_conn->prepare($sql)) {
    $query->bind_param("sss", $title,$article,$author);
    $query->execute();
    Header("Location:list.php"); 
} else {
    $error = $db_conn->errno . ' ' . $db_conn->error;
    echo $error;
}

mysqli_close($db_conn);
?>