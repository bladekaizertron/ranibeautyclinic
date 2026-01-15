<div id="calendar-section" class="main-section" style="display: none;">
    <div class="head-title">
        <div class="left">
            <h1>Appointments Calendar</h1>
            <ul class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Calendar</a></li>
            </ul>
        </div>
    </div>

    <!-- Calendar Controls & Filters -->
    <div class="calendar-controls glass-card">
        <div class="cal-nav-group">
            <button class="btn-cal-nav" id="prev-month-btn"><i class='bx bx-chevron-left'></i></button>
            <h2 id="current-month-display">January 2026</h2>
            <button class="btn-cal-nav" id="next-month-btn"><i class='bx bx-chevron-right'></i></button>
            <button class="btn-today" id="today-btn">Today</button>
        </div>
        
        <div class="cal-filter-group">
            <div class="filter-item">
                <i class='bx bx-filter-alt'></i>
                <select id="staff-filter">
                    <option value="all">All Staff</option>
                </select>
            </div>
            <div class="filter-item">
                <i class='bx bx-spa'></i>
                <select id="service-filter">
                    <option value="all">All Services</option>
                </select>
            </div>
            <button class="btn-refresh" id="refresh-cal"><i class='bx bx-refresh'></i></button>
        </div>
    </div>

    <div class="table-data bg-transparent">
        <div class="calendar-container glass-card">
            <div class="calendar-weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="calendar-grid" id="main-calendar-grid">
                <!-- Days will be injected here by JS -->
            </div>
        </div>
        
        <!-- Sidebar for Selected Date (Upcoming) -->
        <div class="calendar-sidebar glass-card">
            <div class="header">
                <h3>Today's Schedule</h3>
                <span id="selected-date-label">Jan 15, 2026</span>
            </div>
            <div class="day-appointments" id="day-appointments-list">
                <div class="empty-state">
                    <i class='bx bx-calendar-event'></i>
                    <p>Select a date to see appointments</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Calendar Specific Styles */
    .calendar-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 30px;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .cal-nav-group {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cal-nav-group h2 {
        font-family: var(--playfair);
        font-size: 24px;
        color: var(--brand-navy);
        min-width: 200px;
        text-align: center;
    }

    .btn-cal-nav {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: rgba(15, 29, 44, 0.05);
        border: 1px solid rgba(15, 29, 44, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--brand-navy);
        font-size: 20px;
    }

    .btn-cal-nav:hover {
        background: var(--brand-navy);
        color: white;
        transform: translateY(-2px);
    }

    .btn-today {
        padding: 8px 20px;
        border-radius: 10px;
        background: var(--brand-gold);
        color: var(--brand-navy);
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-today:hover {
        background: var(--brand-navy);
        color: white;
    }

    .cal-filter-group {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .filter-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background: white;
        padding: 8px 15px;
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .filter-item i {
        color: var(--brand-gold);
    }

    .filter-item select {
        border: none;
        outline: none;
        font-family: var(--montserrat);
        font-size: 14px;
        font-weight: 500;
        color: var(--brand-navy);
        background: transparent;
    }

    .btn-refresh {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--brand-navy);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 20px;
    }

    .calendar-container {
        flex: 1;
        min-width: 0; /* Important for flex overflow */
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        padding: 15px 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        font-weight: 700;
        color: var(--brand-navy);
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
        text-align: center;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1px;
        background: rgba(0,0,0,0.03);
    }

    .cal-day {
        min-height: 120px;
        background: white;
        padding: 10px;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        position: relative;
    }

    .cal-day:hover {
        background: rgba(243, 214, 190, 0.1);
        z-index: 5;
    }

    .cal-day.other-month {
        background: #fdfcfb;
        color: #ccc;
    }

    .cal-day.today {
        background: rgba(243, 214, 190, 0.05);
    }

    .cal-day.today .day-num {
        background: var(--brand-navy);
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .day-num {
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .day-events {
        display: flex;
        flex-direction: column;
        gap: 4px;
        overflow-y: auto;
        max-height: 80px;
    }

    /* Event Dot Styles (Desktop) */
    .cal-event {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        background: var(--brand-navy);
        color: white;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .cal-event:hover {
        transform: scale(1.05);
    }

    .calendar-sidebar {
        width: 320px;
        display: flex;
        flex-direction: column;
        padding: 25px;
    }

    .calendar-sidebar .header {
        margin-bottom: 25px;
    }

    .calendar-sidebar h3 {
        font-family: var(--playfair);
        font-size: 20px;
        color: var(--brand-navy);
        margin-bottom: 5px;
    }

    .calendar-sidebar span {
        font-size: 13px;
        color: var(--dark-grey);
        font-weight: 500;
    }

    .day-appointments {
        flex: 1;
        overflow-y: auto;
    }

    .appt-card {
        padding: 15px;
        background: white;
        border-radius: 15px;
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .appt-card:hover {
        transform: translateX(5px);
        border-color: var(--brand-gold);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .appt-time {
        font-weight: 700;
        color: var(--brand-navy);
        font-size: 14px;
        min-width: 70px;
    }

    .appt-info {
        flex: 1;
    }

    .appt-info .name {
        font-weight: 600;
        font-size: 14px;
        color: var(--brand-navy);
    }

    .appt-info .staff {
        font-size: 12px;
        color: var(--dark-grey);
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 200px;
        color: #ccc;
        text-align: center;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 10px;
    }

    @media (max-width: 1200px) {
        .calendar-sidebar {
            width: 100%;
        }
        .table-data {
            flex-direction: column;
        }
    }
</style>
