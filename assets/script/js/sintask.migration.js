/**
 * Sintask Migration - sintask.func.js
 * For SintaskFW 1.3.4+ (upgrade to 1.3.4+ from version 1.3.3 or bellow)
 * ----
 * Note for 1.3.3 or bellow :
 *  - Open your myassets/_php/my.core.php
 *  - Add on variable $__MY_CORE__ : key "MIGRATION_SCRIPT" and give boolean value TRUE
 */
function changingPageSPA(input) {
    return __SFW_spa.changingPageSPA(input);
}
function getRandomOnSinTask(maxFrame) {
    return __SFW_f.getRandomOnSinTask(maxFrame);
}
function getBooleanRandom() {
    return __SFW_f.getBooleanRandom()
}
function escapeHtml(text) {
    return __SFW_f.escapeHtml(text)
}
function addslashesJs(str) {
    return __SFW_f.addslashesJs(str)
}
function ctypeSpace(input) {
    return __SFW_f.ctypeSpace(input)
}
function ctypeSpaceNewLine(input) {
    return __SFW_f.ctypeSpaceNewLine(input);
}
function ctypeSpaceHtml(input) {
    return __SFW_f.ctypeSpaceHtml(input)
}
function spaceFilterString(input) {
    return __SFW_f.spaceFilterString(input)
}
function wordCounter(input) {
    return __SFW_f.wordCounter(input)
}
function stringCounter(input) {
    return __SFW_f.stringCounter(input)
}
function countEnter(input) {
    return __SFW_f.countEnter(input)
}
function timeStampJsLocal() {
    return __SFW_f.timeStampJsLocal()
}
function timeStampJsTenLocal() {
    return __SFW_f.timeStampJsTenLocal()
}
function timeStampJs() {
    return __SFW_f.timeStampJs()
}
function timeStampJsTen() {
    return __SFW_f.timeStampJsTen()
}
function getLoading() {
    return __SFW_f.getLoading()
}
function disableTagInside(id) {
    return __SFW_f.disableTagInside(id)
}
function enableTagInside(id) {
    return __SFW_f.enableTagInside(id)
}
function saveSintCookies(sname, svalue, expiresDays) {
    return __SFW_f.saveSintCookies(sname, svalue, expiresDays)
}
function getSintCookies(sname) {
    return __SFW_f.getSintCookies(sname)
}
function saveSintCookiesAdv(sname, svalue, expiresDays, domain) {
    return __SFW_f.saveSintCookiesAdv(sname, svalue, expiresDays, domain)
}
function sCached() {
    return __SFW_f.sCached()
}
function displayCountArrayContent(arr) {
    return __SFW_f.displayCountArrayContent(arr)
}
function fromByte(bytefilesize) {
    return __SFW_f.fromByte(bytefilesize)
}
function endJs(input) {
    return __SFW_f.endJs(input)
}
function explodeJs(input, separator) {
    return __SFW_f.explodeJs(input, separator)
}
function powJs(base, exponent) {
    return __SFW_f.powJs(base, exponent)
}
function subStringJs(input, start, long) {
    return __SFW_f.subStringJs(input, start, long)
}
function strReplaceJs(search, replace, input) {
    return __SFW_f.strReplaceJs(search, replace, input)
}
function numberFormatJs(input, tofixed, separator, separatorTwo) {
    return __SFW_f.numberFormatJs(input, tofixed, separator, separatorTwo)
}
function formatFromFileName(input, tolower) {
    return __SFW_f.formatFromFileName(input, tolower)
}
function copyToClipboard(elem) {
    return __SFW_f.copyToClipboard(elem)
}
function fadeContentOne(message, fadeTime, status) {
    return __SFW_f.toastOne(message, fadeTime, status)
}
function fadeContentTwo(message, status, hideIn) {
    return __SFW_f.toastTwo(message, status, hideIn)
}
function toastOne(message, fadeTime, status) {
    return __SFW_f.toastOne(message, fadeTime, status)
}
function toastTwo(message, status, hideIn) {
    return __SFW_f.toastTwo(message, status, hideIn)
}
function popUpOne(data) {
    return __SFW_f.popUpOne(data)
}
function popUpTwo(data) {
    return __SFW_f.popUpTwo(data)
}
function removePopUp(callback) {
    return __SFW_f.removePopUp(callback)
}
function removePopUpFade(callback) {
    return __SFW_f.removePopUpFade(callback)
}
function stalert(message) {
    return __SFW_f.stalert(message)
}
function stAlert(message) {
    return __SFW_f.stalert(message)
}
function sintaskHideNotParamClicked(param, callback, fadeTime) {
    return __SFW_f.sintaskHideNotParamClicked(param, callback, fadeTime)
}
function base64ToBlob(base64, mime) {
    return __SFW_f.base64ToBlob(base64, mime)
}
function sintaskResetFormat(id) {
    return __SFW_f.sintaskResetFormat(id)
}