<?php
// Step 1: Include the HTML form
if ($_SERVER['REQUEST_METHOD'] != 'POST') { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
</head>
<body>

    <h2>Submit your Details</h2>
    <form id="myForm" method="POST" action="join.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit" id="submitBtn">Submit</button>
    </form>

</body>
</html>

<?php 
// End HTML form section
} else {

// Step 2: Handle the form submission in PHP and send email via PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer using Composer or manually

// Capture form data
$name = $_POST['name'];
$email = $_POST['email'];

// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
    // SMTP server configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';            // Set Gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'yourgmail@gmail.com';   // Your Gmail address
    $mail->Password = 'yourpassword';          // Your Gmail password or App Password
    $mail->SMTPSecure = 'tls';                 // Encryption type (SSL/TLS)
    $mail->Port = 587;                         // SMTP port

    // Email sender and recipient settings
    $mail->setFrom('yourgmail@gmail.com', 'Your Name');
    $mail->addAddress('recipient@gmail.com', 'Recipient Name'); // Add recipient

    // Email content
    $mail->isHTML(false);  // Set email format to plain text
    $mail->Subject = 'New Form Submission';
    $mail->Body    = "Name: $name\nEmail: $email";

    // Send the email
    if ($mail->send()) {
        echo "Message sent successfully!";
    } else {
        echo "Message could not be sent.";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Our Team</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
        }
        .form-container h2 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
        .file-group {
            display: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Join Our Team</h2>
        <form id="joinForm" method="post" action="process-form.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="birthDate">Enter Your Birthdate</label>
                <input type="date" id="birthDate" name="birthDate" required>
            </div>
            <div class="form-group">
                <label for="verificationMethod">Choose Your Verification Method</label>
                <select id="verificationMethod" name="verificationMethod" required>
                    <option value="">Select a method</option>
                    <option value="Aadhar card">Aadhar card</option>
                    <option value="Disability Certificate">Disability Certificate</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group file-group" id="aadharGroup">
                <label for="aadharFile">Upload Aadhar Card</label>
                <input type="file" id="aadharFile" name="aadharFile" accept="image/*,application/pdf">
            </div>
            <div class="form-group file-group" id="disabilityGroup">
                <label for="disabilityFile">Upload Disability Certificate</label>
                <input type="file" id="disabilityFile" name="disabilityFile" accept="image/*,application/pdf">
            </div>
            <div class="form-group file-group" id="otherGroup">
                <label for="otherFile">Upload Other Document</label>
                <input type="file" id="otherFile" name="otherFile" accept="image/*,application/pdf">
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('verificationMethod').addEventListener('change', function () {
            var aadharGroup = document.getElementById('aadharGroup');
            var disabilityGroup = document.getElementById('disabilityGroup');
            var otherGroup = document.getElementById('otherGroup');

            aadharGroup.style.display = 'none';
            disabilityGroup.style.display = 'none';
            otherGroup.style.display = 'none';

            if (this.value === 'Aadhar card') {
                aadharGroup.style.display = 'block';
            } else if (this.value === 'Disability Certificate') {
                disabilityGroup.style.display = 'block';
            } else if (this.value === 'Other') {
                otherGroup.style.display = 'block';
            }
        });
    </script>
</body>
</html>

<?php
// process-form.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthDate = $_POST['birthDate'];
    $verificationMethod = $_POST['verificationMethod'];

    // Handle file upload
    $uploadedFile = '';
    if ($verificationMethod == 'Aadhar card' && isset($_FILES['aadharFile'])) {
        $uploadedFile = $_FILES['aadharFile']['name'];
        move_uploaded_file($_FILES['aadharFile']['tmp_name'], 'uploads/' . $uploadedFile);
    } elseif ($verificationMethod == 'Disability Certificate' && isset($_FILES['disabilityFile'])) {
        $uploadedFile = $_FILES['disabilityFile']['name'];
        move_uploaded_file($_FILES['disabilityFile']['tmp_name'], 'uploads/' . $uploadedFile);
    } elseif ($verificationMethod == 'Other' && isset($_FILES['otherFile'])) {
        $uploadedFile = $_FILES['otherFile']['name'];
        move_uploaded_file($_FILES['otherFile']['tmp_name'], 'uploads/' . $uploadedFile);
    }

    // Prepare email
    $to = "shaikhjuned57865786@gmail.com";
    $subject = "New Team Member Application";
    $message = "Full Name: $fullName\nEmail: $email\nPhone: $phone\nBirthdate: $birthDate\nVerification Method: $verificationMethod\nUploaded File: $uploadedFile";
    $headers = "From: no-reply@yourdomain.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "Your record has been submitted!";
    } else {
        echo "Failed to send email.";
    }
}
?>
