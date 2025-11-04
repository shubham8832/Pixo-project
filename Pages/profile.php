<!DOCTYPE html>
<html lang="en">
<?php
include('../Php-Scripts/functions.php');
?>

<?php
if (!isset($_SESSION['user-details'])) {
  header("location:./conupdated.php");
  exit();
}
?>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pixo | Profile</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Font Awesome for Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
  <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>
  <script src="https://cdn.rawgit.com/kensnyder/quill-image-drop-module/3411c9a7/image-drop.min.js"></script>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <!-- cropper js -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
  <link rel="shortcut icon" href="../Visuals/Untitled design.png" type="image/x-icon">
  <link rel="stylesheet" href="../Content/CSS/profile.css">
  <link rel="stylesheet" href="../Content/CSS/sidebar.css">

  <style>
    #image_container {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px solid #ddd;
    }

    #image_cropper {
      max-width: 100%;
      height: auto;
      display: block;
    }

    .votes {
      display: flex;
      gap: 20px;
      align-items: center;
      /*border: 2px solid;*/
      padding: 5px;
      border-radius: 25px;
      height: 40px;
    }

    .votes>.arrow,
    .votes>.count {
      font-size: 1.5rem;
      margin: 0;
      height: fit-content;
      cursor: pointer;
    }

    .discuss {
      display: flex;
      width: 80px;
      height: 40px;
      align-items: center;
      gap: 5px;
      padding: 5px;
      /*border: 2px solid;*/
      border-radius: 25px;
      justify-content: center;
      cursor: pointer;
    }

    .input-container {
      position: relative;
      margin: 20px 0;
    }

    .input-container input {
      width: 100%;
      padding: 10px;
      background: transparent;
      border: none;
      border-bottom: 2px solid #555;
      outline: none;
      color: #fff;
      font-size: 16px;
    }

    /* .input-container label {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #888;
            transition: 0.3s;
            font-size: 16px;
        } */
    /* .input-container input:focus ~ label,
        input:valid ~ label {
            top: -10px;
            left: 5px;
            color: #e74c3c;
            font-size: 12px;
        } */
    #passwordsection.show .cpw {
      display: block;
    }

    .cpw {
      display: none;
    }

    input {
      color: whitesmoke;
      transition: color 0.3s ease;
      spellcheck: false;
      -webkit-user-modify: read-write-plaintext-only;
    }

    /* input:focus {
            color: transparent;
        } */

    .contain {
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .card {
      transition: filter 0.3s ease-in-out;
    }

    .blur {
      filter: blur(5px);
    }

    .overlay.blur {
      display: block;
      z-index: 2;
      filter: blur(5px);
    }

    .buttons {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: none;
    }

    .buttons button {
      padding: 10px 35px;
      margin: 20px;
      border: none;
      cursor: pointer;
      font-size: 16px;
      border-radius: 5px;
    }

    .I-btn,
    .delete-btn {
      padding: 10px 20px;
      font-size: 16px;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
      text-transform: uppercase;
    }

    .edit-btn {
      background: linear-gradient(135deg, #FF9800, #F57C00);
      /* Warm Orange gradient */
      color: white;
      box-shadow: 0 4px 8px rgba(255, 152, 0, 0.3);
    }

    .delete-btn {
      background: linear-gradient(135deg, #D84315, #BF360C);
      /* Deep Reddish-Brown */
      color: white;
      box-shadow: 0 4px 8px rgba(216, 67, 21, 0.3);
    }

    .edit-btn:hover {
      background: linear-gradient(135deg, #FFA726, #FB8C00);
      box-shadow: 0 6px 12px rgba(255, 152, 0, 0.5);
      transform: translateY(-2px);
    }

    .delete-btn:hover {
      background: linear-gradient(135deg, #E64A19, #D84315);
      box-shadow: 0 6px 12px rgba(216, 67, 21, 0.5);
      transform: translateY(-2px);
    }

    .edit-btn:active,
    .delete-btn:active {
      transform: translateY(0);
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
    }

    .icon {

      cursor: pointer;
      font-size: 16px;
      padding: 4px;
      border-radius: 50%;

    }

    /* Hide popup by default */
    .popupDel {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #1e1e1e;
      color: #fff;
      padding: 20px;
      border-radius: 8px;
      z-index: 1001;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
      padding: 2rem;
    }

    /* Hide popup by default */
    .popupReport {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #1e1e1e;
      color: #fff;
      padding: 20px;
      border-radius: 8px;
      z-index: 1001;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
      padding: 2rem;
    }

    .popupReport .content {
      padding: 15px;
      border-radius: 12px;
      background-color: rgba(255, 255, 255, 0.1);
      transition: background-color 0.3s ease-in;
      outline: none;
      border: none;
      color: white;
      margin: 10px 0px;
    }

    .popupReport .content:hover {
      background-color: rgba(255, 255, 255, 0.2);
      transition: background-color 0.3s ease-in;
      color: #e3694a;
    }

    /* Style the popup content */
    .popup-content {
      text-align: center;
    }

    .btn-d {
      background: #d13c23;
      padding: 0.7rem;
      border-radius: 30px;
      width: 8rem;
      color: whitesmoke;
      font-size: 15px;
      border: none;
      outline: none;
    }

    .btn {
      width: 100%;
      border: 1px solid #e3694a;
      color: whitesmoke;
    }

    .btn:hover {
      background-color: #d13c23;
      border: 1px solid whitesmoke;
    }

    .lbl {
      padding: 10px;
    }

    #popup_del_profile {
      height: 35%;
      width: 25%;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #1e1e1e;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
      z-index: 2;
      display: none;
    }

    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
      /* Apply blur effect */
      display: none;
      z-index: 1;
    }

    .tab {
      cursor: pointer;
    }

    .tab.active {
      color: #d13c23;
    }

    .user_post {
      display: none;
    }

    .user_post.active {
      display: block;
    }
  </style>
</head>

<body>
  <!-- <div class="personal-profilesection"> -->
  <div id="overlay"></div>
  <div class="container-fluid">
    <?php include('../Php-Scripts/sidebar.php'); ?>
    <div class="content-container" style="width: 100%;height: 100%;overflow-y: scroll;">
      <div class="Personal-profile" style="">
        <div class="profile-header d-flex align-items-center" style="width:100%;">
          <?php
          // $conn=mysqli_connect('localhost','root','','pixo_demo');
          $id = $_GET['id'];
          $qry = "select id,firstname,lastname,username,profile_image from users where id=$id";
          $query_run = mysqli_query($con, $qry);
          $result = mysqli_fetch_assoc($query_run);
          ?>
          <div class="profile-image" style="width: 80px; height: 80px; position: relative; display: inline-block;">
            <?php
            $loggedInUserId = $_SESSION['user-details']['id']; // Logged-in user ID
            $profileId = $_GET['id']; // Profile ID being viewed
            
            // Fetch user details
            $qry = "SELECT * FROM users WHERE id=$profileId";
            $query_run = mysqli_query($con, $qry);
            $user = mysqli_fetch_assoc($query_run);

            $isOwner = ($loggedInUserId == $profileId); // Check if profile belongs to logged-in user
            
            if ($user): // If user data exists
              ?>
              <img src="<?php echo "../Uploads/User-Data/" . $user['profile_image']; ?>" class="profile-pic me-3"
                style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 2px solid white;object-fit: cover;"
                alt="Profile Image">

              <?php if ($isOwner): // Show edit icon only if the logged-in user is viewing their own profile ?>
                <i class="fas fa-pencil-alt" id="editIcon" style="position: absolute; bottom: 0; right: 0; 
                background-color: rgb(205, 86, 17); color: white; 
                width: 25px; height: 25px; border-radius: 50%; 
                display: flex; justify-content: center; align-items: center; 
                font-size: 10px; text-decoration: none; 
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); 
                border: 1px solid white;
                cursor: pointer;">
                </i>
              <?php endif; ?>

            <?php endif; ?>
          </div>

          <div style="padding-left: 2rem;flex-grow: 1;">
            <h5>
              <div class="profile-name">
                <?php
                echo $result['firstname'] . " " . $result['lastname'];
                ?>
                &nbsp;
              </div>
            </h5>
            <?php
            $id = $_GET['id'];
            $qry = "SELECT COUNT(*) AS TotalCount FROM topic_data WHERE user_id = $id";
            $query_run = mysqli_query($con, $qry);

            if ($query_run) {
              $row = mysqli_fetch_assoc($query_run); // Fetch the count
              echo $row['TotalCount'];
            } else {
              echo "0";
            }
            ?> POSTS | <?php
             $id = $_GET['id'];
             $qry = "SELECT COUNT(*) AS TotalCount FROM community_data WHERE owner_id = $id";
             $query_run = mysqli_query($con, $qry);

             if ($query_run) {
               $row = mysqli_fetch_assoc($query_run); // Fetch the count
               echo $row['TotalCount'];
             } else {
               echo "0";
             }
             ?>&nbsp;Communities</p>
          </div>
          <?php
          $loggedInUserId = $_SESSION['user-details']['id'];
          $profileId = $_GET['id'];
          $isOwner = ($loggedInUserId == $profileId);
          if ($isOwner):?>
            <div style="display: flex;width: 30%;margin-right: 15px;gap: 7.5px;justify-content: end;margin-top: 10px;">
              <?php
              $adminId = 0;
              $isAdmin = ($loggedInUserId == $adminId);
              if ($isAdmin):
                ?>
                <a href="#" data-tab="tab3" class="btn tab" name="btn-logout"
                  style="color:whitesmoke;display: flex;flex-direction: column;padding: 15px;width: 28%;border-radius: 15px;justify-content: center;align-items: center;max-width: 200px;">
                  <svg fill="whitesmoke" height="30px" width="30px" version="1.1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                    xml:space="preserve">
                    <g>
                      <g>
                        <g>
                          <path
                            d="M502.989,196.267h-5.521c-15.764,0-29.975-9.499-36.002-24.067l-0.947-2.272c-6.011-14.546-2.674-31.3,8.465-42.439
                        l3.893-3.885c3.527-3.527,3.527-9.237,0.007-12.757l-71.731-71.731c-3.52-3.52-9.222-3.52-12.742,0l-3.9,3.9
                        c-11.138,11.138-27.898,14.477-42.45,8.457l-2.252-0.935c-14.574-6.023-24.076-20.238-24.076-36.006V9.011
                        c0-4.949-4.013-9.011-9.011-9.011H205.278c-4.998,0-9.011,4.063-9.011,9.011v5.521c0,15.767-9.501,29.983-24.063,36l-2.274,0.944
                        c-14.543,6.016-31.303,2.677-42.441-8.461l-3.9-3.9c-3.52-3.52-9.222-3.52-12.742,0l-71.731,71.731
                        c-3.52,3.52-3.52,9.23,0,12.751l3.906,3.898c11.132,11.132,14.47,27.886,8.449,42.455l-0.929,2.23
                        c-6.035,14.587-20.246,24.086-36.01,24.086H9.011c-4.998,0-9.011,4.063-9.011,9.011v101.444c0,4.977,4.034,9.011,9.011,9.011
                        h5.521c15.761,0,29.973,9.505,36.002,24.075c6.764,16.354,3.267,33.917-8.414,45.599l-3.004,3.004
                        c-3.52,3.52-3.52,9.222,0,12.742l71.731,71.731c3.52,3.52,9.222,3.52,12.742,0l2.995-2.987
                        c11.69-11.697,29.252-15.196,44.526-8.883c15.225,6.3,25.156,21.153,25.156,37.63v4.344c0,4.977,4.034,9.011,9.011,9.011h101.444
                        c4.977,0,9.011-4.034,9.011-9.011v-4.344c0-16.478,9.931-31.33,25.159-37.632c15.271-6.312,32.833-2.813,44.513,8.874
                        l3.014,3.006c3.512,3.512,9.213,3.512,12.733-0.009l71.731-71.731c3.52-3.52,3.52-9.222,0-12.742l-3.9-3.9
                        c-11.135-11.135-14.471-27.888-8.455-42.455l0.928-2.228c6.037-14.59,20.249-24.095,36.01-24.095h5.521
                        c4.977,0,9.011-4.034,9.011-9.011V205.278C512,200.329,507.987,196.267,502.989,196.267z M494.933,298.724
                        c-21.646,0.976-40.894,14.394-49.238,34.56l-0.931,2.233c-8.332,20.176-4.203,43.245,10.395,59.224l-60.469,60.469
                        c-16.474-14.455-39.849-18.429-60.32-9.968c-20.461,8.467-34.182,27.811-35.585,49.691h-85.571
                        c-1.402-21.88-15.124-41.224-35.582-49.69c-20.47-8.461-43.84-4.49-60.323,9.968l-60.518-60.518
                        c14.454-16.484,18.424-39.856,9.965-60.323c-8.797-21.254-28.045-34.671-49.691-35.647v-85.447
                        c21.648-0.975,40.895-14.387,49.238-34.552l0.931-2.233c8.339-20.179,4.207-43.249-10.395-59.233l60.419-60.419
                        c15.984,14.601,39.062,18.735,59.204,10.403l2.271-0.943c20.152-8.328,33.567-27.582,34.542-49.234h85.447
                        c0.975,21.652,14.39,40.906,34.555,49.239l2.249,0.934c20.152,8.336,43.23,4.202,59.214-10.399l60.419,60.419
                        c-14.603,15.989-18.733,39.056-10.404,59.21l0.948,2.276c8.335,20.146,27.582,33.557,49.229,34.532V298.724z" />
                          <path d="M256,93.868c-89.543,0-162.133,72.591-162.133,162.133S166.457,418.135,256,418.135s162.133-72.591,162.133-162.133
                        S345.543,93.868,256,93.868z M256,401.068c-80.117,0-145.067-64.95-145.067-145.067S175.883,110.935,256,110.935
                        s145.067,64.95,145.067,145.067S336.117,401.068,256,401.068z" />
                          <path d="M256,145.068c-61.263,0-110.933,49.67-110.933,110.933c0,33.287,14.667,63.147,37.887,83.481l-0.282,0.265l4.601,3.333
                        c15.639,12.36,34.686,20.593,55.5,23.067c0.073,0.009,0.146,0.016,0.22,0.025c1.337,0.156,2.68,0.292,4.031,0.401
                        c0.083,0.007,0.165,0.015,0.247,0.022c1.26,0.098,2.527,0.17,3.798,0.226c0.378,0.017,0.756,0.03,1.134,0.043
                        c1.103,0.037,2.21,0.061,3.321,0.066c0.16,0.001,0.318,0.009,0.478,0.009c0.161,0,0.321-0.009,0.483-0.01
                        c1.107-0.005,2.209-0.029,3.308-0.065c0.38-0.013,0.76-0.026,1.14-0.043c1.268-0.055,2.532-0.127,3.789-0.225
                        c0.082-0.006,0.163-0.015,0.245-0.022c1.345-0.108,2.683-0.243,4.014-0.398c0.079-0.009,0.159-0.018,0.239-0.027
                        c20.837-2.475,39.903-10.721,55.552-23.102l4.742-3.43l-0.308-0.272c23.128-20.331,37.73-50.131,37.73-83.342
                        C366.933,194.738,317.263,145.068,256,145.068z M253.434,349.832c-0.425-0.011-0.849-0.031-1.272-0.048
                        c-0.49-0.02-0.979-0.04-1.468-0.068c-0.368-0.021-0.735-0.045-1.101-0.07c-0.595-0.041-1.189-0.086-1.781-0.138
                        c-0.258-0.022-0.515-0.044-0.772-0.069c-12.318-1.181-24.139-4.782-34.941-10.546l20.718-11.304
                        c6.357-3.464,10.317-10.127,10.317-17.372v-14.404l-1.987-2.376c-1.171-1.401-3.143-4.247-5.144-8.131
                        c-1.899-3.684-3.376-7.534-4.273-11.44l-0.773-3.364l-2.894-1.881c-0.259-0.168-0.392-0.406-0.392-0.636v-12.365
                        c0-0.167,0.083-0.345,0.28-0.524l2.809-2.541v-21.674l-0.073-1.116c-0.176-2.512,0.297-5.758,1.908-8.713
                        c3.159-5.795,10.131-9.465,23.646-9.465c13.515,0,20.487,3.671,23.646,9.465c1.611,2.955,2.084,6.201,1.905,8.693
                        c-0.014,0.164-0.071,1.135-0.071,1.135v21.685l2.823,2.542c0.188,0.169,0.266,0.338,0.266,0.511v12.365
                        c0,0.284-0.219,0.572-0.562,0.678l-4.249,1.311l-1.36,4.233c-1.884,5.867-4.574,11.316-8.016,16.183
                        c-0.851,1.202-1.618,2.189-2.224,2.876l-2.133,2.419v14.813c0,7.496,4.229,14.349,10.931,17.707l22.06,11.027
                        c-9.909,5.192-20.665,8.575-31.867,9.946c-0.053,0.006-0.107,0.012-0.16,0.018c-0.78,0.094-1.563,0.176-2.347,0.25
                        c-0.275,0.026-0.55,0.05-0.826,0.073c-0.562,0.048-1.126,0.09-1.69,0.128c-0.375,0.025-0.749,0.051-1.125,0.071
                        c-0.465,0.026-0.93,0.044-1.396,0.064c-0.436,0.018-0.871,0.038-1.309,0.05c-0.388,0.01-0.778,0.012-1.167,0.018
                        c-0.457,0.007-0.913,0.017-1.371,0.017c-0.415,0-0.827-0.01-1.241-0.016C254.317,349.847,253.875,349.844,253.434,349.832z
                          M315.705,328.434c-0.437-0.246-0.872-0.495-1.321-0.72l-29.543-14.767c-0.925-0.465-1.508-1.41-1.508-2.448v-8.577
                        c0.399-0.529,0.807-1.087,1.22-1.671c3.761-5.318,6.811-11.134,9.118-17.317c4.985-3.196,8.204-8.749,8.204-14.947v-12.365
                        c0-3.628-1.11-7.076-3.089-9.97v-14.363c0.42-5.79-0.507-12.15-3.917-18.404c-6.323-11.597-19.172-18.362-38.63-18.362
                        s-32.307,6.765-38.63,18.362c-3.41,6.254-4.336,12.614-3.944,18.085c0.011,0.127,0.027,14.687,0.027,14.687
                        c-1.977,2.893-3.089,6.338-3.089,9.964v12.365c0,4.809,1.944,9.289,5.226,12.571c1.23,4.359,2.935,8.559,5.002,12.569
                        c1.815,3.521,3.644,6.443,5.234,8.671v8.421c0,0.996-0.544,1.911-1.42,2.388l-27.593,15.055
                        c-0.335,0.182-0.657,0.386-0.985,0.581c-20.731-17.219-33.934-43.188-33.934-72.24c0-51.838,42.029-93.867,93.867-93.867
                        c51.838,0,93.867,42.029,93.867,93.867C349.867,285.161,336.568,311.217,315.705,328.434z" />
                        </g>
                      </g>
                    </g>
                  </svg>
                  <span class="nav-link-text">Users</span>
                </a>
              <?php endif; ?>
              <button class="btn" id="openPopup" style="width: 27%;border-radius: 15px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-7z" />
                  <path
                    d="M3.5 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1H14a.5.5 0 0 1 0 1h-1v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5H2a.5.5 0 0 1 0-1h1.5zM5 5v7h6V5H5z" />
                </svg><br>
                <span class="nav-link-text">Profile</span></button>
              <br>
              <a href="../Php-Scripts/process.php?btn-logout=1" class="btn" name="btn-logout"
                style="display: flex;padding: 15px;flex-direction: column;width: 27%;border-radius: 15px;justify-content: center;align-items: baseline;">
                <svg width="24px" height="24px" viewBox="-2.4 -2.4 28.80 28.80" fill="none"
                  xmlns="http://www.w3.org/2000/svg" transform="rotate(180)" stroke="#ffffff"
                  style="position: relative;left: 15px;">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <path
                      d="M3.25 12C3.25 7.16751 7.16751 3.25 12 3.25C16.4943 3.25 20.1973 6.63843 20.6935 11H13.4142L14.7071 9.70711C15.0976 9.31658 15.0976 8.68342 14.7071 8.29289C14.3166 7.90237 13.6834 7.90237 13.2929 8.29289L10.2929 11.2929C9.90237 11.6834 9.90237 12.3166 10.2929 12.7071L13.2929 15.7071C13.6834 16.0976 14.3166 16.0976 14.7071 15.7071C15.0976 15.3166 15.0976 14.6834 14.7071 14.2929L13.4142 13H20.6935C20.1973 17.3616 16.4943 20.75 12 20.75C7.16751 20.75 3.25 16.8325 3.25 12Z"
                      fill="#ffffff"></path>
                  </g>
                </svg>
                <span class="nav-link-text">Logout</span>
              </a>
            </div>
            <?php else: ?>
              <div style="display: flex;width: 30%;margin-right: 15px;gap: 7.5px;justify-content: end;margin-top: 10px;">
                <button class="btn" id="openReport" style="width: 27%;border-radius: 15px;padding: 15px;">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="24" height="24" viewBox="0 0 24 24" stroke="#ffffff" stroke-width="0.00024000000000000003">

                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>

                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                  <g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" d="M16,2 C16.2652165,2 16.5195704,2.10535684 16.7071068,2.29289322 L21.7071068,7.29289322 C21.8946432,7.4804296 22,7.73478351 22,8 L22,15 C22,15.2339365 21.9179838,15.4604694 21.7682213,15.6401844 L16.7682213,21.6401844 C16.5782275,21.868177 16.2967798,22 16,22 L8,22 C7.73478351,22 7.4804296,21.8946432 7.29289322,21.7071068 L2.29289322,16.7071068 C2.10535684,16.5195704 2,16.2652165 2,16 L2,8 C2,7.73478351 2.10535684,7.4804296 2.29289322,7.29289322 L7.29289322,2.29289322 C7.4804296,2.10535684 7.73478351,2 8,2 L16,2 Z M15.5857864,4 L8.41421356,4 L4,8.41421356 L4,15.5857864 L8.41421356,20 L15.5316251,20 L20,14.6379501 L20,8.41421356 L15.5857864,4 Z M12,16 C12.5522847,16 13,16.4477153 13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 C11,16.4477153 11.4477153,16 12,16 Z M12,6 C12.5522847,6 13,6.44771525 13,7 L13,13 C13,13.5522847 12.5522847,14 12,14 C11.4477153,14 11,13.5522847 11,13 L11,7 C11,6.44771525 11.4477153,6 12,6 Z"></path> </g>
                  </svg>
                  <br>
                  <span class="nav-link-text">Report</span>
                </button>
              <br>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="profile-nav" style="width: 100%;display: flex;">
        <div class="center-section" style="width: 74.5%;">
          <ul class="nav custom-nav">
            <li class="nav-item" id="recentBtn" style="width: 50%;">
              <p class="nav-link active tab" data-tab="tab1">Posts</p>
            </li>
            <li class="nav-item" id="trendingBtn" style="width: 50%;">
              <p class="nav-link tab" style="margin: 0;" data-tab="tab2">Communities</p>
            </li>
          </ul>

          <span class="e-search-bar" id="searching" style="width: 100%;margin: 1rem 0rem 1rem 0rem;">
            <div style="display: flex;align-items: center;width: 100%;height: 30px;">
              <div class="search-icon"></div>
              <form action="./profile.php?id=<?php echo $_GET['id']; ?>" method="get" style="flex-grow: 1;">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="text" id="live_search" name="live_search" autocomplete="off" placeholder="Search Content">
              </form>
              <a href="./profile.php?id=<?php echo $_GET['id']; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                  xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" width="23px" height="23px" viewBox="0 0 32 32"
                  version="1.1" fill="#000000">

                  <g id="SVGRepo_bgCarrier" stroke-width="0" />

                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                  <g id="SVGRepo_iconCarrier">
                    <title>cross-circle</title>
                    <desc>Created with Sketch Beta.</desc>
                    <defs> </defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                      <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-568.000000, -1087.000000)"
                        fill="#e3694a">
                        <path
                          d="M584,1117 C576.268,1117 570,1110.73 570,1103 C570,1095.27 576.268,1089 584,1089 C591.732,1089 598,1095.27 598,1103 C598,1110.73 591.732,1117 584,1117 L584,1117 Z M584,1087 C575.163,1087 568,1094.16 568,1103 C568,1111.84 575.163,1119 584,1119 C592.837,1119 600,1111.84 600,1103 C600,1094.16 592.837,1087 584,1087 L584,1087 Z M589.717,1097.28 C589.323,1096.89 588.686,1096.89 588.292,1097.28 L583.994,1101.58 L579.758,1097.34 C579.367,1096.95 578.733,1096.95 578.344,1097.34 C577.953,1097.73 577.953,1098.37 578.344,1098.76 L582.58,1102.99 L578.314,1107.26 C577.921,1107.65 577.921,1108.29 578.314,1108.69 C578.708,1109.08 579.346,1109.08 579.74,1108.69 L584.006,1104.42 L588.242,1108.66 C588.633,1109.05 589.267,1109.05 589.657,1108.66 C590.048,1108.27 590.048,1107.63 589.657,1107.24 L585.42,1103.01 L589.717,1098.71 C590.11,1098.31 590.11,1097.68 589.717,1097.28 L589.717,1097.28 Z"
                          id="cross-circle" sketch:type="MSShapeGroup"> </path>
                      </g>
                    </g>
                  </g>

                </svg>

              </a>

            </div>
          </span>
          <div id="tab1" class="user_post active">
            <?php
            $id = $_GET['id'];
            //$qry = "SELECT topic.`topic_id`,topic.`title`,topic.`body`,topic.`user_id`,topic.`categories`,topic.`community_id`,topic.`created_at`,user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic INNER JOIN `users` user ON topic.`user_id` = user.`id` WHERE topic.user_id=$id ORDER BY topic.`created_at` DESC";
            if (isset($_GET['live_search']) && $_GET['live_search'] != '') {

              $search_topic = $_GET['live_search'];

              $qry = "SELECT 
            (SELECT COALESCE(SUM(vote.`vote_type`),0) FROM votes vote
            WHERE vote.vote_topic_id = topic.topic_id) as `total_votes`,
            COUNT(DISTINCT cmnt.`id`) as `total_cmnts`, 
            topic.*,
            user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic 
            INNER JOIN `users` user ON topic.`user_id` = user.`id` 
            LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id` 
            left JOIN discuss cmnt on cmnt.topic_id = topic.topic_id 
            WHERE topic.`user_id` = $id AND topic.title like '%$search_topic%'
            GROUP BY topic.`topic_id`
            ORDER BY topic.`created_at` DESC";
            } else {
              $qry = 'SELECT 
              (SELECT COALESCE(SUM(vote.`vote_type`),0) FROM votes vote
              WHERE vote.vote_topic_id = topic.topic_id) as `total_votes`,
              COUNT(DISTINCT cmnt.`id`) as `total_cmnts`, 
              topic.*,
              user.`id`,user.`firstname`,user.`lastname`,user.`username`,user.`profile_image` FROM `topic_data` topic 
              INNER JOIN `users` user ON topic.`user_id` = user.`id` 
              LEFT JOIN votes vote on vote.`vote_topic_id` = `topic`.`topic_id` 
              left JOIN discuss cmnt on cmnt.topic_id = topic.topic_id 
              WHERE topic.`user_id` = ' . $id . '
              GROUP BY topic.`topic_id`
              ORDER BY topic.`created_at` DESC';
            }
            $run = mysqli_query($con, $qry);

            if (!$run) {
              die();
            } else {
              if (mysqli_num_rows($run) > 0) {
                while ($row = mysqli_fetch_assoc($run)) { ?>
                  <div class="contain">
                    <div class="card card-custom" id="card" style="width:100%">
                      <div class="card-body" style="width: 100%;">
                        <div class="d-flex align-items-center mb-3" style="width: 98%;">
                          <img src="../Uploads/User-Data/<?php echo $row['profile_image']; ?>" alt="profile"
                            class="profile-pic" style="object-fit: cover;">
                          <div class="ms-2" style="width: 100%;">
                            <div style="display: flex;width: 100%;">
                              <strong style="width: 100%;"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></strong>
                              <i class="fas fa-ellipsis-v icon" style="color: whitesmoke;"></i>
                            </div>

                            <div style="width: 100%;display: flex;flex-grow: 1;">
                              <a class="small-text"
                                href="./profile.php?id=<?php echo $row['id']; ?>">p/<?php echo $row['username'] ?></a>
                              <span class="date"><?php
                              $format_date = date("d-M-Y", strtotime($row['created_at']));
                              echo $format_date; ?></span>&nbsp;
                            </div>
                          </div>
                        </div>
                        <div class="heading">
                          <h3 style="color: white;margin-bottom:2rem;"><strong><?php echo $row['title']; ?></strong></h3>
                        </div>
                        <<div class="content" style="color: white;margin-bottom:15px;display: none;"
                          id="content-<?php echo $row['topic_id']; ?>">
                          <?php echo $row['body'] ?>
                      </div>

                      <a href="#" id="toggle-<?php echo $row['topic_id']; ?>"
                        onclick="toggleData(<?php echo $row['topic_id']; ?>)"
                        style="color: white;text-decoration: none;display: flex;justify-content: center;gap: 10px;margin-bottom: 10px;">Show
                        More <span style="transform: rotate(-90deg);" ;>&lt;</span></a>

                      <div class="d-flex align-items-center" style="gap: 10px;height: 40px;color: white;">
                        <div class="votes">
                          <button id="btn-up-vote" onclick="vote(<?php echo $row['topic_id']; ?>,event)" data-type="+1"
                            data-user-id="<?php echo $_SESSION['user-details']['id']; ?>">
                            <p class="arrow <?php
                            if (voteExist($_SESSION['user-details']['id'], $row['topic_id'])) {
                              $checktype = voteExist($_SESSION['user-details']['id'], $row['topic_id']);
                              if ($checktype == 1) {
                                echo "up";
                              } else {
                                echo "";
                              }
                            }
                            ?>" id="up-arrow-<?php echo $row['topic_id']; ?>" style="transform: rotate(90deg);">&lt;
                            </p>
                          </button>
                          <p class="count" style="font-size: 1.1rem;width: 30px;text-align: center;"
                            id="vote-count-<?php echo $row['topic_id']; ?>"><?php echo $row['total_votes']; ?></p>
                          <button id="btn-up-vote" onclick="vote(<?php echo $row['topic_id']; ?>,event)" data-type="-1"
                            data-user-id="<?php echo $_SESSION['user-details']['id']; ?>">
                            <p class="arrow <?php
                            if (voteExist($_SESSION['user-details']['id'], $row['topic_id'])) {
                              $checktype = voteExist($_SESSION['user-details']['id'], $row['topic_id']);
                              if ($checktype != 1) {
                                echo "down";
                              } else {
                                echo "";
                              }
                            }
                            ?>" id="down-arrow-<?php echo $row['topic_id']; ?>" style="transform: rotate(-90deg)" ;>
                              &lt;</p>
                          </button>
                        </div>
                        <?php
                        if ($row['community_id'] != 0) { ?>
                          <a href="./community-topic.php?id=<?php echo $row['topic_id']; ?>"
                            style="text-decoration: none;color: white;flex-grow: 50;">
                            <div class="discuss">
                              <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00025">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                  <path
                                    d="M9.0001 8.517C8.58589 8.517 8.2501 8.85279 8.2501 9.267C8.2501 9.68121 8.58589 10.017 9.0001 10.017V8.517ZM16.0001 10.017C16.4143 10.017 16.7501 9.68121 16.7501 9.267C16.7501 8.85279 16.4143 8.517 16.0001 8.517V10.017ZM9.8751 11.076C9.46089 11.076 9.1251 11.4118 9.1251 11.826C9.1251 12.2402 9.46089 12.576 9.8751 12.576V11.076ZM15.1251 12.576C15.5393 12.576 15.8751 12.2402 15.8751 11.826C15.8751 11.4118 15.5393 11.076 15.1251 11.076V12.576ZM9.1631 5V4.24998L9.15763 4.25002L9.1631 5ZM15.8381 5L15.8438 4.25H15.8381V5ZM19.5001 8.717L18.7501 8.71149V8.717H19.5001ZM19.5001 13.23H18.7501L18.7501 13.2355L19.5001 13.23ZM18.4384 15.8472L17.9042 15.3207L17.9042 15.3207L18.4384 15.8472ZM15.8371 16.947V17.697L15.8426 17.697L15.8371 16.947ZM9.1631 16.947V16.197C9.03469 16.197 8.90843 16.23 8.79641 16.2928L9.1631 16.947ZM5.5001 19H4.7501C4.7501 19.2662 4.89125 19.5125 5.12097 19.6471C5.35068 19.7817 5.63454 19.7844 5.86679 19.6542L5.5001 19ZM5.5001 8.717H6.25012L6.25008 8.71149L5.5001 8.717ZM6.56175 6.09984L6.02756 5.5734H6.02756L6.56175 6.09984ZM9.0001 10.017H16.0001V8.517H9.0001V10.017ZM9.8751 12.576H15.1251V11.076H9.8751V12.576ZM9.1631 5.75H15.8381V4.25H9.1631V5.75ZM15.8324 5.74998C17.4559 5.76225 18.762 7.08806 18.7501 8.71149L20.2501 8.72251C20.2681 6.2708 18.2955 4.26856 15.8438 4.25002L15.8324 5.74998ZM18.7501 8.717V13.23H20.2501V8.717H18.7501ZM18.7501 13.2355C18.7558 14.0153 18.4516 14.7653 17.9042 15.3207L18.9726 16.3736C19.7992 15.5348 20.2587 14.4021 20.2501 13.2245L18.7501 13.2355ZM17.9042 15.3207C17.3569 15.8761 16.6114 16.1913 15.8316 16.197L15.8426 17.697C17.0201 17.6884 18.1461 17.2124 18.9726 16.3736L17.9042 15.3207ZM15.8371 16.197H9.1631V17.697H15.8371V16.197ZM8.79641 16.2928L5.13341 18.3458L5.86679 19.6542L9.52979 17.6012L8.79641 16.2928ZM6.2501 19V8.717H4.7501V19H6.2501ZM6.25008 8.71149C6.24435 7.93175 6.54862 7.18167 7.09595 6.62627L6.02756 5.5734C5.20098 6.41216 4.74147 7.54494 4.75012 8.72251L6.25008 8.71149ZM7.09595 6.62627C7.64328 6.07088 8.38882 5.75566 9.16857 5.74998L9.15763 4.25002C7.98006 4.2586 6.85413 4.73464 6.02756 5.5734L7.09595 6.62627Z"
                                    fill="#ffffff"></path>
                                </g>
                              </svg>
                              <p class="count" id="comments" style="margin: 0;"><?php echo $row['total_cmnts']; ?></p>
                            </div>
                          </a>
                          <a href="./community-profile.php?id=<?php echo $row['community_id']; ?>"
                            style="text-decoration: none;color: white;">
                            <i class="fa-solid fa-circle-plus" style="color: #e3694a;"></i>
                            <span class="small-text" id="community">View Community</span>
                          </a>
                          <?php
                        } else { ?>
                          <a href="./personal-topic.php?id=<?php echo $row['topic_id']; ?>"
                            style="text-decoration: none;color: white;flex-grow: 50;">
                            <div class="discuss">
                              <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00025">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                  <path
                                    d="M9.0001 8.517C8.58589 8.517 8.2501 8.85279 8.2501 9.267C8.2501 9.68121 8.58589 10.017 9.0001 10.017V8.517ZM16.0001 10.017C16.4143 10.017 16.7501 9.68121 16.7501 9.267C16.7501 8.85279 16.4143 8.517 16.0001 8.517V10.017ZM9.8751 11.076C9.46089 11.076 9.1251 11.4118 9.1251 11.826C9.1251 12.2402 9.46089 12.576 9.8751 12.576V11.076ZM15.1251 12.576C15.5393 12.576 15.8751 12.2402 15.8751 11.826C15.8751 11.4118 15.5393 11.076 15.1251 11.076V12.576ZM9.1631 5V4.24998L9.15763 4.25002L9.1631 5ZM15.8381 5L15.8438 4.25H15.8381V5ZM19.5001 8.717L18.7501 8.71149V8.717H19.5001ZM19.5001 13.23H18.7501L18.7501 13.2355L19.5001 13.23ZM18.4384 15.8472L17.9042 15.3207L17.9042 15.3207L18.4384 15.8472ZM15.8371 16.947V17.697L15.8426 17.697L15.8371 16.947ZM9.1631 16.947V16.197C9.03469 16.197 8.90843 16.23 8.79641 16.2928L9.1631 16.947ZM5.5001 19H4.7501C4.7501 19.2662 4.89125 19.5125 5.12097 19.6471C5.35068 19.7817 5.63454 19.7844 5.86679 19.6542L5.5001 19ZM5.5001 8.717H6.25012L6.25008 8.71149L5.5001 8.717ZM6.56175 6.09984L6.02756 5.5734H6.02756L6.56175 6.09984ZM9.0001 10.017H16.0001V8.517H9.0001V10.017ZM9.8751 12.576H15.1251V11.076H9.8751V12.576ZM9.1631 5.75H15.8381V4.25H9.1631V5.75ZM15.8324 5.74998C17.4559 5.76225 18.762 7.08806 18.7501 8.71149L20.2501 8.72251C20.2681 6.2708 18.2955 4.26856 15.8438 4.25002L15.8324 5.74998ZM18.7501 8.717V13.23H20.2501V8.717H18.7501ZM18.7501 13.2355C18.7558 14.0153 18.4516 14.7653 17.9042 15.3207L18.9726 16.3736C19.7992 15.5348 20.2587 14.4021 20.2501 13.2245L18.7501 13.2355ZM17.9042 15.3207C17.3569 15.8761 16.6114 16.1913 15.8316 16.197L15.8426 17.697C17.0201 17.6884 18.1461 17.2124 18.9726 16.3736L17.9042 15.3207ZM15.8371 16.197H9.1631V17.697H15.8371V16.197ZM8.79641 16.2928L5.13341 18.3458L5.86679 19.6542L9.52979 17.6012L8.79641 16.2928ZM6.2501 19V8.717H4.7501V19H6.2501ZM6.25008 8.71149C6.24435 7.93175 6.54862 7.18167 7.09595 6.62627L6.02756 5.5734C5.20098 6.41216 4.74147 7.54494 4.75012 8.72251L6.25008 8.71149ZM7.09595 6.62627C7.64328 6.07088 8.38882 5.75566 9.16857 5.74998L9.15763 4.25002C7.98006 4.2586 6.85413 4.73464 6.02756 5.5734L7.09595 6.62627Z"
                                    fill="#ffffff"></path>
                                </g>
                              </svg>
                              <p class="count" id="comments" style="margin: 0;"><?php echo $row['total_cmnts']; ?></p>
                            </div>
                          </a>
                          <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>

                  <div class="buttons" id="buttons">
                    <?php
                    $loggedInUserId = $_SESSION['user-details']['id'];
                    $profileId = $_GET['id'];
                    $isOwner = ($loggedInUserId == $profileId);
                    if ($isOwner): ?>
                      <button class="edit-btn" id="edit-btn-<?php echo $row['topic_id']; ?>"
                        onclick="editBtn(<?php echo $row['topic_id']; ?>)" name="edit-btn"
                        data-user-id="<?php echo $_SESSION['user-details']['id']; ?>">Edit</button>
                      <button class="delete-btn">Delete</button>
                    <?php endif; ?>
                    <?php
                    if ($profileId != $loggedInUserId) { ?>
                      <button name="report-btn" class="report-btn" id="report-btn">Report</button>
                      <?php
                    }
                    ?>
                  </div>


                  <!-- Popup for Delete Confirmation -->
                  <div class="popupDel" id="popupDel">
                    <div class="popup-content">
                      <p style="padding: 1rem;font-size: 18px;">Are you sure you want to delete this?</p>
                      <button class="btn-d" onclick="hidePopup()"><a style="color: whitesmoke;text-decoration: none;"
                          href="../Php-Scripts/update_profile.php?topic_id=<?php echo $row['topic_id']; ?>"
                          data-topic_id="'.$row['topic_id'].'">Yes, Delete</a></button>
                      <button class="btn-d cancel-btn">Cancel</button>
                    </div>
                  </div>

                  <!-- Popup for Report -->
                  <div class="popupReport" id="popupReport">
                    <div class="popup-content">
                      <button class="close-btn">&times;</button>
                      <h4 class="pop-head">Why are you reporting this topic?</h4>
                      <p class="description">Your report is anonymous . Others <br> will not be notified about it.</p>
                      <form action="../Php-Scripts/update_report.php" id="report-form" method="post">
                        <input type="hidden" name="redirection"
                          value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                        <input type="hidden" name="topic_id" value="<?php echo $row['topic_id']; ?>">
                        <button type="submit" class="content" name="report-btn" value="1">Bullying or unwanted
                          content</button>
                        <button type="submit" class="content" name="report-btn" value="2">Violence , Hate or
                          Exploitation</button>
                        <button type="submit" class="content" name="report-btn" value="3">Selling or promoting restricted
                          items</button>
                        <button type="submit" class="content" name="report-btn" value="4">Nudity or Sexual Activity</button>
                        <button type="submit" class="content" name="report-btn" value="5">Scam , Fraud or spam</button>
                        <button type="submit" class="content" name="report-btn" value="6">False Information</button>
                      </form>
                    </div>
                  </div>
                </div>
                <br>

                <?php
                }
              } else { ?>
              <div class="empty-card"
                style="height: 300px;margin-top: 50px;color: white;display: flex;align-items: center;justify-content: center;font-size: 1.5rem;border-radius: 12px;transition: 0.5s ease-in-out;flex-direction: column;gap: 15px;text-align: center;">
                <img src="../Visuals/Animation11.gif" style="width: 25%;border-radius: 12px;" alt="">
                <?php echo "Looks like " . $result['username'] . " hasn't <br> posted anything yet ..."; ?>
              </div>
              <?php
              }
            }
            ?>
          <br>
        </div>

        <div id="tab2" class="user_post">
          <?php
          $id = $_GET['id'];
          $qry = "SELECT community.*,
                        COUNT(uc.`user_id`) AS `total_user`,
                        user.`username` from community_data community 
                        LEFT JOIN `users` user on community.`owner_id` = user.`id` 
                        LEFT JOIN user_community_data uc ON `uc`.`community_id` = `community`.`id`
                        where community.`owner_id` = $id
                        GROUP BY community.id
                        ORDER BY created_at DESC";
          $run = mysqli_query($con, $qry);

          if (!$run) {
            die();
          } else {
            if (mysqli_num_rows($run) > 0) {
              while ($row = mysqli_fetch_assoc($run)) { ?>
                <a href="./community-profile.php?id=<?php echo $row['id'] ?>" style="text-decoration: none;color: white;">
                  <div class="community-card">
                    <img src="<?php echo $row['banner']; ?>" alt="cover-photo" width="21%" height="100%">
                    <div class="community-details">
                      <div class="title-section">
                        <h4 class="community-name" style="color: white;margin: 0;flex-grow: 1;">
                          <?php echo htmlspecialchars($row['community_name']); ?>
                        </h4>
                        <img src="../Visuals/Chevron down.png" alt="" width="30px" height="30px">
                      </div>
                      <div class="community-info">
                        <h3 class="owner-name" style="font-size: 1.1rem;color: #e3694a;margin: 0;flex-grow: 1;">
                          p/<?php echo htmlspecialchars($row['username']); ?></h3>
                        <h4 class="users-count"
                          style="font-size: 1.1rem;color: #898989;width: fit-content;margin: 0;font-weight: 600;">
                          <?php echo $row['total_user']; ?> Users
                        </h4>
                      </div>
                    </div>
                  </div>
                </a>
                <?php
              }
            } else { ?>
              <div class="empty-card"
                style="height: 300px;margin-top: 50px;color: white;display: flex;align-items: center;justify-content: center;font-size: 1.5rem;border-radius: 12px;transition: 0.5s ease-in-out;flex-direction: column;gap: 15px;text-align: center;">
                <img src="../Visuals/Animation11.gif" style="width: 25%;border-radius: 12px;" alt="">
                <?php echo "Looks like " . $result['username'] . " hasn't <br> created anything yet ..."; ?>
              </div>
            <?php }
          } ?>
        </div>
        <div id="tab3" class="user_post">
          <h2
            style="background: linear-gradient(135deg, #E64A19, #D84315);border-radius: 12px;padding: 10px;width: 100%;margin-top: 1rem;">
            <center>TOPIC HANDLING</center>
          </h2>
          <input type="text" id="search-input" class="e-search-bar" onkeyup="searchTable()"
            style="color: whitesmoke;width: 95%;margin: 1rem 0rem 1rem 0rem;margin-left: 1rem;border: none;outline: none;"
            placeholder="Search by Username or Topic Title...">
          <table id="topic-table"
            style="width: 100%;padding: 10px;background-color: rgba(255, 255, 255, 0.1);border-radius: 12px;margin: 10px 0px 20px 0px;"
            cellpadding="10px" text-align="center">
            <tr>
              <th style="text-align: center;">User Id</th>
              <th style="text-align: center;">Username</th>
              <th style="text-align: center;">Topic Id</th>
              <th style="text-align: center;">Topic Title</th>
              <th style="text-align: center;">No of Reports</th>
              <th style="text-align: center;">Action</th>
            </tr>
            <?php
            $qry = "SELECT user.id,user.username,topic.topic_id,topic.title,topic.report from users user INNER JOIN topic_data topic ON topic.user_id=user.id ORDER BY topic.report DESC;";
            $results = mysqli_query($con, $qry);
            while ($row = mysqli_fetch_array($results)) {
              ?>
              <tr>
                <td style="text-align: center;"><?php echo $row['id']; ?></td>
                <td style="text-align: center;"><?php echo $row['username']; ?></td>
                <td style="text-align: center;"><?php echo $row['topic_id']; ?></td>
                <td style="text-align: center;"><?php echo $row['title']; ?></td>
                <td style="text-align: center;"><?php echo $row['report']; ?></td>
                <td style="float: inline-end;"><button class="delete-btn">
                    <a style="color: whitesmoke;text-decoration: none;"
                      href="../Php-Scripts/update_profile.php?topic_id=<?php echo $row['topic_id']; ?>">
                      DELETE
                    </a>
                  </button>
                </td>
              </tr>
            <?php } ?>
          </table>
          <!-- Pagination Controls -->
          <div id="pagination" style="margin-bottom: 1rem;">
            <button id="prev-btn" onclick="changePage(-1)">❮ Prev</button>
            <span id="page-numbers"></span>
            <button id="next-btn" onclick="changePage(1)">Next ❯</button>
          </div>
          <br>
          <h2
            style="background: linear-gradient(135deg, #E64A19, #D84315);border-radius: 12px;padding: 10px;width: 100%;">
            <center>USER HANDLING</center>
          </h2>
          <input type="text" id="search-input1" class="e-search-bar" onkeyup="#"
            style="color: whitesmoke;width: 95%;margin: 1rem 0rem 1rem 0rem;margin-left: 1rem;border: none;outline: none;"
            placeholder="Search by Username...">
          <table id="user-table"
            style="width: 100%;padding: 10px;background-color: rgba(255, 255, 255, 0.1);border-radius: 12px;margin: 10px 0px 20px 0px;"
            cellpadding="10px" text-align="center">
            <tr>
              <th style="text-align: center;">User Id</th>
              <th style="text-align: center;">Username</th>
              <th style="text-align: center;">Email</th>
              <th style="text-align: center;">Created At</th>
              <th style="text-align: center;">No of Reports</th>
              <th style="text-align: center;">Action</th>
            </tr>
            <?php
            $qry = "SELECT id,username,email,created_at,report FROM users order by report desc";
            $results = mysqli_query($con, $qry);
            while ($row = mysqli_fetch_array($results)) {
              ?>
              <?php
              $adminId = 0;
              $id = $_SESSION['user-details']['id'];
              if ($adminId == $row['id']) {
                echo "";
              } else {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo $row['id']; ?></td>
                  <td style="text-align: center;"><?php echo $row['username']; ?></td>
                  <td style="text-align: center;"><?php echo $row['email']; ?></td>
                  <td style="text-align: center;"><?php echo $row['created_at']; ?></td>
                  <td style="text-align: center;"><?php echo $row['report']; ?></td>
                  <td style="float: inline-end;"><button class="delete-btn">
                      <a style="color: whitesmoke;text-decoration: none;"
                        href="../Php-Scripts/del_user.php?id=<?php echo $row['id']; ?>">
                        DELETE
                      </a>
                    </button>
                  </td>
                </tr>
              <?php }
            } ?>
          </table>
          <!-- Pagination Controls -->
          <div id="pagination1">
            <button id="prev-btn1" onclick="change_page(-1)">❮ Prev</button>
            <span id="page-numbers1"></span>
            <button id="next-btn1" onclick="change_page(1)">Next ❯</button>
          </div>
          <br>
          <h2
            style="background: linear-gradient(135deg, #E64A19, #D84315);border-radius: 12px;padding: 10px;width: 100%;">
            <center>COMMUNITY HANDLING</center>
          </h2>
          <input type="text" id="search-input-comm" class="e-search-bar" onkeyup="#"
            style="color: whitesmoke;width: 95%;margin: 1rem 0rem 1rem 0rem;margin-left: 1rem;border: none;outline: none;"
            placeholder="Search by Community Name...">
          <table id="comm-table"
            style="width: 100%;padding: 10px;background-color: rgba(255, 255, 255, 0.1);border-radius: 12px;margin: 10px 0px 20px 0px;"
            cellpadding="10px" text-align="center">
            <tr>
              <th style="text-align: center;">Community Id</th>
              <th style="text-align: center;">Name</th>
              <th style="text-align: center;">Username</th>
              <th style="text-align: center;">User Counts</th>
              <th style="text-align: center;">Action</th>
            </tr>
            <?php
            $qry = "SELECT community.id,community.community_name,community.owner_id,
                        COUNT(uc.`user_id`) AS `total_user`,
                        user.`username` from community_data community 
                        LEFT JOIN `users` user on community.`owner_id` = user.`id` 
                        LEFT JOIN user_community_data uc ON `uc`.`community_id` = `community`.`id`
                        GROUP BY community.id
                        ORDER BY community.created_at DESC";
            $results = mysqli_query($con, $qry);
            while ($row = mysqli_fetch_array($results)) {
              ?>
              <?php
              $adminId = 0;
              $id = $_SESSION['user-details']['id'];
              if ($adminId == $row['id']) {
                echo "";
              } else {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo $row['id']; ?></td>
                  <td style="text-align: center;"><?php echo $row['community_name']; ?></td>
                  <td style="text-align: center;"><?php echo $row['username']; ?></td>
                  <td style="text-align: center;"><?php echo $row['total_user']; ?></td>
                  <td style="float: inline-end;"><button class="delete-btn">
                      <a style="color: whitesmoke;text-decoration: none;"
                        href="../Php-Scripts/community_activity.php?id=<?php echo $row['id']; ?>&owner=<?php echo $row['owner_id']; ?>&profile=<?php echo $_GET['id']; ?>">
                        DELETE
                      </a>
                    </button>
                  </td>
                </tr>
              <?php }
            } ?>
          </table>
          <div id="pagination1">
            <button id="prev-btn2" onclick="change_page(-1)">❮ Prev</button>
            <span id="page-numbers_comm"></span>
            <button id="next-btn2" onclick="change_page(1)">Next ❯</button>
          </div>
        </div>
      </div>

      <div id="information" class="trending-panel" style="width: 24%;">
        <form id="profileForm" action="../Php-Scripts/update_profile.php" method="POST">
          <span id="title">Your Details</span>
          <?php
          $loggedInUserId = $_SESSION['user-details']['id'];
          $profileId = $_GET['id'];

          // Fetch user details
          $qry = "SELECT * FROM users WHERE id=$profileId";
          $query_run = mysqli_query($con, $qry);
          $user = mysqli_fetch_assoc($query_run);

          $isOwner = ($loggedInUserId == $profileId); // Check if profile belongs to logged-in user
          ?>

          <div class="input-container">
            <?php if ($isOwner): ?>
              <input id="firstname" name="firstname" spellcheck="false" type="text" autocomplete="off"
                value="<?php echo $user['firstname']; ?>">
              <span class="error-message"></span>
            <?php else: ?>
              <label class="lbl">Firstname :<br> <?php echo $user['firstname']; ?></label><br>
            <?php endif; ?>
          </div>
          <div class="input-container">
            <?php if ($isOwner): ?>
              <input id="lastname" name="lastname" spellcheck="false" type="text" autocomplete="off"
                value="<?php echo $user['lastname']; ?>">
              <span class="error-message"></span>
            <?php else: ?>
              <label class="lbl">Lastname :<br> <?php echo $user['lastname']; ?></label><br>
            <?php endif; ?>
          </div>

          <div class="input-container">
            <?php if ($isOwner): ?>
              <input id="username" name="username" spellcheck="false" type="text" autocomplete="off"
                value="<?php echo $user['username']; ?>">
              <span class="error-message"></span>
            <?php else: ?>
              <label class="lbl">Username :<br> <?php echo $user['username']; ?></label><br>
            <?php endif; ?>
          </div>

          <div class="input-container">
            <?php if ($isOwner): ?>
              <input id="email" name="email" spellcheck="false" type="email" value="<?php echo $user['email']; ?>">
              <span class="error-message"></span>
            <?php else: ?>
              <label class="lbl">Email : <br><?php echo $user['email']; ?></label><br>
            <?php endif; ?>
          </div>

          <?php if ($isOwner): ?>
            <div class="input-container">
              <a href="#" id="pass-link" class="cpwlink"
                style="font-size: 15px;float: right;text-decoration: none;color: whitesmoke;">Change Password?</a>
              <br><br><button name="update_user" type="submit" class="btn" id="update-profile-btn">Save</button>
            </div>
          </form>
          <div class="trending-panel" style="width: 100%;margin: 0;height: auto;background-color: transparent;">
            <form id="passwordsection" action="../Php-Scripts/update_profile.php" method="POST">
              <div class="cpw">
                <div class="input-container">
                  <label>New Password</label>
                  <input id="password" spellcheck="false" value="<?php echo $user['password']; ?>" name="password"
                    type="password">
                  <span class="error-message1"></span>
                </div>
                <div class="input-container">
                  <label>Confirm Password</label>
                  <input id="cpassword" spellcheck="false" name="cpassword" type="password">
                  <span class="error-message1"></span>
                </div>
                <button name="update_pw" type="submit" class="btn">Change</button>
              </div>
          </div>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>

  </div>
  </div>
  </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <?php include('../Php-Scripts/popup.php'); ?>
  <div id="popupContainer" class="popup-container">
    <div class="popup-box">
      <h2>PIXO PROFILE</h2>
      <button class="close-btn" type="button" id="closePopup">&times;</button>
      <center>
        <form action="../Php-Scripts/update_profile.php" method="POST" enctype="multipart/form-data">
          <div id="image_container" style="height: 20rem;width: 20rem;">
            <?php
            // $id=$_SESSION['user-details']['id'];
            $qry = "select id,profile_image from users where id=$id";
            $query_run = mysqli_query($con, $qry);
            $result = mysqli_fetch_assoc($query_run);
            ?>
            <img src="<?php
            echo "../Uploads/User-Data/" . $result['profile_image'];
            ?>" id="image_cropper" style="display: block;height: inherit;">
          </div><br>
          <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
          <input name="profile_image_new" style="width: 17rem;padding: 0.5rem;"
            class="form-control form-control-sm border border-primary rounded-pill" type="file" id="browse_image"><br>
          <input type="hidden" name="profile_image_old" value="<?php echo $result['profile_image']; ?>">

          <button id="crop_button" type="button"
            style="background: #d13c23;padding: 0.5rem;border-radius: 30px;width: 10rem;color: whitesmoke;font-size: large;border: none;outline: none;">Preview</button>
          <button type="submit" name="update_profile"
            style="background: #d13c23;padding: 0.5rem;border-radius: 30px;width: 10rem;color: whitesmoke;font-size: large;border: none;outline: none;">Save</button>
        </form>
      </center>
    </div>
  </div>
  <div id="popup_del_profile" class="popup_del_profile">
    <form action="../Php-Scripts/del_user.php" method="POST"
      style="display: flex;flex-direction: column;align-items: center;">
      <h2>PIXO PROFILE</h2>
      <button class="close-btn" type="button" id="closeBtn">&times;</button>
      <p style="text-align: center;">Are you sure you want to delete Your Profile?</p>
      <button type="submit" name="del_user" class="delete-profile-confirmation">Yes</button>
    </form>
  </div>

  <!-- Popup for Report -->
  <div class="popupReport" id="popupReport_User">
    <div class="popup-content">
      <button class="close-btn">&times;</button>
      <h4 class="pop-head">Why are you reporting this User?</h4>
      <p class="description">Your report is anonymous . Others <br> will not be notified about it.</p>
      <form action="../Php-Scripts/update_report.php?report_type=user" id="report-form" method="post">
        <input type="hidden" name="redirection"
          value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="victim_id" value="<?php echo $_GET['id']; ?>">
        <button type="submit" class="content" name="report-btn" value="1">Bullying or unwanted
          content</button>
        <button type="submit" class="content" name="report-btn" value="2">Violence , Hate or
          Exploitation</button>
        <button type="submit" class="content" name="report-btn" value="3">Selling or promoting restricted
          items</button>
        <button type="submit" class="content" name="report-btn" value="4">Nudity or Sexual Activity</button>
        <button type="submit" class="content" name="report-btn" value="5">Scam , Fraud or spam</button>
        <button type="submit" class="content" name="report-btn" value="6">False Information</button>
      </form>
    </div>
  </div>

  <?php
  if (isset($_SESSION['report']) && $_SESSION['report'] == true) { ?>
    <script>
      toastr.success("Reported Successfully.", "Pixo | Notification", { timeout: 4000 });
    </script>
    <?php
    unset($_SESSION['report']);
  }
  ?>
  <?php
  if (isset($_SESSION['reported']) && $_SESSION['reported'] = true) { ?>
    <script>
      toastr.error("You have already reported.", "Pixo | Notification", { timeout: 4000 });
    </script>
    <?php
    unset($_SESSION['reported']);
  }
  ?>
  <?php
  if (isset($_SESSION['profile-img']) && $_SESSION['profile-img'] = true) { ?>
    <script>
      toastr.success("Profile has been updated .", "Pixo | Notification", { timeout: 4000 });
    </script>
    <?php
    unset($_SESSION['profile-img']);
  }
  ?>
  <script>
    $(document).ready(function () {
      $(".tab").click(function () {
        var tabId = $(this).attr("data-tab");

        // Remove active class from all tabs and add to clicked tab
        $(".tab").removeClass("active");
        $(this).addClass("active");

        // Hide all content divs and show the selected one
        $(".user_post").removeClass("active");
        $("#" + tabId).addClass("active");

        const tab1 = document.getElementById('tab1');
        if (tab1 && tab1.classList.contains('active')) {
          document.querySelector('.e-search-bar').style.display = "flex";
        }

        const tab2 = document.getElementById('tab2');
        if (tab2 && tab2.classList.contains('active')) {
          document.querySelector('.e-search-bar').style.display = "none";
        }

        const tab3 = document.getElementById('tab3');
        if (tab3 && tab3.classList.contains('active')) {
          document.querySelector('.e-search-bar').style.display = "none";
        }
      });

    });

  </script>
  <script src="../Content/JS/sidebar.js"></script>
  <script src="../Content/JS/popup.js"></script>
  <script src="../Content/JS/cropper.js"></script>
  <script src="../Content/JS/vote.js"></script>
  <script src="../Content/JS/pagination.js"></script>


</body>

</html>