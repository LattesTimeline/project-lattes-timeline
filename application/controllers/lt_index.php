<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Lt_index - Controller
 * -------------------------------------------------------------------
 * Controller de inicio.
 * -------------------------------------------------------------------
 * DESCRICAO : Controller responsavel apenas pela construcao inicial  
 * da aplicacao. Constroi a pagina basica.
 * -------------------------------------------------------------------
 * CARREGA : 
 * - lt_header
 * - lt_menu
 * - lt_index
 * - lt_footer
 */
class Lt_index extends CI_Controller {

	/*
	 * CONSTRUCT
	 * ---------------------------------------
	 * DESCRICAO : Construtor que faz o carregamento 
	 * do arquivo de LABEL's da aplicacao, atraves 
	 * do metodo definido na biblioteca principal da 
	 * aplicacao.
	 * ---------------------------------------
	 * PARAMETROS : N/A
	 * ---------------------------------------
	 * RETORNO : N/A
	*/
	function __construct(){
        parent::__construct();

        $this->my_lt_lib->load_msg();

        date_default_timezone_set('America/Fortaleza');
    }

    /*
	 * INDEX
	 * ---------------------------------------
	 * DESCRICAO : Constroi a pagina inicial. 
	 * Foi necessario a retirada dos dois parametros 
	 * de sessao que sao utilizados para verificacao 
	 * do carregamento do arquivo XML.
	 * ---------------------------------------
	 * PARAMETROS : N/A
	 * ---------------------------------------
	 * RETORNO : N/A
	*/
	public function index(){
		$this->session->unset_userdata('missing_file');
		$this->session->unset_userdata('file_name');

		$this->load->view('template/lt_header');
		$this->load->view('template/lt_menu');
		$this->load->view('lt_index');
		$this->load->view('template/lt_footer');
	}
	
}
