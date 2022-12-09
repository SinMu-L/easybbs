# easybbs


无js的论坛

相关资料：https://learnku.com/laravel/t/72462

模仿：https://laravel-agreper.xuchunyang.cn/forum/1/thread/1
> github源码地址：https://github.com/xuchunyang/laravel-agreper

前端脚手架:https://learnku.com/docs/laravel/7.x/frontend/7472#33dd85



### 1. 角色
在论坛中，将会出现以下角色

- 游客 ---- 未登录的用户
- 用户 ---- 注册的用户，没有多余的权限
- 管理员 ---- 管理站点，最高的权限

角色的权限从低到高，高权限的用户将包含权限低的用户权限。


### 2. 信息结构
主要信息有：
- 用户 ---- 模型名称 User;
- 论坛 ---- 模型名称 Forum, 我理解为分类，但是因为我代码已经写好了，就不修改了,一个论坛板块包含多个话题；
- 帖子 ---- 模型名称 Topic, EasyBBS应用中最核心的数据；
- 评论 ---- 模型名称 Comment, 针对某个帖子的回复，一个帖子可以有多个评论。


### 3. 动作
角色与信息之间的互动称为用户『动作』, 动作主要有以下几个：
- 创建 Create
- 查看 Read
- 编辑 Update
- 删除 Delete



## 用例
排序后的高权限角色适用于前面的角色的用例. 例如管理员可以执行包括游客和用户的操作

### 1. 游客
- 游客可以查看分类列表;
- 游客可以查看某个分类下面的所有帖子;
- 游客可以通过注册按钮创建用户;
- 游客可以查看用户的个人页面.
    
### 2. 用户
- 用户可以在分类下面发布的所有帖子;
- 用户可以回复所有的帖子;
- 用户可以编辑自己的个人资料.
    
    
### 3. 管理员
- 管理员可以访问后台;
- 管理员可以编辑分类.



-----------------------------------------

## 开发细节
   - 评论是无限极评论，评论的展示使用的是这个包[ `bluem/tree` ](https://github.com/BlueM/Tree)
   - 时间显示为 xxx天前
   - 登录注册页面还是自己写


总共有4个对象：用户、话题、评论、论坛

论坛(forum_name,description)

话题(topic,author,自动维护创建时间,评论数)

评论(content,topic_id,pid,自动维护时间,user_id)

论坛(1) ---- 话题(n)

话题(1) ---- 评论(n)


路由中间件是个好东西。

我只需要将 founder 中间件放在路由上，就可以隔绝所有的非 founder 角色隔离

后台页面写起来也是体力活儿了。就没有继续写后台了。

说不定后面会有更棒的小伙伴来优化。



----------------------------------------------------

## 安装并运行

PHP7 +

下载代码
```shell
git clone git@github.com:SinMu-L/easybbs.git easybbs
cd easybbs
```

安装依赖
```shell
composer install
```

获取本地配置文件
```shell
cp .env.example .env
```

编辑 .env 文件，设置数据库，比如 MySQL
```shell
# env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=easybbs
DB_USERNAME=root
DB_PASSWORD=123456

```

生成密钥
```shell
php artisan key:generate
```

新建数据库表并填充数据, 如果有红色提示“Migration not found: 2022_11_01_203322_create_forums_table” 之类的问题，忽略就行，不影响最终的效果。issue: https://github.com/laravel/framework/issues/23789
```shell
php artisan migrate_in_order

// 默认管理员用户名：test ，默认管理员密码：password
```



运行网站
```shell
php artisan serve
```
