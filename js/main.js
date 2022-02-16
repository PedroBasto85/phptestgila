function deleteOptions(mySelect) {
    indice = 0;
    while (indice < mySelect.length) {
        mySelect.remove(indice);
    }
}

function optionBlank() {
    myOptionBlank = document.createElement('option');
    myOptionBlank.value = '0';
    myOptionBlank.text = 'Elija...';
    return myOptionBlank;
}

function validarCampos() {
    lkpCategoria = document.getElementById('lkpCategoria');
    lkpMarca = document.getElementById('lkpMarca');
    lkpModelo = document.getElementById('lkpModelo');
    Anio = document.getElementById('txtAnio');
    lkpNoLlantas = document.getElementById('lkpNoLlantas');
    Potencia = document.getElementById('txtPotencia');

    if ((lkpCategoria.value != 0) && (lkpMarca.value != 0) && (lkpModelo.value != 0) && (Anio.value != '') && (lkpNoLlantas.value != 0) && (Potencia != '')) {
        return true;
    } else {
        return false;
    }
}

async function limpiarCampos() {
    document.getElementById('txtAnio').value = '';
    document.getElementById('txtPotencia').value = '';
    document.getElementById('lkpNoLlantas').value = 0;
    document.getElementById('lkpCategoria').value = 0;
    getMarca(document.getElementById('lkpCategoria').value);
}

function insertVehiculo() {
    if (validarCampos() == true) {
        const url = 'api/vehiculo/';
        data = JSON.stringify({
            _CategoriaID: document.getElementById('lkpCategoria').value,
            _MarcaID: document.getElementById('lkpMarca').value,
            _ModeloID: document.getElementById('lkpModelo').value,
            _Anio: document.getElementById('txtAnio').value,
            _NoLlantas: document.getElementById('lkpNoLlantas').value,
            _PotenciaMotor: document.getElementById('txtPotencia').value
        });
        //console.log(data);
        fetchData = {
            method: 'POST',
            body: data,
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        };
        fetch(url, fetchData)
            .then(resp => resp.json())
            .then(function (data) {
                if (data > 0) {
                    alert('El registro ha sido guardado')
                    limpiarCampos();
                    getAllVehiculos();
                }
            })
    } else {
        alert('Todos los campos son obligatorios');
    }

}

async function getAllVehiculos() {   
    var arrayvh = []; 
    const urlCatalogo = 'api/vehiculo/';
    await fetch(urlCatalogo)
        .then(resp => resp.json())
        .then(function (data) {
            datosVehiculos = data;
            datosVehiculos.forEach(function (veh) {                 
                miveh = Object.values(veh); 
                arrayvh.push(miveh);                  
            });
            //console.log(arrayvh);
            new gridjs.Grid({
                search: false,
                columns: ['Categoria', 'Marca', 'Modelo', 'Año', 'Potencia'],
                data: arrayvh,
                pagination: {
                    enabled: true,
                    limit: 5,
                    summary: false
                  }
            }).render(document.getElementById("gridContainer"));
        });
}


function getCategoria() {
    const urlCatalogo = 'api/catalogo?_tipoCat=CATEGORIA';

    fetch(urlCatalogo)
        .then(resp => resp.json())
        .then(function (data) {
            datos = data;
            lkpCategoria = document.getElementById('lkpCategoria');
            datos.forEach(element => {
                myOption = document.createElement('option');
                myOption.value = element.CategoriaID;
                myOption.text = element.CategoriaDescripcion;
                lkpCategoria.appendChild(myOption);
            });
        })
        .catch(function (error) {
            console.log(error);
        })
}

function getMarca(CategoriaID) {
    const urlCatalogo = 'api/catalogo?_tipoCat=MARCA&_categoriaID=' + CategoriaID;

    fetch(urlCatalogo)
        .then(resp => resp.json())
        .then(function (data) {
            datos = data;
            lkpMarca = document.getElementById('lkpMarca');
            deleteOptions(lkpMarca);
            lkpMarca.appendChild(optionBlank());
            datos.forEach(element => {
                myOption = document.createElement('option');
                myOption.value = element.MarcaID;
                myOption.text = element.MarcaDescripcion;
                lkpMarca.appendChild(myOption);
            });
            getModelo(lkpMarca.value);
        })
        .catch(function (error) {
            console.log(error);
        })
}

function getModelo(MarcaID) {
    const urlCatalogo = 'api/catalogo?_tipoCat=MODELO&_marcaID=' + MarcaID;

    fetch(urlCatalogo)
        .then(resp => resp.json())
        .then(function (data) {
            datos = data;
            lkpModelo = document.getElementById('lkpModelo');
            deleteOptions(lkpModelo);
            lkpModelo.appendChild(optionBlank());
            datos.forEach(element => {
                myOption = document.createElement('option');
                myOption.value = element.ModeloID;
                myOption.text = element.ModeloDescripcion;
                lkpModelo.appendChild(myOption);
            });
        })
        .catch(function (error) {
            console.log(error);
        })
}


window.onload = function () {
    getCategoria();
    getAllVehiculos();
}