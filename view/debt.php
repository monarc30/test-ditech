<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">

	<table class="table">
		<thead>
			<tr><th colspan=7 style="text-align:center;"><h4>Data Form</h4></th></tr>
			<tr style="text-align:center;">
				<th>Id</th>
				<th>Created date</th>
				<th>Name</th>
				<th>Email</th>
				<th>Date of birth</th>
				<th colspan=2>Action</th>
			</tr>
		</thead>
		<tbody>		
		</tbody>
	</table>

	<form name="form1" id="form1" method="post">
		Created Date:<input class="form-control" disabled type="text" name="created_date" id="created_date">	
		Name:<input class="form-control" type="text" name="name" id="name" size=100>	
		Email:<input class="form-control" type="text" name="email" id="email" size=100>	
		Date of birth:<input class="form-control" type="date" name="birth" id="birth" size=100>	
		Password:<input class="form-control" type="text" name="password" id="password" size=10>		
		
		<input type="hidden" name="id_user" id="id_user">
		<input type="hidden" name="action" id="action" value="insert">
		<hr>
		<input id="save" class="btn-primary" type="submit" value="Insert New"></input>	

		<input id="cancel" class="btn-primary" type="reset" value="Cancel"></input>	

	</form>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
		getData();

		function Reset() 
		{

			$('#form1')[0].reset();

			$('#save').val('Insert New');

			$('#action').val('insert');

		}
		
		function getData()
		{
			$.ajax({
				url:"getdata.php",
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
			if ($('#name').val()=="") 
			{
				alert('Name is empty!');
				$('#name').focus();
				
			}
			else if ($('#email').val()=="") {
				alert('Email is empty!');
				$('#email').focus();
				
			}
			else if ($('#password').val().length < 8) {
				alert('Password is too small!');
				$('#password').focus();
				
			}
			else {
				var form1 = $(this).serialize();
				
				$.ajax({
					url: "save.php",
					method:"POST",
					data:form1,
					success:function(data)
					{
						
						if (data === 'insert')
						{
							alert("Data inserted!");
						}
						if (data === 'error2')
						{
							alert("This email already exists in the database!");
						}						
						if (data === 'update') 
						{
							alert("Data updated!");
						}

						Reset();
						getData();						
						
						
					}
				});				
			}
		});
		
		
		$(document).on('click', '.edit', function(){

			var id = $(this).attr('id');			
			
			var action = 'user_one';
			
			$('#action').val('update');

			$('#save').val('Update');
			
			$.ajax({
				url:"save.php",
				method:"POST",
				data:{id:id,action:action},
				dataType:"json",				
				success:function(data)
				{
					$('#id_user').val(id);
					$('#created_date').val(data.created_date);
					$('#name').val(data.name);
					$('#email').val(data.email);
					$('#birth').val(data.birth);
					$('#password').val(data.password);
				}
			});
		});
		
		
		
		$(document).on('click', '.delete', function(){
			
			var id = $(this).attr('id');
			
			var action = 'delete';
			
			if (confirm("Are you sure?")) 
			{
				
				$.ajax({
					url:"save.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data)
					{
						Reset();
						getData();						
						
						alert("Data deleted!");
					}
				});
				
			}
				
		});		
			
			
	});
</script>
</body>
</html>