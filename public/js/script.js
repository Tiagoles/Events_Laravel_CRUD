document.addEventListener("DOMContentLoaded", function () {
    const msgSucess = document.getElementById("success")
    const msgError = document.getElementById("error")

    function hideMessage(message) {
        setTimeout(() => {
            if (message) {
                message.style.display = "none"
            }
        }, 5000)
    }

    hideMessage(msgSucess)
    hideMessage(msgError)

    const labelsCheck = document.querySelectorAll(".custom-checkbox")
    const labelsCheckArray = Array.from(labelsCheck);
    labelsCheckArray.forEach(labelCheck => {
        labelCheck.addEventListener("click", () => {
            const checks = labelCheck.querySelector(".check")
            checks.checked = !checks.checked;
            if (checks.checked) {
                labelCheck.classList.add("checked")
            } else {
                labelCheck.classList.remove("checked")
            }
        })
    })
    const [btnCreateEventToDashboard] = [...document.getElementsByClassName("btnCreateEventToDashboard")]
    if (btnCreateEventToDashboard) {
        btnCreateEventToDashboard.addEventListener("click", () => {
            window.location.href = "/events/create"
        });
    }
    let arrowDown = document.querySelectorAll(".arrowDownEditEvent");
    let arrowUp = document.querySelectorAll(".arrowUpEditEvent");
    let containerImageEditEvent = document.querySelectorAll(".container-img-preview-edit-event");
    function toggleArrowForShowImageEditEvent(arrowDown, arrowUp, containerImageEditEvent) {
        arrowDown.style.display = "none"
        containerImageEditEvent.style.display = "none"
        arrowDown.addEventListener("click", function () {
            containerImageEditEvent.style.display = containerImageEditEvent.style.display === "none" ? "block" : "none"
            arrowDown.style.display = arrowDown.style.display === "none" ? "block" : "none"
            arrowUp.style.display = arrowUp.style.display === "none" ? "block" : "none"

        })
        arrowUp.addEventListener("click", function () {
            arrowDown.style.display = arrowDown.style.display === "none" ? "block" : "none"
            arrowUp.style.display = arrowUp.style.display === "none" ? "block" : "none"
            containerImageEditEvent.style.display = containerImageEditEvent.style.display === "none" ? "block" : "none"
        })
    }
    for (let i = 0; i < arrowDown.length; i++) {
        toggleArrowForShowImageEditEvent(arrowDown[i], arrowUp[i], containerImageEditEvent[i]);
    }

    const formConfirmPresence = document.getElementById("formConfirmPresence");
    if (formConfirmPresence) {
        formConfirmPresence.addEventListener("submit", function () {
            this.preventDefault();
        })
    }















































































})
