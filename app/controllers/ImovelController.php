<?php

class ImovelController extends Controller
{

    private $modelImovel;

    //Construir algo automaticamente - executa todos os dados | Instanciou uma classe e será executado 
    public function __construct()
    {

        $this->modelImovel = new Imovel();
    }



    public function index()
    {

        $dados = [];

        $filtros = [
            'tipo' => $_GET['tipo'] ?? null,
            'valor' => $_GET['valor'] ?? null,
            'condominio' => $_GET['condominio'] ?? null,
            'tipo_imovel' => $_GET['tipo_imovel'] ?? null,
            'quartos' => $_GET['quartos'] ?? null,
            'vagas' => $_GET['vagas'] ?? null,
            'piscina_imovel' => $_GET['piscina_imovel'] ?? null,
            'academia_imovel' => $_GET['academia_imovel'] ?? null,
            'salao_festas_imovel' => $_GET['salao_festas_imovel'] ?? null,
            'churrasqueira_imovel' => $_GET['churrasqueira_imovel'] ?? null,
            'quadra_esportes_imovel' => $_GET['quadra_esportes_imovel'] ?? null,
            'espaco_gourmet_imovel' => $_GET['espaco_gourmet_imovel'] ?? null,
            'brinquedoteca_imovel' => $_GET['brinquedoteca_imovel'] ?? null,
            'playground_imovel' => $_GET['playground_imovel'] ?? null,
            'portaria_24h_imovel' => $_GET['portaria_24h_imovel'] ?? null,
            'seguranca_imovel' => $_GET['seguranca_imovel'] ?? null,
            'bicicletario_imovel' => $_GET['bicicletario_imovel'] ?? null,
            'elevador_imovel' => $_GET['elevador_imovel'] ?? null,
            'vaga_visitante_imovel' => $_GET['vaga_dvisitante_imovel'] ?? null,
            'gerador_energia_imovel' => $_GET['gerador_energia_imovel'] ?? null

        ];


        // $resultado = $this->modelImovel->getFiltrarAvancado($filtros);

        // $dados['imovel'] = $resultado;
        $tipoPesquisa = isset($_GET['tipo']) ? trim($_GET['tipo']) : '';

        // Mapeia termos que o usuário pode digitar para os valores do banco
        $mapaTipos = [

            'a alugar'   => 'aluguel',
            'a venda'     => 'venda',
            'para vender' => 'venda',
            'para alugar' => 'aluguel',
            'alugar'      => 'aluguel',
            'comprar'     => 'venda',
            'casa'        => 'casa',
            'apartamento' => 'residencial',
            'condominio'  => 'residencial',
            // adicione conforme necessário
        ];

        // Verifica se o termo digitado precisa ser convertido
        $tipo = isset($mapaTipos[strtolower($tipoPesquisa)])
            ? $mapaTipos[strtolower($tipoPesquisa)]
            : $tipoPesquisa;

        // Busca os imóveis pelo tipo definido

        $resultado = $this->modelImovel->getPorTipo($tipo, $filtros);

        $dados['imovel'] = $resultado;

        $this->carregarViews('imovel', $dados);
    }


    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/imovel/listar';

        $imoveis = $this->modelImovel->getTodosImoveis();

        $dados['imoveis'] = $imoveis;

        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);
    }
    public function uploadFoto($file, $id, $nome)
    {
        $dir = 'upload/imovel/';
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $novoNome = $id . '_' . $this->gerarLinkImovel($nome) . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $dir . $novoNome)) {

            return $novoNome;
        } else {

            $novoNome = 'sem-foto.jpg';
            return $novoNome;
        }
    }
    public function editar($id)
    {
        $dados = array();
        $carregarDadosImovel = $this->modelImovel->carregarDados($id);
        $dados['carregarDadosImovel'] = $carregarDadosImovel;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /*2ª pegar os dados do form */
            $nome_imovel = filter_input(INPUT_POST, 'nome_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $tipo_anuncio_imovel = filter_input(INPUT_POST, 'tipo_anuncio_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_imovel = filter_input(INPUT_POST, 'endereco_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_imovel = filter_input(INPUT_POST, 'bairro_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_imovel = filter_input(INPUT_POST, 'status_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $cep_imovel = filter_input(INPUT_POST, 'cep_imovel', FILTER_SANITIZE_SPECIAL_CHARS);

            $complemento_imovel = filter_input(INPUT_POST, 'complemento_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_imovel = filter_input(INPUT_POST, 'estado_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_imovel = filter_input(INPUT_POST, 'descricao_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_imovel = filter_input(INPUT_POST, 'preco_imovel', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);


            date_default_timezone_set('America/Sao_Paulo');
            $data_publicacao_imovel = $carregarDadosImovel['data_publicacao_imovel'];
            $data_atualizacao_imovel = date('y-m-d H:i:s');

            $data_publicacao_imovel = $data_publicacao_imovel;
            $data_atualizacao_imovel = $data_atualizacao_imovel;
            $status_imovel = $carregarDadosImovel['status_imovel'];
            var_dump($nome_imovel);
            var_dump($endereco_imovel);
            /*3ª Atualizar  os dados na tabela imovel */
            if ($nome_imovel) {

                // var_dump($nome_imovel);
                if (isset($_FILES['url_foto_imovel']) && $_FILES['url_foto_imovel']['error'] == 0) {
                    $arquivo = $this->uploadFoto($_FILES['url_foto_imovel'], $id, $nome_imovel);
                } else {
                    $arquivo = $carregarDadosImovel['url_foto_imovel'];
                }

                $dadosImovel = array(
                    'id_imovel' => $id,
                    'nome_imovel' => $nome_imovel,
                    'tipo_anuncio_imovel' => $tipo_anuncio_imovel,
                    'endereco_imovel' => $endereco_imovel,
                    'bairro_imovel' => $bairro_imovel,
                    'status_imovel' => $status_imovel,
                    'cep_imovel' => $cep_imovel,
                    'complemento_imovel' => $complemento_imovel,
                    'estado_imovel' => $estado_imovel,
                    'descricao_imovel' => $descricao_imovel,
                    'preco_imovel' => $preco_imovel,

                    'data_publicacao_imovel' => $data_publicacao_imovel,
                    'data_atualizacao_imovel' => $data_atualizacao_imovel,
                    'url_foto_imovel' => $arquivo
                );
                /*4ª Atualizar o registro do imovel com a foto*/

                $resultado = $this->modelImovel->editarImovel($dadosImovel);

                /*5ª Tratar o nome da imagem e salvar na pasta UPLOAD */
                if ($resultado) {
                    /*6ª Alerta na pagina listar imovel*/
                    $_SESSION['mensagem'] = "Imóvel atualizado com sucesso!";
                    $_SESSION['tipoMsg'] = "sucesso";

                    header('Location:' . URL_BASE . 'imovel/listar');
                    exit;
                } else {
                    $_SESSION['mensagem'] = "Erro! Imóvel não atualizado.";
                    $_SESSION['tipoMsg'] = "erro";
                    header('Location:' . URL_BASE . 'imovel/listar');
                    exit;
                }
            }
        }

        $dados['conteudo'] = 'admin/imovel/editar';
        $this->carregarViews('admin/dash', $dados);
    }

    public function adicionar()
    {
        $dados = array();

        /*1ª a chamada vem do botão cadastrar Curso */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /*2ª pegar os dados do form */
            $nome_imovel = filter_input(INPUT_POST, 'nome_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $tipo_anuncio_imovel = filter_input(INPUT_POST, 'tipo_anuncio_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_imovel = filter_input(INPUT_POST, 'endereco_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_imovel = filter_input(INPUT_POST, 'bairro_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_imovel = filter_input(INPUT_POST, 'status_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $complemento_imovel = filter_input(INPUT_POST, 'complemento_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_imovel = filter_input(INPUT_POST, 'estado_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_imovel = filter_input(INPUT_POST, 'descricao_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_imovel = filter_input(INPUT_POST, 'preco_imovel', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $status_imovel = filter_input(INPUT_POST, 'status_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $cep_imovel = filter_input(INPUT_POST, 'cep_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_tipo_imovel = filter_input(INPUT_POST, 'id_tipo_imovel', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);



            date_default_timezone_set('America/Sao_Paulo');
            $data_publicacao_imovel = date('y-m-d H:i:s');
            $data_atualizacao_imovel = date('y-m-d H:i:s');

            $data_publicacao_imovel = $data_publicacao_imovel;
            $data_atualizacao_imovel = $data_atualizacao_imovel;

            /*3ª Inserir os dados na tabela curso */
            if ($nome_imovel) {
                $dadosImovel = array(
                    'nome_imovel' => $nome_imovel,
                    'tipo_anuncio_imovel' => $tipo_anuncio_imovel,
                    'endereco_imovel' => $endereco_imovel,
                    'bairro_imovel' => $bairro_imovel,
                    'status_imovel' => $status_imovel,
                    'complemento_imovel' => $complemento_imovel,
                    'estado_imovel' => $estado_imovel,
                    'descricao_imovel' => $descricao_imovel,
                    'preco_imovel' => $preco_imovel,
                    'cep_imovel' => $cep_imovel,
                    'alt_imovel' => $nome_imovel,
                    'data_publicacao_imovel' => $data_publicacao_imovel,
                    'data_atualizacao_imovel' => $data_atualizacao_imovel,
                    'id_tipo_imovel' => $id_tipo_imovel
                );
                $id_imovel = $this->modelImovel->addImovel($dadosImovel);
                // var_dump($id_curso);
                /*4ª Tratar o nome da imagem e salvar na pasta UPLOAD */
                if ($id_imovel) {

                    /*5ª Atualizar o registro do curso com a foto*/
                    if (isset($_FILES['url_foto_imovel']) && $_FILES['url_foto_imovel']['error'] == 0) {
                        $arquivo = $this->uploadFoto($_FILES['url_foto_imovel'], $id_imovel, $nome_imovel);

                        if ($arquivo) {
                            // Atualizar a foto na base de dados do Curso add, no ultimo ID curso add
                            $this->modelImovel->salvarFoto($id_imovel, $arquivo);
                        } else {
                            // Mensagem informando que a foto não foi salva
                            $dados['mensagem'] = "Erro ao salvar a foto!";
                            $dados['tipoMsg'] = "erro";
                        }
                    }

                    /*6ª Alerta na pagina listar curso*/
                    $_SESSION['mensagem'] = "Curso adicionado com sucesso!";
                    $_SESSION['tipoMsg'] = "sucesso";
                    header('Location:' . URL_BASE . 'imovel/listar');
                    //http://localhost/sistema-escola/public/curso/listar
                    exit;
                }
            }
        }




        $dados['conteudo'] = 'admin/imovel/adicionar';
        $this->carregarViews('admin/dash', $dados);
    }
    public function detalhe($link)
    {
        $dados = array();

        $imovel = $this->modelImovel->getTodosImoveis();
        foreach ($imovel as $linha) {
            if ($this->gerarLinkImovel($linha['id_imovel']) == $link) {
                $dados['imovel'] = $linha;
                $dados['titulo'] = $linha['nome_imovel'];
                $this->carregarViews('detalhe', $dados);
                return;
            }
        }
    }
    function gerarLinkImovel($link)
    {
        $link = mb_strtolower($link, 'UTF-8');
        $caracter = [
            // Letras minúsculas
            'á' => 'a',
            'à' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ç' => 'c',
            'ñ' => 'n',
            ' ' => '-',


        ];
        $link = strtr($link, $caracter);
        return $link;
    }
    public function carregar()
    {

        $dados = array();


        $todosOsImoveis = $this->modelImovel->getTodosImoveis();
        $dados['imoveis'] = $todosOsImoveis;
    }
    public function deletarImovel($id)
    {
        $resultado = $this->modelImovel->excluirImovel($id);


        if ($resultado) {
            // Retornar a resposta do AJAX
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false]);
        }
    }
    public function atualizarStatus()
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        // echo $dados;
        $sucesso = $this->modelImovel->atualizarStatus($dados['id_imovel'], $dados['status_imovel']);
        echo json_encode(['sucesso' => $sucesso]);
    }
    public function meusImoveis()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'proprietario') {
            header('Location: ' . URL_BASE);
            exit;
        }

        $idProprietario = $_SESSION['tipo_id'];

        $imovelModel = new Imovel();

        $dados = array();

        $dados['conteudo'] = 'admin/imovel/listarProprietario';

        $imoveis = $this->modelImovel->getImoveisPorProprietario($idProprietario);

        $dados['imoveis'] = $imoveis;

        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dashProprietario', $dados);





        $this->carregarViews('imovel/listarProprietario', $dados);
    }
    public function editarImovelProprietario($id)
    {
        $dados = array();
        $carregarDadosImovel = $this->modelImovel->carregarDados($id);
        $dados['carregarDadosImovel'] = $carregarDadosImovel;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /*2ª pegar os dados do form */
            $nome_imovel = filter_input(INPUT_POST, 'nome_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $tipo_anuncio_imovel = filter_input(INPUT_POST, 'tipo_anuncio_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_imovel = filter_input(INPUT_POST, 'endereco_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_imovel = filter_input(INPUT_POST, 'bairro_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_imovel = filter_input(INPUT_POST, 'status_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $cep_imovel = filter_input(INPUT_POST, 'cep_imovel', FILTER_SANITIZE_SPECIAL_CHARS);

            $complemento_imovel = filter_input(INPUT_POST, 'complemento_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_imovel = filter_input(INPUT_POST, 'estado_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_imovel = filter_input(INPUT_POST, 'descricao_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_imovel = filter_input(INPUT_POST, 'preco_imovel', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);


            date_default_timezone_set('America/Sao_Paulo');
            $data_publicacao_imovel = $carregarDadosImovel['data_publicacao_imovel'];
            $data_atualizacao_imovel = date('y-m-d H:i:s');

            $data_publicacao_imovel = $data_publicacao_imovel;
            $data_atualizacao_imovel = $data_atualizacao_imovel;
            $status_imovel = $carregarDadosImovel['status_imovel'];
            var_dump($nome_imovel);
            var_dump($endereco_imovel);
            /*3ª Atualizar  os dados na tabela imovel */
            if ($nome_imovel) {

                // var_dump($nome_imovel);
                if (isset($_FILES['url_foto_imovel']) && $_FILES['url_foto_imovel']['error'] == 0) {
                    $arquivo = $this->uploadFoto($_FILES['url_foto_imovel'], $id, $nome_imovel);
                } else {
                    $arquivo = $carregarDadosImovel['url_foto_imovel'];
                }

                $dadosImovel = array(
                    'id_imovel' => $id,
                    'nome_imovel' => $nome_imovel,
                    'tipo_anuncio_imovel' => $tipo_anuncio_imovel,
                    'endereco_imovel' => $endereco_imovel,
                    'bairro_imovel' => $bairro_imovel,
                    'status_imovel' => $status_imovel,
                    'cep_imovel' => $cep_imovel,
                    'complemento_imovel' => $complemento_imovel,
                    'estado_imovel' => $estado_imovel,
                    'descricao_imovel' => $descricao_imovel,
                    'preco_imovel' => $preco_imovel,

                    'data_publicacao_imovel' => $data_publicacao_imovel,
                    'data_atualizacao_imovel' => $data_atualizacao_imovel,
                    'url_foto_imovel' => $arquivo
                );
                /*4ª Atualizar o registro do imovel com a foto*/

                $resultado = $this->modelImovel->editarImovel($dadosImovel);

                /*5ª Tratar o nome da imagem e salvar na pasta UPLOAD */
                if ($resultado) {
                    /*6ª Alerta na pagina listar imovel*/
                    $_SESSION['mensagem'] = "Imóvel atualizado com sucesso!";
                    $_SESSION['tipoMsg'] = "sucesso";

                    header('Location:' . URL_BASE . 'imovel/listarProprietario');
                    exit;
                } else {
                    $_SESSION['mensagem'] = "Erro! Imóvel não atualizado.";
                    $_SESSION['tipoMsg'] = "erro";
                    header('Location:' . URL_BASE . 'imovel/listarProprietario');
                    exit;
                }
            }
        }

        $dados['conteudo'] = 'admin/imovel/editarProprietario';
        $this->carregarViews('admin/dashProprietario', $dados);
    }

    public function adicionarImovelProprietario()
    {
        $dados = array();

        /*1ª a chamada vem do botão cadastrar Curso */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /*2ª pegar os dados do form */
            $nome_imovel = filter_input(INPUT_POST, 'nome_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $tipo_anuncio_imovel = filter_input(INPUT_POST, 'tipo_anuncio_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $endereco_imovel = filter_input(INPUT_POST, 'endereco_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_imovel = filter_input(INPUT_POST, 'bairro_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $complemento_imovel = filter_input(INPUT_POST, 'complemento_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_imovel = filter_input(INPUT_POST, 'estado_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_imovel = filter_input(INPUT_POST, 'descricao_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_imovel = filter_input(INPUT_POST, 'preco_imovel', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $cep_imovel = filter_input(INPUT_POST, 'cep_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_tipo_imovel = filter_input(INPUT_POST, 'id_tipo_imovel', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $id_proprietario = filter_input(INPUT_POST, 'id_proprietario', FILTER_SANITIZE_NUMBER_INT);


            date_default_timezone_set('America/Sao_Paulo');
            $data_publicacao_imovel = date('y-m-d H:i:s');
            $data_atualizacao_imovel = date('y-m-d H:i:s');

            $data_publicacao_imovel = $data_publicacao_imovel;
            $data_atualizacao_imovel = $data_atualizacao_imovel;

            /*3ª Inserir os dados na tabela curso */
            if ($nome_imovel) {
                $dadosImovel = array(
                    'nome_imovel' => $nome_imovel,
                    'tipo_anuncio_imovel' => $tipo_anuncio_imovel,
                    'endereco_imovel' => $endereco_imovel,
                    'bairro_imovel' => $bairro_imovel,

                    'complemento_imovel' => $complemento_imovel,
                    'estado_imovel' => $estado_imovel,
                    'descricao_imovel' => $descricao_imovel,
                    'preco_imovel' => $preco_imovel,
                    'cep_imovel' => $cep_imovel,
                    'alt_imovel' => $nome_imovel,
                    'data_publicacao_imovel' => $data_publicacao_imovel,
                    'data_atualizacao_imovel' => $data_atualizacao_imovel,
                    'id_tipo_imovel' => $id_tipo_imovel,
                    'id_proprietario' => $id_proprietario
                );
                $id_imovel = $this->modelImovel->addImovelProprietario($dadosImovel);
                // var_dump($id_curso);
                /*4ª Tratar o nome da imagem e salvar na pasta UPLOAD */
                if ($id_imovel) {

                    /*5ª Atualizar o registro do curso com a foto*/
                    if (isset($_FILES['url_foto_imovel']) && $_FILES['url_foto_imovel']['error'] == 0) {
                        $arquivo = $this->uploadFoto($_FILES['url_foto_imovel'], $id_imovel, $nome_imovel);

                        if ($arquivo) {
                            // Atualizar a foto na base de dados do Curso add, no ultimo ID curso add
                            $this->modelImovel->salvarFoto($id_imovel, $arquivo);
                        } else {
                            // Mensagem informando que a foto não foi salva
                            $dados['mensagem'] = "Erro ao salvar a foto!";
                            $dados['tipoMsg'] = "erro";
                        }
                    }

                    /*6ª Alerta na pagina listar curso*/
                    $_SESSION['mensagem'] = "Curso adicionado com sucesso!";
                    $_SESSION['tipoMsg'] = "sucesso";
                    header('Location:' . URL_BASE . 'imovel/meusImoveis');
                    //http://localhost/sistema-escola/public/curso/listar
                    exit;
                }
            }
        }




        $dados['conteudo'] = 'admin/imovel/adicionarProprietario';
        $this->carregarViews('admin/dashProprietario', $dados);
    }
 
}
