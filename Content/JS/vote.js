
//js to expand or wrap the details of the topic
function toggleData(id) {
    const content = document.getElementById('content-' + id);
    const button = document.getElementById('toggle-' + id);

    if (content.style.display === "none") {
        content.style.display = "block";
        button.innerHTML = "Show Less <span style='transform: rotate(90deg)';>&lt;</span>";
    }
    else {
        content.style.display = "none";
        button.innerHTML = "Show More <span style='transform: rotate(-90deg)';>&lt;</span>";
    }
}

//function to add-minus-update-delete the vote

function vote(id, event) {
    const button = event.currentTarget;
    const topic_id = id;
    const user_id = button.dataset.userId;
    const vote_type = button.dataset.type;

    const up = document.getElementById('up-arrow-'+id);
    const down = document.getElementById('down-arrow-'+id);
    const vote_count = document.getElementById('vote-count-'+id);

    $.ajax({
        url: '../Php-Scripts/votes.php',
        type: 'POST',
        data: {
            type: vote_type,
            topic_id: topic_id,
            user_id: user_id,
            button: 'vote'
        },
        beforeSend: function () {
            console.log("Data has been sent " + topic_id + " " + user_id + " " + vote_type);
        },
        success: function (response) {
            if (response.msg == "added") {
                up.classList.toggle('up');
                if (up.classList.contains('up')) {
                    down.classList.remove('down');
                    vote_count.innerHTML = response.vote_count;
                }
            }
            if(response.msg == "minus"){
                down.classList.toggle('down');
                if (down.classList.contains('down')) {
                    up.classList.remove('up');
                    vote_count.innerHTML = response.vote_count;
                }
            }

            if(response.msg == "removed"){
                if (up.classList.contains('up')) {
                    up.classList.remove('up');
                    vote_count.innerHTML = response.vote_count;
                }
                if(down.classList.contains('down')){
                    down.classList.remove('down');
                    vote_count.innerHTML = response.vote_count;
                }
            }
        }
    })
}
