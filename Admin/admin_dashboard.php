<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
            padding: 2rem;
            background: var(--card-bg);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .stat-box {
            text-align: center;
            padding: 1.5rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            transition: transform 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5em;
            color: var(--secondary-color);
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1em;
            color: var(--text-color);
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
            margin-top: 1rem;
        }

        .apartment-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .apartment-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .card-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .apartment-card:hover .card-image {
            transform: scale(1.05);
        }

        .card-content {
            padding: 1.5rem;
            position: relative;
            background: linear-gradient(
                to top,
                rgba(44, 62, 80, 0.95),
                rgba(44, 62, 80, 0.7)
            );
        }

        .card-title {
            font-size: 1.4em;
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }

        .card-text {
            font-size: 1em;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            color: var(--text-color);
        }

        .card-button {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .card-button:hover {
            background-color: transparent;
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        /* Add animation for cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .apartment-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .apartment-card:nth-child(1) { animation-delay: 0.1s; }
        .apartment-card:nth-child(2) { animation-delay: 0.2s; }
        .apartment-card:nth-child(3) { animation-delay: 0.3s; }
        .apartment-card:nth-child(4) { animation-delay: 0.4s; }
        .apartment-card:nth-child(5) { animation-delay: 0.5s; }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .card-container {
                grid-template-columns: 1fr;
            }

            .slideshow {
                height: 300px;
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
        <li><i class="fa fa-calendar"></i><a href="../owner/viewempl.php"> Employee Details</a></li>
        <li><i class="fa fa-clone"></i><a href="viewenq.php"> View Enquiries</a></li>
        <li><i class="fa fa-user"></i><a href="parkingslot.php"> Parking</a></li>
        <li><i class="fa fa-shield"></i><a href="fees.php"> Fees</a></li>
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
    </div>

    <div class="stats-container">
        <div class="stat-box">
            <div class="stat-number">150+</div>
            <div class="stat-label">Happy Tenants</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">50+</div>
            <div class="stat-label">Properties</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Support</div>
        </div>
    </div>

    <div class="card-container">
        <div class="apartment-card">
            <img src="https://images.pexels.com/photos/1428348/pexels-photo-1428348.jpeg" class="card-image" alt="Luxury Apartment">
            <div class="card-content">
                <h3 class="card-title">Luxury Suite</h3>
                <p class="card-text">Modern luxury apartment with premium amenities and stunning views.</p>
                <a href="#" class="card-button">View Details</a>
            </div>
        </div>

        <div class="apartment-card">
            <img src="https://thumbs.dreamstime.com/b/small-apartment-modern-interior-desugn-series-design-99114741.jpg" class="card-image" alt="Modern Interior">
            <div class="card-content">
                <h3 class="card-title">Modern Living</h3>
                <p class="card-text">Contemporary design meets comfort in our modern apartments.</p>
                <a href="#" class="card-button">View Details</a>
            </div>
        </div>

        <div class="apartment-card">
            <img src="https://media.istockphoto.com/id/1165384568/photo/europe-modern-complex-of-residential-buildings.jpg" class="card-image" alt="Residential Complex">
            <div class="card-content">
                <h3 class="card-title">Urban Living</h3>
                <p class="card-text">Experience urban living at its finest in our residential complex.</p>
                <a href="#" class="card-button">View Details</a>
            </div>
        </div>

        <div class="apartment-card">
            <img src="https://www.apartments.com/blog/sites/default/files/styles/x_large_hq/public/image/2023-06/ParkLine-apartment-in-Miami-FL.jpg" class="card-image" alt="ParkLine Apartment">
            <div class="card-content">
                <h3 class="card-title">ParkLine Residences</h3>
                <p class="card-text">Exclusive apartments with premium facilities and amenities.</p>
                <a href="#" class="card-button">View Details</a>
            </div>
        </div>

        <div class="apartment-card">
            <img src="https://i.pinimg.com/736x/4a/a9/55/4aa955a400be6c95a34a61bb0094ba35.jpg" class="card-image" alt="Luxury Interior">
            <div class="card-content">
                <h3 class="card-title">Premium Living</h3>
                <p class="card-text">Experience luxury living with our premium apartment offerings.</p>
                <a href="#" class="card-button">View Details</a>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        const slides = document.querySelectorAll('.image__container');

        // Hide all images
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // Show current image
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].classList.add('active');

        // Repeat after 3 sec (3000ms)
        setTimeout(showSlides, 3000);
    }
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
