/* SINTASK PLUGIN JS */
/* sintask.plugin.2.js */
/* (c) 2018 - SinTask Webdev */
/* ------------------------- */
/**
 *  Tooltip untuk tag HTML disarankan pada <span>
 *
 *  Cara penggunaan :
 *      <span id="contohTooltip" title-sintask="Ini Tooltip">
 *          Arahkan Cursor akan mengeluarkan Tooltip
 *      </span>
 *      <script>
 *          sjqNoConflict("#contohTooltip").sintaskTooltipP2();
 *      </script>
 *
 *  @attribute  title-sintask           -> Isi dari tooltip
 *              title-align-sintask     -> Align text: left, right, justify, center, dll
 *              title-fontsize-sintask  -> Ukuran font dari tooltip: 12px, 15px, dll
 *              title-width-sintask     -> Ukuran lebar dari tooltip: 100em, 100px, dll
 *              title-maxwidth-sintask  -> Maksimal lebar dari tooltip: 100em, 100px, dll
 *              title-margintop-sintask -> Margin atas tooltip: 10px, 10em, dll
 *                   -marginleft-       -> Margin kiri
 *                   -marginright-      -> Margin kanan
 *                   -marginbottom-     -> Margin bawah
 *              title-position-sintask  -> Sama seperti position pada: relative, absolute, fixed
 *              auto-sintask            -> Otomatis untuk margin atas tooltip: margintop
 *              title-sintask-onclick   -> Jika bernilai 1 akan tetap,
 *                                         dan jika selain 1 akan menghilang saat diklik.
 */

sjqNoConflict.fn.sintaskTooltipP2 = function() {
    var thisRandomNum = (Math.random() * 1000000).toFixed(0);
    var thisRandomDate = Date.now();
    var thisRandomSession = thisRandomNum+""+thisRandomDate;
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
                    var thisStyle = "<div class='st_tooltip_2"+thisRandomSession+"' style='display: none;'><style>.st_tooltip_2"+thisRandomSession+"{background:#111;border-radius:2px;margin-top:4px;margin-left:-7px;color:#fff;display:block;padding:.3em 1em;position:absolute;text-shadow:0 1px 0 #000;z-index:99999;max-width:180px;font-size:12px;overflow:visible;box-shadow:0 0 1px 1px #FFF;white-space:normal!important}.st_tooltip_2"+thisRandomSession+":before{border:solid;border-color:#111 transparent;border-width:0 .5em .5em;margin-top:-7px;content:\"\";display:block;left:14px;position:absolute;z-index:99999}</style></div>";
                    sjqNoConflict(this).append("<div id='sintask_tooltip' class='p_ab st_tooltip_2"+thisRandomSession+"' style='"+thisalign+thiswidtsize+thismaxwidtsize+thisfontsize+thismtop+thismleft+thismright+thismbottom+thisposition+"'>"+thisval+"</div>"+thisStyle);
                }
            }
        }, function(){
            sjqNoConflict("#sintask_tooltip").remove();
            sjqNoConflict(".st_tooltip_2"+thisRandomSession).remove();
    });
    sjqNoConflict(this).on("click", function(){
        var thisvalonclick = sjqNoConflict(this).attr("title-sintask-onclick");
        if(thisvalonclick != "1") {
            sjqNoConflict("#sintask_tooltip").remove();
            sjqNoConflict(".st_tooltip_2"+thisRandomSession).remove();
        }
    });
    return this;
};

/** REALTIME TIME-AGO
 * fn.realtimeTimeAgo = get timestamp from real-timestamp atribute on html element 
 * and translate it to human readable with 5s realtime interval
 */

/** REALTIME TIME-LIMIT
 * fn.realtimeTimeAgo = get timestamp from real-timestamp atribute on html element 
 * and translate it to human readable with 5s realtime interval
 */
sjqNoConflict.fn.realtimeTimeAgoP2 = function() {
    var thisId = this;
    var timeOldJsTen = sjqNoConflict(thisId).attr("real-timestamp");
    timeOldJsTen = timeOldJsTen.substr(0, 10);
    function timeOutRealtimeTimeAgo() {
        var timeNowJsTen = __SFW_f.timeStampJsTenLocal();
        var detik = timeNowJsTen-timeOldJsTen;
        var theResult = "";
        if(detik>-1) {
            if(detik<60) {
                theResult = detik+" "+sintaskBahasa.secondAgoPrettyTimeLST;
                if(detik<=15) {
                    theResult = sintaskBahasa.stillWarmLST;
                }
            } else {
                if(detik<(60*60)) {
                    var thisMinute = Math.floor((timeNowJsTen-timeOldJsTen)/60);
                    var minuteAgo = sintaskBahasa.minutesAgoPrettyTimeLST;
                    if(thisMinute>0 && thisMinute<2) {
                        minuteAgo = sintaskBahasa.minuteAgoPrettyTimeLST;
                    }
                    theResult = thisMinute+" "+minuteAgo;
                } else if(detik>=(60*60*1) && detik<(60*60*24)) {
                    var thisMinute = Math.floor((timeNowJsTen-timeOldJsTen)/60);
                    var thisHour = Math.floor(thisMinute/60);
                    var hourAgo = sintaskBahasa.hoursAgoPrettyTimeLST;
                    if(thisHour>0 && thisHour<2) {
                        hourAgo = sintaskBahasa.hourAgoPrettyTimeLST;
                    }
                    var isYesterday = __SFW_f.timeStampToHumanTimeP2(timeOldJsTen, "checkday");
                    theResult = thisHour+" "+hourAgo+" "+isYesterday;
                } else if(detik>=(60*60*24) && detik<(60*60*24*4)) {
                    theResult = __SFW_f.timeStampToHumanTimeP2(timeOldJsTen, "dayago");
                } else {
                    theResult = __SFW_f.timeStampToHumanTimeP2(timeOldJsTen, "realtimecontent");
                }
            }
        } else {
            theResult = __SFW_f.timeStampToHumanTimeP2(timeOldJsTen, "realtimecontent");
        }

        sjqNoConflict(thisId).html(theResult);

        setTimeout(function(){
            if(sjqNoConflict(thisId).length > 0) {
                timeOutRealtimeTimeAgo();
            }
        },5000);
    }
    timeOutRealtimeTimeAgo();
}
sjqNoConflict.fn.realtimeTimeLimitP2 = function() {
    var thisId = this;
    var timeFutureJsTen = sjqNoConflict(thisId).attr("real-timestamp");
    function timeOutRealtimeTimeLimit() {
        var timeNowJsTen = __SFW_f.timeStampJsTenLocal();
        var detik = timeFutureJsTen-timeNowJsTen;
        var theResult = "";

        function getInTimes(detikIn) {
            var theResultReturn = [];

            var thisSecond = detik;
            var thisMinute = Math.floor((timeFutureJsTen-timeNowJsTen)/60);
            var thisHour = Math.floor(thisMinute/60);
            var thisDay = Math.floor(thisHour/24);
            var thisWeek = Math.floor(thisDay/7);
            
            var thisSecondNew = thisSecond-(thisMinute*60);
            var secondLimit = "";
            if(thisSecondNew>0 && thisSecondNew<2) {
                secondLimit = sintaskBahasa.secondLST;
            } else if(thisSecondNew>1) {
                secondLimit = sintaskBahasa.secondsLST;
            } 

            var thisMinuteNew = thisMinute-(thisHour*60);
            var minuteLimit = sintaskBahasa.minutesLST;
            if(thisMinuteNew>0 && thisMinuteNew<2) {
                minuteLimit = sintaskBahasa.minuteLST;
            } else if(thisMinuteNew>1) {
                minuteLimit = sintaskBahasa.minutesLST;
            }

            var thisHourNew = thisHour-(thisDay*24);
            var hourLimit = sintaskBahasa.hoursLST;
            if(thisHourNew>0 && thisHourNew<2) {
                hourLimit = sintaskBahasa.hourLST;
            } else if(thisHourNew>1) {
                hourLimit = sintaskBahasa.hoursLST;
            }

            var thisDayNew = thisDay-(thisWeek*7);
            var dayLimit = sintaskBahasa.daysLST;
            if(thisDayNew>0 && thisDayNew<2) {
                dayLimit = sintaskBahasa.dayLST;
            } else if(thisDayNew>1) {
                dayLimit = sintaskBahasa.daysLST;
            }

            var thisWeekNew = thisWeek;
            var weekLimit = sintaskBahasa.weeksLST;
            if(thisWeekNew>0 && thisWeekNew<2) {
                weekLimit = sintaskBahasa.weekLST;
            } else if(thisWeekNew>1) {
                weekLimit = sintaskBahasa.weeksLST;
            }
            
            if(thisWeekNew>0) {
                theResultReturn["week"]     = thisWeekNew+" "+weekLimit; 
            } else {
                theResultReturn["week"]     = "";
            }

            if(thisDayNew>0) {
                theResultReturn["day"]      = thisDayNew+" "+dayLimit;
            } else {
                theResultReturn["day"]      = "";
            }

            if(thisHourNew>0) {
                theResultReturn["hour"]     = thisHourNew+" "+hourLimit;
            } else {
                theResultReturn["hour"]     = "";
            }

            if(thisMinuteNew>0) {
                theResultReturn["minute"]   = thisMinuteNew+" "+minuteLimit;
            } else {
                theResultReturn["minute"]   = "";
            }

            if(thisSecondNew>0) {
                theResultReturn["second"]   = thisSecondNew+" "+secondLimit;
            } else {
                theResultReturn["second"]   = "";
            }

            return theResultReturn;
        }
        
        if(detik>-1) {
            if(detik<60) {
                /* Second : 
                 * < 1 Minute | < 60 Seconds 
                 */
                theResult = detik+" "+sintaskBahasa.secondLST;
                if(detik>1) {
                    theResult = detik+" "+sintaskBahasa.secondsLST;
                }
            } else {
                if(detik<(60*60)) {
                    /* Minute : 
                     * < 1 Hour | < 60 Minutes 
                     */
                    var thisResult = getInTimes(detik);
                    theResult = thisResult["minute"];
                    theResult = theResult+" "+thisResult["second"];
                } else if(detik>=(60*60) && detik<(60*60*24)) {
                    /* Hour : 
                     * >= 1 Hour & < 24 Hours 
                     */
                    var thisResult = getInTimes(detik);
                    theResult = thisResult["hour"];
                    theResult = theResult+" "+thisResult["minute"];
                    theResult = theResult+" "+thisResult["second"];
                } else if(detik>=(60*60*24) && detik<(60*60*24*7)) {
                    /* Day : 
                     * >= 1 Day & < 7 Days 
                     */
                    var thisResult = getInTimes(detik);
                    theResult = thisResult["day"];
                    theResult = theResult+" "+thisResult["hour"];
                    theResult = theResult+" "+thisResult["minute"];
                    theResult = theResult+" "+thisResult["second"];
                } else {
                    /* Week : 
                     * >= 7 Day 
                     */
                    var thisResult = getInTimes(detik);

                    /* ( IF > 10 Week ) -> Show Week, Day, Hour Remaining */
                    if(parseInt(thisResult["week"])>10) {
                        theResult = thisResult["week"];
                        theResult = theResult+" "+thisResult["day"];
                        theResult = theResult+" "+thisResult["hour"];
                    } else {
                        theResult = thisResult["week"];
                        theResult = theResult+" "+thisResult["day"];
                        theResult = theResult+" "+thisResult["hour"];
                        theResult = theResult+" "+thisResult["minute"];
                    }
                }
            }
            theResult = theResult+" "+sintaskBahasa.remainingLST; 
        } else {
            theResult = sintaskBahasa.deadlinePassedLST;
        }

        sjqNoConflict(thisId).html(theResult);

        setTimeout(function(){
            if(sjqNoConflict(thisId).length > 0) {
                timeOutRealtimeTimeLimit();
            }
        },5000);
    }
    timeOutRealtimeTimeLimit();
}
/* END LINE */

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
        if(thisBytes >= stdBytes && byteState < byteName.length-1) {
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
 * fn.sintaskHidePopUp = hide PopUp when out of PopUp area clicked by user.
 * Plugin is migrate to function sintaskHideNotParamClicked();
 */
sjqNoConflict.fn.sintaskHidePopUpP2 = function(param, fadeTime, callback) {
    var callback = callback || "";

    sjqNoConflict(document).mouseup(function (e) {
        var popUpName = sjqNoConflict(param);
        if (!sjqNoConflict(param).is(e.target) && !popUpName.is(e.target) && popUpName.has(e.target).length == 0) {
            popUpName.hide(fadeTime);
            
            if(typeof(callback) == "function") {
                callback();
            }
        }
    });
};