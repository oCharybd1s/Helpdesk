<div class="card">
	<div class="card-body">
        <div class="row">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header" style="font-size:32px; color: #00a652;"><b>Pengajuan Saya</b></h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th style="width: 40px;"></th>
                                <th>No</th>
                                <th>Nama Investasi</th>
                                <th>Biaya</th>
                                <th>Date</th>
                                <th>Dari</th>
                                <th>Kepada</th>
                                <th>Up</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-open" class="table-body-open">
                            <!-- Table rows will be populated dynamically -->
                        </tbody>
                    </table>

                    <!-- Pagination controls -->
                    <nav>
                        <ul class="pagination justify-content-center" id="pengajuanSaya" style="margin-top: 15px;">
                            <!-- Page items will be generated dynamically by JavaScript -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
  .table th, .table td {
    padding-left: 4px !important;
    padding-right: 4px !important;
    font-size: small;
}
</style>
<script type="text/javascript">
	// $(document).ready(()=>{
	// 	var tmp_calon_customer = rutanApi('DataCalonCustomerSAP', 'Wyge7d6IEmI3PmJSMMMM', {iddbase:'DB00000031', idapi:'API0000410'});
	// 	startForm(tmp_calon_customer);
	// });

	// function startForm() {
    //     clearTableAndPagination();
    // }
    // startForm();

    function clearTableAndPagination() {
        $('#table-body-open').html('');
        $('#tugasOpen').html('');
    }
    clearTableAndPagination();

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

    pengajuanSaya = [];
    currentPagePengajuan = 1;
    rowsPerPagePengajuan = 20;
    pengajuanCount = 0;

    function printPengajuanSaya() {
    sendPost("Issue", { type_submit: "getAllPengajuan", page: currentPagePengajuan }, function(response) {
        pengajuanSaya = response;
        pengajuanCount = pengajuanSaya.total_count;

        let dataArray = Array.isArray(pengajuanSaya) ? pengajuanSaya : pengajuanSaya.data;

        let htmlbody = "";
        $.each(dataArray, function(index, row) {
            let formattedDate = formatDate(row.tanggal?.date || row.tanggal || "-");

            let rowDari = row.dari ? row.dari.trim().toLowerCase() : "";
            let matchedPegawaiDari = getPG.find(pegawai => pegawai.emp_no?.trim().toLowerCase() === rowDari);
            let dariDisplay = matchedPegawaiDari ? matchedPegawaiDari.first_name : "-";

            let rowKepada = row.kepada ? row.kepada.trim().toLowerCase() : "";
            let matchedPegawaiKepada = getPG.find(pegawai => pegawai.emp_no?.trim().toLowerCase() === rowKepada);
            let kepadaDisplay = matchedPegawaiKepada ? matchedPegawaiKepada.first_name : rowKepada;

            let upDisplay = row.up || "-";
            let biayaDisplay = row.biaya || "-";
            let investasiDisplay = row.namainvestasi || upDisplay;
            let statusHTML = row.Status || '<span class="badge rounded-pill bg-label-secondary">-</span>';
            htmlbody += `
                <tr>
                    <td><a onclick="page.view('helpdesk/editIssue_helpdesk','',{id_Issue:'${row.No}'})">
                                    <i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i>
                                </a></td>
                    <td>${row.No}</td>
                    <td title="${investasiDisplay}" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        ${investasiDisplay}
                    </td>
                    <td>${biayaDisplay}</td>
                    <td>${formattedDate}</td>
                    <td title="${dariDisplay}" style="max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        ${dariDisplay}
                    </td>
                    <td title="${kepadaDisplay}" style="max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        ${kepadaDisplay}
                    </td>
                    <td title="${upDisplay}" style="max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        ${upDisplay}
                    </td>
                    <td>${statusHTML}</td> 
                </tr>
            `;
        });

        $('#table-body-open').html(htmlbody);
        updatePengajuanPagination();
    });
}

    printPengajuanSaya();
</script>