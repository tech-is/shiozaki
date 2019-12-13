<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url() ?>application/css/hitokoto.css">
</head>
<body>
	
<h1>ひとこと掲示板</h1>
<?php
if(!empty($_GET['mode'])){
    if((int)$_GET['mode'] == 1){
        echo '投稿に成功しました';
    }elseif((int)$_GET['mode'] == 2){
        echo '投稿に失敗しました';
    }elseif((int)$_GET['mode'] == 3){
        echo '投稿の編集に成功しました';
    }elseif((int)$_GET['mode'] == 4){
        echo '投稿の編集に失敗しました';
    }elseif((int)$_GET['mode'] == 5){
        echo '投稿の削除に成功しました';
    }elseif((int)$_GET['mode'] == 6){
        echo '投稿の削除に失敗しました';
    }
}
?>
	<form method='post' action='/index.php/Welcome/add'>
        <table class='mx-auto'>
			<tr>
				<label class='aa'>
					<div class='bb'>
					<input type='text' name='name' placeholder= '名前' required></td><br>
					</div>
				</label>
			</tr>
			<tr>
				<label class='aa'>
					<div class='bb'>
					<textarea name='main' rows='4' cols='50' placeholder= '本文' required></textarea></td>
					</div>
				</label>
			</tr>
        </table>
        <input type= 'submit' name= 'up'class= 'up' value= '送信'>
    </form>

 <table class= 'table mx-auto col-sm-8'>
                <thead class= 'thead-dark'>
                    <tr class= 'd-flex'>
                    <th class='col-5'>名前</th><th class='col-5'>本文</th><th class='col-2'>時間</th>
                    </tr>
                </thead>
                    <?php foreach($result as $row){ 
                        $rows['view_name'] = htmlspecialchars($row['view_name'], ENT_QUOTES);
                        $rows['message'] = htmlspecialchars($row['message'], ENT_QUOTES);
                        ?>
                    <tr class= 'd-flex'>
                        <td class='col-5' style="word-wrap:break-word;"><?php echo $rows['view_name']?></td>
                        <td class='col-5' style="word-wrap:break-word;"><?php echo $rows['message']?></td>
                        <td class='col-2'><?php echo $row['post_date']?></td>
                        <td><a href="<?= base_url() ?>index.php/Welcome/edit/?id=<?php echo $row['id'] ?>">編集</a></td>
                    </tr>
                    <?php } ?>

            </table>
</body>
</html>