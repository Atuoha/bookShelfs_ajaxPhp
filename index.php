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
    <div id="searched_books" class="mt-5"></div>


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
                                <input type="date" name="pub_date" class="form-control" id="" required="">
                            </div> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-block btn btn-primary">Store Record <i class="fa fa-book"></i></button>
                    </div>

                    <p class="action_response"></p>

        
                </form>


            </div>

            <!-- Edit books -->
            <div class="col-md-6" id="edit_form">
                        <form action="functions/functions.php" method="post" id="editing_form"> 
                            <p id="book_details"></p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Title: </label>
                                        <input type="hidden" name="edit_id" class="edit_id">
                                        <input type="text" name="edit_title" class="form-control" id="title" required="" autofocus="" placeholder="Title:">
                                    </div> 
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Isbn: </label>
                                        <input type="text" name="edit_isbn" class="form-control" id="isbn" required="" placeholder="Isbn:">
                                    </div> 
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Author: </label>
                                        <input type="text" name="edit_author" class="form-control" id="author" required="" placeholder="Author:">
                                    </div> 
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Quantity: </label>
                                        <input type="number" name="edit_quantity" class="form-control" id="quantity" required="" placeholder="Quantity:">
                                    </div> 
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Cost: </label>
                                        <input type="text" name="edit_cost" class="form-control" id="cost" required="" placeholder="Cost in Dollars:">
                                    </div> 
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Pub_date: </label>
                                        <input type="date" name="edit_pub_date" class="form-control" id="pub_date">
                                    </div> 
                                </div>
                             
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update Record <i class="fa fa-book"></i></button>
                                <button type="button" id="cancel_btn" class="btn btn-info">Cancel <i class="fa fa-check"></i></button>
                                <button type="button" class=" btn btn-warning"><a href="#" class="del_btn" id="">Delete  <i class="fa fa-remove"></i></a></button>
                            </div>

                
                        </form>                
            </div>
        </div>

        <form action="functions/functions.php" id="del_form">
            <button type="submit" id="checkbox_del" class="btn btn-warning">Delete Book(s) now <i class="fa fa-remove"></i></button>

        <div id="stored_books_div" class="text-center">
            <!-- Display stored books -->
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><input type="checkbox" id="multi_array"></th>    
                    <th>Title</th>
                    <th>Isbn</th>
                    <th>Author</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    <th>Pub_Date</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody id="table-body">
                    <?php pull_stored_books() ?>
                </tbody>
        </form>

            
            </table>
        </div>
    </div>
</div>


<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>