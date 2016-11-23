<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Lt_uploader - Controller
 * -------------------------------------------------------------------
 * Controller de carregamento do arquivo XML.
 * -------------------------------------------------------------------
 * DESCRICAO : Controller responsavel pelo carregamento do arquivo XML 
 * Faz a movimentacao do arquivo do local temporario para um local 
 * permanente.
 * -------------------------------------------------------------------
 * CARREGA : 
 * - lt_header
 * - lt_menu
 * - lt_index
 * - lt_footer
 */
class Lt_uploader extends CI_Controller {

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
	 * DESCRICAO : Faz o carregamento do ar-
	 * quivo XML passado por parametro do for-
	 * mulario. Antes de mover o arquivo para 
	 * a pasta permanente, faz a remocao do(s) 
	 * arquivo(s) anterior(es). Se nao houver 
	 * erros, redireciona para o controller 
	 * LT_TIMELINE_GENERATOR.
	 * ---------------------------------------
	 * PARAMETROS : N/A
	 * ---------------------------------------
	 * RETORNO : N/A
	*/
	public function index(){
		if ( isset($_FILES['lt-param-xml-file']) ) {
			$temp_file = $_FILES['lt-param-xml-file']['tmp_name'];

			if ( !empty($temp_file) && file_exists($_FILES['lt-param-xml-file']['tmp_name']) ) {
				try {
					$upload_dir = $this->my_lt_lib->get_lattes_path();
					$upload_file = $this->my_lt_lib->generate_lattes_file_name();

					$this->delete_files();
					
					$moved_xml = move_uploaded_file($temp_file, $upload_dir . $upload_file);

					if ($moved_xml && $this->my_lt_lib->is_curriculum($_FILES, $upload_file)) {
						$data_array = array(
							'temp_file_uploaded' => $moved_xml,
							'file_uploaded_name' => $upload_file
						);
		                $this->session->set_userdata($data_array);

						redirect(base_url() . 'timeline-generator');
					} else {
						unlink($upload_dir . $upload_file);
					}
				} catch(Exception $e) {
					log('error', 'ERRO XML - ' . $e->getMessage());
				}
			}
		}
		$this->load_index(TRUE);
	}

	/*
	 * DELETE_FILES
	 * ---------------------------------------
	 * DESCRICAO : Faz a remocao do(s) arqui-
	 * vo(s) XML existentes na pasta permanente.
	 * ---------------------------------------
	 * PARAMETROS : N/A
	 * ---------------------------------------
	 * RETORNO : N/A
	*/
	function delete_files() {
		$files = glob($this->my_lt_lib->get_lattes_path() . '*');

		foreach ($files as $file) {
		  if(is_file($file)) {
		    unlink($file);
		  }
		}
	}

	/*
	 * LOAD_INDEX
	 * ---------------------------------------
	 * DESCRICAO : Utilizado para construcao da 
	 * pagina inicial. Chamado apenas quando 
	 * ocorre um erro na manipulacao do XML.
	 * Passa uma mensagem de erro como parametro 
	 * de sessao.
	 * ---------------------------------------
	 * PARAMETROS : N/A
	 * ---------------------------------------
	 * RETORNO : N/A
	*/
	function load_index($with_error = FALSE){
		if ( $with_error ) {
			$this->session->set_flashdata('missing_file', lang('lt_error_message_file_missing'));
		}
		$this->load->view('template/lt_header');
		$this->load->view('template/lt_menu');
		$this->load->view('lt_index');
		$this->load->view('template/lt_footer');
	}

}
