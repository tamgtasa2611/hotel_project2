//ScrollReveal
let FadeIn = {
    duration: 1200,
};
let scaleUp = {
    scale: 0.85,
};
let scaleDown = {
    scale: 1.15,
};
let fadeTop = {
    origin: "top",
    distance: "20px",
};
let fadeBottom = {
    origin: "bottom",
    distance: "20px",
};
let fadeLeft = {
    origin: "left",
    distance: "40px",
};
let fadeRight = {
    origin: "right",
    distance: "40px",
};

ScrollReveal().reveal(".fade-scale-up", scaleUp);
ScrollReveal().reveal(".fade-scale-down", scaleDown);
ScrollReveal().reveal(".fade-in", FadeIn);
ScrollReveal().reveal(".fade-std");
ScrollReveal().reveal(".fade-top", fadeTop);
ScrollReveal().reveal(".fade-bottom", fadeBottom);
ScrollReveal().reveal(".fade-left", fadeLeft);
ScrollReveal().reveal(".fade-right", fadeRight);

$(document).ready(function () {
    // ALERT
    setInterval(function () {
        $(".alert").addClass("opacity-0");
        setInterval(function () {
            $(".alert").fadeOut();
        }, 1000);
    }, 4000);

    // PASSWORD EYE
    $("#show_hide_password a").on("click", function (event) {
        event.preventDefault();
        if ($("#show_hide_password input").attr("type") == "text") {
            $("#show_hide_password input").attr("type", "password");
            $("#show_hide_password i").addClass("bi-eye-slash");
            $("#show_hide_password i").removeClass("bi-eye");
        } else if ($("#show_hide_password input").attr("type") == "password") {
            $("#show_hide_password input").attr("type", "text");
            $("#show_hide_password i").removeClass("bi-eye-slash");
            $("#show_hide_password i").addClass("bi-eye");
        }
    });

    // DELETE MODAL
    $(document).on("click", ".dlt-btn", function () {
        let id = $(this).attr("data-id");
        $("#id").val(id);
    });
    $(document).on("click", ".modalBtn", function () {
        let id = $(this).attr("data-id");
        $("#id").val(id);
    });

    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })

    // spinner

    $(".spinner-btn").click(function () {
        $("#spinner").removeClass("d-none");
    });
});


