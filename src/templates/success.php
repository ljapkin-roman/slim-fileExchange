<script type="text/javascript">
    localStorage.setItem('user', 'true');
</script>
<?php
   session_start();
   setcookie('user_id', $data['id']);
   $_SESSION['email'] = $data['email'];
   $_SESSION['token'] = $data['token'];
   $_SESSION['name'] = $data['name'];
   $_SESSION['last_name'] = $data['last_name'];
   $_SESSION['PHPSESSID'] = session_id();
   setcookie("PHPSESSID", session_id());
   print_r($_SESSION);
