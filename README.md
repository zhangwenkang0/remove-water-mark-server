# 全能去水印小帮手-服务端

短视频去水印系列教程服务端源码。php版

## 支持平台
抖音，B站，微博，快手，皮皮虾，火山视频，微视，最右。其中B站视频只能下载，无法去水印 

## 小程序展示
![小程序展示](https://upload-images.jianshu.io/upload_images/13046507-287263952492432c.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

可扫码预览：

![在这里插入图片描述](https://upload-images.jianshu.io/upload_images/13046507-8138532f912110df.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)


> 这里不过多介绍，我假设您有基本的编码基础，并熟悉php语言及laravel框架。

## 安装
请先确保 [composer](https://docs.phpcomposer.com/00-intro.html) 已安装。（如使用laravels，还需确认[swoole](https://wiki.swoole.com/wiki/page/6.html)扩展已安装）

>如未安装可根据链接中的官方文档进行安装

1. 克隆代码
    ```
    git clone https://github.com/wyq2214368/remove-water-mark-server.git
    ```

2. composer安装依赖
    ```
    composer install
    ```
    
   >以下的步骤是laravel及laravels的相关配置，您可以选择使用 `php artisan install` 指令一键完成。或根据相应文档完成设置
3. 创建.env文件
    ```
    cp .env.example .env
    ```
    
    编辑.env文件，设置你自己的微信小程序appi和secret
    
    ```
    WECHAT_MINI_PROGRAM_APPID=这里填你自己的appid
    WECHAT_MINI_PROGRAM_SECRET=这里填你自己的secret
    ```
    
4. 生成laravel的key
    ```
    php artisan key:generate
    ```

5. 文件夹权限设置
    ```
    chmod -R 777 storage/
    chmod -R 777 bootstrap/cache/
    ```
    >可视情况合理分配需要的权限
    
    或分配php-fpm进程用户为所有者
    ```bash
    choown -R apache:apache ./
    ```
6. 生成数据表
    请先到config/database.php文件修改数据库信息，之后执行
    ```
    php artisan migrate
    ```
    自动生成数据表    
7. 启动服务
    ```
    php artisan serve
    ```
    > 如果您不想启动laravel server而是使用laravel是服务，可以通过 `php artisan install` 指令启动laravels服务，或通过[laravels文档](https://github.com/hhxsv5/laravel-s/blob/master/README-CN.md#%E7%89%B9%E6%80%A7)自行启动
    
8. 访问并测试服务
   
   服务启动后可将小程序app.js中的globalData.apiDomain设置为： http://127.0.0.1:8000/api
    > 如您启动的laravels服务，则需要使用laravels配置的端口(默认是 5200)
    
以上，可以直接打开小程序访问了。

注意: /config/app.php文件中  'preview' => env('MP_VIDEO_PREVIEW', 1)  设置为1小程序可显示视频，设置为0不显示视频(个人小程序不允许视频，可用于规避审核)

# 小程序端
- [短视频去水印小程序源码-小程序端](https://github.com/zhangwenkang0/remove-water-mark-mp)

# 该源码完善及修改自:github源码地址
- [短视频去水印小程序源码-服务端（php）](https://github.com/wyq2214368/remove-water-mark-server)

