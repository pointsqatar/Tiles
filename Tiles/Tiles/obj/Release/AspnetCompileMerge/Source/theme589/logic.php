<?php defined('_JEXEC') or die;

// generator tag
$this->setGenerator(null);
 ?> 
<link href='//fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
<?php 
$doc->addStyleSheet($tpath.'/css/normalize.css');
$doc->addStyleSheet($tpath.'/css/font-awesome.css');
$doc->addStyleSheet($tpath.'/css/bootstrap.css');
$doc->addStyleSheet($tpath.'/css/vm/allvmscripts.css');
$doc->addStyleSheet($tpath.'/css/vm/virtuemart.css');
if($animation == '1'){
$doc->addStyleSheet($tpath.'/css/animate.css');
}

// favicon
?>

<link rel="shortcut icon" href="<?php echo $tpath; ?>/favicon.ico" />

<?php
// disable position conditions

switch ($view) {
	case 'user':
	case 'orders':
	case 'cart':
	case 'contact':
	case 'wrapper':
	case 'productdetails':
		$hide_position 	= true;
		$hide_asides 	= true;
		break;

	case 'category':
	case 'manufacturer':
	case 'vendor':
	case 'article':
	case 'archive':
	case 'categories':
	case 'featured':
	case 'login':
	case 'profile':
	case 'reset':
	case 'registration':
	case 'remind':
	case 'search':
		$hide_position 	= false;
		$hide_asides 	= false;
		break;

	case 'virtuemart':
		$hide_position 	= false;
		$hide_asides 	= false;
		break;

	default:
		$hide_position 	= false;
		$hide_asides 	= false;
		break;
}


// main row grid logic
$aside_width = 3;

$modules_in_left = $this->countModules( 'aside-left' );
$modules_in_right = $this->countModules( 'aside-right' );

if ($modules_in_left > 0 && $modules_in_right > 0 && $hide_asides == false) {
  $content_width = 12 - $aside_width * 2;
} else if ((($modules_in_left > 0 && $modules_in_right == 0) || ($modules_in_left == 0 && $modules_in_right > 0)) && $hide_asides == false){
  $content_width = 12 - $aside_width;
}  else {
  $content_width = 12;
}


// bulk module position conditions
function position_enabled($positions = array()){
	$doc = JFactory::getDocument(); 
	if (count($positions) > 0) {
		foreach ($positions as $position) {
			if ($doc->countModules( $position )) {
				return true;
			} else {
				return false;
			}

		}
	} else {
		return false;
	}
}

?>