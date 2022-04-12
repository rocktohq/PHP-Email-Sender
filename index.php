<?php
    
    
    $errors = [];
    $toast = "";
    
    if (isset($_POST['send'])) {
        
        # Subject
        if(isset($_POST['subject'])) {
            $subject = trim($_POST['subject']);
            if (!$subject) {
                $errors['subject'] = 'Subject is requred!';
            }
            } else {
            $errors['subject'] = 'Subject is requred!';
        }
        
        # Receiver email
        if(isset($_POST['email'])) {
            $email = trim($_POST['email']);
            if (!$email) {
                $errors['email'] = 'Email is requred!';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Enter a valid email!';
            }
            } else {
            $errors['email'] = 'Email is requred!';
        }
        
        # Message
        if(isset($_POST['message'])) {
            $message = trim($_POST['message']);
            if (!$message) {
                $errors['message'] = 'Message is requred!';
            }
            } else {
            $errors['message'] = 'Message is requred!';
        }
        
        
        # If there is no error
        if (empty($errors)) {
            # Content type
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            # From
            $headers .= 'From: <itzmonir@gmail.com>' . "\r\n";
            
            if (mail($email, $subject, $message, $headers)) {
                $toast = "Mail sent succesfully";
                $color = "text-success";
                unset($subject);
                unset($email);
                unset($message);
                
                } else {
                $toast =  "Something went wrong!";
                $color = "text-danger";
            }
        }
    }
    
?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/css/main.css">
        
        <link rel="shortcut icon" href="assets/images/fM.png" type="image/x-icon">
        
        <title>Email Sender</title>
    </head>
    <body>
        <!-- Header -->
        <header>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand header-logo" href="#"><img src="assets/images/fMailer.png"></a>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="h2"><i class="bi bi-list"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Help</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-icon">
                                <button class="btn btn-danger" type="button" id="search-icon"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Main -->
        <main class="my-5 p-1">
            <div class="container-fluid">
                <h1 class="text-center mb-5">Send Email Secretly</h1>
                
                <!-- Toast Message -->
                <?php if (!empty($toast)) { ?>
                    <div class="position-fixed bottom-0 end-0" style="z-index: 11">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Notification</strong>
                                <small>Just Now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                <span class="h6 <?= $color; ?>" id="notification"><?php echo $toast; ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="d-sm-flex justify-content-between">
                    <div class="col-md-6 offset-md-1">
                        <div class="card">
                            <div class="card-header bg-danger text-light">Enter Information</div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="d-md-flex justify-content-between">
                                        <div class="form-floating col-md-5 mb-3">
                                            <input class="form-control<?php if(!empty($errors['subject'])) { echo ' is-invalid'; } ?>" type="text" placeholder="Subject" name="subject" id="subject" aria-label="Subject" value="<?php if (isset($subject)) echo $subject; ?>">
                                            <label for="subject">Subject</label>
                                            <?php if(!empty($errors['subject'])) {
                                                echo '<div class="invalid-feedback">';
                                                echo $errors['subject'];
                                                echo '</div>';
                                            } ?>
                                        </div>
                                        <div class="form-floating col-md-5 mb-3">
                                            <input class="form-control<?php if(!empty($errors['email'])) { echo ' is-invalid'; } ?>" type="email" placeholder="Email" name="email" id="email" aria-label="Email" value="<?php if (isset($email)) echo $email; ?>">
                                            <label for="email">Email address</label>
                                            <?php if(!empty($errors['email'])) {
                                                echo '<div class="invalid-feedback">';
                                                echo $errors['email'];
                                                echo '</div>';
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="form-floating clo-md-12">
                                        <textarea class="form-control<?php if(!empty($errors['message'])) { echo ' is-invalid'; } ?>" placeholder="Leave your message here" name="message" id="message" style="height: 100px"><?php if (isset($message)) echo $message; ?></textarea>
                                        <label for="message">Message</label>
                                        
                                        <?php if(!empty($errors['message'])) {
                                            echo '<div class="invalid-feedback">';
                                            echo $errors['message'];
                                            echo '</div>';
                                        } ?>
                                        
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" name="send" id="send" class="btn btn-danger">Send Email</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 qanda">
                        <h2 class="text-center text-danger">Questions and Answers</h2>
                        <div class="d-flex justify-content-center">
                            <div class="col-12 ms-auto">
                                
                                <div class="accordion" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                How it works?
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">We are using php <code>mail()</code> function.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Question no 2?
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsam, reprehenderit. Quia, illo? Ratione impedit unde qui obcaecati? In nam possimus nulla labore soluta minima excepturi!</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Question #3
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, dolorum et soluta sequi iste autem vitae nostrum fuga nisi atque?</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer>
            <div class="bg-dark text-light p-2">
                <p class="text-center">&copy; <span class="text-danger">f</span>Mailer&trade; 2022 by <span class="text-danger">Rockto</span>. Alright reserved.</p>
            </div>
        </footer>
        
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>                                