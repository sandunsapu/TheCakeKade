<?php

// Connect to the database
$host = 'localhost';
$dbname = 'thecakekade';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the form data
    $name = $_POST['item-name'];
    $price = $_POST['item-price'];
    $description = $_POST['item-description'];
    //$quantity = $_POST['item-qty'];
    $image = $_FILES['image'];

    // Move the uploaded file to a permanent location
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image["name"]);
    move_uploaded_file($image["tmp_name"], $target_file);

    // Insert the data into the database
    $stmt = $db->prepare("INSERT INTO cakes (Name, Price, Description, Image) VALUES (:name, :price, :description, :image)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    //$stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':image', $target_file);

    try {
        $stmt->execute();
        //echo "Item added successfully!";
        echo '<script>alert("Item added successfully!"); window.location.href="/TheCakeKade/pages/admin.html";</script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
