# easybbs


无js的论坛

相关资料：https://learnku.com/laravel/t/72462

模仿：https://laravel-agreper.xuchunyang.cn/forum/1/thread/1

前端脚手架:https://learnku.com/docs/laravel/7.x/frontend/7472#33dd85


总共有3个对象：用户、话题、评论

话题(topic,author,自动维护创建时间,评论数)
评论(content,topic_id,pid,自动维护时间,user_id)


--------

还差下面几个功能点
1. 面包屑
2. 评论列表
    > 评论使用的是递归，在 model 里面生成原生的html，然后打印到页面上，巨卡
    > 参考资料： https://learnku.com/articles/14130/infinite-class-classification-infinite-nested-review-in-php
    > 查阅博主用的那个评论包是这个 `[bluem/tree](https://github.com/BlueM/Tree)`
    > 用起来只能说，这个包很 nice
3. 页面优化
4. 用户权限
