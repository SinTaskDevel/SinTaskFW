/**
 * SinTask ZCore JS -> Replace the Old Core 
 * All Single Page Control is in this file
 * Several XHR interaction & realtime in this file
 * ----------------------------------------
 * SinTask, Inc (c) 2017
 */

var __SFWspa = function() {
    var __SFW_globalScrollPage = [];
    var __SFW_250ErrorDesc = '[<b>Kode Error 250<\/b>]<br>Ada kesalahan dengan __SFW_tokenizing karena tidak dapat diverifikasi oleh sisi Server, silahkan re-load halaman ini, jika terus berlanjut Selengkapnya buka <a class="ft_style_u" href="https:\/\/fw.sintask.com\/docs\/error">Dokumentasi Error SinTaskFW<\/a>';
    var __SFW_251ErrorDesc = '[<b>Kode Error 251<\/b>]<br>Ada beberapa kesalahan yang mungkin terjadi : <br><br>1. Saat mengambil data dari Server, kemungkinan SPA tidak dapat membaca JSON karena Error, periksa lagi setiap baris kode anda. <br><br>2. Terjadi perpindahan halaman dari halaman berbasis SPA ke halaman normal (Not-SPA), silahkan periksa perpindahan halaman anda.';

    sjqNoConflict(window).on('load', function() {
        sintaskLoaderIframeStop();
    });
    /**
     * __SFW_expectHiddenObject variable = contain expect hidden element.
     * this variable use in function instructBodyObjectSinTask below
     */
    var __SFW_expectHiddenObject = ['#headerSinTask','#contentParSinTask','#popUpSinTask','#popUpSinTaskTwo','#popUpSinTaskThree','#sideSinTask','.sintaskTooltipInput'];
    /**
     * sintaskLoaderIframeAgain = Iframe load or browser tab loading re-start.
     */
    function sintaskLoaderIframeAgain() {
        sintaskLoaderIframe();
    }
    /**
     * universalHideContent = Universal hidden element content :
     * - sintaskTooltipInput (class)
     */
    function universalHideContent() {
        sjqNoConflict(".sintaskTooltipInput").hide();
    }
    /**
     * sintaskLoaderIframe = Iframe loader initial
     */
    function sintaskLoaderIframe() {
    	return true;
    }
    /**
     * sintaskLoaderIframeStop = Stop the iframe loader or browser tab loading
     */
    function sintaskLoaderIframeStop() {
        setTimeout(function(){
    		checkCss = sjqNoConflict("style.styleAdd").html();
    		if(typeof checkCss != 'undefined' && checkCss != "" && __SFW_f.ctypeSpace(checkCss) != 0) {
    			instructBodyObjectSinTask("show", __SFW_expectHiddenObject);

                /*FIXED_THE_SCROLL*/
                if(typeof __SFW_globalScrollPage[document.URL] === "undefined") {
                    sjqNoConflict(document).scrollTop(0);
                } else {
                    sjqNoConflict(document).scrollTop(__SFW_globalScrollPage[document.URL]);
                }
    		} else {
    			sintaskLoaderIframeStop();
    		}
        },700);
    	/*Reset Scroll*/
    	sjqNoConflict("body" || "html").scrollTop(0);
    	/*!!IFRAME LOADER IS CLOSED*/
    	return true;
    }
    /**
     * instSinTask = Instruction from JSON response from Server
     */
    function instSinTask(input) {
        if(input != "null" && typeof input != 'undefined') {
            var input_ = input.split("_[inst]_");
            var input_length = input_.length;
            var it = 0;
            while(it<input_length) {
                var input__ = input_[it];
                var input___ = input__.split("|");
                if(input___[0]=="hide") {
                    sjqNoConflict(input___[1]).hide(input___[2]);
                } else if(input___[0]=="show") {
                    sjqNoConflict(input___[1]).show(input___[2]);
                } else if(input___[0]=="removeClass") {
                    sjqNoConflict(input___[2]).removeClass(input___[1]);
                } else if(input___[0]=="addClass") {
                    sjqNoConflict(input___[2]).addClass(input___[1]);
                } else {
                    /*NOTHING_FORNOW!*/
                }
                it = it+1;
            }
        }
        return true;
    }
    /**
     * loadAddScript = Load additional <script> (JS) with response from Server
     */
    function loadAddScript(link) {
        var link_ = link;
        sjqNoConflict.ajax({
            type: "POST",
            data: { tokenizing: __SFW_tokenizingUser },
            cache: true,
            dataType: "script",
            url: link_,
            success: function (data) {
                /*NOTHING*/
            },
            error: function(xhr, textStatus, errorThrown) {
                /*NOTHING*/
            }
        });
        return true;
    }
    /**
     * loadAddStyle = Load additional <style> (CSS) with response from Server
     */
    function loadAddStyle(link, id) {
        if(link!="null") {
            var idfinal = "style-"+id;
            if(sjqNoConflict("."+idfinal).length>0) {
                sjqNoConflict.ajax({
                    type: "POST",
                    data: { tokenizing: __SFW_tokenizingUser },
                    cache: true,
                    dataType: "html",
                    url: link,
                    success: function (data) {
                        var feedcssback = "/*BEGIN*/"+data;
                        sjqNoConflict("."+idfinal).html(feedcssback);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        
                    }
                });
            } else {
                sjqNoConflict("body").append("<style class='"+idfinal+" styleAdd iDisplayNone'></style>");
                setTimeout(function(){loadAddStyle(link, id);},500);
            }
        }
        return true;
    }
    /**
     * __SFW_runH variable is Run Stay SPA Loader, 1 = True, else = False
     */
    if(__SFW_runH!=1) {
        var turnArray = ["stayheader", "staycontent", "stayfooter"];
        for(var turnIt = 0; turnIt < turnArray.length; turnIt++) {
            var nowTurn = turnArray[turnIt];
            if(nowTurn != null && nowTurn != "" && typeof nowTurn != 'undefined') {
                var thisNowTurn = __SFW_homeUrl+"/."+nowTurn;
                loadAddScript(thisNowTurn);
            }
        }
    }

    /*_SINGLE_PAGE_APPLICATION_BIGLINE_*/
    /**
     * sintaskSPA = replace if href="[BASE URL]/path/path" to be /path/path
     */
    function sintaskSPA(input) {
        var vars = input.replace(__SFW_homeUrl, "");

        var replacer = [
            "http://",
            "https://",
            "ftp://",
            "ftps://",
            ":",
        ];

        for(var a = 0; a < replacer.length; a++) {
        	vars = vars.split(replacer[a]).join("-");	
        }

        var validator = vars.split("");
        if(validator[0] != "/") {
            vars = "/"+vars;
        }

        return vars;
    }
    /*SPA_PART*/
    /**
     * SinTask SPA after success get data from server,
     * divided to 4 execution part :
     * Left, Middle, Right, Last (Area of Content)
     * Area of Content have unique id, get from Server.
     * If there is new unique id from server, so this code must be add new unique id (not flexible).
     * ------
     * loadAddScript function have one parameter to run new javascript function (command from server),
     * and run function with from server parameter.
     */
    function sintaskSuccessGetData(data) {
        /*afterLoadScript = [];*/
        var datafeed    = (data);
        var feedbackSts = datafeed[1].sts;
        var msgSts      = datafeed[2].msg;
        /*SPECIAL_INSTRUCTION*/
        var inst        = datafeed[2].inst;
        instSinTask(inst);
        if(feedbackSts==200) {
            /*INITIAL*/
            var theTitle    = datafeed[0].content[0].contentTitle;
            var addStyle    = datafeed[0].content[1].addStyle;
            var addScript   = datafeed[0].content[2].addScript;
            /*LEN*/
            if(addStyle!="null") {
                var addStyleLen = addStyle.length;
            }
            if(addScript!="null") {
                var addScriptLen = addScript.length;
            }
            /*PURGE_CONTENT*/
            purgeSideSinTask(__SFW_runP);
            purgeScriptAdd();
            /*LOAD_STYLE*/
            var loadAddStyleIt = 0;
            while(loadAddStyleIt<addStyleLen) {
                var styleNow = addStyle[loadAddStyleIt].style;
                loadAddStyle(styleNow, "addParentStyle"+loadAddStyleIt);
                loadAddStyleIt = loadAddStyleIt+1;
            }
            /*LOAD_SCRIPT*/
            var loadAddScriptIt = 0;
            while(loadAddScriptIt<addScriptLen) {
                var scriptNow = addScript[loadAddScriptIt].script;
                loadAddScript(scriptNow);
                loadAddScriptIt = loadAddScriptIt+1;
            }
            /*GET NEW TITLE*/
            document.title = theTitle[0].title;

            /*LOAD_FUNC_SCRIPT_AGAIN*/
            sintaskLoaderIframeStop();
        } else {
            purgeSideSinTask(0);
            purgeScriptAdd();
            instructBodyObjectSinTask("show", __SFW_expectHiddenObject);
            sjqNoConflict("#loadingPageSinTaskSPA").hide();

            __SFW_f.popUpTwo({
                title: "SinTask Framework Error", 
                message: __SFW_250ErrorDesc, 
                okButton: "Ok",
                onOk: function(){
                    __SFW_f.toastTwo("Tokenizing Error", "show", 8000);
                },
                onOuterClick: "hide",
                animationFade: true
            });
        }
    }
    /**
     * resetAllCache = Clean the cache or anything that interupt any new action / movement.
     */
    function resetAllCache() {
        cacheDropdown = [];
        cacheCommentDropdown = [];
    }
    /**
     * purgeSideSinTask = Clean/Purge Area of Content SinTask if there are user move to other page
     */
    function purgeSideSinTask(input) {
        if(input!=1) {
            sjqNoConflict("#freeContentSinTask").html("");
            sjqNoConflict("#contentParSinTask").html("");
            sjqNoConflict("#sideOneSinTask_0").html("");
            sjqNoConflict("#sideOneSinTask_1").html("");
            sjqNoConflict("#sideOneSinTask_2").html("");
            sjqNoConflict("#sideSinTaskFooter").html("");

            sjqNoConflict("#freeContentSinTask").attr("style", "");
            sjqNoConflict("#contentParSinTask").attr("style", "");
            sjqNoConflict("#sideOneSinTask_0").attr("style", "");
            sjqNoConflict("#sideOneSinTask_1").attr("style", "");
            sjqNoConflict("#sideOneSinTask_2").attr("style", "");
            sjqNoConflict("#sideSinTaskFooter").attr("style", "display: none;");
        }

        /* Clear cache */
        resetAllCache();
    }
    /**
     * purgeScriptAdd = Clean/Purge loaded JavaScript & CSS Style
     */
    function purgeScriptAdd(input) {
        if(input!=1) {
            sjqNoConflict("#addScript").html("");
            sjqNoConflict("#addStyle").html("");
            sjqNoConflict("#addArea").html("");
            sjqNoConflict(".styleAdd").remove();
        }
    }
    /**
     * instructBodyObjectSinTask = Instruction to run command (hide & show) the html element.
     */
    function instructBodyObjectSinTask(inst, expectIdTag) {
        var det = detTwo = checktag = 0;
        var bodychild = sjqNoConflict("body").children();
        var bodychildlen = bodychild.length;
        var expectIdTagLen = expectIdTag.length;
        var active = 1;
    	
        if(active==1) {
            while(det<bodychildlen) {
                detTwo = 0;
                checktag = 0;
    			var idstore = "";
                
    			while(detTwo<expectIdTagLen) {
    				var thistag = bodychild.eq(det).prop("tagName");
    				var thisid = thisrealid = "";
                    if(thistag!="SCRIPT" && thistag!="IFRAME") {
                        var thisExpect = expectIdTag[detTwo];
                        var splitDetectExpect = thisExpect.split("");
                        if(splitDetectExpect[0]=="#") {
                            thisid = "#"+bodychild.eq(det).attr("id");
    						thisrealid = bodychild.eq(det).attr("id");
                        } else if(splitDetectExpect[0]==".") {
                            thisid = "."+bodychild.eq(det).attr("class");
    						thisrealid = bodychild.eq(det).attr("class");
                        }
    	
    					if(typeof thisrealid != 'undefined') {
    						if(thisid==thisExpect) {
    							checktag = checktag+1;
    						} else {
    							idstore = thisid;
    						}
    					} else {
    						thisid = "";
    					}
                    } else {
                        checktag = checktag+1;
                    }
                    detTwo = detTwo+1;
    			}
    			
                if(checktag==0) {
                    if(inst=="hide") {
                        bodychild.eq(det).hide();
    					sjqNoConflict("#loadingPageSinTaskSPA").show();
                    } else if(inst=="show") {
                        bodychild.eq(det).show();
    					sjqNoConflict("#loadingPageSinTaskSPA").hide();
                    }
                }
                det = det+1;
            }
        }
    }
    /*_SINGLE_PAGE_APPLICATION_*/
    /**
     * abortSinTaskMovePage = Abort other process if there is new request from user
     */
    var xhrSinTaskMovePage = [];
    function abortSinTaskMovePage() {
        for (var i=0;i<xhrSinTaskMovePage.length;i++)
        {
            xhrSinTaskMovePage[i].abort();
        }
    }

    /**
     * <a..></a> Tag
     * --------
     * document on click class 's' = if a href with .s click by user
     * will run sjqNoConflict.loadContent function above.
     * 
     * Other Tag
     * destination page get from atribute s-data-url on html element (<a href...></a>).
     */
    function __SFW_spaClick() {
        /* SPA PAGE A HREF HANDLER */
        sjqNoConflict(document).on('click', '.s, a[spa]', function (e) {
            __SFW_globalScrollPage[document.URL] = sjqNoConflict(document).scrollTop();

            pageUrl = sjqNoConflict(this).attr('href');
            if(pageUrl=="" || pageUrl==null || typeof pageUrl == 'undefined') {
                pageUrl = sjqNoConflict(this).attr('s-data-url') || sjqNoConflict(this).attr('spa-url');
            }
            sjqNoConflict.loadContent();
            e.preventDefault();
        });

        /* A TAG PREVENT DEFAULT ON CLICK HANDLER */
        sjqNoConflict(document).on("click", "a.prevent", function(e){
            e.preventDefault();
        });
    }

    /**/
    /*LOADER_SINTASK*/
    /**
     * Initialize run function : 
     * sintaskLoaderIframe, abortSinTaskMovePage, universalHideContent, instructBodyObjectSinTask
     */
    sintaskLoaderIframe();
    abortSinTaskMovePage();
    universalHideContent();
    instructBodyObjectSinTask("hide", __SFW_expectHiddenObject);

    xhrSinTaskMovePage.push( sjqNoConflict.ajax({
        type: "POST",
        data: { tokenizing: __SFW_tokenizingUser, part: "content" },
        url: __SFW_thisUrl,
        success: function (data) {
            __SFW_f.toastOne("", 200, "hide");
            sintaskSuccessGetData(data);
        },
        error: function(xhr, textStatus, errorThrown) {
            if(textStatus!="abort") {
                purgeSideSinTask(0);
                purgeScriptAdd();
                instructBodyObjectSinTask("show", __SFW_expectHiddenObject);
                sjqNoConflict("#loadingPageSinTaskSPA").hide();
                
                __SFW_f.popUpTwo({
                    title: "SinTask Framework Error", 
                    message: __SFW_251ErrorDesc, 
                    okButton: "Ok",
                    onOk: function(){
                        __SFW_f.toastTwo("Load JSON Error", "show", 8000);
                    },
                    onOuterClick: "hide",
                    animationFade: true
                });
                /* location.assign("SINTASK_ERROR"); */
            }
            sintaskLoaderIframeStop();
        }
    }) );
    /**
     * sjqNoConflict.loadContent = if user change SinTask page.
     */
    sjqNoConflict.loadContent = function () {
        sintaskLoaderIframe();
        abortSinTaskMovePage();
        universalHideContent();
        instructBodyObjectSinTask("hide", __SFW_expectHiddenObject);

        sjqNoConflict(document).off("click");
        __SFW_spaClick();
        xhrSinTaskMovePage.push( sjqNoConflict.ajax({
            type: "POST",
            data: { tokenizing: __SFW_tokenizingUser, part: "content" },
            url: __SFW_homeUrl+sintaskSPA(pageUrl),
            success: function (data) {
                __SFW_f.toastOne("", 200, "hide");
                sintaskSuccessGetData(data);
            },
            error: function(xhr, textStatus, errorThrown) {
                if(textStatus!="abort") {
                    purgeSideSinTask(0);
                    purgeScriptAdd();
                    instructBodyObjectSinTask("show", __SFW_expectHiddenObject);
                    sjqNoConflict("#loadingPageSinTaskSPA").hide();
                    
                    __SFW_f.popUpTwo({
                        title: "SinTask Framework Error", 
                        message: __SFW_251ErrorDesc, 
                        okButton: "Ok",
                        onOk: function(){
                            __SFW_f.toastTwo("Load JSON Error", "show", 8000);
                        },
                        onOuterClick: "hide",
                        animationFade: true
                    });
                    /* location.assign("SINTASK_ERROR"); */
                }
                sintaskLoaderIframeStop();
            }
        }) );
        /* Change URL with pushState (History API JS) */
        if (__SFW_homeUrl+sintaskSPA(pageUrl) != window.location) {
            window.history.pushState('', '', pageUrl);
        }
    }

    /**
     * sjqNoConflict.backForwardButtons = if user click Back or Forward button from browser tab
     * this function will get data from user history
     */
    sjqNoConflict.backForwardButtons = function () {
        sjqNoConflict(window).on('popstate', function () {
            sintaskLoaderIframe();
            abortSinTaskMovePage();
            universalHideContent();
            instructBodyObjectSinTask("hide", __SFW_expectHiddenObject);

            sjqNoConflict(document).off("click");
            __SFW_spaClick();
            xhrSinTaskMovePage.push( sjqNoConflict.ajax({
                type: "POST",
                data: { tokenizing: __SFW_tokenizingUser, part: "content" },
                url: document.URL,
                success: function (data) {
                    __SFW_f.toastOne("", 200, "hide");
                    sintaskSuccessGetData(data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    if(textStatus!="abort") {
                        purgeSideSinTask(0);
                        purgeScriptAdd();
                        instructBodyObjectSinTask("show", __SFW_expectHiddenObject);
                        sjqNoConflict("#loadingPageSinTaskSPA").hide();
                        
                        __SFW_f.popUpTwo({
                            title: "SinTask Framework Error", 
                            message: __SFW_251ErrorDesc, 
                            okButton: "Ok",
                            onOk: function(){
                                __SFW_f.toastTwo("Load JSON Error", "show", 8000);
                            },
                            onOuterClick: "hide",
                            animationFade: true
                        });
                        /* location.assign("SINTASK_ERROR"); */
                    }
                    sintaskLoaderIframeStop();
                }
            }) );
        });
    }

    /**
     *  sjqNoConflict.goToNotFound = to direct user with not found page
     *  without changing their URL link
     *  run on SPA only
     */
    sjqNoConflict.goToNotFound = function () {
        document.title = "Tidak ditemukan";
        sjqNoConflict("#freeContentSinTask").html("");

        xhrSinTaskMovePage.push( sjqNoConflict.ajax({
            type: "POST",
            data: { tokenizing: __SFW_tokenizingUser, part: "content" },
            url: __SFW_homeUrl+"/../..not/..found",
            success: function (data) {
                __SFW_f.toastOne("", 200, "hide");
                sintaskSuccessGetData(data);
            },
            error: function(xhr, textStatus, errorThrown) {
                if(textStatus!="abort") {
                    purgeSideSinTask(0);
                    purgeScriptAdd();
                    instructBodyObjectSinTask("show", __SFW_expectHiddenObject);
                    sjqNoConflict("#loadingPageSinTaskSPA").hide();
                    
                    __SFW_f.popUpTwo({
                        title: "SinTask Framework Error", 
                        message: __SFW_251ErrorDesc, 
                        okButton: "Ok",
                        onOk: function(){
                            __SFW_f.toastTwo("Load JSON Error", "show", 8000);
                        },
                        onOuterClick: "hide",
                        animationFade: true
                    });
                    /* location.assign("SINTASK_ERROR"); */
                }
                sintaskLoaderIframeStop();
            }
        }) );
    }

    /* Run the SPA on click (initialization) */
    __SFW_spaClick();

    /**
     * Function for other operation changing page and run SPA
     */
    function changingPageSPA(__SFW_thisUrl) {
        var __SFW_thisUrl = __SFW_thisUrl || null;

        pageUrl = __SFW_thisUrl;
        if(pageUrl == null || pageUrl == "") {
            pageUrl = window.location;
        }
        sjqNoConflict.loadContent();
    }

    /**
     * Initial run sjqNoConflict.backForwardButtons
     */
    sjqNoConflict.backForwardButtons();

    return {
        goToNotFound: sjqNoConflict.goToNotFound,
        changingPageSPA: changingPageSPA
    };
}

var __SFW_spa = __SFWspa();