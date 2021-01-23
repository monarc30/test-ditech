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

    <div class="row" style="margin-top:100px;">
        <div class="col-4">
            &nbsp;
        </div>
        <div class="col-4">
            <h2 style="text-align:center">Login Form</h2>		
            <hr>
        </div>
        <div class="col-4">
            &nbsp;
        </div>
    </div>

	<div class="row">        
            <div class="col-4">
                &nbsp;
            </div>
            <div class="col-4">
                <form name="form1" id="form1" method="post">	

                    <label>Login:</label>
                    <input class="form-control" type="text" name="login" id="login" maxlength=10 size=10 required>		

                    <label>Password:</label>
                    <input class="form-control" type="password" name="password" id="password" maxlength=10 size=10 required>		
                    
                    <input type="hidden" name="id_user" id="id_user">
                    <input type="hidden" name="action" id="action" value="login">
                    <hr>
                    <p style="text-align:center"><input id="save" class="btn btn-primary" type="submit" value="Login"></input></p>
                </form>

            </dlv>
            <div class="col-4">
                &nbsp;
            </div>        
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('#form1').on('submit', function(event){
			
            event.preventDefault();			
			
			var form1 = $(this).serialize();
			
			$.ajax({
				url: "../api/saveUsers.php",
				method:"POST",
				data:form1,
				success:function(data)
				{
					/*
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
                    */
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
	});
</script>
</body>
</html>