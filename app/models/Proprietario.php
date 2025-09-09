<?php

class Proprietario extends Model
{
    public function buscarProp($email, $senha)
    {
        $sql = "SELECT * FROM tbl_proprietario 
        WHERE email_proprietario = :email 
        AND senha_proprietario = :senha 
        AND status_proprietario = 'ATIVO'";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProprietario()
    {

        $sql = "SELECT * FROM tbl_proprietario 
        WHERE status_proprietario != 'Desativar' ORDER BY nome_proprietario ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    public function getProprietarioById($id)
    {
        $sql = "SELECT * FROM tbl_proprietario WHERE id_proprietario = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getImoveisPorProprietario($idProprietario)
    {
        $sql = "SELECT * FROM tbl_imovel WHERE id_proprietario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $idProprietario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProprietarioPorId($id)
    {
        $sql = "SELECT * FROM tbl_proprietario WHERE id_proprietario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
