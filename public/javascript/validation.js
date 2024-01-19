$(document).ready(function () {
    alert("hello");
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                // Add rules for other form fields
            },
            messages: {
                name: {
                    required: 'Please enter your name',
                    minlength: 'Name must be at least 3 characters long'
                },
                email: {
                    required: 'Please enter your email',
                    email: 'Please enter a valid email address'
                },
                // Add messages for other form fields
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                // Add Bootstrap validation classes
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                // Add Bootstrap error classes
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element, errorClass, validClass) {
                // Add Bootstrap success classes
                $(element).addClass('is-valid').removeClass('is-invalid');
            }
        });
    });

