<?php
function print_before_install(){
    echo("<script>alert('설치가 되지 않았습니다. 설치 페이지로 이동해 주세요.');</script>"); 
    echo("<a href='setup.php'>설치 페이지로 이동</a>"); 
}

if(!file_exists('setting.php')){
    print_before_install();
    exit;    
}

require_once('conn.php');

$query = "SELECT name,value FROM hm_admin where name='installed'";
$result = mysqli_query($db_conn, $query); 
if ( $result ) { 
    if (mysqli_num_rows($result)){
        while ($row = mysqli_fetch_assoc($result)){
            if($row["value"]){
                Header("Location:list.php"); 
            }else{
                print_before_install();
            }
        }
    }else{
        print_before_install();
    }
    mysqli_free_result($result);
}else{ 
    print_before_install();
}

mysqli_close($db_conn);
?>