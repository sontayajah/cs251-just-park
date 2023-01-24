var slot;

function makeRequest(){
  document.cookie='floor='+document.querySelector('.floorInfo').innerHTML.substring(0,1);
  return   $.ajax({
    type: "POST",
    url: "./assets/server/server.php",
  });
}



function fetchData() {
  $(document).ready(function () {
    $.when(makeRequest()).then(function successHandler(data){
      slot = JSON.parse(data);
      console.log(slot);
      localStorage.setItem('slotList', JSON.stringify(slot));
      /*
      slot = data.replace('\n','').trim();
      slot = slot.split('        ');*/
      if(!document.querySelector('.model-container').classList.contains('show')){
        find_slot();
        document.querySelector('.container .canvas .cardInfo .slotInfo').innerHTML = document.querySelector('.navigation ul').childNodes[1].childNodes[1].childNodes[5].innerHTML;
        set_zoneID('A');
        give_carTo_slot('A');
      }
    });
  });
}

fetchData();

const menuToggle = document.querySelector('.menuToggle');
const navigation = document.querySelector('.navigation');
var zone_book;
var floor_book;
var num_slot;
menuToggle.onclick = function(){
  navigation.classList.toggle('open');
}

//get cookie
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function popupShow(){
  const modal = document.querySelector('.model-container');
  // const modal2 = document.querySelector('.model-booked');
  console.log(getCookie("count_book"));

  if (getCookie("count_book")==0) {
    modal.classList.add('show');
    console.log('floor: '+ floor_book + '|' + 'slot: '+zone_book);
    localStorage.setItem('zone', zone_book);
    localStorage.setItem('floor', floor_book);
    localStorage.setItem('slotNum', num_slot);
    fetchData();
  }else {
    alert("You already booked.");
    event.stopImmediatePropagation();
  }
}

//click floor
const list = document.querySelectorAll('.list');
function activeLink(){
  list.forEach((item) => 
  item.classList.remove('active'));
  this.classList.add('active');
  give_carTo_slot('A');
  document.querySelector('.z-list.activeZone').classList.remove('activeZone');
  document.querySelector('.z-list').classList.add('activeZone');
  set_zoneID('A');
  let floor = parseInt(this.childNodes[1].childNodes[1].innerHTML);
  let area = document.querySelector('.container .canvas .cardInfo .slotInfo');
  let areatab = document.querySelector('.navigation ul');
  switch(floor){
      case 1: 
          area.innerHTML = areatab.childNodes[1].childNodes[1].childNodes[5].innerHTML;
          floor = floor+'st'; break;
      case 2: 
          area.innerHTML = areatab.childNodes[3].childNodes[1].childNodes[5].innerHTML;
          floor = floor+'nd'; break;
      case 3:
          area.innerHTML = areatab.childNodes[5].childNodes[1].childNodes[5].innerHTML;
          floor = floor+'rd'; break;
      case 4:
          area.innerHTML = areatab.childNodes[7].childNodes[1].childNodes[5].innerHTML;
          floor = floor+'th'; break;
      case 5:
          area.innerHTML = areatab.childNodes[9].childNodes[1].childNodes[5].innerHTML;
          floor = floor+'th'; break;
  }
  document.querySelector('.container .canvas .cardInfo .floorInfo').innerHTML = floor;
}
list.forEach((item) => 
item.addEventListener('click', activeLink));


//click zone
const zoneID = document.querySelectorAll('.zone-id');
const list_zone = document.querySelectorAll('.z-list');
function activeLink_zone(){
  list_zone.forEach((item_zone) => 
  item_zone.classList.remove('activeZone'));
  this.classList.add('activeZone');
  let zoneName
  zoneName = this.childNodes[1].childNodes[1].innerHTML;
  give_carTo_slot(zoneName);
  document.querySelector('.zoneInfo').innerHTML = zoneName;
  set_zoneID(zoneName);
}
list_zone.forEach((item_zone) => 
item_zone.addEventListener('click', activeLink_zone));

function set_zoneID(id){
  for(let i = 0; i < zoneID.length; i++){
    let text;
    let zoneName = id;
    text = zoneName+"-"+(i+1);
    zoneID[i].innerHTML = text;
  }
}

function find_slot(){
  let check = 1;
  for(let floor = 1; floor < 10; floor = floor + 2){
    let s = 0;
    for(let i = 0; i < slot['parking_lot'].length; i++){
      if(slot['parking_lot'][i][0].substring(0,1) === check+""){
        s++;
      }
    }
    check++;
    document.querySelector('.navigation ul').childNodes[floor].childNodes[1].childNodes[5].innerHTML = s+'/36';
  }
}

function give_carTo_slot(key){
  var carZone = [];
  const zc = document.querySelectorAll('.car img');
  zc.forEach((image) => 
  image.src = "");
    let flr = document.querySelector('.list.active a .floor');
    let keyflr = flr.innerHTML+'-'
    const matcher = new RegExp(`${keyflr}\\d{1,2}${key}`, 'g');

    var c = [];
    let i = 0;
    slot['parking_lot'].forEach((item) => {
      c[i] = item[0];
      i++;
    });

    carZone = c.filter(id => id.match(matcher));
    if(carZone.length > 0){
      for(let j = 0; j < carZone.length; j++){
        
        let index = parseInt(carZone[j].substring(2,carZone[j].length-1))-1;
        zc[index].src = "white-car-parking-meter-top-png-18.png";
        
      }
  }

  //remove hover
  const hover = document.querySelectorAll('.slot-num a');

  for(let i = 0; i < hover.length; i++){
    let matcher = new RegExp('white-car-parking-meter-top-png-18.png$','g');
    if(hover[i].childNodes[1].childNodes[3].childNodes[1].src.match(matcher) != null){
      hover[i].classList.remove('hover');
      hover[i].classList.add('booked');
      hover[i].childNodes[1].childNodes[1].innerHTML = ' ';
    }else {
      hover[i].classList.remove('hover');
      hover[i].classList.remove('booked');
      hover[i].classList.add('hover');
    }
  }

  //click slot
const slot_s = document.querySelectorAll('.card-slot');
slot_s.forEach((item) => {
  item.addEventListener('click', function(){
    zone_book = item.childNodes[1].innerHTML;
    floor_book = document.querySelector('.floorInfo').innerHTML;
    num_slot = document.querySelector('.slotInfo').innerHTML;
    popupShow();
  });
  
});

}

const model = document.querySelector('.model-container');
const close = document.querySelector('.cancel');

close.addEventListener('click', () => {
  model.classList.remove('show');
})

//backup 
//go booking process
document.querySelector('.confirm').onclick = function(){
  localStorage.setItem('locate', document.location.href);
  location.href = 'search2.php';
};

window.addEventListener('load', function(){
  console.log("height: " + $(window).height());
  console.log("width: "+ $(window).width());
})

window.addEventListener('resize', function(){
  const sec1 = document.querySelectorAll('.func-slot.sec1 ul li');
  const sec2 = document.querySelectorAll('.func-slot.sec2 ul li');
  var move = $(window).height()/782 + $(window).width()/1512;
  sec1.forEach((data) => data.style.marginLeft = move+"px");
  sec2.forEach((data) => data.style.marginLeft = move+"px");
  console.log("height: " + $(window).height());
  console.log("width: "+ $(window).width());

})

/*

window.addEventListener('load', setPosition)

window.addEventListener("resize", setPosition)

function setPosition(){
  var size = document.querySelector('.img_slot').width - 1052;
  if(size > 0){
  var sec1 = document.querySelectorAll('.func-slot.sec1 ul li');
  var sec2 = document.querySelectorAll('.func-slot.sec2 ul li');
  sec1.forEach((data) => 
    data.style.marginRight = size/43 + 'px'
  );
  sec2.forEach((data) => 
    data.style.marginRight = size/35 + 'px'
  );
  }
}*/