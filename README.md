# 县域电商平台 #
============================


[县域电商平台](https://github.com/wtbu703/xyds "县域电商平台")是一个使用Yii2开发的为示范县提供服务的电商平台


## 项目结构 ##


      assets/             用于存放前端资源包PHP类
      commands/           命令行
	  common/       	  公共目录
      config/             配置
      controllers/        控制器
      mail/               与邮件相关的布局文件
      models/             模型
      runtime/            运行时临时文件
      tests/              存放测试类
      vendor/             第三方的程序
      views/              视图
      web/                Web服务器可以访问的目录



## 安装环境 ##


本项目需要PHP版本大于等于 5.4.0.

开启openssl扩展.

开启open_short _tags配置.




## 配置信息 ##


### Database

修改 `config/db.php` 为你的实际环境:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=xyds',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```

在本地新建名为xyds的数据库，字符集为utf8-unicode，
还原项目目录里的xyds.psc数据库备份

或者导入xyds.sql文件


## 网站入口 ##
http://119.23.225.62/

## 关于作者 ##
武汉工商学院703工作室

李罗奥

QQ911430818

[https://github.com/liluoao](https://github.com/liluoao "Github")

[http://liluoao.blog.163.com/](http://liluoao.blog.163.com/ "李罗奥的博客")
