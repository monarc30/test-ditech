<?php
	session_start();
?>
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
					<a class="nav-link" href="..\index.php">Login</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="">Select Rooms</a>
				</li>							
			</ul>
		</div>
	</nav>

    <div class="table-responsive">
		<table class="table">
			<thead>
                <tr style="text-align:center;"><th colspan=7><h4>Rented Rooms</h4></th></tr>				
                <tr style="text-align:center;">
                    <td><strong>User</strong></td>
                    <td><strong>Room</strong></td>
                    <td><strong>Start</strong></td>
                    <td><strong>End</strong></td>
                </tr>
			</thead>
			<tbody id="result">	                
			</tbody>
        </table>
    </div>

	<div class="table-responsive">

		<table class="table">
			<thead>
				<tr><th colspan=7 style="text-align:center;"><h4>Select Rooms</h4></th></tr>				
			</thead>			
		</table>

	</div>

	<form name="form1" id="form1" method="post">
		
        <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION["id_user"]; ?>">
        <input type="hidden" name="action" id="action" value="select_room">

        <strong>Room:</strong> <select class="form-control" id="id_room" name="id_room" required>
			<option value="">-Select Room-</option>
		</select>			                
        <br>
        <strong>Date:</strong>
        <input class="form-control" type="datetime-local" name="date" id="date" required>
		<hr>
		<p style="text-align:center;"><input id="save" class="btn btn-primary" type="submit" value="Select"></input></p>
	</form>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		var id_user = $("#id_user").val();

		getData('id_room', '?action=get_all_rooms_free');

        getData('rented_rooms_user', '?action=get_user_by_date&id='+id_user);
		
		function getData( type, param )
		{
			
            $.ajax({
				url:"../api/getdataUsers.php",
				data: { type: type, param: param },
				success: function(data)
				{
					
                    if (type=='rented_rooms_user') {
						$('tbody').html(data);
					}
					else{						
						$('#id_room').append(data);			                    
					}

				}
			})
		}

		$('#form1').on('submit', function(event){

			event.preventDefault();

			var form1 = $(this).serialize();			

			$.ajax({
				url: "../api/saveRooms.php",
				method:"POST",
				data:form1,
				success:function(data)
				{						
					if (data === 'insert')
					{
						alert("Room selected!");	

                        getData('rented_rooms_user', '?action=get_user_by_date&id='+id_user);
					}															
                    else if (data === 'error2') {
                        alert("Unavailable Room!");	
                    }
				}
			});				
			
		});	



        $(document).on('click', '.delete', function(){
			
			var id = $(this).attr('id');

            var action = 'delete_room';
			
			if (confirm("Are you sure?")) 
			{
				
				$.ajax({
					url:"../api/saveRooms.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data)
					{
						alert("Reservation Canceled!");

                        getData('rented_rooms_user', '?action=get_user_by_date&id='+id_user);
					}
				});
				
			}
				
		});		        
			
	});
</script>
</body>
</html>