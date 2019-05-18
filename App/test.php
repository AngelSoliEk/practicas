<?php
include_once("imagen.php");
 class pelicula{
 var $idpelicula;
 var $precio;
 var $nompelicula;
 var $visitas;
 var $imagenes;

function pelicula($id,$nom,$clav,$vis){
 $this->idpelicula=$id;
 $this->nompelicula=$nom;
 $this->precio=$clav;
 $this->visitas=$vis;
 $this->imagenes=array();
}

 function insertar_pelicula()
{
 $conexion=new conexionBaseDatos();
 $consulta="Insert into pelicula (nompelicula,precio,visitas) value (:nompelicula,:precio,:visitas)";
 $datos=array(
  ":nompelicula"=>$this->nompelicula,
 ":precio"=>$this->precio,
  ":visitas"=>$this->visitas,
  );

 $this->idpelicula=$conexion->ejecutarsentencia($consulta,$datos);
}

 function modificar_pelicula()
{
 $conexion=new conexionBaseDatos();
 $consulta="update pelicula set nompelicula=:nompelicula,precio=:precio,visitas=:visitas where idpelicula=:idpelicula";
  $datos=array(
  ":nompelicula" =>$this->nompelicula,
  ":precio" =>$this->precio,
  ":visitas"=>$this->visitas,
 ":idpelicula"=>$this->idpelicula,
 );

  $conexion->ejecutarsentencia($consulta,$datos);
}
 function eliminar_pelicula()
 {
  $this->borrado_imagen_cascada();
  $conexion=new conexionBaseDatos();
  $consulta="delete from pelicula where idpelicula=:idpelicula";
 $datos=array(
 ":idpelicula"=>$this->idpelicula
 );
   $conexion->ejecutarsentencia($consulta,$datos);
 }
 function obtener_pelicula()
 {
  $conexion=new conexionBaseDatos();
  $consulta="SELECT nomarchivo,nompelicula,precio,visitas  FROM pelicula,imagen WHERE pelicula.idpelicula=imagen.idpelicula and pelicula.idpelicula=:idpelicula";
  $datos=array(
              ":idpelicula"=>$this->idpelicula
              );
  $resultados=$conexion->ejecutarsentencia($consulta,$datos);
  $resultados->setFetchMode(PDO::FETCH_INTO,$this);
  $resultados->fetch();
 }
 function aumentar_visitas($visita)
{
	$this->visitas=$vista;
 $conexion=new conexionBaseDatos();
 $consulta="update pelicula set visitas=:visitas where idpelicula=:idpelicula";
  $datos=array(
  ":visitas"=>$this->visitas,
 ":idpelicula"=>$this->idpelicula,
 );

  $conexion->ejecutarsentencia($consulta,$datos);
}
 function listar_peliculas()
{

 $lista_peliculas=array();
 $conexion=new conexionBaseDatos();
 $consulta="select idpelicula,precio,nompelicula,visitas from pelicula";
 $resultados=$conexion->ejecutarsentencia($consulta,$lista_peliculas);
 $resultados->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "pelicula",array("idpelicula","nompelicula","precio","visitas"));
 $lista_peliculas=$resultados->fetchALL();
 return $lista_peliculas;
 }


function obtener_imagen()
 {

 $imagenes=new imagen(0,"","",$this->idpelicula);

 $this->imagenes=$imagenes->listar_imagenes();


  }



function borrado_imagen_cascada()
{

 $conexion=new ConexionBaseDatos();
 $consulta="delete from pelicula where idpelicula=:idpelicula";

 $datos=array(

 ":idpelicula"=>$this->idpelicula
,
  );

$conexion->ejecutarsentencia($consulta,$datos);
}



}
?>