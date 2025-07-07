<div class="col-md-12">
    <div class="card mb-4" style="border: 2px solid #00a652;">
        <h5 class="card-header" style="font-size:32px; color: #00a652;"><b>Buat Permintaan Pengajuan</b></h5>
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

                <!-- Cabang Pengajuan -->
                <div class="form-floating form-floating-outline">
                    <select name="floatingSelectCabang" class="form-select" id="floatingSelectCabang" required aria-label="Floating label select example" onchange="enableNext('floatingSelect2')" style="border: 1px solid #d8d8dd;">
                        <option value="" selected disabled>Pilih Cabang</option>
                        <option value="P" >PUSAT</option>
                        <option value="B" >Lampung</option>
                        <option value="R" >Semarang</option>
                        <option value="U" >Makassar</option>
                        <option value="V" >Jakarta</option>
                        <option value="W" >Palembang</option>
                        <option value="Y" >Medan</option>
                    </select>
                    <label for="floatingSelect1" 
                    style="color: #00a652;"><b>Cabang</b></label>
                </div>

                <!-- Kepada -->
                <div class="form-floating form-floating-outline">
                    <select name="takePegawai1" id="takePegawai1" class="select2 form-select form-select-lg" required data-allow-clear="true" style="border: 2px solid #00a652;">
                        <!-- Options will be populated here -->
                    </select>
                    <label style="color: #00a652;" for="select2Basic">Kepada</label>
                </div>

                <!-- Up -->
                <div class="form-floating form-floating-outline">
                    <select name="takePegawai2" id="takePegawai2" class="select2 form-select form-select-lg" required data-allow-clear="true" style="border: 2px solid #00a652;">
                        <!-- Options will be populated here -->
                    </select>
                    <label style="color: #00a652;" for="select2Basic">Up</label>
                </div>

                <!-- Investasi -->
                <div class="form-floating form-floating-outline">
                    <input
                    type="text"
                    class="form-control"
                    id="floatingSelect4" 
                    placeholder="Contoh: Scanner"
                    style="border: 1px solid #d8d8dd;"
                    aria-label="Investasi"
                    aria-describedby="floatingSelect4" />
                    <label for="floatingSelect4" 
                    style="color: #00a652;">Investasi</label>
                </div>

                <!-- Biaya -->
                <div class="form-floating form-floating-outline">
                    <input
                    type="text"
                    class="form-control"
                    id="floatingSelect5" 
                    placeholder="Contoh: Scanner"
                    style="border: 1px solid #d8d8dd;"
                    aria-label="Biaya"
                    aria-describedby="floatingSelect5" />
                    <label for="floatingSelect5" 
                    style="color: #00a652;">Biaya</label>
                </div>

                <!-- Deskripsi -->
                <div class="input-group input-group-merge">
                    <div name="floatingSelect6" class="form-floating form-floating-outline">
                        <textarea class="form-control" required aria-label="With textarea" placeholder="Masukkan Deskripsi" style="border: 1px solid #d8d8dd; height: auto; min-height: 200px;" rows="5"></textarea>
                        <label 
                        style="color: #00a652;"><b>Keterangan User</b></label>
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
                <button type="button" onclick="submitPengajuan()" class="btn btn-success mt-3">
                    Submit Pengajuan
                </button>
            </div>
        </form>
        <div id="loading" class="loading" style="display:none;">
            <div class="spinner"></div>
        </div>

        <!-- Success Popup -->
        <div id="successPopup" class="popup" style="display:none;">
            <div class="top" style="height:40%; background-color: rgba(255, 255, 255, 0);">
                <img src="src/icon/success.png" alt="Success" style="width:150px; height:150px; margin-bottom: 10px;">
                <p style="color:white !important;">Success!</p>
            </div>
            <div class="bottom" style="height:60%; background-color: #00a652;">
                <button onclick="closePopup('successPopup')">Okay</button>
            </div>
        </div>

        <!-- Error Popup -->
        <div id="errorPopup" class="popup" style="display:none;">
            <div class="top" style="height:40%; background-color: rgba(255, 255, 255, 0);">
                <img src="src/icon/error.png" alt="Error" style="width:150px; height:150px; margin-bottom: 10px;">
                <p style="color:white !important;">Error, please try again!</p>
            </div>
            <div class="bottom" style="height:60%; background-color: #00a652;">
                <button onclick="closePopup('errorPopup')">Okay</button>
            </div>
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

    function validateImage() {
        const inputFile = document.getElementById('inputGroupFile03');
        const errorMessage = document.getElementById('error-message');
        const file = inputFile.files[0];

        if (file && !file.type.startsWith('image/')) {
            errorMessage.style.display = 'block';
            inputFile.value = '';
        } else {
            errorMessage.style.display = 'none';
        }
    }

    function pad(num, size) {
        let s = "000000000" + num;
        return s.substr(s.length - size);
    }

    function setTimestamp() {
        const now = new Date();
        const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
        const gm7 = new Date(utc + (7 * 60 * 60000));

        const day = pad(gm7.getDate(), 2);
        const month = pad(gm7.getMonth() + 1, 2);
        const year = gm7.getFullYear();
        const hours = pad(gm7.getHours(), 2);
        const minutes = pad(gm7.getMinutes(), 2);
        const formattedTime = `${day}-${month}-${year} / ${hours}:${minutes} WIB`;
        document.getElementById('timestamp').innerText = formattedTime;
    }
    setInterval(setTimestamp, 1000);

    function submitPengajuan() {
        const dari = document.getElementById("takePegawai").value;
        const kepada = document.getElementById("takePegawai1").value;
        const up = document.getElementById("takePegawai2").value;
        const cabang = document.getElementById("#floatingSelectCabang").value;
        const investasi = document.getElementById("floatingSelect4").value;
        const biaya = document.getElementById("floatingSelect5").value;
        const deskripsi = document.querySelector("textarea[name='floatingSelect6']").value;

        const fileInput = document.getElementById("inputGroupFile03");
        const files = fileInput.files;

        const formData = new FormData();

        // Append data ke FormData
        formData.append("type_submit", "postPeng");
        formData.append("dari", dari);
        formData.append("kepada", kepada);
        formData.append("up", up);
        formData.append("cabang", cabang);
        formData.append("namainvestasi", investasi);
        formData.append("biaya", biaya);
        formData.append("keterangan", deskripsi);

        // Upload multiple files
        for (let i = 0; i < files.length; i++) {
            formData.append("file[]", files[i]);
        }

        // Kirim pakai submitPost
        submitPost("Issue", "postPeng", "pengajuanForm", formData, false);
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

    function printAllPegawai() {
        const getPG = rutanApi('GetAllPegawai', 'mP60RM7Spq9pMSYPRsCD', {
            iddbase: "DB00000023",
            idapi: "API0000700"
        });

        if (Array.isArray(getPG) && getPG.length > 0) {
            let htmlOptions = "";
            $.each(getPG, function (index, row) {
                htmlOptions += `<option value="${row.no_emp}">${row.first_name}</option>`;
            });

            // Untuk #takePegawai
            $('#takePegawai').html(`
                <option value="<?= $_SESSION[_session_app_id]['emp_no'] ?>" selected><?= $_SESSION[_session_app_id]['first_name'] ?></option>
                ${htmlOptions}
            `);

            // Untuk #takePegawai1
            $('#takePegawai1').html(`
                <option selected disabled value="#">Pilih Kepada</option>
                ${htmlOptions}
            `);

            // Untuk #takePegawai2
            $('#takePegawai2').html(`
                <option selected disabled value="#">Pilih Up</option>
                ${htmlOptions}
            `);
        } else {
            console.error("Data format error: getPG is not an array or it's empty.");
        }
    }

    printAllPegawai();
</script>


