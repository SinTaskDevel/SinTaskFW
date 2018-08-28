/* SINTASK FUNC JS */
/* sintask.func.js */
/* (c) 2016 - 2018 SinTask Webdev */
/* ------------------------- */

var publicFunction = function(ouput) {
    var ouput = ouput || 'default';
    return ouput;
}
var __SFWfunc = function(){
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

    /** REALTIME TIME-LIMIT [PART]
     * fn.realtimeTimeAgo = get timestamp from real-timestamp atribute on html element 
     * and translate it to human readable with 5s realtime interval
     */
    function timeStampToHumanTimeP2(timestampIn, exception) {
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

    /*_GET_RANDOM_VAL_*/
    /**
     * getRandomOnSinTask = Get random value from SinTask with 1 - Unlimited frame
     * 1 frame = 8 Digit.
     */
    function getRandomOnSinTask(maxFrame) {
        var return_ = Math.floor((Math.random() * 99999999) + 1);
        var frame = 0;
        if(maxFrame<=0) {
            maxFrame = 1;
        }
        while(frame<maxFrame) {
            return_ = return_+""+Math.floor((Math.random() * 99999999) + 1);
            frame = frame+1;
        }
        return return_;
    }
    /**
     * getBooleanRandom = Get random boolean value True/False
     */
    function getBooleanRandom() {
        return Math.random() >= 0.5;
    }
    /*_PHP_TO_JS_SCRIPT_*/
    /*_HTML_ESCAPE_PHPHTMLSPECIALCHARS_EQUIVALENT_*/
    /**
     * escapeHtml = Equivalent to PHP htmlspecialchars function
     */
    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
    /*_ADDSLASHES_JS_*/
    /**
     * addslashesJs = Equivalent to PHP addslashes function
     */
    function addslashesJs(str) {
        return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
    }
    /*_CTYPE_SPACE_PHP_JS_*/
    /**
     * ctypeSpace = Equivalent to PHP ctypeSpace function
     */
    function ctypeSpace(input) {
        return input.replace(/\s/g, '').length;
        /*Return 0 for false, return >0 true*/
    }
    function ctypeSpaceNewLine(input) {
        var returnVal = input.replace(/\s/g, '');
        returnVal = returnVal.replace(/\n/g, '');
        returnVal = returnVal.replace(/\r/g, '');
        returnVal = returnVal.replace(/\r\n/g, '');
        returnVal = returnVal.replace(/<br>/g, '');
        returnVal = returnVal.replace(/&nbsp;/g, '');

        return returnVal.length;
        /*Return 0 for false, return >0 true*/
    }
    function ctypeSpaceHtml(input) {
        return input.replace(/&nbsp;/g, '').length;
        /*Return 0 for false, return >0 true*/
    }

    function spaceFilterString(input) {
        var returnVal = input;

        returnVal = returnVal.replace(/&nbsp;/g, ' ');
        returnVal = returnVal.replace(/\s{2,}/g, ' ');

        return returnVal;
    }

    /**
     * wordCounter = Count word length
     */
    function wordCounter(input) {
        var returnVal = input;
        
        returnVal = returnVal.replace(/<br>/g, ' ');
        returnVal = returnVal.replace(/&nbsp;/g, ' ');

        returnVal = returnVal.replace(/\s{2,}/g, ' ');
        returnVal = returnVal.replace(/\n{2,}/g, ' ');
        returnVal = returnVal.replace(/\r{2,}/g, ' ');
        returnVal = returnVal.replace(/\r\n{2,}/g, ' ');
        
        var result = returnVal.split(" ").length;

        return result;
    }
    function stringCounter(input) {
        var returnVal = input;

        returnVal = returnVal.replace(/<br>/g, '');
        returnVal = returnVal.replace(/&nbsp;/g, '');

        returnVal = returnVal.replace(/\s{2,}/g, '');
        returnVal = returnVal.replace(/\n{2,}/g, '');
        returnVal = returnVal.replace(/\r{2,}/g, '');
        returnVal = returnVal.replace(/\r\n{2,}/g, '');

        var result = returnVal.length;

        return result;
    }
    /**
     * countEnter = Count enter contain from input
     */
    function countEnter(input) {
        var input = input || '';
        //return input.replace(/\r\n/g, '').length;
        return input.split(/<br>/g).length;
        /*Return 0 for false, return >0 true*/
    }
    
    /*_JS_TIMESTAMP_LOCALTIME_&_SERVERTIME_(DEVICE)_*/
    /**
     * timeStampJs{Complex} = Function will return timestamp from 10 - 13 Digit
     * There is 2 timestamp different get type :
     * local    = Local timestamp based on user device time.
     * srv      = Server timestamp based on server time ( with device time processing ).
     * ----------------------------------
     * if we use local, the time will malfunction on user change the device time, and
     *                  the device time maybe not real time now, 
     *                  and maybe not sync with the server time & user config time.
     *                  + Pros is more accurate than srv
     * ----------------------------------
     * if we use srv,   the time will sync with server time, even user change the device time, or
     *                  user device time is not real time now.
     *                  - Cons is less accurate than local
     * ----------------------------------
     * Long version of getTime + 10 digit
     *      ->  var date = new Date();
     *          var timestamp = Math.floor(date.getTime() / 1000);
     * -----------------------------------
     * Short version of getTime + 10 digit
     *      ->  var timestamp = Math.floor(Date.now() / 1000);
     * -----------------------------------
     */
    function timeStampJsLocal() {
        var configTime = "srv";
        /* Time choice is "local" and "srv" */
        if(configTime=="local") {
            var date = new Date();
            var timestamp = date.getTime();
        } else if(configTime=="srv") {
            var timestamp = __SFW_srvTime.timenow;
        }

        return timestamp;
    }
    function timeStampJsTenLocal() {
        var configTime = "srv";
        /* Time choice is "local" and "srv" */
        if(configTime=="local") {
            var date = new Date();
            var timestamp = Math.floor(date.getTime() / 1000);
        } else if(configTime=="srv") {
            var timestamp = __SFW_srvTime.timenowTen;
        }

        return timestamp;
    }
    function timeStampJs() {
        var timestamp = __SFW_srvTime.timenow;
        return timestamp;
    }
    function timeStampJsTen() {
        var timestamp = __SFW_srvTime.timenowTen;
        return timestamp;
    }
    /*_LOADING_TEMPLATE_*/
    function getLoading() {
        return "<div class=\"loading\"> <span class=\"l01\"><\/span> <span class=\"l02\"><\/span> <span class=\"l03\"><\/span> <span class=\"l04\"><\/span> <span class=\"l05\"><\/span> <div class=\"clearBoth\"> <\/div> <\/div>";
    }
    /*_END_PHP_TO_JS_SCRIPT_*/

    /*_DISABLE_&_ENABLE_TAG_INSIDE_*/
    /**
     * disable & enableTagInside = This function will disable html element until enable function run.
     */
    function disableTagInside(id) {
        sjqNoConflict(id).css("pointer-events", "none");
        sjqNoConflict(id).css("opacity", "0.4");
    }
    function enableTagInside(id) {
        sjqNoConflict(id).css("pointer-events", "");
        sjqNoConflict(id).css("opacity", "");
        sjqNoConflict(id).blur();
    }
    /*_SAVE_&_GET_COOKIES__USE_FOR_SAVE_INSENSITIVE_DATA_*/
    /**
     * get & saveSintCookies = This function will save & get SinTask cookies (modified cookies)
     */
    function saveSintCookies(sname, svalue, expiresDays) {
        var sname = sname;
        var svalue = svalue;
        var date = new Date();
        date.setTime(date.getTime() + (60000*60*24*expiresDays));
        var expires = "expires=" + date.toUTCString();
        document.cookie = sname+"="+svalue+"; "+expires;
    }
    function getSintCookies(sname) {
        var name = sname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return "";
    }
    function saveSintCookiesAdv(sname, svalue, expiresDays, domain) {
        var sname = sname;
        var svalue = svalue;
        var dateCtg = new Date();
        dateCtg.setTime(dateCtg.getTime() + (60000*60*24*expiresDays));
        var expiresCtg = "expiresCtg=" + dateCtg.toUTCString();
        document.cookie = sname+"="+svalue+"; "+expiresCtg+"; path=/; domain="+domain;
    }
    /** Bagian penting SinTaskFW untuk caching
     */
    function sCached() {
        var sAgainHead      = sjqNoConflict("again-script-head");
        var sAgainHeadLen   = sAgainHead.length;

        var sAgainFoot      = sjqNoConflict("again-script-foot");
        var sAgainFootLen   = sAgainFoot.length;

        var prefixHead  = "sCachedSinTaskFWhead";
        var prefixFoot  = "sCachedSinTaskFWfoot";
        
        var it          = 0;
        var jt          = 0;

        sessionStorage[prefixHead] = "";
        sessionStorage[prefixFoot] = "";

        function getTheScriptHead(it) {
            var srcNow  = sAgainHead.eq(it).attr("src");

            sjqNoConflict.ajax({
                type: "GET",
                cache: true,
                dataType: "text",
                url: srcNow,
                success: function (data) {
                    sessionStorage[prefixHead] += data;

                    it = it+1;
                    if(it < sAgainHeadLen) {
                        getTheScriptHead(it);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    /*NOTHING*/
                }
            });
        }
        function getTheScriptFoot(jt) {
            var srcNow  = sAgainFoot.eq(jt).attr("src");

            sjqNoConflict.ajax({
                type: "GET",
                cache: true,
                dataType: "text",
                url: srcNow,
                success: function (data) {
                    sessionStorage[prefixFoot] += data;

                    jt = jt+1;
                    if(jt < sAgainFootLen) {
                        getTheScriptFoot(jt);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    /*NOTHING*/
                }
            });
        }

        getTheScriptHead(it);
        getTheScriptFoot(jt);
    }
    /**
     * displayCountArrayContent = Return array how many same value on array().
     * e.g.     : array = [2, 5, 3, 2, 5, 3, 6, 1, 9]
     * result   :    a  = [1, 2, 3, 5, 6, 9];
     *               b  = [1, 2, 2, 2, 1, 1];
     */
    function displayCountArrayContent(arr) {
        var a = [], b = [], prev;
        
        arr.sort();
        for(var i = 0; i < arr.length; i++) {
            if(arr[i] !== prev) {
                a.push(arr[i]);
                b.push(1);
            } else {
                b[b.length-1]++;
            }
            prev = arr[i];
        }
        
        return [a, b];
    }
    /*_FILE_SIZE_MB_AND_KB_FROM_BYTE*/
    /**
     * fromByte = translate Byte to KiloByte and MegaByte human readable.
     */
    function fromByte(bytefilesize) {
        var thisBytes = bytefilesize;
        var thisFixed = 2;

        thisBytes = parseInt(thisBytes);
        thisFixed = parseInt(thisFixed);

        var stdBytes = 1024;
        var byteName = ["B", "KB", "MB", "GB", "TB", "PB"];
        var byteState = 0;

        var feedReturn = 0;

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
                feedReturn = finalBytes;
            }
        }
        translateBytes();

        return feedReturn;
    }

    /*_END_PHP_EQUIVALEN_*/
    function endJs(input) {
        var inputlen = input.length;
        return input[inputlen-1];
    }

    /*_EXPLODE_PHP_EQUIVALEN_*/
    function explodeJs(input, separator) {
        return input.toString().split(separator);
    }

    /*_POW_PHP_EQUIVALEN_*/
    function powJs(base, exponent) {
        return Math.pow(base, exponent);
    }

    /*_SUBSTR_PHP_EQUIVALEN_*/
    function subStringJs(input, start, long) {
        return input.toString().substr(start, long);
    }

    /*_STR_REPLACE_PHP_EQUIVALEN_*/
    function strReplaceJs(search, replace, input) {
        var regex = new RegExp(search, 'g');
        return input.toString().replace(regex, replace);
    }

    /*_NUMER_FORMAT_PHP_EQUIVALEN_*/
    /* BUG */
    function numberFormatJs(input, tofixed, separator, separatorTwo) {
        var tofixed = tofixed || 2;
        var separator = separator || ",";
        var separatorTwo = separatorTwo || ".";

        input = parseFloat(input).toFixed(tofixed);
        input = input.toString();
        var nstr = input.split(".");
        var strmod = nstr[0];
        var nstrmod = strmod.split("");
        var result = "";

        nstrmod.reverse();

        for(var a = 0; a < nstrmod.length; a++) {
            if(nstrmod[a] != null && nstrmod[a] != "") {
                if(a % 3 == 0 && a != 0) {
                    result = nstrmod[a]+separatorTwo+result;
                } else {
                    result = nstrmod[a]+result;
                }
            }
        }
        
        if(nstr[1] == null) {
            return result;
        } else {
            return result+separator+nstr[1];
        }
    }

    /*_GET_FORMAT_FROM_NAME_OF_FILE_*/
    /**
     * formatFromFileName = get the extension of file from filename
     * e.g. : - sintask_text.txt = .txt 
     *        - sintask.style.css = .css
     * all file extension name to lower case .CSS -> .css or .CsS -> .css; etc.
     */
    function formatFromFileName(input, tolower) {
        var input = input;
        var inputSplit = input.split(".");
        var inputLen = inputSplit.length;
        var inputLenMin = inputLen-1;
        if(tolower==1) {
            var result = inputSplit[inputLenMin].toLowerCase();
        } else if(tolower==2) {
            var result = inputSplit[inputLenMin].toUpperCase();
        } else {
            var result = inputSplit[inputLenMin];
        }
        return result;
    }

    /*_COPY_ELEMENT_*/
    /**
     * copyToClipboard = copy to clipboard command execution
     */
    function copyToClipboard(elem) {
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;

        if (isInput) {
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }

        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch(e) {
            succeed = false;
        }

        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            target.textContent = "";
        }

        return succeed;
    }

    /**
     * fadeContentOne = FadePopUpContent in the footer of web (fixed css position)
     */
    function fadeContentOne(message, fadeTime, status) {
        if(status == "show") {
            var checkContent = sjqNoConflict("#typeOneFadeContent").length;
            var templateBegin = "<div id=\"typeOneFadeContent\" class=\"fadeContentFooter\" style=\"display: none;\"><div id=\"fadeContentFooterChild\" class=\"fadeContentFooterChild\">";
            var templateEnd = "<\/div><\/div>";
            if(checkContent<1) {
                sjqNoConflict("#fadeContentOne").html(templateBegin+message+templateEnd);
                setTimeout(function(){
                    sjqNoConflict("#typeOneFadeContent").fadeIn(fadeTime);
                },fadeTime);
            } else {
                sjqNoConflict("#fadeContentFooterChild").html(message);
            }
        } else if(status == "hide") {
            sjqNoConflict("#typeOneFadeContent").fadeOut(fadeTime);
            setTimeout(function(){
                sjqNoConflict("#fadeContentOne").html("");
            },fadeTime);
        }
    }

    /**
     * fadeContentTwo = FadePopUpContent in the footer of web (fixed css position), with timer
     */
    var __SFW_fadeContentTwoTimeout;
    function fadeContentTwo(message, status, hideIn) {
        var fadeTime = 200;

        message = message.toString();
        
        if(status == "show") {
            clearTimeout(__SFW_fadeContentTwoTimeout);
            
            var checkContent = sjqNoConflict("#typeOneFadeContent").length;
            var templateBegin = "<div id=\"typeOneFadeContent\" class=\"fadeContentFooter\" style=\"display: none;\"><div id=\"fadeContentFooterChild\" class=\"fadeContentFooterChild\">";
            var templateEnd = "<\/div><\/div>";
            if(checkContent < 1) {
                sjqNoConflict("#fadeContentOne").html(templateBegin+""+message+""+templateEnd);
                setTimeout(function(){
                    sjqNoConflict("#typeOneFadeContent").fadeIn(fadeTime);
                },fadeTime);
            } else {
                sjqNoConflict("#fadeContentFooterChild").html(message);
            }
            
            if(hideIn > 0) {
                __SFW_fadeContentTwoTimeout = setTimeout(function(){
                    sjqNoConflict("#typeOneFadeContent").fadeOut(fadeTime);
                    setTimeout(function(){
                        sjqNoConflict("#fadeContentOne").html("");
                    },fadeTime);
                }, hideIn);
            }
        } else if(status == "hide") {
            sjqNoConflict("#typeOneFadeContent").fadeOut(fadeTime);
            setTimeout(function(){
                sjqNoConflict("#fadeContentOne").html("");
            },fadeTime);
        }
    }

    /**
     * Alias Toast1 & 2
     */
    function toastOne(message, fadeTime, status) {
        fadeContentOne(message, fadeTime, status);
    }
    function toastTwo(message, status, hideIn) {
        fadeContentTwo(message, status, hideIn);
    }

    /**
     * PopUp SinTaskFW Default
     */
    function popUpOne(data) {
        sjqNoConflict("#fadeContentTwo").html("");

        var data            = data || [];

        var title           = data.title || "";
        var message         = data.message || "";
        var yes             = data.yesButton || "";
        var no              = data.noButton || "";
        var onYes           = data.onYes || "";
        var onNo            = data.onNo || "";
        var onOuterClick    = data.onOuterClick || "";
        var animationFade   = data.animationFade || "";
        var callback        = data.callback || "";

        var removePopUpMethod = "";
        var shownPopUpMethod = "";
        if(animationFade == true) {
            removePopUpMethod = "__SFW_f.removePopUpFade";
            shownPopUpMethod = ""+
            "setTimeout(function(){"+
                "sjqNoConflict(\"#popUpFadeInPar\").fadeIn(200);"+
                "sjqNoConflict(\"#popUpFadeInChild\").fadeIn(400);"+
            "},100);";
        } else {
            removePopUpMethod = "__SFW_f.removePopUp";
            shownPopUpMethod = ""+
            "sjqNoConflict(\"#popUpFadeInPar\").show();"+
            "sjqNoConflict(\"#popUpFadeInChild\").show();";
        }

        var outerClickScript = "";
        if(onOuterClick == "hide") {
            outerClickScript = "__SFW_f.sintaskHideNotParamClicked('#popUpFadeInChild', "+removePopUpMethod+", 500);";
        }

        var templatePopUpOne = ""+
        "<div id=\"popUpFadeInPar\" class=\"popUpFadeIn\" style=\"display: none;\"><\/div>"+
        "<div id=\"popUpFadeInChild\" class=\"popUpFadeInContent\" style=\"display: none;\">"+
            "<div class=\"popUpFadeInContentChild_3 ft_style_b\">"+ 
                "<div id=\"closePopUpFadeInTwo\" class=\"deleteOrCloseIcon c_pointer\"><\/div>"+
            "<\/div>"+
            "<div class=\"popUpFadeInContentChild_1 ft_style_b fontSize20px\">"+ 
                title+ 
            "<\/div>"+
            "<div class=\"popUpFadeInContentChild_0\">"+
                message+
            "<\/div>"+
            "<div class=\"popUpFadeInContentChild_2\">"+ 
                "<div class=\"optionArea\">"+ 
                    "<button id=\"onYesPopUp\" class=\"unSelectAble sintaskButtonDefaultColorYes\">"+yes+"<\/button>"+ 
                    "<button id=\"onNoPopUp\" class=\"unSelectAble sintaskButtonDefaultColorNo\">"+no+"<\/button>"+
                    "<div class=\"clearBoth\"><\/div>"+
                "<\/div>"+
            "<\/div>"+
        "<\/div>"+
        "<script>"+
            shownPopUpMethod+
            "sjqNoConflict('#closePopUpFadeInTwo').on('click', "+removePopUpMethod+");"+
            outerClickScript+
        "<\/script>"+
        "";

        var shownStatus = true;

        if(title == "" || ctypeSpace(title) < 1) {
            shownStatus = false;
        }

        if(message == "" || ctypeSpace(message) < 1) {
            shownStatus = false;
        }

        if(yes == "" || ctypeSpace(yes) < 1) {
            shownStatus = false;
        }

        if(no == "" || ctypeSpace(no) < 1) {
            shownStatus = false;
        }

        if(shownStatus == true) {
            sjqNoConflict("#headerStayContentSinTask").css("filter", "blur(3px)");
            sjqNoConflict("#freeContentSinTask").css("filter", "blur(3px)");
            sjqNoConflict("#stayContentSinTask").css("filter", "blur(3px)");
            sjqNoConflict("#footerStayContentSinTask").css("filter", "blur(3px)");
            sjqNoConflict("#fadeContentTwo").html(templatePopUpOne);
            sjqNoConflict("body").css("overflow-y", "hidden");
            sjqNoConflict("body").css("width", "98.8%");
            sjqNoConflict("#popUpFadeInPar").css("overflow-y", "scroll");

            sjqNoConflict(document).off("click", "#onYesPopUp");
            sjqNoConflict(document).off("click", "#onNoPopUp");

            if(typeof onYes != "undefined" && onYes != "" && onYes) {
                if(typeof onYes == "function") {
                    sjqNoConflict(document).on("click", "#onYesPopUp", onYes);
                }
            }

            if(typeof onNo == "undefined" || onNo == "" || !onNo) {
                if(animationFade == true) {
                    sjqNoConflict(document).on("click", "#onNoPopUp", removePopUpFade);
                } else {
                    sjqNoConflict(document).on("click", "#onNoPopUp", removePopUp);
                }
            } else {
                if(typeof onNo == "function") {
                    sjqNoConflict(document).on("click", "#onNoPopUp", onNo);
                    sjqNoConflict(document).on("click", "#closePopUpFadeInTwo", onNo);
                }
            }

            if(typeof callback == "function") {
                callback();
            }
        }
    }

    /**
     * PopUp SinTaskFW Default (with single choice "OK")
     */
    function popUpTwo(data) {
        sjqNoConflict("#fadeContentTwo").html("");

        var data            = data || [];

        var title           = data.title || "";
        var message         = data.message || "";
        var ok              = data.okButton || "";
        var onOk            = data.onOk || "";
        var onOuterClick    = data.onOuterClick || "";
        var animationFade   = data.animationFade || "";
        var callback        = data.callback || "";

        var removePopUpMethod = "";
        var shownPopUpMethod = "";
        if(animationFade == true) {
            removePopUpMethod = "__SFW_f.removePopUpFade";
            shownPopUpMethod = ""+
            "setTimeout(function(){"+
                "sjqNoConflict(\"#popUpFadeInPar\").fadeIn(200);"+
                "sjqNoConflict(\"#popUpFadeInChild\").fadeIn(400);"+
            "},100);";
        } else {
            removePopUpMethod = "__SFW_f.removePopUp";
            shownPopUpMethod = ""+
            "sjqNoConflict(\"#popUpFadeInPar\").show();"+
            "sjqNoConflict(\"#popUpFadeInChild\").show();";
        }

        var outerClickScript = "";
        if(onOuterClick == "hide") {
            outerClickScript = "__SFW_f.sintaskHideNotParamClicked('#popUpFadeInChild', "+removePopUpMethod+", 500);";
        }

        var templatePopUpOne = ""+
        "<div id=\"popUpFadeInPar\" class=\"popUpFadeIn\" style=\"display: none;\"><\/div>"+
        "<div id=\"popUpFadeInChild\" class=\"popUpFadeInContent\" style=\"display: none;\">"+
            "<div class=\"popUpFadeInContentChild_3 ft_style_b\">"+ 
            "<\/div>"+
            "<div class=\"popUpFadeInContentChild_1 ft_style_b fontSize20px\">"+ 
                title+ 
            "<\/div>"+
            "<div class=\"popUpFadeInContentChild_0\">"+
                message+
            "<\/div>"+
            "<div class=\"popUpFadeInContentChild_2\">"+ 
                "<div class=\"optionArea\">"+ 
                    "<button id=\"onOkPopUp\" class=\"unSelectAble sintaskButtonDefaultColorOk\">"+ok+"<\/button>"+ 
                    "<div class=\"clearBoth\"><\/div>"+
                "<\/div>"+
            "<\/div>"+
        "<\/div>"+
        "<script>"+
            shownPopUpMethod+
            outerClickScript+
        "<\/script>"+
        "";

        var shownStatus = true;

        if(title == "" || ctypeSpace(title) < 1) {
            shownStatus = false;
        }

        if(message == "" || ctypeSpace(message) < 1) {
            shownStatus = false;
        }

        if(ok == "" || ctypeSpace(ok) < 1) {
            shownStatus = false;
        }

        if(shownStatus == true) {
            sjqNoConflict("#headerStayContentSinTask").css("filter", "blur(3px)");
            sjqNoConflict("#freeContentSinTask").css("filter", "blur(3px)");
            sjqNoConflict("#stayContentSinTask").css("filter", "blur(3px)");
            sjqNoConflict("#footerStayContentSinTask").css("filter", "blur(3px)");
            sjqNoConflict("#fadeContentTwo").html(templatePopUpOne);
            sjqNoConflict("body").css("overflow-y", "hidden");
            sjqNoConflict("body").css("width", "98.8%");
            sjqNoConflict("#popUpFadeInPar").css("overflow-y", "scroll");

            sjqNoConflict(document).off("click", "#onOkPopUp");

            if(typeof onOk == "undefined" || onOk == "" || !onOk) {
                if(animationFade == true) {
                    sjqNoConflict(document).on("click", "#onOkPopUp", removePopUpFade);
                } else {
                    sjqNoConflict(document).on("click", "#onOkPopUp", removePopUp);
                }
            } else {
                function onOkChild() {
                    onOk();
                    if(animationFade == true) {
                        removePopUpFade();
                    } else {
                        removePopUp();
                    }
                }
                
                if(typeof onOk == "function") {
                    sjqNoConflict(document).on("click", "#onOkPopUp", onOkChild);
                }
            }

            if(typeof callback == "function") {
                callback();
            }
        }
    }

    /**
     * Remove PopUp SinTaskFW Default
     */
    function removePopUp(callback) {
        var callback    = callback || "";

        sjqNoConflict("#headerStayContentSinTask").css("filter", "");
        sjqNoConflict("#freeContentSinTask").css("filter", "");
        sjqNoConflict("#stayContentSinTask").css("filter", "");
        sjqNoConflict("#footerStayContentSinTask").css("filter", "");
        sjqNoConflict("#fadeContentTwo").html("");
        sjqNoConflict("body").css("overflow-y", "");
        sjqNoConflict("body").css("width", "");
        sjqNoConflict("#popUpFadeInPar").css("overflow-y", "");

        if(typeof callback == "function") {
            callback();
        }
    }

    /**
     * Remove PopUp FadeOut SinTaskFW Default
     */
    function removePopUpFade(callback) {
        var callback    = callback || "";

        sjqNoConflict("#headerStayContentSinTask").css("filter", "");
        sjqNoConflict("#freeContentSinTask").css("filter", "");
        sjqNoConflict("#stayContentSinTask").css("filter", "");
        sjqNoConflict("#footerStayContentSinTask").css("filter", "");
        sjqNoConflict("body").css("overflow-y", "");
        sjqNoConflict("body").css("width", "");
        sjqNoConflict("#popUpFadeInPar").css("overflow-y", "");

        function deletionPopUp() {
            sjqNoConflict("#fadeContentTwo").html("");

            if(typeof callback == "function") {
                callback();
            }
        }

        sjqNoConflict("#popUpFadeInPar").fadeOut(200);
        sjqNoConflict("#popUpFadeInChild").fadeOut(400, "swing", deletionPopUp);  
    }

    /**
     * Sintask Alert - stalert
     */
    function stalertInit() {
        var __SFW_stalertQueue = [];
        var __SFW_stalertStatus = 0;

        function stalertStart(message) {
            var message = message || "";

            if(__SFW_stalertStatus == 0) {
                popUpTwo({
                    title: location.hostname+" - Alert", 
                    message: "<div class='fontSize18px'>"+message+"<\/div>", 
                    okButton: "Ok",
                    onOk: function(){
                        removePopUp(function(){
                            __SFW_stalertStatus = 0;

                            if(__SFW_stalertQueue.length > 0) {
                                var tempStalertContent = __SFW_stalertQueue[0]; 
                                setTimeout(function(){
                                    stalertStart(tempStalertContent);
                                },100);
                                __SFW_stalertQueue.shift();
                            }
                        });
                    },
                    onOuterClick: false,
                    animationFade: true,
                    callback: function(){
                        __SFW_stalertStatus = 1;
                    }
                });
            } else {
                __SFW_stalertQueue.push(message);
            }
        }

        return {
            stalertStart: stalertStart
        };
    }

    var __SFW_stalert = stalertInit();
    function stalert(message) {
        __SFW_stalert.stalertStart(message);
        return true;
    }

    /**
     * Hiding where is not 'param' (HTML Tag/Element) is clicked
     * or Hide the 'param' where is not 'param' clicked
     */
    function sintaskHideNotParamClicked(param, callback, fadeTime) {
        sjqNoConflict(document).mouseup(function (e) {
            if(param != null && typeof param != "undefined" && param != "") {
                var popUpName = sjqNoConflict(param);
                if (!sjqNoConflict(param).is(e.target) && !popUpName.is(e.target) && popUpName.has(e.target).length == 0) {
                    if(callback && callback != "" && typeof callback != "undefined") {
                        callback();
                    } else {
                        popUpName.hide(fadeTime);
                    }
                    param = null;
                }
            }
        });
    }

    /**
     * Convert from base64 image -> blob
     */
    function base64ToBlob(base64, mime) {
        mime = mime || '';
        var sliceSize = 1024;
        var byteChars = window.atob(base64);
        var byteArrays = [];

        for (var offset = 0, len = byteChars.length; offset < len; offset += sliceSize) {
            var slice = byteChars.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

        return new Blob(byteArrays, {type: mime});
    }

    function sintaskResetFormat(id) {
        document.querySelector(id).addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertTEXT", false, text);
        });
    }

    /*  Get from https://stackoverflow.com/a/26809125
     *  JS Version Browser Support
     *  @author = https://stackoverflow.com/users/4228427/dmitrys (DimitryS)
     *  --------------------------
     *  Modified by Sintask Web Dev
     */
    this.jsv = {
        versions: [
            "1.1", "1.2", "1.3", "1.4", "1.5", "1.6", "1.7", "1.8", "1.9", "+1.9"
        ],
        version: ""
    };

    function getJsVersion() {
        var headElem = document.getElementsByTagName("script");
        var headElemLen = headElem.length;

        if(headElemLen > 0) {
            for (i = 0; i < jsv.versions.length; i++) {
                var createElem = document.createElement('script'),
                    tagHolder = document.getElementsByTagName('script')[0];

                createElem.setAttribute("language", "JavaScript" + jsv.versions[i]);
                createElem.text = "this.jsv.version = '"+jsv.versions[i]+"';";
                tagHolder.parentNode.insertBefore(createElem, tagHolder);

                /* Redefine and Remove <script> */
                var tagHolder2 = document.getElementsByTagName('script')[0];
                tagHolder2.parentNode.removeChild(tagHolder2);
            }
        } else {
            var jsVersion = "<script> tag not found";
        }

        var jsVersion = jsv.version;

        return {
            jsVersion: jsVersion
        };
    }

    return {
        timeStampToHumanTimeP2: timeStampToHumanTimeP2,
        getRandomOnSinTask: getRandomOnSinTask,
        getBooleanRandom: getBooleanRandom,
        escapeHtml: escapeHtml,
        addslashes: addslashesJs,
        addslashesJs: addslashesJs,
        ctypeSpace: ctypeSpace,
        ctypeSpaceNewLine: ctypeSpaceNewLine,
        ctypeSpaceHtml: ctypeSpaceHtml,
        spaceFilterString: spaceFilterString,
        wordCounter: wordCounter,
        stringCounter: stringCounter,
        countEnter: countEnter,
        timeStampJsTenLocal: timeStampJsTenLocal,
        timeStampJsLocal: timeStampJsLocal,
        timeStampJs: timeStampJs,
        timeStampJsTen: timeStampJsTen,
        getLoading: getLoading,
        disableTagInside: disableTagInside,
        enableTagInside: enableTagInside,
        saveSintCookies: saveSintCookies,
        getSintCookies: getSintCookies,
        saveSintCookiesAdv: saveSintCookiesAdv,
        sCached: sCached,
        displayCountArrayContent: displayCountArrayContent,
        fromByte: fromByte,
        end: endJs,
        endJs: endJs,
        explode: explodeJs,
        explodeJs: explodeJs,
        pow: powJs,
        powJs: powJs,
        subString: subStringJs,
        subStringJs: subStringJs,
        strReplace: strReplaceJs,
        strReplaceJs: strReplaceJs,
        numberFormat: numberFormatJs,
        numberFormatJs: numberFormatJs,
        formatFromFileName: formatFromFileName,
        copyToClipboard: copyToClipboard,
        toastOne: toastOne,
        toastTwo: toastTwo,
        popUpOne: popUpOne,
        popUpTwo: popUpTwo,
        removePopUp: removePopUp,
        removePopUpFade: removePopUpFade,
        stAlert: stalert,
        stalert: stalert,
        sintaskHideNotParamClicked: sintaskHideNotParamClicked,
        base64ToBlob: base64ToBlob,
        sintaskResetFormat: sintaskResetFormat,
        getJsVersion: getJsVersion
    }
}

var __SFW_f = __SFWfunc();