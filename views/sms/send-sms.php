<!-- Large modal -->
<div class="modal fade send-sms" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Envoie SMS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 id="show-nombre2"></h3>
                <span>Veuillez écrire ici le texte à envoyer, qui doit comporter un maximum de 120 caractères.</span>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control setcolor" id="message-text" onkeyup="count_caractere();"></textarea>
                </div>
                <h4 id="count-caractere"></h4>
                <div id="show-error"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-send-click" onclick="sendSMS();">Envoyer</button>
            </div>
        </div>
    </div>
</div>

<script>
    var isCredit = false;

    function count_caractere() {
        var txt = document.getElementById("message-text").value;
        var nombre = txt.length;
        if (nombre >= 120) {
            document.getElementById("count-caractere").innerHTML = 'Vous avez saisie ' + nombre + ' Caractères<br>' +
                'Attention Vous serez surfacturé si vous envoyez ce message';
            document.getElementById("count-caractere").style.color = 'red';

        } else {
            document.getElementById("count-caractere").innerHTML = 'Vous avez saisie ' + nombre + ' Caractères';
            document.getElementById("count-caractere").style.color = 'green';
        }

    }


    function sendSMS() {

        var message = document.getElementById("message-text").value;


        var phones = [];

        tab_all_val.forEach(element => {
            if (tab_selected_id.includes(element.id) && element.id != null) {
                var index = data.indexOf(element.id);
                phones.push(element.phone);
            }
        });

        if (isCredit) {
            phones = tab_selected_phone;
        }

        if (phones.length > 0) {


            HttpPost("/account/sms-send", {
                phones,
                message
            }, 'btn-send-click').then((response) => {
                var json = response.data;
                $("#btn-send-click").attr("disabled", false);
                $("#btn-send-click").html("Envoyer");

                document.getElementById("show-error").innerHTML = setErreur((json.status != 200), json.message);

            });
        } else {

            document.getElementById("show-error").innerHTML = setErreur(true, "Aucun contact n'a été sélectionné jusqu'à présent");
        }




    }

    var tab_interfaces = [];
    var tab_taches = [];
    var tab_operations = [];



    var tab_all_val = [];
    var tab_selected_id = [];
    var tab_selected_phone = [];

    function selectVal(id, phone) {

        if (!tab_selected_id.includes(id)) {
            tab_selected_id.push(id);
            tab_selected_phone.push(phone);
        } else {
            var index = tab_selected_id.indexOf(id);
            tab_selected_id.splice(index, 1);
            tab_selected_phone.splice(index, 1);
        }

        console.log(tab_selected_phone);



        document.getElementById("show-nombre2").innerHTML = ("Vous allez Envoyer (" + tab_selected_id.length + ") messages");
        document.getElementById("show-nombre").innerHTML = ("Envoyer (" + tab_selected_id.length + ")");
    }

    function selectAllVal() {

        tab_all_val.forEach(element => {

            $("#select_" + element.id).prop("checked", !(tab_selected_id.includes(element.id)));

            selectVal(element.id, element.phone)
        });

    }
</script>