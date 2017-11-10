<?php

    if($__PART_CORE__ == 1) {
        
        if($thisCoreGet == "doctype") {
            ?>
            <!DOCTYPE html><HTML <?php echo $__HTML_SETTING__["HTML_HEADER_TAG"];?>>
            <?php
            echo $__HTML_CUSTOM__["H-HTML"];
        }

        if($thisCoreGet == "headstart") {
            ?>
            <HEAD>
            <?php 
            echo $__HTML_CUSTOM__["H-HEAD"];
            ?>
            <meta charset="<?php echo $__HTML_SETTING__["HTML_META_CHARSET"];?>" />
            <meta http-equiv="Content-Type" content="<?php echo $__HTML_SETTING__["HTML_META_CONTENT_TYPE"];?>" />
            <meta name="viewport" content="<?php echo $__HTML_SETTING__["HTML_META_VIEWPORT"];?>" />
            <?php 
                $countMetaCustom = count($__HTML_SETTING__["HTML_META_CUSTOM"]);
                for($metaCustom = 0; $metaCustom < $countMetaCustom; $metaCustom++) {
                    echo "<meta ".$__HTML_SETTING__["HTML_META_CUSTOM"][$metaCustom]." />";
                }
            ?>
			<!--cache0.1.1-->
			<!--[if lt IE 9]>
                <script src="<?php echo $__BASE_URL__;?>/assets/script/js/lib/html5shiv.js"></script>
				<script src="<?php echo $__BASE_URL__;?>/assets/script/js/lib/html5shiv-printshiv.js"></script>
			<![endif]-->
            <?php
            echo $__HTML_CUSTOM__["M-HEAD"];
        }

        if($thisCoreGet == "scripttop") {
            ?><link rel="stylesheet" type="text/css" href="<?php echo $__BASE_URL__;?>/s-dcss/font"/><?php

            $base_url_css 	= $__BASE_URL__."/assets/script/css/";
            $base_url_js 	= $__BASE_URL__."/assets/script/js/";
            $base_url_jsd 	= $__BASE_URL__."/assets/script/jsd/";

            $base_css       = [
                "sintask.css",
            ];
            $base_js_lib    = [
                "lib/jquery.min.js",
                "lib/cryptojs-aes.js",
            ];

            /* Default */
            foreach($base_css as $value) {
                ?><link rel="stylesheet" type="text/css" href="<?php echo $base_url_css.$value;?>"/><?php
            }
            foreach($base_js_lib as $value) {
                ?><script type="text/javascript" src="<?php echo $base_url_js.$value;?>"></script><?php
            }
            
            /* AUTO CSS */
            $base_url_auto_css  = $__BASE_URL__."/myassets/auto_css_head/";
            $auto_css           = scandir($__DOC_ROOT__.$requirePath["auto_css"]);
            $count_auto_css     = count($auto_css);

            for($autoCssI = 2; $autoCssI < $count_auto_css; $autoCssI++) {
                $value = $base_url_auto_css.$auto_css[$autoCssI];                   
                ?><link rel="stylesheet" type="text/css" href="<?php echo $value;?>"/><?php
            }

            /* CUSTOM JS & CSS */
            if(count($__MY_CSS_HEAD__) > 0) {
                foreach($__MY_CSS_HEAD__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {  
                        $value = $__BASE_URL__."/".$value;                   
                        ?><link rel="stylesheet" type="text/css" href="<?php echo $value;?>"/><?php
                    }
                }
            }
            if(count($__MY_JS_HEAD__) > 0) {
                foreach($__MY_JS_HEAD__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        $value = $__BASE_URL__."/".$value;
                        ?><script s-again type="text/javascript" src="<?php echo $value;?>"></script><?php
                    }
                }
            }

            /* CUSTOM EXTERNAL URL LINK JS & CSS */
            if(count($__MY_EXT_CSS_HEAD__) > 0) {
                foreach($__MY_EXT_CSS_HEAD__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {                       
                        ?><link rel="stylesheet" type="text/css" href="<?php echo $value;?>"></link><?php
                    }
                }
            }
            if(count($__MY_EXT_JS_HEAD__) > 0) {
                foreach($__MY_EXT_JS_HEAD__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        ?><script s-again type="text/javascript" src="<?php echo $value;?>"></script><?php
                    }
                }
            }
            /* END CUSTOM JS & CSS */
        }

        if($thisCoreGet == "headend") {
            if($__IMAGE_FAV__ != null && $__IMAGE_FAV__ != "" && !ctype_space($__IMAGE_FAV__)) {
                ?>
                <link rel="Shortcut Icon" type="image/png" href="<?php echo $__IMAGE_FAV__;?>" />
                </HEAD>
                <?php
            } else {
                $imagefavicon = $__BASE_URL__."/images/logo/fav_sintask.png";
                ?>
                <link rel="Shortcut Icon" type="image/png" href="<?php echo $imagefavicon;?>" />
                </HEAD>
                <?php
            }
        }

        if($thisCoreGet == "bodystart") {
            ?>
            <BODY>
            <?php
            echo $__HTML_CUSTOM__["H-BODY"];
        }

        if($thisCoreGet == "content") {
            ?>
            <script>
                var homeUrl 	    = "<?php echo $__BASE_URL__;?>";
                var thisUrl 	    = "<?php echo pureUrlPage($__BASE_URL__);?>";
                var tokenizing 	    = "<?php echo $__TOKENIZING__;?>";
                var tokenizingUser 	= tokenizing;
                var pageCache       = [];
                var utoken          = "<?php echo $__UTOKEN__;?>";

                var runH            = 0;
                var runP            = 0;

                /*BELOW CODE IS DEPRECATED*/
                var JSGET           = [];
				var JSPOST 			= [];
                <?php
                    /*
                    DISABLED
                    foreach($_GET as $key => $value) {
                        ?>
						JSGET.push("<?php echo $key;?>|<?php echo $value;?>");
						JSPOST.<?php echo $key;?> = "<?php echo $value;?>";
						<?php
                    }
                    */
                ?>

                var JSGETJSON       = JSON.stringify(JSGET);
                JSGETJSON           = ""; /* DISABLED */
                /*ABOVE CODE IS DEPRECATED*/

                var locVal          = [];

                locVal.url          = [];
                locVal.url.home     = "<?php echo $__BASE_URL__;?>";
                locVal.url.thisis   = "<?php echo pureUrlPage($__BASE_URL__);?>";
                
                locVal.sitenowww    = "<?php echo SITENOWWW;?>";
                
                var thisUrl;

                var urlNow = document.URL;
                locVal.url.now = urlNow;

                function urlRealTime() {
                    setTimeout(function(){
                        if(locVal.url.now != document.URL) {
                            urlNow = document.URL;
                            locVal.url.now = urlNow;
                        }
                        urlRealTime();
                    },500);
                }
                urlRealTime();
            </script>

            <?php
            /*
             * OUTPUT BLOCKER
             */


            /** [ MAINTENANCE & DB CONFIG ]
             *  Halaman berbasiskan Non-SPA
             */
            if(MAINTENANCE == true) {
                ?>
                <script>
                    document.title = "Maintenance";
                </script>
                <?php 
                require($__DOC_ROOT__.$requirePath['error']."/maintenance.php");
                ?>
                </BODY></HTML>
                <?php
                die();
            }

            /** [ MAINTENANCE & DB CONFIG ]
             *  Halaman berbasiskan Non-SPA
             */
            if($__CONNECT_STATUS__ == false) {
                ?>
                <script>
                    document.title = "DB Conn Failed";
                </script>
                <?php 
                echo "DB Connection Failed - Check your DB settings.";
                ?>
                </BODY></HTML>
                <?php
                die();
            }

            /** [ JS-DISABLED CONDITION ]
             *  Halaman berbasiskan Non-SPA
             */
            /* NOSCRIPT CHECKER */
            if($__SEGMEN__[2]!="jsdisabled") {
                ?>
                <noscript>
                    <meta http-equiv="Refresh" content="0; URL=<?php echo SITEADDR;?>/jsdisabled">
                </noscript>
                <?php
            }
            if($__SEGMEN__[2]=="jsdisabled") {
                ?>
                <script>
					/*If run - JS not Disabled*/
                    location.assign("<?php echo SITEADDR;?>");

                    document.title = "JavaScript Disabled";
                </script>
                <?php 
                require($__DOC_ROOT__.$requirePath['error']."/javascript_disabled.php");
                ?>
                </BODY></HTML>
                <?php
                die();
            }
			
			/** [ COOKIE-DISABLED CONDITION ]
             *  Halaman berbasiskan Non-SPA
             */
            /* COOKIE CHECKER */
            if($__SEGMEN__[2]!="kk") {
                ?>
                <script>
					function manCheckCookie() {
						document.cookie = "checkerCookie=1";
						var retrn = document.cookie.indexOf("checkerCookie=") != -1;
						document.cookie = "checkerCookie=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";
						return retrn;
					}
					
					if(navigator.cookieEnabled == false || manCheckCookie() == false) {
						location.assign("<?php echo SITEADDR;?>/kk");
					}
                </script>
                <?php
            }
            if($__SEGMEN__[2]=="kk") {
                ?>
                <script>
					function manCheckCookie() {
						document.cookie = "checkerCookie=1";
						var retrn = document.cookie.indexOf("checkerCookie=") != -1;
						document.cookie = "checkerCookie=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";
						return retrn;
					}
					
					if(navigator.cookieEnabled == true || manCheckCookie() == true) {
						location.assign("<?php echo SITEADDR;?>");
					}
					
					document.title = "Cookies Disabled";
                </script>
                <?php 
                require($__DOC_ROOT__.$requirePath['error']."/cookies_disabled.php");
                ?>
                </BODY></HTML>
                <?php
                die();
            }
			
			/** [ HTML5-NOT-SUPPORT CONDITION ]
             *  Halaman berbasiskan Non-SPA
             */
            /* HTML5 CHECKER */
            if($__SEGMEN__[2]!="html5") {
                ?>
                <script>
					var h5s 		= [];
	
					h5s.fileApi 	= typeof FileReader != 'undefined';
					h5s.video 		= !!document.createElement('video').canPlayType;
					h5s.canvas 		= !!document.createElement('canvas').getContext;
					h5s.audio 		= !!document.createElement('audio').canPlayType;
					h5s.historyApi 	= !!(window.history && window.history.pushState);
					h5s.formData 	= !!window.FormData;
				
                    if(
						h5s.fileApi 	== false 	|| 
						h5s.video 		== false 	|| 
						h5s.canvas 		== false 	|| 
						h5s.audio 		== false	||
						h5s.historyApi 	== false 	||
						h5s.formData 	== false
						) {
							location.assign("<?php echo $__BASE_URL__;?>/html5");
					}
                </script>
                <?php
            }
            if($__SEGMEN__[2]=="html5") {
                ?>
                <script>
					var h5s 		= [];
	
					h5s.fileApi 	= typeof FileReader != 'undefined';
					h5s.video 		= !!document.createElement('video').canPlayType;
					h5s.canvas 		= !!document.createElement('canvas').getContext;
					h5s.audio 		= !!document.createElement('audio').canPlayType;
					h5s.historyApi 	= !!(window.history && window.history.pushState);
					h5s.formData 	= !!window.FormData;
                </script>
                <?php 
                require($__DOC_ROOT__.$requirePath['error']."/html5_not_supported.php");
                ?>
                </BODY></HTML>
                <?php
                die();
            }

            /* END OUTPUT BLOCKER */
			
            ?>

            <div id="headerStayContentSinTask" style="display: none;">

            </div>

            <div id="freeContentSinTask" style="display: none;">
                <?php
                    /* SEO Support */
                    if($__XHR_STATUS__ == false) {
                        if(fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['template'], $thisReqPathLoginPrefix, $thisReqPath, 2, ".jssintasktemplate") != $__ZERO__) {
                            /* Konten dapat terbaca tanpa Javascript */
                            $pathRender = fileDynamic($__SEGMEN__, $__FILE_EXTENSION__, $__ZERO__, $requirePath['template'], $thisReqPathLoginPrefix, $thisReqPath, 2, ".jssintasktemplate");
                            /* HTML Rendering */
                            ob_start();
                            include($pathRender);
                            $varRender = ob_get_contents(); 
                            ob_end_clean();

                            echo $varRender;
                        }
                    }
                ?>
                <script>
                    /* Menghapus dari Pengguna tetapi tidak pada SOURCE VIEW */
                    sjqNoConflict("#freeContentSinTask").html("");
                    sjqNoConflict("#freeContentSinTask").show();
                </script>
            </div>

            <div id="stayContentSinTask" style="display: none;">
                
            </div>

            <div id="footerStayContentSinTask" style="display: none;">

            </div>

            <div class="clearBoth"></div>
            
            <div id="popUpSinTask" style="display: none;">

            </div>
            <div id="popUpSinTaskTwo" style="display: none;">

            </div>
            <div id="popUpSinTaskThree" style="display: none;">

            </div>
            <div id="fadeContentOne" style="display: none;">

            </div>
            <div id="fadeContentTwo" style="display: none;">

            </div>
			<div id="loadingPageSinTaskSPA" style="display: block;">
				<?php echo loadingHtmlTemplate();?>
			</div>
            <!-- SCRIPT ADD -->
            <script id="addScript">

            </script>
            <style id="addStyle">

            </style>
            <div id="addArea">
            
            </div>
            <?php
        }

        if($thisCoreGet == "scriptend") {
            $base_url_css 	= $__BASE_URL__."/assets/script/css/";
            $base_url_js 	= $__BASE_URL__."/assets/script/js/";
            $base_url_jsd 	= $__BASE_URL__."/jsd/";

            $footer_js      = [
                "sintask.func.js",
                "sintask.plugin.js",
                "sintask.zcore.js",
            ];

            /* Default */
            foreach($footer_js as $value) {
                ?><script type="text/javascript" src="<?php echo $base_url_js.$value;?>"></script><?php
            }

            /* AUTO JS */
            $base_url_auto_js   = $__BASE_URL__."/myassets/auto_js_foot/";
            $auto_js            = scandir($__DOC_ROOT__.$requirePath["auto_js"]);
            $count_auto_js      = count($auto_js);

            for($autoJsI = 2; $autoJsI < $count_auto_js; $autoJsI++) {
                $value = $base_url_auto_js.$auto_js[$autoJsI];                   
                ?><script s-again type="text/javascript" src="<?php echo $value;?>"></script><?php
            }

            /* CUSTOM JS & CSS */
            if(count($__MY_CSS_FOOT__) > 0) {
                foreach($__MY_CSS_FOOT__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        $value = $__BASE_URL__."/".$value;
                        ?><link rel="stylesheet" type="text/css" href="<?php echo $value;?>"/><?php
                    }
                }
            }
            if(count($__MY_JS_FOOT__) > 0) {
                foreach($__MY_JS_FOOT__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        $value = $__BASE_URL__."/".$value;
                        ?><script s-again type="text/javascript" src="<?php echo $value;?>"></script><?php
                    }
                }
            }
            /* CUSTOM EXT URL LINK JS & CSS */
            if(count($__MY_EXT_CSS_FOOT__) > 0) {
                foreach($__MY_EXT_CSS_FOOT__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        ?><link rel="stylesheet" type="text/css" href="<?php echo $value;?>"/><?php
                    }
                }
            }
            if(count($__MY_EXT_JS_FOOT__) > 0) {
                foreach($__MY_EXT_JS_FOOT__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        ?><script s-again type="text/javascript" src="<?php echo $value;?>"></script><?php
                    }
                }
            }
            /* END CUSTOM JS & CSS */

            ?>
            <script>
                sjqNoConflict(document).ready(function(){
                    sCached(); 
                });
            </script>
            <?php
        }

        if($thisCoreGet == "scriptend_general") {
            $base_url_css   = $__BASE_URL__."/assets/script/css/";
            $base_url_js    = $__BASE_URL__."/assets/script/js/";
            $base_url_jsd   = $__BASE_URL__."/jsd/";

            /* AUTO JS */
            $base_url_auto_js   = $__BASE_URL__."/myassets/auto_js_foot/";
            $auto_js            = scandir($__DOC_ROOT__.$requirePath["auto_js"]);
            $count_auto_js      = count($auto_js);

            for($autoJsI = 2; $autoJsI < $count_auto_js; $autoJsI++) {
                $value = $base_url_auto_js.$auto_js[$autoJsI];                   
                ?><script type="text/javascript" src="<?php echo $value;?>"></script><?php
            }

            /* CUSTOM JS & CSS */
            if(count($__MY_CSS_FOOT__) > 0) {
                foreach($__MY_CSS_FOOT__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        $value = $__BASE_URL__."/".$value;
                        ?><link rel="stylesheet" type="text/css" href="<?php echo $value;?>"/><?php
                    }
                }
            }
            if(count($__MY_JS_FOOT__) > 0) {
                foreach($__MY_JS_FOOT__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        $value = $__BASE_URL__."/".$value;
                        ?><script type="text/javascript" src="<?php echo $value;?>"></script><?php
                    }
                }
            }
            /* CUSTOM EXT URL LINK JS & CSS */
            if(count($__MY_EXT_CSS_FOOT__) > 0) {
                foreach($__MY_EXT_CSS_FOOT__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        ?><link rel="stylesheet" type="text/css" href="<?php echo $value;?>"/><?php
                    }
                }
            }
            if(count($__MY_EXT_JS_FOOT__) > 0) {
                foreach($__MY_EXT_JS_FOOT__ as $value) {
                    if($value != null && $value != "" && !ctype_space($value)) {
                        ?><script type="text/javascript" src="<?php echo $value;?>"></script><?php
                    }
                }
            }
            /* END CUSTOM JS & CSS */
        }

        if($thisCoreGet == "bodyend") {
            echo $__HTML_CUSTOM__["F-BODY"];
            ?>
            </BODY>
            <?php
        }

        if($thisCoreGet == "foothtml") {
            echo $__HTML_CUSTOM__["F-HTML"];
            ?>
            </HTML>
            <?php
        }
    }
    
?>