console.log('Welcome to js2');
let allAlerts = document.getElementsByClassName('allAlerts');
Array.from(allAlerts).forEach((alert)=>{
    setTimeout(() => {
        alert.style.display = 'none';
    }, 2000);
});