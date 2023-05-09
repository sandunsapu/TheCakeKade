<?php

    $email = $_POST['email'];
    $password = $_POST['password'];

    //Database connection here
    $con = new mysqli("localhost","root","","thecakekade");

    if($con->connect_error){
        die("Failed to connect:".$con->connect_error);
    }

    else{

        $stmt = $con->prepare("select * from users where email = ?");
        $stmt->bind_param("s",$email);

        $stmt->execute();

        $stmt_result = $stmt->get_result();

        if($stmt_result->num_rows > 0)
        {
            $data = $stmt_result->fetch_assoc();
            
            if($data['Password']=== $password){
                echo '<script>alert("Logged in successful"); window.location.href="/TheCakeKade/pages/admin.html";</script>';
            }
            else{
                echo"<h2>Invalid Email or Password</h2>";
            }
        }
    }
?>