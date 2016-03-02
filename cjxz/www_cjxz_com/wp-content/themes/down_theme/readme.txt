主题说明

一、模板
首页--index.php
软件归档页--archive-soft.php(显示所有软件)
软件分类页--taxonomy-softs.php
软件详情页--single-soft.php

专题汇总页--archive-topic.php
专题分类页--taxonomy-topics.php
专题详情页--single-topic.php

资讯分类页--archive.php
资讯详情页--signle.php

搜索页--search.php

其它文件  footer.php为底部，全站共用；header.php为头部，全站共用；seo.php用于seo（由于恢复老的seo文件，所以本文件无用）
comments.php没有此文件会报错。

其中上述的模板文件会调用partials文件夹中为模板分块。
    文件名home开头的为首页的板块。文件名为sidebar的为侧边栏共四个。
    part-links.php为友情链接，
    part-softcommend.php为软件分类页面的“本类推荐”，
    part-softtop.php为软件分类页面的专题推荐。


二、文件说明
functions.php为主题一些函数，在functions.php还加载了其它一些文件。函数基本都有注释，也不需要修改。

css文件夹中bootstrap.min.css和ashuwp_framework.css为后台的css样式
editor-style-soft.css为后台软件编辑器中的样式。
font-awesome.min.css为字体图标的css文件。

fancybox中的文件为前台“点击图片弹出框”效果的js和图片文件。

fonts文件夹中为图标字体文件，前台的某些图标为矢量字体图标。



include文件夹
include中 ashuwp_framework_core.php  ashuwp_options_feild.php  ashuwp_post_feild.php ashuwp_taxonomy_feild.php simple-term-meta.php import_export.php为ashwp_framwork框架文件，请勿修改。
include中config.php为ashuwp_framework框架的配置文件，可以修改。
include中ajax.php 处理ajax请求，如网站首页的第三块ajax翻页。后台添加专题软件时的搜索请求。
include中breadcrumbs.php为面包屑导航文件
include中post_type.php注册了“软件”“专题”两个文章类型
include中topic_metabox.php文件，后台专题添加时弹出添加软件的弹出框。
include中function.php里面是一些函数，比如页码函数、获取缩略图函数、截取文字等

include文件夹中的seo文件夹，为seo模块，从老主题中复制而来。



js文件夹
ashuwp_framwork.js为ashuwp_framwork的js文件，请勿修改。
bootstrap-modal.js为后台弹出框的js文件
bootstrap-tab.js为前台选项卡的js文件
line_title.js在后台编辑器中“横线标题”按钮的js文件
slick.js为前台滚动效果的js文件。
soft-add.js为后台专题页面中，添加专题软件的js文件
custom.js为前台的js文件
jquery.matchHeight-min.js使元素的高度相等的jquery插件，前台有调用。


plugin文件夹
三个子文件夹对应三个插件，请勿修改。

