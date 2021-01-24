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
					<a class="nav-link" href="../index.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="users.php">Users</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Rooms</a>
				</li>		
				<li class="nav-item">
					<a class="nav-link" href="rented_rooms.php">Rented Rooms</a>
				</li>						
			</ul>
		</div>
	</nav>

	<div class="table-responsive">

		<table class="table">
			<thead>
				<tr><th colspan=7 style="text-align:center;"><h4>Rooms Form</h4></th></tr>
				<tr style="text-align:center;">
					<th>Description</th>
					<th colspan=2>Action</th>
				</tr>
			</thead>
			<tbody>		
			</tbody>
		</table>

	</div>

	<form name="form1" id="form1" method="post">
		
		<label>Created Date:</label>
		<input class="form-control" disabled type="text" name="created_date" id="created_date">	
		<label>Description:</label>
		<input type="text" class="form-control" name="description" id="description" value="" required>				

		<!-----
		<label>Vendor:</label>
		<select id="id_vendor" name="id_vendor" required>
			<option value="">-Select Vendor-</option>
		</select>					
		------->
		
		<input type="hidden" name="id_rooms" id="id_rooms">
		<input type="hidden" name="action" id="action" value="insert">
		<hr>
		<input id="save" class="btn btn-primary" type="submit" value="Insert New"></input>	

		<input id="cancel" class="btn btn-primary" type="reset" value="Cancel"></input>	

	</form>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
		getData('rooms', '?action=get_all_rooms');

		getData('id_vendor', '?action=get_all');

		function Reset() 
		{

			$('#form1')[0].reset();

			$('#save').val('Insert New');

			$('#action').val('insert');

		}		
		
		function getData( type, param )
		{
			$.ajax({
				url:"../api/getdataUsers.php",
				data: { type: type, param: param },
				success: function(data)
				{
					if (type=='rooms') {
						$('tbody').html(data);
					}
					else{
						
						$('#id_rooms').append(data);
					}

				}
			})
		}

		$(document).on('click', '#cancel', function(){
			
			Reset();

		});
		
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
						alert("Data inserted!");						
					}
					else if (data === 'update') 
					{
						alert("Data updated!");											
					}
					Reset();
					getData('rooms', '?action=get_all_rooms');
				}
			});				
			
		});
		
		
		$(document).on('click', '.edit', function(){			

			var id = $(this).attr('id');

			var action = 'user_one_rooms';

			$('#action').val('update');

			$('#save').val('Update');
			
			$.ajax({
				url:"../api/saveRooms.php",
				method:"POST",
				data:{id:id,action:action},
				dataType:"json",				

				success:function(data)
				{
					$('#id_rooms').val(id);
					$('#created_date').val(data.created_date);
					$('#description').val(data.description);

				},
				error: function(result) {
					console.log(result);
                }
			});
		});
		
		
		
		$(document).on('click', '.delete', function(){
			
			var id = $(this).attr('id');
			
			var action = 'delete';
			
			if (confirm("Are you sure?")) 
			{
				
				$.ajax({
					url:"../api/saveRooms.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data)
					{
						Reset();
						getData('rooms','?action=get_all_rooms');
						
						//alert("Data deleted!");
					}
				});
				
			}
				
		});		
			
			
	});
</script>
</body>
</html>