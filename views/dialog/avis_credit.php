<!-- Large modal -->
<div class="modal fade avis_credit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_x"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="print" style="border-color:black;">


                    <h4><strong>COOPECCO KIRUMBA</strong> </h4>
                    <h5>N° AG GOUV/D143/N°000363/2008</h5>
                    <h6>Adresse : KIRUMBA Q. KAYALUNGERO; BP 18 KAYNA</h6>
                    <h4><strong>AVIS DE CREDIT</strong><a id="av_numero_credit"></a></h4>
                    <input type="hidden" id="id_operation_">
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 id="beneficiaire_"></h5>
                            <h5 id="av_montant"></h5>
                            <h5 id="toute_lettre"></h5>
                            <h5 id="motif_operation"></h5>
                            <h5 id="av_interet"></h5>
                            <h5 id="av_periode"></h5>
                            <h5 id="av_observation"></h5>
                            <hr>
                            <h5 id="av_dateop"></h5>
                            <h5 id="av_user"></h5>
                            </ul>
                            <br>
                            <div class="col-md-12" style="background-color: #e1e4e8;">
                                <table>
                                    <tr>
                                        <th style="text-align: left;width: 400px;"><a>Sé/Membre <span id="membre_nom"></span></a></th>
                                        <th style="text-align: right;width: 400px;"><a> <span id="user_nom"></span></a></th>
                                    </tr> 
                                </table>
                               
                            </div>
                        </div>
                    </div>

                </div>

                <div id="txy"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="printDivContent();" class="btn btn-primary">Imprimer</button>
            </div>
        </div>
    </div>
</div>