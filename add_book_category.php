<?php require_once 'checksession.php';?>
<?php
      if(isset($_POST['btnsave']))
    {
          #assign error to array
          $err =[];
          if(isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])){
              $name = $_POST['name'];
              if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $err['name'] = "Only letters and white space allowed";
              }
          }else
          {
              $err['name'] = "Please enter name";
          }
          $status = $_POST['status'];
          $created_at = date('Y-m-d H:i:s');
          $created_by = $_SESSION['admin_id'];
          
        if(count($err) == 0){
            require_once 'databaseconn.php';
            $sql = "insert into book_categories(name, status, created_by, created_at) values('$name', $status, '$created_by', '$created_at')";
             $connection -> query($sql);
            if($connection -> affected_rows == 1 && $connection -> insert_id > 0) 
            {
                
                $success = 'Category insert successsful.';
                
            }
            else{
                $error = 'Category insert failed!';
            }
        }else{
            $msg = 'Invalid Username.';
        }
    }
      

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book add</title>
    <style>
        .err{
            color: red;
        }
        .err_msg{
            background-color: red;
            color: white;
            padding: 5px;
        }
        .success_msg{
            background-color: green;
            color: white;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h3>BOOK ADD CATEGORY.</h3>
    <?php require_once 'admin_menu.php';?>
     <div>
     <fieldset>
     <?php if(isset($error)){ ?>
        <p class="err_msg"><?php echo $error;?></p>
     <?php } ?>
     <?php if(isset($success)){ ?>
        <p class="success_msg"><?php echo $success;?></p>
     <?php } ?>
     <legend>Add book</legend>
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     Name: <input type="text" name="name" placeholder="Enter name.">
     <span class="err">
         <?php if(isset($err['name'])) {?>
            <?php echo $err['name']; ?>
         <?php };?>
     </span>
     <br>
     status: <input type="radio" name="status" value="1">Active
             <input type="radio" name="status" value="0" checked>De-Active
     <br>
     <input type="submit" value="submit" name="btnsave">
     </form>
 </fieldset>
     </div>

    
</body>
</html>
