<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$item_heading = $params->get('item_heading', 'h4');
?>
<div class="wrap-column items_<?php echo $count++ ?>">

<?php
//var_dump($item->images);
$introarray=$item->images;
$introarray = explode(':', $introarray);
$introarray = explode(',', $introarray[1]);
$introarray = explode('"', $introarray[0]);
$introarray = explode('\/', $introarray[1]);

//var_dump ($introarray);

$introarray = implode("/", $introarray);
$intro_img = JURI::base().$introarray;

//var_dump ($introarray);
 ?>

<dd class="article_reate">
  <?php /*   <span class="date1"><?php echo JText::sprintf(JHtml::_('date', $item->publish_up, 'd')); ?></span>
    <span class="date2"><?php echo JText::sprintf(JHtml::_('date', $item->publish_up, '/')); ?></span>
    <span class="date3"> <?php echo JText::sprintf(JHtml::_('date', $item->publish_up, 'm')); ?></span> */  ?>
    <?php  echo JText::sprintf('<span>'.JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC2')).'</span>');  ?>

</dd>
<?php
 if ($params->get('item_title')) : ?>

	<<?php echo $item_heading; ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php if ($params->get('link_titles') && $item->link != '') : ?>
		<a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?>
		</a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
	</<?php echo $item_heading; ?>>

<?php endif; ?>
 <div class="home-img">
	<img alt="" src="<?php echo $intro_img  ?>" />
</div>


<?php if (!$params->get('intro_only')) : ?>
	<?php echo $item->afterDisplayTitle; ?>
<?php endif; ?>
<?php /*?><div class="home_article_category">
    <?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span>'.$item->category_title.'</span>'); ?>
</div>

<div class="home_article_published">
<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', '<span>'.JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC2')).'</span>'); ?>
</div>
 <div class="home_article_hits">
    <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', '<span>'.$item-> hits.'</span>'); ?>

</div>
<?php */?>
<div class="content">
<?php echo $item->beforeDisplayContent; ?>
<?php echo $item->introtext; ?>
</div>
<div class="clearfix"></div>
<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
	<?php echo '<a class="readmore btn btn-primary" href="' . $item->link . '">' . $item->linkText . '</a>'; ?>
<?php endif; ?>

</div>

