
const hidden_activ = document.querySelectorAll('.input_block_select')
const select_item = document.querySelectorAll('.select__item')

hidden_activ.forEach(i => {
    i.addEventListener('click',selectToggle)
});

select_item.forEach(i => {
    i.addEventListener('click',selectText)
});


function selectToggle(){
    let lines = this.querySelector('.line')
    lines.classList.toggle('line_animation')
    this.parentElement.classList.toggle('isActiv')
}


function selectText()
{

    let innerText = this.dataset.value
    let currentText = this.closest('.select__input').querySelector('.info_block_select')
    let delActiv = this.closest('.select__input')
    delActiv.classList.remove('isActiv')
    let lines = this.closest('.select__input').querySelector('.line')
    lines.classList.toggle('line_animation')
    let hiddenInput = this.closest('.select__input').querySelector('.value_select')
    hiddenInput.value = innerText;
    console.log(hiddenInput)
    currentText.innerText = innerText
}

