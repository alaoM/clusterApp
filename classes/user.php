<?php
include('password.php');
class User extends Password{

    private $_db;

    function __construct($db){
    	parent::__construct();

    	$this->_db = $db;
    }

	private function get_user_hash($email, $clusterCode){

		try {
			$stmt = $this->_db->prepare('SELECT * FROM chairman WHERE email = :email AND clusterCode = :clusterCode ');
			$stmt->execute(array('email' => $email, 'clusterCode' => $clusterCode));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function login($email,$password,$clusterCode){

		$row = $this->get_user_hash($email, $clusterCode);

		if($this->password_verify($password,$row['password']) == 1){

		    $_SESSION['UserLoggedin'] = true;
		    $_SESSION['email'] = $row['email'];
		 	$_SESSION['clusterCode'] = $row['clusterCode'];
		    return true;
		}
	}
	
	public function logout(){
		session_destroy();
	}
//normal user session
	public function is_logged_in(){
		
		if(isset($_SESSION['UserLoggedin']) && $_SESSION['UserLoggedin'] == true){
			return true;
		}
	}
}


?>
