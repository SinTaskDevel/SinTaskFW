/**
 * SinTask ZCore JS -> Replace the Old Core 
 * All Single Page Control is in this file
 * Several XHR interaction & realtime in this file
 * ----------------------------------------
 * SinTask, Inc (c) 2017
 */
var globalScrollPage = [];

sjqNoConflict(window).on('load', function() {
    sintaskLoaderIframeStop();
});
/**
 * expectHiddenObject variable = contain expect hidden element.
 * this variable use in function instructBodyObjectSinTask below
 */
var expectHiddenObject = ['#headerSinTask','#contentParSinTask','#popUpSinTask','#popUpSinTaskTwo','#popUpSinTaskThree','#sideSinTask','.sintaskTooltipInput'];
/**
 * sintaskLoaderIframeAgain = Iframe load or browser tab loading re-start.
 */
sintaskLoaderIframeAgain = function() {
    sintaskLoaderIframe();
}
/**
 * universalHideContent = Universal hidden element content :
 * - sintaskTooltipInput (class)
 */
universalHideContent = function() {
    sjqNoConflict(".sintaskTooltipInput").hide();
}
/**
 * sintaskLoaderIframe = Iframe loader initial
 */
sintaskLoaderIframe = function() {
	return true;
}
/**
 * sintaskLoaderIframeStop = Stop the iframe loader or browser tab loading
 */
sintaskLoaderIframeStop = function() {
    setTimeout(function(){
		checkCss = sjqNoConflict("style.styleAdd").html();
		if(typeof checkCss != 'undefined' && checkCss != "" && ctypeSpace(checkCss) != 0) {
			instructBodyObjectSinTask("show", expectHiddenObject);

            /*FIXED_THE_SCROLL*/
            if(typeof globalScrollPage[document.URL] === "undefined") {
                sjqNoConflict(document).scrollTop(0);
            } else {
                sjqNoConflict(document).scrollTop(globalScrollPage[document.URL]);
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
instSinTask = function(input) {
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
var afterLoadScript = []; /*VAR_FOR_LINK_ALREADY_LOADED*/
var funcToRunArr = []; /*FUNC_TO_RUN_ARRAY*/
var funcParamToRunArr = []; /*FUNC_PARAMETER_TO_RUN_ARRAY*/
var completeAllLoaded = 0; /*1_IF_COMPLETE_LOAD_ALL_DATA*/
loadAddScript = function(link, funcToRun, funcParamToRun) {
    var link_ = link;
    if(funcToRun=="normal") {
        sjqNoConflict.ajax({
            type: "POST",
            data: { tokenizing: tokenizingUser },
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
    } else if(funcToRun=="noRand") {
        var searchAfterLoadScript = afterLoadScript.indexOf(link_);
        if(searchAfterLoadScript<0) {
            afterLoadScript.push(link_);
            sjqNoConflict.ajax({
                type: "POST",
                data: { tokenizing: tokenizingUser },
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
        }
    } else {
        if(link_!="null") {
            var link__ = link_.split("/");
            var searchAfterLoadScript = afterLoadScript.indexOf(link_);
            if(searchAfterLoadScript<0 || (link__[4]=="core" && link__[5]=="controller")) {
                afterLoadScript.push(link_);
                sjqNoConflict.ajax({
                    type: "POST",
                    data: { tokenizing: tokenizingUser },
                    cache: true,
                    dataType: "script",
                    url: link_,
                    success: function () {
                        if(link__[4]=="template") {
                            var funcToRun_ = window[funcToRun];
                            if (typeof funcToRun_ === "function") funcToRun_.apply(null, funcParamToRun);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        afterLoadScript.pop(link_);
                    }
                });
            } else {
                if(link__[4]=="template") {
                    var funcToRun_ = window[funcToRun];
                    if (typeof funcToRun_ === "function") funcToRun_.apply(null, funcParamToRun);
                }
            }
        } else {
            var funcToRun_ = window[funcToRun];
            if (typeof funcToRun_ === "function") funcToRun_.apply(null, funcParamToRun);
        }
    }
    return true;
}
/**
 * loadAddStyle = Load additional <style> (CSS) with response from Server
 */
loadAddStyle = function(link, id) {
    if(link!="null") {
        var idfinal = "style-"+id;
        if(sjqNoConflict("."+idfinal).length>0) {
            sjqNoConflict.ajax({
                type: "POST",
                data: { tokenizing: tokenizingUser },
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
            sjqNoConflict("body").append("<style class='"+idfinal+" styleAdd'></style>");
            setTimeout(function(){loadAddStyle(link, id);},500);
        }
    }
    return true;
}
/**
 * runH variable is Run Stay SPA Loader, 1 = True, else = False
 */
if(runH!=1) {
    var turnArray = ["stayheader", "staycontent", "stayfooter"];
    for(var turnIt = 0; turnIt < turnArray.length; turnIt++) {
        var nowTurn = turnArray[turnIt];
        if(nowTurn != null && nowTurn != "" && typeof nowTurn != 'undefined') {
            var thisNowTurn = homeUrl+"/."+nowTurn;
            loadAddScript(thisNowTurn, "normal", "");
        }
    }
}

/*_SINGLE_PAGE_APPLICATION_BIGLINE_*/
/**
 * sintaskSPA = replace if href="[BASE URL]/path/path" to be /path/path
 */
sintaskSPA = function(input) {
    var vars = input.replace(homeUrl, "");

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
sintaskSuccessGetData = function(data) {
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
        purgeSideSinTask(runP);
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
            loadAddScript(scriptNow, "normal", "");
            loadAddScriptIt = loadAddScriptIt+1;
        }
        /*GET NEW TITLE*/
        document.title = theTitle[0].title;

        /*LOAD_FUNC_SCRIPT_AGAIN*/
        sintaskLoaderIframeStop();
    } else {
        sjqNoConflict("body").html("ERROR: 205-INVALID_TOKEN -> https://fw.sintask.com/docs/error");
    }
}
/**
 * resetAllCache = Clean the cache or anything that interupt any new action / movement.
 */
resetAllCache = function() {
    cacheDropdown = [];
    cacheCommentDropdown = [];
}
/**
 * purgeSideSinTask = Clean/Purge Area of Content SinTask if there are user move to other page
 */
purgeSideSinTask = function(input) {
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
purgeScriptAdd = function(input) {
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
instructBodyObjectSinTask = function(inst, expectIdTag) {
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
abortSinTaskMovePage = function() {
    for (var i=0;i<xhrSinTaskMovePage.length;i++)
    {
        xhrSinTaskMovePage[i].abort();
    }
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
instructBodyObjectSinTask("hide", expectHiddenObject);
xhrSinTaskMovePage.push( sjqNoConflict.ajax({
    type: "POST",
    data: { tokenizing: tokenizingUser, part: "content" },
    url: thisUrl,
    success: function (data) {
        fadeContentOne("", 200, "hide");
        sintaskSuccessGetData(data);
    },
    error: function(xhr, textStatus, errorThrown) {
        if(textStatus!="abort") {
            purgeSideSinTask(0);
            purgeScriptAdd();
            fadeContentOne("Load Problem", 200, "show");
            location.assign("SINTASK_ERROR");
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
    instructBodyObjectSinTask("hide", expectHiddenObject);
    xhrSinTaskMovePage.push( sjqNoConflict.ajax({
        type: "POST",
        data: { tokenizing: tokenizingUser, part: "content" },
        url: homeUrl+sintaskSPA(pageUrl),
        success: function (data) {
            fadeContentOne("", 200, "hide");
            sintaskSuccessGetData(data);
        },
        error: function(xhr, textStatus, errorThrown) {
            if(textStatus!="abort") {
                purgeSideSinTask(0);
                purgeScriptAdd();
                fadeContentOne("Load Problem", 200, "show");
                location.assign("SINTASK_ERROR");
            }
            sintaskLoaderIframeStop();
        }
    }) );
    if (homeUrl+sintaskSPA(pageUrl) != window.location) {
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
        instructBodyObjectSinTask("hide", expectHiddenObject);
        xhrSinTaskMovePage.push( sjqNoConflict.ajax({
            type: "POST",
            data: { tokenizing: tokenizingUser, part: "content" },
            url: document.URL,
            success: function (data) {
                fadeContentOne("", 200, "hide");
                sintaskSuccessGetData(data);
            },
            error: function(xhr, textStatus, errorThrown) {
                if(textStatus!="abort") {
                    purgeSideSinTask(0);
                    purgeScriptAdd();
                    fadeContentOne("Load Problem", 200, "show");
                    location.assign("SINTASK_ERROR");
                }
                sintaskLoaderIframeStop();
            }
        }) );
    });
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
sjqNoConflict(document).on('click', '.s', function (e) {
    globalScrollPage[document.URL] = sjqNoConflict(document).scrollTop();

    pageUrl = sjqNoConflict(this).attr('href');
    if(pageUrl=="" || pageUrl==null || typeof pageUrl == 'undefined') {
        pageUrl = sjqNoConflict(this).attr('s-data-url');
    }
    sjqNoConflict.loadContent();
    e.preventDefault();
});

/**
 * Function for other operation changing page and run SPA
 */
changingPageSPA = function(thisUrl = null) {
    pageUrl = thisUrl;
    if(pageUrl == null || pageUrl == "") {
        pageUrl = window.location;
    }
    sjqNoConflict.loadContent();
}

/**
 * Initial run sjqNoConflict.backForwardButtons
 */
sjqNoConflict.backForwardButtons();