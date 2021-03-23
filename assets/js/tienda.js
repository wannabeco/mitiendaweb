$(document).ready(function(){
    //alert("skdfjhsdkfjhkj");
});

var storage = [];
var logueado = 0;
localStorage.setItem('logueado', 0);
//login exitoso con Google
function onSignIn(googleUser) 
{
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    logueado = 1;
    var dataUser = {id:profile.getId(),nombre:profile.getName(),correo:profile.getEmail(),foto:profile.getImageUrl(),tipoLogin:'google',logueado:true}
    localStorage.setItem('dataLogin', JSON.stringify(dataUser));
    localStorage.setItem('logueado', 1);
    console.log("Entro aca");
    angular.element(document.getElementById('paginaCompleta')).scope().iniciarLogueo();
}

function getDataLogin()
{
    return JSON.parse(localStorage.getItem('dataLogin'));
}
  