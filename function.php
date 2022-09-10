
<?php 
 function getNameByAdminID($admin_id){
    $connection = new mysqli('localhost', 'root', '', 'crud_book_entry_system');
    if($connection ->connect_errno !=0){
        die('Databse connection Error.' . $connection -> connect_error);
    }
    $sql = "select name from admins where id=$admin_id";
    $result = $connection -> query($sql);
    $row = $result -> fetch_assoc();
    return $row['name'];
     
 }
?>
