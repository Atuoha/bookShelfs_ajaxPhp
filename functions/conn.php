<?php

$conn = mysqli_connect('localhost', 'root', '', 'phpcrud');

if(!$conn){
    die('Error with connection '. mysqli_error($conn));
}

?>
