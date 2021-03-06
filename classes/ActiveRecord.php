<?php

namespace App;

class ActiveRecord {
    /* DB */
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    /* Errores o Validacion */
    protected static $errores = [];


    /* Definir conexion a la DB */
    public static function setDB($database) {
      self::$db = $database;
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
        $query = " INSERT INTO " . static::$tabla ." ( ";
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

      $query = "UPDATE " . static::$tabla . " SET "; 
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
      /* Eliminar registro */
      $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

      $resultado = self::$db->query($query);

      if($resultado){
        $this->borrarImagen();

        header('Location: /admin?resultado=3'); 
    }
      
  }

  public function atributos() {
    $atributos = [];
    foreach(static::$columnasDB as $columna) {
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

  /* Validaci??n */
  public static function getErrores() {
      return static::$errores;
    }
    
public function validar() {
    static::$errores = [];

    return static::$errores;
  }

  /* Lista de todas los registros */
  public static function all() {
    $query = "SELECT * FROM " . static::$tabla;

    
    $resultado = self::consultarSQL($query);
  
    return $resultado;    
    //debuguear($resultado);
  }

  //Obtiene determinado n??mero de registros
  public static function get($cantidad) {
    $query = "SELECT * FROM " . static::$tabla. " LIMIT " . $cantidad;
    
    $resultado = self::consultarSQL($query);
  
    return $resultado;    
    //debuguear($resultado);
  }

  // Busca un resgistro por su ID
  public static function find($id){
    $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}"; 

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }


  public static function consultarSQL($query) {
    /* Consultar DB */
    $resultado = self::$db->query($query);
    
    
    /* Iterar los resultados */
    $array = [];
    while($registro = $resultado->fetch_assoc()) {
      $array[] = static::crearObjeto($registro);
    } 
    
    /* Liberar la memoria */
    $resultado->free();

    /* retornar los resultados */
    return $array;
  }
  
  protected static function crearObjeto($registro) {
    $objeto = new static;
    
    
    
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