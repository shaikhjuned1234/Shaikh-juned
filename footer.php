<footer role="contentinfo">
    <!-- About Section -->
    <div>
        <h3>About Blind Tools</h3>
        <ul>
            <li><a href="/about-us" aria-label="About Us" accesskey="a"><i class="fas fa-info-circle"></i> About Us</a></li>
            <li><a href="/contact-us" aria-label="Contact Us" accesskey="c"><i class="fas fa-envelope"></i> Contact Us</a></li>
            <li><a href="/donate" aria-label="Donate"><i class="fas fa-donate"></i> Donate</a></li>
            <li><a href="/developer" aria-label="Developer"><i class="fas fa-code"></i> Developer</a></li>
            <li><a href="/join-us" aria-label="Join Our Team" accesskey="j"><i class="fas fa-users"></i> Join Our Team</a></li>
        </ul>
    </div>

    <!-- Follow Us Section -->
    <div>
        <h4>Follow Us</h4>
        <a href="https://www.instagram.com/shaikhjuned5786" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/blindtechgaming" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
        <a href="https://whatsapp.com/channel/0029VahYhKY5fM5cnAXhEO23" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        <a href="https://youtube.com/@shaikhjuned5786" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
    </div>

    <!-- Legal Section -->
    <div>
        <h4>Legal</h4>
        <ul>
            <li><a href="/privacy-policy" aria-label="Privacy Policy" accesskey="p"><i class="fas fa-user-secret"></i> Privacy Policy</a></li>
        </ul>
    </div>

    <!-- Contact Section -->
    <div>
        <h4>Contact Us</h4>
        <p>Email: <a href="mailto:info@blindtools.in">info@blindtools.in</a></p>
    </div>

    <!-- User Count -->
    <p>User count: 
        <?php 
        if (file_exists('user_count.php')) { 
            require 'user_count.php'; 
        } else { 
            echo "Unavailable"; 
        } 
        ?>
    </p>

    <!-- Copyright Notice -->
    <p class="footer-copyright">
        &copy; <?php echo date("Y"); ?> 
        <a href="/index" aria-label="Blind Tools">Blind Tools</a> | Empowering technology for all. All rights reserved.
    </p>

    <!-- Back to Top Button -->
    <button id="backToTop" aria-label="Back to Top">Back to Top</button>

    <!-- Google reCAPTCHA v3 Integration -->
    <form id="recaptchaForm" method="POST">
        <input type="hidden" name="recaptchaToken" id="recaptchaToken">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['recaptchaToken'])) {
        $secretKey = getenv('RECAPTCHA_SECRET_KEY');
        $token = filter_var($_POST['recaptchaToken'], FILTER_SANITIZE_STRING);

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$token");
        $responseKeys = json_decode($response, true);

        if ($responseKeys['success']) {
            echo "<p class='success-message'>reCAPTCHA verification successful!</p>";
        } else {
            echo "<p class='error-message'>reCAPTCHA verification failed!</p>";
        }
    }
    ?>

    <script src="https://www.google.com/recaptcha/api.js?render='<?php echo getenv('RECAPTCHA_SITE_KEY'); ?>'"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Back to Top Button
            document.getElementById("backToTop").addEventListener("click", function () {
                window.scrollTo({ top: 0, behavior: "smooth" });
            });

            // reCAPTCHA
            grecaptcha.ready(function () {
                grecaptcha.execute('<?php echo getenv('RECAPTCHA_SITE_KEY'); ?>', { action: 'footer' }).then(function (token) {
                    document.getElementById('recaptchaToken').value = token;
                });
            });
        });
    </script>

    <!-- External CSS for Styling -->
    <style>
        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        footer a {
            color: #ffcc00;
            text-decoration: none;
            margin: 0 10px;
        }
        footer ul {
            list-style: none;
            padding: 0;
        }
        footer ul li {
            margin-bottom: 5px;
        }
        .footer-copyright {
            margin-top: 20px;
            padding: 10px;
            background-color: #222;
            border-radius: 5px;
        }
        .success-message { color: green; }
        .error-message { color: red; }
        #backToTop {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #ffcc00;
            color: black;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        #backToTop:hover {
            background-color: #e6b800;
        }
    </style>
</footer>

