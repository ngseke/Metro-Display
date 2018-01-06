<?php

if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST']== '127.0.0.1'){
  // 若當前主機為localhost
  define('db_host',     'localhost', false); // 資料庫host
  define('db_username', 'root',      false); // 資料庫用戶名
  define('db_password', '',          false); // 資料庫密碼
  define('db_name',     'MRT',      false); // 資料庫名稱
 }else{

 }
