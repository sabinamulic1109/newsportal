 


<div id="pr__application__form" class="pr__contact__form uk-modal-full uk-modal" data-uk-modal="" style="" id="PRapplicationForm">
            <div class="uk-modal-dialog" data-uk-height-viewport="" style="min-height: calc(100vh);">
                <div class="form-outer">
                    <div class="uk-container uk-container-xsmall">
                        <div class="form-inner uk-position-relative">
                            <button class="uk-modal-close-full uk-close uk-icon" type="button" data-uk-close="ratio: 2;"><span><?php echo $contactForm['close']; ?></span><svg width="28" height="28" viewBox="0 0 14 14" ></svg></button>
                            <h2 class="uk-modal-title uk-h1"><?php echo $applicationForm['title']; ?></h2>
                            <p><?php echo $applicationForm['subTitle']; ?></p>
							
							
							
                            <form  method="post"  class="pr__application pr__form" enctype="multipart/form-data" id="applicationForm">
                            <input type="hidden" id="g-token2" name="g-token2">
                                <div class="pr__form__group">
                                    <label for="name2"><?php echo $applicationForm['name']; ?> <span class="required">*</span></label>
                                    <input class="pr-input" id="name2" name="name2" type="text" require>
                                </div>
                                <div class="pr__form__group">
                                    <label for="email"><?php echo $applicationForm['mail']; ?> <span class="required">*</span></label>
                                    <input class="pr-input" id="email2" name="email2" type="text" require>
                                </div>
                                <div class="pr__form__group">
                                    <label for="job"><?php echo $applicationForm['jobsTitle']; ?></label>
                                    <?php 
                                    $hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "portal";
 $conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
    $query ="SELECT naziv FROM jobs";
    $result = $conn->query($query);
    if($result->num_rows> 0){
      $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>
                                    <select class="uk-select" id="naziv" name="naziv">
                                        <option class="text-muted option" hidden><?php echo $applicationForm['select']; ?></option>
                            

                                          <?php 
                                    foreach ($options as $option) {
                                                                         ?>
                               <option><?php echo $option['naziv']; ?> </option>
                                      <?php 
                                                   }
                                                  ?>                              
                                    </select>
                                </div>
                    
                                <div class="pr__form__group">
                                    <label for="file"><?php echo $applicationForm['attach']; ?></label>
                                    <input  class="fileInput" id="file" name="file" type="file" accept=".docx,.doc,.pdf"  >
                                 </div>

                            

                                <p class="pr__form__group uk-margin-large">
                                    <button class="uk-button uk-button-large uk-button-primary" type="submit" name="appsubmit" id="appsubmit" ><?php echo $applicationForm['button']; ?></button>
                                </p>
                            </form>
							
							
							
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Contact Form Popup End -->



		
	
  

