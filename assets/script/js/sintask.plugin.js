/* SINTASK PLUGIN JS */
/* sintask.plugin.js */
/* (c) 2016 - SinTask Webdev */
/* ------------------------- */
/**
 * fn.preventDoubleSubmission = Prevent from double submit
 */
sjqNoConflict.fn.preventDoubleSubmission = function() {
  	sjqNoConflict(this).on('submit',function(e) {
	    var $form = sjqNoConflict(this);

	    if ($form.data('submitted') === true) {
	      	e.preventDefault();
	    } else {
	      	$form.data('submitted', true);
	    }
  	});
  	return this;
};
/**
 * fn.focusInputDivParent = if there is parent of input, textarea, contenteditable, etc
 * the parent will run custom css code input.
 */
sjqNoConflict.fn.focusInputDivParent = function(css, code) {
  	sjqNoConflict(this).focusin(function(){
        sjqNoConflict(this).css(css, code);
    });
    sjqNoConflict(this).focusout(function(){
        sjqNoConflict(this).css(css, "");
    });
    sjqNoConflict(this).hover(function(){
	        sjqNoConflict(this).css(css, code);
	    }, function(){
	    	if(sjqNoConflict(this).find("input").is(":focus")==false) {
	        	sjqNoConflict(this).css(css, "");
	        }
	});
  	return this;
};
/**
 * fn.sintaskHidePopUp = hide PopUp when out of PopUp area clicked by user.
 * Plugin is migrate to function sintaskHideNotParamClicked();
 */
sjqNoConflict.fn.sintaskHidePopUp = function(param, callback, fadeTime) {
    sjqNoConflict(document).mouseup(function (e) {
        var popUpName = sjqNoConflict(param);
        if (!sjqNoConflict(param).is(e.target) && !popUpName.is(e.target) && popUpName.has(e.target).length == 0) {
            if(callback && callback != "" && typeof callback != "undefined") {
                callback();
            } else {
                popUpName.hide(fadeTime);
            }
        }
    });
};
/**
 * jQuery Function shortcut
 */
sjqNoConflict.fn.c = function() {
    return sjqNoConflict(this).children();
}
sjqNoConflict.fn.p = function() {
    return sjqNoConflict(this).parent();
}
sjqNoConflict.fn.outh = function() {
    return sjqNoConflict(this).outerHeight();
}
sjqNoConflict.fn.outw = function() {
    return sjqNoConflict(this).outerWidth();
}
sjqNoConflict.fn.pos = function() {
    return sjqNoConflict(this).position();
}
/**
 * fn.sintaskTooltip = show tooltip from html element that with class .t_sint
 * sintaskTooltip will use many atribute, but basic atribute is title-sintask.
 */
sjqNoConflict.fn.sintaskTooltip = function() {
	sjqNoConflict(this).hover(function(){
	        var thisval = sjqNoConflict(this).attr("title-sintask");
	        var thisalign = "text-align: "+sjqNoConflict(this).attr("title-align-sintask")+";";
	        var thisfontsize = "font-size: "+sjqNoConflict(this).attr("title-fontsize-sintask")+";";
	        var thiswidtsize = "min-width: "+sjqNoConflict(this).attr("title-width-sintask")+";";
	        var thismaxwidtsize = "max-width: "+sjqNoConflict(this).attr("title-maxwidth-sintask")+";";
	        var thismtop = "margin-top: "+sjqNoConflict(this).attr("title-margintop-sintask")+";";
	        var thismleft = "margin-left: "+sjqNoConflict(this).attr("title-marginleft-sintask")+";";
	        var thismright = "margin-right: "+sjqNoConflict(this).attr("title-marginright-sintask")+";";
	        var thismbottom = "margin-bottom: "+sjqNoConflict(this).attr("title-marginbottom-sintask")+";";
	        var thisposition = "position: "+sjqNoConflict(this).attr("title-position-sintask")+" !important;";
            /*OTHER*/
            var thispositiontopauto = sjqNoConflict(this).attr("auto-sintask");
            if(thispositiontopauto == "margintop") {
                var thisheight = sjqNoConflict(this).height();
                thisheight = thisheight+10;
                thismtop = "margin-top: "+thisheight+"px;";
            }

            var getThisTooltipLen = sjqNoConflict("#sintask_tooltip").length;
            if(getThisTooltipLen<1) {
                if(typeof thisval != 'undefined') {
	               sjqNoConflict(this).append("<div id='sintask_tooltip' class='p_ab st_tooltip_2' style='"+thisalign+thiswidtsize+thismaxwidtsize+thisfontsize+thismtop+thismleft+thismright+thismbottom+thisposition+"'>"+thisval+"</div>");
                }
            }
	    }, function(){
	        sjqNoConflict("#sintask_tooltip").remove();
	        sjqNoConflict(".st_tooltip_2").remove();
	});
	sjqNoConflict(this).on("click", function(){
	    var thisvalonclick = sjqNoConflict(this).attr("title-sintask-onclick");
	    if(thisvalonclick!="1") {
	        sjqNoConflict("#sintask_tooltip").remove();
	        sjqNoConflict(".st_tooltip_2").remove();
	    }
	});
  	return this;
};
/**
 * fn.toUpperValue = onkeyup/keydown will change all input, textarea, contenteditable element
 * from lower case to upper case -> sintask = SINTASK
 */
sjqNoConflict.fn.toUpperValue = function() {
	sjqNoConflict(this).keyup(function(){
	    var thisValueUpper = sjqNoConflict(this).val();
	    thisValueUpper = thisValueUpper.toUpperCase();
	    sjqNoConflict(this).val(thisValueUpper);
	});
	sjqNoConflict(this).keydown(function(){
	    var thisValueUpper = sjqNoConflict(this).val();
	    thisValueUpper = thisValueUpper.toUpperCase();
	    sjqNoConflict(this).val(thisValueUpper);
	});
};
/**
 * fn.clearAllInputForm = search all input element and clear it.
 */
sjqNoConflict.fn.clearAllInputForm = function() {
	sjqNoConflict(this).find("input").val("");
};
/**
 * fn.sintaskPassStrength = custom SinTask Standard for Password Strength
 * source code for example :
 * -------------------------
 *  <div id="passwordBox"> 
        <div class="MakeYourOwn"> 
            <div class="fl_l"> 
                <input id="MakeYourOwn" class="MakeYourOwn" id-pass-meter="#passMeterSinTask" name="MakeYourOwn" placeholder="Kata sandi" autocomplete="off" type="password"> 
            </div>
            <div class="MakeYourOwn"> 
                <div id="passMeterSinTask" class="passMeterSinTaskChild backgroundPassMeterlv0"></div> 
            </div>
        </div> 
    </div>
 * --------------------------
 * Require custom css .backgroundPassMeterlv0 - lv4 
 * with 0 (low) - 4 (high)
 */
sjqNoConflict.fn.sintaskPassStrength = function(minLength, debug) {
	var idPassMeter = sjqNoConflict(this).attr("id-pass-meter");
	sjqNoConflict(idPassMeter).addClass("backgroundPassMeterlv0");
	sjqNoConflict(this).keyup(function(){
        var thisNewPassVal = sjqNoConflict(this).val();
        var maxLevel = 5;
        var totalPassMeter = 0;
        var isDebugMode = 0;
        var minimalLength = 4;
        if(debug>0 || debug!=null) {
        	isDebugMode = 1;
        }
        if(minLength>0 || minLength!=null) {
        	minimalLength = minLength;
        }
        /*Start*/
        if (!thisNewPassVal.replace(/\s/g, '').length) {
            totalPassMeter = 0;
        } else if (thisNewPassVal.length<minimalLength) {
            totalPassMeter = 0;
        } else {
            /*start_sintask_passMeterAlgorithm*/
            var passMeterPoin = 0;
            /*first_step_algorithm*/
            var plusPoinStepOne = 0;
                /*INITIATE*/
                var alfOne = "abcdefghijklmnopqrstuvwxyz";
                var alfTwo = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                var alfThree = "0123456789";
                var symOne = "~`!@#$%^&*()_-+={}[]|\\;:'\"<,>.?/";
                /*alfOne*/
                var qa = 0;
                var alfOneArr = alfOne.split("");
                var alfOneLen = alfOneArr.length;
                while(qa<alfOneLen) {
                    var za = thisNewPassVal.indexOf(alfOneArr[qa]);
                    if(za>-1) {
                        plusPoinStepOne = plusPoinStepOne+1;
                    }
                    qa = qa+1;
                }
                /*alfTwo*/
                var qb = 0;
                var alfTwoArr = alfTwo.split("");
                var alfTwoLen = alfTwoArr.length;
                while(qb<alfTwoLen) {
                    var zb = thisNewPassVal.indexOf(alfTwoArr[qb]);
                    if(zb>-1) {
                        plusPoinStepOne = plusPoinStepOne+1;
                    }
                    qb = qb+1;
                }
                /*alfThree*/
                var qc = 0;
                var alfThreeArr = alfThree.split("");
                var alfThreeLen = alfThreeArr.length;
                while(qc<alfThreeLen) {
                    var zc = thisNewPassVal.indexOf(alfThreeArr[qc]);
                    if(zc>-1) {
                        plusPoinStepOne = plusPoinStepOne+1;
                    }
                    qc = qc+1;
                }
                /*symOne*/
                var qd = 0;
                var symOneArr = symOne.split("");
                var symOneLen = symOneArr.length;
                while(qd<symOneLen) {
                    var zd = thisNewPassVal.indexOf(symOneArr[qd]);
                    if(zd>-1) {
                        plusPoinStepOne = plusPoinStepOne+2;
                    }
                    qd = qd+1;
                }
            /*second_step_algorithm*/
            var plusPoinStepTwo = 0;
                /*INITIATE*/
                var thisNewPassValLen = thisNewPassVal.length;
                if(thisNewPassValLen>1 && thisNewPassValLen<6) {
                    plusPoinStepTwo = plusPoinStepTwo+2;
                } else if(thisNewPassValLen>5 && thisNewPassValLen<13) {
                    plusPoinStepTwo = plusPoinStepTwo+6;
                } else if(thisNewPassValLen>12 && thisNewPassValLen<26) {
                    plusPoinStepTwo = plusPoinStepTwo+10;
                } else if(thisNewPassValLen>25) {
                    plusPoinStepTwo = plusPoinStepTwo+20;
                }
            /*third_step_algorithm*/
            var plusPoinStepThree = 0;
                /*INITIATE*/
                /*RLV1*/
                var regexOne = /^[a-z]*$/;
                var regexTwo = /^[A-Z]*$/;
                var regexThree = /^[0-9]*$/;
                var regexFour = /^[\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]*$/;
                /*RLV2*/
                var regexOneLv2 = /^[a-zA-Z]*$/;
                var regexTwoLv2 = /^[a-z0-9]*$/;
                var regexThreeLv2 = /^[a-z\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]*$/;
                var regexFourLv2 = /^[A-Z0-9]*$/;
                var regexFiveLv2 = /^[A-Z\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]*$/;
                var regexSixLv2 = /^[0-9\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]*$/;
                /*RLV3*/
                var regexOneLv3 = /^[a-zA-Z0-9]*$/;
                var regexTwoLv3 = /^[a-zA-Z\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]*$/;
                var regexThreeLv3 = /^[a-z0-9\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]*$/;
                var regexFourLv3 = /^[A-Z0-9\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]*$/;
                /*RLV4*/
                var regexOneLv4 = /^[a-zA-Z0-9\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E]*$/;
                /*StartDetect*/
                if(regexOne.test(thisNewPassVal) == true 
                    || regexTwo.test(thisNewPassVal) == true 
                    || regexThree.test(thisNewPassVal) == true 
                    || regexFour.test(thisNewPassVal) == true) {
                    plusPoinStepThree = plusPoinStepThree+5;
                } else {
                    if(regexOneLv2.test(thisNewPassVal) == true
                        || regexTwoLv2.test(thisNewPassVal) == true
                        || regexThreeLv2.test(thisNewPassVal) == true
                        || regexFourLv2.test(thisNewPassVal) == true
                        || regexFiveLv2.test(thisNewPassVal) == true
                        || regexSixLv2.test(thisNewPassVal) == true) {
                        plusPoinStepThree = plusPoinStepThree+7;
                    } else {
                        if(regexOneLv3.test(thisNewPassVal) == true
                            || regexTwoLv3.test(thisNewPassVal) == true
                            || regexThreeLv3.test(thisNewPassVal) == true
                            || regexFourLv3.test(thisNewPassVal) == true) {
                            plusPoinStepThree = plusPoinStepThree+10;
                        } else {
                            if(regexOneLv4.test(thisNewPassVal) == true) {
                                plusPoinStepThree = plusPoinStepThree+20;
                            } else {
                                plusPoinStepThree = plusPoinStepThree+22;
                            }
                        }
                    }
                }
            /*finishing*/
            passMeterPoin = plusPoinStepOne+plusPoinStepTwo+plusPoinStepThree;
                if(passMeterPoin>5 && passMeterPoin<22) {
                    totalPassMeter = 1;
                } else if(passMeterPoin>21 && passMeterPoin<36) {
                    totalPassMeter = 2;
                } else if(passMeterPoin>35 && passMeterPoin<44) {
                    totalPassMeter = 3;
                } else if(passMeterPoin>43 && passMeterPoin<81) {
                    totalPassMeter = 4;
                } else if(passMeterPoin>80) {
                    totalPassMeter = 5;
                }
            /*DEBUGMODE*/
            if(isDebugMode==1) {
                var shownDebug = "\n+P1>"+plusPoinStepOne+"\n+P2>"+plusPoinStepTwo+"\n+P3>"+plusPoinStepThree+"\nPMP>"+passMeterPoin+"\nTPM>"+totalPassMeter;
            }
        }
        /*REMOVE_ALL_CLASS*/
        var i = 0;
        while(i<maxLevel) {
            var thisLevel = i+1;
            sjqNoConflict(idPassMeter).removeClass("backgroundPassMeterlv"+thisLevel);
            i = i+1;
        }
        /*SHOW*/
        sjqNoConflict(idPassMeter).addClass("backgroundPassMeterlv"+totalPassMeter);
    });
};

/**  
 * fn.childrenHeight = to get the all children height, not the parent of this element
 */
sjqNoConflict.fn.childrenHeight = function() {
    var thisId = this;
    var thisChildren = sjqNoConflict(thisId).children();
    var thisChildLength = thisChildren.length;
    var heightResult = 0;
	var thisChildrenStep = "";
	
    var classExecpt = [
        "ps-scrollbar-x-rail",
        "ps-scrollbar-y-rail",
    ];
	
	function heightCount(id, result) {
		var thisTagName = id.prop("tagName");
		if(thisTagName.toLowerCase() == "a") {
			return heightCount(id.children(), result);
		} else {
			return id.outerHeight();
		}
	}

    for(var a=0; a<thisChildLength; a++) {
        var thisClassExecpt = thisChildren.eq(a).attr("class");
        if((classExecpt.indexOf(thisClassExecpt)) < 0) {
            var heightNow = heightCount(thisChildren.eq(a), heightResult);
			heightResult = heightResult+heightNow;
        }
    }

    return heightResult;
}

/**
 * SinTask Bytes -> ALL
 */
sjqNoConflict.fn.sintaskFileSize = function() {
    var thisId = this;
    var thisBytes = sjqNoConflict(thisId).attr("this-bytes");
    var thisFixed = sjqNoConflict(thisId).attr("behind-commas");

    thisBytes = parseInt(thisBytes);
    thisFixed = parseInt(thisFixed);

    var stdBytes = 1024;
    var byteName = ["B", "KB", "MB", "GB", "TB", "PB"];
    var byteState = 0;

    if(thisFixed==null || thisFixed=="") {
        thisFixed = 2;
    }

    function translateBytes() {
        if(thisBytes>stdBytes && byteState<byteName.length-1) {
            byteState = byteState+1;
            thisBytes = thisBytes/stdBytes;
            translateBytes();
        } else {
            thisBytes = thisBytes.toFixed(thisFixed);
            var finalBytes = thisBytes+" "+byteName[byteState];
            sjqNoConflict(thisId).html(finalBytes);
        }
    }
    translateBytes();
}
/**
 * SinTask Disable/Enable Tag Inside
 */
sjqNoConflict.fn.disableTagInside = function() {
    sjqNoConflict(this).css("pointer-events", "none");
    sjqNoConflict(this).css("opacity", "0.4");
    sjqNoConflict(this).blur();
}
sjqNoConflict.fn.enableTagInside = function() {
    sjqNoConflict(this).css("pointer-events", "");
    sjqNoConflict(this).css("opacity", "");
    sjqNoConflict(this).blur();
}
/**
 * fn.sintaskGoto = Goto tag HTML focus.
 */
sjqNoConflict.fn.sintaskGoto = function() {
    sjqNoConflict(this).on("click", function (e) {
        var sgoto = sjqNoConflict(this).attr("sgoto");
        if(typeof sgoto != 'undefined') {
            var checkSgoto = sjqNoConflict(sgoto).length;
            if(checkSgoto > 0) {
                var top = sjqNoConflict(sgoto).position().top;
                var height = sjqNoConflict(sgoto).innerHeight();
                if(typeof top != 'undefined' && typeof height != 'undefined') {
                    var fixTop = top-height;
                    sjqNoConflict(document).scrollTop(fixTop);
                    sjqNoConflict(window).scrollTop(fixTop);
                    sjqNoConflict("html").scrollTop(fixTop);
                    sjqNoConflict("body").scrollTop(fixTop);
                }
            }
        }
        e.preventDefault();
    });
};
/**
 * fn.sintaskDivPlaceholder = Div element placeholder
 */
sjqNoConflict.fn.sintaskDivPlaceholder = function() {
    var checkThisPlaceholder = sjqNoConflict(this).parent().find(".typeDivPlaceholder").length;
    var thisPlaceholder = sjqNoConflict(this).attr("placeholder");
    var thisId = this;

    var randomValue = getRandomOnSinTask(2);

    showOrHidePlaceholder = function(thisId) {
        var element     = sjqNoConflict(thisId);
        var elemText    = element.text();
        var elemHtml    = element.html();
        var elemTextLen = elemText.length;

        if(countEnter(elemHtml)<3 && elemTextLen==0) {
            sjqNoConflict(thisId).parent().find(".typeDivPlaceholder").show();
        } else {
            sjqNoConflict(thisId).parent().find(".typeDivPlaceholder").hide();
        }
    }

    if(checkThisPlaceholder<1) {
        sjqNoConflict(this).parent().prepend("<div id='placeholder"+randomValue+"' class='typeDivPlaceholder unSelectAble' contenteditable='true'>"+thisPlaceholder+"</div>");
    }

    sjqNoConflict(this).on("focusout", function(){
        var element = sjqNoConflict(this);        
        if (!element.text().replace(" ", "").length) {
            element.empty();
            sjqNoConflict(this).parent().find(".typeDivPlaceholder").css("opacity", "0.8");
        }
        showOrHidePlaceholder(thisId);
    });
    sjqNoConflict(this).on("focusin", function(){
        sjqNoConflict(this).parent().find(".typeDivPlaceholder").css("opacity", "0.4");
        sjqNoConflict("#placeholder"+randomValue).html(thisPlaceholder);
    });
    sjqNoConflict(this).parent().on("click mousedown", function(){
        sjqNoConflict(thisId).focus();
    });
    sjqNoConflict(this).parent().on("contextmenu", function(e){
        sjqNoConflict(thisId).focus();
    });

    setInterval(function(){
        var checkFocus = sjqNoConflict(thisId).is(':focus');
        if(checkFocus == true) {
            showOrHidePlaceholder(thisId);
        } else {
            var checkDisplay = sjqNoConflict(this).parent().find(".typeDivPlaceholder").is(':visible');
            if(checkDisplay == false) {
                sjqNoConflict(this).parent().find(".typeDivPlaceholder").css("opacity", "0.8");
                showOrHidePlaceholder(thisId);
            }
        }
    },20);
};