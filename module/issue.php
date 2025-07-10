<?php
/**
 * $$_POST['type_submit']
 */
class Issue extends Encription
{
	public $type_submit='';
	public $db='';
	function __construct($db='', $request=[])
	{
		extract($request);
		unset( $_POST['submit'] );
		$this->db=$db;
		$this->type_submit=$type_submit;
		if( isset($type_submit) && $type_submit!='' ){
			echo $this->$type_submit();
		}
	}

	public function getIssue($page = 1, $tujuan = "", $kategori = "", $jenis = 0, $work = "", $status = 0, $bulan = "", $tahun = "", $program = 0, $rowsPerPage = 20) {
		$page = isset($_POST['page']) ? $_POST['page'] : $page;
		$tujuan = isset($_POST['tujuan']) && $_POST['tujuan'] !== "" ? $_POST['tujuan'] : null;
		$kategori = isset($_POST['kategori']) && $_POST['kategori'] !== "" ? $_POST['kategori'] : null;
		$jenis = isset($_POST['jenis']) && $_POST['jenis'] !== "" ? $_POST['jenis'] : null;
		$work = isset($_POST['work']) ? $_POST['work'] : $work;
		$status = isset($_POST['status']) ? $_POST['status'] : $status;
		$bulanNama = isset($_POST['bulan']) ? $_POST['bulan'] : null;
		$bulan = null;
		if ($bulanNama) {
			$bulanArray = [
				"Januari" => 1, "Februari" => 2, "Maret" => 3, "April" => 4,
				"Mei" => 5, "Juni" => 6, "Juli" => 7, "Agustus" => 8,
				"September" => 9, "Oktober" => 10, "November" => 11, "Desember" => 12
			];

			$bulan = isset($bulanArray[$bulanNama]) ? $bulanArray[$bulanNama] : null;
		}
		$tahun = isset($_POST['tahun']) && $_POST['tahun'] !== "" ? $_POST['tahun'] : null;
		$program = isset($_POST['program']) && $_POST['program'] !== "" ? $_POST['program'] : null;
		$offset = ($page - 1) * $rowsPerPage;
	
		$query = "SELECT * FROM mIssue WHERE 1=1";
		$params = [];
	
		if ($tujuan) {
			$query .= " AND tujuan = $tujuan";
		}
		if ($kategori) {
			$query .= " AND kategori = $kategori";
		}

		if ($jenis) {
			$query .= " AND jenis = $jenis";
		}

		if ($work) {
			$query .= " AND ditangani = $work";
		}

		if ($status) {
			if ($status == 1) {
				$query .= " AND ditangani IS NULL AND TanggalSelesai IS NULL";
			} elseif ($status == 2) {
				$query .= " AND ditangani IS NOT NULL AND TanggalSelesai IS NULL";
			} elseif ($status == 3) {
				$query .= " AND ditangani IS NOT NULL AND TanggalSelesai IS NOT NULL";
			}
		}
		
		if ($bulan) {
			$query .= " AND MONTH(Tanggal) = $bulan";
		}
		
		if ($tahun) {
			$query .= " AND YEAR(Tanggal) = $tahun";
		}

		if ($program){
			$query .= " AND Aplikasi = $program";
		}
	
		$query .= " ORDER BY No DESC OFFSET $offset ROWS FETCH NEXT $rowsPerPage ROWS ONLY";
	
		$result = $this->db->execute($query);
	
		$countQuery = "SELECT COUNT(*) AS total FROM mIssue WHERE 1=1";
		if ($tujuan) $countQuery .= " AND tujuan = $tujuan";
		if ($kategori) $countQuery .= " AND kategori = $kategori";
		if ($jenis) $countQuery .= " AND jenis = $jenis";
		if ($work) $countQuery .= " AND ditangani = $work";
		if ($status) {
			if ($status == 1) {
				$countQuery .= " AND ditangani IS NULL AND TanggalSelesai IS NULL";
			} elseif ($status == 2) {
				$countQuery .= " AND ditangani IS NOT NULL AND TanggalSelesai IS NULL";
			} elseif ($status == 3) {
				$countQuery .= " AND ditangani IS NOT NULL AND TanggalSelesai IS NOT NULL";
			}
		}
		if ($bulan) $countQuery .= " AND MONTH(Tanggal) = $bulan";
		if ($tahun) $countQuery .= " AND YEAR(Tanggal) = $tahun";
		if ($program) $countQuery .= " AND Aplikasi = $program";
	 
		$countResult = $this->db->execute($countQuery, $params);
		$totalCount = $countResult ? $countResult[0]['total'] : 0;
	
		echo json_encode([
			'data' => $result ?: $query,
			'total_count' => $totalCount
		]);
	}
	
	public function getEdit($id_Issue = ""){
		$id_Issue = isset($_POST['id_Issue']) ? $_POST['id_Issue'] : $id_Issue;
		$query = "SELECT * FROM mIssue WHERE No = '$id_Issue'";
		$result = $this->db->execute($query); 

		if (!$result) {
			return json_encode(["error" => "Data not found"]);
		}
	
		return json_encode($result);
	}

	public function getOpenIssue($page = 1, $rowsPerPage = 20){
		$page = isset($_POST['page'])? $_POST['page'] : $page; 
		$offset = ($page - 1) * $rowsPerPage;
		$countResult = $this->db->execute("SELECT COUNT(*) AS total FROM mIssue WHERE ditangani IS NULL");
		$totalCount = $countResult[0]['total'];
		$result = $this->db->execute("
			SELECT * 
			FROM mIssue 
			WHERE Ditangani IS NULL 
			ORDER BY Tanggal DESC
			OFFSET $offset ROWS
			FETCH NEXT $rowsPerPage ROWS ONLY
		");
	
		return json_encode([
			'data' => $result,
			'total_count' => $totalCount  
		]);
	}	

	public function getMyIssue($idUser = "000830") {
		$idUser = !empty($_POST['idUser']) ? trim($_POST['idUser']) : $idUser;
	
		$query = "
			SELECT No 
			FROM MIssue 
			WHERE (Ditangani = '$idUser' OR Dari = '$idUser') 
			AND TanggalSelesai IS NULL
			ORDER BY Tanggal DESC
		";
	
		try {
			$issues = $this->db->execute($query);
			$finalData = [];
	
			foreach ($issues as $issue) {
				$id_Issue = $issue['No'];
	
				// Ambil data chat dari MComCli untuk setiap issue
				$queryChat = "SELECT * FROM MComCli WHERE id_Issue = '$id_Issue'";
				$chats = $this->db->execute($queryChat);
	
				foreach ($chats as $chat) {
					if ($chat['isRead'] == 0 && $chat['Dari'] != $_SESSION[_session_app_id]['emp_no']) {
						$finalData[] = [
							'NoIssue' => $id_Issue,
							'Dari' => $chat['Dari'],
							'Isi' => $chat['Isi']
						];
					}
				}
			}
	
			return json_encode([
				'status' => 'success',
				'data' => $finalData
			]);
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			]);
		}
	}
	
	
	public function getProgIssue($page = 1, $rowsPerPage = 20){
		$page = isset($_POST['page'])? $_POST['page'] : $page; 
		$emp_no = $_SESSION[_session_app_id]['emp_no'];
		$offset = ($page - 1) * $rowsPerPage;
		$countResult = $this->db->execute("SELECT COUNT(*) AS total FROM mIssue WHERE ditangani = $emp_no AND TanggalSelesai IS NULL");
		$totalCount = $countResult[0]['total'];
		$result = $this->db->execute("
			SELECT * 
			FROM mIssue 
			WHERE Ditangani = $emp_no AND TanggalSelesai IS NULL 
			ORDER BY Tanggal DESC
			OFFSET $offset ROWS
			FETCH NEXT $rowsPerPage ROWS ONLY
		");
	
		return json_encode([
			'data' => $result,
			'total_count' => $totalCount  
		]);
	}

	public function getAllPengajuan($page = 1, $rowsPerPage = 20) {
		$page = isset($_POST['page']) ? $_POST['page'] : $page;
		$offset = ($page - 1) * $rowsPerPage;
		$emp_no = $_SESSION[_session_app_id]['emp_no'];

		// Hitung total data
		$countResult = $this->db->execute("SELECT COUNT(*) AS total FROM mPengajuan WHERE dari = '$emp_no'");
		$totalCount = $countResult[0]['total'];

		// Ambil data + status
		$result = $this->db->execute("
			SELECT 
				p.*, 
				CASE 
					WHEN a.NoPeng IS NOT NULL THEN '<span class=\"badge rounded-pill bg-label-info\">Completed</span>'
					WHEN p.tanggalKonfirmasi IS NOT NULL THEN '<span class=\"badge rounded-pill bg-label-warning\">In Progress</span>'
					ELSE '<span class=\"badge rounded-pill bg-label-success\">Open</span>'
				END AS Status
			FROM mPengajuan p
			LEFT JOIN ACCPENGAJUAN a ON p.No = a.NoPeng
			WHERE p.dari = '$emp_no'
			ORDER BY p.tanggal DESC
			OFFSET $offset ROWS 
			FETCH NEXT $rowsPerPage ROWS ONLY
		");

		return json_encode([
			'data' => $result,
			'total_count' => $totalCount
		]);
	}
	
	public function getApk(){
		$result = $this->db->execute("SELECT * FROM MAplikasi ORDER BY NamaAplikasi ASC");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	public function getLaporan($jenis = "") {
		$jenis = isset($_POST['jenis']) ? trim(strval($_POST['jenis'])) : trim(strval($jenis));
		$lapList = [
			"KomSw"  => "(3,4,7,9,17)",
			"KomHw"  => "(5,9,17)",
			"ReqSw"  => "(3,6,9,17)",
			"ReqHw"  => "(8,9,17)",
			"Hw"     => "(5,8,9,17)",
			"Req"    => "(3,6,8,9,17)",
			"Sw"     => "(3,4,6,7,9,17)",
			"Kom"    => "(3,4,5,7,9,17)",
			"AllComb"=> "" 
		];
	
		if (!isset($lapList[$jenis])) {
			$jenis = "AllComb";
		}
	
		$query = ($lapList[$jenis] !== "") 
			? "SELECT * FROM MJLaporan WHERE Lap IN {$lapList[$jenis]} ORDER BY NamaLaporan ASC"
			: "SELECT * FROM MJLaporan ORDER BY NamaLaporan ASC";
	
		$result = $this->db->execute($query);
		return json_encode($result);
	}
	
	//11
	public function getKomSw(){
		$result = $this->db->execute("SELECT * FROM MJLaporan WHERE Lap IN (3,4,7,9,17) ORDER BY NamaLaporan ASC");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	//12
	public function getKomHw(){
		$result = $this->db->execute("SELECT * FROM MJLaporan WHERE Lap IN (5,9,17) ORDER BY NamaLaporan ASC");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	//21
	public function getReqSw(){
		$result = $this->db->execute("SELECT TOP 25 * FROM MJLaporan WHERE Lap IN (3,6,9,17) ORDER BY NamaLaporan ASC");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	//22
	public function getReqHw(){
		$result = $this->db->execute("SELECT * FROM MJLaporan WHERE Lap IN (8,9,17) ORDER BY NamaLaporan ASC;");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	//02
	public function getHw(){
		$result = $this->db->execute("SELECT * FROM MJLaporan WHERE Lap IN (5,8,9,17) ORDER BY NamaLaporan ASC;");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	//20
	public function getReq(){
		$result = $this->db->execute("SELECT * FROM MJLaporan WHERE Lap IN (3,6,8,9,17) ORDER BY NamaLaporan ASC;");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	//01
	public function getSw(){
		$result = $this->db->execute("SELECT * FROM MJLaporan WHERE Lap IN (3,4,6,7,9,17) ORDER BY NamaLaporan ASC;");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	//10
	public function getKom(){
		$result = $this->db->execute("SELECT * FROM MJLaporan WHERE Lap IN (3,4,5,7,9,17) ORDER BY NamaLaporan ASC;");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	//00
	public function getAllComb(){
		$result = $this->db->execute("SELECT * FROM MJLaporan ORDER BY NamaLaporan ASC;");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	public function postHD($No = "", $Seq=0, $NamaFile="",$key){
		$file = [];
		$file['name'] = $_FILES['file']['name'][$key];
		$file['type'] = $_FILES['file']['type'][$key];
		$file['tmp_name'] = $_FILES['file']['tmp_name'][$key];
		$file['error'] = $_FILES['file']['error'][$key];
		$file['size'] = $_FILES['file']['size'][$key];
		uploadFile($file, glob_src('upload') , $NamaFile, $allow_type=['jpg','jpeg','png','gif','webp']);
		$result = $this->db->insert("GBIssue",[
			"No" => $No,
			"Seq" => $Seq,
			"NamaFile" => $NamaFile
		]);
		
		if ($result) {
			return json_encode([
				'status' => 'success',
				'message' => 'GBIssue inserted successfully'
			]);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Failed to insert GBIssue']);
		}
	}	

	public function getEditAll(){
		$result = $this->db->execute("SELECT * FROM MIssue WHERE No = 'id_Issue';");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	public function getComCli($idIssue = ""){
		$idIssue = isset($_POST['idIssue']) ? trim(strval($_POST['idIssue'])) : trim(strval($idIssue));
		$result = $this->db->execute("SELECT * FROM MComCli WHERE NoIssue = '$idIssue' ORDER BY Waktu ASC;");
		// $result = $this->db->getAll('mIssue');
		return json_encode($result);
	}

	public function insLiveChat($NoIssue="", $Waktu="", $Dari="", $Isi="", $idUser="") {
		$NoIssue = isset($_POST['NoIssue']) ? trim(strval($_POST['NoIssue'])) : trim(strval($NoIssue));
		$Waktu = isset($_POST['Waktu']) ? trim(strval($_POST['Waktu'])) : trim(strval($Waktu));
		$Dari = isset($_POST['Dari']) ? trim(strval($_POST['Dari'])) : trim(strval($Dari));
		$Isi = isset($_POST['Isi']) ? trim(strval($_POST['Isi'])) : trim(strval($Isi));
		$idUser = isset($_POST['idUser']) ? trim(strval($_POST['idUser'])) : trim(strval($idUser));

		error_log("Received idUser: " . $idUser);
		try {
			$result = $this->db->insert("MComCli", ['NoIssue' => $NoIssue, 'Waktu' => $Waktu, "Dari" => $Dari, "Isi" => $Isi, "isRead" => false, "idUser" => $idUser]);
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Chat message inserted successfully'
				]);
			} else {
				return json_encode(['status' => 'error', 'message' => 'Failed to insert message']);
			}
		} catch (Exception $e) {
			return json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
		}
	}	
	
	public function kerjakanIssue($No = "", $estimasiMenit = 0) {
		// Ambil dan bersihkan nilai No
		$No = isset($_POST['No']) ? $_POST['No'] : $No;
	
		// Menghilangkan karakter escape seperti \/ menggunakan json_decode
		$No = json_decode('"' . $No . '"');
		$No = trim($No);
	
		// Ambil estimasi waktu
		$estimasiMenit = isset($_POST['estimasiMenit']) ? intval($_POST['estimasiMenit']) : intval($estimasiMenit);
	
		// Ambil user dari session
		$currentUser = $_SESSION[_session_app_id]['emp_no'] ?? '';
	
		// Tanggal dan waktu sekarang
		$currentDateTime = date('Y-m-d H:i:s') . '.' . substr(microtime(false), 2, 3);
	
		// Validasi input
		if (empty($No)) {
			return json_encode(['status' => 'error', 'message' => 'No Issue is required'], JSON_UNESCAPED_SLASHES);
		}
	
		if (empty($currentUser)) {
			return json_encode(['status' => 'error', 'message' => 'User not authenticated'], JSON_UNESCAPED_SLASHES);
		}
	
		if ($estimasiMenit <= 0) {
			return json_encode(['status' => 'error', 'message' => 'Estimation time is required'], JSON_UNESCAPED_SLASHES);
		}
	
		try {
			// Cek apakah issue ada dan belum ditangani
			$checkQuery = "SELECT Ditangani FROM MIssue WHERE No = '$No'";
			$existingIssue = $this->db->execute($checkQuery);
	
			if (empty($existingIssue)) {
				return json_encode(['status' => 'error', 'message' => 'Issue not found'], JSON_UNESCAPED_SLASHES);
			}
	
			if (!empty($existingIssue[0]['Ditangani'])) {
				return json_encode(['status' => 'error', 'message' => 'Issue already taken by another user'], JSON_UNESCAPED_SLASHES);
			}
	
			// Try different approaches for SQL Server compatibility
			
			// Method 1: Try with explicit field updates (most compatible)
			$updateQuery1 = "UPDATE MIssue SET Ditangani = '$currentUser' WHERE No = '$No'";
			$result1 = $this->db->execute($updateQuery1);
			
			if ($result1 !== false) {
				// Update AcceptWork separately
				$updateQuery2 = "UPDATE MIssue SET AcceptWork = '$currentDateTime' WHERE No = '$No'";
				$result2 = $this->db->execute($updateQuery2);
				
				if ($result2 !== false) {
					// Update EstimasiMenit separately
					$updateQuery3 = "UPDATE MIssue SET EstimasiMenit = $estimasiMenit WHERE No = '$No'";
					$result3 = $this->db->execute($updateQuery3);
					
					if ($result3 !== false) {
						return json_encode([
							'status' => 'success',
							'message' => 'Issue successfully taken',
							'data' => [
								'No' => $No,
								'Ditangani' => $currentUser,
								'AcceptWork' => $currentDateTime,
								'EstimasiMenit' => $estimasiMenit
							]
						], JSON_UNESCAPED_SLASHES);
					}
				}
			}
			
			// Method 2: Try with quoted datetime format if Method 1 fails
			$updateQuery = "UPDATE MIssue SET Ditangani = '$currentUser', AcceptWork = CAST('$currentDateTime' AS DATETIME2), EstimasiMenit = $estimasiMenit WHERE No = '$No'";
			$result = $this->db->execute($updateQuery);
	
			if ($result !== false) {
				return json_encode([
					'status' => 'success',
					'message' => 'Issue successfully taken',
					'data' => [
						'No' => $No,
						'Ditangani' => $currentUser,
						'AcceptWork' => $currentDateTime,
						'EstimasiMenit' => $estimasiMenit
					]
				], JSON_UNESCAPED_SLASHES);
			}
			
			// Method 3: Try with different datetime format if Method 2 fails
			$simpleDatetime = date('Y-m-d H:i:s');
			$updateQuery = "UPDATE MIssue SET Ditangani = '$currentUser', AcceptWork = '$simpleDatetime', EstimasiMenit = $estimasiMenit WHERE No = '$No'";
			$result = $this->db->execute($updateQuery);
	
			if ($result !== false) {
				return json_encode([
					'status' => 'success',
					'message' => 'Issue successfully taken',
					'data' => [
						'No' => $No,
						'Ditangani' => $currentUser,
						'AcceptWork' => $simpleDatetime,
						'EstimasiMenit' => $estimasiMenit
					]
				], JSON_UNESCAPED_SLASHES);
			}
			
			// Method 4: Use prepared statement approach if all else fails
			try {
				$preparedQuery = "UPDATE MIssue SET Ditangani = ?, AcceptWork = ?, EstimasiMenit = ? WHERE No = ?";
				$params = [$currentUser, $currentDateTime, $estimasiMenit, $No];
				$result = $this->db->execute($preparedQuery, $params);
				
				if ($result !== false) {
					return json_encode([
						'status' => 'success',
						'message' => 'Issue successfully taken (prepared statement)',
						'data' => [
							'No' => $No,
							'Ditangani' => $currentUser,
							'AcceptWork' => $currentDateTime,
							'EstimasiMenit' => $estimasiMenit
						]
					], JSON_UNESCAPED_SLASHES);
				}
			} catch (Exception $preparedEx) {
				// Continue to final error if prepared statement also fails
			}
	
			// If all methods fail, return detailed error information
			return json_encode([
				'status' => 'error',
				'message' => 'Failed to update issue - all methods tried',
				'debug_info' => [
					'no' => $No,
					'user' => $currentUser,
					'datetime' => $currentDateTime,
					'estimation' => $estimasiMenit,
					'final_query' => $updateQuery,
					'db_result' => $result
				]
			], JSON_UNESCAPED_SLASHES);
	
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error: ' . $e->getMessage(),
				'debug_info' => [
					'no' => $No,
					'user' => $currentUser,
					'datetime' => $currentDateTime
				]
			], JSON_UNESCAPED_SLASHES);
		}
	}
	
	
	public function selesaikanIssue($No = "", $solusi = "", $catatan = "") {
		$No = isset($_POST['No']) ? $_POST['No'] : $No;
		$No = json_decode('"' . $No . '"');
		$No = trim($No);
		$solusi = isset($_POST['solusi']) ? trim(strval($_POST['solusi'])) : trim(strval($solusi));
		$catatan = isset($_POST['catatan']) ? trim(strval($_POST['catatan'])) : trim(strval($catatan));
		
		$currentUser = $_SESSION[_session_app_id]['emp_no'] ?? '';
		
		$currentDateTime = date('Y-m-d H:i:s') . '.' . substr(microtime(false), 2, 3);
		
		try {
			// Check if issue exists and is being worked on by current user
			$checkQuery = "SELECT Ditangani, AcceptWork, EstimasiMenit, TanggalSelesai FROM MIssue WHERE No = '$No'";
			$existingIssue = $this->db->execute($checkQuery);
			
			if (empty($existingIssue)) {
				return json_encode(['status' => 'error', 'message' => 'Issue not found']);
			}
			
			if ($existingIssue[0]['Ditangani'] !== $currentUser) {
				return json_encode(['status' => 'error', 'message' => 'You are not assigned to this issue']);
			}
			
			if (!empty($existingIssue[0]['TanggalSelesai'])) {
				return json_encode(['status' => 'error', 'message' => 'Issue already completed']);
			}
			
			// Calculate actual work time
			$acceptTime = new DateTime($existingIssue[0]['AcceptWork']);
			$finishTime = new DateTime($currentDateTime);
			$actualMinutes = round(($finishTime->getTimestamp() - $acceptTime->getTimestamp()) / 60);
			
			// Escape strings for SQL safety
			$escapedSolusi = str_replace("'", "''", $solusi);
			$escapedCatatan = str_replace("'", "''", $catatan);
			
			// Update the issue with full SQL query
			$updateQuery = "UPDATE MIssue SET TanggalSelesai = '$currentDateTime', Solusi = '$escapedSolusi', CatatanIT = '$escapedCatatan', AktualMenit = $actualMinutes WHERE No = '$No'";
			
			$result = $this->db->execute($updateQuery);
			
			if ($result !== false) {
				return json_encode([
					'status' => 'success',
					'message' => 'Issue successfully completed',
					'data' => [
						'No' => $No,
						'TanggalSelesai' => $currentDateTime,
						'EstimasiMenit' => $existingIssue[0]['EstimasiMenit'],
						'AktualMenit' => $actualMinutes,
						'Solusi' => $solusi,
						'CatatanIT' => $catatan
					]
				]);
			} else {
				return json_encode(['status' => 'error', 'message' => 'Failed to complete issue']);
			}
			
		} catch (Exception $e) {
			return json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
		}
	}

	public function issueGenID(){
		$year = date('Y');
		$shortYear = substr($year, -2);
		$query = "SELECT COUNT(*) as total FROM MIssue WHERE YEAR(Tanggal) = '$year'";
		$result = $this->db->execute($query);
		$count = $result[0]['total'] ?? 0;
		$newNumber = $count + 1;
		$formattedNumber = str_pad($newNumber, 6, '0', STR_PAD_LEFT);
		$newID = "IT/$shortYear/$formattedNumber";
		return json_encode($newID);
	}	
	
	public function getAtP(){
		$query = "SELECT TOP 1 MPATA FROM MAtP;";
		$result = $this->db->execute($query);

		if (!$result || empty($result)) {
			return json_encode(0); 
		}

		return json_encode(intval($result[0]['MPATA'])); 
	}

	public function getNotif() {
		$query = "
			SELECT mc1.*
				, (
					SELECT COUNT(*) 
					FROM MComCli mc2 
					WHERE mc2.NoIssue = mc1.NoIssue AND mc2.isRead = 0
				) AS unread_count
			FROM MComCli mc1
			INNER JOIN (
				SELECT NoIssue, MAX(Waktu) AS MaxWaktu
				FROM MComCli
				WHERE isRead = 0
				GROUP BY NoIssue
			) latest ON mc1.NoIssue = latest.NoIssue AND mc1.Waktu = latest.MaxWaktu
			ORDER BY mc1.Waktu DESC
		";
	
		$result = $this->db->execute($query);
		return json_encode($result);
	}	

	public function markAllNotifRead() {
		try {
			// Mark all unread notifications as read
			$query = "UPDATE MComCli SET isRead = 1 WHERE isRead = 0";
			$result = $this->db->execute($query);
			
			return json_encode([
				'status' => 'success',
				'message' => 'All notifications marked as read'
			]);
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error', 
				'message' => 'Error marking notifications as read: ' . $e->getMessage()
			]);
		}
	}

	public function markNotifReadByNoCom() {
		$noCom = isset($_POST['NoCom']) ? $_POST['NoCom'] : '';
		
		if (empty($noCom)) {
			return json_encode([
				'status' => 'error', 
				'message' => 'NoCom tidak dikirim'
			]);
		}
		
		try {
			// Use prepared statement for security
			$query = "UPDATE MComCli SET isRead = 1 WHERE NoCom = ?";
			$result = $this->db->execute($query, [$noCom]);
			
			return json_encode([
				'status' => 'success',
				'message' => 'Notification marked as read'
			]);
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error: ' . $e->getMessage()
			]);
		}
	}

	public function markNotifReadByNoIssue() {
		$noIssue = isset($_POST['NoIssue']) ? $_POST['NoIssue'] : '';
		
		if (empty($noIssue)) {
			return json_encode([
				'status' => 'error',
				'message' => 'NoIssue tidak dikirim'
			]);
		}
	
		try {
			$query = "UPDATE MComCli SET isRead = 1 WHERE NoIssue = ? AND isRead = 0";
			$params = [$noIssue];
			foreach ($params as $val) {
				$val = is_numeric($val) ? $val : "'" . addslashes($val) . "'";
				$query = preg_replace('/\?/', $val, $query, 1);
			}
			$result = $this->db->execute($query); 
	
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'All notifications for issue marked as read',
					'updated_rows' => $result,
					'NoIssue' => $noIssue
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'No rows updated or already read',
					'NoIssue' => $noIssue
				]);
			}
	
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Exception: ' . $e->getMessage()
			]);
		}
	}	

	public function markChatAsRead() {
		$noIssue = isset($_POST['NoIssue']) ? $_POST['NoIssue'] : '';
		$noIssue = json_decode('"' . $noIssue . '"');
		$noIssue = trim($noIssue);
		$currentUser = isset($_SESSION[_session_app_id]['emp_no']) ? $_SESSION[_session_app_id]['emp_no'] : '';
		
		try {
			$query = "UPDATE MComCli SET isRead = 1 
					WHERE NoIssue = $noIssue
					AND Dari != $currentUser 
					AND isRead = 0";
			$result = $this->db->execute($query);
			
			return json_encode([
				'status' => 'success',
				'message' => 'Chat marked as read'
			]);
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error: ' . $e->getMessage()
			]);
		}
	}
	
	public function createHD($No = "", $prioritas = "", $Tanggal = "", $dari = "", $tujuan = "", $kategori = "", $Jenis = "", $Aplikasi = "", $issue = "", $accPATA = "", $AcceptWork = "", $Rating = 0) {
		$No = isset($_POST['No']) ? trim($_POST['No']) : trim($No);
		$prioritas = isset($_POST['prioritas']) ? trim(strval($_POST['prioritas'])) : trim(strval($prioritas));
		$Tanggal = isset($_POST['Tanggal']) ? trim(strval($_POST['Tanggal'])) : trim(strval($Tanggal));
		$dari = isset($_POST['dari']) ? trim(strval($_POST['dari'])) : trim(strval($dari));
		$tujuan = isset($_POST['tujuan']) ? trim(strval($_POST['tujuan'])) : trim(strval($tujuan));
		$kategori = isset($_POST['kategori']) ? trim(strval($_POST['kategori'])) : trim(strval($kategori));
		$Jenis = isset($_POST['Jenis']) ? trim(strval($_POST['Jenis'])) : trim(strval($Jenis));
		$Aplikasi = isset($_POST['Aplikasi']) ? trim(strval($_POST['Aplikasi'])) : trim(strval($Aplikasi));
		$issue = isset($_POST['issue']) ? trim(strval($_POST['issue'])) : trim(strval($issue));
		$accPATA = isset($_POST['accPATA']) ? trim(strval($_POST['accPATA'])) : trim(strval($accPATA));
		$TanggalKonfirmasi = isset($_POST['TanggalKonfirmasi']) ? trim(strval($_POST['TanggalKonfirmasi'])) : trim(strval($AcceptWork));
		// dd([$_POST,$_FILES['file']]);

		try {
			if($accPATA == 1){
				$result = $this->db->insert("MIssue", [
					"No" => $No,
					"prioritas" => $prioritas,
					"Tanggal" => $Tanggal,
					"dari" => $dari,
					"tujuan" => $tujuan,
					"kategori" => $kategori,
					"Jenis" => $Jenis,
					"Aplikasi" => $Aplikasi,
					"issue" => $issue,
					"accPATA" => $accPATA,
					"StNotifPATA" => 0,
					"StNotifIT" => 0,
					"StNotifStf" => 0,
					"Rating" => 0,
					"autoppilot" => 1,
					"TanggalKonfirmasi" => $TanggalKonfirmasi,
					"Konfirmasi" => 1
				]);
			}
			
			$st_gmbr = [];
			if (!empty($_FILES)) {
				foreach ($_FILES['file']['tmp_name'] as $key => $tmp) {
					$NamaFile = $No . "_" . ($key + 1) . "." . pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
					$st_gmbr[] = json_decode($this->postHD($No, $key + 1, $NamaFile, $key), true);
				}
			}
	
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Issue inserted successfully',
					'st_gmbr' => $st_gmbr
				]);
			} else {
				$insertData = [
					"No" => $No,
					"prioritas" => $prioritas,
					"Tanggal" => $Tanggal,
					"dari" => $dari,
					"tujuan" => $tujuan,
					"kategori" => $kategori,
					"Jenis" => $Jenis,
					"Aplikasi" => $Aplikasi,
					"issue" => $issue,
					"accPATA" => $accPATA,
					"Rating" => $Rating,
					"autoppilot" => 1,
					"TanggalKonfirmasi" => $TanggalKonfirmasi,
					"Konfirmasi" => 1
				];
				return json_encode([
					'status' => 'error',
					'message' => 'Failed to insert Helpdesk',
					'data_attempted' => $insertData
				]);
			}
		} catch (Exception $e) {
			return json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
		}
	}

	public function createPengajuan() {
		$cabang = isset($_POST['cabang']) ? trim(strval($_POST['cabang'])) : 'P';
		$No = isset($_POST['No']) && $_POST['No'] !== '' ? trim(strval($_POST['No'])) : $this->generateNoPJ($cabang);
		$namainvestasi = isset($_POST['namainvestasi']) ? trim(strval($_POST['namainvestasi'])) : "";
		$biaya = isset($_POST['biaya']) ? trim(strval($_POST['biaya'])) : 0;
		$dari = isset($_POST['dari']) ? trim(strval($_POST['dari'])) : "";
		$kepada = isset($_POST['kepada']) ? trim(strval($_POST['kepada'])) : "";
		$up = isset($_POST['up']) ? trim(strval($_POST['up'])) : "";
		$keterangan = isset($_POST['keterangan']) ? trim(strval($_POST['keterangan'])) : "";
		$tanggal = date("Y-m-d H:i:s");
	
		try {
			$result = $this->db->insert("mPengajuan", [
				"No" => $No,
				"namainvestasi" => $namainvestasi,
				"biaya" => $biaya,
				"Tanggal" => $tanggal,
				"Dari" => $dari,
				"Kepada" => $kepada,
				"cabang" => $cabang,
				"up" => $up,
				"keterangan" => $keterangan
			]);
	
			$st_gmbr = [];
			if (!empty($_FILES)) {
				foreach ($_FILES['file']['tmp_name'] as $key => $tmp) {
					$NamaFile = $No . "_" . ($key + 1) . "." . pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
					$st_gmbr[] = json_decode($this->postPengajuanFile($No, $key + 1, $NamaFile, $key), true);
				}
			}
	
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Pengajuan inserted successfully',
					'st_gmbr' => $st_gmbr
				]);
			} else {
				return json_encode(['status' => 'error', 'message' => 'Failed to insert pengajuan']);
			}
		} catch (Exception $e) {
			return json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
		}
	}
	
	public function postPengajuanFile($No = "", $Seq = 0, $NamaFile = "", $key = 0) {
		$file = [
			'name' => $_FILES['file']['name'][$key],
			'type' => $_FILES['file']['type'][$key],
			'tmp_name' => $_FILES['file']['tmp_name'][$key],
			'error' => $_FILES['file']['error'][$key],
			'size' => $_FILES['file']['size'][$key]
		];
	
		uploadFile($file, glob_src('upload'), $NamaFile, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
	
		$result = $this->db->insert("GBPengajuan", [
			"No" => $No,
			"Seq" => $Seq,
			"NamaFile" => $NamaFile
		]);
	
		if ($result) {
			return json_encode([
				'status' => 'success',
				'message' => 'GBPengajuan inserted successfully'
			]);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Failed to insert GBPengajuan']);
		}
	}
	
	public function generateNoPJ($cabang = '' ){
		$tahun = date('y');      
		$bulan = date('m');     
		$prefix = "HR-IT" . $cabang . "-{$tahun}{$bulan}"; 
	
		$query = "
			SELECT TOP 1 
				RIGHT('000' + CAST(CAST(SUBSTRING(No, 12, 3) AS INT) + 1 AS VARCHAR), 3) AS no 
			FROM mPengajuan 
			WHERE SUBSTRING(No, 9, 2) = '{$tahun}' 
			  AND SUBSTRING(No, 11, 2) = '{$bulan}' 
			  AND SUBSTRING(No, 7, 1) = '{$cabang}' 
			ORDER BY No DESC
		";
	
		$result = $this->db->execute($query);
	
		if (!empty($result) && isset($result[0]['no'])) {
			$urutan = $result[0]['no'];
		} else {
			$urutan = '001';
		}
	
		return "{$prefix}{$urutan}";
	}	
	

	//-----------------------------------------------------------

	public function createDummyIssue() {
		try {
			// Generate unique issue number
			$issueNo = $this->generateTestIssueNumber();
			
			$dummyIssueData = [
				'No' => $issueNo,
				'prioritas' => 'Medium',
				'Tanggal' => date('Y-m-d H:i:s'),
				'dari' => 'TEST_USER_001',
				'tujuan' => '000830',
				'kategori' => 'Testing',
				'Jenis' => 'Test Issue',
				'Aplikasi' => 'Dummy App',
				'issue' => 'This is a test issue created for notification testing',
				'accPATA' => 1,
				'AcceptWork' => 1,
				'ditangani' => null,
				'TanggalSelesai' => null
			];
			
			$result = $this->db->insert("MIssue", $dummyIssueData);
			
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Dummy issue created successfully',
					'issue_no' => $issueNo
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'Failed to create dummy issue'
				]);
			}
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error creating dummy issue: ' . $e->getMessage()
			]);
		}
	}
	

	private function generateTestIssueNumber() {
		$year = date('Y');
		$shortYear = substr($year, -2);
		$timestamp = date('His'); // Hour, minute, second
		$random = rand(100, 999);
		return "TEST/$shortYear/$timestamp$random";
	}
	
	/**
	 * Create dummy chat messages for testing
	 */
	public function createDummyChat() {
		$NoIssue = isset($_POST['NoIssue']) ? $_POST['NoIssue'] : $this->generateTestIssueNumber();
		$Waktu = isset($_POST['Waktu']) ? $_POST['Waktu'] : date('Y-m-d H:i:s');
		$Dari = isset($_POST['Dari']) ? $_POST['Dari'] : 'TEST_USER_001';
		$Isi = isset($_POST['Isi']) ? $_POST['Isi'] : 'This is a test message for notification testing';
		$idUser = isset($_POST['idUser']) ? $_POST['idUser'] : '000830';
		
		try {
			// First ensure the issue exists (create if it doesn't)
			$this->ensureTestIssueExists($NoIssue);
			
			// Create the chat message
			$chatData = [
				'NoIssue' => $NoIssue,
				'Waktu' => $Waktu,
				'Dari' => $Dari,
				'Isi' => $Isi,
				'isRead' => 0, // Always unread for testing
				'idUser' => $idUser
			];
			
			$result = $this->db->insert("MComCli", $chatData);
			
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Dummy chat message created successfully',
					'data' => $chatData
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'Failed to create dummy chat message'
				]);
			}
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error creating dummy chat: ' . $e->getMessage()
			]);
		}
	}
	
	/**
	 * Ensure test issue exists, create if it doesn't
	 */
	private function ensureTestIssueExists($issueNo) {
		try {
			// Check if issue exists
			$checkQuery = "SELECT COUNT(*) as count FROM MIssue WHERE No = ?";
			$result = $this->db->execute($checkQuery, [$issueNo]);
			
			if ($result[0]['count'] == 0) {
				// Issue doesn't exist, create it
				$issueData = [
					'No' => $issueNo,
					'prioritas' => 'Medium',
					'Tanggal' => date('Y-m-d H:i:s'),
					'dari' => 'TEST_USER_001',
					'tujuan' => '000830',
					'kategori' => 'Testing',
					'Jenis' => 'Test Issue',
					'Aplikasi' => 'Test App',
					'issue' => 'Auto-created test issue for chat testing',
					'accPATA' => 1,
					'AcceptWork' => 1,
					'ditangani' => null,
					'TanggalSelesai' => null
				];
				
				$this->db->insert("MIssue", $issueData);
			}
			
			return true;
		} catch (Exception $e) {
			error_log("Error ensuring test issue exists: " . $e->getMessage());
			return false;
		}
	}
	
	/**
	 * Clear test data (remove dummy messages and issues)
	 */
	public function clearTestData() {
		try {
			// Delete test chat messages
			$deleteChatQuery = "DELETE FROM MComCli WHERE Dari LIKE 'TEST_%' OR NoIssue LIKE 'TEST/%'";
			$this->db->execute($deleteChatQuery);
			
			// Delete test issues  
			$deleteIssueQuery = "DELETE FROM MIssue WHERE No LIKE 'TEST/%' OR dari LIKE 'TEST_%'";
			$this->db->execute($deleteIssueQuery);
			
			return json_encode([
				'status' => 'success',
				'message' => 'Test data cleared successfully'
			]);
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error clearing test data: ' . $e->getMessage()
			]);
		}
	}
	
	/**
	 * Create multiple dummy messages for batch testing
	 */
	public function createBatchDummyChats() {
		$count = isset($_POST['count']) ? intval($_POST['count']) : 5;
		$targetUser = isset($_POST['targetUser']) ? $_POST['targetUser'] : '000830';
		
		try {
			$created = 0;
			$senders = ['000630', '000351', '000379', '000772', '000543'];
			$messages = [
				'Hello, I need help with my computer',
				'The printer is not working properly',
				'Can you help me reset my password?',
				'System is running very slow today',
				'Need assistance with software installation',
				'Error message keeps appearing',
				'Cannot access shared folder',
				'Email is not syncing properly',
				'Software license expired',
				'Network connection issues'
			];
			
			for ($i = 0; $i < $count; $i++) {
				$issueNo = $this->generateTestIssueNumber();
				$this->ensureTestIssueExists($issueNo);
				
				$chatData = [
					'NoIssue' => $issueNo,
					'Waktu' => date('Y-m-d H:i:s', time() + ($i * 60)), // Stagger by minutes
					'Dari' => $senders[$i % count($senders)],
					'Isi' => $messages[$i % count($messages)],
					'isRead' => 0,
					'idUser' => $targetUser
				];
				
				$result = $this->db->insert("MComCli", $chatData);
				if ($result) $created++;
			}
			
			return json_encode([
				'status' => 'success',
				'message' => "$created dummy chat messages created successfully",
				'created_count' => $created
			]);
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error creating batch dummy chats: ' . $e->getMessage()
			]);
		}
	}
	
	/**
	 * Get test data statistics
	 */
	public function getTestDataStats() {
		try {
			// Count test chats
			$chatQuery = "SELECT COUNT(*) as count FROM MComCli WHERE Dari LIKE 'TEST_%' OR NoIssue LIKE 'TEST/%'";
			$chatResult = $this->db->execute($chatQuery);
			$chatCount = $chatResult[0]['count'];
			
			// Count test issues
			$issueQuery = "SELECT COUNT(*) as count FROM MIssue WHERE No LIKE 'TEST/%' OR dari LIKE 'TEST_%'";
			$issueResult = $this->db->execute($issueQuery);
			$issueCount = $issueResult[0]['count'];
			
			// Count unread test messages
			$unreadQuery = "SELECT COUNT(*) as count FROM MComCli WHERE (Dari LIKE 'TEST_%' OR NoIssue LIKE 'TEST/%') AND isRead = 0";
			$unreadResult = $this->db->execute($unreadQuery);
			$unreadCount = $unreadResult[0]['count'];
			
			return json_encode([
				'status' => 'success',
				'stats' => [
					'test_chats' => $chatCount,
					'test_issues' => $issueCount,
					'unread_test_messages' => $unreadCount
				]
			]);
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error getting test data stats: ' . $e->getMessage()
			]);
		}
	}
}
?>