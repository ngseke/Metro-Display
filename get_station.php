<?php
// session_start();
require_once('connection.php');

$sql = "SELECT * FROM STATION_VIEW WHERE (TRUE)";
$color = '';

if(isset($_GET['Color'])){
  $color = $_GET['Color'];
  $sql.= "AND Color = '$color' ";
}

if(isset($_GET['Num'])){
  $num = $_GET['Num'];
  $sql.= "AND Num = '$num' ";
}

//echo $sql;

$result = $conn->query($sql);  // $result 存放查詢到的所有物件
$data = array();
while ($rows = mysqli_fetch_assoc($result)) {
  $data[] = $rows;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE); // 以JSON印出結果
