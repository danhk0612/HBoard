<?php
require_once('conn.php');

$no = $_GET['no'];

if(!$no) header("Location: list.php"); 

$query = "SELECT * FROM hm_contents where no=".$no;
$result = mysqli_query($db_conn, $query); 

require_once('_head.php');

if ( $result ) { 
    while ($row = mysqli_fetch_assoc($result)){
?>
<table class="table table-sm table-hover">
  <thead class="thead-dark">
    <tr>
      <th colspan="3" scope="col"><?php printf("%s",stripslashes($row["title"])); ?></th>
    </tr>
  </thead>
  <tbody>
<?php

        printf ("<tr><td>작성자: %s 작성일: %s 조회수: %s 추천수: %s</td></tr><tr><td colspan=\"3\">%s</td></tr>", stripslashes($row["author"]), $row["date"], $row["read"], $row["vote"], stripslashes(strip_tags($row["article"], '<p><a><h1><h2><h3><h4><h5><strong><br><img><iframe>')));
    }
    mysqli_free_result($result);
}else{ 
    echo "Error : ".mysqli_error($db_conn);
}
?>
  </tbody>
</table>
<a href="list.php"><input type="button" class="btn" value="목록"></a>
<?php
$query = "UPDATE `hm_contents` SET `read` = `read` + 1 WHERE `no`=".$no;
mysqli_query($db_conn, $query); 

mysqli_close($db_conn);
require_once('_foot.php');
?>