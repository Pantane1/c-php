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
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pantane254@gmail.com';
        $mail->Password   = 'iujpfphdnrgqlgcl';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('pantane254@gmail.com', 'Portfolio Contact');
        $mail->addAddress('pantane254@gmail.com');

        $mail->Subject = "New Message From Portfolio";
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        $messageStatus = "Message sent successfully!";
    } catch (Exception $e) {
        $messageStatus = "Message failed. Try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: #f5f7fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: #ffffff;
    padding: 40px;
    width: 100%;
    max-width: 500px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

h2 {
    margin-bottom: 10px;
    font-size: 24px;
    font-weight: 600;
}

.subtitle {
    color: #666;
    font-size: 14px;
    margin-bottom: 25px;
}

input, textarea {
    width: 100%;
    padding: 14px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    transition: 0.2s ease;
}

input:focus, textarea:focus {
    border-color: #000;
    outline: none;
}

button {
    width: 100%;
    padding: 14px;
    background: #000;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    transition: 0.2s ease;
}

button:hover {
    background: #333;
}

.success {
    background: #e6f9ed;
    color: #1a7f37;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 13px;
}

.error {
    background: #fdecea;
    color: #b42318;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 13px;
}
</style>
</head>
<body>

<div class="container">
    <h2>Get In Touch</h2>
    <p class="subtitle">Let’s build something meaningful together.</p>

    <?php if($messageStatus == "Message sent successfully!") echo "<div class='success'>$messageStatus</div>"; ?>
    <?php if($messageStatus == "Message failed. Try again.") echo "<div class='error'>$messageStatus</div>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

</body>
</html>
