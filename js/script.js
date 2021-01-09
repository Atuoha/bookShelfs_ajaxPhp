$(document).ready(function(){
    
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
                    $('#store_form').reset();
                }
            })
        })
    })

    
       
           

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



    setInterval( ()=>{
        $('#stored_books_div').load(location.href + ' #stored_books_div' )
    }, 200)
})

