<?php

namespace app\home\controller;

use think\Request;
use think\Validate;

class Repair extends Home
{
    public function Add(){
        if (request()->isPost()) {
            $repair = new \app\admin\model\Repair();
            $post = Request::instance()->post();
            $validate = new Validate([
                ['name', 'require', '报修人不能为空'],
                ['tel', 'require', '电话不能为空'],
                ['tel', 'number|min:11|max:11', '请输入11位电话'],
                ['address', 'require', '地址不能为空'],
                ['title', 'require', '标题不能为空'],
            ]);
            if(!$validate->check($post)){
                return $this->error($validate->getError());
            }
            $repair->sn = date('Ymd',time()).rand(100,999);
            $data = $repair->save($post);
            if($data){
                $this->success('新增成功', url('index'));
            } else {
                $this->error($repair->getError());
            }
        }
        return $this->fetch("add");
    }

}