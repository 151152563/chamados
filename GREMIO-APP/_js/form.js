toggleCheck()


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