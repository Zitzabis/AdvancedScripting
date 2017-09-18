<?php
    $to      = 'stephen_png@yahoo.com.au';
    $subject = 'the subject';
    $message = 'hello';
    $headers = 'From: webmaster@zitzasoft.com' . "\r\n" .
        'Reply-To: webmaster@zitzasoft.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    mail($to, $subject, $message, $headers);

    header( 'Location: index.php' ) ;
?>