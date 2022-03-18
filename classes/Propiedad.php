<?php
namespace App;

class Propiedad {

    /* DB */
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    /* Errores o Validacion */
    protected static $errores = [];


    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    /* Definir conexion a la DB */
    public static function setDB($database) {
      self::$db = $database;
    }

    public function __construct($args = [])
    {
      $this->id = $args['id'] ?? null;  
      $this->titulo = $args['titulo'] ?? '';  
      $this->precio = $args['precio'] ?? '';  
      $this->imagen = $args['imagen'] ?? '';  
      $this->descripcion = $args['descripcion'] ?? '';  
      $this->habitaciones = $args['habitaciones'] ?? '';  
      $this->wc = $args['wc'] ?? '';  
      $this->estacionamiento = $args['estacionamiento'] ?? '';  
      $this->creado = date('Y/m/d');  
      $this->vendedorId = $args['vendedorId'] ?? 1 ;  
    }

    public function guardar () {
      if(!is_null($this->id)){
        //actualizando
        $this->actualizar();
      } else {
        //creando
        $this->crear();
      }
    }

    public function crear(){

      /* Sanitizar el ingreso de los datos */
      $atributos = $this->sanitizarAtributos();

        /* insertar en la DB */
        $query = " INSERT INTO propiedades ( ";
        $query.= join(', ', array_keys($atributos));
        $query.= " ) VALUES ( ' ";
        $query.= join("', '", array_values($atributos));
        $query.= " ' ) ";

        $resultado = self::$db->query($query);


        //debuguear($query);
        /* Mensaje de exito o error */
        if($resultado){
          /*  echo "Insertado Correctamente"; */
          /* redireccion al usuario */
          header('Location: /admin?resultado=1');
        }
  }

  public function actualizar() {
      /* Sanitizar el ingreso de los datos */
      $atributos = $this->sanitizarAtributos();

      $valores = [];
      foreach($atributos as $key => $value) {
        $valores[] = "{$key}='{$value}'";
      }

      $query = "UPDATE propiedades SET "; 
      $query.= join(', ', $valores );
      $query.= " WHERE id = '" . self::$db->escape_string($this->id) ."' ";
      $query.= " LIMIT 1 ";

      $resultado = self::$db->query($query);

      if($resultado){
        /*  echo "Insertado Correctamente"; */
        /* redireccion al usuario */
        header('Location: /admin?resultado=2');
     }
  }

  public function eliminar() {
      /* Eliminar Propiedad */
      $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

      $resultado = self::$db->query($query);

      if($resultado){
        $this->borrarImagen();

        header('Location: /admin?resultado=3'); 
    }
      
  }

  public function atributos() {
    $atributos = [];
    foreach(self::$columnasDB as $columna) {
      if ($columna === 'id') continue;
      $atributos[$columna] = $this->$columna;
    }
    return $atributos;
  }

  public function sanitizarAtributos() {
    $atributos = $this->atributos();
    $sanitizado = [];

    
    foreach($atributos as $key => $value ) {
      $sanitizado[$key] =  self::$db->escape_string($value);
    }
    
    return  $sanitizado;
  }

  /* Subida de Archivos */

  public function setImagen($imagen) {
    /* Eliminar la imagen previa */

    if( !is_null( $this->id) ) {
      $this->borrarImagen();
    }

    /* asignar a atributo en nombre de la imagen */
    if($imagen) {
      $this->imagen = $imagen; 
    }
  }

  //Eliminar Archivo
  public function borrarImagen() {
    //comprobar si existe el archivo
    $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
    if($existeArchivo){
      unlink(CARPETA_IMAGENES . $this->imagen);
    }
  }

  /* Validación */
  public static function getErrores() {
    return self::$errores;
  }

  public function validar() {

    /* validacion */
    if(!$this->titulo) {
        self::$errores[] = "Debes añadir un titulo";
    }
    
    if(!$this->precio){
      self::$errores[] = "Debes añadir un precio";
    }
    if( strlen($this->descripcion) <10 ){
        self::$errores[] = "Descripcion obligatoria y debe tener al menos 50 caracteres";
    }
    if(!$this->habitaciones){
        self::$errores[] = "Debes añadir un habitaciones";
    }
    if(!$this->wc){
        self::$errores[] = "Debes añadir un wc";
    }
    if(!$this->estacionamiento){
        self::$errores[] = "Debes añadir un estacionamiento";
    }
    if(!$this->vendedorId){
        self::$errores[] = "Debes añadir un vendedor";
    }
    if(!$this->imagen) {
      self::$errores[] = "La imagen es Obligatorio";
    }
    
    return self::$errores;
  }

  /* Lista de todas los registros */
  public static function all() {
    $query = "SELECT * FROM propiedades";

    $resultado = self::consultarSQL($query);
  
    return $resultado;    
    //debuguear($resultado);
  }

  // Busca un resgistro por su ID
  public static function find($id){
    $query = "SELECT * FROM propiedades WHERE id = ${id}"; 

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }


  public static function consultarSQL($query) {
    /* Consultar DB */
    $resultado = self::$db->query($query);
    
    
    /* Iterar los resultados */
    $array = [];
    while($registro = $resultado->fetch_assoc()) {
      $array[] = self::crearObjeto($registro);
    } 
    
    /* Liberar la memoria */
    $resultado->free();

    /* retornar los resultados */
    return $array;
  }
  
  protected static function crearObjeto($registro) {
    $objeto = new self;
    
    
    
    foreach($registro as $key => $value ) {
       if(property_exists( $objeto, $key )) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }

  //sincroniza el objeto en memoria con los cambios realizados por el usuario
  public function sincronizar( $argc = [] ){
    foreach($argc as $key => $value){
      if( property_exists($this, $key ) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

}