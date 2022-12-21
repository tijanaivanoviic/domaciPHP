<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/admin.js"></script>
    <script>
        $(document).ready(function() {
            if (!sessionStorage.getItem('id_korisnik')) {
                alert('Niste ulogovani!');
                location.href = 'login.php';
            }
        });
    </script>
</head>

<body>

    <div class="container">



        <div class="mb-3 col-4">
            <label for="" id="sortiranje-label" class="form-label">Sortiranje</label>
            <select class="form-control" name="sortiranje" id="sortiranje">
                <option value='0'>Izaberite sortiranje...</option>
                <option value='naziv_carapa-asc'>Naziv (rastuce)</option>
                <option value='naziv_carapa-desc'>Naziv (opadajuce)</option>
                <option value='naziv_kategorija-asc'>Naziv Kategorije (rastuce)</option>
                <option value='naziv_kategorija-desc'>Naziv Kategorije (opadajuce)</option>
            </select>
        </div>

        <div class="row" id="carape">

        </div>
        <!-- Button trigger modal -->

        <button type="button" class="btn btn-success btn-lg" id="dodavanje-novih-carapa" data-bs-toggle="modal" data-bs-target="#modelId">
            +
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dodavanje novih carapa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="unos-carape" name="unos-carape">
                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-label">Naziv carapa</label>
                                    <input type="text" required class="form-control" name="naziv" id="naziv" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Unesite naziv carapa ovde</small>
                                </div>
                                <div class="col">
                                    <label for="" class="form-label">Kategorija</label>
                                    <select required class="form-control" name="id_kategorija" id="id_kategorija"></select>
                                    <div id="tooltip_container"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-label">Opis carapa</label>
                                    <textarea required class="form-control" name="opis" id="opis"></textarea>
                                    <small id="helpId" class="form-text text-muted">Unesite opis carapa ovde</small>
                                </div>
                                <div class="col">


                                    <small id="helpId" class="form-text text-muted">Izaberite kategoriju</small>
                                    <label>Izaberite fajl:</label><br>
                                    <input class="form-control" type="file" name="file" required />
                                </div>

                            </div>

                            <input class="btn-primary btn form-control" type="submit" value="Dodaj!" />
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Izadji</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
</body>

</html>