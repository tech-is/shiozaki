<?php
    $dbh = new PDO("mysql:dbname=form;host=localhost",'root','');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

    $sql = $dbh->prepare("SELECT id, name, kana, tel, mail FROM member");
    $sql->execute();
    // foreach($sql as $row){
    //     var_dump($row);
    // }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
        <th>id</th><th>name</th><th>kana</th><th>tel</th><th>mail</th>
<?php foreach($sql as $row){ ?>
     <tr>
        <td><?= $row["id"] ?></td><td><?= $row["name"] ?></td><td><?= $row["kana"] ?></td><td><?= $row["tel"] ?></td><td><?= $row["mail"] ?></td>  
    </tr> 
<?php } ?>

</table>
</body>
</html>