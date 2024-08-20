document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
        var email = document.getElementById('email').value.trim();

        if (email === '') {
            alert('Please enter your email address.');
            event.preventDefault(); // Prevent form submission
        }
        // Add further validation or AJAX requests here if needed
    });
});
