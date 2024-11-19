<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style copy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .slideshow {
            position: relative;
            overflow: hidden;
            max-width: 100%;
            animation: fadeInFromLeft 1.5s ease;
        }

        .image__container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            border-radius: 10px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            transition: opacity 1s ease-in-out;
        }

        /* Add a class to the visible image container */
        .image__container.active {
            opacity: 1;
        }
        
    </style>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --text-color: #ecf0f1;
            --card-bg: rgba(255, 255, 255, 0.1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--primary-color);
            color: var(--text-color);
        }

        .slideshow {
            position: relative;
            height: 400px;
            margin-bottom: 2rem;
        }

        .image__container {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            border-radius: 15px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            transition: opacity 1s ease-in-out;
        }

        .image__container.active {
            opacity: 1;
        }

        .image__container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        /* Add slide indicators */
        .slide-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 1;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .indicator.active {
            background: var(--secondary-color);
        }

        /* Add this to your existing styles */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card i {
            font-size: 2.5em;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .stat-card .number {
            font-size: 2em;
            font-weight: bold;
            color: var(--text-color);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
            margin-top: 2rem;
        }

        .grid-item {
            background: var(--card-bg);
            padding: 1.5rem;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .activity-list {
            margin-top: 1rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .activity-item i {
            font-size: 1.5em;
            color: var(--secondary-color);
            margin-right: 1rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-time {
            font-size: 0.8em;
            color: rgba(255, 255, 255, 0.6);
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .action-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .action-btn:hover {
            background: transparent;
            border: 1px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .quick-stats {
                grid-template-columns: 1fr 1fr;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="../images/logo_1_criwwp-removebg-preview.png" class="logo">
    <i class="fa fa-chevron-left menu-icon"></i>
    <ul class="sidenav">
        <li class="active"><i class="fa fa-home"></i><a href="#"> Dashboard
            <span class="span1"><i class="fa fa-angle-right"></i></span>
        </a>
        </li>
        <ul class="dropdown">
            <li><a href="admin_dashboard.php"><span class="dot"></span> Admin</a></li>
            <li><a href="../employee/empdashboard.php"><span class="dot"></span> Employee</a></li>
            <li><a href="../tenant/tenant_dashboard.php"><span class="dot"></span> Tenant</a></li>
        </ul>
        <p class="app">Admin Control</p>
        <li><i class="fa fa-calendar"></i><a href="viewtenant.php"> Tenant Details</a></li>
        <li><i class="fa fa-clone"></i><a href="createtenant.php"> Create Tenant</a></li>
        <li><i class="fa fa-user"></i><a href="viewrequest.php"> Services</a></li>
        <li><i class="fa fa-shield"></i><a href="fees.php"> Fees</a></li>
        <li><i class="fa fa-shield"></i><a href="../admin/complaints.php"> Complaints</a></li>
        <li><i class="fa fa-file-text"></i><a href="export.php"> Export Data</a></li>
        <li><i class="fa fa-square-o"></i><a href="../"> Logout</a></li>
    </ul>
</div>

<div class="main">
    <div class="main-top">
        <input type="text" name="" class="input" placeholder="Search">
        <div class="top-right">
            <i class="fa fa-bell-o topicon bell"></i>
            <div class="notification-div">
                <p>Success! Your registration is now complete!</p>
                <p>Here's some information you may find useful!</p>           
            </div>

            <a href="#" class="user1"><img src="image/user.png" class="user">
                <div class="profile-div">
                    <p><i class="fa fa-user"></i> &nbsp;&nbsp;Profile</p>
                    <p><i class="fa fa-cog"></i> &nbsp;&nbsp;Settings</p>
                    <p><i class="fa fa-power-off"></i> &nbsp;&nbsp;Log Out</p>
                </div>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="slideshow">
        <div class="image__container active">
            <img src="https://media.gettyimages.com/id/1435149042/photo/cityscape-of-a-residential-area-with-modern-apartment-buildings.jpg?s=612x612&w=0&k=20&c=ueetSwQs9VJ_qFpKOKaoDF8_tEEQcYDTGv43WD5HKyc=" alt="Indoor">        
        </div>
        <div class="image__container">
            <img src="https://t3.ftcdn.net/jpg/08/80/18/00/360_F_880180083_aTAQcQClQoJr1Brgv5F5Y9EV8fZEgZDm.jpg" alt="Indoor">        
        </div>
        <div class="image__container">
            <img src="https://res.akamaized.net/domain/image/upload/t_web/v1543188978/Dom-oct27m-ModernHomes-04_jpg_ia23ii.jpg" alt="Indoor">        
        </div>
        <div class="slide-indicators">
            <span class="indicator active"></span>
            <span class="indicator"></span>
            <span class="indicator"></span>
        </div>
    </div>

    <div class="quick-stats">
        <div class="stat-card">
            <i class="fa fa-users"></i>
            <h3>Total Tenants</h3>
            <p class="number">124</p>
        </div>
        <div class="stat-card">
            <i class="fa fa-wrench"></i>
            <h3>Pending Requests</h3>
            <p class="number">8</p>
        </div>
        <div class="stat-card">
            <i class="fa fa-check-circle"></i>
            <h3>Completed Tasks</h3>
            <p class="number">45</p>
        </div>
        <div class="stat-card">
            <i class="fa fa-exclamation-circle"></i>
            <h3>Active Complaints</h3>
            <p class="number">3</p>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="grid-item recent-activities">
            <h3>Recent Activities</h3>
            <div class="activity-list">
                <div class="activity-item">
                    <i class="fa fa-key"></i>
                    <div class="activity-content">
                        <p class="activity-text">New tenant check-in completed</p>
                        <p class="activity-time">2 hours ago</p>
                    </div>
                </div>
                <div class="activity-item">
                    <i class="fa fa-wrench"></i>
                    <div class="activity-content">
                        <p class="activity-text">Maintenance request resolved</p>
                        <p class="activity-time">4 hours ago</p>
                    </div>
                </div>
                <div class="activity-item">
                    <i class="fa fa-file-text"></i>
                    <div class="activity-content">
                        <p class="activity-text">Monthly report generated</p>
                        <p class="activity-time">Yesterday</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid-item quick-actions">
            <h3>Quick Actions</h3>
            <div class="action-buttons">
                <button class="action-btn"><i class="fa fa-plus"></i> New Tenant</button>
                <button class="action-btn"><i class="fa fa-envelope"></i> Send Notice</button>
                <button class="action-btn"><i class="fa fa-calendar"></i> Schedule Visit</button>
                <button class="action-btn"><i class="fa fa-file"></i> Generate Report</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    let slideIndex = 0;
    const indicators = document.querySelectorAll('.indicator');
    showSlides();

    function showSlides() {
        const slides = document.querySelectorAll('.image__container');

        // Hide all images and remove active indicators
        slides.forEach(slide => {
            slide.classList.remove('active');
        });
        indicators.forEach(indicator => {
            indicator.classList.remove('active');
        });

        // Show current image and indicator
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].classList.add('active');
        indicators[slideIndex - 1].classList.add('active');

        // Repeat after 3 sec (3000ms)
        setTimeout(showSlides, 3000);
    }

    // Add click handlers for indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            slideIndex = index;
            showSlides();
        });
    });
</script>

<script type="text/javascript">
    $(".menu-icon").click(function(e) {
        e.preventDefault();
        $(".menu-icon").toggleClass("menuicon");
        $(".main").toggleClass("main-width");
        $(".sidebar").toggleClass("active1");
        $(".sidenav li a").toggleClass("anchor");
        $(".sidenav li").toggleClass("lislide");
        $(".sidenav p").toggleClass("apphide");
        $(".logo span").toggleClass("headspan");
        $(".logo").toggleClass("lm");

    });
</script>
<script>
    $(document).ready(function(){
        $(".user").click(function(){
            $(".profile-div").toggle(1000);
        });
        $(".bell").click(function(){
            $(".notification-div").toggle(1000);
        });
    });
</script>
</body>
</html>
