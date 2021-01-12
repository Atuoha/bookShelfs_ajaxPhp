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
            <td><input type="checkbox" class="single_array" name="checkbox_array[]" value="<?php echo $id ?>"></td>
            <td><?php echo $title ?></td>                    
            <td><?php echo $isbn ?></td>                    
            <td><?php echo $author ?></td>                    
            <td><?php echo $quantity ?></td>                    
            <td><?php echo '$'.$cost ?></td>                    
            <td><?php echo $pub_date ?></td> 
            <td>
                <a href="#" class="select_book" data-id="<?php echo $id ?>" data-title="<?php echo $title ?>" data-isbn="<?php echo $isbn ?>" data-quantity="<?php echo $quantity ?>" data-cost="<?php echo $cost ?>" data-author="<?php echo $author ?>" data-date="<?php echo $pub_date ?>">Operate</a>
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
                    <a href="#" class="select_book" data-id="<?php echo $id ?>" data-title="<?php echo $title ?>" data-isbn="<?php echo $isbn ?>" data-quantity="<?php echo $quantity ?>" data-cost="<?php echo $cost ?>" data-author="<?php echo $author ?>">Operate</a>
                </td>                    
            </tr>    
    <?php

    }
    ?>

        </tbody>
    </table>

    <?php

    }else{
        echo '<p class="alert alert-danger lead">Opps! No result for keyword </p>';
    }

}



// deleting book
if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql_delete_book = mysqli_query($conn, "DELETE FROM books WHERE id = '$id' ");
    if(!$sql_delete_book){
        die('Error with query ' . mysqli_error($conn));
    }
}

// editing book
if(isset($_POST['edit_title'])){
    $id = $_POST['edit_id'];
    $title = $_POST['edit_title'];
    $isbn = $_POST['edit_isbn'];
    $author = $_POST['edit_author'];
    $cost = $_POST['edit_cost'];
    $quantity = $_POST['edit_quantity'];
    $pub_date = $_POST['edit_pub_date'];

    $sql_update_book = mysqli_query($conn, "UPDATE books SET title = '$title', isbn = '$isbn', author = '$author', cost = '$cost', quantity = '$quantity', pub_date = '$pub_date' WHERE id = '$id' ");

    if(!$sql_update_book){
        die('Error with query ' . mysqli_error($conn));
    }
}



// deleting using checkboxes
if(isset($_POST['checkbox_array'])){
    $ids = $_POST['checkbox_array'];

    foreach($ids as $id){
        $sql_delete_book = mysqli_query($conn, "DELETE FROM books WHERE id = '$id' ");
        if(!$sql_delete_book){
            die('Error with query ' . mysqli_error($conn));
        }
    }
}