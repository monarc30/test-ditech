<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">    

</head>
<body>

<div class="container">

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Ditech</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="..\index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="users.php">Users</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="rooms.php">Rooms</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Rented Rooms</a>
				</li>							
			</ul>
		</div>
    </nav>
    
    <div class="table-responsive">
		<table class="table">
			<thead>
				<tr><th colspan=7 style="text-align:center;"><h4>Rented Rooms Form</h4></th></tr>
				<tr style="text-align:center;">
					<th>Select the Date bellow</th>										
				</tr>
			</thead>
			<tbody>		
			</tbody>
		</table>

    </div>
    

    <div class="row">

        <div class="col col-lg-12">

            <form name="form1" id="form1" method="post">                
                <input class="form-control" type="date" name="date" id="date" onchange="getData('vendors_sales_form', '?action=get_vendor_by_date&date='+this.value);" required>
            </form>
        
        </div>
    
    </div>
    
    <div class="table-responsive">
		<table class="table">
			<thead>
                <tr style="text-align:center;"><th colspan=7><h4>Result</h4></th></tr>				
                <tr style="text-align:center;">
                    <td><strong>Date</strong></td>
                    <td><strong>Total</strong></td>
                </tr>
			</thead>
			<tbody id="result">	                
			</tbody>
        </table>
    </div>
    
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">

    function SendEmail( date,total ){

        var action = "sendEmail";

        $.ajax({
            type: "POST",
            url:"../api/sendEmail.php",
            data: { date: date, total: total, action:action },
        }).done(function(data){ 
            
            if (data=="sent") {
                alert("Email sent!");
            }
            else{
                alert("Error sending the email!");
            }
            
        }).fail(function(data){            
            alert("Error sending the email!");
        });

    }

    function getData( type, param )
    {
        $.ajax({
            url:"../api/getdataVendors.php",
            data: { type: type, param: param },
            success: function(data)
            {					
                $('#result').html(data);
            }
        })
    }	
        
	$(document).ready(function(){		
		//getData('vendors_sales_form', '?action=get_vendor_by_date');					
	});
</script>
</body>
</html>