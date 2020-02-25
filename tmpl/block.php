<div class="ivacms_last_guest block">
<?php if($params['zag'] !=''){?>
<div class="h3 text-center"><?php echo $params['zag'];?></div>
<?php }?>
<div class="row">
<?php foreach($content as $con){ ?>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="h6 subject"><?php echo $con['title'];?></div>
		<?php if($con['img'] !=''){?>
		<div class="image lead"><img <?php if($params['img_class'] !=''){?>class="<?php echo $params['img_class'];?>"<?php }?> <?php if($params['img_width'] !=''){?>width="<?php echo $params['img_width'];?>"<?php }?> src="<?php echo $con['img'];?>" alt="<?php echo $con['title'];?>"></div><?php }?>
		<div class="message">				
		<?php echo $con['content'];?>
		</div>
	</div>
<?php } ?>
</div>			

<?php if(isset($params['button'])){?>
	<div class="row button">
	<a class="btn btn-primary" href="<?php if($params['button_link'] !=''){?><?php echo $params['button_link'];?><?php }else{?><?php echo JRoute::_('index.php?option=com_phocaguestbook');?><?php }?>" rel="alternate"><?php echo $params['button_name'];?></a>
	</div>
<?php } ?>
		
</div>
