<div class="tab-pane fade" id="apropos" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Une brève description de la personne</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="row">

                <div class="form-group col-md-12">
                    <label for="pays">Apropos de vous</label>
                    <textarea class="form-control mb-0 setcolor" id="biographie"><?php echo $profil->biographie; ?></textarea>

                </div>
                <div class="form-group col-md-6" id="alert-apropos">

                </div>

                <div class="form-group col-md-12">
                    <label for="mere" style="color:white ;"></label>
                    <input type="button" onclick="save_Apropos();" value="Enregistrer" class="btn btn-primary">
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function save_Apropos() {

        HttpPost("/membres/update/apropos-biographie", {
            id: "<?php echo $id; ?>",
            bio: $("#biographie").val()
        }).then(function(data) {
            var json = data.data;
            document.getElementById("alert-apropos").innerHTML = setErreur((json.status != 200), json.message);
        });
    }
</script>