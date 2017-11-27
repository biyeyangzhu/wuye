<?php
namespace app\home\controller;

use app\home\model\Document;


class Notice extends Home
{
    /**
     * 小区通知列表
     * @return mixed
     */
    public function Index(){
        $Document = new Document();
        $list = $Document->lists(43);
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
}