<?php

class DataBaseConn {
    private string $host;
    private string $user;
    private string $pass;
    private string $database;
    private $connection;

    public function __construct(string $host, string $user, string $pass, string $database) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;

        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->database);

        if ($this->connection->connect_error) {
            throw new Exception("Błąd połączenia z bazą danych: " . $this->connection->connect_error);
        }
    }

    public function put(string $table, array $columns, array $values) {
        $columnsString = implode(', ', $columns);
        $valuesString = "'" . implode("', '", $values) . "'";

        $query = "INSERT INTO $table ($columnsString) VALUES ($valuesString)";

        if ($this->connection->query($query) === true) {
            return true;
        } else {
            return false;
        }
    }

    public function get(string $table, array $columns) {
        $columnsString = implode(", ", $columns);
        $query = "SELECT $columnsString FROM $table;";
        if ($this->connection->query($query) === true) {
            return true;
        } else {
            return false;
        }
    }

    public function update(string $table, array $columns, array $values) {

    }

    public function delete(string $table) {
        $query = "DELETE FROM $table;";

        if ($this->connection->query($query) === true) {
            return true;
        } else {
            return false;
        }

    }
}
