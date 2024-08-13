<?php
session_start();
include 'config/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Check if the email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            $error = "Email already registered.";
        } else {
            // Insert the user into the database
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
            if ($stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password])) {
                $_SESSION['email'] = $email;
                $_SESSION['first_name'] = $first_name;
                header('Location: member.php');
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<?php include 'templates/header.php'; ?>

<h2>Register</h2>
<form action="register.php" method="POST">
    <?php if (isset($error)): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Register</button>
</form>

<?php include 'templates/footer.php'; ?>
