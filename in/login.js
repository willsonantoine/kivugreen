$(document).ready(function () {

    document.getElementById("username").style.borderColor = "#1E3D73";
    document.getElementById("password").style.borderColor = "#1E3D73";

    $("#log").click(function () {

        var username = $('#username').val();
        var password = $('#password').val();

        $("#infos").html("").show();

        if (username != null && password != null && username != '' && password != '') {
            HttpPost("/login", { username: username, password: password },'log').then((res) => {
                var data = res.data;
                if (data.status == 200) {

                    localStorage.setItem("psedo", data.data.username);
                    localStorage.setItem("fonction", data.data.fonction);
                    localStorage.setItem("access_token", data.token);
                    access_files = url_base + data.file_folder;
                    
                    if (data.data.img == null) {
                        localStorage.setItem("avatar-user", access_files + "defaultuser.png");
                    } else {
                        localStorage.setItem("avatar-user", access_files + data.data.img);
                    }


                    document.location.href = "./start?token=" + data.token;

                } else {
                    $("#infos").html(setErreur(true, data.message,'Erreur','log'));
                }
            }).catch((error) => {
                $("#infos").html(setErreur(true, error.message,'Erreur','log'));
              
            });
        } else {
            $("#infos").html(setErreur(true, "Le nom ou le mot de passe ne peut pas être vide",'Erreur','log'));
        }
    });
});