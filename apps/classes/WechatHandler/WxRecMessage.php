<?php

namespace App\WechatHandler;

/**
 * 微信消息结构类，不做任何功能，仅仅为了IDE语法自动提示.
 */
class WxRecMessage
{
    //公共属性
    public $ToUserName;
    public $FromUserName;
    public $CreateTime;
    public $MsgType;
    //普通消息公共属性
    public $MsgId;
    //事件消息公共属性
    public $Event;
    //普通消息-文本
    public $Content;
    //普通消息-图片、语音、视频、小视频、地理位置、链接
    public $MediaId;
    //普通消息-视频、小视频
    public $ThumbMediaId;
    //普通消息-图片
    public $PicUrl;
    //普通消息-语音
    public $Format;
    //普通消息-语音
    public $Recognition;
    //普通消息-地理位置
    public $Location_X;
    public $Location_Y;
    public $Scale;
    public $Label;
    //普通消息-链接
    public $Title;
    public $Description;
    public $Url;
    //事件消息-扫描带参数二维码、自定义菜单
    public $EventKey;
    //事件消息-扫描带参数二维码
    public $Ticket;
    //事件消息-上报地理位置
    public $Latitude;
    public $Longitude;
    public $Precision;
    //事件消息-群发、模板消息
    /**
     * 群发的结构，为“send success”或“send fail”或“err(num)”。但send success时，也有可能因用户拒收公众号的消息、系统错误等原因造成少量用户接收失败。err(num)是审核失败的具体原因，可能的情况如下：.
     err(10001), //涉嫌广告 err(20001), //涉嫌政治 err(20004), //涉嫌社会 err(20002), //涉嫌色情 err(20006), //涉嫌违法犯罪 err(20008), //涉嫌欺诈 err(20013), //涉嫌版权 err(22000), //涉嫌互推(互相宣传) err(21000), //涉嫌其他
     err(30001) // 原创校验出现系统错误且用户选择了被判为转载就不群发
     err(30002) // 原创校验被判定为不能群发
     err(30003) // 原创校验被判定为转载文且用户选择了被判为转载就不群发
     * 模板消息，发送状态为成功
     *
     * @var
     */
    public $Status;
    /**
     * tag_id下粉丝数；或者openid_list中的粉丝数.
     *
     * @var
     */
    public $TotalCount;
    /**
     * 过滤（过滤是指特定地区、性别的过滤、用户设置拒收的过滤，用户接收已超4条的过滤）后，准备发送的粉丝数，原则上，FilterCount = SentCount + ErrorCount.
     *
     * @var
     */
    public $FilterCount;
    /**
     * 发送成功的粉丝数.
     *
     * @var
     */
    public $SentCount;
    /**
     * 发送失败的粉丝数.
     *
     * @var
     */
    public $ErrorCount;
    /**
     * @var \App\WechatHandler\WxRecCopyrightCheckResult
     */
    public $CopyrightCheckResult;
}
class WxRecCopyrightCheckResult
{
    /**
     * 图文总数.
     *
     * @var
     */
    public $Count;
    /**
     * 各个单图文校验结果.
     *
     * @var
     */
    public $ResultList;
    /**
     * 1-未被判为转载，可以群发，2-被判为转载，可以群发，3-被判为转载，不能群发.
     *
     * @var
     */
    public $CheckState;
}
