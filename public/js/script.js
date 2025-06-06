// Wait for the DOM to be fully loaded before running the script
document.addEventListener('DOMContentLoaded', function() {

    /**
     * Delete Confirmation
     * Adds a click event listener to all delete links.
     */
    const deleteLinks = document.querySelectorAll('a[href*="delete.php"]');

    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            // Prevent the link from navigating immediately
            event.preventDefault();

            // Show a confirmation dialog
            const userConfirmed = confirm('ທ່ານແນ່ໃຈບໍ່ວ່າຕ້ອງການລົບລາຍການນີ້? ການກະທຳນີ້ບໍ່ສາມາດຍົກເລີກໄດ້.');

            // If the user clicks "OK", proceed to the delete link
            if (userConfirmed) {
                window.location.href = this.href;
            }
            // If the user clicks "Cancel", do nothing.
        });
    });


    /**
     * Client-Side Form Validation for the "Add User" form.
     * This provides quick feedback to the user without needing a page reload.
     */
    const addUserForm = document.querySelector('form[action="../create.php"]');

    if (addUserForm) {
        addUserForm.addEventListener('submit', function(event) {
            // Prevent form submission
            event.preventDefault();

            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            let isValid = true;
            let errorMessage = '';

            if (username === '') {
                isValid = false;
                errorMessage += 'ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້.\n';
            }

            if (email === '') {
                isValid = false;
                errorMessage += 'ກະລຸນາປ້ອນອີເມວ.\n';
            } else if (!validateEmail(email)) {
                isValid = false;
                errorMessage += 'ຮູບແບບອີເມວບໍ່ຖືກຕ້ອງ.\n';
            }

            if (password === '') {
                isValid = false;
                errorMessage += 'ກະລຸນາປ້ອນລະຫັດຜ່ານ.\n';
            } else if (password.length < 6) {
                isValid = false;
                errorMessage += 'ລະຫັດຜ່ານຕ້ອງມີຢ່າງໜ້ອຍ 6 ຕົວອັກສອນ.\n';
            }

            if (isValid) {
                // If all checks pass, submit the form
                this.submit();
            } else {
                // If there are errors, show them in an alert box
                alert(errorMessage);
            }
        });
    }


    /**
     * Client-Side Form Validation for the "Edit User" form.
     */
    const editUserForm = document.querySelector('form[action="../update.php"]');
    if (editUserForm) {
        editUserForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            let isValid = true;
            let errorMessage = '';

            if (username === '') {
                isValid = false;
                errorMessage += 'ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້.\n';
            }

            if (email === '') {
                isValid = false;
                errorMessage += 'ກະລຸນາປ້ອນອີເມວ.\n';
            } else if (!validateEmail(email)) {
                isValid = false;
                errorMessage += 'ຮູບແບບອີເມວບໍ່ຖືກຕ້ອງ.\n';
            }
            
            // For the edit form, password is optional.
            // But if it's not empty, it should be at least 6 characters.
            if (password !== '' && password.length < 6) {
                isValid = false;
                errorMessage += 'ລະຫັດຜ່ານໃໝ່ຕ້ອງມີຢ່າງໜ້ອຍ 6 ຕົວອັກສອນ.\n';
            }

            if (isValid) {
                this.submit();
            } else {
                alert(errorMessage);
            }

        });
    }

    /**
     * Helper function to validate email format using a simple regular expression.
     * @param {string} email - The email string to validate.
     * @returns {boolean} - True if the email is valid, false otherwise.
     */
    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

});