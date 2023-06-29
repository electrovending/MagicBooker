//Desarollado por Amir Mosquera

const inputBuscar = document.getElementById('buscar')
const celdas = document.getElementsByTagName('tr')
let color = ''
let endpoints = 'https://fapi.binance.com'
let uri = `${endpoints}/fapi/v1/ticker/24hr`

fetch(uri)
    .then(respuesta => respuesta.json())
    .then(datos => mostrarDatos(datos))
    .catch(e => console.log(e))

const mostrarDatos = (datos) =>{
    //console.log(datos)
    //console.log("El contenido es: " + datos.length)
    let body = ''

    for (let i=0; i < datos.length; i++) {
        if (datos[i].symbol.endsWith("USDT") == false) {
            continue
        }

        if (datos[i].priceChangePercent > 0) {
            color = "upPrice"
        } else {
            color = "downPrice"
        }
        body += `<tr class="ocultar"><td class="fw-bold ps-5">${datos[i].symbol}</td><td><span class="d-none d-sm-none d-md-block">${datos[i].lastPrice}</span></td><td class="${color}"><span class="d-none d-sm-none d-md-block">${datos[i].priceChangePercent}%</span></td><td class="text-end pe-5"><a class="btn btn-primary btn-sm" role="button" href='orderbook.php?symbol=${datos[i].symbol}&op=spot'>Spot</a> <a class="btn btn-primary btn-sm" role="button" href='orderbook.php?symbol=${datos[i].symbol}&op=futures'>Futures</a></td></tr>`
    }
    document.querySelector('.datos').innerHTML = body
}
// <a class="btn btn-success btn-sm" role="button" href="https://bit.ly/BinanceReady" target="_blank">Buy</a>
//Busqueda
inputBuscar.addEventListener('keyup', (e) => {
    let texto = e.target.value
    let er = new RegExp(texto, "i")
    for (let i=0; i < celdas.length; i++) {
        let valor = celdas[i]
        if (er.test(valor.innerText)) {
            valor.classList.remove("ocultar")
        } else {
            valor.classList.add("ocultar")
        }

        if (texto.length == 0) {
            valor.classList.add("ocultar")
        }
    }
})




