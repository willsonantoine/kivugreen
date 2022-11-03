<!-- Large modal -->


<div class="modal fade parametres-site" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Paramètres du site web</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="param_id" value="00">
                    <div class="form-group col-md-4">
                        <label>Titre</label>
                        <input type="text" id="param_title" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Télephone</label>
                        <input type="phone" id="param_phone" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Email</label>
                        <input type="mail" id="param_mail" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Adresse</label>
                        <input type="text" id="param_adresse" class="form-control setcolor">
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <span>Veiller importer les logos (Petit et larage)<br></span>
                                <input type="file" id="icon1" onChange="readURL(document.getElementById('icon1'),'show_icon1');" style="display:none;">
                                <input type="file" id="icon2" onChange="readURL(document.getElementById('icon2'),'show_icon2');" style="display:none;">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="button" id="param_btn_icon1" value="Sélectionner l'icon" class="btn btn-primary">
                            </div>
                            <div class="form-group col-md-3">
                                <img src="./views/images/icon.png" id="show_icon1" height="40" >
                            </div>
                            <div class="form-group col-md-3">
                                <input type="button" id="param_btn_icon2" value="Sélectionner l'icon" class="btn btn-primary">
                            </div>
                            <div class="form-group col-md-3">
                                <img src="./views/images/icon.png" id="show_icon2" height="40" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea id="param_description" class="form-control setcolor"></textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Url LinkedIn</label>
                        <input type="url" id="param_url_linkedin" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Url Facebook</label>
                        <input type="url" id="param_url_facebook" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Url instagram</label>
                        <input type="url" id="param_url_instagram" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Url tweeter</label>
                        <input type="url" id="param_url_tweeter" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Adresse map</label>
                        <input type="url" id="param_adresse_map" class="form-control setcolor">
                    </div>
                    <div class="form-group col-md-12" id="alx">

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="save_configuration()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function clickFile() {
        $('#file').click();

    }

    // Content wrapper element
    let contentElement = document.getElementById("content");
    let files = [];
    // Button callback
    async function onButtonClicked() {
        files = await selectFile("image/*", true);
        contentElement.innerHTML = files.map(file => `<img src="${URL.createObjectURL(file)}" style="width: 100px; height: 100px;border-image-slice: 20;">`).join('');
    }

    function setRef() {
        var titre = document.getElementById('titre_text').value;
        titre = titre.replace(/\s/gm, '_') + getRandomInt(100000000);
        $('#ref_integration').val(titre);
    }

    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }
</script>