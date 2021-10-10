<?php
   session_start();
   $_SESSION['email'] = $data['email'];
   $_SESSION['PHPSESSID'] = session_id();
   setcookie("PHPSESSID", session_id());
   print_r($_COOKIE);
   print_r("\n");
   print_r($_SESSION);