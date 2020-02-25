<div class="ivacms_last_guest">
	<ul>	
	<?php foreach($content as $con){ ?>
        <li>
		<?php if(!empty($con['title'])){?>
		<div class="subject"><?php echo $con['title'];?></div>
		<?php }?>
		<?php if(!empty($con['img'])){?>
		<p>
		<img style="opacity:0.8" <?php if($params['img_class'] !=''){?>class="<?php echo $params['img_class'];?>"<?php }?> <?php if($params['img_width'] !=''){?>width="<?php echo $params['img_width'];?>"<?php }?> src="<?php echo $con['img'];?>" alt="<?php echo $con['title'];?>">
		</p>
		<?php }?>					
		<?php echo $con['content'];?>				
        </li>
		<?php } ?>	
	</ul>

	<?php if(isset($params['button']) and $params['type'] !=0){?>
	<div class="button_all">
	<a class="uk-button" href="<?php echo $params['button_link'];?>" rel="alternate">
	<?php echo $params['button_name'];?>
	</a>
	</div>
	<?php } ?>
</div>		