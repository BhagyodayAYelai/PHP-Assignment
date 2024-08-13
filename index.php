<?php
session_start();
include 'config/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Both fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Check if the user exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        if ($stmt->rowCount() == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $stmt->fetch()['first_name'];
            header('Location: member.php');
            exit();
        } else {
            $error = "Incorrect email or password.";
        }
    }
}
?>

<?php include 'templates/header.php'; ?>

<?php if (!isset($_SESSION['email'])): ?>
    <form action="index.php" method="POST">
        <h2>Login</h2>
        <?php if (isset($error)): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
<?php else: ?>
    <p>Welcome, <?php echo $_SESSION['first_name']; ?>!</p>
<?php endif; ?>

<?php include 'templates/footer.php'; ?>
