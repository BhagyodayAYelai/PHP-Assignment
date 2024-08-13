<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

include 'templates/header.php';
?>

<h2>Member Page</h2>
<p>Welcome, <?php echo $_SESSION['first_name']; ?>!</p>
<p>Your email is <?php echo $_SESSION['email']; ?>.</p>

<?php include 'templates/footer.php'; ?>
