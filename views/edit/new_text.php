<!-- Large modal -->


<div class="modal fade new-text" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Texte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row">
                                <input type="hidden" id="id_" value="00" class="form-control" placeholder="">
                                <div class="form-group col-md-6">
                                    <label>Type</label>
                                    <select class="form-control setcolor" id="type">
                                        <option value="">Select type</option>
                                        <option value="Blog">Blog</option>
                                        <option value="Evenement">Evenement</option>
                                        <option value="Texte">Texte</option>
                                        <option value="Image">Image</option>
                                        <option value="Video">Video</option>
                                        <option value="Audio">Audio</option>
                                        <option value="Document">Document</option>
                                        <option value="Service">Service</option>
                                        <option value="Partenaire">Partenaire</option>
                                        <option value="Slider">Slider</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Référence </label>
                                    <input type="text" class="form-control setcolor" id="ref_integration" readonly="readonly" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Titre</label>
                            <input type="text" id="titre_text" class="form-control setcolor" placeholder="" onkeyup="setRef();">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Extrait</label>
                            <textarea class="form-control setcolor" id="extrait" placeholder="Extrait du contenue à afficher"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Url d'access ou d'un fichier </label>
                            <input type="url" class="form-control setcolor" id="url" placeholder="">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Vous avez la possibilite de choisir plusieurs fichiers </label>
                            <input type="button" class="btn btn-primary col-md-12" onclick="clickFile();" id="btn-file" value="Choisir les fichiers">
                        </div>
                        <input type="file" id="file" style="display:none;" multiple onchange="showImages();">
                        <br>
                        <div class="col-md-12">
                            <span>Liste des images attachés à ce block</span>
                            <div id="content" class="row">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group col-md-12">
                            <label>Texte à afficher</label>
                            <textarea cols="80" id="editor2" name="editor2" rows="10"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <div id="al"></div>
                        </div>
                    </div>

                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="save_text();" id="save_text">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showImages() {
        let contentElement = document.getElementById("content");
        const imagefile = document.querySelector('#file');

        let files = Array.from(imagefile.files);

        contentElement.innerHTML = files.map(file => `<div class="col-md-4"><img src="${URL.createObjectURL(file)}" width="100px" class="rounded ml-0"></div>`).join('');

    }

    function save_text() {

        var containt = CKEDITOR.instances['editor2'].getData();
        var titre = $('#titre_text').val();
        var url = $('#url').val();
        var ref_integration = $('#ref_integration').val();
        var type = $('#type').val();
        var page = $("#page_").val();
        var id = $("#id_").val();
        var extrait = $("#extrait").val();
        var url = $("#url").val();

        const formData = new FormData();
        const imagefile = document.querySelector('#file');
        var i = 1;

        for (const file of imagefile.files) {
            formData.append('files' + i, file)
            i++;
        }

        formData.append("id", id);
        formData.append("titre", titre);
        formData.append("url", url);
        formData.append("containt", containt);
        formData.append("type", type);
        formData.append("ref_integration", ref_integration);
        formData.append("page", page);
        formData.append("extrait", extrait);
        formData.append("url", url);
        formData.append("parms", id_auth);

        if (page.length > 2) {
            HttpPost("/web-manage/create/containt",
                formData
            ).then(function(response) {
                var json = response.data;

                document.getElementById("al").innerHTML = setErreur((json.status != 200), json.message);

                if (json.status == 200) {
                    load();
                }
            });
        } else {
            document.getElementById("al").innerHTML = setErreur(201, "Veillez à sélectionner la page avant de l'enregistrer");
        }


    }

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