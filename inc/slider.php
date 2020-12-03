	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">

				<?php
				$getLastAdidas = $product->getLastestAdidas();
				if($getLastAdidas)
				{
					while($resultAdidas = $getLastAdidas->fetch_assoc())
					{
				?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php"> <img src="admin/uploads/<?php echo $resultAdidas['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Adidas</h2>
						<p><?php echo $resultAdidas['productName']?></p>
						<div class="button"><span><a href="details.php?proid=<">Add to cart</a></span></div>
				   </div>
			   </div>		
			   	<?php
		}}
			?>	
		

				<?php
				$getLastNike = $product->getLastestNike();
				if($getLastNike)
				{
					while($resultNike = $getLastNike->fetch_assoc())
					{
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						   <img src="admin/uploads/<?php echo $resultNike['image']?>" alt="" />
					</div>
					<div class="text list_2_of_1">
						  <h2>Nike</h2>
						  <p><?php echo $resultNike['productName']?></p>
						  <div class="button"><span><a href="details.php">Add to cart</a></span></div>
					</div>
				</div>
			</div>
				   	<?php
		}}
			?>	

			<?php
				$getLastConverser = $product->getLastestConverse();
				if($getLastConverser)
				{
					while($resultConverser = $getLastConverser->fetch_assoc())
					{
				?>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php">  <img src="admin/uploads/<?php echo $resultConverser['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Converser</h2>
						 <p><?php echo $resultConverser['productName']?></p>
						<div class="button"><span><a href="details.php">Add to cart</a></span></div>
				   </div>
			   </div>	
			   	<?php
		}}
			?>			


			<?php
				$getLastNew_Balance= $product->getLastestNew_Balance();
				if($getLastNew_Balance)
				{
					while($resultgetLastNew_Balance = $getLastNew_Balance->fetch_assoc())
					{
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php"><img src="admin/uploads/<?php echo $resultgetLastNew_Balance['image']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>New Balance</h2>
						   <p><?php echo $resultgetLastNew_Balance['productName']?></p>
						  <div class="button"><span><a href="details.php">Add to cart</a></span></div>
					</div>
				</div>
			</div>
				   	<?php
		}}
			?>			
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	