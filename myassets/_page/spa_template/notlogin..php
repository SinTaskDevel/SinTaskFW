<h2 class="head">
	Welcome Coders,
</h2>
<div class="contentArea">
	Selamat, anda sudah berhasil menggunakan SinTaskFW.
	<div class="borderSpaceMini"></div>
	SinTaskFW atau SinTask Framework adalah <i>Simple & Light PHP Micro Framework built-in SPA</i>, dikembangkan oleh Divisi Web SinTask, yang dimana SinTask adalah Startup Teknologi yang juga mengembangkan <a href="http://www.sintask.com" target="_blank">SinTask Productive & Fun</a>.
	<div class="borderSpaceMini"></div>
	<div class="noted">
		<strong>Info</strong>
		<div class="borderSpaceMini"></div>
		Versi &mdash; <span class="ft_style_b"><?php echo $__VERSION__;?></span>
		<br>
		Browser anda saat ini support JavaScript &mdash; <span id="jsVersion" class="ft_style_b"></span>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	<h2 class="title">Memulai.</h2>
	<div class="borderSpaceMini"></div>
	<div class="contentTwo">
		<ul>
			<li>
				Saat baru mulai menggunakan SinTaskFW, silahkan konfigurasi pada direktori <span class="thisTagging">myassets/_php/my.core.php</span>
				<br>
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs/1.2.0/3" target="_blank">fw.sintask.com</a> untuk keterangan lebih lengkap. 
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Membuat halaman baru cukup dengan menambahkan file baru pada <span class="thisTagging">myassets/_page/spa_template</span> dan <span class="thisTagging">myassets/_page/spa_latecss</span>
				<br>
				Format penulisan nama file terdapat pada <a href="https://fw.sintask.com/docs/1.2.0/5" target="_blank">fw.sintask.com</a>
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Jika anda menggunakan Database, silahkan konfigurasi pada direktori <span class="thisTagging">myassets/_dbconfig/my.db.config.php</span>
				<br>
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs/1.2.0/4" target="_blank">fw.sintask.com</a> untuk penggunaan $sdb.
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
				Fungsi default <span class="thisTagging">move_uploaded_file</span> tidak dapat digunakan untuk beberapa kondisi, agar saat proses mengupload file tetap lancar, mohon gunakan fungsi <span class="thisTagging">rename</span> atau <span class="thisTagging">sfwUploadFile</span> dengan parameter input yang sama dengan <span class="thisTagging">move_uploaded_file</span>.
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
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs/1.2.0" target="_blank">fw.sintask.com</a> (Sangat Disarankan) 
			</li>
		</ul>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>
	
	<h2 class="title">Contoh Page.</h2>
	<div class="borderSpaceMini"></div>
	<div class="contentTwo">
		<span class="s ft_style_u c_pointer" spa-url="<?php echo $__BASE_URL__;?>/true/div">
			Tidak menggunakan a href (SPA - 404)
		</span>
		<div class="borderSpaceMini"></div>
		<a spa href="<?php echo $__BASE_URL__;?>/true/href" class="ft_style_u">
			Menggunakan href biasa (SPA - 404)
		</a>
		<div class="borderSpaceMini"></div>
		<a spa href="<?php echo $__BASE_URL__;?>/test?src=HOMEPAGES" class="ft_style_u">
			Halaman test (SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a href="<?php echo $__BASE_URL__;?>/general" class="ft_style_u">
			Halaman general (NON-SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a spa href="<?php echo $__BASE_URL__;?>/my/dynamic1" class="ft_style_u">
			Halaman dinamis 1 (SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<a spa href="<?php echo $__BASE_URL__;?>/my/dynamic2" class="ft_style_u">
			Halaman dinamis 2 (SPA)
		</a>
		<div class="borderSpaceMini"></div>
		<div class="noted">
			Perhatikan Source Code dari baris kode Link-link di atas ini agar memahami bagaimana penggunaan tag &lt;a&gt; untuk berpindah ke halaman berbasis SPA dan halaman biasa.
		</div>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	<h2 class="title">Latihan & Panduan Singkat.</h2>
	<div class="borderSpaceMini"></div>
	<div class="contentTwo">
		<div class="ft_style_b">1. Panduan singkat, menambah halaman/page.</div>
		<div class="borderSpaceMini"></div>
		Silahkan tambahkan file .php pada <span class="thisTagging">/myassets/_page/spa_template</span> dengan nama <span class="thisTagging">notlogin.my-firstpage.php</span> lalu isi dengan kode PHP/HTML/JS anda secara bebas, setelah itu coba buka Link di bawah ini, jika tidak menghasilkan 404 artinya anda berhasil membuat Page SPA Pertama anda menggunakan SinTaskFW.
		<div class="borderSpaceMini"></div>
		<a spa href="<?php echo $__BASE_URL__;?>/my-firstpage" class="ft_style_u">
			Halaman SPA Pertama-ku &mdash; <b><?php echo $__BASE_URL__;?>/my-firstpage</b>
		</a>
		<div class="borderSpace"></div>

		<div class="ft_style_b">2. Panduan singkat, mengubah/menghilangkan header & footer.</div>
		<div class="borderSpaceMini"></div>
		Silahkan edit file .php pada <span class="thisTagging">/myassets/_page/stay</span> terdapat 3 file dengan nama <span class="thisTagging">stay_content.php</span>, <span class="thisTagging">stay_header.php</span>, <span class="thisTagging">stay_footer.php</span> di mana file-file ini berfungsi untuk menampilkan Header, Footer dan Content. File ini berguna saat anda ingin mengurangi beban load / memuat halaman SPA anda dari Header, Footer dan Content, juga agar mempermudah anda agar tidak perlu membuat header pada setiap Page secara manual. Anda juga tentu dapat mengosongkan ke-tiga file ini jika tidak ingin menggunakan fitur stay content SPA SinTaskFW, lalu membuat Header & Footer secara manual pada setiap Page (Not-Recomended).
		<div class="borderSpace"></div>

		<div class="ft_style_b">3. Baca dokumentasi dan pahami, serta temukan hal menariknya.</div>
		<div class="borderSpaceMini"></div>
		Kami menyarankan anda untuk membaca dokumentasi kami secara menyeluruh agar paham dan mudah dalam membangun web anda menggunakan SinTaskFW.
		<div class="borderSpaceMini"></div>
		&mdash; <a href="https://fw.sintask.com/docs/" class="ft_style_u" target="_blank">Buka Dokumentasi SinTaskFW</a>
		<br>
		&mdash; Jika ada kendala hubungi kami melalui <b>hi@sintask.com</b> dengan menyertakan tulisan [SinTaskFW] pada subject anda.
		<br>
		&mdash; Menemui masalah lain dan butuh respon lebih cepat? kirim Issue ke <a href="https://github.com/SinTaskDevel/SinTaskFW" class="ft_style_u" target="_blank">Github SinTaskFW</a>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	<h2 class="title">Extra JavaScript.</h2>
	<div class="borderSpaceMini"></div>
	<div class="contentTwo">
		<b>Toast 1</b> &mdash; function <span class="thisTagging">toastOne</span> &mdash; Javascript
		<div class="borderSpaceMini"></div>
		Toast tipe 1 memungkinkan anda untuk menampilkan pesan Toast (layaknya Android Apps), Toast 1 ini tidak ada batasan waktu untuk menghilang (hide/fadeout) sehingga anda harus menjalankan function <span class="thisTagging">toastOne</span> dengan parameter "hide".
		<div class="borderSpaceMini"></div>
		<input id="toastMessage" class="toast" type="text" placeholder="Pesan pada Toast">
		<br>
		<input id="toastFadeTime" class="toast" type="text" placeholder="Waktu fade Toast muncul (milisecond)">
		<div class="borderSpaceMini"></div>
		<button id="showToastSinTask" class="toast c_pointer">Munculkan Toast</button>
		<button id="hideToastSinTask" class="toast c_pointer">Hilangkan Toast</button>
		<div class="borderSpaceMini"></div>
		Contoh <span class="thisTagging">&lt;script&gt;</span> memunculkan Toast 1
		<div class="borderSpaceMini"></div>
		<div class="noted">
			<pre><code>var thisMessage = "Ini Toast 1"; 	// Pesan Toast
var thisFadeTime = 200; 		// 200 Milisecond
toastOne(thisMessage, thisFadeTime, "show");</code></pre>
		</div>
		<div class="borderSpaceMini"></div>
		Contoh <span class="thisTagging">&lt;script&gt;</span> menghilangkan Toast 1 (yang sudah muncul)
		<div class="borderSpaceMini"></div>
		<div class="noted">
			<pre><code>toastOne("", "", "hide");</code></pre>
		</div>

		<div class="borderSpace"></div>
		<b>Toast 2</b> &mdash; function <span class="thisTagging">toastTwo</span> &mdash; Javascript
		<div class="borderSpaceMini"></div>
		Sama seperti Toast 1 tetapi memiliki perbedaan Toast 2 dapat menghilang pada waktu yang telah ditentukan dalam Milisecond.
		<div class="borderSpaceMini"></div>
		<input id="toastMessage2" class="toast" type="text" placeholder="Pesan pada Toast">
		<br>
		<input id="toastShowTime2" class="toast" type="text" placeholder="Waktu menghilang Toast (milisecond)">
		<div class="borderSpaceMini"></div>
		<button id="showToast2SinTask" class="toast c_pointer">Munculkan Toast</button>
		<div class="borderSpaceMini"></div>
		Contoh <span class="thisTagging">&lt;script&gt;</span> memunculkan Toast 2
		<div class="borderSpaceMini"></div>
		<div class="noted">
			<pre><code>var thisMessage = "Ini Toast 2"; 	// Pesan Toast
var thisShowTime = 2000; 		// 2000 Milisecond = 2 Detik
toastTwo(thisMessage, "show", thisShowTime);</code></pre>
		</div>

		<div class="borderSpace"></div>
		<b>Pop Up</b> &mdash; function <span class="thisTagging">popUpOne</span> &mdash; Javascript
		<div class="borderSpaceMini"></div>
		Pop Up bawaan SinTaskFW hanya dapat dijalankan pada halaman SinTaskFW yang berbasiskan SPA (Single Page Application)
		<div class="borderSpaceMini"></div>
		<input id="popUpTitle" class="toast" type="text" placeholder="Pop Up Title">
		<br>
		<input id="popUpMessage" class="toast" type="text" placeholder="Pop Up Message">
		<br>
		<input id="popUpYesButton" class="toast" type="text" placeholder="Nama tombol Pop Up kondisi Yes">
		<br>
		<input id="popUpNoButton" class="toast" type="text" placeholder="Nama tombol Pop Up kondisi No">
		<div class="borderSpaceMini"></div>
		<button id="showPopUpSinTask" class="toast c_pointer">Munculkan PopUp</button>
		<div class="borderSpaceMini"></div>
		Contoh <span class="thisTagging">&lt;script&gt;</span> memunculkan PopUp
		<div class="borderSpaceMini"></div>
		<div class="noted">
			<pre><code>var thisTitle = "Ini PopUp"; 	// Judul PopUp
var thisMessage = "Test test test test?"; 		// Isi Pesan PopUp
var thisButtonYes = "Ya";		// Nama tombol Pop Up kondisi "Yes"
var thisButtonNo = "Tidak";		// Nama tombol Pop Up kondisi "No"
popUpOne({
	title: thisTitle, 
	message: thisMessage, 
	yesButton: thisButtonYes, 
	noButton: thisButtonNo,
	onYes: function(){
		toastTwo("Anda mengklik kondisi onYes", "show", 8000);
	},
	onNo: function(){
		toastTwo("Anda mengklik kondisi onNo", "show", 8000);
	},
	onOuterClick: "hide",
	animationFade: true
});</code></pre>
		</div>
		<div class="borderSpaceMini"></div>
		<span class="thisTagging">onNo</span> bersifat opsional, jika tidak didefinisikan akan menjalankan kondisi untuk menghilangkan PopUp (close PopUp).
		<div class="borderSpaceMini"></div>
		<span class="thisTagging">onOuterClick</span> memiliki value "hide" dengan tujuan saat anda ingin PopUp menghilang atau close jika wilayah luar PopUp (Wilayah gelap & blur) diklik. Parameter ini dapat dikosongkan atau bersifat opsional untuk hasil sebaliknya.
		<div class="borderSpaceMini"></div>
		<span class="thisTagging">animationFade</span> bernilai true atau false (boolean), jika true akan memunculkan PopUp dengan menyertakan efek animasi FadeIn-FadeOut

		<div class="borderSpace"></div>
		<b>Pop Up</b> &mdash; function <span class="thisTagging">popUpTwo</span> &mdash; Javascript
		<div class="borderSpaceMini"></div>
		Pop Up bawaan SinTaskFW hanya dapat dijalankan pada halaman SinTaskFW yang berbasiskan SPA (Single Page Application), perbedaan dengan popUpOne adalah Pop Up ini hanya memiliki 1 pilihan tombol.
		<div class="borderSpaceMini"></div>
		<input id="popUpTitle2" class="toast" type="text" placeholder="Pop Up Title">
		<br>
		<input id="popUpMessage2" class="toast" type="text" placeholder="Pop Up Message">
		<br>
		<input id="popUpOkButton2" class="toast" type="text" placeholder="Nama tombol Pop Up kondisi Ok">
		<div class="borderSpaceMini"></div>
		<button id="showPopUpSinTask2" class="toast c_pointer">Munculkan PopUp 2</button>
		<div class="borderSpaceMini"></div>
		Contoh <span class="thisTagging">&lt;script&gt;</span> memunculkan PopUp
		<div class="borderSpaceMini"></div>
		<div class="noted">
			<pre><code>var thisTitle = "Ini PopUp"; 	// Judul PopUp
var thisMessage = "Test test test test?"; 		// Isi Pesan PopUp
var thisButtonOk = "Ok";		// Nama tombol Pop Up kondisi "Ok"
popUpTwo({
	title: thisTitle, 
	message: thisMessage, 
	okButton: thisButtonOk,
	onOk: function(){
		toastTwo("Anda mengklik kondisi onOk", "show", 8000);
	},
	onOuterClick: "hide",
	animationFade: true
});</code></pre>
		</div>

		<div class="borderSpace"></div>
		<b>Hilangkan Pop Up</b> &mdash; function <span class="thisTagging">removePopUp</span> & <span class="thisTagging">removePopUpFade</span> &mdash; Javascript
		<div class="borderSpaceMini"></div>
		Terdapat 2 function (global) untuk menghilangkan Pop Up bawaan SinTaskFW yaitu <span class="thisTagging">removePopUp</span> & <span class="thisTagging">removePopUpFade</span>, khusus untuk <span class="thisTagging">removePopUpFade</span> akan menghilangkan Pop Up dengan tambahan animasi fadeOut.
		<div class="borderSpaceMini"></div>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	<h3>Lisensi untuk Framework ini menggunakan <a href="https://fw.sintask.com/licenses" target="_blank">MIT License</a>.</h3>
	<div class="borderSpaceMini"></div>
</div>
<script>
	sjqNoConflict("#jsVersion").html(__SFW_f.getJsVersion().jsVersion);
	
	sjqNoConflict("#showToastSinTask").on("click", function(){
		var thisMessage = sjqNoConflict("#toastMessage").val();
		var thisFadeTime = sjqNoConflict("#toastFadeTime").val();
		if(thisMessage != "" && __SFW_f.ctypeSpace(thisMessage) > 0) {
			__SFW_f.toastOne(thisMessage, thisFadeTime, "show");
		}
	});
	sjqNoConflict("#hideToastSinTask").on("click", function(){
		__SFW_f.toastOne("", "", "hide");
	});

	sjqNoConflict("#showToast2SinTask").on("click", function(){
		var thisMessage = sjqNoConflict("#toastMessage2").val();
		var thisShowTime = sjqNoConflict("#toastShowTime2").val();
		if(thisMessage != "" && __SFW_f.ctypeSpace(thisMessage) > 0) {
			__SFW_f.toastTwo(thisMessage, "show", thisShowTime);
		}
	});

	sjqNoConflict("#showPopUpSinTask").on("click", function(){
		var thisTitle = sjqNoConflict("#popUpTitle").val();
		var thisMessage = sjqNoConflict("#popUpMessage").val();
		var thisButtonYes = sjqNoConflict("#popUpYesButton").val();
		var thisButtonNo = sjqNoConflict("#popUpNoButton").val();
		
		var thisPopUpDefault = true;

		if(
			(thisMessage != "" && __SFW_f.ctypeSpace(thisMessage) > 0) 		&&
			(thisTitle != "" && __SFW_f.ctypeSpace(thisTitle) > 0) 			&&
			(thisButtonYes != "" && __SFW_f.ctypeSpace(thisButtonYes) > 0)	&&
			(thisButtonNo != "" && __SFW_f.ctypeSpace(thisButtonNo) > 0)
		) {
			thisPopUpDefault = false;
		}

		if(thisPopUpDefault == true) {
			__SFW_f.popUpOne({
				title: "Ada yang kurang", 
				message: "Wajib mengisi ke-empat kolom input di atas tombol <span class=\"thisTagging\">Munculkan PopUp</span> untuk membuat contoh PopUp anda sendiri", 
				yesButton: "Ya", 
				noButton: "Keluar",
				onYes: function(){
					__SFW_f.toastTwo("Anda mengklik kondisi onYes, untuk keluar klik tombol 'Keluar' atau silang pada pojok kanan atas PopUp ini", "show", 15000);
				},
				onOuterClick: "hide",
				animationFade: true
			});
		} else if(thisPopUpDefault == false) {
			__SFW_f.popUpOne({
				title: thisTitle, 
				message: thisMessage, 
				yesButton: thisButtonYes, 
				noButton: thisButtonNo,
				onYes: function(){
					__SFW_f.toastTwo("Anda mengklik kondisi onYes", "show", 8000);
				},
				onNo: function(){
					__SFW_f.toastTwo("Anda mengklik kondisi onNo, untuk keluar klik tombol silang pada pojok kanan atas PopUp ini", "show", 8000);
				},
				onOuterClick: "hide"
			});
		}
	});

	sjqNoConflict("#showPopUpSinTask2").on("click", function(){
		var thisTitle = sjqNoConflict("#popUpTitle2").val();
		var thisMessage = sjqNoConflict("#popUpMessage2").val();
		var thisButtonOk = sjqNoConflict("#popUpOkButton2").val();
		
		var thisPopUpDefault = true;

		if(
			(thisMessage != "" && __SFW_f.ctypeSpace(thisMessage) > 0) 		&&
			(thisTitle != "" && __SFW_f.ctypeSpace(thisTitle) > 0) 			&&
			(thisButtonOk != "" && __SFW_f.ctypeSpace(thisButtonOk) > 0)
		) {
			thisPopUpDefault = false;
		}

		if(thisPopUpDefault == true) {
			__SFW_f.popUpTwo({
				title: "Ada yang kurang", 
				message: "Wajib mengisi ke-tiga kolom input di atas tombol <span class=\"thisTagging\">Munculkan PopUp 2</span> untuk membuat contoh PopUp anda sendiri", 
				okButton: "Oke",
				onOk: function(){
					__SFW_f.toastTwo("Anda mengklik kondisi onOk dan PopUp tipe 2 ini langsung menghilang", "show", 15000);
				},
				onOuterClick: "hide",
				animationFade: true
			});
		} else if(thisPopUpDefault == false) {
			__SFW_f.popUpTwo({
				title: thisTitle, 
				message: thisMessage, 
				okButton: thisButtonOk,
				onOk: function(){
					__SFW_f.toastTwo("Anda mengklik kondisi onOk dan PopUp tipe 2 ini langsung menghilang", "show", 15000);
				},
				onOuterClick: "hide"
			});
		}
	});
</script>