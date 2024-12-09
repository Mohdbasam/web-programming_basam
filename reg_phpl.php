<?php
// Initialize error messages
$errors = [];
$successMessage = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);

    // Validate Username
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors['username'] = "Username must be at least 3 characters.";
    }

    // Validate Email
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate Password
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    }

    // Validate Confirm Password
    if (empty($confirmPassword)) {
        $errors['confirm_password'] = "Please confirm your password.";
    } elseif ($confirmPassword !== $password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // Validate First Name
    if (empty($firstName)) {
        $errors['first_name'] = "First name is required.";
    }

    // Validate Last Name
    if (empty($lastName)) {
        $errors['last_name'] = "Last name is required.";
    }

    // If there are no errors, set a success message
    if (empty($errors)) {
        $successMessage = "Registration successful!";
        // Here you would typically insert the data into a database
        // For now, display the success message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h1>Register</h1>
    <?php if ($successMessage): ?>
        <p style="color: green;"><?php echo htmlspecialchars($successMessage); ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <!-- Username -->
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>"><br>
        <?php if (isset($errors['username'])): ?>
            <p style="color: red;"><?php echo $errors['username']; ?></p>
        <?php endif; ?>

        <!-- Email -->
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>"><br>
        <?php if (isset($errors['email'])): ?>
            <p style="color: red;"><?php echo $errors['email']; ?></p>
        <?php endif; ?>

        <!-- Password -->
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <?php if (isset($errors['password'])): ?>
            <p style="color: red;"><?php echo $errors['password']; ?></p>
        <?php endif; ?>

        <!-- Confirm Password -->
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password"><br>
        <?php if (isset($errors['confirm_password'])): ?>
            <p style="color: red;"><?php echo $errors['confirm_password']; ?></p>
        <?php endif; ?>

        <!-- First Name -->
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstName ?? ''); ?>"><br>
        <?php if (isset($errors['first_name'])): ?>
            <p style="color: red;"><?php echo $errors['first_name']; ?></p>
        <?php endif; ?>

        <!-- Last Name -->
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastName ?? ''); ?>"><br>
        <?php if (isset($errors['last_name'])): ?>
            <p style="color: red;"><?php echo $errors['last_name']; ?></p>
        <?php endif; ?>

        <!-- Submit Button -->
        <input type="submit" value="Register">
    </form>
</body>
</html>

