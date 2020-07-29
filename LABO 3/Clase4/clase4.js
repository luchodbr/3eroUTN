 function agregar(){

    console.log("Hola");
    var apellido =  document.getElementById("lname").value;
    var nombre =  document.getElementById("fname").value;

    if(apellido=="" || nombre=="")
    {
        document.getElementById("lname").className = "error";
        document.getElementById("fname").className = "error";
        return;
    }
    if(confirm("¿Estas seguro que desea agregar una persona?"))
    {
        document.getElementById("lname").className = "sinError";
        document.getElementById("fname").className = "sinError";
        var tCuerpo = document.getElementById("tCuerpo");
        tCuerpo.innerHTML+=
        "<tr>"+
        "<td>"+nombre +"</td>"+
        "<td>"+apellido +"</td>"+
        "<td><a href=''>borrar</a></td>"+
    "</tr>";
    }
}
function contenedorAparecer(){
    document.getElementById("containerAgregar").hidden=false;
}
function contenedorDesaparecer(){
    document.getElementById("containerAgregar").hidden=true;
}