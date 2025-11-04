function showSection(sectionId) {
    document.getElementById('postSection').style.display = 'none';
    document.getElementById('communitySection').style.display = 'none';
    document.getElementById('mostRecentSection').style.display = 'none';

    document.getElementById(sectionId).style.display = 'block';
}
const modal = document.querySelector('.create-community-modal');
const closeButton = document.querySelector('.close-btn');
const openButton = document.querySelector('.open-community-btn');

closeButton.addEventListener('click', function() {
  modal.style.display = 'none'; // Hides the modal
});

openButton.addEventListener('click', function() {
  modal.style.display = 'block'; // Shows the modal again
});

/*function to toggle dropdowns in sidebar*/

function toggleMenu(button){
  button.nextElementSibling.classList.toggle('show');
  button.classList.toggle('rotate');
}

/*function to toggle dropdowns in sidebar profile*/

function showOptions(button){
  
  const dropMenu = document.querySelector('.profile-actions');
  dropMenu.classList.toggle('show');
  button.classList.toggle('rotate');
}

const up = document.querySelector('#up-arrow');
const down = document.querySelector('#down-arrow');

up.addEventListener('click',function(){
  up.classList.toggle('up');
  if(up.classList.contains('up')){
      document.querySelector('#vote-count').innerHTML = "101";
      document.querySelector('.votes').style.backgroundColor = "#e3694a";
  }
  else{
      document.querySelector('#vote-count').innerHTML = "100";
      document.querySelector('.votes').style.backgroundColor = "transparent";
  }
})

down.addEventListener('click',function(){
  down.classList.toggle('down');
  if(down.classList.contains('down')){
      document.querySelector('#vote-count').innerHTML = "99";
      document.querySelector('.votes').style.backgroundColor = "#4A9EE3";
  }
  else{
      document.querySelector('#vote-count').innerHTML = "100";
      document.querySelector('.votes').style.backgroundColor = "transparent";
  }
})
document.getElementById("editIcon").addEventListener("click", function() {
document.body.classList.add("show-popup");
});

document.getElementById("closePopup").addEventListener("click", function() {
document.body.classList.remove("show-popup");
});

//change password in profile
const cpw = document.querySelector('.cpw');
const cpwlink = document.querySelector('.cpwlink');

cpwlink.addEventListener('click', function() {
  cpw.style.display = cpw.style.display === 'block' ? 'none' : 'block';
});
