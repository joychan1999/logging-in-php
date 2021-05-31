$(document).ready(function(){
    $('#dashbord').click(function(){
        $('.dashbord').fadeIn(500);
        $('.notification').hide();
        $('.seller').hide();
        $('.buyer').hide();

    })
    $('#Notification').click(function(){
        $('.dashbord').hide();
        $('.notification').fadeIn(500);
        $('.seller').hide();
        $('.buyer').hide();
         
    })
    $('#seller').click(function(){
        $('.dashbord').hide();
        $('.notification').hide();
        $('.seller').fadeIn(500);
        $('.buyer').hide();
   
    })
    $('#buyer').click(function(){
        $('.dashbord').hide();
        $('.notification').hide();
        $('.seller').hide();
        $('.buyer').fadeIn(500);
    })
 
 

})