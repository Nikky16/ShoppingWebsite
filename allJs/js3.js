console.log('Welcome to js3');
let allAlerts = document.getElementsByClassName('allAlerts');
Array.from(allAlerts).forEach((alert)=>{
    setTimeout(() => {
        alert.style.display = 'none';
    }, 2000);
});

let orderAgainModal = document.getElementById('orderAgainModal');
orderAgainModal.addEventListener('click', ()=>{
    // console.log('clikced');

    let xs = document.getElementById('extraSmall');
    let sm = document.getElementById('small');
    let med = document.getElementById('medium');
    let lar = document.getElementById('large');
    let xl = document.getElementById('extraLarge');
    let size;
    let quantity;
    let payMethod;

    let quan = document.getElementById('quantity_again');
    quantity = quan.value;

    let upi = document.getElementById('upi');
    let cod = document.getElementById('cod');

    if(xs.checked){
        size = xs.value;
    }
    if(sm.checked){
        size = sm.value;
    }
    if(med.checked){
        size = med.value;
    }
    if(lar.checked){
        size = lar.value;
    }
    if(xl.checked){
        size = xl.value;
    }

    if(upi.checked){
        payMethod = upi.value;
    }
    if(cod.checked){
        payMethod = cod.value;
    }
    
    console.log(size);
    console.log(quantity);
    console.log(payMethod);

    let sizeAgain = document.getElementById('sizeAgain');
    let quantityAgain = document.getElementById('quantityAgain');
    let payAgain = document.getElementById('payAgain');

    sizeAgain.value = size;
    quantityAgain.value = quantity;
    payAgain.value = payMethod;
})

let orderBtn = document.getElementById('orderBtn');
let xs2 = document.getElementById('extraSmall_');
let sm2 = document.getElementById('small_');
let med2 = document.getElementById('medium_');
let lar2 = document.getElementById('large_');
let xl2 = document.getElementById('extraLarge_');

orderBtn.addEventListener('submit', ()=>{
    xs2.value = "";
    sm2.value = "";
    med2.value = "";
    lar2.value = "";
    xl2.value = "";

    document.getElementById('orderFormAgain').reset();
})