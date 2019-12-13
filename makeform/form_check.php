<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='form_check.css'>
    <title>Document</title>
</head>
<?php
$pass_tmp = substr(str_shuffle('1234567890qwertyuiopasdfghjklzxcvbnm'), 0, 16);


session_start();
$_SESSION['pass_tmp'] = $pass_tmp;

if(!empty($_POST['registration'])){
    $dbh = new PDO("mysql:dbname=form;host=localhost",'root','');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sth = $dbh->prepare("INSERT INTO member (name, kana, tel, mail, year, sex, magagine, pass_tmp, password) VALUES (:name, :kana, :tel, :mail, :year, :sex, :magagine, :pass_tmp, :password)");
    $sth->bindValue(":name", $_SESSION['name'] );
    $sth->bindValue(":kana", $_SESSION['name_kana'] );
    $sth->bindValue(":tel", $_SESSION['TEL'] );
    $sth->bindValue(":mail", $_SESSION['email'] );
    $sth->bindValue(":year", $_SESSION['year'] );
    $sth->bindValue(":sex", $_SESSION['sex'] );
    $sth->bindValue(":magagine", $_SESSION['magazin'] );
    $sth->bindValue(":pass_tmp", $_SESSION['pass_tmp']);
    $sth->bindValue(":password","");

    $sth->execute();

    header('Location: ./form_var.php');
}

?>
<body>

    <h1>会員登録フォーム（確認画面）</h1>
        <form method= 'post' action="">   
            <p>
            名前&nbsp;&nbsp;<?php echo $_SESSION['name'] ?><br>
            カナ&nbsp;&nbsp;<?php echo $_SESSION['name_kana'] ?><br>
            電話&nbsp;&nbsp;<?php echo $_SESSION['TEL'] ?><br>
            mail&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['email'] ?><br>
            生まれ年&nbsp;&nbsp;<?php echo $_SESSION['year'] ?><br>

                性別&nbsp;&nbsp;<?php echo $_SESSION['sex_code'] ?><br>
                メールマガジン送付&nbsp;&nbsp;<br><?php echo $_SESSION['magagine'] ?><br>
                <div>   
                  
                <input type='submit' class='registration' name='registration' value='登録' >
                    </div>
            </p>
        </form>
<script>

</script>
</body>
</html>