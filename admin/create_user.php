<?php require('includes/config.php');



//if form has been submitted process it
if (isset($_POST['submit'])) {

  //very basic validation

  if (strlen($_POST['password']) < 3) {
    $error[] = 'Password is too short.';
  }

  //email validation
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $error[] = 'Please enter a valid email address';
  } else {
    $stmt = $db->prepare('SELECT email FROM chairman WHERE email = :email');
    $stmt->execute(array(':email' => $_POST['email']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($row['email'])) {
      $error[] = 'Email provided is already in use.';
    }
  }
 

  //if no errors  created carry on
  if (!isset($error)) {
    

    //hash the password
    $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

    //create the activasion code
    $activasion = md5(uniqid(rand(), true));

    try {

      //insert into database with a prepared statement
      $stmt = $db->prepare('INSERT INTO admin (user_type,fullName,password,adminID) VALUES (:userType,:fullName,:password,:adminID)');
      $stmt->execute(array(
        ':userType' => $_POST['userType'],
        ':fullName' => $_POST['fullName'],
        ':password' => $hashedpassword,
        ':adminID' => $_POST['email'],
        

      ));
      $id = $db->lastInsertId('memberID');

      //redirect to index page
      header('Location: create_user.php?action=joined');
      exit;



      //else catch the exception and show the error.
    } catch (PDOException $e) {
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
  <link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
  <link href="../plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/animate.css">
  <link rel="stylesheet" type="text/css" href="../styles/main_styles.css">
  <link rel="stylesheet" type="text/css" href="../styles/elements_styles.css">
  <link rel="stylesheet" type="text/css" href="../styles/responsive.css">
  <script type="text/javascript" language="JavaScript">
    // Password check
    $.validator.addMethod("pwcheck", function(value) {
      return /[a-z]/.test(value) && /[0-9]/.test(value) && /[A-Z]/.test(value)
    });



    $(function() {

      $("#RegisterForm").validate({
        ignore: ".ignore",

        invalidHandler: function() {
          $('html, body').animate({
            scrollTop: $("#RegisterForm").offset().top // scroll top to your form on error
          }, 'slow');
        },
        // Specify the validation rules
        rules: {
          username: {
            required: true,
            minlength: 6,
          },
          email: {
            required: true,
            email: true,
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
            required: function() {
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
            window.location.replace = 'login_student.php'; // Add your custom form submitted redirect page
          }

        },
      });

    });
  </script>
</head>

<body>
  <?php include('includes/navbar.php'); ?>

  <div class="super_container" style="margin-top: 50px;">



    <div class="row row-eq-height" id="register">

      <div class="col-lg-8" style="margin: 45px 20% 45px 20%;">

        <!-- Register -->

        <div class="register_section d-flex flex-column align-items-center justify-content-center">
          <div class="register_content text-center">
            <h1 class="register_title"> Admin</h1>
            <h3 class="register_title">Cluster Chairman Registration</h3>

            <div>



              <form name="RegisterForm" id="RegisterForm" target="_blank" role="form" action="" method="post" autocomplete="off">
                <?php
                //check for any errors
                if (isset($error)) {
                  foreach ($error as $error) {
                    echo '<p class="btn-danger">' . $error . '</p>';
                  }
                }

                //if action is joined show sucess
                if (isset($_GET['action']) && $_GET['action'] == 'joined') {
                  echo "<p class='btn-success'>Registration successful.<p><br>";
                }
                ?>
                
                
                  <div class="register_content text-center"><select class='input_field' type="text" name="userType">
                      <option value="" disabled selected hidden>User Type</option>
                      <option value="NormalUser">Normal User</option>
                      <option value="Admin">Admin</option>
                    </select></div>
                </div>
                <div class="register_content text-center"> <i class="glyphicon glyphicon-user"></i></span>
                  <input name="fullName" id="username" type="text" placeholder="Full Name" class="input_field search_form_name" maxlength="50" value="<?php if (isset($error)) {
                                                                                                                                                        echo $_POST['fullName'];
                                                                                                                                                      } ?>"><br><br>


                </div>

                


                <div class="register_content text-center"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input type="email" name="email" id="email" placeholder="Email" class="input_field search_form_name" maxlength="100" value="<?php if (isset($error)) {
                                                                                                                                                echo $_POST['email'];
                                                                                                                                              } ?>"><br><br>


                </div>


                <div class="register_content text-center"> <i class="glyphicon glyphicon-lock"></i></span>
                  <input name="password" id="password" placeholder="Enter Password" class="input_field search_form_name" maxlength="20" type="password"><br><br>

                </div>



                <div class="register_content text-center">

                  <input type="submit" name="submit" value="Register" class="btn form-control btn-success"><br><br>


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

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="styles/bootstrap4/popper.js"></script>
  <script src="styles/bootstrap4/bootstrap.min.js"></script>
  <script src="plugins/greensock/TweenMax.min.js"></script>
  <script src="plugins/greensock/TimelineMax.min.js"></script>
  <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
  <script src="plugins/greensock/animation.gsap.min.js"></script>
  <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
  <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
  <script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
  <script src="plugins/easing/easing.js"></script>
  <script src="js/custom.js"></script>

</body>

</html>