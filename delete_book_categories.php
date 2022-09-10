<?php require_once 'checksession.php';?>
<?php 
   if(is_numeric($_GET['id'])){
    $id = $_GET['id'];
   }else{
       header('location:list_book_category.php?msg=1');
   }
   
  require_once 'databaseconn.php';
  $sql = "delete from book_categories where id=$id ";
  $result = $connection -> query($sql);
  if($connection -> affected_rows == 1){
    header('location:list_book_category.php?msg=2');
  }else{
    header('location:list_book_category.php?msg=3');   
  }
   
 