<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>404 - Page not found</title>

	<style>
		@import url('https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700');

		.static-full-background {
			background: url('/public/images/404banner.jpg');
			background-size: cover;
			font-family: 'Ubuntu', sans-serif !important;
			font-weight: 400;
			background-attachment: fixed;
			background-repeat: no-repeat;
		}

		.own-img {
			width: 184px;
			margin: 13px 0;
		}

		.content {
			margin-top: 14vh;
		}

		.title-w {
			color: #fff;
		}

		.btn-bg {
			padding-top: 30px;
		}

		.btn-bg a {
			background: #f8c746;
			padding: 11px 22px;
			text-decoration: none;
			color: #000;
			font-weight: 500;
			font-size: 16px;
			text-transform: uppercase;
		}

		.btn-bg a:hover {
			text-decoration: none;
			background: #f8c746;
			color: #fff;
		}

		.pt-10 {
			padding-top: 10px;
		}

		.content h2 {
			font-size: 30px;
			text-transform: uppercase;
			line-height: 20px;
		}

		.content h1 {
			font-size: 33px;
			text-transform: uppercase;
			line-height: 24px;
			color: #f8c746;
		}

		.content h4 {
			font-size: 27px;
			line-height: 0px;
			font-weight: 500;
		}

		@media(max-width:767px) {
			.content h2 {
				line-height: 53px;
			}

			.content h4 {
				line-height: 35px;
			}

			.btn-bg {
				margin-bottom: 33px;
			}

			.content h1 {
				line-height: 30px;
			}
		}

		.t-gray {
			color: #dcd9d9
		}

		.sitelogo img {
			width: 100%;
			max-width: 228px;
			margin-bottom: 5px;
		}
	</style>
</head>

<body class="static-full-background">
	<div class="container">
		<div class="col-md-8">
			<div class="content" align="center">
				<div class="sitelogo">
					<img src="{{ url('/public/images/logo.svg') }}" />
				</div>
				<h2 class="title-w">Sorry! Something went wrong ,Please try again!</h2>
				<img src="{{ url('/public/images/404.png') }}" class="img-responsive own-img" />
				<h1 class="t-gray">Page Not Found.</h1>
				<h4 class="title-w pt-10">Please try one of the following pages </h4>
				<div class="btn-bg">
					<a href="{{ url('admin/dashboard') }}">Go To Dashboard</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>