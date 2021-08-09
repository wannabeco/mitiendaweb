<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por  @orugal
   https://github.com/orugal
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Inicio extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("home/LogicaHome", "logicaHome");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
	public function index()	
	{
		//aca debo validar el dominio que esta cargando arriba.
		//die($_SERVER["HTTP_HOST"]);
		//aca lo primero que debo hacer es subir a session la data de la tienda visitda para consultar todo con ese idTienda
		$infoTienda = $this->logicaHome->getInfoTienda($_SERVER["HTTP_HOST"]);
		if(count($infoTienda['datos']) > 0)
		{
			//subo los datos a session
			$_SESSION['tiendaVisitada'] = $infoTienda['datos'][0];
			$salida['titulo'] = "";
			$salida['centro'] = "";
			$salida['infoTienda'] = $infoTienda['datos'][0];
			$this->load->view("paginaWeb/index",$salida);
		}
		else
		{
			$salida['titulo'] = "";
			$salida['centro'] = "";
			$this->load->view("paginaWeb/tiendaNoExiste",$salida);
		}
	}
	public function indexTest($nombreTienda="")	
	{
		$salida['titulo'] = "Pedidos Colombia";
		$salida['centro'] = "";
		$this->load->view("paginaWeb/paginaPrincipal",$salida);
	}
	public function crearTienda()	
	{
		//consulto los tipos de tienda creados
		$listaTiposTienda =  $this->logica->getTiposTiendas(array("eliminado"=>0));
		//listado de municipios para el pais 
		$listaDepartamentos   = $this->logica->getDepartamentos(array("ID_PAIS"=>'057'));
		$selects = array("tiposTienda"=>$listaTiposTienda['datos'],
						 "deptos"=>$listaDepartamentos['datos']);
		$salida['titulo'] = "Crear nueva tienda";
		$salida['centro'] = "";
		$salida['selects'] = $selects;
		$this->load->view("paginaWeb/crearTienda",$salida);
	}

	public function tiendas($nombreTienda="")
	{
		//aca debo validar el dominio que esta cargando arriba.
		//die($_SERVER["HTTP_HOST"]);
		//aca lo primero que debo hacer es subir a session la data de la tienda visitda para consultar todo con ese idTienda
		if($nombreTienda != "")
		{
			$infoTienda = $this->logicaHome->getInfoTienda("","",$nombreTienda);
		}
		else
		{
			$infoTienda = $this->logicaHome->getInfoTienda($_SERVER["HTTP_HOST"]);
		}
		//reviso la info de la tienda
		if(count($infoTienda['datos']) > 0)
		{
			//subo los datos a session
			$_SESSION['tiendaVisitada'] = $infoTienda['datos'][0];
			$salida['titulo'] = "";
			$salida['centro'] = "";
			$salida['infoTienda'] = $infoTienda['datos'][0];
			$this->load->view("paginaWeb/index",$salida);
		}
		else
		{
			$salida['titulo'] = "";
			$salida['centro'] = "";
			$this->load->view("paginaWeb/tiendaNoExiste",$salida);
		}
	}

	public function registroExitoso($idTienda="")
	{
		//aca debo validar el dominio que esta cargando arriba.
		//die($_SERVER["HTTP_HOST"]);
		//aca lo primero que debo hacer es subir a session la data de la tienda visitda para consultar todo con ese idTienda
		if($idTienda != "")
		{
			$infoTienda = $this->logicaHome->getInfoTienda("",$idTienda,"");
			//reviso la info de la tienda
			if(count($infoTienda['datos']) > 0)
			{
				$salida['titulo'] = "Registro exitoso";
				$salida['centro'] = "";
				$salida['infoTienda'] = $infoTienda['datos'][0];
				$this->load->view("paginaWeb/registroExitoso",$salida);
			}
			else
			{
				$salida['titulo'] = "Registro exitoso";
				$salida['centro'] = "";
				$this->load->view("paginaWeb/tiendaNoExiste",$salida);
			}
		}
		else
		{
			$this->load->view("paginaWeb/tiendaNoExiste",$salida);
		}
		
	}

	public function homeEmpresa()
	{
		
	}	
	public function recordarClave()
	{
		$salida['titulo'] = lang("titulo")." - Recordar Contraseña";
		$salida['centro'] = "login/recordarClave";
		$this->load->view("login/index",$salida);
	}
	public function cabeza()
	{
		if($_SESSION['project']['info']['idPerfil'] == 6)//admin de la tienda
        {
			$infoTienda = $this->logicaHome->getInfoTienda("",$_SESSION['project']['info']['idTienda']);
        }
        else
        {
        	$infoTienda = array();
        }
		$salida['infoTienda'] = $infoTienda;
		$salida['opc']    	  = "";
		$salida['modulos']    = $this->logica->getModulos(1);
		echo $this->load->view("app/menu",$salida,true);
	}

	public function getMunicipios()
	{
		$municipios =  $this->logica->getCiudades(array("ID_PAIS"=>"057","ID_DPTO"=>$_POST['idDepartamento']));
		echo json_encode($municipios);
	}

}
?>