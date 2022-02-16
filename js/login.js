function login() {
    var Usuario = document.getElementById('txtUsuario').value;
    var Pass = document.getElementById('txtPassword').value;
    var url = 'api/login/?usuario=' + Usuario + '&password=' + Pass;
    fetch(url)
        .then(resp => resp.json())
        .then(function (data) {
            let datos = data[0];
            if (datos.messageID == 200) {
                window.location = 'vehiculo.html';
            }
        })
        .catch(function (error) {
            console.log(error);
        })
}