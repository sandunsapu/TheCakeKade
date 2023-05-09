<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Database connection here
    $con = new mysqli("localhost","root","","thecakekade");
    if($con->connect_error){
        die("Failed to connect:".$con->connect_error);
    }
    else{
        $stmt = $con->prepare("insert into users(Name,Email,Password)values(?,?,?)");
        $stmt->bind_param("sss",$name,$email,$password);
        $stmt->execute();
        //echo "<script>alert('registration successfully');</script>";
        echo '<script>alert("Registration successful"); window.location.href="/TheCakeKade/pages/signin.html";</script>';

        //header("Location: /TheCakeKade/pages/signin.html");
        $stmt->close();
        $con->close();
        
        }
?>