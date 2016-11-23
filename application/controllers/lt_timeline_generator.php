<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Lt_timeline_generator - Controller
 * -------------------------------------------------------------------
 * Controller de geracao da Timeline.
 * -------------------------------------------------------------------
 * DESCRICAO : Controller responsavel pela leitura do arquivo XML, ja 
 * carregado atraves do controller LT_UPLOADER. Tambem faz a chamada 
 * dos metodos de consulta dos NODE's e atributos, para coloca-los 
 * em sessao. Ao final, faz o carregamento da pagina da Timeline.
 * -------------------------------------------------------------------
 * CARREGA : 
 * - lt_header
 * - lt_menu
 * - lt_index | lt_timeline
 * - lt_footer
 */
class Lt_timeline_generator extends CI_Controller {

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
	 * DESCRICAO : Faz a leitura do arquivo XML 
	 * ja carregado anteriomente. Apos ler o 
	 * arquivo, realiza as consultas atraves da 
	 * biblioteca MY_LT_LIB. Apos consultas car-
	 * rega os dados na sessao.
	 * ---------------------------------------
	 * PARAMETROS : N/A
	 * ---------------------------------------
	 * RETORNO : N/A | NULL - Caso nao haja nenhum 
	 * erro para conter a interpretacao do metodo.
	*/
	public function index(){
		$temp_file_uploaded = $this->session->userdata('temp_file_uploaded');

		if ($temp_file_uploaded ) {
			$upload_dir = $this->my_lt_lib->get_lattes_path();
			$file_uploaded_name = $this->session->userdata('file_uploaded_name');

			if ( file_exists($upload_dir . $file_uploaded_name) && !empty($file_uploaded_name) ) {
				$data = array();
				$years = array();
				$curriculum = array();
				
				// PREPARA A LEITURA DO ARQUIVO
				$file_url = base_url() . 'uploads/' . $file_uploaded_name;
				$xml_UTF8 = utf8_encode( file_get_contents($file_url));
				//$xml_UTF8 = str_replace('-', '_', $xml_UTF8);
				//$xml_UTF8 = str_replace('ISO_8859_1', 'ISO-8859-1', $xml_UTF8);

				$xml_file = simplexml_load_string($xml_UTF8);
				/* ********** NOME COMPLETO ********** */
				$node_name = $xml_file->xpath(QA_NOME_COMPLETO);
				if (isset($node_name)) {
					$name = strval($xml_file->xpath(QA_NOME_COMPLETO)[0][LABEL_NOME_COMPLETO]);
					if (isset($name)) {
						$curriculum['name'] = $name;
					}
				}
				/* ********** PROJETOS DE PESQUISA ********** */
				$projects_by_year = $this->my_lt_lib->load_research_projects($xml_file, $years);
				$curriculum['projects'] = $projects_by_year;
				/* ********** BANCA DE MESTRADO ********** */
				$master_boards_by_year = $this->my_lt_lib->load_master_boards($xml_file, $years);
				$curriculum['master_boards'] = $master_boards_by_year;
				/* ********** BANCA DE ESPECIALIZACAO ********** */
				$expertise_boards_by_year = $this->my_lt_lib->load_expetise_boards($xml_file, $years);
				$curriculum['expertise_boards'] = $expertise_boards_by_year;
				/* ********** BANCA DE QUALIFICACAO ********** */
				$qualification_boards_by_year = $this->my_lt_lib->load_qualification_boards($xml_file, $years);
				$curriculum['qualification_boards'] = $qualification_boards_by_year;
				/* ********** BANCA DE GRADUACAO ********** */
				$graduation_boards_by_year = $this->my_lt_lib->load_graduation_boards($xml_file, $years);
				$curriculum['graduation_boards'] = $graduation_boards_by_year;
				/* ********** ORIENTACOES CONCLUIDAS DE MESTRADO ********** */
				$done_master_orientations_by_year = $this->my_lt_lib->load_done_master_orientations($xml_file, $years);
				$curriculum['done_master_orientations'] = $done_master_orientations_by_year;
				/* ********** OUTRAS ORIENTACOES CONCLUIDAS ********** */
				$done_other_orientations_by_year = $this->my_lt_lib->load_done_other_orientations($xml_file, $years);
				$curriculum['done_other_orientations'] = $done_other_orientations_by_year;
				/* ********** ORIENTACOES EM ANDAMENTO MESTRADO ********** */
				$going_master_orientations_by_year = $this->my_lt_lib->load_going_master_orientations($xml_file, $years);
				$curriculum['going_mater_orientations'] = $going_master_orientations_by_year;
				/* ********** ORIENTACOES EM ANDAMENTO DE INICIACAO CIENTIFICA ********** */
				$going_scientific_orientations_by_year = $this->my_lt_lib->load_going_scientific_orientations($xml_file, $years);
				$curriculum['going_scientific_orientations'] = $going_scientific_orientations_by_year;
				/* ********** PRODUCOES BIBLIOGRAFICAS DE LIVROS ********** */
				$production_books_by_year = $this->my_lt_lib->load_production_books($xml_file, $years);
				$curriculum['produtcion_books'] = $production_books_by_year;
				/* ********** PRODUCOES BIBLIOGRAFICAS DE CAPITULOS ********** */
				$production_book_chapters_by_year = $this->my_lt_lib->load_production_book_chapters($xml_file, $years);
				$curriculum['production_book_chapters'] = $production_book_chapters_by_year;
				/* ********** OUTRAS PRODUCOES BIBLIOGRAFICAS ********** */
				$other_productions_by_year = $this->my_lt_lib->load_others_productions($xml_file, $years);
				$curriculum['other_productions'] = $other_productions_by_year;
				/* ********** PRODUCOES BIBLIOGRAFICAS DE TRABALHOS EM EVENTOS ********** */
				$in_event_productions_by_year = $this->my_lt_lib->load_produtions_in_events($xml_file, $years);
				$curriculum['in_event_productions'] = $in_event_productions_by_year;
				/* ********** PRODUCOES TECNICAS - TRABALHOS TECNICOS ********** */
				$technical_productions_by_year = $this->my_lt_lib->load_technical_productions($xml_file, $years);
				$curriculum['technical_productions'] = $technical_productions_by_year;

				arsort($years);

				$curriculum['years'] = $years;
				$data['curriculum'] = $curriculum;

				$this->load->view('template/lt_header');
				$this->load->view('template/lt_menu');
				$this->load->view('lt_timeline', $data);
				$this->load->view('template/lt_footer');
				return;
			}
		}
		$this->load_index(TRUE);
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
