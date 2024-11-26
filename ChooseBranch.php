<!DOCTYPE html>
<html>
<head>
	<title>E-Complaint KPTM - Select a branch</title>
</head>
<body>
	<?php 
		include 'header.php';

		$q = "SELECT * FROM university_branch";

		$result = @mysqli_query ($connect, $q);
	?>

	<p align="center">Select a branch your complaint is directed to</p>

	<form action="ComplaintForm.php" method="post">
		<p align="center"><select name="branch" required required oninvalid="this.setCustomValidity('Please choose a branch')" oninput="this.setCustomValidity('')">>
			<option selected disabled hidden value="">Select a branch</option>
			<?php while($row = mysqli_fetch_array($result)):;?>
			<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
			<?php endwhile;?>
		</select></p>

		<p align="center"><input id="submit" type="submit" name="submit" value="Click to continue"></p>
	</select>
	</form>
</html>