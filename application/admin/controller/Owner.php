<?php
/**
 * Created by PhpStorm.
 * User: melo
 * Date: 2017/11/30
 * Time: 15:04
 */

namespace app\admin\controller;


use think\Db;

class Owner extends Admin
{
    public function Index()
    {
        $list = Db::name('owner')->select();
        int_to_status($list);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function changeStatus($method=null){
        $data=input('id/a');
        $id = array_unique($data);
        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['uid'] =   array('in',$id);
        switch ( strtolower($method) ){
            case 'forbid':
                $this->forbid('owner', $map );
                break;
            case 'pass':
                $this->resume('owner', $map );
                break;
            case 'deleteuser':
                $this->delete('owner', $map );
                break;
            default:
                $this->error('参数非法');
        }
    }
}