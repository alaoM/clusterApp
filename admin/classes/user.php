<?php
include('password.php');
class User extends Password{

    private $_db;

    function __construct($db){
    	parent::__construct();

    	$this->_db = $db;
    }

	private function get_user_hash($adminID){

		try {
			$stmt = $this->_db->prepare('SELECT * FROM admin WHERE adminID = :adminID AND user_Type = "Admin"');
			$stmt->execute(array('adminID' => $adminID));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	
	public function login_admin($adminID,$password){

		$row = $this->get_user_hash($adminID);

		if($this->password_verify($password,$row['password']) == 1){
			$_SESSION['AdminLoggedIn'] = true;
		    $_SESSION['adminID'] = $row['adminID'];
		   /*  $_SESSION['userType'] = $row['user_type']; */
		    return true;
		}
	}

	public function logout(){
		session_destroy();
	}
//admin Session
public function admin_is_logged_in(){
	if(isset($_SESSION['adminID']) && $_SESSION['AdminLoggedIn'] == true){
		return true;
	}
	
}

}
