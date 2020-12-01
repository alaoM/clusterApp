<?php
ob_start();

session_start();
//set timezone
date_default_timezone_set('Europe/London'); // You can change this to you time zone

//database credentials
define('DBHOST','localhost');        // This should work if not try ip website address or define path to your database
define('DBUSER','zetharsk_import'); // Database username most often with the database prefix_username if not try username
define('DBPASS','gg2m+8:8MCsMY3');        // Database Password
define('DBNAME', 'zetharsk_import');   // Database name most often with the database prefix_databasename if not try databasename



//database credentials
//define('DBHOST','localhost');        // This should work if not try ip website address or define path to your database
//define('DBUSER','root'); // Database username most often with the database prefix_username if not try username
//define('DBPASS','');        // Database Password
//define('DBNAME', 'import_csv');   // Database name most often with the database prefix_databasename if not try databasename



try {

	//create PDO connection
	$db2 = mysqli_connect("localhost", "zetharsk_import", "gg2m+8:8MCsMY3", "zetharsk_import");
	//$db2 = mysqli_connect("localhost", "root", "", "import_csv");
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}
//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);

?>
