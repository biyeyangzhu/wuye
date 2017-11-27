<?php
namespace app\admin\validate;
use think\Validate;

class Repair extends Validate{

    protected $rule = [
        ['name', 'require', '报修人不能为空'],
        ['tel', 'require', '电话不能为空'],
        ['tel', 'number|min:11|max:11', '请输入11位电话'],
        ['address', 'require', '地址不能为空'],
        ['title', 'require', '标题不能为空'],
    ];
}