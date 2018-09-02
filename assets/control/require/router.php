<?php
	/* Deteksi jika Page dimuat ulang dari awal */
	if(
		$_SESSION["_SFW_loadingPage"] 	== true 	&&
		$__XHR_STATUS__ 				== false
	) {
		$_SESSION["_SFW_loadingPage"] = false;
	}

	/* Pindahkan GET Param ke SESSION */
	foreach($_GET as $key => $value) {
		if(isset($_SESSION[$_SESSION['globalSecureToken'].'postGET'][$key])) {
			unset($_SESSION[$_SESSION['globalSecureToken'].'postGET'][$key]);
			$_SESSION[$_SESSION['globalSecureToken'].'postGET'][$key] = null;
		}

		$_SESSION[$_SESSION['globalSecureToken'].'postGET'][$key] = $value;
	}
	/* Pindahkan POST Param ke SESSION */
	foreach($_POST as $key => $value) {
		if(isset($_SESSION[$_SESSION['globalSecureToken'].'postPOST'][$key])) {
			unset($_SESSION[$_SESSION['globalSecureToken'].'postPOST'][$key]);
			$_SESSION[$_SESSION['globalSecureToken'].'postPOST'][$key] = null;
		}

		$_SESSION[$_SESSION['globalSecureToken'].'postPOST'][$key] = $value;
	}
	/* Pindahkan FILES Param ke SESSION */
	foreach($_FILES as $key => $value) {
		$__TMP_DIR_FILE__ = $__DOC_ROOT__."/protected/data/tmp";
			
		/* Check Directory EXIST */
		if(!is_dir($__TMP_DIR_FILE__)) {
		    mkdir($__TMP_DIR_FILE__, 0755, true);
		}

		/* Pindahkan FILES ke tmp Directory */
		$tmpFile = $__TMP_DIR_FILE__."/".getRandomPlusDate(5).".tmp";
		move_uploaded_file($_FILES[$key]['tmp_name'], $tmpFile);

		/* Rename tmp_name menjadi Value baru */
		$_FILES[$key]['tmp_name'] = $tmpFile;

		if(isset($_SESSION[$_SESSION['globalSecureToken'].'postFILES'][$key])) {
			unset($_SESSION[$_SESSION['globalSecureToken'].'postFILES'][$key]);
			$_SESSION[$_SESSION['globalSecureToken'].'postFILES'][$key] = null;
		}

		$_SESSION[$_SESSION['globalSecureToken'].'postFILES'][$key] = $value;
		$_SESSION[$_SESSION['globalSecureToken'].'postFILES'][$key]['tmp_name'] = $tmpFile;
	}

	if($_SESSION['sintaskFWActualURL'] == "" || $_SESSION['sintaskFWActualURL'] == null) {
		$_SESSION['sintaskFWActualURL'] = "";
	} else {
		$__ACTUAL_URL__ = $_SESSION['sintaskFWActualURL'];
	}

	/* Router Core */
	switch ($__SEGMEN__[2]) {

		case "s-ajaxify" :
		case "s-api" :
			/* Halaman dinamis request ajax -> [DYNAMIC_PAGE] -> [domain]/api/[anything] */
			if(
				$__SEGMEN__[3] 	!= "" 		&& 
				$__SEGMEN__[3] 	!= null 	&& 
				$__XHR_STATUS__	== true 
			) {
				header("Content-type: application/json");
				include(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['api'], $thisReqPathLoginPrefix, $thisReqPath, 3, ""));
			} else {
				require($__ZERO__);
			}

			/* Jika request setelah Page di load 100% */
			if($_SESSION["_SFW_loadingPage"] == true) {
				clearAllSessInput();
			}

			break;

		case "sec-s-ajaxify" :
		case "sec-s-api" :
			$__FTOKEN__ = $sintaskSess->get("globalSecureToken");
			$__STOKEN__ = $_POST["tokenizing"];
			/* Halaman dinamis request ajax -> [DYNAMIC_PAGE] -> [domain]/api/[anything] */
			if(
				$__SEGMEN__[3] 	!= "" 			&& 
				$__SEGMEN__[3] 	!= null 		&& 
				$__FTOKEN__ 	== $__STOKEN__ 
			) {
				header("Content-type: application/json");
				include(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['api_sec'], $thisReqPathLoginPrefix, $thisReqPath, 3, ""));
			} else {
				require($__ZERO__);
			}

			/* Jika request setelah Page di load 100% */
			if($_SESSION["_SFW_loadingPage"] == true) {
				clearAllSessInput();
			}

			break;

		case "s-dl" :
			if(
				$__SEGMEN__[3] 	!= ""		&&
				$__SEGMEN__[3] 	!= null 	&&
				!ctype_space($__SEGMEN__[3])
			) {
				$__LOWER_CASE_SEG3__ = strtolower($__SEGMEN__[3]);
				if($__LOWER_CASE_SEG3__ == "direct") {
					include($__DOC_ROOT__.$requirePath['static']."/static.direct.download".$__FILE_EXTENSION__);
				} else if($__LOWER_CASE_SEG3__ == "ndr") {
					include($__DOC_ROOT__.$requirePath['static']."/static.not.direct.download".$__FILE_EXTENSION__);
				} else {
					require($__ZERO__);
				}
			} else {
				require($__ZERO__);
			}

			break;

		case "s-update" :
			if($__MY_AUTO_UPDATE__["AUTO_UPDATE_PAGE"] == true) {
				if(
					$__SEGMEN__[3] 	!= ""		&&
					$__SEGMEN__[3] 	!= null 	&&
					!ctype_space($__SEGMEN__[3])
				) {
					if($__SEGMEN__[3] == $__MY_AUTO_UPDATE__["AUTO_UPDATE_SECRET_KEY"]) {
						include($__DOC_ROOT__.$requirePath['static']."/static.auto.update".$__FILE_EXTENSION__);
					}
				}
			} else {
				continue;
			}

			break;

		case "s-dcss" :
			if(
				$__SEGMEN__[3] != "" &&
				$__SEGMEN__[3] != null
			) {
				header("Content-type: text/css");
				include($__DOC_ROOT__.$requirePath['static']."/dcss/".$__SEGMEN_PURE__[3].$__FILE_EXTENSION__);
			}

			break;

		case "..srv-time-get" :
			$__FTOKEN__ = $sintaskSess->get("globalSecureToken");
			$__STOKEN__ = $_POST["tokenizing"];

			if($__FTOKEN__ == $__STOKEN__) {
				header("Content-type: application/json");
				
				$response = [
					"status"        => 200,
					"timeupdate"	=> microTimeStamp(),
				];

				echo json_encode($response, JSON_PRETTY_PRINT);
			}

			break;

		case "..srv-time-js" :
			header("Content-type: text/javascript");
			include($__DOC_ROOT__.$requirePath['static']."/djs/srvtime".$__FILE_EXTENSION__);
			break;

		case "..sfw" :
			if(
				$__SEGMEN__[3] == "..ver"
			) {
				include($__DOC_ROOT__.$requirePath['static']."/static.ver".$__FILE_EXTENSION__);
			}

			break;

		case "s-404":
			if(
				$__XHR_STATUS__ 	== true 				&& 
				$__END_SEGMEN_DOT__ == "jssintasktemplate" 	&&
				$__FTOKEN__ 		== $__STOKEN__
			) {
				/* 404 JS-Template */
				$pathRender = $__DOC_ROOT__.$requirePath['template']."/default.404.php";

				/* Mengambil akhiran nama file */
				$explodePath = explode("/", $pathRender);
				$endPath = end($explodePath);

				$controlRender = $__DOC_ROOT__.$requirePath['control']."/".$endPath;

				/* HTML Rendering */
				ob_start();
				if(file_exists($controlRender)) {
					include($controlRender);
				}
			    include($pathRender);
			    $varRender = ob_get_contents(); 
			    ob_end_clean();

			    /* Tunjukan HTML rendering ke JS SinTask Standard Format */
				if($_GET['type'] == 'content') {
					if($__MY_CORE__["AES_SECURE_SPA_TRANSF"] == true) {
						echo renderHTMLToJSENC($varRender);
					} else {
						echo renderHTMLToJS($varRender);
					}
				}
			} else if(
				$__XHR_STATUS__ 	== true 		&& 
				$__END_SEGMEN_DOT__ == "latecss" 	&&
				$__FTOKEN__ 		== $__STOKEN__
			) {
				/* 404 CSS-Template */
				$pathRender = $__DOC_ROOT__.$requirePath['latecss']."/default.404.php";
					
				/* Render CSS - LateCSS agar ukuran lebih kecil */
				ob_start();
			    include($pathRender);
			    $varRender = ob_get_contents(); 
				ob_end_clean();
				
				echo toSingleLine($varRender);
			}
			break;

		default :
			$__FTOKEN__ = $sintaskSess->get("globalSecureToken");
			$__STOKEN__ = $sintaskFW->post("tokenizing");

			/* Halaman dinamis request Page & SPA -> [DYNAMIC_PAGE] -> [domain]/[anything] */
			if(
				$__XHR_STATUS__ 	== true 				&& 
				$__END_SEGMEN_DOT__ != "jssintasktemplate" 	&& 
				$__END_SEGMEN_DOT__ != "jsd" 				&& 
				$__END_SEGMEN_DOT__ != "cssd" 				&& 
				$__END_SEGMEN_DOT__ != "latecss" 			&&
				$__END_SEGMEN_DOT__ != "staycontent" 		&&
				$__END_SEGMEN_DOT__ != "stayheader" 		&&
				$__END_SEGMEN_DOT__ != "stayfooter"			&&
				$__FTOKEN__ 		== $__STOKEN__
			) {
				/* Menetapkan $__ACTUAL_URL__ */
				$_SESSION['sintaskFWActualURL'] = $__DYN_ACTUAL_URL__;
				$__ACTUAL_URL__ = $_SESSION['sintaskFWActualURL'];

				/* [SPA] XHR / AJAX */
				/* GENERAL FIRST */
				if(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['general'], $thisReqPathLoginPrefix, $thisReqPath, 2, "") != $__ZERO__) {
					/* [OTHER] Jika halaman Normal-General */
					header("Content-type: text/javascript");
					?>
						sjqNoConflict("html").remove();
						location.assign(document.URL);
					<?php
					die();
				}
				
				/* SPA SECOND */
				header("Content-type: application/json");
				if(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['template'], $thisReqPathLoginPrefix, $thisReqPath, 2, "") != $__ZERO__) {
					$__META_PATH__ = fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['template'], $thisReqPathLoginPrefix, $thisReqPath, 2, "");

					$normalizingPage = "";
					if(pureUrlPage($__BASE_URL__) == $__BASE_URL__) {
						$normalizingPage = "/";
					}

					echo initialJson(
						$sintaskNewMeta->getTitleMeta($__META_PATH__), 
						pureUrlPage($__BASE_URL__).$normalizingPage.".latecss", 
						pureUrlPage($__BASE_URL__).$normalizingPage.".jssintasktemplate?type=content"
					);
					$_SESSION['404_DETECT'] = false;
				} else {
					/* Tidak menemukan SPA tidak ke $__ZERO__ */
					$__META_PATH__ = fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['template'], "default", $thisReqPath, 2, "");
					echo notFound404Template($sintaskNewMeta->getTitleMeta($__META_PATH__));
					$_SESSION['404_DETECT'] = true;
				}
			} else if(
				$__XHR_STATUS__ 	== true 				&& 
				$__END_SEGMEN_DOT__ == "jssintasktemplate" 	&&
				$__FTOKEN__ 		== $__STOKEN__
			) {
				/* [SPA] jika halaman .jssintasktemplate (JavaSciprt SinTask Template) */
				header("Content-type: text/javascript");
				if(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['template'], $thisReqPathLoginPrefix, $thisReqPath, 2, ".jssintasktemplate") != $__ZERO__) {

					/* Custom Template */
					$pathRender = fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['template'], $thisReqPathLoginPrefix, $thisReqPath, 2, ".jssintasktemplate");

					/* Mengambil akhiran nama file */
					$explodePath = explode("/", $pathRender);
					$endPath = end($explodePath);

					$controlRender = $__DOC_ROOT__.$requirePath['control']."/".$endPath;

					/* HTML Rendering */
					ob_start();
					if(file_exists($controlRender)) {
						include($controlRender);
					}
				    include($pathRender);
				    $varRender = ob_get_contents(); 
				    ob_end_clean();

				    /* Tunjukan HTML rendering ke JS SinTask Standard Format */
					if($_GET['type'] == 'content') {
						if($__MY_CORE__["AES_SECURE_SPA_TRANSF"] == true) {
							echo renderHTMLToJSENC($varRender);
						} else {
							echo renderHTMLToJS($varRender);
						}
					}
				} else {
					/* Tidak menemukan SPA tidak ke $__ZERO__ */
					/* 404 JS-Template */
					$pathRender = $__DOC_ROOT__.$requirePath['template']."/default.404.php";

					/* Mengambil akhiran nama file */
					$explodePath = explode("/", $pathRender);
					$endPath = end($explodePath);

					$controlRender = $__DOC_ROOT__.$requirePath['control']."/".$endPath;

					/* HTML Rendering */
					ob_start();
					if(file_exists($controlRender)) {
						include($controlRender);
					}
				    include($pathRender);
				    $varRender = ob_get_contents(); 
				    ob_end_clean();

				    /* Tunjukan HTML rendering ke JS SinTask Standard Format */
					if($_GET['type'] == 'content') {
						if($__MY_CORE__["AES_SECURE_SPA_TRANSF"] == true) {
							echo renderHTMLToJSENC($varRender);
						} else {
							echo renderHTMLToJS($varRender);
						}
					}
				}
			} else if(
				$__XHR_STATUS__ 	== true 				&& 
				$__END_SEGMEN_DOT__ == "latecss"
			) {
				/* [SPA] Jika halaman adalah .latecss (CSS late load) */
				header("Content-type: text/css");
				if(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['latecss'], $thisReqPathLoginPrefix, $thisReqPath, 2, ".latecss") != $__ZERO__) {
					$pathRender = fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['latecss'], $thisReqPathLoginPrefix, $thisReqPath, 2, ".latecss");
					
					/* Render CSS - LateCSS agar ukuran lebih kecil */
					ob_start();
				    include($pathRender);
				    $varRender = ob_get_contents(); 
					ob_end_clean();
					
					echo toSingleLine($varRender);
				} else {
					/* Tidak menemukan SPA tidak ke $__ZERO__ */
					/* 404 CSS-Template */
					$pathRender = $__DOC_ROOT__.$requirePath['latecss']."/default.404.php";
						
					/* Render CSS - LateCSS agar ukuran lebih kecil */
					ob_start();
				    include($pathRender);
				    $varRender = ob_get_contents(); 
					ob_end_clean();
					
					echo toSingleLine($varRender);
				}

				/* SPA PAGE END */
				$_SESSION["_SFW_loadingPage"] = true;
				clearAllSessInput();
			} else if(
				$__XHR_STATUS__ 	== true 				&& 
				$__END_SEGMEN_DOT__ == "staycontent"		&&
				$__FTOKEN__ 		== $__STOKEN__
			) {
				header("Content-type: text/javascript");
				$pathRender = $__DOC_ROOT__.$requirePath['stay']."/stay_content.php";

				/* HTML Rendering */
				ob_start();
			    include($pathRender);
			    $varRender = ob_get_contents(); 
			    ob_end_clean();

			    /* Tunjukan HTML rendering ke JS SinTask Standard Format */
			    if($__MY_CORE__["AES_SECURE_SPA_TRANSF"] == true) {
					echo renderHTMLToJSStayENC("content", $varRender);
			    } else {
			    	echo renderHTMLToJSStay("content", $varRender);
			    }
			} else if(
				$__XHR_STATUS__ 	== true 				&& 
				$__END_SEGMEN_DOT__ == "stayheader" 		&& 
				$__FTOKEN__ 		== $__STOKEN__
			) {
				header("Content-type: text/javascript");
				$pathRender = $__DOC_ROOT__.$requirePath['stay']."/stay_header.php";

				/* HTML Rendering */
				ob_start();
			    include($pathRender);
			    $varRender = ob_get_contents(); 
			    ob_end_clean();

			    /* Tunjukan HTML rendering ke JS SinTask Standard Format */
			    if($__MY_CORE__["AES_SECURE_SPA_TRANSF"] == true) {
					echo renderHTMLToJSStayENC("header", $varRender);
				} else {
					echo renderHTMLToJSStay("header", $varRender);
				}
			} else if(
				$__XHR_STATUS__ 	== true 				&& 
				$__END_SEGMEN_DOT__ == "stayfooter" 		&&
				$__FTOKEN__ 		== $__STOKEN__
			) {
				header("Content-type: text/javascript");
				$pathRender = $__DOC_ROOT__.$requirePath['stay']."/stay_footer.php";

				/* HTML Rendering */
				ob_start();
			    include($pathRender);
			    $varRender = ob_get_contents(); 
			    ob_end_clean();

			    /* Tunjukan HTML rendering ke JS SinTask Standard Format */
			    if($__MY_CORE__["AES_SECURE_SPA_TRANSF"] == true) {
					echo renderHTMLToJSStayENC("footer", $varRender);
				} else {
					echo renderHTMLToJSStay("footer", $varRender);
				}
			} else if(
				$__END_SEGMEN_DOT__ == "jsd" &&
				$__SEGMEN__[2] == "..jsd"
			) {
				/* [OTHER] Jika halaman adalah .jsd (JavaSciprt Dynamic) */
				$__SFW_thisIteration = 2;

				if($activeFileDynamic == "v4") {
					$__SFW_thisIteration = 3;
				}

				header("Content-type: text/javascript");
				if(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['jsd'], $thisReqPathLoginPrefix, $thisReqPath, $__SFW_thisIteration, ".jsd") != $__ZERO__) {
					echo "/* JSD-SFW */\n";
					include(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['jsd'], $thisReqPathLoginPrefix, $thisReqPath, $__SFW_thisIteration, ".jsd"));
				} else {
					/* Tidak menemukan SPA tidak ke $__ZERO__ */
					/* Not Found 404 - JS Dynamic */
					echo "console.log('%cJSD-404 / Sumber JS ini tidak ditemukan, baca selengkapnya https://fw.sintask.com/docs/error [ 3. Notice JSD-404 ]', 'font-size: 14px; color: #EA4335;');";
				}
			} else if(
				$__END_SEGMEN_DOT__ == "cssd" &&
				$__SEGMEN__[2] == "..cssd"
			) {
				/* [OTHER] Jika halaman adalah .cssd (CSS Dynamic) */
				$__SFW_thisIteration = 2;

				if($activeFileDynamic == "v4") {
					$__SFW_thisIteration = 3;
				}

				header("Content-type: text/css");
				if(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['cssd'], $thisReqPathLoginPrefix, $thisReqPath, $__SFW_thisIteration, ".cssd") != $__ZERO__) {
					echo "/* CSSD-SFW */\n";
					include(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['cssd'], $thisReqPathLoginPrefix, $thisReqPath, $__SFW_thisIteration, ".cssd"));
				} else {
					/* Tidak menemukan SPA tidak ke $__ZERO__ */
					/* Not Found 404 - CSS Dynamic */
					echo "/* CSS Dynamic tidak ditemukan */";
				}
			} else {
				if(
					$__XHR_STATUS__ == true 		&&
					$__FTOKEN__ 	!= $__STOKEN__
				) {
					header("Content-type: application/json");
					echo invalidToken($__ERROR_INVALID_MSG__, $__FTOKEN__, $__STOKEN__);
					die();
				}

				/* Menetapkan $__ACTUAL_URL__ */
				$_SESSION['sintaskFWActualURL'] = $__DYN_ACTUAL_URL__;
				$__ACTUAL_URL__ = $_SESSION['sintaskFWActualURL'];

				if(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['general'], $thisReqPathLoginPrefix, $thisReqPath, 2, "") != $__ZERO__) {
					/* General Blocker */
					$generalBlocker = $__DOC_ROOT__.$requirePath['static']."/static.general.blocker.php";

					/* [OTHER] Jika halaman adalah General/Normal */
					$generalState = fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['general'], $thisReqPathLoginPrefix, $thisReqPath, 2, "");

					/* Mengambil akhir akhir dari path (nama file) */
					$explodeGeneralPath = explode("/", $generalState);
					$endGeneralPath = end($explodeGeneralPath);

					/* Menghilangkan .php untuk keperluan EXPECT_META_LIST dari user */
					$explodeGeneralPathFileName = explode(".", $endGeneralPath);
					array_pop($explodeGeneralPathFileName);
					$expectFileName = implode(".", $explodeGeneralPathFileName);

					/* Mencari apakah file ini termasuk EXPECT_META_LIST */
					if(in_array($expectFileName, $__HTML_META_GENERAL__["EXPECT_META_LIST"])) {
						$__HTML_META_GENERAL__["DEFAULT_META"] = false;
					}

					$controlState = $__DOC_ROOT__.$requirePath['control']."/".$endGeneralPath;

					include($generalBlocker);
					if(file_exists($controlState)) {
						include($controlState);
					}

					if($__HTML_META_GENERAL__["DEFAULT_META"] == true) {
						$thisCoreGet = "doctype";
						include($__HTML_CORE_REQ__);

						$thisCoreGet = "headstart";
						include($__HTML_CORE_REQ__);

						$__META_PATH__ = fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['general'], $thisReqPathLoginPrefix, $thisReqPath, 2, "");
						echo $sintaskNewMeta->readingMeta($__META_PATH__);

						$thisCoreGet = "scripttop";
						include($__HTML_CORE_REQ__);

						$thisCoreGet = "headend";
						include($__HTML_CORE_REQ__);
					}

					include($generalState);

					if($__HTML_META_GENERAL__["DEFAULT_META"] == true) {
						$thisCoreGet = "scriptend_general";
						include($__HTML_CORE_REQ__);

						$thisCoreGet = "foothtml";
						include($__HTML_CORE_REQ__);
					}

					/* GENERAL PAGE END */
					$_SESSION["_SFW_loadingPage"] = true;
					clearAllSessInput();
				} else {
					/* [SPA] Jika halaman adalah SPA */
					$thisCoreGet = "doctype";
					include($__HTML_CORE_REQ__);

					$thisCoreGet = "headstart";
					include($__HTML_CORE_REQ__);

					/* Jika Javascript tidak aktif */
					if($__SEGMEN__[2] == "jsdisabled") {
						?><title>Javascript</title><?php
					}

					$__META_PATH__ = fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['template'], $thisReqPathLoginPrefix, $thisReqPath, 2, "");
					echo $sintaskNewMeta->readingMeta($__META_PATH__);
				
					$thisCoreGet = "scripttop";
					include($__HTML_CORE_REQ__);

					$thisCoreGet = "headend";
					include($__HTML_CORE_REQ__);

					$thisCoreGet = "bodystart";
					include($__HTML_CORE_REQ__);

					$thisCoreGet = "content";
					include($__HTML_CORE_REQ__);

					$thisCoreGet = "scriptend";
					include($__HTML_CORE_REQ__);

					$thisCoreGet = "bodyend";
					include($__HTML_CORE_REQ__);

					$thisCoreGet = "foothtml";
					include($__HTML_CORE_REQ__);
				}
			}
			break;
	}
?>