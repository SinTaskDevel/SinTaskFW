var __SFW_srvTime = {
	timenow: <?php echo microTimeStamp();?>,
	timenowTen: <?php echo floor(microTimeStamp()/1000)?>,
	timestampreal: <?php echo microTimeStamp();?>,
}

var srvOldTime = Math.floor(Date.now());
srvTimeReal = function() {
	var timeoutTime 		= 100;
	var timeoutSubstrGap 	= -3;
	setTimeout(function(){
		var srvNowTime 		= Math.floor(Date.now());
		var srvGapTime 		= srvNowTime-srvOldTime;

		if(srvGapTime > 1000) {
			jqsfw.ajax({
				type: "POST",
				data: { tokenizing: __SFW_tokenizing },
				url: __SFW_homeUrl+"/sec-s-ajaxify/srvtime/get",
				success: function (data) {
					var datafeed    = data;
					var feedbackSts = datafeed.status;
					
					if(feedbackSts == 200) {
						var timenow = datafeed.timeupdate;
						timenow = parseInt(timenow);

						__SFW_srvTime.timenow 		= timenow;
						__SFW_srvTime.timenowTen 	= Math.floor(timenow/1000);
						srvOldTime 					= srvNowTime;
					}
					srvTimeReal();
				},
				error: function(xhr, textStatus, errorThrown) {
					/* Doing Nothing */
					srvTimeReal();
				}
			});
		} else {
			var srvGapString	= srvGapTime.toString();
				srvGapString	= srvGapString.substr(timeoutSubstrGap);
				srvGapString	= parseInt(srvGapString);
			var srvPostTime 	= __SFW_srvTime.timenow;
			srvPostTime 		= srvPostTime+srvGapString;

			__SFW_srvTime.timenow 		= srvPostTime;
			__SFW_srvTime.timenowTen 	= Math.floor(srvPostTime/1000);
			srvOldTime 					= srvNowTime;
			srvTimeReal();
		}
	},timeoutTime);
}
srvTimeReal();