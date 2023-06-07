<?php
include 'main.php';
include('../config.php');
// NOTICE: THE FOLLOWING PAGE IS UNRESTRICTED AND THEREFORE WE SUGGEST YOU IMPLEMENT RESTRICTIONS BEFORE GOING PRODUCTION
// Get all subscribers from the database
$stmt = $pdo->prepare('SELECT * FROM subscribers');
$stmt->execute();
$subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Process form
if (isset($_POST['recipient'], $_POST['subject'], $_POST['template'])) {
    // From address
    $from = 'Your Company Name <noreply@yourdomain.com>';
	// Email Headers
	$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'Return-Path: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
	// Determine the subscriber
    $subscriber = null;
    foreach ($subscribers as $s) {
        if ($s['email'] == $_POST['recipient']) {
            $subscriber = $s;
        }
    }
    // Make sure subscriber exists
    if ($subscriber) {
        // Update the unsubscribe link
        $unsubscribe_link = 'https://yourwebsite.com/unsubscribe.php?email=' . $subscriber['email'] . '&code=' . sha1($subscriber['id'] . $subscriber['email']);
        // Replace the placeholder
        $template = str_replace('%unsubscribe_link%', $unsubscribe_link, $_POST['template']);
        // Send email to user
        if (mail($_POST['recipient'], $_POST['subject'], $template, $headers)) {
            exit('success');
        } else {
            exit('Failed to send newsletter! Please check your SMTP mail server!');
        }
    } else {
        exit('Invalid recipient!');
    }
}
?>
<?php
include 'main.php';
// NOTICE: THE FOLLOWING PAGE IS UNRESTRICTED AND THEREFORE WE SUGGEST YOU IMPLEMENT RESTRICTIONS BEFORE GOING PRODUCTION
// Get all subscribers from the database
$stmt = $pdo->prepare('SELECT * FROM subscribers');
$stmt->execute();
$subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Send Newsletter</title>
        <link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
		<style> 
        html {
            padding: 30px;
            height: 10%;
        }
        </style>
	</head>
	<body style="background-image: url('../img/bg-login.jpg');   
  background-size: cover;font-family: 'Century Gothic'; size: auto;
  
  ">

		<form class="send-newsletter-form" method="post" action="">

			<h1><i class="fa-regular fa-envelope"></i>Pošalji Newsletter</h1>

			<div class="fields">

                <label for="recipients">Preplatnici</label>
                <div class="multi-select-list">
                    <?php foreach ($subscribers as $subscriber): ?>
                    <label>
                        <input type="checkbox" class="recipient" name="recipients[]" value="<?=$subscriber['email']?>"> <?=$subscriber['email']?>
                    </label>
                    <?php endforeach; ?>
                </div>

                <label for="subject">Predmet</label>
                <div class="field">
                    <input type="text" value="NAJNOVIJE VIJESTI" id="subject" name="subject" placeholder="Subject" required>
                </div>
             <?/*php 
				$sql = "SELECT * from novosti where visible = 1 order by id desc limit 1"; 
				$result = mysqli_query ($conn,$sql);
				$novosti = array();	
				while($row = mysqli_fetch_array($result)){
					$novosti[] = $row;
				}*/
				?>
                <label for="template">Sadržaj</label>
                <div class="field">
                    <textarea id="template" name="template" 
                    placeholder="Napiši.." required>
                   <?PHP /* ECHO $row['naslov'];*/?>
                </textarea>
                </div>

                <div class="responses"></div>

			</div>

			<input id="submit" type="submit" value="Pošalji">

		</form>
   <!--     
<a href="https://codeshack.io/unsubscribe.php?email=david@codeshack.io&code=d864fa1be1a44abae7e4cfe9d0903cbea163d0fc">
    Unsubscribe</a>-->

        <script>

// Retrieve the form element
const newsletterForm = document.querySelector('.send-newsletter-form');
// Declare variables
let recipients = [], totalRecipients = 0, recipientsProcessed = 0;
// Form submit event
newsletterForm.onsubmit = event => {
    event.preventDefault();
    // Retrieve all recipients and delcare as an array
    recipients = [...document.querySelectorAll('.recipient:checked')];
    // Total number of selected recipients
    totalRecipients = recipients.length;
    // Total number of recipients processed
    recipientsProcessed = 0;
    // Clear the responses (if any)
    document.querySelector('.responses').innerHTML = '';
    // Temporarily disable the submit button
    document.querySelector('#submit').disabled = true;
    // Update the button value
    document.querySelector('#submit').value = `(1/${totalRecipients}) Processing...`;
};
// The below code will send a new email every 3 seconds, but only if the form has been processed
setInterval(() => {
    // If there are recipients...
    if (recipients.length > 0) {
        // Create form data
        let formData = new FormData();
        // Append essential data
        formData.append('recipient', recipients[0].value);
        formData.append('template', document.querySelector('#template').value);
        formData.append('subject', document.querySelector('#subject').value);
        // Use AJAX to process the form
        fetch(newsletterForm.action, {
            method: 'POST',
            body: formData
        }).then(response => response.text()).then(data => {
            // If success
            if (data.includes('success')) {
                // Increment variables
                recipientsProcessed++;
                // Update button value
                document.querySelector('#submit').value = `(${recipientsProcessed}/${totalRecipients}) Processing...`;
                // When all recipients have been processed...
                if (recipientsProcessed == totalRecipients) {
                    // Reset everything
                    newsletterForm.reset();
                    document.querySelector('#submit').disabled = false;
                    document.querySelector('#submit').value = `Submit`;
                    document.querySelector('.responses').innerHTML = 'Newsletter sent successfully!';
                }
            } else {
                // Error
                document.querySelector('.responses').innerHTML = data;
            }
        });
        // Remove the first item from array
        recipients.shift();
    }
}, 3000); // 3000 ms = 3 seconds
</script>

	</body>
</html>