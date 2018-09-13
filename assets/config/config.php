<?php
	
	/* Ubah jika anda menggunakan DB - true/false */
	$__WITHOUT_DB__ = ($__MY_CORE__["USE_DB"] == true ? false : true);

	require($__DOC_ROOT__.$requirePath['myconfig']."/my.db.config.php");

	if($__WITHOUT_DB__ == false) {
		/* Database Data */
		$mydbdata_len = count($mydbdata);

		for($mydbdatait = 0; $mydbdatait < $mydbdata_len; $mydbdatait++) {
			/* Menyiapkan koneksi ke DB - mysqli */
			$koneksi[$mydbdatait] = new mysqli(
				$mydbdata[$mydbdatait]['HOST'],
				$mydbdata[$mydbdatait]['USER'],
				$mydbdata[$mydbdatait]['PASS'],
				$mydbdata[$mydbdatait]['NAME']
			);
			$GLOBALS['gc'][$mydbdatait]				= $koneksi[$mydbdatait];
			$GLOBALS['globalKoneksi'][$mydbdatait] 	= $mydbdata[$mydbdatait];

		}

		/*
			DOCUMENTATION :
				### Inisiasi ###
				$sdb->useDb([Array KEY of DB]);
				$sdb->q('SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1=:bla1 AND bla2 NOT LIKE :bla2');
				$sdb->b(':bla1', $bla_var1);
				$sdb->b(':bla2', '%'.$bla_var2.'%');

				### Jika hanya mengeksekusi Query ###
				$exec = $sdb->exec();
				- or -
				$sdb->exec();

				### Jika satu baris row ###
				$rowArray 		= $sdb->rSingle();
				$rowcountUser 	= $rowArray['counting'];
				$rowresultUser 	= $rowArray['bla_row2'];

				### Jika banyak baris row (Fetch Array/Assoc) ###
				$rowArray = $sdb->rMany();
				foreach($rowArray as $key => $value) {
					$rowresultUser = $value['bla_row2'];
				}

				### Jika ingin mengambil banyak row dari hasil SELECT ###
				Hanya perlu menampilkan $rowcountUser
		*/

		class mySDB {
			private $host      = "";
			private $user      = "";
			private $pass      = "";
			private $dbname    = "";
		 
			private $dbh;
			private $error;
			private $stmt;
			private $temp;

			protected $dbstate;
		 
			public function __construct($dbdata = 0){
				global $GLOBALS;
				$this->dbstate 	= $GLOBALS["globalKoneksi"][$dbdata];

				$this->host 	= $this->dbstate['HOST'];
				$this->user 	= $this->dbstate['USER'];
				$this->pass 	= $this->dbstate['PASS'];
				$this->dbname 	= $this->dbstate['NAME'];
				/* Set DSN */
				$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
				/* Set options */
				$options = array(
					PDO::ATTR_PERSISTENT    		=> true,
					PDO::ATTR_ERRMODE       		=> PDO::ERRMODE_EXCEPTION,
					PDO::MYSQL_ATTR_INIT_COMMAND 	=> "SET NAMES utf8"
				);
				/* Create a new PDO instanace */
				try{
					$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
				}
				/* Catch any errors */
				catch(PDOException $e){
					$this->error = $e->getMessage();
				}
			}

			public function __destruct() {
				$this->dbh = null;
			}

			public function useDb($dbdata) {
				global $GLOBALS;
				$this->dbstate 	= $GLOBALS["globalKoneksi"][$dbdata];

				$this->host 	= $this->dbstate['HOST'];
				$this->user 	= $this->dbstate['USER'];
				$this->pass 	= $this->dbstate['PASS'];
				$this->dbname 	= $this->dbstate['NAME'];
				/* Set DSN */
				$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
				/* Set options */
				$options = array(
					PDO::ATTR_PERSISTENT    		=> true,
					PDO::ATTR_ERRMODE       		=> PDO::ERRMODE_EXCEPTION,
					PDO::MYSQL_ATTR_INIT_COMMAND 	=> "SET NAMES utf8"
				);
				/* Create a new PDO instanace */
				try{
					$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
				}
				/* Catch any errors */
				catch(PDOException $e){
					$this->error = $e->getMessage();
				}
			}
			
			public function q($query){
				$this->stmt = $this->dbh->prepare($query);
			}
			
			public function b($param, $value, $type = null){
				if (is_null($type)) {
					switch (true) {
						case is_int($value):
							$type = PDO::PARAM_INT;
							break;
						case is_bool($value):
							$type = PDO::PARAM_BOOL;
							break;
						case is_null($value):
							$type = PDO::PARAM_NULL;
							break;
						default:
							$type = PDO::PARAM_STR;
					}
				}
				$this->stmt->bindValue($param, $value, $type);
			}
			
			public function exec($param = null){
				if($param == null || is_null($param)) {
					$this->temp = $this->stmt->execute();
				} else {
					$this->temp = $this->stmt->execute($param);
				}
				return $this->temp;
			}

			public function rSingle($param = null){
				if($param == null || is_null($param)) {
					$this->exec();
				} else {
					$this->exec($param);
				}
				$this->temp = $this->stmt->fetch(PDO::FETCH_ASSOC);
				return $this->temp;
			}
			
			public function rMany($param = null){
				if($param == null || is_null($param)) {
					$this->exec();
				} else {
					$this->exec($param);
				}
				$this->temp = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
				return $this->temp;
			}
			
			public function rAffect(){
				$this->temp = $this->stmt->rowCount();
				return $this->temp;
			}
			
			public function lastInId(){
				$this->temp = $this->dbh->lastInsertId();
				return $this->temp;
			}
			
			public function aTrans(){
				$this->temp = $this->dbh->beginTransaction();
				return $this->temp;
			}
			
			public function zTrans(){
				$this->temp = $this->dbh->commit();
				return $this->temp;
			}
			
			public function xTrans(){
				$this->temp = $this->dbh->rollBack();
				return $this->temp;
			}
			
			public function debugDumpPar(){
				$this->temp = $this->stmt->debugDumpParams();
				return $this->temp;
			}

			public function manualClose() {
				return $this->dbh = null;
			}
		}
		/* DECLARE CLASS */
		$sdb = new mySDB(0);
		
		/*
			DB MYSQLI STYLE
			- menggunakan crudSDB() function
			- menggunakan $koneksi->query

			DOCUMENTATION :
				### Menggunakan crudSDB ###
					### Mengekeskusi Query ###
					$exec = crudSDB("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'");
					- or -
					crudSDB("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'");
			
					### Jika satu baris row ###
					$rowArray 		= crudSDB("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'", "fetch_array");
					$rowcountUser 	= $rowArray['counting'];
					$rowresultUser 	= $rowArray['bla_row2'];

					### Jika banyak baris row (Fetch Array/Assoc) ###
					$runQuery = crudSDB("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'");
					while($rowArray = $runQuery->fetch_array()) {
						$rowresultUser = $rowArray['bla_row2'];
					}

					### Jika ingin mengambil banyak row dari hasil SELECT ###
					$rowcountResult = crudSDB("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'", "num_rows");

				### Menggunakan MySQLI OOP ###
					### Mengekeskusi Query ###
					$exec = $koneksi->query("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'");
					- or -
					$koneksi->query("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'");
			
					### Jika satu baris row ###
					$rowArray 		= $koneksi->query("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'");
					$rowcountUser 	= $rowArray['counting'];
					$rowresultUser 	= $rowArray['bla_row2'];

					### Jika banyak baris row (Fetch Array/Assoc) ###
					$runQuery = $koneksi->query("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'");
					while($rowArray = $runQuery->fetch_array()) {
						$rowresultUser = $rowArray['bla_row2'];
					}

					### Jika ingin mengambil banyak row dari hasil SELECT ###
					$rowcountQuery = $koneksi->query("SELECT COUNT(bla_row1) AS counting, bla_row2 FROM bla_tb WHERE bla1='$bla_var1' AND bla2 NOT LIKE '%$bla_var2%'");
					$rowcountResult = $rowcountQuery->num_rows;
		
		*/
		
		/* Fungsi DB untuk query -> crudDB(); */
		function runQuery($query) {
			$koneksi 	= $GLOBALS['gc'][0];
			$runquery 	= $koneksi->query($query);

			return $runquery;
		}
		function crudDB($query, $type) {
			$result = runQuery($query);
			$type 	= strtolower($type);

			if($result == false) {
				return false;
			}

			if($type == "fetch_array") {
				$row = $result->fetch_array();
				return $row;
			} else if($type == "fetch_assoc") {
				$row = $result->fetch_assoc();
				return $row;
			} else if($type == "num_rows") {
				$resultnum = $result->num_rows;
				return $resultnum;
			} else if($type == "fetch_array_more") {

			} else if($type == "fetch_assoc_more") {

			} else {
				return $result;
			}
		}
		function crudSDB($query, $type = null) {
			if($__WITHOUT_DB__ == true) {
				return true;
			} else {
				return crudDB($query, $type);
			}
		}

		/* Inisialisasi "Root Variable" */
		$koneksi = $GLOBALS['gc'][0];
		$__CONNECT_STATUS__ = false;
		
		/* Periksa koneksi ke DB dan Status Maintenance */
		if ($koneksi->connect_error) {
	    	session_destroy();
		} else if (MAINTENANCE == true) {
			session_destroy();
	    } else {
	    	$__CONNECT_STATUS__ = true;
		}
	} else {
		/*
	 	 * Jangan diedit, untuk menangkal error
		 */
		class dummyClass {
	        function query($input = null) {
	            return true;
	        }
	        function close($input = null) {
	            return true;
	        }
	    }

		$koneksi 					= new dummyClass();
		$GLOBALS['gc'] 				= $koneksi; /* Untuk digunakan dalam crudDB() function */
		$GLOBALS['globalKoneksi'] 	= $koneksi; /* Untuk penyesuaian dengan versi sebelumnya */

		/* Inisialisasi "Root Variable" */
		$__CONNECT_STATUS__ = true;
	}
	
?>