//Ajax call for the sign up form
//Once the form is submitted
$("#signupform").submit(function(event){
   //prevent default php processing 
    event.preventDefault();
   //collect user inputs
    var datatopost = $(this).serializeArray();
    //console.log(datatopost);
  //send them to signup.php usign AJAX
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#signupmessage").html(data);
            }
        },
        error:function(){
            $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});


//Ajax call for the login  form
//Once the form is submitted
$("#loginform").submit(function(event){
   //prevent default php processing 
    event.preventDefault();
   //collect user inputs
    var datatopost = $(this).serializeArray();
    //console.log(datatopost);
  //send them to login.php usign AJAX
    $.ajax({
        url: "login.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data.replace(/\s/g, '') == "success"){
                window.location = "mainpageloggedin.php";
            }else{
                $('#loginmessage').html(data);
            }
        },
        error:function(){
            $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});

//Ajax Call for the forfot password form
//Once the form is submitted
$("#forgotpasswordform").submit(function(event){
   //prevent default php processing 
    event.preventDefault();
   //collect user inputs
    var datatopost = $(this).serializeArray();
    //console.log(datatopost);
  //send them to login.php usign AJAX
    $.ajax({
        url: "forgot-password.php",
        type: "POST",
        data: datatopost,
        success: function(data){
          $('#forgotpasswordmessage').html(data);
        },
        error:function(){
            $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});