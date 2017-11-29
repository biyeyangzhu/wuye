<?php
namespace app\home\controller;

use app\home\model\Document;
use app\home\model\Picture;
use think\Db;


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
    public function Index1($page){
        $Document = new Document();
        $page = $page*3;
        $list = $Document->lists(43,$page);
//获取封面

        if($list){
            $html='';
            foreach ($list as $item){
                $img = Db::name('picture')->where('id',$item['cover_id'])->select();
                $img[0]['path']=  $img[0]['path']?$img[0]['path']:'/static/static/nopic.jpg';
                $html.=  '<div class="container-fluid" id="2">
        <div class="row noticeList">
            <a href="/public/home/notice/detail/id/'.$item['id'].'.html">
            <div class="col-xs-2">
                <img class="noticeImg" src="/public'.$img[0]['path'].'" />
            </div>
            <div class="col-xs-10">
                <p class="title">'.$item['title'].'</p>
                <p class="intro">'.$item['description'].'</p>
                <p class="info">浏览: '.$item['view'].' <span class="pull-right">'.$item['create_time'].'</span> </p>
            </div>
            </a>
        </div>
    </div>';
            }
            return $html;
        }else{
            return null;
        }

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