<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="card">
                    <h5 class="card-header" style="font-size:32px; color: #00a652;">
                        <b>Edit Detail Pengajuan</b>
                        <span id="departmentInfo" class="badge bg-secondary float-end"></span>
                    </h5>

                    <div class="card-body">
                        <form id="pengajuanForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="nomorPengajuan" class="form-control" readonly>
                                        <label for="nomorPengajuan">Nomor Pengajuan</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="datetime-local" id="tanggalPengajuan" class="form-control">
                                        <label for="tanggalPengajuan">Tanggal Pengajuan</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="pemohon" class="form-control" readonly>
                                        <label for="pemohon">Nama Pemohon</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="departemen" class="form-control" readonly>
                                        <label for="departemen">Departemen</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="biayaPengajuan" class="form-control" placeholder="Rp 0">
                                        <label for="biayaPengajuan">Biaya Pengajuan</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select id="cabang" class="form-select">
                                            <option value="P">PUSAT</option>
                                            <option value="B">Lampung</option>
                                            <option value="R">Semarang</option>
                                            <option value="U">Makassar</option>
                                            <option value="V">Jakarta</option>
                                            <option value="W">Palembang</option>
                                            <option value="Y">Medan</option>
                                        </select>
                                        <label for="cabang">Cabang</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="namaInvestasi" class="form-control" placeholder="Masukkan nama investasi...">
                                        <label for="namaInvestasi">Nama Investasi</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea id="keterangan" class="form-control" style="height: 120px;" placeholder="Jelaskan detail pengajuan Anda..."></textarea>
                                        <label for="keterangan">Keterangan</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="dokumenPendukung" class="form-label">Dokumen Pendukung</label>
                                    <input type="file" id="dokumenPendukung" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.png">
                                    <div id="existingFiles" class="mt-2"></div>
                                </div>
                            </div>

                            <!-- Analisa IT Section - Only visible for IT Department -->
                            <div id="analisaSection" class="mt-4" style="display: none;">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0">🔧 Analisa IT</h6>
                                        <small>Section khusus untuk IT Department</small>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="teknisiPenanggung" class="form-select">
                                                        <option value="">Pilih Teknisi</option>
                                                    </select>
                                                    <label for="teknisiPenanggung">Teknisi Penanggung Jawab</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="estimasiWaktu" class="form-select">
                                                        <option value="1-3 hari">1-3 hari</option>
                                                        <option value="4-7 hari">4-7 hari</option>
                                                        <option value="1-2 minggu">1-2 minggu</option>
                                                        <option value="2-4 minggu">2-4 minggu</option>
                                                        <option value="1+ bulan">1+ bulan</option>
                                                    </select>
                                                    <label for="estimasiWaktu">Estimasi Waktu Penyelesaian</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="estimasiBiaya" class="form-control" placeholder="Rp 0">
                                                    <label for="estimasiBiaya">Estimasi Biaya IT</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="statusAnalisa" class="form-select" onchange="updateStatusIndicator()">
                                                        <option value="Pending">Pending</option>
                                                        <option value="In Progress">In Progress</option>
                                                        <option value="Completed">Completed</option>
                                                    </select>
                                                    <label for="statusAnalisa">Status Analisa</label>
                                                </div>
                                                <div class="status-indicator mt-2">
                                                    <div class="status-dot status-pending" id="statusDot"></div>
                                                    <span id="statusText" class="ms-2">Menunggu analisa</span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea id="catatanAnalisa" class="form-control" style="height: 100px;" placeholder="Masukkan catatan analisa IT..."></textarea>
                                                    <label for="catatanAnalisa">Catatan Analisa</label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <textarea id="rekomendasiIT" class="form-control" style="height: 100px;" placeholder="Berikan rekomendasi..."></textarea>
                                                    <label for="rekomendasiIT">Rekomendasi IT</label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="statusPengajuan" class="form-select">
                                                        <option value="Pending">Pending</option>
                                                        <option value="Under Review">Under Review</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Rejected">Rejected</option>
                                                    </select>
                                                    <label for="statusPengajuan">Update Status Pengajuan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-secondary me-2" onclick="kembaliKeList()">
                                        <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                    </button>
                                    
                                    <button type="button" class="btn btn-danger me-2" id="btnTolak" onclick="tolakPengajuan()" style="display: none;">
                                        <i class="mdi mdi-close me-1"></i>Tolak
                                    </button>
                                    
                                    <button type="button" class="btn btn-primary me-2" onclick="simpanPerubahan()">
                                        <i class="mdi mdi-content-save me-1"></i>Simpan
                                    </button>
                                    
                                    <button type="button" class="btn btn-success" id="btnApprove" onclick="approvePengajuan()" style="display: none;">
                                        <i class="mdi mdi-check me-1"></i>Approve
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Toast -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
    <div id="notificationToast" class="toast" role="alert">
        <div class="toast-header">
            <i class="mdi mdi-information me-2"></i>
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body" id="toastMessage"></div>
    </div>
</div>

<style>
.status-indicator {
    display: flex;
    align-items: center;
}

.status-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

.status-pending { background: #fbbf24; }
.status-progress { background: #3b82f6; }
.status-completed { background: #10b981; }

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.department-it {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%) !important;
}

#existingFiles .file-item {
    display: flex;
    align-items: center;
    padding: 5px 10px;
    background: #f8f9fa;
    border-radius: 5px;
    margin: 3px 0;
}

#existingFiles .file-item a {
    text-decoration: none;
    color: #495057;
}

#existingFiles .file-item:hover {
    background: #e9ecef;
}
</style>

<script type="text/javascript">
    // Global variables
    let pengajuanId = '';
    let userDept = '<?= $_SESSION[_session_app_id]['id_dept'] ?? '' ?>';
    let userEmpNo = '<?= $_SESSION[_session_app_id]['emp_no'] ?? '' ?>';
    let userName = '<?= $_SESSION[_session_app_id]['first_name'] ?? '' ?>';
    let isITDepartment = userDept === '1';
    let pengajuanData = {};

    // Initialize page
    function initializePage() {
        // Get pengajuan ID from URL
        const urlParams = new URLSearchParams(window.location.search);
        pengajuanId = urlParams.get('id');
        
        if (!pengajuanId) {
            showNotification('ID pengajuan tidak ditemukan', 'error');
            setTimeout(() => kembaliKeList(), 2000);
            return;
        }

        // Set department info
        document.getElementById('departmentInfo').textContent = `Department: ${userDept}`;
        if (isITDepartment) {
            document.getElementById('departmentInfo').classList.add('department-it');
            document.getElementById('analisaSection').style.display = 'block';
            document.getElementById('btnTolak').style.display = 'inline-block';
            document.getElementById('btnApprove').style.display = 'inline-block';
            
            // Add current user as default teknisi
            $('#teknisiPenanggung').append(`<option value="${userEmpNo}" selected>${userName}</option>`);
        }

        // Load pengajuan data
        loadPengajuanData();
    }

    // Load pengajuan data
    function loadPengajuanData() {
        sendPost("Issue", {
            type_submit: "getPengajuanById",
            id: pengajuanId
        }, function(response) {
            if (response.status === 'success') {
                pengajuanData = response.data;
                populateForm(pengajuanData);
            } else {
                showNotification(response.message || 'Gagal memuat data pengajuan', 'error');
                setTimeout(() => kembaliKeList(), 2000);
            }
        });
    }

    // Populate form with data
    function populateForm(data) {
        document.getElementById('nomorPengajuan').value = data.No || '';
        document.getElementById('namaInvestasi').value = data.namainvestasi || '';
        document.getElementById('biayaPengajuan').value = data.biaya || '';
        document.getElementById('cabang').value = data.cabang || 'P';
        document.getElementById('keterangan').value = data.keterangan || '';
        document.getElementById('pemohon').value = data.emp_name_dari || data.Dari || '';
        document.getElementById('departemen').value = data.dept_dari || '';
        
        // Format datetime-local
        if (data.Tanggal) {
            const date = new Date(data.Tanggal);
            const formattedDate = date.toISOString().slice(0, 16);
            document.getElementById('tanggalPengajuan').value = formattedDate;
        }

        // IT Fields
        if (isITDepartment) {
            document.getElementById('estimasiBiaya').value = data.estimasi_biaya_it || '';
            document.getElementById('estimasiWaktu').value = data.estimasi_waktu || '1-3 hari';
            document.getElementById('statusAnalisa').value = data.status_analisa || 'Pending';
            document.getElementById('catatanAnalisa').value = data.catatan_analisa || '';
            document.getElementById('rekomendasiIT').value = data.rekomendasi_it || '';
            document.getElementById('statusPengajuan').value = data.Status || 'Pending';
            updateStatusIndicator();
        }

        // Show existing files
        showExistingFiles(data.attachments || []);
    }

    // Show existing files
    function showExistingFiles(attachments) {
        const container = document.getElementById('existingFiles');
        let html = '';
        
        if (attachments.length > 0) {
            html = '<small class="text-muted">File yang sudah ada:</small>';
            attachments.forEach(file => {
                html += `
                    <div class="file-item">
                        <i class="mdi mdi-file-document me-2"></i>
                        <a href="src/upload/${file.NamaFile}" target="_blank">${file.NamaFile}</a>
                    </div>
                `;
            });
        }
        
        container.innerHTML = html;
    }

    // Update status indicator
    function updateStatusIndicator() {
        const status = document.getElementById('statusAnalisa').value;
        const dot = document.getElementById('statusDot');
        const text = document.getElementById('statusText');
        
        dot.className = 'status-dot';
        
        switch(status) {
            case 'Pending':
                dot.classList.add('status-pending');
                text.textContent = 'Menunggu analisa';
                break;
            case 'In Progress':
                dot.classList.add('status-progress');
                text.textContent = 'Sedang dianalisa';
                break;
            case 'Completed':
                dot.classList.add('status-completed');
                text.textContent = 'Analisa selesai';
                break;
        }
    }

    // Show notification
    function showNotification(message, type = 'success') {
        const toastElement = document.getElementById('notificationToast');
        const messageElement = document.getElementById('toastMessage');
        
        messageElement.textContent = message;
        
        // Set color based on type
        const headerElement = toastElement.querySelector('.toast-header');
        headerElement.className = `toast-header bg-${type === 'error' ? 'danger' : type === 'warning' ? 'warning' : 'success'} text-white`;
        
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    }

    // Back to list
    function kembaliKeList() {
        page.view('pengajuan/my_pengajuan');
    }

    // Reject pengajuan
    function tolakPengajuan() {
        if (!isITDepartment) {
            showNotification('Akses ditolak! Hanya IT Department yang dapat menolak pengajuan.', 'error');
            return;
        }

        if (confirm('Apakah Anda yakin ingin menolak pengajuan ini?')) {
            updateStatusPengajuan('Rejected');
        }
    }

    // Approve pengajuan
    function approvePengajuan() {
        if (!isITDepartment) {
            showNotification('Akses ditolak! Hanya IT Department yang dapat menyetujui pengajuan.', 'error');
            return;
        }

        if (confirm('Apakah Anda yakin ingin menyetujui pengajuan ini?')) {
            updateStatusPengajuan('Approved');
        }
    }

    // Update status pengajuan
    function updateStatusPengajuan(status) {
        const formData = {
            type_submit: 'updatePengajuanStatus',
            No: pengajuanId,
            status: status,
            keterangan_it: document.getElementById('catatanAnalisa')?.value || ''
        };

        sendPost("Issue", formData, function(response) {
            if (response.status === 'success') {
                showNotification(response.message, 'success');
                document.getElementById('statusPengajuan').value = status;
                loadPengajuanData(); // Reload data
            } else {
                showNotification(response.message, 'error');
            }
        });
    }

    // Save changes
    function simpanPerubahan() {
        // Validate required fields
        if (!document.getElementById('namaInvestasi').value.trim()) {
            showNotification('Nama investasi harus diisi!', 'warning');
            return;
        }

        // Prepare form data
        const formData = {
            type_submit: 'updatePengajuan',
            No: pengajuanId,
            namainvestasi: document.getElementById('namaInvestasi').value,
            biaya: document.getElementById('biayaPengajuan').value,
            cabang: document.getElementById('cabang').value,
            keterangan: document.getElementById('keterangan').value,
            tanggal: document.getElementById('tanggalPengajuan').value
        };

        // Add IT specific fields if user is IT department
        if (isITDepartment) {
            formData.teknisi_penanggung = document.getElementById('teknisiPenanggung')?.value || '';
            formData.estimasi_waktu = document.getElementById('estimasiWaktu')?.value || '';
            formData.estimasi_biaya_it = document.getElementById('estimasiBiaya')?.value || '';
            formData.status_analisa = document.getElementById('statusAnalisa')?.value || '';
            formData.catatan_analisa = document.getElementById('catatanAnalisa')?.value || '';
            formData.rekomendasi_it = document.getElementById('rekomendasiIT')?.value || '';
        }

        sendPost("Issue", formData, function(response) {
            if (response.status === 'success') {
                showNotification('Perubahan berhasil disimpan', 'success');
            } else {
                showNotification(response.message || 'Gagal menyimpan perubahan', 'error');
            }
        });
    }

    // File upload handler
    document.getElementById('dokumenPendukung').addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            showNotification(`${files.length} file dipilih`, 'success');
        }
    });

    // Initialize when document ready
    $(document).ready(function() {
        initializePage();
    });
</script>%);
            color: white;
        }

        .btn-continue:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }

        .btn-save {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .btn-save:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        .btn-back {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            cursor: pointer;
            width: 100%;
        }

        .file-upload input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 20px;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            transition: all 0.3s ease;
        }

        .file-upload:hover .file-upload-label {
            border-color: #4facfe;
            background: rgba(79, 172, 254, 0.05);
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success { background: #10b981; }
        .notification.error { background: #ef4444; }
        .notification.warning { background: #f59e0b; }

        .it-only {
            background: rgba(155, 89, 182, 0.1);
            border-left: 4px solid #9b59b6;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .form-grid, .analisa-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Edit Detail Pengajuan</h1>
            <p>Kelola dan review pengajuan dengan analisa IT terintegrasi</p>
        </div>

        <div class="form-content">
            <form id="pengajuanForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nomorPengajuan">Nomor Pengajuan</label>
                        <input type="text" id="nomorPengajuan" value="<?= $pengajuan_data['No'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="tanggalPengajuan">Tanggal Pengajuan</label>
                        <input type="datetime-local" id="tanggalPengajuan" value="<?= date('Y-m-d\TH:i', strtotime($pengajuan_data['Tanggal'])) ?>">
                    </div>

                    <div class="form-group">
                        <label for="pemohon">Nama Pemohon</label>
                        <input type="text" id="pemohon" value="<?= $pengajuan_data['emp_name_dari'] ?? $pengajuan_data['Dari'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="departemen">Departemen</label>
                        <input type="text" id="departemen" value="<?= $pengajuan_data['dept_dari'] ?? '-' ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="biayaPengajuan">Biaya Pengajuan</label>
                        <input type="text" id="biayaPengajuan" value="<?= $pengajuan_data['biaya'] ?? '' ?>" placeholder="Rp 0">
                    </div>

                    <div class="form-group">
                        <label for="cabang">Cabang</label>
                        <select id="cabang">
                            <option value="P" <?= ($pengajuan_data['cabang'] ?? '') == 'P' ? 'selected' : '' ?>>PUSAT</option>
                            <option value="B" <?= ($pengajuan_data['cabang'] ?? '') == 'B' ? 'selected' : '' ?>>Lampung</option>
                            <option value="R" <?= ($pengajuan_data['cabang'] ?? '') == 'R' ? 'selected' : '' ?>>Semarang</option>
                            <option value="U" <?= ($pengajuan_data['cabang'] ?? '') == 'U' ? 'selected' : '' ?>>Makassar</option>
                            <option value="V" <?= ($pengajuan_data['cabang'] ?? '') == 'V' ? 'selected' : '' ?>>Jakarta</option>
                            <option value="W" <?= ($pengajuan_data['cabang'] ?? '') == 'W' ? 'selected' : '' ?>>Palembang</option>
                            <option value="Y" <?= ($pengajuan_data['cabang'] ?? '') == 'Y' ? 'selected' : '' ?>>Medan</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="namaInvestasi">Nama Investasi</label>
                        <input type="text" id="namaInvestasi" value="<?= $pengajuan_data['namainvestasi'] ?? '' ?>" placeholder="Masukkan nama investasi...">
                    </div>

                    <div class="form-group full-width">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" placeholder="Jelaskan detail pengajuan Anda..."><?= $pengajuan_data['keterangan'] ?? '' ?></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label for="dokumenPendukung">Dokumen Pendukung</label>
                        <div class="file-upload">
                            <input type="file" id="dokumenPendukung" multiple accept=".pdf,.doc,.docx,.jpg,.png">
                            <label for="dokumenPendukung" class="file-upload-label">
                                📎 Pilih atau seret file ke sini
                            </label>
                        </div>
                        <?php if (!empty($pengajuan_data['attachments'])): ?>
                            <div style="margin-top: 10px;">
                                <small>File yang sudah ada:</small>
                                <?php foreach ($pengajuan_data['attachments'] as $file): ?>
                                    <div style="margin: 5px 0;">
                                        <a href="<?= glob_src('upload/' . $file['NamaFile']) ?>" target="_blank">
                                            📄 <?= $file['NamaFile'] ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Analisa IT Section - Only visible for IT Department -->
                <?php if ($user_dept === '1'): ?>
                <div class="analisa-section">
                    <h3>Analisa IT</h3>
                    <div class="it-only">
                        <strong>🔒 Akses IT Department</strong>
                        <p>Section ini hanya dapat diakses oleh departemen IT untuk melakukan analisa teknis.</p>
                    </div>
                    
                    <div class="analisa-grid">
                        <div class="form-group">
                            <label for="teknisiPenanggung">Teknisi Penanggung Jawab</label>
                            <select id="teknisiPenanggung">
                                <option value="">Pilih Teknisi</option>
                                <option value="<?= $user_emp_no ?>" selected><?= $_SESSION[_session_app_id]['first_name'] ?? $user_emp_no ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estimasiWaktu">Estimasi Waktu Penyelesaian</label>
                            <select id="estimasiWaktu">
                                <option value="1-3 hari">1-3 hari</option>
                                <option value="4-7 hari">4-7 hari</option>
                                <option value="1-2 minggu">1-2 minggu</option>
                                <option value="2-4 minggu">2-4 minggu</option>
                                <option value="1+ bulan">1+ bulan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estimasiBiaya">Estimasi Biaya IT</label>
                            <input type="text" id="estimasiBiaya" placeholder="Rp 0">
                        </div>

                        <div class="form-group">
                            <label for="statusAnalisa">Status Analisa</label>
                            <select id="statusAnalisa" onchange="updateStatusIndicator()">
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                            <div class="status-indicator">
                                <div class="status-dot status-pending" id="statusDot"></div>
                                <span id="statusText">Menunggu analisa</span>
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label for="catatanAnalisa">Catatan Analisa</label>
                            <textarea id="catatanAnalisa" placeholder="Masukkan catatan analisa IT..."></textarea>
                        </div>

                        <div class="form-group full-width">
                            <label for="rekomendasiIT">Rekomendasi IT</label>
                            <textarea id="rekomendasiIT" placeholder="Berikan rekomendasi..."></textarea>
                        </div>

                        <div class="form-group full-width">
                            <label for="statusPengajuan">Update Status Pengajuan</label>
                            <select id="statusPengajuan">
                                <option value="Pending" <?= ($pengajuan_data['Status'] ?? '') == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Under Review" <?= ($pengajuan_data['Status'] ?? '') == 'Under Review' ? 'selected' : '' ?>>Under Review</option>
                                <option value="Approved" <?= ($pengajuan_data['Status'] ?? '') == 'Approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="Rejected" <?= ($pengajuan_data['Status'] ?? '') == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="action-buttons">
                    <button type="button" class="btn btn-back" onclick="kembaliKeList()">
                        ← Kembali
                    </button>
                    
                    <?php if ($user_dept === '1'): ?>
                    <button type="button" class="btn btn-reject" onclick="tolakPengajuan()">
                        ❌ Tolak
                    </button>
                    <?php endif; ?>
                    
                    <button type="button" class="btn btn-save" onclick="simpanPerubahan()">
                        💾 Simpan
                    </button>
                    
                    <?php if ($user_dept === '1'): ?>
                    <button type="button" class="btn btn-continue" onclick="approvePengajuan()">
                        ✅ Approve
                    </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // Global variables
        const pengajuanId = '<?= $pengajuan_id ?>';
        const userDept = '<?= $user_dept ?>';
        const userEmpNo = '<?= $user_emp_no ?>';
        const isITDepartment = userDept === '1';

        function updateStatusIndicator() {
            const status = document.getElementById('statusAnalisa').value;
            const dot = document.getElementById('statusDot');
            const text = document.getElementById('statusText');
            
            dot.className = 'status-dot';
            
            switch(status) {
                case 'Pending':
                    dot.classList.add('status-pending');
                    text.textContent = 'Menunggu analisa';
                    break;
                case 'In Progress':
                    dot.classList.add('status-progress');
                    text.textContent = 'Sedang dianalisa';
                    break;
                case 'Completed':
                    dot.classList.add('status-completed');
                    text.textContent = 'Analisa selesai';
                    break;
            }
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => notification.classList.add('show'), 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => document.body.removeChild(notification), 300);
            }, 3000);
        }

        function kembaliKeList() {
            window.location.href = 'page.view("pengajuan/my_pengajuan")';
        }

        function tolakPengajuan() {
            if (!isITDepartment) {
                showNotification('Akses ditolak! Hanya IT Department yang dapat menolak pengajuan.', 'error');
                return;
            }

            const konfirmasi = confirm('Apakah Anda yakin ingin menolak pengajuan ini?');
            if (konfirmasi) {
                updateStatusPengajuan('Rejected');
            }
        }

        function approvePengajuan() {
            if (!isITDepartment) {
                showNotification('Akses ditolak! Hanya IT Department yang dapat menyetujui pengajuan.', 'error');
                return;
            }

            const konfirmasi = confirm('Apakah Anda yakin ingin menyetujui pengajuan ini?');
            if (konfirmasi) {
                updateStatusPengajuan('Approved');
            }
        }

        function updateStatusPengajuan(status) {
            const formData = {
                type_submit: 'updateStatus',
                No: pengajuanId,
                status: status,
                keterangan_it: document.getElementById('catatanAnalisa')?.value || ''
            };

            $.post('', formData, function(response) {
                if (response.status === 'success') {
                    showNotification(response.message, 'success');
                    // Update status display
                    document.getElementById('statusPengajuan').value = status;
                } else {
                    showNotification(response.message, 'error');
                }
            }, 'json').fail(function() {
                showNotification('Terjadi kesalahan saat mengupdate status', 'error');
            });
        }

        function simpanPerubahan() {
            const form = document.getElementById('pengajuanForm');
            
            // Prepare form data
            const formData = {
                type_submit: 'updatePengajuan',
                No: pengajuanId,
                namainvestasi: document.getElementById('namaInvestasi').value,
                biaya: document.getElementById('biayaPengajuan').value,
                cabang: document.getElementById('cabang').value,
                keterangan: document.getElementById('keterangan').value,
                tanggal: document.getElementById('tanggalPengajuan').value
            };

            // Add IT specific fields if user is IT department
            if (isITDepartment) {
                formData.teknisi_penanggung = document.getElementById('teknisiPenanggung')?.value || '';
                formData.estimasi_waktu = document.getElementById('estimasiWaktu')?.value || '';
                formData.estimasi_biaya_it = document.getElementById('estimasiBiaya')?.value || '';
                formData.status_analisa = document.getElementById('statusAnalisa')?.value || '';
                formData.catatan_analisa = document.getElementById('catatanAnalisa')?.value || '';
                formData.rekomendasi_it = document.getElementById('rekomendasiIT')?.value || '';
            }

            // Validate required fields
            if (!formData.namainvestasi.trim()) {
                showNotification('Nama investasi harus diisi!', 'warning');
                return;
            }

            $.post('', formData, function(response) {
                if (response.status === 'success') {
                    showNotification('Perubahan berhasil disimpan', 'success');
                } else {
                    showNotification(response.message || 'Gagal menyimpan perubahan', 'error');
                }
            }, 'json').fail(function() {
                showNotification('Terjadi kesalahan saat menyimpan', 'error');
            });
        }

        // File upload handler
        document.getElementById('dokumenPendukung').addEventListener('change', function(e) {
            const files = e.target.files;
            const label = document.querySelector('.file-upload-label');
            
            if (files.length > 0) {
                label.innerHTML = `📎 ${files.length} file dipilih`;
                showNotification(`${files.length} file berhasil dipilih`, 'success');
            } else {
                label.innerHTML = '📎 Pilih atau seret file ke sini';
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            updateStatusIndicator();
            
            // Show notification about access level
            if (isITDepartment) {
                showNotification('Anda memiliki akses IT untuk mengelola pengajuan ini', 'success');
            }
        });
    </script>
</body>
</html>