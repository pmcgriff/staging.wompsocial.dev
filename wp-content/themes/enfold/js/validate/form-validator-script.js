jQuery(document).ready(function() {

    // validate signup form on keyup and submit
    jQuery("div.mc4wp-form-2100 > form").validate({
        errorElement: 'small',
        rules: {
            FNAME: {
                required: true,
                lettersonly: true,
                minlength: 2
            },
            LNAME: {
                required: true,
                lettersonly: true,
                minlength: 2
            },			
            EMAIL: {
                required: true,
                email: true
            },
            MMERGE3: {
                required: false,
                digits: true,
                minlength: 5,
                maxlength: 5
            },
        },
        messages: {
            FNAME: {
                required: "Please enter your full name",
                minlength: jQuery.validator.format("Your name must be at least {0} characters")
            },
            LNAME: {
                required: "Please enter your full name",
                minlength: jQuery.validator.format("Your name must be at least {0} characters")
            },			
            EMAIL: "Please enter a valid email address",
            MMERGE3: {
                required: "Please enter your 5 digit zipcode",
                minlength: jQuery.validator.format("Your zipcode must be at least {0} digits"),
                maxlength: jQuery.validator.format("Your zipcode can be no more than {0} digits")
            }
        }
    });

});