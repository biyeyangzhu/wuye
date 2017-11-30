<?php
/**
 * Created by PhpStorm.
 * User: melo
 * Date: 2017/11/30
 * Time: 18:53
 */

namespace app\home\controller;


use think\Db;

class Sale extends Home
{
    public function Index(){
        $list = Db::name('sale')->where('type','1')->select();
        $list2 = Db::name('sale')->where('type','2')->select();
        $this->assign('list', $list);
        $this->assign('list2', $list2);
        return $this->fetch();
    }

    public function Detail($id = 0){
        $list = Db::name('sale')->find(['id'=>$id]);
        $this->assign('list', $list);
        return $this->fetch();
    }
}