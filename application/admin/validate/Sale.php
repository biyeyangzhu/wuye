<?php
namespace app\admin\validate;
use think\Validate;

class Sale extends Validate{

    protected $rule = [
        ['price', 'require', '价格不能为空'],
        ['tel', 'require', '电话不能为空'],
        ['tel', 'number|min:11|max:11', '请输入11位电话'],
        ['title', 'require', '标题不能为空'],
    ];
}