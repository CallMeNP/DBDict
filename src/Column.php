<?php
namespace DBDict;

class Column
{
    public function list($fields, $serverName, $dbName, $tableName)
    {
        $pdo=(new Server)->getConnection($serverName);
        $query = $pdo->prepare('select '.implode(',', $fields).' from COLUMNS where TABLE_SCHEMA = :db_name and TABLE_NAME = :table_name');
        if (!$query->execute([':db_name' => $dbName, ':table_name'=>$tableName])) {
            var_dump($query->errorInfo());
        }
        $table = $query->fetchAll();
        return $table;
    }
    public function info($fields, $serverName, $dbName, $tableName, $columnName)
    {
        $pdo=(new Server)->getConnection($serverName);
        $query = $pdo->prepare('select '.implode(',', $fields).' from COLUMNS where TABLE_SCHEMA = :db_name and TABLE_NAME = :table_name and COLUMN_NAME = :column_name');
        if (!$query->execute([':db_name' => $dbName, ':table_name'=>$tableName, ':column_name'=>$columnName])) {
            var_dump($query->errorInfo());
        }
        $table = $query->fetch();
        return $table;
    }
}
