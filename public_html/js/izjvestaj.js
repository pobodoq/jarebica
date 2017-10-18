$(document).ready(function(){
    // var array = [];
    var string = '';
    $('button').on('click', function(){
        $('.onClick :input').each(function(){
            console.log($(this).attr('name'));
            // if($(this).val()!==""){
            //     array.push({name:$(this).attr('name'), value: $(this).val()});
            // }
            string += $(this).attr('name')+ '=' + $(this).val();
        });
        console.log(array);
        // $(".onClick input").each(function(){
        //     console.log($(this).attr('name'));
        // });

        // var array = $('.onClick input').val();
        // console.log(array);
        // console.log('a');
        // $.each()
        // alert('me');
        //array za tcpdf  - dobivamo od inputa i selecta
        // append za listu

    });


});