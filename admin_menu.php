<?php require_once 'checksession.php';?>
<?php 
 $sn = explode('/', $_SERVER['SCRIPT_NAME']);
 $page = $sn[count($sn) - 1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       ul.admin_menu{
            display: flex;
            flex-direction: row;
            list-style-type: none;
        }
        ul li a {
            padding-left: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border: none;
        }
        .active{
            background-color: red;
        }
        ul li a:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.active_link a{
    background-color: hotpink;
}
    </style>
</head>
<body>
<ul class="admin_menu">
    <li class="<?php echo ($page == 'list_book_category.php')?'active_link':'' ;?>"><a href="list_book_category.php">List book Category</a></li>
    <li class="<?php echo ($page == 'add_book_category.php')?'active_link':'' ;?>"><a href="add_book_category.php">add book Category</a></li>
    <li class="<?php echo ($page == 'list_book.php')?'active_link':'' ;?>"><a href="list_book.php">List Book</a></li>
    <li class="<?php echo ($page == 'add_book.php')?'active_link':'' ;?>"><a href="add_book.php">Add Book</a></li>
    <li class="<?php echo ($page == 'logout.php')?'active_link':'' ;?>"><a  class= "active" href="logout.php"> log-out</a></li>
</ul>
</body>
</html>