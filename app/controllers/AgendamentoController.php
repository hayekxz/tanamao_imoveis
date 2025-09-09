<?php

class AgendamentoController extends Controller
{

    private $agendamentoModel;
    private $proprietarioModel;
    private $imovelModel;

    public function __construct()
    {

        $this->agendamentoModel = new Agendamento();
        $this->imovelModel = new Agendamento(); // Adicione esta linha
        $this->proprietarioModel = new Agendamento(); // E esta linha
    }
    public function index()
    {

        $dados = array();

        $todosOsAgendamentos = $this->agendamentoModel->getAgendamentos();
        $dados["clientes"] = $todosOsAgendamentos;

        $this->carregarViews('admin/cliente/listar', $dados);
    }

    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/agendamento/listar';

        $agendamento = $this->agendamentoModel->getAgendamentos();

        $dados['agendamentos'] = $agendamento;



        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);
    }

    public function atualizarStatus()
    {

        $dados = json_decode(file_get_contents('php://input'), true);

        $sucesso = $this->agendamentoModel->atualizarStatus($dados['id_agendamento'], $dados['status_agendamento']);

        echo json_encode(['sucesso' => $sucesso]);
    }

    public function editar($id)
    {
        $dados = array();

        // 1º Carregar as informações atuais do cliente
        $carregarDadosAgendamento = $this->agendamentoModel->carregarDados($id);
        $dados['carregarDadosAgendamento'] = $carregarDadosAgendamento;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cliente         = filter_input(INPUT_POST, 'id_cliente', FILTER_SANITIZE_NUMBER_INT);
            $id_imovel          = filter_input(INPUT_POST, 'id_imovel', FILTER_SANITIZE_NUMBER_INT);
            $id_proprietario    = filter_input(INPUT_POST, 'id_proprietario', FILTER_SANITIZE_NUMBER_INT);
            $data_visita        = filter_input(INPUT_POST, 'data_visita',  FILTER_SANITIZE_SPECIAL_CHARS);
            $status_agendamento = filter_input(INPUT_POST, 'status_agendamento', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome_imovel        = filter_input(INPUT_POST, 'nome_imovel', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome_proprietario  = filter_input(INPUT_POST, 'nome_proprietario', FILTER_SANITIZE_SPECIAL_CHARS); // Corrija aqui

            $data_visita = date('Y-m-d H:i:s', strtotime($data_visita));

            $carregarDadosAgendamento = array(
                'id_agendamento'      => $id,
                'id_cliente'          => $id_cliente,
                'id_imovel'           => $id_imovel,
                'id_proprietario'     => $id_proprietario,
                'data_visita'         => $data_visita,
                'status_agendamento'  => $status_agendamento
            );


            // Atualiza agendamento
            $resultado = $this->agendamentoModel->editarAgendamento($carregarDadosAgendamento);

            // Atualiza nome do imóvel
            $this->imovelModel->atualizarNomeImovel($id_imovel, $nome_imovel);

            // Atualiza nome do proprietário
            $this->proprietarioModel->atualizarNomeProprietario($id_proprietario, $nome_proprietario);
            

            if ($resultado) {
                $_SESSION['Mensagem'] = "Agendamento atualizado com sucesso!";
                $_SESSION['tipoMsg']  = "Sucesso!";
                header('Location: ' . URL_BASE . 'agendamento/listar');
                exit;
            } else {
                $_SESSION['Mensagem'] = "Erro ao atualizar agendamento!";
                $_SESSION['tipoMsg']  = "Erro!";
                header('Location: ' . URL_BASE . 'agendamento/listar');
                exit;
            }
        }

        $dados['conteudo'] = 'admin/agendamento/editar';
        $this->carregarViews('admin/dash', $dados);
    }
}
