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
	
<h1>ひとこと掲示板（編集)</h1>
	<form method='post' action='/index.php/Welcome/edit_OK'>
        <table class='mx-auto'>
			<tr>
				<label class='aa'>
					<div class='bb'>
					<input type='text' name='name' placeholder= '名前' value= '<?php echo $result['view_name'] ?>' required></td><br>
					</div>
				</label>
			</tr>
			<tr>
				<label class='aa'>
					<div class='bb'>
					<textarea name='main' rows='4' cols='50' placeholder= '本文' required><?php echo $result['message'] ?></textarea></td>
					</div>
				</label>
			</tr>
        </table>
        <input type= 'submit' name= 'up' class= 'up' value= '更新'>
        <input type= 'hidden' name= 'edit_id' value= "<?php echo $result['id']; ?>">
    </form>
    <form method='post' action='/index.php/Welcome/delete'>
        <input type= 'submit' name= 'del' class= 'del' value= '削除'>
        <input type= 'hidden' name= 'edit_id' value= "<?php echo $result['id']; ?>">
    </form>