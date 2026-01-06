<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	
    <!-- Fixed: user had this as a stylesheet link -->
    <script src='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js'></script>

	<title>MedSpa CRM</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        :root {
            --poppins: 'Poppins', sans-serif;
            --lato: 'Lato', sans-serif;

            --light: #F9F9F9;
            --blue: #3C91E6;
            --light-blue: #CFE8FF;
            --grey: #eee;
            --dark-grey: #AAAAAA;
            --dark: #342E37;
            --red: #DB504A;
            --yellow: #FFCE26;
            --light-yellow: #FFF2C6;
            --orange: #FD7238;
            --light-orange: #FFE0D3;
        }

        html {
            overflow-x: hidden;
        }

        body.dark {
            --light: #0C0C1E;
            --grey: #060714;
            --dark: #FBFBFB;
        }

        body {
            background: var(--grey);
            overflow-x: hidden;
        }





        /* SIDEBAR */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100%;
            background: var(--light);
            z-index: 2000;
            font-family: var(--lato);
            transition: .3s ease;
            overflow-x: hidden;
            scrollbar-width: none;
        }
        #sidebar::--webkit-scrollbar {
            display: none;
        }
        #sidebar.hide {
            width: 60px;
        }
        #sidebar .brand {
            font-size: 24px;
            font-weight: 700;
            height: 56px;
            display: flex;
            align-items: center;
            color: var(--blue);
            position: sticky;
            top: 0;
            left: 0;
            background: var(--light);
            z-index: 500;
            padding-bottom: 20px;
            box-sizing: content-box;
        }
        #sidebar .brand .bx {
            min-width: 60px;
            display: flex;
            justify-content: center;
        }
        #sidebar .side-menu {
            width: 100%;
            margin-top: 48px;
        }
        #sidebar .side-menu li {
            height: 48px;
            background: transparent;
            margin-left: 6px;
            border-radius: 48px 0 0 48px;
            padding: 4px;
        }
        #sidebar .side-menu li.active {
            background: var(--grey);
            position: relative;
        }
        #sidebar .side-menu li.active::before {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            top: -40px;
            right: 0;
            box-shadow: 20px 20px 0 var(--grey);
            z-index: -1;
        }
        #sidebar .side-menu li.active::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            bottom: -40px;
            right: 0;
            box-shadow: 20px -20px 0 var(--grey);
            z-index: -1;
        }
        #sidebar .side-menu li a {
            width: 100%;
            height: 100%;
            background: var(--light);
            display: flex;
            align-items: center;
            border-radius: 48px;
            font-size: 16px;
            color: var(--dark);
            white-space: nowrap;
            overflow-x: hidden;
        }
        #sidebar .side-menu.top li.active a {
            color: var(--blue);
        }
        #sidebar.hide .side-menu li a {
            width: calc(48px - (4px * 2));
            transition: width .3s ease;
        }
        #sidebar .side-menu li a.logout {
            color: var(--red);
        }
        #sidebar .side-menu.top li a:hover {
            color: var(--blue);
        }
        #sidebar .side-menu li a .bx {
            min-width: calc(60px  - ((4px + 6px) * 2));
            display: flex;
            justify-content: center;
        }

        #sidebar .side-menu.bottom li:nth-last-of-type(-n+2) { /* Son iki <li>'yi seç */
        position: absolute; /* Ebeveynine göre konumlandır */
        bottom: 0; /* En alt */
        left: 0;
        right: 0;
        text-align: center;
        }

        /* Birbirinin üzerine binmesini engellemek için */
        #sidebar .side-menu.bottom li:nth-last-of-type(2) {
        bottom: 40px; /* İkinci son öğeyi yukarı kaydır */
        }
        /* SIDEBAR */





        /* CONTENT */
        #content {
            position: relative;
            width: calc(100% - 220px);
            left: 220px;
            transition: .3s ease;
        }
        #sidebar.hide ~ #content {
            width: calc(100% - 60px);
            left: 60px;
        }




        /* NAVBAR */
        #content nav {
            height: 56px;
            background: var(--light);
            padding: 0 24px;
            display: flex;
            align-items: center;
            grid-gap: 24px;
            font-family: var(--lato);
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        #content nav::before {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            bottom: -40px;
            left: 0;
            border-radius: 50%;
            box-shadow: -20px -20px 0 var(--light);
        }
        #content nav a {
            color: var(--dark);
        }
        #content nav .bx.bx-menu {
            cursor: pointer;
            color: var(--dark);
        }
        #content nav .nav-link {
            font-size: 16px;
            transition: .3s ease;
        }
        #content nav .nav-link:hover {
            color: var(--blue);
        }
        #content nav form {
            max-width: 400px;
            width: 100%;
            margin-right: auto;
        }
        #content nav form .form-input {
            display: flex;
            align-items: center;
            height: 36px;
        }
        #content nav form .form-input input {
            flex-grow: 1;
            padding: 0 16px;
            height: 100%;
            border: none;
            background: var(--grey);
            border-radius: 36px 0 0 36px;
            outline: none;
            width: 100%;
            color: var(--dark);
        }
        #content nav form .form-input button {
            width: 36px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--blue);
            color: var(--light);
            font-size: 18px;
            border: none;
            outline: none;
            border-radius: 0 36px 36px 0;
            cursor: pointer;
        }
        #content nav .notification {
            font-size: 20px;
            position: relative;
        }
        #content nav .notification .num {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--light);
            background: var(--red);
            color: var(--light);
            font-weight: 700;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Notification Dropdown */
        #content nav .notification-menu {
            display: none;
            position: absolute;
            top: 56px;
            right: 0;
            background: var(--light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            width: 250px;
            max-height: 300px;
            overflow-y: auto;
            z-index: 9999;
            font-family: var(--lato);
        }

        #content nav .notification-menu ul {
            list-style: none;
            padding: 10px;
            margin: 0;
        }

        #content nav .notification-menu li {
            padding: 10px;
            border-bottom: 1px solid var(--grey);
            color: var(--dark);
        }

        #content nav .notification-menu li:hover {
            background-color: var(--light-blue);
            color: var(--dark);
        }
        #content nav .notification-menu li:hover a{
            background-color: var(--dark-grey);
            color: var(--light);
        }
        body.dark #content nav .notification-menu li:hover {
            background-color: var(--light-blue);
            color: var(--light);
        }
        body.dark #content nav .notification-menu li a{
            background-color: var(--dark-grey);
            color: var(--light);
        }
        #content nav .profile img {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 50%;
        }
        #content nav .profile-menu {
            display: none;
            position: absolute;
            top: 56px;
            right: 0;
            background: var(--light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            width: 200px;
            z-index: 9999;
            font-family: var(--lato);
        }

        #content nav .profile-menu ul {
            list-style: none;
            padding: 10px;
            margin: 0;
        }

        #content nav .profile-menu li {
            padding: 10px;
            border-bottom: 1px solid var(--grey);
        }

        #content nav .profile-menu li:hover {
            background-color: var(--light-blue);
            color: var(--dark);
        }
        #content nav .profile-menu li a {
            color: var(--dark);
            font-size: 16px;
        }
        body.dark #content nav .profile-menu li:hover a {
            color: var(--light);
        }
        body.dark #content nav .profile-menu li a {
            color: var(--dark);
        }
        #content nav .profile-menu li:hover a {
            color: var(--dark);
        }
        /* Active State for Menus */
        #content nav .notification-menu.show,
        #content nav .profile-menu.show {
            display: block;
        }

        #content nav .switch-mode {
            display: block;
            min-width: 50px;
            height: 25px;
            border-radius: 25px;
            background: var(--grey);
            cursor: pointer;
            position: relative;
        }
        #content nav .switch-mode::before {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            bottom: 2px;
            width: calc(25px - 4px);
            background: var(--blue);
            border-radius: 50%;
            transition: all .3s ease;
        }
        #content nav #switch-mode:checked + .switch-mode::before {
            left: calc(100% - (25px - 4px) - 2px);
        }


        #content nav .swith-lm {
            background-color:  var(--grey);
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 3px;
            position: relative;
            height: 21px;
            width: 45px;
            transform: scale(1.5);
        }

        #content nav .swith-lm .ball {
            background-color: var(--blue);
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            height: 20px;
            width: 20px;
            transform: translateX(0px);
            transition: transform 0.2s linear;
        }

        #content nav .checkbox:checked + .swith-lm .ball {
            transform: translateX(22px);
        }
        .bxs-moon {
            color: var(--yellow);
        }

        .bx-sun {
            color: var(--orange);
            animation: shakeOn .7s;
        }



        /* NAVBAR */





        /* MAIN */
        #content main {
            width: 100%;
            padding: 36px 24px;
            font-family: var(--poppins);
            max-height: calc(100vh - 56px);
            overflow-y: auto;
        }
        #content main .head-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            grid-gap: 16px;
            flex-wrap: wrap;
        }
        #content main .head-title .left h1 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }
        #content main .head-title .left .breadcrumb {
            display: flex;
            align-items: center;
            grid-gap: 16px;
        }
        #content main .head-title .left .breadcrumb li {
            color: var(--dark);
        }
        #content main .head-title .left .breadcrumb li a {
            color: var(--dark-grey);
            pointer-events: none;
        }
        #content main .head-title .left .breadcrumb li a.active {
            color: var(--blue);
            pointer-events: unset;
        }
        #content main .head-title .btn-download {
            height: 36px;
            padding: 0 16px;
            border-radius: 36px;
            background: var(--blue);
            color: var(--light);
            display: flex;
            justify-content: center;
            align-items: center;
            grid-gap: 10px;
            font-weight: 500;
        }




        #content main .box-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            grid-gap: 24px;
            margin-top: 36px;
        }
        #content main .box-info li {
            padding: 24px;
            background: var(--light);
            border-radius: 20px;
            display: flex;
            align-items: center;
            grid-gap: 24px;
        }
        #content main .box-info li .bx {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            font-size: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #content main .box-info li:nth-child(1) .bx {
            background: var(--light-blue);
            color: var(--blue);
        }
        #content main .box-info li:nth-child(2) .bx {
            background: var(--light-yellow);
            color: var(--yellow);
        }
        #content main .box-info li:nth-child(3) .bx {
            background: var(--light-orange);
            color: var(--orange);
        }
        #content main .box-info li .text h3 {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark);
        }
        #content main .box-info li .text p {
            color: var(--dark);	
        }





        #content main .table-data {
            display: flex;
            flex-wrap: wrap;
            grid-gap: 24px;
            margin-top: 24px;
            width: 100%;
            color: var(--dark);
        }
        #content main .table-data > div {
            border-radius: 20px;
            background: var(--light);
            padding: 24px;
            overflow-x: auto;
        }
        #content main .table-data .head {
            display: flex;
            align-items: center;
            grid-gap: 16px;
            margin-bottom: 24px;
        }
        #content main .table-data .head h3 {
            margin-right: auto;
            font-size: 24px;
            font-weight: 600;
        }
        #content main .table-data .head .bx {
            cursor: pointer;
        }

        #content main .table-data .order {
            flex-grow: 1;
            flex-basis: 500px;
        }
        #content main .table-data .order table {
            width: 100%;
            border-collapse: collapse;
        }
        #content main .table-data .order table th {
            padding-bottom: 12px;
            font-size: 13px;
            text-align: left;
            border-bottom: 1px solid var(--grey);
        }
        #content main .table-data .order table td {
            padding: 16px 0;
        }
        #content main .table-data .order table tr td:first-child {
            display: flex;
            align-items: center;
            grid-gap: 12px;
            padding-left: 6px;
        }
        #content main .table-data .order table td img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }
        #content main .table-data .order table tbody tr:hover {
            background: var(--grey);
        }
        #content main .table-data .order table tr td .status {
            font-size: 10px;
            padding: 6px 16px;
            color: var(--light);
            border-radius: 20px;
            font-weight: 700;
        }
        #content main .table-data .order table tr td .status.completed {
            background: var(--blue);
        }
        #content main .table-data .order table tr td .status.process {
            background: var(--yellow);
        }
        #content main .table-data .order table tr td .status.pending {
            background: var(--orange);
        }


        #content main .table-data .todo {
            flex-grow: 0.3;
            flex-basis: 300px;
            min-width: 360px;
            overflow: hidden;
        }
        #content main .table-data .todo .todo-list {
            width: 100%;
        }
        #content main .table-data .todo .todo-list li {
            width: 100%;
            margin-bottom: 16px;
            background: var(--grey);
            border-radius: 10px;
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #content main .table-data .todo .todo-list li .bx {
            cursor: pointer;
        }
        #content main .table-data .todo .todo-list li.completed {
            border-left: 10px solid var(--blue);
        }
        #content main .table-data .todo .todo-list li.not-completed {
            border-left: 10px solid var(--orange);
        }
        #content main .table-data .todo .todo-list li:last-child {
            margin-bottom: 0;
        }
        /* MAIN */
        /* CONTENT */
        #content main .menu, #content nav .menu {

            display: none;
            list-style-type: none;
            padding-left: 20px;
            margin-top: 5px;
            position: absolute;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
        }

        #content main .menu a , #content nav .menu a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 8px 16px;
        }

        #content main .menu a:hover , #content nav .menu a:hover {
            background-color: #444;
        }
                
        #content main .menu-link , #content nav .menu-link {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            color: #007bff;
        }

        #content main .menu-link:hover, #content nav .menu-link:hover {
            text-decoration: underline;
        }





        /* Media Query for Smaller Screens */
        @media screen and (max-width: 768px) {
            #sidebar {
                width: 200px;
            }

            #content {
                width: calc(100% - 200px);
                left: 200px;
            }

            #content nav .nav-link {
                display: none;
            }
        }

        @media screen and (max-width: 576px) {
            #sidebar {
                width: 60px;
            }
            #content {
                width: calc(100% - 60px);
                left: 60px;
            }
            #content nav .nav-link {
                display: none;
            }
            #content nav form .form-input input {
                display: none;
            }

            #content nav form .form-input button {
                width: auto;
                height: auto;
                background: transparent;
                border-radius: none;
                color: var(--dark);
            }

            #content nav form.show .form-input input {
                display: block;
                width: 100%;
            }
            #content nav form.show .form-input button {
                width: 36px;
                height: 100%;
                border-radius: 0 36px 36px 0;
                color: var(--light);
                background: var(--red);
            }

            #content nav form.show ~ .notification,
            #content nav form.show ~ .profile {
                display: none;
            }

            #content main .box-info {
                grid-template-columns: 1fr;
            }

            #content main .table-data .head {
                min-width: unset;
            }
            #content main .table-data .order table {
                min-width: 420px;
            }
            
            /* Calendar Widget Responsive Adjustments */
            .calendar-week-day div,
            .calendar-days div {
                font-size: 14px;
                height: 30px;
                width: 30px;
            }
            .calendar-header {
                font-size: 16px;
            }
        }
        /* Calendar Widget Styles */
        .calendar-widget {
            width: 100%;
            height: 100%;
            background-color: var(--light);
            border-radius: 20px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 20px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 20px;
        }

        .month-picker {
            cursor: pointer;
        }

        .year-picker {
            display: flex;
            align-items: center;
        }

        .year-change {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin: 0 10px;
            cursor: pointer;
        }

        .year-change:hover {
            background-color: var(--light-blue);
        }

        .calendar-body {
            padding: 10px;
        }

        .calendar-week-day {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            font-weight: 600;
            height: 50px;
        }

        .calendar-week-day div {
            display: grid;
            place-items: center;
            color: var(--dark-grey);
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            color: var(--dark);
        }

        .calendar-days div {
            width: 37px;
            height: 37px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            position: relative;
            cursor: pointer;
            border-radius: 50%;
        }

        .calendar-days div:hover {
            transition: width 0.2s ease-in-out, height 0.2s ease-in-out;
            background-color: var(--light-blue);
        }

        .calendar-days div.curr-date {
            background-color: var(--blue);
            color: var(--light);
            border-radius: 50%;
        }
    </style>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<div style="min-width: 60px; display: flex; justify-content: center; align-items: center;">
				<img src="../assets/coderebuiltlogo.png" style="width: 40px; height: auto;" alt="CodeRebuilt Logo">
			</div>
			<span class="text">MedSpa-CRM</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#" data-section="frontdesk">
					<i class='bx bxs-dashboard bx-sm' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-calendar-check bx-sm' ></i>
					<span class="text">Calendar</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots bx-sm' ></i>
					<span class="text">Messages</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-dollar-circle bx-sm' ></i>
					<span class="text">Sales</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-user-detail bx-sm' ></i>
					<span class="text">Clients</span>
				</a>
			</li>
            <li>
				<a href="#">
					<i class='bx bxs-report bx-sm' ></i>
					<span class="text">Reports</span>
				</a>
			</li>
            <li>
				<a href="#">
					<i class='bx bxs-megaphone bx-sm' ></i>
					<span class="text">Marketing</span>
				</a>
			</li>
            <li>
				<a href="#" data-section="manage" id="manageMenuToggle">
					<i class='bx bxs-briefcase-alt-2 bx-sm' ></i>
					<span class="text">Manage</span>
				</a>
                <ul id="manage-submenu" style="display: none; padding-left: 40px; list-style: none; margin-top: 5px;">
                    <li><a href="#" data-subsection="schedule">Schedule</a></li>
                    <li><a href="#" data-subsection="services">Services</a></li>
                    <li><a href="#" data-subsection="staff">Staff</a></li>
                </ul>
			</li>
		</ul>
		<ul class="side-menu bottom">
			<li>
				<a href="#">
					<i class='bx bxs-cog bx-sm bx-spin-hover' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bx-power-off bx-sm bx-burst-hover' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
<nav>
    <i class='bx bx-menu bx-sm' ></i>
    <form action="#">
        <div class="form-input">
            <input type="search" placeholder="Search Clients...">
            <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
        </div>
    </form>
    <input type="checkbox" class="checkbox" id="switch-mode" hidden />
    <label class="swith-lm" for="switch-mode">
        <i class="bx bxs-moon"></i>
        <i class="bx bx-sun"></i>
        <div class="ball"></div>
    </label>

    <!-- Notification Bell -->
    <a href="#" class="notification" id="notificationIcon">
        <i class='bx bxs-bell bx-tada-hover' ></i>
        <span class="num">8</span>
    </a>
    <div class="notification-menu" id="notificationMenu">
        <ul>
            <li>New message from John</li>
            <li>Your order has been shipped</li>
            <li>New comment on your post</li>
            <li>Update available for your app</li>
            <li>Reminder: Meeting at 3PM</li>
        </ul>
    </div>

    <!-- Profile Menu -->
    <a href="#" class="profile" id="profileIcon">
        <i class='bx bxs-user-circle' style="font-size: 40px;"></i>
    </a>
    <div class="profile-menu" id="profileMenu">
        <ul>
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Log Out</a></li>
        </ul>
    </div>
</nav>
<!-- NAVBAR -->


		<!-- MAIN -->
		<main>
        <div id="frontdesk-section">
			<div class="head-title">
				<div class="left">
					<h1>Insights</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Stats</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar' ></i>
					<span class="text">
						<h3>Unconfirmed</h3>
					</span>
				</li>
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>Confirmed</h3>
					</span>
				</li>
				<li>
					<i class='bx bxs-user-check' ></i>
					<span class="text">
						<h3>Arrived</h3>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Staffs</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Staff Name</th>
								<th>Role</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<i class='bx bxs-user-circle' style='font-size: 36px; color: var(--dark-grey);'></i>
									<p>Micheal John</p>
								</td>
								<td>Esthetician</td>
								<td><span class="status completed">Available</span></td>
							</tr>
							<tr>
								<td>
									<i class='bx bxs-user-circle' style='font-size: 36px; color: var(--dark-grey);'></i>
									<p>Ryan Doe</p>
								</td>
								<td>Receptionist</td>
								<td><span class="status pending">On Leave</span></td>
							</tr>
							<tr>
								<td>
									<i class='bx bxs-user-circle' style='font-size: 36px; color: var(--dark-grey);'></i>
									<p>Tarry White</p>
								</td>
								<td>Therapist</td>
								<td><span class="status process">Busy</span></td>
							</tr>
							<tr>
								<td>
									<i class='bx bxs-user-circle' style='font-size: 36px; color: var(--dark-grey);'></i>
									<p>Selma</p>
								</td>
								<td>Manager</td>
								<td><span class="status completed">Available</span></td>
							</tr>
							<tr>
								<td>
									<i class='bx bxs-user-circle' style='font-size: 36px; color: var(--dark-grey);'></i>
									<p>Andreas Doe</p>
								</td>
								<td>Dermatologist</td>
								<td><span class="status process">Busy</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
                    <div class="head">
						<h3>Calendar</h3>
						<i class='bx bx-filter' ></i>
					</div>
                    <div class="calendar-widget">
                        <div class="calendar-header">
                            <span class="month-picker" id="month-picker"></span>
                            <div class="year-picker">
                                <span class="year-change" id="prev-month">
                                    <i class='bx bx-chevron-left'></i>
                                </span>
                                <span class="year-change" id="next-month">
                                    <i class='bx bx-chevron-right'></i>
                                </span>
                            </div>
                        </div>
                        <div class="calendar-body">
                            <div class="calendar-week-day">
                                <div>Sun</div>
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                            </div>
                            <div class="calendar-days" id="calendar-days"></div>
                        </div>
                    </div>
				</div>
			</div>
        </div>

        <!-- Manage Section (hidden by default) -->
        <div id="manage-section" style="display: none;">
            <div class="head-title">
                <div class="left">
                    <h1>Manage</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Manage</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-data">
                <!-- Schedule subsection (default) -->
                <div class="order manage-subsection" id="manage-schedule">
                    <div class="head">
                        <h3>Schedule</h3>
                    </div>
                    <p>Configure and view your clinic schedule here.</p>
                </div>

                <!-- Services subsection -->
                <div class="order manage-subsection" id="manage-services" style="display: none;">
                    <div class="head">
                        <h3>Services</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Services</th>
                                <th>$</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><th colspan="2">Face Fixes</th></tr>
                            <tr data-service="Botox / Botox Facial" data-price="14" data-category="Face Fixes"><td>Botox / Botox Facial</td><td>14</td></tr>
                            <tr data-service="Sculptra" data-price="950" data-category="Face Fixes"><td>Sculptra</td><td>950</td></tr>
                            <tr data-service="Lip Filler" data-price="650" data-category="Face Fixes"><td>Lip Filler</td><td>650</td></tr>
                            <tr data-service="Eye Filler" data-price="750" data-category="Face Fixes"><td>Eye Filler</td><td>750</td></tr>
                            <tr data-service="Cheek Filler" data-price="850" data-category="Face Fixes"><td>Cheek Filler</td><td>850</td></tr>
                            <tr data-service="Nose Filler" data-price="795" data-category="Face Fixes"><td>Nose Filler</td><td>795</td></tr>
                            <tr data-service="Jawline Filler" data-price="795" data-category="Face Fixes"><td>Jawline Filler</td><td>795</td></tr>
                            <tr data-service="Neck Filler" data-price="795" data-category="Face Fixes"><td>Neck Filler</td><td>795</td></tr>

                            <tr><th colspan="2">Body Fixes</th></tr>
                            <tr data-service="Radiesse" data-price="950" data-category="Body Fixes"><td>Radiesse</td><td>950</td></tr>
                            <tr data-service="Sculptra Skinny BBL" data-price="895" data-category="Body Fixes"><td>Sculptra Skinny BBL</td><td>895</td></tr>
                            <tr data-service="Traptox" data-price="895" data-category="Body Fixes"><td>Traptox</td><td>895</td></tr>
                            <tr data-service="Cutera Secret" data-price="895" data-category="Body Fixes"><td>Cutera Secret</td><td>895</td></tr>
                            <tr data-service="Sofwave (Body)" data-price="495" data-category="Body Fixes"><td>Sofwave</td><td>495</td></tr>

                            <tr><th colspan="2">Skin Fixes</th></tr>
                            <tr data-service="Laser Facials" data-price="495" data-category="Skin Fixes"><td>Laser Facials</td><td>495</td></tr>
                            <tr data-service="Hydrafacial" data-price="250" data-category="Skin Fixes"><td>Hydrafacial</td><td>250</td></tr>
                            <tr data-service="VI Peel" data-price="399" data-category="Skin Fixes"><td>VI Peel</td><td>399</td></tr>
                            <tr data-service="Cosmelan" data-price="995" data-category="Skin Fixes"><td>Cosmelan</td><td>995</td></tr>
                            <tr data-service="Sofwave (Skin)" data-price="495" data-category="Skin Fixes"><td>Sofwave</td><td>495</td></tr>

                            <tr><th colspan="2">Laser Hair Removal</th></tr>
                            <tr data-service="Laser Acne Facial" data-price="495" data-category="Laser Hair Removal"><td>Laser Acne Facial</td><td>495</td></tr>
                            <tr data-service="Laser Roscea Facial" data-price="495" data-category="Laser Hair Removal"><td>Laser Roscea Facial</td><td>495</td></tr>
                            <tr data-service="Laser Resurfacing Facial" data-price="795" data-category="Laser Hair Removal"><td>Laser Resurfacing Facial</td><td>795</td></tr>
                            <tr data-service="Upper Lip Laser Hair Removal" data-price="29" data-category="Laser Hair Removal"><td>Upper Lip Laser Hair Removal</td><td>29</td></tr>
                            <tr data-service="Eyebrows" data-price="99" data-category="Laser Hair Removal"><td>Eyebrows</td><td>99</td></tr>
                            <tr data-service="Sideburns" data-price="99" data-category="Laser Hair Removal"><td>Sideburns</td><td>99</td></tr>
                            <tr data-service="Full Back" data-price="400" data-category="Laser Hair Removal"><td>Full Back</td><td>400</td></tr>
                            <tr data-service="Pantyline" data-price="150" data-category="Laser Hair Removal"><td>Pantyline</td><td>150</td></tr>
                            <tr data-service="Neck" data-price="299" data-category="Laser Hair Removal"><td>Neck</td><td>299</td></tr>
                            <tr data-service="Full Face Laser Hair Removal" data-price="299" data-category="Laser Hair Removal"><td>Full Face Laser Hair Removal</td><td>299</td></tr>
                            <tr data-service="Hands and fingers" data-price="99" data-category="Laser Hair Removal"><td>Hands and fingers</td><td>99</td></tr>
                            <tr data-service="Full Chest" data-price="250" data-category="Laser Hair Removal"><td>Full Chest</td><td>250</td></tr>
                            <tr data-service="Happy Trail" data-price="99" data-category="Laser Hair Removal"><td>Happy Trail</td><td>99</td></tr>
                            <tr data-service="Areolas" data-price="99" data-category="Laser Hair Removal"><td>Areolas</td><td>99</td></tr>
                            <tr data-service="Forehead" data-price="99" data-category="Laser Hair Removal"><td>Forehead</td><td>99</td></tr>
                            <tr data-service="Jawline" data-price="99" data-category="Laser Hair Removal"><td>Jawline</td><td>99</td></tr>
                            <tr data-service="Underarms" data-price="175" data-category="Laser Hair Removal"><td>Underarms</td><td>175</td></tr>
                            <tr data-service="Limited Time $99 Upper Lip" data-price="99" data-category="Laser Hair Removal"><td>Limited Time $99 Upper Lip</td><td>99</td></tr>
                            <tr data-service="Feet &amp; Toes" data-price="99" data-category="Laser Hair Removal"><td>Feet &amp; Toes</td><td>99</td></tr>
                            <tr data-service="Full Brazilian" data-price="250" data-category="Laser Hair Removal"><td>Full Brazilian</td><td>250</td></tr>
                            <tr data-service="Ears" data-price="99" data-category="Laser Hair Removal"><td>Ears</td><td>99</td></tr>
                            <tr data-service="Full Body Laser Hair Removal" data-price="1299" data-category="Laser Hair Removal"><td>Full Body Laser Hair Removal</td><td>1299</td></tr>
                            <tr data-service="Pony Tail Laser" data-price="125" data-category="Laser Hair Removal"><td>Pony Tail Laser</td><td>125</td></tr>
                            <tr data-service="Full Abs" data-price="300" data-category="Laser Hair Removal"><td>Full Abs</td><td>300</td></tr>
                            <tr data-service="Full Legs" data-price="450" data-category="Laser Hair Removal"><td>Full Legs</td><td>450</td></tr>
                            <tr data-service="Cheeks" data-price="99" data-category="Laser Hair Removal"><td>Cheeks</td><td>99</td></tr>
                            <tr data-service="Chin" data-price="99" data-category="Laser Hair Removal"><td>Chin</td><td>99</td></tr>
                            <tr data-service="Buttocks" data-price="299" data-category="Laser Hair Removal"><td>Buttocks</td><td>299</td></tr>

                            <tr><th colspan="2">Radiofrequency Microneedling</th></tr>
                            <tr data-service="Full Face RF Microneedling" data-price="495" data-category="Radiofrequency Microneedling"><td>Full Face</td><td>495</td></tr>
                            <tr data-service="Neck RF Microneedling" data-price="495" data-category="Radiofrequency Microneedling"><td>Neck</td><td>495</td></tr>
                            <tr data-service="Arms RF Microneedling" data-price="595" data-category="Radiofrequency Microneedling"><td>Arms</td><td>595</td></tr>
                            <tr data-service="Abdomen RF Microneedling" data-price="1100" data-category="Radiofrequency Microneedling"><td>Abdomen</td><td>1100</td></tr>
                            <tr data-service="Bra Far Sculp" data-price="695" data-category="Radiofrequency Microneedling"><td>Bra Far Sculp</td><td>695</td></tr>
                            <tr data-service="Legs RF Microneedling" data-price="1500" data-category="Radiofrequency Microneedling"><td>Legs</td><td>1500</td></tr>

                            <tr><th colspan="2">Hydrafacial</th></tr>
                            <tr data-service="Signature Hydrafacial" data-price="250" data-category="Hydrafacial"><td>Signature Hydrafacial</td><td>250</td></tr>
                            <tr data-service="Dior Hydrafacial" data-price="399" data-category="Hydrafacial"><td>Dior Hydrafacial</td><td>399</td></tr>
                            <tr data-service="Keravive Hydrafacial (Hair)" data-price="450" data-category="Hydrafacial"><td>Keravive Hydrafacial (Hair)</td><td>450</td></tr>
                            <tr data-service="Underarm Hydrafacial" data-price="199" data-category="Hydrafacial"><td>Underarm Hydrafacial</td><td>199</td></tr>
                            <tr data-service="Back Hydrafacial" data-price="375" data-category="Hydrafacial"><td>Back Hydrafacial</td><td>375</td></tr>

                            <tr><th colspan="2">Chemical Peels</th></tr>
                            <tr data-service="BioRepeel" data-price="295" data-category="Chemical Peels"><td>BioRepeel</td><td>295</td></tr>
                            <tr data-service="Face &amp; Neck Peel" data-price="225" data-category="Chemical Peels"><td>Face &amp; Neck</td><td>225</td></tr>
                            <tr data-service="Back Peel" data-price="275" data-category="Chemical Peels"><td>Back</td><td>275</td></tr>
                            <tr data-service="Underarms Peel" data-price="175" data-category="Chemical Peels"><td>Underarms</td><td>175</td></tr>
                            <tr data-service="Intimate Area Peel" data-price="195" data-category="Chemical Peels"><td>Intimate Area</td><td>195</td></tr>

                            <tr><th colspan="2">VI Peels</th></tr>
                            <tr data-service="Acne VI Peel" data-price="350" data-category="VI Peels"><td>Acne VI Peel</td><td>350</td></tr>
                            <tr data-service="Acne Scarring VI Peel" data-price="350" data-category="VI Peels"><td>Acne Scarring VI Peel</td><td>350</td></tr>
                            <tr data-service="Rosacea Peel" data-price="350" data-category="VI Peels"><td>Rosacea Peel</td><td>350</td></tr>
                            <tr data-service="Sensitive Skin Peel" data-price="350" data-category="VI Peels"><td>Sensitive Skin Peel</td><td>350</td></tr>
                            <tr data-service="VI Hyperpigmentation Peel" data-price="350" data-category="VI Peels"><td>VI Hyperpigmentation Peel</td><td>350</td></tr>

                            <tr><th colspan="2">Skin Boosters &amp; Wellness</th></tr>
                            <tr data-service="Salmon DNA" data-price="450" data-category="Skin Boosters &amp; Wellness"><td>Salmon DNA</td><td>450</td></tr>
                            <tr data-service="Exosomes" data-price="595" data-category="Skin Boosters &amp; Wellness"><td>Exosomes</td><td>595</td></tr>

                            <tr><th colspan="2">Add Ons</th></tr>
                            <tr data-service="Hydrafacial Skin Booster" data-price="75" data-category="Add Ons"><td>Hydrafacial Skin Booster</td><td>75</td></tr>
                            <tr data-service="Dermaplanning" data-price="70" data-category="Add Ons"><td>Dermaplanning</td><td>70</td></tr>
                            <tr data-service="Red Light Therapy" data-price="50" data-category="Add Ons"><td>Red Light Therapy</td><td>50</td></tr>
                            <tr data-service="Blue Light Therapy" data-price="50" data-category="Add Ons"><td>Blue Light Therapy</td><td>50</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- Staff subsection -->
                <div class="order manage-subsection" id="manage-staff" style="display: none;">
                    <div class="head" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h3>Staff</h3>
                        </div>
                        <button style="padding: 8px 16px; background: var(--dark); color: var(--light); border: none; border-radius: 4px; cursor: pointer;">
                            New staff
                        </button>
                    </div>

                    <!-- Search and status filter -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin: 16px 0;">
                        <div style="flex: 1; margin-right: 16px;">
                            <input type="text" placeholder="Search staff" style="width: 100%; padding: 10px 12px; border-radius: 4px; border: 1px solid var(--grey);">
                        </div>
                        <div>
                            <span style="margin-right: 4px;">Status:</span>
                            <select style="padding: 8px 12px; border-radius: 4px; border: 1px solid var(--grey);">
                                <option>Active</option>
                                <option>Invited</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Staff table -->
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Permission group</th>
                                <th>Invite</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-name="Ayla K" data-phone="(253) 408-9535" data-email="info@aylamedia.co" data-role="Team Permissions">
                                <td>
                                    <span style="display:inline-flex;align-items:center;gap:8px;">
                                        <span style="width:32px;height:32px;border-radius:50%;background:#9b5de5;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;">
                                            <i class='bx bxs-user'></i>
                                        </span>
                                        <span>Ayla K</span>
                                    </span>
                                </td>
                                <td>(253) 408-9535</td>
                                <td>info@aylamedia.co</td>
                                <td>Team Permissions</td>
                                <td>Service Provider</td>
                                <td><a href="#">Send Invite</a></td>
                            </tr>
                            <tr data-name="Jodie X" data-phone="(206) 507-8902" data-email="coderebuilt@gmail.com" data-role="Team Permissions">
                                <td>
                                    <span style="display:inline-flex;align-items:center;gap:8px;">
                                        <span style="width:32px;height:32px;border-radius:50%;background:#ff6f91;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;">
                                            <i class='bx bxs-user'></i>
                                        </span>
                                        <span>Jodie X</span>
                                    </span>
                                </td>
                                <td>(206) 507-8902</td>
                                <td>coderebuilt@gmail.com</td>
                                <td>Team Permissions</td>
                                <td>Admin</td>
                                <td>Confirmed</td>
                            </tr>
                            <tr data-name="Laser Room #1" data-phone="(206) 554-9524" data-email="ranibeautyclinic13@gmail.com" data-role="Team Permissions">
                                <td>
                                    <span style="display:inline-flex;align-items:center;gap:8px;">
                                        <span style="width:32px;height:32px;border-radius:50%;background:#495057;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;">
                                            <i class='bx bxs-user'></i>
                                        </span>
                                        <span>Laser Room #1</span>
                                    </span>
                                </td>
                                <td>(206) 554-9524</td>
                                <td>ranibeautyclinic13@gmail.com</td>
                                <td>Team Permissions</td>
                                <td>Service Provider</td>
                                <td><a href="#">Send Invite</a></td>
                            </tr>
                            <tr data-name="Raj Rai" data-phone="(206) 507-8902" data-email="rajvinderkaurnijjar@gmail.com" data-role="Team Permissions">
                                <td>
                                    <span style="display:inline-flex;align-items:center;gap:8px;">
                                        <span style="width:32px;height:32px;border-radius:50%;background:#00b4d8;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;">
                                            <i class='bx bxs-user'></i>
                                        </span>
                                        <span>Raj Rai</span>
                                    </span>
                                </td>
                                <td>(206) 507-8902</td>
                                <td>rajvinderkaurnijjar@gmail.com</td>
                                <td>Team Permissions</td>
                                <td>Service Provider</td>
                                <td><a href="#">Send Invite</a></td>
                            </tr>
                            <tr data-name="Rina Rai" data-phone="(425) 539-4440" data-email="info@ranibeautyclinic.com" data-role="General Staff">
                                <td>
                                    <span style="display:inline-flex;align-items:center;gap:8px;">
                                        <span style="width:32px;height:32px;border-radius:50%;background:#f4a261;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;">
                                            <i class='bx bxs-user'></i>
                                        </span>
                                        <span>Rina Rai</span>
                                    </span>
                                </td>
                                <td>(425) 539-4440</td>
                                <td>info@ranibeautyclinic.com</td>
                                <td>General Staff</td>
                                <td>Admin</td>
                                <td>Confirmed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sliding Service Profile Panel -->
        <div id="service-profile-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.35); z-index:996;"></div>
        <div id="service-profile-panel" style="position:fixed; top:0; right:-700px; width:700px; height:100%; background:var(--light); box-shadow:-2px 0 8px rgba(0,0,0,0.15); z-index:997; transition:right 0.3s ease; display:flex; flex-direction:column;">
            <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 20px; background:#222; color:#fff;">
                <div style="font-weight:600;">Service</div>
                <button id="service-profile-close" style="background:transparent; border:none; color:#fff; font-size:20px; cursor:pointer;">&times;</button>
            </div>
            <div style="padding:20px; overflow-y:auto; flex:1;">
                <h2 id="service-profile-name" style="margin:0 0 16px 0; font-size:22px;">Service Name</h2>

                <!-- Sub-tabs: Overview / Staff -->
                <div style="display:flex; gap:24px; border-bottom:1px solid var(--grey); margin-bottom:16px;">
                    <button id="service-tab-overview" style="background:none; border:none; padding:8px 0; cursor:pointer; font-weight:600; border-bottom:2px solid #000;">
                        Overview
                    </button>
                    <button id="service-tab-staff" style="background:none; border:none; padding:8px 0; cursor:pointer; color:var(--dark-grey); border-bottom:2px solid transparent;">
                        Staff
                    </button>
                </div>

                <div id="service-panel-overview">
                    <!-- Commission and charges -->
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">
                        <div>
                            <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey); display:block; margin-bottom:8px;">
                                Commission Override
                            </label>
                            <div style="display:flex; align-items:center; border-bottom:1px solid var(--grey); padding-bottom:8px;">
                                <input type="number" min="0" max="100" step="0.1" placeholder=""
                                       style="flex:1; border:none; outline:none; font-size:16px; background:transparent;">
                                <span style="margin-left:4px;">%</span>
                            </div>
                        </div>
                        <div>
                            <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey); display:block; margin-bottom:8px;">
                                Business Service Charge *
                            </label>
                            <div style="display:flex; align-items:center; border-bottom:1px solid var(--grey); padding-bottom:8px;">
                                <span style="margin-right:6px;">$</span>
                                <input type="number" min="0" step="0.01" value="0.00"
                                       style="flex:1; border:none; outline:none; font-size:16px; background:transparent; text-align:right;">
                            </div>
                        </div>
                    </div>

                    <!-- Checkboxes -->
                    <div style="display:flex; flex-direction:column; gap:12px; margin-bottom:24px; font-size:14px;">
                        <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                            <input type="checkbox" style="width:16px; height:16px;">
                            <span>This location has a custom tax rate</span>
                        </label>
                        <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                            <input type="checkbox" checked style="width:16px; height:16px;">
                            <span>Bookable online</span>
                        </label>
                    </div>

                    <!-- Informational text -->
                    <p style="font-size:14px; color:var(--dark-grey); line-height:1.5; margin-bottom:24px;">
                        If this service has a custom commission rate, you may override it here.
                        To use the default staff pay rate, leave this blank. Historical records will be preserved
                        even if this value is changed.
                    </p>
                    <p style="font-size:14px; color:var(--dark-grey); line-height:1.5; margin-bottom:24px;">
                        Business Service Charges may be used for material costs or other cost of goods recouped from
                        this service. The total service charges may be seen in reports.
                    </p>
                    <p style="font-size:14px; color:var(--dark-grey); line-height:1.5; margin-bottom:24px;">
                        A staff member must be assigned to this service for it to be accessible and appear in the
                        self-booking overlay.
                    </p>
                </div>

                <div id="service-panel-staff" style="display:none;">
                    <p style="margin-top:8px; color:var(--dark-grey); font-size:14px;">Staff members who can perform this service will be listed here.</p>
                </div>
            </div>
            <div style="padding:12px 20px; border-top:1px solid var(--grey); display:flex; justify-content:flex-end; gap:8px;">
                <button style="padding:8px 14px; border:none; background:#000; color:#fff; border-radius:4px; cursor:pointer;">Save changes</button>
            </div>
        </div>

        <!-- Sliding Staff Profile Panel -->
        <div id="staff-profile-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.35); z-index:998;"></div>
        <div id="staff-profile-panel" style="position:fixed; top:0; right:-820px; width:820px; height:100%; background:var(--light); box-shadow:-2px 0 8px rgba(0,0,0,0.15); z-index:999; transition:right 0.3s ease; display:flex; flex-direction:column;">
            <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 20px; background:#222; color:#fff;">
                <div style="font-weight:600;">Staff Profile</div>
                <button id="staff-profile-close" style="background:transparent; border:none; color:#fff; font-size:20px; cursor:pointer;">&times;</button>
            </div>
            <div style="padding:20px; overflow-y:auto; flex:1;">
                <h2 id="staff-profile-name" style="margin:0 0 16px 0; font-size:22px;">Staff Name</h2>

                <!-- Sub-tabs under Personal information -->
                <div style="display:flex; gap:24px; border-bottom:1px solid var(--grey); margin-bottom:16px;">
                    <button id="staff-tab-personal" class="staff-profile-tab active" style="background:none; border:none; padding:8px 0; cursor:pointer; font-weight:600; border-bottom:2px solid #000;">
                        Personal information
                    </button>
                    <button id="staff-tab-services" class="staff-profile-tab" style="background:none; border:none; padding:8px 0; cursor:pointer; color:var(--dark-grey);">
                        Services
                    </button>
                    <button id="staff-tab-appointments" class="staff-profile-tab" style="background:none; border:none; padding:8px 0; cursor:pointer; color:var(--dark-grey);">
                        Appointments
                    </button>
                </div>

                <!-- Personal Info Content -->
                <div id="staff-panel-personal" class="staff-panel-section" style="display:block;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-top:4px;">
                    <div>
                        <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey);">First name</label>
                        <input id="staff-profile-firstname" type="text" style="width:100%; padding:8px 10px; border:1px solid var(--grey); border-radius:4px; margin-top:4px;">
                    </div>
                    <div>
                        <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey);">Last name</label>
                        <input id="staff-profile-lastname" type="text" style="width:100%; padding:8px 10px; border:1px solid var(--grey); border-radius:4px; margin-top:4px;">
                    </div>
                    <div>
                        <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey);">Staff role</label>
                        <input id="staff-profile-role" type="text" style="width:100%; padding:8px 10px; border:1px solid var(--grey); border-radius:4px; margin-top:4px;">
                    </div>
                    <div>
                        <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey);">Alias</label>
                        <input id="staff-profile-alias" type="text" style="width:100%; padding:8px 10px; border:1px solid var(--grey); border-radius:4px; margin-top:4px;">
                    </div>
                    <div>
                        <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey);">Email</label>
                        <input id="staff-profile-email" type="email" style="width:100%; padding:8px 10px; border:1px solid var(--grey); border-radius:4px; margin-top:4px;">
                    </div>
                    <div>
                        <label style="font-size:12px; text-transform:uppercase; color:var(--dark-grey);">Phone</label>
                        <input id="staff-profile-phone" type="text" style="width:100%; padding:8px 10px; border:1px solid var(--grey); border-radius:4px; margin-top:4px;">
                    </div>
                    </div>
                </div>

                <!-- Services Content -->
                <div id="staff-panel-services" class="staff-panel-section" style="display:none;">
                    <p style="margin-top:8px; color:var(--dark-grey); font-size:14px;">Services offered by this location.</p>
                    <div style="margin-top:12px; max-height:490px; overflow-y:auto; border:1px solid var(--grey); border-radius:4px; padding:8px;">
                        <table style="width:100%; border-collapse:collapse; font-size:14px;">
                            <thead>
                                <tr>
                                    <th style="text-align:left; padding:6px 8px;">Services</th>
                                    <th style="text-align:left; padding:6px 8px;">$</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><th colspan="2" style="padding:6px 8px;">Face Fixes</th></tr>
                                <tr><td style="padding:4px 8px;">Botox / Botox Facial</td><td style="padding:4px 8px;">14</td></tr>
                                <tr><td style="padding:4px 8px;">Sculptra</td><td style="padding:4px 8px;">950</td></tr>
                                <tr><td style="padding:4px 8px;">Lip Filler</td><td style="padding:4px 8px;">650</td></tr>
                                <tr><td style="padding:4px 8px;">Eye Filler</td><td style="padding:4px 8px;">750</td></tr>
                                <tr><td style="padding:4px 8px;">Cheek Filler</td><td style="padding:4px 8px;">850</td></tr>
                                <tr><td style="padding:4px 8px;">Nose Filler</td><td style="padding:4px 8px;">795</td></tr>
                                <tr><td style="padding:4px 8px;">Jawline Filler</td><td style="padding:4px 8px;">795</td></tr>
                                <tr><td style="padding:4px 8px;">Neck Filler</td><td style="padding:4px 8px;">795</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">Body Fixes</th></tr>
                                <tr><td style="padding:4px 8px;">Radiesse</td><td style="padding:4px 8px;">950</td></tr>
                                <tr><td style="padding:4px 8px;">Sculptra Skinny BBL</td><td style="padding:4px 8px;">895</td></tr>
                                <tr><td style="padding:4px 8px;">Traptox</td><td style="padding:4px 8px;">895</td></tr>
                                <tr><td style="padding:4px 8px;">Cutera Secret</td><td style="padding:4px 8px;">895</td></tr>
                                <tr><td style="padding:4px 8px;">Sofwave</td><td style="padding:4px 8px;">495</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">Skin Fixes</th></tr>
                                <tr><td style="padding:4px 8px;">Laser Facials</td><td style="padding:4px 8px;">495</td></tr>
                                <tr><td style="padding:4px 8px;">Hydrafacial</td><td style="padding:4px 8px;">250</td></tr>
                                <tr><td style="padding:4px 8px;">VI Peel</td><td style="padding:4px 8px;">399</td></tr>
                                <tr><td style="padding:4px 8px;">Cosmelan</td><td style="padding:4px 8px;">995</td></tr>
                                <tr><td style="padding:4px 8px;">Sofwave</td><td style="padding:4px 8px;">495</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">Laser Hair Removal</th></tr>
                                <tr><td style="padding:4px 8px;">Laser Acne Facial</td><td style="padding:4px 8px;">495</td></tr>
                                <tr><td style="padding:4px 8px;">Laser Roscea Facial</td><td style="padding:4px 8px;">495</td></tr>
                                <tr><td style="padding:4px 8px;">Laser Resurfacing Facial</td><td style="padding:4px 8px;">795</td></tr>
                                <tr><td style="padding:4px 8px;">Upper Lip Laser Hair Removal</td><td style="padding:4px 8px;">29</td></tr>
                                <tr><td style="padding:4px 8px;">Eyebrows</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Sideburns</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Full Back</td><td style="padding:4px 8px;">400</td></tr>
                                <tr><td style="padding:4px 8px;">Pantyline</td><td style="padding:4px 8px;">150</td></tr>
                                <tr><td style="padding:4px 8px;">Neck</td><td style="padding:4px 8px;">299</td></tr>
                                <tr><td style="padding:4px 8px;">Full Face Laser Hair Removal</td><td style="padding:4px 8px;">299</td></tr>
                                <tr><td style="padding:4px 8px;">Hands and fingers</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Full Chest</td><td style="padding:4px 8px;">250</td></tr>
                                <tr><td style="padding:4px 8px;">Happy Trail</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Areolas</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Forehead</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Jawline</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Underarms</td><td style="padding:4px 8px;">175</td></tr>
                                <tr><td style="padding:4px 8px;">Limited Time $99 Upper Lip</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Feet &amp; Toes</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Full Brazilian</td><td style="padding:4px 8px;">250</td></tr>
                                <tr><td style="padding:4px 8px;">Ears</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Full Body Laser Hair Removal</td><td style="padding:4px 8px;">1299</td></tr>
                                <tr><td style="padding:4px 8px;">Pony Tail Laser</td><td style="padding:4px 8px;">125</td></tr>
                                <tr><td style="padding:4px 8px;">Full Abs</td><td style="padding:4px 8px;">300</td></tr>
                                <tr><td style="padding:4px 8px;">Full Legs</td><td style="padding:4px 8px;">450</td></tr>
                                <tr><td style="padding:4px 8px;">Cheeks</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Chin</td><td style="padding:4px 8px;">99</td></tr>
                                <tr><td style="padding:4px 8px;">Buttocks</td><td style="padding:4px 8px;">299</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">Radiofrequency Microneedling</th></tr>
                                <tr><td style="padding:4px 8px;">Full Face</td><td style="padding:4px 8px;">495</td></tr>
                                <tr><td style="padding:4px 8px;">Neck</td><td style="padding:4px 8px;">495</td></tr>
                                <tr><td style="padding:4px 8px;">Arms</td><td style="padding:4px 8px;">595</td></tr>
                                <tr><td style="padding:4px 8px;">Abdomen</td><td style="padding:4px 8px;">1100</td></tr>
                                <tr><td style="padding:4px 8px;">Bra Far Sculp</td><td style="padding:4px 8px;">695</td></tr>
                                <tr><td style="padding:4px 8px;">Legs</td><td style="padding:4px 8px;">1500</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">Hydrafacial</th></tr>
                                <tr><td style="padding:4px 8px;">Signature Hydrafacial</td><td style="padding:4px 8px;">250</td></tr>
                                <tr><td style="padding:4px 8px;">Dior Hydrafacial</td><td style="padding:4px 8px;">399</td></tr>
                                <tr><td style="padding:4px 8px;">Keravive Hydrafacial (Hair)</td><td style="padding:4px 8px;">450</td></tr>
                                <tr><td style="padding:4px 8px;">Underarm Hydrafacial</td><td style="padding:4px 8px;">199</td></tr>
                                <tr><td style="padding:4px 8px;">Back Hydrafacial</td><td style="padding:4px 8px;">375</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">Chemical Peels</th></tr>
                                <tr><td style="padding:4px 8px;">BioRepeel</td><td style="padding:4px 8px;">295</td></tr>
                                <tr><td style="padding:4px 8px;">Face &amp; Neck</td><td style="padding:4px 8px;">225</td></tr>
                                <tr><td style="padding:4px 8px;">Back</td><td style="padding:4px 8px;">275</td></tr>
                                <tr><td style="padding:4px 8px;">Underarms</td><td style="padding:4px 8px;">175</td></tr>
                                <tr><td style="padding:4px 8px;">Intimate Area</td><td style="padding:4px 8px;">195</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">VI Peels</th></tr>
                                <tr><td style="padding:4px 8px;">Acne VI Peel</td><td style="padding:4px 8px;">350</td></tr>
                                <tr><td style="padding:4px 8px;">Acne Scarring VI Peel</td><td style="padding:4px 8px;">350</td></tr>
                                <tr><td style="padding:4px 8px;">Rosacea Peel</td><td style="padding:4px 8px;">350</td></tr>
                                <tr><td style="padding:4px 8px;">Sensitive Skin Peel</td><td style="padding:4px 8px;">350</td></tr>
                                <tr><td style="padding:4px 8px;">VI Hyperpigmentation Peel</td><td style="padding:4px 8px;">350</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">Skin Boosters &amp; Wellness</th></tr>
                                <tr><td style="padding:4px 8px;">Salmon DNA</td><td style="padding:4px 8px;">450</td></tr>
                                <tr><td style="padding:4px 8px;">Exosomes</td><td style="padding:4px 8px;">595</td></tr>

                                <tr><th colspan="2" style="padding:6px 8px;">Add Ons</th></tr>
                                <tr><td style="padding:4px 8px;">Hydrafacial Skin Booster</td><td style="padding:4px 8px;">75</td></tr>
                                <tr><td style="padding:4px 8px;">Dermaplanning</td><td style="padding:4px 8px;">70</td></tr>
                                <tr><td style="padding:4px 8px;">Red Light Therapy</td><td style="padding:4px 8px;">50</td></tr>
                                <tr><td style="padding:4px 8px;">Blue Light Therapy</td><td style="padding:4px 8px;">50</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Appointments Content -->
                <div id="staff-panel-appointments" class="staff-panel-section" style="display:none;">
                    <p style="margin-top:8px; color:var(--dark-grey); font-size:14px;">View upcoming and past appointments for this staff member.</p>
                </div>
            </div>
            <div style="padding:12px 20px; border-top:1px solid var(--grey); display:flex; justify-content:flex-end; gap:8px;">
                <button style="padding:8px 14px; border:none; background:#000; color:#fff; border-radius:4px; cursor:pointer;">Save changes</button>
            </div>
        </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script>
        const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top > li > a');
        const manageSubmenu = document.getElementById('manage-submenu');
        const manageSubLinks = document.querySelectorAll('#manage-submenu a[data-subsection]');
        const serviceRows = document.querySelectorAll('#manage-services table tbody tr[data-service]');

        allSideMenu.forEach(item => {
            const li = item.parentElement;

            item.addEventListener('click', function (e) {
                // Prevent default jump for menu links
                e.preventDefault();

                // Active state handling
                allSideMenu.forEach(i => {
                    i.parentElement.classList.remove('active');
                });
                li.classList.add('active');

                // Close sliding panels if open when switching main sections
                if (typeof closeStaffProfile === 'function') {
                    closeStaffProfile();
                }
                if (typeof closeServiceProfile === 'function') {
                    closeServiceProfile();
                }

                // Section switching for Front Desk and Manage
                const section = item.getAttribute('data-section');
                const frontdeskSection = document.getElementById('frontdesk-section');
                const manageSection = document.getElementById('manage-section');

                if (section === 'frontdesk') {
                    if (frontdeskSection) frontdeskSection.style.display = 'block';
                    if (manageSection) manageSection.style.display = 'none';
                    if (manageSubmenu) manageSubmenu.style.display = 'none';
                } else if (section === 'manage') {
                    if (frontdeskSection) frontdeskSection.style.display = 'none';
                    if (manageSection) manageSection.style.display = 'block';

                    if (manageSubmenu) {
                        const isHidden = manageSubmenu.style.display === 'none' || manageSubmenu.style.display === '';

                        // Toggle submenu visibility
                        if (isHidden) {
                            manageSubmenu.style.display = 'block';

                            // Default to Schedule subsection when opening Manage
                            const defaultSub = document.getElementById('manage-schedule');
                            const allSubs = document.querySelectorAll('.manage-subsection');
                            allSubs.forEach(s => s.style.display = 'none');
                            if (defaultSub) defaultSub.style.display = 'block';
                        } else {
                            manageSubmenu.style.display = 'none';
                        }
                    }
                }
            });
        });

        // Handle clicks on Manage submenu items (Schedule, Services, Staff)
        manageSubLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('data-subsection');
                const allSubs = document.querySelectorAll('.manage-subsection');

                allSubs.forEach(s => s.style.display = 'none');

                const activeSub = document.getElementById(`manage-${target}`);
                if (activeSub) activeSub.style.display = 'block';
            });
        });

        // Sliding Staff Profile panel logic
        const staffRows = document.querySelectorAll('#manage-staff table tbody tr');
        const staffProfilePanel = document.getElementById('staff-profile-panel');
        const staffProfileOverlay = document.getElementById('staff-profile-overlay');
        const staffProfileClose = document.getElementById('staff-profile-close');
        const staffProfileName = document.getElementById('staff-profile-name');
        const staffProfileFirstname = document.getElementById('staff-profile-firstname');
        const staffProfileLastname = document.getElementById('staff-profile-lastname');
        const staffProfileRole = document.getElementById('staff-profile-role');
        const staffProfileEmail = document.getElementById('staff-profile-email');
        const staffProfilePhone = document.getElementById('staff-profile-phone');
        const staffTabPersonal = document.getElementById('staff-tab-personal');
        const staffTabServices = document.getElementById('staff-tab-services');
        const staffTabAppointments = document.getElementById('staff-tab-appointments');
        const staffPanelPersonal = document.getElementById('staff-panel-personal');
        const staffPanelServices = document.getElementById('staff-panel-services');
        const staffPanelAppointments = document.getElementById('staff-panel-appointments');

        function openStaffProfile(row) {
            const name = row.getAttribute('data-name') || '';
            const phone = row.getAttribute('data-phone') || '';
            const email = row.getAttribute('data-email') || '';
            const role = row.getAttribute('data-role') || '';

            staffProfileName.textContent = name || 'Staff Profile';

            const parts = name.split(' ');
            staffProfileFirstname.value = parts[0] || '';
            staffProfileLastname.value = parts.slice(1).join(' ') || '';

            staffProfileRole.value = role;
            staffProfileEmail.value = email;
            staffProfilePhone.value = phone;

            staffProfileOverlay.style.display = 'block';
            staffProfilePanel.style.right = '0';
        }

        function closeStaffProfile() {
            staffProfileOverlay.style.display = 'none';
            staffProfilePanel.style.right = '-820px';
        }

        // Service profile sliding panel logic
        const serviceProfilePanel = document.getElementById('service-profile-panel');
        const serviceProfileOverlay = document.getElementById('service-profile-overlay');
        const serviceProfileClose = document.getElementById('service-profile-close');
        const serviceProfileName = document.getElementById('service-profile-name');
        const serviceProfileCategory = document.getElementById('service-profile-category');
        const serviceProfilePrice = document.getElementById('service-profile-price');
        const serviceTabOverview = document.getElementById('service-tab-overview');
        const serviceTabStaff = document.getElementById('service-tab-staff');
        const servicePanelOverview = document.getElementById('service-panel-overview');
        const servicePanelStaff = document.getElementById('service-panel-staff');

        function openServiceProfile(row) {
            const name = row.getAttribute('data-service') || '';
            const category = row.getAttribute('data-category') || '';
            const price = row.getAttribute('data-price') || '';

            serviceProfileName.textContent = name || 'Service';
            if (serviceProfileCategory) {
                serviceProfileCategory.textContent = category ? `Category: ${category}` : '';
            }
            if (serviceProfilePrice) {
                serviceProfilePrice.textContent = price ? `Price: $${price}` : '';
            }

            // Default to Overview tab
            if (serviceTabOverview && servicePanelOverview && servicePanelStaff && serviceTabStaff) {
                serviceTabOverview.style.color = '#000';
                serviceTabOverview.style.borderBottom = '2px solid #000';
                serviceTabOverview.style.fontWeight = '600';
                serviceTabStaff.style.color = 'var(--dark-grey)';
                serviceTabStaff.style.borderBottom = '2px solid transparent';
                serviceTabStaff.style.fontWeight = '400';
                servicePanelOverview.style.display = 'block';
                servicePanelStaff.style.display = 'none';
            }

            serviceProfileOverlay.style.display = 'block';
            serviceProfilePanel.style.right = '0';
        }

        function closeServiceProfile() {
            serviceProfileOverlay.style.display = 'none';
            serviceProfilePanel.style.right = '-700px';
        }

        staffRows.forEach(row => {
            row.style.cursor = 'pointer';
            row.addEventListener('click', function (e) {
                // Avoid triggering when clicking on links inside the row
                if (e.target.tagName.toLowerCase() === 'a') return;
                openStaffProfile(row);
            });
        });

        if (staffProfileClose) {
            staffProfileClose.addEventListener('click', closeStaffProfile);
        }
        if (staffProfileOverlay) {
            staffProfileOverlay.addEventListener('click', closeStaffProfile);
        }

        // Service rows click handlers
        serviceRows.forEach(row => {
            row.style.cursor = 'pointer';
            row.addEventListener('click', function () {
                openServiceProfile(row);
            });
        });

        if (serviceProfileClose) {
            serviceProfileClose.addEventListener('click', closeServiceProfile);
        }
        if (serviceProfileOverlay) {
            serviceProfileOverlay.addEventListener('click', closeServiceProfile);
        }

        // Service profile sub-tabs
        if (serviceTabOverview && serviceTabStaff && servicePanelOverview && servicePanelStaff) {
            serviceTabOverview.addEventListener('click', function () {
                serviceTabOverview.style.color = '#000';
                serviceTabOverview.style.borderBottom = '2px solid #000';
                serviceTabOverview.style.fontWeight = '600';

                serviceTabStaff.style.color = 'var(--dark-grey)';
                serviceTabStaff.style.borderBottom = '2px solid transparent';
                serviceTabStaff.style.fontWeight = '400';

                servicePanelOverview.style.display = 'block';
                servicePanelStaff.style.display = 'none';
            });

            serviceTabStaff.addEventListener('click', function () {
                serviceTabStaff.style.color = '#000';
                serviceTabStaff.style.borderBottom = '2px solid #000';
                serviceTabStaff.style.fontWeight = '600';

                serviceTabOverview.style.color = 'var(--dark-grey)';
                serviceTabOverview.style.borderBottom = '2px solid transparent';
                serviceTabOverview.style.fontWeight = '400';

                servicePanelOverview.style.display = 'none';
                servicePanelStaff.style.display = 'block';
            });
        }

        // Staff profile sub-tabs (Personal / Services / Appointments)
        function setActiveStaffTab(activeTab, activePanel) {
            const tabs = [staffTabPersonal, staffTabServices, staffTabAppointments];
            const panels = [staffPanelPersonal, staffPanelServices, staffPanelAppointments];

            tabs.forEach(tab => {
                if (!tab) return;
                if (tab === activeTab) {
                    tab.style.color = '#000';
                    tab.style.borderBottom = '2px solid #000';
                    tab.style.fontWeight = '600';
                } else {
                    tab.style.color = 'var(--dark-grey)';
                    tab.style.borderBottom = '2px solid transparent';
                    tab.style.fontWeight = '400';
                }
            });

            panels.forEach(panel => {
                if (!panel) return;
                panel.style.display = (panel === activePanel) ? 'block' : 'none';
            });
        }

        if (staffTabPersonal && staffPanelPersonal) {
            setActiveStaffTab(staffTabPersonal, staffPanelPersonal);

            staffTabPersonal.addEventListener('click', () => setActiveStaffTab(staffTabPersonal, staffPanelPersonal));
        }
        if (staffTabServices && staffPanelServices) {
            staffTabServices.addEventListener('click', () => setActiveStaffTab(staffTabServices, staffPanelServices));
        }
        if (staffTabAppointments && staffPanelAppointments) {
            staffTabAppointments.addEventListener('click', () => setActiveStaffTab(staffTabAppointments, staffPanelAppointments));
        }

        // Calendar Logic
        const calendarDays = document.getElementById('calendar-days');
        const monthPicker = document.getElementById('month-picker');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');

        let currentDate = new Date();
        let currMonth = currentDate.getMonth();
        let currYear = currentDate.getFullYear();

        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        const isLeapYear = (year) => {
            return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
        };

        const getFebDays = (year) => {
            return isLeapYear(year) ? 29 : 28;
        };

        const generateCalendar = (month, year) => {
            calendarDays.innerHTML = '';
            
            // Get last day of the month
            let daysInMonth = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            
            // Date object for the first day of the month
            let firstDay = new Date(year, month, 1);
            
            // 0 = Sunday, 1 = Monday, etc.
            let startDay = firstDay.getDay();

            monthPicker.innerHTML = `${months[month]} ${year}`;

            // Add empty divs for previous month days
            for (let i = 0; i < startDay; i++) {
                const day = document.createElement('div');
                day.classList.add('empty');
                calendarDays.appendChild(day);
            }

            // Add days of current month
            for (let i = 1; i <= daysInMonth[month]; i++) {
                const day = document.createElement('div');
                day.innerHTML = i;
                
                // Highlight current date
                if (i === currentDate.getDate() && year === currentDate.getFullYear() && month === currentDate.getMonth()) {
                    day.classList.add('curr-date');
                }

                calendarDays.appendChild(day);
            }
        };

        prevMonthBtn.onclick = () => {
            currMonth--;
            if (currMonth < 0) {
                currMonth = 11;
                currYear--;
            }
            generateCalendar(currMonth, currYear);
        };

        nextMonthBtn.onclick = () => {
            currMonth++;
            if (currMonth > 11) {
                currMonth = 0;
                currYear++;
            }
            generateCalendar(currMonth, currYear);
        };

        // Initialize Calendar
        generateCalendar(currMonth, currYear);

        // TOGGLE SIDEBAR
        const menuBar = document.querySelector('#content nav .bx.bx-menu');
        const sidebar = document.getElementById('sidebar');

        // Sidebar toggle işlemi
        menuBar.addEventListener('click', function () {
            sidebar.classList.toggle('hide');
        });

        // Sayfa yüklendiğinde ve boyut değişimlerinde sidebar durumunu ayarlama
        function adjustSidebar() {
            if (window.innerWidth <= 576) {
                sidebar.classList.add('hide');  // 576px ve altı için sidebar gizli
                sidebar.classList.remove('show');
            } else {
                sidebar.classList.remove('hide');  // 576px'den büyükse sidebar görünür
                sidebar.classList.add('show');
            }
        }

        // Sayfa yüklendiğinde ve pencere boyutu değiştiğinde sidebar durumunu ayarlama
        window.addEventListener('load', adjustSidebar);
        window.addEventListener('resize', adjustSidebar);

        // Arama butonunu toggle etme
        const searchButton = document.querySelector('#content nav form .form-input button');
        const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
        const searchForm = document.querySelector('#content nav form');

        searchButton.addEventListener('click', function (e) {
            if (window.innerWidth < 768) {
                e.preventDefault();
                searchForm.classList.toggle('show');
                if (searchForm.classList.contains('show')) {
                    searchButtonIcon.classList.replace('bx-search', 'bx-x');
                } else {
                    searchButtonIcon.classList.replace('bx-x', 'bx-search');
                }
            }
        })

        // Dark Mode Switch
        const switchMode = document.getElementById('switch-mode');

        switchMode.addEventListener('change', function () {
            if (this.checked) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
        })

        // Notification Menu Toggle
        document.querySelector('.notification').addEventListener('click', function () {
            document.querySelector('.notification-menu').classList.toggle('show');
            document.querySelector('.profile-menu').classList.remove('show'); // Close profile menu if open
        });

        // Profile Menu Toggle
        document.querySelector('.profile').addEventListener('click', function () {
            document.querySelector('.profile-menu').classList.toggle('show');
            document.querySelector('.notification-menu').classList.remove('show'); // Close notification menu if open
        });

        // Close menus if clicked outside
        window.addEventListener('click', function (e) {
            if (!e.target.closest('.notification') && !e.target.closest('.profile')) {
                document.querySelector('.notification-menu').classList.remove('show');
                document.querySelector('.profile-menu').classList.remove('show');
            }
        });

        // Menülerin açılıp kapanması için fonksiyon
            function toggleMenu(menuId) {
            var menu = document.getElementById(menuId);
            var allMenus = document.querySelectorAll('.menu');

            // Diğer tüm menüleri kapat
            allMenus.forEach(function(m) {
                if (m !== menu) {
                m.style.display = 'none';
                }
            });

            // Tıklanan menü varsa aç, yoksa kapat
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
            }

            // Başlangıçta tüm menüleri kapalı tut
            document.addEventListener("DOMContentLoaded", function() {
            var allMenus = document.querySelectorAll('.menu');
            allMenus.forEach(function(menu) {
                menu.style.display = 'none';
            });
            });
    </script>
</body>
</html>
