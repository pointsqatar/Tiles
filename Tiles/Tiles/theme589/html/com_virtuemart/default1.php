<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz
 * @author RolandD,
 * @todo handle child products
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 6530 2012-10-12 09:40:36Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.module.helper' );
jimport( 'joomla.filter.filteroutput' );
$product_page_modules = JModuleHelper::getModules( 'product-page' );
vmJsApi::jDynUpdate();
vmJsApi::addJScript('updDynamicListeners',"
jQuery(document).ready(function() { // GALT: Start listening for dynamic content update.
	// If template is aware of dynamic update and provided a variable let's
	// set-up the event listeners.
	if (Virtuemart.container)
		Virtuemart.updateDynamicUpdateListeners();

}); ");

/* Let's see if we found the product */
if (empty($this->product)) {
	echo JText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo $this->continue_link_html;
	return;
}
echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));

if(JRequest::getInt('print',false)) { ?>
<body onLoad="javascript:print();">
<?php }

// addon for joomla modal Box

$MailLink = 'index.php?option=com_virtuemart&amp;view=productdetails&amp;task=recommend&amp;virtuemart_product_id=' . $this->product->virtuemart_product_id . '&amp;virtuemart_category_id=' . $this->product->virtuemart_category_id . '&amp;tmpl=component';
?>
<div class="page productdetails-view productdetails">
	<div class="page_heading product_heading">	   

	    <?php // afterDisplayTitle Event
	    echo $this->product->event->afterDisplayTitle ?>

	    <?php
	    // Product Edit Link
	   // echo $this->edit_link;
	    ?>

	    <?php
	    // PDF - Print - Email Icon
	    if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_icon')) {
		?>
	        <div class="product_icons icons">
			    <?php
			    //$link = (JVM_VERSION===1) ? 'index2.php' : 'index.php';
			    $link = 'index.php?tmpl=component&amp;option=com_virtuemart&amp;view=productdetails&amp;virtuemart_product_id=' . $this->product->virtuemart_product_id;

				echo $this->linkIcon($link . '&amp;format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_icon', false);
			    echo $this->linkIcon($link . '&amp;print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');
			    echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend', false,true,false,'class="recommened-to-friend"');
			    ?>
	        </div>
	    <?php }
	    ?>
	</div>

	<?php 
	// Back To Category Button
	if ($this->product->virtuemart_category_id) {
		$catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE);
		$categoryName = $this->product->category_name ;
	} else {
		$catURL =  JRoute::_('index.php?option=com_virtuemart');
		$categoryName = jText::_('COM_VIRTUEMART_SHOP_HOME') ;
	}
	?>
	<div class="product_back-to-category">
    	<a href="<?php echo $catURL ?>" class="product-details btn btn-default" title="<?php echo $categoryName ?>"><span><span><i class="fa fa-reply"></i><?php echo JText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO','<strong>'.$categoryName.'</strong>') ?></span></span></a>
	</div>

	<div class="row product_columns">

		<div class="col-md-4">
			<div class="product_images">
				<?php echo $this->loadTemplate('images'); ?>
			</div>
		</div>

		<div class="col-md-8">
			<div class="row product_wrap-top-right">
				<div class="col-md-7">

					<!-- Product title -->
				    <h1 class="page_title product_title"><?php echo $this->product->product_name ?></h1>

				    <div class="product_rating ratingbox">
						<?php // Output: Average Product Rating
							$ratingModel = VmModel::getModel('ratings');
							$rating = $ratingModel->getRatingByProduct($this->product->virtuemart_product_id);
						 ?>
						
                        <?php                    
						if ($this->showRating) {
							$maxrating = VmConfig::get('vm_maximum_rating_scale', 5);

							if (empty( $rating)) { ?>
								<div class="vote">
									<span class="rating-text"><?php echo JText::_('COM_VIRTUEMART_RATING') . ' ' . JText::_('COM_VIRTUEMART_UNRATED') ?></span>
								</div>
							<?php
							} else {
								?>
								<div class="vote">
									<span class="pull-left rating-icons">
		                            <?php 
		                            for ($i = 1; $i <= 5 ; $i ++ ) { 		                            	
		                            	if ($i <= $rating->rating) {
		                            		echo '<i class="fa fa-star"></i> ';
		                            	} else {
		                            		echo '<i class="fa fa-star-o"></i> ';
		                            	}                     	
		                            } ?>
		                            </span>
		                            <span class="rating-text pull-right">
		                            	<?php echo JText::_('COM_VIRTUEMART_RATING') . ' ' . round( $rating->rating) . '/' . $maxrating; ?>
		                            </span>
		                            <div class="clearfix"></div>
		                        </div>
		                <?php
							}
						} ?>
					</div>
               		 
				    <?php
				    // Product Short Description
				    if (!empty($this->product->product_s_desc)) { ?>
				       <div class="product_short-description">
						    <?php
						    /** @todo Test if content plugins modify the product description */
						    echo nl2br($this->product->product_s_desc); ?>
				        </div>
					<?php
				    } 

				    if (!empty($this->product->customfieldsSorted['ontop'])) {
						$this->position = 'ontop';
						echo $this->loadTemplate('customfields');
				    } ?>
					
					<?php 
					if (is_array($this->productDisplayShipments)) { ?>
					<div class="product_shipments">
					    <?php 
					    	foreach ($this->productDisplayShipments as $productDisplayShipment) {
								echo $productDisplayShipment;
					    	} ?>
					</div>
					<?php } ?>


					<?php if (is_array($this->productDisplayPayments)) { ?>
					<div class="product_payments">
					    <?php 
					    	foreach ($this->productDisplayPayments as $productDisplayPayment) {
								echo $productDisplayPayment;
					    	} ?>
					</div>
					<?php } 
					if ($this->product->product_availability) {
					?>			

					<div class="product_availability">
						<?php
						// Availability
						$stockhandle = VmConfig::get('stockhandle', 'none');
						$product_available_date = substr($this->product->product_available_date,0,10);
						$current_date = date("Y-m-d");
						if (($this->product->product_in_stock - $this->product->product_ordered) < 1) {
							if ($product_available_date != '0000-00-00' and $current_date < $product_available_date) {
							?>	<div class="availability">
									<?php echo JText::_('COM_VIRTUEMART_PRODUCT_AVAILABLE_DATE') .': '. JHTML::_('date', $this->product->product_available_date, JText::_('DATE_FORMAT_LC4')); ?>
								</div>
						    <?php
							} else if ($stockhandle == 'risetime' and VmConfig::get('rised_availability') and empty($this->product->product_availability)) {
							?>	<div class="availability">
							    <?php echo (file_exists(JPATH_BASE . DS . VmConfig::get('assets_general_path') . 'images/availability/' . VmConfig::get('rised_availability'))) ? JHTML::image(JURI::root() . VmConfig::get('assets_general_path') . 'images/availability/' . VmConfig::get('rised_availability', '7d.gif'), VmConfig::get('rised_availability', '7d.gif'), array('class' => 'availability')) : JText::_(VmConfig::get('rised_availability')); ?>
							</div>
						    <?php
							} else if (!empty($this->product->product_availability)) {
							?>
							<div class="availability">
							<?php echo (file_exists(JPATH_BASE . DS . VmConfig::get('assets_general_path') . 'images/availability/' . $this->product->product_availability)) ? JHTML::image(JURI::root() . VmConfig::get('assets_general_path') . 'images/availability/' . $this->product->product_availability, $this->product->product_availability, array('class' => 'availability')) : JText::_($this->product->product_availability); ?>
							</div>
							<?php
							}
						}
						else if ($product_available_date != '0000-00-00' and $current_date < $product_available_date) {
						?>	<div class="availability">
								<?php echo JText::_('COM_VIRTUEMART_PRODUCT_AVAILABLE_DATE') .': '. JHTML::_('date', $this->product->product_available_date, JText::_('DATE_FORMAT_LC4')); ?>
							</div>
						<?php
						}
						?>					
					</div>
					<?php } ?>
					<ul class="list product_details-list">

						<?php if (!empty($this->product->product_box)): ?>
							<li>							
								<strong><?php echo JText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX'); ?></strong>
								<span><?php echo $this->product->product_box; ?></span>
							</li>
				    	<?php endif; ?>

						<?php
						// Manufacturer of the Product
						if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) {
							echo $this->loadTemplate('manufacturer');
						}
						?>
					</ul>
				</div>
				<div class="col-md-5">
					<div class="product_price-wrap">
						<div class="product_prices">
							<?php  echo $this->loadTemplate('showprices'); ?>
						</div>

						<div class="product_addtocart">
                        	<?php 
								  echo shopFunctionsF::renderVmSubLayout('addtocartproduct',array('product'=>$this->product)); 
							?>
						</div>

                        
                      <?php   // Ask a question about this product
						if (VmConfig::get('ask_question', 0) == 1) {
							$askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component', FALSE);
							?>
							<div class="product_question ask-a-question">
								<a class="ask-a-question" href="<?php echo $askquestion_url ?>" rel="nofollow" ><i class="fa fa-question-circle"></i><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?></a>
							</div>
						<?php
						}
					?>
					</div>					
				</div>
				<div class="clearfix"></div>
			</div>
			<?php // event onContentBeforeDisplay
			echo $this->product->event->beforeDisplayContent; ?>

			<?php
			// Product Description
			if (!empty($this->product->product_desc)) { ?>
		        <div class="product_description product-section">
		    		<h4 class="product-section_title"><?php echo JText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></h4>
					<?php echo $this->product->product_desc; ?>
		        </div>
			<?php
		    }
				echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'normal'));

			?>
		    <?php
		    // Product Files
		    // foreach ($this->product->images as $fkey => $file) {
		    // Todo add downloadable files again
		    // if( $file->filesize > 0.5) $filesize_display = ' ('. number_format($file->filesize, 2,',','.')." MB)";
		    // else $filesize_display = ' ('. number_format($file->filesize*1024, 2,',','.')." KB)";

		    /* Show pdf in a new Window, other file types will be offered as download */
		    // $target = stristr($file->file_mimetype, "pdf") ? "_blank" : "_self";
		    // $link = JRoute::_('index.php?view=productdetails&task=getfile&virtuemart_media_id='.$file->virtuemart_media_id.'&virtuemart_product_id='.$this->product->virtuemart_product_id);
		    // echo JHTMl::_('link', $link, $file->file_title.$filesize_display, array('target' => $target));
		    // }
		    //if (!empty($this->product->customfieldsRelatedProducts)) {
				//echo $this->loadTemplate('relatedproducts');
		   // } // Product customfieldsRelatedProducts END
			
			echo shopFunctionsF::renderVmSubLayout('customfieldsrelatedprod',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products' ));
		   echo shopFunctionsF::renderVmSubLayout('customfieldsrelatedcategories',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));

		    
		    // Show child categories
		   
		   	echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot'));

		    ?>


            <?php ?><div class="product-jc product-section">
				<?php 
				defined('_JEXEC') or die('Restricted access'); 
				$comments = JPATH_SITE.'/components/com_jcomments/jcomments.php';
				if (file_exists($comments)){
					require_once($comments);
					echo JComments::show($this->product->virtuemart_product_id,'com_virtuemart', $this->product->product_name);
				}
                ?> 
			</div><?php ?>
            <?php // onContentAfterDisplay event
				echo $this->product->event->afterDisplayContent; ?>
			<?php
				echo $this->loadTemplate('reviews');
			?>
			<!-- Product-page position modules -->
            <div class="product_page-modules">
            <?php   	
	            $link2 = JRoute::_(JURI::base().'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id.'&virtuemart_category_id=' . $this->product->virtuemart_category_id);
			    //$og_price_amount = $this->$product_price;
				$og_url = $link2;
				$og_desc = strip_tags($this->product->product_s_desc);
				$og_image = JRoute::_(JURI::base().$this->product->images[0]->file_url); 
				$og_title = $this->product->product_name;
				//$app =& JFactory::getApplication();

				$doc = JFactory::getDocument();
				$doc->addCustomTag('<meta property="og:type" content="product"/>');
				$doc->addCustomTag('<meta property="og:title" content="'.$og_title.'"/>');
				$doc->addCustomTag('<meta property="og:url" content="'.$og_url.'"/>');
				$doc->addCustomTag('<meta property="og:description" content="'.$og_desc.'"/>');
				$doc->addCustomTag('<meta property="og:image" content="'.$og_image.'"/>');
				$og_title=urlencode("$og_title");
				$og_url=urlencode("$og_url");
				$og_desc=urlencode("$og_desc");
				$og_image=urlencode("$og_image");
			?>
			<div class="social-likes">
				<a class="btn btn-default btn-facebook" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=' + encodeURIComponent('<?php echo $og_title;?>') + '&amp;p[summary]=' + encodeURIComponent('<?php echo $og_desc;?>') + '&amp;p[url]=' + encodeURIComponent('<?php echo $og_url; ?>') + '&amp;p[images][0]=' + encodeURIComponent('<?php echo $og_image;?>'), 'sharer', 'toolbar=0,status=0,width=660,height=445');" href="javascript: void(0)">
				<i class="fa fa-facebook"></i><?php echo jText::_('Share'); ?>
			</a>
				<div class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</div>
				<div class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</div>
				<div class="pinterest" title="Поделиться картинкой на Пинтересте" data-media="<?php echo $og_image ?>">Pinterest</div>
			</div>

				
            </div>
			<?php
		    // Product Navigation
		    if (VmConfig::get('product_navigation', 1)) {
			?>
		        <div class="product_neighbours">
				    <?php
				    if (!empty($this->product->neighbours ['previous'][0])) {
						$prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
						echo JHTML::_('link', $prev_link, '<i class="fa fa-caret-left"></i> ' . $this->product->neighbours ['previous'][0] ['product_name'], array('rel'=>'prev', 'class' => 'previous-page'));
				    }
				    if (!empty($this->product->neighbours ['next'][0])) {
						$next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
						echo JHTML::_('link', $next_link, $this->product->neighbours ['next'][0] ['product_name'] . ' <i class="fa fa-caret-right"></i>', array('rel'=>'next','class' => 'next-page'));
				    }
				    ?>
		        </div>
		    <?php } ?>
		</div>
	</div>
</div>
<?php
echo vmJsApi::writeJS();
?>
<script>
	Virtuemart.container = jQuery('.productdetails-view');
	Virtuemart.containerSelector = '.productdetails-view';
</script>

