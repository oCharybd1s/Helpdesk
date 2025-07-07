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
        // UPDATED DASHBOARD JAVASCRIPT - Replace the existing functions with these fixed versions

        async function loadNotifications() {
            try {
                const notifications = await sendPost("Issue", { type_submit: "getNotif" });
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

                    // FIX 1: Enhanced click handler for dashboard notification boxes
                    notificationItem.addEventListener('click', async () => {
                        try {
                            // Mark this specific notification as read first
                            await markNotificationAsRead(notification.NoIssue, notification.NoCom);
                            
                            // Then open the issue
                            openIssue(notification.NoIssue, notification.NoCom);
                        } catch (error) {
                            console.error("❌ Error handling notification click:", error);
                            // Still open the issue even if marking as read fails
                            openIssue(notification.NoIssue, notification.NoCom);
                        }
                    });
                    
                    container.appendChild(notificationItem);
                });

            } catch (error) {
                console.error("🚨 Gagal memuat notifikasi:", error);
            }
        }

        // FIX 2: Enhanced markAllRead function with proper error handling
        async function markAllRead() {
            try {
                const response = await sendPost("Issue", { type_submit: "markAllNotifRead" });

                if (response.status === 'success') {
                    showToast('All notifications marked as read!');
                    // Refresh notifications to update UI
                    loadNotifications(); 
                } else {
                    showToast('Failed to mark notifications as read: ' + (response.message || 'Unknown error'));
                }
            } catch (error) {
                console.error("🚨 Gagal update notifikasi:", error);
                showToast('Error occurred while marking notifications as read');
            }
        }

        // FIX 3: New function to mark individual notification as read
        async function markNotificationAsRead(noIssue, noCom) {
            try {
                // If we have NoCom, mark by NoCom, otherwise mark by NoIssue
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

        // FIX 4: Enhanced openIssue function
        async function openIssue(noIssue, noCom) {
            try {
                // Mark notification as read before opening
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
                // Still try to navigate even if marking as read fails
                page.view('helpdesk/editIssue_helpdesk', '', { id_Issue: noIssue });
            }
        }

        // FIX 5: Add these new functions for dashboard widgets/boxes
        function addDashboardClickHandlers() {
            // Add click handlers to any dashboard cards/boxes that should mark notifications as read
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
    </script>
</body>
</html>