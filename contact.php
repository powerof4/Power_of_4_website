<?php
	session_start();

	// if session errors is set, assign $errors to session errors otherwise set $errors to empty array
	$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
	$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];
	$success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Power of 4</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/master.css" media="screen" title="masterCSS">
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" ></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Navbar -->
	<nav class="navbar navbar-toggleable-md navbar navbar-inverse bg-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">
  	<img src="images/Logo.png" alt="Power of 4 Logo" id="our_logo">
  </a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="po4.html">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Get in Touch<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<!-- Form -->
<div class="cover-container">
    <div class="inner cover">
      <div class ="container form-background">
				<!-- If success is not empty, display success message. -->
				<?php if(!empty($success)): ?>
						<div class="container">
							<p id="success_msg"><?php echo $success; ?></p>
						</div>
					<?php endif; ?>
        <p class="contact-header">We'd Love To Hear From You!</p>

					<?php if(!empty($errors)): ?>
						<div class="form_errors">
							<!-- PHP function implode takes an array that takes an array to a string -->
							<ul><li><?php echo implode('</li><li>', $errors); ?></li></ul>
						</div>
				  <?php endif; ?>

          <form class="form-position" method="post" action="process.php">
            <div class="form-group row">
              <label for="name" class="col-form-label">Name</label>
							<!-- if the field is set with data, keep the data, if not, set it to blank -->
              <input type="text" class="form-control" id="name" placeholder="Your Name" name="your_name" <?php echo isset($fields['name']) ? 'value="' . $fields['name'] . ' " ' : '' ?>>
            </div>
            <div class="form-group row">
              <label for="email" class= "col-form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Your Email" name="email" <?php echo isset($fields['email']) ? 'value="' . $fields['email'] . ' " ' : '' ?>>
            </div>
             <!-- Don't think this is needed since subject is sent via email.

						 <div class="form-group row">
              <label for="subject" class= "col-form-label">Subject</label>
              <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject">
            </div> -->
            <div class="form-group row">
              <label for="message">Message</label>
              <textarea class="form-control" id="message" rows="5" name="message" <?php echo isset($fields['message']) ? $fields['message'] : '' ?>></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </form>
      </div>
    </div>
  </div>

</body>
</html>

<?php
	// Unset session errors to remove info user may have put in there before
	unset($_SESSION['errors']);
	unset($_SESSION['fields']);
	unset($_SESSION['success']);
 ?>
