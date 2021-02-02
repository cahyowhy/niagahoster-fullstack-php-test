<?php

namespace NiagahosterTest\Core;

use \PDO;
use \PDOException;

class DatabaseConnection
{
    private static $instance;
    private $db_conn;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();

            try {
                $db_name = $_ENV['DB_NAME'];
                $db_host = $_ENV['DB_HOST'];
                $db_user = $_ENV['DB_USER'];
                $db_password = $_ENV['DB_PASSWORD'];

                self::$instance->db_conn = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_password);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->db_conn;
    }
}
