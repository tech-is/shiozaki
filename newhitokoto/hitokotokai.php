<?php
date_default_timezone_set('Asia/Tokyo');
$now_date = date("Y-m-d H:i:s");



       
if(empty($_POST['name']) && isset($_POST['up'])){
     $error_message[]= '名前を入力してください';
            // }elseif(!empty($_POST['name'])){
            //     $clear_name = htmlspecialchars($_POST['name'], ENT_QUOTES);

}

if(empty($_POST['main']) && isset($_POST['up'])){
    $error_message[] = '本文を入力してください';
            // }elseif(!empty($_POST['main'])){
            //     $clear_main = htmlspecialchars($_POST['main'], ENT_QUOTES);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
            // echo '成功';

    if(empty($error_message)){

        $dbh = new PDO("mysql:dbname=board;host=localhost",'root','');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

        $sql = $dbh->prepare("INSERT INTO bbs (view_name, message, post_date) VALUES (:view_name, :message, :post_date)");
        $sql->bindValue(":view_name", $_POST['name']);
        $sql->bindValue(":message", $_POST['main']);
        $sql->bindValue(":post_date", $now_date);

        $sql->execute();
                // unset($_SESSION['success']);
        header('Location: ./hitokotokai.php');
    }         
} 
 


?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='hitokotokai.css'>
</head>
<body>
       
       
    <h1>ひとこと掲示板</h1>
    <?php  
        if(!empty($error_message)){

            foreach($error_message as $value){
                echo $value.'<br>';
            } 
        }

    ?>



    <form method='post' action=''>
        <table class='mx-auto'>
        <tr>
            <label class='aa'>
                <div class='bb'>
                <input type='text' name='name' placeholder= '名前'></td><br>
                </div>
            </label>
        </tr>
        <tr>
            <label class='aa'>
                <div class='bb'>
                <textarea name='main' rows='4' cols='50' placeholder= '本文'></textarea></td>
                </div>
            </label>
        </tr>
        </table>
        <input type= 'submit' name= 'up'class= 'up' value= '送信'>
    </form>
    <!-- ログを表示する -->
        <?php
            $dbh = new PDO("mysql:dbname=board;host=localhost",'root','');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

            $log=$dbh->prepare("SELECT view_name, message, post_date FROM bbs ORDER BY post_date DESC");
            $log->execute();
        ?>
        <div class='log'>
            <table class= 'table mx-auto col-sm-8'>
                <thead class= 'thead-dark'>
                    <tr class= 'd-flex'>
                    <th class='col-5'>名前</th><th class='col-5'>本文</th><th class='col-2'>時間</th>
                    </tr>
                </thead>
                    <?php foreach($log as $row){ 
                        $rows['view_name'] = htmlspecialchars($row['view_name'], ENT_QUOTES);
                        $rows['message'] = htmlspecialchars($row['message'], ENT_QUOTES);
                        ?>
                    <tr class= 'd-flex'>
                        <td class='col-5' style="word-wrap:break-word;"><?= $rows['view_name']?></td><td class='col-5' style="word-wrap:break-word;"><?= $rows['message']?></td><td class='col-2'><?= $row['post_date']?></td>
                    </tr>
                    <?php } ?>
            </table>
        </div>
        
            
       
</body>
</html>