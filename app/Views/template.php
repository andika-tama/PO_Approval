<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css
">


    <title>Sign In!</title>
</head>

<body>

    <?= $this->renderSection('content'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- <script>
    $('.form-login').submit(function(e) {
        e.preventDefault();

        // ambil link
        const href = document.querySelector('.form-login').getAttribute('action');

        // ajax
        $.ajax({
            type: "POST",
            url: href,
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(response) {
                if (response.success) {
                    // alert("Selamat Anda berhasil login!")

                    const boxConfirm = document.querySelector('.box-confirm');
                    const pesan = `<div class="container text-center">
                                        <div class="row">
                                            <div class="col">
                                                <h2 class="text-success">
                                                ${response.success} 
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <img src="/pictures/success.gif" alt="gagal login" width="250px">
                                            </div>
                                        </div>
                                    </div>`
                    boxConfirm.innerHTML = pesan;
                } else {
                    const boxConfirm = document.querySelector('.box-confirm');
                    const pesan = `<div class="container text-center">
                                        <div class="row">
                                            <div class="col">
                                                <h2 class="text-danger">
                                                ${response.error} 
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <img src="/pictures/gagal.gif" alt="gagal login" width="250px">
                                            </div>
                                        </div>
                                    </div>`
                    boxConfirm.innerHTML = pesan;
                }
            },
            error: function(response) {
                console.log("Terjadi kesalahan");
            }
        });
    })
</script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->

    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tb_product').DataTable();
        });
    </script>

    <!-- script untuk tipa2 disable product yg diselect -->
    <script>
        $(".select-product").on('change', function() {
            const id = $(this).val();

            if ($(this).is(':checked')) {
                $('.product-' + id).prop('disabled', false);
            } else {
                $('.product-' + id).prop('disabled', true);
            }
        });
    </script>
</body>

</html>