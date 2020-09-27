<?php 

include 'includes/db.php';
session_start();

error_reporting(E_ALL ^ E_NOTICE); // sakriva Notice

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user = mysqli_query($conn, $query);
    if($select_user === FALSE) { 
    die(mysqli_error($conn)); 
	 }
	
    
    while ($row = mysqli_fetch_array($select_user)) {
        $db_user_id = $row['id'];
        $db_user_username = $row['username'];
        $db_user_password = $row['password'];
        $db_user_firstname = $row['firstname'];
        $db_user_lastname = $row['lastname'];
        
    }
    
	 if (!$username || !$password) {
		 echo "<h1 style='background: red; color: white; padding: 10px 60px;'>
						&#9888; Niste uneli ime i/ili šifru
				  </h1>";
	 }
		 
    else if ($username !== $db_user_username || $password !== $db_user_password) {
        echo "<h1 style='background: red; color: white; padding: 10px 60px;'>
						&#9888; Pogrešno ime ili šifra
				  </h1>";
    } else {
        
        $_SESSION['username'] = $db_user_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
         
        header("Location: admin.php");
    }
    
} //end if, red 8

	include 'includes/header.php'; ?>


<div class="contact_desc">
	<div class="wrap">
		<div class="contact-form">
		<h2>admin login</h2>
			<form method="post" action="login.php">
				<div class="left_form">
					<div>
						<span><label>IME</label></span>
						<span><input name="username" type="text" class="textbox"></span>
					</div>
					<div>
						<span><label>ŠIFRA</label></span>
						<span><input name="password" type="password" class="textbox"></span>
					</div>
					<div>
						<span><input name="login" type="submit" value="Uloguj se" class="myButton"></span>
					</div>
				</div>
			</form>
		</div>
		<div class="clear"></div>
		<h3><a href="index.php">vrati se na početnu</a></h3>
	</div>
</div>


<?php include 'includes/footer.php'; ?>