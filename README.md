# DBDict
数据字典,data-dictionary,数据库字段文档,db-doc
## 介绍
原理是从数据库中读取字段注释等信息展示出来。

目前只支持mysql。从`information_schama`中的`SCHEMATA`,`TABLES`,`COLUMNS`三个表读取信息。
## 安装
* 放置代码。
* 执行`composer install -vvv`安装依赖包，主要是twig模板引擎。
* 复制配置文件`exmpale.config.ini`为`config.ini`并修改。

### 配置
参见`example.config.ini`中的注释。主要修改数据库的地址，端口，账号和密码。建议专门配置只读的数据库账号。
## 使用说明
### 4个页面
主要有四个页面：
* 服务器列表页
* 某一服务器的数据库列表页
* 某一库中的表的列表页
* 某一表中的字段列表页

页首提供面包屑导航。

### 模式
即配置文件中的`mode`。用于定制在各个列表中显示哪些字段。

可以定制多种`mode`。会在页面底部列出所有模式，点击切换。
### url参数说明
 参数名     | 解释                       | 必选 | 默认值          
----|----|----|----
 serverId   | 主机名，需出现在配置文件中 | 否   | 0            
 schemaName | 数据库名                   | 否   | 
 tableName  | 表名                       | 否   | 
 columnName | 字段名                     | 否   |    
 mode       | 显示哪些字段               | 否   | default模式    
 action     | xxxList               | 否   | serverList         
 
## TODO
1. 生成html文件
2. 其他数据库
3. wiki插件
