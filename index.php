<?php
include_once __dir__.'/vendor/autoload.php';
include_once __dir__.'/helper.php';
$action=isset($_GET['action'])?$_GET['action']:'serverList';
$controller=new Controller();
call_user_func([$controller, $action]);

class Controller
{
    public function serverList()
    {
        $mode=isset($_GET['mode'])?$_GET['mode']:'default';
        $fields=explode(',', \DBDict\Config::get('mode', $mode, 'server'));
        $srv=new \DBDict\Server();
        $srvs=$srv->list($fields);
        echo \DBDict\Tpl::render('serverList.html', [
            'modeLinks'=>modeLinks(),
            'breadcrumb'=>breadcrumb($mode),
            'itemBaseUrl'=>itemBaseUrl('schemaList'),
            'mode'=>$mode,
            'fields'=>$fields,
            'rows'=>$srvs]);
        return;
    }
    public function schemaList()
    {
        $mode=isset($_GET['mode'])?$_GET['mode']:'default';
        $serverId=isset($_GET['serverId'])?$_GET['serverId']:\DBDict\Config::get('default', 'server');
        /**
         * 当config.ini中serverId是数字时，parse_ini_file会将之作为数组的数字下标。
         * 这时使用字符串下标的数字将取不到值。
         * 所以此处做转换。
         */
        if (preg_match('/^\d+$/', $serverId)) {
            $serverId=intval($serverId);
        }

        $fields=explode(',', \DBDict\Config::get('mode', $mode, 'schema'));
        if (! in_array('SCHEMA_NAME', $fields)) {
            array_unshift($fields, 'SCHEMA_NAME');
        }

        $schema=new \DBDict\Schema();
        $rows=$schema->list($fields, $serverId);
        echo \DBDict\Tpl::render('schemaList.html', [
            'modeLinks'=>modeLinks(),
            'breadcrumb'=>breadcrumb($mode, $serverId, $schemaName, $tableName),
            'itemBaseUrl'=>itemBaseUrl('tableList'),
            'serverId'=>$serverId,
            'mode'=>$mode,
            'fields'=>$fields,
            'rows'=>$rows
        ]);
        return;
    }
    public function tableList()
    {
        $mode=isset($_GET['mode'])?$_GET['mode']:'default';
        $serverId=isset($_GET['serverId'])?$_GET['serverId']:\DBDict\Config::get('default', 'server');
        if (preg_match('/^\d+$/', $serverId)) {
            $serverId=intval($serverId);
        }
        $schemaName=isset($_GET['schemaName'])?$_GET['schemaName']:null;
        if (null==$schemaName) {
            echo "need schemaName";
        }

        $fields=explode(',', \DBDict\Config::get('mode', $mode, 'table'));
        if (! in_array('TABLE_NAME', $fields)) {
            array_unshift($fields, 'TABLE_NAME');
        }

        $table=new \DBDict\Table();
        $rows=$table->list($fields, $serverId, $schemaName);
        echo \DBDict\Tpl::render('tableList.html', [
            'modeLinks'=>modeLinks(),
            'breadcrumb'=>breadcrumb($mode, $serverId, $schemaName),
            'itemBaseUrl'=>itemBaseUrl('columnList'),
            'serverId'=>$serverId,
            'schemaName'=>$schemaName,
            'mode'=>$mode,
            'fields'=>$fields,
            'rows'=>$rows
        ]);
        return;
    }
    public function columnList()
    {
        $mode=isset($_GET['mode'])?$_GET['mode']:'default';
        $serverId=isset($_GET['serverId'])?$_GET['serverId']:\DBDict\Config::get('default', 'server');
        if (preg_match('/^\d+$/', $serverId)) {
            $serverId=intval($serverId);
        }
        $schemaName=isset($_GET['schemaName'])?$_GET['schemaName']:null;
        if (null==$schemaName) {
            echo "need schemaName";
        }
        $tableName=isset($_GET['tableName'])?$_GET['tableName']:null;
        if (null==$tableName) {
            echo "need tableName";
        }

        $fields=explode(',', \DBDict\Config::get('mode', $mode, 'column'));
        if (! in_array('COLUMN_NAME', $fields)) {
            array_unshift($fields, 'COLUMN_NAME');
        }
        $column=new \DBDict\Column();
        $rows=$column->list($fields, $serverId, $schemaName, $tableName);
        echo \DBDict\Tpl::render('columnList.html', [
            'modeLinks'=>modeLinks(),
            'breadcrumb'=>breadcrumb($mode, $serverId, $schemaName, $tableName),
            'serverId'=>$serverId,
            'schemaName'=>$schemaName,
            'tableName'=>$tableName,
            'mode'=>$mode,
            'fields'=>$fields,
            'rows'=>$rows
        ]);
        return;
    }
}
