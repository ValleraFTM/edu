<?php
/**
 *login page template
 */
if (isset($_POST['submit'])) {
  $user = login($_POST['login'], $_POST['password']);
  if ($user) {
      $user = $user[0];
      $hash = md5(generateCode(10));
      $ip = null;
      if (!empty($_POST['ip'])) {
          $ip = $_SERVER['REMOTE_ADDR'];

      }
      updateUser($user['id'], $hash, $ip);
      setcookie('id', $user['id'], time()+60*60*24*30, "/");
      setcookie('hash', $hash, time()+60*60*24*30, "/");
      header('location: /admin');
      exit();
  }
  else {
      echo "<h3>вы неправильно ввели логин и пароль</h3>";
  }
}
 ?>

 <h2>Логин</h2>
 <form method="POST">
     Login: <input type="text" name="login" required value="Admin3"><br><br>
     Pass:   <input type="password" name="password" required value="qwerty"><br><br>
     Прикреплять к IP:   <input type="checkbox" name="ip"><br><br>
     <input type="submit" name="submit" value="Войти">
     
 </form>