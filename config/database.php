<?php
// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function dbConnect()
{
    $connection = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $connection;
}

function dbQuery($query)
{
    $connection = dbConnect();
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function dbQueryInsert($query)
{
    $connection = dbConnect();
    mysqli_query($connection, $query);
    $lastId = mysqli_insert_id($connection);
    mysqli_close($connection);
    return $lastId;
}

function dbFetchAssoc($result)
{
    return mysqli_fetch_assoc($result);
}

function dbFetchAll($result)
{
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
