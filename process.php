<?php
  session_start();

  require_once 'php_mailer_lib/PHPMailerAutoload.php';

  $errors = [];
  $success = "Your message has been successfully sent!";

  // Check to see if data has been submitted
  if (isset($_POST['your_name'], $_POST['email'], $_POST['message'])) {
    $fields = [
      'name' => $_POST['your_name'],
      'email' => $_POST['email'],
      'message' => $_POST['message']
    ];

    foreach ($fields as $field => $data) {
      if (empty($data)) {
        $errors[] = "The " . $field . " is required.";
      }
    }
    // If not errors, send email
      if(empty($errors)){
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        // Connect to SMTP server
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'powerof4devs@gmail.com';
        $mail->Password = 'LadiesWhoCode';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // In order to send data in html
        $mail->isHTML();

        $mail->Subject = "Contact form Submitted";
        $mail->Body = 'From: ' . $fields['name'] . '(' .$fields['email'] . ')<p>' . $fields['message'] . '</p>';

        $mail->FromName = 'Contact';

        $mail->AddReplyTo($fields['email'], $fields['name']);

        // Email adress to send email to
        $mail->AddAddress('powerof4devs@gmail.com', 'Power of 4');

        if ($mail->send()) {
          $_SESSION['success'] = $success; 
          header('Location: contact.php');
          die();
        }else{
          $errors[] = "Sorry, could not send the email. Try again later.";
        }

      }

  }else{
    $errors[] = "Something went wrong";
  }

  // Store errors in session variable to have access to it on contact.php page
  $_SESSION['errors'] = $errors;
  $_SESSION['fields'] = $fields;


  header("Location: contact.php");
 ?>
