<div class="tab-pane fade" id="ethnicite" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Ethnicité et parenté</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="row">

                <div class="form-group col-md-4">
                    <label for="territoire">Térritoire</label>
                    <select id="territoire" class="form-control setcolor" onchange="load_by(document.getElementById('territoire').value,'chefferie')">

                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="chefferie">Chefférie et collectivité</label>
                    <select id="chefferie" class="form-control setcolor" onchange="load_by(document.getElementById('chefferie').value,'grouppement')">

                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="grouppement">Grouppement ou clan </label>
                    <select id="grouppement" class="form-control setcolor">

                    </select>
                </div>

                <div class="form-group col-md-5">
                    <label for="pere">Nom du père</label>
                    <input type="text" id="pere" value="<?php echo $profil->pere; ?>" class="form-control mb-0 setcolor">

                </div>
                <div class="form-group col-md-5">
                    <label for="mere">Nom du la mère</label>
                    <input type="text" id="mere" value="<?php echo $profil->mere; ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-2">
                    <label for="mere">Nombre d'enfants </label>
                    <input type="text" id="enfant" value="<?php echo $profil->enfant == null ? '0' : $profil->enfant; ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-6" id="alert-ethnicite">

                </div>

                <div class="form-group col-md-2">
                    <label for="mere" style="color:white ;">Nom du la mère</label>
                    <input type="button" onclick="save_ethnicite();" value="Enregistrer" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var all_groups = [];
    var territoire = [];
    var chefferie = [];
    var grouppement = [];
    var clan = [];



    load();
 
    function load() {
        HttpPost("/web-manage/containt-loads/groupes", {}).then(function(response) {
            var json = response.data;
            all_groups = json.data;
            access_files = url_base + json.file_folder;
            territoire = all_groups.filter(element => (element.designation == "Territoire"));
            chefferie = all_groups.filter(element => (element.designation == "Chefférie"));
            grouppement = all_groups.filter(element => (element.designation == "Grouppement ou clan"));
            loadCombo('territoire', territoire);
            loadCombo('chefferie', chefferie);
            loadCombo('grouppement', grouppement);

            setSelectBoxByText("territoire", "<?php echo $profil->territoire; ?>");
            setSelectBoxByText("chefferie", "<?php echo $profil->chefferie; ?>");
            setSelectBoxByText("grouppement", "<?php echo $profil->grouppement; ?>");

        });
    }

    function load_by(value, id_element) {

        var combo = document.getElementById(id_element);
        combo.innerHTML = "";
        all_groups.forEach(element => {


            if (value == element.id_parent) {
                combo.innerHTML += `<option value="${element.id}">${element.description}</option>`;
            } else if (value == null) {
                combo.innerHTML += `<option value="${element.id}">${element.description}</option>`;
            }

        });
    }

    function loadCombo(id_el, array = []) {
        var combo = document.getElementById(id_el);
        combo.innerHTML = "";
        array.forEach(element => {
            combo.innerHTML += `<option value="${element.id}">${element.description}</option>`;
        });
    }

    function save_ethnicite() {

        HttpPost("/membres/update/ethnicite", {
            id: "<?php echo $id; ?>",
            grouppement_clan: $("#grouppement").val(),
            pere: $("#pere").val(),
            mere: $("#mere").val(),
            enfants: $("#enfant").val(),
        }).then(function(data) {
            var json = data.data;
            document.getElementById("alert-ethnicite").innerHTML = setErreur((json.status != 200), json.message);
        });
    }
</script>