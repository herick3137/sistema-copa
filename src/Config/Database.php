<?php

namespace Res0144783\CopaDoMundo\Config;

use PDO;
use PDOException;

class Database {
    private $host = "localhost";
    private $db_name = "copa_db";
    private $user = "root";
    private $password = "herick123";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->user,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }

        return $this->conn;
    }
}