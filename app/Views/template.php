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
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!-- css swall -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
</head>


<title>Sign In!</title>
</head>

<body>

    <?= $this->renderSection('content'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- swall -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- untuk data tables -->
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
    <!-- coba swall -->

    <script>
        // selector
        const flashData = document.querySelector('.flash-data').getAttribute('data-flash');
        const flashDataDanger = document.querySelector('.flash-data-danger').getAttribute('data-flash');

        console.log(flashDataDanger);
        // bila berhasil (success)
        if (flashData) {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: flashData,
            })
        }
        // bila gagal
        if (flashDataDanger) {
            console.log("kok ra masuk");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: flashDataDanger,
            })
        }
    </script>
</body>

</html>