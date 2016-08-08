<?php
	$mailpath = 'C:\xampp\PHPMailer-master\PHPMailer-master';
	$path = get_include_path();
	set_include_path($path . PATH_SEPARATOR . $mailpath);
	require 'PHPMailerAutoload.php';
	#If info is valid (passes js check) and submit button is pressed, insert into DB and send the user an email directing them to the payment link
	if (isset($_POST["Submit"])):
		$db = new mysqli('localhost', 'new_user', '2Te2NDq5sfDwBS6N', 'cs4753_db');
		$query = "INSERT INTO siteusers VALUES ('$_POST[name]', '$_POST[email]', '$_POST[address1]', '$_POST[address2]', '$_POST[city]', '$_POST[state]', '$_POST[zip]')";
		$db->query($query);
		$message = "<font size = 10>Thank you for registering!</font>";
		$mail = new PHPMailer();
		 
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth = true; // enable SMTP authentication
		$mail->SMTPSecure = "tls"; // sets tls authentication
		$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server; or your email service
		$mail->Port = 587; // set the SMTP port for GMAIL server; or your email server port
		//$mail->Username = "email"; // email username
		//$mail->Password = "password"; // email password
		$mail->Username = "caesar.encryptions@gmail.com"; // email username
		$mail->Password = "UVACSROCKS"; // email password
		$mail->IsHTML(true);


		$sender = "cs4501.fall15.assignment2@gmail.com";
		$receiver = $_POST["email"];
		$subj = "Thank you for registering with Caesar Encryptions";
		$msg = "$_POST[name], thank you for registering with Caesar Encryptions! Please visit " . "<a href = localhost/4753/M3/payment.php>this page</a>" . " in order to register payment information.";

		// Put information into the message
		$mail->addAddress($receiver);
		$mail->SetFrom($sender);
		$mail->Subject = "$subj";
		$mail->Body = "$msg";

		// echo 'Everything ok so far' . var_dump($mail);
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		
	endif;

?>

<!DOCTYPE HTML>
<!--
	Halcyonic by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Sign Up</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<script type = "text/javascript">
		//Front end checking of user input
		function check_input() {
			//Error messages initialized
			var mes_name = "";
			var mes_email = "";
			var mes_address = "";
			var mes_city = "";
			var mes_state = "";
			var mes_zip = "";
			//Names format (alphabetical chars only)
			var re = /^[a-zA-Z]+[ ][a-zA-Z]+$/;
			var found = document.getElementById("name").value.match(re);
			if (found == null) {
				mes_name = "Please enter a valid name.\n";				
			}
			//Emails format (char / num @ char / num . char / num)
			var re = /^[a-zA-Z0-9]+[@][a-zA-Z0-9]+[.][a-zA-Z0-9]+$/
			var found = document.getElementById("email").value.match(re);
			if (found == null) {
				mes_email = "Please enter a valid email.\n";
			}
			//City format (alphabetical chars only)
			var re = /^[a-zA-Z]+$/
			var found = document.getElementById("city").value.match(re);
			if (found == null) {
				mes_city = "Please enter a valid city.\n";
			}
			//State format (2 uppercase chars only)
			var re = /^[A-Z]{2}$/
			var found = document.getElementById("state").value.match(re);
			if (found == null) {
				mes_state = "Please enter a valid state.\n";
			}
			//ZIP format (5 numeric chars only)
			var re = /^[0-9]{5}$/
			var found = document.getElementById("zip").value.match(re);
			if (found == null) {
				mes_zip = "Please enter a valid zip.\n";
			}

			var mes = mes_name + mes_email + mes_city + mes_state + mes_zip;
			//If any error messages exist, alert it, prevent DB insertion
			if (mes != "") {
				alert(mes);
				return false;
			}
			
		}
		</script>
	</head>
	<body class="subpage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">
						<div class="row">
							<div class="12u">

								<!-- Logo -->
									<h1><a href="#" id="logo">Caesar Encryptions</a></h1>

								<!-- Nav -->
									<nav id="nav">
										<a href="index.html">Home Page</a>
										
										<a href="aboutus.html">About Us</a>
										
										<a href="#">Sign Up</a>

										<a href="payment.php">Payment</a>
									</nav>

							</div>
						</div>
					</header>
				</div>

			<!-- Content -->
				<div id="content-wrapper">
					<div id="content">
						<div class="container">
							<div class="row">
								<div class="9u 12u(mobile)">

									<!-- Main Content -->
										<section>
											<header>
												<?php if (isset($_POST["Submit"])) { echo $message;}?>

												<?php if (!isset($_POST["Submit"])) { echo "<h2>Sign Up Now</h2>";}?>
												<h3>Starred fields are required</h3>
											</header>
											<form action = "signup.php"
													method = "POST">
											<p>
												*Name:</br> <input type = "textbox" id = "name" name = "name"></input></br>
												<font size = 2>First Last</font>
											</p>
											<p>
												*Email:</br> <input type = "textbox" id = "email" name = "email"></input>
											</p>
											<p>
												*Address 1:</br> <input type = "textbox" id = "address1" name = "address1"></input></br>
												<font size = 2>Street Address, P.O. box</font>
											</p>
											<p>
												Address 2:</br> <input type = "textbox" id = "address2" name = "address2"></input></br>
												<font size = 2>Apartment, Suite, etc.</font>
											</p>
											<p>
												*City:</br> <input type = "textbox" id = "city" name = "city"></input>
											</p>
											<p>
												*State:</br> <input type = "textbox" id = "state" name = "state"></input></br>
												<font size = 2>Two Letter Abbreviation</font>
											</p>
											<p>
												*Zip:</br> <input type = "textbox" id = "zip" name = "zip"></input>
											</p>
											<p><input type = "submit" name = "Submit" onclick = "return check_input()"></input></p>
											</form>
										</section>
										<form action="" method="POST">
										  <!--<script
										    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										    data-key="pk_test_EtC5pVd9qagqujTDT22e0Qrj"
										    data-amount="2000"
										    data-name="Caesar Encryptions"
										    data-description="Subscription ($20.00)"
										    data-image="images/Caesar.png"
										    data-locale="auto">
										  </script>-->
										</form>

								</div>
								<div class="3u 12u(mobile)">

									<!-- Sidebar -->
										<section>
											<header>
												<h2></h2>
											</header>
											<a href="#" class="bordered-feature-image"><img src="images/Caesar.png" alt="" /></a>
										</section>
										
								</div>
							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="8u 12u(mobile)">

								<!-- Links -->
									<section>
										<h2>Links</h2>
										<div>
											<div class="row">
												<div class="3u 12u(mobile)">
													<ul class="link-list last-child">
														<li><a href="index.html">Home Page</a></li>
														<li><a href="aboutus.html">About Us</a></li>
														<li><a href="#">Sign Up</a></li>
														<li><a href="payment.php">Payment</a></li>
														
													</ul>
												</div>
												
												
											</div>
										</div>
									</section>

							</div>
							<div class="4u 12u(mobile)">

								

							</div>
						</div>
					</footer>
				</div>

			<!-- Copyright -->
				<div id="copyright">
					&copy; Untitled. All rights reserved. | Design: <a href="http://html5up.net">HTML5 UP</a>
				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>