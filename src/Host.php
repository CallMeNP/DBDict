<?php
namespace DBDict;

class Host
{
    public function __construct($config)
    {
    }

    /* 返回本host的信息
     * @param $mode string 字段集合的名字，在config.ini中定义
     */
    public function info($mode)
    {
    }

    /* 返回制定的db对象
     * @param $name string db名字
     */
    public function db()
    {
    }

    /* 返回本host下的数据库列表
     */
    public function dbList()
    {
    }
}
