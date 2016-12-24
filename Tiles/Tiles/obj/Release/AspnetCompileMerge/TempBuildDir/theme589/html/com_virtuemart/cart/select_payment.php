<?php
/**
 *
 * Layout for the payment selection
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: select_payment.php 5451 2012-02-15 22:40:08Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$addClass="";


if (VmConfig::get('oncheckout_show_steps', 1)) {
    echo '<div class="checkoutStep" id="checkoutStep3">' . JText::_('COM_VIRTUEMART_USER_FORM_CART_STEP3') . '</div>';
}

if ($this->layoutName!='default') {
	$headerLevel = 1;
	if($this->cart->getInCheckOut()){
		$buttonclass = 'button';
	} else {
		$buttonclass = 'default';
	} ?>

	<form method="post" id="paymentForm" name="choosePaymentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate <?php echo $addClass ?>">
<?php 
} else {
	$headerLevel = 3;
	$buttonclass = 'vm-button';
}

	// echo "<h".$headerLevel.">".JText::_('COM_VIRTUEMART_CART_SELECT_PAYMENT')."</h".$headerLevel.">";
?>

<div class="cart_payment-select">

<div class="options-list">
<?php
    if ($this->found_payment_method) { ?>
    <ul>
    	<?php 
		foreach ($this->paymentplugins_payments as $paymentplugin_payments) {
		    if (is_array($paymentplugin_payments)) {
				foreach ($paymentplugin_payments as $paymentplugin_payment) {
				    echo '<li>' . $paymentplugin_payment . '</li>';
				}
		    }
		} ?>
	</ul>
	<?php 
    } else {
	 echo "<h1>".$this->payment_not_found_text."</h1>";
    } ?>
</div>
<div class="control-button">
	<button name="updatecart" class="btn btn-primary default button <?php echo $buttonclass ?>" type="submit"><?php echo JText::_('COM_VIRTUEMART_SAVE'); ?></button>
		<?php if ($this->layoutName!='default') { ?>
			<button class="btn btn-default  button <?php echo $buttonclass ?>" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=cancel'); ?>'" ><?php echo JText::_('COM_VIRTUEMART_CANCEL'); ?></button>
		<?php } ?>
</div>
</div>
<?php
if ($this->layoutName!='default') {
?>    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="updatecart" />
    <input type="hidden" name="controller" value="cart" />
</form>
<?php
}
?>