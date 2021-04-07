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
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosGral extends CI_Model {
    private $tableDeptos                 =   "";
    private $tableCiudad                 =   "";
    private $tableMails                  =   "";
    private $tableInfoPago               =   "";
    private $tableEmpresas               =   "";
    private $tablePersonas               =   "";
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->tableDeptos               = "app_departamentos"; 
        $this->tableCiudad               = "app_ciudades"; 
        $this->tableMails                = "app_mails";
        $this->tableInfoPago             = "app_estadopago";
        $this->tableEmpresas             = "app_empresas";
        $this->tablePersonas             = "app_personas";
        $this->tableModulos              = "app_modulos";
        $this->tableRelModulosPerfil     = "app_rel_perfil_modulo";
        $this->tablePerfiles             = "app_perfiles";
        $this->tableTiposDoc             = "app_tipos_doc";
        $this->tableSexo                 = "app_sexo";
        $this->tableProfesiones          = "app_profesiones";
        $this->tableCargos               = "app_cargos";
        $this->tableAreas                = "app_areas";
        $this->tableEps                  = "app_listado_eps";
        $this->tableCesantias            = "app_cesantias";
        $this->tableAfp                  = "app_listado_afp";
        $this->tableServicios            = "app_lista_de_servicios";
        $this->tableRelCargoServ         = "app_rel_cargo_servicio";
        $this->tableAseguradoras         = "app_lista_aseguradoras";
        $this->tableAuditoria            = "app_auditoria_general";
        $this->tableOcupaciones          = "app_lista_ocupaciones";
        $this->tableEstadoCivil          = "app_lista_estados_civiles";
        $this->tableEscolaridad          = "app_lista_nivel_educativo";
        $this->tableReligiones           = "app_lista_religiones";
        $this->tableGrupoEtnico          = "app_pertenencia_etnica";
        $this->tableCiediez              = "app_cie_diez";
        $this->tableRelCieDiez           = "app_rel_visitas_ciediez";
        $this->tableVariablesGlobales    = "app_variablesglobales";
        $this->tableProductos            = "app_productos";
        $this->tablePedidos              = "app_pedidos";
        $this->tableDetPedidos           = "app_detalle_pedido";
        $this->tableEstadosPedido        = "app_estado_pedido";
        $this->tableCiudadesVentas       = "app_ciudades_venta";
        $this->tableConjuntos            = "app_conjuntos";
        $this->tableTiendas              = "app_tiendas";
        $this->tablePresentaciones       = "app_presentacion_producto";
        $this->tableLogin                = "app_login";
        $this->tableRelConjuntoVendedora = "app_rel_conjunto_vendedora";
        $this->tableInventario           = "app_inventario_producto";
        $this->tableEstadisticas         = "app_estaditicas_vendedor";
        $this->getObservacionesUsuario   = "app_llamadas";
        $this->tableNotificaciones       = "app_noti";
        $this->tableSubcategorias       = "app_subproductos";
        $this->tableBanners             = "app_banners";
    }
    public function getVariablesGlobales()
    {
        $this->db->select("*");
        $this->db->from($this->tableVariablesGlobales);
        $this->db->order_by("variable","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getBannersHome()
    {
        $this->db->select("*");
        $this->db->from($this->tableBanners." b");
        $this->db->join($this->tablePresentaciones." p",'p.idPresentacion=b.idPresentacion','LEFT');
        $this->db->join($this->tableSubcategorias." s",'s.idSubcategoria=p.idSubcategoria','LEFT');
        $this->db->order_by("b.orden","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getPresentacionesProducto($where=array(),$campo='')
    {
        $this->db->select("*,".$campo);
        if(count($where) > 0)
        {
            $this->db->where($where);
        }
        $this->db->from($this->tablePresentaciones." pre");
        $this->db->join($this->tableProductos." pro","pre.idProducto = pro.idProducto","INNER");
        $this->db->order_by("nombrePresentacion","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getConsecutivosInv($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableInventario);
        $this->db->order_by("consecutivo","DESC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getEstadisticas($where)
    {
        $this->db->select("SUM(gananciaTotal) as ganancia,SUM(cantidad) as cantidad");
        $this->db->where($where);
        $this->db->from($this->tableEstadisticas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getNotificacionesPersona($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableNotificaciones);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getPresentacionesProductoVendedor($where=array(),$campo='')
    {
        $this->db->select("*,".$campo);
        if(count($where) > 0)
        {
            $this->db->where($where);
        }
        $this->db->where_in("pre.idProducto",array(1,3));
        $this->db->where_in("pre.app",array('clientes','Ocultos'));
        $this->db->from($this->tablePresentaciones." pre");
        $this->db->join($this->tableProductos." pro","pre.idProducto = pro.idProducto","INNER");
        $this->db->order_by("nombrePresentacion","ASC");
        $id = $this->db->get();

        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getProductosVendedor($where=array())
    {
        $this->db->select("*");
        $this->db->from($this->tableProductos);
        $this->db->order_by("orden","ASC");
        if(count($where) > 0)
        {
            $this->db->where($where);
        }

        $this->db->where_in("idProducto",array(1,3));
        
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getProductos($where)
    {
        $this->db->select("*");
        $this->db->from($this->tableProductos);
        $this->db->order_by("orden","ASC");
        if(count($where) > 0)
        {
            $this->db->where($where);
        }

        $this->db->where_not_in("idProducto",array(3));
        
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getSubcategorias($where)
    {
        $this->db->select("*");
        $this->db->from($this->tableSubcategorias);
        $this->db->order_by("nombreSubcategoria","ASC");
        if(count($where) > 0)
        {
            $this->db->where($where);
        }

        //$this->db->where_not_in("idProducto",array(3));
        
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getVendedoraConjunto($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRelConjuntoVendedora." r");
        $this->db->join($this->tablePersonas." p"," p.idPersona = r.idPersona");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getDepartamentos($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableDeptos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getObservacionesUsuario($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->getObservacionesUsuario);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaConjuntos($where=array())
    {
        $this->db->select("*");
        if(count($where)  > 0)
        {
            $this->db->where($where);
        }
        $this->db->from($this->tableConjuntos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    } 
    public function consultatiendas($where=array())
    {
        $this->db->select("*");
        if(count($where)  > 0)
        {
            $this->db->where($where);
        }
        $this->db->from($this->tableTiendas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getCiudades($where,$group=false)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableCiudad);
        $this->db->order_by("NOMBRE","ASC");
        if($group)
        {
            $this->db->group_by("ID_DPTO");
        }
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaCieDiez($where,$like)
    {
        $this->db->select("*");
        $this->db->where($where);
        //$this->db->or_where($where);
        $this->db->from($this->tableCiediez);
        $this->db->like('descripcion', $like);
        $this->db->order_by("descripcion","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function consultaEPS($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEps);
        $this->db->order_by("des_eps","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function especialistasServicio($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas." p");
        $this->db->join($this->tableRelCargoServ." rs"," rs.idCargo = p.idCargo");
        $this->db->order_by("p.nombre","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getDiagnosticos($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRelCieDiez." c");
        $this->db->join($this->tableCiediez." d"," d.codigo=c.id_cie_diez","INNER");
        $this->db->order_by("d.descripcion","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaAFP($where)
    { 
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableAfp);
        $this->db->order_by("des_afp","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaCesantias($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableCesantias);
        $this->db->order_by("nombrefondocesantias","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaAseguradoras($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableAseguradoras);
        $this->db->order_by("des_asegurador","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaOcupaciones($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableOcupaciones);
        $this->db->order_by("descripcion","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaEstadoCivil($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEstadoCivil);
        $this->db->order_by("des_estado_civil","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaGrupoEtnico($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableGrupoEtnico);
        //$this->db->order_by("grupo_etnia","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaEscolaridad($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEscolaridad);
        $this->db->order_by("niveleducativo","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function consultaReligiones($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableReligiones);
        $this->db->order_by("des_religiones","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }

    public function getInfoPago($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableInfoPago);
        $this->db->order_by("idPago","DESC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getInfoEmpresa($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableEmpresas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getInfoPersonas($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getInfoPersonasCruce($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePersonas." p");
        $this->db->join($this->tableCargos." c","c.idCargo=p.idCargo","INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getPersonasClientes($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->where_not_in('idPersona',array(91,92,93,113,1,29));
        $this->db->from($this->tablePersonas." p");
        $this->db->join($this->tableConjuntos." c","c.idConjunto=p.idConjunto","INNER");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaPerfiles($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePerfiles);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getServicios($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableServicios);
        $this->db->order_by("des_servicios","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultatiposDoc($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableTiposDoc);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaSexo($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableSexo);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getCiudadesVentas()
    {
        $this->db->select("*");
        $this->db->from($this->tableCiudadesVentas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaCargos($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableCargos);
        $this->db->order_by("nombreCargo","ASC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaAreas($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableAreas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaProfesiones($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableProfesiones);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function consultaSolicitudes($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tablePedidos." p");
        $this->db->join($this->tablePersonas." per","per.idPersona=p.idPersona","INNER");
        //$this->db->join($this->tableProductos." pro","pro.idProducto=p.idProducto","INNER");
        $this->db->join($this->tableEstadosPedido." es","es.idEstadoPedido=p.estadoPedido","INNER");
        $this->db->order_by("p.idPedido","DESC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function envioMailDB($dataInserta)
    {
        $this->db->insert($this->tableMails,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function insertaSolicitud($dataInserta)
    {
        $this->db->insert($this->tablePedidos,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function insertaNotificacion($dataInserta)
    {
        $this->db->insert($this->tableNotificaciones,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function insertaPedido($dataInserta)
    {
        $this->db->insert($this->tablePedidos,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function actualizaPedido($dataInserta,$where)
    {
        $this->db->where($where);
        $this->db->update($this->tablePedidos,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function updateNotificacionesPersona($dataInserta,$where)
    {
        $this->db->where($where);
        $this->db->update($this->tableNotificaciones,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function cambioContrasena($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableLogin,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function insertaDetalleProducto($dataInserta)
    {
        $this->db->insert($this->tableDetPedidos,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function auditoria($dataInserta)
    {
        $this->db->insert($this->tableAuditoria,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();

    }
    public function infoModulo($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableModulos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getDistCatModuloModulos($where)
    {
        $this->db->select("distinct(m.idPadre)");
        $this->db->where($where);
        $this->db->from($this->tableModulos." m");
        $this->db->join($this->tableRelModulosPerfil." r","r.idModulo=m.idModulo","INNER"); 
        $this->db->order_by("m.idPadre","ASC");
        $id = $this->db->get();
       //print_r($this->db->last_query());die();
        return $id->result_array();
    }

    public function getModulosIn($where_in)
    {
        $this->db->select("*");
        $this->db->where_in("idModulo",$where_in);
        $this->db->where(array("estado"=>1));
        $this->db->from($this->tableModulos);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();   
    }

    public function getModulos($where)
    {
        $this->db->select("m.idModulo,m.idPadre,m.nombreModulo,m.urlModulo,m.icono,m.eliminado,m.estado");
        $this->db->where($where);
        $this->db->from($this->tableModulos." m");
        $this->db->join($this->tableRelModulosPerfil." r","r.idModulo=m.idModulo","INNER");
        $this->db->group_by("m.idModulo","ASC");
        $this->db->order_by("m.idModulo","ASC");
        $id = $this->db->get();
        //echo $this->db->last_query()."<hr>";
        return $id->result_array();
    }
    public function consultaRelacionPerfil($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableRelModulosPerfil);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
    public function getEstadosPedido($where=array())
    {
        $this->db->select("*");
        if(count($where) > 0)
        {
            $this->db->where($where);
        }
        $this->db->from($this->tableEstadosPedido);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();

    }
}

?>