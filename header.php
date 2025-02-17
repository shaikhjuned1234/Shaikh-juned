<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blind Tools - Accessibility for All</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blind Tools provides accessibility solutions for visually impaired users, including text-to-speech, screen readers, AI-powered tools, and more.">
    <meta name="keywords" content="blind tools, accessibility, screen reader, visually impaired">
    <meta name="author" content="Blind Tools Team">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
            text-align: center;
        }

        /* Skip to Main Content */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 10px;
            background: #007bff;
            color: white;
            padding: 10px;
            z-index: 100;
            text-decoration: none;
            font-weight: bold;
        }
        .skip-link:focus {
            top: 10px;
        }

        /* Header */
        header {
            background: #222;
            color: white;
            padding: 15px 0;
        }
        header img {
            max-width: 150px;
        }

        /* Navigation */
        nav {
            background: #333;
            padding: 10px 0;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        nav ul li {
            margin: 10px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            display: inline-block;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }

        /* Main Content */
        main {
            padding: 20px;
        }

        /* Loading Indicator */
        #loading {
            display: none;
            font-size: 18px;
            font-weight: bold;
            color: #ff6600;
        }

        /* Screen Reader Only Text */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }
    </style>
</head>
<body>

    <!-- Skip to Main Content -->
    <a href="#main-content" class="skip-link">Skip to Main Content</a>

    <header>
        <div><img src="logo.png" alt="Blind Tools Logo" loading="lazy"></div>
    </header>

    <nav>
        <ul>
            <li><a href="javascript:void(0);" onclick="loadPage('home.php', 'Homepage loaded successfully')"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="javascript:void(0);" onclick="loadPage('tools.php', 'Tools loaded successfully')"><i class="fas fa-tools"></i> Tools</a></li>
            <li><a href="javascript:void(0);" onclick="loadPage('audio-book.php', 'Audio Books loaded successfully')"><i class="fas fa-headphones"></i> Audio Books</a></li>
            <li><a href="javascript:void(0);" onclick="loadPage('about.php', 'About Us loaded successfully')"><i class="fas fa-info-circle"></i> About Us</a></li>
            <li><a href="javascript:void(0);" onclick="loadPage('blog.blindtools.in', 'Blog loaded successfully')"><i class="fas fa-blog"></i> Blog</a></li>
            <li><a href="javascript:void(0);" onclick="loadPage('contact.php', 'Contact Us loaded successfully')"><i class="fas fa-envelope"></i> Contact Us</a></li>
            <li><a href="javascript:void(0);" onclick="loadPage('account.php', 'Manage Account loaded successfully')"><i class="fas fa-user-cog"></i> Manage Account</a></li>
            <li><a href="javascript:void(0);" onclick="loadPage('/donate', 'Donate page loaded successfully')"><i class="fas fa-donate"></i> Donate</a></li>
            <li><a href="javascript:void(0);" onclick="loadPage('/privacy', 'Privacy Policy loaded successfully')"><i class="fas fa-user-shield"></i> Privacy Policy</a></li>
        </ul>
    </nav>

    <main id="main-content">
        <h1>Welcome to Blind Tools</h1>
        <p><strong>Date & Time:</strong> <span id="dateTime"></span></p>
    </main>

    <div id="loading" role="alert">Loading...</div>
    <span id="sr-message" class="sr-only" aria-live="polite"></span>

    <!-- External JavaScript -->
    <script src="script.js"></script>

</body>
</html>

