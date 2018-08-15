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
var sintaskBahasa = [];

sintaskBahasa.janLST = "Jan";
sintaskBahasa.febLST = "Feb";
sintaskBahasa.marLST = "Mar";
sintaskBahasa.aprLST = "Apr";
sintaskBahasa.mayLST = "Mei";
sintaskBahasa.junLST = "Jun";
sintaskBahasa.julLST = "Jul";
sintaskBahasa.augLST = "Agu";
sintaskBahasa.sepLST = "Sep";
sintaskBahasa.octLST = "Okt";
sintaskBahasa.novLST = "Nov";
sintaskBahasa.decLST = "Des";

sintaskBahasa.sunLST = "Min";
sintaskBahasa.monLST = "Sen";
sintaskBahasa.tueLST = "Sel";
sintaskBahasa.wedLST = "Rab";
sintaskBahasa.thuLST = "Kam";
sintaskBahasa.friLST = "Jum";
sintaskBahasa.satLST = "Sab";

sintaskBahasa.stillWarmLST              = "baru saja";
sintaskBahasa.secondAgoPrettyTimeLST    = "detik lalu";
sintaskBahasa.minuteAgoPrettyTimeLST    = "menit lalu";
sintaskBahasa.minutesAgoPrettyTimeLST   = "menit lalu";
sintaskBahasa.hourAgoPrettyTimeLST      = "jam lalu";
sintaskBahasa.hoursAgoPrettyTimeLST     = "jam lalu";
sintaskBahasa.yesterdayPrettyTimeLST    = "kemarin";
sintaskBahasa.todayPrettyTimeLST        = "hari ini";
sintaskBahasa.dayAgoPrettyTimeLST       = "hari lalu";
sintaskBahasa.daysAgoPrettyTimeLST      = "hari lalu";

sintaskBahasa.secondLST         = "detik";
sintaskBahasa.secondsLST        = "detik";
sintaskBahasa.minuteLST         = "menit";
sintaskBahasa.minutesLST        = "menit";
sintaskBahasa.hourLST           = "jam";
sintaskBahasa.hoursLST          = "jam";
sintaskBahasa.dayLST            = "hari";
sintaskBahasa.daysLST           = "hari";
sintaskBahasa.weekLST           = "minggu";
sintaskBahasa.weeksLST          = "minggu";
sintaskBahasa.remainingLST      = "tersisa";
sintaskBahasa.deadlinePassedLST = "Deadline sudah lewat";

timeStampToHumanTimeP2 = function(timestampIn, exception) {
    AmPm = function(inHourMinuteSecond) {
        var split = inHourMinuteSecond.split(":");
        var hourAmPm = "";
        if(split[0]>11 && split[0]<24) {
            split[0] = split[0]-12;
            if(split[0]<1) {
                split[0] = "12";
            }
            hourAmPm = "PM";
        } else {
            split[0] = split[0];
            if(split[0]<1) {
                split[0] = "12";
            }
            hourAmPm = "AM";
        }

        var thisHourSplit = "0"+split[0];
        split[0] = thisHourSplit.substr(-2);
        var result = split[0]+":"+split[1]+":"+split[2]+" "+hourAmPm;
        return result;
    }
    NumMonth = function(inMonth) {
        var monthArray = [sintaskBahasa.janLST, sintaskBahasa.febLST, sintaskBahasa.marLST, sintaskBahasa.aprLST, sintaskBahasa.mayLST, sintaskBahasa.junLST, sintaskBahasa.julLST, sintaskBahasa.augLST, sintaskBahasa.sepLST, sintaskBahasa.octLST, sintaskBahasa.novLST, sintaskBahasa.decLST];

        inMonth = parseInt(inMonth);

        return monthArray[inMonth];
    }
    NumDay = function(inDay) {
        var dayArray = [sintaskBahasa.sunLST, sintaskBahasa.monLST, sintaskBahasa.tueLST, sintaskBahasa.wedLST, sintaskBahasa.thuLST, sintaskBahasa.friLST, sintaskBahasa.satLST];

        inDay = parseInt(inDay);

        return dayArray[inDay];
    }

    var timestamp = timestampIn;
    if(timestamp!="" && timestamp!=null) {
        timestamp = timestamp.toString();
        timestamp = timestamp.substr(0, 10);
        timestamp = parseInt(timestamp*1000);
    } else {
        var newDate = new Date();
        timestamp = newDate.getTime();
    }

    var date        = new Date(timestamp);
    var getDay      = date.getDay();
    var getDate     = date.getDate();
    var getMonth    = date.getMonth();
    var getYear     = date.getFullYear();
    var getHour     = date.getHours();
    var getMinute   = date.getMinutes();
    var getSecond   = date.getSeconds();

    getHour     = "0"+getHour;
    getMinute   = "0"+getMinute;
    getSecond   = "0"+getSecond;

    getHour     = getHour.substr(-2);
    getMinute   = getMinute.substr(-2);
    getSecond   = getSecond.substr(-2);

    var getHourAmPm = AmPm(getHour+":"+getMinute+":"+getSecond);
    var getMonthAlfabet = NumMonth(getMonth);
    var getDayAlfabet = NumDay(getDay);

    if(exception=="" || exception==null) {
        var result = getDayAlfabet+", "+getDate+" "+getMonthAlfabet+" "+getYear+" "+getHourAmPm;
    } else {
        if(exception=="nosecond") {
            var splitHour = getHourAmPm.split(":");
            var getSecAmPm = splitHour[2];
            var splitSec = getSecAmPm.split(" ");
            var newGetHourAmPm = splitHour[0]+":"+splitHour[1]+" "+splitSec[1];

            var result = getDayAlfabet+", "+getDate+" "+getMonthAlfabet+" "+getYear+" "+newGetHourAmPm;
        } else if(exception=="noclock") {
            var result = getDayAlfabet+", "+getDate+" "+getMonthAlfabet+" "+getYear;
        } else if(exception=="noyear") {
            var result = getDayAlfabet+", "+getDate+" "+getMonthAlfabet+" "+getHourAmPm;
        } else if(exception=="noday") {
            var result = getDate+" "+getMonthAlfabet+" "+getYear+" "+getHourAmPm;
        } else if(exception=="checkday") {
            var newDate = new Date();
            dayNow = newDate.getDay();

            if(dayNow==getDay) {
                var result = "";
            } else if(dayNow>getDay) {
                var dayMinus = dayNow-getDay;
                if(dayMinus==1) {
                    var result = "("+sintaskBahasa.yesterdayPrettyTimeLST+")";
                } else {
                    var result = "("+dayMinus+" "+sintaskBahasa.daysAgoPrettyTimeLST+")"; 
                }
            } else if(dayNow<getDay) {
                var dayMinus = (dayNow+7)-getDay; /* +7 Because 7 = 1 Week */
                if(dayMinus==1) {
                    var result = "("+sintaskBahasa.yesterdayPrettyTimeLST+")";
                } else {
                    var result = "("+dayMinus+" "+sintaskBahasa.daysAgoPrettyTimeLST+")"; 
                }
            }
        } else if(exception=="dayago") {
            var newDate = new Date();
            dayNow = newDate.getDay();

            var splitHour = getHourAmPm.split(":");
            var getSecAmPm = splitHour[2];
            var splitSec = getSecAmPm.split(" ");
            var newGetHourAmPm = splitHour[0]+":"+splitHour[1]+" "+splitSec[1];

            if(dayNow==getDay) {
                var result = sintaskBahasa.todayPrettyTimeLST+" "+newGetHourAmPm;
            } else if(dayNow>getDay) {
                var dayMinus = dayNow-getDay;
                if(dayMinus==1) {
                    var result = sintaskBahasa.yesterdayPrettyTimeLST+" "+newGetHourAmPm;
                } else {
                    var result = dayMinus+" "+sintaskBahasa.daysAgoPrettyTimeLST+" "+newGetHourAmPm; 
                }
            } else if(dayNow<getDay) {
                var dayMinus = (dayNow+7)-getDay; /* +7 Because 7 = 1 Week */
                if(dayMinus==1) {
                    var result = sintaskBahasa.yesterdayPrettyTimeLST+" "+newGetHourAmPm;
                } else {
                    var result = dayMinus+" "+sintaskBahasa.daysAgoPrettyTimeLST+" "+newGetHourAmPm; 
                }
            }
        } else if(exception=="realtimecontent") {
            var newDate = new Date();
            yearNow = newDate.getFullYear();

            var splitHour = getHourAmPm.split(":");
            var getSecAmPm = splitHour[2];
            var splitSec = getSecAmPm.split(" ");
            var newGetHourAmPm = splitHour[0]+":"+splitHour[1]+" "+splitSec[1];

            if(getYear==yearNow) {
                var result = getDayAlfabet+", "+getDate+" "+getMonthAlfabet+" "+newGetHourAmPm;
            } else {
                var result = getDayAlfabet+", "+getDate+" "+getMonthAlfabet+" "+getYear+" "+newGetHourAmPm;
            }
        }
    }

    return result;
}
sjqNoConflict.fn.realtimeTimeAgoP2 = function() {
    var thisId = this;
    var timeOldJsTen = sjqNoConflict(thisId).attr("real-timestamp");
    timeOldJsTen = timeOldJsTen.substr(0, 10);
    function timeOutRealtimeTimeAgo() {
        var timeNowJsTen = timeStampJsTenLocal();
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
                    var isYesterday = timeStampToHumanTimeP2(timeOldJsTen, "checkday");
                    theResult = thisHour+" "+hourAgo+" "+isYesterday;
                } else if(detik>=(60*60*24) && detik<(60*60*24*4)) {
                    theResult = timeStampToHumanTimeP2(timeOldJsTen, "dayago");
                } else {
                    theResult = timeStampToHumanTimeP2(timeOldJsTen, "realtimecontent");
                }
            }
        } else {
            theResult = timeStampToHumanTimeP2(timeOldJsTen, "realtimecontent");
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
        var timeNowJsTen = timeStampJsTenLocal();
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