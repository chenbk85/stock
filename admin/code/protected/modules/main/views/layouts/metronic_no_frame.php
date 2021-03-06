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

   <!-- END MY STYLES -->

   <script src="/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
 
   <link rel="shortcut icon" href="favicon.ico" />
</head>

<!-- BEGIN BODY -->
<!-- 横向菜单-->
<body  style="background-color:white !important;" class="page-header-fixed <?php if(Yii::app()->params['horizontal_menu_layout'])  echo 'page-full-width';?>">


<div class="row">
  <div class='col-md-12'>
    <?php echo $content;?>
  </div>
</div>



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
       });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
</html>
