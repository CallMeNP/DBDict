<?php
namespace DBDict;

class Table
{
    public function list($fields, $serverName, $dbName)
    {
        $pdo=(new Server)->getConnection($serverName);
        $query = $pdo->prepare('select '.implode(',', $fields).' from TABLES where TABLE_SCHEMA = :dbname');
        if (!$query->execute([':dbname' => $dbName])) {
            var_dump($query->errorInfo());
        }
        $table = $query->fetchAll();
        return $table;
    }
    public function info($fields, $serverName, $dbName, $tableName)
    {
        $pdo=(new Server)->getConnection($serverName);
        $query = $pdo->prepare('select '.implode(',', $fields).' from TABLES where TABLE_SCHEMA = :dbname and TABLE_NAME = :table_name');
        if (!$query->execute([':dbname' => $dbName, ':table_name'=>$tableName])) {
            var_dump($query->errorInfo());
        }
        $table = $query->fetch();
        return $table;
    }
}
