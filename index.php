<!DOCTYPE html>
<html>
<head>
<title>This is practice</title>
</head>
<style>
.err{
color: #ff0000;
}
.err_msg{
    color: white;
    background-color: #ff0000;
    padding: 5px;
}
</style>
<body>
<h2> USER LOGIN AND ADMIN LOGIN:</h2>
<br>
<?php
    if(isset($_COOKIE['admin_id'])){
        session_start();
        $_SESSION['admin_id'] = $_COOKIE['admin_id'];
        $_SESSION['admin_name'] = $_COOKIE['admin_name'];
        $_SESSION['admin_email'] = $_COOKIE['admin_email'];
        header('location: dashboard.php');
    }
   
      if(isset($_POST['login']))
    {
          #assign error to array
          $err =[];
          if(isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])){
              $email = $_POST['email'];
              if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                  $err['email'] = "Enter valid E-mail.";
              }
          }else
          {
              $err['email'] = "Please enter E-mail";
          }

          if(isset($_POST['pass']) && !empty($_POST['pass']) && trim($_POST['pass'])){
            $pass = md5($_POST['pass']);
        }else
        {
            $err['pass'] = "Please enter password.";
        }
        if(count($err) == 0){
           require_once 'databaseconn.php';
        //    query to select data using email and password.
           $sql = "select id,name,email from admins where email = '$email' and password = '$pass' and status = 1 " ;
        //execute query
        $result = $connection  ->query($sql);
        if($result -> num_rows == 1){
            $row = $result -> fetch_assoc();
            session_start();
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            // check remember me button
            if(isset($_POST['remember'])){
                setcookie('admin_id', $row['id'], time()+7*24*60*60);
                setcookie('admin_email', $row['email'], time()+7*24*60*60);
                setcookie('admin_name', $row['name'], time()+7*24*60*60);
            }
            header('location: dashboard.php');

        }
        }else{
            $msg = 'Invalid Username.';
        }

    }   

?>
<br>
 <fieldset>
     <?php if(isset($msg)){ ?>
        <p class="err_msg"><?php echo $msg;?></p>
     <?php } ?>

     <?php if(isset($_GET['err']) && $_GET['err'] == 1){ ?>
        <p class="err_msg">Please login to continue.</p>
     <?php } ?>


     <legend>Login Form</legend>
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     E-mail: <input type="text" name="email" value="<?php echo isset($email) ? $email : '' ;?>" placeholder="Enter Email.">
     <span class="err">
         <?php if(isset($err['email'])) {?>
            <?php echo $err['email']; ?>
         <?php };?>
     </span>
     <br>
     password: <input type="password" placeholder="Password" name="pass">
     <span class="err">
         <?php if(isset($err['pass'])) {?>
            <?php echo $err['pass']; ?>
         <?php };?>
     </span>
     <br>
     
      <input type="checkbox" name="remember"> Remember Me.
      <br>
     
     <input type="submit" value="submit" name="login">
     <input type="reset" value="reset" name="reset">
     </form>
 </fieldset>
</body>
</html>

