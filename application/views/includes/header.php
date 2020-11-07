<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Employee Management System</title>

	<link rel="stylesheet" href="<?php echo base_url();?>/public/css/bootstrap.min.css" type="text/css"
		media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>/public/css/animate.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>/public/css/styles.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>/public/css/datatables.min.css" type="text/css"
		media="screen" />

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://use.fontawesome.com/releases/v5.11.1/js/all.js"></script>
	<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
	</script>
<style type="text/css">
		.pricing .card {
			border: none;
			border-radius: 1rem;
			transition: all 0.2s;
			box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
		}

		.pricing hr {
			margin: 1.5rem 0;
		}

		.pricing .card-title {
			margin: 0.5rem 0;
			font-size: 0.9rem;
			letter-spacing: .1rem;
			font-weight: bold;
		}

		.fas {
			font-size: 16px;
			color: red;
		}

		.pricing .btn {
			font-size: 80%;
			border-radius: 5rem;
			letter-spacing: .1rem;
			font-weight: bold;
			padding: 1rem;
			opacity: 0.7;
			transition: all 0.2s;
		}

		@-webkit-keyframes slideIn {
			0% {
				-webkit-transform: transform;
				-webkit-opacity: 0;
			}

			100% {
				-webkit-transform: translateY(0);
				-webkit-opacity: 1;
			}

			0% {
				-webkit-transform: translateY(1rem);
				-webkit-opacity: 0;
			}
		}

		.slideIn {
			-webkit-animation-name: slideIn;
			animation-name: slideIn;
		}

		/* Other styles for the page not related to the animated dropdown */

		body {
			background: #007bff;
			background: linear-gradient(to right, #0062E6, #33AEFF);
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}

		/* Hover Effects on Card */

		@media (min-width: 992px) {
			.pricing .card:hover {
				margin-top: -.25rem;
				margin-bottom: .25rem;
				box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
			}

			.pricing .card:hover .btn {
				opacity: 1;
			}
		}

	</style>
</head>

<body
	style="width:100%; height:100%; background-image: url('<?php echo base_url();?>/public/images/manager.jpg'); background-repeat:no-repeat;background-size:cover;">
	<div class="container"> 
