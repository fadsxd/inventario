const firstTabEl = document.querySelector('#nav-tab button:last-child')
const firstTab = new bootstrap.Tab(firstTabEl)

function insertarRegistros(url,idFormulario, tbl,idButton,accion){
            //crear formData
            const data = new FormData(idFormulario);
            //hacer una instancia del objeto XMLHttpRequest
            const http = new XMLHttpRequest();
            //abrir una conexion - POST - GET
            http.open('POST',url,true);
            //Enviar datos
            http.send(data);
            //verificar estados
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    console.log("---");
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
                        if(accion){
                            clave.removeAttribute('readonly');
                        }
                        if(tbl != null){
                            document.querySelector('#id_usuario').value = '';
                            idButton.textContent = 'Registrar';
                            idFormulario.reset();
                            //limpiarCampos();
                            tbl.ajax.reload();
                        }
                        
                       
                    }
                }
            }
}
function eliminarRegistro(url,tbl) {
    Swal.fire({
        title: 'Esta seguro de Eliminar?',
        text: "El registro no se eliminara de forma pemanete",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!!'
      }).then((result) => {
        if (result.isConfirmed) {
            
            //hacer una instancia del objeto XMLHttpRequest
            const http = new XMLHttpRequest();
            //abrir una conexion - POST - GET
            http.open('GET',url,true);
            //Enviar datos
            http.send();
            //verificar estados
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    console.log("---");
                    const res = JSON.parse(this.responseText);
                    console.log(res);

                    Swal.fire({
                        toast: true,
                        position: 'top-center',
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    if(res.type == 'success'){
                        tbl.ajax.reload();
                    }
                }
            }
        }
      })
}
function restaurarRegistro(url,tbl) {
    Swal.fire({
        title: 'Esta seguro de Restaurar?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Restaurar!'
      }).then((result) => {
        if (result.isConfirmed) {
            //const url = base_url + 'usuarios/restaurar/' + idUsuario; 
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
                        tbl.ajax.reload();
                    }
                }
            }
        }
      })
}
function alertaPersonalizada(type,msg) {
    Swal.fire({
        toast: true,
        position: 'top-center',
        icon: type,
        title: msg,
        showConfirmButton: false,
        timer: 2000
    })
}