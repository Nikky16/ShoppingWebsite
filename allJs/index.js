console.log("Welcome to index js");

let sign = document.getElementById('sign');
let log = document.getElementById('log');
log.style.display = 'block';
sign.style.display = 'none';

let signinForm = document.getElementById('signinForm');
let loginForm = document.getElementById('loginForm');

signinForm.addEventListener('click', ()=>{
    sign.style.display = 'block';
    log.style.display = 'none';
})

loginForm.addEventListener('click', ()=>{
    sign.style.display = 'none';
    log.style.display = 'block';
})

let allAlerts = document.getElementsByClassName('allAlerts');
Array.from(allAlerts).forEach((alert)=>{
    setTimeout(() => {
        alert.style.display = 'none';
    }, 2000);
});