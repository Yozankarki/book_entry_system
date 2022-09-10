<?php
// process to login to database.
            $connection = new mysqli('localhost', 'root', '', 'crud_book_entry_system');
            if($connection ->connect_errno !=0){
                die('Databse connection Error.' . $connection -> connect_error);
            }
            ?>