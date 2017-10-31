<?php
	
	/*
	 *	SinTask HQ untuk _POST, _GET, _FILES
	 */
	class SinTaskHQ {
		public function __construct() {
			
		}
		function get($key) {
			return $_SESSION["postGET"][$key];
		}
		function post($key) {
			return $_SESSION["postPOST"][$key];
		}
		function files($key) {
			return $_SESSION["postFILES"][$key];
		}
	}
	/* $sintaskFW */
	$sintaskFW = new SinTaskHQ;

	/*
	 *	SinTask META untuk SPA or N-SPA Page
	 */
	class MetaSPA extends SinTaskHQ {
		private $fileName	= "";
		private $title 		= "";
	    private $siteName	= "";
	    private $keywords 	= "";
	    private $description= "";
	    private $image 		= "";

	    public $docroot 		= "";
	    public $spatemplateloc 	= "";
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
	    	return $this->fileNameArr[$fileName]['title'];
	    }

	    function readingMeta($fileName) {
	    	$this->metaReturn .= '<meta property="og:title" name="site_name" content="'.$this->fileNameArr[$fileName]['title'].'">
    			<meta property="og:site_name" name="site_name" content="'.$this->fileNameArr[$fileName]['siteName'].'">
    			<meta property="og:keywords" name="keywords" content="'.$this->fileNameArr[$fileName]['keywords'].'" />
    			<meta property="og:description" name="description" content="'.$this->fileNameArr[$fileName]['description'].'"/>
    			<meta property="og:image" name="image" content="'.$this->fileNameArr[$fileName]['image'].'"/>
    			<title>'.$this->fileNameArr[$fileName]['title'].'</title>';
	    	return $this->metaReturn;
	    }
	}
	/* $sintaskNewMeta - Meta Tag */
	$GLOBALS['metasaver'] = [];
	$sintaskNewMeta = new MetaSPA;
	$sintaskNewMeta->thisDocRoot($__DOC_ROOT__);
	$sintaskNewMeta->spatemplateloc = $requirePath['template'];

	/*
	 * 	SinTask Session
	 */
	class SessionSinTask extends SinTaskHQ {
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
	class CookieSinTask extends SinTaskHQ {
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
	class NoRoute extends SinTaskHQ {
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

?>