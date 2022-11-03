<div class="tab-pane fade" id="reseau-sociaux" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Réseau sociaux</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="row">

                <div class="form-group col-md-4">
                    <label for="facebook">Url Facebook</label>
                    <input type="text" id="facebook" value="<?php echo $profil->facebook; ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-4">
                    <label for="linkedin">Url linkedIn</label>
                    <input type="text" id="linkedin" value="<?php echo $profil->linkedin; ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-4">
                    <label for="tweeter">Url tweeter</label>
                    <input type="text" id="tweeter" value="<?php echo $profil->tweeter; ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-4">
                    <label for="intagram">Url instagram</label>
                    <input type="text" id="intagram" value="<?php echo $profil->instagram; ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-4">
                    <label for="whatsap">Numéro Whatsap</label>
                    <input type="text" id="whatsap" value="<?php echo $profil->whatsap; ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-4">
                    <label for="blog">URL du blog personnel</label>
                    <input type="text" id="blog_url" value="<?php echo $profil->url_blog; ?>" class="form-control mb-0 setcolor">
                </div>
                <div class="form-group col-md-12" id="error_reseau">

                </div>
                <div class="form-group col-md-4">
                    <input type="button" onclick="save_reseau_sociaux();" value="Enregistrer" class="btn btn-primary">
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function save_reseau_sociaux() {
        HttpPost("/membres/update/reseau-sociaux", {
            id: "<?php echo $id; ?>",
            facebook: $("#facebook").val(),
            tweeter: $("#tweeter").val(),
            linkedin: $("#linkedin").val(),
            intagram: $("#intagram").val(),
            whatsap: $("#whatsap").val(),
            blog_url: $("#blog_url").val(),
        }).then(function(data) {
            var json = data.data;
            document.getElementById("error_reseau").innerHTML = setErreur((json.status != 200), json.message);
        });
    }
</script>