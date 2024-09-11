function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var defaultImage = document.getElementById('defaultImage');
        var darkImage = document.getElementById('darkImage');
        defaultImage.src = reader.result;
        darkImage.src = reader.result;
        darkImage.style.display = 'block';
    }

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('basicFormFile').addEventListener('change', previewImage);