<?php
namespace app\home\controller;

use app\home\model\Document;
use app\home\model\Owner;
use app\user\model\Member;
use think\Request;
use think\Validate;


class Service extends Home
{
    /**
     * 小区通知列表
     * @return mixed
     */
    public function Index(){
        $Document = new Document();
        $list = $Document->lists(44);
        if(false === $list){
            $this->error('获取列表数据失败！');
        }
        $this->assign('list', $list);
       return $this->fetch();
    }

    /**
     *小区通知详情
     */
    public function Detail($id = 0){
        /* 标识正确性检测 */
        if(!($id && is_numeric($id))){
            $this->error('文档ID错误！');
        }
        /* 获取详细信息 */
        $Document = new Document();
        $info = $Document->detail($id);
        if(!$info){
            $this->error($Document->getError());
        }
        /* 更新浏览数 */
        $map = array('id' => $id);
        $Document->where($map)->setInc('view');
        /* 模板赋值并渲染模板 */
        $this->assign('info', $info);
        return $this->fetch();
    }

    /**
     * 导航服务首页
     * @return mixed
     */
    public function Service(){
        return $this->fetch();
    }

    /**
     * 关于我们
     * @return mixed
     */
    public function About(){
        $id =142;
        $Document = new Document();
        $info = $Document->detail($id);
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * 业主认证
     */
    public function Owner(){
        $uid= is_login();
        if($uid){
            $user = Member::get($uid);
            $owner = $user->owner;
            if($owner){
                $this->error('你已经认证','home/index/index');
            }else{
                if (request()->isPost()){
                    $repair = new Owner();
                    $post = Request::instance()->post();
                    $validate = new Validate([
                        ['name', 'require', '姓名不能为空'],
                        ['tel', 'require', '电话不能为空'],
                        ['tel', 'number|min:11|max:11', '请输入11位电话'],
                        ['number', 'require', '身份证号不能为空'],
                        ['number', 'number|min:18|max:18', '身份证号格式不正确'],
                        ['door', 'require', '房号不能为空'],
                    ]);
                    if(!$validate->check($post)){
                     $this->error($validate->getError());
                    }
                    $repair->uid = $uid;
                    $data = $repair->save($post);
                    $user->owner = 1;
                    $user->save();
                    if($data){
                        $this->success('认证成功', url('home/index/index'));
                    } else {
                        $this->error($repair->getError());
                    }
                }
               return $this->fetch();
            }
        }else{
            $this->error('请先登录','user/login/index');
        }
    }


       public function life(){
           $Document = new Document();
           $list = $Document->whereOr('category_id',43)->whereOr('category_id',44)->whereOr('category_id',45)->whereOr('category_id',46)->select();
           if(false === $list){
               $this->error('获取列表数据失败！');
           }
//           var_dump($list);die;
           $this->assign('list', $list);
           return $this->fetch();
    }

}