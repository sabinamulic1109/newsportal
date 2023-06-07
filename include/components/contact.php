



<div id="pr__contact__form" class="pr__contact__form uk-modal-full uk-modal" data-uk-modal="" style="" id="formaCont">
            <div class="uk-modal-dialog" data-uk-height-viewport="" style="min-height: calc(100vh);">
                <div class="form-outer">
                    <div class="uk-container uk-container-xsmall">
                        <div class="form-inner uk-position-relative">
                            <button class="uk-modal-close-full uk-close uk-icon" type="button" data-uk-close="ratio: 2;"><span><?php echo $contactForm['close']; ?></span><svg width="28" height="28" viewBox="0 0 14 14" ></svg></button>
                            <h2 class="uk-modal-title uk-h1"><?php echo $contactForm['title']; ?></h2>
                            <p><?php echo $contactForm['subTitle']; ?></p>
							
							
							
                            <form  method="post"  class="pr__contact pr__form" id="contactForm">
                            <input type="hidden" id="g-token" name="g-token">
                                <div class="pr__form__group">
                                    <label for="name"><?php echo $contactForm['name']; ?> <span class="required">*</span></label>
                                    <input class="pr-input" id="name" name="name" type="text" require>
                                </div>
                                <div class="pr__form__group">
                                    <label for="email"><?php echo $contactForm['mail']; ?> <span class="required">*</span></label>
                                    <input class="pr-input" id="email" name="email" type="text" require>
                                </div>
                                <div class="pr__form__group">
                                    <label for="service"><?php echo $contactForm['servicesTitle']; ?></label>
                                    <select class="uk-select" id="service" name="service">
                                        <option class="text-muted option" hidden><?php echo $servicesCategories['select']; ?></option>
                            
                                        <option><?php echo $servicesCategories['web']; ?></option>
                                        <option><?php echo $servicesCategories['graph']; ?></option>
                                        <option><?php echo $servicesCategories['video']; ?></option>
                                        <option><?php echo $servicesCategories['support']; ?></option>
                                        <option><?php echo $servicesCategories['cloud']; ?></option>
                                    </select>
                                </div>
                                <div class="pr__form__group">
                                    <label for="budget"><?php echo $contactForm['budgetTitle']; ?></label>
                                    <select class="uk-select" id="budget" name="budget">
                                        <option class="text-muted option" hidden><?php echo $servicesCategories['budget']; ?></option>
                                        <option>€250 — €500</option>
                                        <option>€500 — €1.000</option>
                                        <option>€1.000 — €5.000</option>
                                        <option>€5.000+</option>
                                    </select>
                                </div>
                                <div class="pr__form__group">
                                    <label for="message"><?php echo $contactForm['msg']; ?><span class="required">*</span></label>
                                    <textarea class="pr-textarea" id="message" name="message" require></textarea>
                                </div>

                            

                                <p class="pr__form__group uk-margin-large">
                                    <button class="uk-button uk-button-large uk-button-primary" type="submit" name="submit" id="submit" ><?php echo $contactForm['button']; ?></button>
                                </p>
                            </form>
							
							
							
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Contact Form Popup End -->
		
	
  

