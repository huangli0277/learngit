<?php
try {
    $con = new PDO('mysql:host=mysql;dbname=ceshidata', 'root', '123456');
    $con->query('SET NAMES UTF8');
    $res =  $con->query('select * from user');
    $info=array();
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $val = array_change_key_case ( $row ,  CASE_LOWER );
        $info[$val['field']] = array(
            'name'    => $val['field'],
            'type'    => $val['type'],
            'notnull' => (bool) ($val['null'] === ''), // not null is empty, null is yes
            'default' => $val['default'],
            'primary' => (strtolower($val['key']) == 'pri'),
            'autoinc' => (strtolower($val['extra']) == 'auto_increment'),
        );
    }
    print_r($info);
} catch (PDOException $e) {
     echo '错误原因：'  . $e->getMessage();
}