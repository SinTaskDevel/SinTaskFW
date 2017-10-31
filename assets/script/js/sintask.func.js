/* SINTASK FUNC JS */
/* sintask.func.js */
/* (c) 2016 - SinTask Webdev */
/* ------------------------- */

/**
 * Initiate var
 */
var mobileDeviceDetect = false;

/*_GET_RANDOM_VAL_*/
/**
 * getRandomOnSinTask = Get random value from SinTask with 1 - Unlimited frame
 * 1 frame = 8 Digit.
 */
getRandomOnSinTask = function(maxFrame) {
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
getBooleanRandom = function() {
    return Math.random() >= 0.5;
}
/*_PHP_TO_JS_SCRIPT_*/
/*_HTML_ESCAPE_PHPHTMLSPECIALCHARS_EQUIVALENT_*/
/**
 * escapeHtml = Equivalent to PHP htmlspecialchars function
 */
escapeHtml = function(text) {
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
addslashesJs = function(str) {
    return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}
/*_CTYPE_SPACE_PHP_JS_*/
/**
 * ctypeSpace = Equivalent to PHP ctypeSpace function
 */
ctypeSpace = function(input) {
    return input.replace(/\s/g, '').length;
    /*Return 0 for false, return >0 true*/
}
ctypeSpaceNewLine = function(input) {
    var returnVal = input.replace(/\s/g, '');
    returnVal = returnVal.replace(/\n/g, '');
    returnVal = returnVal.replace(/\r/g, '');
    returnVal = returnVal.replace(/\r\n/g, '');
    returnVal = returnVal.replace(/<br>/g, '');
    returnVal = returnVal.replace(/&nbsp;/g, '');

    return returnVal.length;
    /*Return 0 for false, return >0 true*/
}
ctypeSpaceHtml = function(input) {
    return input.replace(/&nbsp;/g, '').length;
    /*Return 0 for false, return >0 true*/
}

spaceFilterString = function(input) {
    var returnVal = input;

    returnVal = returnVal.replace(/&nbsp;/g, ' ');
    returnVal = returnVal.replace(/\s{2,}/g, ' ');

    return returnVal;
}

/**
 * wordCounter = Count word length
 */
wordCounter = function(input) {
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
stringCounter = function(input) {
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
countEnter = function(input = '') {
    //return input.replace(/\r\n/g, '').length;
    return input.split(/<br>/g).length;
    /*Return 0 for false, return >0 true*/
}
publicFunction = function(ouput = 'default') {
    return ouput;
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
timeStampJsLocal = function() {
    var configTime = "srv";
    /* Time choice is "local" and "srv" */
    if(configTime=="local") {
        var date = new Date();
        var timestamp = date.getTime();
    } else if(configTime=="srv") {
        var timestamp = srvTime.timenow;
    }

    return timestamp;
}
timeStampJsTenLocal = function() {
    var configTime = "srv";
    /* Time choice is "local" and "srv" */
    if(configTime=="local") {
        var date = new Date();
        var timestamp = Math.floor(date.getTime() / 1000);
    } else if(configTime=="srv") {
        var timestamp = srvTime.timenowTen;
    }

    return timestamp;
}
timeStampJs = function() {
    var timestamp = srvTime.timenow;
    return timestamp;
}
timeStampJsTen = function() {
    var timestamp = srvTime.timenowTen;
    return timestamp;
}
/*_LOADING_TEMPLATE_*/
getLoading = function() {
    return "<div class=\"loading\"> <span class=\"l01\"><\/span> <span class=\"l02\"><\/span> <span class=\"l03\"><\/span> <span class=\"l04\"><\/span> <span class=\"l05\"><\/span> <div class=\"clearBoth\"> <\/div> <\/div>";
}
/*_END_PHP_TO_JS_SCRIPT_*/

/*_DISABLE_&_ENABLE_TAG_INSIDE_*/
/**
 * disable & enableTagInside = This function will disable html element until enable function run.
 */
disableTagInside = function(id) {
    sjqNoConflict(id).css("pointer-events", "none");
    sjqNoConflict(id).css("opacity", "0.4");
}
enableTagInside = function(id) {
    sjqNoConflict(id).css("pointer-events", "");
    sjqNoConflict(id).css("opacity", "");
    sjqNoConflict(id).blur();
}
/*_SAVE_&_GET_COOKIES__USE_FOR_SAVE_INSENSITIVE_DATA_*/
/**
 * get & saveSintCookies = This function will save & get SinTask cookies (modified cookies)
 */
saveSintCookies = function(sname, svalue, expiresDays) {
    var sname = sname;
    var svalue = svalue;
    var date = new Date();
    date.setTime(date.getTime() + (60000*60*24*expiresDays));
    var expires = "expires=" + date.toUTCString();
    document.cookie = sname+"="+svalue+"; "+expires;
}
getSintCookies = function(sname) {
    var name = sname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
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
saveSintCookiesAdv = function(sname, svalue, expiresDays, domain) {
    var sname = sname;
    var svalue = svalue;
    var dateCtg = new Date();
    dateCtg.setTime(dateCtg.getTime() + (60000*60*24*expiresDays));
    var expiresCtg = "expiresCtg=" + dateCtg.toUTCString();
    document.cookie = sname+"="+svalue+"; "+expiresCtg+"; path=/; domain="+domain;
}
/**
 * displayCountArrayContent = Return array how many same value on array().
 * e.g.     : array = [2, 5, 3, 2, 5, 3, 6, 1, 9]
 * result   :    a  = [1, 2, 3, 5, 6, 9];
 *               b  = [1, 2, 2, 2, 1, 1];
 */
displayCountArrayContent = function(arr) {
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
fromByte = function(bytefilesize) {
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
        if(thisBytes>stdBytes && byteState<byteName.length-1) {
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
endJs = function(input) {
    var inputlen = input.length;
    return input[inputlen-1];
}

/*_EXPLODE_PHP_EQUIVALEN_*/
explodeJs = function(input, separator) {
    return input.toString().split(separator);
}

/*_POW_PHP_EQUIVALEN_*/
powJs = function(base, exponent) {
    return Math.pow(base, exponent);
}

/*_SUBSTR_PHP_EQUIVALEN_*/
subStringJs = function(input, start, long) {
    return input.toString().substr(start, long);
}

/*_STR_REPLACE_PHP_EQUIVALEN_*/
strReplaceJs = function(search, replace, input) {
	var regex = new RegExp(search, 'g');
	return input.toString().replace(regex, replace);
}

/*_NUMER_FORMAT_PHP_EQUIVALEN_*/
/* BUG */
numberFormatJs = function(input, tofixed = 2, separator = ",", separatorTwo = ".") {
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
formatFromFileName = function(input, tolower) {
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
copyToClipboard = function(elem) {
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

/*MOBILE_DETECTION*/
/**
 * mobileDeviceDetect variable = if user open SinTask from Mobile Device,
 * we will show the PopUp instruction
 */
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    mobileDeviceDetect = true;
}
if(mobileDeviceDetect==true) {
    fadeContentOne("Web is not optimal, open mobile web version", 200, "show");
}

/**
 * fadeContentOne = FadePopUpContent in the footer of web (fixed css position)
 */
fadeContentOne = function(message, fadeTime, status) {
    if(status=="show") {
        var checkContent = sjqNoConflict("#typeOneFadeContent").length;
        var templateBegin = "<div id=\"typeOneFadeContent\" class=\"fadeContentFooter\" style=\"display: none;\"><div class=\"fadeContentFooterChild\">";
        var templateEnd = "<\/div><\/div>";
        if(checkContent<1) {
            sjqNoConflict("#fadeContentOne").html(templateBegin+message+templateEnd);
            setTimeout(function(){
                sjqNoConflict("#typeOneFadeContent").fadeIn(fadeTime);
            },fadeTime);
        } else {
            sjqNoConflict("#fadeContentFooterChild").html(message);
        }
    } else if(status=="hide") {
        sjqNoConflict("#typeOneFadeContent").fadeOut(fadeTime);
        setTimeout(function(){
            sjqNoConflict("#fadeContentOne").html("");
        },fadeTime);
    }
}
/**
 * Convert from base64 image -> blob
 */
base64ToBlob = function(base64, mime) {
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