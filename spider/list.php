<?php

require '../spider/QueryList.php';
require '../spider/phpQuery.php';
// 待采集的页面地址
$url = 'https://www.cnbeta.com/category/soft.htm';

// 采集规则
$rules = [
    // 文章标题
    'title' => ['.items-area .item dl dt a','text'],
    'desn' => ['.items-area .item dl dd p','text'],
    'pic' => ['.items-area .item dl a img','src'],
];


$data = @\QL\QueryList::Query($url,$rules)->data;

print_r($data);

$pdo=new PDO('mysql:host=127.0.0.1;dbname=month9','root','root');
$sql = 'INSERT INTO article (title,desn,pic) VALUES ("'.$data['title'].'",'.$data['author'].',"'.$data['desn'].'","'.$data['pic'].'")';		//插入数据
$count = $pdo->exec($sql);
if($count){
    echo "添加成功！";
}else{
    echo "<pre>";
    var_dump($pdo->errorInfo());						//显示错误数组
    echo "</pre>";
}
