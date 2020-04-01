<?php
function uuid1(){
    return  md5(mktime(true).mt_rand(1,9999).mt_rand(1,9999).mt_rand(1,9999).mt_rand(1,9999));
}




