<?php
require_once('conn.php');

$query = "SELECT * FROM hm_contents";
$result = mysqli_query($db_conn, $query);
$all_posts = mysqli_num_rows($result);

if($_GET['page']>=1){
  $page = $_GET['page'];
}else{
  Header("Location:?page=1"); 
}
mysqli_free_result($result);

$query = "SELECT * FROM hm_contents ORDER BY no desc LIMIT 10 OFFSET ".($page-1)*10;
$result = mysqli_query($db_conn, $query);
require_once('_head.php');
?>

<?php
if ( $result ) { 
    echo "전체 글 : ".$all_posts." | 페이지 : ".$page."<br />";
?>

<table class="table table-sm table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">제목</th>
      <th scope="col">작성자</th>
      <th scope="col">작성일</th>
      <th scope="col">조회</th>
      <th scope="col">추천</th>
    </tr>
  </thead>
  <tbody>

<?php
    while ($row = mysqli_fetch_assoc($result)){
        printf ("<tr><th scope=\"row\">%s</th><td><a href=\"read.php?no=".$row["no"]."\">%s</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row["no"], stripslashes($row["title"]), stripslashes($row["author"]), $row["date"], $row["read"], $row["vote"]);
    }
    mysqli_free_result($result);
}else{ 
    echo "Error : ".mysqli_error($db_conn);
}
?>
  </tbody>
</table>
<a href="write.php"><input type="button" class="btn" value="글쓰기"></a>

<nav aria-label="Page navigation">
  <ul class="pagination">
<?php
for($i=0;$i<($all_posts/10);$i++){
  echo '<li class="page-item';
  if($page==($i+1)) echo ' active';
  echo '"><a class="page-link" href="?page='.($i+1).'">'. ($i+1) .'</a></li>';
}
?>
  </ul>
</nav>
<?php
mysqli_close($db_conn);
require_once('_foot.php');
?>