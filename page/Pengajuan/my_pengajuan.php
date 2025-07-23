<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="card">
                    <h5 class="card-header" style="font-size:32px; color: #00a652;">
                        <b>Pengajuan Management</b>
                        <span id="departmentInfo" class="badge bg-secondary float-end"></span>
                    </h5>

                    <!-- Filter Section -->
                    <div class="card-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label">Filter Status:</label>
                                <select class="form-select" id="filterStatus" onchange="filterTable()">
                                    <option value="">Semua Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Review">Under Review</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Filter Departemen:</label>
                                <select class="form-select" id="filterDepartment" onchange="filterTable()">
                                    <option value="">Semua Departemen</option>
                                    <option value="IT">IT</option>
                                    <option value="HR">HR</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Operations">Operations</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Cari Nama:</label>
                                <input type="text" class="form-control" id="searchName" placeholder="Cari nama investasi..." onkeyup="filterTable()">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Mode Tampilan:</label>
                                <select class="form-select" id="viewMode" onchange="changeViewMode()">
                                    <option value="my">Pengajuan Saya</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">Action</th>
                                    <th>No</th>
                                    <th>Nama Investasi</th>
                                    <th>Biaya</th>
                                    <th>Date</th>
                                    <th>Dari</th>
                                    <th>Kepada</th>
                                    <th>Up</th>
                                    <th>Dept</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="table-body-open" class="table-body-open">
                                <!-- Table rows will be populated dynamically -->
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="mt-2">Memuat data pengajuan...</p>
                                    </td>
                                </tr>
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
</div>

<style>
.table th, .table td {
    padding-left: 8px !important;
    padding-right: 8px !important;
    font-size: small;
}

.table tbody tr:hover {
    background-color: rgba(0, 166, 82, 0.05);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.btn-action {
    border: none;
    border-radius: 8px;
    padding: 6px 10px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin: 2px;
}

.btn-edit {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
}

.btn-edit:hover {
    background: linear-gradient(135deg, #2980b9 0%, #1f5f99 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
    color: white;
}

.btn-view {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
}

.btn-view:hover {
    background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
    color: white;
}

.badge-custom {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.badge-pending {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
}

.badge-approved {
    background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
    color: white;
}

.badge-rejected {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
}

.badge-review {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
}

.department-badge {
    display: inline-block;
    padding: 4px 8px;
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    border-radius: 12px;
    font-size: 10px;
    font-weight: 600;
}

.department-it {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
}

.currency {
    font-weight: 600;
    color: #27ae60;
}

.pagination .page-link {
    border: none;
    color: #00a652;
    padding: 8px 16px;
    margin: 0 2px;
    border-radius: 8px;
}

.pagination .page-link:hover {
    background-color: #00a652;
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: #00a652;
    border-color: #00a652;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}

.btn-retry {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-retry:hover {
    background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
    transform: translateY(-2px);
    color: white;
}

.btn-create {
    background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-create:hover {
    background: linear-gradient(135deg, #229954 0%, #1e7e34 100%);
    transform: translateY(-2px);
    color: white;
}
</style>

<script type="text/javascript">
    // Global variables
    let pengajuanSaya = [];
    let filteredData = [];
    let currentPagePengajuan = 1;
    let rowsPerPagePengajuan = 20;
    let pengajuanCount = 0;
    let currentViewMode = 'my';
    let userDepartment = '<?= $_SESSION[_session_app_id]['id_dept'] ?? '' ?>';
    let userEmpNo = '<?= $_SESSION[_session_app_id]['emp_no'] ?? '' ?>';
    let userName = '<?= $_SESSION[_session_app_id]['first_name'] ?? '' ?>';

    // Clear table and pagination
    function clearTableAndPagination() {
        $('#table-body-open').html(`
            <tr>
                <td colspan="10" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data pengajuan...</p>
                </td>
            </tr>
        `);
        $('#pengajuanSaya').html('');
    }

    // Format date function
    function formatDate(dateStr) {
        if (!dateStr) return "-";
        
        try {
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
        } catch (error) {
            return dateStr;
        }
    }

    // Format currency
    function formatCurrency(amount) {
        if (!amount || amount === 0 || amount === "0") return "-";
        
        // Remove any existing formatting
        let numAmount = amount.toString().replace(/[^0-9.-]/g, '');
        
        if (isNaN(numAmount) || numAmount === "") return amount;
        
        return 'Rp ' + parseFloat(numAmount).toLocaleString('id-ID');
    }

    // Main function to load pengajuan data
    function printPengajuanSaya() {
        const viewMode = document.getElementById('viewMode')?.value || 'my';
        
        // Fix: IT Department should default to 'all' mode, bukan 'my'
        let requestType;
        if (userDepartment === '1') {
            // IT Department: default ke getAllPengajuanForIT kecuali user pilih 'my'
            requestType = viewMode === 'my' ? 'getAllPengajuan' : 'getAllPengajuanForIT';
        } else {
            // Regular user: selalu getAllPengajuan
            requestType = 'getAllPengajuan';
        }
        
        console.log('Loading pengajuan data...', { 
            viewMode, 
            requestType, 
            userDepartment, 
            userEmpNo,
            currentPage: currentPagePengajuan,
            isITDepartment: userDepartment === '1'
        });
        
        // Show loading state
        clearTableAndPagination();
        
        sendPost("Issue", { 
            type_submit: requestType, 
            page: currentPagePengajuan,
            limit: rowsPerPagePengajuan 
        }, function(response) {
            console.log('Response received:', response);
            
            if (response && response.status === 'success') {
                pengajuanSaya = response.data || [];
                pengajuanCount = response.total_count || 0;
                filteredData = [...pengajuanSaya];

                console.log('Data loaded successfully:', {
                    count: pengajuanSaya.length,
                    totalCount: pengajuanCount
                });

                displayTable();
                updatePengajuanPagination();
            } else {
                console.error('Error fetching pengajuan:', response);
                showErrorState(response?.message || 'Gagal memuat data pengajuan');
            }
        });
    }

    // Show error state
    function showErrorState(message) {
        $('#table-body-open').html(`
            <tr>
                <td colspan="10" class="text-center py-4">
                    <i class="mdi mdi-alert-circle-outline mdi-48px text-warning"></i>
                    <p class="mt-2 text-muted">${message}</p>
                    <button class="btn btn-retry btn-sm" onclick="printPengajuanSaya()">
                        <i class="mdi mdi-refresh me-1"></i>Coba Lagi
                    </button>
                </td>
            </tr>
        `);
        $('#pengajuanSaya').html('');
    }

    // Display table data
    function displayTable() {
        console.log('Displaying table with filtered data:', filteredData.length);
        
        const startIndex = (currentPagePengajuan - 1) * rowsPerPagePengajuan;
        const endIndex = startIndex + rowsPerPagePengajuan;
        const paginatedData = filteredData.slice(startIndex, endIndex);

        let htmlbody = "";
        
        if (filteredData.length === 0) {
            htmlbody = `
                <tr>
                    <td colspan="10" class="text-center py-4">
                        <i class="mdi mdi-folder-open-outline mdi-48px text-muted"></i>
                        <p class="mt-2 text-muted">Tidak ada data pengajuan</p>
                        <button class="btn btn-create btn-sm" onclick="createNewPengajuan()">
                            <i class="mdi mdi-plus me-1"></i>Buat Pengajuan Baru
                        </button>
                    </td>
                </tr>
            `;
        } else {
            $.each(paginatedData, function(index, row) {
                let formattedDate = formatDate(row.tanggal?.date || row.tanggal || row.Tanggal || "-");
                let dariDisplay = row.emp_name_dari || row.dari || row.Dari || "-";
                let kepadaDisplay = row.emp_name_kepada || row.kepada || row.Kepada || "-";
                let upDisplay = row.emp_name_up || row.up || row.Up || "-";
                let biayaDisplay = formatCurrency(row.biaya || row.Biaya || 0);
                let investasiDisplay = row.namainvestasi || row.Namainvestasi || row.namaInvestasi || upDisplay || "Tidak ada nama";
                let statusHTML = row.Status || '<span class="badge bg-secondary">Pending</span>';
                let departmentDisplay = row.department || row.Department || row.dept_dari || "-";

                htmlbody += `
                    <tr>
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <a onclick="editPengajuan('${row.No}')" class="btn-action btn-edit" title="Edit Pengajuan" href="javascript:void(0)">
                                    <i class="mdi mdi-pencil mdi-16px"></i>
                                </a>
                                <a onclick="viewPengajuan('${row.No}')" class="btn-action btn-view" title="View Detail" href="javascript:void(0)">
                                    <i class="mdi mdi-eye mdi-16px"></i>
                                </a>
                            </div>
                        </td>
                        <td><strong>${row.No}</strong></td>
                        <td title="${investasiDisplay}" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${investasiDisplay}
                        </td>
                        <td class="currency">${biayaDisplay}</td>
                        <td style="font-size: 11px;">${formattedDate}</td>
                        <td title="${dariDisplay}" style="max-width: 120px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${dariDisplay}
                        </td>
                        <td title="${kepadaDisplay}" style="max-width: 120px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${kepadaDisplay}
                        </td>
                        <td title="${upDisplay}" style="max-width: 120px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${upDisplay}
                        </td>
                        <td><span class="department-badge">${departmentDisplay}</span></td>
                        <td>${statusHTML}</td>
                    </tr>
                `;
            });
        }

        $('#table-body-open').html(htmlbody);
        console.log('Table updated with', paginatedData.length, 'rows');
    }

    // Update pagination
    function updatePengajuanPagination() {
        const totalPages = Math.ceil(filteredData.length / rowsPerPagePengajuan);
        let paginationHTML = "";

        if (totalPages <= 1) {
            paginationHTML = `
                <li class="page-item disabled">
                    <span class="page-link">
                        ${filteredData.length} total items
                    </span>
                </li>
            `;
            $('#pengajuanSaya').html(paginationHTML);
            return;
        }

        // Previous button
        if (currentPagePengajuan > 1) {
            paginationHTML += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="changePage(${currentPagePengajuan - 1})">
                        <i class="mdi mdi-chevron-left"></i>
                    </a>
                </li>
            `;
        }

        // Page numbers
        const startPage = Math.max(1, currentPagePengajuan - 2);
        const endPage = Math.min(totalPages, currentPagePengajuan + 2);

        for (let i = startPage; i <= endPage; i++) {
            paginationHTML += `
                <li class="page-item ${i === currentPagePengajuan ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="changePage(${i})">${i}</a>
                </li>
            `;
        }

        // Next button
        if (currentPagePengajuan < totalPages) {
            paginationHTML += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="changePage(${currentPagePengajuan + 1})">
                        <i class="mdi mdi-chevron-right"></i>
                    </a>
                </li>
            `;
        }

        // Info
        paginationHTML += `
            <li class="page-item disabled">
                <span class="page-link">
                    ${filteredData.length} total items
                </span>
            </li>
        `;

        $('#pengajuanSaya').html(paginationHTML);
    }

    // Change page function
    function changePage(page) {
        console.log('Changing to page:', page);
        currentPagePengajuan = page;
        displayTable();
        updatePengajuanPagination();
    }

    // Filter table function
    function filterTable() {
        console.log('Applying filters...');
        
        const statusFilter = document.getElementById('filterStatus').value.toLowerCase();
        const departmentFilter = document.getElementById('filterDepartment').value.toLowerCase();
        const nameSearch = document.getElementById('searchName').value.toLowerCase();

        filteredData = pengajuanSaya.filter(item => {
            const statusMatch = !statusFilter || (item.Status && item.Status.toLowerCase().includes(statusFilter));
            const departmentMatch = !departmentFilter || (
                (item.department && item.department.toLowerCase() === departmentFilter) ||
                (item.Department && item.Department.toLowerCase() === departmentFilter) ||
                (item.dept_dari && item.dept_dari.toLowerCase() === departmentFilter)
            );
            const nameMatch = !nameSearch || (
                (item.namainvestasi && item.namainvestasi.toLowerCase().includes(nameSearch)) ||
                (item.Namainvestasi && item.Namainvestasi.toLowerCase().includes(nameSearch)) ||
                (item.namaInvestasi && item.namaInvestasi.toLowerCase().includes(nameSearch))
            );
            
            return statusMatch && departmentMatch && nameMatch;
        });

        console.log('Filtered data:', filteredData.length, 'items');
        
        currentPagePengajuan = 1;
        displayTable();
        updatePengajuanPagination();
    }

    // Change view mode function
    function changeViewMode() {
        const newMode = document.getElementById('viewMode').value;
        
        console.log('Changing view mode to:', newMode);
        
        if (newMode === 'all' && userDepartment !== '1') {
            alert('Akses ditolak! Hanya IT Department yang dapat melihat semua pengajuan.');
            document.getElementById('viewMode').value = currentViewMode;
            return;
        }
        
        currentViewMode = newMode;
        currentPagePengajuan = 1;
        printPengajuanSaya();
    }

    // Edit pengajuan function
    function editPengajuan(id) {
        console.log('Editing pengajuan:', id);
        page.view('pengajuan/editPengajuan', '', { id: id });
    }

    // View pengajuan function
    function viewPengajuan(id) {
        console.log('Viewing pengajuan:', id);
        page.view('pengajuan/viewPengajuan', '', { id: id });
    }

    // Create new pengajuan
    function createNewPengajuan() {
        console.log('Creating new pengajuan');
        page.view('pengajuan/create_pengajuan');
    }

    // Initialize page
    function initializePage() {
        console.log('Initializing page...', { 
            userDepartment, 
            userEmpNo, 
            userName 
        });
        
        // Set department info
        const deptText = userDepartment === '1' ? 'IT Department' : `Department: ${userDepartment}`;
        document.getElementById('departmentInfo').textContent = deptText;
        
        if (userDepartment === '1') {
            document.getElementById('departmentInfo').classList.add('department-it');
            // Add option for viewing all pengajuan for IT department
            $('#viewMode').append('<option value="all">Semua Pengajuan (IT Only)</option>');
            
            // Set default view mode untuk IT ke 'all'
            document.getElementById('viewMode').value = 'all';
            currentViewMode = 'all';
            
            console.log('IT Department access granted - default to view all pengajuan');
        }

        // Load initial data
        printPengajuanSaya();
    }

    // Document ready
    $(document).ready(function() {
        console.log('Document ready, initializing...');
        
        // Add small delay to ensure all elements are loaded
        setTimeout(function() {
            initializePage();
        }, 100);
    });
</script>