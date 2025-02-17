<?php
$title_dump = "donate us";
require_once "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - Blind Tools</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        main {
            padding: 2rem;
            max-width: 600px;
            margin: auto;
        }

        main h2 {
            color: #007bff;
        }

        label {
            display: block;
            margin-top: 1rem;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"] {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            margin-top: 1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .qr-code {
            text-align: center;
            margin-top: 2rem;
        }

        .qr-code img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .qr-code p {
            margin-top: 1rem;
            font-size: 1.2rem;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Donate to Blind Tools</h1>
    </header>

    <main>
        <section>
            <h2>Your Donation Makes a Difference</h2>
            <p>
                Your generous donations help us develop and maintain tools that make life easier for the blind and visually impaired.
                Every contribution, no matter the size, helps us continue this important work.
            </p>
            <form id="donation-form">
                <label for="donation-amount">Donation Amount:</label>
                <input type="number" id="donation-amount" name="amount" aria-label="Donation amount" min="1" required>

                <label for="donor-name">Your Name:</label>
                <input type="text" id="donor-name" name="name" aria-label="Your name" required>

                <label for="donor-email">Your Email:</label>
                <input type="email" id="donor-email" name="email" aria-label="Your email" required>

                <button type="submit">Donate</button>
            </form>
        </section>

        <section class="qr-code">
            <h2>Donate via UPI</h2>
            <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents('/mnt/data/GooglePay_QR.png')); ?>" alt="QR Code for UPI Donation">
            <p>Scan to pay with any UPI app</p>
            <p>UPI ID: shaikhjunedofficial@okhdfcbank</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Blind Tools. All rights reserved.</p>
    </footer>
<?php
require_once "footer.php";
?>

    <script>
        document.getElementById('donation-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const amount = document.getElementById('donation-amount').value;
            const name = document.getElementById('donor-name').value;
            const email = document.getElementById('donor-email').value;

            if (amount && name && email) {
                // Open UPI apps like PhonePe, Google Pay, Paytm, etc.
                const upiID = 'shaikhjunedofficial@okhdfcbank';
                const upiURI = `upi://pay?pa=${upiID}&pn=${name}&am=${amount}&cu=INR`;

                window.location.href = upiURI;

                // If the above doesn't open the UPI app, fallback to a message
                alert(`If the UPI app doesn't open automatically, please use the QR code below to donate.`);
            } else {
                alert('Please fill out all the required fields.');
            }
        });
    </script>
</body>
</html>
