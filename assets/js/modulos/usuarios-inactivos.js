let tblUsuarios;
document.addEventListener('DOMContentLoaded', function(){
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + 'usuarios/listarInactivos',
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
})

function restaurarUsuario(idUsuario) {
    const url = base_url + 'usuarios/restaurar/'+idUsuario;
    restaurarRegistro(url,tblUsuarios);
    /*
    Swal.fire({
        title: 'Esta seguro de Restaurar?',
        text: "Se eliminara al usuario",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Restaurar Usuario'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'usuarios/restaurar/' + idUsuario; 
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