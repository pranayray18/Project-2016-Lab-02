<?php
require_once('start.php');
require_once('actions/linux/config.php');

$con = mysqli_connect($lab_host, $lab_user, $lab_pass, $lab_db);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$username = "admin"; //change username here to switch between admin and non-admin
$active = FALSE;    //user account is inactive
if($username == "admin")
	header('Location: adminpage.php');

$sql = "SELECT * FROM userlist WHERE username = '$username'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $hasAcc = TRUE;
    $row = mysqli_fetch_assoc($result);
    
    if ($row['status'] == "Inactive") {
        $active = FALSE;
    }
    else {
        $active = TRUE;
    }
}
else {
    $hasAcc = FALSE;
}
?>
<html>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script
        src="https://code.jquery.com/jquery-3.1.0.js"
        integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk="
    crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/account.js"></script>
    <head>
        <meta charset="UTF-8">
        <title>CK Linux Lab</title>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>

    <center><h1> Linux Lab for Windows User </h1></center>
    <br/>
    <div class="row">
        <div class="col-xs-3">
            Current status of your subscription:
            <br/>
            <br/>
            <b>Name:</b><br/>
            <b>Username:</b><br/>
            <b>Expiry:</b>
            <?php
            if ($hasAcc) {
                echo $row['expiry_date'];
            }
            else {
                echo "Not available";
            }
            ?>
            <br/>
            <b>Status:</b>
            <?php
            if ($hasAcc) {
                echo $row['status'];
            }
            else {
                echo "Not available";
            }
            ?>
            <br/>
            <br/>
            <?php
            if ($hasAcc && $active) {
                echo '<input name="delete-account" type="submit" value="Delete your account" class="btn btn-primary btn-danger">';
            }
            ?>
            <br/>
            <br/>
            <em>Note: By clicking the button, you agree to the <a href="#">Terms and Conditions</a> of the site</em>

        </div>


        <div class="col-xs-9 ">
            <div class="wrapper">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                <span class="text">Home</span>
                            </a>
                        </li>
                        <li role="presentation" class="next">
                            <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">
                                <span class="text">Profile</span>
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#account" role="tab" id="account-tab" data-toggle="tab" aria-controls="samsa">
                                <span class="text">Account</span>
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#request" role="tab" id="request-tab" data-toggle="tab" aria-controls="samsa">
                                <span class="text">Request Service</span>
                            </a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">

                            <h3>Welcome to Linux Lab</h3>
                            <br/>
                            <p>With the increasing demand for Linux in our day to day college life, where we have to perform dozen of Linux program in our lab/home and our biggest nightmare is that we are a windows user.</p>
                            <p>We at campus karma aim to improve and help you with your daily campus life problem and that's why we are happy to inform you that we have started an online linux lab for the students of India. All those students who does not have a high end configured machine to support dual boot or cannot install virtual box for linux, they can use our online linux lab. No need to install any bulky software. You can register with us and we will provide you with your very own linux account on our server.</p>
                            <center>
                            <?php
                            if ($hasAcc && $active) {
                                echo '<input type="submit" name="login-account" class="btn btn-primary" value="Open Terminal">';
                            }
                            else if (!$hasAcc && !$active) { 
                                echo '<input type="submit" name="create-account" class="btn btn-primary" value="Create My Account ">';
                            }    
                            ?>
                            </center>
                            <br/>
                            <p>Hope you enjoy our service. If you have any suggestion or feedback feel free to <a href="<?php echo elgg_get_site_url() ?>contact_us">Contact Us</a></p>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                            <p>
                                Welcome to the profile page .
                            </p>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="account" aria-labelledby="account-tab">
                            <p>
                                Here you can extend your account by 90 days.
                                <br>
                                <?php
                                if ($hasAcc && $active) {
                                    echo '<input name="extend-account" type="submit" value="Extend" class="btn btn-primary">';
                                }
                                ?>
                            </p>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="request" aria-labelledby="request-tab">

                            <p>Want to request for a service ?</p>
                            <p>Kindly fill out the form below and one of our representative will contact you within the next 48 hours</p>
                            <p>Try to include as much details as possible</p>
                            <form>
                                <div class="form-group">

                                    <textarea name="message" class="form-control" rows="5" id="comment"></textarea>
                                </div>
                            </form>
                            <center><input name="request-service" type="submit" class="btn btn-info" value="Submit "></center>
                        </div>
                    </div>
                </div>

            </div>
            <!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
            <script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js'></script>

            <script src="js/index.js"></script>




        </div>

    </body>
</html>