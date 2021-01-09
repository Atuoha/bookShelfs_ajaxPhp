<?php
require_once('conn.php');

global $conn;

// store book
if(isset($_POST['title'])){
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];
    $author = $_POST['author'];
    $cost = $_POST['cost'];
    $quantity = $_POST['quantity'];
    $pub_date = $_POST['pub_date'];



    $sql_pull_books = mysqli_query($conn, "SELECT * FROM books WHERE title = '$title' ");
    if(!$sql_pull_books){
        die('Error with query '. mysqli_error($conn));
    }

    $sql_pull_count = mysqli_num_rows($sql_pull_books);
    if($sql_pull_count == 1){
        echo "<span class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close' >&times;</a> Book already exists ):</span>";
    }else{
        $sql_insert_book = mysqli_query($conn, "INSERT INTO books(title, isbn, author, cost, quantity, pub_date) VALUES('$title', '$isbn', '$author', '$cost', '$quantity', '$pub_date') ");
        if(!$sql_insert_book){
            die('Error with query' . mysqli_error($conn));
        }else{
            echo "<span class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close' >&times;</a> Book added successfully </span>";
        }
    }


}


// pull books
function pull_stored_books(){
    global $conn;

    $sql_pull_books = mysqli_query($conn, "SELECT * FROM books ORDER By id DESC");
    if(!$sql_pull_books){
        die('Error with query' . mysqli_error($conn));
    }

    while($row = mysqli_fetch_array($sql_pull_books)){
        $id = $row['id'];
        $title = $row['title'];
        $isbn = $row['isbn'];
        $author = $row['author'];
        $quantity = $row['quantity'];
        $cost = $row['cost'];
        $pub_date = $row['pub_date'];
        ?>

        <tr>
            <td><?php echo $title ?></td>                    
            <td><?php echo $isbn ?></td>                    
            <td><?php echo $author ?></td>                    
            <td><?php echo $quantity ?></td>                    
            <td><?php echo '$'.$cost ?></td>                    
            <td><?php echo $pub_date ?></td> 
            <td>
                <a href="#" id="edit_book" data-id="<?php echo $id ?>" data-title="<?php echo $title ?>">Operate</a>
            </td>                    
         </tr>
         
        <?php
    }
}




// search books
if(isset($_POST['searched'])){
    $searched = $_POST['searched'];
    $search_books = mysqli_query($conn, "SELECT * FROM books WHERE title LIKE '%$searched%'
    OR isbn LIKE '%$searched%' OR author LIKE '%$searched%' OR cost LIKE '$searched' ");
    if(!$search_books){
        die('Error with query ' . mysqli_error($conn));
    }

    $search_count = mysqli_num_rows($search_books);
    if($search_count > 0){
    ?>
        <p class="alert alert-success lead">Showing <?php echo $search_count ?> Results </p>
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Isbn</th>
                <th>Author</th>
                <th>Quantity</th>
                <th>Cost</th>
                <th>Pub_Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php

    while($row = mysqli_fetch_array($search_books)){
        $title = $row['title'];
        $isbn = $row['isbn'];
        $author = $row['author'];
        $quantity = $row['quantity'];
        $cost = $row['cost'];
        $pub_date = $row['pub_date'];


    ?>
    
            <tr>
                <td><?php echo $title ?></td>                    
                <td><?php echo $isbn ?></td>                    
                <td><?php echo $author ?></td>                    
                <td><?php echo $quantity ?></td>                    
                <td><?php echo '$'.$cost ?></td>                    
                <td><?php echo $pub_date ?></td> 
                <td>
                    <a href="#" id="edit_book" data-id="<?php echo $id ?>" data-title="<?php echo $title ?>">Operate</a>
                </td>                    
            </tr>
        
    <?php

    }
    ?>

        </tbody>
    </table>

    <?php

    }

}

