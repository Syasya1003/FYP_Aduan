<!DOCTYPE html>
<html>
<head>
	<title>test php passing</title>
</head>
<body>
	<?php
		include 'header.php';

		$q = "SELECT * FROM complaint_attachments";
		$result = mysqli_query($connect, $q);

		$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$Branch = $_POST['branch'];
		$Customer_Type = $_POST['customer_type'];

		echo $Branch;
		echo $Customer_Type;

		// Uploads files
		if (isset($_POST['submit'])) { // if save button on the form is clicked
		    // name of the uploaded file
		    $filename = $_FILES['attachment']['name'];

		    // destination of the file on the server
		    $destination = 'uploads/' . $filename;

		    // get the file extension
		    $extension = pathinfo($filename, PATHINFO_EXTENSION);

		    // the physical file on a temporary uploads directory on the server
		    $file = $_FILES['attachment']['tmp_name'];

		    if (!in_array($extension, ['gif', 'jpg', 'png', 'zip', 'rar', 'csv', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'pdf'])) {
		        echo "You file extension must be .gif, .jpg, .png, .zip, .rar, .csv, .doc, .docx, .xls, .xlsx, .txt or .pdf";
		    } else {
		        // move the uploaded (temporary) file to the specified destination
		        if (move_uploaded_file($file, $destination)) {
		            $sql = "INSERT INTO complaint_attachments (coma_id, coma_name) VALUES ('', '$filename')";
		            if (mysqli_query($connect, $sql)) {
		                echo "File uploaded successfully";
		            }
		        } else {
		            echo "Failed to upload file.";
		        }
		    }
		}

		if (isset($_GET['file_id'])) {
		    $id = $_GET['file_id'];

		    // fetch file to download from database
		    $sql = "SELECT * FROM complaint_attachments WHERE coma_id=$id";
		    $result = mysqli_query($connect, $sql);

		    $file = mysqli_fetch_assoc($result);
		    $filepath = 'uploads/' . $file['coma_name'];

		    if (file_exists($filepath)) {
		        header('Content-Description: File Transfer');
		        header('Content-Type: application/octet-stream');
		        header('Content-Disposition: attachment; filename=' . basename($filepath));
		        header('Expires: 0');
		        header('Cache-Control: must-revalidate');
		        header('Pragma: public');
		        header('Content-Length: ' . filesize('uploads/' . $file['coma_name']));
		        readfile('uploads/' . $file['coma_name']);
		    }
		}
    ?>

    <?php foreach ($files as $file): ?>
        <tr>
          <td><?php echo $file['coma_id']; ?></td>
          <td><?php echo $file['coma_name']; ?></td>
          <td><a href="uploads/<?php echo $file['coma_name'] ?>" target="_blank">View Attachment</a></td>
        </tr>
      <?php endforeach;?>
</body>
</html>