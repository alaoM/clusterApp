<?php
include('includes/config.php');
error_reporting();
$error[] = "";
//if user is not logged in, proceed to login page
if (!$user->admin_is_logged_in()) {
    header('Location: admin.php');
}



if (isset($_POST['update'])) {

    $BVN = $_POST['BVN'];
    $BankName = $_POST['BankName'];
    $AccountNumber = $_POST['AccountNumber'];


    $ret = mysqli_query($db2, "UPDATE chairman set BVN='$BVN',BankName='$BankName', AccountNumber='$AccountNumber', WHERE BVN = '$BVN' ");
    if ($ret)
        $error[] = "Record updated Successfully !!";

    else {
        $error[] = "Unsuccessful Update, No BVN Record Found";
    }
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

    <?php include('includes/navbar.php'); ?>

    <!-- Register -->

    <div class="register" style="margin-top: 150px;">

        <div class="container-fluid">

            <div class="row row-eq-height" ;>
                <div class="col-lg-6 nopadding">

                    <!-- Register -->


                    <div class="register_section d-flex flex-column align-items-center justify-content-center">
                        <div class="search_background" style="background-image:url(../images/search_background.jpg);"></div>
                        <div class="register_content text-center">
                            <h2>Update Incomplete Profile Here</h2>
                            <font class="btn-success" align="center"><?php if (isset($error)) {
                                                                            foreach ($error as $error) {
                                                                                echo '<p class="btn-danger">' . $error . '</p>';
                                                                            }
                                                                        }
                                                                        ?><?php echo ($error = ""); ?></font>


                        </div>
                    </div>

                </div>

                <div class="col-lg-6 nopadding">

                    <div class="search_section d-flex flex-column align-items-center justify-content-center">
                        <div class="search_content text-center">
                            <!-- firm starts here -->
                            <form method="post" autocomplete="off" enctype="multipart/form-data" action="">


                                <input id="search_form_name" class="input_field search_form_name" type="text" placeholder="Bank Verification Number" required="required" name="BVN" value="" maxlength="11">
                                <!-- BANK NAME -->
                                <select class="input_field search_form_name" id="bank" name="BankName">
                                    <option selected>Select Bank</option>
                                    <option value="access">Access Bank</option>
                                    <option value="citibank">Citibank</option>
                                    <option value="diamond">Diamond Bank</option>
                                    <option value="ecobank">Ecobank</option>
                                    <option value="fidelity">Fidelity Bank</option>
                                    <option value="firstbank">First Bank</option>
                                    <option value="fcmb">First City Monument Bank (FCMB)</option>
                                    <option value="gtb">Guaranty Trust Bank (GTB)</option>
                                    <option value="heritage">Heritage Bank</option>
                                    <option value="keystone">Keystone Bank</option>
                                    <option value="polaris">Polaris Bank</option>
                                    <option value="providus">Providus Bank</option>
                                    <option value="stanbic">Stanbic IBTC Bank</option>
                                    <option value="standard">Standard Chartered Bank</option>
                                    <option value="sterling">Sterling Bank</option>
                                    <option value="suntrust">Suntrust Bank</option>
                                    <option value="union">Union Bank</option>
                                    <option value="uba">United Bank for Africa (UBA)</option>
                                    <option value="unity">Unity Bank</option>
                                    <option value="wema">Wema Bank</option>
                                    <option value="zenith">Zenith Bank</option>
                                </select>
                                <!--ACCOUNT NUMBER -->
                                <input id="search_form_name" class="input_field search_form_name" type="text" placeholder="Account Number" required="required" name="AccountNumber" value="" maxlength="10">

                                <button id="search_submit_button" type="submit" class="search_submit_button trans_200" value="update" name="update" tabindex="1">Update</button>


                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>

}
?>