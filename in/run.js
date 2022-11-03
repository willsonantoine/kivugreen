
$(document).ready(function () {

    $("#title-username").html((localStorage.getItem("psedo") == null) ? 'User' : localStorage.getItem("psedo"));
    $("#title-username2").html(localStorage.getItem("psedo"));
    $("#title-fonction").html((localStorage.getItem("fonction") == null) ? 'Membre' : localStorage.getItem("fonction"));
    $("#title-fonction2").html(localStorage.getItem("fonction"));
    $('#avatar-user').attr('src', (localStorage.getItem("avatar-user") == null) ? '../views/images/defaultuser.png' : localStorage.getItem("avatar-user"));

});