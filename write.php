<?php
require_once('conn.php');

$query = "SELECT * FROM hm_contents ORDER BY no LIMIT 10 OFFSET 0";
$result = mysqli_query($db_conn, $query); 

require_once('_head.php');
?>
<script type="text/javascript" src="se2/js/HuskyEZCreator.js" charset="utf-8"></script>

<form action="process.php" method="POST">
<div class="form-group">
    <input type="text" class="form-control" name="title" placeholder="제목">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="author" placeholder="작성자">
  </div>
  <div class="form-group">
    <textarea name="article" id="ir1" rows="10" cols="100" style="width:100%;"></textarea>
  </div>
  <input type="button" onclick="submitContents(this);" class="btn btn-primary" value="글쓰기"></input>
</form>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
    oAppRef: oEditors,
    elPlaceHolder: "ir1",
    sSkinURI: "se2/SmartEditor2Skin.html",
    fCreator: "createSEditor2"
});

function submitContents(elClickedObj) {
oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
try {
    elClickedObj.form.submit();
} catch(e) {}
}
</script>
<?php
mysqli_close($db_conn);
require_once('_foot.php');
?>