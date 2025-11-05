<?php

class Usuario
{

    private $conn;
    private $tabela_nome = "usuario";

    public $id;
    public $nome;
    public $email;
    public $senha;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Metodo de login
    public function login()
    {
        $query = "SELECT id, nome, senha FROM " . $this->tabela_nome . " WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->email);

        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();

            if (password_verify($this->senha, $row['senha'])) {

                $this->id = $row['id'];
                $this->nome = $row['nome'];
                return true;
            }
        }
        return false;
    }

    //Metodo de verificação de email existente
    public function emailExiste()
    {
        $query = "SELECT id FROM " . $this->tabela_nome . " WHERE email = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Metodo de cadastro de usuário
    public function cadastrar()
    {
        if ($this->emailExiste()) {
            return false;
        }

        $query = "INSERT INTO " . $this->tabela_nome . " (nome, email, senha) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);

        $stmt->bind_param("sss", $this->nome, $this->email, $this->senha);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
