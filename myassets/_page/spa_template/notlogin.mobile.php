<h2 class="head">
	Welcome Coders, Ini Tester Untuk Mobile Device
</h2>
<div class="contentArea">
	<h3>Toast</h3>
	<button id="showToastSinTask" class="sintaskButtonDefaultColorOk w_100p">Munculkan Toast 1</button>
	<div class="borderSpaceMini"></div>
	<button id="showToast2SinTask" class="sintaskButtonDefaultColorOk w_100p">Munculkan Toast 2</button>
	<div class="borderSpaceMini"></div>
	<button id="hideToastSinTask" class="sintaskButtonDefaultColorOk w_100p">Hilangkan Toast</button>
	
	<div class="clearBoth"></div>
	<div class="borderLine"></div>

	<h3>PopUp</h3>
	<button id="showPopUpSinTask" class="sintaskButtonDefaultColorOk w_100p">Munculkan PopUp 1</button>
	<div class="borderSpaceMini"></div>
	<button id="showPopUp2SinTask" class="sintaskButtonDefaultColorOk w_100p">Munculkan PopUp 2</button>
	<div class="borderSpaceMini"></div>

	<div class="clearBoth"></div>
	<br>
	<a spa href="<?php echo $__BASE_URL__;?>/test">Go to test page</a>
</div>
<script>
	sjqNoConflict(document).on("click", "h3", function(){
		alert("Header 3 Clicked (h3)");
	});

	sjqNoConflict("#showToastSinTask").on("click", function(){
		var thisMessage = "Tester Toast 1";
		var thisFadeTime = "200";
		if(thisMessage != "" && ctypeSpace(thisMessage) > 0) {
			toastOne(thisMessage, thisFadeTime, "show");
		}
	});
	sjqNoConflict("#hideToastSinTask").on("click", function(){
		toastOne("", "", "hide");
	});

	sjqNoConflict("#showToast2SinTask").on("click", function(){
		var thisMessage = "Tester Toast 2 - Hilang dalam 15 detik";
		var thisShowTime = 15000;
		if(thisMessage != "" && ctypeSpace(thisMessage) > 0) {
			toastTwo(thisMessage, "show", thisShowTime);
		}
	});

	sjqNoConflict("#showPopUpSinTask").on("click", function(){
		popUpOne({
			title: "Ini PopUp Tipe 1", 
			message: "PopUp Tipe 1 ini hanya menampilkan tombol Yes & No, dan handler Yes/No pada Event", 
			yesButton: "Yes",
			noButton: "No",
			onYes: function(){
				toastTwo("Anda mengklik kondisi onYes", "show", 8000);
			},
			onNo: function(){
				toastTwo("Anda mengklik kondisi onNo", "show", 8000);
			},
			onOuterClick: "hide",
			animationFade: true
		});
	});

	sjqNoConflict("#showPopUp2SinTask").on("click", function(){
		popUpTwo({
			title: "Ini PopUp Tipe 2", 
			message: "PopUp Tipe 2 ini hanya menampilkan tombol OK saja, dan handler OK pada Event", 
			okButton: "OK",
			onOk: function(){
				toastTwo("Mengklik kondisi onOk dan PopUp tipe 2 ini akan menghilang", "show", 15000);
			},
			onOuterClick: "hide",
			animationFade: true
		});
	});
</script>