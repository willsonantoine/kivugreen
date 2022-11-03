$(document).ready(function () {

    $("#scan").keyup(function () {

        StartScan();

    });
    $("#btn_scan").click(function () {

        StartScan();

    });


    function StartScan() {

        var code = $("#scan").val();

        HttpPost("/membres/scan-presence", { code }).then((res) => {
            var json = res.data;
            $("#infos").html(setErreur((json.status != 200), json.message));
            access_files = url_base + json.file_folder;

            if (json.status == 200) {
                $("#show-nom").html(json.data.nom + " / " + json.data.type + " / " + json.data.fonction);
                $('#img-user').attr('src', access_files + json.data.img);
                $("#scan").val('');
            } else {
                $("#show-nom").html("NOM / TYPE / FONCTION");
                $('#img-user').attr('src', access_files + 'defaultuser.png');
            }
             
        }).catch(function (error) {
            $("#infos").html(setErreur(true, error.message));
        });

    }

});