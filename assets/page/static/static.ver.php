<!DOCTYPE html>
<HTML lang='id-ID'>
    <HEAD>
	    <meta charset="UTF-8" />
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1" />
	    <meta http-equiv='pragma' content='no-cache' />
	    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
	    <title>SinTaskFW Ver</title>
	</HEAD>
	<BODY>
		<style>
			* {
			    margin:0; 
			    padding:0;
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
		    	letter-spacing: -4px;
		    }
		    h2 {
		    	color: #FFFFFF; 
		        background: #45898F; 
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
		   		margin-left: 20%;
			    text-align: left;
			    box-sizing: border-box;
		    }
		</style>

		<h1>SFW,</h1>
		<h2>Keterangan Versi SinTaskFW</h2>
		<div class="content">
		    Sistem/Aplikasi/Website ini menggunakan SinTask Framework, halaman ini dapat dibuka karena Router Engine dari SinTaskFW belum dimodifikasi/ubah.
		</div>
		<div class="contentLeft">
			<table class="centered">
				<tbody>
					<tr>
						<td>Versi</td>
						<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
						<td class="ft_underline"><?php echo $__VERSION__;?></td>
					</tr>
					<tr>
						<td>Codename</td>
						<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
						<td class="ft_underline"><?php echo $__CODENAME__;?></td>
					</tr>
					<tr>
						<td>Nama Versi</td>
						<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
						<td class="ft_underline"><?php echo $__VERNAME__;?></td>
					</tr>
					<tr>
						<td>Versi Komparasi</td>
						<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
						<td class="ft_underline"><?php echo $__VERCOMPARE__;?></td>
					</tr>
					<tr>
						<td>Tgl Update</td>
						<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
						<td class="ft_underline"><?php echo $__DATE_UPDATED__;?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</BODY>
</HTML>