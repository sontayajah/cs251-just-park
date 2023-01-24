//set floor, slotID
const floor = document.querySelector('.floorInfo');
const slotID = document.querySelector('.zoneInfo');
floor.innerHTML = floor.innerHTML + " " + localStorage.getItem('floor');
slotID.innerHTML = localStorage.getItem('zone');

var slot;

//pass variable from search.js
function convert_data() {
    if(localStorage.getItem('locate') !== document.location.href){
        var convert = localStorage.getItem('slotList');
        slot = JSON.parse(convert);
        localStorage.setItem('wName', slot['warden'][0]);
        localStorage.setItem('wTel', slot['warden'][1]);
        localStorage.setItem('locate', document.location.href)
    }
}

//set Information
function set_info(){
const wardenName = document.querySelector('.warName');
const wardenTel = document.querySelector('.warTel');
const emptySlot = document.querySelector('.slotNum');
wardenName.innerHTML = localStorage.getItem('wName');
wardenTel.innerHTML = localStorage.getItem('wTel');
emptySlot.innerHTML = localStorage.getItem('slotNum');
}

convert_data()
set_info();

const submit = document.querySelector('.btn a');
submit.addEventListener('click', checkInput);

function checkInput(){
    var check = document.querySelectorAll('.form input');
    var pass = true;
    check.forEach((data) => {
        if(data.value === ''){
            alert('Please Enter: ' + data.getAttribute('for'));
            pass = false;
        }
    });
    if(pass)
        popupToggle();
    else {
        const popup = document.querySelector('#popup');
        popup.classList.remove('active');
    }

}

function popupToggle(){
    const popup = document.querySelector('#popup');
    popup.classList.toggle('active');
}

function Accept(){


    // console.log(document.cookie);
    var floor = document.querySelector('.floorInfo').innerHTML.substring(7,8);
    var slot_num = document.querySelector('.zoneInfo').innerHTML;
    var slot_id = floor+'-'+slot_num.substring(2,slot_num.length)+''+slot_num.substring(0,1);
    document.cookie='slot_id='+slot_id;
    document.cookie='warden_id='+floor;
    const inputList = document.querySelectorAll('.form input');
    inputList.forEach((data) => {
        data.readOnly = true;
    });
    document.cookie='floors='+localStorage.getItem('floor');
    popupToggle();
}


