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
            <div class="row" style="margin-left: 15px; margin-bottom: 4px; display: flex; justify-content: space-between;">
                <div class="mid-6" id="estimasi-pengerjaan-form" style="font-size:16px; flex: 1; padding-right: 10px;">
                    Estimasi Pengerjaan: <input type="number" id="estimasi-minutes" placeholder="Menit">
                    <button>Kerjakan</button>
                </div>
                <div>
                    <span class="time-count"></span>
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
	function startForm() {
		// tmp_calon_customer = tmp_calon_customer;
		// console.log(tmp_calon_customer);
	}
    startForm();

    id_Issue = _post.id_Issue;
    
    document.querySelector(".id_Issue").textContent = id_Issue;
    id_Issue = _post.id_Issue;
    data = sendPost("Issue", {type_submit: "getEdit", id_Issue: id_Issue});

    if (data && data.length > 0 && data[0].Tanggal && data[0].Tanggal.date) {
        date = data[0].Tanggal.date; 
        newDate = formatDate(date);
        document.querySelector(".date").textContent = newDate;
    } else {
        console.error("Tanggal or date property is undefined", data);
    }

    jenis = data[0].Jenis;
    dari = data[0].dari;
    apk = data[0].Aplikasi;
    pata = data[0].NotePATA;
    desc = data[0].issue;   
    tujuan = data[0].tujuan;
    kategori = data[0].kategori;
    cari = rutanApi('GetAllPegawai', 'mP60RM7Spq9pMSYPRsCD', {
        iddbase: "DB00000023",
        idapi: "API0000700",
        emp_noAPI0000700 : data[0].dari
      });
    cabang = cari[0].nama_cabang;
    if (pata === null || pata === "") {
        document.querySelector("#pataNote").textContent = "TIDAK ADA NOTE DARI PATA";
    } else {
        document.querySelector("#pataNote").textContent = pata;
    }

    document.querySelector("#deskripsi-area").textContent = desc;
    document.querySelector(".tujuan").textContent = tujuan;
    document.querySelector(".kategori").textContent = kategori;
    document.querySelector(".cabang").textContent = cabang;

    if (Array.isArray(getPG) && getPG.length > 0) {
        let employeeName = '';
        $.each(getPG, function (index, row) {
            dari = dari.replace(/\s+/g, ''); 
            if (String(row.emp_no) == String(dari)) {
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
            if (String(row.Lap) === String(jenis)) {
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
            if (String(row.Apl) === String(apk)) {
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

    // Function to format the date
    function formatDate(dateStr) {
        let formattedDateStr = dateStr.split('.')[0].replace(" ", "T");
        let date = new Date(formattedDateStr);
        if (isNaN(date.getTime())) {
            return "Invalid Date"; 
        }
        const months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        let day = String(date.getDate()).padStart(2, '0');
        let month = months[date.getMonth()];
        let year = date.getFullYear();
        let hours = String(date.getHours()).padStart(2, '0');
        let minutes = String(date.getMinutes()).padStart(2, '0');
        return `${day} ${month} ${year} ${hours}:${minutes}`;
    }

    function updateStatus(status) { 
        const timeCountElement = document.querySelector('.time-count');
        const estimasiForm = document.getElementById('estimasi-pengerjaan-form');
        estimasiForm.style.display = 'none'; 

        if (!timeCountElement) {
            console.error("Element with class 'time-count' not found.");
            return;
        } 
        if (status === 1) {
            if (data && data[0]) {
                if (data[0].Ditangani === null && data[0].TanggalSelesai === null) {
                    estimasiForm.style.display = 'block';
                    timeCountElement.textContent = ''; 
                    timeCountElement.style.display = 'inline-block'; 
                } else if (data[0].Ditangani !== null && data[0].TanggalSelesai === null) {
                    const now = new Date();
                    const minutes = now.getMinutes(); 
                    const hours = now.getHours();
                    const day = now.getDate().toString().padStart(2, '0');
                    const month = (now.getMonth() + 1).toString().padStart(2, '0');
                    const year = now.getFullYear();
                    const formattedTime = `${day}-${month}-${year} ${hours}:${minutes}`;
                    timeCountElement.textContent = `Waktu Pengerjaan: ${minutes} Menit dari ${formattedTime}`;
                    timeCountElement.style.display = 'inline-block'; 

                    timeCountElement.offsetHeight;  
                } else if (data[0].Ditangani !== null && data[0].TanggalSelesai !== null) {
                    const completedMinutes = 120; 
                    timeCountElement.textContent = `Waktu Penyelesaian: ${completedMinutes} Menit`;
                    timeCountElement.style.display = 'inline-block'; 
                }
            } else {
                console.error("Data is not available or incorrectly structured.");
            }
        } else if (status === 2) {
            timeCountElement.textContent = 'Status 2: Pekerjaan telah selesai atau tidak membutuhkan estimasi.';
            estimasiForm.style.display = 'none';
            timeCountElement.style.display = 'inline-block'; 
        }
    }

    updateStatus(1);
    issueId = _post.id_Issue; 

    function sendMessage() {
    message = document.getElementById("chat-input").value;
    userName = "<?= $_SESSION[_session_app_id]['first_name'] ?>"; 
    idUser = data[0].dari
    console.log(idUser);
    
    if (message.trim() === "") {
        alert("Pesan tidak boleh kosong!");
        return;
    }
    let now = new Date();
    let offset = 7 * 60 * 60 * 1000; 
    let currentTime = new Date(now.getTime() + offset).toISOString();
    
    sendPost("Issue", { 
        type_submit: "insLiveChat",
        NoIssue: issueId,       
        Waktu: currentTime,     
        Dari: userName,         
        Isi: message,
        idUser: idUser
    });

    document.getElementById("chat-input").value = ""; 
    loadChatHistory();
}

    function displayMessage(sender, message, time) {
        let chatBox = document.getElementById("chat-box");
        let messageElement = document.createElement("div");
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
        let date = new Date(dateString);
        let year = date.getFullYear();
        let monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        let month = monthNames[date.getMonth()];
        let day = date.getDate().toString().padStart(2, '0');
        let hour = date.getHours().toString().padStart(2, '0');
        let minute = date.getMinutes().toString().padStart(2, '0');
        return `${hour}:${minute} | ${day} ${month} ${year}`;
    }

    function loadChatHistory() {
        var chatBox = document.getElementById("chat-box");
        chatBox.innerHTML = ''; 
        var id_Issue = _post.id_Issue;  
        MComCli = sendPost("Issue", { type_submit: "getComCli", idIssue: issueId}); 
        MComCli.forEach(msg => {
            var formattedTime = formatDate(msg.Waktu.date);  
            displayMessage(msg.Dari, msg.Isi, formattedTime);  
        });
    }
    loadChatHistory();

</script>
