<?php
namespace app\home\behavior;

class CheckLogin
{
    public function run(&$params)
    {
        $user_id =session('user_id');
        if(empty($user_id)){
            $url = url('home/user/login');
            echo <<<eof
            <script type="text/javascript">
                window.top.location.href="$url";
              </script>
eof;
            exit;

        }
    }
}