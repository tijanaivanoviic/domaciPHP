$(document).ready(function () {

    ucitavanje();
    function ucitavanje() {
        ucitajKategorije();
        ucitajCarape();
    }
    $('#unos-carape').submit(function (e) {
        e.preventDefault();
        submitForm();
    });
    $('body').on('submit', '#izmena-carape', function (e) {
        e.preventDefault();
        submitIzmenaForm();
    });


    $('body').on('click', '.brisanje', function () {
        const id = $(this).attr('id');

        $.ajax({
            type: "GET",
            url: "endpoints/brisanje-carape.php",
            data: {
                id
            },
            dataType: "text",
            success: function (response) {
                alert(response);
                ucitajCarape();
            }
        });
    });

    function submitIzmenaForm() {
        console.log("submit event");
        var fd = new FormData(document.getElementById("izmena-carape"));

        console.log(fd);
        $.ajax({
            url: "endpoints/izmena-carape.php",
            type: "POST",
            data: fd,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function (response) {
                alert(response);
            }
        });

        return false;
    }
    function submitForm() {
        console.log("submit event");
        var fd = new FormData(document.getElementById("unos-carape"));

        console.log($('#id_kategorija').val())
        console.log(fd);
        $.ajax({
            url: "endpoints/nove-carape.php",
            type: "POST",
            data: fd,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function (response) {
                alert(response);
                ucitajCarape();
            }
        });

        return false;
    }

    $('#sortiranje').change(function (e) {
        e.preventDefault();
        if ($(this).val()) {
            sortirajCarape($(this).val().split('-')[0], $(this).val().split('-')[1])
        }
        else ucitajCarape();
    });

    function ucitajKategorije() {
        $.ajax({
            type: "GET",
            url: "endpoints/dohvati-kategorije.php",
            dataType: "JSON",
            success: function (kategorije) {
                kategorije.forEach(kat => {
                    $('#id_kategorija').append(
                        `
                    <option data-bs-toggle="tooltip" data-bs-placement="left"  title="${kat.opis_kategorija}" value="${kat.id}">${kat.naziv_kategorija} </option>
                    `);
                });
            }
        });
    }

    $('#login-forma').submit(function (e) {
        e.preventDefault();
        login(
            $('#nadimak').val(),
            $('#password').val()
        )
    });

    function login(nadimak, password) {

        $.ajax({
            type: "GET",
            url: "endpoints/login.php",
            data: {
                nadimak,
                password
            },
            dataType: "JSON",
            success: function (korisnik) {
                if (korisnik) {
                    sessionStorage.setItem('id_korisnik', korisnik.id);
                    alert('Uspesan login.')
                    location.href = 'admin.php';
                }
                else alert('Kredencijali nisu dobri.')
            }
        });
    }

    function ucitajCarape() {
        $.ajax({
            type: "GET",
            url: "endpoints/dohvati-carape.php",
            dataType: "JSON",
            success: function (carape) {
                $('#carape').html('');
                if (!carape.length) {
                    $('#carape').html(
                        `
                        <h1 class="text-white">Ne postoje carape, pritisnite + da dodate.</h1>
                        `
                    );
                }
                carape.forEach(c => {
                    $('#carape').append(
                        `
                    <div class="col-6 mt-5">
                        <div class="card" >
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/${c.img_path}" height="200px" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${c.naziv_carapa}</h5>
                                        <p class="card-text">${c.opis_carapa}.</p>
                                        <p class="card-text"><small class="text-muted">${c.naziv_kategorija}</small></p>
                                        </div>
                                        ${generisiModalZaIzmenu(c)}
                                        <button type="button" class="btn btn-danger btn-lg brisanje" id="${c.id}">
                                        Izbrisi
                                    </button>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
            }
        });
    }

    function sortirajCarape(kolona, direction) {
        $.ajax({
            type: "GET",
            url: "endpoints/sortiraj-carape.php",
            data: {
                kolona,
                direction
            },
            dataType: "JSON",
            success: function (carape) {
                $('#carape').html('');
                if (!carape.length) {
                    $('#carape').html(
                        `
                        <h1><
                        `
                    );
                }
                carape.forEach(c => {
                    $('#carape').append(
                        `
                        <div class="col-6 mt-5">
                        <div class="card" >
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/${c.img_path}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${c.naziv_carapa}</h5>
                                        <p class="card-text">${c.opis_carapa}.</p>
                                        <p class="card-text"><small class="text-muted">${c.naziv_kategorija}</small></p>
                                    </div>
                                    ${generisiModalZaIzmenu(c)}
                                    <button type="button" class="btn btn-danger btn-lg brisanje" id="${c.id}">
                                    Izbrisi
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
            }
        });
    }

    function generisiModalZaIzmenu(carapa) {
        return `
        <button type="button" class="btn btn-primary btn-lg" id="izmena_carapa" data-bs-toggle="modal" data-bs-target="#carape_${carapa.id}">
            Izmeni
        </button>
    <div class="modal fade" id="carape_${carapa.id}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Izmena carapa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="izmena-carape" name="izmena-carape">
                        <div class="row">
                            <div class="col">
                            <input type="text" hidden value="${carapa.id}" class="form-control" name="id">
                                <label for="" class="form-label">Naziv carapa</label>
                                <input type="text" value="${carapa.naziv_carapa}" class="form-control" name="naziv" id="naziv" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted">Unesite naziv carapa ovde</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Opis carapa</label>
                                <textarea value="" class="form-control" name="opis" id="opis">${carapa.opis_carapa}</textarea>
                                <small id="helpId" class="form-text text-muted">Unesite opis carapa ovde</small>
                            </div>
                        </div>

                        <input class="btn-primary btn form-control" type="submit" value="Izmeni!" />
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Izadji</button>
                </div>
            </div>
        </div>
    </div>
        `
    }

});