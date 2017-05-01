<?php
namespace App\Router;

use Swoole\IFace\Router;

class ModuleRouter implements Router
{
    function handle(&$uri)
    {
        $request = \Swoole::$php->request;
        $array = \Swoole::$default_controller;
        if (!empty($request->get["m"])){
            $array['directory'] = $request->get["m"];
        }
        if (!empty($request->get["c"]))
        {
            $array['controller'] = $request->get["c"];
        }
        if (!empty($request->get["v"]))
        {
            $array['view'] = $request->get["v"];
        }
        $request_uri = explode('/', $uri, 3);
        var_dump($request_uri);
        if (count($request_uri) < 2)
        {
            return $array;
        }
        $array['directory'] = $request_uri[0];
        $array['controller'] = $request_uri[1];
        $array['view'] = $request_uri[2];
        Tool::$url_prefix = '';
        if (isset($request_uri[3]))
        {
            $request_uri[3] = trim($request_uri[3], '/');
            $_id = str_replace('.html', '', $request_uri[2]);
            if (is_numeric($_id))
            {
                $request->get['id'] = $_id;
            }
            else
            {
                Tool::$url_key_join = '-';
                Tool::$url_param_join = '-';
                Tool::$url_add_end = '.html';
                Tool::$url_prefix = WEBROOT . "/{$request_uri[0]}/$request_uri[1]/{$request_uri[2]}/";
                Tool::url_parse_into($request_uri[3], $request->get);
            }
            $_REQUEST = $request->request = array_merge($request->request, $request->get);
            $_GET = $request->get;
        }

        return $array;

        //未命中路由器，返回false，继续执行下一个路由器
        return false;
    }
}