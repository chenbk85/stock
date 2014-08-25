<!DOCTYPE html>
<!--[if IE 8]> <html lang="ch" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="ch" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="ch"> <!--<![endif]-->
<head>
   <meta charset="utf-8" />
   <title><?php echo htmlspecialchars($this->actionName);?></title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
   <!-- data table -->

   <!-- END PAGE LEVEL PLUGIN STYLES -->

   <!-- BEGIN THEME STYLES --> 
   <link href="/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="/assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <link href="/css/round_button.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->

   <!-- BEGIN MY STYLES --> 
   <link href="/css/backadmin.css" rel="stylesheet" type="text/css"/>
   <link href="/css/stock.css" rel="stylesheet" type="text/css"/>
   <!-- END MY STYLES -->

   <script src="/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
 
   <link rel="shortcut icon" href="favicon.ico" />
</head>

<!-- BEGIN BODY -->
<!-- 横向菜单-->
<body  class="page-header-fixed <?php if(Yii::app()->params['horizontal_menu_layout'])  echo 'page-full-width';?>">
<div class="">
  <!-- BEGIN HEADER -->
  <div class="color_header header navbar navbar-inverse navbar-fixed-top">
    <div class="stock_body_center">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
        <!-- BEGIN LOGO -->  
        <a class="navbar-brand" href="/site/index">
        <img src="/images/stocktool_logo4.png" alt="logo" class="img-responsive" style="margin-top:-14px"/>
        </a>
        <!-- 横向菜单-->
        <?php if(Yii::app()->params['horizontal_menu_layout']) { ?>
          <?php $this->widget('application.modules.main.widgets.LeftMenuMetro', array('userid' => $this->userid,'allMenu'=>Yii::app()->params['close_user'],'horiz'=>Yii::app()->params['horizontal_menu_layout'])); ?>
        <?php } ?>

          <!-- BEGIN TOP NAVIGATION MENU -->
          <ul class="nav navbar-nav pull-right">
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <?php if(!empty($this->userInfo)&&$this->visitorrid!=Yii::app()->params['rid']['visitor']) {?>
            <li class="dropdown user">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              <img alt="" src="/assets/img/avatar1_small.jpg"/>
              <span class="username"><?php echo htmlspecialchars($this->userInfo["uname"]);?></span>
              <i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a href="javascript:;" id="trigger_fullscreen"><i class="fa fa-move"></i>全屏</a></li>
                <!--<li><a href="/main/user/lock"><i class="fa fa-lock"></i>锁屏</a></li>-->
                <li><a href="/main/user/logout"><i class="fa fa-kesy"></i>退出</a></li>
              </ul>
            </li>
            <?php }?>
            <!-- END USER LOGIN DROPDOWN -->
          </ul>
          <?php if(!empty($this->userid)&&$this->visitorrid==Yii::app()->params['rid']['visitor']) {?>
          <a class='r1_button r1_gray r1_medium pull-right login_button' href='/main/user/login?url=<?php echo htmlspecialchars($this->requesturl);?>&amp;isreg=1'>注册</a>
          <a class='r1_button r1_gray r1_medium pull-right signup_button' href='/main/user/login?url=<?php echo htmlspecialchars($this->requesturl);?>'>登录</a>
          <?php }?>
          <span class='pull-right stocktimer' id='nowtime'></span>
          <!-- END TOP NAVIGATION MENU -->
      </div>
    </div>
  </div> <!--header-->


  <div class="clearfix"></div>
  <!-- BEGIN CONTAINER -->
  <div class="page-container mpage_container">
    <div class="stock_body_center">
      <!-- BEGIN SIDEBAR -->
      <!-- 纵向菜单-->
      <?php if(!Yii::app()->params['horizontal_menu_layout']) { ?>
      <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->        
        <?php $this->widget('application.modules.main.widgets.LeftMenuMetro', array('userid' => $this->userid,'allMenu'=>Yii::app()->params['close_user'])); ?>
        <!-- END SIDEBAR MENU -->
      </div>
      <?php } ?>
      <!-- END SIDEBAR -->

      <!-- BEGIN PAGE HEADER-->
      <div class="row color_page_title">
        <div class="col-md-12">
          <div class="contact_content">
            <span class="contact_icon contact_group_bg"></span>
            <ul>
              <li class="contact_text">QQ群:<a id="" style="color:#1fa4c7" target="_blank" href="">254233419</a></li>
            </ul>
          </div>
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
          <!-- END PAGE TITLE & BREADCRUMB--> 
        </div>
      </div> 
      <!-- END PAGE HEADER-->

      <!-- BEGIN PAGE -->
      <div class="page-content" style='padding:5px 5px'>
          <!-- BEGIN PAGE HEADER-->

          <!-- END PAGE HEADER-->

          <div class="row">
          <div class='col-md-12'>
            <?php echo $content;?>
          </div>
          </div>
      </div>
      <!-- END PAGE -->
    </div>
  </div>
  <!-- END CONTAINER -->

  <!-- BEGIN FOOTER -->
  <div class="footer">
    <div class="stock_body_center">
      <div class="footer-inner">
          2014 &copy; 美股时代.
      </div>
      <div class="footer-tools">
          <span class="go-top">
          <i class="fa fa-angle-up"></i>
          </span>
      </div>
    </div>
  </div>
  <!-- END FOOTER -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F056c0d45e91cbb7137d76448d034d80f' type='text/javascript'%3E%3C/script%3E"));
</script>




    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->   
    <!--[if lt IE 9]>
    <script src="/assets/plugins/respond.min.js"></script>
    <script src="/assets/plugins/excanvas.min.js"></script> 
    <![endif]-->   
    <script src="/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>   
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
    <script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
    <script src="/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/js/mtime.js" type="text/javascript"></script>


    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/assets/scripts/app.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->  
    <script>
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins
         //Index.init();
         //TableAjax.init();
         /*
         Index.initJQVMAP(); // init index page's custom scripts
         Index.initCalendar(); // init index page's custom scripts
         Index.initCharts(); // init index page's custom scripts
         Index.initChat();
         Index.initMiniCharts();
         Index.initDashboardDaterange();
         Index.initIntro();
         Tasks.initDashboardWidget();
         */
         function setStockTime() {
           s='美东时间 '+getStockTime();
           $("#nowtime").text(s);
         }
         setInterval(setStockTime,1000);
       });
    </script>
    <!-- END JAVASCRIPTS -->

</div>
</body>
</html>
