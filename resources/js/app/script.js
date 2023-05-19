
const burgerMenu = document.querySelector('.hamb__field')
const popup = document.querySelector('.popup')
const spanBar = burgerMenu.querySelectorAll('.bar')
const mainMenu = document.querySelector ('.buttons__account')

burgerMenu.addEventListener('click', clickOnTheBurger)

function clickOnTheBurger () {
    popup.classList.toggle('active')
    spanBar.forEach(item => {
        item.classList.toggle('turn')
    });
    popup.append(mainMenu)
}





let bg = document.querySelector('.registration-cssave');
if (bg !== null) {
    console.log(bg)
    window.addEventListener('mousemove', function(e) {
        let x = e.clientX / window.innerWidth;
        let y = e.clientY / window.innerHeight;  
        bg.style.transform = 'translate(-' + x * 50 + 'px, -' + y * 50 + 'px)';
    });
}
