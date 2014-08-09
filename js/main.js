$(document).ready(function(){
    var retina = (window.retina || window.devicePixelRatio > 1);
    if (retina) {
        // the user has a retina display
        $('body').addClass('retina');
    }
    else {
        // the user has a non-retina display
        $('body').removeClass('retina');
    }
    
    var hash = window.location.hash;
    hash = hash.substring(1); // remove #
    if (hash.length>0){
        $('.hero-unit-inner .carousel .item, .hero-unit-inner .carousel .itemsTxt .inner').hide();
        $('.hero-unit-inner .carousel .item.'+hash+', .hero-unit-inner .carousel .itemsTxt .inner.'+hash).show();   
    }

     $('.navbar .nav > li.menu > ul > li a').click(function(){
        window.location($(this).attr('href'));
     });
     $('.nav.navCarousel > li:not(.menu) > a').click(function(){
          var thisIndex = $(this).parent('li').index()+1;
          $('.dots a, .nav li').removeClass('active');
          $('.carousel .items .item, .carousel .itemsTxt .inner').fadeOut(250).delay(200).fadeOut(100, function(){
               $('.carousel .items .item:eq('+thisIndex+'), .carousel .itemsTxt .inner:eq('+thisIndex+')').fadeIn(250);               
          });
          $(this).parent('li').addClass('active');
          $('.dots a:eq('+thisIndex+')').addClass('active');
          $('.navbar .nav > li.menu > a').parent('li').find('ul').hide();
          return false;
     });
     $('.navbar .nav > li.menu > a').click(function(){
        $(this).parent('li').find('ul').toggle();
        return false;
     });

     /* checkbox 
     $("input[type=checkbox]").each(function(){
          $(this).hide();
          $(this).after('<div class="checkDiv"></div>');
     });
     $(".checkDiv").on('click', function(){
          if ( $(this).hasClass('checked')==true ){
               $(this).removeClass('checked');
               $(this).prev("input[type=checkbox]").removeAttr("checked");
          }else{
               $(this).addClass('checked');  
               $(this).prev("input[type=checkbox]").attr("checked","checked");        
          }
     });
     $(".checkDiv").on('change', function(){
          if ( $(this).hasClass('checked')==true ){
               $(this).removeClass('checked');
               $(this).prev("input[type=checkbox]").removeAttr("checked");
          }else{
               $(this).addClass('checked');  
               $(this).prev("input[type=checkbox]").attr("checked","checked");        
          }
     });
*/

});


