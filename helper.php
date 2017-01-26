<?php
include_once __dir__.'/vendor/autoload.php';
function breadcrumb($mode, $serverId=null, $schemaName=null, $tableName=null)
{
    $links[]=['text'=>'home','params'=>['action'=>'serverList','mode'=>$mode]];
    if (null!==$serverId) {
        $links[]=['text'=>"$serverId(server)",'params'=>['action'=>'schemaList','serverId'=>$serverId,'mode'=>$mode]];
        if (null !== $schemaName) {
            $links[]=['text'=>"$schemaName(schema)",'params'=>['action'=>'tableList','serverId'=>$serverId,'schemaName'=>$schemaName,'mode'=>$mode]];
            if (null !== $tableName) {
                $links[]=['text'=>"$tableName(table)",'params'=>['action'=>'columnList','serverId'=>$serverId,'schemaName'=>$schemaName,'tableName'=>$tableName,'mode'=>$mode]];
            }
        }
    }
    $links=array_map(function ($link) {return ['text'=>$link['text'], 'url'=>'?'.http_build_query($link['params'])];}, $links);
    return $links;
}
function modeLinks()
{
    $modes=\DBDict\Config::get('mode');
    $modes=array_keys($modes);
    $modes=array_map(function ($mode) {$get=$_GET;$get['mode']=$mode;return ['text'=>$mode, 'url'=>'?'.http_build_query($get)];}, $modes);
    return $modes;
}
function itemBaseUrl($action)
{
    $get=$_GET;
    $get['action']=$action;
    return '?'.http_build_query($get);
}
