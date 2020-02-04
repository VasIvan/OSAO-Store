
/*NAVBAR*/
$(document).ready(function () {
    if($(window).width() < 992) {
       $("#right-align").removeClass("ml-auto");  
    }    
});
/*NAVBAR*/

/*RESET PASSWORD*/
$(document).ready(function () {
    if($(window).width() > 575) {
       $("#mail-rst").removeClass("mb-2");  
    }    
});
/*RESET PASSWORD*/

/*LOGIN NAV BTN*/
$(document).ready(function () {
    if($(window).width() < 992) {
       $("#login-btn").removeClass("ml-auto");
       $("#login-btn").addClass("mr-auto");  
    }
    
    if($(window).width() < 575) {
        $("#login-btn").removeClass("mr-auto");
        $("#login-btn").addClass("btn-block");  
     }    
});
/*LOGIN NAV BTN*/

/*ADMIN USERS*/
$(document).ready(function () {
   if($(window).width() < 992) {
      $("#table-users").removeClass("container");
      $("#table-users").addClass("container-fluid");  
   }   
});

/*ADMIN USERS*/