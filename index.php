<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">    

    <div class="header">

        <h1>Receiv.it Solutions</h1>

    </div>

    <div class="content">
    
        <button id="users" onclick="location.href='\view\users.php'">Users</button>
        <button id="bDoubts" onclick="location.href='\view\debt.php'">Doubts Users</button>	

    </div>

    <div class="footer">
        @copyright 2020 Receiv
    </div>

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