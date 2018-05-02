<style type="text/css">
	* {
	    margin: 0; 
	    padding: 0;
	    outline: none;
	}
    body {
    	font-size: 14px; 
    	color: #777777; 
    	font-family: Arial; 
    	text-align: center;
    }
    h1 {
    	font-size: 100px; 
    	color: #555555; 
    	background: transparent; 
    	margin: 70px 0 0 0;
    }
    h2 {
    	color: #FFFFFF; 
        background: #DE6C5D; 
        font-family: Arial; 
        font-size: 20px; 
        font-weight: bold; 
        letter-spacing: -1px; 
        padding: 20px 0 20px;
    }
    h2.green {
    	color: #FFFFFF; 
        background: #248E75; 
        font-family: Arial; 
        font-size: 20px; 
        font-weight: bold; 
        letter-spacing: -1px; 
        padding: 20px 0 20px;
    }
    p {
    	width: 375px; 
        text-align: center; 
        margin-left: auto;
        margin-right: auto; 
        margin-top: 30px 
    }
    div.content {
    	width: 375px; 
    	text-align: justify-all; 
    	margin-left: auto;
    	margin-right: auto;
    	padding: 20px;
    }
    div.contentLeft {
    	width: 375px; 
    	text-align: center; 
    	margin-left: auto;
    	margin-right: auto;
    	padding: 20px;
    }
    a:link 		{color: #34536A;}
    a:visited 	{color: #34536A;}
    a:active 	{color: #34536A;}
    a:hover 	{color: #34536A;}
    .ft_underline {
    	text-decoration: underline;
    }
    table.centered {
   		margin-left: 28%;
	    text-align: left;
	    box-sizing: border-box;
    }
</style>

<h1>HTML5,</h1>
<h2>Browser anda tidak mendukung HTML5.</h2>
<div class="content">
    Peringatan ini muncul karena browser anda tidak mendukung sepenuhnya HTML5 yang kami butuhkan, sepertinya anda perlu mengupdate browser ke versi paling baru.
</div>
<div class="contentLeft">
	HTML5 [ <span id="supportCount"></span> ]
	<br>
	<br>

	<table class="centered">
		<tbody>
			<tr>
				<td>File API</td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="ft_underline" id="h5sFileApi">Not-Support</td>
			</tr>
			<tr>
				<td>History API</td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="ft_underline" id="h5sHistoryApi">Not-Support</td>
			</tr>
			<tr>
				<td>Canvas</td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="ft_underline" id="h5sCanvas">Not-Support</td>
			</tr>
			<tr>
				<td>Video</td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="ft_underline" id="h5sVideo">Not-Support</td>
			</tr>
			<tr>
				<td>Audio</td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="ft_underline" id="h5sAudio">Not-Support</td>
			</tr>
			<tr>
				<td>Form Data</td>
				<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="ft_underline" id="h5sFormData">Not-Support</td>
			</tr>
		</tbody>
	</table>

	<script type="text/javascript">
		var fileApi 	= document.getElementById("h5sFileApi");
		var historyApi 	= document.getElementById("h5sHistoryApi");
		var canvas 		= document.getElementById("h5sCanvas");
		var video 		= document.getElementById("h5sVideo");
		var audio 		= document.getElementById("h5sAudio");
		var formData 	= document.getElementById("h5sFormData");

		var divContent 	= document.getElementsByClassName("content");
		var h2Tag 		= document.getElementsByTagName("h2");

		var supportCount = document.getElementById("supportCount");
		var sco 		= 0;
		var scoMax 		= 6;

		if(h5s.fileApi 		== true) {
			fileApi.innerHTML 		= "Support";
			sco = sco+1;
		}
		if(h5s.historyApi 	== true) {
			historyApi.innerHTML 	= "Support";
			sco = sco+1;
		}
		if(h5s.canvas 		== true) {
			canvas.innerHTML 		= "Support";
			sco = sco+1;
		}
		if(h5s.video 		== true) {
			video.innerHTML 		= "Support";
			sco = sco+1;
		}
		if(h5s.audio 		== true) {
			audio.innerHTML 		= "Support";
			sco = sco+1;
		}
		if(h5s.formData 	== true) {
			formData.innerHTML 		= "Support";
			sco = sco+1;
		}

		supportCount.innerHTML = "<b>"+sco+" dari "+scoMax+"</b>";

		if(sco == 6) {
			divContent[0].innerHTML = "Browser anda mendukung seluruh<br>HTML5 yang kami butuhkan.";
			h2Tag[0].innerHTML 		= "Browser mendukung HTML5.";
			h2Tag[0].style 			= "background: #248E75;";
			document.title 			= "Mendukung HTML5";
		}
	</script>
</div>