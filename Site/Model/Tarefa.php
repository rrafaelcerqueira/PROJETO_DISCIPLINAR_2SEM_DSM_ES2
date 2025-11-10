<?php

class Tarefa
{

    private $conn;
    private $tabela_tarefa = "tarefa";

    public $id;
    public $nome;
    public $data_expiracao;
    public $data_conclusao;
    public $descricao;
    public $fk_categoria_id;
    public $fk_usuario_id;
    public $fk_estado_id;

    // Construtor da classe, recebe a conexão com o banco
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Metodo de criação de tarefa
    public function criar()
    {
        $query = "INSERT INTO " . $this->tabela_tarefa .
            " (nome, data_expiracao, descricao, fk_categoria_id, fk_usuario_id)" .
            " VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));

        if (empty($this->data_expiracao)) {
            $this->data_expiracao = null;
        }

        $stmt->bind_param(
            "sssii",
            $this->nome,
            $this->data_expiracao,
            $this->descricao,
            $this->fk_categoria_id,
            $this->fk_usuario_id
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Metodo de listagem de tarefas por estado (pendente ou concluída)
    public function listarPorEstado()
    {
        $query = "SELECT 
                    t.id, 
                    t.nome, 
                    t.data_expiracao,
                    t.data_conclusao,
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
                    t.data_expiracao, t.nome";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->fk_usuario_id, $this->fk_estado_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado;
    }

    // Metodo de exclusão de tarefa
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

    // Metodo de busca de tarefa por ID
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

    // Metodo de edição de tarefa
    public function editar()
    {
        $this->data_conclusao = null;
        if ($this->fk_estado_id == 2) {
            $busca = $this->buscaID();
            if (empty($busca['data_conclusao'])) {
                $this->data_conclusao = date('Y-m-d');
            } else {
                $this->data_conclusao = $busca['data_conclusao'];
            }
        }

        $query = "UPDATE " . $this->tabela_tarefa . " SET 
                    nome = ?, 
                    data_expiracao = ?, 
                    descricao = ?, 
                    fk_categoria_id = ?, 
                    data_conclusao = ?
                  WHERE 
                    id = ? AND fk_usuario_id = ?";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));

        if (empty($this->data_expiracao)) {
            $this->data_expiracao = null;
        }

        $stmt->bind_param(
            "sssisii",
            $this->nome,
            $this->data_expiracao,
            $this->descricao,
            $this->fk_categoria_id,
            $this->data_conclusao,
            $this->id,
            $this->fk_usuario_id
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Metodo de mudança de estado
    public function mudarEstado()
    {
        $data_conclusao_sql = "NULL";
        if ($this->fk_estado_id == 2) {
            $data_conclusao_sql = "'" . date('Y-m-d') . "'";
        }

        $query = "UPDATE " . $this->tabela_tarefa . " SET 
                    fk_estado_id = ?,
                    data_conclusao = " . $data_conclusao_sql . "
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