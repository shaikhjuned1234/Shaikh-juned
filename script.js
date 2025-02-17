// Enhanced Navigation Toggle with ARIA Attributes
function toggleMenu() {
    const btn = document.getElementById("btn");
    const nav = document.getElementById("nav");
    const isExpanded = btn.getAttribute("aria-expanded") === "true";

    nav.style.display = isExpanded ? "none" : "block";
    btn.setAttribute("aria-expanded", !isExpanded);
    btn.setAttribute("aria-label", isExpanded ? "Open menu" : "Close menu");
}

// Accessible Date and Time Display (without seconds)
function displayDateTime() {
    const date = new Date();
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    let hours = date.getHours();
    let minutes = date.getMinutes();
    const period = hours >= 12 ? "PM" : "AM";
    hours = hours % 12 || 12; // Convert to 12-hour format
    minutes = minutes < 10 ? `0${minutes}` : minutes;

    const dateTimeString = `${days[date.getDay()]}, ${months[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()} - ${hours}:${minutes} ${period}`;
    
    const timeElement = document.getElementById("time");
    if (timeElement) {
        timeElement.textContent = dateTimeString;
        timeElement.setAttribute("aria-label", `The current date and time is ${dateTimeString}`);
    }
}

// Improving Navigation Link Accessibility
function enhanceNavLinks() {
    document.querySelectorAll('nav a').forEach(function(link) {
        link.setAttribute('role', 'menuitem');
        link.setAttribute('tabindex', '0');
        const pageName = link.textContent.trim().toLowerCase();
        link.setAttribute("title", `Navigate to the ${pageName} page of Blind Tools`);
        link.addEventListener('focus', () => {
            link.setAttribute('aria-current', 'true');
        });
        link.addEventListener('blur', () => {
            link.removeAttribute('aria-current');
        });
    });
}

// Dialog Box Accessibility Enhancements
function enhanceDialogBox() {
    const openLangDialog = document.getElementById("webLang");
    const closeLangDialog = document.getElementById("closebtn");
    const dialog = document.getElementById("dialog");

    if (openLangDialog && closeLangDialog && dialog) {
        openLangDialog.setAttribute('aria-haspopup', 'dialog');
        openLangDialog.setAttribute('aria-controls', 'dialog');

        openLangDialog.addEventListener("click", function() {
            dialog.showModal();
            dialog.setAttribute('aria-hidden', 'false');
            closeLangDialog.focus();
        });

        closeLangDialog.addEventListener("click", function() {
            dialog.close();
            dialog.setAttribute('aria-hidden', 'true');
            openLangDialog.focus();
        });
    }
}

// Announce Dynamic Page Load for Screen Readers
function announcePageChange(message) {
    let srMessage = document.getElementById("sr-message");
    srMessage.textContent = message;
}

// Load Pages Dynamically & Announce
function loadPage(page) {
    document.getElementById("loading").style.display = "block";

    fetch(page)
    .then(response => {
        if (!response.ok) {
            throw new Error('Page not found');
        }
        return response.text();
    })
    .then(data => {
        document.getElementById("loading").style.display = "none";
        document.getElementById("main-content").innerHTML = data;
        announcePageChange(page + " loaded successfully");
        window.history.pushState({ path: page }, '', page);
    })
    .catch(error => {
        document.getElementById("loading").style.display = "none";
        document.getElementById("main-content").innerHTML = "<h2>Page not found</h2>";
        announcePageChange("Error loading page");
    });
}

// Handle Back/Forward Navigation
window.addEventListener("popstate", function(event) {
    if (event.state && event.state.path) {
        loadPage(event.state.path);
    }
});

// Initialize functions on page load
document.addEventListener("DOMContentLoaded", () => {
    // Menu toggle setup
    const menuButton = document.getElementById("btn");
    if (menuButton) {
        menuButton.addEventListener("click", toggleMenu);
    }

    // Date and time display setup
    displayDateTime();
    setInterval(displayDateTime, 60000); // Update every minute

    // Enhance navigation links
    enhanceNavLinks();

    // Enhance dialog box accessibility
    enhanceDialogBox();
});

