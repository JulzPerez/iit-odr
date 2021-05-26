//request.js


$(function () {

    //jQuery('#select_id').on('change',onChange);

    $('#selectDocument').change(function(){
        //alert($(this).val());
        console.log('heyyyyyyyyyyyyyyyyyy');
    })
    
    /* const zipcode = $('#zipcode')
    const country = $('#country')

    // To prevent token mismatch error when posting via ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //     1] choose a gender => add text input for name prefixed with the rigth 'aanspreekvorm'
    $('#gender input[type=radio]').on('change', function(e) {
        const gender = e.target.value;

        $('#name-input').remove();

        // create a string to update the DOM
        const textInput = `<div id="name-input" class="form-group">
                <label for="city">${(gender === 'male' ? 'Mr.' : 'Ms.')}</label>
                <input type="text" class="form-control" id="name" placeholder="Your name">
            </div>`

        $('#email-cntr').after(textInput)
    });

    //     2] check if email exist and message user if so or show 'free'
    $('#email').on('blur', function(e) {
        // clean up previous messages
        $('#emailerror').remove()

        const email = e.target.value

        // Check if it is a valid emailaddress
        if (!validateEmail(email)) {
            const message = `<small id="emailerror" class="form-text text-danger">This is not a valid emailaddress</small>`
            $('#emailHelp').after(message)
            return false;
        }

        // add a spinner behind the input
        const spinner = '<i id="spinner" class="fa fa-spinner fa-spin" style="position: absolute; right: -10px; top: 115px;"></i>'

        $(this).after(spinner);

        $.ajax({
            url: '/email-exist',
            type: 'POST',
            data: {
                email
            },
        })
        .done(function(response) {
            // remove spinner
            $('#spinner').remove()

            let messageClass, messageText

            if (response === 'exists') {
                // email exists => add some html 'text-danger'
                messageClass = 'text-danger'
                messageText = 'This emailaddress already exists, please choose another.'
            } else {
                // free! => add some html 'text-success'
                messageClass = 'text-info'
                messageText = 'Yeah! emailaddress is still free'
            }
            const message = `<small id="emailerror" class="form-text ${messageClass}">${messageText}</small>`
            $('#emailHelp').after(message)
        })
    })

    //     3] zipcode validation based on zipcode and country
    zipcode.on('blur', checkZipcode)
    country.on('change', checkZipcode)

    // ---
    // Extra functions
    // ---
    function checkZipcode(event) {
        // clean up errors
        $('.zipcodeerror').remove()

        const zipcodeV = zipcode.val()
        const countryV = country.val()

        // Only if zipcode is non empty
        if (zipcodeV === '') {
            return
        }

        let zipcodeValid = checkZipcodeCountry(countryV, zipcodeV)

        if (!zipcodeValid) {
            // dependent on target => show message below
            if (event.target.type === 'text') {
                const message = `<small class="zipcodeerror form-text text-danger">This zipcode is not correct for the chosen country (${countryV.toUpperCase()})</small>`
                zipcode.after(message)
            } else {
                const message = `<small class="zipcodeerror form-text text-danger">This country does not match the zipcode you entered (${zipcodeV})</small>`
                country.after(message)
            }
        }
    }

    function checkZipcodeCountry(countryV, zipcodeV) {
        let re = /^[1-9][0-9]{3}[a-z]{2}$/i
        if (countryV === 'be') {
            re = /^B-[1-9][0-9]{3}$/
        } else if (countryV === 'de') {
            re = /^[1-9][0-9]{4}$/
        }
        return re.test(zipcodeV)
    }

    function validateEmail(email) {
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    */

}(jQuery))