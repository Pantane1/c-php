<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

$messageStatus = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pantane254@gmail.com'; 
        $mail->Password   = 'iujpfphdnrgqlgcl';   
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email Details
        $mail->setFrom('pantane254@gmail.com', 'Website Contact');
        $mail->addAddress('pantane254@gmail.com'); // Where messages go

        $mail->Subject = "New Contact Form Message";
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        $messageStatus = "Message sent successfully!";
    } catch (Exception $e) {
        $messageStatus = "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Me</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 40px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px; background: #000; color: #fff; border: none; width: 100%; cursor: pointer; }
        .status { margin-bottom: 15px; color: green; }
    </style>
</head>
<body>

<div class="container">
    <h2>Get In Touch</h2>

    <?php if($messageStatus != "") echo "<div class='status'>$messageStatus</div>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

</body>
</html>