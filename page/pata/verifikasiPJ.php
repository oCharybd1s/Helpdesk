<div class="card">
	<div class="card-body">
        <div class="row">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header" style="font-size:32px; color: #00a652;"><b>Pengajuan Baru</b></h5>
                <div class="table-responsive text-nowrap">
                    <table class="table" style="text-align: center;">
                        <thead>
                            <tr>
                                <th style="width: 40px;"></th>
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
                        <tbody class="table-body-open" id="table-body-open">
                            <!-- Table rows will go here -->
                        </tbody>
                    </table>
                    
                   <!-- Pagination controls -->
                    <nav>
                        <ul class="pagination justify-content-center" id="tugasSaya" style="margin-top: 15px;">
                            <li class="page-item">
                                <a class="page-link" href="#" id="previous-page" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <!-- Page items will be dynamically generated here -->
                            <li class="page-item">
                                <a class="page-link" href="#" id="next-page" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
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

    priProgIssue = [];
    currentPageProgIssue = 1;
    rowsPerPageProgIssue = 20;
    progCount = 0;

    priOpenIssue = []; 
    currentPageOpenIssue = 1;
    rowsPerPageOpenIssue = 20;
    openCount = 0;

    all = sendPost("Issue", { type_submit: "getAllComb" });
    apk = sendPost("Issue", { type_submit: "getApk" });

    function printProgIssue() {
        sendPost("Issue", { type_submit: "getProgIssue" }, function(response) {
            priProgIssue = response;
            let htmlbody = "";
            progCount = priProgIssue.total_count;
            let dataArray = Array.isArray(priProgIssue) ? priProgIssue : priProgIssue.data;
            let startIndex = 0;
            let endIndex = 30;
            pageData1 = dataArray.slice(startIndex, endIndex);

            $.each(pageData1, function(index, row) {
                let formattedDate = formatDate(row.Tanggal.date);
                let jenis = row.Jenis;
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
                let statusHtml = "";

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
                            <td>
                                ${formattedDate}
                            </td> 
                            <td title="${dariDisplay}" style="max-width: 80px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                ${dariDisplay}
                            </td> 
                            <td title="${lapValue}" style="max-width: 80px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                ${lapValue}
                            </td>
                            <td title="${appValue}" style="max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                ${appValue}
                            </td>
                            <td title="${row.issue}" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${row.issue}    
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-label-primary">NEW</span>
                        </td>
                    </tr>
                `; 
            });
            $('#table-body-open').html(htmlbody);
            updateProgIssuePagination();
        });
    }

    function updateProgIssuePagination() {
    let totalPages = Math.ceil(progCount / rowsPerPageProgIssue);
    let paginationHTML = "";
    paginationHTML += `<li class="page-item ${currentPageProgIssue === 1 ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0);" id="previous-page" aria-label="Previous" onclick="changePageProgIssue(currentPageProgIssue - 1)">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>`;
    let maxPagesToShow = 10;
    if (totalPages <= maxPagesToShow) {
        for (let i = 1; i <= totalPages; i++) {
            paginationHTML += `<li class="page-item ${i === currentPageProgIssue ? 'active' : ''}" id="page-${i}">
                <a class="page-link" href="javascript:void(0);" onclick="changePageProgIssue(${i})">${i}</a>
            </li>`;
        }
    } else {
        let pagesToShow = [];
        pagesToShow.push(1);
        
        let start = Math.max(2, currentPageProgIssue - 2);
        let end = Math.min(totalPages - 1, currentPageProgIssue + 2);
        for (let i = start; i <= end; i++) {
            pagesToShow.push(i);
        }
        if (!pagesToShow.includes(totalPages)) {
            pagesToShow.push(totalPages);
        }
        if (pagesToShow[1] > 2) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
        
        // Add the pages
        for (let i of pagesToShow) {
            paginationHTML += `<li class="page-item ${i === currentPageProgIssue ? 'active' : ''}" id="page-${i}">
                <a class="page-link" href="javascript:void(0);" onclick="changePageProgIssue(${i})">${i}</a>
            </li>`;
        }

        // Add "..." if necessary before the last page
        if (pagesToShow[pagesToShow.length - 2] < totalPages - 1) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }

    // Show "Next" button
    paginationHTML += `<li class="page-item ${currentPageProgIssue === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0);" id="next-page" aria-label="Next" onclick="changePageProgIssue(currentPageProgIssue + 1)">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>`;

    // Update the pagination container
    $('#tugasSaya').html(paginationHTML);
}

    function changePageProgIssue(pageNumber) {
        if (typeof progCount !== "number" || progCount <= 0 || rowsPerPageProgIssue <= 0) {
            console.error("progCount atau rowsPerPageProgIssue tidak valid.");
            return;
        }

        let totalPages = Math.ceil(progCount / rowsPerPageProgIssue);
        if (pageNumber < 1 || pageNumber > totalPages) return;
        currentPageProgIssue = pageNumber;
        updateProgIssuePagination();
        printProgIssue(); 
    }
    
    function updateOpenIssuePagination() {
    let totalPages = Math.ceil(openCount / rowsPerPageOpenIssue);
    let paginationHTML = "";

    // Show "Previous" button
    paginationHTML += `<li class="page-item ${currentPageOpenIssue === 1 ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0);" id="previous-page" aria-label="Previous" onclick="changePageOpenIssue(currentPageOpenIssue - 1)">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>`;

    // Show pages with ellipsis logic
    let maxPagesToShow = 10;
    if (totalPages <= maxPagesToShow) {
        // If there are 10 or fewer pages, show all pages
        for (let i = 1; i <= totalPages; i++) {
            paginationHTML += `<li class="page-item ${i === currentPageOpenIssue ? 'active' : ''}" id="page-${i}">
                <a class="page-link" href="javascript:void(0);" onclick="changePageOpenIssue(${i})">${i}</a>
            </li>`;
        }
    } else {
        let pagesToShow = [];
        pagesToShow.push(1);
        let start = Math.max(2, currentPageOpenIssue - 2);
        let end = Math.min(totalPages - 1, currentPageOpenIssue + 2);
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
            paginationHTML += `<li class="page-item ${i === currentPageOpenIssue ? 'active' : ''}" id="page-${i}">
                <a class="page-link" href="javascript:void(0);" onclick="changePageOpenIssue(${i})">${i}</a>
            </li>`;
        }
        if (pagesToShow[pagesToShow.length - 2] < totalPages - 1) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }

    paginationHTML += `<li class="page-item ${currentPageOpenIssue === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="javascript:void(0);" id="next-page" aria-label="Next" onclick="changePageOpenIssue(currentPageOpenIssue + 1)">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>`;

    $('#tugasOpen').html(paginationHTML);
}

    function changePageOpenIssue(pageNumber) {
        if (typeof openCount !== "number" || openCount <= 0 || rowsPerPageOpenIssue <= 0) {
            console.error("openCount atau rowsPerPageOpenIssue tidak valid.");
            return;
        }

        let totalPages = Math.ceil(openCount / rowsPerPageOpenIssue);
        if (pageNumber < 1 || pageNumber > totalPages) return;
        currentPageOpenIssue = pageNumber;
        updateOpenIssuePagination();
        printOpenIssue(); 
    }

    printProgIssue(); 
    printOpenIssue(); 
</script>