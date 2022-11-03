<!-- Large modal -->
<div class="modal fade etat-compte" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-body">

                <div class="row justify-content-left">
                    <div class="col-lg-12">
                        <div class="iq-card">
                            <div class="iq-card-body">

                                <div class="row" id="printDiv">
                                    <h4 class="card-title col-md-12">Etat de compte<a id="compte_x"></a></h4>
                                    <div class="col-md-3" id="tab-solde">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="iq-card-body" id="tot_" style="text-align:center ;">

                                        </div>
                                        <table id="user-list-table" border="1" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Type</th>
                                                    <th>Montant</th>
                                                    <th>Motif</th>
                                                    <th>Béneficiaire</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="listeop">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div id="infos"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="printDivContent();">Imprimer</button>
                <button type="button" class="btn btn-primary" id="save">Enrégistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function printDivContent() {

        var divElementContents = document.getElementById("printDiv").innerHTML;
        var windows = window.open('', '', 'height=800, width=800');
        windows.document.write('<html>');
        windows.document.write('<body>');
        windows.document.write(divElementContents);
        windows.document.write('</body></html>');
        windows.document.close();
        windows.print();
    }
</script>