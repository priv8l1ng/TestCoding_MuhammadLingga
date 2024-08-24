"use strict";

// Class definition
var KTModalUpdateProfile = function () {
    var element;
    var submitButton;
    var cancelButton;
    var closeButton;
    var form;
    var modal;
    var validator;

    // Init form inputs
    var initForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Address name is required'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Revalidate country field. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="country"]')).on('change', function () {
            // Revalidate the field when an option is chosen
            validator.revalidateField('country');
        });

        // Action buttons
        submitButton.addEventListener('click', function (e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
			if (validator) {
				validator.validate().then(function (status) {
					console.log('validated!');

					if (status == 'Valid') {
						submitButton.setAttribute('data-kt-indicator', 'on');

						// Disable submit button whilst loading
						submitButton.disabled = true;

						setTimeout(function() {
							submitButton.removeAttribute('data-kt-indicator');

                            axios.post('/dashboard/account-settings/update-profile-picture', new FormData(form))
                            .then(function (response) {
                                console.log(response);
                                if(response.data.status == "00")
                                {
                                    Swal.fire({
                                        text: response.data.message,
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Oke, mengerti!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        },
                                        allowOutsideClick: false,
                                    }).then(function (result) {
                                        if (result.isConfirmed) {
                                            // Hide modal
                                            modal.hide();

                                            // Reset form
                                            form.reset();

                                            // Reload page
                                            location.reload();
            
                                            // Enable submit button after loading
                                            submitButton.disabled = false;
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        // text: "Sorry, looks like there are some errors detected, please try again.",
                                        text: response.data.message,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Oke, mengerti!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        },
                                        backdrop: false,
                                    }).then(function (result) {
                                        if (result.isConfirmed) {
                                            // Reset form
                                            form.reset();
                                        }
                                    });
                                }
                            })
                            .catch(function (error) {
                                Swal.fire({
                                    text: "Maaf, tampaknya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Oke, mengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    },
                                    backdrop: false,
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        // Reset form
                                        form.reset();
                                    }
                                });
                            });

							// Swal.fire({
							// 	text: "Profile Picture has been successfully updated!",
							// 	icon: "success",
							// 	buttonsStyling: false,
							// 	confirmButtonText: "Ok, got it!",
							// 	customClass: {
							// 		confirmButton: "btn btn-primary"
							// 	}
							// }).then(function (result) {
							// 	if (result.isConfirmed) {
							// 		// Hide modal
							// 		modal.hide();

							// 		// Enable submit button after loading
							// 		submitButton.disabled = false;
							// 	}
							// });							
						}, 2000);   						
					} else {
						Swal.fire({
							text: "Maaf, tampaknya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Oke, mengerti!",
							customClass: {
								confirmButton: "btn btn-primary"
							},
                            backdrop: false,
						}).then(function (result) {
                            if (result.isConfirmed) {
                                // Reset form
                                form.reset();

                                // Enable submit button after loading
                                submitButton.disabled = false;
                            }
                        });
					}
				});
			}
        });

        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                text: "Apakah Anda yakin ingin membatalkan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, batalkan!",
                cancelButtonText: "Tidak, kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                },
                backdrop: false,
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Form Anda tidak dibatalkan!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Oke, mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        backdrop: false,
                    });
                }
            });
        });

        closeButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                text: "Apakah Anda yakin ingin membatalkan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, batalkan!",
                cancelButtonText: "Tidak, kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                },
                backdrop: false,
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Form Anda tidak dibatalkan!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Oke, mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        backdrop: false,
                    });
                }
            });
        });
    }

    return {
        // Public functions
        init: function () {
            // Elements
            element = document.querySelector('#kt_modal_update_profile');
            modal = new bootstrap.Modal(element);

            form = element.querySelector('#kt_modal_update_profile_form');
            submitButton = form.querySelector('#kt_modal_update_profile_submit');
            cancelButton = form.querySelector('#kt_modal_update_profile_cancel');
            closeButton = element.querySelector('#kt_modal_update_profile_close');

            initForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTModalUpdateProfile.init();
});