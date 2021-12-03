<?php
   session_start();
   setcookie('user_id', $data['id']);
   $_SESSION['email'] = $data['email'];
   $_SESSION['token'] = $data['token'];
   $_SESSION['PHPSESSID'] = session_id();
   setcookie("PHPSESSID", session_id());
   print_r($_SESSION);