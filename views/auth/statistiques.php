<!-- Large modal -->
<div class="modal fade statistiques" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body" id="print_">

                <div class="row">
                    <div class="iq-card-body col-md-6">

                        <div class="table-responsive mt-4">
                            <table class="table mb-0 table-borderless">
                                <h4><strong>1. Type</strong></h4>
                                <hr>
                                <tbody id="tab_type">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="iq-card-body col-md-6">

                        <div class="table-responsive mt-4">
                            <table class="table mb-0 table-borderless">
                                <h4><strong>2. Fonction</strong></h4>
                                <hr>
                                <tbody id="tab_categorie">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="iq-card-body col-md-6">

                        <div class="table-responsive mt-4">
                            <table class="table mb-0 table-borderless">
                                <h4><strong>3. Genre</strong></h4>
                                <hr>
                                <tbody id="tab_gender">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="iq-card-body col-md-6">

                        <div class="table-responsive mt-4">
                            <table class="table mb-0 table-borderless">
                                <h4><strong>4. Etat Civil</strong></h4>
                                <hr>
                                <tbody id="tab_etat_civil">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Femer</button>
                <button type="button" class="btn btn-primary" onclick="printJS('print_', 'html');">Imprimer</button>
            </div>
        </div>
    </div>
</div>

<script>

     

    var all_stat = [];
    var max = 0;

    var title = '';

    var stat_gender = [];
    var stat_type = [];
    var stat_categorie = [];
    var stat_etat_civil = [];

    function loadStat() {

        stat_categorie = all_stat.categorie;
        stat_type = all_stat.type;
        stat_etat_civil = all_stat.etat_civil;
        stat_gender = all_stat.gender;

        load_value(stat_type, 'tab_type');
        load_value(stat_categorie, 'tab_categorie');
        load_value(stat_gender, 'tab_gender');
        load_value(stat_etat_civil, 'tab_etat_civil');

    }

    function load_value(list = [], tab_html) {

        var tab = document.getElementById(tab_html);

        list.forEach(element => {
            tab.innerHTML += `      <tr> 
                                         <td>
                                             <h4>${element.type}</h4>
                                         </td>
                                         <td><strong>${element.nombre}</strong></td>
                                         <td><strong>${parseInt((element.nombre*100)/max)} %</strong></td>
                                     </tr>`;
        });

    }
</script>