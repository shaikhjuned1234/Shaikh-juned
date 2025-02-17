const apiUrl = 'https://www.blog.blindtools.in/wp/wp-json/wp/v2/posts?per_page=5';

// Function to fetch and display recent blog posts
async function fetchRecentPosts() {
    try {
        const response = await fetch(apiUrl);

        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }

        const posts = await response.json();
        displayPosts(posts);
    } catch (error) {
        console.error('Error fetching posts:', error);
        document.getElementById('blog-posts').innerText = 'Error fetching posts';
    }
}

// Function to display the posts
function displayPosts(posts) {
    const blogPostsContainer = document.getElementById('blog-posts');
    blogPostsContainer.innerHTML = ''; // Clear existing content

    posts.forEach(post => {
        const postDiv = document.createElement('div');
        postDiv.className = 'post';
        postDiv.innerHTML = `
            <div class="title">${post.title.rendered}</div>
            <div class="date">${new Date(post.date).toLocaleDateString()}</div>
            <div class="content">${post.excerpt.rendered}</div>
            <a href="${post.link}" target="_blank">Read more</a>
        `;
        blogPostsContainer.appendChild(postDiv);
    });
}

document.addEventListener('DOMContentLoaded', fetchRecentPosts);

