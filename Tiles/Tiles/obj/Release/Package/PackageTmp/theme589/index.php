<?php defined( '_JEXEC' ) or die;
// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$params = $app->getParams();
$headdata = $doc->getHeadData();
$menu = $app->getMenu();
$active = $app->getMenu()->getActive();
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl.'/templates/'.$this->template;
$templateparams	= $app->getTemplate(true)->params;
$option = JRequest::getString('option', null);
$view = JRequest::getString('view', null);
$layout = JRequest::getString('layout', null);


// parameter
$logo = $this->params->get('logo');
$logo2 = $this->params->get('logo2');

$animation = $templateparams->get('home_animate');
  JHtml::_('bootstrap.framework');
  JHtml::_('behavior.framework');
  JHtml::_('behavior.formvalidation');

?>
<!DOCTYPE html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
  <?php 
  include_once JPATH_THEMES.'/'.$this->template.'/logic.php'; // load logic.php ?>
  <jdoc:include type="head" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"  />
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
  <?php $doc->addStyleSheet($tpath.'/css/template.css'); ?>

   <!--[if lt IE 9]><div style='clear:both;height:59px;padding:0 15px 0 15px;position:relative;z-index:10000;text-align:center;'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div><![endif]-->      
	<script type="text/javascript">
    	var animate =  '<?php echo $animation; ?>';
    </script>
    
</head>

  <?php 
	$men = $app->getMenu();
	$men      = $men->getActive();
	$pageclass   = "";
	if (is_object( $men )){ 
		$params1 =  $men->params;
		$pageclass = $params1->get( 'pageclass_sfx' );
	}
  	 if ($menu->getActive() == $menu->getDefault()) {
   		$body_class = 'home';
	}else{
		$body_class = 'all';
	}

  ?>
  
<body class="<?php echo $body_class . ' ' . $view. ' ' .$pageclass ; ?>">
  <div class="wrapper">
  <!-- Top row -->
  <?php if ($this->countModules( 'top-a' ) ): ?>
  <div class="top-row">
        <div class="top">
            <div class="row">
              <div class="col-md-4 col-lg-4 col-sm-4">
                <?php if ($this->countModules( 'top-a' )): ?>
                  <jdoc:include type="modules" name="top-a" style="vmBasic"/>
                  <!-- Top-a position -->
                <?php endif; ?>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4">
                <?php if ($this->countModules( 'top-b' )): ?>
                  <jdoc:include type="modules" name="top-b" style="vmBasic"/>
                  <!-- Top-a position -->
                <?php endif; ?>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4">
                <?php if ($this->countModules( 'top-c' )): ?>
                  <jdoc:include type="modules" name="top-c" style="vmBasic"/>
                  <!-- Top-a position -->
                <?php endif; ?>
                </div>
              </div>
          <div class="clearfix"></div>
        </div>
    </div> 
  <?php endif; ?>    
<div class="boxed-layout">    
<div id="wrapper" class="z-index">
	<div class="cotainer-top">
        <!-- Header row -->
          <div class="header-row">
             <?php if ( $this->countModules('showcase') && $layout !=='blog' && $option !=='com_search'): ?>
                <jdoc:include type="modules" name="showcase" style="vmNotitle"/>
             <?php endif; ?> 
            <div class="header">
                        <div class="logo-fleft">
                        <!-- Site logo / title / description -->
                          <div class="site-logo site-logo__header">
                            <a class="site-logo_link" href="<?php echo $this->baseurl ?>">
                              <?php if ($logo): ?>
                                <img class="site-logo_img" src="<?php echo $this->baseurl . "/" . htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
                              <?php else: ?>
                                <?php echo htmlspecialchars($templateparams->get('sitetitle'));?>
                              <?php endif; ?>
                            </a>
                            <span class="site-desc">
                              <?php echo htmlspecialchars($templateparams->get('sitedescription'));?>
                            </span>
                          </div>
                        </div>
                          <jdoc:include type="modules" name="header-a" style="vmBasic"/>
                          <div class="clearfix"></div> 
                           <jdoc:include type="modules" name="header-b" style="vmBasic"/>
                          <div class="clearfix"></div>  
                  </div>       
                 
         <div class="clearfix"></div>
        </div>
            <div class="navigation">
                <jdoc:include type="modules" name="navigation" style="raw"/>
          </div>
        <div class="content-box">       
                 <?php if ($this->countModules( 'showcase' ) || $this->countModules( 'galerific' )): ?>
                <!-- Showcase row -->
                <div class="container">
                <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="showcase-row">
                          <?php if ( $this->countModules('galerific') && $layout !=='blog' && $option !=='com_search'): ?>
                             <div id="galerific-banner">
                                 <jdoc:include type="modules" name="galerific" style="vmBasic"/>
                            </div>  
                             <div class="clearfix"></div>  
                         <?php endif; ?>    
                    </div>
                    </div>
                </div>
            </div>
                <?php endif; ?>   
          
             <?php if ( $this->countModules('latest') && $layout !=='blog' && $option !=='com_search'): ?>
                <!-- Featured row -->
                <div class="prod-row">
                  <div class="container">
                    <div class="featured">
                      <jdoc:include type="modules" name="latest" style="vmBasic"/>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <div id="custom-html">
                    <div class="container">
                        <jdoc:include type="modules" name="custom-html" style="vmBasic"/>
                    </div>
                </div>
                <!-- Main row -->
                <div class="main-row">
                    <div class="container">
                 		 <?php if ( $this->countModules('main-top') && $layout !=='blog' && $option !=='com_search'): ?>
                        <div class="main-top">
                            <jdoc:include type="modules" name="main-top" style="vmBasic"/>
                        </div>
                        <?php endif; ?>
                        <div class="main">
                            <div class="row">            
                                <?php if ($this->countModules( 'aside-left' ) && !$hide_asides): ?>
                                  <!-- Left aside -->
                                  <div class="col-md-<?php echo $aside_width; ?>">
                                    <div class="aside aside__left">
                                      <jdoc:include type="modules" name="aside-left" style="vmBasic"/>
                                    </div>
                                  </div>
                                <?php endif; ?>
        
                                <div class="col-md-<?php echo $content_width; ?>">
                                 <jdoc:include type="modules" name="breadcrumbs" style="vmNotitle"/>
                 						<?php if ( $this->countModules('content-top') && $layout !=='blog' && $option !=='com_search'): ?>
                                        <!-- Top content -->
                                        <div class="top-content">
                                            <jdoc:include type="modules" name="content-top" style="vmBasic"/>
                                        </div>
                                    <?php endif; ?>
            
                                    <!-- Main content area -->
                                    <div class="main-content">
                                    <?php if(count($app->getMessageQueue())): ?>
                                        <jdoc:include type="message" />
                                    <?php endif; ?>
                                    <jdoc:include type="component" />
                                    </div>
        
                                    <?php if ( $this->countModules('content-bottom') && $layout !=='blog' && $option !=='com_search'): ?>

                                        <!-- bottom content -->
                                        <div class="bottom-content">
                                            <jdoc:include type="modules" name="content-bottom" style="vmBasic"/>
                                        </div>
                                    <?php endif; ?>					
                                </div>
        
                                <?php if ($this->countModules( 'aside-right' ) && !$hide_asides): ?>
                                  <!-- Right aside -->
                                  <div class="col-md-<?php echo $aside_width; ?>">
                                    <div class="aside aside__right">
                                      <jdoc:include type="modules" name="aside-right" style="vmBasic"/>
                                    </div>
                                  </div>
                                <?php endif; ?>
                            </div>          
                        </div>
                    </div>
                </div>
          </div>
           <div id="push"></div>
		
    <div id="footer">
       
        <!-- Footer row -->
     <?php if ($this->countModules( 'footer-a' ) || $this->countModules( 'footer-b' ) || $this->countModules( 'footer-c' ) || $this->countModules( 'footer-d' )): ?>
        <div class="footer-row">
          <div class="container">
            <div class="footer">
              <div class="row">
                <?php if ($this->countModules( 'footer-a' )): ?>
                  <div class="col-md-3 col-lg-3 col-sm-3 border">
                    <jdoc:include type="modules" name="footer-a" style="vmBasic"/>
                  </div>
                <?php endif; ?>
                 <?php if ($this->countModules( 'footer-b' )): ?>
                  <div class="col-md-3 col-lg-3 col-sm-3 border">
                    <jdoc:include type="modules" name="footer-b" style="vmBasic"/>
                  </div>
                <?php endif; ?>
                  <?php if ($this->countModules( 'footer-c' )): ?>
                  <div class="col-md-3 col-lg-3 col-sm-6 border">
                    <jdoc:include type="modules" name="footer-c" style="vmBasic"/>
                  </div>
                <?php endif; ?>
                 <?php if ($this->countModules( 'footer-d' )): ?>
                  <div class="col-md-3 col-lg-3 col-sm-12 border item4">
                    <jdoc:include type="modules" name="footer-d" style="vmBasic"/>
                  </div>
                <?php endif; ?>
                </div>
                </div>
                </div>
        </div>
          <?php endif; ?> 
        <!-- Copyright row -->
        <div class="copyright-row">
          <div class="container">
            <?php if ($this->countModules( 'copyright' ) || $this->countModules( 'templatesettings' )): ?>
              <div class="copyright">
                 <jdoc:include type="modules" name="copyright" style="vmNotitle"/>
                 <jdoc:include type="modules" name="templatesettings" style="vmNotitle"/>
              </div>   
             <?php endif; ?>
          </div>
        </div>
    </div>
 </div>
    <div id="totopscroller"></div>
    <div class="chat-position">
        <jdoc:include type="modules" name="chat" style="vmBasic"/>
    </div>
  </div>
    <jdoc:include type="modules" name="debug" /> 
    <script type="text/javascript" src="<?php echo $tpath ?>/js/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="<?php echo $tpath ?>/js/tm-stick-up.js"></script>
    <script type="text/javascript" src="<?php echo $tpath ?>/js/scrollUp.min.js"></script>
    <script type="text/javascript" src="<?php echo $tpath ?>/js/vm/scriptsAll.js"></script>
    <?php
    if($animation == '1'){ ?>
    	<script type="text/javascript" src="<?php echo $tpath ?>/js/animate/wow.js"></script>
    <?php } ?>
   
    <script type="text/javascript" src="<?php echo $tpath ?>/js/scripts.js"></script>
</body>
</html>




