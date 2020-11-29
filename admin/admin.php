<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if ($user->admin_is_logged_in()) {
	header('Location:index.php');
	
}
//process login form if submitted
if (isset($_POST['submit'])) {
	$adminID = $_POST['email'];
	$password = $_POST['password'];

	if ($user->login_admin($adminID, $password)) {
		$_SESSION['adminID'] = $adminID;
		header('Location:index.php');
	} else {
		$error[] = 'Wrong Username/Password or Password not Set.';
	}
}


//define page title
$title = 'Login';


?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Course Project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
	<link href="../plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../styles/main_styles.css">

</head>

<body>

	<div class="super_container">

		<!-- Register -->

		<div class="register" style="margin-top: 100px;">

			<div class="container-fluid">

				<div class="row row-eq-height">
					<div class="col-lg-6 nopadding">

						<!-- Register -->

						<div class="register_section d-flex flex-column align-items-center justify-content-center">
							<div class="register_content text-center">
								<h1 class="register_title"> Login Area</h1>
								<h3 class="register_title">Admin Login Area</h3>


							</div>
						</div>

					</div>

					<div class="col-lg-6 nopadding">

						<!-- Search -->

						<div class="search_section d-flex flex-column align-items-center justify-content-center">
							<div class="search_content text-center">

								<form name="UsernameLoginForm" id="UsernameLoginForm" role="form" action="" method="post" autocomplete="off">
									<?php
									//check for any errors
									if (isset($error)) {
										foreach ($error as $error) {
											echo '<p class="bg-danger">' . $error . '</p>';
										}
									}

									if (isset($_GET['action'])) {

										//check the action
										switch ($_GET['action']) {
											case 'active':
												echo "<div class='bg-success'>Your account is now active you may now log in.</div>";
												break;
											case 'reset':
												echo "<div class='bg-success'>Please check your inbox for a reset link.</div>";
												break;
											case 'resetAccount':
												echo "<div class='bg-success'>Password changed, you may now login.</div>";
												break;
										}
									}


									?>
									<input id="search_form_name" class="input_field search_form_name" type="email" placeholder="Administrator Email" required="required" data-error="Administrator ID is required." name="email" value="<?php if (isset($error)) {
																																																											echo $_POST['email'];
																																																										} ?>" maxlength="50" tabindex="1">
									<input name="password" id="search_form_category" class="input_field search_form_category" type="password" placeholder="Password" required="required" data-error="Password is required" tabindex="1">
									<button id="search_submit_button" type="submit" class="search_submit_button trans_200" value="Submit" name="submit" value="Login">Login</button>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>