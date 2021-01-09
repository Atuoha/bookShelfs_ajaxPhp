$(document).ready(function(){
    
    // store books
    $('#store_form').submit(function(e){
        e.preventDefault();
        data = $(this).serialize();
        action = $(this).attr('action');

        $.ajax({
            data: data,
            url: action,
            type: 'POST',
            success: (result=>{
                if(!result.error){
                    $('.response').html(result);

                    // reload table div
                    setInterval( ()=>{
                        $('#stored_books_div').load(location.href + ' #stored_books_div' );
                    }, 200)

                    $('#store_form').reset();
                }
            })
        })
    })

    
       
           
        // search books
        $('#search_keyword').keyup(function(e){
            let searched = e.target.value
            if(searched != ''){
                console.log(searched)
                $.ajax({
                    data: {searched: searched},
                    url: 'functions/functions.php',
                    type: 'POST',
                    success: (result=>{
                        if(!result.error){
                            $('#searched_books').html(result)
                        }
                    })
                })
            }else{
                $('#searched_books').html('')
            }
        })


    // Delete OR Update Books
    $('.select_book').click(function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let title = $(this).data('title');
        let author = $(this).data('author');
        let isbn = $(this).data('isbn');
        let quantity = $(this).data('quantity');
        let cost = $(this).data('cost');
        let pub_date = $(this).data('date');

        
        $('#edit_form').css('display', 'block')
        $('#book_details').attr('class', 'alert alert-success');
        $('#book_details').html(`Showing ${title}`);
        $('#title').attr('value', title);
        $('#author').attr('value', author);
        $('#isbn').attr('value', isbn);
        $('#quantity').attr('value', quantity);
        $('#cost').attr('value', cost);
        $('#pub_date').attr('value', pub_date);  
        $('.edit_id').attr('value', id);    
        $('.del_btn').attr('id', id);    
        $('.del_btn').attr('rel', title);    


    })



    // cancelling edit/delete request
    $('#cancel_btn').click(function(e){
        $('#edit_form').css('display', 'none')
    })


    // deleting request
    $('.del_btn').click(function(e){

        let title = $(this).attr('rel');
        let id = $(this).attr('id');

        if(confirm(`Do you want to delete "${title}" ?`)){   

            $.ajax({
                data: {id: id},
                url: 'functions/functions.php',
                type: 'POST',
                success: (data=>{
                    if(!data.error){
                        $('.action_response').css('display', 'block');
                        $('.action_response').html(`Deleted book successfully :) " `);
                        $('.action_response').attr('class', 'alert alert-success');
                        $('#edit_form').css('display', 'none');

                        setTimeout( ()=>{
                            $('.action_response').fadeOut('slow');
                        }, 3000)
                        
                         // reload table div
                        setInterval( ()=>{
                            $('#stored_books_div').load(location.href + ' #stored_books_div' );
                        }, 200)
                        
                    }
                })
            })


        }else{
        $('#edit_form').css('display', 'none')
        }
    })



    // editing request
    $('#editing_form').submit(function(e){
        e.preventDefault();

        let action = $(this).attr('action');
        let title = $('#edit_title').attr('value');
        let data = $(this).serialize();

        $.ajax({
            data: data,
            url: action,
            type: 'POST',
            success: (response=>{
                $('.action_response').css('display', 'block');
                $('.action_response').html(`Updated book successfully :) `);
                $('.action_response').attr('class', 'alert alert-success');
                $('#edit_form').css('display', 'none')

                setTimeout( ()=>{
                    $('.action_response').fadeOut('slow');
                }, 3000)


                 // reload table div
                setInterval( ()=>{
                    $('#stored_books_div').load(location.href + ' #stored_books_div' );
                }, 200)

            })
        })
    })



    // single book operation using checkbox
    $('.single_array').click(function(e){

        if(this.checked){
            $('#checkbox_del').fadeIn('slow')
        }else{
            $('#checkbox_del').fadeOut('slow')
        }
    })


    // checkbox multi-selection
    $('#multi_array').click(function(e){
        if(this.checked){
            $('.single_array').each(function(){
                this.checked = true;
                $('#checkbox_del').fadeIn('slow')
            })
        }else{
            $('.single_array').each(function(){
                this.checked = false;
                $('#checkbox_del').fadeOut('slow')
            })
        }
    })



    // deleting books using checkbox
    $('#del_form').submit(function(e){
        e.preventDefault();

        let data = $(this).serialize();
        let action = $(this).attr('action');

        $.ajax({
            data: data,
            url: action,
            type: 'POST',
            success: (response=>{
                $('.action_response').css('display', 'block');
                $('.action_response').html(`Deleted books successfully :)`);
                $('.action_response').attr('class', 'alert alert-success');
                $('#checkbox_del').fadeOut('slow')


                setTimeout( ()=>{
                    $('.action_response').fadeOut('slow');
                }, 3000)


                 // reload table div
                 setInterval( ()=>{
                    $('#stored_books_div').load(location.href + ' #stored_books_div' );
                }, 200)


            })
        })
    })



})

