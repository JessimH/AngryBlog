'use strict'

const darkBtn = document.querySelector('.darkmode')
const body = document.getElementById('body')
const hand = document.getElementById('hand')
const links = document.querySelectorAll('.link')

darkBtn.addEventListener('click', function(e){

    body.classList.toggle('dark')

    body.className === 'dark' ? darkBtn.style.backgroundColor = 'white' : darkBtn.style.backgroundColor = 'black';
    
    for(let link of links){
        link.classList.toggle('dark')
    }
    
    hand.textContent ==="👈" ? hand.textContent = "👉" : hand.textContent ="👈"
            
})