<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin-site</title>
    <link rel="icon" type="image/x-icon" href="./views/admin/assets/img/favicon.png" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="./images/favicon.ico" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="./in/var.js"></script>
    <script src="./in/run.js"></script>

</head>


<body>

    <div style="margin-left:3%;margin-right:3%;padding:1px 16px;height:1000px;">
        <h3>Nouvelle publication</h3>
        <hr>
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">

                    <form action="#" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Titre de l'article</label>
                                        <input type="text" name="titre" value="" class="form-control" placeholder="Titre de l'article" required />
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Contenue</label>
                                        <div id="summernote" class="form-control">

                                        </div>
                                    </div>
                                    <input type="hidden" id="contenue" value="" name="contenue">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Image de mise en avant</label>
                                        <br>
                                        <img id="blah" src="#" class="img-fluid" height="200">
                                        <div class="form-group">
                                            <label>Selectionez l'image de garde</label>
                                            <input type="file" name="img" id="myfile" class="form-control" onChange="readURL(document.getElementById('myfile'));" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button onclick="save();" class="fw-500 btn btn-primary text-primary">Enregistrer</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="fw-500 btn btn-primary text-primary">brouillon</button>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" class="fw-500 btn btn-primary">Liste des articles</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <hr>
                                        <div class="form-group col-md-5">
                                            <label>Catégorie</label>
                                            <select class="form-control" name="id_categ">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label style="color:white ;">-</label>
                                            <input type="button" class="btn btn-primary form-control" value="+">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Langue</label>
                                            <select class="form-control" name="langue">
                                                <option value="Fr">Francais</option>
                                                <option value="En">Englais</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Extrait</label>
                                            <textarea class="form-control" name="extrait" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });

        $('#blah').click(function() {
            $('#myfile').click();

        });


        var edit = function() {
            $('#summernote').summernote({
                focus: true
            });

        };


        var save = function() {
            var markup = $('#summernote').summernote('code');
            document.getElementById("contenue").value = markup;
            // $('#summernote').summernote('destroy');
        };
    </script>



</body>

</html>