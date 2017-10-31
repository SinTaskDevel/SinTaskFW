<div class="contentArea">
	<b class="fontSize25px">The Begining of your <u><?php echo $__BASE_URL__;?></u></b>
	<div class="borderSpaceMini"></div>
	Selamat, anda sudah berhasil menggunakan SinTaskFW.
	<div class="borderSpaceMini"></div>
	SinTaskFW atau SinTask Framework dikembangkan oleh Divisi Web SinTask, yang dimana SinTask adalah Startup Teknologi yang juga mengembangkan <a href="http://www.sintask.com" target="_blank">SinTask Productive & Fun</a>.
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	Memulai.
	<div class="borderSpaceMini"></div>
	<div class="contentTwo">
		<ul>
			<li>
				Saat baru mulai menggunakan SinTaskFW, silahkan konfigurasi pada direktori <span class="thisTagging">myassets/_php/my.core.php</span>
				<br>
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs" target="_blank">fw.sintask.com</a> untuk keterangan lebih lengkap. 
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Membuat halaman baru cukup dengan menambahkan file baru pada <span class="thisTagging">myassets/_page/spa_template</span> dan <span class="thisTagging">myassets/_page/spa_latecss</span>
				<br>
				Format penulisan nama file terdapat pada <a href="https://fw.sintask.com/docs" target="_blank">fw.sintask.com</a>
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Jika anda menggunakan Database, silahkan konfigurasi pada direktori <span class="thisTagging">myassets/_dbconfig/my.db.config.php</span>
				<br>
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs" target="_blank">fw.sintask.com</a> untuk penggunaan $sdb.
				<br>
				&mdash; $sdb ini untuk menjalankan Query Database anda. 
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs" target="_blank">fw.sintask.com</a> (Sangat Disarankan) 
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				CSS & JS SinTaskFW (Tidak boleh diubah)
				<div class="borderSpaceMini"></div>
				<div class="noted">
					<div class="orangeBubble">Mengubah script dapat menyebabkan malfunction</div>
					<pre><code>
assets/script/css/sintask.css
assets/script/js/
	|_ jquery.min.js
		|_ sintask.plugin.js
		|_ sintask.func.js
		|_ sintask.zcore.js</code></pre>
				</div>
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Ingin mengembangkan SinTaskFW lebih lanjut? kami terbuka untuk siapa saja yang ingin mengembangkan SinTaskFW, saat ini SinTaskFW <b>tidak dapat</b> ditemukan di GitHub, Bitbucket, GitLab dan sejenisnya.
				<div class="borderSpaceMini"></div>
				Keterangan lebih lanjut dapat hubungi tim SinTask melalui email ke <span class="thisTagging">hi@sintask.com</span> atau <span class="thisTagging">developer@sintask.com</span>
			</li>
		</ul>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>
	
	Contoh Page.
	<div class="borderSpaceMini"></div>
	<div class="contentTwo">
		<span class="s ft_style_u c_pointer" s-data-url="/true/div">
			Tidak menggunakan a href (SPA - 404)
		</span>
		<div class="borderSpaceMini"></div>
		<a href="/true/href" class="s ft_style_u">
			Menggunakan href biasa (SPA - 404)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="/test?src=HOMEPAGES" class="s ft_style_u">
			Halaman test (SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="/general" class="s ft_style_u">
			Halaman general -> akan menghasilkan halaman SINTASK_ERROR (NON-SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<div class="noted">
			Jangan memberi <span class="thisTagging">class="s"</span> untuk perpindahan dari halaman SPA ke NON-SPA.
		</div>
		<div class="borderSpaceMini"></div>
		<a href="/general" class="ft_style_u">
			Halaman general (NON-SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="/dynamic1" class="s ft_style_u">
			Halaman dinamis 1 (SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="/dynamic2" class="s ft_style_u">
			Halaman dinamis 2 (SPA)
		</a>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	Lisensi untuk Framework ini menggunakan <a href="https://fw.sintask.com/licenses" target="_blank">MIT License</a>.
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>
	<div class="fontSize13px">&copy; 2016 - 2017, CV. SinTask - <?php echo $__VERSION__."-".$__CODENAME__;?> </div>
</div>