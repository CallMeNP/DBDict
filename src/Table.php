<?php
namespace DBDict;

class Table
{
    public function list($fields, $serverName, $dbName)
    {
        $pdo=(new Server)->getConnection($serverName);
        $query = $pdo->prepare('select '.implode(',', $fields).' from TABLES where TABLE_SCHEMA = :dbname');
        $query->execute([':dbname' => $dbName]);
        $table = $query->fetchAll();
        return $table;
    }
    public function info($fields, $serverName, $dbName, $tableName)
    {
        $pdo=(new Server)->getConnection($serverName);
        $query = $pdo->prepare('select '.implode(',', $fields).' from TABLES where TABLE_SCHEMA = :dbname and TABLE_NAME = :table_name');
        $query->execute([':dbname' => $dbName, ':table_name'=>$tableName]);
        $table = $query->fetch();
        return $table;
    }
}
