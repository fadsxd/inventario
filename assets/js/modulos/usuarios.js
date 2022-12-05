let tblUsuarios;
const formulario = document.querySelector('#formulario');
const nombres = document.querySelector('#nombres');
const apellidos = document.querySelector('#apellidos');
const correo = document.querySelector('#correo');
const direccion = document.querySelector('#direccion');
const telefono = document.querySelector('#telefono');
const clave = document.querySelector('#clave');
const rol = document.querySelector('#rol');

//error
const errorNombres = document.querySelector('#errorNombres');
const errorApellidos = document.querySelector('#errorApellidos');
const errorCorreo = document.querySelector('#errorCorreo');
const errorDireccion = document.querySelector('#errorDireccion');
const errorTelefono = document.querySelector('#errorTelefono');
const errorClave = document.querySelector('#errorClave');
const errorRol = document.querySelector('#errorRol');

const btnAccion = document.querySelector('#btnAccion');
const id_usuario = document.querySelector('#id_usuario');
const btnNuevo = document.querySelector('#btnNuevo');

document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + 'usuarios/listar',
            dataSrc: ''
        },
        columns: [ 
            { data: 'nombres' },
            { data: 'correo' },
            { data: 'telefono' },
            { data: 'direccion' },
            { data: 'rol' },
            { data: 'acciones' }
         ],
         language : {
            url : base_url + 'assets/js/espanol.json'
         },
         dom,
         buttons,
         responsive: true,
         order: [[0, 'asc']],
    }); 
    //limpiar campos
    btnNuevo.addEventListener('click',function(){
        id_usuario.value = '';
        btnAccion.textContent = 'Registrar';
        clave.removeAttribute('readonly');
        formulario.reset();
        //cursos en nombre
        nombres.focus();
        limpiarCampos();

    })


    //registrar usuarios
    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        limpiarCampos();


        if(nombres.value == ''){
            errorNombres.textContent = "(*)EL NOMBRE ES REQUERIDO";
        }else if(apellidos.value == ''){
            errorApellidos.textContent = "(*)EL APELLIDO ES REQUERIDO";
        }else if(correo.value == ''){
            errorCorreo.textContent = "(*)EL CORREO ES REQUERIDO";
        }else if(telefono.value == ''){
            errorTelefono.textContent = "(*)EL TELEFONO ES REQUERIDO";
        }else if(direccion.value == ''){
            errorDireccion.textContent = "(*)LA DIRECCIÓN ES REQUERIDO";
        }else if(clave.value == ''){
            errorClave.textContent = "(*)LA CONTRASEÑA ES REQUERIDO";
        }else if(rol.value == ''){
            errorRol.textContent = "(*)EL ROL ES REQUERIDO";
        }else{
            const url = base_url + 'usuarios/registrar'; 
            insertarRegistros(url,this,tblUsuarios,btnAccion,true);
            
        }
    })
})
//para eliminar usuario
function eliminarUsuario(idUsuario) {
    const url = base_url + 'usuarios/eliminar/' + idUsuario;
    eliminarRegistro(url,tblUsuarios);
    /*
    Swal.fire({
        title: 'Esta seguro de Eliminar?',
        text: "Se eliminara al usuario",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar Usuario'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'usuarios/eliminar/' + idUsuario; 
            //hacer una instancia del objeto XMLHttpRequest
            const http = new XMLHttpRequest();
            //abrir una conexion - POST - GET
            http.open('GET',url,true);
            //Enviar datos
            http.send();
            //verificar estados
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    Swal.fire({
                        toast: true,
                        position: 'top-center',
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    if(res.type == 'success'){
                        tblUsuarios.ajax.reload();
                    }
                }
            }
        }
      })
      */
}
// funcion para editar usuario
function editarUsuario(idUsuario) {
    limpiarCampos();
    const url = base_url + 'usuarios/editar/' + idUsuario; 
            //hacer una instancia del objeto XMLHttpRequest
            const http = new XMLHttpRequest();
            //abrir una conexion - POST - GET
            http.open('GET',url,true);
            //Enviar datos
            http.send();
            //verificar estados
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
           const res = JSON.parse(this.responseText);
            id_usuario.value = res.id_usuario;
            nombres.value = res.nombre;
            apellidos.value = res.apellido;
            correo.value = res.correo;
            telefono.value = res.telefono;
            direccion.value = res.direccion;
            rol.value = res.rol;
            clave.value = '0000000';
            clave.setAttribute('readonly','readonly');
            btnAccion.textContent = 'Actualizar';


           const firstTabEl = document.querySelector('#nav-tab button:last-child')
           const firstTab = new bootstrap.Tab(firstTabEl)
           firstTab.show()
        }
    }
}
function limpiarCampos(){
    errorNombres.textContent = '';
    errorApellidos.textContent = '';
    errorCorreo.textContent = '';
    errorTelefono.textContent = '';
    errorDireccion.textContent = '';
    errorClave.textContent = '';
    errorRol.textContent = '';
}
