<?php
include('includes/config.php');
error_reporting();
//if user is not logged in, proceed to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 


if (isset($_POST['submit'])) {

    //very basic validation

    if (strlen($_POST['BVN']) < 11) {
        $error[] = 'BVN is too short.';
    } else {
        $stmt = $db->prepare('SELECT BVN FROM users WHERE BVN = :BVN');
        $stmt->execute(array(':BVN' => $_POST['BVN']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($row['BVN'])) {
            $error[] = 'BVN already provided.';
        }
    }
    if (strlen($_POST['clusterCode']) == ''){
        $error[] = 'Cluster Code is required';
    }
    //if no errors have been created carry on
    if (!isset($error)) {


        try {

            //insert into database with a prepared statement
            $stmt = $db->prepare('INSERT INTO users (fullName,Age,Gender,BankName,AccountNumber, BVN,clusterCode, PhoneNumber, Town, Project,Amount) VALUES (:fullName,:Age,:Gender,:BankName,:AccountNumber, :BVN,:clusterCode, :PhoneNumber, :Town, :Project,:Amount)');
            $stmt->execute(array(

                ':fullName' => $_POST['fullName'],
                ':Age' => $_POST['Age'],
                ':Gender' => $_POST['Gender'],
                ':BankName' => $_POST['BankName'],
                ':AccountNumber' => $_POST['AccountNumber'],
                ':BVN' => $_POST['BVN'],
                ':clusterCode' => $_POST['clusterCode'],
                ':PhoneNumber' => $_POST['PhoneNumber'],
                ':Town' => $_POST['Town'],
                ':Project' => $_POST['Project'],
                ':Amount' => $_POST['Amount'],

            ));

            $id = $db->lastInsertId('id');
            //else catch the exception and show the error.
            //redirect to upload page
            header('Location: upload_single.php?action=Sucessful');
            exit;

        } catch (PDOException $e) {
            $error[] = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <script src="jquery-3.2.1.min.js"></script>

    <style>
        body {
            font-family: Arial;
            width: 550px;
            margin: 0 30% 0 30%
            
        }
        .outer-container {
            background: #F0F0F0;
            border: #e0dfdf 1px solid;
            padding: 40px 20px;
            border-radius: 2px;
        }
        .container{
            height: 80px;

        }

        .btn-submit {
            background: #ffb606;
            border: #ffb606 1px solid;
            border-radius: 2px;
            color: #FFFFFF;
            cursor: pointer;
            padding: 5px 20px;
            font-size: 0.9em;
        }

        .btn-submit2 {
            width: 100%;
            height: 48px;
            background: #ffb606;
            color: #FFFFFF;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 700;
            margin-top: 28px;
            border: none;
            cursor: pointer;
        }

        .tutorial-table {
            margin-top: 40px;
            font-size: 0.8em;
            border-collapse: collapse;
            width: 100%;
        }

        .tutorial-table th {
            background: #f0f0f0;
            border-bottom: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .tutorial-table td {
            background: #FFF;
            border-bottom: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .search_form {
            margin-top: 57px;
        }

        .input_field {
            width: 100%;
            height: 42px;
            background: #FFFFFF;
            box-sizing: border-box;
            border: solid 2px #FFFFFF;
            padding-left: 25px;
            margin-bottom: 24px;
        }

        #response {
            padding: 10px;
            margin-top: 10px;
            border-radius: 2px;
            display: none;
        }

        .success {
            background: #c7efd9;
            border: #bbe2cd 1px solid;
        }

        .error {
            background: #fbcfcf;
            border: #f3c6c7 1px solid;
        }

        div#response.display-block {
            display: block;
        }
    </style>

</head>

<body>


<div class="container">
<?php include('includes/navbar.html'); ?>
</div> 
   
        

    

    <div class="outer-container">
    <h2 style="padding-left: 100px; padding-bottom:30px;">Import Single Record</h2>
         <?php
					       //check for any errors
					     if(isset($error)){
					           foreach($error as $error){
					             echo '<p  style="font-size: 20; color:red" font-size:20" class="btn-danger">'.$error.'</p>';
					           }
					       }

					       //if action is joined show sucess
					       if(isset($_GET['action']) && $_GET['action'] == 'Sucessful'){
					           echo '<p  style="font-size: 20; color:green" class="btn-success">Upload Successful.<p><br>';
					       }
					    ?>

        <form id="search_form" class="search_form" method="post" action="" name="registration">
            <div><input  class='input_field' type="text" placeholder="Full Name" name="fullName"></div>
            <div><input class='input_field' type="text" placeholder="Age" name="Age"></div>
            <div><select class='input_field' type="text" name="Gender">
                    <option value="" disabled selected hidden>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select></div>
            <div><input class='input_field' type="text" placeholder="Bank Name" name="BankName"></div>
            <div><input class='input_field' type="text" placeholder="Bank Account Numnber" name="AccountNumber" maxlength="10"></div>
            <div><input class='input_field' type="text" placeholder="Bank Verification Number" name="BVN" required="required"  maxlength="11"></div>
            <div><input class='input_field' type="text" placeholder="Cluster Code" name="clusterCode" required="required"></div>
            <div><input class='input_field' type="text" placeholder="Phone Number" name="PhoneNumber"></div>
            <div><input class='input_field' type="text" placeholder="Town" name="Town"></div>
            <div><input class='input_field' type="text" placeholder="Project" name="Project"></div>
            <div><input class='input_field' type="text" placeholder="Amount" name="Amount"></div>
            <button type="submit" id="submit" name="submit" class="btn-submit2">Submit</button>

        </form>

    </div>



</body>

</html>