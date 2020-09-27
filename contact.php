<?php include 'includes/header.php'; ?>
<?php $page = 'contact'; include 'includes/navbar.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
	$error = '';
	if(isset($_POST['submit'])) {
		if (empty($_POST['userName'])){
			$error = "&#9888; Morate uneti ime.<br>";
		}

		if (empty($_POST["userEmail"])) {
			$error .= "&#9888; Morate uneti e-mail.<br>";
		} else {
			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST["userEmail"])) {
				$error .= "&#9888; Morate uneti ispravan e-mail.<br>";
			}
		}

		if (empty($_POST['userMsg'])){
			$error .= "&#9888; Ne možete poslati praznu poruku.<br>";
		}
		if (strlen($_POST['userMsg']) > 1000 ) {
			$error .= "&#9888; Možete uneti maksimalno 1000 karaktera.<br>";
		}
		if($_POST['robots'] != '') {
    	 	$error .= "&#9888; Oznaceni ste kao bot.<br>";
		}
				
		if(!$error){
			global $conn;
			$email = $_POST['userEmail'];
			$msg = $_POST['userMsg'];
			$date = date('d-m-Y H:i:s');
			$name = $_POST['userName'];

			$email = mysqli_real_escape_string($conn, $email);
			$msg = mysqli_real_escape_string($conn, $msg);
			$name = mysqli_real_escape_string($conn, $name);

			$query = "INSERT INTO poruke(name, email, body,"
				. " date) ";
			$query .= "VALUES('{$name}', '{$email}', '{$msg}', now()) ";

			$create_post = mysqli_query($conn, $query);


			if (!$create_post) {
				die("<h1 style='background: red; padding: 10px 25px;'>
				Došlo je do greške, pokušajte ponovo kasnije ili nas kontaktirajte na broj 064/516-3212</a>
				</h1>");
			} else {
				echo "<div class='poruka'>&#10004; Poruka je uspešno poslata.</div>";
				$_POST['userName'] = '';
				$_POST['userEmail'] = '';
				$_POST['userMsg'] = '';
			}
		}

		echo "<div class='error'>$error</div>";

	}

?>

<div class="contact_desc">
	<div class="wrap">
		<div class="contact-form">
			<h2>Kontakt forma</h2>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="left_form">
					<div>
						<span><label>IME</label></span>
						<span><input name="userName" type="text" class="textbox" value="<?php if(isset($_POST['userName'])) echo $_POST['userName'];?>"></span>
					</div>
					<div>
						<span><label>E-MAIL</label></span>
						<span><input name="userEmail" type="text" class="textbox" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail'];?>"></span>
					</div>
				</div>
<!--				antibot check-->
				<input style="display:none;" type="text" name="robots" value="" />
				<div class="right_form">
					<div>
						<span><label>TEKST PORUKE</label></span>
						<span><textarea name="userMsg" id="userMsg"><?php if(isset($_POST['userMsg'])) echo $_POST['userMsg'];?></textarea></span>
					</div>
					<div>
						<span><input name="submit" type="submit" value="Pošalji" class="myButton"></span>
					</div>
				</div>
			</form>
			<div class="clear"></div>
		</div>
		<div class="content_bottom">
			<div class="company_address">
				<h2>Kontakt informacije</h2>
				<p>Niš,</p>
				<p>Srbija</p>
				<p>Telefon: 065/ 516-3212</p>
				<p>Email: <span>misstrenkic@yahoo.com</span></p>
			</div>
			
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php'; ?>