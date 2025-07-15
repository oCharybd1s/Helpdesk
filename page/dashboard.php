<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Department Helpdesk Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.4));
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            font-size: 1.5rem;
            color: white;
        }

        .stat-content h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.3rem;
        }

        .stat-content p {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #48bb78;
        }

        .btn-success:hover {
            background: #38a169;
        }

        .btn-warning {
            background: #ed8936;
        }

        .btn-warning:hover {
            background: #dd6b20;
        }

        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .ticket-list {
            max-height: 500px;
            overflow-y: auto;
        }

        .ticket-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-left: 4px solid transparent;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .ticket-item:hover {
            background: linear-gradient(135deg, #f8f9ff, #e6edff);
            transform: translateX(5px);
        }

        .ticket-item:last-child {
            border-bottom: none;
        }

        .ticket-info h4 {
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .ticket-meta {
            display: flex;
            gap: 1rem;
            color: #666;
            font-size: 0.9rem;
        }

        .ticket-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .ticket-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.5rem;
        }

        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-open {
            background: linear-gradient(135deg, #fed7d7, #feb2b2);
            color: #c53030;
        }

        .status-progress {
            background: linear-gradient(135deg, #feebc8, #fbd38d);
            color: #dd6b20;
        }

        .status-resolved {
            background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
            color: #276749;
        }

        .priority-high {
            border-left-color: #e53e3e !important;
        }

        .priority-medium {
            border-left-color: #dd6b20 !important;
        }

        .priority-low {
            border-left-color: #38a169 !important;
        }

        .priority-urgent {
            border-left-color: #9f2042 !important;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { border-left-color: #9f2042; }
            50% { border-left-color: #e53e3e; }
            100% { border-left-color: #9f2042; }
        }

        .notification-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #f8f9ff, #e6edff);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .notification-item:hover {
            background: linear-gradient(135deg, #e6edff, #d6e4ff);
            transform: translateX(5px);
        }

        .notification-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 1.1rem;
        }

        .notification-content h5 {
            color: #333;
            margin-bottom: 0.3rem;
            font-size: 1rem;
        }

        .notification-content p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.2rem;
        }

        .notification-time {
            color: #999;
            font-size: 0.8rem;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-item {
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .action-item:hover {
            border-color: #667eea;
            transform: translateY(-3px);
        }

        .action-item i {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .action-item h4 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .action-item p {
            color: #666;
            font-size: 0.9rem;
        }

        .recent-activity {
            max-height: 300px;
            overflow-y: auto;
        }

        .activity-item {
            display: flex;
            align-items: start;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-content h6 {
            color: #333;
            margin-bottom: 0.3rem;
            font-size: 0.95rem;
        }

        .activity-content p {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0.2rem;
        }

        .activity-time {
            color: #999;
            font-size: 0.8rem;
        }

        .toast {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: #48bb78;
            color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            transform: translateX(400px);
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .toast.show {
            transform: translateX(0);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .main-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .ticket-meta {
                flex-direction: column;
                gap: 0.3rem;
            }
            
            .ticket-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Notifications & Alerts -->
        <div class="card">
            <div class="card-body">
                <div class="section-header">
                    <h2 class="section-title">Notifications</h2>
                    <button class="btn btn-success" onclick="markAllRead()">
                        <i class="fas fa-check"></i> Mark All Read
                    </button>
                </div>
                <div id="notification-container">
                    <!-- Notifications will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <div id="working-phase" class="work-phase">
        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin: 10px 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h4 style="margin: 0; color: #495057;">🔧 Sedang Mengerjakan</h4>
                <div id="work-status" style="padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 12px;">
                    ON TIME
                </div>
            </div>
            
            <!-- Grid untuk 3 bagian: Issue No, Waktu Sisa (tengah), Waktu Pause (kanan) -->
            <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 30px; align-items: center; margin-bottom: 15px;">
                <!-- Issue Number (Kiri) -->
                <div style="text-align: left;">
                    <div style="font-size: 14px; color: #6c757d; margin-bottom: 5px;">Issue No:</div>
                    <div id="current-issue-no" style="font-size: 20px; font-weight: bold; color: #007bff;">Belum Ada Issue</div>
                </div>
                
                <!-- Waktu Sisa (Tengah) -->
                <div style="text-align: center;">
                    <div style="font-size: 14px; color: #6c757d; margin-bottom: 5px;">Waktu Sisa:</div>
                    <div id="remaining-time" style="font-size: 32px; font-weight: bold; color: #28a745; font-family: 'Courier New', monospace;">00:00:00</div>
                </div>
                
                <!-- Waktu Pause (Kanan) -->
                <div style="text-align: right;">
                    <div style="font-size: 14px; color: #6c757d; margin-bottom: 5px;">Total Pause:</div>
                    <div id="total-pause-time" style="font-size: 20px; font-weight: bold; color: #ffc107; font-family: 'Courier New', monospace;">00:00</div>
                </div>
            </div>
            
            <div style="display: flex; gap: 30px; align-items: center; margin-bottom: 15px;">
                <div>
                    <strong>Estimasi:</strong> <span id="estimated-time">0</span> menit
                </div>
            </div>
            
            <div style="background: #e9ecef; border-radius: 10px; height: 8px; margin-bottom: 15px;">
                <div id="progress-bar" style="background: #28a745; height: 100%; border-radius: 10px; width: 0%; transition: all 0.5s ease;"></div>
            </div>
            
            <!-- Tombol Pause/Resume -->
            <div style="display: flex; gap: 15px; justify-content: center; margin-bottom: 15px;">
                <button id="pause-btn" onclick="pauseWork()" 
                        style="padding: 10px 20px; border: none; border-radius: 25px; background: linear-gradient(45deg, #ffc107, #fd7e14); color: white; font-weight: bold; cursor: pointer; display: none;">
                    ⏸️ PAUSE
                </button>
                <button id="resume-btn" onclick="resumeWork()" 
                        style="padding: 10px 20px; border: none; border-radius: 25px; background: linear-gradient(45deg, #28a745, #20c997); color: white; font-weight: bold; cursor: pointer; display: none;">
                    ▶️ RESUME
                </button>
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

    <!-- Statistics Overview -->
    <div class="card">
        <div class="card-body">
            <div class="section-header">
                <h2 class="section-title">System Overview</h2>
                <button class="btn" onclick="refreshStats()">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #ff6b6b, #ee5a52);">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 style="color: #ff6b6b;">37</h3>
                        <p>Open Tickets</p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #feca57, #ff6348);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3 style="color: #feca57;">2</h3>
                        <p>In Progress</p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #48cab2, #2dd4bf);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 style="color: #48cab2;">8</h3>
                        <p>Resolved Today</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toast-message">Operation completed successfully!</span>
    </div>

    <script>
        function loadTickets() {
            const ticketList = document.getElementById('ticket-list');
            ticketList.innerHTML = '';

            tickets.forEach(ticket => {
                const ticketItem = document.createElement('div');
                ticketItem.className = `ticket-item priority-${ticket.priority}`;
                ticketItem.innerHTML = `
                    <div class="ticket-info">
                        <h4>${ticket.title}</h4>
                        <div class="ticket-meta">
                            <span><i class="fas fa-hashtag"></i> ${ticket.id}</span>
                            <span><i class="fas fa-user"></i> ${ticket.user}</span>
                            <span><i class="fas fa-building"></i> ${ticket.department}</span>
                            <span><i class="fas fa-clock"></i> ${ticket.created}</span>
                            <span><i class="fas fa-tag"></i> ${ticket.category}</span>
                        </div>
                    </div>
                    <div class="ticket-actions">
                        <span class="status-badge status-${ticket.status}">${ticket.status}</span>
                        <small style="color: #666;">Assigned: ${ticket.assignee}</small>
                    </div>
                `;
                ticketItem.addEventListener('click', () => viewTicketDetails(ticket));
                ticketList.appendChild(ticketItem);
            });
        }

        async function loadNotifications() {
            try {
                const notifications = sendPost("Issue", { type_submit: "getNotif"});
                console.log("📥 Notifikasi Diterima:", notifications);
                const container = document.getElementById('notification-container');
                container.innerHTML = '';

                if (!Array.isArray(notifications)) {
                    console.warn("⚠️ Format notifikasi tidak valid:", notifications);
                    return;
                }

                notifications.forEach(notification => {
                    const waktuDisplay = formatWaktu(notification.Waktu?.date || notification.Waktu);

                    const notificationItem = document.createElement('div');
                    notificationItem.className = 'notification-item';
                    notificationItem.style.cursor = 'pointer';

                    // Set inner content
                    notificationItem.innerHTML = `
                        <div class="notification-icon" style="background: ${notification.color || '#ccc'};">
                            <i class="${notification.icon || 'mdi mdi-bell'}"></i>
                        </div>
                        <div class="notification-content">
                            <h5>${notification.Dari || 'Tanpa Nama'} - ${notification.NoIssue || '-'}</h5>
                            <p>${notification.Isi || 'Tidak ada isi.'}</p>
                            <span class="notification-time">${waktuDisplay}</span>
                        </div>
                    `;

                    notificationItem.addEventListener('click', async () => {
                        try {
                            await markNotificationAsRead(notification.NoIssue, notification.NoCom);
                            
                            openIssue(notification.NoIssue, notification.NoCom);
                        } catch (error) {
                            console.error("❌ Error handling notification click:", error);
                            openIssue(notification.NoIssue, notification.NoCom);
                        }
                    });
                    
                    container.appendChild(notificationItem);
                });

            } catch (error) {
                console.error("🚨 Gagal memuat notifikasi:", error);
            }
        }

        loadNotifications();
        async function markAllRead() {
            try {
                const response = await sendPost("Issue", { type_submit: "markAllNotifRead" });

                if (response.status === 'success') {
                    showToast('All notifications marked as read!');
                    loadNotifications(); 
                } else {
                    showToast('Failed to mark notifications as read: ' + (response.message || 'Unknown error'));
                }
            } catch (error) {
                console.error("🚨 Gagal update notifikasi:", error);
                showToast('Error occurred while marking notifications as read');
            }
        }

        async function markNotificationAsRead(noIssue, noCom) {
            try {
                if (noCom) {
                    await sendPost("Issue", {
                        type_submit: "markNotifReadByNoCom",
                        NoCom: noCom
                    });
                } else if (noIssue) {
                    await sendPost("Issue", {
                        type_submit: "markNotifReadByNoIssue", 
                        NoIssue: noIssue
                    });
                }
                
                console.log("✅ Notification marked as read");
                return true;
            } catch (error) {
                console.error("❌ Failed to mark notification as read:", error);
                return false;
            }
        }

        async function openIssue(noIssue, noCom) {
            try {
                if (noCom) {
                    await sendPost("Issue", {
                        type_submit: "markNotifReadByNoCom",
                        NoCom: noCom
                    });
                }
                
                // Navigate to the issue page
                page.view('helpdesk/editIssue_helpdesk', '', { id_Issue: noIssue });
                
                console.log("✅ Issue opened:", noIssue);
            } catch (error) {
                console.error("❌ Error opening issue:", error);
                page.view('helpdesk/editIssue_helpdesk', '', { id_Issue: noIssue });
            }
        }

        function addDashboardClickHandlers() {
            const dashboardCards = document.querySelectorAll('.card, .dashboard-card, .info-box, .widget');
            
            dashboardCards.forEach(card => {
                if (card.dataset.issueId || card.dataset.notificationId) {
                    card.addEventListener('click', async function() {
                        const issueId = this.dataset.issueId;
                        const notificationId = this.dataset.notificationId;
                        
                        if (issueId) {
                            await markNotificationAsRead(issueId, notificationId);
                        }
                    });
                }
            });
        }

        // Enhanced initialization
        document.addEventListener('DOMContentLoaded', function() {
            loadNotifications();
            addDashboardClickHandlers();
        });

        // Keep existing functions with enhancements
        function refreshActivity() {
            showToast('Activity log refreshed!');
            loadRecentActivity();
        }

        function openTicketManagement() {
            showToast('Opening ticket management system...');
        }

        function openUserManagement() {
            showToast('Opening user management panel...');
        }

        function openSystemSettings() {
            showToast('Opening system settings...');
        }

        function openReports() {
            showToast('Opening reports dashboard...');
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            if (toast && toastMessage) {
                toastMessage.textContent = message;
                toast.classList.add('show');
                
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            } else {
                // Fallback if toast elements don't exist
                alert(message);
            }
        }

        function formatWaktu(waktuString) {
            const date = new Date(waktuString);
            if (isNaN(date)) {
                console.warn("⛔ Waktu tidak valid:", waktuString);
                return waktuString || "-";
            }
            const jam = String(date.getHours()).padStart(2, '0');
            const menit = String(date.getMinutes()).padStart(2, '0');
            const hari = String(date.getDate()).padStart(2, '0');
            const bulan = String(date.getMonth() + 1).padStart(2, '0');
            const tahun = date.getFullYear();
            return `${jam}:${menit} ${hari}/${bulan}/${tahun}`;
        }
        // Modifikasi fungsi checkITProgress yang sudah ada
        function checkITProgress() {
            const ditangani = "<?= $_SESSION[_session_app_id]['emp_no'] ?? '' ?>";
            console.log('👤 emp_no dari PHP session:', ditangani);
            try {
                const result = sendPost("Issue", {
                    type_submit: "checkKerjaan",
                    ditangani: ditangani
                });

                if (result.status === 'success') {
                    if (result.data && result.data.length > 0) {
                        const issueData = result.data[0];
                        // Update display issue number
                        document.getElementById('current-issue-no').textContent = issueData.No;
                        console.log("Issue sedang dikerjakan:", issueData.No);
                        return issueData.No;
                    } else {
                        // Tidak ada issue yang dikerjakan
                        document.getElementById('current-issue-no').textContent = "Belum Ada Issue";
                        console.log("Tidak ada issue aktif");
                        return null;
                    }
                } else {
                    document.getElementById('current-issue-no').textContent = "Belum Ada Issue";
                    console.log("Status tidak success:", result.status);
                    return null;
                }
            } catch (err) {
                console.error("Gagal memeriksa progress:", err);
                document.getElementById('current-issue-no').textContent = "Error";
                return null;
            }
        }
        startWorkTimer();
        // Modifikasi fungsi startWorkTimer yang sudah ada
        function startWorkTimer() {
            console.log('Memulai timer...');
            const idIssue = checkITProgress();

            if (!idIssue) {
                // Sembunyikan working phase jika tidak ada issue
                document.getElementById('working-phase').style.display = 'none';
                return;
            }

            // Tampilkan working phase
            document.getElementById('working-phase').style.display = 'block';

            const timerInfo = sendPost("Issue", { type_submit: "getTimerInfo", id_Issue: idIssue});
            console.log(timerInfo);

            if (!timerInfo || !timerInfo.data) {
                console.error("Timer info tidak diterima dari server");
                return;
            }

            // Parse start time
            let rawTimeStr = '';
            if (typeof timerInfo.data.AcceptWork === 'object' && timerInfo.data.AcceptWork.date) {
                rawTimeStr = timerInfo.data.AcceptWork.date;
            } else if (typeof timerInfo.data.AcceptWork === 'string') {
                rawTimeStr = timerInfo.data.AcceptWork;
            } else {
                console.error("Format AcceptWork tidak valid:", timerInfo.data.AcceptWork);
                return;
            }

            const formattedTime = rawTimeStr.replace(' ', 'T');
            window.startTime = new Date(formattedTime);
            window.estimatedMinutes = parseInt(timerInfo.data.EstIT) || 0;
            window.issueId = idIssue;

            // Load data pause dari MPause
            loadPauseData();

            console.log('Timer dimulai:', {
                startTime: window.startTime,
                estimatedMinutes: window.estimatedMinutes,
                issueId: window.issueId
            });

            if (!window.estimatedMinutes || window.estimatedMinutes <= 0) {
                console.error('Estimasi menit tidak valid:', window.estimatedMinutes);
                return;
            }

            // Update UI
            document.getElementById('estimated-time').textContent = window.estimatedMinutes;
            updatePauseButtons();

            // Start timer
            if (window.workTimer) {
                clearInterval(window.workTimer);
            }
            window.workTimer = setInterval(updateTimer, 1000);
            updateTimer();
        }

        // Fungsi baru untuk load data pause dari MPause
        function loadPauseData() {
            if (!window.issueId) return;
            
            try {
                const pauseData = sendPost("Issue", {
                    type_submit: "getPauseData",
                    No: window.issueId
                });

                if (pauseData && pauseData.status === 'success') {
                    totalPauseMinutes = pauseData.totalPause || 0;
                    isPaused = pauseData.isPaused || false;
                    pauseStartTime = pauseData.currentPauseStart ? new Date(pauseData.currentPauseStart) : null;
                    
                    updatePauseButtons();
                    updateTotalPauseDisplay();
                }
            } catch (error) {
                console.error("Error loading pause data:", error);
            }
        }

        function updateTimer() {
            if (!window.startTime || !window.estimatedMinutes) {
                return;
            }

            const now = new Date();
            
            // Hitung elapsed time dalam detik (bukan menit)
            const elapsedTotalSeconds = Math.floor((now.getTime() - window.startTime.getTime()) / 1000);
            const elapsedTotalMinutes = Math.floor(elapsedTotalSeconds / 60);
            
            // Hitung current pause time jika sedang pause
            let currentPauseSeconds = 0;
            if (isPaused && pauseStartTime) {
                currentPauseSeconds = Math.floor((now.getTime() - pauseStartTime.getTime()) / 1000);
            }
            
            // Total pause dalam detik
            const totalPauseSeconds = (totalPauseMinutes || 0) * 60 + currentPauseSeconds;
            
            // Net working time dalam detik
            const netWorkingSeconds = elapsedTotalSeconds - totalPauseSeconds;
            const netWorkingMinutes = Math.floor(netWorkingSeconds / 60);
            
            // Remaining time dalam detik
            const estimatedSeconds = window.estimatedMinutes * 60;
            const remainingSeconds = estimatedSeconds - netWorkingSeconds;

            // Update WAKTU SISA (format: HH:MM:SS)
            updateRemainingTimeDisplay(remainingSeconds);
            
            // Update WAKTU PAUSE (format: MM:SS)
            updateTotalPauseDisplay(totalPauseSeconds);
            
            // Update progress bar dan status
            updateProgressBar(netWorkingMinutes);
            updateWorkStatus(netWorkingMinutes, remainingSeconds / 60);
        }

        function updateRemainingTimeDisplay(remainingSeconds) {
            const isOvertime = remainingSeconds < 0;
            const absSeconds = Math.abs(remainingSeconds);
            
            const hours = Math.floor(absSeconds / 3600);
            const minutes = Math.floor((absSeconds % 3600) / 60);
            const seconds = absSeconds % 60;
            
            const timeString = `${isOvertime ? '-' : ''}${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            const remainingElement = document.getElementById('remaining-time');
            if (remainingElement) {
                remainingElement.textContent = timeString;
                remainingElement.style.color = isOvertime ? '#dc3545' : '#28a745';
            }
        }

        function updateTotalPauseDisplay(totalPauseSeconds) {
            const minutes = Math.floor(totalPauseSeconds / 60);
            const seconds = totalPauseSeconds % 60;
            
            const timeString = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            const pauseElement = document.getElementById('total-pause-time');
            if (pauseElement) {
                pauseElement.textContent = timeString;
            }
        }

        function updateProgressBar(netWorkingMinutes) {
            const progressPercent = Math.min(100, Math.max(0, (netWorkingMinutes / window.estimatedMinutes) * 100));
            
            const progressBar = document.getElementById('progress-bar');
            if (progressBar) {
                progressBar.style.width = progressPercent + '%';
            }
        }

        function updateWorkStatus(netWorkingMinutes, remainingMinutes) {
            const statusElement = document.getElementById('work-status');
            const progressBar = document.getElementById('progress-bar');
            
            if (!statusElement || !progressBar) return;
            
            if (isPaused) {
                statusElement.textContent = 'PAUSE';
                statusElement.style.backgroundColor = '#6c757d';
                statusElement.style.color = 'white';
                progressBar.style.backgroundColor = '#6c757d';
            } else if (remainingMinutes > window.estimatedMinutes * 0.2) {
                statusElement.textContent = 'ON TIME';
                statusElement.style.backgroundColor = '#28a745';
                statusElement.style.color = 'white';
                progressBar.style.backgroundColor = '#28a745';
            } else if (remainingMinutes > 0) {
                statusElement.textContent = 'WARNING';
                statusElement.style.backgroundColor = '#ffc107';
                statusElement.style.color = 'black';
                progressBar.style.backgroundColor = '#ffc107';
            } else {
                statusElement.textContent = 'OVER TIME';
                statusElement.style.backgroundColor = '#dc3545';
                statusElement.style.color = 'white';
                progressBar.style.backgroundColor = '#dc3545';
            }
        }
        // Fungsi untuk update tombol pause/resume
        function updatePauseButtons() {
            const pauseBtn = document.getElementById('pause-btn');
            const resumeBtn = document.getElementById('resume-btn');
            
            if (pauseBtn && resumeBtn) {
                if (isPaused) {
                    pauseBtn.style.display = 'none';
                    resumeBtn.style.display = 'inline-block';
                } else {
                    pauseBtn.style.display = 'inline-block';
                    resumeBtn.style.display = 'none';
                }
            }
        }

        // Fungsi baru untuk pause work
        function pauseWork() {
            if (!window.issueId || isPaused) return;
            
            const reason = prompt('Alasan pause (opsional):') || '';
            
            try {
                const response = sendPost("Issue", {
                    type_submit: "pauseWork",
                    No: window.issueId,
                    reason: reason
                });
                
                if (response && response.status === 'success') {
                    isPaused = true;
                    pauseStartTime = new Date();
                    updatePauseButtons();
                    showToast('⏸️ Pekerjaan di-pause');
                } else {
                    alert('Gagal pause: ' + (response?.message || 'Unknown error'));
                }
            } catch (error) {
                console.error("Error pausing work:", error);
                alert('Error saat pause pekerjaan');
            }
        }

        // Fungsi baru untuk resume work
        function resumeWork() {
            if (!window.issueId || !isPaused) return;
            
            try {
                const response = sendPost("Issue", {
                    type_submit: "resumeWork",
                    No: window.issueId
                });
                
                if (response && response.status === 'success') {
                    // Update total pause minutes
                    if (pauseStartTime) {
                        const pauseDuration = Math.floor((new Date().getTime() - pauseStartTime.getTime()) / 60000);
                        totalPauseMinutes += pauseDuration;
                    }
                    
                    isPaused = false;
                    pauseStartTime = null;
                    updatePauseButtons();
                    showToast('▶️ Pekerjaan dilanjutkan');
                } else {
                    alert('Gagal resume: ' + (response?.message || 'Unknown error'));
                }
            } catch (error) {
                console.error("Error resuming work:", error);
                alert('Error saat resume pekerjaan');
            }
        }

        // Inisialisasi saat page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(startWorkTimer, 1000);
        });

        // Auto refresh setiap 30 detik untuk sinkronisasi data pause
        setInterval(() => {
            if (window.issueId) {
                loadPauseData();
            }
        }, 30000);

        function selesaikanIssue() {
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
            
            // Using traditional callback approach instead of .then()
            const response = sendPost("Issue", {
                type_submit: "selesaikanIssue",
                No: window.issueId,
                solusi: solusi,
                catatan: catatan
            });
            
            console.log('Response from selesaikanIssue:', response);

            if (response && response.status === 'success') {
                alert('✅ Pekerjaan berhasil diselesaikan!');
                
                // Stop timer
                if (window.workTimer) {
                    clearInterval(window.workTimer);
                    window.workTimer = null;
                    console.log('Work timer stopped');
                }
                
                // Update issue data
                if (window.issueWorkflowData) {
                    window.issueWorkflowData.TanggalSelesai = response.data.TanggalSelesai;
                    window.issueWorkflowData.Solusi = response.data.Solusi;
                    window.issueWorkflowData.CatatanIT = response.data.CatatanIT;
                    window.issueWorkflowData.AktualMenit = response.data.AktualMenit;
                }
                
                console.log('Successfully completed issue and switched to completion phase');
                startWorkTimer();
                
            } else {
                alert('❌ Gagal menyelesaikan pekerjaan: ' + (response ? response.message : 'Unknown error'));
            }
        }

    </script>
</body>
</html>