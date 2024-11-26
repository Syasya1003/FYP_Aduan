<!DOCTYPE html>
<html>
<head>
	<title>E-Complaint KPTM - Submit a complaint</title>
</head>
<script type="text/javascript">
	function ClearValidity() {
			document.getElementById('about').setCustomValidity('');
		}

	function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            file.value = null;
        }
    }

    function CheckEmail() {
    	if (document.getElementById('email').value != document.getElementById('confirm_email').value) {
    		document.getElementById('message').style.color = 'red';
    		document.getElementById('message').innerHTML = 'Your emails do not match';
    	} else {
    		document.getElementById('message').innerHTML = null;
    	}
    }

    function FixEmail() {
    	if (document.getElementById('email').value != document.getElementById('confirm_email').value) {
    		alert('Your emails do not match');
    		return false;
    	}
    	return true;
    }
</script>
<style type="text/css">
	td.topleft {
		vertical-align: top;
		text-align: left;
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
	?>

	<p align="center">Please use the form below to submit a complaint. Please enter right information here and <b>you need to give the real email because admin <br>will reply your complaint to that email.</b> Required fields are marked with <font color="red">*</font></p>

	<?php
		$Branch = $_POST['branch'];

		$q = "SELECT * FROM customer_type";

		$result = @mysqli_query ($connect, $q);
	?>

	<form action="ConfirmSubmit.php" method="post" enctype='multipart/form-data' onSubmit="return FixEmail()">
		<table align="center" cellpadding="5">
			<tr>
				<td>
					<td align="left">Name</td>
					<td>:</td>
					<td><font color="red">*</font></td>
					<td><input type="text" name="name" size="50" maxlength="50" required oninvalid="this.setCustomValidity('Please enter your name')" oninput="this.setCustomValidity('')">
				</td>
			</tr>
			<tr>
				<td>
					<td align="left">Email</td>
					<td>:</td>
					<td><font color="red">*</font></td>
					<td><input type="email" name="email" id="email" size="50" maxlength="50" required oninvalid="this.setCustomValidity('Please enter your email')" oninput="this.setCustomValidity('')">
				</td>
			</tr>
			<tr>
				<td>
					<td class="topleft">Confirm Email</td>
					<td class="topleft">:</td>
					<td class="topleft"><font color="red">*</font></td>
					<td><input type="email" name="confirm_email" id="confirm_email" size="50" maxlength="50" required oninvalid="this.setCustomValidity('Please confirm your email')" onkeyup="CheckEmail()"><br><span id='message'></span>
				</td>
			</tr>
			<tr>
				<td>
					<td align="left">Phone Number</td>
					<td>:</td>
					<td><font color="red">*</font></td>
					<td><input type="number" name="phone" size="50" maxlength="11" required oninvalid="this.setCustomValidity('Please enter your phone number')" oninput="this.setCustomValidity('')">
				</td>
			</tr>
			<tr>
				<td>
					<td align="left">Category of complainant</td>
					<td>:</td>
					<td><font color="red">*</font></td>
					<td><select name="customer_type" required required oninvalid="this.setCustomValidity('Please choose')" oninput="this.setCustomValidity('')">
						<option selected disabled hidden value="">Click to Select</option>
						<?php while($row = mysqli_fetch_array($result)):;?>
							<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
						<?php endwhile;?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<td class="topleft">Complaint is about?</td>
					<td class="topleft">:</td>
					<td class="topleft"><font color="red">*</font></td>
					<td><input type="radio" required oninvalid="this.setCustomValidity('Please choose')" onclick="ClearValidity()" name="about" id="about" value="Infrastructure">&nbsp;Infrastructure
						<br><input type="radio" onclick="ClearValidity()" name="about" id="about" value="Service">&nbsp;Service
						<br><input type="radio" onclick="ClearValidity()" name="about" id="about" value="Staffs">&nbsp;Staffs
					</td>
				</td>
			</tr>
			<tr>
				<td>
					<td align="left">Subject</td>
					<td>:</td>
					<td><font color="red">*</font></td>
					<td><input type="text" name="subject" size="50" maxlength="30" required oninvalid="this.setCustomValidity('Please enter a subject')" oninput="this.setCustomValidity('')">
				</td>
			</tr>
			<tr>
				<td>
					<td class="topleft">Complaint Details</td>
					<td class="topleft">:</td>
					<td class="topleft"><font color="red">*</font></td>
					<td><textarea name="details" rows="5" cols="50" maxlength="1000" required oninvalid="this.setCustomValidity('Please enter the details')" oninput="this.setCustomValidity('')"></textarea><br><font color="red">max 1000 words</font><br>
				</td>
			</tr>
			<tr>
				<td>
					<td align="left">Attachment</td>
					<td>:</td>
					<td></td>
					<td><input type="file" name="attachment" id="attachment" onchange="ValidateSize(this)" accept=".gif, .jpg, .png, .zip, .rar, .csv, .doc, .docx, .xls, .xlsx, .txt, .pdf"><br><font color="red"><a href="AttachmentRules.php" target="_blank">File Upload Limit</a></font>
				</td>
			</tr>
		</table>
		<input type="hidden" name="branch" value="<?php echo $Branch;?>">
		<p align="center"><input id="submit" type="submit" name="submit" value="Submit Complaint"></p>
	</form>
</body>
</html>