<!DOCTYPE html>
<html lang="en">
<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>ログインフォーム</h1>
    <?php 
    // if(isset($error)){
    //     if($error===5 ){
    //         echo 'パスワードが正しくありません';
    //     }
    // }
    //     ?>
    //    <?php
    //         echo form_open("/index.php/Welcome/login_validation");

    //         echo "<p>パスワード:";
    //         echo form_password("password");
    //         echo "</p>";

    //         echo "<p>";
    //         echo form_submit("login_submit", "Login");
    //         echo "</p>";

    //         echo form_close();
       ?>
</body> -->
</html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="<?= base_url() ?>application/css/login.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Login Form -->
    <form method='post' action='/index.php/Welcome/login_validation'>
      <!-- <input type="text" id="login" class="fadeIn second" name="login" placeholder="login"> -->
      <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

  </div>
</div>

