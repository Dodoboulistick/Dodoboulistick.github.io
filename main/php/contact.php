<?php

/* // Email recipient
$EmailTo = "contact@dodobwebsite.fr";

$errors = "";

// Name
if (empty($_POST["name"])) {
    $errors = "Name is required ";
} else {
    $name = $_POST["name"];
}

// Email
if (empty($_POST["email"])) {
    $errors .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// Subject
if (empty($_POST["subject"])) {
    $errors = "Subject is required ";
} else {
    $Subject = $_POST["subject"];
}

// Message
if (empty($_POST["message"])) {
    $errors .= "Message is required ";
} else {
    $message = $_POST["message"];
}

// Prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

// Send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);

// Redirect to success page
if ($success && $errors == ""){
   echo 'success';
}
else{
    echo $errors;
} */
?>

<?php 

    $array = array("name" => "","email" => "","subject" =>"" ,"message" => "","nameError" => "", "emailError" => "","subjectError" => "","messageError" => "", "isSuccess" => false);

    $emailTo = "contact@dodobwebsite.fr";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $array["name"] = verifyInput($_POST['name']);
        $array["email"] = verifyInput($_POST['email']);
        $array["subject"] = verifyInput($_POST['subject']);
        $array["message"] = verifyInput($_POST['message']);
        $array["isSuccess"] = true;
        $emailText = "";
        
        if(empty($array["name"])){
            $array["nameError"] = "Vous devez entrer votre nom.";
            $array["isSuccess"] = false;
        } else {
            $emailText .= "Nom : {$array["name"]}\n";
        }
        
            
        if(!isEmail($array["email"])){
            $array["emailError"] = "Vous devez entrer votre mail.";
            $array["isSuccess"] = false;
        } else {
            $emailText .= "Email: {$array["email"]}\n";
        }
            
            
        if(empty($array["subject"])){
            $array["subjectError"] = "Vous devez entrer l'objet du message.";
            $array["isSuccess"] = false;
        } else {
            $emailText .= "Nom : {$array["subject"]}\n";
        }
            
            
        if(empty($array["message"])){
            $array["messageError"] = "Vous devez entrer un message";
            $array["isSuccess"] = false;
                } else {
            $emailText .= "Message: {$array["message"]}\n";
        }
            
            
        if($array["isSuccess"]){
            $headers = "De: {$array["name"]} <{$array["email"]}> à propos de : {$array["subject"]}\r\nRépondre à: {$array["email"]}";
            mail($emailTo, "Un message de votre site", $emailText, $headers);
        }
        
        echo json_encode($array);
    }


    /* function isPhone($var){
        return preg_match("/^[0-9 ]*$/", $var);
    } */

    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

?>


