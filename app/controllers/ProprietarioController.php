<?php

class ProprietarioController extends Controller
{

    private $modelProprietario;

    public function __construct()
    {

        $this->modelProprietario = new Proprietario();
    }

    public function getProprietario()
    {
        return array();
    }

    public function index()
    {

        $dados = array();

        $modelProprietario = $this->modelProprietario->getProprietario();
        $dados["proprietarios"] = $modelProprietario;

        $this->carregarViews('admin/proprietario/listar', $dados);
    }

    public function perfilProprietario()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'proprietario') {
            header('Location: ' . URL_BASE);
            exit;
        }

        $idProprietario = $_SESSION['tipo_id'];

        $proprietarioModel = new Proprietario();
        $dados = array();

        $dados['proprietario'] = $proprietarioModel->getProprietarioById($idProprietario);

        $dados['conteudo'] = 'admin/proprietario/perfilProprietario';

        $this->carregarViews('admin/dashProprietario', $dados);
    }
    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/proprietario/listar';

        $modelProprietario = $this->modelProprietario->getProprietario();

        $dados['proprietarios'] = $modelProprietario;



        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);
    }
}
