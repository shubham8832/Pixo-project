let cropper;

document.getElementById("browse_image").addEventListener("change", function (e) {
    var files = e.target.files;
    if (files && files.length > 0) {
        var file = files[0];
        var url = URL.createObjectURL(file);

        var image = document.getElementById("image_cropper");
        image.src = url;
        image.style.display = "block";

        // Destroy previous cropper instance if exists
        if (cropper) {
            cropper.destroy();
        }

        // Initialize Cropper with circular view
        cropper = new Cropper(image, {
            aspectRatio: 1, // Ensures a perfect square crop
            viewMode: 1, // Ensures the image fits within the crop box
            dragMode: "move",
            autoCropArea: 1, // Uses the entire image for cropping
            cropBoxResizable: false, // Prevents resizing the crop box
            background: false,
            ready: function () {
                document.querySelector(".cropper-view-box").style.borderRadius = "50%";
            }
        });
    }
});

document.getElementById("crop_button").addEventListener("click", function () {
    if (cropper) {
        var croppedCanvas = cropper.getCroppedCanvas({ width: 200, height: 200 });

        // Replace the image with the cropped one
        var image = document.getElementById("image_cropper");
        image.src = croppedCanvas.toDataURL();
        
        // Destroy Cropper after cropping
        cropper.destroy();
    }
});
