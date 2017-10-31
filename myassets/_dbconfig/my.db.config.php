<?php
	
	/* Fill your DB data (if using DB) */
	$mydbdata[0]['HOST'] = 'YOUR_HOST';
	$mydbdata[0]['USER'] = 'YOUR_USERNAME';
	$mydbdata[0]['PASS'] = 'YOUR_PASSWORD';
	$mydbdata[0]['NAME'] = 'YOUR_DBNAME';

	/*
	 * You can add more database with $mydbdata array variable
	 */

	/*
		DOCUMENTATION :
			### Note ###
			Each new query, we create new class.
			For security reason don't create query with new variable

			### Initiate class ###
			$sdb->useDb([Array KEY of DB]);
			$sdb->q('SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1=:bla1 AND bla2 NOT LIKE :bla2');
			$sdb->b(':bla1', $bla_var1);
			$sdb->b(':bla2', '%'.$bla_var2.'%');

			### If execute only ###
			$exec = $sdb->exec();
			- or -
			$sdb->exec();

			### If single line row ###
			$rowArray 		= $sdb->rSingle();
			$rowcountUser 	= $rowArray['counting'];
			$rowresultUser 	= $rowArray['bla_row2'];

			### If multiline row (Fetch Array/Assoc) ###
			$rowArray = $sdb->rMany();
			foreach($rowArray as $key => $value) {
				$rowresultUser = $value['bla_row2'];
			}

			### If Get Count Row ###
			Just get $rowcountUser

			WARNING: You can't use $sdb in this file.
	*/

?>