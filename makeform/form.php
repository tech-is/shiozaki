<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='form.css'>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <title>Document</title>
</head>
<?php
session_start();




if(isset($_POST['registration'])){
    //名前
    if(empty($_POST['name'])){
        $error_message[] = '名前を入力してください。';
    }else{
        $clean_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $_SESSION['name'] = $clean_name;
    }

    //カナ
    if(empty($_POST['name_kana'])){
        $error_message[] = 'カナを入力してください。';
    }else{
        $clean_name_kana = htmlspecialchars($_POST['name_kana'], ENT_QUOTES);
        $_SESSION['name_kana'] = $clean_name_kana;
    }

    //電話
    if(empty($_POST['TEL'])){
        $error_message[] = '電話番号を入力してください。';
    }else{
        $clean_TEL = htmlspecialchars($_POST['TEL'], ENT_QUOTES);
        $_SESSION['TEL'] = $clean_TEL;
    }

    //メール
    if(empty($_POST['email'])){
        $error_message[] = 'メールアドレスを入力してください。';
    }else{
        $clean_email = htmlspecialchars($_POST['email'], ENT_QUOTES);
        $_SESSION['email'] = $clean_email;
    }

    //性別
    if(!isset($_POST['sex'])){
        $error_message[] = '性別を選択してください。';
    // }elseif($_POST['sex'] == 0){
    //     $clean_sex = '男性';
    //     $_SESSION['sex'] = $clean_sex;
    }else{
        $_SESSION['sex'] = $_POST['sex'];
        if(($_POST['sex']) == 0){
            $_SESSION['sex_code'] = '男性';
        }else{
            $_SESSION['sex_code'] = '女性';
        }
    }
$_SESSION['year'] = $_POST['year'];

    if(empty($_POST['magazin'])){
        $_SESSION['magazin'] = 0;
        $_SESSION['magagine'] = 'メールマガジンを受け取らない';
    }else{
        $_SESSION['magazin'] = 1;
        $_SESSION['magagine'] = 'メールマガジンを受け取る';
    }
    if(isset($_POST['TEL']) && isset($_POST['email'])){
        $dbh = new PDO("mysql:dbname=form;host=localhost",'root','');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        
        $sql = $dbh->prepare("SELECT tel, mail FROM member WHERE  mail = :mail OR tel = :tel");

        $sql->bindvalue(":tel", $_POST['TEL']);
        $sql->bindvalue(":mail", $_POST['email']);
        $sql->execute();
        $result = $sql->fetch();
        // $count = $sql->rowCount();

        // if($count == 1){
        // $error_message[] = '電話番号が既に登録されています';
        // }
        if($result['tel'] == $_POST['TEL']){
            $error_message[] = '既に登録されている電話番号です';
        }

        if($result['mail'] == $_POST['email']){
            $error_message[] = '既に登録されているメールアドレスです';
        }
        
    }
    // echo var_dump($error_message);
}
?>
<body >
    <h1>会員登録フォーム</h1>
    <?php 
    if(!empty($error_message)){
        foreach($error_message as $value){
        echo $value."<br>" ;
        } 
  
    }else{
        if(isset($_POST['registration'])){
 
        header('Location: ./form_check.php');
    }
    }
    ?>
        <form method= 'post' action='' >
            <p>
              
            名前&nbsp;&nbsp;<input type = 'text' name= 'name'><br>
            カナ&nbsp;&nbsp;<input type = 'text' name= 'name_kana'><br>
            電話&nbsp;&nbsp;<input type = 'tel' name= 'TEL'><br>
            mail&nbsp;&nbsp;&nbsp;<input type = 'email' name= 'email'><br>
            生まれ年&nbsp;&nbsp;<select name= 'year' >
                <?php
                $year = date('Y');
                    for( $i = 1900;  $i <= $year ; $i++ ){
                    ?>    
                        <option value= "<?php echo $i ?>"> <?php echo $i ?> </option>
                        
                    <?php } ?></select><br>
                性別&nbsp;&nbsp;<input type = "radio" name="sex" value="0" >男性
                    <input type = "radio" name="sex" value="1">女性<br>
                メールマガジン送付&nbsp;&nbsp;<input type='checkbox' name='magazin' checked><br>
                <div>
                <input type='submit' class='registration' name='registration' value='登録'>
                </div>
         
            </p>

        </form>
    <p class='cop'>
        thandai.com
                    </p>
</body>
</html>