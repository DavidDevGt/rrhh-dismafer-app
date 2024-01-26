<?php
// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Database
{
    private function connect()
    {
        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $dbname = $_ENV['DB_NAME'];

        $connection = mysqli_connect($host, $user, $pass, $dbname);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $connection;
    }

    private function close($connection)
    {
        mysqli_close($connection);
    }

    public function dbQuery($query)
    {
        $connection = $this->connect();
        $result = mysqli_query($connection, $query);
        $this->close($connection);
        return $result;
    }

    public function dbQueryInsert($query)
    {
        $connection = $this->connect();
        mysqli_query($connection, $query);
        $lastId = mysqli_insert_id($connection);
        $this->close($connection);
        return $lastId;
    }

    public function dbFetchAssoc($result)
    {
        return mysqli_fetch_assoc($result);
    }

    public function dbFetchAll($result)
    {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
