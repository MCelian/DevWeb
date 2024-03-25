function afficherImage(image){
    var overlay = document.getElementById('popup-overlay');
    var popup = document.getElementById('popup');
    var imageZoome = document.getElementById('image-popup');
    imageZoome.src = image.src;
    imageZoome.alt = image.alt;
    popup.style.display = 'block';
    overlay.style.display = 'block';
}

function fermerImage(){
    var overlay = document.getElementById('popup-overlay');
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
    overlay.style.display = 'none';
}