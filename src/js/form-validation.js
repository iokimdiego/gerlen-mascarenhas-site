document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contact-form");
    const emailInput = document.getElementById("email");
    const messageInput = document.getElementById("message");
    const submitButton = document.getElementById("submit");

    form.addEventListener("submit", function(event) {
        let valid = true;

        // Clear previous error messages
        clearErrors();

        // Validate email
        if (!validateEmail(emailInput.value)) {
            showError(emailInput, "Please enter a valid email address.");
            valid = false;
        }

        // Validate message
        if (messageInput.value.trim() === "") {
            showError(messageInput, "Message cannot be empty.");
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    function showError(input, message) {
        const error = document.createElement("div");
        error.className = "error-message";
        error.textContent = message;
        input.parentNode.insertBefore(error, input.nextSibling);
    }

    function clearErrors() {
        const errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach(function(error) {
            error.remove();
        });
    }
});