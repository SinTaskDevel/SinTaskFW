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
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submitFile">
</form>
<br><br>
<a href="<?php echo $__BASE_URL__;?>">Home Page</a>