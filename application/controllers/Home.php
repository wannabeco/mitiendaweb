<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal

   Este archivo es el controlador que realizara al cuál se harán los llamados desde las url en la página o en los procesos AJAX que se utilicen.
*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
        $this->load->model("admin/LogicaEnBlanco", "logicaUsuarios");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
        $this->load->model("home/LogicaHome", "logicaHome");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
       	$this->load->helper('language');//mantener siempre.
    	$this->lang->load('spanish');//mantener siempre.
    }
    /*
    * Funcion inicial del módulo de creación de usuarios
    * @author Farez Prieto
    * @date 17 de Noviembre de 2016
    * @param $idModulo Este parámetro siempre lo enviará el menú y siempre se deberá recibir en la función del módulo principal, no olvidar esto.
    * Esta función permite inicializar este módulo, dentro de ella siempre se debe declarar la variable de session $_SESSION['moduloVisitado'] con el $idModulo Pasado por parámetro
    * y a continuación siempre se debe llamar la función del helper llamada getPrivilegios, la función está en el archivo helpers/funciones_helper.php
    * Tenga en cuenta que cada llamado ajax que haga a una plantilla gráfica que incluya botones de ver,editar, crear, borrar debe siempre llamar la función getPrivilegios.
    */
	public function index()	
	{
		$salida['titulo'] = lang("titulo")." - Recordar Contraseña";
		$salida['centro'] = "login/recordarClave";
		$this->load->view("paginaWeb/index",$salida);
	}
	public function getCategorias()
	{
		$where['idTienda']   = $_POST['idTienda'];
		$where['idEstado']   = 1;
		$categorias	     = $this->logicaHome->getCategorias($where);
		echo json_encode($categorias);
	}
	public function getSubcategorias()
	{
		$where['idEstado'] 	 = 1;
		$where['idProducto'] = $_POST['categoria'];
		$where['idTienda']   = $_POST['idTienda'];
		$subcategorias	     = $this->logicaHome->getSubcategorias($where);
		echo json_encode($subcategorias);
	}
	public function getProductos()
	{
		$where['p.idEstado']   = 1;
		$where['p.idTienda']   = $_POST['idTienda'];
		if($_POST['categoria'] != "")
		{
			$where['p.idProducto'] = $_POST['categoria'];
		}
		if($_POST['subcategoria'] != "")
		{
			$where['p.idSubcategoria'] = $_POST['subcategoria'];
		}

		$subcategorias	     = $this->logicaHome->getProductos($where);
		echo json_encode($subcategorias);
	}
	public function getProductosPhp()
	{
		$where['idEstado']   = 1;
		$where['idTienda']   = $_POST['idTienda'];
		if($_POST['categoria'] != "")
		{
			$where['idProducto'] = $_POST['categoria'];
		}
		if($_POST['subcategoria'] != "")
		{
			$where['idSubcategoria'] = $_POST['subcategoria'];
		}

		$productos	     = $this->logicaHome->getProductos($where);

		$salida["productos"]  = $productos['datos'];
		echo $this->load->view("paginaWeb/productosList",$salida,true);

	}
	public function procesaLike()
	{
		$proceso	     = $this->logicaHome->procesaLike($_POST);
		echo json_encode($proceso);
	}
	public function agregarCarrito()
	{
		$proceso	     = $this->logicaHome->agregarCarrito($_POST);
		echo json_encode($proceso);
	}
	public function quitarDelCarrito()
	{
		$proceso	     = $this->logicaHome->quitarDelCarrito($_POST);
		echo json_encode($proceso);
	}
	public function modificarCantidad()
	{
		$proceso	     = $this->logicaHome->modificarCantidad($_POST);
		echo json_encode($proceso);
	}
	public function leerCarrito()
	{
		$proceso	     = $this->logicaHome->leerCarrito($_POST);
		echo json_encode($proceso);
	}

	public function cargaPlantillaModal()
	{
		/*extract($_POST);
		//listados 

		$tiposDoc		  	 = $this->logica->consultatiposDoc(); 
		$sexo		  	 	 = $this->logica->consultaSexo(); 
		$profesiones  	 	 = $this->logica->consultaProfesiones(); 
		$cargos  	 	 	 = $this->logica->consultaCargos(); 
		$perfiles  	 	 	 = $this->logica->consultaPerfiles(); 
		$areas  	 	 	 = $this->logica->consultaAreas(); 
		$salida["selects"]   = array("tiposDoc"=>$tiposDoc,
									  "sexo"=>$sexo,
									  "profesiones"=>$profesiones,
									  "perfiles"=>$perfiles,
									  "areas"=>$areas,
									  "cargos"=>$cargos);
		if($edita == 1)
		{
			$infoUsuario	     = $this->logicaUsuarios->infoUsuario($idUsuario);
			//var_dump($infoUsuario);

			$salida["titulo"] 	 = "Editar el usuario ";
			$salida["datos"]  	 = $infoUsuario['datos'][0];
			$salida["idUsuario"] = $idUsuario;
			$salida["edita"]  	 = $edita;
			$salida["labelBtn"]  = "EDITAR USUARIO";
		}
		else
		{
			$salida["titulo"] 	 = "Agregar nuevo usuario";
			$salida["datos"] 	 = array();
			$salida["edita"]  	 = $edita;
			$salida["idUsuario"] = $idUsuario;
			$salida["labelBtn"]  = "CREAR USUARIO";
		}
		echo $this->load->view("admin/adminUsuarios/formControl",$salida,true);*/
	}
}
?>