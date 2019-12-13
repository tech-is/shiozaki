<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='calender.css'>
</head>
<?php
//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

$year = 2019;
$month = 11;
$day =1;
if(isset($_GET['month']) ){
    $month = (int)$_GET['month'];   
}
if(isset($_GET['year'])){
    $year = (int)$_GET['year'];
}

$file = file_get_contents('syukujitsu.csv');
$txt = mb_convert_encoding($file, 'UTF-8', 'SJIS');
$lines = explode("\r\n", trim($txt));
array_shift($lines);
$syukujitsu = array();
foreach($lines as $line){
    $date = explode(",", $line);
    //$syukujitsu[] = [trim($date[0]), trim($date[1])];
    $syukujitsu[trim($date[0])] = trim($date[1]);
}
// print_r($syukujitsu);

?>
<body>

    <h1><?php echo $year.'年'. $month.'月'; ?></h1>
    <p>   
    <!-- 先月 -->
    <?php if($month == 1) : ?>
        <a href= "?month=12&year=<?php echo ($year-1) ?>">先月</a>
    <?php elseif($month >1) : ?>
        <a href= "?month=<?php echo ($month-1); ?>&year=<?php echo $year ?>">先月</a>
    <?php endif ;?>

    <!-- 来月 -->
    <?php if($month == 12) : ?>
        <a href= "?month=1&year=<?php echo ($year+1) ?>">来月</a>
    <?php elseif ($month <12) : ?>
        <a href= "?month=<?php echo ($month+1); ?>&year=<?php echo $year ?>">来月</a>

    <?php endif ;?>

        
    

    
       
    

    </p>
    <table >

        <table class='table table-bordered'>
        <tr>
        <th class = 'sun'>日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th class = 'sat'>土</th>
        </tr>
        <?php
      
        $a = date("w", mktime(0, 0, 0, $month, 1, $year)) ;
               for($i=0; $i<$a; $i++){
                   echo "<td> </td>";
               }
        while( checkdate($month, $day, $year)){
                $hahaha =  $year . "/" . $month . "/" .  $day;
                if(date("w", mktime(0, 0, 0, $month, $day, $year)) == 6){
                 
                    if(array_key_exists($hahaha, $syukujitsu)) {
                        echo "<td class = 'syukujitsu'>$day.$syukujitsu[$hahaha]</td>";
                    } else {
                      echo "<td class = 'sat'>$day</td>";
                    }
     
                      
                }elseif(date("w", mktime(0, 0, 0, $month, $day, $year)) == 0){
                  
                    if(array_key_exists($hahaha, $syukujitsu)) {
                        echo "<td class = 'syukujitsu'>$day.$syukujitsu[$hahaha]</td>";
                    } else {
                        echo "<td class = 'sun'>$day</td>";
                    }
                        

                }else{
                   
                    if(array_key_exists($hahaha, $syukujitsu)) {
                        echo "<td class = 'syukujitsu'>$day.$syukujitsu[$hahaha]</td>";
                    } else {
                        echo "<td>$day</td>";
                    }         
                   
                }
                
                if(date("w", mktime(0, 0, 0, $month, $day, $year)) == 6){
                    echo "</tr>";
                    if(checkdate($month, $day + 1, $year)){
                        echo "<tr>";
                    }
                }

           $day++;           
       }

       $end = date("w", mktime(0, 0, 0, $month +1, 0, $year)) ;
        for($j=0; $j<6-$end; $j++){
            echo "<td> </td>";
        }
        "</table>"


           ?>   

        

</table>
</body>
</html>