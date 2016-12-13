var vidContainer;

// Event listener for the Camera button
var photoButton = document.getElementById('snapPic');
photoButton.addEventListener('click', picCapture, false);

// Cross-browser compatibility
navigator.getUserMedia  = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia;

if (navigator.getUserMedia) {
    navigator.getUserMedia({video: true}, onSuccess, onError);
} else {
    alert('Your browser does not support getUserMedia(), so the camera will not work.');
}

// If the user's browser supports getUserMedia(), start streaming video
function onSuccess(stream) {
    vidContainer = document.getElementById('video-stream');
    var vidStream;

    // Cross-browser compatibility
    if (window.URL) {
        vidStream = window.URL.createObjectURL(stream);        
    } else {
        vidStream = stream;
    }

    vidContainer.autoplay = true;
    vidContainer.src = vidStream;
}

function onError() {
    alert('There was a problem connecting with your camera.');
}

// When they click the camera button, capture the image and display it below the button
function picCapture() {
    var picture = document.getElementById('capture');
    var context = picture.getContext('2d');

    picture.width = "265";
    picture.height = "200";

    context.drawImage(vidContainer, 0, 0, picture.width, picture.height);
/*    var dataURL = picture.toDataURL();
    document.getElementById('canvasImg').src = dataURL;*/
}