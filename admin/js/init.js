$(document).ready(function(){
 
    /* image delete */
    $('.imglistItem a').click(function(){
        var imgId = $(this).attr('data-id');
        $.ajax({
             type: 'POST',
             url: "inc/deleteImg.php",
             data: {'deleteImg':'ok', 'imgId':imgId},
             success: function(){
                $('a[data-id='+imgId+']').closest('.imglistItem').remove();
             }
        });
        return false;
    });


    $('.message.clickable').click(function(){
        $(this).fadeOut(200);
    });
    
    /**/
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });


    $(".BannerListSortable").sortable({
        handle: ".handle",
        placeholder: "ui-state-highlight",
        update: function( event, ui ) {
            var sorted = $( ".BannerListSortable" ).sortable("serialize");
            $.ajax({
                 type: 'GET',
                 url: "inc/sortableItems.php",
                 data: {'data':sorted},
                 success: function(){
                    //
                 }
            });
            //alert(sorted);
        }
    });


});

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}