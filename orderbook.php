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
    <title>MagicBooker - <?php echo '' . htmlspecialchars($_GET["symbol"]) . ''; ?></title>
</head>

<body class="text-white text-center">
    <?php require('./layout/header.php') ?>
    <section class="container">
        <h1>Showing results for <?php echo '' . htmlspecialchars($_GET["symbol"]) . ''; ?> in <?php echo '' . htmlspecialchars($_GET["op"]). ''; ?></h1>
        <div class="d-flex flex-column align-items-center">
            <div class="d-flex mt-2 align-items-center justify-content-around flex-wrap w-50"  style="row-gap: 1em;">
                <div class="">
                    <h6>Last price: <span id="current_price"></span> USDT</h6>
                </div>
                <div class="">
                    <h6>24h Change: <span id="change"></span> %</h6>
                </div>
                <div class="d-none d-sm-none d-md-block">
                    <h6>24h Volume: <span id="volume"></span> USDT</h6>
                </div>
            </div>
            <!-- <div class="border-bottom border-bottom-dark w-100" data-bs-theme="dark"></div> -->
            <div class="d-flex flex-row justify-content-around mt-3 flex-wrap">
                <div class="d-flex flex-column p-2">
                    <h4>Blocks</h4>
                    <div class="d-flex flex-row  flex-grow-1">
                        <div>
                            <table
                                class="table-sm table table-hover mt-3 rounded-3 rounded-bottom-0 bg-white border-bottom-0 border-dark-subtle">
                                <thead class="table-danger text-center">
                                    <th>#</th>
                                    <th>Price</th>
                                    <th>Sell orders</th>
                                </thead>
                                <tbody class="datosAsks"></tbody>
                            </table>
                        </div>
                        <div class="ps-1">
                            <table
                                class="table-sm table table-hover mt-3 rounded-3 rounded-bottom-0 bg-white border-bottom-0 border-dark-subtle">
                                <thead class="table-success text-center">
                                    <th>Price</th>
                                    <th>Buy orders</th>
                                </thead>
                                <tbody class="datosBids"></tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <p>Claim your 100 USDT Trading Fee Credit</p>
                        <a class="btn btn-primary fw-bold" role="button" href="https://bit.ly/BingxWeb"
                            target="_blank">BingX
                        </a>
                        <a class="btn btn-warning fw-bold" role="button" href="https://bit.ly/BinanceReady"
                            target="_blank">Binance
                        </a>

                    </div>
                </div>
                <div class="p-2">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container d-none d-sm-none d-md-block">
                        <h4>Chart</h4>
                        <div id="tradingview_0731f"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                            if ("<?php echo '' . htmlspecialchars($_GET["op"]) . ''; ?>" == "spot") {
                                datos_moneda = "BINANCE:<?php echo '' . htmlspecialchars($_GET["symbol"]) . ''; ?>"
                            }else{
                                datos_moneda = "BINANCE:<?php echo '' . htmlspecialchars($_GET["symbol"]) . ''; ?>.P"
                            }
                            new TradingView.widget(
                                {
                                    "width": 800,
                                    "height": 500,
                                    "symbol": datos_moneda,
                                    "interval": "240",
                                    "timezone": "Etc/UTC",
                                    "theme": "dark",
                                    "style": "1",
                                    "locale": "en",
                                    "toolbar_bg": "#f1f3f6",
                                    "hide_side_toolbar": false,
                                    "enable_publishing": false,
                                    "save_image": false,
                                    "container_id": "tradingview_0731f"
                                }
                            );
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Data -->
        <!--
        <h3>All data</h3>
        <div class="d-flex flex-row justify-content-around">
            <div class="">
                <table
                    class="table-sm tabla-css table table-hover mt-3 rounded-3 rounded-bottom-0 bg-white border-bottom-0 border-dark-subtle">
                    <thead class="table-danger">
                        <th>#</th>
                        <th>Price</th>
                        <th>Sell</th>
                    </thead>
                    <tbody class="datos2"></tbody>
                </table>
            </div>

            <div class="ps-1">
                <table
                    class="table-sm tabla-css table table-hover mt-3 rounded-3 rounded-bottom-0 bg-white border-bottom-0 border-dark-subtle">
                    <thead class="table-success">
                        <th>Price</th>
                        <th>Buy</th>
                    </thead>
                    <tbody class="datos1"></tbody>
                </table>
            </div>
        </div>
        -->

    </section>
    <!-- Footer -->
    <?php require('./layout/footer.php') ?>

    <script type="text/javascript">
        const coin = "<?php echo '' . htmlspecialchars($_GET["symbol"]) . ''; ?>";
        const mercado = "<?php echo '' . htmlspecialchars($_GET["op"]) . ''; ?>";
        
        const lanzar = (symbol, ope) => {
            if (ope == "spot") {
                let endpoint = 'https://api.binance.com'
                let limit = 5000
                let url = `/api/v3/depth?symbol=${symbol.toUpperCase()}&limit=${limit}`
                //Websocket para spot
                let ws = new WebSocket(`wss://stream.binance.com:9443/ws/${coin.toLowerCase()}@ticker`)

                fetch(endpoint + url)
                    .then(response => response.json())
                    .then(data => mostrarData(data))
                    .catch(error => console.log(error))
                
                let precio = document.getElementById('current_price')
                let cambio = document.getElementById('change')
                let precio_actual
                let precio_anterior
                
                ws.onmessage = (event) => {
                    let objeto =JSON.parse(event.data)
                    
                    precio_actual =parseFloat(objeto.c)
                    cambio_actual = parseFloat(objeto.P)
                    volumen = parseFloat(objeto.q)
                    volumen = volumen.toFixed(0)

                    precio_anterior > precio_actual ? precio.style.color = 'red' : precio.style.color = '#5DB142'
                    cambio_actual > 0 ? cambio.style.color = '#5DB142' : cambio.style.color = 'red'

                    //console.log(objeto)
                    precio.innerHTML = `${objeto.c}`
                    cambio.innerHTML = `${objeto.P}`
                    volume.innerHTML = `${volumen}`

                    precio_anterior =parseFloat(objeto.c)
                }
            } else {
                let endpoint = 'https://fapi.binance.com'
                let limit = 1000
                let url = `/fapi/v1/depth?symbol=${symbol.toUpperCase()}&limit=${limit}`
                //Websocket para futuros
                let ws = new WebSocket(`wss://fstream.binance.com/ws/${coin.toLowerCase()}@ticker`)

                fetch(endpoint + url)
                    .then(response => response.json())
                    .then(data => mostrarData(data))
                    .catch(error => console.log(error))


                let precio = document.getElementById('current_price')
                let cambio = document.getElementById('change')
                let precio_actual
                let precio_anterior
                
                ws.onmessage = (event) => {
                    let objeto =JSON.parse(event.data)
                    
                    precio_actual =parseFloat(objeto.c)
                    cambio_actual = parseFloat(objeto.P)
                    volumen = parseFloat(objeto.q)
                    volumen = volumen.toFixed(0)

                    precio_anterior > precio_actual ? precio.style.color = 'red' : precio.style.color = '#5DB142'
                    cambio_actual > 0 ? cambio.style.color = '#5DB142' : cambio.style.color = 'red'

                    //console.log(objeto)
                    precio.innerHTML = `${objeto.c}`
                    cambio.innerHTML = `${objeto.P}`
                    volume.innerHTML = `${volumen}`

                    precio_anterior =parseFloat(objeto.c)
                }
            }
        }


        const mostrarData = (data, bloques) => {
            //console.log(data)
            //console.log("El contenido de bids: " + data["bids"].length)
            //console.log("El contenido de asks: " + data["asks"].length)

            //--------------------------------------------------------------------------------------
            //Aca mostramos todos los datos

            //let body2 = ''
            //for (let i = 0; i < data["asks"].length; i++) {
            //    body2 += `<tr><td>${i + 1}</td><td>${data["asks"][i][0]}</td><td>${data["asks"][i][1]}</td></tr>`
            //}
            //document.querySelector('.datos2').innerHTML = body2

            //let body1 = ''
            //for (let i = 0; i < data["bids"].length; i++) {
            //    body1 += `<tr><td>${data["bids"][i][0]}</td><td>${data["bids"][i][1]}</td></tr>`
            //}
            //document.querySelector('.datos1').innerHTML = body1



            //--------------------------------------------------------------------------------------
            //Sacamos los datos de los Asks Vender
            arrayAsks = []; // Aquí almacenamos los nuevos arreglos
            bloques = data["asks"].length / 10
            for (let i = 0; i < data["asks"].length; i += bloques) {
                let pedazoa = data["asks"].slice(i, i + bloques);
                arrayAsks.push(pedazoa);
            }
            //console.log("Arreglo de Asks: ", arrayAsks);
            //console.log("Arreglo de Asks 1er: ", arrayBids.length);
            //console.log("Arreglo de Asks 2do: ", arrayBids[0].length);
            sumaAsks = 0
            x = 0
            y = 0
            priceAsks = 0
            arrayPrintAsks = []
            let bodyAsks = ''
            for (let i = 0; i < arrayAsks.length; i++) {
                for (let j = 0; j < arrayAsks[i].length; j++) {
                    //console.log(i + " : " + j);
                    //console.log(arrayAsks[i][j][1]);
                    if (parseFloat(arrayAsks[i][j][1]) > x) {
                        x = parseFloat(arrayAsks[i][j][1])
                        priceAsks = parseFloat(arrayAsks[i][j][0])
                    }
                    sumaAsks += parseFloat(arrayAsks[i][j][1]);
                }
                //console.log(`Suma Arreglo de Asks: ${i}`, sumaAsks, " : ", priceAsks);
                arrayPrintAsks.push([priceAsks, sumaAsks])
                if (sumaAsks > y) {
                    color = "downPrice"
                    y = sumaAsks
                } else {
                    color = ""
                }

                //bodyAsks += `<tr><td>${i+1}</td><td>${priceAsks}</td><td style="text-align: end;">${sumaAsks.toFixed(2)}</td></tr>`
                sumaAsks = 0
                priceAsks = 0
                x = 0
            }
            //console.log(arrayPrintAsks);

            let mayorA = 0
            for (let index = 0; index < arrayPrintAsks.length; index++) {
                if (arrayPrintAsks[index][1] > mayorA) {
                    mayorA = arrayPrintAsks[index][1]
                }
            }

            //console.log(mayorA);
            for (let index = 0; index < arrayPrintAsks.length; index++) {
                if (arrayPrintAsks[index][1] == mayorA) {
                    color = "downPrice"
                } else {
                    color = ""
                }
                bodyAsks += `<tr><td>${index + 1}</td><td class="text-start ${color}">${arrayPrintAsks[index][0]}</td><td class="text-end ${color}">${arrayPrintAsks[index][1].toFixed(2)}</td></tr>`

            }
            document.querySelector('.datosAsks').innerHTML = bodyAsks

            //--------------------------------------------------------------------------------------
            //Sacamos los datos de los Bids Comprar
            arrayBids = []; // Aquí almacenamos los nuevos arreglos
            bloques = data["bids"].length / 10
            for (let i = 0; i < data["bids"].length; i += bloques) {
                let pedazob = data["bids"].slice(i, i + bloques);
                arrayBids.push(pedazob);
            }
            //console.log("Arreglo de Bids: ", arrayBids);
            //console.log("Arreglo de Bids 1er: ", arrayBids.length);
            //console.log("Arreglo de Bids 2do: ", arrayBids[0].length);
            sumaBids = 0
            x = 0
            priceBids = 0
            arrayPrintBids = []
            let bodyBids = ''
            for (let i = 0; i < arrayBids.length; i++) {
                for (let j = 0; j < arrayBids[i].length; j++) {
                    //console.log(i + " : " + j);
                    //console.log(arrayBids[i][j][1]);
                    if (parseFloat(arrayBids[i][j][1]) > x) {
                        x = parseFloat(arrayBids[i][j][1])
                        priceBids = parseFloat(arrayBids[i][j][0])
                    }
                    sumaBids += parseFloat(arrayBids[i][j][1]);
                }
                //console.log(`Suma Arreglo de Bids: ${i}`, sumaBids, " : ", priceBids);
                arrayPrintBids.push([priceBids, sumaBids])
                //bodyBids += `<tr><td>${i+1}</td><td>${priceBids}</td><td style="text-align: end;">${sumaBids.toFixed(2)}</td></tr>`
                sumaBids = 0
                priceBids = 0
                x = 0
            }
            //console.log(arrayPrintBids);
            let mayorB = 0
            for (let index = 0; index < arrayPrintBids.length; index++) {
                if (arrayPrintBids[index][1] > mayorB) {
                    mayorB = arrayPrintBids[index][1]
                }

            }

            //console.log(mayorB);
            for (let index = 0; index < arrayPrintBids.length; index++) {
                if (arrayPrintBids[index][1] == mayorB) {
                    color = "upPrice"
                } else {
                    color = ""
                }
                bodyBids += `<tr><td class="text-start ${color}">${arrayPrintBids[index][0]}</td><td class="text-end ${color}">${arrayPrintBids[index][1].toFixed(2)}</td></tr>`

            }
            document.querySelector('.datosBids').innerHTML = bodyBids
        }


        lanzar(coin, mercado)



    </script>
</body>

</html>