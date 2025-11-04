//this block will receive the data from the discuss-data based in sent topic ids

window.onload = function(){
    setTimeout(loadData(),5000);
}

setInterval(loadData,10000);
const url = window.location.search;
const qryString = new URLSearchParams(url);

const topic_id = qryString.get('id');
console.log(topic_id);


function loadData(){
    $.ajax({
        url: '../Php-Scripts/discuss-data.php',
        type: 'POST',
        data: {
            topicId: topic_id
        },
        success: function(response){
            document.querySelector('.comment-section').innerHTML = response;
        }
    })
}

//end of the block

//comment sending logic
const sendBtn = document.getElementById('discussion-btn');
sendBtn.addEventListener('click',function(e){
    e.preventDefault();
    const user_Id = sendBtn.dataset.userId;
    const comment_data = document.getElementById('discussion-input-field').value;

    if(comment_data == ''){
        toastr.info("Kindly write something in the discussion box .","Pixo | Notification",{ timeout: 4000 });
    }
    else{
        console.log(comment_data);
    
        $.ajax({
            url: '../Php-Scripts/discuss-data.php',
            type: 'POST',
            data: {
                userId: user_Id,
                topic_id: topic_id,
                commentData: comment_data,
            },
            beforeSend: function(){
                sendBtn.disabled = true;
                sendBtn.innerHTML = "Wait";
            },
            success: function(){
                    document.getElementById('discussion-form').reset();
                    sendBtn.disabled = false;
                    sendBtn.innerHTML = '<i class="fa-regular fa-paper-plane send-mark" style="font-size: 1.4rem;width: 100%;height: 100%;display: flex;align-items: center;padding-left: 8px;"></i>';
                    loadData();
            }
        })
    }
})