# Swoft安装

安装可以直接安装到电脑物理机上，注意：在windows下无法使用，请使用linux或者Docker。

* 1、直接安装到电脑上
* 2、使用Docker

### 安装 composer

阿里镜像站：https://developer.aliyun.com/composer

```shell
wget https://mirrors.aliyun.com/composer/composer.phar -O /usr/local/bin/composer --no-check-certificate
chmod a+x /usr/local/bin/composer
```

### composer 安装 Swoft

```shell
composer create-project swoft/swoft swoft
```

> 通过 Packagist国内镜像 加速国内下载速度，请参阅 https://developer.aliyun.com/composer

### 手动安装

```shell
git clone https://github.com/swoft-cloud/swoft
cd swoft
composer install --no-dev # 不安装 dev 依赖会更快一些
```

### Docker方式安装

```shell
docker run -v /Users/sphynx/Desktop/swoft:/var/www/swoft -p 18306:18306 swoft/swoft
```

### 错误解决

composer 提示证书错误

解决办法链接：https://www.sunnyos.com/