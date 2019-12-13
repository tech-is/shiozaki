<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php

if(empty($_POST['email']) && isset($_POST['registration'])){
    $error_message[] = 'メールアドレスを入力してください';
}elseif(isset($_POST['ragistration'])){
    $clear_email = htmlspecialchars($_POST['email'], ENT_QUOTES);
}

if(empty($_POST['pass_tmp']) && isset($_POST['registration'])){
  $error_message[] = 'パスワードを入力してください';
}elseif(isset($_POST['ragistration'])){
    $clear_pass = htmlspecialchars($_POST['pass_tmp'], ENT_QUOTES);
} 

if(isset($_POST['registration'])){
    $dbh = new PDO("mysql:dbname=form;host=localhost",'root','');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

    $sql = $dbh->prepare("SELECT mail, pass_tmp FROM member WHERE mail = :mail");
    $sql->bindvalue(":mail",$_POST['email']);
    $sql->execute();
    $result = $sql->fetch();

    $count = $sql->rowCount();
    if($count == 1){
        if($result['pass_tmp'] == $_POST['pass_tmp']){
            //ログイン成功
            header('Location: ../makeform/form.php');
        }else{
            echo 'パスワードが違います';
        }
    }else{
        echo 'メールアドレスが登録されていません';
    }
    
}


?>




<body>
    <h1>ログインフォーム</h1>
    <?php 
        if(!empty($error_message)){
            foreach($error_message as $value){
                echo $value."<br>";
            }
        }
    ?>
    <p>
        <form method = 'post' action ="">
            <table>
                <tr>
                    <td>メアド</td>
                    <td><input type= 'email' name= 'email'></td>
                </tr>
                <tr>
                    <td>パスワード</td>
                    <td><input type= 'password' name= 'pass_tmp'></td>
                </tr>
                <tr>
                    <td><input type= 'submit' name='registration' value= 'ログイン'></td>
                </tr>   
            </table>
</body>
</html>