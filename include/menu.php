<nav>
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbar-collapse">
		<ul class="main-menu">
			<?php 
				$sql = "SELECT * from grupe order by id"; 
				$result = mysqli_query ($con,$sql); 
				$menu = array();
				while($row = mysqli_fetch_array($result)){
					$menu[] = $row;
				}
				foreach($menu as $item){
					/* Provjeri ima li submenu */
					$idg = $item['id'];
					$sql = "SELECT * from podgrupe where grupa = $idg order by id"; 
					$result = mysqli_query ($con,$sql); 
					$submenu = array();
					while($row = mysqli_fetch_array($result)){
						$submenu[] = $row;
					}
					$ima = count($submenu);
					if($ima>0){
					?>					
					<li class="smooth-menu" id="menuit<?php echo $item['id']; ?>" onclick="showmenu('menuit<?php echo $item['id']; ?>');">
							<a href="#" ><?php echo $item['naziv']; ?></a>
							<ul class="menuUL">
									<?php 
									foreach($submenu as $item2){
									?>
									<li class="panel-outer">
										<a href="<?php echo $item2['url']; ?>"><?php echo $item2['naziv']; ?></a>
									</li>
									<?php	
									}
									?>
									
									
								</ul>
														
						</li>
					<?php
					}else{
					?>
						<li class="smooth-menu"><a href="<?php echo $item['url']; ?>"><?php echo $item['naziv']; ?></a></li>
					<?php	
					}
				}
			?>	
			<!--		
			<li class="smooth-menu" style="float:right">
				<div class="search-box-outer">
				<div class="dropdown">
					<button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
					<ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
						<li class="panel-outer">
							<div class="form-container">
								<form method="post" action="">
									<div class="form-group">
										<input type="search" name="field-name" value="" placeholder="Search Here" required>
										<button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
									</div>
								</form>
							</div>
						</li>
					</ul>
				</div>
				</div>								
			</li>
			-->
		</ul>
	</div>
</nav> <!--===  End Navbar /===-->
<script>
function showmenu(id){
	$('#'+id+' ul').toggle();
}
</script>