<div class="contentArea">
	General Page & NON-SPA
	<br><br>
	<form action="" method="post">
		<input type="hidden" name="changeToken" value="leterror"/>
		<input type="submit" value="Munculkan Error 205 - (Tidak dapat membuat Error 205 dari General)"/>
	</form>
	<br><br>
	<form action="<?php echo $__BASE_URL__;?>" method="post">
		<input type="hidden" name="changeToken" value="leterror"/>
		<input type="submit" value="Munculkan Error 205 - (Mengirim POST ke halaman utama SPA)"/>
	</form>
	<br><br>
	<form action="" method="post">
		<input type="hidden" name="another" value="POSTED"/>
		<input type="submit" value="POST TEST (FORM SUBMIT)"/>
	</form>
	<br><br>
	<form action="" method="post" enctype="multipart/form-data">
	    Pilih gambar untuk diupload (akan tersimpan pada /protected/data/download/not-direct/):
	    <br>
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload Gambar" name="submitFile">
	</form>
	<br><br>
	<a href="<?php echo $__BASE_URL__;?>">Home Page</a>
</div>
<style>
	/**/
	div.contentArea {
		padding: 20px 200px 20px 200px;
		margin: 0px auto;
		font-size: 16px;
		color: #222;
	}
	div.contentTwo {
		padding: 20px;
	}
</style>