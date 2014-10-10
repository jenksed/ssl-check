<?php

// Define the Domain to check and the email address to notify of problems
$domain = 'ENTER_DOMAIN HERE'; // https:// automatically added
$to = 'ENTER_EMAIL_HERE';  // Where would you like to receive notifications?

// Create a curl hand to a non-existing location
$ch = curl_init('https://' . $domain);

// Execute
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);

// Check if any error occurred
if(curl_errno($ch))
{
   // Save output of error
   $curlerror =  curl_error($ch);
   
   // Begin building the email notification added random Error ID to stop Google from trimming like messages.
   $subject = $curlerror;
   $message = "SSLCheck Report for " . $domain . " \r\n ==================\r\n" . $curlerror . "\r\n\r\n Test Completed on: " . date(DATE_RFC2822);

    // Send notification
    mail($to, $subject, $message); 
}
else
{
   $subject = "SSLCheck report passed for " . $domain;
   $message = "SSLCheck Report for " . $domain . " \r\n ==================\r\n Passed! \r\n\r\n Test Completed on: " . date(DATE_RFC2822);
   mail($to, $subject, $message);
}

// Close handle
curl_close($ch);
?>
