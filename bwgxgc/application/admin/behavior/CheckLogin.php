<?php
namespace app\admin\behavior;

class CheckLogin
{
    public function run(&$params)
    {
        $com_id =session('com_id');
        if(empty($com_id)){
            $url = url('admin/user/login');
            echo <<<eof
            <script type="text/javascript">
                window.top.location.href="$url";
              </script>
eof;
            exit;

        }


    }
}