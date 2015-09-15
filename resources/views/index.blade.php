<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<style type="text/css">
	.amcharts-graph-g3 .amcharts-graph-line {
		-webkit-animation: am-pulsate-line 1s linear infinite;
		animation: am-pulsate-line 1s linear infinite;
	}
</style>
    <meta charset="utf-8"/>
    <title>Metronic | Admin Dashboard Template</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="../../assets/global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="../../assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="../../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
    <link href="../../assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout5/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/admin/layout5/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    {{--<link rel="shortcut icon" href="favicon.ico"/>--}}
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<body class="page-header-fixed page-quick-sidebar-over-content">

	<!-- BEGIN MAIN LAYOUT -->
	<div class="wrapper">
		<!-- Header BEGIN -->
	    <header class="page-header">
	        <nav class="navbar mega-menu" role="navigation">
	            <div class="container-fluid">
	                <div class="clearfix navbar-fixed-top">
		                <!-- Brand and toggle get grouped for better mobile display -->
		                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
		                    <span class="sr-only">Toggle navigation</span>
		                    <span class="toggle-icon">
		                        <span class="icon-bar"></span>
		                        <span class="icon-bar"></span>
		                        <span class="icon-bar"></span>
		                    </span>
		                </button>
		                <!-- End Toggle Button -->

	                	<!-- BEGIN LOGO -->
	                    <a id="index" class="page-logo" href="index.html">
	                        <img src="../../assets/admin/layout5/img/logo.png" alt="Logo">
	                    </a>
	                	<!-- END LOGO -->

	                </div>

	                <!-- Collect the nav links, forms, and other content for toggling -->
	                <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
	                    <ul class="nav navbar-nav text-uppercase">
	                        <li class="dropdown dropdown-fw open selected">
	                            <a href="javascript:;">
	                            	Projeto Certificação
	                            </a>
	                           	<ul class="dropdown-menu dropdown-menu-fw">
	                                {{--<li class="active"><a href="{{ url('dashboard') }}">Dashboard</a></li>--}}
	                                <li><a href="{{ action('AgendaController@ppc') }}">Personal & Professional Coaching</a></li>
	                                <li><a href="{{ action('AgendaController@executive') }}">Certified Executive Coaching</a></li>
	                                <li><a href="{{ action('AgendaController@xtreme') }}">Xtreme Positive Coaching</a></li>
	                            </ul>
	                        </li>
	                    </ul>
	                </div>
	                <!-- END NAVBAR COLLAPSE -->
	            </div>
	            <!--/container-->
	        </nav>
	    </header>
		<!-- Header END -->
		<!-- Page Content BEGIN -->
	    <div class="container-fluid">
	    	<div class="page-content">

                @yield('content')

	    	</div>
			<!-- Page Content END -->
			<!-- Copyright BEGIN -->
			<p class="copyright">Relatório de certificação {{ date('Y') }} © Sociedade Brasileira de Coaching</p>
			<!-- Copyright END -->
	    </div>

	</div>
    <!-- END MAIN LAYOUT -->
    <a href="#index" class="go2top"><i class="icon-arrow-up"></i></a>

    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="../../assets/global/plugins/respond.min.js"></script>
    <script src="../../assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="../../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript" ></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript" ></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript" ></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>

    <script src="../../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="../../assets/admin/layout5/scripts/layout.js" type="text/javascript"></script>
    <script src="../../assets/admin/layout5/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="../../assets/admin/layout5/scripts/index.js" type="text/javascript"></script>
    <script src="../../assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
    <script src="../../assets/admin/pages/scripts/charts-amcharts.js"></script>
    <script src="http://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
    <script src="http://www.amcharts.com/lib/3/plugins/responsive/responsive.min.js" type="text/javascript"></script>

    <script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="http://www.amcharts.com/lib/3/serial.js"></script>
    <script src="http://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="http://www.amcharts.com/lib/3/pie.js"></script>
    <script src="http://www.amcharts.com/lib/3/themes/none.js"></script>
    <script src="http://amcharts.com/lib/3/plugins/export/export.js" type="text/javascript"></script>
    <link href="http://amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css">
    <script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="http://www.amcharts.com/lib/3/serial.js"></script>
    <script src="http://www.amcharts.com/lib/3/themes/light.js"></script>

    <script src="../../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../../assets/admin/pages/scripts/components-jqueryui-sliders.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            Metronic.init(); // init metronic core componets
            Layout.init(); // init layout
            QuickSidebar.init();
            Tasks.initDashboardWidget();
            ComponentsjQueryUISliders.init();
            @yield('jquery')
        });
    </script>
    <!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->
</html>