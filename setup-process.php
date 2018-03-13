<?php
$db_host = $_POST['db_host'];
$db_id = $_POST['db_id'];
$db_pwd = $_POST['db_pwd'];
$db_name = $_POST['db_name'];

$myfile = fopen("setting.php", "w") or die("Unable to open file!");
$txt = '<?php ';
fwrite($myfile, $txt);
$txt = '$db_host = "'.$db_host.'"; ';
fwrite($myfile, $txt);
$txt = '$db_id = "'.$db_id.'"; ';
fwrite($myfile, $txt);
$txt = '$db_pwd = "'.$db_pwd.'"; ';
fwrite($myfile, $txt);
$txt = '$db_name = "'.$db_name.'"; ';
fwrite($myfile, $txt);
$txt = '?>';
fwrite($myfile, $txt);
fclose($myfile);
?>

<?php
require_once('conn.php');
echo '설치가 필요합니다.';
?>

<?php
$query = "CREATE TABLE `hm_admin` ( `name` TEXT , `value` INT  );";
mysqli_query($db_conn, $query); 

$query = "INSERT INTO `hm_admin` (`name`, `value`) VALUES ('installed', '1');";
mysqli_query($db_conn, $query); 

$query = "CREATE TABLE `hm_contents` ( `no` INT NOT NULL AUTO_INCREMENT , `title` TEXT NOT NULL , `article` LONGTEXT NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `author` TEXT , `read` INT NOT NULL DEFAULT '0' , `vote` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`no`));";
mysqli_query($db_conn, $query); 

$query = "INSERT INTO `hm_contents` (`title`, `article`, `author`) VALUES ('설치가 완료되었습니다.', 'H-Board 설치가 완료되었습니다.
이 글은 이제 삭제하셔도 됩니다.', '참빛바다');";
mysqli_query($db_conn, $query); 
?>

<?php
    echo("<script>alert('설치가 완료되었습니다. 메인 페이지로 이동해 주세요.');</script>"); 
    echo("<a href='list.php'>설치 페이지로 이동</a>"); 
?>
<?php
mysqli_close($db_conn);
?>