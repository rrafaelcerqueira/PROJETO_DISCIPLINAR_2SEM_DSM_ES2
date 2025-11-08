<?php

class Tarefa
{

    private $conn;
    private $tabela_tarefa = "tarefa";

    public $id;
    public $nome;
    public $data;
    public $descricao;
    public $fk_categoria_id;
    public $fk_usuario_id;
    public $fk_estado_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Metodo de criação de tarefa
    public function criar()
    {
        $query = "INSERT INTO " . $this->tabela_tarefa .
            " (nome, data, descricao, fk_categoria_id, fk_usuario_id, fk_estado_id)" .
            " VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));

        if (empty($this->data)) {
            $this->data = null;
        }

        $stmt->bind_param(
            "ssiiii",
            $this->nome,
            $this->data,
            $this->descricao,
            $this->fk_categoria_id,
            $this->fk_usuario_id,
            $this->fk_estado_id
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Metodo de listagem de tarefas por estado
    public function listarPorEstado()
    {
        $query = "SELECT 
                    t.id, 
                    t.nome, 
                    t.data,
                    t.descricao, 
                    t.fk_categoria_id,
                    t.fk_estado_id,
                    c.nome as nome_categoria 
                  FROM 
                    " . $this->tabela_tarefa . " t 
                    LEFT JOIN categoria c ON t.fk_categoria_id = c.id 
                  WHERE 
                    t.fk_usuario_id = ? AND t.fk_estado_id = ? 
                  ORDER BY 
                    t.data, t.nome";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->fk_usuario_id, $this->fk_estado_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado;
    }

    //Metodo de exclusão de tarefa
    public function excluir()
    {
        $query = "DELETE FROM " . $this->tabela_tarefa . " WHERE id = ? AND fk_usuario_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->id, $this->fk_usuario_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Metodo de busca de tarefa por id
    public function buscaID()
    {
        $query = "SELECT 
                    t.*, 
                    c.nome as nome_categoria 
                  FROM 
                    " . $this->tabela_tarefa . " t 
                    LEFT JOIN categoria c ON t.fk_categoria_id = c.id 
                  WHERE 
                    t.id = ? AND t.fk_usuario_id = ? 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->id, $this->fk_usuario_id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();
            return $row;
        }
        return false;
    }

    //Metodo de edição de tarefa
    public function editar()
    {
        $query = "UPDATE " . $this->tabela_tarefa . " SET 
                    nome = ?, 
                    data = ?, 
                    descricao = ?, 
                    fk_categoria_id = ?, 
                    fk_estado_id = ? 
                  WHERE 
                    id = ? AND fk_usuario_id = ?";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));

        if (empty($this->data)) {
            $this->data = null;
        }

        $stmt->bind_param(
            "sssiiii",
            $this->nome,
            $this->data,
            $this->descricao,
            $this->fk_categoria_id,
            $this->fk_estado_id,
            $this->id,
            $this->fk_usuario_id
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //Metodo de mudança de estado
    public function mudarEstado()
    {
        $query = "UPDATE " . $this->tabela_tarefa . " SET 
                    fk_estado_id = ? 
                  WHERE 
                    id = ? AND fk_usuario_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "iii",
            $this->fk_estado_id,
            $this->id,
            $this->fk_usuario_id
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
