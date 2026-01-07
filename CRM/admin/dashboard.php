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
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap');

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

            /* Rani Beauty Clinic Brand Colors */
            --brand-navy: #0F1D2C;
            --brand-gold: #F3D6BE;
            --brand-bg: #FAF8F5;
            --brand-white: #FFFFFF;
            --brand-text: #2A2A2A;
            --brand-soft-shadow: 0 10px 30px rgba(0,0,0,0.06);

            --montserrat: 'Montserrat', sans-serif;
            --playfair: 'Playfair Display', serif;
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

        /* PREMIUM SERVICES LIST STYLES */
        #manage-services {
            background: var(--brand-bg) !important;
            padding: 30px !important;
        }

        .services-header {
            margin-bottom: 30px;
        }

        .services-header h3 {
            font-family: var(--playfair);
            font-size: 2.2rem;
            color: var(--brand-navy);
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        /* Search Bar */
        .services-search {
            position: relative;
            max-width: 500px;
            margin-bottom: 25px;
        }

        .services-search input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 1px solid rgba(15, 29, 44, 0.1);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            font-family: var(--montserrat);
            font-size: 1rem;
            color: var(--brand-navy);
            transition: all 0.3s ease;
        }

        .services-search i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--brand-navy);
            opacity: 0.5;
            font-size: 1.2rem;
        }

        .services-search input:focus {
            outline: none;
            border-color: var(--brand-navy);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        /* Filter Tabs */
        .services-filters {
            display: flex;
            gap: 25px;
            border-bottom: 1px solid rgba(15, 29, 44, 0.1);
            margin-bottom: 30px;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 10px;
        }

        .services-filters::-webkit-scrollbar {
            display: none;
        }

        .filter-pill {
            font-family: var(--montserrat);
            font-weight: 500;
            color: var(--brand-navy);
            opacity: 0.6;
            cursor: pointer;
            padding: 5px 0 15px 0;
            position: relative;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .filter-pill.active {
            opacity: 1;
            font-weight: 700;
        }

        .filter-pill.active::after {
            content: '';
            position: absolute;
            bottom: -11px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--brand-navy);
            border-radius: 3px;
        }

        /* Services List */
        .services-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .service-item {
            background: var(--brand-white);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--brand-soft-shadow);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .service-item:hover {
            transform: translateY(-3px);
            border-color: var(--brand-gold);
            background: #fff;
        }

        .service-main-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .service-title {
            font-family: var(--montserrat);
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--brand-navy);
            line-height: 1.4;
        }

        .service-category {
            font-family: var(--montserrat);
            font-size: 0.85rem;
            color: var(--brand-navy);
            opacity: 0.5;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .service-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .service-price {
            font-family: var(--montserrat);
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--brand-navy);
            background: var(--brand-gold);
            padding: 8px 15px;
            border-radius: 10px;
            min-width: 90px;
            text-align: center;
        }

        .service-actions {
            color: var(--brand-navy);
            opacity: 0.3;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .service-item:hover .service-actions {
            opacity: 0.8;
            color: var(--brand-navy);
        }

        .service-item.hidden {
            display: none;
        }

        /* Clients Section Styles */
        .clients-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .clients-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .clients-actions a {
            color: #000;
            font-weight: 500;
            font-size: 14px;
            text-decoration: underline;
        }

        .clients-actions button {
            padding: 8px 16px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
        }

        .clients-stats-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-top: 1px solid var(--grey);
            border-bottom: 1px solid var(--grey);
            margin-bottom: 20px;
            font-size: 14px;
        }

        .clients-stats-line span b {
            font-weight: 700;
        }

        .add-filter {
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: underline;
            color: #000;
            font-weight: 500;
            cursor: pointer;
        }

        .clients-search-container {
            position: relative;
            margin-bottom: 25px;
        }

        .clients-search-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark-grey);
            font-size: 18px;
        }

        .clients-search-container input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            background: #f1f1f1;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
        }

        .clients-table-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        .clients-table {
            width: 100%;
            border-collapse: collapse;
        }

        .clients-table th {
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            padding: 12px 0;
            color: var(--dark);
        }

        .clients-table td {
            padding: 15px 0;
            border-top: 1px solid #f0f0f0;
            font-size: 14px;
        }

        .client-name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .client-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--dark-grey);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        .marketing-pill {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin-right: 5px;
            background: #f0f0f0;
            color: #888;
        }

        .marketing-pill.active {
            background: #e8f5e9;
            color: #2e7d32;
        }

        /* Updated Staff Profile Layout */
        #staff-profile-panel {
            position: fixed;
            top: 0;
            right: -100%; /* Hidden by default */
            width: 100%;
            max-width: 1300px;
            height: 100%;
            background: var(--light);
            box-shadow: -2px 0 8px rgba(0,0,0,0.15);
            z-index: 999;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .staff-profile-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow: hidden; /* Main body should not scroll */
        }

        .staff-profile-info-header {
            padding: 20px 20px 0 20px;
            background: #fff;
            flex-shrink: 0;
        }

        .staff-profile-scroll-area {
            padding: 0 20px 20px 20px;
            overflow-y: auto;
            flex: 1;
            background: #fdfdfd;
        }

        .staff-profile-footer {
            padding: 12px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            background: #fff;
            flex-shrink: 0;
        }

        /* Staff Profile Cards */
        .info-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        
        .info-card-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media screen and (max-width: 600px) {
            .info-card-grid {
                grid-template-columns: 1fr;
            }
            #staff-profile-panel {
                max-width: 100%;
            }
            .staff-profile-info-header h2 {
                font-size: 20px !important;
            }
            .color-picker-container {
                gap: 8px;
            }
            .color-circle {
                width: 28px;
                height: 28px;
            }
        }
        .info-field-label {
            font-size: 13px;
            font-weight: 500;
            color: #666;
            margin-bottom: 8px;
            display: block;
        }
        .info-input, .info-select, .info-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            background: #f9f9f9;
            outline: none;
            transition: border-color 0.2s;
        }
        .info-textarea:focus {
            border-color: #9b5de5;
        }

        /* Services Table Styles */
        .services-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            color: #444;
        }
        .services-table th {
            font-weight: 500;
            color: #666;
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            text-align: center;
            vertical-align: bottom;
            white-space: nowrap;
        }
        .services-table td {
            padding: 14px 10px;
            border-bottom: 1px solid #f9f9f9;
            text-align: center;
        }
        .services-table .service-name {
            text-align: left;
            font-weight: 400;
            color: #333;
            min-width: 200px;
        }
        .status-assignable {
            color: #4a90e2;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-customize {
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 6px 12px;
            font-size: 12px;
            color: #555;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-customize:hover {
            background: #e8e8e8;
        }
        .color-picker-container {
            display: flex;
            gap: 12px;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        .color-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: transform 0.2s, border-color 0.2s;
        }
        .color-circle:hover {
            transform: scale(1.1);
        }
        .color-circle.selected {
            border-color: #000;
            transform: scale(1.1);
            box-shadow: 0 0 0 2px #fff inset;
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
				<a href="#" data-section="clients">
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

        <!-- Clients Section (blank list) -->
        <div id="clients-section" style="display: none;">
            <div class="clients-header">
                <h1>Clients</h1>
                <div class="clients-actions">
                    <a href="#">Export</a>
                    <a href="#">Merge clients</a>
                    <button>Add client</button>
                </div>
            </div>

            <div class="clients-stats-line">
                <span><b>0 clients</b> in your directory</span>
                <div class="add-filter">
                    <i class='bx bx-filter'></i>
                    <span>Add filter</span>
                </div>
            </div>

            <div class="clients-search-container">
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search for a name, phone number or email">
            </div>

            <div class="clients-table-container">
                <table class="clients-table">
                    <thead>
                        <tr>
                            <th style="width: 35%;">Client name</th>
                            <th style="width: 20%;">Marketing Status</th>
                            <th style="width: 20%;">Phone number</th>
                            <th style="width: 25%;">Email</th>
                        </tr>
                    </thead>
                    <tbody id="clients-table-body">
                        <!-- Blank for now as requested -->
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--dark-grey); padding: 40px 0;">
                                No clients found in your directory.
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                    <div class="services-header">
                        <h3>Services</h3>
                        
                        <div class="services-search">
                            <i class='bx bx-search'></i>
                            <input type="text" id="service-search-input" placeholder="Search for a service...">
                        </div>

                        <div class="services-filters">
                            <div class="filter-pill active" data-category="all">All</div>
                            <div class="filter-pill" data-category="Face Fixes">Face Fixes</div>
                            <div class="filter-pill" data-category="Body Fixes">Body Fixes</div>
                            <div class="filter-pill" data-category="Skin Fixes">Skin Fixes</div>
                            <div class="filter-pill" data-category="Laser Hair Removal">Laser Hair</div>
                            <div class="filter-pill" data-category="Radiofrequency Microneedling">RF Microneedling</div>
                            <div class="filter-pill" data-category="Hydrafacial">Hydrafacial</div>
                            <div class="filter-pill" data-category="Chemical Peels">Peels</div>
                            <div class="filter-pill" data-category="VI Peels">VI Peels</div>
                            <div class="filter-pill" data-category="Skin Boosters & Wellness">Wellness</div>
                            <div class="filter-pill" data-category="Add Ons">Add Ons</div>
                        </div>
                    </div>

                    <div class="services-list">
                        <!-- Face Fixes -->
                        <div class="service-item" data-service="Botox / Botox Facial" data-category="Face Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Botox / Botox Facial</span>
                                <span class="service-category">Face Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$14</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Sculptra" data-category="Face Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Sculptra</span>
                                <span class="service-category">Face Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$950</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Lip Filler" data-category="Face Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Lip Filler</span>
                                <span class="service-category">Face Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$650</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Eye Filler" data-category="Face Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Eye Filler</span>
                                <span class="service-category">Face Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$750</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Cheek Filler" data-category="Face Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Cheek Filler</span>
                                <span class="service-category">Face Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$850</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Nose Filler" data-category="Face Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Nose Filler</span>
                                <span class="service-category">Face Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$795</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Jawline Filler" data-category="Face Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Jawline Filler</span>
                                <span class="service-category">Face Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$795</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Neck Filler" data-category="Face Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Neck Filler</span>
                                <span class="service-category">Face Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$795</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- Body Fixes -->
                        <div class="service-item" data-service="Radiesse" data-category="Body Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Radiesse</span>
                                <span class="service-category">Body Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$950</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Sculptra Skinny BBL" data-category="Body Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Sculptra Skinny BBL</span>
                                <span class="service-category">Body Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$895</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Traptox" data-category="Body Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Traptox</span>
                                <span class="service-category">Body Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$895</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Cutera Secret" data-category="Body Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Cutera Secret</span>
                                <span class="service-category">Body Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$895</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Sofwave (Body)" data-category="Body Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Sofwave</span>
                                <span class="service-category">Body Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$495</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- Skin Fixes -->
                        <div class="service-item" data-service="Laser Facials" data-category="Skin Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Laser Facials</span>
                                <span class="service-category">Skin Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$495</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Hydrafacial" data-category="Skin Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Hydrafacial</span>
                                <span class="service-category">Skin Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$250</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="VI Peel" data-category="Skin Fixes">
                            <div class="service-main-info">
                                <span class="service-title">VI Peel</span>
                                <span class="service-category">Skin Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$399</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Cosmelan" data-category="Skin Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Cosmelan</span>
                                <span class="service-category">Skin Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$995</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Sofwave (Skin)" data-category="Skin Fixes">
                            <div class="service-main-info">
                                <span class="service-title">Sofwave</span>
                                <span class="service-category">Skin Fixes</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$495</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- Laser Hair Removal -->
                        <div class="service-item" data-service="Laser Acne Facial" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Laser Acne Facial</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$495</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Laser Roscea Facial" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Laser Roscea Facial</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$495</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Laser Resurfacing Facial" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Laser Resurfacing Facial</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$795</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Upper Lip Laser Hair Removal" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Upper Lip Laser Hair Removal</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$29</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Eyebrows" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Eyebrows</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Sideburns" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Sideburns</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Full Back" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Full Back</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$400</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Pantyline" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Pantyline</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$150</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Neck" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Neck</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$299</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Full Face Laser Hair Removal" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Full Face Laser Hair Removal</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$299</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Hands and fingers" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Hands and fingers</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Full Chest" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Full Chest</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$250</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Happy Trail" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Happy Trail</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Areolas" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Areolas</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Forehead" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Forehead</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Jawline" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Jawline</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Underarms" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Underarms</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$175</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Limited Time $99 Upper Lip" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Limited Time $99 Upper Lip</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Feet & Toes" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Feet & Toes</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Full Brazilian" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Full Brazilian</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$250</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Ears" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Ears</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Full Body Laser Hair Removal" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Full Body Laser Hair Removal</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$1299</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Pony Tail Laser" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Pony Tail Laser</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$125</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Full Abs" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Full Abs</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$300</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Full Legs" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Full Legs</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$450</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Cheeks" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Cheeks</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Chin" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Chin</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$99</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Buttocks" data-category="Laser Hair Removal">
                            <div class="service-main-info">
                                <span class="service-title">Buttocks</span>
                                <span class="service-category">Laser Hair Removal</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$299</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- Radiofrequency Microneedling -->
                        <div class="service-item" data-service="Full Face" data-category="Radiofrequency Microneedling">
                            <div class="service-main-info">
                                <span class="service-title">Full Face</span>
                                <span class="service-category">Radiofrequency Microneedling</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$495</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Neck" data-category="Radiofrequency Microneedling">
                            <div class="service-main-info">
                                <span class="service-title">Neck</span>
                                <span class="service-category">Radiofrequency Microneedling</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$495</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Arms" data-category="Radiofrequency Microneedling">
                            <div class="service-main-info">
                                <span class="service-title">Arms</span>
                                <span class="service-category">Radiofrequency Microneedling</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$595</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Abdomen" data-category="Radiofrequency Microneedling">
                            <div class="service-main-info">
                                <span class="service-title">Abdomen</span>
                                <span class="service-category">Radiofrequency Microneedling</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$1100</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Bra Far Sculp" data-category="Radiofrequency Microneedling">
                            <div class="service-main-info">
                                <span class="service-title">Bra Far Sculp</span>
                                <span class="service-category">Radiofrequency Microneedling</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$695</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Legs" data-category="Radiofrequency Microneedling">
                            <div class="service-main-info">
                                <span class="service-title">Legs</span>
                                <span class="service-category">Radiofrequency Microneedling</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$1500</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- Hydrafacial -->
                        <div class="service-item" data-service="Signature Hydrafacial" data-category="Hydrafacial">
                            <div class="service-main-info">
                                <span class="service-title">Signature Hydrafacial</span>
                                <span class="service-category">Hydrafacial</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$250</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Dior Hydrafacial" data-category="Hydrafacial">
                            <div class="service-main-info">
                                <span class="service-title">Dior Hydrafacial</span>
                                <span class="service-category">Hydrafacial</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$399</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Keravive Hydrafacial (Hair)" data-category="Hydrafacial">
                            <div class="service-main-info">
                                <span class="service-title">Keravive Hydrafacial (Hair)</span>
                                <span class="service-category">Hydrafacial</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$450</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Underarm Hydrafacial" data-category="Hydrafacial">
                            <div class="service-main-info">
                                <span class="service-title">Underarm Hydrafacial</span>
                                <span class="service-category">Hydrafacial</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$199</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Back Hydrafacial" data-category="Hydrafacial">
                            <div class="service-main-info">
                                <span class="service-title">Back Hydrafacial</span>
                                <span class="service-category">Hydrafacial</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$375</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- Chemical Peels -->
                        <div class="service-item" data-service="BioRepeel" data-category="Chemical Peels">
                            <div class="service-main-info">
                                <span class="service-title">BioRepeel</span>
                                <span class="service-category">Chemical Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$295</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Face & Neck" data-category="Chemical Peels">
                            <div class="service-main-info">
                                <span class="service-title">Face & Neck</span>
                                <span class="service-category">Chemical Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$225</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Back" data-category="Chemical Peels">
                            <div class="service-main-info">
                                <span class="service-title">Back</span>
                                <span class="service-category">Chemical Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$275</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Underarms" data-category="Chemical Peels">
                            <div class="service-main-info">
                                <span class="service-title">Underarms</span>
                                <span class="service-category">Chemical Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$175</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Intimate Area" data-category="Chemical Peels">
                            <div class="service-main-info">
                                <span class="service-title">Intimate Area</span>
                                <span class="service-category">Chemical Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$195</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- VI Peels -->
                        <div class="service-item" data-service="Acne VI Peel" data-category="VI Peels">
                            <div class="service-main-info">
                                <span class="service-title">Acne VI Peel</span>
                                <span class="service-category">VI Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$350</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Acne Scarring VI Peel" data-category="VI Peels">
                            <div class="service-main-info">
                                <span class="service-title">Acne Scarring VI Peel</span>
                                <span class="service-category">VI Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$350</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Rosacea Peel" data-category="VI Peels">
                            <div class="service-main-info">
                                <span class="service-title">Rosacea Peel</span>
                                <span class="service-category">VI Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$350</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Sensitive Skin Peel" data-category="VI Peels">
                            <div class="service-main-info">
                                <span class="service-title">Sensitive Skin Peel</span>
                                <span class="service-category">VI Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$350</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="VI Hyperpigmentation Peel" data-category="VI Peels">
                            <div class="service-main-info">
                                <span class="service-title">VI Hyperpigmentation Peel</span>
                                <span class="service-category">VI Peels</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$350</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- Skin Boosters and Wellness -->
                        <div class="service-item" data-service="Salmon DNA" data-category="Skin Boosters & Wellness">
                            <div class="service-main-info">
                                <span class="service-title">Salmon DNA</span>
                                <span class="service-category">Skin Boosters & Wellness</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$450</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Exosomes" data-category="Skin Boosters & Wellness">
                            <div class="service-main-info">
                                <span class="service-title">Exosomes</span>
                                <span class="service-category">Skin Boosters & Wellness</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$595</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>

                        <!-- Add Ons -->
                        <div class="service-item" data-service="Hydrafacial Skin Booster" data-category="Add Ons">
                            <div class="service-main-info">
                                <span class="service-title">Hydrafacial Skin Booster</span>
                                <span class="service-category">Add Ons</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$75</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Dermaplanning" data-category="Add Ons">
                            <div class="service-main-info">
                                <span class="service-title">Dermaplanning</span>
                                <span class="service-category">Add Ons</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$70</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Red Light Therapy" data-category="Add Ons">
                            <div class="service-main-info">
                                <span class="service-title">Red Light Therapy</span>
                                <span class="service-category">Add Ons</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$50</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                        <div class="service-item" data-service="Blue Light Therapy" data-category="Add Ons">
                            <div class="service-main-info">
                                <span class="service-title">Blue Light Therapy</span>
                                <span class="service-category">Add Ons</span>
                            </div>
                            <div class="service-right">
                                <span class="service-price">$50</span>
                                <i class='bx bx-edit-alt service-actions'></i>
                            </div>
                        </div>
                    </div>
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
        <div id="service-profile-panel" style="position:fixed; top:0; right:-900px; width:900px; height:100%; background:var(--light); box-shadow:-2px 0 8px rgba(0,0,0,0.15); z-index:997; transition:right 0.3s ease; display:flex; flex-direction:column;">
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
                    <table style="width:100%; border-collapse:collapse; margin-top:16px;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--grey);">
                                <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);"></th>
                                <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Price</th>
                                <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Duration</th>
                                <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Processing Time</th>
                                <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Finishing Time</th>
                                <th style="text-align:left; padding:12px 8px; font-size:12px; font-weight:600; color:var(--dark-grey);">Transition Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom:1px solid var(--grey);">
                                <td style="padding:12px 8px; display:flex; align-items:center; gap:12px; padding-left:40px;">
                                    <label class="service-toggle" style="position:relative; display:inline-block; width:44px; height:24px; cursor:pointer;">
                                        <input type="checkbox" checked style="opacity:0; width:0; height:0;">
                                        <span class="toggle-track" style="position:absolute; top:0; left:0; right:0; bottom:0; background-color:#9b5de5; border-radius:24px; transition:0.3s;"></span>
                                        <span class="toggle-thumb" style="position:absolute; top:2px; left:2px; width:20px; height:20px; background-color:#fff; border-radius:50%; transition:0.3s; transform:translateX(20px);"></span>
                                    </label>
                                    <span style="font-size:14px; color:var(--dark-grey); font-style:italic;">Ayla K</span>
                                </td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark);">$99.00</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">10 mins</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">5 mins</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--grey);">
                                <td style="padding:12px 8px; display:flex; align-items:center; gap:12px; padding-left:40px;">
                                    <label class="service-toggle" style="position:relative; display:inline-block; width:44px; height:24px; cursor:pointer;">
                                        <input type="checkbox" checked style="opacity:0; width:0; height:0;">
                                        <span class="toggle-track" style="position:absolute; top:0; left:0; right:0; bottom:0; background-color:#9b5de5; border-radius:24px; transition:0.3s;"></span>
                                        <span class="toggle-thumb" style="position:absolute; top:2px; left:2px; width:20px; height:20px; background-color:#fff; border-radius:50%; transition:0.3s; transform:translateX(20px);"></span>
                                    </label>
                                    <span style="font-size:14px; color:var(--dark-grey); font-style:italic;">Jodie X</span>
                                </td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark);">$99.00</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">10 mins</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">5 mins</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--grey);">
                                <td style="padding:12px 8px; display:flex; align-items:center; gap:12px; padding-left:40px;">
                                    <label class="service-toggle" style="position:relative; display:inline-block; width:44px; height:24px; cursor:pointer;">
                                        <input type="checkbox" checked style="opacity:0; width:0; height:0;">
                                        <span class="toggle-track" style="position:absolute; top:0; left:0; right:0; bottom:0; background-color:#9b5de5; border-radius:24px; transition:0.3s;"></span>
                                        <span class="toggle-thumb" style="position:absolute; top:2px; left:2px; width:20px; height:20px; background-color:#fff; border-radius:50%; transition:0.3s; transform:translateX(20px);"></span>
                                    </label>
                                    <span style="font-size:14px; color:var(--dark-grey); font-style:italic;">Laser Room #1</span>
                                </td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark);">$99.00</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">10 mins</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">5 mins</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--grey);">
                                <td style="padding:12px 8px; display:flex; align-items:center; gap:12px; padding-left:40px;">
                                    <label class="service-toggle" style="position:relative; display:inline-block; width:44px; height:24px; cursor:pointer;">
                                        <input type="checkbox" style="opacity:0; width:0; height:0;">
                                        <span class="toggle-track" style="position:absolute; top:0; left:0; right:0; bottom:0; background-color:#ccc; border-radius:24px; transition:0.3s;"></span>
                                        <span class="toggle-thumb" style="position:absolute; top:2px; left:2px; width:20px; height:20px; background-color:#fff; border-radius:50%; transition:0.3s;"></span>
                                    </label>
                                    <span style="font-size:14px; color:var(--dark-grey); font-style:italic;">Rina Rai</span>
                                </td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark);">$99.00</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">10 mins</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">5 mins</td>
                            </tr>
                            <tr>
                                <td style="padding:12px 8px; display:flex; align-items:center; gap:12px; padding-left:40px;">
                                    <label class="service-toggle" style="position:relative; display:inline-block; width:44px; height:24px; cursor:pointer;">
                                        <input type="checkbox" style="opacity:0; width:0; height:0;">
                                        <span class="toggle-track" style="position:absolute; top:0; left:0; right:0; bottom:0; background-color:#ccc; border-radius:24px; transition:0.3s;"></span>
                                        <span class="toggle-thumb" style="position:absolute; top:2px; left:2px; width:20px; height:20px; background-color:#fff; border-radius:50%; transition:0.3s;"></span>
                                    </label>
                                    <span style="font-size:14px; color:var(--dark-grey); font-style:italic;">Raj Rai</span>
                                </td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark);">$99.00</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">10 mins</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey);">-</td>
                                <td style="padding:12px 8px; font-size:14px; color:var(--dark-grey); font-style:italic;">5 mins</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="padding:12px 20px; border-top:1px solid var(--grey); display:flex; justify-content:flex-end; gap:8px;">
                <button id="service-staff-save" style="padding:8px 14px; border:none; background:#000; color:#fff; border-radius:4px; cursor:pointer;">Save changes</button>
            </div>
        </div>

        <!-- Sliding Staff Profile Panel -->
        <div id="staff-profile-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.35); z-index:998;"></div>
        <div id="staff-profile-panel">
            <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 20px; background:#222; color:#fff; flex-shrink:0;">
                <div style="font-weight:600;">Staff Profile</div>
                <button id="staff-profile-close" style="background:transparent; border:none; color:#fff; font-size:20px; cursor:pointer;">&times;</button>
            </div>
            <div class="staff-profile-body">
                <div class="staff-profile-info-header">
                    <h2 id="staff-profile-name" style="margin:0 0 16px 0; font-size:22px;">Staff Name</h2>

                    <!-- Sub-tabs under Personal information -->
                    <div style="display:flex; gap:24px; border-bottom:1px solid var(--grey); margin-bottom:0;">
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
                </div>

                <div class="staff-profile-scroll-area">

                <!-- Personal Info Content -->
                <div id="staff-panel-personal" class="staff-panel-section" style="display:block;">
                    <div class="info-card">
                        <div class="info-card-grid">
                            <div>
                                <label class="info-field-label">First name</label>
                                <input id="staff-profile-firstname" type="text" class="info-input">
                            </div>
                            <div>
                                <label class="info-field-label">Last name</label>
                                <input id="staff-profile-lastname" type="text" class="info-input">
                            </div>
                            <div>
                                <label class="info-field-label">Staff role</label>
                                <input id="staff-profile-role" type="text" class="info-input">
                            </div>
                            <div>
                                <label class="info-field-label">Alias</label>
                                <input id="staff-profile-alias" type="text" class="info-input">
                            </div>
                            <div>
                                <label class="info-field-label">Email</label>
                                <input id="staff-profile-email" type="email" class="info-input">
                            </div>
                            <div>
                                <label class="info-field-label">Phone</label>
                                <input id="staff-profile-phone" type="text" class="info-input">
                            </div>
                        </div>
                    </div>

                    <!-- Permissions Section -->
                    <div class="info-card">
                        <div class="info-card-title">Permissions</div>
                        <div class="info-card-grid">
                            <div>
                                <label class="info-field-label">Permission group *</label>
                                <select id="staff-profile-permission-group" class="info-select">
                                    <option value="admin">Admin</option>
                                    <option value="provider">Service Provider</option>
                                    <option value="frontdesk">Front Desk</option>
                                </select>
                            </div>
                            <div>
                                <label class="info-field-label">Assigned locations</label>
                                <select id="staff-profile-location" class="info-select">
                                    <option value="renton">Renton</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Calendar Display Section -->
                    <div class="info-card">
                        <div class="info-card-title">Calendar display</div>
                        <div style="margin-bottom: 20px;">
                            <label class="info-field-label">Internal display name *</label>
                            <input id="staff-profile-display-name" type="text" class="info-input" style="max-width: 350px;">
                        </div>
                        <div>
                            <label class="info-field-label">Color on calendar</label>
                            <div class="color-picker-container" id="staff-calendar-colors">
                                <div class="color-circle selected" style="background: #00bcd4;" data-color="#00bcd4"></div>
                                <div class="color-circle" style="background: #9b5de5;" data-color="#9b5de5"></div>
                                <div class="color-circle" style="background: #2ecc71;" data-color="#2ecc71"></div>
                                <div class="color-circle" style="background: #f39c12;" data-color="#f39c12"></div>
                                <div class="color-circle" style="background: #e91e63;" data-color="#e91e63"></div>
                                <div class="color-circle" style="background: #8bc34a;" data-color="#8bc34a"></div>
                                <div class="color-circle" style="background: #2196f3;" data-color="#2196f3"></div>
                                <div class="color-circle" style="background: #009688;" data-color="#009688"></div>
                                <div class="color-circle" style="background: #ef5350;" data-color="#ef5350"></div>
                                <div class="color-circle" style="background: #ce93d8;" data-color="#ce93d8"></div>
                                <div class="color-circle" style="background: #ffd54f;" data-color="#ffd54f"></div>
                                <div class="color-circle" style="background: #a1887f;" data-color="#a1887f"></div>
                                <div class="color-circle" style="background: #607d8b;" data-color="#607d8b"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Biography Section -->
                    <div class="info-card">
                        <div class="info-card-title">Biography</div>
                        <div>
                            <label class="info-field-label">Bio</label>
                            <textarea id="staff-profile-bio" class="info-textarea" rows="4" placeholder="Brief biography of the staff member..."></textarea>
                        </div>
                    </div>
                </div>
                <div id="staff-panel-services" class="staff-panel-section" style="display:none;">
                    <div style="margin-top:20px; overflow-x:auto;">
                        <table class="services-table">
                            <thead>
                                <tr>
                                    <th class="service-name"></th>
                                    <th></th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Processing Time</th>
                                    <th>Finishing Time</th>
                                    <th>Transition Time</th>
                                    <th>Business charge</th>
                                    <th>Commission percentage</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><th colspan="10" style="padding:12px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Face Fixes</th></tr>
                                <tr><td class="service-name">Botox / Botox Facial</td><td><a class="status-assignable">Assignable</a></td><td>$14.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Sculptra</td><td><a class="status-assignable">Assignable</a></td><td>$950.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Lip Filler</td><td><a class="status-assignable">Assignable</a></td><td>$650.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Eye Filler</td><td><a class="status-assignable">Assignable</a></td><td>$750.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Cheek Filler</td><td><a class="status-assignable">Assignable</a></td><td>$850.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Nose Filler</td><td><a class="status-assignable">Assignable</a></td><td>$795.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Jawline Filler</td><td><a class="status-assignable">Assignable</a></td><td>$795.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Neck Filler</td><td><a class="status-assignable">Assignable</a></td><td>$795.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Body Fixes</th></tr>
                                <tr><td class="service-name">Radiesse</td><td><a class="status-assignable">Assignable</a></td><td>$950.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Sculptra Skinny BBL</td><td><a class="status-assignable">Assignable</a></td><td>$895.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Traptox</td><td><a class="status-assignable">Assignable</a></td><td>$895.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Cutera Secret</td><td><a class="status-assignable">Assignable</a></td><td>$895.00</td><td>1 hr</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Sofwave</td><td><a class="status-assignable">Assignable</a></td><td>$495.00</td><td>1 hr</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Skin Fixes</th></tr>
                                <tr><td class="service-name">Laser Facials</td><td><a class="status-assignable">Assignable</a></td><td>$495.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Hydrafacial</td><td><a class="status-assignable">Assignable</a></td><td>$250.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">VI Peel</td><td><a class="status-assignable">Assignable</a></td><td>$399.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Cosmelan</td><td><a class="status-assignable">Assignable</a></td><td>$995.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Sofwave</td><td><a class="status-assignable">Assignable</a></td><td>$495.00</td><td>1 hr</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Laser Hair Removal</th></tr>
                                <tr><td class="service-name">Laser Acne Facial</td><td><a class="status-assignable">Assignable</a></td><td>$495.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Laser Roscea Facial</td><td><a class="status-assignable">Assignable</a></td><td>$495.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Laser Resurfacing Facial</td><td><a class="status-assignable">Assignable</a></td><td>$795.00</td><td>1 hr</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Upper Lip Laser Hair Removal</td><td><a class="status-assignable">Assignable</a></td><td>$29.00</td><td>10 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Eyebrows</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Sideburns</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Full Back</td><td><a class="status-assignable">Assignable</a></td><td>$400.00</td><td>45 mins</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Pantyline</td><td><a class="status-assignable">Assignable</a></td><td>$150.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Neck</td><td><a class="status-assignable">Assignable</a></td><td>$299.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Half Leg</td><td><a class="status-assignable">Assignable</a></td><td>$250.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Full Leg</td><td><a class="status-assignable">Assignable</a></td><td>$450.00</td><td>1 hr</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Half Arm</td><td><a class="status-assignable">Assignable</a></td><td>$150.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Full Arm</td><td><a class="status-assignable">Assignable</a></td><td>$300.00</td><td>45 mins</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Underarms</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Chin</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Buttocks</td><td><a class="status-assignable">Assignable</a></td><td>$299.00</td><td>45 mins</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Full Face Laser Hair Removal</td><td><a class="status-assignable">Assignable</a></td><td>$299.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Hands and fingers</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Full Chest</td><td><a class="status-assignable">Assignable</a></td><td>$250.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Happy Trail</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Areolas</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Forehead</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Jawline</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Limited Time $99 Upper Lip</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>10 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Feet &amp; Toes</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Full Brazilian</td><td><a class="status-assignable">Assignable</a></td><td>$250.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Ears</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Full Body Laser Hair Removal</td><td><a class="status-assignable">Assignable</a></td><td>$1299.00</td><td>2 hr</td><td>-</td><td>-</td><td>15 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Pony Tail Laser</td><td><a class="status-assignable">Assignable</a></td><td>$125.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Full Abs</td><td><a class="status-assignable">Assignable</a></td><td>$300.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Cheeks</td><td><a class="status-assignable">Assignable</a></td><td>$99.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Radiofrequency Microneedling</th></tr>
                                <tr><td class="service-name">Full Face</td><td><a class="status-assignable">Assignable</a></td><td>$495.00</td><td>1 hr</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Neck</td><td><a class="status-assignable">Assignable</a></td><td>$495.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Arms</td><td><a class="status-assignable">Assignable</a></td><td>$595.00</td><td>1 hr</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Bra Far Sculp</td><td><a class="status-assignable">Assignable</a></td><td>$695.00</td><td>1 hr</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Legs</td><td><a class="status-assignable">Assignable</a></td><td>$1500.00</td><td>2 hr</td><td>-</td><td>-</td><td>15 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Hydrafacial</th></tr>
                                <tr><td class="service-name">Signature Hydrafacial</td><td><a class="status-assignable">Assignable</a></td><td>$250.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Dior Hydrafacial</td><td><a class="status-assignable">Assignable</a></td><td>$399.00</td><td>1 hr</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Keravive Hydrafacial (Hair)</td><td><a class="status-assignable">Assignable</a></td><td>$450.00</td><td>1 hr</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Neck Hydrafacial</td><td><a class="status-assignable">Assignable</a></td><td>$150.00</td><td>20 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Hands Hydrafacial</td><td><a class="status-assignable">Assignable</a></td><td>$75.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Back Hydrafacial</td><td><a class="status-assignable">Assignable</a></td><td>$375.00</td><td>45 mins</td><td>-</td><td>-</td><td>10 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Chemical Peels</th></tr>
                                <tr><td class="service-name">BioRepeel</td><td><a class="status-assignable">Assignable</a></td><td>$295.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Face &amp; Neck</td><td><a class="status-assignable">Assignable</a></td><td>$225.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Back</td><td><a class="status-assignable">Assignable</a></td><td>$275.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Intimate Area</td><td><a class="status-assignable">Assignable</a></td><td>$195.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">VI Peels</th></tr>
                                <tr><td class="service-name">Acne VI Peel</td><td><a class="status-assignable">Assignable</a></td><td>$350.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Acne Scarring VI Peel</td><td><a class="status-assignable">Assignable</a></td><td>$350.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Rosacea Peel</td><td><a class="status-assignable">Assignable</a></td><td>$350.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">VI Hyperpigmentation Peel</td><td><a class="status-assignable">Assignable</a></td><td>$350.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Skin Boosters &amp; Wellness</th></tr>
                                <tr><td class="service-name">Salmon DNA</td><td><a class="status-assignable">Assignable</a></td><td>$450.00</td><td>30 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Exosomes</td><td><a class="status-assignable">Assignable</a></td><td>$595.00</td><td>45 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>

                                <tr><th colspan="10" style="padding:18px 8px 6px 8px; text-align:left; font-size:15px; color:#333;">Add Ons</th></tr>
                                <tr><td class="service-name">Hydrafacial Skin Booster</td><td><a class="status-assignable">Assignable</a></td><td>$75.00</td><td>10 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Dermaplanning</td><td><a class="status-assignable">Assignable</a></td><td>$70.00</td><td>20 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Red Light Therapy</td><td><a class="status-assignable">Assignable</a></td><td>$50.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                                <tr><td class="service-name">Blue Light Therapy</td><td><a class="status-assignable">Assignable</a></td><td>$50.00</td><td>15 mins</td><td>-</td><td>-</td><td>5 mins</td><td>$0.00</td><td>Pay Rate Default</td><td><button class="btn-customize">Customize</button></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Appointments Content -->
                <div id="staff-panel-appointments" class="staff-panel-section" style="display:none;">
                    <p style="margin-top:8px; color:var(--dark-grey); font-size:14px;">View upcoming and past appointments for this staff member.</p>
                </div>
            </div>
            <div class="staff-profile-footer">
                <button id="staff-deactivate-btn" style="padding:8px 14px; border:1px solid #d00; background:transparent; color:#d00; border-radius:4px; cursor:pointer; font-weight:500;">Deactivate</button>
                <button id="staff-profile-save-btn" style="padding:8px 24px; border:none; background:#000; color:#fff; border-radius:4px; cursor:pointer; font-weight:500;">Save changes</button>
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
        let serviceRows = document.querySelectorAll('.service-item');
        const serviceSearchInput = document.getElementById('service-search-input');
        const filterPills = document.querySelectorAll('.filter-pill');

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

                const clientsSection = document.getElementById('clients-section');

                if (section === 'frontdesk') {
                    if (frontdeskSection) frontdeskSection.style.display = 'block';
                    if (manageSection) manageSection.style.display = 'none';
                    if (clientsSection) clientsSection.style.display = 'none';
                    if (manageSubmenu) manageSubmenu.style.display = 'none';
                } else if (section === 'clients') {
                    if (frontdeskSection) frontdeskSection.style.display = 'none';
                    if (manageSection) manageSection.style.display = 'none';
                    if (clientsSection) {
                        clientsSection.style.display = 'block';
                        fetchClients(); // Load clients when section is shown
                    }
                    if (manageSubmenu) manageSubmenu.style.display = 'none';
                } else if (section === 'manage') {
                    if (frontdeskSection) frontdeskSection.style.display = 'none';
                    if (clientsSection) clientsSection.style.display = 'none';
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
        const staffProfileDisplayName = document.getElementById('staff-profile-display-name');
        const staffProfileBio = document.getElementById('staff-profile-bio');
        const staffProfilePermissionGroup = document.getElementById('staff-profile-permission-group');
        const staffProfileLocation = document.getElementById('staff-profile-location');
        const colorCircles = document.querySelectorAll('.color-circle');

        // Color picker logic for calendar display
        colorCircles.forEach(circle => {
            circle.addEventListener('click', function() {
                colorCircles.forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

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

            // Reset new fields (or populate if data exists)
            if (staffProfileDisplayName) staffProfileDisplayName.value = name;
            if (staffProfileBio) staffProfileBio.value = ""; 
            if (staffProfilePermissionGroup) staffProfilePermissionGroup.value = "provider"; // Default
            if (staffProfileLocation) staffProfileLocation.value = "renton";

            // Default color selection
            colorCircles.forEach(c => {
                c.classList.remove('selected');
                if (c.getAttribute('data-color') === '#00bcd4') {
                    c.classList.add('selected');
                }
            });

            // Fetch current availability from DB for THIS staff member
            fetch(`api/api_staff_availability.php?staff=${encodeURIComponent(name)}`)
                .then(response => response.json())
                .then(data => {
                    const serviceRows = document.querySelectorAll('#staff-panel-services tbody tr');
                    serviceRows.forEach(row => {
                        const serviceCell = row.querySelector('td:nth-child(2)');
                        if (!serviceCell) return;
                        const serviceName = serviceCell.textContent.trim();
                        const checkbox = row.querySelector('input[type="checkbox"]');
                        if (!checkbox) return;
                        
                        const availability = data.find(item => item.service_name === serviceName);
                        if (availability) {
                            checkbox.checked = availability.is_available == 1;
                        } else {
                            checkbox.checked = false;
                        }
                    });
                    initializeServiceToggles('#staff-panel-services');
                });

            staffProfileOverlay.style.display = 'block';
            staffProfilePanel.style.right = '0';
        }

        function closeStaffProfile() {
            staffProfilePanel.style.right = '-100%';
            staffProfileOverlay.style.display = 'none';
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
            
            // Fetch current availability from DB
            fetch(`api/api_staff_availability.php?service=${encodeURIComponent(name)}`)
                .then(response => response.json())
                .then(data => {
                    const staffRows = document.querySelectorAll('#service-panel-staff tbody tr');
                    staffRows.forEach(row => {
                        const staffName = row.querySelector('span:not(.toggle-track):not(.toggle-thumb)').textContent.trim();
                        const checkbox = row.querySelector('input[type="checkbox"]');
                        const availability = data.find(item => item.staff_name === staffName);
                        
                        if (availability) {
                            checkbox.checked = availability.is_available == 1;
                        } else {
                            // Default to unchecked or maintain current state if not in DB
                        }
                    });
                    initializeServiceToggles();
                });
        }

        function closeServiceProfile() {
            serviceProfileOverlay.style.display = 'none';
            serviceProfilePanel.style.right = '-900px';
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

        // Service items click handlers
        function initializeServiceItemHandlers() {
            serviceRows = document.querySelectorAll('.service-item');
            serviceRows.forEach(item => {
                item.addEventListener('click', function (e) {
                    // Avoid triggering when clicking on the edit icon specifically if we want separate logic, 
                    // but for now both can open the profile.
                    openServiceProfile(item);
                });
            });
        }

        initializeServiceItemHandlers();

        // Search and Filter Logic
        if (serviceSearchInput) {
            serviceSearchInput.addEventListener('input', filterServices);
        }

        filterPills.forEach(pill => {
            pill.addEventListener('click', function() {
                filterPills.forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                filterServices();
            });
        });

        function filterServices() {
            const searchTerm = serviceSearchInput ? serviceSearchInput.value.toLowerCase() : '';
            const activeCategory = document.querySelector('.filter-pill.active').getAttribute('data-category');

            serviceRows.forEach(item => {
                const serviceName = item.getAttribute('data-service').toLowerCase();
                const serviceCategory = item.getAttribute('data-category');
                
                const matchesSearch = serviceName.includes(searchTerm);
                const matchesCategory = activeCategory === 'all' || serviceCategory === activeCategory;

                if (matchesSearch && matchesCategory) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        if (serviceProfileClose) {
            serviceProfileClose.addEventListener('click', closeServiceProfile);
        }
        if (serviceProfileOverlay) {
            serviceProfileOverlay.addEventListener('click', closeServiceProfile);
        }

        // Toggle switches inside Profile panels
        function initializeServiceToggles(containerSelector = '#service-panel-staff') {
            const serviceToggles = document.querySelectorAll(containerSelector + ' .service-toggle');
            serviceToggles.forEach(toggle => {
                const input = toggle.querySelector('input[type="checkbox"]');
                const track = toggle.querySelector('.toggle-track');
                const thumb = toggle.querySelector('.toggle-thumb');

                function applyToggleState() {
                    const isOn = input.checked;
                    if (isOn) {
                        if (track) track.style.backgroundColor = '#9b5de5';
                        if (thumb) thumb.style.transform = 'translateX(20px)';
                    } else {
                        if (track) track.style.backgroundColor = '#ccc';
                        if (thumb) thumb.style.transform = 'translateX(0)';
                    }
                }

                // Initialize state
                applyToggleState();

                // Toggle on click
                const toggleClickHandler = function(e) {
                    // avoid double toggling when clicking the hidden input
                    if (e.target.tagName.toLowerCase() !== 'input') {
                        input.checked = !input.checked;
                        applyToggleState();
                        e.preventDefault();
                        e.stopPropagation();
                    }
                };

                // Remove existing event listeners to avoid duplicates
                toggle.onclick = null; // Simple way to clear
                toggle.addEventListener('click', toggleClickHandler);
            });
        }
        // Profile panel tab switching
        if (staffTabPersonal) {
            staffTabPersonal.addEventListener('click', () => {
                staffTabPersonal.style.color = '#000';
                staffTabPersonal.style.borderBottom = '2px solid #000';
                staffTabPersonal.style.fontWeight = '600';
                staffTabServices.style.color = 'var(--dark-grey)';
                staffTabServices.style.borderBottom = '2px solid transparent';
                staffTabServices.style.fontWeight = '400';
                staffTabAppointments.style.color = 'var(--dark-grey)';
                staffTabAppointments.style.borderBottom = '2px solid transparent';
                staffTabAppointments.style.fontWeight = '400';
                staffPanelPersonal.style.display = 'block';
                staffPanelServices.style.display = 'none';
                staffPanelAppointments.style.display = 'none';
            });
        }
        if (staffTabServices) {
            staffTabServices.addEventListener('click', () => {
                staffTabServices.style.color = '#000';
                staffTabServices.style.borderBottom = '2px solid #000';
                staffTabServices.style.fontWeight = '600';
                staffTabPersonal.style.color = 'var(--dark-grey)';
                staffTabPersonal.style.borderBottom = '2px solid transparent';
                staffTabPersonal.style.fontWeight = '400';
                staffTabAppointments.style.color = 'var(--dark-grey)';
                staffTabAppointments.style.borderBottom = '2px solid transparent';
                staffTabAppointments.style.fontWeight = '400';
                staffPanelServices.style.display = 'block';
                staffPanelPersonal.style.display = 'none';
                staffPanelAppointments.style.display = 'none';
                initializeServiceToggles('#staff-panel-services');
            });
        }
        
        // Initialize the toggles when the page loads
        initializeServiceToggles();

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
                
                // Re-initialize the toggles when switching to the staff tab
                setTimeout(() => {
                    initializeServiceToggles();
                }, 100);
            });
        }

        // Save staff availability changes
        const saveBtn = document.getElementById('service-staff-save');
        if (saveBtn) {
            saveBtn.addEventListener('click', function() {
                const serviceName = serviceProfileName.textContent.trim();
                const staffData = [];
                const staffRows = document.querySelectorAll('#service-panel-staff tbody tr');
                
                staffRows.forEach(row => {
                    const staffName = row.querySelector('span:not(.toggle-track):not(.toggle-thumb)').textContent.trim();
                    const isAvailable = row.querySelector('input[type="checkbox"]').checked;
                    staffData.push({ name: staffName, available: isAvailable });
                });

                fetch('api/api_staff_availability.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ service: serviceName, staff: staffData })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        alert('Changes saved successfully!');
                    } else {
                        alert('Error saving changes.');
                    }
                });
            });
        }

        const staffSaveBtn = document.getElementById('staff-profile-save-btn');
        if (staffSaveBtn) {
            staffSaveBtn.addEventListener('click', function() {
                const staffName = staffProfileName.textContent.trim();
                const serviceRows = document.querySelectorAll('#staff-panel-services tbody tr');
                const availability = [];
                
                serviceRows.forEach(row => {
                    const serviceCell = row.querySelector('td:nth-child(2)');
                    if (!serviceCell) return;
                    const serviceName = serviceCell.textContent.trim();
                    const checkbox = row.querySelector('input[type="checkbox"]');
                    if (!checkbox) return;
                    
                    availability.push({
                        name: serviceName,
                        available: checkbox.checked
                    });
                });
                
                fetch('api/api_staff_availability.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        staff: staffName,
                        availability: availability
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Staff availability updated successfully');
                    } else {
                        alert('Error updating availability');
                    }
                });
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

            // Fetch clients on initial load if needed
            fetchClients();
            });

            function fetchClients() {
                const tableBody = document.getElementById('clients-table-body');
                const statsSpan = document.querySelector('.clients-stats-line span');
                
                if (!tableBody) return;

                fetch('api/api_get_clients.php')
                    .then(response => response.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            // Update count
                            if (statsSpan) {
                                statsSpan.innerHTML = `<b>${data.length} clients</b> in your directory`;
                            }

                            if (data.length === 0) {
                                tableBody.innerHTML = `
                                    <tr>
                                        <td colspan="4" style="text-align: center; color: var(--dark-grey); padding: 40px 0;">
                                            No clients found in your directory.
                                        </td>
                                    </tr>`;
                                return;
                            }

                            tableBody.innerHTML = '';
                            data.forEach(client => {
                                const initials = client.name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>
                                        <div class="client-name-cell">
                                            <div class="client-avatar">${initials}</div>
                                            <span>${client.name}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="marketing-pill active">Subscribed</span>
                                    </td>
                                    <td>${client.phone || '-'}</td>
                                    <td>${client.email || '-'}</td>
                                `;
                                tableBody.appendChild(row);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching clients:', error);
                    });
            }
    </script>
</body>
</html>
