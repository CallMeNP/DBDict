<?php
namespace DBDict;

class Server
{
    public function list($fields)
    {
        $servers=Config::get('server');
        foreach ($servers as $serverId=>&$serverInfo) {
            $serverInfo=array_intersect_key($serverInfo, array_flip($fields));
        }
        return $servers;
    }
    public function info($fields, $serverName)
    {
        $serverInfo=Config::get('server', $serverName);
        $serverInfo=array_intersect_key($serverInfo, array_flip($fields));
        return $serverInfo;
    }
    public function getConnection($serverName)
    {
        $srvInfo=Config::get('server', $serverName);
        $pdo = new \PDO("mysql:host=${srvInfo['host']};port=${srvInfo['port']};dbname=information_schema", $srvInfo['username'], $srvInfo['password']);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return $pdo;
    }
}
