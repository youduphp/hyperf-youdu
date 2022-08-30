# hyperf-youdu

[![Latest Test](https://github.com/youduphp/hyperf-youdu/workflows/tests/badge.svg)](https://github.com/youduphp/hyperf-youdu/actions)
[![Latest Stable Version](https://poser.pugx.org/youduphp/hyperf-youdu/version.png)](https://packagist.org/packages/youduphp/hyperf-youdu)
[![Total Downloads](https://poser.pugx.org/youduphp/hyperf-youdu/d/total.png)](https://packagist.org/packages/youduphp/hyperf-youdu)
[![GitHub license](https://img.shields.io/github/license/youduphp/hyperf-youdu)](https://github.com/youduphp/hyperf-youdu)

## Installation

### Laravel

composer

```bash
composer require "youduphp/hyperf-youdu:^1.0"
```

publish

```bash
php bin/hyperf.php vendor:publish youduphp/hyperf-youdu
```

## Usage

### Send text message

```php
use YouduPhp\HyperfYoudu\Facades\Youdu;

Youdu::message()->send('user1|user2', 'dept1|dept2', 'test'); // send to user and dept
Youdu::message()->sendToUser('user1|user2', 'test'); // send to user
Youdu::message()->sendToDept('dept1|dept2', 'test'); // send to dept
```

### Send other type

```php
use YouduPhp\HyperfYoudu\Facades\Youdu;

Youdu::message()->send('user1|user2', 'dept1|dept2',new Text('test'));
Youdu::message()->sendToUser('user1|user2', new Image($mediaId)); // $mediaId 通过 Youdu::media()->upload() 接口获得
Youdu::message()->sendToDept('dept1|dept2', new File($mediaId)); // $mediaId 通过 Youdu::media()->upload() 接口获得
// ...
```

### Message types

|类型|类|
|--|--|
|文本|YouduPhp\Youdu\Message\App\Text|
|图片|YouduPhp\Youdu\Message\App\Image|
|文件|YouduPhp\Youdu\Message\App\File|
|图文|YouduPhp\Youdu\Message\App\Mpnews|
|链接|YouduPhp\Youdu\Message\App\Link|
|外部链接|YouduPhp\Youdu\Message\App\Exlink|
|系统|YouduPhp\Youdu\Message\App\SysMsg|
|短信|YouduPhp\Youdu\Message\App\Sms|
|邮件|YouduPhp\Youdu\Message\App\Mail|

### Upload file

```php
use YouduPhp\HyperfYoudu\Facades\Youdu;

$mediaId = Youdu::media()->upload($file, $fileType); // $fileType image代表图片、file代表普通文件、voice代表语音、video代表视频
```

### Download file

```php
use YouduPhp\HyperfYoudu\Facades\Youdu;

Youdu::media()->download($mediaId, $savePath);
```
