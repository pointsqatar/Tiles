<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$app			= JFactory::getApplication();
$doc			= JFactory::getDocument();
$templateparams	= $app->getTemplate(true)->params;
$template = $app->getTemplate();
$base = $doc->baseurl;
$path = $base.'/templates/'.$template;
vmJsApi::css('chosen');

?>
<div class="mod-currency-selector <?php echo $params->get('moduleclass_sfx'); ?>">	
	<form action="<?php echo vmURI::getCleanUrl() ?>" method="post" class="form-inline">
		<?php echo $text_before ? '<label>' . $text_before . '</label>' : '' ?>
		<?php echo JHTML::_('select.genericlist', $currencies, 'virtuemart_currency_id', 'class="inputbox vm-chzn-select-cur form-control"', 'virtuemart_currency_id', 'currency_txt', $virtuemart_currency_id) ; ?>
	    <!-- <input class="button btn btn-default" type="submit" name="submit" value="<?php /*echo JText::_('MOD_VIRTUEMART_CURRENCIES_CHANGE_CURRENCIES')*/ ?>" /> -->
	</form>
</div>
<script type="text/javascript" src="<?php echo $path ?>/js/chosen.jquery.min.js"></script>

<script>
	updateChosenDropdownLayout = function() {
		jQuery(function($) {
			$(".vm-chzn-select-cur").chosen();
		});
	}
	jQuery(document).ready(function(){
		updateChosenDropdownLayout();
	});
	jQuery('#virtuemart_currency_id').change(function(){
		jQuery(this).parent('form').submit();
	})
</script>