document.getElementById('add-topic-text').addEventListener('click', function () {
    document.getElementById('add-topic-text').disabled = true;
    const popupbox = document.querySelectorAll('.popup-container');
    popupbox[0].classList.add("show-popup");
})
document.getElementById("searchform").addEventListener("submit", function () {
    window.location.replace(window.location.href);
});

document.addEventListener("DOMContentLoaded", function () {
    // Show buttons when clicking on the ellipsis icon
    document.querySelectorAll(".fa-ellipsis-v").forEach((icon, index) => {
        icon.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevent event bubbling

            let card = icon.closest(".card");
            let buttons = document.querySelectorAll(".buttons")[index];

            if (buttons.style.display === "flex") {
                buttons.style.display = "none";
                card.classList.remove("blur");
            } else {
                buttons.style.display = "flex";
                card.classList.add("blur");
            }
        });
    });
});

// Hide buttons when clicking outside
document.addEventListener("click", function (event) {
    document.querySelectorAll(".card").forEach((card, index) => {
        let buttons = document.querySelectorAll(".buttons")[index];

        if (!card.contains(event.target) && !buttons.contains(event.target)) {
            buttons.style.display = "none";
            card.classList.remove("blur");
        }
    });
});

// Show report popup when clicking Report
document.querySelectorAll(".report-btn").forEach((btn, index) => {
    btn.addEventListener("click", function (event) {
        event.stopPropagation(); // Prevents closing due to outside click

        //let card = btn.closest('.card');
        let card = btn.previousElementSibling;
        let popup = document.querySelectorAll(".popupReport")[index];
        
        if(card && card.classList.contains('.contain')){
            card.classList.add("blur");
        }
        popup.style.display = "block";   
    });
});
// Cancel button should close the popup
document.querySelectorAll(".close-btn").forEach((button) => {
    button.addEventListener("click", function () {
        let popup = this.closest(".popupReport"); // Find nearest popup
        if (popup) {
            popup.style.display = "none"; // Hide popup
            document.querySelectorAll(".card").forEach((card) => {
                card.classList.remove("blur"); // Remove blur from all cards
            });
        }
    });
});

const reportform = document.getElementById('report-form');

if (reportform != null) {
    reportform.addEventListener('submit', function (e) {
        const report_content = document.querySelectorAll('.content');
        report_content.forEach((index) => function () {
            if (report_content[index] == false) {
                report_content[index].disabled = true;
            }
            else {
                report_content[index].disabled = false;
            }
        });
    })
}