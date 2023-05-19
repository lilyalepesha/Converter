window.onload = function () {
    let preloader = document.getElementById('preloader');
    document.querySelector('.body__index').classList.remove('noscroll')
    preloader.style.opacity = "0"
    setTimeout( () => {
        preloader.style.display = 'none'
    },1100)
}