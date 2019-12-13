<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='form.css'>
    <title>Document</title>
</head>
 <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>
<body>

    <h1>会員登録が完了しました。</h1>
    <?php
    session_start();
//  mb_language("japanese");
//  mb_internal_encoding("UTF-8");
//  $to = $_SESSION['email'];
 $title = '会員登録完了のお知らせ';
 $content = '会員の仮登録が完了しました。'."\n"
 .'以下の情報で登録いたします。'."\n".
            '名前'.":".$_SESSION['name']."\n".
            'カナ'.":".$_SESSION['name_kana']."\n".
            '電話'.":".$_SESSION['TEL']."\n".
            'メール'.":".$_SESSION['email']."\n".
            '生まれ年'.":".$_SESSION['year']."\n".
            '性別'.":".$_SESSION['sex_code']."\n".
            $_SESSION['magagine']."\n".
            '仮パスワード'.":".$_SESSION['pass_tmp']."\n".

            '本登録は以下のURLをクリックし、仮パスワードを入力してください。以上で登録は完了です。';
// $from = "From: blackbeeshrimp@gmail.com\r\n";
// $from .="Return-Path: blackbeeshrimp@gmail.com";
            // if(mb_send_mail($to, $title, $content, $from)){
            //     echo "メールを送信しました";
            //   } else {
            //     echo "メールの送信に失敗しました";
            //   };





              
              require '../PHPMailer/src/Exception.php';
              require '../PHPMailer/src/PHPMailer.php';
              require '../PHPMailer/src/SMTP.php';
              
              $mail = new PHPMailer(true);
              
              try {
                //Gmail 認証情報
                $host = 'smtp.gmail.com';
                $username = ''; // example@gmail.com
                $password = '';
              
                //差出人
                $from = '';
                $fromname = '差出人名';
              
                //宛先
                $to = $_SESSION['email'];
                $toname = $_SESSION['name'];
              
                //件名・本文
                $subject = $title;
                $body = $content;
              
                //メール設定
                $mail->SMTPDebug = 2; //デバッグ用
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = $host;
                $mail->Username = $username;
                $mail->Password = $password;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->CharSet = "utf-8";
                $mail->Encoding = "base64";
                $mail->setFrom($from, $fromname);
                $mail->addAddress($to, $toname);
                $mail->Subject = $subject;
                $mail->Body    = $body;
              
                //メール送信
                $mail->send();
                echo '成功';
              
              } catch (Exception $e) {
                echo '失敗: ', $mail->ErrorInfo;
              }



?>
</body>
</html>