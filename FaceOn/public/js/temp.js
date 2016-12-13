<script>
// Checks for the existence of navigator.getUserMedia -- needed for Camera access
function hasGetUserMedia() {
    return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia || navigator.msGetUserMedia);
}

if (hasGetUserMedia()) {
    // Good to go!
} else {
    alert('getUserMedia() is not supported in your browser');
}

// Gaining access to an input device
var errorCallback = function(e) {
    console.log('Reeeejected!', e);
};

// Cross-browser compatibility
navigator.getUserMedia  = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia;

var video = document.querySelector('video');

if (navigator.getUserMedia) {
    navigator.getUserMedia({video: true}, function(stream) {
        video.src = window.URL.createObjectURL(stream);
    }, errorCallback);
} else {
    video.src = 'trailer.webm'; // fallback.
}
</script>




<script>
// Photo Booth application with realtime video
var video = document.querySelector('video');
var canvas = document.querySelector('canvas');
var ctx = canvas.getContext('2d');
var localMediaStream = null;

function snapshot() {
    if (localMediaStream) {
        ctx.drawImage(video, 0, 0);
        // "image/webp" works in Chrome.
        // Other browsers will fall back to image/png.
        document.querySelector('img').src = canvas.toDataURL('image/webp');
    }
}

video.addEventListener('click', snapshot, false);

// Not showing vendor prefixes or code that works cross-browser.
navigator.getUserMedia({video: true}, function(stream) {
    video.src = window.URL.createObjectURL(stream);
    localMediaStream = stream;
}, errorCallback);
</script>