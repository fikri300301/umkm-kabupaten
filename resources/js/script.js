$(document).on("click", "[id^=anyButton]", function (event) {
    Livewire.emit("anyButtonFromGlobal", event.target.id.slice(9));
});
$(document).on("click", "[id^=editButton]", function (event) {
    Livewire.emit("editButtonFromGlobal", event.target.id.slice(10));
});
$(document).on("click", "[id^=deleteButton]", function (event) {
    Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Anda tidak akan dapat mengembalikan ini!!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yaa, hapus!",
        cancelButtonText: "Batalkan!",
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emit("deleteButtonFromGlobal", event.target.id.slice(12));
        }
    });
});

window.addEventListener("messageSuccess", (e) => {
    let data;
    if (e.detail.message != null && e.detail.message != "") {
        data = e.detail.message;
    } else {
        data = undefined;
    }
    return messageSucces(data, e.detail.time);
});

window.addEventListener("errorSuccess", (e) => {
    let data;
    if (e.detail.message != null && e.detail.message != "") {
        data = e.detail.message;
    } else {
        data = undefined;
    }
    return errorMessage(data);
});

function messageSucces(message = "", time = 1000) {
    Swal.fire({
        icon: "success",
        title: "Success",
        text: `${message}`,
        showCloseButton: true,
        timer: time,
    });
}

function errorMessage(data = "Maaf Ada Masalah") {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: `${data}`,
    });
}

$(window).on("openFormModal", function (event) {
    let id = 'backdrop';
    if (event.detail.id !== '' && event.detail.id !== null && event.detail.id !== undefined) {
        id = event.detail.id;
    }
    $(`#${id}`).addClass("show d-block");
    $("body").addClass('modal-open');
});

$(window).on("closeFormModal", function (event) {
    let id = 'backdrop';
    if (event.detail.id !== '' && event.detail.id !== null && event.detail.id !== undefined) {
        id = event.detail.id;
    }
    $(`#${id}`).removeClass("show d-block");
    $("body").removeClass('modal-open');
});


