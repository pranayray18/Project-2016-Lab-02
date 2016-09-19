<?php
require_once('actions/linux/config.php');
?>

<html>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<head>
<meta charset="UTF-8">
    <title>CK Admin Page</title>
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
<b>Name : Admin</b><br/>
<b>Username:</b><br/>
<b>Expiry:</b><br/>
<b>Status:</b><br/>
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
                    
          <h3>Welcome to Linux Lab </h3>
		  
		  
		  <table class="table table-bordered">
		  <thead>
		  <th>Sl.No.</th>
		  <th>Name</th>
		  <th>UserName</th>
		  <th>Status</th>
		  <th>Expiry Date</th>
		  </thead>
		  <?php



$count=0;
//echo "count1=".$count;
$stmt = $dbh->query('SELECT * FROM userlist');
$i=1;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	?>
	<tr>
	<td><?php echo $i ?></td>
	<td><?php echo $row['name'] ?></td>
	<td><?php echo $row['username'] ?></td>
	<td><?php echo $row['status'] ?></td>
	<td><?php echo $row['expiry_date']?></td>
	</tr>
	
	
    <?php
	//echo $i.' - '.$row['name'].' - '.$row['username'].' - '.$row['status'].' - '.$row['expiry_date']; 
	$count=1;
	
	$i=$i+1;
	

}
//echo "count2=".$count;
if($count==0)
{
	echo 'No records found';
}
$count=0;
//echo "count3=".$count;


?>
		  
		  </table>

</div>
		
        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
          <p>
            Welcome to the profile page .
			</p>
        </div>
        
        <div role="tabpanel" class="tab-pane fade" id="account" aria-labelledby="account-tab">
          <p>
            Welcome to the Account page .
          </p>
        </div>
		
        <div role="tabpanel" class="tab-pane fade" id="request" aria-labelledby="request-tab">
		
		<p>
            Welcome to the Service Request Page .
          </p>
        </div>
      </div>
    </div>
  
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
</div>

</body>
</html>