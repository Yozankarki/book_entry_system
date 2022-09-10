<?php require_once 'checksession.php';
  require_once 'function.php';

   if(is_numeric($_GET['id'])){
    $id = $_GET['id'];
   }else{
       header('location:list_book_category.php?msg=1');
   }

   if(isset($_POST['btnUpdate']))
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
         $updated_at = date('Y-m-d H:i:s');
         $updated_by = $_SESSION['admin_id'];

       if(count($err) == 0){
           require_once 'databaseconn.php';
           $sql = "update book_categories set name='$name', status='$status', updated_by='$updated_by', updated_at='$updated_at' where id= '$id'";
            $connection -> query($sql);
           if($connection ->affected_rows == 1) 
           {
               
               $success = 'Category update successsful.';
               
           }
           else{
               $error = 'Category update failed!';
           }
        }
   }
  require_once 'databaseconn.php';
  $sql = "select id,name,status from book_categories where id=$id";
  $result = $connection -> query($sql);
  if($result -> num_rows == 1){
    $row = $result -> fetch_assoc();
  }else{
      $row = [];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details.</title>
    <style>
    </style>
</head>
<body>
     <div>
     <h3>BOOK EDIT CATEGORY.</h3>
    <?php require_once 'admin_menu.php';?>
     <div>
     <form method="post" action="">
     <fieldset>
     <?php if(isset($error)){ ?>
        <p class="err_msg"><?php echo $error;?></p>
     <?php } ?>
     <?php if(isset($success)){ ?>
        <p class="success_msg"><?php echo $success;?></p>
     <?php } ?>
     <legend>Edit book</legend>
     
     Name: <input type="text" name="name" placeholder="Enter name." value="<?php echo isset($row['name'])?$row['name']:'';?>">
     <span class="err">
         <?php if(isset($err['name'])) {?>
            <?php echo $err['name']; ?>
         <?php };?>
     </span>
     <br>
     status: 
             <?php if($row['status'] == 1){?>
                <input type="radio" name="status" value="1" checked="">Active
             <input type="radio" name="status" value="0" >De-Active
             <?php } else {?>
                <input type="radio" name="status" value="1">Active
             <input type="radio" name="status" value="0" checked>De-Active
                <?php }?>
     <br>
     <input type="submit" value="update" id="update" name="btnUpdate">
     <input type="reset" name="btnreset" value="clear">
     </form>
 </fieldset>
     </div>

    
</body>
</html>
