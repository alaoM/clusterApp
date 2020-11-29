<?php require('includes/config.php');



//if form has been submitted process it
if(isset($_POST['submit'])){

  //very basic validation


  if(strlen($_POST['password']) < 3){
    $error[] = 'Password is too short.';
  }

  if(strlen($_POST['passwordConfirm']) < 3){
    $error[] = 'Confirm password is too short.';
  }

  if($_POST['password'] != $_POST['passwordConfirm']){
    $error[] = 'Passwords do not match.';
  }

  
  //email validation
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $error[] = 'Please enter a valid email address';
  } else {
    $stmt = $db->prepare('SELECT email FROM chairman WHERE email = :email');
    $stmt->execute(array(':email' => $_POST['email']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($row['email'])){
      $error[] = 'Email does not exist.';
    }

  }

  //if no errors have been created carry on
  if(!isset($error)){

    //hash the password
    $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

    //create the activasion code
    $activasion = md5(uniqid(rand(),true));

    try {

      //insert into database with a prepared statement
      $stmt = $db->prepare('UPDATE chairman SET password = :password WHERE email= :email');
      $stmt->execute(array(
        
        
        ':password' => $hashedpassword,
        ':email' => $_POST['email'],
        
      ));
      $id = $db->lastInsertId('memberID');

      

      //redirect to index page
      header('Location: resetpassword.php?action=Updated');
      exit;

    //else catch the exception and show the error.
    } catch(PDOException $e) {
        $error[] = $e->getMessage();
    }

  }

}

//define page title
$title = 'Register';


?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Course</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Course Project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/elements_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<script type="text/javascript" language="JavaScript">

// Password check
$.validator.addMethod("pwcheck", function (value) {    
    return /[a-z]/.test(value) && /[0-9]/.test(value) && /[A-Z]/.test(value)
});



$(function () {
   
$("#RegisterForm").validate({
        ignore: ".ignore",
    
        invalidHandler : function() {
            $('html, body').animate({
                scrollTop: $("#RegisterForm").offset().top // scroll top to your form on error
            }, 'slow' );
        },
        // Specify the validation rules
        rules: {
           username: { 
                required: true,
        minlength: 6,
            },
      email: { 
                required: true,
        email:true,
            },
            password: {
                required: true,
        minlength: 8,
        pwcheck: true,
            },
      passwordConfirm: { 
                required: true,
        equalTo: "#password",
            },
      hiddenRecaptcha: {
                required: function () {
                if (grecaptcha.getResponse() == '') {
                     return true;
                } else {
                     return false;
          }
        }       
           },
       },

        // Specify the validation error messages
        messages: {
            username: {
                required: "Please enter username",
            },
      email: {
                required: "Please enter email",
            },
            password: {
                required: "Password required",
        minlength: "Minumum length 8",
        pwcheck: "1 upper/lower case &amp; number required"
            },
      passwordConfirm: {
                required: "Please confirm password",
        equalTo: "Passwords do not match"
            },
     
      submitHandler: function(form) // CALLED ON SUCCESSFUL VALIDATION
      // Redirect can be removed from here
                {
                window.location.replace='login.php'; // Add your custom form submitted redirect page
      }
      
        },
   });

});

</script>
</head>
<body>

<div class="super_container">


	<!-- Header -->


<div class="row row-eq-height" id="registerCourses">

				<div class="col-lg-8" style="margin: 0 20% 0 20%;">
				
				<!-- Register -->

					<div class="register_section d-flex flex-column align-items-center justify-content-center">
						<div class="register_content text-center">
							<h1 class="register_title">Update / Reset Password</h1>
							
							<div>
								

												
					    <form name="RegisterForm" id="RegisterForm" target = "_blank" role="form" action="" method="post" autocomplete="off">
					        <?php
					       //check for any errors
					     if(isset($error)){
					           foreach($error as $error){
					             echo '<p class="btn-danger">'.$error.'</p>';
					           }
					       }

					       //if action is joined show sucess
					       if(isset($_GET['action']) && $_GET['action'] == 'Updated'){
					           echo "<p class='btn-success'>Password Updates Successfully, Please proceed to login<p><br>";
					       }
					    ?>
              
					    


						<div class="register_content text-center"><i class="glyphicon glyphicon-envelope"></i></span>
			              <input type="email" name="email" id="email" placeholder="Enter Email"  class="input_field search_form_name" maxlength="100" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2"><br><br>


			            </div>


			            <div class="register_content text-center"> <i class="glyphicon glyphicon-lock"></i></span>
			              <input name="password" id="password" placeholder="Enter Password" class="input_field search_form_name" maxlength="20" type="password" tabindex="3"><br><br>

			            </div>

			             <div class="register_content text-center"> <i class="glyphicon glyphicon-lock"></i></span>
			              <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Re-Enter Password" maxlength="20"class="input_field search_form_name" tabindex="4"><br><br>

			            </div>

			            <div class="register_content text-center">
				         
				          <input type="submit" name="submit" value="Register"class="btn form-control btn-success" ><br><br>

				          <div class="btn form-control btn-danger"><a href="login.php">Login</a></div>
				        </div>

					       
					    </form>
							
						</div>
						</div>
						

						</div>
					</div>

				</div>
			</div>
	<!-- footer ends here -->
</div>



</body>
</html>