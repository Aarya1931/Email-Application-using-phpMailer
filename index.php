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
    <title>Inbox</title>
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1, h2 {
            color: #fff;
        }
        .email {
            background-color: #333;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
        }
        .email a {
            color: #007bff;
            text-decoration: none;
        }
        .email a:hover {
            text-decoration: underline;
        }
        .email-body {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #444;
            border-radius: 5px;
        }
        .email-body.active {
            display: block;
        }
        .compose-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .compose-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mail Inbox</h1>

        <?php
        // Your Gmail IMAP server settings
        $server = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'kaushik.salunke09@gmail.com'; // Update with your Gmail address
        $password = 'mgktqhohirrlkayk'; // Update with your Gmail app password
        // Attempt to connect to Gmail IMAP server
        $mailbox = imap_open($server, $username, $password);
        if (!$mailbox) {
            die('Cannot connect to Gmail mailbox: ' . imap_last_error());
        }
        // Search for unseen emails
        $mail_ids = imap_search($mailbox, 'UNSEEN');
        if ($mail_ids) {
            // Limit the number of emails to be displayed
            $mail_ids = array_slice($mail_ids, -10); // Get the last 10 unseen emails
            // Loop through each unseen email
            foreach ($mail_ids as $mail_id) {
                // Fetch email header
                $header = imap_headerinfo($mailbox, $mail_id);
                // Extract relevant details (e.g., sender, subject, date)
                $from = $header->fromaddress;
                $subject = $header->subject;
                $date = date("Y-m-d H:i:s", strtotime($header->date));
                // Fetch email body
                $body = imap_body($mailbox, $mail_id);
                // Print or process the email details
                echo "<div class='email'>";
                echo "<p><strong>From:</strong> $from </p>";
                echo "<p><strong>Subject:</strong> $subject</p>";
                echo "<p><strong>Date:</strong> $date</p>";
                echo "<div class='email-body'>$body</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No unseen emails.</p>";
        }

        // Close the mailbox connection
        imap_close($mailbox);
        ?>

        <a href="compose.html" class="compose-btn">Compose</a>
        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    </div>

    <script>
        // Add event listener to each email to toggle email body visibility
        const emails = document.querySelectorAll('.email');
        emails.forEach(email => {
            email.addEventListener('click', () => {
                email.querySelector('.email-body').classList.toggle('active');
            });
        });
    </script>
</body>
</html>
