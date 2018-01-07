<?php
// session_start();
require_once('connection.php');

$sql = "SELECT T.Color, T.Num, T.TransferColor, T.TransferNum,
        L.Name TransferName, L.Name_EN TransferName_EN,
        L.ColorCode TransferColorCode, L.TextColorCode TransferTextColorCode  FROM TRANSFER T ";
$sql.= "LEFT JOIN LINE L ON T.TransferColor = L.Color ";
$sql.= "WHERE (1) ";

if(isset($_GET['Color'])){
  $color = $_GET['Color'];
  $sql.= "AND T.Color = '$color' ";
}

if(isset($_GET['Num'])){
  $num = $_GET['Num'];
  $sql.= "AND T.Num = '$num' ";
}

$sql.="";

// echo $sql;

$result = $conn->query($sql);  // $result 存放查詢到的所有物件
$data = array();
while ($rows = mysqli_fetch_assoc($result)) {
  $data[] = $rows;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE); // 以JSON印出結果
