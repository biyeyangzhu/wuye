<?php

namespace app\admin\Controller;


use think\Db;
use think\Request;

class Sale extends Admin
{
    /**
     * 列表
     * @return mixed
     */
    public function Index()
    {
        $list = Db::name('sale')->select();
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
            $sale = model('sale');
            $post = Request::instance()->post();
            $validate = validate("sale");
            if(!$validate->check($post)){
                return $this->error($validate->getError());
            }
            $sale->uid = is_login();
            unset($post['parse']);
            $post['deadline']=strtotime($post['deadline']);
            $data = $sale->save($post);
            if($data){
                $this->success('新增成功', url('index'));
            } else {
                $this->error($sale->getError());
            }
        }
            return $this->fetch("add");
        }

    /**
     * 修改
     * @param $id
     * @return mixed|void
     */
        public function Edit($id){
            $info=Db::name("sale")->find($id);
            if(false === $info){
                $this->error('获取配置信息错误');
            }
            if($this->request->isPost()){
                $sale = model('sale');
                $post = Request::instance()->post();
                $validate = validate("sale");
                if(!$validate->check($post)){
                    return $this->error($validate->getError());
                }
                unset($post['parse']);
                $data = $sale->save($post,['id'=>$id]);
                if($data){
                    $this->success('修改成功', url('index'));
                } else {
                    $this->error($sale->getError());
                }
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑报修信息';
            return $this->fetch("add");
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
        if(\think\Db::name('sale')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    }
