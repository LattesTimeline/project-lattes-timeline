<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_LT_LIB - Library
 * -------------------------------------------------------------------
 * Biblioteca com as principais funcionalidades da aplicacao.
 * -------------------------------------------------------------------
 * DESCRICAO : Biblioteca contendo as funcionalidades de internaciona-
 * lizacao, consulta do arquivo XML, processamento das informacoes 
 * buscadas no arquivo XML, entre outras funcionalidades de uso fun-
 * damental para a aplicacao.
 * -------------------------------------------------------------------
 * CARREGA : 
 * - N/A
 */
class MY_LT_LIB {
    /* 
        ****************************************************************************
                            FUNCOES DA TRADUCAO
        ****************************************************************************
    */
    /*
     * LOAD_MSG
     * ---------------------------------------
     * DESCRICAO : Carrega os arquivos de 
     * palavras e mensagens de toda a inter-
     * face da aplicacao. O carregamento eh 
     * feito atraves de metodos padroes do 
     * proprio C.I..
     * ---------------------------------------
     * PARAMETROS : N/A
     * ---------------------------------------
     * RETORNO : N/A
    */
    public function load_msg() {
        $CI =& get_instance();

        $CI->lang->load('admin', 'pt-br');
        $CI->lang->load('msg', 'pt-br');
        $CI->lang->load('form_validation', 'pt-br');
    }

    /*
     * GET_LATTES_PATH
     * ---------------------------------------
     * DESCRICAO : Metodo que concatena e re-
     * torna a pasta permanente dos arquivos 
     * XML. Caso a pasta nao exista, chama o 
     * metodo de criacao de pasta.
     * ---------------------------------------
     * PARAMETROS : N/A
     * ---------------------------------------
     * RETORNO : Caminho da Pasta Permanente [STRING]
    */
    public function get_lattes_path() {
        $lattes_dir = '';
        $parts_dir = explode('\\', __DIR__);
        for ($index_parts = 0; $index_parts < count($parts_dir) - 2; $index_parts++) {
            $lattes_dir .= $parts_dir[$index_parts] . DIRECTORY_SEPARATOR;
        }
        $lattes_dir .= 'uploads' . DIRECTORY_SEPARATOR;

        $this->create_if_not_lattes_path($lattes_dir);

        return $lattes_dir;
    }

    /*
     * CREATE_IF_NOT_LATTES_PATH
     * ---------------------------------------
     * DESCRICAO : Faz o teste de existencia de 
     * um diretorio ou arquivo. Caso nao exista 
     * cria a pasta/arquivo com a permissao que 
     * esta configurada na constante 
     * LATTES_DIR_CHMOD.
     * ---------------------------------------
     * PARAMETROS : LATTES_DIR - Diretorio [STRING]
     * ---------------------------------------
     * RETORNO : N/A
    */
    public function create_if_not_lattes_path($lattes_dir) {
        if (!file_exists($lattes_dir)) {
            mkdir($lattes_dir, LATTES_DIR_CHMOD);
        } else {
            chmod($lattes_dir, LATTES_DIR_CHMOD);
        }
    }


    /*
     * GENERATE_LATTES_FILE_NAME
     * ---------------------------------------
     * DESCRICAO : Retorna um nome de um 
     * curriculo com a data e hora atuais.
     * ---------------------------------------
     * PARAMETROS : N/A
     * ---------------------------------------
     * RETORNO : Nome para arquivo XML [STRING]
    */
    public function generate_lattes_file_name() {
        return 'curriculo_' . date('Y-m-d_H-i-s') . '.xml';
    }

    /*
     * IS_CURRICULUM
     * ---------------------------------------
     * DESCRICAO : Faz a verificacao se o 
     * arquivo passado por parametro eh um cur-
     * riculo Lattes Valido.
     * ---------------------------------------
     * PARAMETROS : $FILES - Array de Upload do PHP
                    $UPLOADED_FILE - Nome do arquivo XML
     * ---------------------------------------
     * RETORNO : Validade do arquivo XML [BOOLEAN]
    */
    public function is_curriculum($FILES, $upload_file){
        if ($FILES['lt-param-xml-file']['type'] == "text/xml") {
            $file_url = base_url() . 'uploads/' . $upload_file;

            $xml_UTF8 = utf8_encode( file_get_contents($file_url));
            //$xml_UTF8 = str_replace('-', '_', $xml_UTF8);
            //$xml_UTF8 = str_replace("ISO_8859_1", "ISO-8859-1", $xml_UTF8);
            $xml_file = simplexml_load_string($xml_UTF8);

            if($xml_file->xpath(QA_ANO_DE_INICIO_GRADUACAO)) {
                return TRUE;
            }
        }
        return FALSE;

    }

    /*
     * TO_DEBUG
     * ---------------------------------------
     * DESCRICAO : Metodo para debugar varia-
     * veis passadas por parametro.
     * ---------------------------------------
     * PARAMETROS : $VARIABLE - Variavel a ser debugada
     * ---------------------------------------
     * RETORNO : N/A
    */
    public function to_debug($variable = NULL){
        if (isset($variable)) {
            echo '<pre>';
            var_dump($variable);
            die();
        }
    }


    /* 
        ****************************************************************************
                            FUNCOES DE CARREGAMENTO DO XML
        ****************************************************************************
    */
    /*
     * LOAD_REASEARCH_PROJECTS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta dos projetos 
     * no arquivo XML passado por parametro. 
     * Computa os anos encontrados nos projetos 
     * dentro do array de referencia. Ao final, 
     * organiza o array em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de projetos (objetos em arrays organizados) [ARRAY]
    */
    function load_research_projects($xml_file, &$years) {
        $projects = array();
        try {
            foreach ($xml_file->xpath(Q_PARTICIPACAO_EM_PROJETO) as $project) {
                $arrayYearStart = $project->xpath(QA_ANO_DE_INICIO_PROJETO);
                $arrayYearEnd = $project->xpath(QA_ANO_DE_FIM_PROJETO);
                $arraySituation = $project->xpath(QA_PROJETO_SITUACAO);
                if ($arrayYearStart && $arrayYearEnd && $arraySituation) {
                    $year_start = intval(strval($project[LABEL_ANO_INICIO]));
                    $year_end = intval($project[LABEL_ANO_FIM]);
                    $situation = strval($project->xpath(QA_PROJETO_SITUACAO)[0][LABEL_SITUACAO]);
                    // SE NAO HOUVER ANO DE FIM, COLOCA O ANO MAXIMO
                    if (!$year_end && $situation == VALUE_SITUACAO_PROJETO_ANDAMENTO) {
                        $year_end = date('Y');
                    }
                    // ADICIONA AS KEYS DOS ANOS
                    for ($index_year = $year_start; $index_year <= $year_end; $index_year++) {
                        if (!array_key_exists($index_year, $projects)) {
                            $projects[$index_year] = array();
                        }
                        if (!in_array($index_year, $years)) {
                            array_push($years, $index_year);
                        }
                        array_push($projects[$index_year], $this->process_project($project));
                    }
                }
            }
            // ORGANIZA OS PROJETOS DE DOS ARRAYS DE PROJETO
            /*foreach ($projects as &$project) {
                krsort($project);
            }*/
            krsort($projects);
            /*DEBUG*/
            //$this->my_lt_lib->to_debug($projects);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $projects;
    }

    /*
     * LOAD_MASTER_BOARDS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das bancas 
     * de mestrado no arquivo XML passado por 
     * parametro. Computa os anos encontrados 
     * nas bancas dentro do array de referencia. 
     * Ao final, organiza o array em ordem 
     * decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de bancas de mestrado (objetos em arrays organizados) [ARRAY]
    */
    function load_master_boards($xml_file, &$years) {
        $boards = array();
        try {
            foreach ($xml_file->xpath(Q_PARTICIPACAO_EM_BANCA_DE_MESTRADO) as $board) {
                $arrayYear = $board->xpath(QA_ANO_MESTRADO);
                if ($arrayYear) {
                    $year = intval($board->xpath(QA_ANO_MESTRADO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $boards)) {
                        $boards[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($boards[$year], $this->process_master_board($board));
                }
            }
            krsort($boards);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $boards;
    }

    /*
     * LOAD_EXPERTISE_BOARDS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das bancas 
     * de especializacao no arquivo XML passado por 
     * parametro. Computa os anos encontrados 
     * nas bancas dentro do array de referencia. 
     * Ao final, organiza o array em ordem 
     * decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de bancas de especializacao (objetos em arrays organizados) [ARRAY]
    */
    function load_expetise_boards($xml_file, &$years) {
        $boards = array();
        try {
            foreach ($xml_file->xpath(Q_PARTICIPACAO_EM_BANCA_DE_ESPECIALIZACAO) as $board) {
                $arrayYear = $board->xpath(QA_ANO_ESPECIALIZACAO);
                if ($arrayYear) {
                    $year = intval($board->xpath(QA_ANO_ESPECIALIZACAO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $boards)) {
                        $boards[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($boards[$year], $this->process_expertise_board($board));
                }
            }
            krsort($boards);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $boards;
    }

    /*
     * LOAD_QUALIFICATION_BOARDS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das bancas 
     * de qualificacao no arquivo XML passado por 
     * parametro. Computa os anos encontrados 
     * nas bancas dentro do array de referencia. 
     * Ao final, organiza o array em ordem 
     * decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de bancas de qualificacao (objetos em arrays organizados) [ARRAY]
    */
    function load_qualification_boards($xml_file, &$years) {
        $boards = array();
        try {
            foreach ($xml_file->xpath(Q_PARTICIPACAO_EM_BANCA_DE_QUALIFICACAO) as $board) {
                $arrayYear = $board->xpath(QA_ANO_QUALIFICACAO);
                if ($arrayYear) {
                    $year = intval($board->xpath(QA_ANO_QUALIFICACAO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $boards)) {
                        $boards[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($boards[$year], $this->process_qualification_board($board));
                }
            }
            krsort($boards);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $boards;
    }

    /*
     * LOAD_GRADUATION_BOARDS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das bancas 
     * de graduacao no arquivo XML passado por 
     * parametro. Computa os anos encontrados 
     * nas bancas dentro do array de referencia. 
     * Ao final, organiza o array em ordem 
     * decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de bancas de graduacao (objetos em arrays organizados) [ARRAY]
    */
    function load_graduation_boards($xml_file, &$years) {
        $boards = array();
        try {
            foreach ($xml_file->xpath(Q_PARTICIPACAO_EM_BANCA_DE_GRADUACAO) as $board) {
                $arrayYear = $board->xpath(QA_ANO_GRADUACAO);
                if ($arrayYear) {
                    $year = intval($board->xpath(QA_ANO_GRADUACAO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $boards)) {
                        $boards[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($boards[$year], $this->process_graduation_board($board));
                }
            }
            krsort($boards);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $boards;
    }

    /*
     * LOAD_DONE_MASTER_ORIENTATIONS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das orientacoes 
     * de mestrado concluidas, no arquivo XML 
     * passado por parametro. Computa os anos 
     * encontrados nas orientacoes dentro do array 
     * de referencia. Ao final, organiza o array 
     * em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de orientacoes concluidas de mestrado (objetos em arrays organizados) [ARRAY]
    */
    function load_done_master_orientations($xml_file, &$years) {
        $orientations = array();
        try {
            foreach ($xml_file->xpath(Q_ORIENTACOES_CONCLUIDAS_MESTRADO) as $orientation) {
                $arrayYear = $orientation->xpath(QA_ANO_ORIENTACOES_CONCLUIDAS_MESTRADO);
                if ($arrayYear) {
                    $year = intval($orientation->xpath(QA_ANO_ORIENTACOES_CONCLUIDAS_MESTRADO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $orientations)) {
                        $orientations[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($orientations[$year], $this->process_done_master_orientation($orientation));
                }
            }
            krsort($orientations);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $orientations;
    }

    /*
     * LOAD_DONE_OTHER_ORIENTATIONS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das outras 
     * orientacoes concluidas, no arquivo XML 
     * passado por parametro. Computa os anos 
     * encontrados nas orientacoes dentro do array 
     * de referencia. Ao final, organiza o array 
     * em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de outras orientacoes concluidas (objetos em arrays organizados) [ARRAY]
    */
    function load_done_other_orientations($xml_file, &$years) {
        $orientations = array();
        try {
            foreach ($xml_file->xpath(Q_ORIENTACOES_CONCLUIDAS_OUTRAS) as $orientation) {
                $arrayYear = $orientation->xpath(QA_ANO_ORIENTACOES_CONCLUIDAS_OUTRAS);
                if ($arrayYear) {
                    $year = intval($orientation->xpath(QA_ANO_ORIENTACOES_CONCLUIDAS_OUTRAS)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $orientations)) {
                        $orientations[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($orientations[$year], $this->process_done_other_orientation($orientation));
                }
            }
            krsort($orientations);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $orientations;
    }

    /*
     * LOAD_GOING_MASTER_ORIENTATIONS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das orientacoes 
     * de mestrado em andamento, no arquivo XML 
     * passado por parametro. Computa os anos 
     * encontrados nas orientacoes dentro do array 
     * de referencia. Ao final, organiza o array 
     * em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de orientacoes de mestrado em andamento (objetos em arrays organizados) [ARRAY]
    */
    function load_going_master_orientations($xml_file, &$years) {
        $orientations = array();
        try {
            foreach ($xml_file->xpath(Q_ORIENTACOES_ANDAMENTO_MESTRADO) as $orientation) {
                $arrayYear = $orientation->xpath(QA_ANO_ORIENTACOES_EM_ANDAMENTO_MESTRADO);
                if ($arrayYear) {
                    $year = intval($orientation->xpath(QA_ANO_ORIENTACOES_EM_ANDAMENTO_MESTRADO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $orientations)) {
                        $orientations[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($orientations[$year], $this->process_going_master_orientation($orientation));
                }
            }
            krsort($orientations);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $orientations;
    }

    /*
     * LOAD_GOING_SCIENTIFIC_ORIENTATIONS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das orientacoes 
     * de iniciacao cientifica em andamento, no 
     * arquivo XML passado por parametro. Computa 
     * os anos encontrados nas orientacoes dentro 
     * do array de referencia. Ao final, organiza 
     * o array em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de orientacoes de iniciacao cientifica em andamento (objetos em arrays organizados) [ARRAY]
    */
    function load_going_scientific_orientations($xml_file, &$years) {
        $orientations = array();
        try {
            foreach ($xml_file->xpath(Q_ORIENTACOES_ANDAMENTO_INICIACAO) as $orientation) {
                $arrayYear = $orientation->xpath(QA_ANO_ORIENTACOES_EM_ANDAMENTO_INICIACAO);
                if ($arrayYear) {
                    $year = intval($orientation->xpath(QA_ANO_ORIENTACOES_EM_ANDAMENTO_INICIACAO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $orientations)) {
                        $orientations[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($orientations[$year], $this->process_going_scientific_orientation($orientation));
                }
            }
            krsort($orientations);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $orientations;
    }
    
    /*
     * LOAD_PRODUCTION_BOOKS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das producoes 
     * bibliograficas de livros, no arquivo XML 
     * passado por parametro. Computa os anos 
     * encontrados nas producoes dentro do
     * array de referencia. Ao final, organiza 
     * o array em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de producoes bibliograficas de livros (objetos em arrays organizados) [ARRAY]
    */
    function load_production_books($xml_file, &$years) {
        $productions = array();
        try {
            foreach ($xml_file->xpath(Q_PRODUCAO_BIBLIOGRAFICA_LIVROS) as $production) {
                $arrayYear = $production->xpath(QA_ANO_PRODUCOES_LIVRO);
                if ($arrayYear) {
                    $year = intval($production->xpath(QA_ANO_PRODUCOES_LIVRO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $productions)) {
                        $productions[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($productions[$year], $this->process_production_book($production));
                }
            }
            krsort($productions);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $productions;
    }

    /*
     * LOAD_PRODUCTION_BOOK_CHAPTERS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das producoes 
     * bibliograficas de capitulos de livros, 
     * no arquivo XML passado por parametro. 
     * Computa os anos encontrados nas producoes 
     * dentro do array de referencia. Ao final, 
     * organiza o array em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de producoes bibliograficas de capitulos de livros (objetos em arrays organizados) [ARRAY]
    */
    function load_production_book_chapters($xml_file, &$years) {
        $productions = array();
        try {
            foreach ($xml_file->xpath(Q_PRODUCAO_BIBLIOGRAFICA_CAPITULOS) as $production) {
                $arrayYear = $production->xpath(QA_ANO_PRODUCOES_CAPITULO);
                if ($arrayYear) {
                    $year = intval($production->xpath(QA_ANO_PRODUCOES_CAPITULO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $productions)) {
                        $productions[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($productions[$year], $this->process_production_book_chapter($production));
                }
            }
            krsort($productions);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $productions;
    }

    /*
     * LOAD_OTHERS_PRODUCTIONS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das outras
     * producoes bibliograficas, no arquivo XML 
     * passado por parametro. Computa os anos 
     * encontrados nas producoes dentro do array 
     * de referencia. Ao final, organiza o array 
     * em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de outras producoes bibliograficas (objetos em arrays organizados) [ARRAY]
    */
    function load_others_productions($xml_file, &$years) {
        $productions = array();
        try {
            foreach ($xml_file->xpath(Q_PRODUCAO_BIBLIOGRAFICA_OUTRAS_PRODUCOES) as $production) {
                $arrayYear = $production->xpath(QA_ANO_PRODUCOES_OUTRAS);
                if ($arrayYear) {
                    $year = intval($production->xpath(QA_ANO_PRODUCOES_OUTRAS)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $productions)) {
                        $productions[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($productions[$year], $this->process_other_production($production));
                }
            }
            krsort($productions);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $productions;
    }

    /*
     * LOAD_PRODUCTIONS_IN_EVENTS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das producoes 
     * publicadas em eventos, no arquivo XML 
     * passado por parametro. Computa os anos 
     * encontrados nas producoes dentro do array 
     * de referencia. Ao final, organiza o array 
     * em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * OBS II : Trabalhos publicados em anais de eventos
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de producoes publicadas em eventos (objetos em arrays organizados) [ARRAY]
    */
    function load_produtions_in_events($xml_file, &$years) {
        $productions = array();
        try {
            foreach ($xml_file->xpath(Q_PRODUCAO_BIBLIOGRAFICA_EVENTOS) as $production) {
                $arrayYear = $production->xpath(QA_ANO_PRODUCOES_EVENTOS);
                if ($arrayYear) {
                    $year = intval($production->xpath(QA_ANO_PRODUCOES_EVENTOS)[0][LABEL_ANO_DO_TRABALHO]);
                    if (!array_key_exists($year, $productions)) {
                        $productions[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($productions[$year], $this->process_production_in_event($production));
                }
            }
            krsort($productions);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $productions;
    }

    /*
     * LOAD_PRODUCTIONS_IN_EVENTS
     * ---------------------------------------
     * DESCRICAO : Faz a consulta das producoes 
     * tecnicas, no arquivo XML 
     * passado por parametro. Computa os anos 
     * encontrados nas producoes dentro do array 
     * de referencia. Ao final, organiza o array 
     * em ordem decrescente. 
     * As consultas sao feitas atraves do metodo 
     * XPATH, da biblioteca XML do PHP. As con-
     * sultas sao realizadas atraves das QUERY's
     * passadas pelas constantes.
     * OBS II : Trabalhos publicados em anais de eventos
     * ---------------------------------------
     * PARAMETROS : $XML_FILE - Arquivo padrao do PHP [SIMPLEXML_FILE]
                    $YEARS - Referencia do array de anos
     * ---------------------------------------
     * RETORNO : Lista de producoes tecnicas (objetos em arrays organizados) [ARRAY]
    */
    function load_technical_productions($xml_file, &$years) {
        $productions = array();
        try {
            foreach ($xml_file->xpath(Q_PRODUCAO_TECNICA_TRABALHO_TECNICO) as $production) {
                $arrayYear = $production->xpath(QA_ANO_PRODUCOES_TECNICAS_TRABALHO);
                if ($arrayYear) {
                    $year = intval($production->xpath(QA_ANO_PRODUCOES_TECNICAS_TRABALHO)[0][LABEL_ANO]);
                    if (!array_key_exists($year, $productions)) {
                        $productions[$year] = array();
                    }
                    if (!in_array($year, $years)) {
                        array_push($years, $year);
                    }
                    array_push($productions[$year], $this->process_technical_production($production));
                }
            }
            krsort($productions);
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $productions;
    }

    /* 
        ****************************************************************************
                            FUNCOES DE PROCESSAMENTO DO XML
        ****************************************************************************
    */
    /*
     * PROCESS_PROJECT
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_project($xml_project) {
        $project = array();
        try {
            $integrantes = array();
            $financiadores = array();

            $project[LABEL_ANO_INICIO] = strval($xml_project[LABEL_ANO_INICIO]);
            $project[LABEL_ANO_FIM] = strval($xml_project[LABEL_ANO_FIM]);
            $project[LABEL_NOME_DO_PROJETO] = utf8_decode(strval($xml_project->xpath(QA_PROJETO_NOME)[0][LABEL_NOME_DO_PROJETO]));
            $project[LABEL_DESCRICAO_PROJETO] = utf8_decode(strval($xml_project->xpath(QA_PROJETO_DESCRICAO)[0][LABEL_DESCRICAO_PROJETO]));
            $project[LABEL_SITUACAO] = strval($xml_project->xpath(QA_PROJETO_SITUACAO)[0][LABEL_SITUACAO]) == VALUE_SITUACAO_PROJETO_ANDAMENTO ? lang('lt_label_going') : lang('lt_label_done');
            $project[LABEL_NATUREZA] = ucfirst(strtolower(strval($xml_project->xpath(QA_PROJETO_NATUREZA)[0][LABEL_NATUREZA])));
            // DOUTORADO
            if (!$xml_project->xpath(QA_PROJETO_NUM_DOUTORADO) || empty(strval($xml_project->xpath(QA_PROJETO_NUM_DOUTORADO)[0][LABEL_NUMERO_DOUTORADO]))) {
                $project[LABEL_NUMERO_DOUTORADO] = '';
            } else {
                $project[LABEL_NUMERO_DOUTORADO] = lang('lt_label_phd');
                $project[LABEL_NUMERO_DOUTORADO] .= '(';
                $project[LABEL_NUMERO_DOUTORADO] .= strval($xml_project->xpath(QA_PROJETO_NUM_DOUTORADO)[0][LABEL_NUMERO_DOUTORADO]);
                $project[LABEL_NUMERO_DOUTORADO] .= ') ';
            }
            // MESTRADO ACADEMICO
            if ($xml_project->xpath(QA_PROJETO_NUM_MESTRADO_ACADEMICO) || empty(strval($xml_project->xpath(QA_PROJETO_NUM_MESTRADO_ACADEMICO)[0][LABEL_NUMERO_MESTRADO_ACADEMICO]))) {
                $project[LABEL_NUMERO_MESTRADO_ACADEMICO] = '';
            } else {
                $project[LABEL_NUMERO_MESTRADO_ACADEMICO] = lang('lt_label_master_academic');
                $project[LABEL_NUMERO_MESTRADO_ACADEMICO] .= '(';
                $project[LABEL_NUMERO_MESTRADO_ACADEMICO] .= strval($xml_project->xpath(QA_PROJETO_NUM_MESTRADO_ACADEMICO)[0][LABEL_NUMERO_MESTRADO_ACADEMICO]);
                $project[LABEL_NUMERO_MESTRADO_ACADEMICO] .= ') ';
            }
            // MESTRADO PROFISSIONAL
            if ($xml_project->xpath(QA_PROJETO_NUM_MESTRADO_PROF) || empty(strval($xml_project->xpath(QA_PROJETO_NUM_MESTRADO_PROF)[0][LABEL_NUMERO_MESTRADO_PROF]))) {
                $project[LABEL_NUMERO_MESTRADO_PROF] = '';
            } else {
                $project[LABEL_NUMERO_MESTRADO_PROF] = lang('lt_label_master_prof');
                $project[LABEL_NUMERO_MESTRADO_PROF] .= '(';
                $project[LABEL_NUMERO_MESTRADO_PROF] .= strval($xml_project->xpath(QA_PROJETO_NUM_MESTRADO_PROF)[0][LABEL_NUMERO_MESTRADO_PROF]);
                $project[LABEL_NUMERO_MESTRADO_PROF] .= ') ';
            }
            // ESPECIALIZACAO
            if ($xml_project->xpath(QA_PROJETO_NUM_ESPECIALIZACAO) || empty(strval($xml_project->xpath(QA_PROJETO_NUM_ESPECIALIZACAO)[0][LABEL_NUMERO_ESPECIALIZACAO]))) {
                $project[LABEL_NUMERO_ESPECIALIZACAO] = '';
            } else {
                $project[LABEL_NUMERO_ESPECIALIZACAO] = lang('lt_label_expertise');
                $project[LABEL_NUMERO_ESPECIALIZACAO] .= '(';
                $project[LABEL_NUMERO_ESPECIALIZACAO] .= strval($xml_project->xpath(QA_PROJETO_NUM_ESPECIALIZACAO)[0][LABEL_NUMERO_ESPECIALIZACAO]);
                $project[LABEL_NUMERO_ESPECIALIZACAO] .= ') ';
            }
            // GRADUACAO
            if ($xml_project->xpath(QA_PROJETO_NUM_GRADUACAO) || empty(strval($xml_project->xpath(QA_PROJETO_NUM_GRADUACAO)[0][LABEL_NUMERO_GRADUACAO]))) {
                $project[LABEL_NUMERO_GRADUACAO] = '';
            } else {
                $project[LABEL_NUMERO_GRADUACAO] = lang('lt_label_graduation');
                $project[LABEL_NUMERO_GRADUACAO] .= '(';
                $project[LABEL_NUMERO_GRADUACAO] .= strval($xml_project->xpath(QA_PROJETO_NUM_GRADUACAO)[0][LABEL_NUMERO_GRADUACAO]);
                $project[LABEL_NUMERO_GRADUACAO] .= ') ';
            }

            if ($xml_project->xpath(Q_INTEGRANTES_PROJETO))
                foreach ($xml_project->xpath(Q_INTEGRANTES_PROJETO) as $xml_integrante) {
                    $integrante = array();
                    $integrante[LABEL_NOME_COMPLETO] = ucwords(utf8_decode($xml_integrante[LABEL_NOME_COMPLETO]));
                    $integrante[LABEL_RESPONSAVEL] = $xml_integrante[LABEL_RESPONSAVEL] == VALUE_FLAG_RESPONSAVEL_NEGATIVO ? FALSE : TRUE;
                    if (!in_array($integrante, $integrantes)) {
                        array_push($integrantes, $integrante);
                    }
                }
            $project['integrantes'] = $integrantes;

            if ($xml_project->xpath(Q_FINANCIADORES_PROJETO))
                foreach ($xml_project->xpath(Q_FINANCIADORES_PROJETO) as $xml_financiadores) {
                    foreach ($xml_financiadores as $xml_financiador) {
                        $financiador = array();
                        $financiador[LABEL_NOME_INSTITUICAO] = utf8_decode(strval($xml_financiador[LABEL_NOME_INSTITUICAO]));
                        $financiador[LABEL_NATUREZA] = ucfirst(strtolower(str_replace('_', ' ', strval($xml_financiador[LABEL_NATUREZA]))));
                        array_push($financiadores, $financiador);
                    }
                }
            $project['financiadores'] = $financiadores;
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $project;
    }

    /*
     * PROCESS_PRODUCTION_BOOK
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_production_book($xml_production) {
        $book = array();
        try {
            $authors = array();

            if ($xml_production->xpath(Q_PRODUCAO_AUTORES)) {
                foreach ($xml_production->xpath(Q_PRODUCAO_AUTORES) as $xml_author) {
                    $author = array();
                    $author[LABEL_NOME_PARA_CITACAO] = ucwords(utf8_decode($xml_author[LABEL_NOME_PARA_CITACAO]));
                    if (!in_array($author, $authors)) {
                        array_push($authors, $author);
                    }
                }
            }
            $book['autores'] = $authors;

            if ($xml_production->xpath(QA_PRODUCAO_LIVRO_TITULO)) {
                $book[LABEL_TITULO_DO_LIVRO] = utf8_decode(strval($xml_production->xpath(QA_PRODUCAO_LIVRO_TITULO)[0][LABEL_TITULO_DO_LIVRO]));
            } else {
                $book[LABEL_TITULO_DO_LIVRO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_LIVRO_NUMERO_EDICAO_REVISAO)) {
                $book[LABEL_NUMERO_EDICAO_REVISAO] = strval($xml_production->xpath(QA_PRODUCAO_LIVRO_NUMERO_EDICAO_REVISAO)[0][LABEL_NUMERO_EDICAO_REVISAO]);
            } else {
                $book[LABEL_NUMERO_EDICAO_REVISAO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_LIVRO_ANO)) {
                $book[LABEL_ANO] = strval($xml_production->xpath(QA_PRODUCAO_LIVRO_ANO)[0][LABEL_ANO]);
            } else {
                $book[LABEL_ANO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_LIVRO_NUMERO_VOLUMES)) {
                $book[LABEL_NUMERO_VOLUMES] = strval($xml_production->xpath(QA_PRODUCAO_LIVRO_NUMERO_VOLUMES)[0][LABEL_NUMERO_VOLUMES]);
            } else {
                $book[LABEL_NUMERO_VOLUMES] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $book;
    }

    /*
     * PROCESS_PRODUCTION_BOOK_CHAPTER
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_production_book_chapter($xml_production) {
        $chapters = array();
        try {
            $authors = array();

            if ($xml_production->xpath(Q_PRODUCAO_AUTORES)) {
                foreach ($xml_production->xpath(Q_PRODUCAO_AUTORES) as $xml_author) {
                    $author = array();
                    $author[LABEL_NOME_PARA_CITACAO] = ucwords(utf8_decode($xml_author[LABEL_NOME_PARA_CITACAO]));
                    if (!in_array($author, $authors)) {
                        array_push($authors, $author);
                    }
                }
            }
            $chapters['autores'] = $authors;

            if ($xml_production->xpath(QA_PRODUCAO_CAPITULO_TITULO)) {
                $chapters[LABEL_TITULO_DO_CAPITULO_DO_LIVRO] = utf8_decode(strval($xml_production->xpath(QA_PRODUCAO_CAPITULO_TITULO)[0][LABEL_TITULO_DO_CAPITULO_DO_LIVRO]));
            } else {
                $chapters[LABEL_TITULO_DO_CAPITULO_DO_LIVRO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_CAPITULO_TITULO_LIVRO)) {
                $chapters[LABEL_TITULO_DO_LIVRO] = utf8_decode(strval($xml_production->xpath(QA_PRODUCAO_CAPITULO_TITULO_LIVRO)[0][LABEL_TITULO_DO_LIVRO]));
            } else {
                $chapters[LABEL_TITULO_DO_LIVRO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_CAPITULO_EDICAO_REVISAO)) {
                $chapters[LABEL_NUMERO_EDICAO_REVISAO] = strval($xml_production->xpath(QA_PRODUCAO_CAPITULO_EDICAO_REVISAO)[0][LABEL_NUMERO_EDICAO_REVISAO]);
            } else {
                $chapters[LABEL_NUMERO_EDICAO_REVISAO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_CAPITULO_ANO)) {
                $chapters[LABEL_ANO] = strval($xml_production->xpath(QA_PRODUCAO_CAPITULO_ANO)[0][LABEL_ANO]);
            } else {
                $chapters[LABEL_ANO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_CAPITULO_VOLUMES)) {
                $chapters[LABEL_NUMERO_VOLUMES] = strval($xml_production->xpath(QA_PRODUCAO_CAPITULO_VOLUMES)[0][LABEL_NUMERO_VOLUMES]);
            } else {
                $chapters[LABEL_NUMERO_VOLUMES] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_CAPITULO_PAG_INICIAL)) {
                $chapters[LABEL_PAGINA_INICIAL] = strval($xml_production->xpath(QA_PRODUCAO_CAPITULO_PAG_INICIAL)[0][LABEL_PAGINA_INICIAL]);
            } else {
                $chapters[LABEL_PAGINA_INICIAL] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_CAPITULO_PAG_FINAL)) {
                $chapters[LABEL_PAGINA_FINAL] = strval($xml_production->xpath(QA_PRODUCAO_CAPITULO_PAG_FINAL)[0][LABEL_PAGINA_FINAL]);
            } else {
                $chapters[LABEL_PAGINA_FINAL] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $chapters;
    }

    /*
     * PROCESS_OTHER_PRODUCTION
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_other_production($xml_production) {
        $other = array();
        try {
            $authors = array();

            if ($xml_production->xpath(Q_PRODUCAO_AUTORES)) {
                foreach ($xml_production->xpath(Q_PRODUCAO_AUTORES) as $xml_author) {
                    $author = array();
                    $author[LABEL_NOME_PARA_CITACAO] = ucwords(utf8_decode($xml_author[LABEL_NOME_PARA_CITACAO]));
                    if (!in_array($author, $authors)) {
                        array_push($authors, $author);
                    }
                }
            }
            $other['autores'] = $authors;

            if ($xml_production->xpath(QA_OUTRA_PRODUCAO_TITULO)) {
                $other[LABEL_TITULO] = utf8_decode(strval($xml_production->xpath(QA_OUTRA_PRODUCAO_TITULO)[0][LABEL_TITULO]));
            } else {
                $other[LABEL_TITULO] = '';
            }
            if ($xml_production->xpath(QA_OUTRA_PRODUCAO_ANO)) {
                $other[LABEL_ANO] = strval($xml_production->xpath(QA_OUTRA_PRODUCAO_ANO)[0][LABEL_ANO]);
            } else {
                $other[LABEL_ANO] = '';
            }
            if ($xml_production->xpath(QA_OUTRA_PRODUCAO_NATUREZA)) {
                $other[LABEL_NATUREZA] = ucfirst(strtolower(str_replace('_', ' ', strval($xml_production->xpath(QA_OUTRA_PRODUCAO_NATUREZA)[0][QA_OUTRA_PRODUCAO_NATUREZA]))));
            } else {
                $other[LABEL_NATUREZA] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $other;
    }

    /*
     * PROCESS_PRODUCTION_IN_EVENT
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_production_in_event($xml_production) {
        $event = array();
        try {
            $authors = array();

            if ($xml_production->xpath(Q_PRODUCAO_AUTORES)) {
                foreach ($xml_production->xpath(Q_PRODUCAO_AUTORES) as $xml_author) {
                    $author = array();
                    $author[LABEL_NOME_PARA_CITACAO] = ucwords(utf8_decode($xml_author[LABEL_NOME_PARA_CITACAO]));
                    if (!in_array($author, $authors)) {
                        array_push($authors, $author);
                    }
                }
            }
            $event['autores'] = $authors;

            if ($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_TITULO_TRABALHO)) {
                $event[LABEL_TITULO_DO_TRABALHO] = utf8_decode(strval($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_TITULO_TRABALHO)[0][LABEL_TITULO_DO_TRABALHO]));
            } else {
                $event[LABEL_TITULO_DO_TRABALHO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_TITULO_EVENTO)) {
                $event[LABEL_TITULO_DO_EVENTO] = utf8_decode(strval($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_TITULO_EVENTO)[0][LABEL_TITULO_DO_EVENTO]));
            } else {
                $event[LABEL_TITULO_DO_EVENTO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_ANO_TRABALHO)) {
                $event[LABEL_ANO_DO_TRABALHO] = strval($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_ANO_TRABALHO)[0][LABEL_ANO_DO_TRABALHO]);
            } else {
                $event[LABEL_ANO_DO_TRABALHO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_CIDADE_EVENTO)) {
                $event[LABEL_CIDADE_DO_EVENTO] = utf8_decode(strval($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_CIDADE_EVENTO)[0][LABEL_CIDADE_DO_EVENTO]));
            } else {
                $event[LABEL_CIDADE_DO_EVENTO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_NOME_EVENTO)) {
                $event[LABEL_NOME_DO_EVENTO] = utf8_decode(strval($xml_production->xpath(QA_PRODUCAO_EM_EVENTO_NOME_EVENTO)[0][LABEL_NOME_DO_EVENTO]));
            } else {
                $event[LABEL_NOME_DO_EVENTO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $event;
    }

    /*
     * PROCESS_TECHNICAL_PRODUCTION
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_technical_production($xml_production) {
        $technical = array();
        try {
            $authors = array();

            if ($xml_production->xpath(Q_PRODUCAO_AUTORES)) {
                foreach ($xml_production->xpath(Q_PRODUCAO_AUTORES) as $xml_author) {
                    $author = array();
                    $author[LABEL_NOME_PARA_CITACAO] = ucwords(utf8_decode($xml_author[LABEL_NOME_PARA_CITACAO]));
                    if (!in_array($author, $authors)) {
                        array_push($authors, $author);
                    }
                }
            }
            $technical['autores'] = $authors;

            if ($xml_production->xpath(QA_PRODUCAO_TECNICO_TITULO)) {
                $technical[LABEL_TITULO_DO_TRABALHO_TECNICO] = utf8_decode(strval($xml_production->xpath(QA_PRODUCAO_TECNICO_TITULO)[0][LABEL_TITULO_DO_TRABALHO_TECNICO]));
            } else {
                $technical[LABEL_TITULO_DO_TRABALHO_TECNICO] = '';
            }
            if ($xml_production->xpath(QA_PRODUCAO_TECNICO_ANO)) {
                $technical[LABEL_ANO] = strval($xml_production->xpath(QA_PRODUCAO_TECNICO_ANO)[0][LABEL_ANO]);
            } else {
                $technical[LABEL_ANO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $technical;
    }

    /*
     * PROCESS_MASTER_BOARD
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_master_board($xml_board) {
        $board = array();
        try {
            $evaluators = array();

            if ($xml_board->xpath(QA_PARTICIPANTES_BANCA)) {
                foreach ($xml_board->xpath(QA_PARTICIPANTES_BANCA) as $xml_evaluator) {
                    $evaluator = array();
                    $evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE] = ucwords(utf8_decode($xml_evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE]));
                    if (!in_array($evaluator, $evaluators)) {
                        array_push($evaluators, $evaluator);
                    }
                }
            }
            $board['participantes'] = $evaluators;

            if ($xml_board->xpath(QA_BANCA_MESTRADO_NOME_CANDIDATO)) {
                $board[LABEL_NOME_DO_CANDIDATO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_MESTRADO_NOME_CANDIDATO)[0][LABEL_NOME_DO_CANDIDATO]));
            } else {
                $board[LABEL_NOME_DO_CANDIDATO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_MESTRADO_TITULO)) {
                $board[LABEL_TITULO] = strtoupper(utf8_decode(strval($xml_board->xpath(QA_BANCA_MESTRADO_TITULO)[0][LABEL_TITULO])));
            } else {
                $board[LABEL_TITULO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_MESTRADO_ANO)) {
                $board[LABEL_ANO] = strval($xml_board->xpath(QA_BANCA_MESTRADO_ANO)[0][LABEL_ANO]);
            } else {
                $board[LABEL_ANO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_MESTRADO_NOME_CURSO)) {
                $board[LABEL_NOME_CURSO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_MESTRADO_NOME_CURSO)[0][LABEL_NOME_CURSO]));
            } else {
                $board[LABEL_NOME_CURSO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_MESTRADO_NOME_INSTITUICAO)) {
                $board[LABEL_NOME_INSTITUICAO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_MESTRADO_NOME_INSTITUICAO)[0][LABEL_NOME_INSTITUICAO]));
            } else {
                $board[LABEL_NOME_INSTITUICAO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $board;
    }

    /*
     * PROCESS_QUALIFICATION_BOARD
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_qualification_board($xml_board) {
        $board = array();
        try {
            $evaluators = array();

            if ($xml_board->xpath(QA_PARTICIPANTES_BANCA)) {
                foreach ($xml_board->xpath(QA_PARTICIPANTES_BANCA) as $xml_evaluator) {
                    $evaluator = array();
                    $evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE] = ucwords(utf8_decode($xml_evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE]));
                    if (!in_array($evaluator, $evaluators)) {
                        array_push($evaluators, $evaluator);
                    }
                }
            }
            $board['participantes'] = $evaluators;

            if ($xml_board->xpath(QA_BANCA_QUALI_NOME_CANDIDATO)) {
                $board[LABEL_NOME_DO_CANDIDATO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_QUALI_NOME_CANDIDATO)[0][LABEL_NOME_DO_CANDIDATO]));
            } else {
                $board[LABEL_NOME_DO_CANDIDATO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_QUALI_TITULO)) {
                $board[LABEL_TITULO] = strtoupper(utf8_decode(strval($xml_board->xpath(QA_BANCA_QUALI_TITULO)[0][LABEL_TITULO])));
            } else {
                $board[LABEL_TITULO] = '';
            }
            if ($xml_board->xpath(QA_ANO_QUALIFICACAO)) {
            $board[LABEL_ANO] = strval($xml_board->xpath(QA_ANO_QUALIFICACAO)[0][LABEL_ANO]);
            } else {
                $board[LABEL_ANO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_QUALI_NOME_CURSO)) {
            $board[LABEL_NOME_CURSO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_QUALI_NOME_CURSO)[0][LABEL_NOME_CURSO]));
            } else {
                $board[LABEL_NOME_CURSO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_QUALI_NOME_INSTITUICAO)) {
                $board[LABEL_NOME_INSTITUICAO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_QUALI_NOME_INSTITUICAO)[0][LABEL_NOME_INSTITUICAO]));
            } else {
                $board[LABEL_NOME_INSTITUICAO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $board;
    }

    /*
     * PROCESS_EXPERTISE_BOARD
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_expertise_board($xml_board) {
        $board = array();
        try {
            $evaluators = array();

            if ($xml_board->xpath(QA_PARTICIPANTES_BANCA)) {
                foreach ($xml_board->xpath(QA_PARTICIPANTES_BANCA) as $xml_evaluator) {
                    $evaluator = array();
                    $evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE] = ucwords(utf8_decode($xml_evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE]));
                    if (!in_array($evaluator, $evaluators)) {
                        array_push($evaluators, $evaluator);
                    }
                }
            }
            $board['participantes'] = $evaluators;

            if ($xml_board->xpath(QA_BANCA_ESPECIALIZACAO_NOME_CANDIDATO)) {
                $board[LABEL_NOME_DO_CANDIDATO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_ESPECIALIZACAO_NOME_CANDIDATO)[0][LABEL_NOME_DO_CANDIDATO]));
            } else {
                $board[LABEL_NOME_DO_CANDIDATO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_ESPECIALIZACAO_TITULO)) {
                $board[LABEL_TITULO] = strtoupper(utf8_decode(strval($xml_board->xpath(QA_BANCA_ESPECIALIZACAO_TITULO)[0][LABEL_TITULO])));
            } else {
                $board[LABEL_TITULO] = '';
            }
            if ($xml_board->xpath(QA_ANO_ESPECIALIZACAO)) {
                $board[LABEL_ANO] = strval($xml_board->xpath(QA_ANO_ESPECIALIZACAO)[0][LABEL_ANO]);
            } else {
                $board[LABEL_ANO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_ESPECIALIZACAO_NOME_CURSO)) {
                $board[LABEL_NOME_CURSO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_ESPECIALIZACAO_NOME_CURSO)[0][LABEL_NOME_CURSO]));
            } else {
                $board[LABEL_NOME_CURSO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_ESPECIALIZACAO_NOME_INSTITUICAO)) {
                $board[LABEL_NOME_INSTITUICAO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_ESPECIALIZACAO_NOME_INSTITUICAO)[0][LABEL_NOME_INSTITUICAO]));
            } else {
                $board[LABEL_NOME_INSTITUICAO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $board;
    }

    /*
     * PROCESS_GRADUATION_BOARD
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_graduation_board($xml_board) {
        $board = array();
        try {
            $evaluators = array();

            if ($xml_board->xpath(QA_PARTICIPANTES_BANCA)) {
                foreach ($xml_board->xpath(QA_PARTICIPANTES_BANCA) as $xml_evaluator) {
                    $evaluator = array();
                    $evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE] = ucwords(utf8_decode($xml_evaluator[LABEL_NOME_PARA_CITACAO_PARCIPANTE]));
                    if (!in_array($evaluator, $evaluators)) {
                        array_push($evaluators, $evaluator);
                    }
                }
            }
            $board['participantes'] = $evaluators;

            if ($xml_board->xpath(QA_BANCA_GRADUACAO_NOME_CANDIDATO)) {
                $board[LABEL_NOME_DO_CANDIDATO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_GRADUACAO_NOME_CANDIDATO)[0][LABEL_NOME_DO_CANDIDATO]));
            } else {
                $board[LABEL_NOME_DO_CANDIDATO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_GRADUACAO_TITULO)) {
                $board[LABEL_TITULO] = strtoupper(utf8_decode(strval($xml_board->xpath(QA_BANCA_GRADUACAO_TITULO)[0][LABEL_TITULO])));
            } else {
                $board[LABEL_TITULO] = '';
            }
            if ($xml_board->xpath(QA_ANO_GRADUACAO)) {
                $board[LABEL_ANO] = strval($xml_board->xpath(QA_ANO_GRADUACAO)[0][LABEL_ANO]);
            } else {
                $board[LABEL_ANO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_GRADUACAO_NOME_CURSO)) {
                $board[LABEL_NOME_CURSO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_GRADUACAO_NOME_CURSO)[0][LABEL_NOME_CURSO]));
            } else {
                $board[LABEL_NOME_CURSO] = '';
            }
            if ($xml_board->xpath(QA_BANCA_GRADUACAO_NOME_INSTITUICAO)) {
                $board[LABEL_NOME_INSTITUICAO] = utf8_decode(strval($xml_board->xpath(QA_BANCA_GRADUACAO_NOME_INSTITUICAO)[0][LABEL_NOME_INSTITUICAO]));
            } else {
                $board[LABEL_NOME_INSTITUICAO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $board;
    }

    /*
     * PROCESS_DONE_MASTER_ORIENTATION
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_done_master_orientation($xml_orientation) {
        $orientation = array();
        try {
            if ($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_MESTRADO_NOME_ORIENTADO)) {
                $orientation[LABEL_NOME_DO_ORIENTADO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_MESTRADO_NOME_ORIENTADO)[0][LABEL_NOME_DO_ORIENTADO]));
            } else {
                $orientation[LABEL_NOME_DO_ORIENTADO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_MESTRADO_TITULO)) {
                $orientation[LABEL_TITULO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_MESTRADO_TITULO)[0][LABEL_TITULO]));
            } else {
                $orientation[LABEL_TITULO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_MESTRADO_NOME_CURSO)) {
                $orientation[LABEL_NOME_DO_CURSO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_MESTRADO_NOME_CURSO)[0][LABEL_NOME_DO_CURSO]));
            } else {
                $orientation[LABEL_NOME_DO_CURSO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_MESTRADO_NOME_INSTITUICAO)) {
                $orientation[LABEL_NOME_DA_INSTITUICAO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_MESTRADO_NOME_INSTITUICAO)[0][LABEL_NOME_DA_INSTITUICAO]));
            } else {
                $orientation[LABEL_NOME_DA_INSTITUICAO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $orientation;
    }
    
    /*
     * PROCESS_DONE_OTHER_ORIENTATION
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_done_other_orientation($xml_orientation) {
        $orientation = array();
        try {
            if ($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_OUTRA_NOME_ORIENTADO)) {
                $orientation[LABEL_NOME_DO_ORIENTADO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_OUTRA_NOME_ORIENTADO)[0][LABEL_NOME_DO_ORIENTADO]));
            } else {
                $orientation[LABEL_NOME_DO_ORIENTADO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_OUTRA_TITULO)) {
                $orientation[LABEL_TITULO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_OUTRA_TITULO)[0][LABEL_TITULO]));
            } else {
                $orientation[LABEL_TITULO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_OUTRA_NOME_CURSO)) {
                $orientation[LABEL_NOME_DO_CURSO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_OUTRA_NOME_CURSO)[0][LABEL_NOME_DO_CURSO]));
            } else {
                $orientation[LABEL_NOME_DO_CURSO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_OUTRA_NOME_INSTITUICAO)) {
                $orientation[LABEL_NOME_DA_INSTITUICAO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_CONCLUIDA_OUTRA_NOME_INSTITUICAO)[0][LABEL_NOME_DA_INSTITUICAO]));
            } else {
                $orientation[LABEL_NOME_DA_INSTITUICAO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $orientation;
    }

    /*
     * PROCESS_GOING_SCIENTIFIC_ORIENTATION
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_going_scientific_orientation($xml_orientation) {
        $orientation = array();
        try {
            if ($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_INICIACAO_NOME_ORIENTADO)) {
                $orientation[LABEL_NOME_DO_ORIENTADO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_INICIACAO_NOME_ORIENTADO)[0][LABEL_NOME_DO_ORIENTADO]));
            } else {
                $orientation[LABEL_NOME_DO_ORIENTADO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_INICIACAO_TITULO)) {
                $orientation[LABEL_TITULO_DO_TRABALHO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_INICIACAO_TITULO)[0][LABEL_TITULO_DO_TRABALHO]));
            } else {
                $orientation[LABEL_TITULO_DO_TRABALHO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_INICIACAO_NOME_CURSO)) {
                $orientation[LABEL_NOME_CURSO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_INICIACAO_NOME_CURSO)[0][LABEL_NOME_CURSO]));
            } else {
                $orientation[LABEL_NOME_CURSO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_INICIACAO_NOME_INSTITUICAO)) {
                $orientation[LABEL_NOME_INSTITUICAO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_INICIACAO_NOME_INSTITUICAO)[0][LABEL_NOME_INSTITUICAO]));
            } else {
                $orientation[LABEL_NOME_INSTITUICAO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $orientation;
    }

    /*
     * PROCESS_GOING_MASTER_ORIENTATION
     * ---------------------------------------
     * DESCRICAO : Processa um objeto XML ELE-
     * MENT passado como parametro para trans-
     * formar em um array organizado pelos 
     * atributos do NODE.
     * As consultas dos atributos sao feitas 
     * atraves das constantes.
     * ---------------------------------------
     * PARAMETROS : $XML_PROJECT - XML ELEMENT de projeto [SIMPLEXML_ELEMENT]
     * ---------------------------------------
     * RETORNO : Objeto Array com os atributos do NODE [ARRAY]
    */
    function process_going_master_orientation($xml_orientation) {
        $orientation = array();
        try {
            if ($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_MESTRADO_NOME_ORIENTADO)) {
                $orientation[LABEL_NOME_DO_ORIENTANDO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_MESTRADO_NOME_ORIENTADO)[0][LABEL_NOME_DO_ORIENTANDO]));
            } else {
                $orientation[LABEL_NOME_DO_ORIENTANDO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_MESTRADO_TITULO)) {
                $orientation[LABEL_TITULO_DO_TRABALHO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_MESTRADO_TITULO)[0][LABEL_TITULO_DO_TRABALHO]));
            } else {
                $orientation[LABEL_TITULO_DO_TRABALHO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_MESTRADO_NOME_CURSO)) {
                $orientation[LABEL_NOME_CURSO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_MESTRADO_NOME_CURSO)[0][LABEL_NOME_CURSO]));
            } else {
                $orientation[LABEL_NOME_CURSO] = '';
            }
            if ($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_MESTRADO_NOME_INSTITUICAO)) {
                $orientation[LABEL_NOME_INSTITUICAO] = utf8_decode(strval($xml_orientation->xpath(QA_ORIENT_ANDAMENTO_MESTRADO_NOME_INSTITUICAO)[0][LABEL_NOME_INSTITUICAO]));
            } else {
                $orientation[LABEL_NOME_INSTITUICAO] = '';
            }
        } catch(Exception $e) {
            log_message('error', 'ERRO XML - ' . $e->getMessage());
        }
        return $orientation;
    }
}

/* End of file MY_LT_LIB.php */

?>
