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
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Users</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="rooms.php">Rooms</a>
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
				<tr><th colspan=7 style="text-align:center;"><h4>Users Form</h4></th></tr>
				<tr style="text-align:center;">
					<th>Name</th>					
					<th>Email</th>					
					<th>Login</th>					
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
		<label>Name:</label>
		<input class="form-control" type="text" name="name" id="name" size=100 required>	
		<label>Email:</label>
		<input class="form-control" type="text" name="email" id="email" size=100 required>		

		<label>Login:</label>
		<input class="form-control" type="text" name="login" id="login" maxlength=10 size=10 required>		

		<label>Password:</label>
		<input class="form-control" type="password" name="password" id="password" maxlength=10 size=10 required>		
		
		<input type="hidden" name="id_user" id="id_user">
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
		
		getData('users', '?action=get_all');

		function Reset() 
		{

			$('#form1')[0].reset();

			$('#save').val('Insert New');

			$('#action').val('insert');

		}
		
		function getData(type, param)
		{
			$.ajax({
				url:"../api/getdataUsers.php",
				data: { type:type, param:param },
				success: function(data)
				{
					$('tbody').html(data);					

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
				url: "../api/saveUsers.php",
				method:"POST",
				data:form1,
				success:function(data)
				{
					if (data === 'insert')
					{
						alert("Data inserted!");
						Reset();
						getData('users', '?action=get_all');
					}
					else if (data === 'error2')
					{
						alert("This email already exists in the database!");
					}						
					else if (data === 'update') 
					{
						alert("Data updated!");
						Reset();
						getData('users', '?action=get_all');
					
					}
				}
			});				
			
		});
		
		
		$(document).on('click', '.edit', function(){

			var id = $(this).attr('id');			

			var action = 'user_one';
			
			$('#action').val('update');

			$('#save').val('Update');
			
			$.ajax({
				url:"../api/saveUsers.php",
				method:"POST",
				data:{id:id,action:action},
				dataType:"json",				
				success:function(data)
				{
					$('#id_user').val(id);
					$('#created_date').val(data.created_date);
					$('#name').val(data.name);
					$('#email').val(data.email);
					$('#login').val(data.login);
					$('#password').val(data.password);										
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
					url:"../api/saveUsers.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data)
					{
						Reset();
						getData('users', '?action=get_all');
						
						alert("Data deleted!");
					}
				});
				
			}
				
		});		
			
			
	});
</script>
</body>
</html>