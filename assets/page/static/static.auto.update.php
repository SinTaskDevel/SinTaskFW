<?php

	/* Halaman Statis untuk -
	 * Auto-Update
	 */
	
	$sintaskGet = $_GET["to"];
	$latestVer 	= $_GET['ver'];
	if($sintaskGet == "step1" && !!$latestVer) {
		// STEP 1
		$local_file     	= $__DOC_ROOT__.'/protected/data/download/file.zip';
		$github_source_api 	= 'https://api.github.com/repos/sintaskdevel/sintaskfw/releases/latest';
		$download_url1  	= 'https://api.github.com/repos/SinTaskDevel/SinTaskFW/zipball/'.$latestVer;

		$sleepTime  = 1;        // 1 sec
		$usleepTime = 1000000;  // 1 sec

		header('Content-Type: text/octet-stream');
		header('Cache-Control: no-cache');

		function stream_notification_callback($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max) {
		    
		    $sleepTime  = 80000; // 0.008 s

		    switch($notification_code) {
		        case STREAM_NOTIFY_RESOLVE:
		        case STREAM_NOTIFY_AUTH_REQUIRED:
		        case STREAM_NOTIFY_COMPLETED:
		        case STREAM_NOTIFY_FAILURE:
		        case STREAM_NOTIFY_AUTH_RESULT:
		            var_dump($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max);
		            /* Ignore */
		            break;

		        case STREAM_NOTIFY_REDIRECTED:
		            usleep($sleepTime);
		            
		            $messages = "Mengalihkan";
		            
		            $progress = 0;
		            
		            $d = array('message' => $messages , 'progress' => $progress);
		            echo json_encode($d) . PHP_EOL;
		            
		            ob_flush();
		            flush();
		            
		            break;

		        case STREAM_NOTIFY_CONNECT:
		            usleep($sleepTime);
		            
		            $messages = "Terhubung...";
		            
		            $progress = 0;
		            
		            $d = array('message' => $messages , 'progress' => $progress);
		            echo json_encode($d) . PHP_EOL;
		            
		            ob_flush();
		            flush();
		            
		            break;

		        case STREAM_NOTIFY_FILE_SIZE_IS:
		            usleep($sleepTime);
		            
		            $messages = "Mendapatkan ukuran file";
		            
		            $progress = 0;
		            
		            $d = array('message' => $messages , 'progress' => $progress);
		            echo json_encode($d) . PHP_EOL;
		            
		            ob_flush();
		            flush();
		            
		            break;

		        case STREAM_NOTIFY_MIME_TYPE_IS:
		            usleep($sleepTime);
		            
		            $messages = "Menemukan tipe file";
		            
		            $progress = 0;
		            
		            $d = array('message' => $messages , 'progress' => $progress);
		            echo json_encode($d) . PHP_EOL;
		            
		            ob_flush();
		            flush();
		            
		            break;

		        case STREAM_NOTIFY_PROGRESS:
		            usleep($sleepTime);
		            
		            $messages = "Mengunduh <u>".fileSizeFrByToAll($bytes_transferred, 2)."</u> dari <u>".fileSizeFrByToAll($bytes_max, 2)."</u>";
		            
		            $progress1  = $bytes_transferred/$bytes_max;
		            $progress2  = $progress1*100;
		            $progress   = round($progress2);
		            
		            $d = array('message' => $messages , 'progress' => $progress);
		            echo json_encode($d) . PHP_EOL;
		            
		            ob_flush();
		            flush();
		            
		            break;
		    }
		}

		$ctx = stream_context_create(array('http' => array(
			'header' => 'User-Agent: sintaskfw',
		)));
		stream_context_set_params($ctx, array("notification" => "stream_notification_callback"));

		$save = file_get_contents($download_url1, false, $ctx);
		file_put_contents($local_file, $save);
	} else if($sintaskGet == "step2") {
		// STEP 2
		header('Content-Type: text/octet-stream');
	    header('Cache-Control: no-cache');

	    $file   = $__DOC_ROOT__.'/protected/data/download/file.zip';

	    $zip    = new ZipArchive;
	    $res    = $zip->open($file);
	    if ($res === TRUE) {
			$dirName = trim($zip->getNameIndex(0), '/');

	        $zip->extractTo($__DOC_ROOT__.'/protected/data/tmp/');
	        $zip->close();
	        
	        unlink($file);

			$oldDest   = $__DOC_ROOT__.'/protected/data/tmp/'.$dirName;
			$newDest   = $__DOC_ROOT__.'/protected/data/tmp/sintaskfw';

			rcopy($oldDest, $newDest);
			rrmdir($oldDest);
	        
	        $d = array('message' => "File telah di ekstrak", 'status' => 200);
	        echo json_encode($d) . PHP_EOL;
	    } else {
	        
	        $d = array('message' => "Gagal mengekstrak file", 'status' => 400);
	        echo json_encode($d) . PHP_EOL;
	    }
	} else if($sintaskGet == "step3") {
		// STEP 3
		header('Content-Type: text/octet-stream');
	    header('Cache-Control: no-cache');

	    $file   = $__DOC_ROOT__.'/protected/data/tmp/sintaskfw';
	    $dest   = $__DOC_ROOT__;
	    
	    rcopy($file."/.htaccess", $dest."/.htaccess");
	    rcopy($file."/index.php", $dest."/index.php");
	    rcopy($file."/assets", $dest."/assets");
	    rrmdir($file);

	    $d = array('message' => "SintaskFW telah diperbarui", 'status' => 200);
	    echo json_encode($d) . PHP_EOL;
	} else {
		?>
		<html>
			<head>
				<title>SintaskFW Auto-Update</title>
				<script type="text/javascript" src="<?php echo $__BASE_URL__;?>/assets/script/js/lib/jquery.min.js"></script>
			</head>
			<body>
				<style>
					body, html {
						font-family: Arial, sans-serif;
					}
					body {
						background: #FFF;
					    background-repeat: repeat;
					    background-position: center center;
					    background-attachment: fixed;
					    line-height: 1.4em;
					}
					div.contentArea {
						padding: 20px 200px 20px 200px;
						margin: 0px auto;
						font-size: 16px;
						color: #222;
					}
					div.contentTwo {
						padding: 20px;
					}
					div.borderLine {
						margin-top: 15px;
						padding-top: 15px;
						border-top: 1px solid #DADADA;
					}
					div.borderSpaceMini {
						margin-top: 5px;
						padding-top: 5px;
					}
					div.borderSpaceMiniSuper {
						margin-top: 5px;
					}
					div.borderSpace {
						margin-top: 20px;
						padding-top: 20px;
					}
					span.thisTagging {
						font-size: 13px;
						padding: 1px 5px;
						border: 1px solid #EAEAEA;
						background: #EAEAEA;
						color: #555;
						font-weight: bolder;
						border-radius: 4px;
					}
					.noted {
						padding: 5px 20px;
						border-left: 3px solid #EA9F2D;
						color: #555;
					}
					.orangeBubble {
						font-size: 13px;
						padding: 1px 5px;
						border: 1px solid #EA9F2D;
						background: #EA9F2D;
						color: #FFF;
						font-weight: bolder;
						border-radius: 2px;
						display: inline-block;
					}
					input[type='submit'] {
						padding: 2px 6px;
						font-size: 13px;
						border: 1px solid #DADADA;
						border-radius: 4px;
						color: #555;
						margin-top: 2px;
						margin-bottom: 2px;
						cursor: pointer;
						transition: all 0.2s linear 0s;
					}
					input[type='submit']:hover {
						box-shadow: 0px 0px 4px #111;
					}
					button {
					    padding: 2px 6px;
						font-size: 13px;
						border: 1px solid #DADADA;
						border-radius: 4px;
						color: #555;
						margin-top: 2px;
						margin-bottom: 2px;
						cursor: pointer;
						transition: all 0.2s linear 0s;
					}
					button:hover {
					    box-shadow: 0px 0px 4px #111;
					}
					button:disabled {
					    box-shadow: 0px 0px 4px #111;
					    opacity: 0.5;
					}
					ul {
						margin-left: 20px;
					}
				</style>

				<div class="contentArea">
				    <b class="fontSize25px">SintaskFW Auto-Update / Versi saat ini <span id="currentVer"><?php echo $__VERNAME__;?></span></b>
				    <div class="borderSpace"></div>
				    <div id="thisNotedUser" class="noted">
				    	<div class="orangeBubble">Mohon diperhatikan</div>
				    	<div class="borderSpaceMini"></div>
				    	Perlu diketahui, dengan menekan tombol <b>Periksa update</b> maka akan mengembalikan segala perubahan pada direktori <span class="thisTagging">/assets</span>, file <span class="thisTagging">index.php</span> dan <span class="thisTagging">.htaccess</span> menjadi default SinTaskFW.
				    	<div class="borderSpaceMini"></div>
				    	Lingkup direktori pekerjaan atau proyek web anda pada <span class="thisTagging">/myassets</span>, <span class="thisTagging">/images</span>, dan <span class="thisTagging">/protected</span>. Anda juga diperkenankan menambah direktori-direktori lainnya untuk keperluan anda.
				    </div>
				    <div class="borderSpaceMini"></div>
				    Klik tombol <b>Periksa update</b> untuk mendapatkan update terkini dari SintaskFW.
				    <div class="borderSpaceMini"></div>
				    <button id="checkUpdate" onclick="ajaxChecker();">Periksa update</button>
				    <div class="borderLine"></div>
				    <div id="progressor" style="background:#555; width:0%; height:10px;"></div>
				    <div class="borderSpaceMini"></div>
				    <div class="codeNoted" id="divProgress"></div>
				    <div class="borderSpaceMini"></div>
				</div>

				<script>
					let currentTagVersion = '';

				    function doClear() {
				        document.getElementById("divProgress").innerHTML = "";
				    }

				    function logMessage(message) {
				        document.getElementById("divProgress").innerHTML += message + '<br />';
				    }
				    
				    function logMessageOne(message) {
				        document.getElementById("divProgress").innerHTML = message + '<br />';
				    }
				    
				    function ajaxChecker() {
				        sjqNoConflict("#checkUpdate").prop("disabled", true);
				        sjqNoConflict("#thisNotedUser").remove();
				        
				        if (!window.XMLHttpRequest) {
				            logMessage("Browser anda tidak mendukung XMLHttpRequest, silahkan update browser anda");
				            return;
				        }

				        logMessage("Memulai mengunduh...");
				        
				        try {
				            var xhr = new XMLHttpRequest();
				            var next = false;
				            
				            xhr.onload = function() {
				                var new_response = JSON.parse( xhr.responseText );
				                var tag_name = new_response.tag_name;
				                
				                if(next == true) {
				                    logMessage("Versi terbaru telah tersedia - <b>"+tag_name+"</b>");
				                    logMessage("Mencoba mengunduh dari server...");
				                    
				                    setTimeout(function(){
				                        ajaxStream();
				                    },2000);
				                }
				            };
				            xhr.onerror = function() { 
				                logMessage("Error"); 
				            };
				            xhr.onreadystatechange = function() {
				                try {
				                    if (xhr.readyState == 4) {
				                        var new_response = JSON.parse( xhr.responseText );
										var tag_name = new_response.tag_name;
										currentTagVersion = tag_name;

				                        if(tag_name == "<?php echo $__VERNAME__;?>") {
				                            logMessageOne("SintaskFW anda up-to-date dengan versi v"+tag_name);
				                            
				                            sjqNoConflict("#checkUpdate").prop("disabled", false);
				                        } else {
				                        	next = true;
				                        }
				                    }   
				                }
				                catch (e) {
				                    
				                }
				            };

				            var url1 = "https://api.github.com/repos/sintaskdevel/sintaskfw/releases/latest";

				            xhr.open("GET", url1, true);
				            xhr.send("Making request...");      
				        }
				        catch (e) {
				            logMessage("Error - Exception: " + e);
				        }
				    }
				    
				    function ajaxFinish() {
				        if (!window.XMLHttpRequest) {
				            logMessage("Browser anda tidak mendukung XMLHttpRequest, silahkan update browser anda");
				            return;
				        }
				        
				        try {
				            var xhr = new XMLHttpRequest();
				            var next = false;
				            
				            xhr.onload = function() {
				                var new_response = JSON.parse( xhr.responseText );
				                
				                if(next == true) {
				                    logMessage("Selesai");

									document.getElementById('currentVer').innerHTML = currentTagVersion;
				                }
				            };
				            xhr.onerror = function() { 
				                logMessage("Error"); 
				            };
				            xhr.onreadystatechange = function() {
				                try {
				                    if (xhr.readyState == 4) {
				                        var new_response = JSON.parse( xhr.responseText );
				                        var status  = new_response.status;
				                        var message = new_response.message;
				                        
				                        logMessageOne(message);

				                        if(status == 200) {
				                            next = true;
				                        } else {
				                            next = false;
				                        }
				                    }   
				                }
				                catch (e) {
				                    
				                }
				            };

				            var url1 = "?to=step3";

				            xhr.open("GET", url1, true);
				            xhr.send("Making request...");      
				        }
				        catch (e) {
				            logMessage("Error - Exception: " + e);
				        }
				    }
				    
				    function ajaxExtract() {
				        if (!window.XMLHttpRequest) {
				            logMessage("Browser anda tidak mendukung XMLHttpRequest, silahkan update browser anda");
				            return;
				        }
				        
				        try {
				            var xhr = new XMLHttpRequest();
				            var next = false;
				            
				            xhr.onload = function() {
				                var new_response = JSON.parse( xhr.responseText );
				                
				                if(next == true) {
				                    logMessage("Memindahkan data file...");
				                    
				                    setTimeout(function(){
				                        ajaxFinish();
				                    },2000);
				                }
				            };
				            xhr.onerror = function() { 
				                logMessage("Error"); 
				            };
				            xhr.onreadystatechange = function() {
				                try {
				                    if (xhr.readyState == 4) {
				                        var new_response = JSON.parse( xhr.responseText );
				                        var status  = new_response.status;
				                        var message = new_response.message;
				                        
				                        logMessageOne(message);

				                        if(status == 200) {
				                            next = true;
				                        } else {
				                            next = false;
				                        }
				                    }   
				                }
				                catch (e) {
				                    
				                }
				            };

				            var url1 = "?to=step2";

				            xhr.open("GET", url1, true);
				            xhr.send("Making request...");      
				        }
				        catch (e) {
				            logMessage("Error - Exception: " + e);
				        }
				    }

				    function ajaxStream() {
				        if (!window.XMLHttpRequest) {
				            logMessage("Browser anda tidak mendukung XMLHttpRequest, silahkan update browser anda");
				            return;
				        }

				        try {
				            var xhr = new XMLHttpRequest();  
				            xhr.previous_text = '';

				            xhr.onload = function() {
				                document.getElementById('progressor').style.width = "0%";
				                doClear();
				                logMessage("Unduh update berhasil"); 
				                logMessage("Memasang update..."); 
				                
				                setTimeout(function(){
				                    ajaxExtract();
				                },1000);
				            };
				            xhr.onerror = function() { 
				                logMessage("Error"); 
				            };
				            xhr.onreadystatechange = function() {
				                try {
				                    if (xhr.readyState > 2) {
				                        var new_response = xhr.responseText.substring(xhr.previous_text.length);
				                        var result = JSON.parse( new_response );
				                        
				                        logMessageOne(result.message);

				                        document.getElementById('progressor').style.width = result.progress + "%";
				                        xhr.previous_text = xhr.responseText;
				                    }   
				                }
				                catch (e) {
				                    
				                }
				            };

				            var url1 = `?to=step1&ver=${currentTagVersion}`;

				            xhr.open("GET", url1, true);
				            xhr.send("Making request...");      
				        }
				        catch (e) {
				            logMessage("Error - Exception: " + e);
				        }
				    }
				</script>
			</body>
		</html>
		<?php
	}

?>