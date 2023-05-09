<?php
    // Set database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "thecakekade";

    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $_POST['your-name'];
    $email = $_POST['your-email'];
    $subject = $_POST['your-subject'];
    $message = $_POST['your-message'];

    // Insert form data into database table
    $sql = "INSERT INTO contact_details (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Set success message
        $successMsg = "Your Message sent successfully";

        // Redirect with success message
        header("Location: ../pages/contact-us.html?msg=" . urlencode($successMsg));
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
?>
