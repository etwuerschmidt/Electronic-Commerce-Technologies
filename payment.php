<?php
	require 'C:\xampp\php\stripe-php-3.4.0/init.php';
	\Stripe\Stripe::setApiKey("sk_test_aAszwx80URy64Jg6rVywl8p9");

	// Get the credit card details submitted by the form
	if (isset($_POST['stripeToken'])):
		$token = $_POST['stripeToken'];
	endif;

	// Create the charge on Stripe's servers - this will charge the user's card
	if (isset($token)):
		try {
	  	$charge = \Stripe\Charge::create(array(
	    	"amount" => 2000, // amount in cents, again
	    	"currency" => "usd",
	    	"source" => $token,
	    	"description" => "Example charge"
	    	));
	  		$message = "<h2>Payment has been successfully processed!<h2>";
		} catch(\Stripe\Error\Card $e) {
	  	// The card has been declined
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
		<title>Payment Processing</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
										
										<a href="signup.php">Sign Up</a>

										<a href="#">Payment</a>
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
												<?php if (isset($_POST["stripeToken"])) { echo $message;}?>

												<?php if (!isset($_POST["stripeToken"])) { echo "<h2>Payment Processing</h2>";}?>
												<h3>Standard Fee: $20.00</h3>
											</header>
										
											
											<script type="text/javascript">
											  // This identifies your website in the createToken call below
											  Stripe.setPublishableKey('pk_test_EtC5pVd9qagqujTDT22e0Qrj');
											  // ...

											  function stripeResponseHandler(status, response) {
											    var $form = $('#payment-form');

											    if (response.error) {
											      // Show the errors on the form
											      $form.find('.payment-errors').text(response.error.message);
											      $form.find('button').prop('disabled', false);
											    } else {
											      // response contains id and card, which contains additional card details
											      var token = response.id;
											      // Insert the token into the form so it gets submitted to the server
											      $form.append($('<input type="hidden" name="stripeToken" />').val(token));
											      // and submit
											      $form.get(0).submit();
											    }
											  };

											  jQuery(function($) {
											    $('#payment-form').submit(function(event) {
											      var $form = $(this);

											      // Disable the submit button to prevent repeated clicks
											      $form.find('button').prop('disabled', true);

											      Stripe.card.createToken($form, stripeResponseHandler);

											      // Prevent the form from submitting with the default action
											      return false;
											    });
											  });

											  
											</script>

											<form action="" method="POST" id="payment-form">
											  <span class="payment-errors"></span>

											  <div class="form-row">
											    <label>
											      <span>Card Number:</span></br>
											      <input type="text" size="20" data-stripe="number"/>
											    </label>
											  </div></br>

											  <div class="form-row">
											    <label>
											      <span>CVC:</span></br>
											      <input type="text" size="4" data-stripe="cvc"/>
											    </label>
											  </div></br>

											  <div class="form-row">
											    <label>
											      <span>Expiration (MM/YY):</span></br>
											      <input type="text" size="2" data-stripe="exp-month"/>
											    </label>
											    <span> / </span>
											    <input type="text" size="4" data-stripe="exp-year"/>
											  </div></br>

											  <input type="submit" value = "Submit Payment">
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
														<li><a href="signup.php">Sign Up</a></li>
														<li><a href="#">Payment</a></li>
														
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