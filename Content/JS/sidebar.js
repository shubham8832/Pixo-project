/*function to toggle dropdowns in sidebar*/

function toggleMenu(button) {
    button.nextElementSibling.classList.toggle('show');
    button.classList.toggle('rotate');
}

/*function to toggle dropdowns in sidebar profile*/

function showOptions(button) {

    const dropMenu = document.querySelector('.profile-actions');
    dropMenu.classList.toggle('show');
    button.classList.toggle('rotate');
}

/*for quill editor*/

let options = [
    //text-style
    ["bold"],
    //headers
    [{ header: [1, 2, 3, 4, 5, 6, false] }],
    //image,video,link
    ["image", "link"],
    //colour and background
    [{ color: [] }, { background: [] }]
]

window.quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: options,
        imageResize: {
            displaySize: true,
            imageDrop: true,
            modules: ["Resize", "DisplaySize", "Toolbar"]
        }
    }
});

/*get html code from quill inside hidden input to send it to php*/

document.querySelector('.upload-btn').addEventListener('click', function () {

    const hiddenInput = document.querySelector('#send-html-code');

    hiddenInput.value = quill.root.innerHTML;

    console.log(hiddenInput);
})

document.querySelector('.create-btn').addEventListener('click',function(){
    const hiddenBio = document.getElementById('community-bio'); //this will select hidden input of community-bio
    hiddenBio.value = document.querySelector('#community-bio-editor').innerHTML; //this will set the value of hidden input from content editable div
    console.log(hiddenBio.value);
})

const popup = document.querySelectorAll('.popup-container');

const openModal = document.querySelector('.add-menu');

openModal.addEventListener('click', function () {
    if(document.getElementById('community-id').value != ''){
        document.getElementById('community-id').value = 0;
    }
    else{
        document.getElementById('community-id').value = 0;
    }
    popup[0].classList.add("show-popup");
})

const createComSide = document.querySelector('.add-comms');
const createCom = document.querySelector('.open-community-btn');

if(createComSide != null){
    createComSide.addEventListener('click', function (e) {

        popup[1].classList.add('show-popup');
        const hiddenBio = document.getElementById('community-bio'); //this will select hidden input of community-bio
        hiddenBio.value = document.querySelector('#community-bio-editor').innerHTML; //this will set the value of hidden input from content editable div
        console.log(hiddenBio.value);
    
    })    
}
if(createCom != null){
    createCom.addEventListener('click', function (e) {

        popup[1].classList.add('show-popup');
        const hiddenBio = document.getElementById('community-bio'); //this will select hidden input of community-bio
        hiddenBio.value = document.querySelector('#community-bio-editor').innerHTML; //this will set the value of hidden input from content editable div
        console.log(hiddenBio.value);
    
    })   
}



/*function to toggle add community menu*/

const closeButton = document.querySelector('.close-btn');

const closeButtons = document.querySelectorAll('.close-btn'); // Select all close buttons

closeButtons.forEach(button => {
    button.addEventListener('click', function () {
        // Check if the button is inside .add-post-modal or .add-community-modal
        const postModal = this.closest('.add-post-modal');
        const communityModal = this.closest('.create-community-modal');

        if (postModal) {
            popup[0].classList.remove("show-popup"); // Hide add-post-modal
            document.querySelector('.post-form').reset();
            if(document.getElementById('add-topic-text') != null){
                if(document.getElementById('add-topic-text').disabled == true){
                    document.getElementById('add-topic-text').disabled = false;
                }
            }
            //document.getElementById('editor').innerHTML = "Enter your content ...";
            quill.clipboard.dangerouslyPasteHTML("Enter your content ...");
            if(document.getElementById('select-community').disabled = true){
                document.getElementById('select-community').disabled = false;
            }
        }else if (communityModal) {
            popup[1].classList.remove("show-popup"); // Hide add-community-modal
            document.querySelector('.community-form').reset();
            document.querySelector('.previmg').style.display = "none";
            document.querySelector('.banner-upload').style.display = "flex";
            document.querySelector('.community-avtar').src = "../Visuals/user.png";
            document.querySelector('#community-bio-editor').innerHTML = "Your community bio...";
        }
    });
});

/* this function will load the preview of the image after uploading that image */

$(document).on('change', '#user-post', function (event) {

    /* the gives temporary url to generate uploaded image source */
    var imgsrc = URL.createObjectURL(event.target.files[0]);
    document.querySelector('.previmg').src = imgsrc;
    document.querySelector('.previmg').style.display = "block";
    document.querySelector('.banner-upload').style.display = "none";

    /* this function will add the uploaded img preview tag in previmage div tag */
})

$(document).on('change', '#community_logo', function (event) {

    const logoPrev = document.querySelector('.community-avtar');

    var imgsrc = URL.createObjectURL(event.target.files[0]);
    logoPrev.src = imgsrc;
})


