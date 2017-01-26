<?php
namespace DBDict;

class Schema
{
    public function list($fields, $serverName)
    {
        $pdo=(new Server)->getConnection($serverName);
        $query = $pdo->prepare('select '.implode(',', $fields).' from SCHEMATA where SCHEMA_NAME not in ("information_schema","mysql","performance_schema")');
        $query->execute();
        $tables = $query->fetchAll();
        return $tables;
    }

    public function info($fields, $serverName, $dbName)
    {
        $pdo=(new Server)->getConnection($serverName);
        $query = $pdo->prepare('select '.implode(',', $fields).' from SCHEMATA where SCHEMA_NAME = :dbname');
        $query->execute([':dbname' => $dbName]);
        $table = $query->fetch();
        return $table;
    }
}
