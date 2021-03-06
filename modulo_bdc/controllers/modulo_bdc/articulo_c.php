<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articulo_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modulo_bdc/articulo_m');
    }

	public function index(){       
       $datos['categorias']     = $this->articulo_m->listar_categorias();
       $datos['subcategorias']  = $this->articulo_m->listar_subcategorias();

       $this->load->view('modulo_bdc/articulo_v', $datos);
	}

	public function insertar_articulo(){
		//inicializacion de variables o parametros por omision ... jv
		$id     ='';
        $salida ='';
    	$datos  = array(
					'codigo_categoria'      => $this->input->post( 'subcategoria' ) ,
                    'titulo'                => $this->input->post( 'titulo' ) ,
		    		'codigo_articulo'       => mt_rand(0, 99999) , 
		    		'descripcion_pregunta'  => $this->input->post( 'pregunta' ) ,
                    'descripcion_respuesta' => $this->input->post( 'respuesta' ) ,
                    'palabras_claves'       => $this->input->post( 'palabras_claves' ) ,
                    /**
                    MAS ADELANTE
                    'nivel_privacidad'      => $this->input->post( 'privacidad' ) ,
                    **/
	    		);  
        /**
        revisar mas adelante     $datos['categorias']     = $this->articulo_m->listar_categorias();
       $datos['subcategorias']  = $this->articulo_m->listar_subcategorias();
               
        $validacion = $this->validar_articulo( $id, $datos );
    	if ( $validacion['valido'] == 0 ){
    	
    		$salida = $this->articulo_m->insertar_articulo( $id, $datos );	

    	}else{
    	
    		//echo $validacion['mensaje'];
    	
    	}
        **/
    	$salida = $this->articulo_m->insertar_articulo( $id, $datos ); 
    	if ( $salida == 0 ) $this->index();
    }
/**
    function validar_articulo($id, $parame     $datos['categorias']     = $this->articulo_m->listar_categorias();
       $datos['subcategorias']  = $this->articulo_m->listar_subcategorias();     $datos['categorias']     = $this->articulo_m->listar_categorias();
       $datos['subcategorias']  = $this->articulo_m->listar_subcategorias();tros = array() ){
    	$errores = '';
    	$valido = false;//validacion falsa por omision

    	$salida = array( //salida por omision ( caso ideal )
    			'valido'  => 0,
    			'mensaje' => '',
    		);

    	extract($parametros); // se convierten los parametros en variables del entorno independiente

    	if ( trim( $titulo ) == '' ) {
    		$errores .= 'falta titulo <br>';
    	}
    	if ( trim( $descripcion_pregunta ) == '' ) {
    		$errores .= 'el texo de la pregunta es requrido <br>';
    	}

    	if ( trim ( $errores ) == '') $valido = true;

    	if ( !$valido ) {
    		$salida = array (
    				'valido'  => -1,
    				'mensaje' => "Se encontraron errores en los datos: <br> $errores <br> verifique e intente de nuevo.",
    			);
    	}

    	return $salida;	
    }
**/    

    function listar_respuestas(){
        $id     = '';
        $datos  = array(
                    'descripcion_respuesta' => $this->input->post( 'busqueda' ) ,
                    'descripcion_pregunta'  => $this->input->post( 'busqueda' ) ,
                    'palabras_claves'       => $this->input->post( 'busqueda' ) , 
                    'titulo'                => $this->input->post( 'busqueda' ) ,
                );  

        $salida['categorias']     = $this->articulo_m->listar_categorias();
        $salida['subcategorias']  = $this->articulo_m->listar_subcategorias();
        $salida['articulo']      = $this->articulo_m->listar_respuestas( $id, $datos ); 
        $this->load->view('modulo_bdc/respuesta_v', $salida);       
    } 

    function mostrar_articulo($id){
        //echo $id;die();
        $salida['articulo'] = $this->articulo_m->mostrar_articulo($id);
        //echo '<pre>',print_r($salida),'</pre>';die;
        $this->load->view('modulo_bdc/mostrar_respuesta_v', $salida);

    }

    function consultar_articulos(){
        $datos['categorias'] = $this->articulo_m->listar_categorias();
        $this->load->view('modulo_bdc/respuesta_v', $datos);
    }

}