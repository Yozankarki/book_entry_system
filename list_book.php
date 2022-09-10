<?php 
require_once 'checksession.php';
require_once 'databaseconn.php';
$books= [];

try {
	//databaset connection function
	 $connection = new mysqli('localhost', 'root', '', 'crud_book_entry_system');
	//sql to select data
	$sql = "select * from books";
	//query execution and return result object
	$result = mysqli_query($connection,$sql);
	//check number of rows
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)){
			array_push($books, $row);
		}
	}
} catch (Exception $e) {
	die ('Database  error:-' . $e->getMessage());
} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Table</title>
	<style type="text/css">
th {
  background-color: #04AA6D;
  color: white;
}
	
table {
  margin-top:2em;
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
tr:hover{background-color:grey;}
.error{
  color: red;
}
	</style>
</head>
<body>
<h1>List Book</h1>
<?php 
require_once 'admin_menu.php';
 ?>
<table border="1" width="100%">
	<thead>
		<tr>
			<th>SN</th>
			<th>ID</th>
			<th>Title</th>
			<th>Author</th>
			<th>Publisher</th>
			<th>Edition</th>
			<th>ISBN</th>
			<th>Price</th>
			<th>Page</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($books as $key => $book){ ?>
	 	<tr>
	 		<td><?php echo $key+1 ?></td>
	 		<td><?php echo $book['id'] ?></td>
	 		<td><?php echo $book['title'] ?></td>
	 		<td><?php echo $book['author'] ?></td>
	 		<td><?php echo $book['publication'] ?></td>
	 		<td><?php echo $book['edition'] ?></td>
	 		<td><?php echo $book['isbn'] ?></td>
	 		<td><?php echo $book['price'] ?></td>
	 		<td><?php echo $book['page'] ?></td>
	 		<td>
	 			<a href="edit_book.php?id=<?php echo $book['id'] ?>" >Edit</a>
	 			<a href="delete_book.php?id=<?php echo $book['id'] ?>" onclick="return confirm('are you sure to delete?')">Delete</a>
	 		</td>
	 	</tr>
 	<?php } ?>
 	<?php if (count($books) == 0) { ?>
 			<tr>
 				<th colspan="10" class="error">Book not found</th>
 			</tr>
 	<?php } ?>
	</tbody>
</table>
</body>
</html>
