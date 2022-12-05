let tblProveedores;

const formulario = document.querySelector('#formulario');
const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');

const id = document.querySelector('#id_usuario');
const nombre = document.querySelector('#nombre');
const nit = document.querySelector('#nit');
const telefono = document.querySelector('#telefono');
const direccion = document.querySelector('#direccion');


const errorNombre = document.querySelector('#errorNombre');
const errorNit = document.querySelector('#errorNit');
const errorTelefono = document.querySelector('#errorTelefono');
const errorDireccion = document.querySelector('#errorDireccion');




document.addEventListener('DOMContentLoaded',function () {
    tblProveedores = $('#tblProveedores').DataTable({
        ajax: {
            //manda al controlador categorias funcion "listar"
            url: base_url + 'proveedor/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'nit' },
            { data: 'nombre' },
            { data: 'telefono' },
            { data: 'direccion' },
            { data: 'acciones' },
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'asc']],
    });
    btnNuevo.addEventListener('click',function () {
        id.value = '';
        btnAccion.textContent = 'Registrar';
        formulario.reset();
        limpiarCampos();
    })


    //registrar proveedores 
    formulario.addEventListener('submit',function (e) {
        e.preventDefault();

        limpiarCampos();

         if(nombre.value== ''){
             errorNombre.textContent= 'EL NOMBRE ES REQUERIDO (*)';
         }else if (nit.value == '') {
             errorNit.textContent= 'EL NIT ES REQUERIDO (*)';
         }else if (telefono.value == '') {
             errorTelefono.textContent= 'EL TELEFONO ES REQUERIDO (*)';
         }else if (direccion.value == '') {
             errorDireccion.textContent= 'LA DIRECCIÓN ES REQUERIDO (*)';
         }else{
            const url = base_url + 'proveedor/registrar';
            insertarRegistros(url,this,tblProveedores,btnAccion,false);  
        }
        
       
    })

})
function eliminarProveedor(idProveedor){
    const url = base_url +'proveedor/eliminar/'+ idProveedor;
    eliminarRegistro(url,tblProveedores);
}
function editarProveedor(idProveedor) {
    limpiarCampos();
    const url = base_url + 'proveedor/editar/' + idProveedor;
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
            id.value = res.id_proveedor;
            nombre.value = res.nombre;
            nit.value = res.nit;
            telefono.value = res.telefono;
            direccion.value = res.direccion;

            btnAccion.textContent = 'Actualizar';
            firstTab.show()
        }
    }
}
function limpiarCampos(){
    errorNit.textContent = '';
    errorNombre.textContent = '';
    errorTelefono.textContent = '';
    errorDireccion.textContent = '';
}