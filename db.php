<?php

require_once 'config.php';
require_once 'connection.php';

if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']== '127.0.0.1'){
  // 若當前主機為localhost
  $file="";
}else{
  $file="";
}

$file.= file_get_contents('db.sql'); // 取得sql腳本檔

// 將讀入的腳本檔字串打散為Array，以';'分割，所以連註解的尾也要打';'
$arr = explode(';', $file);
$queryLineNum = sizeof($arr);
echo "<script type=\"text/javascript\">var queryLineNum=$queryLineNum</script>";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title>DB</title>
  <?php include('js.php') ?>
</head>
<body>
  <div class="container mt-3" id="zhilingBox">
    <div class="alert alert-info text-center"><i class="material-icons">storage</i> 執行了以下查詢</div>
    <!-- 進度條 -->
    <div class="progress my-3">
      <div class="progress-bar progress-bar-striped progress-bar-animated text-light" style="width: 0%;"></div>
    </div>
    <div id="zhiling">
    <?php
      $errorNum=$i=0;
      // 逐一執行mysql查詢
      foreach ($arr as $line) {
        flush();

        if ($conn->query($line.';') == TRUE) {
          // 若正確
          if (!($rst = strpos($line, '-Z-'))) { // 只印出非註解指令
            echo '<div class="alert alert-secondary zhilingLine"><pre><code>'. $line . ';</code></pre></div>';
          }
        } else {
          // 若錯誤 印出錯誤資訊
          $errorNum++;
          echo'<div class="alert alert-danger zhilingLine" id="error-query"><i class="material-icons">warning</i> 錯誤 :<br><pre><code>'
              . $line . ';<br><strong></code></pre>'. $conn->error .'</strong></div>';

        }
        $percent=ceil((++$i)/$queryLineNum*100);
        //設定進度
        if($i%1==0){
          $precentText =  $percent . ' % '. "($i/$queryLineNum)" ;
          echo '<script type="text/javascript">
                  $(\'.progress-bar\').html("'.$precentText.'").css("width", "'.$percent.'%");;
                </script>';
        }
      }

    ?>

    </div>
    <?=($errorNum>0)
     ?'<div class="alert alert-danger text-center" id="final-msg"><i class="material-icons">report_problem</i> 查詢時發生了共 '. $errorNum .' 筆錯誤！</div>'
     :'<div class="alert alert-success text-center" id="final-msg"><i class="material-icons">favorite</i> 已成功查詢所有指令。 <a data-toggle="collapse" href="#zhiling" class="alert-link">顯示</a></div>';
     ?>
  </div>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    // 若查詢成功則將指令折疊。
    if($('#final-msg').hasClass('alert-success')){
      $('#zhiling').addClass('collapse');
    }

    // 頁面載入完成後，自動滾到最底部
    var h = $(document).height()-$(window).height();
    $(document).scrollTop(h);
    $('.progress').remove(); // 隱藏進度條
  });
</script>

</html>
