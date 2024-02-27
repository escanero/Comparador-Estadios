document.addEventListener('DOMContentLoaded', function() {
    // Obtener el contenedor del slider
    const sliderContainer = document.getElementById('slider-container');
    
    // Obtener todas las imágenes del slider
    const images = sliderContainer.getElementsByTagName('img');

    // Ocultar todas las imágenes excepto la primera
    for (let i = 1; i < images.length; i++) {
        images[i].style.display = 'none';
    }

    // Definir el índice de la imagen actual
    let currentIndex = 0;

    // Función para cambiar la imagen actual del slider
    function changeImage() {
        // Ocultar la imagen actual
        images[currentIndex].style.display = 'none';

        // Incrementar el índice de la imagen actual
        currentIndex = (currentIndex + 1) % images.length;

        // Mostrar la siguiente imagen
        images[currentIndex].style.display = 'block';
    }

    // Iniciar el cambio de imágenes cada 1 segundo
    setInterval(changeImage, 1000);
});
