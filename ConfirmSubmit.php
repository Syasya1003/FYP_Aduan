<!DOCTYPE html>
<html>
<head>
	<title>Your complaint has been submitted</title>
</head>
<body>
	<?php
		include 'header.php';
		require 'C:\XAMPP\htdocs\FYP\composer\vendor\autoload.php';
		use PHPMailer\PHPMailer\PHPMailer;

		$Name = $_POST['name'];
		$Email = $_POST['email'];
		$Phone = $_POST['phone'];
		$Customer_Type = $_POST['customer_type'];
		$About = $_POST['about'];
		$Subject = $_POST['subject'];
		$Details = $_POST['details'];
		$Branch = $_POST['branch'];
		$Com_id = uniqid();

		$q1 = "INSERT INTO customer(c_email,c_name, c_phonenum, ct_id) VALUES ('$Email', '$Name', '$Phone', '$Customer_Type') ON DUPLICATE KEY UPDATE c_name='$Name', c_phonenum='$Phone', ct_id='$Customer_Type'";
		$result1 = @mysqli_query($connect, $q1);

		$q4 = "INSERT INTO complaints(com_id, com_about, com_subject, com_details, c_email, b_id) VALUES ('$Com_id', '$About', '$Subject', '$Details', '$Email', '$Branch')";
		$result4 = @mysqli_query($connect, $q4);

		// Uploads files
		if (isset($_POST['submit'])) { // if save button on the form is clicked
		    
		    if(!empty($_FILES['attachment']['name'])) {
		    	// name of the uploaded file
		    	$filename = $_FILES['attachment']['name'];

		    	// destination of the file on the server
		    	$destination = 'uploads/' . $filename;

		    	// get the file extension
		    	$extension = pathinfo($filename, PATHINFO_EXTENSION);

		    	// the physical file on a temporary uploads directory on the server
		    	$file = $_FILES['attachment']['tmp_name'];

	        	// move the uploaded (temporary) file to the specified destination
	        	if (move_uploaded_file($file, $destination)) {
	            	$q5 = "INSERT INTO complaint_attachments (coma_id, coma_name, com_id) VALUES ('', '$filename', '$Com_id')";
	            	$result5 = @mysqli_query($connect, $q5);
	        	}
		    }
		}

		$mail = new PHPMailer();

		$mail->isSMTP();
		$mail->Host='smtp.mailtrap.io';
		$mail->SMTPAuth=true;
		$mail->Username = '3f4d9b1917dc8b';
		$mail->Password = '0f226acf906b85';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 2525;

		$mail->setFrom('testing521608@gmail.com', 'No-Reply');
		$mail->addAddress($Email, $Name);
		$mail->Subject = 'Your complaint has been submitted';
		$mail->isHTML(true);
		$mailContent = "<h3>Hello " .$Name. "</h3><p>Your complaint has been submitted. Your complaint id is: " .$Com_id. "</p>";
		$mail->Body = $mailContent;

		if($mail->send()){
		    echo 'Message has been sent';
		}else{
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	?>
</body>
</html>