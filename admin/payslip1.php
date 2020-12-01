<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
// if ($user->admin_is_logged_in()) {
// 	header('Location:index.php');

// }
//process login form if submitted
if (isset($_POST['generate'])) {
    $state = $_POST['state'];
    $query = "SELECT *,banklog.BankName  FROM users INNER JOIN banklog ON users.BankName = banklog.BankName WHERE users.state='" . $state . "'";
             $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $_SESSION['state'] = $row['state'];
            echo $_SESSION['state'];
}

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
                                <h1 class="register_title"> Payslip</h1>
                                <h3 class="register_title">Generate Payslip based on State</h3>


                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 nopadding">

                        <!-- Search -->

                        <div class="search_section d-flex flex-column align-items-center justify-content-center">
                            <div class="search_content text-center">

                                <form name="UsernameLoginForm" id="UsernameLoginForm" role="form" action="" method="post" autocomplete="off">

                                    <select name="state" class="form-control input-sm">
                                        <option disabled selected>-- Select State --</option>
                                        <option value="Abia">Abia</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="Akwa Ibom">Akwa Ibom</option>
                                        <option value="Anambra">Anambra</option>
                                        <option value="Bauchi">Bauchi</option>
                                        <option value="Bayelsa">Bayelsa</option>
                                        <option value="Benue">Benue</option>
                                        <option value="Borno">Borno</option>
                                        <option value="Cross Rive">Cross River</option>
                                        <option value="Delta">Delta</option>
                                        <option value="Ebonyi">Ebonyi</option>
                                        <option value="Edo">Edo</option>
                                        <option value="Ekiti">Ekiti</option>
                                        <option value="Enugu">Enugu</option>
                                        <option value="FCT">Federal Capital Territory</option>
                                        <option value="Gombe">Gombe</option>
                                        <option value="Imo">Imo</option>
                                        <option value="Jigawa">Jigawa</option>
                                        <option value="Kaduna">Kaduna</option>
                                        <option value="Kano">Kano</option>
                                        <option value="Katsina">Katsina</option>
                                        <option value="Kebbi">Kebbi</option>
                                        <option value="Kogi">Kogi</option>
                                        <option value="Kwara">Kwara</option>
                                        <option value="Lagos">Lagos</option>
                                        <option value="Nasarawa">Nasarawa</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Ogun">Ogun</option>
                                        <option value="Ondo">Ondo</option>
                                        <option value="Osun">Osun</option>
                                        <option value="Oyo">Oyo</option>
                                        <option value="Plateau">Plateau</option>
                                        <option value="Rivers">Rivers</option>
                                        <option value="Sokoto">Sokoto</option>
                                        <option value="Taraba">Taraba</option>
                                        <option value="Yobe">Yobe</option>
                                        <option value="Zamfara">Zamfara</option>
                                    </select>
                                    <input type="submit" name="generate" value="Generate" class="search_submit_button trans_200" />
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