<div class="contentArea">
	<b class="fontSize25px">The Begining of your <u><?php echo $__BASE_URL__;?></u></b>
	<div class="borderSpaceMini"></div>
	Selamat, anda sudah berhasil menggunakan SinTaskFW.
	<div class="borderSpaceMini"></div>
	SinTaskFW atau SinTask Framework dikembangkan oleh Divisi Web SinTask, yang dimana SinTask adalah Startup Teknologi yang juga mengembangkan <a href="http://www.sintask.com" target="_blank">SinTask Productive & Fun</a>.
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	<h3>Memulai.</h3>
	<div class="borderSpaceMini"></div>
	<div class="contentTwo">
		<ul>
			<li>
				Saat baru mulai menggunakan SinTaskFW, silahkan konfigurasi pada direktori <span class="thisTagging">myassets/_php/my.core.php</span>
				<br>
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs/1.1.0/3" target="_blank">fw.sintask.com</a> untuk keterangan lebih lengkap. 
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Membuat halaman baru cukup dengan menambahkan file baru pada <span class="thisTagging">myassets/_page/spa_template</span> dan <span class="thisTagging">myassets/_page/spa_latecss</span>
				<br>
				Format penulisan nama file terdapat pada <a href="https://fw.sintask.com/docs/1.1.0/5" target="_blank">fw.sintask.com</a>
			</li>
			<div class="borderSpaceMini"></div>
			<li>
				Jika anda menggunakan Database, silahkan konfigurasi pada direktori <span class="thisTagging">myassets/_dbconfig/my.db.config.php</span>
				<br>
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs/1.1.0/4" target="_blank">fw.sintask.com</a> untuk penggunaan $sdb.
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
				Silahkan baca dokumentasi lengkap di <a href="https://fw.sintask.com/docs/1.1.0" target="_blank">fw.sintask.com</a> (Sangat Disarankan) 
			</li>
		</ul>
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>
	
	<h3>Contoh Page.</h3>
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

	<h3>Extra.</h3>
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
	onOuterClick: "hide"
});</code></pre>
		</div>
		<div class="borderSpaceMini"></div>
		<span class="thisTagging">onNo</span> bersifat opsional, jika tidak didefinisikan akan menjalankan kondisi untuk menghilangkan PopUp (close PopUp).
		<div class="borderSpaceMini"></div>
		<span class="thisTagging">onOuterClick</span> memiliki value "hide" dengan tujuan saat anda ingin PopUp menghilang atau close jika wilayah luar PopUp (Wilayah gelap & blur) diklik. Parameter ini dapat dikosongkan atau bersifat opsional untuk hasil sebaliknya.
	</div>
	<div class="borderSpaceMini"></div>
	<div class="borderLine"></div>

	<h3>Lisensi untuk Framework ini menggunakan <a href="https://fw.sintask.com/licenses" target="_blank">MIT License</a>.</h3>
	<div class="borderSpaceMini"></div>
</div>
<script>
	sjqNoConflict("#showToastSinTask").on("click", function(){
		var thisMessage = sjqNoConflict("#toastMessage").val();
		var thisFadeTime = sjqNoConflict("#toastFadeTime").val();
		if(thisMessage != "" && ctypeSpace(thisMessage) > 0) {
			toastOne(thisMessage, thisFadeTime, "show");
		}
	});
	sjqNoConflict("#hideToastSinTask").on("click", function(){
		toastOne("", "", "hide");
	});

	sjqNoConflict("#showToast2SinTask").on("click", function(){
		var thisMessage = sjqNoConflict("#toastMessage2").val();
		var thisShowTime = sjqNoConflict("#toastShowTime2").val();
		if(thisMessage != "" && ctypeSpace(thisMessage) > 0) {
			toastTwo(thisMessage, "show", thisShowTime);
		}
	});

	sjqNoConflict("#showPopUpSinTask").on("click", function(){
		var thisTitle = sjqNoConflict("#popUpTitle").val();
		var thisMessage = sjqNoConflict("#popUpMessage").val();
		var thisButtonYes = sjqNoConflict("#popUpYesButton").val();
		var thisButtonNo = sjqNoConflict("#popUpNoButton").val();
		
		var thisPopUpDefault = true;

		if(
			(thisMessage != "" && ctypeSpace(thisMessage) > 0) 		&&
			(thisTitle != "" && ctypeSpace(thisTitle) > 0) 			&&
			(thisButtonYes != "" && ctypeSpace(thisButtonYes) > 0)	&&
			(thisButtonNo != "" && ctypeSpace(thisButtonNo) > 0)
		) {
			thisPopUpDefault = false;
		}

		if(thisPopUpDefault == true) {
			popUpOne({
				title: "Ada yang kurang", 
				message: "Wajib mengisi ke-empat kolom input di atas tombol <span class=\"thisTagging\">Munculkan PopUp</span> untuk membuat contoh PopUp anda sendiri", 
				yesButton: "Ya", 
				noButton: "Keluar",
				onYes: function(){
					toastTwo("Anda mengklik kondisi onYes, untuk keluar klik tombol 'Keluar' atau silang pada pojok kanan atas PopUp ini", "show", 15000);
				},
				onOuterClick: "hide"
			});
		} else if(thisPopUpDefault == false) {
			popUpOne({
				title: thisTitle, 
				message: thisMessage, 
				yesButton: thisButtonYes, 
				noButton: thisButtonNo,
				onYes: function(){
					toastTwo("Anda mengklik kondisi onYes", "show", 8000);
				},
				onNo: function(){
					toastTwo("Anda mengklik kondisi onNo, untuk keluar klik tombol silang pada pojok kanan atas PopUp ini", "show", 8000);
				},
				onOuterClick: "hide"
			});
		}
	});
</script>