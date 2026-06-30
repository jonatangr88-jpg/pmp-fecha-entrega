document.addEventListener("DOMContentLoaded", function () {

    const campo = document.querySelector("#pmp_fecha_entrega");

    if (!campo) {
        return;
    }

    flatpickr(campo, {
        locale: "es",
        dateFormat: "d/m/Y",
        allowInput: false,
        clickOpens: true,
        disableMobile: true
    });

});