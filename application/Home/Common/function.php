<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/11/28
 * Time: 10:37
 */


function getpage($count, $pagesize = 10) {
     $p = new Think\Page($count, $pagesize);
     $p->rollPage=5;
     $p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
     $p->setConfig('prev', '上一页');
     $p->setConfig('next', '下一页');
     $p->setConfig('end', '末页');
     $p->setConfig('first', '首页');
     $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
     $p->lastSuffix = false;//最后一页不显示为总页数
     return $p;
}

function tuijian($height,$weight,$pinpid){


}


