var http = new XMLHttpRequest;
 function agregar(){

    //console.log("Hola");
    var apellido =  document.getElementById("lname").value;
    var nombre =  document.getElementById("fname").value;
    var fecha =  document.getElementById("fecha").value;
    var telefono =  document.getElementById("telefono").value;
    //console.log(fecha);

    if(apellido=="" || nombre=="")
    {
        document.getElementById("lname").className = "error";
        document.getElementById("fname").className = "error";
        
        return;
    }
    if(confirm("¿Estas seguro que desea agregar una persona?"))
    {
    //     document.getElementById("lname").className = "sinError";
    //     document.getElementById("fname").className = "sinError";
    //     var tCuerpo = document.getElementById("tCuerpo");
    //     tCuerpo.innerHTML+=
    //     "<tr>"+
    //     "<td>"+nombre +"</td>"+
    //     "<td>"+apellido +"</td>"+
    //     "<td><a href=''>borrar</a></td>"+
    // "</tr>";
    //ejecutarPost();
    ejecutarPost(nombre,apellido,fecha,telefono);
    //ejecutarModificar(id,nombre,apellido,fecha,sexo);
    }
}
function contenedorAparecer(){
    document.getElementById("containerAgregar").hidden=false;
}
function contenedorDesaparecer(){
    document.getElementById("containerAgregar").hidden=true;
}
function loadingAparecer(){
    document.getElementById("load").hidden=false;
}
function loadingDesaparecer(){
    document.getElementById("load").hidden=true;
}
function ejecutarPost(nombre,apellido,fecha,telefono){
    contenedorDesaparecer();
    loadingAparecer();
    var httpPost = new XMLHttpRequest();
    httpPost.onreadystatechange=function(){        
        if(httpPost.readyState==4 && httpPost.status == 200){
            console.log(httpPost.responseText);
            //location.reload();
            loadingDesaparecer();
        }
    }
    httpPost.open("POST","http://localhost:3000/nuevaPersona",true);
    httpPost.setRequestHeader("Content-Type","application/json");
    //var json ={"nombre":nombre,"apellido":apellido,"fecha":fecha,"telefono":telefono};
    var json ={"nombre":nombre,"apellido":apellido,"fecha":fecha,"telefono":telefono};
    httpPost.send(JSON.stringify(json));
    //CONTROL-C podes matar la api via console
    /// PONER UN GIFT CARGANDO Y CUANDO YA VUELVA EL SERVIDOR SACAR EL GIFT Y RECARGAR LA GRILLA CON LA RESPUESTA DEL SERVIDOR 
}
function ejecutarModificar(id,nombre,apellido,fecha,sexo){
    contenedorDesaparecer();
    loadingAparecer();
    var httpPost = new XMLHttpRequest();
    httpPost.onreadystatechange=function(){        
        if(httpPost.readyState==4 && httpPost.status == 200){
            console.log(httpPost.responseText);
            //location.reload();
            loadingDesaparecer();
        }
    }
    httpPost.open("POST","http://localhost:3000/editar",true);
    httpPost.setRequestHeader("Content-Type","application/json");
    var json ={"id":id,"nombre":nombre,"apellido":apellido,"fecha":fecha,"sexo":sexo};
    //var json ={"nombre":nombre,"apellido":apellido,"fecha":fecha,"telefono":telefono};
    httpPost.send(JSON.stringify(json));
    //CONTROL-C podes matar la api via console
    /// PONER UN GIFT CARGANDO Y CUANDO YA VUELVA EL SERVIDOR SACAR EL GIFT Y RECARGAR LA GRILLA CON LA RESPUESTA DEL SERVIDOR 
}

window.onload=function(){
    this.GetPersonas();
}

function armarGrilla(jsonObj){
    for(var i=0;i<jsonObj.length;i++){
        
        document.getElementById("lname").className = "sinError";
        document.getElementById("fname").className = "sinError";
        document.getElementById("fecha").className = "sinError";
        document.getElementById("telefono").className = "sinError";
        // tr.setAttribute("idPersona",jsonObj[i].id);
        agregarPersona(jsonObj[i])
        /* // nodoTexto
        tCuerpo.innerHTML+=
        "<tr>"+
        "<td>"+jsonObj[i].nombre +"</td>"+
        "<td>"+jsonObj[i].apellido +"</td>"+
        "<td>"+jsonObj[i].fecha +"</td>"+
        "<td>"+jsonObj[i].telefono +"</td>"+
        "<td><a href=''>borrar</a></td>"+
        "</tr>";*/
        
    }
}
    function agregarPersona(persona){
        var tCuerpo = document.getElementById("tCuerpo");
        var tr =document.createElement("tr");
        tr.setAttribute("idPersona",persona.id);
        //Agrega una row
        var td =document.createElement("td");
        var nodoTexto1 = document.createTextNode(persona.nombre);
        td.appendChild(nodoTexto1);
        tr.appendChild(td); //agrego la row a la tabla 

        var td2 =document.createElement("td");
        var nodoTexto2 = document.createTextNode(persona.apellido);
        td2.appendChild(nodoTexto2);
        tr.appendChild(td2); //agrego la row a la tabla 

        var td3 =document.createElement("td");
        var nodoTexto3 = document.createTextNode(persona.fecha);
        td3.appendChild(nodoTexto3);
        tr.appendChild(td3); //agrego la row a la tabla 

        var td4 =document.createElement("td");
        var nodoTexto4 = document.createTextNode(persona.telefono);
        td4.appendChild(nodoTexto4);
        tr.appendChild(td4); //agrego la row a la tabla 

        
        tr.addEventListener("dblclick",clickGrilla);
        tCuerpo.appendChild(tr);
    }

function GetPersonas(){
    http.onreadystatechange = function(){
        if(http.readyState == 4 && http.status == 200){
            //console.log(http.responseText);
            objPersonas =JSON.parse(http.responseText) 
            armarGrilla(objPersonas);
        }
    }
    http.open("GET","http://localhost:3000/personas",true);
    http.send();
}
var trClick;
function clickGrilla(e){
    trClick = e.target.parentNode;
    //console.log(e);
    //console.log(e.target.parentNode.childNodes[0].innerHTML);//esto me da una lista de tds
    //document.getElementById("nombre") = trClick.childNodes[0].innerHTML;
    contenedorAparecer();
    document.getElementById("fname").value = trClick.childNodes[0].textContent;
    document.getElementById("lname").value = trClick.childNodes[1].textContent;
    document.getElementById("fecha").value = trClick.childNodes[2].textContent;
    document.getElementById("telefono").value = trClick.childNodes[3].textContent;
    alert(trClick.getAttribute("idPersona"));
    var btnModificar = document.getElementById("btnModificar");
   
    // trClick.removeChild(trClick.childNodes[0]);
    
}

function Modificar(){
     trClick.childNodes[0].textContent = document.getElementById("fname").value;
     trClick.childNodes[1].textContent = document.getElementById("lname").value;
     trClick.childNodes[2].textContent = document.getElementById("fecha").value;
     trClick.childNodes[3].textContent = document.getElementById("telefono").value;
     ejecutarModificar(trClick.getAttribute("idPersona"),trClick.childNodes[0].textContent,trClick.childNodes[1].textContent,trClick.childNodes[2].textContent
        ,"masculino");

}

