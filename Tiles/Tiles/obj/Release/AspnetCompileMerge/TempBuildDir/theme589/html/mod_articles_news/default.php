<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="newsflash<?php echo $moduleclass_sfx; ?>">
	<?php
	$count=1;
	 foreach ($list as $item) : ?>
		<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_item'); ?>
	<?php endforeach; ?>
	<?php
	//var_dump($list);
	 foreach ($list as $items) {
	 	//var_dump($items);
		//echo $items->link;

	 }
	 $itemarray=$items->link;
	$itemarray = explode(';', $itemarray);
	$itemarray=$itemarray['4'];
	//var_dump ($itemarray);
	 	//echo '<a class="readmore btn btn-primary" href="index.php?option=com_content&view=category&id='.$items->catid.'&'.$itemarray.'">'.JText::_('SEE_ALL').'<i class="fa fa-angle-right"></i></a>'; 
	 ?>
</div>
