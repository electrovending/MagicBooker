<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Amir Mosquera">
    <meta name="description" content="MagicBooker.com is a FREE cryptocurrency tool that can find futures order blocks. Finding order blocks when initiating a trade is important to manage risk">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="shortcut icon" href="./img/favicon.ico">
    <title>MagicBooker</title>
  </head>


  <body class="d-flex h-100 flex-column ">
    <?php require('./layout/header.php') ?>
    <!---->
    <section class="container mt-5 d-flex justify-content-center"  style='padding-top: 1rem;'>
      <div class="sec-home mt-5">
        <div class="text-center text-white">
          <h1>MagicBooker</h1>
          <p class="">The easiest way to find cryptocurrency order blocks</p>
        </div>

        <div class="">
          <form action="" class="form text-center m-auto align-items-center w-50 input-group">
            <span class="text-white pe-2 d-none d-sm-none d-md-block"><i class="bi bi-search hii"></i></span>
            <input class="form-control rounded-3" id="buscar" type="text" placeholder="Search for an asset, example BTCUSDT" autocomplete="off">
          </form>
        </div>

        <div class="">
          <div class="d-flex justify-content-around fw-bold mt-3 text-white">
            <div><i class="bi bi-currency-bitcoin"></i> Symbol</div>
            <div class="d-none d-sm-none d-md-block"><i class="bi bi-currency-dollar"></i> Price</div>
            <div class="d-none d-sm-none d-md-block"><i class="bi bi-percent"></i> 24hr Change</div>
            <div><i class="bi bi-graph-up"></i> DashBoard</div>
          </div>

          <div class="">
            <table class="table table-sm table-hover mt-3 rounded-3 rounded-bottom-0 bg-white border-bottom-0 border-dark-subtle">
              <tbody class="datos"></tbody>
            </table>
          </div>
        </div>
          
      </div>
    </section>
    <!-- Footer -->
    <?php require('./layout/footer.php') ?>
    <!-- Script -->
    <script src="./js/app.js"></script>
  </body>
</html>
