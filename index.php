
<?php 

    // check if user coming from a REQUEST
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);


        // Echo data for test :
       /*      echo $user ."<br>";
            echo $mail . "<br>";
            echo $phone . "<br>";
            echo $msg . "<br>"; */

        // Array of Errors :
        $formErrors = array();

        if (strlen($user) < 3) {
            $formErrors[] = 'Username must be larger than <strong>3</strong> characters';
        }
        if (strlen($msg) < 10) {
            $formErrors[] = 'Message must be larger than <strong>10</strong> characters';
        }
        if (strlen($phone) < 11) {
            $formErrors[] = 'Phone number must be equal <strong>11</strong> numbers';
        }

        // if no errors, send the mail : [mail(To, Subject of message, Headers of message, Parameters)]
        $headers = 'From: ' . $mail . '\r\n';

        if (empty($formErrors)) {

            mail('mohamedkhaled97858@gmail.com', 'Contact Form That I Created By Php', $msg, $headers);
        }
        $user = '';
        $mail = '';
        $phone = '';
        $msg = '';

        $success = "<div class='alert alert-success'>Message Sent Successfuly</div>";
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700,900,900i">    
    <title>Contact</title>
</head>
<body>

    <!-- Start Form Code -->
    <div class="container">
        <h1 class="text-center">Contact US</h1>
        <form class="contact" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <?php if (! empty($formErrors)) { ?>
            <div class="alert alert-danger" role="start">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php
                    foreach($formErrors as $error) {
                        echo $error . "<br>";
                    }
                ?>
            </div>
            <?php } ?>
            <?php if (isset($success)) { echo $success;} ?>
            <div class="form-group">
                <input 
                        class="username form-control" 
                        type="text" 
                        name="username" 
                        placeholder="Enter Your Username" 
                        value="<?php if (isset($user)) { echo $user;}?>" />
                <i class="fa fa-user fa-fw"></i>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Username must be larger than <strong>3</strong> characters
                </div>
            </div>
            <div class="form-group">
                <input 
                        class="email form-control" 
                        type="email" 
                        name="email" 
                        placeholder="Enter Valid E-mail"
                        value="<?php if (isset($user)) { echo $mail;}?>" />
                <i class="fa fa-envelope fa-fw"></i>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Email Can't be <strong>Empty</strong>
                </div>
            </div>
            <input 
                    class="phone form-control" 
                    type="text" 
                    name="phone" 
                    placeholder="Enter Your Phone Number"
                    value="<?php if (isset($user)) { echo $phone;}?>" />
            <i class="fa fa-phone fa-fw"></i>
            <div class="alert alert-danger custom-alert">
                Phone number must be equal <strong>11</strong> numbers
            </div>
            <div class="form-group">
                <textarea class="message form-control" name="message"  placeholder="Enter Your Message"><?php if (isset($user)) { echo $msg;}?></textarea>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Message must be larger than <strong>10</strong> characters
                </div>
            </div>
            <input 
                    class="btn btn-success" 
                    type="submit" 
                    value="Send Message" />
            <i class="fa fa-send fa-fw send-icon"></i>
        </form>
    </div>
    <!-- End Form Code -->


    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>