<?php

	/** 
	 * -----------------------
	 * SINTASKFW CORE FUNCTION
	 * -----------------------
	 */
	
	/* Fungsi menghasilkan array() 
	 * input : $type
	 * 			-> "pure"				-> Pure URL tanpa ? parameter
	 * 			-> "normal" or null 	-> Normal URL dengan ? dan parameter lain
	 */
	function fixURI($input) {
		$explodeURI = explode("?", $input);
		$output = $explodeURI[0];
		$trash 	= $explodeURI[1];

		return $output;
	}
	function siteSegmen($type) {
		$urlFeedback = [];

		if($type == "pure") {
			$url = explode("/", "System/".fixURI($_SERVER["REQUEST_URI"]));

			$urlCount = count($url);
			for($a=0; $a<$urlCount; $a++) {
				$urlexplode = explode("?", $url[$a]);
				array_push($urlFeedback, $urlexplode[0]);
			}
		} else if($type == "normal" || $type == "" || $type == null) {
			$url = explode("/", "System/".$_SERVER["REQUEST_URI"]);
			$urlFeedback = $url;
		} else if($type == "nofollow") {
			$url = siteSegmen("pure");

			$urlCount = count($url);
			for($a=0; $a<$urlCount; $a++) {
				$urlexplode = explode(".", $url[$a]);
				$urlend = end($urlexplode);
				if($urlend == "jssintasktemplate") {
					array_pop($urlexplode);
				}
				$finalurl = implode(".", $urlexplode);
				array_push($urlFeedback, $finalurl);
			}
		}

		return $urlFeedback;
	}

	/*
	 * Old segmen
	 */
	function segmen($segmen) {
		$url = explode("/", "SinTask/".$_SERVER["REQUEST_URI"]);
		$thisSegmen = $segmen;
		return $url[$thisSegmen];
	}
	/*
	 * Alias segmen -> siteSegmen();
	 */
	function sintaskSegmen($type) {
		return siteSegmen($type);
	}

	/*
	 * Pure URL page
	 * digunakan di pageCache.push JS disetiap -> spa_template
	 */
	function pureUrlPage($baseUrl) {
		$thisUrl 	= siteSegmen("pure");
		$result 	= $baseUrl;

		$thisUrl[0] = "";
		$thisUrl[1] = "";

		foreach($thisUrl as $value) {
			if($value!="" && $value!=null) {
 				$result = $result."/".$value;
			}
		}

		return $result;
	}

	/*
	 * Pure URL page + Get
	 * digunakan di pageCache.push JS disetiap -> spa_template
	 */
	function pureUrlPageWithGet($baseUrl) {
		$thisUrl 	= siteSegmen("normal");
		$result 	= $baseUrl;

		$thisUrl[0] = "";
		$thisUrl[1] = "";

		foreach($thisUrl as $value) {
			if($value!="" && $value!=null) {
 				$result = $result."/".$value;
			}
		}

		return $result;
	}

	/* 
	 * Memperbaiki Segmen URL
	 * Pop dari array $__SEGMEN__ jika element terakhir = empty / null
	 */
	function fixedTheSegmen(&$inputSegmen) {
		if( end($inputSegmen)!="" && end($inputSegmen)!=null && !ctype_space(end($inputSegmen)) ) {
			return true;
		} else {
			if(count($inputSegmen) > 3) {
				array_pop($inputSegmen);
				fixedTheSegmen($inputSegmen);
			} else {
				return true;
			}
		}
	}

	/* SinTaskFW Routing Algorithm */
	/* v4 Terakhir dimodifikasi 15/Apr/2018 [Release]			Aditya Wikardiyan - Web Dev
	 * v3 Terakhir dimodifikasi 07/Des/2017 [Drop/Cancel] 		Aditya Wikardiyan - Web Dev
	 * v2 Terakhir dimodifikasi 26/Mar/2017 [Deprecated]		Aditya Wikardiyan - Web Dev
	 *
	 * Ubah nama function menjadi 'fileDynamic' yang akan diaktifkan (Ready) 
	 */
	$activeFileDynamic = "v4";
	
	if($activeFileDynamic == "v2") {
		/* 	(v2) dari fileDynamic - mengutamakan login/notlogin -> both 
		 */
		function oneOneSortCount($input) {
			$return = 0;

			if($input > 2) {
				while($input > 1) {
					$return = $return+$input;
					$input = $input-1;
				}
			} else {
				$return = $input;
			}

			return $return;
		}
		function fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath, $thisReqPathLoginPrefix, $thisReqPath, $startIterationFrom, $replacement = "") {
			$thisReqPathDefault = $thisReqPath;
			$thisReqPathLoginPrefixDefault = $thisReqPathLoginPrefix;

			$scanPath = $thisReqPathDefault.$requirePath."/";
			$scandirPath = scandir($scanPath);

			$urlFile = "";
			for( $sg = $startIterationFrom; $sg < count($__SEGMEN__); $sg++ ) {
				$urlFile .= ".".$__SEGMEN__[$sg];
			}
			
			/* Hapus dobel ekstensi file */
			if($replacement != "" && $replacement != null) {
				$urlFile = str_replace($replacement, "", $urlFile);
			}

			$urlFileNotChange = $urlFile;
			$resultArrayScan = "";

			$__SEGMEN_ABS__ = siteSegmen("pure");

			$sgCount 	= count($__SEGMEN_ABS__);
			$sgminOne 	= (count($__SEGMEN__)-1);
			$sgminTwo 	= (count($__SEGMEN__)-2);

			/* First-Loop Algorithm */
			$arrayChild = $startIterationFrom;
			$stateChild = -1;
			for( $ss = 1; $ss <= ($sgminOne*$sgminOne); $ss++ ) {

				if( ($ss > 2) && ($ss % $sgminTwo)==0 ) {
					if($arrayChild > $startIterationFrom) {
						$arrayChild = $arrayChild+1;
					} else {
						$arrayChild = $startIterationFrom;
						$stateChild = $stateChild+1;
					}
				}
				if( ($ss > 2) && ($ss % $sgminTwo)!=0 ) {
					$arrayChild = $arrayChild+1;
				}
				
				$urlFile = "";
				for( $sg = $startIterationFrom; $sg < count($__SEGMEN__); $sg++ ) {
					if($ss > 2 && $arrayChild > $sgminOne) {
						$arrayChild = $startIterationFrom;
						$__SEGMEN__[$sg+$stateChild] = "[]";
						$stateChild = $stateChild+1;

						$urlFile .= ".".$__SEGMEN__[$sg];
					} else if($ss > 2 && $arrayChild == $sg) {
						$urlFile .= ".[]";
					} else {
						$urlFile .= ".".$__SEGMEN__[$sg];
					}
				}

				/* Hapus dobel ekstensi file */
				if($replacement != "" && $replacement != null) {
					$urlFile = str_replace($replacement, "", $urlFile);
				}

				if($stateChild >= $sgminTwo) {
					if($thisReqPathLoginPrefix != "both") {
						/* Kembalikan ke normal jika tidak ditemukan
						 * Ganti dari login -> both file prefix
						 */
						$thisReqPathLoginPrefix = "both";
						$ss = 1;
						$arrayChild = $startIterationFrom;
						$stateChild = -1;
						$__SEGMEN__ = siteSegmen("pure");
						continue;
					} else {
						/* Menghentikan iterasi $ss */
						$ss = ($sgminOne*$sgminOne);
						break;
					}
				}

				$urlFile = $thisReqPathLoginPrefix.$urlFile.$__FILE_EXTENSION__;
				$searchResult = array_search($urlFile, $scandirPath);

				if($searchResult == null) {
					$urlFile = $urlFileNotChange;
				} else {
					$resultArrayScan = $searchResult;
					break;
				}
			}

			if(file_exists( $scanPath.$scandirPath[$resultArrayScan]) && ($resultArrayScan!=null || $resultArrayScan!="" ) ) {
				return $scanPath.$scandirPath[$resultArrayScan];
			} else {

				/* First-Loop 2 Algorithm */
				$thisReqPathLoginPrefix = $thisReqPathLoginPrefixDefault;
				$urlFileOneOne = ".";
				$resultArrayScanOneOne = "";
				$oneOneLen = oneOneSortCount($sgminTwo);

				$segmenOneOneLoop = 1;
				$lenOneOneLoop = 0;
				$turnOneOneLoop = $startIterationFrom;
				$borderOneOneLoop = $sgminTwo;
				
				for( $sz = 0; $sz < $oneOneLen; $sz++ ) {
					for( $sx = $startIterationFrom; $sx < $sgCount; $sx++ ) {
						if($sx == $turnOneOneLoop) {
							for($sxx = 0; $sxx < $segmenOneOneLoop; $sxx++) {
								$urlFileOneOne .= "[]";
								if(($sxx+1) < $segmenOneOneLoop) {
									$urlFileOneOne .= ".";
								}
							}
							$sx = $sx+($segmenOneOneLoop-1);
						} else {
							$urlFileOneOne .= $__SEGMEN_ABS__[$sx];
						}
						
						if($sx < ($sgCount-1)) {
							$urlFileOneOne .= ".";
						}
					}
					$urlFileOneOne = $thisReqPathLoginPrefix.$urlFileOneOne.$__FILE_EXTENSION__;
					$searchResult = array_search($urlFileOneOne, $scandirPath);

					if($searchResult == null) {
						$urlFileOneOne = ".";
					} else {
						$resultArrayScanOneOne = $searchResult;
						break;
					}
					
					$lenOneOneLoop = $lenOneOneLoop+1;
					if($lenOneOneLoop >= $borderOneOneLoop) {
						$segmenOneOneLoop = $segmenOneOneLoop+1;
						$lenOneOneLoop = 0;
						$turnOneOneLoop = $startIterationFrom;
						$borderOneOneLoop = $borderOneOneLoop-1;
					} else {
						$turnOneOneLoop = $turnOneOneLoop+1;
					}

					
					if($sz == ($oneOneLen)) {
						if($thisReqPathLoginPrefix != "both") {
							$sz = 0;
							$thisReqPathLoginPrefix = "both";

							$segmenOneOneLoop = 1;
							$lenOneOneLoop = 0;
							$turnOneOneLoop = $startIterationFrom;
							$borderOneOneLoop = $sgminTwo;
						}
					}
				}

				if(file_exists( $scanPath.$scandirPath[$resultArrayScanOneOne]) && ($resultArrayScanOneOne!=null || $resultArrayScanOneOne!="" ) ) {
					return $scanPath.$scandirPath[$resultArrayScanOneOne];
				} else {
					return $__ZERO__;
				}
			}
		}
	} else if($activeFileDynamic == "v3") {
		/* 	(v3) dari fileDynamic - mengutamakan both -> login/notlogin 
		 * 		Knwon Issues : 
		 *			- Tidak dapat _POST, _GET, FILES
		 *			- Control pada halaman tidak dapat dijalankan (View-Controller)
		 * 	[ BUG + ERROR ]
		 */
		function oneOneSortCount($input) {
			$return = 0;

			if($input > 2) {
				while($input > 1) {
					$return = $return+$input;
					$input = $input-1;
				}
			} else {
				$return = $input;
			}

			return $return;
		}
		function fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath, $thisReqPathLoginPrefix, $thisReqPath, $startIterationFrom, $replacement = "") {
			$thisReqPathDefault = $thisReqPath;
			$thisReqPathLoginPrefixFirst = "both";

			$scanPath = $thisReqPathDefault.$requirePath."/";
			$scandirPath = scandir($scanPath);

			$urlFile = "";
			for( $sg = $startIterationFrom; $sg < count($__SEGMEN__); $sg++ ) {
				$urlFile .= ".".$__SEGMEN__[$sg];
			}
			
			/* Hapus dobel ekstensi file */
			if($replacement != "" && $replacement != null) {
				$urlFile = str_replace($replacement, "", $urlFile);
			}

			$urlFileNotChange = $urlFile;
			$resultArrayScan = "";

			$__SEGMEN_ABS__ = siteSegmen("pure");

			$sgCount 	= count($__SEGMEN_ABS__);
			$sgminOne 	= (count($__SEGMEN__)-1);
			$sgminTwo 	= (count($__SEGMEN__)-2);

			/* First-Loop Algorithm */
			$arrayChild = $startIterationFrom;
			$stateChild = -1;
			for( $ss = 1; $ss <= ($sgminOne*$sgminOne); $ss++ ) {

				if( ($ss > 2) && ($ss % $sgminTwo)==0 ) {
					if($arrayChild > $startIterationFrom) {
						$arrayChild = $arrayChild+1;
					} else {
						$arrayChild = $startIterationFrom;
						$stateChild = $stateChild+1;
					}
				}
				if( ($ss > 2) && ($ss % $sgminTwo)!=0 ) {
					$arrayChild = $arrayChild+1;
				}
				
				$urlFile = "";
				for( $sg = $startIterationFrom; $sg < count($__SEGMEN__); $sg++ ) {
					if($ss > 2 && $arrayChild > $sgminOne) {
						$arrayChild = $startIterationFrom;
						$__SEGMEN__[$sg+$stateChild] = "[]";
						$stateChild = $stateChild+1;

						$urlFile .= ".".$__SEGMEN__[$sg];
					} else if($ss > 2 && $arrayChild == $sg) {
						$urlFile .= ".[]";
					} else {
						$urlFile .= ".".$__SEGMEN__[$sg];
					}
				}

				/* Hapus dobel ekstensi file */
				if($replacement != "" && $replacement != null) {
					$urlFile = str_replace($replacement, "", $urlFile);
				}

				if($stateChild >= $sgminTwo) {
					if($thisReqPathLoginPrefixFirst != $thisReqPathLoginPrefix) {
						/* Kembalikan ke normal jika tidak ditemukan
						 * Ganti dari login -> both file prefix
						 */
						$thisReqPathLoginPrefixFirst = $thisReqPathLoginPrefix;
						$ss = 1;
						$arrayChild = $startIterationFrom;
						$stateChild = -1;
						$__SEGMEN__ = siteSegmen("pure");
						continue;
					} else {
						/* Menghentikan iterasi $ss */
						$ss = ($sgminOne*$sgminOne);
						break;
					}
				}

				$urlFile = $thisReqPathLoginPrefixFirst.$urlFile.$__FILE_EXTENSION__;
				$searchResult = array_search($urlFile, $scandirPath);

				if($searchResult == null) {
					$urlFile = $urlFileNotChange;
				} else {
					$resultArrayScan = $searchResult;
					break;
				}
			}

			if(file_exists( $scanPath.$scandirPath[$resultArrayScan]) && ($resultArrayScan!=null || $resultArrayScan!="" ) ) {
				return $scanPath.$scandirPath[$resultArrayScan];
			} else {

				/* First-Loop 2 Algorithm */
				$thisReqPathLoginPrefixFirst = $thisReqPathLoginPrefix;
				$urlFileOneOne = ".";
				$resultArrayScanOneOne = "";
				$oneOneLen = oneOneSortCount($sgminTwo);

				$segmenOneOneLoop = 1;
				$lenOneOneLoop = 0;
				$turnOneOneLoop = $startIterationFrom;
				$borderOneOneLoop = $sgminTwo;
				
				for( $sz = 0; $sz < $oneOneLen; $sz++ ) {
					for( $sx = $startIterationFrom; $sx < $sgCount; $sx++ ) {
						if($sx == $turnOneOneLoop) {
							for($sxx = 0; $sxx < $segmenOneOneLoop; $sxx++) {
								$urlFileOneOne .= "[]";
								if(($sxx+1) < $segmenOneOneLoop) {
									$urlFileOneOne .= ".";
								}
							}
							$sx = $sx+($segmenOneOneLoop-1);
						} else {
							$urlFileOneOne .= $__SEGMEN_ABS__[$sx];
						}
						
						if($sx < ($sgCount-1)) {
							$urlFileOneOne .= ".";
						}
					}
					$urlFileOneOne = $thisReqPathLoginPrefixFirst.$urlFileOneOne.$__FILE_EXTENSION__;
					$searchResult = array_search($urlFileOneOne, $scandirPath);

					if($searchResult == null) {
						$urlFileOneOne = ".";
					} else {
						$resultArrayScanOneOne = $searchResult;
						break;
					}
					
					$lenOneOneLoop = $lenOneOneLoop+1;
					if($lenOneOneLoop >= $borderOneOneLoop) {
						$segmenOneOneLoop = $segmenOneOneLoop+1;
						$lenOneOneLoop = 0;
						$turnOneOneLoop = $startIterationFrom;
						$borderOneOneLoop = $borderOneOneLoop-1;
					} else {
						$turnOneOneLoop = $turnOneOneLoop+1;
					}

					
					if($sz == ($oneOneLen)) {
						if($thisReqPathLoginPrefixFirst != $thisReqPathLoginPrefix) {
							$sz = 0;
							$thisReqPathLoginPrefixFirst = $thisReqPathLoginPrefix;

							$segmenOneOneLoop = 1;
							$lenOneOneLoop = 0;
							$turnOneOneLoop = $startIterationFrom;
							$borderOneOneLoop = $sgminTwo;
						}
					}
				}

				if(file_exists( $scanPath.$scandirPath[$resultArrayScanOneOne]) && ($resultArrayScanOneOne!=null || $resultArrayScanOneOne!="" ) ) {
					return $scanPath.$scandirPath[$resultArrayScanOneOne];
				} else {
					return $__ZERO__;
				}
			}
		}
	} else if($activeFileDynamic == "v4") {
		/* 	(v4) dari fileDynamic - mengutamakan both -> login/notlogin 
 		 * 		Lebih simple dan elegan
		 */
		function createFileDynamicMatrix($col, $row, $segmen) {
			$row = $row;
			$col = $col;

			$a = $row;
			$b = $col;

			$array = [];
			$stayVal = [];

			for($azs = 0; $azs < $b; $azs++) {
			    array_push($stayVal, 0);
			}  

			/*
				$azz = ROW
				$azx = COLUMN
			*/

			for($azz = 0; $azz < $a; $azz++) {
			    $azzm = $azz+1;
			    for($azx = 0; $azx < $b; $azx++) {
			        if($azx == 0) {
			        	$modding 	= $azzm%2;
			        	$resultmod 	= "";

			        	if($modding == 0) {
			        		$resultmod = "[]";
			        	} else {
			        		$resultmod = $segmen[$azx];
			        	}

			            $array[$azz][$azx] = $resultmod;
			        } else {
			            $tmod   	= pow(2, $azx);
			            $resultmod 	= "";
			            
			            if($azz%$tmod == 0) {
			                if($stayVal[$azx] == 0) {
			                    $stayVal[$azx] 	= 1;
			                } else {
			                    $stayVal[$azx] 	= 0;
			                }
			            }

			            if($stayVal[$azx] == 0) {
			        		$resultmod = "[]";
			        	} else {
			        		$resultmod = $segmen[$azx];
			        	}
			            
			            $array[$azz][$azx] = $resultmod;
			        }
			    }
			}

			/* 
				1 = Real URL
				0 = []
			 */

			return $array;
		}
		function searchTheFileDynamic($arrMatrix, $scanDir, $extension, $pathPrefix) {
			$arrMatrixLen 	= count($arrMatrix);
			$urlTranslate 	= [];
			$result 		= "";

			for($a = 0; $a < $arrMatrixLen; $a++) {
				$thisMatrix = $arrMatrix[$a];
				$implodeMatrix = implode(".", $thisMatrix);

				$aVal = $pathPrefix.".".$implodeMatrix.$extension;
				$bVal = "both.".$implodeMatrix.$extension;

				array_push($urlTranslate, $aVal);
				array_push($urlTranslate, $bVal);
			}

			$urlTranslateLen = count($urlTranslate);

			for($b = 0; $b < $urlTranslateLen; $b++) { 
				$result = array_search($urlTranslate[$b], $scanDir);

				if($result != false && $result != null && $result != "") {
					$b = $urlTranslateLen;
					return $scanDir[$result];
				}
			}

			return false;
		}
		function fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath, $thisReqPathLoginPrefix, $thisReqPath, $startIterationFrom, $replacement = "") {
			$newSegmen 		= [];
			$segmenPure		= siteSegmen("pure");
			$segmenCount	= count($segmenPure);
			$segmenCountMin	= $segmenCount-$startIterationFrom;
			$rowCount 		= pow(2, $segmenCountMin);

			$thisPath 		= $thisReqPath.$requirePath."/";
			$scanThisPath 	= scandir($thisPath);

			for($az = $startIterationFrom; $az < $segmenCount; $az++) {
				$thisSegmenPure = str_replace($replacement, "", $segmenPure[$az]);
				array_push($newSegmen, $thisSegmenPure);
			}

			$newMatrix 		= createFileDynamicMatrix($segmenCountMin, $rowCount, $newSegmen);
			$returnResult 	= searchTheFileDynamic($newMatrix, $scanThisPath, $__FILE_EXTENSION__, $thisReqPathLoginPrefix);

			$finalResult 	= $thisPath.$returnResult;

			if(file_exists($finalResult) && !is_dir($finalResult)) {
				return $finalResult;
			} else {
				return $__ZERO__;
			}
		}
	} else if($activeFileDynamic == "debug_v2") {
		/* Digunakan Sebagai Debugger (v2) */
		function fileDynamicDebug($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath, $thisReqPathLoginPrefix, $thisReqPath, $startIterationFrom, $replacement = "") {
			$time_start = microtime(true); 

			echo "\n<br>";
			echo "\n<br>";

			echo "- \$__SEGMEN__ : "; print_r($__SEGMEN__); echo "\n<br>";
			echo "- \$__SEGMEN2__ : "; print_r(siteSegmen("pure")); echo "\n<br>";
			echo "- \$__FILE_EXTENSION__ : ".$__FILE_EXTENSION__."\n<br>";
			echo "- \$__ZERO__ : ".$__ZERO__."\n<br>";
			echo "- \$requirePath : ".$requirePath."\n<br>";
			echo "- \$thisReqPathLoginPrefix : ".$thisReqPathLoginPrefix."\n<br>";
			echo "- \$thisReqPath : ".$thisReqPath."\n<br>";
			echo "- \$startIterationFrom : ".$startIterationFrom."\n<br>";
			echo "- \$replacement : ".$replacement."\n<br>";

			echo "\n<br>";
			echo "\n<hr>";

			echo "\n<br>";
			echo "\n<br>";
			echo "BEGIN FILE DYNAMIC DEBUGGER...";
			echo "\n<br>";
			echo "\n<br>";

			$thisReqPathDefault = $thisReqPath;
			$thisReqPathLoginPrefixDefault = $thisReqPathLoginPrefix;

			$scanPath = $thisReqPathDefault.$requirePath."/";
			$scandirPath = scandir($scanPath);

			print_r($scandirPath);
			echo "\n<br>";

			$urlFile = "";
			for( $sg = $startIterationFrom; $sg < count($__SEGMEN__); $sg++ ) {
				$urlFile .= ".".$__SEGMEN__[$sg];
			}
			
			/* Hapus dobel ekstensi file */
			if($replacement != "" && $replacement != null) {
				$urlFile = str_replace($replacement, "", $urlFile);
			}

			$urlFileNotChange = $urlFile;
			$resultArrayScan = "";

			$__SEGMEN_ABS__ = siteSegmen("pure");

			$sgCount 	= count($__SEGMEN_ABS__);
			$sgminOne 	= (count($__SEGMEN__)-1);
			$sgminTwo 	= (count($__SEGMEN__)-2);

			/* First-Loop Algorithm */
			$arrayChild = $startIterationFrom;
			$stateChild = -1;

			echo "\n<br>";
			echo "[1] LOOPING FOR ".($sgminOne*$sgminOne);
			echo "\n<br>";

			for( $ss = 1; $ss <= ($sgminOne*$sgminOne); $ss++ ) {

				if( ($ss > 2) && ($ss % $sgminTwo)==0 ) {
					if($arrayChild > $startIterationFrom) {
						$arrayChild = $arrayChild+1;
					} else {
						$arrayChild = $startIterationFrom;
						$stateChild = $stateChild+1;
					}
				}
				if( ($ss > 2) && ($ss % $sgminTwo)!=0 ) {
					$arrayChild = $arrayChild+1;
				}

				echo "\n<br>";
				echo "[1][1] Looping For ".count($__SEGMEN__)." - ON [".$ss."]";
				echo "\n<br>";
				
				$urlFile = "";
				for( $sg = $startIterationFrom; $sg < count($__SEGMEN__); $sg++ ) {
					if($ss > 2 && $arrayChild > $sgminOne) {
						$arrayChild = $startIterationFrom;
						$__SEGMEN__[$sg+$stateChild] = "[]";
						$stateChild = $stateChild+1;

						$urlFile .= ".".$__SEGMEN__[$sg];
					} else if($ss > 2 && $arrayChild == $sg) {
						$urlFile .= ".[]";
					} else {
						$urlFile .= ".".$__SEGMEN__[$sg];
					}
					echo "\n<br>";
					echo "RESULT [1][1] ON [".$ss."] ON [".$sg."] = ".$urlFile;
					echo "\n<br>";
				}

				echo "\n<br>";
				echo "END [1][1] WITH = ".$urlFile;
				echo "\n<br>";

				/* Hapus dobel ekstensi file */
				if($replacement != "" && $replacement != null) {
					$urlFile = str_replace($replacement, "", $urlFile);
				}

				echo "\n<br>";
				echo "AFTER REPLACEMENT = ".$urlFile;
				echo "\n<br>";

				if($stateChild >= $sgminTwo) {
					if($thisReqPathLoginPrefix != "both") {
						/* Kembalikan ke normal jika tidak ditemukan
						 * Ganti dari login -> both file prefix
						 */
						$thisReqPathLoginPrefix = "both";
						$ss = 1;
						$arrayChild = $startIterationFrom;
						$stateChild = -1;
						$__SEGMEN__ = siteSegmen("pure");
						continue;
					} else {
						/* Menghentikan iterasi $ss */
						$ss = ($sgminOne*$sgminOne);
						break;
					}
				}

				$urlFile = $thisReqPathLoginPrefix.$urlFile.$__FILE_EXTENSION__;
				$searchResult = array_search($urlFile, $scandirPath);

				echo "\n<br>";
				echo "___RESULTING[".$ss."] = ".$urlFile;
				echo "\n<br>";

				if($searchResult == null) {
					$urlFile = $urlFileNotChange;
				} else {
					$resultArrayScan = $searchResult;
					break;
				}
			}

			if(file_exists( $scanPath.$scandirPath[$resultArrayScan]) && ($resultArrayScan!=null || $resultArrayScan!="" ) ) {
				echo $scanPath.$scandirPath[$resultArrayScan];
				echo "\n<br>";
			} else {

				/* First-Loop 2 Algorithm */
				$thisReqPathLoginPrefix = $thisReqPathLoginPrefixDefault;
				$urlFileOneOne = ".";
				$resultArrayScanOneOne = "";
				$oneOneLen = oneOneSortCount($sgminTwo);

				$segmenOneOneLoop = 1;
				$lenOneOneLoop = 0;
				$turnOneOneLoop = $startIterationFrom;
				$borderOneOneLoop = $sgminTwo;
				
				for( $sz = 0; $sz < $oneOneLen; $sz++ ) {
					for( $sx = $startIterationFrom; $sx < $sgCount; $sx++ ) {
						if($sx == $turnOneOneLoop) {
							for($sxx = 0; $sxx < $segmenOneOneLoop; $sxx++) {
								$urlFileOneOne .= "[]";
								if(($sxx+1) < $segmenOneOneLoop) {
									$urlFileOneOne .= ".";
								}
							}
							$sx = $sx+($segmenOneOneLoop-1);
						} else {
							$urlFileOneOne .= $__SEGMEN_ABS__[$sx];
						}
						
						if($sx < ($sgCount-1)) {
							$urlFileOneOne .= ".";
						}
					}
					$urlFileOneOne = $thisReqPathLoginPrefix.$urlFileOneOne.$__FILE_EXTENSION__;
					$searchResult = array_search($urlFileOneOne, $scandirPath);

					if($searchResult == null) {
						$urlFileOneOne = ".";
					} else {
						$resultArrayScanOneOne = $searchResult;
						break;
					}
					
					$lenOneOneLoop = $lenOneOneLoop+1;
					if($lenOneOneLoop >= $borderOneOneLoop) {
						$segmenOneOneLoop = $segmenOneOneLoop+1;
						$lenOneOneLoop = 0;
						$turnOneOneLoop = $startIterationFrom;
						$borderOneOneLoop = $borderOneOneLoop-1;
					} else {
						$turnOneOneLoop = $turnOneOneLoop+1;
					}

					
					if($sz == ($oneOneLen)) {
						if($thisReqPathLoginPrefix != "both") {
							$sz = 0;
							$thisReqPathLoginPrefix = "both";

							$segmenOneOneLoop = 1;
							$lenOneOneLoop = 0;
							$turnOneOneLoop = $startIterationFrom;
							$borderOneOneLoop = $sgminTwo;
						}
					}
				}

				if(file_exists( $scanPath.$scandirPath[$resultArrayScanOneOne]) && ($resultArrayScanOneOne!=null || $resultArrayScanOneOne!="" ) ) {
					echo $scanPath.$scandirPath[$resultArrayScanOneOne];
					echo "\n<br>";
				} else {
					echo $__ZERO__;
					echo "\n<br>";
				}
			}
			echo "\n<br>";
			echo "\n<br>";
			echo "...END FILE DYNAMIC DEBUGGER";
			echo "\n<br>";
			$time_end = microtime(true);

			$execution_time = ($time_end - $time_start);
			echo "WAKTU PROSES : <b>".number_format($execution_time, 6)."</b> Detik";
		}
		function fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath, $thisReqPathLoginPrefix, $thisReqPath, $startIterationFrom, $replacement = "") {
			if($requirePath != "/myassets/_page/general") {
				return fileDynamicDebug($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath, $thisReqPathLoginPrefix, $thisReqPath, $startIterationFrom, $replacement);
				die();
			} else {
				return $__ZERO__;
			}
		}
	}

	/* Menghapus semua session untuk POST, GET, FILES */
	function clearAllSessInput() {
		/* Menghapus postGET & postPOST - karena terakhir di load */
		unset($_SESSION['postGET']);
		unset($_SESSION['postPOST']);
		if(count($_SESSION['postFILES']) > 0) {
			foreach($_SESSION['postFILES'] as $key => $value) {
				$thisPostFiles = $_SESSION['postFILES'][$key]['tmp_name'];
				if(file_exists($thisPostFiles)) {
					unlink($thisPostFiles);
				}
			}
		}
		unset($_SESSION['postFILES']);
	}
	/* Addslash untuk \ dan " saja */
	function addslashesNormalize($input) {
		$thisInput = $input;
		$thisInput = str_replace("&bsol;", "\\", $thisInput);
		$thisInput = str_replace("&quot;", "\"", $thisInput);
		return $thisInput;
	}
	/* implode array - tanpa menggunakan implode() */
	function implodeArrayWord($input, $count) {
		$output = "";
		for($a=0;$a<$count;$a++) {
			if($a==0) {
				$output = $input[$a];
			} else {
				$output = $output." ".$input[$a];
			}
		}
		return $output;
	}
	/* Function untuk mendeteksi OS dari host/server */
	function hostOS() {
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return 'windows';
		} else {
			if(strtoupper(substr(PHP_OS, 0, 3)) === 'LIN') {
				return 'linux';
			} else {
				return 'other';
			}
		}
	}

	/* Menghapus <SCRIPT> */
	function removeScriptTag($output) {
		$output = preg_replace("'<script[^>]*\>(.*?)</script>'si", "", $output);
		return $output;
	}

	/* Membuat baris kode menjadi single line */
	function toSingleLine($output) {
		/* 
		 * \r 	= Carriage Return  	- NewLine Mac OS sebelum OS X
		 * \n 	= Line Feed 		- NewLine Unix/Mac OS
		 * \r\n = CR+LF				- NewLine Windows
		 */
		$tzer = $_SESSION["globalSecureToken"];

		/* Mengubah <PRE> memiliki NewLine & Tab, lalu ditranslasikan menjadi singleline */
		preg_match_all("'<pre[^>]*\>(.*?)</pre>'si", $output, $match);
		preg_match_all('/<pre[^>]*\>/i', $output, $match2);
		preg_match_all('/<\/pre[^>]*\>/i', $output, $match3);

		$countMatchPre 	= count($match[1]);
		$arrayBlock 	= ["\r\n", "\r", "\n"];
		$arrayBlock2 	= ["\t"];
		$arrayResult 	= [];
		for($a = 0; $a < $countMatchPre; $a++ ) {
		    $replaced = str_replace($arrayBlock, "{{S-".$tzer."NewLine}}", $match[1][$a]);
		    $replaced = str_replace($arrayBlock2, "{{S-".$tzer."Tab}}", $replaced);
		    array_push($arrayResult, $replaced);
		}

		$output = preg_replace_callback(
			"'(<pre[^>]*\>)(.*?)(</pre>)'si", 
			function($matches) use (&$arrayResult, &$match2, &$match3) {
			    return array_shift($match2[0]).array_shift($arrayResult).array_shift($match3[0]);
			}, 
			$output
		);

		/* Mengubah <CODE> memiliki NewLine & Tab, lalu ditranslasikan menjadi singleline */
		preg_match_all("'<code[^>]*\>(.*?)</code>'si", $output, $match);
		preg_match_all('/<code[^>]*\>/i', $output, $match2);
		preg_match_all('/<\/code[^>]*\>/i', $output, $match3);

		$countMatchPre 	= count($match[1]);
		$arrayBlock 	= ["\r\n", "\r", "\n"];
		$arrayBlock2 	= ["\t"];
		$arrayResult 	= [];
		for($a = 0; $a < $countMatchPre; $a++ ) {
		    $replaced = str_replace($arrayBlock, "{{S-".$tzer."NewLine}}", $match[1][$a]);
		    $replaced = str_replace($arrayBlock2, "{{S-".$tzer."Tab}}", $replaced);
		    array_push($arrayResult, $replaced);
		}

		$output = preg_replace_callback(
			"'(<code[^>]*\>)(.*?)(</code>)'si", 
			function($matches) use (&$arrayResult, &$match2, &$match3) {
			    return array_shift($match2[0]).array_shift($arrayResult).array_shift($match3[0]);
			}, 
			$output
		);

		/* Mengubah <SCRIPT> memiliki NewLine & Tab, lalu ditranslasikan menjadi singleline */
		preg_match_all("'<script[^>]*\>(.*?)</script>'si", $output, $match);
		preg_match_all('/<script[^>]*\>/i', $output, $match2);
		preg_match_all('/<\/script[^>]*\>/i', $output, $match3);

		$countMatchPre 	= count($match[1]);
		$arrayBlock 	= ["\r\n", "\r", "\n"];
		$arrayBlock2 	= ["\t"];
		$arrayResult 	= [];
		for($a = 0; $a < $countMatchPre; $a++ ) {
		    $replaced = str_replace($arrayBlock, "{{S-".$tzer."NewLine}}", $match[1][$a]);
		    $replaced = str_replace($arrayBlock2, "{{S-".$tzer."Tab}}", $replaced);
		    array_push($arrayResult, $replaced);
		}

		$output = preg_replace_callback(
			"'(<script[^>]*\>)(.*?)(</script>)'si", 
			function($matches) use (&$arrayResult, &$match2, &$match3) {
			    return array_shift($match2[0]).array_shift($arrayResult).array_shift($match3[0]);
			}, 
			$output
		);

		/* Replace \r\n and \r menjadi format \n */
		$breaks = array("\r\n", "\r");
		$output = str_replace($breaks, "\n", $output);
		
		/* Explode per baris baru menjadi Array */
		$lines = explode("\n", $output);

		/* $new_lines variabel sebagai output function */
		$new_lines = array();

		/* Per line replace \t (TAB) dan masukkan hasil ke $new_lines array variable */
		foreach ($lines as $i => $line) {
			if(!empty($line)) {
				$fix_lines = trim($line);
				$fix_lines = trim(preg_replace('/\t+/', '', $fix_lines));
				
				$new_lines[] = $fix_lines;
			}
		}

		/* Implode array menjadi satu string variabel */
		$outputFinal = implode($new_lines);

		return $outputFinal;
	}
	/* Menghapus tag slash custom -> \\, /, ', \" */
	function tagSlash($output) {
		$breaks = array("\\");
		$output = str_replace($breaks, "\\\\", $output);

		$breaks = array("/");
		$output = str_replace($breaks, "\/", $output);

		$breaks = array("'");
		$output = str_replace($breaks, "\\'", $output);

		$breaks = array("\"");
		$output = str_replace($breaks, "\\\"", $output);
		
		return $output;
	}
	/* Menghapus tag slash custom -> /, ', \" */
	function tagSlashOri($output) {
		$breaks = array("/");
		$output = str_replace($breaks, "\/", $output);

		$breaks = array("'");
		$output = str_replace($breaks, "\\'", $output);

		$breaks = array("\"");
		$output = str_replace($breaks, "\\\"", $output);
		
		return $output;
	}

	/* Mendapatkan nilai random dari function rand() 
	 * Nilai rand minimal saat $maxFrame = 1 adalah 8 digit
	 */
	function getRandomOnSinTask($maxFrame) {
		$return_ = "";
		$frame = 0;
		if($maxFrame<=0) {
			$maxFrame = 1;
		}
		while($frame<$maxFrame) {
			$return_ = $return_."".rand(10000000,99999999);
			$frame = $frame+1;
		}
		return $return_;
	}
	/* Menghasilkan random dari substr + str_shuffle 
	 * panjang maksimal 56 pada $long (56 karakter) 
	 */
	function getRandom($long) {
		$rand = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz12345678901234567890'), 0, $long );
		return $rand;
	}
	/* Menghasilkan random dari substr + str_shuffle + strtotime & date (timestamp)
	 * panjang maksimal 56 pada $long (56 karakter) + 10 digit angka timestamp
	 */
	function getRandomPlusDate($long) {
		$rand = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz12345678901234567890'), 0, $long ).strtotime(date("d-m-Y H:i:s"));
		return $rand;
	}
	/* Menghasilkan random karakter Key Token Standard SinTaskFW
	 * 100 karakter dengan campuran timestamp
	 */
	function getRandomKeyToken() {
		$key_token 	= substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz12345678901234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 25).substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz12345678901234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 25).substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz12345678901234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 25).substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz12345678901234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 15).strtotime(date("d-m-Y H:i:s"));
		return $key_token;
	}

	/* Untuk allow CORS - Cross Origin 
	 * Digunakan untuk API yg dapat digunakan untuk umum
	 */
	function corsSinTaskAPI() {
		/* Izinkan ke semua origin */
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			/* 
				$_SERVER['HTTP_ORIGIN'] mengizinkan ke semua origin
				kami tidak menggunakan * sebagai nilai 'Access-Control-Allow-Origin'
			*/
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}

		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
			exit(0);
		}
	}
	/* Header tambahan SinTaskFW */
	function headerSinTaskHQ() {
		header('Content-Type: text/html; charset=UTF-8');
		header('Cache-Control: max-age=3600, must-revalidate');
		header('SinTask-Framework-Info: fw.sintask.com');
		header('SinTask-Author: SinTask Web Developer');
		header('SinTask-License: Framework is under MIT License');
		header('SinTask-Company: PT. SinTask Digital');
		header('SinTask-Framework: fw@sintask.com');
	}

	/* Template loading pada web */
	function loadingHtmlTemplate() {
		$output = '
		<div class="loading"> 
			<span class="l01"></span> 
			<span class="l02"></span> 
			<span class="l03"></span> 
			<span class="l04"></span> 
			<span class="l05"></span> 
			<div class="clearBoth"></div>
		</div>';
		return $output;
	}
	/* JSON initial - awal template */
	function initialJson($title, $style, $script, $inst = "null", $msg = "OK") {
		$output = "[
						{\"content\":[
							{\"contentTitle\":[
								{\"title\":\"".$title."\"}
							]},
							{\"addStyle\":[
								{\"style\":\"".$style."\"}
							]},
							{\"addScript\":[
								{\"script\":\"".$script."\"}
							]}
						]},
						{\"sts\":200},
						{\"inst\":\"".$inst."\"},
						{\"msg\":\"".$msg."\"}
					]";
		return fixStJson($output);
	}
	/* JSON jika token salah */
	function invalidToken($msg, $t1 = "null", $t2 = "null") {
		$output = "[
						{\"content\":[
							{\"contentTitle\":[
								{\"title\":\"Invalid\"}
							]},
							{\"addStyle\":[
								{\"style\":\"null\"}
							]},
							{\"addScript\":[
								{\"script\":\"null\"}
							]}
						]},
						{\"sts\":205},
						{\"inst\":\"t1:".$t1."_t2:".$t2."\"},
						{\"msg\":\"".$msg."\"}
					]";
		return fixStJson($output);
	}
	/* Template halaman error */
	function errorPageTemplate($msg) {
		$output = "[
						{\"content\":[
							{\"contentTitle\":[
								{\"title\":\"Error Page\"}
							]},
							{\"addStyle\":[
								{\"style\":\"null\"}
							]},
							{\"addScript\":[
								{\"script\":\"null\"}
							]}
						]},
						{\"sts\":200},
						{\"inst\":\"null\"},
						{\"msg\":\"".$msg."\"}
					]";
		return fixStJson($output);
	}
	/* Template halaman 404 */
	function notFound404Template($title) {
		$output = "  [
					{\"content\":[
						{\"contentTitle\":[
							{\"title\":\"".$title."\"}
						]},
						{\"addStyle\":[
							{\"style\":\"".$GLOBALS["__BASE_URL__"]."/404/404.latecss\"}
						]},
						{\"addScript\":[
							{\"script\":\"".$GLOBALS["__BASE_URL__"]."/404/404.jssintasktemplate?type=content\"}
						]}
					]},
					{\"sts\":200},
					{\"inst\":\"_[inst]_hide|#headerTwoSinTask_[inst]_removeClass|loginRegForgotBackgroundHNL|#contentSinTask\"},
					{\"msg\":\"Ok!\"}
				]";
		return fixStJson($output);
	}

	/* Dapatakan Hasil Render HTML */
	function getRenderedHTML($path){
		/* Render tidak global, dan tidak membaca variable lain, karena scope function */
	    ob_start();
	    include($path);
	    $var = ob_get_contents(); 
	    ob_end_clean();
	    return $var;
	}
	
	/* Template untuk Try Catch */
	function tryCatchTemplate($title, $tryContent) {
		$final = "";

		$theBrowser = getBrowser();

        $final .= 'try{';
		$final .= 		$tryContent;
		$final .= '} catch(error) {';

		$final .= 		'console.log("%c'.$title.'", "font-size: 16px; color: #EA4335;");';
		
		if($theBrowser["BR_NAME"] == "MOZ_FIRE") {
			$final .= 		'console.log("%cError - "+error.message, "color: #EA4335; background: transparent; padding: 0px 10px; border-left: 4px solid #EA4335;");';
			$final .= 		'console.log("%cLine "+error.lineNumber, "color: #EA4335; background: transparent; padding: 0px 10px; border-left: 4px solid #EA4335;");';
			$final .= 		'console.log("%cColumn "+error.columnNumber, "color: #EA4335; background: transparent; padding: 0px 10px; border-left: 4px solid #EA4335;");';

			$final .= 'console.log("%cLine & Column numbers are calculated from the <script> tag in your SPA file\n", "font-size: 12px; color: #EA4335; border-bottom: 1px solid #EA4335;");';
		} else if($theBrowser["BR_NAME"] == "CHROME") {
			$final .= 		'console.log("%cError - "+error.message, "color: #EA4335; background: transparent; padding: 0px 10px; border-left: 4px solid #EA4335;");';
			$final .= 		'console.log("%cStack "+error.stack, "color: #EA4335; background: transparent; padding: 0px 10px; border-left: 4px solid #EA4335;");';

			$final .= 'console.log("%cSorry, your browser is not supported Line & Column number detection (Try Mozilla Firefox 50+ or Browser with Developer Edition)", "font-size: 12px; color: #EA4335; border-bottom: 1px solid #EA4335;");';
			$final .= 'console.log("%cClient-Browser: '.$theBrowser["name"].' ver-'.$theBrowser["version"].'\n", "font-size: 12px; color: #EA4335; border-bottom: 1px solid #EA4335;");';
		} else {
			$final .= 		'console.log("%cError - "+error.message, "color: #EA4335; background: transparent; padding: 0px 10px; border-left: 4px solid #EA4335;");';

			$final .= 'console.log("%cSorry, your browser is not supported Line & Column number detection (Try Mozilla Firefox 50+ or Browser with Developer Edition)", "font-size: 12px; color: #EA4335; border-bottom: 1px solid #EA4335;");';
			$final .= 'console.log("%cClient-Browser: '.$theBrowser["name"].' ver-'.$theBrowser["version"].'\n", "font-size: 12px; color: #EA4335; border-bottom: 1px solid #EA4335;");';
		}

		$final .= '};';

		return $final;
	}
	/* Ambil SCRIPT (JS) lagi */
	/* Code dibawah menggunakan eval(); */
	function getScriptAgain($type = null) {
		$tzer = $_SESSION["globalSecureToken"];

		if($type == "head") {
			$output .= tryCatchTemplate(
	        	"SinTaskFW Javascript Error - HEAD SCRIPT AGAIN", 
	        	'eval(sessionStorage.sCachedSinTaskFWhead);'
	        );
		} else if($type == "foot") {
			$output .= tryCatchTemplate(
	        	"SinTaskFW Javascript Error - FOOT SCRIPT AGAIN", 
	        	'eval(sessionStorage.sCachedSinTaskFWfoot);'
	        );
		}

		return $output;
	}
	/* Code dibawah menggunakan new Function(); */
	function getScriptAgainOther($type = null) {
		$tzer = $_SESSION["globalSecureToken"];

		if($type == "head") {
			$output = 'var sCachedSFWhead'.$tzer.' = new Function(sessionStorage.sCachedSinTaskFWhead);';

			$output .= tryCatchTemplate(
	        	"SinTaskFW Javascript Error - HEAD SCRIPT AGAIN", 
	        	'sCachedSFWhead'.$tzer.'();'
	        );
		} else if($type == "foot") {
			$output = 'var sCachedSFWfoot'.$tzer.' = new Function(sessionStorage.sCachedSinTaskFWfoot);';

			$output .= tryCatchTemplate(
	        	"SinTaskFW Javascript Error - FOOT SCRIPT AGAIN", 
	        	'sCachedSFWfoot'.$tzer.'();'
	        );
		}

		return $output;
	}
	/* SPA - Merender HTML menjadi JS + Enkripsi AES dari GibberishAES */
	function renderHTMLToJSENC($input) {
		$vars = toSingleLine($input);
        $tzer = $_SESSION["globalSecureToken"];

        $__AES_ENC_KEY__ 	= $tzer;
        $__AES_ENC_OUTPUT__ = $vars;

        $old_key_size = GibberishAES::size();
		GibberishAES::size(256);
		$encrypted_the_output = GibberishAES::enc($__AES_ENC_OUTPUT__, $__AES_ENC_KEY__);
		GibberishAES::size($old_key_size);

        $final .= 'var sintaskGFV'.$tzer.' = "'.$encrypted_the_output.'";';
        $final .= 'var decsintaskGFV'.$tzer.' = CryptoJS.AES.decrypt(sintaskGFV'.$tzer.', __SFW_tokenizing);';
        $final .= 'decsintaskGFV'.$tzer.' = decsintaskGFV'.$tzer.'.toString(CryptoJS.enc.Utf8);';
        $final .= 'sintaskGFV'.$tzer.' = decsintaskGFV'.$tzer.';';
        $final .= 'sintaskGFV'.$tzer.' = sintaskGFV'.$tzer.'.replace(/{{S-'.$tzer.'NewLine}}/g, "\n");';
        $final .= 'sintaskGFV'.$tzer.' = sintaskGFV'.$tzer.'.replace(/{{S-'.$tzer.'Tab}}/g, "\t");';
        
        $final .= getScriptAgain("head");
        
        $final .= tryCatchTemplate(
        	"SinTaskFW Javascript SPA Error - AES", 
        	'sjqNoConflict("#freeContentSinTask").html(sintaskGFV'.$tzer.');'
        );

        $final .= getScriptAgain("foot");

		return $final;
	}
	/* SPA Stay - Merender HTML menjadi JS + Enkripsi AES dari GibberishAES */
	function renderHTMLToJSStayENC($content, $input) {
		$vars = toSingleLine($input);
        $tzer = $_SESSION["globalSecureToken"];
        $tzeo = $tzer;
        $tzer = $tzer.$content;

        $__AES_ENC_KEY__ 	= $_SESSION["globalSecureToken"];
        $__AES_ENC_OUTPUT__ = $vars;

        $old_key_size = GibberishAES::size();
		GibberishAES::size(256);
		$encrypted_the_output = GibberishAES::enc($__AES_ENC_OUTPUT__, $__AES_ENC_KEY__);
		GibberishAES::size($old_key_size);

        $final .= 'var sintaskGFV'.$tzer.' = "'.$encrypted_the_output.'";';
        $final .= 'var decsintaskGFV'.$tzer.' = CryptoJS.AES.decrypt(sintaskGFV'.$tzer.', __SFW_tokenizing);';
        $final .= 'decsintaskGFV'.$tzer.' = decsintaskGFV'.$tzer.'.toString(CryptoJS.enc.Utf8);';
        $final .= 'sintaskGFV'.$tzer.' = decsintaskGFV'.$tzer.';';
        $final .= 'sintaskGFV'.$tzer.' = sintaskGFV'.$tzer.'.replace(/{{S-'.$tzeo.'NewLine}}/g, "\n");';
        $final .= 'sintaskGFV'.$tzer.' = sintaskGFV'.$tzer.'.replace(/{{S-'.$tzeo.'Tab}}/g, "\t");';
        
        if($content == "header") {
        	$final .= tryCatchTemplate(
	        	"SinTaskFW Javascript SPA Stay-Header Error - AES", 
	        	'sjqNoConflict("#headerStayContentSinTask").html(sintaskGFV'.$tzer.');'
	        );
        } else if($content == "footer") {
        	$final .= tryCatchTemplate(
	        	"SinTaskFW Javascript SPA Stay-Footer Error - AES", 
	        	'sjqNoConflict("#footerStayContentSinTask").html(sintaskGFV'.$tzer.');'
	        );
      	} else if($content == "content") {
      		$final .= tryCatchTemplate(
	        	"SinTaskFW Javascript SPA Stay-Content Error - AES", 
	        	'sjqNoConflict("#stayContentSinTask").html(sintaskGFV'.$tzer.');'
	        );
        }

		return $final;
	}
	/* SPA - Merender HTML menjadi JS */
	function renderHTMLToJS($input) {
		$vars = toSingleLine($input);
		$vars = tagSlash($vars);
        $tzer = $_SESSION["globalSecureToken"];

        $final .= 'var sintaskGFV'.$tzer.' = "'.$vars.'";';
        $final .= 'sintaskGFV'.$tzer.' = sintaskGFV'.$tzer.'.replace(/{{S-'.$tzer.'NewLine}}/g, "\n");';
        $final .= 'sintaskGFV'.$tzer.' = sintaskGFV'.$tzer.'.replace(/{{S-'.$tzer.'Tab}}/g, "\t");';

        $final .= getScriptAgain("head");

        $final .= tryCatchTemplate(
        	"SinTaskFW Javascript SPA Error", 
        	'sjqNoConflict("#freeContentSinTask").html(sintaskGFV'.$tzer.');'
        );

        $final .= getScriptAgain("foot");

		return $final;
	}
	/* SPA Stay - Merender HTML menjadi JS */
	function renderHTMLToJSStay($content, $input) {
		$vars = toSingleLine($input);
        $vars = tagSlash($vars);
        $tzer = $_SESSION["globalSecureToken"];
        $tzeo = $tzer;
        $tzer = $tzer.$content;

        $final .= 'var sintaskGFV'.$tzer.' = "'.$vars.'";';
        $final .= 'sintaskGFV'.$tzer.' = sintaskGFV'.$tzer.'.replace(/{{S-'.$tzeo.'NewLine}}/g, "\n");';
        $final .= 'sintaskGFV'.$tzer.' = sintaskGFV'.$tzer.'.replace(/{{S-'.$tzeo.'Tab}}/g, "\t");';
        
        if($content == "header") {
        	$final .= tryCatchTemplate(
	        	"SinTaskFW Javascript SPA Stay-Header Error", 
	        	'sjqNoConflict("#headerStayContentSinTask").html(sintaskGFV'.$tzer.');'
	        );
        } else if($content == "footer") {
        	$final .= tryCatchTemplate(
	        	"SinTaskFW Javascript SPA Stay-Footer Error", 
	        	'sjqNoConflict("#footerStayContentSinTask").html(sintaskGFV'.$tzer.');'
	        );
      	} else if($content == "content") {
      		$final .= tryCatchTemplate(
	        	"SinTaskFW Javascript SPA Stay-Content Error", 
	        	'sjqNoConflict("#stayContentSinTask").html(sintaskGFV'.$tzer.');'
	        );
        }

		return $final;
	}

	/* addslashes tanpa menambah slash pada ' single quot */
	function addslashesCustom($input) {
		$input = addslashes($input);
		$input = str_replace("\'", "'", $input);
		return $input;
	}
	/* addslashes untuk meta (rendered page) */
	function addslashesMeta($input) {
		$input = addslashes($input);
		$input = str_replace("\'", "'", $input);
		$input = str_replace("\\\"", "&quot;", $input);
		$input = str_replace("\\\\", "&bsol;", $input);
		return $input;
	}

	/** 
	 * ------------------------
	 * SINTASKFW EXTRA FUNCTION
	 * ------------------------
	 */

	/* Function extra untuk memunculkan AM/PM dari jam */
	function amPmHour($input) {
		$output = "";
		$expInput = explode(":", $input);
		if($expInput[0]>12) {
			$s = $expInput[0]-12;
			if($s<10) {
				$s = "0".$s;
			}
			$output = $s.":".$expInput[1].":".$expInput[2]." PM";
		} else {
			if($expInput[0]==0) {
				$s = "12";
			} else {
				$s = $expInput[0];
			}
			$output = $s.":".$expInput[1].":".$expInput[2]." AM";
		}
		return $output;
	}
	/* Function extra untuk regex http */
	function httpRegexType($type) {
		$output = "";
		if($type==1) {
			$output = "%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%siu";
		} else if($type==2) {
			$output = "#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si";
		} else if($type==3) {
			$output = '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i';
		} else if($type==4) {
			$output = "/(?:http|https)?(?:\:\/\/)?(?:www.)?(([A-Za-z0-9-]+\.)*[A-Za-z0-9-]+\.[A-Za-z]+)(?:\/.*)?/im";
		} else if($type==5) {
			$output = '_^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/[^\s]*)?$_iuS';
		} else {
			$output = "@(https?|ftp)://(-\.)?([^\s/?\.#-]+\.?)+(/[^\s]*)?$@iS";
		}
		return $output;
	}
	/* Alias untuk httpRegexType */
	function regexType($type) {
		return httpRegexType($type);
	}
	/* Function extra untuk mengambil data browser user/visitor/client */
	function getBrowser() {
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
		$PLT = "";
		$BR_NAME = "";
		
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'Linux';
			$PLT = "LINUX";
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'Mac';
			$PLT = "MAC";
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'Windows';
			$PLT = "WINDOWS";
		}
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
			$BR_NAME = "MS_IE";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
			$BR_NAME = "MOZ_FIRE";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
			$BR_NAME = "CHROME";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
			$BR_NAME = "SAFARI";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
			$BR_NAME = "OPERA";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
			$BR_NAME = "NETSCAPE";
		}

		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
		}
		
		$i = count($matches['browser']);
		if ($i != 1) {
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		if ($version==null || $version=="") {
			$version="?";
		}
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern,
			'BR_NAME'	=> $BR_NAME
		);
	}
	/* Function extra untuk menghilangkan tag HTML */
	function netralizeContentFromHtmlTag($input) {
		/* Ganti '<br /> atau <br> atau <br/>' ke '' atau null */
		$breaks 		= array("<br />","<br>","<br/>");
		$input 			= str_ireplace($breaks, "", $input);
		/* Ganti '<div>' tag ke '' atau null */
		$breaksDiv 		= array("<div>","< div>","<div >","< div >");
		$input 			= str_ireplace($breaksDiv, "", $input);
		/* Ganti '&nbsp;' tag ke '' atau null */
		$breaksSpace	= array("&nbsp;");
		$input 			= str_ireplace($breaksSpace, "", $input);
		/* Deteksi HTML tag dan jadikan ke text */
		$input 			= strip_tags($input);
		$input 			= preg_replace("#<[^>]+>#", "", $input);

		return $input;
	}
	/* Untuk mengubah New Line ke \n, \r, \r\n */
	function brToNl($input) {
		/* Ganti '<div><br>' tag ke '\r\n' Spasi baru */
		$breaksDivBr	= array(
								"<div><br>",
								"< div><br>",
								"<div ><br>",
								"< div ><br>",
								"<div><br />",
								"< div><br />",
								"<div ><br />",
								"< div ><br />",
								"<div><br/>",
								"< div><br/>",
								"<div ><br/>",
								"< div ><br/>"
						);

		$getOs = hostOS();
		$replacer = "\n";
		if($getOs == "windows") {
			$replacer = "\r\n";
		} else {
			$replacer = "\n";
		}

		$input 			= str_ireplace($breaksDivBr, $replacer, $input);
		/* Ganti '<br /> atau <br> atau <br/>' ke '\r\n' Spasi baru */
		$breaks 		= array("<br />","<br>","<br/>");
		$input 			= str_ireplace($breaks, $replacer, $input);
		/* Ganti '<div>' tag ke '\r\n' Spasi baru */
		$breaksDiv 		= array("<div>","< div>","<div >","< div >");
		$input 			= str_ireplace($breaksDiv, $replacer, $input);
		/* Ganti '&nbsp;' tag ke '\s' Spasi baru */
		$breaksSpace	= array("&nbsp;");
		$input 			= str_ireplace($breaksSpace, " ", $input);
		/* Deteksi HTML tag dan jadikan ke text */
		$input 			= strip_tags($input);
		$input 			= preg_replace("#<[^>]+>#", "", $input);

		return $input;
	}
	/* Alias dari penulisan brToNl agar sesuai dengan nl2br (standard PHP) */
	function br2nl($input) {
		return brToNl($input);
	}
	/* Menghapus semua New Line menjadi Kosong */
	function br2zero($input) {
		/* Ganti '<br /> atau <br> atau <br/>' ke '' kosong */
		$breaks 		= array("<br />","<br>","<br/>");
		$input 			= str_ireplace($breaks, "", $input);
		/* Ganti '<div>' tag ke '' kosong */
		$breaksDiv 		= array("<div>","< div>","<div >","< div >");
		$input 			= str_ireplace($breaksDiv, "", $input);
		/* Ganti '&nbsp;' tag ke '\s' Spasi baru */
		$breaksSpace	= array("&nbsp;");
		$input 			= str_ireplace($breaksSpace, " ", $input);
		/* Deteksi HTML tag dan jadikan ke text */
		$input 			= strip_tags($input);
		$input 			= preg_replace("#<[^>]+>#", "", $input);

		return $input;
	}
	/* Menghapus semua New Line (\r, \n, \r\n) menjadi Spasi */
	function nl2space($input) {
		$breaks 	= array("\r\n", "\r", "\t\n", "\t");
		$input 		= str_ireplace($breaks, " ", $input);

		return $input;
	}
	/* Menghapus Slash dari ' misalnya \' menjadi hanya ' saja */
	function removeSlashOneQuot($input) {
		$breaks = array("\'");  
		$input = str_ireplace($breaks, "'", $input);
		return $input;
	}
	/* Membuat <br> dan &nbsp menjadi spasi */
	function normalizationNewLineAndSpaceHtml($input) {
		$breaks = array("<br />","<br>","<br/>","&nbsp;");  
		$input = str_ireplace($breaks, " ", $input);
		return $input;
	}
	/* Mengambil hanya nama Domain saja dari URL (tidak termasuk subdomain) 
 	 * Contoh : getDomainName("https://fw.sintask.com"); akan menghasilkan "sintask.com"
 	 * Contoh : getDomainName("https://fw.st.com"); akan menghasilkan "fw.st.com"
 	 * Contoh : getDomainName("https://fw.snt.id"); akan menghasilkan "fw.snt.id"
 	 * Contoh : getDomainName("https://fw.sntk.id"); akan menghasilkan "sntk.id"
	 */
	function getDomainName($url) {
		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
			return $regs['domain'];
		}
		return false;
	}
	/* Memudahkan function parse_url menjadi lebih singkat
	 * Contoh : parse_url($url, PHP_URL_HOST); hanya perlu tulis getDomainURL($url, "host");
	 */
	function getDomainURL($url, $type) {
		$type = strtolower($type);
		if($type=="scheme") {
			$return = parse_url($url, PHP_URL_SCHEME);
		} else if($type=="host") {
			$return = parse_url($url, PHP_URL_HOST);
		} else if($type=="port") {
			$return = parse_url($url, PHP_URL_PORT);
		} else if($type=="user") {
			$return = parse_url($url, PHP_URL_USER);
		} else if($type=="pass") {
			$return = parse_url($url, PHP_URL_PASS);
		} else if($type=="path") {
			$return = parse_url($url, PHP_URL_PATH);
		} else if($type=="query") {
			$return = parse_url($url, PHP_URL_QUERY);
		} else if($type=="fragment") {
			$return = parse_url($url, PHP_URL_FRAGMENT);
		}
		return $return;
	}
	/* Untuk men-cetak <br> HTML tag sesuai banyak yg diinginkan */
	function printbr($times = 1) {
		$result = "";
		for($a = 0; $a < $times; $a ++) {
			$result .= "<br>";
		}
		return $result;
	}
	/* Request CURL menggunakan userAgent Mozilla Firefox 43 */
	function curlDownload($Url) {
		$output = "";
		if (!function_exists('curl_init')){
			$output = "cURL is not installed";
		}
		
		$ch = curl_init();
		$userAgent = "Mozilla/5.0 Gecko/20100101 Firefox/43.0";
		
		$options = array(
			CURLOPT_URL            => $Url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING       => "UTF-8",
			CURLOPT_AUTOREFERER    => true,
			CURLOPT_CONNECTTIMEOUT => 120,
			CURLOPT_TIMEOUT        => 120,
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_USERAGENT      => $userAgent,
		);
		curl_setopt_array( $ch, $options );
		$output = curl_exec($ch);
		curl_close($ch);
	
		return $output;
	}
	/* Request CURL secara Asynchronous
	 * sangat cocok untuk request ke server tanpa harus menunggu response hingga selesai
	 */
	function curlAsyncShell($url, $timeout=1, $error_report=FALSE) {
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL,            $url         );
		curl_setopt( $curl, CURLOPT_HEADER,         FALSE        );
		curl_setopt( $curl, CURLOPT_TIMEOUT,        $timeout     );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE         );

		$htm = curl_exec($curl);
		$err = curl_errno($curl);
		$inf = curl_getinfo($curl);

		if(!$htm)
		{
			if($error_report)
			{
				echo "cURL ERROR -> $url [ TIMEOUT=$timeout, CURL_ERRNO=$err ]";
				echo "<pre>\n";
				var_dump($inf);
				echo "</pre>\n";
			}
			curl_close($curl);
			return FALSE;
		}

		curl_close($curl);
		return $htm;
	}
	/* Mengambil HTTP code saja menggunakan CURL */
	function curlDownloadInfo($Url) {
		if (!function_exists('curl_init')){
			die('cURL is not installed');
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_exec($ch);
		$output = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		return $output;
	}
	/* Mengambil Original URL jika menggunakan URL Shortener (tanpa blocking page) 
 	 * Maksimal Redirect URL = 10 (CURLOPT_MAXREDIRS)
	 */
	function getOriginalURL($url) {
		$ch = curl_init($url);
		$userAgent = "Mozilla/5.0 Gecko/20100101 Firefox/43.0";
		
		$options = array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_BINARYTRANSFER => true,
			CURLOPT_HEADER         => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING       => "UTF-8",
			CURLOPT_AUTOREFERER    => true,
			CURLOPT_CONNECTTIMEOUT => 120,
			CURLOPT_TIMEOUT        => 120,
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_USERAGENT      => $userAgent,
		);
		curl_setopt_array( $ch, $options );
		
		$header = curl_exec($ch);
		$redir = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		
		return $redir;
	}
	/* Mengambil hanya HOST dari URL (termasuk subdomain) */
	function urlFixed($url) {
		$urlFixed = parse_url($url, PHP_URL_HOST);
		if($urlFixed=="" || $urlFixed==null) {
			$urlExplode = explode("/", $url);
			$urlFixed = $urlExplode[0];
		}
		return $urlFixed;
	}
	/* Menggunakan regexType() mendeteksi URl dan menghasilkan true/false */
	function searchLinkCurl($input) {
		$regexType = 5;
		$regex = regexType($regexType);
		if(preg_match($regex, $input)) {
			return true;
		} else {
			return false;
		}
	}
	/* Menggunakan regexType() mendeteksi URl dan menghasilkan true/false 
	 * jika http://localhost akan bernilai true
	 */
	function urlCheckerv2($url) {
		$regexType = 5;
		$regex = regexType($regexType);
		if(preg_match($regex, $url)) {
			return true;
		} else {
			if(strcasecmp($url, "localhost")!=0) {
				$urlf = "http://".$url;
				if(preg_match($regex, $urlf)) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		}
	}
	/* Memperbaiki URL 
	 * Contoh : https://fw.sintask.com -> //fw.sintask.com
	 * Contoh : ngasal://www.sintask.com -> //
	 */
	function fixedTheURL($url, $addhost) {
		$output;
		if(searchLinkCurl($url) == false) {
			if(urlCheckerv2($url) == false) {
				$thispath = getDomainURL($url, "path");
				$four = getDomainURL($url, "query");

				$explodethepath = explode("/", $thispath);
				if($explodethepath[0]!="") {
					if($four!=null || $four!="") {
						$output = "//".$addhost."/".$thispath."?".$four;
					} else {
						$output = "//".$addhost."/".$thispath;
					}
				} else {
					if($four!=null || $four!="") {
						$output = "//".$addhost.$thispath."?".$four;
					} else {
						$output = "//".$addhost.$thispath;
					}
				}
			} else {
				$one = getDomainURL($url, "host");
				$two = getDomainURL($url, "port");
				$three = getDomainURL($url, "path");
				$four = getDomainURL($url, "query");
				if($two!=null || $two!="") {
					if($four!=null || $four!="") {
						$output = "//".$one.":".$two.$three."?".$four;
					} else {
						$output = "//".$one.":".$two.$three;
					}
				} else {
					if($four!=null || $four!="") {
						$output = "//".$one.$three."?".$four; 
					} else {
						$output = "//".$one.$three; 
					}    
				}   
			}
		} else {
			$one = getDomainURL($url, "host");
			$two = getDomainURL($url, "port");
			$three = getDomainURL($url, "path");
			$four = getDomainURL($url, "query");
			if($two!=null || $two!="") {
				if($four!=null || $four!="") {
					$output = "//".$one.":".$two.$three."?".$four;
				} else {
					$output = "//".$one.":".$two.$three;
				}
			} else {
				if($four!=null || $four!="") {
					$output = "//".$one.$three."?".$four; 
				} else {
					$output = "//".$one.$three; 
				}   
			}
		}
		return $output;
	}
	
	/* addslash dengan menambahkan \ pada \" menjadi \\\" */
	function addslashesCustomForLang($input) {
		$input = addslashes($input);
		$input = str_replace("\"", "\\\"", $input);
		return $input;
	}
	/* Menambahkan \ pada \\ menjadi \\\\ */
	function addslashesSlash($input) {
		$input = str_replace("\\", "\\\\", $input);
		return $input;
	}
	/* SinTaskFW fungsi untuk mengecek username yang di izinkan */
	function checkUsernameAllowed($usernameCheck) {
		if(
			(!ctype_space($usernameCheck))  					&& 
			(strlen($usernameCheck)>2) 							&& 
			($usernameCheck!="")								&&
			/* General Lv1 Blocked Word */
			(strcasecmp($usernameCheck, "admin")!=0)			&&
			(strcasecmp($usernameCheck, "administrator")!=0)	&&
			(strcasecmp($usernameCheck, "about")!=0)			&&
			(strcasecmp($usernameCheck, "api")!=0)				&&
			(strcasecmp($usernameCheck, "external")!=0)			&&
			(strcasecmp($usernameCheck, "sintask")!=0)			&&
			(strcasecmp($usernameCheck, "career")!=0)			&&
			(strcasecmp($usernameCheck, "karir")!=0)			&&
			(strcasecmp($usernameCheck, "xhr")!=0)				&&
			(strcasecmp($usernameCheck, "ajax")!=0)				&&
			(strcasecmp($usernameCheck, "tos")!=0)				&&
			(strcasecmp($usernameCheck, "term")!=0)				&&
			(strcasecmp($usernameCheck, "privacy")!=0)			&&
			(strcasecmp($usernameCheck, "setting")!=0)			&&
			(strcasecmp($usernameCheck, "settings")!=0)			&&
			(strcasecmp($usernameCheck, "notification")!=0)		&&
			(strcasecmp($usernameCheck, "notifications")!=0)	&&
			(strcasecmp($usernameCheck, "content")!=0)			&&
			(strcasecmp($usernameCheck, "konten")!=0)			&&
			(strcasecmp($usernameCheck, "tugas")!=0)			&&
			(strcasecmp($usernameCheck, "grup")!=0)				&&
			(strcasecmp($usernameCheck, "group")!=0)			&&
			(strcasecmp($usernameCheck, "game")!=0)				&&
			(strcasecmp($usernameCheck, "games")!=0)			&&
			(strcasecmp($usernameCheck, "permainan")!=0)		&&
			(strcasecmp($usernameCheck, "save")!=0)				&&
			(strcasecmp($usernameCheck, "simpan")!=0)			&&
			(strcasecmp($usernameCheck, "notif")!=0)			&&
			(strcasecmp($usernameCheck, "help")!=0)				&&
			(strcasecmp($usernameCheck, "tolong")!=0)			&&
			(strcasecmp($usernameCheck, "bantuan")!=0)			&&
			(strcasecmp($usernameCheck, "explore")!=0)			&&
			(strcasecmp($usernameCheck, "jelajahi")!=0)			&&
			(strcasecmp($usernameCheck, "more")!=0)				&&
			(strcasecmp($usernameCheck, "register")!=0)			&&
			(strcasecmp($usernameCheck, "login")!=0)			&&
			(strcasecmp($usernameCheck, "signin")!=0)			&&
			(strcasecmp($usernameCheck, "sso")!=0)				&&
			(strcasecmp($usernameCheck, "logout")!=0)			&&
			(strcasecmp($usernameCheck, "keluar")!=0)			&&
			(strcasecmp($usernameCheck, "forgot")!=0)			&&
			(strcasecmp($usernameCheck, "forget")!=0)			&&
			(strcasecmp($usernameCheck, "forgotpass")!=0)		&&
			(strcasecmp($usernameCheck, "forgetpass")!=0)		&&
			(strcasecmp($usernameCheck, "forgotpassword")!=0)	&&
			(strcasecmp($usernameCheck, "forgetpassword")!=0)	&&
			(strcasecmp($usernameCheck, "daftar")!=0)			&&
			(strcasecmp($usernameCheck, "masuk")!=0)			&&
			(strcasecmp($usernameCheck, "lupa")!=0)				&&
			(strcasecmp($usernameCheck, "lupapass")!=0)			&&
			(strcasecmp($usernameCheck, "lupapassword")!=0)		&&
			(strcasecmp($usernameCheck, "tentang")!=0)			&&
			(strcasecmp($usernameCheck, "company")!=0)			&&
			(strcasecmp($usernameCheck, "perusahaan")!=0)		&&
			(strcasecmp($usernameCheck, "jobs")!=0)				&&
			(strcasecmp($usernameCheck, "job")!=0)				&&
			(strcasecmp($usernameCheck, "pekerjaan")!=0)		&&
			(strcasecmp($usernameCheck, "link")!=0)				&&
			(strcasecmp($usernameCheck, "savelink")!=0)			&&
			(strcasecmp($usernameCheck, "simpanlink")!=0)		&&
			(strcasecmp($usernameCheck, "url")!=0)				&&
			(strcasecmp($usernameCheck, "simpanurl")!=0)		&&
			(strcasecmp($usernameCheck, "ads")!=0)				&&
			(strcasecmp($usernameCheck, "productiveandfun")!=0)	&&
			(strcasecmp($usernameCheck, "produktifdanfun")!=0)	&&
			(strcasecmp($usernameCheck, "produktif")!=0)		&&
			(strcasecmp($usernameCheck, "fun")!=0)				&&
			(strcasecmp($usernameCheck, "productive")!=0)		&&
			(strcasecmp($usernameCheck, "menyenangkan")!=0)		&&
			(strcasecmp($usernameCheck, "konsep")!=0)			&&
			(strcasecmp($usernameCheck, "cerita")!=0)			&&
			(strcasecmp($usernameCheck, "story")!=0)			&&
			(strcasecmp($usernameCheck, "novel")!=0)			&&
			(strcasecmp($usernameCheck, "note")!=0)				&&
			(strcasecmp($usernameCheck, "catatan")!=0)			&&
			(strcasecmp($usernameCheck, "feed")!=0)				&&
			(strcasecmp($usernameCheck, "feedback")!=0)			&&
			(strcasecmp($usernameCheck, "newsfeed")!=0)			&&
			/* General Lv2 Blocked Word */
			(strcasecmp($usernameCheck, "tim")!=0)				&&
			(strcasecmp($usernameCheck, "abc")!=0)				&&
			(strcasecmp($usernameCheck, "def")!=0)				&&
			(strcasecmp($usernameCheck, "ghi")!=0)				&&
			(strcasecmp($usernameCheck, "jkl")!=0)				&&
			(strcasecmp($usernameCheck, "mno")!=0)				&&
			(strcasecmp($usernameCheck, "pqr")!=0)				&&
			(strcasecmp($usernameCheck, "stu")!=0)				&&
			(strcasecmp($usernameCheck, "vwx")!=0)				&&
			(strcasecmp($usernameCheck, "xyz")!=0)				&&
			(strcasecmp($usernameCheck, "founder")!=0)			&&
			(strcasecmp($usernameCheck, "cofounder")!=0)		&&
			(strcasecmp($usernameCheck, "developer")!=0)		&&
			(strcasecmp($usernameCheck, "ceosintask")!=0)		&&
			(strcasecmp($usernameCheck, "ctosintask")!=0)		&&
			(strcasecmp($usernameCheck, "cmosintask")!=0)		&&
			(strcasecmp($usernameCheck, "cbosintask")!=0)		&&
			(strcasecmp($usernameCheck, "cfosintask")!=0)		&&
			(strcasecmp($usernameCheck, "ccosintask")!=0)		&&
			(strcasecmp($usernameCheck, "chiefsintask")!=0)		&&
			(strcasecmp($usernameCheck, "customerservice")!=0)	&&
			(strcasecmp($usernameCheck, "support")!=0)			&&
			(strcasecmp($usernameCheck, "cs")!=0)				&&
			(strcasecmp($usernameCheck, "support")!=0)			&&
			(strcasecmp($usernameCheck, "email")!=0)			&&
			(strcasecmp($usernameCheck, "device")!=0)			&&
			(strcasecmp($usernameCheck, "perangkat")!=0)		&&
			(strcasecmp($usernameCheck, "snk")!=0)				&&
			(strcasecmp($usernameCheck, "bug")!=0)				&&
			(strcasecmp($usernameCheck, "customersupport")!=0)	&&
			(strcasecmp($usernameCheck, "task")!=0)				&&
			(strcasecmp($usernameCheck, "official")!=0)			&&
			(strcasecmp($usernameCheck, "resmi")!=0)			&&
			(strcasecmp($usernameCheck, "real")!=0)				&&
			(strcasecmp($usernameCheck, "sint")!=0)				&&
			(strcasecmp($usernameCheck, "sintdotcf")!=0)		&&
			(strcasecmp($usernameCheck, "thesintask")!=0)		&&
			(strcasecmp($usernameCheck, "sintasknew")!=0)		&&
			(strcasecmp($usernameCheck, "sintaskdotcom")!=0)	&&
			(strcasecmp($usernameCheck, "sintaskofficial")!=0)	&&
			(strcasecmp($usernameCheck, "sintaskdeveloper")!=0)	&&
			(strcasecmp($usernameCheck, "sintaskweb")!=0)		&&
			(strcasecmp($usernameCheck, "sintaskwebsite")!=0)	&&
			(strcasecmp($usernameCheck, "sintaskmobile")!=0)	&&
			(strcasecmp($usernameCheck, "sintaskmobileapps")!=0)&&
			(strcasecmp($usernameCheck, "sintaskapi")!=0)		&&
			(strcasecmp($usernameCheck, "sintaskapps")!=0)		&&
			(strcasecmp($usernameCheck, "sintaskinc")!=0)		&&
			(strcasecmp($usernameCheck, "sintaskltd")!=0)		&&
			(strcasecmp($usernameCheck, "sintaskco")!=0)		&&
			(strcasecmp($usernameCheck, "sintaskandroid")!=0)	&&
			(strcasecmp($usernameCheck, "sintaskios")!=0)		&&
			(strcasecmp($usernameCheck, "sintaskdesktop")!=0)	&&
			(strcasecmp($usernameCheck, "jsdisabled")!=0)		&&
			(strcasecmp($usernameCheck, "html")!=0)				&&
			(strcasecmp($usernameCheck, "html1")!=0)			&&
			(strcasecmp($usernameCheck, "html2")!=0)			&&
			(strcasecmp($usernameCheck, "html3")!=0)			&&
			(strcasecmp($usernameCheck, "html4")!=0)			&&
			(strcasecmp($usernameCheck, "html5")!=0)			&&
			(strcasecmp($usernameCheck, "html5_1")!=0)			&&
			(strcasecmp($usernameCheck, "css")!=0)				&&
			(strcasecmp($usernameCheck, "javascript")!=0)		&&
			(strcasecmp($usernameCheck, "browser")!=0)			&&
			(strcasecmp($usernameCheck, "cvsintask")!=0)		&&
			(strcasecmp($usernameCheck, "ptsintask")!=0)		&&
			(strcasecmp($usernameCheck, "___")!=0)				&&
			/* Custom Blocked Word */
			(strcasecmp($usernameCheck, "water")!=0)			&&
			(strcasecmp($usernameCheck, "fire")!=0)				&&
			(strcasecmp($usernameCheck, "ground")!=0)			&&
			(strcasecmp($usernameCheck, "earth")!=0)			&&
			(strcasecmp($usernameCheck, "storm")!=0)			&&
			(strcasecmp($usernameCheck, "moon")!=0)				&&
			(strcasecmp($usernameCheck, "electric")!=0)			&&
			(strcasecmp($usernameCheck, "waffer")!=0)			&&
			(strcasecmp($usernameCheck, "test")!=0)				&&
			(strcasecmp($usernameCheck, "testt")!=0)			&&
			(strcasecmp($usernameCheck, "testtt")!=0)			&&
			(strcasecmp($usernameCheck, "testttt")!=0)			&&
			(strcasecmp($usernameCheck, "teest")!=0)			&&
			(strcasecmp($usernameCheck, "teeest")!=0)			&&
			(strcasecmp($usernameCheck, "teeeest")!=0)			&&
			(strcasecmp($usernameCheck, "block")!=0)			&&
			(strcasecmp($usernameCheck, "syntask")!=0)			&&
			(strcasecmp($usernameCheck, "seentask")!=0)
			) {
			return true;
		} else {
			return false;
		}
	}

	/* Template menampilkan kode html dari input dan berdasarkan banyaknya perulangan */
	function customHtmlLoopTemplate($htmlcode = "<br>", $count = 1) {
		$result = "";
		for($a = 0; $a < $count; $a++) {
			$result .= $htmlcode;
		}
		return $result;
	}
	/* Alias function customHtmlLoopTemplate() menjadi chlt();  */
	function chlt($htmlcode, $count) {
		return customHtmlLoopTemplate($htmlcode, $count);
	}

	/* Upload Gambar dan Kompresi 
	 * Berisi 8 function extra - khusus kompresi, resize, dan crop (normalisasi) gambar
	 */
	function compressImage($path, $quality, $destination, $original) {
		/*
			Kompresi gambar standar dan mendukung JPG / PNG
		*/
		$info = getimagesize($path);
		list($width, $height) = $info;

		$std_width = 700;
		$std_height = 700;

		if($width>$std_width && $width>$height) {
			$width_normalize 	= $width/$std_width;
			$percent_width 		= 100/$width_normalize;
			$percent_width 		= round($percent_width);
			$percent_width 		= $percent_width/100;

			$width_n 			= $width * $percent_width;
			$height_n 			= $height * $percent_width;
		}

		if($height>$std_height && $height>$width) {
			$height_normalize 	= $height/$std_height;
			$percent_height 	= 100/$height_normalize;
			$percent_height 	= round($percent_height);
			$percent_height 	= $percent_height/100;

			$width_n 			= $width * $percent_height;
			$height_n 			= $height * $percent_height;
		}

		$image_p = imagecreatetruecolor($width_n, $height_n); /* Buat pixel */
		if(($info['mime']=="image/jpeg" || $info['mime']=="image/jpg") && $original==0) {
			if ($info !== FALSE) {
				$image = imagecreatefromjpeg($path); /* Copy gambar */
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width_n, $height_n, $width, $height);
				imagejpeg($image_p, $destination, $quality); /* Hasil output */
				return $destination;
			}
		} else if(($info['mime']=="image/png") && $original==0) {
			if ($info !== FALSE) {
				imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
				imagealphablending($image_p, true);
				imagecopy($image_p, $image, 0, 0, 0, 0, $width_n, $height_n);
				
				$image = imagecreatefrompng($path); /* Copy gambar */
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width_n, $height_n, $width, $height);
				imagejpeg($image_p, $destination, $quality); /* Hasil output */
				return $destination;
			}
		}
	}
	function avaCompressImage($path, $quality, $destination, $original) {
		/*
			Fungsi untuk kompress + resize gambar ke 1:1 rasio
			untuk menjaga kualitas silahkan gunakan 90 - 99 ke $quality variabel
		*/
		$info = getimagesize($path);
		/*JPG IMG*/
		if(($info['mime']=="image/jpeg" || $info['mime']=="image/jpg")) {
			$perc = $quality;
			$percQ = $perc*100;
			if($perc==0.1) {
				$perc = 0.3;
			}
			if($perc==0.2) {
				$percQ = 60;
			}
			if($percQ>60) {
				$percQ = 60;
			}
			if($percQ<40) {
				$percQ = 40;
			}
			list($width, $height) = $info;
			if ($info !== FALSE) {
				$init_percent_two = 0;
				$pass_img = 0;
				if($width>$height) {
					$check_no_res = $width/$height;
					$check_no_res = number_format($check_no_res, 1, ".", "");
					if($check_no_res==1.0) {
						$pass_img = 1;
					}
				} else if($width<$height) {
					$check_no_res = $height/$width;
					$check_no_res = number_format($check_no_res, 1, ".", "");
					if($check_no_res==1.0) {
						$pass_img = 1;
					}
				} else if($width==$height) {
					$pass_img = 1;
				}
				/**/
				if($pass_img==0) {
					if($width>$height) {
						$new_w = $height-($height*$init_percent_two);
						$new_h = $height;
						$height_norm = 0;
						/**/
						$var_one = $width-$height;
						$var_two = floor($width * 0.25);
						if($var_one>$var_two) {
							$width_norm = floor($width * 0.25);
						} else {
							$width_norm = floor($width * 0.1);
						}
					} else if($width<$height) {
						$new_w = $width-($width*$init_percent_two);
						$new_h = $width;
						$width_norm = 0;
						/**/
						$var_one = $height-$width;
						$var_two = floor($height * 0.25);
						if($var_one>$var_two) {
							$height_norm = floor($height * 0.25);
						} else {
							$height_norm = floor($height * 0.1);
						}
					}
				} else if($pass_img==1) {
					$new_w = $width;
					$new_h = $height;
				}
				$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */
				$image = imagecreatefromjpeg($path); /* Copy gambar */
				imagecopyresampled($image_p, $image, 0, 0, $width_norm, $height_norm, $width, $height, imagesx($image), imagesy($image));
				imagejpeg($image_p, $destination, $percQ); /* Hasil output */
				return $destination;
			}
		/*PNG IMG*/
		} else if(($info['mime']=="image/png")) {
			$perc = $quality;
			$percQ = $perc*100;
			if($perc==0.1) {
				$perc = 0.3;
			}
			if($perc==0.2) {
				$percQ = 60;
			}
			if($percQ>60) {
				$percQ = 60;
			}
			if($percQ<40) {
				$percQ = 40;
			}
			list($width, $height) = $info;
			if ($info !== FALSE) {
				$init_percent_two = 0;
				$pass_img = 0;
				if($width>$height) {
					$check_no_res = $width/$height;
					$check_no_res = number_format($check_no_res, 1, ".", "");
					if($check_no_res==1.0) {
						$pass_img = 1;
					}
				} else if($width<$height) {
					$check_no_res = $height/$width;
					$check_no_res = number_format($check_no_res, 1, ".", "");
					if($check_no_res==1.0) {
						$pass_img = 1;
					}
				} else if($width==$height) {
					$pass_img = 1;
				}
				/**/
				if($pass_img==0) {
					if($width>$height) {
						$new_w = $height-($height*$init_percent_two);
						$new_h = $height;
						$height_norm = 0;
						/**/
						$var_one = $width-$height;
						$var_two = floor($width * 0.25);
						if($var_one>$var_two) {
							$width_norm = floor($width * 0.25);
						} else {
							$width_norm = floor($width * 0.1);
						}
					} else if($width<$height) {
						$new_w = $width-($width*$init_percent_two);
						$new_h = $width;
						$width_norm = 0;
						/**/
						$var_one = $height-$width;
						$var_two = floor($height * 0.25);
						if($var_one>$var_two) {
							$height_norm = floor($height * 0.25);
						} else {
							$height_norm = floor($height * 0.1);
						}
					}
				} else if($pass_img==1) {
					$new_w = $width;
					$new_h = $height;
				}
				$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */

				if($original==1) {
					imagecolortransparent($image_p, imagecolorallocatealpha($image_p, 255, 255, 255, 127));
					imagealphablending($image_p, false);
					imagesavealpha($image_p, true);
					
					$image = imagecreatefrompng($path); /* Copy gambar */
					imagecopyresampled($image_p, $image, 0, 0, $width_norm, $height_norm, $width, $height, imagesx($image), imagesy($image)); /* Gabungkan ke2nya */
					imagepng($image_p, $destination, 6); /* Hasil output */
				} else {
					imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
					imagealphablending($image_p, true);
					imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
					
					$image = imagecreatefrompng($path); /* Copy gambar */
					imagecopyresampled($image_p, $image, 0, 0, $width_norm, $height_norm, $width, $height, imagesx($image), imagesy($image)); /* Gabungkan ke2nya */
					imagejpeg($image_p, $destination, $percQ); /* Hasil output */
				}
				return $destination;
			}
		/* Untuk gambar tidak terdeteksi */
		} else { /* compression default */
			list($width, $height) = $info;
			if ($info !== FALSE) {
				$init_percent_two = 0;
				$pass_img = 0;
				if($width>$height) {
					$check_no_res = $width/$height;
					$check_no_res = number_format($check_no_res, 1, ".", "");
					if($check_no_res==1.0) {
						$pass_img = 1;
					}
				} else if($width<$height) {
					$check_no_res = $height/$width;
					$check_no_res = number_format($check_no_res, 1, ".", "");
					if($check_no_res==1.0) {
						$pass_img = 1;
					}
				} else if($width==$height) {
					$pass_img = 1;
				}
				/**/
				if($pass_img==0) {
					if($width>$height) {
						$new_w = $height-($height*$init_percent_two);
						$new_h = $height;
						$height_norm = 0;
						/**/
						$var_one = $width-$height;
						$var_two = floor($width * 0.25);
						if($var_one>$var_two) {
							$width_norm = floor($width * 0.25);
						} else {
							$width_norm = floor($width * 0.1);
						}
					} else if($width<$height) {
						$new_w = $width-($width*$init_percent_two);
						$new_h = $width;
						$width_norm = 0;
						/**/
						$var_one = $height-$width;
						$var_two = floor($height * 0.25);
						if($var_one>$var_two) {
							$height_norm = floor($height * 0.25);
						} else {
							$height_norm = floor($height * 0.1);
						}
					}
				} else if($pass_img==1) {
					$new_w = $width;
					$new_h = $height;
				}

				$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */

				if($info['mime']=="image/png") {
					imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
					imagealphablending($image_p, true);
					imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
					
					$image = imagecreatefrompng($path); /* Copy gambar */
					imagecopyresampled($image_p, $image, 0, 0, $width_norm, $height_norm, $width, $height, imagesx($image), imagesy($image)); /* Gabungkan ke2nya */
					imagejpeg($image_p, $destination, 60); /* Hasil output */
				} else {
					$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */
					$image = imagecreatefromjpeg($path); /* Copy gambar */
					imagecopyresampled($image_p, $image, 0, 0, $width_norm, $height_norm, $width, $height, imagesx($image), imagesy($image)); /* Gabungkan ke2nya */
					imagejpeg($image_p, $destination, 60); /* Hasil output */
				}
				return $destination;
			}
		}
	}
	function curlStandarizationImage($path, $quality, $destination, $crop) {
		$info = getimagesize($path);
		list($width, $height) = $info;

		$std_w = 500;
		$std_h = 250;

		if($height>400) {
			$std_w = 700;
			$std_h = 350;
		}

		$percentage = $crop;
		$perc = $quality;
		$percQ = $perc*100;

		if(($height/$width)>=0.5) {
			$new_w = $width;
			$new_h = $width/($std_w/$std_h);
			/* SinTask Crop Normalization */
			$scm_0 = $new_h/100;
			$scm_1 = $percentage*$scm_0;
			/**/
			$norm_height = ceil($height*($percentage/100));
			$norm_height = $norm_height-$scm_1;

			if($info['mime']=="image/jpeg" || $info['mime']=="image/jpg") {
				$image_p = imagecreatetruecolor($width, $new_h); /* Buat pixel */
				$image = imagecreatefromjpeg($path); /* Copy gambar */
				imagecopyresampled($image_p, $image, 0, 0, 0, $norm_height, $width, $height, imagesx($image), imagesy($image));
				imagejpeg($image_p, $destination, $percQ); /* Hasil output */
			} else if($info['mime']=="image/png") {
				$image_p = imagecreatetruecolor($width, $new_h); /* Buat pixel */
				imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
				
				imagealphablending($image_p, true);
				imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
				
				$image = imagecreatefrompng($path); /* Copy gambar */
				imagecopyresampled($image_p, $image, 0, 0, 0, $norm_height, $width, $height, imagesx($image), imagesy($image));
				imagejpeg($image_p, $destination, $percQ); /* Hasil output */
			}
		} else {
			$new_h = $height;
			$new_w = $height/($std_h/$std_w);
			/* SinTask Crop Normalization */
			$scm_0 = $new_w/100;
			$scm_1 = $percentage*$scm_0;
			/**/
			$norm_width = ceil($width*($percentage/100));
			$norm_width = $norm_width-$scm_1;

			if($info['mime']=="image/jpeg" || $info['mime']=="image/jpg") {
				$image_p = imagecreatetruecolor($new_w, $height); /* Buat pixel */
				$image = imagecreatefromjpeg($path); /* Copy gambar */
				imagecopyresampled($image_p, $image, 0, 0, $norm_width, 0, $width, $height, imagesx($image), imagesy($image));
				imagejpeg($image_p, $destination, $percQ); /* Hasil output */
			} else if($info['mime']=="image/png") {
				$image_p = imagecreatetruecolor($new_w, $height); /* Buat pixel */
				imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
				
				imagealphablending($image_p, true);
				imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
				
				$image = imagecreatefrompng($path); /* Copy gambar */
				imagecopyresampled($image_p, $image, 0, 0, $norm_width, 0, $width, $height, imagesx($image), imagesy($image));
				imagejpeg($image_p, $destination, $percQ); /* Hasil output */
			}
		}
	}
	function curlResizeImage($path, $quality, $destination) {
		$info = getimagesize($path);
		list($width, $height) = $info;

		$new_w = 500;
		$new_h = 250;

		if($height>400) {
			$new_w = 700;
			$new_h = 350;
		}

		if($info['mime']=="image/jpeg" || $info['mime']=="image/jpg") {
			$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */
			$image = imagecreatefromjpeg($path); /* Copy gambar */
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
			imagejpeg($image_p, $destination, $quality); /* Hasil output */
		} else if($info['mime']=="image/png") {
			$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */
			imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
			imagealphablending($image_p, true);
			imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
			
			$image = imagecreatefrompng($path); /* Copy gambar */
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
			imagejpeg($image_p, $destination, 100); /* Hasil output */
		}
	}
	function curlCheckerImage($path, $quality, $destination) {
		/* 
			Resize gambar dari link eksternal atau konten, untuk digunakan sebagai preview

			------------
			Perhatian !
			------------
			Nilai balik variable harus berupa true atau false (boolean), bukan 1 = true atau 0 = '' = false
			fungsi ini berhubungan dengan fungsi curlDownloadImage menggunakan === yang lebih teliti
		*/
		$info = getimagesize($path);
		list($width, $height) = $info;
		if ($info !== FALSE) {

			$image_p = imagecreatetruecolor($width, $height); /* Buat pixel */

			if($info['mime']=="image/png") {
				imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
				imagealphablending($image_p, true);
				
				$image = imagecreatefrompng($path); /* Copy gambar */
				if(!$imagecheck = @imagecreatefromstring(file_get_contents($path))) { 
					return false; 
				} else {
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image)); /* Gabungkan ke2nya */
					imagejpeg($image_p, $destination, $quality); /* Hasil output */
					return true;
				}
			} else if($info['mime']=="image/jpeg" || $info['mime']=="image/jpg") {
				imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
				imagealphablending($image_p, true);

				$image = imagecreatefromjpeg($path); /* Copy gambar */
				if(!$imagecheck = @imagecreatefromstring(file_get_contents($path))) { 
					return false; 
				} else {
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
					imagejpeg($image_p, $destination, $quality); /* Hasil output */
					return true;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	function avaResizeImage($path, $quality, $destination, $original) {
		/*
			Resize untuk Avatar/Foto Profil ke :
				35x35 	Super kecil
				40x40 	Kecil
				80x80 	Medium
				200x200 Besar
			Mendukung JPG / PNG, ekstensi lain akan dikonversi ke JPG
		*/
		$info = getimagesize($path);
		list($width, $height) = $info;
		if(($info['mime']=="image/jpeg" || $info['mime']=="image/jpg") && $original==0) {
			$perc = $quality;
			$percQ = $perc*100;
			if($perc==0.1) {
				$perc = 0.3;
			}
			if($perc==0.2) {
				$percQ = 60;
			}
			if($percQ>60) {
				$percQ = 60;
			}
			if($percQ<40) {
				$percQ = 40;
			}

			if ($info !== FALSE) {
				if($perc==0.1 || $perc==0.2) {
					$new_w = 35;
					$new_h = 35;
				} else if($perc==0.3) {
					$new_w = 40;
					$new_h = 40;
				} else if($perc==0.5) {
					$new_w = 80;
					$new_h = 80;
				} else if($perc==0.8) {
					$new_w = 200;
					$new_h = 200;
				} else {
					$new_w = $width * $perc;
					$new_h = $height * $perc;
				}
				
				$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */
				$image = imagecreatefromjpeg($path); /* Copy gambar */
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
				imagejpeg($image_p, $destination, 100); /* Hasil output */
			}
		} else if(($info['mime']=="image/png") && $original==0) {
			$perc = $quality;
			$percQ = $perc*100;
			if($perc==0.1) {
				$perc = 0.3;
			}
			if($perc==0.2) {
				$percQ = 60;
			}
			if($percQ>60) {
				$percQ = 60;
			}
			if($percQ<40) {
				$percQ = 40;
			}

			if ($info !== FALSE) {
				if($perc==0.1 || $perc==0.2) {
					$new_w = 35;
					$new_h = 35;
				} else if($perc==0.3) {
					$new_w = 40;
					$new_h = 40;
				} else if($perc==0.5) {
					$new_w = 80;
					$new_h = 80;
				} else if($perc==0.8) {
					$new_w = 200;
					$new_h = 200;
				} else {
					$new_w = $width * $perc;
					$new_h = $height * $perc;
				}

				$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */

				if($original==1) {
					imagecolortransparent($image_p, imagecolorallocatealpha($image_p, 255, 255, 255, 127));
					imagealphablending($image_p, false);
					imagesavealpha($image_p, true);
					
					$image = imagecreatefrompng($path); /* Copy gambar */
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
					imagepng($image_p, $destination, 9); /* Hasil output */
				} else {
					imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
					imagealphablending($image_p, true);
					imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
					
					$image = imagecreatefrompng($path); /* Copy gambar */
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
					imagejpeg($image_p, $destination, 100); /* Hasil output */
				}
			}
		} else { /* compression default */
			if ($info !== FALSE) {
				$new_w = $width;
				$new_h = $height;

				$image_p = imagecreatetruecolor($new_w, $new_h); /* Buat pixel */

				if($info['mime']=="image/png") {
					imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
					imagealphablending($image_p, true);
					imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
					
					$image = imagecreatefrompng($path); /* Copy gambar */
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
					imagejpeg($image_p, $destination, 100); /* Hasil output */
				} else {
					$image = imagecreatefromjpeg($path); /* Copy gambar */
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
					imagejpeg($image_p, $destination, 100); /* Hasil output */
				}
			}
		}
	}
	function covResizeImage($path, $quality, $destination, $crop) {
		/*
			Resize gambar cover (group) dengan rasio 5,454545..:1 contohnya :
				54,5  x 10
				109   x 20
				163,5 x 30
				.... atau ....
				600	x 110
				.... atau ....
				1366 x 250 -> 5,464:1 aspek rasio juga dapat digunakan
			$crop adalah input dari fungsi untuk nilai reposisi dari gambar yang mempunyai tinggi > = lebar
			nilai dari input akan dinormalisasi pada 'SinTask Crop Normalization'
		*/
		$info = getimagesize($path);
		list($width, $height) = $info;

		$percentage = $crop;
		$perc = $quality;
		$percQ = $perc*100;

		$std_w = 600;
		$std_h = 110;

		$new_w = $width;
		$new_h = $width/($std_w/$std_h);
		/* SinTask Crop Normalization */
		$scm_0 = $new_h/100;
		$scm_1 = $percentage*$scm_0;
		/**/
		$norm_height = ceil($height*($percentage/100));
		$norm_height = $norm_height-$scm_1;

		if($info['mime']=="image/jpeg" || $info['mime']=="image/jpg") {
			$image_p = imagecreatetruecolor($width, $new_h); /* Buat pixel */
			$image = imagecreatefromjpeg($path); /* Copy gambar */
			imagecopyresampled($image_p, $image, 0, 0, 0, $norm_height, $width, $height, imagesx($image), imagesy($image));
			imagejpeg($image_p, $destination, $percQ); /* Hasil output */
		} else if($info['mime']=="image/png") {
			$image_p = imagecreatetruecolor($width, $new_h); /* Buat pixel */
			imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
			
			imagealphablending($image_p, true);
			imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
			
			$image = imagecreatefrompng($path); /* Copy gambar */
			imagecopyresampled($image_p, $image, 0, 0, 0, $norm_height, $width, $height, imagesx($image), imagesy($image));
			imagejpeg($image_p, $destination, $percQ); /* Hasil output */
		}
	}
	function covUserResizeImage($path, $quality, $destination, $crop) {
		/*
			Resize gambar cover (profil) dengan rasio 3,7472..:1 contohnya :
				37 	x 10
				74 	x 20
				111	x 30
				.... or ....
				851	x 227
				.... or ....
				1349 x 360 -> 3,7:1 aspek rasio juga dapat digunakan
			$crop adalah input dari fungsi untuk nilai reposisi dari gambar yang mempunyai tinggi > = lebar
			nilai dari input akan dinormalisasi pada 'SinTask Crop Normalization' 
		*/
		$info = getimagesize($path);
		list($width, $height) = $info;

		$percentage = $crop;
		$perc = $quality;
		$percQ = $perc*100;

		$std_w = 851;
		$std_h = 227;

		$new_w = $width;
		$new_h = $width/($std_w/$std_h);
		/* SinTask Crop Normalization */
		$scm_0 = $new_h/100;
		$scm_1 = $percentage*$scm_0;
		/**/
		$norm_height = ceil($height*($percentage/100));
		$norm_height = $norm_height-$scm_1;

		if($info['mime']=="image/jpeg" || $info['mime']=="image/jpg") {
			$image_p = imagecreatetruecolor($width, $new_h); /* Buat pixel */
			$image = imagecreatefromjpeg($path); /* Copy gambar */
			imagecopyresampled($image_p, $image, 0, 0, 0, $norm_height, $width, $height, imagesx($image), imagesy($image));
			imagejpeg($image_p, $destination, $percQ); /* Hasil output */
		} else if($info['mime']=="image/png") {
			$image_p = imagecreatetruecolor($width, $new_h); /* Buat pixel */
			imagefill($image_p, 0, 0, imagecolorallocate($image_p, 255, 255, 255));
			
			imagealphablending($image_p, true);
			imagecopy($image_p, $image, 0, 0, 0, 0, $new_w, $new_h);
			
			$image = imagecreatefrompng($path); /* Copy gambar */
			imagecopyresampled($image_p, $image, 0, 0, 0, $norm_height, $width, $height, imagesx($image), imagesy($image));
			imagejpeg($image_p, $destination, $percQ); /* Hasil output */
		}
	}
	
	/* 	Function Normalisasi dan memperbaiki JSON - Bug pada konten yg memiliki nilai , atau ] atau [ */
	function fixStJson($input) {
		$input = str_replace(",]", "]", $input);
		$input = str_replace("[,", "]", $input);
		$input = str_replace(",,", ",", $input);
		
		$result = $input;
		return $result;
	}
	/* 	Function Normalisasi dan memperbaiki JSON v2 - Bug pada konten yg memiliki nilai , atau ] atau [ */
	function fixStJsonTwo($input) {
		$input = preg_replace("/,{2,}/", ",", $input);
		$input = preg_replace("/,\s+\]/", "]", $input);

		$result = fixStJson($input);
		return $result;
	}

	/* 	Function menghapus <\/SCRIPT> nilai variable */
	function remScriptErr($input) {
		$input = str_ireplace("</script>", "<\/script>", $input);
		$result = $input;
		return $result;
	}
	/* 	Mengambil timestamp dengan 13 digit */
	function milliSecondsNow() {
		$mt = explode(' ', microtime());
		return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
	}
	/* Alias dari milliSecondsNow(); */
	function microTimeStamp() {
		return milliSecondsNow();
	}
	/* 	Function cutString - Untuk memotong nilai yang panjang, tetapi telah digantikan oleh CSS : 
		---------------
		.wrapLongText {	
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			display: block; 
		}
		{-ATAU-}
		.wrapLongTextInline {	
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			display: inline-block; 
		}
		---------------
		Fungsi Deprecated
	*/
	function cutString($input, $len, $overlen) {
		$result = "";
		$lenghtInput = strlen($input);
		if($lenghtInput>$len) {
			$result = substr($input,0,$len).$overlen;
		} else {
			$result = $input;
		}
		return $result;
	}
	/* Function File Size translasi dari B (Byte) */
	function fileSizeFrByToAll($fileSize, $fileSizeNumFor) {
		/*
			Ini manual, untuk dinamis gunakan POW atau ^ fungsi matematika
			lalu dibagikan oleh $fileSize & nilai pendekatan
		*/
		$fileSizeTwo = $fileSize;
		$fileSizeType = "B";
		if($fileSize>1072668082176) { /* to TB */
			$fileSizeTwo = $fileSize/1099511627776;
			$fileSizeType = "TB";
		} else if($fileSize>1047527424 && $fileSize<=1072668082176) { /* to GB */
			$fileSizeTwo = $fileSize/1073741824;
			$fileSizeType = "GB";
		} else if($fileSize>1022976 && $fileSize<=1047527424) { /* to MB */
			$fileSizeTwo = $fileSize/1048576;
			$fileSizeType = "MB";
		} else if($fileSize>999 && $fileSize<=1022976) { /* to KB */
			$fileSizeTwo = $fileSize/1024;
			$fileSizeType = "KB";
		} else { /* to BYTE */
			$fileSizeTwo = $fileSize;
			$fileSizeType = "B";
		}
		$fileSizeNotFormatedNum = $fileSizeTwo;
		$fileSizeFinal = number_format($fileSizeNotFormatedNum, $fileSizeNumFor)." ".$fileSizeType;
		return $fileSizeFinal;
	}
	/* Check PregMatch - Check PregMatch email dan username, nilai balik berupa boolean 
	 * memiliki 2 tipe = email & username
	 * ------------------------
	 * Validitas Email standard
	 * Validitas Username dengan menggunakan angka atau huruf atau _ underscore
	 */
	function checkPregMatch($input, $type) {
		if($type=="email") {
			$emailn_regex = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
			if(preg_match($emailn_regex, $input)) {
				return true;
			} else {
				return false;
			}
		} else if($type=="username") {
			$usern_regex = "/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/";
			if(preg_match($usern_regex, $input)) {
				if(strlen($input) < 3 || strlen($input) > 20) {
					return false;
				} else {
					return true;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/* Anti SQL Injection */
	function antiInjection($input){
		$filter = stripslashes(strip_tags(htmlspecialchars($input, ENT_QUOTES)));
		return $filter;
	}
	/* Acak dari array variable */
	function shuffleArray(&$array) {
		$keys = array_keys($array);
		shuffle($keys);
		
		foreach($keys as $key) {
			$new[$key] = $array[$key];
		}
		
		$array = $new;
		return true;
	}
	/* Ambil cURL Preview Internal 
 	 * Sebagian menggunakan bahasa inggris (comment)
	 */
	function getCurlPreviewContent($url) {
		$finalURL = $url;

		$html = curlDownload($finalURL);
		$doc = new DOMDocument();
		$doc->loadHTML($html);
		
		/*INITIATE*/
		$urlFixed = "";
		$title = $desc = $image = $keywords = $sitename = $hostname = [];
		/*END INITIATE*/
		
		/*GET URL*/
		$urlFixed = urlFixed($finalURL);
		/*END GET URL*/
		
		/*GET BY PROPERTY*/
		foreach( $doc->getElementsByTagName('meta') as $meta ) { 
			$property = $meta->getAttribute('property');
			if  (
					(strcasecmp($property, "og:title")==0)              ||
					(strcasecmp($property, "twitter:title")==0)
				) 
					{
						$c = $meta->getAttribute('content');
						array_push($title, $c);
					}
			if  (
					(strcasecmp($property, "og:description")==0)        ||
					(strcasecmp($property, "twitter:description")==0)
				) 
					{
						$c = $meta->getAttribute('content');
						array_push($desc, $c);
					}
			if  (
					(strcasecmp($property, "og:image")==0)          ||
					(strcasecmp($property, "twitter:image:src")==0) ||
					(strcasecmp($property, "twitter:image")==0)
				) 
					{
						$c = $meta->getAttribute('content');
						array_push($image, $c);
					}
			if  (
					(strcasecmp($property, "og:keywords")==0)       ||
					(strcasecmp($property, "twitter:keywords")==0)
				) 
					{
						$c = $meta->getAttribute('content');
						array_push($keywords, $c);
					}
			if  (
					(strcasecmp($property, "og:site_name")==0)      ||
					(strcasecmp($property, "twitter:site_name")==0) ||
					(strcasecmp($property, "twitter:site")==0)
				) 
					{
						$c = $meta->getAttribute('content');
						array_push($sitename, $c);
					}
		}
		/*END GET BY PROPERTY*/
		
		/*GET BY NAME*/
		foreach( $doc->getElementsByTagName('meta') as $meta ) { 
			$property = $meta->getAttribute('name');
			if(strcasecmp($property, "title")==0) {
				$c = $meta->getAttribute('content');
				array_push($title, $c);
			}
			if(strcasecmp($property, "description")==0) {
				$c = $meta->getAttribute('content');
				array_push($desc, $c);
			}
			if(strcasecmp($property, "image")==0) {
				$c = $meta->getAttribute('content');
				array_push($image, $c);
			}
			if(strcasecmp($property, "keywords")==0) {
				$c = $meta->getAttribute('content');
				array_push($keywords, $c);
			}
			if(
				(strcasecmp($property, "site_name")==0) ||
				(strcasecmp($property, "site")==0)
			) {
				$c = $meta->getAttribute('content');
				array_push($sitename, $c);
			}
			if(strcasecmp($property, "hostname")==0) {
				$c = $meta->getAttribute('content');
				array_push($hostname, $c);
			}
		}
		/*END GET BY NAME */
		
		/*TITLE BY TAG*/
		$nodes = $doc->getElementsByTagName('title');
		$c = $nodes->item(0)->nodeValue;
		array_push($title, $c);
		/*END TITLE BY TAG*/
		
		/*DESC BY TAG*/
		$bqnodes = $doc->getElementsByTagName('blockquote');
		$c = $bqnodes->item(0)->nodeValue;
		array_push($desc, $c);
		
		$pnodes = $doc->getElementsByTagName('h1');
		$pnodeslen = $pnodes->length;
		for ($i = 0; $i < $pnodeslen; $i++) {
			$c = $pnodes->item($i)->nodeValue;
			if($c!="" || $c!=null) {
				array_push($desc, $c);
			}
		}
		/*END DESC BY TAG*/
		
		/*GET IMAGE BY TAG*/
		$imgtag = $doc->getElementsByTagName('img');
		$imglen = $imgtag->length;
		for ($i = 0; $i < $imglen; $i++) {
			$alterimage = $imgtag->item($i);
			$c = $alterimage->getAttribute('src');
			if($c!="" || $c!=null) {
				array_push($image, $c);
			}
		}
		/*END GET IMAGE*/
		
		/*PUSH BY TITLE URL*/
		array_push($title, $urlFixed);
		/*END PUSH*/

		/*ALL_LENGTH*/
		$titleleng = count($title);
		$descleng = count($desc);
		$imageleng = count($image);
		$keywordsleng = count($keywords);
		$sitenameleng = count($sitename);
		$hostnameleng = count($hostname);
		/*END_ALL_LENGTH*/

		if($titleleng>5) {
			$titleleng = 5;
		}
		if($descleng>5) {
			$descleng = 5;
		}
		if($imageleng>5) {
			$imageleng = 5;
		}

		if(urlCheckerv2($urlFixed)==1 || urlCheckerv2($urlFixed)==true) {
			$imageOn 	= "";
			$titleOn 	= "";
			$descOn 	= "";
			$realUrlOn 	= "";
			$urlOn 		= "";
			$fullUrlOn 	= "";

			for($i = 0; $i < $imageleng; $i++) {
				if($image[$i]!="") {
					if((searchLinkCurl($image[$i]) == false) && (strcasecmp($urlFixed, "localhost") != 0)) {
						$randomId = getRandomPlusDate(22);
						$pictCurlImg = curlDownloadImage(fixedTheURL($image[$i], $urlFixed), $randomId);

						if($pictCurlImg["statuscode"]=="400") {
							$pictCurlImgEnd = "null";
							$imageOn = "";
						} else {
							$pictCurlImgEnd = getPictUrl($pictCurlImg["return"], "external_img", "", "");
							$imageOn = $pictCurlImg['iddata']; 
						}

						$imageLink = $pictCurlImgEnd;
					} else {
						$randomId = getRandomPlusDate(22);
						$pictCurlImg = curlDownloadImage($image[$i], $randomId);

						if($pictCurlImg["statuscode"]=="400") {
							$pictCurlImgEnd = "null";
							$imageOn = "";
						} else {
							$pictCurlImgEnd = getPictUrl($pictCurlImg["return"], "external_img", "", "");
							$imageOn = $pictCurlImg['iddata']; 
						}

						$imageLink = $pictCurlImgEnd;
					}
					$i = $imageleng;
				} else {
					if($i==$imageleng-1) {
						$imageOn = "";
					}
				}
			}
			if($imageleng==0) {
				$imageOn = "";
			}
			for($i = 0; $i < $titleleng; $i++) {
				if($title[$i]!="") {
					$titleOn = toSingleLine(addslashesCustom($title[$i]));
					$i = $titleleng;
				} else {
					if($i==$titleleng-1) {
						$titleOn = "";
					}
				}
			}
			for($i = 0; $i < $descleng; $i++) {
				if($desc[$i]!="") {
					$descOn = toSingleLine(addslashesCustom($desc[$i]));
					$i = $descleng;
				} else {
					if($i==$descleng-1) {
						$descOn = "";
					}
				}
			}

			$realUrlOn 	= getOriginalURL($finalURL);
			/* if original URL is empty or null get the realUrl = fullUrl */
			if($realUrlOn=="" || $realUrlOn==null) {
				$realUrlOn = $finalURL;
			}

			$urlOn 		= toSingleLine(addslashes(strtoupper($urlFixed)));
			$fullUrlOn 	= $finalURL;

			return array(
				'statuscode' 	=> "200",
				'image'      	=> addslashes($imageOn),
				'title'			=> addslashes($titleOn),
				'desc'			=> addslashes($descOn),
				'real_url'		=> ($realUrlOn),
				'url'			=> ($urlOn),
				'full_url'		=> ($fullUrlOn),
			);
		} else {
			return array(
				'statuscode' 	=> "400",
			);
		}
	}

	/* Menghapus baris baru \r\n setelah fungsi nl2br */ 
	function removeNewLine($input) {
		$input = nl2br($input);
		$input = preg_replace("/[\r\n]+/", "", $input);
		return $input;
	}
	/* Menghapus baris baru \r\n */ 
	function removeNewLineTwo($input) {
		$input = preg_replace("/[\r\n]+/", " ", $input);
		return $input;
	}
	/* Menghapus &quot; pada html menjadi normal quot */ 
	function replaceQuoteHtml($input) {
		$input = str_replace("&quot;", "\"", $input);
		return $input;
	}
	/* Menghapus slash single quot pada html menjadi normal single quot */ 
	function replaceSingleQuote($input) {
		$input = str_replace("\'", "'", $input);
		return $input;
	}

	/* Menghapus direktori secara rekursif beserta file */
	function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir); 
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object)) {
                        rrmdir($dir."/".$object);
                    } else {
                        unlink($dir."/".$object);
                    }
                } 
            }
            rmdir($dir); 
        } 
    }

    /**
     * Mengcopy file secara rekursif
     * ----------------------------
     * -- Fungsi dari Aidan Lister --
	 * Copy a file, or recursively copy a folder and its contents
	 * @author      Aidan Lister <aidan@php.net>
	 * @version     1.0.1
	 * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
	 * @param       string   $source    Source path
	 * @param       string   $dest      Destination path
	 * @param       int      $permissions New folder creation permissions
	 * @return      bool     Returns true on success, false on failure
	 */
    function rcopy($source, $dest, $permissions = 0755) {
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }
        
        if (is_file($source)) {
            return copy($source, $dest);
        }
        
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }
        
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            rcopy("$source/$entry", "$dest/$entry", $permissions);
        }
        
        $dir->close();
        return true;
    }

    /* Membuat konten/tulisan ke dalam 1 baris */
    function toOneLine($input) {
    	$breaks = array("\r\n", "\r");
		$input = str_replace($breaks, "\n", $input);
		$lines = explode("\n", $input);
		$new_lines = array();

		foreach ($lines as $i => $line) {
			if(!empty($line)) {
				$fix_lines = trim($line);
				$fix_lines = trim(preg_replace('/\t+/', '', $fix_lines));
				
				$new_lines[] = $fix_lines;
			}
		}
		return implode($new_lines);
    }

    /* Membuat konten menjadi bebas dari error JSON/XML dan dapat ditampilkan ke HTML melalui JS */
    function safeGetToJsonXmlHtml($input) {
    	$input = nl2br($input);
    	$input = toOneLine(addslashesCustom($input));

    	return $input;
    }

    /* Membuat konten menjadi bebas dari error PHP/DB */
    function safePostToPhpDb($input) {
    	$input = toOneLine(addslashes($input));
    	$input = br2nl($input);

    	return $input;
    }
	 
?>