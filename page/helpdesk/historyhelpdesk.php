<div class="card">
	<div class="card-body">
		<h5 class="card-header" style="font-size:32px; color: #00a652;"><b>History Semua Helpdesk</b></h5>
		<div class="container">
			<div class="row">
				<!-- Row pertama dengan 2 bagian -->
                <div class="col-md-6 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select name="tujuanDrop" id="tujuanDrop" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option value="" selected>All</option>
                            <option value="'Komplain'">Komplain</option>
                            <option value="'Request'">Request</option>
                        </select>
                        <label for="tujuanDrop">Tujuan</label>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="form-floating form-floating-outline">
                        <select name="kategoriDrop" id="kategoriDrop" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option value="" selected>All</option>
                            <option value="'Software'">Software</option>
                            <option value="'Hardware'">Hardware</option>
                        </select>
                        <label for="kategoriDrop">Kategori</label>
                    </div>
                </div>
			</div> 
            <!-- .row -->
			
			<div class="row">
				<!-- Row kedua dengan 3 bagian -->
				<div class="col-md-4 mb-4">
					<div class="form-floating form-floating-outline">
						<select name="jenisDrop" id="jenisDrop" class="select2 form-select form-select-lg" data-allow-clear="true">
							
						</select>
						<label for="jenisDrop">Jenis Laporan</label>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="form-floating form-floating-outline">
						<select name="workDrop" id="workDrop" class="select2 form-select form-select-lg" data-allow-clear="true">
							
						</select>
						<label for="workDrop">Dikerjakan Oleh</label>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="form-floating form-floating-outline">
						<select name="statusDrop" id="statusDrop" class="select2 form-select form-select-lg" data-allow-clear="true">
							<option value="" selected>All</option>
							<option value="1">Open</option>
							<option value="2">In Progress</option>
							<option value="3">Complete</option>
							<option value="4">Closed</option>
						</select>
						<label for="statusDrop">Status</label>
                        <small id="statusNote" style="color: red; display: none;">
                            * Open tidak dapat diakses karena sedang memilih dikerjakan oleh
                        </small>
					</div>
				</div>
			</div> <!-- .row -->
			
			<div class="row">
				<!-- Row ketiga dengan 3 bagian -->
				<div class="col-md-4 mb-4">
					<div class="form-floating form-floating-outline">
						<select name="bulanDrop" id="bulanDrop" class="select2 form-select form-select-lg" data-allow-clear="true">
							<option value="" selected>All</option>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
						<label for="bulanDrop">Bulan</label>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="form-floating form-floating-outline">
						<select name="tahunDrop" id="tahunDrop" class="select2 form-select form-select-lg" data-allow-clear="true">
							
						</select>
						<label for="tahunDrop">Tahun</label>
					</div>
				</div>
				<div class="col-md-4 mb-4">
					<div class="form-floating form-floating-outline">
						<select name="programDrop" id="programDrop" class="select2 form-select form-select-lg" data-allow-clear="true">
						
						</select>
						<label for="programDrop">Program Yang Dimaksud</label>
					</div>
				</div>
			</div> <!-- .row -->
			<div class="row">
				<!-- Basic Bootstrap Table -->
				<div class="card">
                <h5 class="card-header" style="font-size:32px; color: #00a652;"><b>Hasil</b></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" style="text-align: center;">
                    <thead>
                      <tr>
                        <th></th>
                        <th>No Issue</th>
                        <th>Prior</th>
                        <th>Date</th>
                        <th>Dari</th>
                        <th>Jenis</th>
                        <th>Program</th>
                        <th>Detail</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody id="table-body-all" class="table-border-bottom-0">
                    
                    </tbody>
                  </table>
				  <!-- Pagination controls -->
					<nav>
						<ul class="pagination justify-content-center" id="historyNav">
							<li class="page-item">
								<a class="page-link" href="#" id="previous-page" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
							</li>
							<li class="page-item" id="page-1"><a class="page-link" href="#">1</a></li>
							<li class="page-item" id="page-2"><a class="page-link" href="#">2</a></li>
							<li class="page-item" id="page-3"><a class="page-link" href="#">3</a></li>
							<!-- Add more page items as needed -->
							<li class="page-item">
								<a class="page-link" href="#" id="next-page" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						</ul>
					</nav>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->
			</div>
		</div> <!-- .container -->
	</div>
</div>
<style> 
  .table th, .table td {
    padding-left: 2px !important;
    padding-right: 2px !important;
    font-size: small;
}
</style>
<script type="text/javascript">
	// $(document).ready(()=>{
	// 	var tmp_calon_customer = rutanApi('DataCalonCustomerSAP', 'Wyge7d6IEmI3PmJSMMMM', {iddbase:'DB00000031', idapi:'API0000410'});
	// 	startForm(tmp_calon_customer);
	// });

	// function startForm() {
	// 	tmp_calon_customer = tmp_calon_customer;
	// 	console.log(tmp_calon_customer);
	// }

    function clearTableAndPagination() {
        $('#table-body-all').html('');
        $('#historyNav').html('');
    }
    clearTableAndPagination();

    all = sendPost("Issue", { type_submit: "getAllComb" });
    apk = sendPost("Issue", { type_submit: "getApk" });

	function generateYearOptions() {
		const currentYear = new Date().getFullYear();
		const startYear = 2023;
		let yearOptions = '<option value="" selected>All</option>';

		for (let year = startYear; year <= currentYear; year++) {
			let selected = (year === currentYear) ? 'selected' : '';
			yearOptions += `<option value="${year}" ${selected}>${year}</option>`;
		}

		document.getElementById('tahunDrop').innerHTML = yearOptions;
	}
	generateYearOptions();

	function printLaporan(jenis) {
        let laporan = sendPost("Issue", { type_submit: "getLaporan", jenis: jenis });
        let htmlbody = "";

        $.each(laporan, function (index, row) {
            htmlbody += `<option value="${row.Lap}">${row.NamaLaporan}</option>`;
        });

        $('#jenisDrop').html(`
            <option value="" selected>All</option>
            ${htmlbody}
        `);
    }

    function updateJenisLaporan() {
        let tujuan = $("#tujuanDrop").val().replace(/'/g, ""); 
        let kategori = $("#kategoriDrop").val().replace(/'/g, ""); 

        console.log("Tujuan:", tujuan);
        console.log("Kategori:", kategori);

        let jenis = "AllComb"; 

        if (tujuan === "Komplain" && kategori === "Software") {
            jenis = "KomSw";
        } else if (tujuan === "Komplain" && kategori === "Hardware") {
            jenis = "KomHw";
        } else if (tujuan === "Request" && kategori === "Software") {
            jenis = "ReqSw";
        } else if (tujuan === "Request" && kategori === "Hardware") {
            jenis = "ReqHw";
        } else if (tujuan === "Komplain" && kategori === "") {
            jenis = "Kom";
        } else if (tujuan === "Request" && kategori === "") {
            jenis = "Req";
        } else if (kategori === "Software" && tujuan === "") {
            jenis = "Sw";
        } else if (kategori === "Hardware" && tujuan === "") {
            jenis = "Hw";
        }

        printLaporan(jenis);
    }

    $(document).ready(function () {
        $("#tujuanDrop, #kategoriDrop").change(updateJenisLaporan);
        updateJenisLaporan();
    });

	function printPegawai() {
		if (Array.isArray(getPG) && getPG.length > 0) {
			let htmlbody = "";
			
			$.each(getPG, function (index, row) {
				if (row.id_dept == 1 ) { 
					htmlbody += `
						<option value="'${row.emp_no}'">${row.first_name}</option>
					`;
				}
			});

			$('#workDrop').html(`
				<option value="" selected>All</option>
				${htmlbody}
			`);
		} else {
			console.error("Data format error: getPG is not an array or it's empty.");
		}
	}
	printPegawai();

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
        $('#programDrop').html(`
            <option value="" selected>All</option>
            ${htmlbody}
        `);
        $('#programSelectDiv').show();
    }
    printApk();

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

	function formatMonth(dateStr) {
        let formattedDateStr = dateStr.split('.')[0].replace(" ", "T");
        let date = new Date(formattedDateStr);
        if (isNaN(date.getTime())) {
            return "Invalid Date"; 
        }
        const months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        let month = months[date.getMonth()];
        return `${month}`;
    }

	function formatYear(dateStr) {
        let formattedDateStr = dateStr.split('.')[0].replace(" ", "T");
        let date = new Date(formattedDateStr);
        if (isNaN(date.getTime())) {
            return "Invalid Date"; 
        }
        const currentYear = new Date().getFullYear();
		const startYear = 2023;
		const years = [];
		for (let year = startYear; year <= currentYear; year++) {
			years.push(year);
		}
        let year = date.getFullYear();
        return `${year}`;
    }
	$(document).ready(function() {
    $('#tujuanDrop, #kategoriDrop, #jenisDrop, #workDrop, #statusDrop, #bulanDrop, #tahunDrop, #programDrop').on('change', function() {
        printIssue();
    });

    printIssue();
});

currentPageIssue = 1;  
rowsPerPageIssue = 30;  
totalCountIssue = 0;  

function printIssue() {
    let selectedTujuan = $('#tujuanDrop').val();
    let selectedKategori = $('#kategoriDrop').val();
    let selectedJenis = $('#jenisDrop').val();
    let selectedWork = $('#workDrop').val();
    let selectedStatus= $('#statusDrop').val();
    let selectedBulan= $('#bulanDrop').val();
    let selectedTahun= $('#tahunDrop').val();
    let selectedProgram= $('#programDrop').val();

    sendPost("Issue", { 
    type_submit: "getIssue",
    page: currentPageIssue,
    tujuan : selectedTujuan,
    kategori : selectedKategori,
    jenis : selectedJenis,
    work : selectedWork,
    status : selectedStatus,
    bulan : selectedBulan,
    tahun : selectedTahun,
    program : selectedProgram
}, function(response) {
    if (!response || !response.data || !response.total_count) {
        console.error('Data is missing or invalid');
        return;
    }
    priProgIssue = response;
    totalCountIssue = priProgIssue.total_count;  
    let htmlbody = "";
    let rowStatus = "";
    let dataArray = Array.isArray(priProgIssue.data) ? priProgIssue.data : priProgIssue.data;

    let startIndex = 0;
    let endIndex = 20;
    if (endIndex > dataArray.length) {
        endIndex = dataArray.length;
    }

    let pageData = dataArray.slice(startIndex, endIndex);
    $.each(pageData, function(index, row) {
        let tujuan = row.tujuan;
        let kategori = row.kategori;
        let jenis = row.Jenis;
        let work = row.Ditangani ? row.Ditangani.trim() : "";
        let bulan = formatMonth(row.Tanggal.date);
        let tahun = formatYear(row.Tanggal.date);
        let statusHtml = "";

        if (!row.Ditangani && !row.TanggalSelesai) {
            statusHtml = `<span class="badge rounded-pill bg-label-success">Open</span>`;
            rowStatus = "1";
        } else if (row.Ditangani && !row.TanggalSelesai) {
            statusHtml = `<span class="badge rounded-pill bg-label-warning">In Progress</span>`;
            rowStatus = "2";
        } else if (row.Ditangani && row.TanggalSelesai) {
            statusHtml = `<span class="badge rounded-pill bg-label-info">Completed</span>`;
            rowStatus = "3";
        }

        let formattedDate = formatDate(row.Tanggal.date);
        let matchedLap = all.find(item => item.Lap === jenis.toString());
        let lapValue = matchedLap ? matchedLap.NamaLaporan : '-';
        let app = row.Aplikasi;
        let matchedApp = apk.find(item => item.Apl === app.toString());
        let appValue = matchedApp ? matchedApp.NamaAplikasi : '-';
        let rowDari = row.dari ? row.dari.trim().toLowerCase() : "";
        let matchedPegawai = getPG.find(pegawai => {
            let empNo = pegawai.emp_no ? pegawai.emp_no.trim().toLowerCase() : "";
            return empNo === rowDari;
        });
        let dariDisplay = matchedPegawai ? matchedPegawai.first_name : "-";

        htmlbody += `
            <tr>
                <td style="max-width:20px;">
                    <a onclick="page.view('helpdesk/editIssue_helpdesk','',{id_Issue:'${row.No}'})">
                        <i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i>
                    </a>
                </td>
                <td style="justify-content:center;">
                    <span class="fw-medium">
                        ${row.No}
                    </span>
                </td>
                <td style="justify-content:center;">
                    ${row.prioritas}
                </td> 
                <td >
                    ${formattedDate}
                </td> 
                <td title="${dariDisplay}" style="max-width: 80px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <b> ${dariDisplay} </b>
                </td> 
                <td title="${lapValue}" style="max-width: 80px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    ${lapValue}
                </td>
                <td title="${appValue}" style="max-width: 80px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    ${appValue}
                </td>
                <td title="${row.issue}" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                ${row.issue}    
                </td>
                <td>
                    ${statusHtml}
                </td>
            </tr>
        `;
    });
    $('#table-body-all').html(htmlbody);
    updateIssuePagination();
});
}

function updateIssuePagination() {
    let totalPages = Math.ceil(totalCountIssue / rowsPerPageIssue);
    let paginationHTML = "";

    paginationHTML += `<li class="page-item ${currentPageIssue === 1 ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0);" id="previous-page" aria-label="Previous" onclick="changePageIssue(currentPageIssue - 1)">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>`;

    let maxPagesToShow = 10;
    if (totalPages <= maxPagesToShow) {
        for (let i = 1; i <= totalPages; i++) {
            paginationHTML += `<li class="page-item ${i === currentPageIssue ? 'active' : ''}" id="page-${i}">
                <a class="page-link" href="javascript:void(0);" onclick="changePageIssue(${i})">${i}</a>
            </li>`;
        }
    } else {
        let pagesToShow = [];
        pagesToShow.push(1);
        let start = Math.max(2, currentPageIssue - 2);
        let end = Math.min(totalPages - 1, currentPageIssue + 2);
        for (let i = start; i <= end; i++) {
            pagesToShow.push(i);
        }
    
        if (!pagesToShow.includes(totalPages)) {
            pagesToShow.push(totalPages);
        }

        if (pagesToShow[1] > 2) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
        for (let i of pagesToShow) {
            paginationHTML += `<li class="page-item ${i === currentPageIssue ? 'active' : ''}" id="page-${i}">
                <a class="page-link" href="javascript:void(0);" onclick="changePageIssue(${i})">${i}</a>
            </li>`;
        }
        if (pagesToShow[pagesToShow.length - 2] < totalPages - 1) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    // Show "Next" button
    paginationHTML += `<li class="page-item ${currentPageIssue === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0);" id="next-page" aria-label="Next" onclick="changePageIssue(currentPageIssue + 1)">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>`;

    // Update the pagination container
    $('#historyNav').html(paginationHTML);
}


function changePageIssue(pageNumber) {
    if (typeof totalCountIssue !== "number" || totalCountIssue <= 0 || rowsPerPageIssue <= 0) {
        console.error("totalCountIssue atau rowsPerPageIssue tidak valid.");
        return;
    }

    let totalPages = Math.ceil(totalCountIssue / rowsPerPageIssue);
    if (pageNumber < 1 || pageNumber > totalPages) return;
    currentPageIssue = pageNumber;
    updateIssuePagination();
    printIssue();  
}

$(document).ready(function () {
    function updateStatusOptions() {
        let workValue = $("#workDrop").val();
        let openOption = $("#statusDrop option[value='1']");
        let statusNote = $("#statusNote");

        if (workValue && workValue !== "") {
            openOption.prop("disabled", true); 
            statusNote.show(); 
        } else {
            openOption.prop("disabled", false); 
            statusNote.hide(); 
        }
    }
    $("#workDrop").change(updateStatusOptions);
    updateStatusOptions();
});

</script>