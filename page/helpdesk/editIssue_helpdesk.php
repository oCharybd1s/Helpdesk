<div class="card">
	<div class="card-body">
        <div class="card">
            <h5 class="card-header" style="font-size:32px; color: #00a652;"><b>Detail Helpdesk</b></h5>
            <div>
                <div class="row" style="margin-left: 15px; margin-bottom: 4px; display: flex; justify-content: space-between;">
                    <div class="mid-6" style="font-size:16px; flex: 1; padding-right: 10px;">
                        No Issue: <b><span class="id_Issue"></span></b>
                    </div>
                    <div class="mid-6" style="font-size:16px; flex: 1; padding-left: 10px;">
                        Tanggal Issue: <b><span class="date"></span></b>
                    </div>
                </div>

                <div class="row" style="margin-left: 15px; margin-bottom: 4px; display: flex; justify-content: space-between;">
                    <div class="mid-6" style="font-size:16px; flex: 1; padding-right: 10px;">
                        Dari: <b><span class="dari"></span></b>
                    </div>
                    <div class="mid-6" style="font-size:16px; flex: 1; padding-left: 10px;">
                        Cabang : <b><span class="cabang"></span></b>
                    </div>
                </div>

                <div class="row" style="margin-left: 15px; margin-bottom: 4px; display: flex; justify-content: space-between;">
                    <div class="mid-6" style="font-size:16px; flex: 1; padding-right: 10px;">
                        Tujuan: <b><span class="tujuan"></span></b>
                    </div>
                    <div class="mid-6" style="font-size:16px; flex: 1; padding-left: 10px;">
                        Kategori : <b><span class="kategori"></span></b>
                    </div>
                </div>

                <div class="row" style="margin-left: 15px; margin-bottom: 4px; display: flex; justify-content: space-between;">
                    <div class="mid-6" style="font-size:16px; flex: 1; padding-right: 10px;">
                        Jenis Laporan: <b><span class="jenisLap"></span></b>
                    </div>
                    <div class="mid-6" style="font-size:16px; flex: 1; padding-left: 10px;">
                        Program Yang Dimaksud : <b><span class="progDimaksud"></span></b>
                    </div>
                </div>
            </div>
            <div style="padding:20px">
                <div id="card-list" class="card">
                    <div class="card-header">
                        NOTE PATA
                    </div>
                    <div class="card-body" id="pataNote">
                        
                    </div>
                </div>
            </div>
            <div style="padding:20px">
                <div class="form-floating form-floating-outline mb-4">
                    <textarea
                        class="form-control h-px-100"
                        id="deskripsi-area"
                        style="height:200px !important;"
                    ></textarea>
                    <label for="exampleFormControlTextarea1" style="margin-bottom: 10px;"><b>Deskripsi (Tambahkan deskripsi pada bagian paling bawah dari deskripsi aslinya)</b></label>
                </div>
            </div>
            <div id="estimation-phase" class="work-phase" style="display: none;">
                <div class="mid-6" style="font-size:16px; flex: 1; padding-right: 10px;">
                    <label for="estimasi-minutes"><strong>Estimasi Pengerjaan (Menit):</strong></label>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                        <input type="number" id="estimasi-minutes" placeholder="Masukkan estimasi dalam menit" min="1" max="9999" required
                            style="padding: 8px 12px; border: 2px solid #ddd; border-radius: 5px; font-size: 14px; width: 200px;">
                        <button type="button" id="kerjakan-btn" onclick="kerjakanIssue()" 
                                style="padding: 10px 20px; border: none; border-radius: 5px; background-color: #28a745; color: white; 
                                    font-size: 14px; cursor: pointer; transition: background-color 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#218838'" 
                                onmouseout="this.style.backgroundColor='#28a745'">
                            Kerjakan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Phase 2: Working with Timer -->
            <div id="working-phase" class="work-phase" style="display: none;">
                <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin: 10px 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <h4 style="margin: 0; color: #495057;">🔧 Sedang Mengerjakan</h4>
                        <div id="work-status" style="padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 12px;">
                            ON TIME
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 30px; align-items: center; margin-bottom: 15px;">
                        <div>
                            <strong>Estimasi:</strong> <span id="estimated-time">0</span> menit
                        </div>
                        <div>
                            <strong>Waktu Berjalan:</strong> <span id="elapsed-time">0</span> menit
                        </div>
                        <div>
                            <strong>Sisa Waktu:</strong> <span id="remaining-time">0</span> menit
                        </div>
                    </div>
                    
                    <div style="background: #e9ecef; border-radius: 10px; height: 8px; margin-bottom: 15px;">
                        <div id="progress-bar" style="background: #28a745; height: 100%; border-radius: 10px; width: 0%; transition: all 0.5s ease;"></div>
                    </div>
                    
                    <div style="display: flex; gap: 20px;">
                        <div style="flex: 1;">
                            <label for="solusi-area"><strong>Solusi:</strong></label>
                            <textarea id="solusi-area" placeholder="Deskripsikan solusi yang diterapkan..." 
                                    style="width: 100%; min-height: 100px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; resize: vertical;"></textarea>
                        </div>
                        <div style="flex: 1;">
                            <label for="catatan-it-area"><strong>Catatan IT:</strong></label>
                            <textarea id="catatan-it-area" placeholder="Catatan tambahan untuk internal IT..." 
                                    style="width: 100%; min-height: 100px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; resize: vertical;"></textarea>
                        </div>
                    </div>
                    
                    <div style="text-align: center; margin-top: 20px;">
                        <button type="button" id="finish-btn" onclick="selesaikanIssue()" 
                                style="padding: 12px 30px; border: none; border-radius: 5px; background-color: #dc3545; color: white; 
                                    font-size: 16px; cursor: pointer; transition: background-color 0.3s ease;"
                                onmouseover="this.style.backgroundColor='#c82333'" 
                                onmouseout="this.style.backgroundColor='#dc3545'">
                            🏁 Selesaikan Pekerjaan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Phase 3: Completed -->
            <div id="completed-phase" class="work-phase" style="display: none;">
                <div style="background: #d4edda; padding: 20px; border-radius: 10px; margin: 10px 0; border: 2px solid #c3e6cb;">
                    <h4 style="margin: 0 0 15px 0; color: #155724;">✅ Pekerjaan Selesai</h4>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                        <div>
                            <strong>Waktu Mulai:</strong> <span id="start-time-display">-</span>
                        </div>
                        <div>
                            <strong>Waktu Selesai:</strong> <span id="finish-time-display">-</span>
                        </div>
                        <div>
                            <strong>Estimasi:</strong> <span id="final-estimated-time">-</span> menit
                        </div>
                        <div>
                            <strong>Waktu Aktual:</strong> <span id="actual-time-display">-</span> menit
                        </div>
                        <div>
                            <strong>Status:</strong> <span id="completion-status">-</span>
                        </div>
                        <div>
                            <strong>Selisih:</strong> <span id="time-difference">-</span>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <strong>Solusi:</strong>
                            <div id="final-solusi" style="background: white; padding: 10px; border-radius: 5px; border: 1px solid #c3e6cb; min-height: 80px;">-</div>
                        </div>
                        <div>
                            <strong>Catatan IT:</strong>
                            <div id="final-catatan" style="background: white; padding: 10px; border-radius: 5px; border: 1px solid #c3e6cb; min-height: 80px;">-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-left: 15px; margin-bottom: 4px; display: flex; justify-content: space-between;">
                <div class="mid-6" style="font-size:16px; flex: 1; padding-right: 10px;">
                <div class="form-floating form-floating-outline mb-4">
                    <textarea
                        class="form-control h-px-100"
                        id="catatan-area"
                        style="height:200px !important;"
                    ></textarea>
                    <label for="exampleFormControlTextarea1" style="margin-bottom: 10px;"><b>Solusi - Catatan</b></label>
                </div>
                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                    <label style="color: #00a652;"><b>Upload Gambar:</b></label>
                    <div class="input-group">
                        <input name="file" type="file" class="form-control" id="inputGroupFile03" required accept="image/*" onchange="validateImage()" style="background-color:#eff0e9;height:250px;margin-bottom:10px; place-items:center; border: 1px solid #d8d8dd;">
                    </div>
                </div>
                <div id="error-message" style="color: red; display: none;">
                    <p>Hanya menerima gambar. Ekstensi yang diperbolehkan: .jpg, .jpeg, .png, .gif</p>
                </div>
                </div>
                <div class="mid-6" style="font-size:16px; flex: 1; padding-left: 10px;">
                    <div>
                        <h1><b>Live Chat</b></h1>
                    </div>
                    <div id="chat-box" style="border: 1px solid #ccc; height: 300px; overflow-y: scroll; padding: 10px;">
                        <!-- Pesan akan muncul di sini -->
                    </div>
                    <input type="text" id="chat-input" placeholder="Ketik pesan..." style="width: 80%; padding: 10px; margin-top: 10px;"/>
                    <button onclick="sendMessage()" style="padding: 10px;">Kirim</button>
                </div>
            </div>
        <div class="table-responsive text-nowrap">
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.8.1/nouislider.min.css" rel="stylesheet">
<style>
    #card-list .card{
        border-radius: 8px;
        background-color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        max-width:200px;
    }

    #card-list .card-header {
        background-color: #4CAF50;
        color: white;
        font-size: 20px;
        font-weight: bold;
        padding: 16px;
        text-align: center;
    }

    #card-list .card-body {
        padding: 20px;
        font-size: 16px;
        color: #333;
        background-color: #f9f9f9;
        border-top: 1px solid #ddd;
    }
    .table th, .table td {
        padding-left: 6px !important;
        padding-right: 6px !important;
    }

    /* Styling untuk chat container */
    #chat-box {
        width: 100%;
        max-height: 500px;
        overflow-y: auto;
        padding: 10px;
        background-color: #f5f5f5;
        border-radius: 10px;
    }

    /* Styling untuk pemisah tanggal */
    .date-separator {
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        color: #888;
        margin: 15px 0;
        position: relative;
    }

    .date-separator::before, 
    .date-separator::after {
        content: "";
        position: absolute;
        width: 40%;
        height: 1px;
        background: #ccc;
        top: 50%;
    }

    .date-separator::before {
        left: 0;
    }

    .date-separator::after {
        right: 0;
    }

    /* Styling untuk setiap pesan */
    .message {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
        padding: 8px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Styling untuk teks pesan */
    .message strong {
        font-size: 14px;
        color: #333;
    }

    .message span.time {
        font-size: 12px;
        color: gray;
        margin-left: 5px;
    }

    .message-content {
        font-size: 14px;
        color: #333;
        margin-top: 2px;
    }

    .message-box {
        margin-bottom: 5px;
    }

    #chat-input {
        width: 75%;
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 25px;
        font-size: 16px;
        transition: all 0.3s ease;
        outline: none;
    }

    #chat-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    button {
        padding: 12px 20px;
        border: none;
        border-radius: 25px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 10px;
    }

    button:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 10px rgba(0, 91, 187, 0.5);
    }

    button:active {
        transform: scale(0.95);
    }

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.8.1/nouislider.min.js"></script>
<script type="text/javascript">
// Fixed JavaScript code based on working reference from second document
function startForm() {
    // tmp_calon_customer = tmp_calon_customer;
    // console.log(tmp_calon_customer);
}
startForm();

// Declare workflow variables only if they don't exist - use window to avoid redeclaration
if (typeof window.workTimer === 'undefined') {
    window.workTimer = null;
    window.startTime = null;
    window.estimatedMinutes = 0;
    window.issueWorkflowData = null;
}

// Use window properties to avoid const redeclaration
window.id_Issue = _post.id_Issue;
document.querySelector(".id_Issue").textContent = window.id_Issue;

// Use let instead of const to avoid redeclaration and check if already declared
if (typeof window.issuePageData === 'undefined') {
    window.issuePageData = sendPost("Issue", {type_submit: "getEdit", id_Issue: window.id_Issue});
}

if (window.issuePageData && window.issuePageData.length > 0 && window.issuePageData[0].Tanggal && window.issuePageData[0].Tanggal.date) {
    window.date = window.issuePageData[0].Tanggal.date; 
    const newDate = formatDate(window.date);
    document.querySelector(".date").textContent = newDate;
} else {
    console.error("Tanggal or date property is undefined", window.issuePageData);
}

// Use window properties to avoid redeclaration
window.jenis = window.issuePageData[0].Jenis;
window.dari = window.issuePageData[0].dari;
window.apk = window.issuePageData[0].Aplikasi;
window.pata = window.issuePageData[0].NotePATA;
window.desc = window.issuePageData[0].issue;   
window.tujuan = window.issuePageData[0].tujuan;
window.kategori = window.issuePageData[0].kategori;

window.cari = rutanApi('GetAllPegawai', 'mP60RM7Spq9pMSYPRsCD', {
    iddbase: "DB00000023",
    idapi: "API0000700",
    emp_noAPI0000700 : window.issuePageData[0].dari
});

window.cabang = window.cari[0].nama_cabang;

if (window.pata === null || window.pata === "") {
    document.querySelector("#pataNote").textContent = "TIDAK ADA NOTE DARI PATA";
} else {
    document.querySelector("#pataNote").textContent = window.pata;
}

document.querySelector("#deskripsi-area").textContent = window.desc;
document.querySelector(".tujuan").textContent = window.tujuan;
document.querySelector(".kategori").textContent = window.kategori;
document.querySelector(".cabang").textContent = window.cabang;

if (Array.isArray(getPG) && getPG.length > 0) {
    let employeeName = '';
    $.each(getPG, function (index, row) {
        const cleanDari = window.dari.replace(/\s+/g, ''); 
        if (String(row.emp_no) == String(cleanDari)) {
            employeeName = row.first_name;
            return false;
        }
    });

    if (employeeName) {
        $('.dari').text(employeeName);
    }
}

sendPost("Issue", { type_submit: "getAllComb" }, function (getLaporan) {
    let jenisLaporan = '';
    $.each(getLaporan, function (index, row) {
        if (String(row.Lap) === String(window.jenis)) {
            jenisLaporan = row.NamaLaporan;
            return false;
        }
    });
    if (jenisLaporan) {
        $('.jenisLap').text(jenisLaporan);
    }
});

sendPost("Issue", { type_submit: "getApk" }, function (getAplikasi) {
    let aplikasi = '';
    $.each(getAplikasi, function (index, row) {
        if (String(row.Apl) === String(window.apk)) {
            aplikasi = row.NamaAplikasi;
            return false;
        }
    });
    if (aplikasi) {
        $('.progDimaksud').text(aplikasi);
    }
    else{
        aplikasi = "-";
        $('.progDimaksud').text(aplikasi);
    }
});

window.issueId = _post.id_Issue;
window.issueWorkflowData = window.issuePageData[0];

// Initialize workflow phases
function initializeWorkflow() {
    console.log('Initializing workflow with data:', window.issueWorkflowData);
    
    if (!window.issueWorkflowData) {
        console.error("Cannot initialize workflow: data is null");
        showPhase('estimation');
        return;
    }
    
    // Check workflow state based on database fields
    if (!window.issueWorkflowData.Ditangani && !window.issueWorkflowData.TanggalSelesai) {
        // Phase 1: Not started
        console.log('Phase 1: Not started');
        showPhase('estimation');
    } else if (window.issueWorkflowData.Ditangani && !window.issueWorkflowData.TanggalSelesai) {
        // Phase 2: Working
        console.log('Phase 2: Working');
        showPhase('working');
        if (window.issueWorkflowData.AcceptWork) {
            window.startTime = new Date(window.issueWorkflowData.AcceptWork);
            window.estimatedMinutes = parseInt(window.issueWorkflowData.EstimasiMenit) || 0;
            startWorkTimer();
        }
    } else if (window.issueWorkflowData.Ditangani && window.issueWorkflowData.TanggalSelesai) {
        // Phase 3: Completed
        console.log('Phase 3: Completed');
        showPhase('completed');
        displayCompletionDetails();
    }
}

function showPhase(phase) {
    console.log('Showing phase:', phase);
    
    // Hide all phases
    document.querySelectorAll('.work-phase').forEach(el => el.style.display = 'none');
    
    // Show selected phase
    switch(phase) {
        case 'estimation':
            const estimationPhase = document.getElementById('estimation-phase');
            if (estimationPhase) {
                estimationPhase.style.display = 'block';
                console.log('Estimation phase shown');
            } else {
                console.error('Estimation phase element not found');
            }
            break;
        case 'working':
            const workingPhase = document.getElementById('working-phase');
            if (workingPhase) {
                workingPhase.style.display = 'block';
                console.log('Working phase shown');
            } else {
                console.error('Working phase element not found');
            }
            break;
        case 'completed':
            const completedPhase = document.getElementById('completed-phase');
            if (completedPhase) {
                completedPhase.style.display = 'block';
                console.log('Completed phase shown');
            } else {
                console.error('Completed phase element not found');
            }
            break;
    }
}

function kerjakanIssue() {
    console.log('kerjakanIssue function called');
    
    const estimasiInput = document.getElementById('estimasi-minutes');
    const estimasiMenit = parseInt(estimasiInput.value) || 0;
    
    if (estimasiMenit <= 0) {
        alert('Mohon masukkan estimasi pengerjaan dalam menit!');
        estimasiInput.focus();
        return;
    }
    
    if (!confirm(`Apakah Anda yakin akan mengambil pekerjaan ini dengan estimasi ${estimasiMenit} menit?`)) {
        return;
    }
    
    const kerjakanBtn = document.getElementById('kerjakan-btn');
    const originalText = kerjakanBtn.textContent;
    kerjakanBtn.textContent = 'Memproses...';
    kerjakanBtn.disabled = true;
    
    sendPost("Issue", {
        type_submit: "kerjakanIssue",
        No: window.issueId,
        estimasiMenit: estimasiMenit
    }).then(response => {
        console.log('Response from kerjakanIssue:', response);
        
        if (response.status === 'success') {
            alert('✅ Berhasil mengambil pekerjaan!');
            
            // Update issue data
            window.issueWorkflowData.Ditangani = response.data.Ditangani;
            window.issueWorkflowData.AcceptWork = response.data.AcceptWork;
            window.issueWorkflowData.EstimasiMenit = response.data.EstimasiMenit;
            
            // Switch to working phase
            showPhase('working');
            window.startTime = new Date(response.data.AcceptWork);
            window.estimatedMinutes = estimasiMenit;
            startWorkTimer();
            
        } else {
            alert('❌ Gagal mengambil pekerjaan: ' + response.message);
        }
    }).catch(error => {
        console.error('Error:', error);
        alert('❌ Terjadi kesalahan saat mengambil pekerjaan');
    }).finally(() => {
        kerjakanBtn.textContent = originalText;
        kerjakanBtn.disabled = false;
    });
}

function startWorkTimer() {
    console.log('Starting work timer with estimated minutes:', window.estimatedMinutes);
    
    const estimatedTimeElement = document.getElementById('estimated-time');
    if (estimatedTimeElement) {
        estimatedTimeElement.textContent = window.estimatedMinutes;
    }
    
    // Clear any existing timer
    if (window.workTimer) {
        clearInterval(window.workTimer);
    }
    
    window.workTimer = setInterval(updateTimer, 1000); // Update every second
    updateTimer(); // Initial update
}

function updateTimer() {
    if (!window.startTime) return;
    
    const now = new Date();
    const elapsedMs = now - window.startTime;
    const elapsedMinutes = Math.floor(elapsedMs / 60000);
    const elapsedSeconds = Math.floor((elapsedMs % 60000) / 1000);
    
    // Update elapsed time
    const elapsedTimeElement = document.getElementById('elapsed-time');
    if (elapsedTimeElement) {
        elapsedTimeElement.textContent = `${elapsedMinutes}:${elapsedSeconds.toString().padStart(2, '0')}`;
    }
    
    // Calculate remaining time
    const remainingMinutes = Math.max(0, window.estimatedMinutes - elapsedMinutes);
    const remainingTimeElement = document.getElementById('remaining-time');
    if (remainingTimeElement) {
        remainingTimeElement.textContent = remainingMinutes;
    }
    
    // Update progress bar
    const progressPercent = Math.min(100, (elapsedMinutes / window.estimatedMinutes) * 100);
    const progressBar = document.getElementById('progress-bar');
    if (progressBar) {
        progressBar.style.width = progressPercent + '%';
    }
    
    // Update status and colors
    const statusElement = document.getElementById('work-status');
    if (statusElement && progressBar) {
        if (elapsedMinutes < window.estimatedMinutes * 0.8) {
            // On time (less than 80% of estimated time)
            statusElement.textContent = 'ON TIME';
            statusElement.style.backgroundColor = '#28a745';
            statusElement.style.color = 'white';
            progressBar.style.backgroundColor = '#28a745';
        } else if (elapsedMinutes < window.estimatedMinutes) {
            // Approaching deadline (80%-100% of estimated time)
            statusElement.textContent = 'PAUSE';
            statusElement.style.backgroundColor = '#ffc107';
            statusElement.style.color = 'black';
            progressBar.style.backgroundColor = '#ffc107';
        } else {
            // Over time (more than estimated time)
            statusElement.textContent = 'OVER TIME';
            statusElement.style.backgroundColor = '#dc3545';
            statusElement.style.color = 'white';
            progressBar.style.backgroundColor = '#dc3545';
        }
    }
}

function selesaikanIssue() {
    console.log('selesaikanIssue function called');
    
    const solusi = document.getElementById('solusi-area').value.trim();
    const catatan = document.getElementById('catatan-it-area').value.trim();
    
    if (!solusi) {
        alert('Mohon isi solusi yang diterapkan!');
        document.getElementById('solusi-area').focus();
        return;
    }
    
    if (!confirm('Apakah Anda yakin pekerjaan ini sudah selesai?')) {
        return;
    }
    
    const finishBtn = document.getElementById('finish-btn');
    const originalText = finishBtn.textContent;
    finishBtn.textContent = '⏳ Menyelesaikan...';
    finishBtn.disabled = true;
    
    sendPost("Issue", {
        type_submit: "selesaikanIssue",
        No: window.issueId,
        solusi: solusi,
        catatan: catatan
    }).then(response => {
        console.log('Response from selesaikanIssue:', response);
        
        if (response.status === 'success') {
            alert('✅ Pekerjaan berhasil diselesaikan!');
            
            // Stop timer
            if (window.workTimer) {
                clearInterval(window.workTimer);
                window.workTimer = null;
            }
            
            // Update issue data
            window.issueWorkflowData.TanggalSelesai = response.data.TanggalSelesai;
            window.issueWorkflowData.Solusi = response.data.Solusi;
            window.issueWorkflowData.CatatanIT = response.data.CatatanIT;
            window.issueWorkflowData.AktualMenit = response.data.AktualMenit;
            
            // Switch to completed phase
            showPhase('completed');
            displayCompletionDetails();
            
        } else {
            alert('❌ Gagal menyelesaikan pekerjaan: ' + response.message);
        }
    }).catch(error => {
        console.error('Error:', error);
        alert('❌ Terjadi kesalahan saat menyelesaikan pekerjaan');
    }).finally(() => {
        finishBtn.textContent = originalText;
        finishBtn.disabled = false;
    });
}

function displayCompletionDetails() {
    console.log('Displaying completion details');
    
    if (!window.issueWorkflowData) return;
    
    const startTimeObj = new Date(window.issueWorkflowData.AcceptWork);
    const finishTimeObj = new Date(window.issueWorkflowData.TanggalSelesai);
    const estimatedMin = parseInt(window.issueWorkflowData.EstimasiMenit) || 0;
    const actualMin = parseInt(window.issueWorkflowData.AktualMenit) || 0;
    
    // Update display elements with null checks
    const startTimeDisplay = document.getElementById('start-time-display');
    if (startTimeDisplay) {
        startTimeDisplay.textContent = formatDateTime(startTimeObj);
    }
    
    const finishTimeDisplay = document.getElementById('finish-time-display');
    if (finishTimeDisplay) {
        finishTimeDisplay.textContent = formatDateTime(finishTimeObj);
    }
    
    const finalEstimatedTime = document.getElementById('final-estimated-time');
    if (finalEstimatedTime) {
        finalEstimatedTime.textContent = estimatedMin;
    }
    
    const actualTimeDisplay = document.getElementById('actual-time-display');
    if (actualTimeDisplay) {
        actualTimeDisplay.textContent = actualMin;
    }
    
    // Determine completion status
    let status, statusColor;
    const difference = actualMin - estimatedMin;
    
    if (actualMin <= estimatedMin) {
        status = '🎯 Tepat Waktu';
        statusColor = '#28a745';
    } else if (difference <= estimatedMin * 0.2) {
        status = '⚠️ Sedikit Terlambat';
        statusColor = '#ffc107';
    } else {
        status = '🚨 Terlambat';
        statusColor = '#dc3545';
    }
    
    const statusElement = document.getElementById('completion-status');
    if (statusElement) {
        statusElement.textContent = status;
        statusElement.style.color = statusColor;
        statusElement.style.fontWeight = 'bold';
    }
    
    // Time difference
    const diffElement = document.getElementById('time-difference');
    if (diffElement) {
        if (difference > 0) {
            diffElement.textContent = `+${difference} menit (terlambat)`;
            diffElement.style.color = '#dc3545';
        } else if (difference < 0) {
            diffElement.textContent = `${Math.abs(difference)} menit (lebih cepat)`;
            diffElement.style.color = '#28a745';
        } else {
            diffElement.textContent = 'Tepat sesuai estimasi';
            diffElement.style.color = '#28a745';
        }
    }
    
    // Solution and notes
    const finalSolusi = document.getElementById('final-solusi');
    if (finalSolusi) {
        finalSolusi.textContent = window.issueWorkflowData.Solusi || '-';
    }
    
    const finalCatatan = document.getElementById('final-catatan');
    if (finalCatatan) {
        finalCatatan.textContent = window.issueWorkflowData.CatatanIT || '-';
    }
}

function formatDateTime(date) {
    if (!date || isNaN(date)) return '-';
    
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear();
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    
    return `${day}-${month}-${year} ${hours}:${minutes}`;
}

function sendMessage() {
    const message = document.getElementById("chat-input").value;
    const userName = "<?= $_SESSION[_session_app_id]['first_name'] ?>"; 
    const idUser = window.issuePageData[0].dari;
    
    if (message.trim() === "") {
        alert("Pesan tidak boleh kosong!");
        return;
    }
    
    const now = new Date();
    const offset = 7 * 60 * 60 * 1000; 
    const currentTime = new Date(now.getTime() + offset).toISOString();
    
    sendPost("Issue", { 
        type_submit: "insLiveChat",
        NoIssue: window.issueId,       
        Waktu: currentTime,     
        Dari: userName,         
        Isi: message,
        idUser: idUser
    });

    document.getElementById("chat-input").value = ""; 
    loadChatHistory();
}

function displayMessage(sender, message, time) {
    const chatBox = document.getElementById("chat-box");
    if (!chatBox) return;
    
    const messageElement = document.createElement("div");
    messageElement.classList.add("message-box");
    messageElement.innerHTML = `
        <div style="
            display: flex; 
            flex-direction: column; 
            background-color: rgb(221, 223, 221); 
            padding: 15px; 
            border-radius: 15px; 
            max-width: 100%; 
            position: relative;
            word-wrap: break-word;
        ">
            <span style="font-weight: bold; font-size: 18px;">${sender}</span>
            <div style="font-size: 15px; margin-bottom: 16px;">${message}</div>
            <span style="font-size: 12px; color: gray; position: absolute; bottom: 10px; right: 10px;">${time}</span>
        </div>
    `;
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    if (isNaN(date)) return "Invalid Date";
    
    const year = date.getFullYear();
    const monthNames = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    const month = monthNames[date.getMonth()];
    const day = date.getDate().toString().padStart(2, '0');
    const hour = date.getHours().toString().padStart(2, '0');
    const minute = date.getMinutes().toString().padStart(2, '0');
    return `${hour}:${minute} | ${day} ${month} ${year}`;
}

function loadChatHistory() {
    const chatBox = document.getElementById("chat-box");
    if (!chatBox) return;
    
    chatBox.innerHTML = ''; 
    const MComCli = sendPost("Issue", { type_submit: "getComCli", idIssue: window.issueId}); 
    
    if (MComCli && Array.isArray(MComCli)) {
        MComCli.forEach(msg => {
            if (msg.Waktu && msg.Waktu.date) {
                const formattedTime = formatDate(msg.Waktu.date);  
                displayMessage(msg.Dari, msg.Isi, formattedTime);
            }
        });
    }
}

// Initialize everything after DOM is ready
console.log('Script loaded, initializing workflow...');
initializeWorkflow();
loadChatHistory();
</script>
