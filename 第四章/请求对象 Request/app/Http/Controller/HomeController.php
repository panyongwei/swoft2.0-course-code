<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-09-03 21:57:33
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Http\Controller;

use Swoft\Http\Message\Request;
use Swoft\Http\Message\Upload\UploadedFile;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * @Controller()
 */
class HomeController
{

    /**
     * @RequestMapping(route="/uri")
     */
    public function uri(Request $request)
    {
        print_r($request->getUri());
    }

    /**
     * @RequestMapping(route="/head")
     */
    public function head()
    {
        $request = context()->getRequest();
        print_r($request->getHeaders());
        echo $request->getHeaderLine("postman-token") . "\n";
        return context()->getResponse()->withData($request->getHeaders());
    }

    /**
     * @RequestMapping(route="/get")
     */
    public function get()
    {
        $request = context()->getRequest();
        return context()->getResponse()->withData($request->get());
    }

    /**
     * @RequestMapping(route="/post")
     */
    public function post()
    {
        $request = context()->getRequest();
        return context()->getResponse()->withData($request->post());
    }

    /**
     * @RequestMapping(route="/input")
     */
    public function input()
    {
        $request = context()->getRequest();
        return context()->getResponse()->withData($request->input());
    }

    /**
     * @RequestMapping(route="/upfile")
     */
    public function upfile()
    {
        $request = context()->getRequest();
        $files = $request->getUploadedFiles();
        print_r($files);
        /** @var UploadedFile $file */
        $file = $files['f'];
        $file->moveTo("@runtime/file/{$file->getClientFilename()}");
        return context()->getResponse()->withData($files);
    }
}
