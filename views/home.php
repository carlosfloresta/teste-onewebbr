<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Document</title>

</head>

<body>


    <!-- As a heading -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Carlos</span>
        </div>
    </nav>

    <div class="container">

        <h1 class="text-center">Teste API Vaga OneWeb</h1>
        <div class="row text-center">
            <div class="col">

                <div class="mb-3">
                    <label for="rota" class="form-label">Digite a rota</label>
                    <input type="text" class="form-control" id="rota" aria-describedby="emailHelp">

                </div>

            </div>
            <div class="col">
                <div class="form-group">
                    <label for="api">Resultado</label>
                    <textarea class="form-control" id="api" rows="5"></textarea>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script>
        $("#rota").on("keyup", function(e) {
            e.preventDefault();
            var rota = $(this).val();

            $.ajax({
                url: 'http://localhost/teste-onewebbr/public_html/trajeto/validar/' + rota,
                type: 'GET',
                dataType: "json",
                success: function(data) {
                    $("#api").val(JSON.stringify(data));
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(field_name, error) {
                        $("#api").val(JSON.stringify(error));
                    });
                },
            });

        });
    </script>
</body>

</html>