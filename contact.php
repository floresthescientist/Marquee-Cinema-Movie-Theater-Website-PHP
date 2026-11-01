<?php
/**
 * contact.php - Contact page
 * ------------------------------------------------------------
 * Displays a contact form built with the formField() function.
 * When submitted, the same page processes the form and shows
 * a thank-you message. (No email is actually sent — this is a demo.)
 * ------------------------------------------------------------
 */

require_once 'functions.php';
require_once 'data.php';

use function Marquee\formField;

$pageTitle   = "Contact";
$currentPage = "contact";

include 'header.php';

$submitted = false;
$error     = "";
$name = $email = $message = "";   // start empty so the form fields have a value

// Only run this block when the form is submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Basic validation
    if ($name === '' || $email === '' || $message === '') {
        $error = "Please fill out every field.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        $submitted = true;
    }
}
?>

<h1 class="page-title">Contact Us</h1>

<?php if ($submitted): ?>
    <!-- Success message (htmlspecialchars blocks injected HTML/scripts) -->
    <div class="notice success">
        Thanks, <?php echo htmlspecialchars($name); ?>!
        We'll reply to <?php echo htmlspecialchars($email); ?> soon.
    </div>
<?php else: ?>

    <?php if ($error): ?>
        <div class="notice error"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Each field comes from formField(); the value keeps what the user typed -->
    <form method="post" action="contact.php" class="contact-form">
        <?php echo formField("Name", "name", "text", $name); ?>
        <?php echo formField("Email", "email", "email", $email); ?>
        <?php echo formField("Message", "message", "textarea", $message); ?>

        <button type="submit" class="btn">Send Message</button>
    </form>

<?php endif; ?>

<?php include 'footer.php'; ?>
