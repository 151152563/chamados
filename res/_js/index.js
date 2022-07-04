function toggleMenu() {
    let open = document.getElementById("open");
    let close = document.getElementById("close");
    let menu = document.getElementById("menu-body")
    if (menuState == false) {
        open.classList.remove("hide")
        close.classList.add("hide")
        menu.classList.remove("menu-open")
        menuState = true;
    } else {
        close.classList.remove("hide")
        open.classList.add("hide")
        menu.classList.add("menu-open")
        menuState = false;
    }
}

function photoPreview(elem) {

    let fileName = elem.target.files[0]["name"]
    let label = elem.path[1].children[1].innerText = fileName;
    let photoPreview = elem.path[1].children[0];
    photoPreview.src = URL.createObjectURL(elem.target.files[0])
    photoPreview.classList.add("filled");
}

function ValidaCPF() {
    var RegraValida = document.getElementById("RegraValida").value;
    var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/;
    if (cpfValido.test(RegraValida) == true) {
        console.log("CPF Válido");
    } else {
        console.log("CPF Inválido");
    }
} -

jQuery("input.cpf")
    .mask("999.999.999-99")
    .focusout(function(event) {
        var target, cpf, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        cpf = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();

        element.mask("999.999.999-99");

    });

$("input.renda").maskMoney({
    prefix: 'R$ ',
    allowNegative: true,
    thousands: '.',
    decimal: ',',
    affixesStay: true
});



jQuery("input.telefone")
    .mask("(99) 9999-9999?9")
    .focusout(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

jQuery("input.residencial")
    .mask("(99) 9999-9999")
    .focusout(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();

        element.mask("(99) 9999-9999");
    });


function toggleCheck(receviedElement) {

    let checkbox = document.querySelectorAll(".checkbox-single");
    checkbox.forEach(element => {
        if (element != receviedElement) {
            element.checked = false

        }
        if (receviedElement != null) {
            if (receviedElement.className.includes("toggle-input")) {
                let others = document.getElementById("others");
                others.disabled = false;

            } else {
                others.disabled = true;

            }


        }

    });
}