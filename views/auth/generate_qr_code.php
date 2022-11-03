<div id="generate_qr_code" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="generate_qr_code" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generate_qr_code">Générer le code QR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div id="qrcode" style="width:200px; height:200px; margin-top:15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <h4 id="qrcode_title">NOM COMPLET DU MEMBRE</h4>
                        <h4 id="qrcode_code">NOM COMPLET DU MEMBRE</h4>
                        <h5>Pour télécharger cette image en format PNG, veuillez faire un menu contextuel sur l'image et sélectionner le menu enregistrer l'image sous.</h5>
                    </div> 

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    var qrcode_generate = new QRCode(document.getElementById("qrcode"), {
        width: 200,
        height: 200
    });

    function generateQrCode(text_string, name) {
     
        document.getElementById('qrcode_title').innerHTML = `<strong>${name}</strong>`;

        document.getElementById("qrcode_code").innerHTML = `<code>${text_string}</code>`;

        qrcode_generate.makeCode(text_string);
    }
</script>