<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
// Your Gmail IMAP server settings
$server = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = ' kaushik.salunke09@gmail.com '; // Update with your Gmail address
$password = 'mgktqhohirrlkayk'; // Update with your Gmail app password
// Attempt to connect to Gmail IMAP server
$mailbox = imap_open($server, $username, $password);
if (!$mailbox) {
die('Cannot connect to Gmail mailbox: ' . imap_last_error());
}
// Search for unread emails
$mail_ids = imap_search($mailbox, 'ALL');
// $mail_ids = imap_search($mailbox, 'ALL', SE_UID, 'UTF-8', 'DATE', 'DESC');
if ($mail_ids) {
// Loop through each unread email
echo "<h1>Mail Inbox</h1>";
foreach ($mail_ids as $mail_id) {
// Fetch email header
$header = imap_headerinfo($mailbox, $mail_id);
// Extract relevant details (e.g., sender, subject, date)
$from = $header->fromaddress;
$subject = $header->subject;
$date = date("Y-m-d H:i:s", strtotime($header->date));
// Print or process the email details
echo "<a href=''>From: $from ";
echo "Subject: $subject";
echo "Date: $date</a><br><br>";
// Retrieve email body (optional)
$body = imap_body($mailbox, $mail_id);
// Print or process the email body
echo "Body: $body<br>";
// Additional processing as needed
}
} else {
echo "No new emails found.";
}

// Close the mailbox connection
imap_close($mailbox);
?>