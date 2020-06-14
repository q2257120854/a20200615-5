<?php
namespace app\dai\controller;

use think\Controller;

class Base extends Controller
{

    public function _initialize()
    {
        $request = request();
        $ac = $request->action();
        $this->assign('controller', strtolower($request->controller()));
        $this->assign('action', $ac);

        $user = model('user')->infoData([
            "user_id" => cookie('dai_id'),
        ]);
		
        if ($user['info']['user_tc'] <= 0 && $ac !== "login"&& $ac !== "up") {
            model('User')->logout();
            return $this->error('不是代理，请重新登录', url('index/login'));
        }
        $GLOBALS['dai'] = $user['info'];

        $this->assign('user', $user['info']);

    }

}
