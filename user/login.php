<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // User is already logged in, redirect to index.php
    header('Location: ../index.php');
    exit;
}

// Get the email and password from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Load the users from the JSON file
$users = json_decode(file_get_contents('../db/users.json'), true);

// Check if the email and password match a user
foreach ($users as $user) {
    if ($user['email'] == $email && $user['password'] == $password) {
        // Email and password match, start a session and redirect to index.php
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../index.php');
        exit;
    }
}

// Email and password do not match, display an error message
echo 'Invalid email or password';
?>