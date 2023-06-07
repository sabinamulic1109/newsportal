<style>
@media only screen and (max-width:500px){
	.footer-copyright{
		font-size:14px;
	}
	footer.page-footer .footer-copyright{
		height:70px;
		line-height: 20px;
	}
}

.load-more {
	position:absolute;
	top:0;
	z-index:300;	
	cursor: pointer;
	//padding: 10px 0;
	text-align: center;
	font-weight:bold;
	width:350px;
	height:350px;
	border-bottom:none !important;
}

.load-more .help{
	width: 338px;
	position:relative;
	top:50%;
	transform:translateY(-50%)
}

.load-more .help p{
	color: #155a63;
	font-size:18px;
	text-transform:uppercase
}
.load-more .help img{
	height:280px;
}

#modalloader{
	max-width:400px; 
	min-width:400px;
}

@media only screen and (max-width:500px){
	#modalloader{
		max-width:98vw; 
		min-width:98vw;
	}
	
	.load-more .help p{
		font-size:12px;
	}
	 
	 .page-footer .container {
		   width:100vw !important
		}
		
		
}
</style>


<div class="modal" id="modalloader" tabindex="-1" role="dialog" style="top:50%;left:50%;transform:translate(-50%,-50%);  min-height:480px">
	<div class="modal-dialog" role="document">
		<div class="modal-content"  style="max-width:340px;min-width:340px;">

			<div class="modal-body" style="min-height:350px;padding:0!important">
				<div class="row">
					<div class="col s12">
						<div class="load-more">
							<div class="help">
								<img src="images/loading-circle.gif"/>
								<p>Your data is proccessed.</p>
								<p>Please do not reload page.</p>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>


<?php if(isset( $_SESSION['myusername'])){ ?>
	<footer class="page-footer" style="bottom:0; position:fixed; width:100%;z-index:99: overflow:hidden;">
       
	   <div class="footer-copyright" style="background-color: #941046;">
            <div class="container" >
               <div class="col-sm-6 footerCenter">
                Design and Developed by 
					<a class="grey-text text-lighten-4" href=""><img src="../login/cms/images/geologo.png" height="15px"></a>
				 
				</div>

            </div>
        </div>
    </footer>
<?php }else{ ?>
	<!-- START F1OOTER --> 
    <footer class="page-footer" style="bottom:0; background-color: #941046; position:fixed; width:100%;z-index:99; padding-left: 0pxoverflow:hidden;">
       
	   <div class="footer-copyright" style="background-color: #941046;">
            <div class="container" >
				<div class="col-sm-6 footerCenter">
                Copyright © 2022 Geosoft studio All rights reserved.
				</div>
				<div class="col-sm-6 footerRight">
                <span class="right footerRight"> Design by
					<a class="grey-text text-lighten-4" href=""><img src="cms/images/geologo.png" height="15px"></a>
				</span>
				</div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->
 <?php } ?>

<script>
$("form").submit(function (e) {
    $('#modalloader').toggle();
});


</script> 
