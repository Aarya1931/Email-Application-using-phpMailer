<?php 
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit;
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Compose Mail</title>
<style>
    body {
        background-color: #222;
        color: #fff;
        font-family: Arial, sans-serif;
    }
    h2 {
        color: #fff;
    }
    form {
        background-color: #333;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"],
    textarea {
        width: calc(100% - 12px);
        padding: 6px;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
        background-color: #444;
        color: #fff;
    }
    textarea {
        resize: vertical;
        height: 100px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<h2>Compose your Mail</h2>
<form action="send_email.php" method="post">
    <label for="to_email">Recipient Email (To):</label>
    <input type="email" id="to_email" name="to_email" required><br>
    <label for="name">Your Name:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" required><br>
    <label for="message">Your Message:</label>
    <textarea id="message" name="message" rows="4" required></textarea><br>
    <input type="submit" value="Send">
</form>
<form action="logout.php" method="post">
    <input type="submit" value="Logout">
</form>
</body>
</html>
