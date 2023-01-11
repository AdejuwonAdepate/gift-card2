<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $Customer_ID = mysqli_real_escape_string($con, $_POST['Customer_ID']);
    $Customer_Name = mysqli_real_escape_string($con, $_POST['Customer_Name']);
    $Email_address = mysqli_real_escape_string($con, $_POST['Email_address']);
    $Network_Provider = mysqli_real_escape_string($con, $_POST['Network_Provider']);
    $Phone_Number = mysqli_real_escape_string($con, $_POST['Phone_Number']);
    $Scratch_Card_ID = mysqli_real_escape_string($con, $_POST['Scratch_Card_ID']);



    $email_check = "SELECT * FROM customer WHERE Email_address = '$Email_address'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['Email_address'] = "Hey! we recognize this email, you can no longer participate in this gift contest";
    }

    $card_check = "SELECT * FROM customer WHERE Scratch_Card_ID = '$Scratch_Card_ID'";
    $res = mysqli_query($con, $card_check);
    if(mysqli_num_rows($res) > 0){
        $errors['Scratch_Card_ID'] = "Sorry this code has already been used ";
    }
    if(count($errors) === 0){
     
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO customer (Customer_ID, Customer_Name, Email_address, Network_Provider, Phone_Number, Scratch_Card_ID)
                        values('$Customer_ID', '$Customer_Name', '$Email_address', '$Network_Provider', '$Network_Provider', '$Phone_Number', '$Scratch_Card_ID')";
        $data_check = mysqli_query($con, $insert_data);   
            echo("<p>" . $mail->getMessage() . "</p>");
            header("Location: card-display.php");
            
            else {
            header( "Location: error-page.php" ); 
            }


            else{
                   $errors['error'] = "Dear $user_name,  Your registration was successful.";
            }
        }else{
            $errors['db-error'] = "!";
            die;
        }
    }


    
