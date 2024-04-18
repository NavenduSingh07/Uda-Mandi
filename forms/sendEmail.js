// Select the form element
const form = document.getElementById('contact-form');

// Add event listener for form submission
form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission behavior

    // Fetch form data
    const formData = new FormData(this);

    // Send form data to backend
    fetch('/sendEmail.php', { // Assuming your PHP script is named sendEmail.php
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Check if the response is successful
        if (response.ok) {
            // Show success message
            document.querySelector('.sent-message').style.display = 'block';
            // Reset form fields
            form.reset();
        } else {
            // Show error message
            document.querySelector('.error-message').style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Show error message
        document.querySelector('.error-message').style.display = 'block';
    })
    .finally(() => {
        // Hide loading message
        document.querySelector('.loading').style.display = 'none';
    });
});
