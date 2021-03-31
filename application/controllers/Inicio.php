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

}
?>