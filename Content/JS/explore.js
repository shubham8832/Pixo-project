const search = document.getElementById('search-form');
const hide = document.querySelectorAll('.recently-searched');

search.addEventListener('submit',function(e){

    const categories = document.getElementById('categories');
    if(categories.value == '-1'){
        e.preventDefault();
        toastr.info("Kindly select categories .", "Pixo | Notification", { timeout: 1000 });
    }

    const searchInput = document.getElementById('search');
    if(searchInput.value == "Gem of The Pixo" || searchInput.value == "@Mad_@_Skulls" && categories.value == 'users'){
        e.preventDefault();
        hide.forEach((section) => {
            section.style.display = "none";
        })
        const users = document.querySelector('.user-container');

        users.innerHTML =  '';
        const easter = 
        '<a href="./stuffs.php" style="text-decoration: none;width: 48%;color: white;">'
        +'<div class="user-card" id="easter1" style="width: 100%;">'
            +'<div class="user-info">'
                +'<img src="../Visuals/skull-pintrest.jpeg" alt="Heather Clark">'
                +'<div class="user-details">'
                    +'<span class="username">Gem of The Pixo</span>'
                    +'<span class="id">@Mad_@_Skulls</span>'
                +'</div>'
            +'</div>'
            +'<div class="tag" style="width: 50%;display: flex;align-items: center;justify-content: end;">'
                +'<img src="../Visuals/dimond.gif" alt="" class="tag-holder" style="width: 50px;height: 50px;">'
            +'</div>'
        +'</div>'
        +'</a>';
        users.innerHTML = easter;
    }
})

