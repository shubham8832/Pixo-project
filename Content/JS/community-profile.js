document.addEventListener("DOMContentLoaded", function () {
    // Show buttons when clicking on the ellipsis icon
    document.querySelectorAll(".fa-ellipsis-v").forEach((icon, index) => {
        icon.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevent event bubbling

            let card = document.querySelectorAll(".card")[index];
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

//js to join or leave community

function displayUsers(id) {
    $.ajax({
        url: '../Php-Scripts/user-display.php',
        type: 'POST',
        data: {
            communityId: id,
            req_type: 'user-display'
        },
        success: function (response) {
            document.querySelector('.users-section').innerHTML = response;
        }
    })
}

function usercount(id) {
    $.ajax({
        url: '../Php-Scripts/user-count.php',
        type: 'POST',
        data: {
            communityId: id,
            req_type: 'user-count'
        },
        success: function (response) {
            document.querySelector('.users').innerHTML = response.count;
            document.getElementById('select-community').innerHTML = response.body;
        }
    })
}

const join = document.querySelector('.join-community');

if (join != null) {

    join.addEventListener('click', function () {

        const user_id = join.dataset.userId;
        const community_id = join.dataset.communityId;

        $.ajax({
            url: '../Php-Scripts/community_activity.php',
            type: 'POST',
            data: {
                button: 'joinBtn',
                userId: user_id,
                communityId: community_id
            },
            beforeSend: function () {
                join.disabled = true;
                console.log("Data has been sent");
            },
            success: function (response) {
                console.log(response);

                if (response.activity == "joined") {
                    join.classList.toggle('active');
                    if (join.classList.contains('active')) {
                        join.innerHTML = "Leave";
                    }
                    join.disabled = false;
                    const addbtn = document.querySelector('.add-content');
                    if (addbtn != null) {
                        addbtn.style.display = "block";
                    }
                    displayUsers(community_id);
                    usercount(community_id);
                }

                if (response.activity == "left") {
                    join.classList.remove('active');
                    if (!join.classList.contains('active')) {
                        join.innerHTML = "Join";
                    }
                    join.disabled = false;
                    const addbtn = document.querySelector('.add-content');
                    if (addbtn != null) {
                        addbtn.style.display = "none";
                    }
                    displayUsers(community_id);
                    usercount(community_id);
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        })
    });

}

const editBtn = document.querySelector('.edit-community');
const popupModal = document.querySelectorAll('.popup-container');

if (editBtn != null) {

    editBtn.addEventListener('click', function () {
        const user_id = editBtn.dataset.userId;
        const community_id = editBtn.dataset.communityId;

        $.ajax({
            url: '../Php-Scripts/community_activity.php',
            type: 'POST',
            data: {
                userId: user_id,
                communityId: community_id,
                button: 'edit-community'
            },
            beforeSend: function () {
                editBtn.disabled = true;
                console.log(community_id + " " + user_id);

            },
            success: function (response) {

                if (response.success === true) {
                    //console.log(response);    

                    const bio_text = response.community_bio;
                    const format_text = bio_text.replace(/\r\n|\r|\n/g, "<br>");
                    document.querySelector('.banner-upload').style.display = "none";
                    document.getElementById('community_id').value = response.communityId;
                    document.getElementById('community_name').value = response.communityName;
                    document.querySelector('.previmg').src = response.banner;
                    document.querySelector('.previmg').style.display = "block";
                    document.getElementById('old-banner').value = response.banner;
                    document.querySelector('.community-avtar').src = response.logo;
                    document.getElementById('old-logo').value = response.logo;
                    document.getElementById('community-bio-editor').innerHTML = format_text;
                    document.querySelector('.create-btn').setAttribute("name", "edit-community");
                    document.querySelector('.create-btn').innerHTML = "Update";
                    editBtn.disabled = false;
                    popupModal[1].classList.add('show-popup');
                }
            }
        })
    })
}

//function to delete the community
const addBtn = document.querySelector('.add-content');
if (addBtn != null) {
    addBtn.addEventListener('click', function () {
        community_id = addBtn.dataset.communityId;
        document.getElementById('select-community').value = community_id;
        document.getElementById('select-community').disabled = true;
        document.getElementById('community-id').value = community_id;
        popupModal[0].classList.add('show-popup');
    })
}

const delBtn = document.querySelector('.delete-community');

if (delBtn != null) {
    delBtn.addEventListener('click', function () {
        popupModal[2].classList.add("show-popup");
    })
}

if(document.querySelector(".delete-no")){
    document.querySelector(".delete-no").addEventListener("click", function (event) {
        event.preventDefault();
        popupModal[2].classList.remove("show-popup");
    });    
}

function deluser(id, name) {
    document.getElementById('del-usernmae').innerHTML = name;
    document.getElementById('del-userid').value = id;
    popupModal[3].classList.add('show-popup');
}

if(document.querySelector("#delete-user-no")){
    document.querySelector("#delete-user-no").addEventListener("click", function (event) {
        event.preventDefault();
        popupModal[3].classList.remove("show-popup");
    });
}

function showPopup(id) {
    document.getElementById("popupDel-" + id).style.display = "block";
}

function hidePopup(id) {
    document.getElementById("popupDel-" + id).style.display = "none";
}


// Show report popup when clicking Report
document.querySelectorAll(".report-btn").forEach((btn, index) => {
    btn.addEventListener("click", function (event) {
        event.stopPropagation(); // Prevents closing due to outside click

        let popup = document.querySelectorAll(".popupReport")[index];
        let card = document.querySelectorAll(".card")[index];

        card.classList.add("blur");
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