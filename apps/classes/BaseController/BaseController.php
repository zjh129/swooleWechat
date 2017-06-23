<?php

namespace App\BaseController;

use Swoole;

/**
 * 接口基类控制器.
 *
 * @property \EasyWeChat\Foundation\Application         $wechatApp
 */
class BaseController extends Swoole\Controller
{
    /**
     * seo信息.
     *
     * @var
     */
    public $seoData;
    /**
     * 面包屑数据
     * title.
     *
     * @var
     */
    public $breadcrumbData;
    /**
     * 菜单数据.
     *
     * @var
     */
    public $menuData;
    private $msgData;

    /**
     * 构造函数.
     *
     * @param Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
    }

    /**
     * 设置网页seo标题.
     *
     * @param $title
     */
    public function setSeoTitle($title)
    {
        $this->seoData['title'] = $title;
    }

    /**
     * 添加面包屑导航.
     *
     * @param array $navData
     */
    public function addBreadcrumb($navData = [])
    {
        $this->breadcrumbData[] = $navData;
    }

    /**
     * 清空面包屑导航数据.
     */
    public function unsetBreadcrumb()
    {
        $this->breadcrumbData = [];
    }

    /**
     * 信息提示页.
     *
     * @param string $type
     * @param string $msg
     * @param string $redirectUrl
     * @param array  $otherData
     */
    public function showMsgPage($type = 'success', $msg = '', $otherData = [], $redirectUrl = '')
    {
        $this->msgData['redirectUrl'] = $redirectUrl ? $redirectUrl : $_SERVER['HTTP_REFERER'];
        $this->msgData['message']     = $msg;
        $templateFile                 = 'common/showmsg.php';
        switch ($type) {
            case 'success':
                $this->msgData['title'] = '操作成功';
                $this->view->boxClass   = 'alert-success';
                $this->view->iconClass  = 'icon-check-circle';
                break;
            case 'error':
                $this->msgData['title'] = '操作失败';
                //提示div样式名
                $this->view->boxClass = 'alert-danger';
                //提示图标样式
                $this->view->iconClass = 'icon-warning-sign';
                break;
            case 'notice':
                $this->msgData['title'] = '消息提示';
                $this->view->boxClass   = 'alert-info';
                $this->view->iconClass  = 'icon-info-sign';
                break;
            case 'warning':
                $this->msgData['title'] = '错误警告';
                $this->view->boxClass   = 'alert-warning';
                $this->view->iconClass  = 'icon-exclamation-sign';
                break;
            case '404':
                $this->msgData['title'] = '页面没找到';
                $templateFile           = 'common/show404.php';
                $this->http->status(404);
                break;
            case '500':
                $this->msgData['title'] = '服务器发生错误';
                $templateFile           = 'common/show500.php';
                $this->http->status(500);
                break;
            default:
                $this->msgData['title']  = '未知信息';
        }
        $this->seoData['title'] = $this->msgData['title'];
        $this->msgData['data']  = $otherData;
        if ($this->is_ajax) {
            $jsonStr = $this->json($this->msgData);
            $this->http->response($jsonStr);
        } else {
            $this->assignData = $this->msgData;
            $content          = $this->fetch($templateFile);
            $this->http->finish($content);
        }
    }
}
