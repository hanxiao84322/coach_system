<?php
namespace app\models;

use Yii;
//$test = HTTP_SDK::getInstance($username,$password);
class Sms {
    private $cpId = "";
    private $cpPwd = "";
    private $server = "";
    /**
     *
     * @var Sms
     */
    private static $_self = null;
    public static function getInstance($cpId, $cpPwd, $server = "http://221.122.112.136:8080") {
        if (null == self::$_self) {
            self::$_self = new Sms ( $cpId, $cpPwd, $server );
        }

        return self::$_self;
    }
    private function __construct($cpId, $cpPwd, $server) {
        $this->cpId = $cpId;
        $this->cpPwd = $cpPwd;
        $this->server = $server;
    }
    public function pushMt($phone,$serialNumber,$content,$extend) {
        $content=iconv("utf-8","gbk",$content);//这里需要转换成gbk
        $content=urlencode($content);
        $url = $this->server ."/sms/mt.jsp?cpName={$this->cpId}&cpPwd={$this->cpPwd}&phones={$phone}&spCode={$serialNumber}&msg={$content}&extNum={$extend}";
        return $this->request($url);
    }

    private function request($url)
    {
        return file_get_contents($url);
    }
}


