"use strict";

// Class definition
var KTAccountSettingsProfileDetails = (function () {
    // Private variables
    var form;
    var submitButton;
    var validation;

    // Private functions
    var initValidation = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation: https://formvalidation.io/
        validation = FormValidation.formValidation(form, {
            fields: {
                title_id: {
                    validators: {
                        notEmpty: {
                            message: "The Title is required",
                        },
                    },
                },
                surname: {
                    validators: {
                        notEmpty: {
                            message: "Surname is required",
                        },
                    },
                },
                first_names: {
                    validators: {
                        notEmpty: {
                            message: "First name is required",
                        },
                    },
                },
                gender_id: {
                    validators: {
                        notEmpty: {
                            message: "Please indicate your gender",
                        },
                    },
                },
                date_of_birth: {
                    validators: {
                        notEmpty: {
                            message: "Date of birth is required",
                        },
                    },
                },
                id_number: {
                    validators: {
                        notEmpty: {
                            message: "Please enter your ID number",
                        },
                    },
                },
                highest_grade: {
                    validators: {
                        notEmpty: {
                            message: "Please enter your highest grade passed",
                        },
                    },
                },
                last_school_attended: {
                    validators: {
                        notEmpty: {
                            message: "Please enter your last school attended",
                        },
                    },
                },
                year_completed: {
                    validators: {
                        notEmpty: {
                            message: "Please enter the year you completed",
                        },
                    },
                },
                education_system_id: {
                    validators: {
                        notEmpty: {
                            message: "Please select your education system",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: "",
                }),
            },
        });
    };

    var handleForm = function () {
        submitButton.addEventListener("click", function (e) {
            e.preventDefault();

            // Validate form
            validation.validate().then(function (status) {
                if (status === "Valid") {
                    // Show loading indication
                    submitButton.setAttribute("data-kt-indicator", "on");

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Send ajax request
                    axios
                        .post(
                            submitButton.closest("form").getAttribute("action"),
                            new FormData(form)
                        )
                        .then(function (response) {
                            // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/

                            var text = `<div>
                                        <p class="text-success">
                                            <strong>Application process complete.</strong>
                                        </p>`;

                            text += `   <p>
                                        <strong><a class="btn btn-sm btn-success" href="/communication/letter/${response.data.userInfo.id}/download" target="_blank"> DOWNLOAD YOUR ACKNOWLEDGEMENT LETTER HERE!</a></strong>.
                                        </p>`;

                            text += `   <p>
                                        <i>(PS: This letter has been emailed to you.)</i>
                                        </p></div>`;

                            Swal.fire({
                                html: text,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                }
                            });
                        })
                        .catch(function (error) {
                            let dataMessage = error.response.data.message;
                            let dataErrors = error.response.data.errors;

                            for (const errorsKey in dataErrors) {
                                if (!dataErrors.hasOwnProperty(errorsKey))
                                    continue;
                                dataMessage += "\r\n" + dataErrors[errorsKey];
                            }

                            if (error.response) {
                                Swal.fire({
                                    text: dataMessage,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                });
                            }
                        })
                        .then(function () {
                            // always executed
                            // Hide loading indication
                            submitButton.removeAttribute("data-kt-indicator");

                            // Enable button
                            submitButton.disabled = false;
                        });
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });
    };

    // Public methods
    return {
        init: function () {
            form = document.getElementById("kt_account_profile_details_form");
            submitButton = form.querySelector(
                "#kt_account_profile_details_submit"
            );

            initValidation();
            handleForm();
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsProfileDetails.init();
});
