<?php

namespace app\admin\Controller;


use think\Db;
use think\Request;

class Repair extends Admin
{
    /**
     * 列表
     * @return mixed
     */
    public function Index()
    {
        $list = Db::name('repair')->select();
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 添加
     * @return mixed|void
     */
    public function Add()
    {
        if (request()->isPost()) {
            $repair = model('repair');
            $post = Request::instance()->post();
            $validate = validate("repair");
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
            return $this->fetch("edit");
        }

    /**
     * 修改
     * @param $id
     * @return mixed|void
     */
        public function Edit($id){
            $info=Db::name("repair")->find($id);
            if(false === $info){
                $this->error('获取配置信息错误');
            }
            if($this->request->isPost()){
                $repair = model('repair');
                $post = Request::instance()->post();
                $validate = validate("repair");
                if(!$validate->check($post)){
                    return $this->error($validate->getError());
                }
                $data = $repair->save($post,['id'=>$id]);
                if($data){
                    $this->success('修改成功', url('index'));
                } else {
                    $this->error($repair->getError());
                }
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑报修信息';
            return $this->fetch("edit");
            }

    /**
     * 删除
     */
    public function Del(){
        $id = array_unique((array)input('id/a',0));
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('id' => array('in', $id) );
        if(\think\Db::name('repair')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
    }
