<?php
	
	/*
	 *	SinTask HQ untuk _POST, _GET, _FILES
	 */
	class SinTaskHQ {
		public function __construct() {
			
		}
		function get($key = null) {
			if($key == null) {
				return $_SESSION[$_SESSION['globalSecureToken']."postGET"];
			} else {
				$result = null;

				if(isset($_GET[$key])) {
					$result = $_GET[$key];
				} else {
					$result = $_SESSION[$_SESSION['globalSecureToken']."postGET"][$key];
				}

				return $result;
			}
		}
		function post($key = null) {
			if($key == null) {
				return $_SESSION[$_SESSION['globalSecureToken']."postPOST"];
			} else {
				$result = null;

				if(isset($_GET[$key])) {
					$result = $_GET[$key];
				} else {
					$result = $_SESSION[$_SESSION['globalSecureToken']."postPOST"][$key];
				}

				return $result;
			}
		}
		function files($key = null) {
			if($key == null) {
				return $_SESSION[$_SESSION['globalSecureToken']."postFILES"];
			} else {
				$result = null;

				if(isset($_GET[$key])) {
					$result = $_GET[$key];
				} else {
					$result = $_SESSION[$_SESSION['globalSecureToken']."postFILES"][$key];
				}

				return $result;
			}
		}
	}
	/* $sintaskFW */
	$sintaskFW = new SinTaskHQ;

	/*
	 *	SinTask META untuk SPA or N-SPA Page
	 */
	class MetaSPA {
		private $fileName	= "";
		private $title 		= "";
	    private $siteName	= "";
	    private $keywords 	= "";
	    private $description= "";
	    private $image 		= "";

	    public $docroot 		= "";
	    public $spatemplateloc 	= "";
	    public $generaltemplate = "";
	    private $metaReturn 	= "";

	    private $fileNameArr;

	    public function __construct() {
	        global $GLOBALS;
	        $this->fileNameArr 	= &$GLOBALS['metasaver'];
	    }

	    function thisDocRoot($docroot) {
	    	$this->docroot 		= $docroot;
	    }

	    function newFileName($fileName) {
	    	$this->fileName 	= $this->docroot.$this->spatemplateloc."/".$fileName;
	    }
	    function newFileNameGeneral($fileName) {
	    	$this->fileName 	= $this->docroot.$this->generaltemplate."/".$fileName;
	    }
	    function newFileNameCustom($fileName) {
	    	$this->fileName 	= $this->docroot.$fileName;
	    }
	    function newTitle($title) {
	    	$this->title 		= $title;
	    }
	    function newSiteName($siteName) {
	    	$this->siteName 	= $siteName;
	    }
	    function newKeywords($keywords) {
	    	$this->keywords 	= $keywords;
	    }
	    function newDescription($description) {
	    	$this->description 	= $description;
	    }
	    function newImage($image) {
	    	$this->image 		= $image;
	    }
	    function addNew() {
	    	$this->fileNameArr[$this->fileName]['title'] 		= $this->title;
	    	$this->fileNameArr[$this->fileName]['siteName'] 	= $this->siteName;
	    	$this->fileNameArr[$this->fileName]['keywords'] 	= $this->keywords;
	    	$this->fileNameArr[$this->fileName]['description'] 	= $this->description;
	    	$this->fileNameArr[$this->fileName]['image'] 		= $this->image;
	    	$GLOBALS['metasaver'] = $this->fileNameArr;
	    }

	    function getTitleMeta($fileName) {
	    	return addslashesCustom($this->fileNameArr[$fileName]['title']);
	    }

	    function readingMeta($fileName) {
	    	$this->metaReturn .= '<meta property="og:title" name="site_name" content="'.addslashesMeta($this->fileNameArr[$fileName]['title']).'">
    			<meta property="og:site_name" name="site_name" content="'.addslashesMeta($this->fileNameArr[$fileName]['siteName']).'">
    			<meta property="og:keywords" name="keywords" content="'.addslashesMeta($this->fileNameArr[$fileName]['keywords']).'" />
    			<meta property="og:description" name="description" content="'.addslashesMeta($this->fileNameArr[$fileName]['description']).'"/>
    			<meta property="og:image" name="image" content="'.addslashesMeta($this->fileNameArr[$fileName]['image']).'"/>
    			<title>'.addslashesMeta($this->fileNameArr[$fileName]['title']).'</title>';
	    	return $this->metaReturn;
	    }
	}
	/* $sintaskNewMeta - Meta Tag */
	$GLOBALS['metasaver'] = [];
	$sintaskNewMeta = new MetaSPA;
	$sintaskNewMeta->thisDocRoot($__DOC_ROOT__);
	$sintaskNewMeta->spatemplateloc = $requirePath['template'];
	$sintaskNewMeta->generaltemplate = $requirePath['general'];

	/*
	 * 	SinTask Session
	 */
	class SessionSinTask {
		private $countSession 	= 0;

		function set($key, $value) {
			$_SESSION[$key] = $value;
			return true;
		}
		function purge($key) {
			$_SESSION[$key] = "";
			unset($_SESSION[$key]);
			return true;
		}
		function purgeAll() {
			$_SESSION = "";
			return true;
		}
		function get($key) {
			if (!isset($_SESSION[$key])) {
				$_SESSION[$key] = "";
			}
			return $_SESSION[$key];
		}
		function status($key) {
			return (isset($_SESSION[$key]) == true ? true : false);
		}
		function statusPrint($key) {
			return (isset($_SESSION[$key]) == true ? 'true' : 'false');
		}
		function readThis($key) {
			return print_r($_SESSION[$key]);
		}
		function readAll() {
			return print_r($_SESSION);
		}
	}
	/* $sintaskSess */
	$sintaskSess = new SessionSinTask;

	/*
	 *	SinTask Cookie
	 */
	class CookieSinTask {
		function set($cookieName, $cookieValue = null, $cookieTime = null, $cookiePath = null, $cookieDomain = null, $opt1 = null, $opt2 = null) {

			$cookieTimeExplode 	= preg_split("/[\s]+/", strtolower($cookieTime));
			$thisCookieTime		= (int)$cookieTimeExplode[0];
			$currentTime		= time();
			$cookieLength		= count($cookieTimeExplode);

			if($cookieTimeExplode[1] == "h" && $cookieLength == 2) {
				$currentTime = time() + (3600 * $thisCookieTime);
			} else if($cookieTimeExplode[1] == "d" && $cookieLength == 2) {
				$thisCookieTime = $thisCookieTime * 24;
				$currentTime = time() + (3600 * $thisCookieTime);
			} else if($cookieTimeExplode[1] == "w" && $cookieLength == 2) {
				$thisCookieTime = $thisCookieTime * (24 * 7);
				$currentTime = time() + (3600 * $thisCookieTime);
			} else {
				$currentTime = $currentTime + $cookieTime;
			}

			setcookie($cookieName, $cookieValue, $currentTime, $cookiePath, $cookieDomain, $opt1, $opt2);
			return true;
		}

		function get($cookieName) {
			return $_COOKIE[$cookieName];
		}

		function purge($cookieName, $cookiePath = null, $cookieDomain = null) {
			setcookie($cookieName, "", time() - ((3600 * 24) * 365) * 10, $cookiePath, $cookieDomain);
			return true;
		}
	}
	/* $sintaskKuki */
	$sintaskKuki = new CookieSinTask;

	/*
	 *	SinTask No Route
	 *	-----------------
	 * 	Digunakan untuk memanggil file pada direktori no_route
	 */
	class NoRoute {
		private $thisPath = "";

		public function __construct($path) {
			$this->thisPath = $path;
		}
		function loadRoute($fileId) {
			ob_start();
		    include($this->thisPath."/".$fileId.".php");
		    $varRender = ob_get_contents(); 
		    ob_end_clean();
			return $varRender;
		}
	}
	/* $sintaskNoRoute */
	$sintaskNoRoute = new NoRoute($__DOC_ROOT__.$requirePath['no_route']);

	/* 
	 *	SinTask Video / audio Stream
 	 *	------------------------------------
	 *	MediaStream class digunakan untuk mendukung stream video player & audio player, 
	 */
	class MediaStream {
	    private $path 	= "";
	    private $mime 	= "";
	    private $stream = "";
	    private $buffer = 102400;
	    private $start  = -1;
	    private $end    = -1;
	    private $size   = 0;
	    function __construct($filePath = null, $fileMime = null) {
	        $this->path = $filePath;
	        $this->mime = $fileMime;
	    }
	    function insert($filePath, $fileMime) {
	    	$this->path = $filePath;
	    	$this->mime = $fileMime;
	    }
	    /* Membuka Stream */
	    private function open() {
	        if (!($this->stream = fopen($this->path, 'rb'))) {
	            die('Tidak dapat membuka stream video');
	        }
	    }
	    /* Set header untuk menampilkan media stream */
	    private function setHeader() {
	        ob_get_clean();
	        header("Content-Type: ".$this->mime);
	        header("Cache-Control: max-age=2592000, public");
	        header("Expires: ".gmdate('D, d M Y H:i:s', time()+2592000) . ' GMT');
	        header("Last-Modified: ".gmdate('D, d M Y H:i:s', @filemtime($this->path)) . ' GMT' );
	        $this->start = 0;
	        $this->size  = filesize($this->path);
	        $this->end   = $this->size - 1;
	        header("Accept-Ranges: 0-".$this->end);
	         
	        if (isset($_SERVER['HTTP_RANGE'])) {
	  
	            $c_start = $this->start;
	            $c_end = $this->end;
	 
	            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
	            if (strpos($range, ',') !== false) {
	                header('HTTP/1.1 416 Requested Range Not Satisfiable');
	                header("Content-Range: bytes $this->start-$this->end/$this->size");
	                exit;
	            }
	            if ($range == '-') {
	                $c_start = $this->size - substr($range, 1);
	            }else{
	                $range = explode('-', $range);
	                $c_start = $range[0];
	                 
	                $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $c_end;
	            }
	            $c_end = ($c_end > $this->end) ? $this->end : $c_end;
	            if ($c_start > $c_end || $c_start > $this->size - 1 || $c_end >= $this->size) {
	                header('HTTP/1.1 416 Requested Range Not Satisfiable');
	                header("Content-Range: bytes $this->start-$this->end/$this->size");
	                exit;
	            }
	            $this->start = $c_start;
	            $this->end = $c_end;
	            $length = $this->end - $this->start + 1;
	            fseek($this->stream, $this->start);
	            header('HTTP/1.1 206 Partial Content');
	            header("Content-Length: ".$length);
	            header("Content-Range: bytes $this->start-$this->end/".$this->size);
	        }
	        else
	        {
	            header("Content-Length: ".$this->size);
	        }
	    }
	    /* Close jika ada media stream yg terbuka, END */
	    private function end() {
	        fclose($this->stream);
	        exit;
	    }
	    /* Tampilkan streaming berdasarkan buffer, sehingga tidak meload semua */
	    private function stream() {
	        $i = $this->start;
	        set_time_limit(0);
	        while(!feof($this->stream) && $i <= $this->end) {
	            $bytesToRead = $this->buffer;
	            if(($i+$bytesToRead) > $this->end) {
	                $bytesToRead = $this->end - $i + 1;
	            }
	            $data = fread($this->stream, $bytesToRead);
	            echo $data;
	            flush();
	            $i += $bytesToRead;
	        }
	    } 
	    /* Mulai streaming media */
	    function start() {
	        $this->open();
	        $this->setHeader();
	        $this->stream();
	        $this->end();
	    }
	}
	/* $sintaskMedia - Audio/Video */
	$sintaskMedia = new MediaStream;

	/*
	 *	SinTask NotFound JS Page
	 * 	(For SPA page only)
	 */
	class SintaskNotFound {
		public function __construct() {
			$thisJSVar = '
			<script>
				sjqNoConflict(document).ready(function(){
					if(typeof __SFW_spa == "object") {
						__SFW_spa.goToNotFound();
					} else {
						alert("Page Not Found\n(Non-SPA Page Alert)");
					}
				});
			</script>';

			$vars = $this->toSingleLine($thisJSVar);
			$vars = $this->tagSlash($vars);
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

			echo $final;

			die();
		}
		/* Membuat baris kode menjadi single line */
		private function toSingleLine($output) {
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
		private function tagSlash($output) {
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
	}

?>