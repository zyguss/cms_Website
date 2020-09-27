<?php include 'includes/header.php';

include 'includes/db.php';
session_start();

if(empty($_SESSION['username'])) {
 header("location:index.php");
}

?>
	<!----start-header----->
	<div class="header">

		<div class="top-header">
			<div class="logo">
				<a href="index.php"><img src="includes/logo/logo.png" title="logo" /></a>
			</div>

			<div class="clear"> </div>
		</div>
		<!---start-top-nav---->
		<div class="top-nav" style="background: saddlebrown">
			<div class="top-nav-left">
				<ul>
					<li><a class="no" href="index.php">početna</a></li>
					<li><a class="no" href="admin.php">admin</a></li>
					<li><a class="no" style="float: right" href="logout.php">izloguj se</a></li>

					<div class="clear"> </div>
				</ul>
			</div>

			<div class="clear"> </div>
		</div>
		<!---End-top-nav---->

	</div>
	<!----End-header----->

	<div class="wrap" style="background: #10fac7; margin:35px auto;" >
		<div>

			<h1 class="adminH1">ADMIN SEKCIJA - <span>PORUKE</span></h1>

		</div>

	<table class="table table-striped">
		<thead class="thead-inverse">
		<tr>

<!--			<th>Id</th>-->
			<th>Ime</th>
			<th>E-mail</th>
			<th>Poruka</th>
			<th>Datum</th>
			<th>Obriši</th>

		</tr>
		</thead>
		<tbody>

		<?php
		$query = "SELECT * FROM poruke";
		$selectComments = mysqli_query($conn, $query);

		if(count($selectComments) > 0){
		while ($row = mysqli_fetch_assoc($selectComments)) {
			$comment_id = $row['id'];
			$comment_name = $row['name'];
			$comment_email = $row['email'];
			$comment_body = $row['body'];
			$comment_date = $row['date'];
			$formatted = date('d. M H:i\h', strtotime($comment_date));

			echo "<tr>";

//			echo "<td>{$comment_id}</td>";
			echo "<td>{$comment_name}</td>";
			echo "<td>{$comment_email}</td>";
			echo "<td>{$comment_body}</td>";
			echo "<td>{$formatted}</td>";
		   echo "<td><a onClick=\"javascript: return confirm('Da li ste sigurni?');\" href ='admin.php?delete=$comment_id'>&#9888;Briši</a></td>";

			echo "</tr>";

		}

		?>

		</tbody>
	</table>
		<div>
		<?php
			} else {
			echo "<h1>Nema poruka trenutno</h1>";
			}
			?>
		</div>

<?php

// DELETE
if (isset($_GET['delete'])) {
	$the_comment_id = $_GET['delete'];
	$query = "DELETE FROM poruke WHERE id = {$the_comment_id} ";
	$delete_query = mysqli_query($conn, $query);
	header("Location: admin.php");
}

?>

</div>

<?php include 'includes/footer.php'; ?>