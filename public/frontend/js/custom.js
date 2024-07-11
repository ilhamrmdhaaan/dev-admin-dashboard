$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

const reloadHalaman = () => window.location.href;

function modalError(message = "Harap hubungi tim developer") {
    $(".modal-error").modal("show");
    $(".nk-modal-text .lead").text(message);
}

function modalTerimakasih(
    message = "Terima kasih atas layanan yang anda berikan"
) {
    $(".modal-terimakasih").modal("show");
    $(".caption-text").text(message);
}

function alertError(title = "Maaf, terjadi kesalahan", message = false) {
    if (!message) {
        Swal.fire(title, "harap hubungi tim developer", "error");
    }
    Swal.fire(title, message, "error");
}

function showModalLogout() {
    event.preventDefault();
    $(".modal-logout").modal("show");
}

// Loop errors
function loopErrors(errors) {
    $(".invalid").remove();
    $("select").removeClass("select2-hidden-accessible");
    if (errors == undefined) {
        return;
    }
    for (error in errors) {
        $(`[name=${error}]`).addClass("error");
        if ($(`[name=${error}]`).attr("type") == "radio") {
            $(`<div class="invalid text-danger">
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next());
        } else if ($(`[name=${error}]`).hasClass("select2")) {
            $(`<div class="invalid text-danger">
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next());
        } else if ($(`[name=${error}]`).attr("type") == "checkbox") {
            $(`<div class="invalid text-danger">
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`).next().next());
        } else {
            $(`<div class="invalid text-danger">
                    ${errors[error][0]}
                </div>`).insertAfter($(`[name=${error}]`));
        }
    }
}

// Confirm delete alert
function confirmDelete(url) {
    Swal.fire({
        title: "Apakah anda yakin menghapus data ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _method: "DELETE",
                },
            })
                .done((response) => {
                    alertSuccess(response.message);
                })
                .fail((errors) => {
                    alert_error(errors.responseJSON.message);
                    return;
                });
        }
    });
}

// alert success
function alertSuccess(message) {
    Toast.fire({
        icon: "success",
        title: message,
    });
}

// alert error
function alert_error(
    message = "Terjadi kesalahan, silahkan hubungi developer"
) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
    });
}

// Reset form
function resetForm(selector) {
    $(selector)[0].reset();
    $(".choices").trigger("change");
    $(".form-control, .choiches").removeClass("is-invalid");
    $(".select2").trigger("change");
    $(".invalid-feedback").remove();
}

// Loop form

function loopForm(originalForm) {
    for (field in originalForm) {
        if ($(`[name=${field}]`).attr("type") != "file") {
            if ($(`[name=${field}]`).hasClass("summernote")) {
                $(`[name=${field}]`).summernote("code", originalForm[field]);
            } else if ($(`[name=${field}]`).attr("type") == "radio") {
                $(`[name=${field}]`)
                    .filter(`[value="${originalForm[field]}"]`)
                    .prop("checked", true);
            } else {
                $(`[name=${field}]`).val(originalForm[field]);
            }

            $("select").trigger("change");
        } else {
            $(`.preview-${field}`).attr("src", originalForm[field]).show();
        }
    }
}

function pindahHalaman(url, detik = 3000) {
    setTimeout(function () {
        window.location.href = url;
    }, detik);
}

const modalGantiPassword = (url) => {
    event.preventDefault();
    $(".modal-update-password").modal("show");
    $(".modal-update-password form").attr("action", url);
};

const updatePassword = (originalForm) => {
    event.preventDefault();
    $.post({
        url: $(originalForm).attr("action"),
        data: $(originalForm).serialize(),
        beforeSend: function () {
            $(originalForm).find(".tombol-simpan").attr("disabled", true);
            $(originalForm).find(".text-simpan").text("Menyimpan . . .");
            $(originalForm).find(".loading-simpan").removeClass("d-none");
        },
        complete: function () {
            $(originalForm).find(".loading-simpan").addClass("d-none");
            $(originalForm).find(".text-simpan").text("Simpan");
            $(originalForm).find(".tombol-simpan").attr("disabled", false);
        },
    })
        .done((response) => {
            alertSuccess(response.message);
            pindahHalaman(response.url);
        })
        .fail((errors) => {
            if (errors.status === 422) {
                loopErrors(errors.responseJSON.errors);
                return;
            }
            alertError();
        });
};
