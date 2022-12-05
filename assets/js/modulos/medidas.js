let tblMedidas;
const btnAccion = document.querySelector('#btnAccion');
const formulario = document.querySelector('#formulario');

const btnNuevo = document.querySelector('#btnNuevo');
const errorNombre = document.querySelector('#errorNombre');
const errorNombreCorto = document.querySelector('#errorNombreCorto');

const Nombre = document.querySelector('#nombre');
const NombreCorto = document.querySelector('#nombre_corto');



const id = document.querySelector('#id_usuario');

document.addEventListener('DOMContentLoaded', function () {
    tblMedidas = $('#tblMedidas').DataTable({
        ajax: {
            url: base_url + 'medidas/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'medida' },
            { data: 'nombre_corto' },
            { data: 'acciones' }
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'asc']],
    });

    // limpiar campos
    btnNuevo.addEventListener('click', function () {
        id.value = '';
        errorNombre.textContent = '';
        errorNombreCorto.textContent = '';
        btnAccion.textContent = 'Registrar';
        formulario.reset();
        
    })
    //enviar datos
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        errorNombre.textContent = '';
        errorNombreCorto.textContent = '';
        if (nombre.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES REQUERIDO (*)';
        } else if (NombreCorto.value == '') {
            errorNombreCorto.textContent = 'EL SIMBOLO ES REQUERIDO (*)';
        } else {
            const url = base_url + 'medidas/registrar';
            insertarRegistros(url, this, tblMedidas, btnAccion, false);
        }
    });

})
function eliminarMedida(idMedida) {
    const url = base_url + 'medidas/eliminar/' + idMedida;
    eliminarRegistro(url, tblMedidas);
}
function editarMedida(idMedida) {
    errorNombre.textContent = '';
    errorNombreCorto.textContent = '';
    const url = base_url + 'medidas/editar/' + idMedida;
    //hacer una instancia del objeto XMLHttpRequest
    const http = new XMLHttpRequest();
    //abrir una conexion - POST - GET
    http.open('GET', url, true);
    //Enviar datos
    http.send();
    //verificar estados
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText);
            console.log(res);
            id.value = res.id_medida;
            nombre.value = res.medida;
            nombre_corto.value = res.nombre_corto;
            btnAccion.textContent = 'Actualizar';
            firstTab.show()
        }
    }
}