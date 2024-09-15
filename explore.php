<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// Function to generate the daily progress report in HTML
function generateDailyReport() {
    $urls=[
        "https://docs.google.com/spreadsheets/d/1V-b8VOFD23lmlTdKhNH5RqZuDaioBmsJbQuaRjJ4VIE/edit?gid=240721194#gid=240721194",
        "https://docs.google.com/spreadsheets/d/1Xfy-TLhMc8Faf4urLY7cujWQfVM1gONuCtqmcFJEWfQ/edit?gid=0#gid=0"

    ];
    $items = [
        "▲Shopify Sales Sheet update: ". $urls[0],
        "▲Inventory Details For Accessories: ". $urls[1],
    ];
    $listItems = "";
    foreach ($items as $item) {
        $listItems .= "<li>$item</li>";
    }
    $report = "<html>
                <body>
                   Hey Ujjwal, Update the details for the following.
                    <p>List mentioned below:</p>
                    <ul>
                        $listItems
                    </ul>
                    <br/>
                    <p>Grateful</p>
                    <p>U·</p>
                </body>
            </html>";
    return $report;
}





                    
try {
    //Server settings                               
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = getenv('EMAIL_USER');
    $mail->Password = getenv('EMAIL_PASSWORD');                           
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;                                   

    //Recipients
    $mail->setFrom(getenv('EMAIL_USER'), 'Ujjwal');
    $mail->addAddress("ujjwal@unforus.com");
    


    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = "We are going here, this week!";
    $mail->Body    = generateDailyReport();

    $mail->send();
    echo 'Message has been sent';
    // close the script
    exit();
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    exit();
}