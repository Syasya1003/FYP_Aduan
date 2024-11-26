<!DOCTYPE html>
<html>
<head>
	<title>Complaint Details</title>
</head>
<style type="text/css">
	table {
		border-collapse: collapse;
	}

	a {
		color: blue;
		text-decoration: underline;
	}

	a:hover {
		color: red;
		text-decoration: none;
	}
</style>
<body>

	<?php
		include 'header.php';

		//Look for a valid user id, either through GET or POST
		if (isset ($_GET['id'])) {
			$cid = $_GET['id'];
		} elseif (isset ($_POST['id'])) {
			$cid = $_POST['id'];
		} else {
			echo '<p>This page has been accessed in error.</p>';
			exit();
		}

		echo '<h1>Complaint Details for '.$cid.'</h1>';

		echo '<table border = "1" cellpadding="5">
			<tr>
			<td>Complainant</td>
			<td>Complainant\'s Email</td>
			<td>Complainant\'s Phone</td>
			<td>Complainant\'s Position</td>
			<td>Complaint Branch</td>
			<td>Complaint About</td>
			<td>Complaint Subject</td>
			<td>Complaint Details</td>
			<td>Complaint Attachment</td>
			<tr>';

		$q1 = "SELECT * FROM complaint_attachments WHERE com_id='$cid'";
		$result1 = @mysqli_query($connect, $q1);

		if($result1) {
			$q2 = "SELECT customer.c_name, customer.c_email, customer.c_phonenum, customer_type.ct_type, complaints.com_about, complaints.com_subject, complaints.com_details, university_branch.b_name, complaint_attachments.coma_name  FROM complaints INNER JOIN customer ON complaints.c_email=customer.c_email INNER JOIN customer_type ON customer.ct_id=customer_type.ct_id INNER JOIN university_branch ON complaints.b_id=university_branch.b_id INNER JOIN complaint_attachments ON complaints.com_id=complaint_attachments.com_id WHERE complaints.com_id='$cid'";
			$result2 = @mysqli_query($connect, $q2);

			//Fetch and print all the records
			while ($row1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				echo '<tr>
				<td>'.$row1['c_name'].'</td>
				<td>'.$row1['c_email'].'</td>
				<td>'.$row1['c_phonenum'].'</td>
				<td>'.$row1['ct_type'].'</td>
				<td>'.$row1['b_name'].'</td>
				<td>'.$row1['com_about'].'</td>
				<td>'.$row1['com_subject'].'</td>
				<td>'.$row1['com_details'].'</td>
				<td><a href="uploads/'.$row1['coma_name'].'" target="_blank">View Attachment</a></td>
				</tr>';
			}
			echo '</table>';
		}
	?>
</body>
</html>