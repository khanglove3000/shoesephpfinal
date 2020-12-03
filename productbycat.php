<?php
	include 'inc/header.php';
	//include 'inc/slider.php';

?>	

<?php
	
	if(!isset($_GET['catid']) || $_GET['catid'] == NULL)
	{
		echo "<script>window.location = '404.php' </script>";	
	}
	else
	{
		$id = $_GET['catid']; 
	}
	
	// if($_SERVER['REQUEST_METHOD'] == 'POST')
	// {
	// 	$catName = $_POST['catName'];
	
	// 	$updateCat = $cat->update_category($catName,$id);
	// }
?>

 <div class="main">
    <div class="content">
    	

    	<div class="content_top">
<?php
    		$name_cat = $cat->get_name_by_cat($id);
    		if($name_cat)
    		{
    			while($result_name = $name_cat->fetch_assoc())
    			{
    		
    	?>
    		<div class="heading">
    			<h3>Category: <?php echo $result_name['catName']?> </h3>
    	

    		</div>
    		<div class="clear"></div>
    			<?php
    			}}
    		?>

    	</div>
	      <div class="section group">

	      	<?php
	      	$get_product_by_cat = $cat->get_product_by_cat($id);
	      	if($get_product_by_cat)
	      	{
	      		while($result_productbycat = $get_product_by_cat->fetch_assoc())
				{	      	
	      	?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="admin/uploads/<?php echo $result_productbycat['image']?>"width="200px" alt="" /></a>
					 <h2><?php echo $result_productbycat['productName']?></h2>
					 <p><?php echo $fm->textShorten($result_productbycat['product_desc'],50)?></p>
					 <p><span class="price"><?php echo $result_productbycat['price'].' '.'VND'?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_productbycat["productId"]?>" class="details">Details</a></span></div>
				</div>

				<?php
					}
					}
					else
					{
						echo 'Category not Avaiable';
					}
				?>
			</div>

	
	
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>	
