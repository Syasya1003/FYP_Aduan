<!DOCTYPE html>
<html>
<head>
	<title>Test View Complaints</title>
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
	<h1>List Complaints</h1>

	<?php
		include 'header.php';

		$q1 = "SELECT complaints.com_id, complaints.com_about, complaints.com_subject, customer.c_name FROM complaints INNER JOIN customer ON complaints.c_email = customer.c_email";
		$result1 = @mysqli_query($connect, $q1);

		if($result1) {
			echo '<table border = "1" cellpadding="5">
			<tr>
			<td>Complaint ID</td>
			<td>Complaint Sender</td>
			<td>About</td>
			<td>Subject</td>
			<tr>';

			//Fetch and print all the records
			while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
				echo '<tr>
				<td><a href="ComplaintDetails.php?id='.$row1['com_id'].'">'.$row1['com_id'].'</a></td>
				<td>'.$row1['c_name'].'</td>
				<td>'.$row1['com_about'].'</td>
				<td>'.$row1['com_subject'].'</td>
				</tr>';
			}
			echo '</table>';

			mysqli_free_result($result1);
		} else {
			//Error message
			echo '<p class="error">The list of complaints could not be retrieved. We apologize for any inconvenience.</p>';

			//Debugging message
			echo '<p>' .mysqli_error($connect). '<br><br/>Query: '.$q1.'</p>';
		}
	?>
</body>
</html>