<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
 <head>
  <title>库存管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="/assets/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
        <a href="/#menu" title="文档库地址" ><!-- 仅仅为了提供文档的快速入口，项目中请删除链接 -->
          <span class="lp-title-port">库存</span><span class="dl-title-text">管理系统</span>
        </a>
      </div>
      <?php echo ($arr1); echo ($arr2); ?>
    <!-- <div class="dl-log">欢迎您，<span class="dl-log-user">**.**@alibaba-inc.com</span><a href="###" title="退出系统" class="dl-log-quit">[退出]</a><a href="http://http://www.builive.com/" title="文档库" class="dl-log-quit">文档库</a> -->
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title">贴心小秘书<s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
        <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">首页</div></li>
<!--         <li class="nav-item"><div class="nav-item-inner nav-order">表单页</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-inventory">搜索页</div></li> -->
        <li class="nav-item"><div class="nav-item-inner nav-supplier">库存详情</div></li>
        <!-- <li class="nav-item"><div class="nav-item-inner nav-marketing">AJAX库存</div></li> -->
      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="/assets/js/bui.js"></script>
  <script type="text/javascript" src="/assets/js/config.js"></script>

  <script>
    BUI.use('common/main',function(){
      var config = [{
          id:'menu', 
          homePage : 'code',
          menu:[{
              text:'首页内容',
              items:[
                {id:'code',text:'后台首页',href:'/index.php/Home/Index/main',closeable : false},
                // {id:'main-menu',text:'顶部导航',href:'main/menu.html'},
                // {id:'second-menu',text:'右边菜单',href:'main/second-menu.html'},
                // {id:'dyna-menu',text:'动态菜单',href:'main/dyna-menu.html'}
              ]
            }]
          },
          // {
          //   id:'form',
          //   menu:[{
          //       text:'表单页面',
          //       items:[
          //         {id:'code',text:'表单代码',href:'form/code.html'},
          //         {id:'example',text:'表单示例',href:'form/example.html'},
          //         {id:'introduce',text:'表单简介',href:'form/introduce.html'},
          //         {id:'valid',text:'表单基本验证',href:'form/basicValid.html'},
          //         {id:'advalid',text:'表单复杂验证',href:'form/advalid.html'},
          //         {id:'remote',text:'远程调用',href:'form/remote.html'},
          //         {id:'group',text:'表单分组',href:'form/group.html'},
          //         {id:'depends',text:'表单联动',href:'form/depends.html'}
          //       ]
          //     },{
          //       text:'成功失败页面',
          //       items:[
          //         {id:'success',text:'成功页面',href:'form/success.html'},
          //         {id:'fail',text:'失败页面',href:'form/fail.html'}
                
          //       ]
          //     },{
          //       text:'可编辑表格',
          //       items:[
          //         {id:'grid',text:'可编辑表格',href:'form/grid.html'},
          //         {id:'form-grid',text:'表单中的可编辑表格',href:'form/form-grid.html'},
          //         {id:'dialog-grid',text:'使用弹出框',href:'form/dialog-grid.html'},
          //         {id:'form-dialog-grid',text:'表单中使用弹出框',href:'form/form-dialog-grid.html'}
          //       ]
          //     }]
          // },{
          //   id:'search',
          //   menu:[{
          //       text:'搜索页面',
          //       items:[
          //         {id:'code',text:'搜索页面代码',href:'search/code.html'},
          //         {id:'example',text:'搜索页面示例',href:'search/example.html'},
          //         {id:'example-dialog',text:'搜索页面编辑示例',href:'search/example-dialog.html'},
          //         {id:'introduce',text:'搜索页面简介',href:'search/introduce.html'}, 
          //         {id:'config',text:'搜索配置',href:'search/config.html'}
          //       ]
          //     },{
          //       text : '更多示例',
          //       items : [
          //         {id : 'tab',text : '使用tab过滤',href : 'search/tab.html'}
          //       ]
          //     }]
          // },
          {
            id:'detail',
            homePage : 'code',
            menu:[{
                text:'详情页面',
                items:[
                  {id:'code',text:'库存详情',href:'/index.php/Home/stock/index'},
                  {id:'code1',text:'添加库存',href:'/index.php/Home/stock/stock'},
                  {id:'code2',text:'入库库存',href:'/index.php/Home/stock/index?stock=1'},
                  {id:'code3',text:'出库库存',href:'/index.php/Home/stock/index?stock=0'},
                ]
              },{
                text:"库存导出",
                items:[
                {id:'code',text:'导出全部库存',href:'/index.php/Home/Excel/expUser'},
                {id:'code',text:'导出出库库存',href:'/index.php/Home/Excel/expUser?page=1'},
                {id:'code',text:'导出入库库存',href:'/index.php/Home/Excel/expUser?page=2'},
                ]
              }]
          }];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
  <div style="text-align:center;">
</div>
 </body>
</html>