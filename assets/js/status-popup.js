document.querySelector(".btn #btn-cf").addEventListener("click",function(){
    document.querySelector(".popup").classList.add("active");
});

document.querySelector(".popup .close-btn").addEventListener("click",function(){
    document.querySelector(".popup").classList.remove("active");
});

document.querySelector("#setConfirm").addEventListener("click",function(){
    document.querySelector(".popup").classList.remove("active");
});
document.querySelector("#setCancle").addEventListener("click",function(){
    document.querySelector(".popup").classList.remove("active");
});