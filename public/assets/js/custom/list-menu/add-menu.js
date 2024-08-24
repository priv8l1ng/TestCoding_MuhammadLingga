"use strict";

// Class definition
var KTAddMenu = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_menu');
    const form = element.querySelector('#kt_modal_add_menu_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initAddMenu = () => {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'nama_menu': {
                        validators: {
                            notEmpty: {
                                message: 'Nama menu harus diisi'
                            }
                        }
                    },
                    'harga': {
                        validators: {
                            notEmpty: {
                                message: 'Harga harus diisi'
                            },
                            numeric: {
                                message: 'Harga harus berupa angka'
                            }
                        }
                    },
                    'kategori': {
                        validators: {
                            notEmpty: {
                                message: 'Kategori harus diisi'
                            },
                        }
                    },
                    'deskripsi': {
                        validators: {
                            notEmpty: {
                                message: 'Deskripsi harus diisi'
                            }
                        }
                    },
                    'foto': {
                        validators: {
                            notEmpty: {
                                message: 'Foto harus diisi'
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

        // Close button handler
        const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
        closeButton.addEventListener('click', e => {
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
                backdrop: false
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        backdrop: false
                    });
                }
            });
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                },
                backdrop: false
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                        backdrop: false
                    });
                }
            });
        });

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
        submitButton.addEventListener('click', function (e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click 
                        submitButton.disabled = true;

                        // Create FormData object
                        let formData = new FormData(form);

                        // Append file from Dropzone if exists
                        if (myDropzone.files.length > 0) {
                            formData.append('foto', myDropzone.files[0]);
                        }

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function () {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            axios.post('/dashboard/list-menu/add-menu', new FormData(form))
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

                                            // Enable submit button after loading
                                            submitButton.disabled = false;
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
                        }, 2000);
                    }
                });
            }
        });

        // Dropzone
        // set the dropzone container id
        const id = "#kt_dropzonejs_example_3";
        const dropzone = document.querySelector(id);

        // set the preview element template
        var previewNode = dropzone.querySelector(".dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
            url: "/dashboard/list-menu/upload-foto", // Set the url for your upload script location
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            paramName: 'foto',
            parallelUploads: 1, // Number of files to upload at once
            maxFilesize: 5, // Max filesize in MB
            acceptedFiles: 'image/*',
            previewTemplate: previewTemplate,
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
        });

        myDropzone.on("addedfile", function (file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
            const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
            dropzoneItems.forEach(dropzoneItem => {
                dropzoneItem.style.display = '';
            });
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            const progressBars = dropzone.querySelectorAll('.progress-bar');
            progressBars.forEach(progressBar => {
                progressBar.style.width = progress + "%";
            });
        });

        myDropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            const progressBars = dropzone.querySelectorAll('.progress-bar');
            progressBars.forEach(progressBar => {
                progressBar.style.opacity = "1";
            });
        });

        // Hide the total progress bar when nothing"s uploading anymore
        myDropzone.on("complete", function (progress) {
            const progressBars = dropzone.querySelectorAll('.dz-complete');

            setTimeout(function () {
                progressBars.forEach(progressBar => {
                    progressBar.querySelector('.progress-bar').style.opacity = "0";
                    progressBar.querySelector('.progress').style.opacity = "0";
                });
            }, 300);
        });

        // Dropzone remove all
        const dropzoneRemoveAll = element.querySelector('.dropzone-remove-all');
        dropzoneRemoveAll.addEventListener('click', function (e) {
            e.preventDefault();
            myDropzone.removeAllFiles();
        });

        // Dropzone delete
        myDropzone.on("removedfile", function (file) {
            // Kirim permintaan ke server untuk menghapus file
            axios.post('/dashboard/list-menu/delete-foto', {
                filename: file.name
            })
            .then(function (response) {
                console.log('File berhasil dihapus dari server:', response.data);
                // Tampilkan pesan sukses jika diperlukan
                Swal.fire({
                    text: "Foto berhasil dihapus",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Oke",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            })
            .catch(function (error) {
                console.error('Gagal menghapus file dari server:', error);
                // Tampilkan pesan error jika diperlukan
                Swal.fire({
                    text: "Gagal menghapus foto",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Oke",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            });
        });

        // Dropzone success
        myDropzone.on("success", function (file, response) {
            Swal.fire({
                text: response.message,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Oke, mengerti!",
                customClass: {
                    confirmButton: "btn btn-primary"
                },
                allowOutsideClick: false,
            });
        });
    }

    return {
        // Public functions
        init: function () {
            initAddMenu();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAddMenu.init();
});