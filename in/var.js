 
function readURL(input, v = "blah") {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#' + v)
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function showImg(input_name, file_name) {
    var img = './views/images/icon.png';

    if (file_name != null) {
        img = access_files + file_name;
    }

    $('#' + input_name).attr('src', img);
}


function setErreur(isError, texte, default_title = null, pan_progress = null,default_btn_texte="Enregistrer") {

    if (texte == 'Your token is expired, please reconnect') {
        window.location.href = "./login";
    } else {
        var ex = "success";
        if (isError) {
            var title = default_title != null ? default_title : "Erreur de traitement";

            ex = `<br><div class="alert bg-white alert-danger" role="alert">
                <div class="iq-alert-icon">
                <i class="ri-information-line"></i>
                </div>
                <div class="iq-alert-text"><b>${title}</b><br>${texte}</div>
            </div>`;
        } else {
            var title = default_title != null ? default_title : "Traitement réussie";

            ex = `<br><div class="alert bg-white alert-success" role="alert">
                    <div class="iq-alert-success">
                    <i class="ri-alert-line"></i>
                    </div>
                    <div class="iq-alert-text"><b>${title}</b><br>${texte}</div>
             </div>`;
        }
    }


    if (pan_progress != null) {
        $("#" + pan_progress).attr("disabled", false);
        document.getElementById(pan_progress).innerHTML = default_btn_texte;
    }




    return ex;
}

function setSelectBoxByText(eid, etxt) {
    var eid = document.getElementById(eid);
    for (var i = 0; i < eid.options.length; ++i) {
        if (eid.options[i].text === etxt) {
            eid.options[i].selected = true;
        }
    }
}

function setListe(liste = []) {

    var liste_element = "";

    liste.forEach(element => {
        liste_element += `<option value="${element.id}">${element.designation}</option>`;
    });
 
    return liste_element;
}

function ExportData(all_print_table = [], filename = 'RAPPORT') {

    filename = filename + '.xlsx';

    var ws = XLSX.utils.json_to_sheet(all_print_table);
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'page1');
    XLSX.writeFile(wb, filename);
}
