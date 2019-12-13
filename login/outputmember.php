<?php
    header("Content-Disposition: attachment; filename=\"aaa.csv\"");
    header("Content-Type: application/octet-stream");

$dbh = new PDO("mysql:dbname=form;host=localhost",'root','');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

$sql = $dbh->prepare("SELECT id, name, kana, tel, mail FROM member");
$sql->execute();
// foreach($sql as $row){
    //     var_dump($row);
    // }
    
    

    foreach($sql as $row){ 
        $row = mb_convert_encoding($row, 'SJIS', 'UTF-8');
        echo  $row["id"].",".$row["name"].",".$row["kana"].",".$row["tel"].",".$row["mail"]."\n"; 
    
} 


?>

