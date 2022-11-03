<div class="tab-pane fade" id="professionnelle" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Informations professionnelles</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="row">

                <div class="form-group col-md-4">
                    <label for="niveau_etude">Niveau d'etude</label>
                    <select id="niveau_etude" class="form-control setcolor" aria-label="Default select example">
                        <option value="">Selectionner</option>
                        <option value="Primaire">Primaire</option>
                        <option value="Secondaire" selected>Secondaire</option>
                        <option value="Université">Université</option>
                        <option value="Master">Master</option>
                        <option value="Doctorant">Doctorant</option>
                        <option value="Aucun">Autres</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="section">Section ou faculté</label>
                    <input type="text" id="section" value="<?php echo $profil->section_faculte; ?>" class="form-control mb-0 setcolor" >
                </div>
                <div class="form-group col-md-4">
                    <label for="domaine">Domaine de récherche spécialisé</label>
                    <input type="text" id="domaine" value="<?php echo $profil->domaine ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-4">
                    <label for="domaine_activite">Domaine d'activité</label>
                    <input type="text" id="domaine_activite" value="<?php echo $profil->activite ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-5">
                    <label for="entreprise">L'entreprise ou organisation dans la quelle vous travaillez</label>
                    <input list="entreprise_list" id="entreprise" value="<?php echo $profil->entreprise ?>" class="form-control mb-0 setcolor">
                    <datalist id="entreprise_list">

                    </datalist>
                </div>
                <div class="form-group col-md-3">
                    <label for="fonction_activite">La fonction dont vous assurez</label>
                    <input type="text" id="fonction_activite" value="<?php echo $profil->fonction_actuelle ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-6" id="alert-infos-pers">

                </div>

                <div class="form-group col-md-12">
                    <label for="mere" style="color:white ;"></label>
                    <input type="button" onclick="save_infos_pers();" value="Enregistrer" class="btn btn-primary">
                </div>

            </div>
        </div>
    </div>
</div>

<script>
     setSelectBoxByText("niveau_etude", "<?php echo $profil->niveau_etude; ?>");

    function save_infos_pers() {

        HttpPost("/membres/update/infos-professionnelles", {
            id: "<?php echo $id; ?>",
            niveau_etude: $("#niveau_etude").val(),
            section: $("#section").val(),
            domaine: $("#domaine").val(),
            activite: $("#domaine_activite").val(),
            entreprise: $("#entreprise").val(),
            fonction: $("#fonction_activite").val(),
        }).then(function(data) {
            var json = data.data;
            document.getElementById("alert-infos-pers").innerHTML = setErreur((json.status != 200), json.message);
        });
    }
</script>