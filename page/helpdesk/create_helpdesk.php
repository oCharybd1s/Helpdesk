<div class="col-md-12">
    <div class="card mb-4" style="border: 2px solid #00a652;">
        <h5 class="card-header" style="font-size:32px; color: #00a652;"><b>Buat Permintaan Helpdesk</b></h5>
        <form id="helpdeskForm" onsubmit="return validateForm()">
            <div id="issue" style="font-size:16px;">
                Tanggal Issue : <b><span name="timestamp" id="timestamp"></span></b>
            </div>

            <div class="card-body demo-vertical-spacing demo-only-element">
                <!-- Dari -->
                <div class="form-floating form-floating-outline">
                    <select name="takePegawai" id="takePegawai" class="select2 form-select form-select-lg" required data-allow-clear="true" style="border: 2px solid #00a652;">
                        <!-- Options will be populated here -->
                    </select>
                    <label style="color: #00a652;" for="select2Basic">Dari</label>
                </div>

                <!-- Tujuan Helpdesk -->
                <div class="form-floating form-floating-outline">
                    <select name="floatingSelect1" class="form-select" id="floatingSelect1" required aria-label="Floating label select example" onchange="enableNext('floatingSelect2')" style="border: 1px solid #d8d8dd;">
                        <option value="" selected disabled>Pilih Tujuan Helpdesk</option>
                        <option value="1">Komplain</option>
                        <option value="2">Request</option>
                    </select>
                    <label for="floatingSelect1" 
                    style="color: #00a652;"><b>Tujuan Helpdesk</b></label>
                </div>

                <!-- Kategori -->
                <div class="form-floating form-floating-outline">
                    <select name="floatingSelect2" class="form-select" id="floatingSelect2" required aria-label="Floating label select example" disabled onchange="handleChange()" onclick="handleCombination();" style="border: 1px solid #d8d8dd;">
                        <option value="" selected disabled>Pilih Kategori Issue</option>
                        <option value="1">Software</option>
                        <option value="2">Hardware</option>
                    </select>
                    <label for="floatingSelect2" 
                    style="color: #00a652;"><b>Kategori</b></label>
                </div>

                <!-- Jenis Laporan -->
                <div class="form-floating form-floating-outline">
                    <select name="floatingSelect3" class="form-select" id="floatingSelect3" required aria-label="Floating label select example" disabled onchange="enableNext('floatingSelect4')" style="border: 1px solid #d8d8dd;">
                        <option value="" selected disabled>Pilih Jenis Laporan</option>
                    </select>
                    <label for="floatingSelect3" 
                    style="color: #00a652;"><b>Jenis Laporan</b></label>
                </div>

                <!-- Program yang Dimaksud -->
                <div class="form-floating form-floating-outline" id="programSelectDiv" style="display: none;">
                    <select name="floatingSelect4" class="form-select" id="floatingSelect4" style="border: 2px solid #d8d8dd;" aria-label="Floating label select example" disabled>
                        <option value="" selected disabled>Pilih Program yang Dimaksud</option>
                    </select>
                    <label for="floatingSelect4" 
                    style="color: #00a652;"><b>Program yang diMaksud</b></label>
                </div>

                <!-- Deskripsi -->
                <div class="input-group input-group-merge">
                    <div name="floatingSelect5" class="form-floating form-floating-outline">
                        <textarea class="form-control" required aria-label="With textarea" placeholder="Masukkan Deskripsi" style="border: 1px solid #d8d8dd; height: auto; min-height: 200px;" rows="5"></textarea>
                        <label 
                        style="color: #00a652;"><b>Deskripsi</b></label>
                    </div>
                </div>

                <!-- Upload Gambar -->
                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                    <label style="color: #00a652;"><b>Upload Gambar:</b></label>
                    <div class="input-group">
                    <input name="file[]" type="file" class="form-control" id="inputGroupFile03" accept="image/*" multiple 
                        onchange="handleFiles(this);" 
                        style="background-color:#eff0e9;margin-bottom:10px; place-items:center; border: 1px solid #d8d8dd;">
                    </div>
                    
                    <div id="dropzone">
                        <span id="dropzone-text">Drag and drop images here</span>
                    </div>
                </div>

                <div id="error-message" style="color: red; display: none;">
                    <p>Hanya menerima gambar. Ekstensi yang diperbolehkan: .jpg, .jpeg, .png, .gif</p>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btnPost" style="color: #00a652; border: 1px solid #d8d8dd; padding: 10px 30px; border-radius: 25px; text-align: center;">KIRIM</button> 
            </div>
        </form>
        <!-- Success Popup -->
        <div id="toast" class="toast">
            <div class="content">
                <div class="icon"><i></i></div>
                <div class="message">
                    <span class="text-1"></span>
                    <span class="text-2"></span>
                </div>
            </div>
            <div class="progress"></div>
            <button class="close">×</button>
        </div>
    </div>
</div>
<style>
     #issue {
      padding-left: 20px;
    }

    .btnPost:hover{
        background-color: #00a652;
        color:#fff !important;
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        height: 400px;
        border-radius: 20px;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        display: none;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .top {
        flex: 1;
        text-align: center;
        padding: 20px;
    }

    .bottom {
        flex: 2;
        text-align: center;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        color:white !important;
    }

    .popup button {
        padding: 10px 20px;
        background-color: white;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        color:#4CAF50;
        font-style: bold;
    }

    .popup img {
        display: block;
        margin: 0 auto 10px auto; 
        width: 35px;  
        height: 350px; 
        object-fit: cover; 
    }

    #dropzone {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        border: 2px dashed #00a652;
        padding: 20px;
        width: 100%;
        min-height: 200px;
        height: auto;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
    }

    #dropzone:hover {
        background-color: #e9f7ef;
        border-color: #007f4e;
    }

    #dropzone-text {
        color: #888;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    .image-container {
        position: relative;
        display: inline-block;
        cursor: pointer;
        overflow: hidden;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }

    .image-container:hover {
        transform: scale(1.05);
    }

    .image-container img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .image-info {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        font-size: 12px;
        text-align: center;
        padding: 4px 0;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .image-container:hover .image-info {
        opacity: 1;
    }

    .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        width: 24px;
        height: 24px;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s;
    }

    .image-container:hover .delete-btn {
        display: flex;
    }

    .delete-btn:hover {
        background: darkred;
    }

    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

    .center-button {
        padding: 15px 25px;
        font-size: 18px;
        font-weight: bold;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .center-button:hover {
        background-color: #0056b3;
    }

    /* Toast (notifikasi) */
    .toast {
        position: fixed;
        top: 20px; 
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999; 
        display: none;
        padding: 15px 20px;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        max-width: 300px;
        text-align: center;
    }

    /* Warna untuk setiap jenis notifikasi */
    .toast.success { background-color: #28a745; }
    .toast.error { background-color: #dc3545; }

</style>
<script type="text/javascript">
	// $(document).ready(()=>{
	// 	var tmp_calon_customer = rutanApi('DataCalonCustomerSAP', 'Wyge7d6IEmI3PmJSMMMM', {iddbase:'DB00000031', idapi:'API0000410'});
	// 	startForm(tmp_calon_customer);
	// });

	// function startForm() {
    //     tmp_post = sendPost("Issue", { type_submit: "getIssue" });
    //     htmlbody = "";
    //     $.each(tmp_post, function (index, row) {
    //         htmlbody += `<tr>
    //             <td>${row.dari}</td>
    //             <td>${dateFormat(row.Tanggal.date, 'd-m-Y')}</td>
    //             <td>${row.Jenis}</td>
    //         </tr>`;
    //     });
    //     $('#table-view tbody').html(htmlbody);
    //     $('#table-view table').dataTable();
    // }

    // startForm();

    function pad(num, size) {
        let s = "000000000" + num;
        return s.substr(s.length - size);
    }

    function setTimestamp() {
        const now = new Date();
        const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
        const gm7 = new Date(utc + (7 * 60 * 60000));
        window.rawTimestamp = `${gm7.getFullYear()}-${pad(gm7.getMonth() + 1, 2)}-${pad(gm7.getDate(), 2)} ` +
                          `${pad(gm7.getHours(), 2)}:${pad(gm7.getMinutes(), 2)}:${pad(gm7.getSeconds(), 2)}.${pad(gm7.getMilliseconds(), 3)}`;

        const day = pad(gm7.getDate(), 2);
        const month = pad(gm7.getMonth() + 1, 2);
        const year = gm7.getFullYear();
        const hours = pad(gm7.getHours(), 2);
        const minutes = pad(gm7.getMinutes(), 2);
        const formattedTime = `${day}-${month}-${year} / ${hours}:${minutes} WIB`;
        document.getElementById('timestamp').innerText = formattedTime;
    }
    setInterval(setTimestamp, 1000);

    function enableNext(nextSelectId) {
        const nextSelect = document.getElementById(nextSelectId);
        const prevSelect = document.getElementById('floatingSelect3');

        if (nextSelectId === "floatingSelect4" && prevSelect.value === "") {
            return;
        }

        if (nextSelect) {
            nextSelect.disabled = false;
        }
    }

    function toggleProgramSelect() {
        const categorySelect = document.getElementById('floatingSelect2'); 
        const programSelectDiv = document.getElementById('programSelectDiv'); 
        const programSelect4 = document.getElementById('floatingSelect4'); 
        const jenisLaporanSelect = document.getElementById('floatingSelect3'); 
        if (!categorySelect || !programSelectDiv || !programSelect4 || !jenisLaporanSelect) return;

        const categoryValue = categorySelect.value;

        if (categoryValue === "1") {
            programSelectDiv.style.display = "block";
            programSelect4.disabled = true;

            if (jenisLaporanSelect.value !== "") {
                programSelect4.disabled = false;
            }

            if (jenisLaporanSelect.value === "") {
                programSelect4.value = "";
            }

            jenisLaporanSelect.value = "";
        } else {
            programSelectDiv.style.display = "none";
            programSelect4.disabled = true;
            jenisLaporanSelect.value = "";
            programSelect4.value = "";
        }
    }

    function handleChange() {
        toggleProgramSelect();
        enableNext('floatingSelect3');
    }

    function printApk() {
        tmp_post = sendPost("Issue", { type_submit: "getAPK" });
        let htmlbody = "";

        $.each(tmp_post, function (index, row) {
            // Check if 'aktif' is 1
            if (row.Aktif == 1) {
                htmlbody += `
                    <option value="${row.Apl}">${row.NamaAplikasi}</option>
                `;
            }
        });
        $('#floatingSelect4').html(`
            <option value="" selected disabled>Open this select menu</option>
            ${htmlbody}
        `);
        $('#programSelectDiv').show();
    }
    printApk();

    function printKomSw() {
        komSw = sendPost("Issue", { type_submit: "getKomSw" });
        htmlbody = "";
        $.each(komSw, function (index, row) {
            htmlbody += `
                <option value="${row.Lap}">${row.NamaLaporan}</option>
            `;
        });
        $('#floatingSelect3').html(`
            <option value="" selected disabled>Open this select menu</option>
            ${htmlbody}
        `);
    }

    function printKomHw() {
        komHw = sendPost("Issue", { type_submit: "getKomHw" });
        htmlbody = "";
        $.each(komHw, function (index, row) {
            htmlbody += `
                <option value="${row.Lap}">${row.NamaLaporan}</option>
            `;
        });
        $('#floatingSelect3').html(`
            <option value="" selected disabled>Open this select menu</option>
            ${htmlbody}
        `);
    }

    function printReqSw() {
        ReqSw = sendPost("Issue", { type_submit: "getReqSw" });
        htmlbody = "";
        $.each(ReqSw, function (index, row) {
            htmlbody += `
                <option value="${row.Lap}">${row.NamaLaporan}</option>
            `;
        });
        $('#floatingSelect3').html(`
            <option value="" selected disabled>Open this select menu</option>
            ${htmlbody}
        `);
    }

    function printReqHw() {
        ReqHw = sendPost("Issue", { type_submit: "getReqHw" });
        htmlbody = "";
        $.each(ReqHw, function (index, row) {
            htmlbody += `
                <option value="${row.Lap}">${row.NamaLaporan}</option>
            `;
        });
        $('#floatingSelect3').html(`
            <option value="" selected disabled>Open this select menu</option>
            ${htmlbody}
        `);
    }

    function handleCombination() {
        const tujuan = document.getElementById("floatingSelect1").value;
        const kategori = document.getElementById("floatingSelect2").value;
        const select3 = document.getElementById("floatingSelect3");

        // Reset and populate the third select
        select3.innerHTML = '<option value="" selected disabled>Open this select menu</option>'; 
        if (tujuan && kategori) {
            let options = [];

            if (tujuan == "1" && kategori == "1") {
                printKomSw();;
            } else if (tujuan == "1" && kategori == "2") {
                printKomHw();;
            } else if (tujuan == "2" && kategori == "1") {
                printReqSw();;
            } else if (tujuan == "2" && kategori == "2") {
                printReqHw();;
            }

            options.forEach(function(option) {
                let opt = document.createElement("option");
                opt.value = option;
                opt.innerHTML = option;
                select3.appendChild(opt);
            });
            select3.removeAttribute("disabled");
        } else {
            select3.setAttribute("disabled", "true");
        }
    }

    function validateForm() {
        event.preventDefault(); 
        document.getElementById('loading').style.display = 'flex';
        setTimeout(function() {
            document.getElementById('loading').style.display = 'none';
            let isSuccess = Math.random() > 0.5;
            if (isSuccess) {
                submitHD()
                document.getElementById('successPopup').style.display = 'block';
            } else {
                document.getElementById('errorPopup').style.display = 'block';
            }
        }, 2000); 
    }

    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
        document.getElementById('helpdeskForm').reset();
        document.getElementById('error-message').style.display = 'none';
    }

    function submitHD(){
        tes = submitPost(target='Issue', type_submit='postHD', id_form='helpdeskForm', data={}, reload=false);
        console.log(tes);
    }

    async function printPegawai() {
        let getPG = await rutanApi('GetAllPegawai', 'mP60RM7Spq9pMSYPRsCD', {
            iddbase: "DB00000023",
            idapi: "API0000700"
        });

        // Pastikan data sudah benar sebelum disort
        if (Array.isArray(getPG) && getPG.length > 0) {
            getPG = getPG.sort(function(a, b){
                var aName = a.first_name.toLowerCase();
                var bName = b.first_name.toLowerCase(); 
                return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
            });

            let htmlbody = getPG.map(row => `<option value="${row.emp_no}">${row.first_name}</option>`).join("");

            $('#takePegawai').html(`
                <option value="<?= $_SESSION[_session_app_id]['emp_no'] ?>" selected><?= $_SESSION[_session_app_id]['first_name'] ?></option>
                ${htmlbody}
            `);
        } else {
            console.error("Data format error: getPG is not an array or it's empty.");
        }

        // Event listener untuk mencetak value saat user memilih opsi
        $(document).on("change", "#takePegawai", function () {
            console.log("Selected Employee ID:", $(this).val());
        });
    }

    printPegawai()

    document.querySelector(".btnPost").addEventListener("click", async function (event) {
    event.preventDefault();

    function pad(num, size) {
        return num.toString().padStart(size, '0');
    }

    try {
        let accPATA = await sendPost("Issue", { type_submit: "getAtP" });

        let prioritas = null;
        let TanggalKonfirmasi = null;

        if (accPATA == 1) {
            prioritas = 2;
            let now = new Date();
            let utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            let gm7 = new Date(utc + (7 * 60 * 60000));
            TanggalKonfirmasi = `${gm7.getFullYear()}-${pad(gm7.getMonth() + 1, 2)}-${pad(gm7.getDate(), 2)} ` +
                `${pad(gm7.getHours(), 2)}:${pad(gm7.getMinutes(), 2)}:${pad(gm7.getSeconds(), 2)}.${pad(gm7.getMilliseconds(), 3)}`;
        }

        let No = await sendPost("Issue", { type_submit: "issueGenID" });

        let takePegawai = document.getElementById("takePegawai")?.value || "";
        let tujuanHelpdesk = parseInt(document.getElementById("floatingSelect1")?.value) || 0;
        let kategori = parseInt(document.getElementById("floatingSelect2")?.value) || 0;
        let jenisLaporan = parseInt(document.getElementById("floatingSelect3")?.value) || 0;
        let program = parseInt(document.getElementById("floatingSelect4")?.value) || 0;
        let deskripsi = document.querySelector("textarea")?.value || "";
        // let inputFiles = document.getElementById("inputGroupFile03").files;

        let data = {
            No,
            prioritas,
            Tanggal: window.rawTimestamp || new Date().toISOString(),
            dari: takePegawai,
            tujuan: tujuanHelpdesk,
            kategori,
            Jenis: jenisLaporan,
            Aplikasi: program,
            issue: deskripsi,
            accPATA,
            TanggalKonfirmasi,
            Rating: 0,
            StNotifPATA: 0,
            StNotifIT: 0,
            StNotifStf: 0
        };

        let response = await sendPost("Issue", "createHD", "helpdeskForm", data);
    } catch (error) {
        console.error("🚨 Unexpected Error:", error);
        showToast(false);
    }
});


    function showToast(isSuccess) {
        const toast = document.getElementById("toast");
        if (isSuccess) {
            toast.innerText = "✅ Sukses, issue telah ditambahkan.";
            toast.className = "toast success";
        } else {
            toast.innerText = "❌ Gagal, issue tidak berhasil ditambahkan.";
            toast.className = "toast error";
        }

        toast.style.display = "block";

        setTimeout(() => {
            toast.style.display = "none";
        }, 3000);
    }

    async function submitPost(action, method, formId, formData) {
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve({
                    status: Math.random() > 0.2 ? "success" : "error", 
                    st_gmbr: [{ status: "success" }]
                });
            }, 1000);
        });
    }

    selectedFiles = [];

    function handleFiles(input) {
        const dropzone = document.getElementById("dropzone");
        const dropzoneText = document.getElementById("dropzone-text");
        if (dropzoneText) dropzoneText.style.display = "none";
        selectedFiles = []; 

        let newFiles = Array.from(input.files);

        newFiles.forEach(file => {
            if (file.type.startsWith("image/")) {
                selectedFiles.push(file);
            } else {
                alert(`File "${file.name}" tidak didukung. Hanya file gambar yang diperbolehkan.`);
            }
        });

        updateFileInput(input);
        console.log("Files uploaded:", selectedFiles);

        renderDropzone(input);
    }

    function renderDropzone(input) {
        const dropzone = document.getElementById("dropzone");
        dropzone.innerHTML = "";

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageContainer = document.createElement("div");
                imageContainer.classList.add("image-container");
                imageContainer.setAttribute("data-index", index);

                const img = document.createElement("img");
                img.src = e.target.result;

                const info = document.createElement("div");
                info.classList.add("image-info");
                info.textContent = `${file.name} (${(file.size / 1024).toFixed(2)} KB)`;

                const deleteBtn = document.createElement("button");
                deleteBtn.classList.add("delete-btn");
                deleteBtn.textContent = "✖";
                deleteBtn.onclick = function () {
                    const fileIndex = parseInt(imageContainer.getAttribute("data-index"));
                    selectedFiles.splice(fileIndex, 1);
                    updateFileInput(input);
                    renderDropzone(input);
                    console.log("Updated file list after deletion:", selectedFiles);

                    if (selectedFiles.length === 0 && dropzoneText) {
                        dropzoneText.style.display = "block";
                    }
                };

                imageContainer.appendChild(img);
                imageContainer.appendChild(info);
                imageContainer.appendChild(deleteBtn);
                dropzone.appendChild(imageContainer);
            };
            reader.readAsDataURL(file);
        });
    }

    function updateFileInput(input) {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
    }

    function clearForm() {
        const idsToClear = [
            "takePegawai",
            "floatingSelect1",
            "floatingSelect2",
            "floatingSelect3",
            "floatingSelect4",
            "inputGroupFile03"
        ];

        idsToClear.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = "";
        });

        const textarea = document.querySelector("textarea");
        if (textarea) textarea.value = "";

        const dropzoneText = document.getElementById("dropzone-text");
        if (dropzoneText) dropzoneText.innerText = "Drag and drop images here";

        const errorMessage = document.getElementById("error-message");
        if (errorMessage) errorMessage.style.display = "none";

        const selectsToDisable = ["floatingSelect2", "floatingSelect3", "floatingSelect4"];
        selectsToDisable.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.disabled = true;
        });

        const programDiv = document.getElementById("programSelectDiv");
        if (programDiv) programDiv.style.display = "none";
    }
</script>


