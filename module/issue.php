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

	public function getProses($idIssue = "") {
		$id_Issue = isset($_POST['id_Issue']) ? $_POST['id_Issue'] : $idIssue;
	
		$query = "
			SELECT 
				Ditangani,
				TanggalSelesai,
				CASE
					WHEN (Ditangani IS NULL OR LTRIM(RTRIM(Ditangani)) = '') AND (TanggalSelesai IS NULL) THEN 1
					WHEN (Ditangani IS NOT NULL AND LTRIM(RTRIM(Ditangani)) != '') AND (TanggalSelesai IS NULL) THEN 2
					WHEN (Ditangani IS NOT NULL AND LTRIM(RTRIM(Ditangani)) != '') AND (TanggalSelesai IS NOT NULL) THEN 3
					ELSE 0
				END AS StatusProses
			FROM mIssue 
			WHERE No = '$id_Issue'
		";
	
		$result = $this->db->execute($query);
	
		if ($result && isset($result[0])) {
			return json_encode([
				'status' => (int)$result[0]['StatusProses']
			]);
		} else {
			return json_encode([
				'status' => 0,
				'message' => 'Data tidak ditemukan atau query error',
				'query' => $query
			]);
		}
	}

	public function getComplete($idIssue = "") {
		$id_Issue = isset($_POST['id_Issue']) ? $_POST['id_Issue'] : $idIssue;
	
		$query = "
			SELECT *
			FROM mIssue 
			WHERE No = '$id_Issue'
		";
	
		$result = $this->db->execute($query);
	
		if ($result) {
			return json_encode([
				'data' => $result
			]);
		} else {
			return json_encode([
				'data' => $query
			]);
		}
	}

	public function pauseWork(){
		$No = $_POST['No'] ?? '';
		$reason = $_POST['reason'] ?? '';
		$emp_no = $_SESSION[_session_app_id]['emp_no'] ?? '';
		
		if (empty($No)) {
			return json_encode([
				'status' => 'error',
				'message' => 'Nomor issue tidak boleh kosong'
			]);
		}
		
		if (empty($emp_no)) {
			return json_encode([
				'status' => 'error',
				'message' => 'Session emp_no tidak ditemukan'
			]);
		}
		
		try {
			// Cek apakah issue sedang dikerjakan oleh user ini
			$issueCheck = $this->db->execute("
				SELECT Ditangani, TanggalSelesai 
				FROM MIssue 
				WHERE No = '$No' 
				AND Ditangani = '$emp_no'
				AND TanggalSelesai IS NULL
			");
			
			if (empty($issueCheck)) {
				return json_encode([
					'status' => 'error',
					'message' => 'Issue tidak sedang dikerjakan atau tidak ditemukan'
				]);
			}
			
			// Cek apakah sudah dalam status pause
			$activePause = $this->db->execute("
				SELECT TOP 1 *
				FROM MPause
				WHERE [No]   = '$No'   
				AND resumed IS NULL
				ORDER BY paused DESC;     
			");
			
			if (!empty($activePause)) {
				return json_encode([
					'status' => 'error',
					'message' => 'Issue sudah dalam status pause'
				]);
			}
			
			// Insert pause record
			$pauseTime = date('Y-m-d H:i:s');
			
			$result = $this->db->execute("
				INSERT INTO MPause (No, paused, reason) 
				VALUES ('$No', '$pauseTime', '$reason')
			");
			
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Pekerjaan berhasil di-pause',
					'data' => [
						'pause_time' => $pauseTime,
						'reason' => $reason
					]
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'Gagal menyimpan data pause'
				]);
			}
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			]);
		}
	}

	// Method untuk resume work
	private function calculatePauseDuration($startTime, $endTime)
{
    try {
        // Convert ke string jika berupa object
        if (is_object($startTime)) {
            if (isset($startTime->date)) {
                $startTime = $startTime->date;
            } else {
                $startTime = (string) $startTime;
            }
        }
        
        if (is_object($endTime)) {
            if (isset($endTime->date)) {
                $endTime = $endTime->date;
            } else {
                $endTime = (string) $endTime;
            }
        }
        
        // Pastikan format string yang benar
        $startTime = trim($startTime);
        $endTime = trim($endTime);
        
        // Create DateTime objects
        $start = new DateTime($startTime);
        $end = new DateTime($endTime);
        
        // Calculate difference in minutes
        $diff = $end->getTimestamp() - $start->getTimestamp();
        return floor($diff / 60);
        
    } catch (Exception $e) {
        // Log error untuk debugging
        error_log("calculatePauseDuration error: " . $e->getMessage());
        error_log("startTime: " . print_r($startTime, true));
        error_log("endTime: " . print_r($endTime, true));
        
        // Return 0 jika ada error
        return 0;
    }
}

	// Fixed resumeWork method dengan error handling yang lebih baik
	public function resumeWork()
	{
		$No = $_POST['No'] ?? '';
		$emp_no = $_SESSION[_session_app_id]['emp_no'] ?? '';
		
		if (empty($No)) {
			return json_encode([
				'status' => 'error',
				'message' => 'Nomor issue tidak boleh kosong'
			]);
		}
		
		if (empty($emp_no)) {
			return json_encode([
				'status' => 'error',
				'message' => 'Session emp_no tidak ditemukan'
			]);
		}
		
		try {
			// Cari pause record yang aktif
			$activePause = $this->db->execute("
				SELECT TOP 1 *
				FROM MPause
				WHERE [No] = '$No'   
				AND resumed IS NULL
				ORDER BY paused DESC
			");
			
			if (empty($activePause)) {
				return json_encode([
					'status' => 'error',
					'message' => 'Tidak ada pause aktif yang ditemukan'
				]);
			}
			
			$pauseRecord = $activePause[0];
			$pausedTime = $pauseRecord['paused'];
			$resumeTime = date('Y-m-d H:i:s');
			
			// Debug log untuk melihat format data
			error_log("pausedTime type: " . gettype($pausedTime));
			error_log("pausedTime value: " . print_r($pausedTime, true));
			
			// Update pause record dengan waktu resume
			$result = $this->db->execute("
				UPDATE MPause 
				SET resumed = '$resumeTime'
				WHERE [No] = '$No'   
				AND resumed IS NULL
			");
			
			if ($result) {
				// Calculate pause duration dengan error handling
				$pauseDuration = $this->calculatePauseDuration($pausedTime, $resumeTime);
				
				return json_encode([
					'status' => 'success',
					'message' => 'Pekerjaan berhasil dilanjutkan',
					'data' => [
						'resume_time' => $resumeTime,
						'pause_duration' => $pauseDuration,
						'debug' => [
							'paused_time_type' => gettype($pausedTime),
							'paused_time_value' => is_object($pausedTime) ? 'object' : $pausedTime
						]
					]
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'Gagal update data resume'
				]);
			}
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage(),
				'debug' => [
					'error_line' => $e->getLine(),
					'error_file' => $e->getFile()
				]
			]);
		}
	}

	// Method untuk mendapatkan data pause
	public function getPauseData(){
		error_log("=== DEBUG getPauseData START ===");
		
		// Debug POST data
		error_log("POST data received: " . print_r($_POST, true));
		
		$No = $_POST['No'] ?? '';
		error_log("No extracted: '" . $No . "'");
		
		if (empty($No)) {
			error_log("ERROR: No is empty");
			return json_encode([
				'status' => 'error',
				'message' => 'Nomor issue tidak boleh kosong'
			]);
		}
		
		// Debug session data
		error_log("Session data: " . print_r($_SESSION, true));
		
		// Fix: Get emp_no from session
		$emp_no = $_SESSION[_session_app_id]['emp_no'] ?? '';
		error_log("emp_no from session: '" . $emp_no . "'");
		
		if (empty($emp_no)) {
			error_log("ERROR: emp_no is empty from session");
			return json_encode([
				'status' => 'error',
				'message' => 'Session emp_no tidak ditemukan'
			]);
		}
		
		try {
			// Query untuk menghitung total pause dengan presisi milidetik
			$totalPauseQuery = "
				SELECT 
					SUM(CASE 
						WHEN resumed IS NOT NULL THEN 
							DATEDIFF(MILLISECOND, paused, resumed)
						ELSE 0
					END) as total_pause_milliseconds,
					COUNT(CASE WHEN resumed IS NULL THEN 1 END) as active_pause_count
				FROM MPause 
				WHERE No = '$No'
			";
			error_log("Total pause query (millisecond precision): " . $totalPauseQuery);
		
			$pauseResult = $this->db->execute($totalPauseQuery);
			error_log("Total pause result: " . print_r($pauseResult, true));
		
			// Ambil hasil dalam milidetik
			$totalPauseMilliseconds = $pauseResult[0]['total_pause_milliseconds'] ?? 0;
			$activePauseCount = $pauseResult[0]['active_pause_count'] ?? 0;
		
			error_log("Total pause milliseconds: " . $totalPauseMilliseconds);
			
			// Konversi milidetik ke jam:menit:detik untuk display
			$totalPauseDisplay = $this->convertMillisecondsToDisplay($totalPauseMilliseconds);
			
			// Juga hitung dalam menit untuk kompatibilitas dengan JavaScript timer
			$totalPauseMinutes = floor($totalPauseMilliseconds / (1000 * 60));
			
			error_log("Total pause display: " . $totalPauseDisplay);
			error_log("Total pause minutes: " . $totalPauseMinutes);
			error_log("Active pause count: " . $activePauseCount);
		
			// Cek apakah sedang dalam status pause
			$isPaused = $activePauseCount > 0;
		
			// Ambil current pause start jika ada pause aktif
			$currentPauseStart = null;
			if ($isPaused) {
				$activePauseQuery = "
					SELECT TOP 1 paused
					FROM MPause
					WHERE [No] = '$No'   
					AND resumed IS NULL
					ORDER BY paused DESC
				";
				error_log("Active pause query: " . $activePauseQuery);
				
				$activePause = $this->db->execute($activePauseQuery);
				error_log("Active pause result: " . print_r($activePause, true));
				
				if (!empty($activePause)) {
					$currentPauseStart = $activePause[0]['paused'];
					error_log("Current pause start time: " . print_r($currentPauseStart, true));
				}
			} else {
				error_log("No active pause found");
			}
		
			error_log("Is currently paused: " . ($isPaused ? 'YES' : 'NO'));
			error_log("Final total pause display: " . $totalPauseDisplay);
		
			// Prepare response dengan format display yang presisi
			$responseData = [
				'status' => 'success',
				'message' => 'Data pause berhasil diambil',
				'totalPause' => $totalPauseMinutes, // Untuk kompatibilitas (dalam menit)
				'totalPauseDisplay' => $totalPauseDisplay, // Format HH:MM:SS untuk display
				'totalPauseMilliseconds' => $totalPauseMilliseconds, // Data mentah untuk perhitungan lanjutan
				'isPaused' => $isPaused,
				'currentPauseStart' => $currentPauseStart
			];
			
			error_log("Response data prepared: " . print_r($responseData, true));
			
			$jsonResponse = json_encode($responseData);
			error_log("Final JSON response: " . $jsonResponse);
			error_log("=== DEBUG getPauseData END (SUCCESS) ===");
			
			return $jsonResponse;
			
		} catch (Exception $e) {
			error_log("=== EXCEPTION in getPauseData ===");
			error_log("Exception message: " . $e->getMessage());
			error_log("Exception line: " . $e->getLine());
			error_log("Exception file: " . $e->getFile());
			error_log("Exception trace: " . $e->getTraceAsString());
			
			$errorResponse = [
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage(),
				'debug' => [
					'line' => $e->getLine(),
					'file' => basename($e->getFile()),
					'trace' => $e->getTraceAsString()
				]
			];
			
			error_log("Error response: " . json_encode($errorResponse));
			error_log("=== DEBUG getPauseData END (ERROR) ===");
			
			return json_encode($errorResponse);
		}
	}

	private function convertMillisecondsToDisplay($milliseconds) {
		if ($milliseconds <= 0) {
			return "00:00:00";
		}
		
		// Konversi ke detik (dengan pembulatan)
		$totalSeconds = round($milliseconds / 1000);
		
		// Hitung jam, menit, detik
		$hours = floor($totalSeconds / 3600);
		$minutes = floor(($totalSeconds % 3600) / 60);
		$seconds = $totalSeconds % 60;
		
		// Format dengan leading zeros
		return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
	}
	
	// Method untuk mendapatkan riwayat pause (opsional)
	public function getPauseHistory()
	{
		$No = $_POST['No'] ?? '';
		$emp_no = $_SESSION[_session_app_id]['emp_no'] ?? '';
		
		if (empty($No)) {
			return json_encode([
				'status' => 'error',
				'message' => 'Nomor issue tidak boleh kosong'
			]);
		}
		
		try {
			$pauseHistory = $this->db->execute("
				SELECT 
					paused,
					resumed,
					reason,
					CASE 
						WHEN resumed IS NULL THEN 'Active'
						ELSE 'Completed'
					END as status
				FROM MPause 
				WHERE No = '$No' 
				AND emp_no = '$emp_no'
				ORDER BY paused DESC
			");
			
			// Hitung durasi untuk setiap pause
			foreach ($pauseHistory as &$pause) {
				if ($pause['resumed']) {
					$pause['duration_minutes'] = $this->calculatePauseDuration($pause['paused'], $pause['resumed']);
				} else {
					$pause['duration_minutes'] = null; // Masih aktif
				}
			}
			
			return json_encode([
				'status' => 'success',
				'message' => 'Riwayat pause berhasil diambil',
				'data' => $pauseHistory
			]);
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			]);
		}
	}

	// Update method getTimerInfo yang sudah ada untuk include pause data
	public function getTimerInfo()
	{
		$id_Issue = $_POST['id_Issue'] ?? '';
		
		if (empty($id_Issue)) {
			return json_encode([
				'status' => 'error',
				'message' => 'ID Issue tidak boleh kosong'
			]);
		}
		
		try {
			// Get issue data (gunakan query yang sudah ada)
			$issueData = $this->db->execute("
				SELECT AcceptWork, EstIT, TanggalSelesai, Ditangani
				FROM MIssue 
				WHERE No = '$id_Issue'
			");
			
			if (empty($issueData)) {
				return json_encode([
					'status' => 'error',
					'message' => 'Issue tidak ditemukan'
				]);
			}
			
			$issue = $issueData[0];
			
			// Tambahkan data pause jika ada
			$pauseQuery = "
			SELECT 
				SUM(DATEDIFF(MINUTE, paused, resumed)) as total_pause_minutes,
				COUNT(CASE WHEN resumed IS NULL THEN 1 END) as active_pause_count
			FROM MPause 
			WHERE No = '$id_Issue'
			";

			$pauseResult = $this->db->execute($pauseQuery);

			// Langsung assign hasil ke variable
			$totalPauseMinutes = $pauseResult[0]['total_pause_minutes'] ?? 0;
			$hasActivePause = ($pauseResult[0]['active_pause_count'] ?? 0) > 0;

			// PauseInfo langsung berisi hasil final
			$pauseInfo = [
				'total_pause_minutes' => $totalPauseMinutes,
				'has_active_pause' => $hasActivePause
			];

		return json_encode([
			'status' => 'success',
			'message' => 'Timer info berhasil diambil',
			'data' => array_merge($issue, $pauseInfo)
		]);
					
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			]);
		}
	}
	
	public function getMyIssue($idUser = "") {
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

	public function getAllPengajuanForIT() {
		$emp_no = $_SESSION[_session_app_id]['emp_no'] ?? '';
		$department = $_SESSION[_session_app_id]['id_dept'] ?? '';
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 20;
		$offset = ($page - 1) * $limit;
		
		try {
			// Cek apakah user adalah bagian dari IT department
			$isITDepartment = $this->checkITDepartmentAccess($emp_no);
			
			if (!$isITDepartment) {
				return json_encode([
					'status' => 'error', 
					'message' => 'Access denied. Only IT Department can view all submissions.',
					'data' => []
				]);
			}
			
			// Query untuk mendapatkan semua pengajuan dengan konfirmasi = '0' (untuk IT review)
			$query = "
				SELECT * FROM mPengajuan
				WHERE konfirmasi = '0'
				ORDER BY Tanggal DESC
			";
			
			// Execute query with pagination
			if ($limit > 0) {
				$query .= " OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
			}
			
			$result = $this->db->execute($query);
			
			// Query untuk total count
			$countQuery = "SELECT COUNT(*) as total FROM mPengajuan WHERE konfirmasi = '0'";
			$countResult = $this->db->execute($countQuery);
			$totalCount = $countResult[0]['total'] ?? 0;
			
			// Format status dan currency untuk setiap record
			foreach ($result as $key => $row) {
				$result[$key]['Status'] = $this->formatStatusBadge($row['Status'] ?? 'Pending');
				$result[$key]['biaya'] = $this->formatCurrency($row['biaya'] ?? 0);
			}
			
			return json_encode([
				'status' => 'success',
				'data' => $result,
				'total_count' => $totalCount,
				'current_page' => $page,
				'per_page' => $limit
			]);
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error: ' . $e->getMessage(),
				'data' => []
			]);
		}
	}
	
	public function getAllPengajuan() {
		$emp_no = $_SESSION[_session_app_id]['emp_no'] ?? '';
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 20;
		$offset = ($page - 1) * $limit;
		
		try {
			// Query untuk mendapatkan pengajuan milik user saat ini dengan konfirmasi = '1'
			$query = "
				SELECT * FROM mPengajuan
				WHERE dari = '$emp_no' AND konfirmasi = '1'
				ORDER BY Tanggal DESC
			";
			
			// Execute query with pagination
			if ($limit > 0) {
				$query .= " OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
			}
			
			$result = $this->db->execute($query);
			
			// Query untuk total count
			$countQuery = "SELECT COUNT(*) as total FROM mPengajuan WHERE dari = '$emp_no' AND konfirmasi = '1'";
			$countResult = $this->db->execute($countQuery);
			$totalCount = $countResult[0]['total'] ?? 0;
			
			// Format status dan currency untuk setiap record
			foreach ($result as $key => $row) {
				$result[$key]['Status'] = $this->formatStatusBadge($row['Status'] ?? 'Pending');
				$result[$key]['biaya'] = $this->formatCurrency($row['biaya'] ?? 0);
			}
			
			return json_encode([
				'status' => 'success',
				'data' => $result,
				'total_count' => $totalCount,
				'current_page' => $page,
				'per_page' => $limit
			]);
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error: ' . $e->getMessage(),
				'data' => []
			]);
		}
	}
	
	public function checkITDepartmentAccess($emp_no) {
		try {
			// Cek dari database lokal atau session
			$department = $_SESSION[_session_app_id]['id_dept'] ?? '';
			
			// Jika department sudah ada di session
			if ($department === '1') {
				return true;
			}
			
			return false;
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function formatStatusBadge($status) {
		$status = strtolower(trim($status));
		
		switch ($status) {
			case 'pending':
				return '<span class="badge badge-pending">Pending</span>';
			case 'approved':
			case 'disetujui':
				return '<span class="badge badge-approved">Approved</span>';
			case 'rejected':
			case 'ditolak':
				return '<span class="badge badge-rejected">Rejected</span>';
			case 'review':
			case 'under review':
			case 'dalam review':
				return '<span class="badge badge-review">Under Review</span>';
			default:
				return '<span class="badge badge-pending">Pending</span>';
		}
	}
	
	public function formatCurrency($amount) {
		if (is_numeric($amount)) {
			return 'Rp ' . number_format($amount, 0, ',', '.');
		}
		return $amount;
	}
	
	public function getPengajuanById($id) {
		try {
			$query = "
				SELECT 
					p.*,
					-- Informasi pegawai dari
					pg_dari.first_name as emp_name_dari,
					pg_dari.id_dept as dept_dari,
					-- Informasi pegawai kepada  
					pg_kepada.first_name as emp_name_kepada,
					pg_kepada.id_dept as dept_kepada,
					-- Informasi pegawai up
					pg_up.first_name as emp_name_up,
					pg_up.id_dept as dept_up
				FROM mPengajuan p
				LEFT JOIN (
					SELECT emp_no, first_name, id_dept 
					FROM GetAllPegawai_View 
				) pg_dari ON p.Dari = pg_dari.emp_no
				LEFT JOIN (
					SELECT emp_no, first_name, id_dept 
					FROM GetAllPegawai_View 
				) pg_kepada ON p.Kepada = pg_kepada.emp_no
				LEFT JOIN (
					SELECT emp_no, first_name, id_dept 
					FROM GetAllPegawai_View 
				) pg_up ON p.up = pg_up.emp_no
				WHERE p.No = '$id'
			";
			
			$result = $this->db->execute($query);
			
			if (!empty($result)) {
				// Get attachments
				$attachQuery = "SELECT * FROM GBPengajuan WHERE No = '$id' ORDER BY Seq";
				$attachments = $this->db->execute($attachQuery);
				$result[0]['attachments'] = $attachments;
				
				return json_encode([
					'status' => 'success',
					'data' => $result[0]
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'Pengajuan tidak ditemukan'
				]);
			}
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Error: ' . $e->getMessage()
			]);
		}
	}
	
	public function updatePengajuanStatus() {
		$no = isset($_POST['No']) ? trim(strval($_POST['No'])) : "";
		$status = isset($_POST['status']) ? trim(strval($_POST['status'])) : "";
		$keterangan_it = isset($_POST['keterangan_it']) ? trim(strval($_POST['keterangan_it'])) : "";
		$emp_no = $_SESSION[_session_app_id]['emp_no'] ?? '';
		
		try {
			// Cek akses IT department
			$isITDepartment = $this->checkITDepartmentAccess($emp_no);
			
			if (!$isITDepartment) {
				return json_encode([
					'status' => 'error', 
					'message' => 'Access denied. Only IT Department can update status.'
				]);
			}
			
			$updateData = [
				"Status" => $status,
				"updated_at" => date("Y-m-d H:i:s"),
				"updated_by" => $emp_no
			];
			
			if (!empty($keterangan_it)) {
				$updateData["keterangan_it"] = $keterangan_it;
			}
			
			$result = $this->db->update("mPengajuan", $updateData, ["No" => $no]);
			
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Status pengajuan berhasil diupdate'
				]);
			} else {
				return json_encode([
					'status' => 'error', 
					'message' => 'Failed to update status'
				]);
			}
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error', 
				'message' => 'Error: ' . $e->getMessage()
			]);
		}
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

	public function getIssueImages($No) {
		$No = trim($No);
		$NoSafe = str_replace("'", "''", $No);
	
		$result = $this->db->execute("SELECT NamaFile FROM GBIssue WHERE No = '$NoSafe' ORDER BY Seq ASC");
	
		if ($result) {
			return json_encode([
				'status' => 'success',
				'data' => $result
			]);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Failed to fetch images']);
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

	public function checkKerjaan($ditangani = ''){
		$ditangani = isset($_POST['ditangani']) ? trim(strval($_POST['ditangani'])) : trim(strval($ditangani));
		
		if (!$ditangani) {
			echo json_encode(['status' => 'error', 'message' => 'Emp No tidak dikirim']);
			return;
		}
	
		$result = $this->db->execute("SELECT TOP 1 No
				FROM MIssue 
				WHERE Ditangani = $ditangani
				AND AcceptWork IS NOT NULL 
				AND TanggalSelesai IS NULL 
				ORDER BY Tanggal DESC");
	
		if ($result) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Issue successfully taken',
				'data' => $result, 
			], JSON_UNESCAPED_SLASHES);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Tidak ada issue aktif'
			]);
		}
	}
	
	public function kerjakanIssue($No = "", $estimasiMenit = 0) {
		// Ambil dan bersihkan nilai No
		$No = isset($_POST['No']) ? $_POST['No'] : $No;
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
	
			$updateQuery1 = "UPDATE MIssue SET Ditangani = '$currentUser', EstIT = '$estimasiMenit' WHERE No = '$No'";
			$result1 = $this->db->execute($updateQuery1);
			
			if ($result1 !== false) {
				$updateQuery2 = "UPDATE MIssue SET AcceptWork = '$currentDateTime' WHERE No = '$No'";
				$result2 = $this->db->execute($updateQuery2);
				
				if ($result2 !== false) {
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
		$No = isset($_POST['No']) ? trim($_POST['No']) : trim($No);
		$solusi = isset($_POST['solusi']) ? trim($_POST['solusi']) : trim($solusi);
		$catatan = isset($_POST['catatan']) ? trim($_POST['catatan']) : trim($catatan);
	
		$currentUser = $_SESSION[_session_app_id]['emp_no'] ?? '';
		$currentDateTime = date('Y-m-d H:i:s');
	
		try {
			// Escape karakter untuk keamanan SQL
			$NoSafe = str_replace("'", "''", $No);
			$solusiSafe = str_replace("'", "''", $solusi);
			$catatanSafe = str_replace("'", "''", $catatan);
	
			// 1. Cek apakah issue ada
			$checkQuery = "SELECT Ditangani, EstIT, TanggalSelesai FROM MIssue WHERE No = '$NoSafe'";
			$existingIssue = $this->db->execute($checkQuery);
	
			if (empty($existingIssue)) {
				return json_encode(['status' => 'error', 'message' => 'Issue not found']);
			}
	
			$row = $existingIssue[0];
	
			// 2. Validasi user
			if (trim($row['Ditangani']) !== $currentUser) {
				return json_encode(['status' => 'error', 'message' => 'You are not assigned to this issue']);
			}
	
			// 3. Cek apakah sudah selesai
			if (!empty($row['TanggalSelesai'])) {
				return json_encode(['status' => 'error', 'message' => 'Issue already completed']);
			}
			$gabunganSolusi = "Solusi: $solusi\nCatatan IT: $catatan";
			$gabunganSolusiSafe = str_replace("'", "''", $gabunganSolusi);

			// 4. Update data
			$updateQuery = "
			UPDATE MIssue 
			SET TanggalSelesai = '$currentDateTime',
				Solusi = '$gabunganSolusiSafe'
			WHERE No = '$NoSafe'";

			
				
			$result = $this->db->execute($updateQuery);
	
			if ($result !== false) {
				return json_encode([
					'status' => 'success',
					'message' => 'Issue successfully completed',
					'data' => [
						'No' => $No,
						'TanggalSelesai' => $currentDateTime,
						'Solusi' => $gabunganSolusiSafe
					]
				]);
			} else {
				return json_encode(['status' => 'error', 'message' => 'Failed to complete issue']);
			}
	
		} catch (Exception $e) {
			return json_encode(['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()]);
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
		
		return json_encode($newID, JSON_UNESCAPED_SLASHES);
	}
	
	public function getAtP(){
		$query = "SELECT TOP 1 MPATA FROM MAtP;";
		$result = $this->db->execute($query);

		if (!$result || empty($result)) {
			return json_encode(0); 
		}

		return json_encode(intval($result[0]['MPATA'])); 
	}

	public function getNotif($id_issue = "") {
		$id_issue = isset($_POST['id_issue']) ? trim($_POST['id_issue']) : trim($id_issue);
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
			WHERE idUser = '$id_issue'
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
					"autopilot" => 1,
					"TanggalKonfirmasi" => $TanggalKonfirmasi,
					"Konfirmasi" => 1
				]);
			}
			elseif($accPATA == 0){
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
					"autopilot" => 0,
					"TanggalKonfirmasi" => NULL,
					"Konfirmasi" => 0
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
					"Konfirmasi" => 1,
					'st_gmbr' => $st_gmbr
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

	public function getPendingIssues($page = 1, $rowsPerPage = 20) {
		$page = isset($_POST['page']) ? $_POST['page'] : $page; 
		$rowsPerPage = isset($_POST['rowsPerPage']) ? $_POST['rowsPerPage'] : $rowsPerPage;
		$offset = ($page - 1) * $rowsPerPage;
		
		try {
			// Count total pending issues
			$countQuery = "
				SELECT COUNT(*) AS total 
				FROM MIssue 
				WHERE Konfirmasi = 0
				AND Ditangani IS NULL 
				AND TanggalSelesai IS NULL
			";
			$countResult = $this->db->execute($countQuery);
			$totalCount = $countResult ? $countResult[0]['total'] : 0;
			
			// Get pending issues with pagination
			$query = "
				SELECT * 
				FROM MIssue 
				WHERE Konfirmasi = 0 
				AND Ditangani IS NULL 
				AND TanggalSelesai IS NULL
				ORDER BY Tanggal DESC
				OFFSET $offset ROWS
				FETCH NEXT $rowsPerPage ROWS ONLY
			";
			$result = $this->db->execute($query);
			
			return json_encode([
				'status' => 'success',
				'data' => $result,
				'total_count' => $totalCount,
				'current_page' => $page,
				'rows_per_page' => $rowsPerPage
			]);
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage(),
				'data' => [],
				'total_count' => 0
			]);
		}
	}
	
	public function acceptIssue() {
		$issueNo = isset($_POST['issueNo']) ? trim($_POST['issueNo']) : '';
		$notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
		$currentUser = $_SESSION[_session_app_id]['emp_no'] ?? '';
		$currentTime = date('Y-m-d H:i:s');
		
		if (empty($issueNo)) {
			return json_encode([
				'status' => 'error',
				'message' => 'Issue number is required'
			]);
		}
		
		try {
			// Update issue to set konfirmasi = 1 and other details
			$query = "
				UPDATE MIssue 
				SET Konfirmasi = 1,
					TanggalKonfirmasi = $currentTime,
					NotePATA = $notes
				WHERE No = $issueNo
			";
			
			$result = $this->db->execute($query);
			
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Issue accepted successfully',
					'issueNo' => $issueNo
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'Failed to accept issue'
				]);
			}
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			]);
		}
	}
	
	public function denyIssue() {
		$issueNo = isset($_POST['issueNo']) ? trim($_POST['issueNo']) : '';
		$notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
		$currentUser = $_SESSION[_session_app_id]['emp_no'] ?? '';
		$currentTime = date('Y-m-d H:i:s');
		
		if (empty($issueNo)) {
			return json_encode([
				'status' => 'error',
				'message' => 'Issue number is required'
			]);
		}
		
		try {
			// Update issue to set konfirmasi = 0 (denied) and add notes
			$query = "
				UPDATE MIssue 
				SET Konfirmasi = 0,
					TanggalKonfirmasi = ?,
					NotePATA = ?,
					Status = 'Denied'
				WHERE No = ?
			";
			
			$result = $this->db->execute($query, [
				$currentTime,
				$notes,
				$issueNo
			]);
			
			if ($result) {
				return json_encode([
					'status' => 'success',
					'message' => 'Issue denied successfully',
					'issueNo' => $issueNo
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'Failed to deny issue'
				]);
			}
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			]);
		}
	}
	
	public function updateAtP() {
		$status = isset($_POST['status']) ? intval($_POST['status']) : 0;
		
		try {
			// Check if record exists in MAtp table
			$checkQuery = "SELECT COUNT(*) as count FROM MAtp";
			$checkResult = $this->db->execute($checkQuery);
			
			if ($checkResult && $checkResult[0]['count'] > 0) {
				// Update existing record
				$query = "UPDATE MAtp SET MPATA = ?";
				$result = $this->db->execute($query, [$status]);
			} else {
				// Insert new record if table is empty
				$query = "INSERT INTO MAtp (MPATA) VALUES (?)";
				$result = $this->db->execute($query, [$status]);
			}
			
			if ($result) {
				return json_encode([
					'status' => 'success',
					'autopilot' => $status,
					'message' => $status ? 'Autopilot activated' : 'Autopilot deactivated'
				]);
			} else {
				return json_encode([
					'status' => 'error',
					'message' => 'Failed to update autopilot status'
				]);
			}
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage()
			]);
		}
	}
	
	// Method untuk mendapatkan data user (jika diperlukan)
	public function getAllUsers() {
		try {
			// Adjust this query based on your user table structure
			$query = "SELECT emp_no, first_name FROM MPegawai ORDER BY first_name ASC";
			$result = $this->db->execute($query);
			
			return json_encode([
				'status' => 'success',
				'data' => $result
			]);
			
		} catch (Exception $e) {
			return json_encode([
				'status' => 'error',
				'message' => 'Database error: ' . $e->getMessage(),
				'data' => []
			]);
		}
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