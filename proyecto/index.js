var divPrincipal = document.getElementById("divPrincipal");
var divPanel = document.getElementById("divPanel");
var divHead = document.getElementById("divHead");
var InputCampo = document.getElementById("inputCampo");
var InputCantCampos = document.getElementById("inputCantCampos");
var selectCarreras = document.getElementById("selectCarrera");
var selectCarrerasAlta = document.getElementById("selectCarreraAlta");
var inputNombre = document.getElementById("inputNombre");
var inputApellido = document.getElementById("inputApellido");
var buttonAbrirAlta = document.getElementById("buttonAbrirAlta");
var contenedorFormAlta = document.getElementById("contenedorFormAlta");
var footer = document.getElementById("footer");
var header = document.getElementById("header");
var cerrar = document.getElementById("cerrar");
var cerrarPdf = document.getElementById("cerrarPdf");
var formAlta = document.getElementById("formAlta");
var checkCV = document.getElementById("checkCV");
var pdfAlta = document.getElementById("pdfAlta");
var inputSecret = document.getElementById("inputSecret");
var mostrarPdf = document.getElementById("mostrarPdf");
var whiteSpace = /^\s+$/;
//Formulario alta elementos
var dniAlta = document.getElementById("dniAlta");
var nombreAlta = document.getElementById("nombreAlta");
var apellidoAlta = document.getElementById("apellidoAlta");
var btnEnviarAlta = document.getElementById("btnEviar");
var ocultoValue = document.getElementById("ocultoValue");
var idOculto = document.getElementById("idOculto");
var pdfAlta = document.getElementById("pdfAlta");

function cambiarCampo(element){
    $('#inputCampo').val(element);
    $("#button").click();
}

$(document).ready(function(){
$("#button").click(function(){
    $("#divPrincipal").empty();
    var pText = document.createElement("p");
    pText.setAttribute("class", "pRespuesta");
    pText.innerHTML = "Esperando respuesta.. <i class='fa fa-spinner fa-pulse fa-2x'></i>";
    divPrincipal.appendChild(pText);
    $("#pText").html("Esperando respuesta...<i class='fa fa-spinner fa-pulse fa-2x'></i>");
    if(selectCarreras.value == "" && inputNombre.value == "" && inputApellido.value == ""){
        traerTodosUsuarios(pText);
    }else{
        if(selectCarreras.value != "" && inputNombre.value == "" && inputApellido.value == ""){
            traerPorCarrerra(pText);
        }else{
            if(selectCarreras.value == "" && inputNombre.value != "" && inputApellido.value == ""){
                filtrarPorNombre(pText);
            }else{
                if(selectCarreras.value == "" && inputNombre.value == "" && inputApellido.value != ""){
                    filtrarPorApellido(pText);
                }else{
                    if(selectCarreras.value != "" && inputNombre.value != "" && inputApellido.value != ""){
                        filtrarPorTodo(pText);
                    }else{
                        $(pText).empty();
                        swal("Aviso", "No esta permitida esta operacion!", "warning");
                    }
                }
            }
        }
    }
    });
});

document.getElementById("body").onload = function(){
    $.ajax({
        type:"get",
        url: "TraerCarreras.php", 
        data:{}, 
        success: function(result){
            var JsonObj = JSON.parse(result);
            AddCarreras(JsonObj);
        }
    });
    cargarCarrerasAlta();
}

function cargarCarrerasAlta(){
    $.ajax({
        type:"get",
        url: "TraerCarreras.php", 
        data:{}, 
        success: function(result){
            var JsonObj = JSON.parse(result);
            AddCarrerasAlta(JsonObj);
        }
    });
}

function traerPorCarrerra(element){
    $.ajax({
        type:"get",
        url: "alumnosPorCarrera.php",
        data:{carrera : $("#selectCarrera").val()},  
        success: function(result){
            var JsonObj = JSON.parse(result);
            $(element).empty();
            addTable(JsonObj);
            InputCantCampos.value = JsonObj.users.length;
        }
    });
}

function filtrarPorNombre(element){
    $.ajax({
        type:"get",
        url: "filtrarPorNombre.php",
        data:{nombre : $("#inputNombre").val()},  
        success: function(result){
            var JsonObj = JSON.parse(result);
            $(element).empty();
            addTable(JsonObj);
            InputCantCampos.value = JsonObj.users.length;
        }
    });
}

function filtrarPorApellido(element){
    $.ajax({
        type:"get",
        url: "filtrarPorApellido.php",
        data:{apellido : $("#inputApellido").val()},  
        success: function(result){
            var JsonObj = JSON.parse(result);
            $(element).empty();
            addTable(JsonObj);
            InputCantCampos.value = JsonObj.users.length;
        }
    });
}

function filtrarPorTodo(element){
    $.ajax({
        type:"get",
        url: "filtrarPorTodo.php",
        data:{nombre : $("#inputNombre").val(), apellido : $("#inputApellido").val(), carrera : $("#selectCarrera").val()},  
        success: function(result){
            var JsonObj = JSON.parse(result);
            $(element).empty();
            addTable(JsonObj);
            InputCantCampos.value = JsonObj.users.length;
        }
    });
}

function traerTodosUsuarios(element){
    $.ajax({
        type:"get",
        url: "respuesta.php",
        data:{campo : $("#inputCampo").val()},  
        success: function(result){
            var JsonObj = JSON.parse(result);
            $(element).empty();
            addTable(JsonObj);
            InputCantCampos.value = JsonObj.users.length;
        }
    });
}

function addTable(result){
    var table = document.createElement("table");
    result.users.forEach(function(index, value){
        var tr = document.createElement("tr");
        var tdId = document.createElement("td");
        var tdNombre = document.createElement("td");
        var tdApellido = document.createElement("td");
        var tdCarrera = document.createElement("td");
        var tdDni = document.createElement("td");
        var tdPdf = document.createElement("td");
        var tdModi = document.createElement("td");
        var tdBaja = document.createElement("td");
        tdId.setAttribute("class","tdId");
        tdCarrera.setAttribute("class", "tdCarrera");
        tdDni.setAttribute("class", "tdDni");
        tdApellido.setAttribute("class", "tdApellido");
        tdNombre.setAttribute("class", "tdNombre");
        tdPdf.setAttribute("class", "tdPdf");
        tdModi.setAttribute("class", "tdModi"); 
        tdId.innerHTML = index.idAlumno;
        tdNombre.innerHTML = index.nombre;
        tdApellido.innerHTML = index.apellido;
        tdCarrera.innerHTML = index.carrera;
        tdDni.innerHTML = index.dniAlumno;
        tdPdf.innerHTML = "<button id=buttonPdf onclick='traerPdf(this)' class=buttonPdf value=" + index.idAlumno + ">Pdf</button>"
        tdModi.innerHTML = "<button id=buttonModi onclick='modi(this)' class=buttonModi value=" + index.idAlumno + ">Modi</button>"
        tdBaja.innerHTML = "<button id=buttonBaja onclick='baja(this)' class=buttonBaja value=" + index.idAlumno + ">Baja</button>"
        tr.appendChild(tdId);
        tr.appendChild(tdNombre);
        tr.appendChild(tdApellido);
        tr.appendChild(tdCarrera);
        tr.appendChild(tdDni);
        tr.appendChild(tdPdf);
        tr.appendChild(tdModi);
        tr.appendChild(tdBaja);
        table.appendChild(tr);
    });
    divPrincipal.appendChild(table);
}

function AddCarreras(result){
    var optionEmpty = document.createElement("option");
	optionEmpty.setAttribute("value", "");
	optionEmpty.innerHTML = "";
	selectCarreras.appendChild(optionEmpty);
	result.carreras.forEach(function(index, value){
		var option = document.createElement("option");
		option.setAttribute("value", index.carrera);
		option.innerHTML = index.carrera;
		selectCarreras.appendChild(option);
	});
}

function AddCarrerasAlta(result){
	result.carreras.forEach(function(index, value){
		var option = document.createElement("option");
		option.setAttribute("value", index.carrera);
		option.innerHTML = index.carrera;
		selectCarrerasAlta.appendChild(option);
	});
}

function abrirFormAlta(element){
    if(element == "1"){
        nombreAlta.value = "";
        dniAlta.value = "";
        apellidoAlta.value = "";
    }
    ocultoValue.setAttribute("value", element);
    divHead.style.opacity = "0.3";
    divHead.style.pointerEvents = "none";
    divPrincipal.style.opacity = "0.3";
    divPrincipal.style.pointerEvents = "none";
    divPanel.style.opacity = "0.3";
    divPanel.style.pointerEvents = "none";
    footer.style.opacity = "0.3";
    header.style.opacity = "0.3";
    contenedorFormAlta.style.display = "block";
}

cerrar.onclick = function(){
    cerrarFormAlta();
}

function closePdf(){
        mostrarPdf.style.display = "none";
    }


function cerrarFormAlta(){
    contenedorFormAlta.style.display = "none";
    divHead.style.opacity = "1";
    divHead.style.pointerEvents = "auto";
    divPrincipal.style.opacity = "1";
    divPrincipal.style.pointerEvents = "auto";
    divPanel.style.opacity = "1";
    divPanel.style.pointerEvents = "auto";
    footer.style.opacity = "1";
    header.style.opacity = "1";
}

checkCV.onclick = function(){
    if(checkCV.checked == true){
        pdfAlta.removeAttribute("disabled");
    }if(checkCV.checked == false){
        pdfAlta.setAttribute("disabled", true);
    }
}

function validarFormAlta(){
    if (nombreAlta.value == "" || whiteSpace.test(nombreAlta.value)) {
		event.preventDefault();
        return false;
	}else{
        if (apellidoAlta.value == "" || whiteSpace.test(apellidoAlta.value)){
            event.preventDefault();
            return false;
        }else{
            if (dniAlta.value == "" || whiteSpace.test(dniAlta.value)){
                event.preventDefault();
               return false;
           }else{
               return true;
           }
        }
    }
}

function alumnoNoExiste(){
    $.ajax({
        type:"get",
        url: "noExisteAlumno.php",
        data:{dniAlta : $("#dniAlta").val()},  
        success: function(result){
            var JsonObj = JSON.parse(result);
            inputSecret.value = JsonObj.users.length;
        },
    });
}

function insertarAlumno(){ 
    var form = $("#formAlta")[0];
    var data = new FormData(form);
    $.ajax({
        type:"post",
        enctype: 'multipart/form-fata',
        url: "altaAlumno.php",
        processData: false,
        contentType: false,
        cache: false,
        data: data,  
        success: function(result){
            swal("Aviso",result,"info");
            $("#button").click();
        },
    });
    return false
}

function activarAltaModi(){
    if(ocultoValue.value == "1"){
        if(validarFormAlta()){
            $.ajax({
                type:"get",
                url: "noExisteAlumno.php",
                data:{dniAlta : $("#dniAlta").val()},  
                success: function(result){
                    var JsonObj = JSON.parse(result);
                    if(JsonObj.users.length == 0){
                        insertarAlumno();
                        cerrarFormAlta();
                    }else{
                        swal("Aviso", "El alumno con dni "+ dniAlta.value +" ya existe!", "warning");    
                    }
                },
            });
        }else{
            swal("Aviso","Verifique los campos requeridos y vuelva a intentarlo!","warning");
        }
    }else{
        if(validarFormAlta()){
            var form = $("#formAlta")[0];
            var data = new FormData(form);
            $.ajax({
                type:"post",
                enctype: 'multipart/form-fata',
                url: "modiAlumno.php",
                processData: false,
                contentType: false,
                cache: false,
                data: data,
                success: function(result){
                    swal("Aviso",result ,"warning");
                    cerrarFormAlta();
                    $("#button").click();

                },
            });
        }
        swal("Aviso","Verifique los campos requeridos y vuelva a intentarlo!","warning");
    }
}

function cargarDatosModi(element){
    $.ajax({
        type:"get",
        url: "traerAlumnoPorId.php",
        data:{idAlumno : $(element).val()}, 
        success: function(result){
            var JsonObj = JSON.parse(result);
            JsonObj.users.forEach(function(index, value){
                idOculto.setAttribute("value", index.idAlumno);  
                dniAlta.setAttribute("value", index.dniAlumno); 
                nombreAlta.setAttribute("value", index.nombre); 
                apellidoAlta.setAttribute("value", index.apellido);
                dniAlta.value = index.dniAlumno;
                nombreAlta.value = index.nombre;
                apellidoAlta.value = index.apellido; 
                selectCarrerasAlta.value = index.carrera; 
            });
        },
    });
}

function traerPdf(element){
    $.ajax({
        type:"post",
        url: "traerPdf.php",
        data:{idAlumno : $(element).val()}, 
        success: function(result){
            var JsonObj = JSON.parse(result);
            mostrarPdf.innerHTML = "<iframe class='pdf' src='data:application/pdf;base64, "+JsonObj.pdf+"'></iframe>"+" "+"<button onclick='closePdf();' id='cerrarPdf' class='buttonCerrarPdf'>x</button>"; 
            mostrarPdf.style.display = "block";
        },
    });
}

function modi(element){
    cargarDatosModi(element);
    abrirFormAlta("0");
}

function borrarRegistros(){
    inputApellido.value = "";
    inputNombre.value = "";
    selectCarreras.value = "";
}

function baja(element){
    $.ajax({
        type:"post",
        url: "baja.php",
        data:{idAlumno : $(element).val()}, 
        success: function(result){
            swal("Aviso",result ,"warning");
            $("#button").click();
            },
    });
}

function cerrarSesion(){
        location.href = "../destruirSesion.php"; 
}