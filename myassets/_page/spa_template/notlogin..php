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
				SinTaskFW sudah langsung menggunakan Lato Font. Jika anda ingin me-reset pengaturan CSS font-family cukup tambahkan kode di bawah pada file <span class="thisTagging">myassets/css/my.css</span> atau file css custom anda (pada contoh di bawah ini menggunakan Arial Font)
				<div class="borderSpaceMini"></div>
				<div class="noted">
					<pre><code>body, html {
	font-family: Arial;
}</code></pre>
				</div>
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Direktori <span class="thisTagging">/myassets</span> merupakan inti dari web yang akan anda bangun, sehingga semua konfigurasi, code, ataupun library tambahan anda harus terletak pada direktori tersebut 
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Ingin mengembangkan SinTaskFW lebih lanjut? kami terbuka untuk siapa saja yang ingin mengembangkan SinTaskFW
				<div class="borderSpaceMini"></div>
				<div class="noted">
					<b>GitHub</b> &mdash; <a href="https://github.com/SinTaskDevel/SinTaskFW" target="_blank">SinTaskFW</a> & <a href="https://github.com/SinTaskDevel/SinTaskFW-Installer" target="_blank">SinTaskFW-Installer</a>
					<div class="borderSpaceMini"></div>
					<b>Kontak</b> &mdash; Keterangan lebih lanjut dapat hubungi tim SinTask melalui email ke <span class="thisTagging">hi@sintask.com</span> atau <span class="thisTagging">developer@sintask.com</span>
				</div>
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs" target="_blank">fw.sintask.com</a> (Sangat Disarankan) 
			</li>
		</ul>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>
	
	Contoh Page.
	<div class="borderSpaceMini"></div>
	<div class="contentTwo">
		<span class="s ft_style_u c_pointer" s-data-url="<?php echo $__BASE_URL__;?>/true/div">
			Tidak menggunakan a href (SPA - 404)
		</span>
		<div class="borderSpaceMini"></div>
		<a href="<?php echo $__BASE_URL__;?>/true/href" class="s ft_style_u">
			Menggunakan href biasa (SPA - 404)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="<?php echo $__BASE_URL__;?>/test?src=HOMEPAGES" class="s ft_style_u">
			Halaman test (SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="<?php echo $__BASE_URL__;?>/general" class="s ft_style_u">
			Halaman general -> akan menghasilkan halaman SINTASK_ERROR (NON-SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<div class="noted">
			Jangan memberi <span class="thisTagging">class="s"</span> untuk perpindahan dari halaman SPA ke NON-SPA.
		</div>
		<div class="borderSpaceMini"></div>
		<a href="<?php echo $__BASE_URL__;?>/general" class="ft_style_u">
			Halaman general (NON-SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="<?php echo $__BASE_URL__;?>/dynamic1" class="s ft_style_u">
			Halaman dinamis 1 (SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="<?php echo $__BASE_URL__;?>/dynamic2" class="s ft_style_u">
			Halaman dinamis 2 (SPA)
		</a>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	Lisensi untuk Framework ini menggunakan <a href="https://fw.sintask.com/licenses" target="_blank">MIT License</a>.
	<div class="borderSpaceMini"></div>
</div>