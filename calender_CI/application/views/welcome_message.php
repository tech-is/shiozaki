<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Calender</title>
	<link rel="stylesheet" href="<?= base_url() ?>asset/cal.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>

<?php
	echo $calendar;
?>
<script type="text/javascript" charset="utf-8">
	$(function(){
		$("td.day").on("click", function(){
			// console.log(this);
			let num =  $(this).find('div.num_day').text(); //const let var
			let day_num = num === ""? $(this).text(): num; 
			// if(num !== "") {
			// 	let day_num = num
			// } else {
			// 	let day_num = (this).text()
			// }
			// alert (day_num);
			day_data = prompt("予定を入力");

			if(day_data != null){
				$.ajax({
					url: "<?php echo base_url() ?>index.php/Calender/display",
					type:"POST",
					data:{
						day:day_num,
						text:day_data
					}
				})
				.then(
					//通信成功時
					function (data){
						location.href = "<?php base_url()?>";
					},
					//失敗時
					function (){
						//location.href = "https://www.google.co.jp";	
					}
				);
			}
		})
	})


</script>


</body>
</html>