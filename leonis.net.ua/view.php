<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>File upload</title>
	<script type="text/javascript" src="jquery.js"></script>
</head>
<body>
	<div class="ajax-respond"></div>
	<form enctype="multipart/form-data" action="/" method="POST">
	 	<input type="file" name="photo" multiple accept="image/*,image/jpeg">
	    <input type="submit" class='submit' value="Send File" />
	</form>

	<table border="1">
		<tr>
		<? foreach ($arr_keys as $value):?>
			<th> <?=$value;?></th>
		<? endforeach;?>
   		</tr>
		<? foreach ($new_array as $key=>$row):?>
			<tr>
				<th> <?=$row['id'];?></th>
				<th> 
					<a href="/images/<?= $href[$key]?>">
					<?=$row['original_name'];?>
					</th>
				<th> <?=$row['create_datetime'];?></th>
			</tr>
		<? endforeach;?>
	</table>
</body>
<script type="text/javascript">
	$(function(){
			$('.submit').click(function( event ){
			event.stopPropagation();
			event.preventDefault();	
			$.ajax({
	        url: '/?send=ajax',
	        type: 'POST',
	        data: new FormData($('form')[0]),
	        cache: false,
	        dataType: 'json',
	        processData: false,
	        contentType: false, 
	        success: function( respond ){
	        	console.log(respond);
	        	$('.ajax-respond').text('file uploaded');
	        	},
	        error: function(respond){
	        		console.log(respond.responseText);
           			$('.ajax-respond').text(respond.responseText);
        		}
	    	});
    	});
    	return false;
	});
 
</script>
</html>