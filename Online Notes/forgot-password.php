<?php

//Start session 
session_start();
//Connect to the database
include('connection.php');

//Check user inputs
    //Define error messages
$missingEmail='<p><strong>Please enter your email address!</strong></p>';
$InvalidEmail='<p><strong>Please enter a valid email address!</strong></p>';

    //Get email
    //Store errors in errors variable
if(empty($_POST["forgotemail"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["forgotemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $InvalidEmail;
    }
}

    //If there are any errors print errors
if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultMessage;
    exit;
}
    //еlse: no errors
        //Prepare variables for the query
$email =
    mysqli_real_escape_string($link, $email);
    //Run query to check if the email exits in the users table
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$count = mysqli_num_rows($result);
//If the email does not exist
if($count != 1){
    echo '<div class="alert alert-danger">That email does not exist in our database.></div>'; 
    exit;
}
    //else
        //get the user_id
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_id = $row['user_id'];
    //Create an unique activation code
$keyy = bin2hex(openssl_random_pseudo_bytes(16));
    //Insert user details and activaction code in the forgotpassword table
$time = time();
$status= 'pending';
$sql = "INSERT INTO forgotpassword (`user_id`,`keyy`,`time`,`status`) VALUES ('$user_id', '$keyy', '$time', '$status')";
$result = mysqli_query($link, $sql);

if(!$result){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>';
    exit;
}
    //Send email with link to resetpassword.php with user id and activation code

$message="Please click on this link to reset your password:\n\n";
$message .= "http://imakesites.host20.uk/OnlineNotesApp/resetpassword.php?user_id=$user_id&key=$keyy";

if(mail($email, 'Reset your password', $message, 'From:'.'simonabushevska99@gmail.com')){
    //If email sent successfully print success message
    echo"<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password.</div>";
}

?>