<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">We'd Love to Hear from You!</h2>
        <p class="text-center">Please fill out the form below, and we'll get back to you as soon as possible.</p>
        <form action="/submit" method="POST" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                <div class="invalid-feedback">Please enter your full name.</div>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="tel" class="form-control" id="mobile_number" name="mobile_number" pattern="[0-9]{10}" placeholder="Enter your 10-digit mobile number" required>
                <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
            </div>
            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="How can we help you?" required></textarea>
                <div class="invalid-feedback">Please enter your message.</div>
            </div>
            <p class="text-muted">* All fields are required. We value your privacy and will not share your information with third parties.</p>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
        </form>
    </div>

    <script>
        // Bootstrap validation script
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
