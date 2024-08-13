<?php include 'templates/header.php'; ?>

<h2>Contact Us</h2>
<form action="contact.php" method="POST">
    <label for="name">Your Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="email">Your Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="message">Your Message:</label>
    <textarea id="message" name="message" required></textarea>
    <button type="submit">Send</button>
</form>

<?php include 'templates/footer.php'; ?>
