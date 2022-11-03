<!-- Large modal -->
<div class="modal fade access-users" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Access utilisateur system</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title" id="titre">Access </h4>
                            <h6 id="catego_txt"></h6>
                        </div>
                        <input type="hidden" id="id_user_access">
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" onchange="setValidateur();" id="validateur1">
                                <label class="custom-control-label" for="validateur1">Validateur </label>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" onchange="setActif();" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">Login système</label>
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" onchange="setSow_onWeb();" id="show_on_web">
                                <label class="custom-control-label" for="show_on_web">Afficher sur le site </label>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="row">
                            <div class="table-responsive col-md-4">
                                <h5>Intefaces</h5>
                                <table class="table mb-0 table-borderless" id="tab_interfaces">

                                </table>
                            </div>
                            <div class="table-responsive col-md-5">
                                <h5>Tâches</h5>
                                <table class="table mb-0 table-borderless" id="tab_taches">

                                </table>
                            </div>
                            <div class="table-responsive col-md-3">
                                <h5>Transactions</h5>
                                <table class="table mb-0 table-borderless" id="tab_operations">

                                </table>
                            </div>
                        </div>
                        <div id="all"></div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="location.href='./utilisateur'">Enregistrer</button>
            </div>
        </div>
    </div>

    <script>
        var tab_interfaces = [];
        var tab_taches = [];
        var tab_operations = [];

        function selectAccess(params) {
            var id_user = getIdUser(params);
            console.log(id_user);
            liste_access_users.forEach(element => {
                if (id_user == element.id_user) {
                    if (element.etat == 1) {
                        console.log("access_" + element.id_access);
                        document.getElementById("access_" + element.id_access).checked = true;
                    }
                }

            });
        }


        loadAccess();

        function setAccess(id) {
            var etat = document.getElementById("customSwitch1").value;
            var id_user_ = document.getElementById("id_user_access").value;
            HttpPost("/account/set-access-user", {
                id,
                id_user_
            }).then(function(response) {
                var json = response.data;
                document.getElementById("all").innerHTML = setErreur((json.status != 200), json.message);
                // load();
            });

        }

        function setSow_onWeb() {
            var etat = document.getElementById("show_on_web").value;
            var id_user_ = document.getElementById("id_user_access").value;
            HttpPost("/account/set-access-user-show-on-profil", {
                id_user_
            }).then(function(response) {
                var json = response.data;
                document.getElementById("all").innerHTML = setErreur((json.status != 200), json.message); 
            });

        }

        function setActif() {
            var etat = document.getElementById("customSwitch1").value;
            var id = document.getElementById("id_user_access").value;
            HttpPost("/membres/set-access", {
                id,
                etat
            }).then(function(response) {
                var json = response.data;
                document.getElementById("all").innerHTML = setErreur((json.status != 200), json.message);
                load();
            });


        }

        function setValidateur() {

            var id = document.getElementById("id_user_access").value;
            var etat = document.getElementById("validateur1").value;

            HttpPost("/membres/set-validateur", {
                id,
                etat
            }).then(function(response) {
                var json = response.data;
                document.getElementById("all").innerHTML = setErreur((json.status != 200), json.message);
                load();
            });


        }
    </script>