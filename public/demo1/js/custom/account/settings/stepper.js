// Stepper lement
var element = document.querySelector("#kt_stepper_example_vertical");

// Initialize Stepper
var stepper = new KTStepper(element);

// Handle next step
stepper.on("kt.stepper.next", function (stepper) {
    var currentStepIndex = stepper.getCurrentStepIndex();

    // Get the form element
    var form = document.getElementById(`current-step-${currentStepIndex}`);

    // Get all the input and select elements within the form
    var formElements = form.querySelectorAll("input, select");

    // Array to store the filled required fields
    var filledFields = [];

    // Iterate over the form elements
    for (var i = 0; i < formElements.length; i++) {
        var input = formElements[i];

        // Check if the element is required and has a value
        if (input.required && input.value.trim() == "") {
            filledFields.push(input);
        }
    }

    if (filledFields.length) {
        // filledFields array now contains all the required fields that are filled
        // Example usage: Log the filled field names
        var text = `<div class="alert alert-danger" style='text-align: left;'>
                    <p > Please complete the following field(s) before moving to the next step </p>`;
        text += "<ul>";
        for (var j = 0; j < filledFields.length; j++) {
            text += `<li>${filledFields[j].dataset.label}</li>`;
        }
        text += `</ul></div>`;

        Swal.fire({
            html: text,
        });

        return;
    }

    let dateOfBirth = document.getElementById("date_of_birth");

    if (!isValidDate(dateOfBirth.value)) {
        // filledFields array now contains all the required fields that are filled
        // Example usage: Log the filled field names
        var text = `<p class="text-danger"> Invalid date format for Date of Birth </p>`;

        Swal.fire({
            html: text,
        });

        return;
    }

    if (currentStepIndex === 3) {
        let yearCompleted = document.getElementById("year_completed");

        if (!isValidMonthYear(yearCompleted.value)) {
            // filledFields array now contains all the required fields that are filled
            // Example usage: Log the filled field names
            var text = `<p class="text-danger"> Invalid date format for Year Completed </p>`;

            Swal.fire({
                html: text,
            });

            return;
        }
    }

    if (currentStepIndex === 1) {
        let idPassport = document.getElementById("id_number");
        let emailAddress = document.getElementById("email_address");

        axios({
            method: "post",
            url: `/check-id-passport`,
            data: {
                id_passport: idPassport.value,
                email: emailAddress.value,
            },
        }).then(function (response) {
            if (response.data.isTaken) {
                Swal.fire({
                    title: "The ID / Passport is already taken",
                    icon: "warning",
                });
                stepper.goPrevious();
                return;
            }
        });
    }

    stepper.goNext(); // go next step
});

function isValidDate(dateString) {
    // Regular expression for a simple date format (YYYY-MM-DD)
    var dateRegex = /^\d{4}-\d{2}-\d{2}$/;

    return dateRegex.test(dateString);
}

function isValidMonthYear(dateString) {
    // Regular expression for the format YYYY-MM
    var dateRegex = /^\d{4}-\d{2}$/;

    return dateRegex.test(dateString);
}

// Handle previous step
stepper.on("kt.stepper.previous", function (stepper) {
    stepper.goPrevious(); // go previous step
});
