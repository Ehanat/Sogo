let categorys = document.querySelectorAll('.category li')

categorys.forEach(category =>{
    category.addEventListener('click', ()=>{
        if(!category.classList.contains('selected_category')){
            resetSelectCategory();
            category.classList.add('selected_category')
        }
    })
})
function resetSelectCategory(){
    categorys.forEach(category =>{
        category.classList.remove('selected_category')
    })
}


// let addToCardBbn = document.querySelectorAll('.add-cart')
// let buttonload = document.querySelector('.add-cart .buttonload')
// let btnCheck = document.querySelector('.add-cart .btnCheck')
// addToCardBbn.forEach(addToCard => {
//     addToCard.addEventListener('click', (e)=>{
//         e.preventDefault()
//         buttonload.style.display = 'block'
//         setTimeout(()=>{
//             buttonload.style.display = 'none'
//             btnCheck.style.display = 'block'
//             setTimeout(() => {
//                 btnCheck.style.display = 'none'
//             }, 200);
//         },300)
//     })
// });

const qty = document.querySelector('.qty input')
const minus = document.querySelector('.qty .minus')
const plus = document.querySelector('.qty .plus')
minus.addEventListener('click', ()=>{
    let qtyValue = parseInt(qty.value)
    if(qtyValue > 1) qty.value = qtyValue - 1
})

plus.addEventListener('click', ()=>{
    let qtyValue = parseInt(qty.value)
    qty.value = qtyValue + 1
})


// image Details
const big_are = document.querySelector('.big_area')
const smallimg = document.getElementsByClassName("small-img");
const smallVedo = document.querySelector('.small_video')

smallVedo.onclick = function(){
    big_are.innerHTML = `
    <video controls autoplay muted width="100%">
    <source src="${smallVedo.src}">
    </source>
    </video>`
}

smallimg[0].onclick = function() {
    big_are.innerHTML = 
    `
    <img src="${smallimg[0].src}" alt="">
    `
}
smallimg[1].onclick = function() {
    big_are.innerHTML = 
    `
    <img src="${smallimg[1].src}" alt="">
    `
}
smallimg[2].onclick = function() {
    big_are.innerHTML = 
    `
    <img src="${smallimg[2].src}" alt="">
    `
}
smallimg[3].onclick = function() {
    big_are.innerHTML = 
    `
    <img src="${smallimg[3].src}" alt="">
    `
}


// Color
const select = document.querySelector('.select')
const COLOR_BTNS = document.querySelectorAll('.color');
const size_btn = document.querySelectorAll('.size');
const product_size = document.getElementsByClassName('product_size')
const product_color = document.getElementsByClassName('product_color')

COLOR_BTNS.forEach(color => {
    color.addEventListener('click', () => {
        if (!color.classList.contains('active-color')) {
            resetActiveBtns();
            color.classList.add('active-color');
        }
        product_color[0].value = get_color()
    });
})

// look through all colors and return the one selected
function get_color(){
    let colorValue
    COLOR_BTNS.forEach(color =>{
        if(color.classList.contains('active-color')){
            let classNames = color.className
            let classArr = classNames.split(' ')
            colorValue = classArr[2].split('-')[1]
        }
    })
    return colorValue
}

size_btn.forEach(size => {
    size.addEventListener('click', () => {
        let sizeNameClass = size.className;
        if (!size.classList.contains('select_size')) {
            resetSizebtns();
            size.classList.add('select_size');
            size.classList.remove('unselect_size');
            product_size[0].value = size.innerHTML
        }
    })
})

function get_size(){
    let sizeValue
    size_btn.forEach(size =>{
        if(size.classList.contains('select_size')){
            sizeValue = size.innerHTML
        }
    })
    return sizeValue
}

//resetting all color btns
function resetActiveBtns() {
    COLOR_BTNS.forEach(color => {
        color.classList.remove('active-color');
    });
}

function resetSizebtns() {
    size_btn.forEach(size => {
        size.classList.remove('select_size');
        size.classList.add('unselect_size');
    })
}


// add to card 
// const addToCardFrom = document.getElementById('addToCard_form')
// addToCardFrom.addEventListener('submit',(e)=>{
//     // e.preventDefault()
//     console.log('submitted')
// })