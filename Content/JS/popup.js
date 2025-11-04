// Function to show popup
// document.addEventListener("DOMContentLoaded", function () {

// });

// Function to show popup
function showPopup() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("popup_del_profile").style.display = "block";
}

// Function to close popup
function closePopup() {
  document.getElementById("overlay").style.display = "none";
  document.getElementById("popup_del_profile").style.display = "none";
}

// Add event listeners
if(document.getElementById("openPopup") != null){
  document.getElementById("openPopup").addEventListener("click", showPopup);
}

if(document.getElementById("closeBtn") != null){
  document.getElementById("closeBtn").addEventListener("click", closePopup);
}

const popups = document.querySelectorAll('.popup-container');

if(document.getElementById("editIcon") != null){
  document.getElementById("editIcon").addEventListener("click", function () {
    popups[2].classList.add("show-popup");
  });
}

if(document.getElementById("closePopup") != null){
  document.getElementById("closePopup").addEventListener("click", function () {
    popups[2].classList.remove("show-popup");
  });  
}
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

  // Show delete popup when clicking Delete
  document.querySelectorAll(".delete-btn").forEach((btn, index) => {
    btn.addEventListener("click", function (event) {
      event.stopPropagation(); // Prevents closing due to outside click

      let popup = document.querySelectorAll(".popupDel")[index];
      let card = document.querySelectorAll(".card")[index];

      card.classList.add("blur");
      popup.style.display = "block";
    });
  });

  // Hide delete popup when clicking outside
  document.addEventListener("click", function (event) {
    document.querySelectorAll(".popupDel").forEach((popup, index) => {
      let card = document.querySelectorAll(".card")[index];

      if (!popup.contains(event.target) && !card.contains(event.target)) {
        popup.style.display = "none";
        card.classList.remove("blur");
      }
    });
  });

  // Cancel button should close the popup
  document.querySelectorAll(".cancel-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let popup = this.closest(".popupDel"); // Find nearest popup
      if (popup) {
        popup.style.display = "none"; // Hide popup
        document.querySelectorAll(".card").forEach((card) => {
          card.classList.remove("blur"); // Remove blur from all cards
        });
      }
    });
  });
});

function editBtn(id) {
  const editButton = document.getElementById('edit-btn-' + id);

  const user_id = editButton.dataset.userId;

  const topic_id = id;

  $.ajax({
    url: '../Php-Scripts/get-topic.php',
    type: 'POST',
    data: {
      topicId: topic_id,
      userId: user_id,
      button: 'btn-edit'
    },
    beforeSend: function () {
      console.log("data has been sent...");
      console.log(user_id + " " + topic_id);
    },
    success: function (response) {
      console.log(response);
      if (response.success === true) {
        document.getElementById('head').innerHTML = "Edit Topic";
        document.getElementById('topic-id').value = response.topic_id;
        document.getElementById('topic-title').value = response.title;
        document.getElementById('catagories').value = response.categories;
        document.getElementById('select-community').value = response.community_id;
        if (window.quill != null) {
          quill.clipboard.dangerouslyPasteHTML(response.body);
          popups[0].classList.add('show-popup');
        }
        document.getElementById('btn-upload').setAttribute("name", "edit-post");
        document.getElementById('btn-upload').innerHTML = "Update";
      }
    }
  })
}

document.getElementById("profileForm").addEventListener("submit", function (event) {
  let isValid = true;

  // Clear previous error messages
  document.querySelectorAll(".error-message").forEach(el => el.textContent = "");

  // Get form values
  let firstname = document.getElementById("firstname").value.trim();
  let lastname = document.getElementById("lastname").value.trim();
  let username = document.getElementById("username").value.trim();
  let email = document.getElementById("email").value.trim();

  // Function to display error message
  function showError(inputId, message) {
    let inputField = document.getElementById(inputId);
    let errorSpan = inputField.nextElementSibling;
    errorSpan.textContent = message;
    errorSpan.style.color = "red";
  }

  // Validation checks
  if (firstname === "") {
    showError("firstname", "Firstname is required");
    isValid = false;
  }

  if (lastname === "") {
    showError("lastname", "Lastname is required");
    isValid = false;
  }

  if (username === "") {
    showError("username", "Username is required");
    isValid = false;
  } else if (/\s/.test(username)) {
    showError("username", "Username cannot contain spaces");
    isValid = false;
  }

  if (email === "") {
    showError("email", "Email is required");
    isValid = false;
  } else if (!/^\S+@\S+\.\S+$/.test(email)) {
    showError("email", "Invalid email format");
    isValid = false;
  }
  // Prevent form submission if validation fails
  if (!isValid) {
    event.preventDefault();
  }
});

//change password in profile
const pswdsection = document.getElementById('passwordsection');
if (pswdsection != '') {
  if(document.getElementById('pass-link') != null){
    document.getElementById('pass-link').addEventListener('click', function () {
      pswdsection.classList.toggle('show');
    });
  }
}

// function togglePopup(id){
// document.querySelector('.overlay').classList.add('blur');
// document.querySelector('.add-post-modal').style.display = "block";
// }

if(document.getElementById("passwordsection") != null){
  document.getElementById("passwordsection").addEventListener("submit", function (event) {
    let isValid = true;
  
    // Clear previous error messages
    document.querySelectorAll(".error-message1").forEach(el => el.textContent = "");
  
    // Get form values
    let password = document.getElementById("password").value.trim();
    let cpassword = document.getElementById("cpassword").value.trim();
  
    // Function to display error message
    function showError(inputId, message) {
      let inputField = document.getElementById(inputId);
      let errorSpan = inputField.nextElementSibling;
      if (errorSpan && errorSpan.classList.contains("error-message1")) {
        errorSpan.textContent = message;
        errorSpan.style.color = "red";
      }
    }
  
    // Validation checks
    if (password.length <= 6) {
      showError("password", "Password must be at least 6 characters long");
      isValid = false;
    }
    if (password !== cpassword) {
      showError("cpassword", "Passwords do not match");
      isValid = false;
    }
  
    // Prevent form submission if validation fails
    if (!isValid) {
      console.log('error');
      event.preventDefault();
    }
  });
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

if(document.getElementById('openReport') != null){
  document.getElementById('openReport').addEventListener('click',function(){
    document.getElementById('popupReport_User').style.display = "block";
  })
}
// function showReport(id){
//   const reportPopup = document.getElementById('popupContainer-'+id);
//   if(reportPopup != ''){
//     reportPopup.style.display = "block";
//   }
// }

