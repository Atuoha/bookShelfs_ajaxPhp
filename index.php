<?php require_once('functions/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookShelf</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
</head>
<body>
    
<nav class="bg-primary">
    <a href="#" class="navbar-brand text-white"> <i class="fa fa-book fa-2x"></i> <b>BookShelf</b></a>
</nav>

<div class="container">
    <h1 class="lead text-center">
        Books - Store | View | Update | Delete | Search
    </h1>

    <!-- Search books -->
    <div class="form-group">
        <label for="">Search Book: </label>
        <input type="text" name="search" class="form-control" id="search_keyword">
    </div>

    <!-- Display searched books -->
    <div id="searched_books" class="mt-5">
        

    </div>


    <div class="container mt-5">
        <div class="row">
            <!-- Store books to database -->
            <div class="col-md-6">
            <div class="response"></div>
                <form action="functions/functions.php" method="post" id="store_form">  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Title: </label>
                                <input type="text" name="title" class="form-control" id="" required="" autofocus="" placeholder="Title:">
                            </div> 
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Isbn: </label>
                                <input type="text" name="isbn" class="form-control" id="" required="" placeholder="Isbn:">
                            </div> 
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Author: </label>
                                <input type="text" name="author" class="form-control" id="" required="" placeholder="Author:">
                            </div> 
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Quantity: </label>
                                <input type="number" name="quantity" class="form-control" id="" required="" placeholder="Quantity:">
                            </div> 
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Cost: </label>
                                <input type="text" name="cost" class="form-control" id="" required="" placeholder="Cost in Dollars:">
                            </div> 
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Pub_date: </label>
                                <input type="date/time" name="pub_date" class="form-control" id="" required="" placeholder="Pub_date:">
                            </div> 
                        </div>
                        </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-block btn btn-primary">Store Record <i class="fa fa-book"></i></button>
                    </div>

        
                </form>


            </div>

            <!-- Edit books -->
            <div class="col-md-6" id="edit_book">
                
            </div>
        </div>


        <div id="stored_books_div" class="text-center">
                      <!-- Display stored books -->
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
                                <?php pull_stored_books() ?>
                            </tbody>
                        
                        </table>
        </div>

    </div>
</div>

<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>