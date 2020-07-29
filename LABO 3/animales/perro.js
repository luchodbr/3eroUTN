var animalesx;
(function (animalesx) {
    var Perro = /** @class */ (function () {
        function Perro(nombre) {
            this.nombre = nombre;
        }
        Perro.prototype.hacerRuido = function () {
            console.log("Guau");
        };
        return Perro;
    }());
    animalesx.Perro = Perro;
    var miPerro = new Perro("Guau");
    var chacho = new Perro();
    var animal = new Perro();
    //typeof(animal);//pa ver que devuelve 
    // var animales:Array<Animal> = new Array<Animal>();
    // animales.push(chacho);
    // animales.push(miPerro);
    // //estos array podrias usar map reduce filter
    // if(typeof(animal) == typeof(Perro)){
    // }
})(animalesx || (animalesx = {}));
