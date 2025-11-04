//this is for video call api config
const appID = "b92830c3ba244a8db037319654e7c34d";
const token = "007eJxTYDjZ/vkbV6vjzJ6V3rMauI2XnePVdOUOY8j5yBCxMXvuShYFhiRLIwtjg2TjpEQjE5NEi5QkA2NzY0NLM1OTVPNkY5MUg93f0hsCGRn2dFgwMzJAIIjPx+BcWlySn6sQUJSflZpcwsAAABBYIW8=";
const channelName = "Custom Project";

const client = AgoraRTC.createClient({mode:'rtc', codec:'vp8'})

let localTracks = [];
let remoteUsers = {};
let notifiedUsers = {};
let notifiedLocalUser = {};

let userDetailsMap = {};

let joinAndDisplayLocalStream = async (id,username,profilesrc) => {

    client.on('user-published',handleUserJoined);
    client.on('user-left',handleUserLeft);

    let UID = await client.join(appID,channelName,token,null);
    userDetailsMap[UID] = {id,username,profilesrc};

    localTracks = await AgoraRTC.createMicrophoneAndCameraTracks();

    let player = `
        <div class="video-container" id="user-container-${UID}">
            <div class="video-player" id="user-${UID}"></div>
        </div>
    `;

    if(document.getElementById('video-card') != null){
        document.getElementById('video-card').insertAdjacentHTML('beforeend',player);
    }
    
    localTracks[1].play(`user-${UID}`);

    await client.publish([localTracks[0],localTracks[1]])

    if(!notifiedLocalUser[UID]){
        openToast('success','joined');
        notifiedLocalUser[UID] = true;
    }
    //openToast('success','joined');
}

//joinStream and JoinAndDisplayLocalStream function is triggered if local user joins the call 
let joinStream = async (id,username,profilesrc) => {
    await joinAndDisplayLocalStream(id,username,profilesrc);
    document.querySelector('.empty-room').style.display = "none";
    document.getElementById('video-card').style.display = "grid";
    document.querySelector('.stream-controls').style.display = "flex";
}


//this function is triggered if remote user joins the call

let handleUserJoined = async (user,mediaType) => {
    remoteUsers[user.uid] = user;
    await client.subscribe(user,mediaType);

    if(mediaType === 'video'){
        let player = document.getElementById(`user-container-${user.uid}`);
        if(player != null){
            player.remove();
        }
        player = `
            <div class="video-container" id="user-container-${user.uid}">
                <div class="video-player" id="user-${user.uid}"></div>
            </div>
        `;

        if(document.getElementById('video-card') != null){
            document.getElementById('video-card').insertAdjacentHTML('beforeend',player);
        }
        user.videoTrack.play(`user-${user.uid}`);
    }
    if(mediaType === 'audio'){
        user.audioTrack.play();
    }

    if(!notifiedUsers[user.uid]){
        openToast('success','joined');
        notifiedUsers[user.uid] = true;
    }
}

let handleUserLeft = async (user) => {
    document.getElementById(`user-container-${user.uid}`).remove();
    delete remoteUsers[user.uid];
    openToast('info','left');
}

let leaveAndRemoveLocalStream = async () => {
    for(let i = 0;localTracks.length > i; i++){
        localTracks[i].stop();
        localTracks[i].close();
    }
    await client.leave();
    
    document.querySelector('.empty-room').style.display = "flex";
    document.querySelector('.stream-controls').style.display = "none";
    document.getElementById('video-card').innerHTML = '';
    document.getElementById('video-card').style.display = 'none';
    openToast('info','left');
}

let toggleCamera = async () => {
    if(localTracks[1].muted){
        await localTracks[1].setMuted(false);
        document.getElementById('toggleCam-btn').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"fill="none">

                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M16 10L18.5768 8.45392C19.3699 7.97803 19.7665 7.74009 20.0928 7.77051C20.3773 7.79703 20.6369 7.944 20.806 8.17433C21 8.43848 21 8.90095 21 9.8259V14.1741C21 15.099 21 15.5615 20.806 15.8257C20.6369 16.056 20.3773 16.203 20.0928 16.2295C19.7665 16.2599 19.3699 16.022 18.5768 15.5461L16 14M6.2 18H12.8C13.9201 18 14.4802 18 14.908 17.782C15.2843 17.5903 15.5903 17.2843 15.782 16.908C16 16.4802 16 15.9201 16 14.8V9.2C16 8.0799 16 7.51984 15.782 7.09202C15.5903 6.71569 15.2843 6.40973 14.908 6.21799C14.4802 6 13.9201 6 12.8 6H6.2C5.0799 6 4.51984 6 4.09202 6.21799C3.71569 6.40973 3.40973 6.71569 3.21799 7.09202C3 7.51984 3 8.07989 3 9.2V14.8C3 15.9201 3 16.4802 3.21799 16.908C3.40973 17.2843 3.71569 17.5903 4.09202 17.782C4.51984 18 5.07989 18 6.2 18Z"
                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </g>

            </svg>
        `;
        //e.target.parentElement.style.backgroundColor = "transparent";
    }
    else{
        await localTracks[1].setMuted(true);
        document.getElementById('toggleCam-btn').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                <g id="SVGRepo_iconCarrier"> <path d="M11.65 6H12.8C13.9201 6 14.4802 6 14.908 6.21799C15.2843 6.40973 15.5903 6.71569 15.782 7.09202C16 7.51984 16 8.0799 16 9.2V10L18.5768 8.45392C19.3699 7.97803 19.7665 7.74009 20.0928 7.77051C20.3773 7.79703 20.6369 7.944 20.806 8.17433C21 8.43848 21 8.90095 21 9.8259V14.1741C21 14.679 21 15.0462 20.9684 15.3184M3 3L6.00005 6.00005M21 21L15.9819 15.9819M6.00005 6.00005C5.01167 6.00082 4.49359 6.01337 4.09202 6.21799C3.71569 6.40973 3.40973 6.71569 3.21799 7.09202C3 7.51984 3 8.07989 3 9.2V14.8C3 15.9201 3 16.4802 3.21799 16.908C3.40973 17.2843 3.71569 17.5903 4.09202 17.782C4.51984 18 5.07989 18 6.2 18H12.8C13.9201 18 14.4802 18 14.908 17.782C15.2843 17.5903 15.5903 17.2843 15.782 16.908C15.9049 16.6668 15.9585 16.3837 15.9819 15.9819M6.00005 6.00005L15.9819 15.9819" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>

            </svg>
        `;
        //e.target.style.backgroundColor = "red";
    }
}

let toggleMic = async () => {
    if(localTracks[0].muted){
        await localTracks[0].setMuted(false);
        document.getElementById('toggleMic-btn').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="24px" height="24px" viewBox="0 0 1920 1920">

                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M960.315 96.818c-186.858 0-338.862 152.003-338.862 338.861v484.088c0 186.858 152.004 338.862 338.862 338.862 186.858 0 338.861-152.004 338.861-338.862V435.68c0-186.858-152.003-338.861-338.861-338.861M427.818 709.983V943.41c0 293.551 238.946 532.497 532.497 532.497 293.55 0 532.496-238.946 532.496-532.497V709.983h96.818V943.41c0 330.707-256.438 602.668-580.9 627.471l-.006 252.301h242.044V1920H669.862v-96.818h242.043l-.004-252.3C587.438 1546.077 331 1274.116 331 943.41V709.983h96.818ZM960.315 0c240.204 0 435.679 195.475 435.679 435.68v484.087c0 240.205-195.475 435.68-435.68 435.68-240.204 0-435.679-195.475-435.679-435.68V435.68C524.635 195.475 720.11 0 960.315 0Z"
                        fill-rule="evenodd"></path>
                </g>

            </svg>
        `;
    }
    else{
        await localTracks[0].setMuted(true);
        document.getElementById('toggleMic-btn').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" width="24px" height="24px" viewBox="0 0 1920 1920">

                <g id="SVGRepo_bgCarrier" stroke-width="0"/>

                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

                <g id="SVGRepo_iconCarrier"> <path d="M621.452 435.678c0-186.858 152.004-338.862 338.862-338.862 159.316 0 293.306 110.504 329.336 258.896L724.351 1162.76c-63.433-61.62-102.899-147.78-102.899-242.994V435.678Zm46.834 807.122c-88.168-79.79-143.65-195.06-143.65-323.033V435.679C524.636 195.475 720.111 0 960.315 0c176.955 0 329.645 106.09 397.775 257.997L1538.8 0l92.38 64.669L333.381 1917.48 241 1852.81l305.287-435.84C414.414 1301.53 331 1132.02 331 943.411V709.984h96.818v233.427c0 155.809 67.319 296.239 174.392 393.719l66.076-94.33Zm292.028 15.83c-9.387 0-18.687-.39-27.883-1.14l-62.071 88.62c29.036 6.12 59.127 9.34 89.955 9.34 240.205 0 435.675-195.48 435.675-435.683V595.685l-96.81 138.223v185.858c0 186.854-152.01 338.864-338.866 338.864Zm-162.996 191.75-57.715 82.4c54.294 20.4 112.13 33.5 172.305 38.1v252.3H669.861V1920h580.909v-96.82h-242.044v-252.3c324.464-24.8 580.904-296.76 580.904-627.469V709.984h-96.82v233.427c0 293.549-238.94 532.499-532.495 532.499-56.824 0-111.602-8.96-162.997-25.53Z" fill-rule="evenodd"/> </g>

            </svg>
        `;
    }
}

//document.getElementById('stream-join').addEventListener('click',joinStream);
document.getElementById('leave-btn').addEventListener('click',leaveAndRemoveLocalStream);
document.getElementById('toggleCam-btn').addEventListener('click',toggleCamera);
document.getElementById('toggleMic-btn').addEventListener('click',toggleMic);

//notification logic

const toast = document.querySelector("#toast");
const toastTimer = document.querySelector("#timer");
const closeToastBtn = document.querySelector("#toast-close");
let countdown;

const closeToast = () => {
  toast.style.animation = "close 0.3s cubic-bezier(.87,-1,.57,.97) forwards";
  toastTimer.classList.remove("timer-animation");
  clearTimeout(countdown)
}

const openToast = (type,use) => {
  toast.style.display = "flex";
  if(use == 'joined'){
    document.getElementById('toast-head').innerHTML = "Pixo | Notification";
    document.getElementById('toast-notify').innerHTML = "User has Joined";
  }
  if(use == 'left'){
    document.getElementById('toast-head').innerHTML = "Pixo | Notification";
    document.getElementById('toast-notify').innerHTML = "User has Left";
  }
  toast.classList = [type];
  toast.style.animation = "open 0.3s cubic-bezier(.47,.02,.44,2) forwards";
  toastTimer.classList.add("timer-animation");
  clearTimeout(countdown)
  countdown = setTimeout(() => {
    closeToast();
  }, 5000)
}

closeToastBtn.addEventListener("click", closeToast)
