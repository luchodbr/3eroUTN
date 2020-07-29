namespace animalesx{
    
    export class Perro implements Animal{
        
        public nombre:string;
        constructor(nombre?:string){
            this.nombre=nombre;
        }
        
        public hacerRuido():void{
            console.log("Guau");
        }
    }
        
         var miPerro:Perro = new Perro("Guau");
         var chacho:Perro = new Perro();
        
         var animal:Animal = new Perro();
        
        //typeof(animal);//pa ver que devuelve 
        
        // var animales:Array<Animal> = new Array<Animal>();
        
        // animales.push(chacho);
        // animales.push(miPerro);
        // //estos array podrias usar map reduce filter
        // if(typeof(animal) == typeof(Perro)){
            
        // }
}
    
