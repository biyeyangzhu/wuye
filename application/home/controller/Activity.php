<?php
namespace app\home\controller;

use app\home\model\Document;
use app\home\model\MemberActivity;
use think\Db;


class Activity extends Home
{
    /**
     * 小区通知列表
     * @return mixed
     */
    public function Index(){
        $Document = new Document();
        $list = $Document->lists(46);
        if(false === $list){
            $this->error('获取列表数据失败！');
        }
        $this->assign('list', $list);
       return $this->fetch();
    }

    /**
     *小区通知详情
     */
    public function detail($id = 0){
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

    public function join($id=0){
        if(!is_login()){
            return "未登录";
        }else{
           $value =  Db::table('member_activity')->where('uid',is_login())->where('activity_id',$id)->find();
           if($value){
                return "已参与";
           }else{
                $model = new MemberActivity();
                $model->uid = is_login();
                $model->activity_id = $id;
                $model->save();
                return 1;
           }
        }
    }
}