let mejl;
let t;
let idKkome;
function inic() {
    let kor = localStorage.getItem("mejl");
    if (kor != null) {
        mejl =kor;
    } else {
        localStorage.setItem("mejl", JSON.stringify(mejl));
    }

let tel=localStorage.getItem("fon");
if (tel != null) {
    t =tel;
} else {
    localStorage.setItem("fon", JSON.stringify(t));
}
let knov=localStorage.getItem("idKkome");
if (knov != null) {
    idKkome =tel;
} else {
    localStorage.setItem("idKkome", JSON.stringify(knov));
}

$(function(){
   $("#br2").toggle(1);
    $("#br4").toggle(1);
});
}
function redirect()
{
let m=localStorage.getItem("mejl");
var mailto_link = 'mailto:milanovicmilicaa@gmail.com';
let s="mailto:"+m;

window = window.open(s, 'emailWindow');
}

$(document).ready(function(){

    $("#b1").click(function() {
        // $("h1").toggle(3000);
        $("#br2").css("opacity", "1");
        $("#br2").toggle(1000);
       
    });

    $("#b2").click(function() {
        // $("h1").toggle(3000);
        $("#br4").css("opacity", "1");
        $("#br4").toggle(1000);
        let s=localStorage.getItem("fon");
       document.getElementById("telefon").innerHTML=s;

    });
 
   document.getElementById("idK_kome").innerHTML=localStorage.getItem("idKkome");
   document.getElementById("idK_kome").value=localStorage.getItem("idKkome");
});

