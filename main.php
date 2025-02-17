<?php
echo '<p>Welcome to <span>Blind Tools</span></p>';
echo '<p>Blind Tools is a non-profit organization dedicated to empowering visually impaired individuals through innovative digital solutions tailored to enhance accessibility and independence. Founded by <strong>Shaikh Juned</strong>, Blind Tools is on a mission to break barriers and create a more inclusive world.</p>';
echo '<p>With technology rapidly advancing, we believe that inclusivity should be at the forefront of innovation. Blind Tools offers a wide range of resources and tools to help visually impaired individuals live with greater confidence and independence.</p>';

echo '<h2>Our Mission</h2>';
echo '<p>Our mission is to make everyday tasks simpler and more accessible for the blind and visually impaired. We aim to deliver high-quality, user-friendly tools that are accessible to everyone, regardless of their technical expertise.</p>';

echo '<h2>Latest Blogs</h2>';
echo '<p>Stay up-to-date with our latest blog posts. We cover technology trends, accessibility tips, and personal stories from the community. Here are our most recent posts:</p>';
echo '<div id="blog-posts">';

$apiUrl = 'https://www.blog.blindtools.in/wp-json/wp/v2/posts?per_page=5';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    echo 'Error fetching posts: cURL error: ' . htmlspecialchars(curl_error($ch));
} else {
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 300) {
        $posts = json_decode($response);

        if (json_last_error() === JSON_ERROR_NONE) {
            if (is_array($posts) && !empty($posts)) {
                foreach ($posts as $post) {
                    echo '<div class="post">';
                    echo '<a href="' . htmlspecialchars($post->link) . '" target="_blank">';
                    echo htmlspecialchars($post->title->rendered);
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo 'Error fetching posts: No posts found or invalid data format.';
            }
        } else {
            echo 'Error fetching posts: JSON decoding error. Details: ' . htmlspecialchars(json_last_error_msg());
        }
    } else {
        echo 'Error fetching posts: Unable to retrieve data from the API. HTTP Status Code: ' . $httpCode;
    }
}

echo '</div>';
echo '<p>Discover more on our <a href="https://www.blog.blindtools.in" target="_blank">Blog Page</a>.</p>';

echo '<h2>Explore Our Tools</h2>';
echo '<p>We provide an array of tools that help simplify everyday life, including:</p>';
echo '<ul>';
echo '<li><strong>Image Reader:</strong> Convert images to text for quick and easy access to visual content.</li>';
echo '<li><strong>QR Code Generator:</strong> Create and scan QR codes for seamless navigation and information access.</li>';
echo '<li><strong>Currency Reader:</strong> Instantly identify currencies to handle money confidently and securely.</li>';
echo '<li><strong>Text Translator:</strong> Translate text into multiple languages for better communication.</li>';
echo '<li><strong>Online Digital Bill Maker:</strong> Generate bills instantly, making the process easy and efficient.</li>';
echo '</ul>';
echo '<p>Explore our <a href="tools.php" target="_blank">Tools Page</a> to learn more about these innovative solutions.</p>';

echo '<h2>Additional Features</h2>';
echo '<p>Blind Tools is more than just tools—it’s a community. We offer:</p>';
echo '<ul>';
echo '<li><strong>Audio Books:</strong> A wide range of stories, educational content, and articles in audio format for easy listening.</li>';
echo '<li><strong>Shop:</strong> A curated selection of products designed to make life easier for the visually impaired community.</li>';
echo '<li><strong>Personal Stories:</strong> Inspiring narratives from individuals who are overcoming challenges with the help of technology.</li>';
echo '<li><strong>Educational Content:</strong> Learn how to use assistive tools effectively through tutorials and guides.</li>';
echo '</ul>';

echo '<h2>Join Us</h2>';
echo '<p>Blind Tools was created by <strong>Shaikh Juned</strong> with the vision to make the digital world accessible to everyone. We invite you to explore our platform and join our journey toward an inclusive future. Together, let’s break barriers and unlock new possibilities.</p>';
?>

