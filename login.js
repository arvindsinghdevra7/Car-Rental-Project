
// Handle login form submission
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Hardcoded credentials for validation (replace with backend validation in real-world use)
    const validUsername = "123123";
    const validPassword = "123123";

    if (username === validUsername && password === validPassword) {
        window.location.href = "index.html"; // Redirect to a car rental dashboard page
    } else {
        document.getElementById("error-message").style.display = "block"; // Show error message
    }
});
