<?php
// Get the name, email, and password from the signup form
$given_name = $_POST['given_name'];
$family_name = $_POST['family_name'];
$nickname = $_POST['nickname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];

// Set default values for new users
$vip = false;
$role = 'user';
$email_verified = false;

// Load the users from the JSON file
$users = json_decode(file_get_contents('../db/users.json'), true);

// Check if the email already exists in the users array
if (isset($users[$email])) {
    // Email already exists, display an error message
    echo 'Email already exists';
} else {
    // Email does not exist, add the user to the users array
    $id = uniqid(); // Generate a unique ID for the new user
    $user = [
        'id' => $id,
        'given_name' => $given_name,
        'family_name' => $family_name,
        'nickname' => $nickname,
        'age' => $age,
        'email' => $email,
        'password' => $password,
        'vip' => $vip, // Add the default vip value to the user object
        'role' => $role, // Add the default role value to the user object
        'email_verified' => $email_verified, // Add the default email_verified value to the user object
        'avatar' => 'assets/media/avatar.png',
        'friends' => []
    ];
    $users[$id] = $user;

    // Save the updated users array to the JSON file
    file_put_contents('../db/users.json', json_encode($users));

    // Redirect the user to index.php
    header('Location: ../index.php');
    exit;
}
?>