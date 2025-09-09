<?php

class Agendamento extends Model
{


    public function listarComRelacionamentos()
    {
        $sql = "SELECT 
            a.id_agendamento,
            a.data_visita,
            a.status_agendamento,
            c.id_cliente,
            c.nome_cliente,
            c.email_cliente,
            c.senha_cliente,
            c.cep_cliente,
            c.foto_cliente,
            i.id_imovel,
            i.nome_imovel
        FROM tbl_agendamento a
        JOIN tbl_cliente c ON a.id_cliente = c.id_cliente
        JOIN tbl_imovel i ON a.id_imovel = i.id_imovel
        WHERE a.status_agendamento != 'Cancelado'
        ORDER BY c.nome_cliente ASC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Desativa um agendamento (altere conforme sua regra de negócio)
     */
    public function desativar($id)
    {
        $sql = "UPDATE agendamento SET status_agendamento != 'Cancelado' WHERE id_agendamento = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAgendamentos()
    {
        $sql = "SELECT 
            a.id_agendamento,
            a.id_cliente,
            a.id_imovel,
            a.id_proprietario,
            a.data_visita,
            a.status_agendamento,   
            c.nome_cliente,
            i.nome_imovel,
            i.preco_imovel,
            p.nome_proprietario
        FROM tbl_agendamento a
        JOIN tbl_cliente c ON a.id_cliente = c.id_cliente
        JOIN tbl_imovel i ON a.id_imovel = i.id_imovel
        JOIN tbl_proprietario p ON i.id_proprietario = p.id_proprietario
        WHERE a.status_agendamento != 'Cancelado'";
    
        $stmt = $this->db->query($sql);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function atualizarStatus($id, $status)
    {
        $sql = "UPDATE tbl_agendamento SET status_agendamento = :status_agendamento WHERE id_agendamento = :id_agendamento";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status_agendamento', $status);
        $stmt->bindValue(':id_agendamento', $id);
        return $stmt->execute();
    }

    public function editarAgendamento($carregarDadosAgendamento)
    {
        $sql = "UPDATE tbl_agendamento SET
        id_cliente         = :id_cliente,
        id_imovel          = :id_imovel,
        id_proprietario    = :id_proprietario,
        data_visita        = :data_visita,
        status_agendamento = :status_agendamento
    WHERE id_agendamento   = :id_agendamento";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id_cliente', $carregarDadosAgendamento['id_cliente'], PDO::PARAM_INT);
        $stmt->bindValue(':id_imovel', $carregarDadosAgendamento['id_imovel'], PDO::PARAM_INT);
        $stmt->bindValue(':id_proprietario', $carregarDadosAgendamento['id_proprietario'], PDO::PARAM_INT);
        $stmt->bindValue(':data_visita', $carregarDadosAgendamento['data_visita']);
        $stmt->bindValue(':status_agendamento', $carregarDadosAgendamento['status_agendamento']);
        $stmt->bindValue(':id_agendamento', $carregarDadosAgendamento['id_agendamento'], PDO::PARAM_INT);


        return $stmt->execute();
    }

    public function carregarDados($id)
    {
    $sql = "SELECT 
    a.*, 
    c.nome_cliente, 
    i.nome_imovel,
    p.nome_proprietario
    FROM tbl_agendamento a
    JOIN tbl_cliente c ON a.id_cliente = c.id_cliente
    JOIN tbl_imovel i ON a.id_imovel = i.id_imovel
    JOIN tbl_proprietario p ON i.id_proprietario = p.id_proprietario
    WHERE a.status_agendamento != 'cancelado' AND a.id_agendamento = :id
    ORDER BY c.nome_cliente ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Exemplo para o ImovelModel
    public function atualizarNomeImovel($id_imovel, $nome_imovel)
    {
        $sql = "UPDATE tbl_imovel SET nome_imovel = :nome_imovel WHERE id_imovel = :id_imovel";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_imovel', $nome_imovel);
        $stmt->bindValue(':id_imovel', $id_imovel, PDO::PARAM_INT);
        return $stmt->execute();
    }

        public function atualizarNomeProprietario($id_proprietario, $nome_proprietario)
    {
        $sql = "UPDATE tbl_proprietario SET nome_proprietario = :nome_proprietario WHERE id_proprietario = :id_proprietario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_proprietario', $nome_proprietario);
        $stmt->bindValue(':id_proprietario', $id_proprietario, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
