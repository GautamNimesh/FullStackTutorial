<?php

$errors = [];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If errors exist
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='index.html'>Go Back</a>";
        exit;
    }

    // JSON File
    $file = "users.json";

    // Read existing file
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    $jsonData = file_get_contents($file);
    if ($jsonData === false) {
        die("Error reading users.json file.");
    }

    $users = json_decode($jsonData, true);
    if (!is_array($users)) {
        $users = [];
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Add new user
    $newUser = [
        "name" => $name,
        "email" => $email,
        "password" => $hashedPassword
    ];

    $users[] = $newUser;

    // Save back to JSON
    $saved = file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    if ($saved === false) {
        die("Error writing to users.json");
    }

    echo "<h3 style='color:green;'>Registration successful!</h3>";
    echo "<a href='index.html'>Register Another User</a>";
}
?>
