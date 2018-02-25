<?php $pageTitle = 'Categories';
	session_start();
	include 'init.php'; ?>
	<div class="container">
		<h1 class="text-center"><?php echo str_replace('-', ' ', $_GET['pagename']); ?></h1>
		<div class="row">
		<?php 
			foreach (getItems($_GET['pageid']) as $item) {
				echo '<div class="col-md-3 col-sm-6">';
					echo '<div class="thumbnail item-box">';
						echo '<span class="price-tag">'. $item['Price'] .'</span>';
						echo '<img src="image.png" alt="'. $item['ItemName'] .' Image"/>';
						echo '<h3>'. $item['ItemName'] .'</h3>';
						echo '<p>'. $item['ItemDescription'] .'</p>';
					echo '</div>';
				echo '</div>';
			}

		?>
		</div>
	</div>

<?php include $tpl . 'footer.php'; ?>