<div>
	THIS IS TEST PAGE NOT HELLO WORLD! :D <?php echo $sintaskFW->get("src");?>
	<br><br>
	HELLO TEST / COOKIE 'sintaskFW' = <?php echo $sintaskKuki->get('sintaskFW');?>
	<br><br>
	<form action="" method="post">
		<input type="hidden" name="changeToken" value="leterror"/>
		<input type="submit" value="Gagal - Munculkan Error 205 karena tidak mengisi Control"/>
	</form>
	<br><br>
	<form action="" method="post">
	    <input type="hidden" name="thisDefaultValue" value="POST BIASA"/>
		<input type="submit" value="Post Default" name="postDefault"/>
	</form>
	<br><br>
	<form action="" method="post">
	    <input type="hidden" name="thisDefaultValue" value="POST COOKIE"/>
		<input type="submit" value="Post Cookie" name="postCookie"/>
	</form>
	<form action="" method="post">
	    <input type="hidden" name="thisDefaultValue" value="POST MODIF COOKIE"/>
		<input type="submit" value="Post Modified Cookie" name="postModifCookie"/>
	</form>
	<form action="" method="post">
	    <input type="hidden" name="thisDefaultValue" value="CLEAR COOKIE"/>
		<input type="submit" value="Clear Cookie" name="clearCookie"/>
	</form>
	<br><br>
	<form action="" method="post" enctype="multipart/form-data">
	    Pilih file untuk di upload (akan tersimpan pada /protected/data/download/not-direct/) :
		<br>
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload File" name="submitFile">
	</form>
</div>