<?php require_once 'checksession.php';?>
<?php require_once 'function.php';?>
<?php 
   if(is_numeric($_GET['id'])){
    $id = $_GET['id'];
   }else{
       header('location:list_book_category.php?msg=1');
   }
  require_once 'databaseconn.php';
  $sql = "select * from book_categories where id=$id ";
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
       table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
th {
  background-color: #04AA6D;
  color: white;
}
.action_column a{
    color: white;
    border: none;
    border-radius: 10px;
    padding: 3px 10px;
    text-decoration: none;
}
.action_column a.edit{
    background-color: greenyellow;
}
.action_column a.view{
    background-color: peachpuff;
}
.action_column a.delete{
    background-color: red;
}
.no_record{
    background-color: red;
    padding: 10px;
}
    </style>
</head>
<body>
    <h3>BOOK CATEGORY DETAILS.</h3>
    <?php require_once 'admin_menu.php';?>
     <div>
        <?php 
            if(!empty($row)){ ?>
            <table>
                <tr>
                    <th>Name</th>
                    <td><?php echo $row['name'] ;?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                    <?php if($row['status'] == 1){
                         echo 'active';
                     }else{
                         echo 'De-active';
                     };?>
                    </td>
                </tr>
                <tr>
                    <th>Created  By</th>
                    <td><?php echo getNameByAdminID($row['created_by']) ;?></td>
                </tr>
                <tr>
                    <th>created at</th>
                    <td><?php echo $row['created_at'] ;?></td>
                </tr>
                <tr>
                    <th>updated by</th>
                    <td><?php if($row['updated_by']){
                        echo getNameByAdminID($row['updated_by']);
                    } ;?></td>
                </tr>
                <tr>
                    <th>updated at</th>
                    <td><?php echo $row['updated_at'] ;?></td>
                </tr>
            </table>
           <?php }else{ ?>
               <div class="no_record">
                   Invalid category.
               </div>
           <?php }  ?> 
     </div>

    
</body>
</html>