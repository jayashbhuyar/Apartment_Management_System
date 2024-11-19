<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4e54c8;
            --secondary: #8f94fb;
            --text: #ffffff;
            --dark: #1a1a1a;
            --card-bg: rgba(255, 255, 255, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, var(--dark), #2c2c2c);
            color: var(--text);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="1.5" fill="%23ffffff20"/></svg>');
            opacity: 0.1;
            z-index: -1;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .welcome-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .slideshow {
            height: 450px;
            margin-bottom: 3rem;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        }

        .image__container img {
            transform: scale(1.02);
            transition: transform 0.5s ease;
        }

        .image__container.active img {
            transform: scale(1);
        }

        .stats-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 25px;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.1);
        }

        .stats-card i {
            font-size: 2.5em;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        .feature-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.1);
        }

        .feature-icon {
            font-size: 3rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78,84,200,0.4);
        }

        .logout-btn {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,65,108,0.4);
        }

        .indicator {
            width: 40px;
            height: 4px;
            border-radius: 2px;
            background: rgba(255,255,255,0.3);
        }

        .indicator.active {
            background: var(--primary);
        }

        h2, h3, h4 {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .stats-card h3 {
            font-size: 2.5em;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    <!-- Replace the carousel section with this enhanced version -->
    <style>
        :root {
            --primary: #6366f1;
            --secondary: #818cf8;
            --accent: #4f46e5;
            --text: #ffffff;
            --dark: #0f172a;
            --card-bg: rgba(255, 255, 255, 0.1);
        }

        .slideshow {
            position: relative;
            height: 500px;
            margin-bottom: 3rem;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .image__container {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: scale(1.1);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .image__container.active {
            opacity: 1;
            transform: scale(1);
        }

        .image__container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.8);
        }

        .slide-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            transform: translateY(100%);
            transition: transform 0.5s ease;
        }

        .image__container.active .slide-caption {
            transform: translateY(0);
        }

        .slide-caption h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--text);
            font-weight: 600;
        }

        .slide-caption p {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.9);
        }

        .slide-controls {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .slide-indicator {
            width: 40px;
            height: 4px;
            background: rgba(255,255,255,0.3);
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slide-indicator.active {
            background: var(--primary);
            width: 50px;
        }

        .slide-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            z-index: 10;
        }

        .slide-nav:hover {
            background: var(--primary);
        }

        .slide-prev {
            left: 20px;
        }

        .slide-next {
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section text-center">
            <h2><i class="fas fa-home"></i> Welcome, Tenant!</h2>
            <p>Manage your apartment services with ease</p>
        </div>

        <div class="slideshow">
            <div class="image__container active">
            <img src="https://media.gettyimages.com/id/1435149042/photo/cityscape-of-a-residential-area-with-modern-apartment-buildings.jpg?s=612x612&w=0&k=20&c=ueetSwQs9VJ_qFpKOKaoDF8_tEEQcYDTGv43WD5HKyc=" alt="Indoor"> 
                <div class="slide-caption">
                    <h3>Welcome to Your Home</h3>
                    <p>Experience modern living at its finest</p>
                </div>
            </div>
            <div class="image__container">
            <img src="https://t3.ftcdn.net/jpg/08/80/18/00/360_F_880180083_aTAQcQClQoJr1Brgv5F5Y9EV8fZEgZDm.jpg" alt="Indoor">   
                <div class="slide-caption">
                    <h3>Premium Amenities</h3>
                    <p>Enjoy world-class facilities</p>
                </div>
            </div>
            <div class="image__container">
            <img src="https://res.akamaized.net/domain/image/upload/t_web/v1543188978/Dom-oct27m-ModernHomes-04_jpg_ia23ii.jpg" alt="Indoor"> 
                <div class="slide-caption">
                    <h3>Vibrant Community</h3>
                    <p>Be part of something special</p>
                </div>
            </div>
            
            <div class="slide-controls">
                <span class="slide-indicator active"></span>
                <span class="slide-indicator"></span>
                <span class="slide-indicator"></span>
            </div>
            
            <button class="slide-nav slide-prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slide-nav slide-next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-ticket-alt text-primary"></i>
                    <h4>Active Complaints</h4>
                    <h3>2</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-money-bill text-success"></i>
                    <h4>Due Payment</h4>
                    <h3>₹1500</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-car text-info"></i>
                    <h4>Parking Slots</h4>
                    <h3>1</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="fas fa-tools text-warning"></i>
                    <h4>Pending Services</h4>
                    <h3>1</h3>
                </div>
            </div>
        </div>

        <!-- Main Features -->
        <div class="row">
            <div class="col-md-3">
                <div class="feature-card text-center">
                    <i class="fas fa-exclamation-circle feature-icon"></i>
                    <h4>Raise Complaints</h4>
                    <p>Report issues or concerns</p>
                    <a href="complaintraise.php" class="btn btn-primary">Raise Now</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center">
                    <i class="fas fa-money-bill-wave feature-icon"></i>
                    <h4>Maintenance Fee</h4>
                    <p>Pay your monthly dues</p>
                    <a href="maintanencefee.php" class="btn btn-primary">Pay Now</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center">
                    <i class="fas fa-parking feature-icon"></i>
                    <h4>Parking Slots</h4>
                    <p>Manage your parking space</p>
                    <a href="parkingslotallot.php" class="btn btn-primary">Manage</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center">
                    <i class="fas fa-concierge-bell feature-icon"></i>
                    <h4>Book Service</h4>
                    <p>Request maintenance service</p>
                    <a href="requestservice.php" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="text-center mt-4">
            <a href="../index.html" class="btn btn-danger logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        const slides = document.querySelectorAll('.image__container');
        const indicators = document.querySelectorAll('.slide-indicator');
        const prevButton = document.querySelector('.slide-prev');
        const nextButton = document.querySelector('.slide-next');
        let slideIndex = 0;
        let slideInterval;

        function showSlide(index) {
            // Clear any existing interval
            if (slideInterval) {
                clearInterval(slideInterval);
            }

            // Remove active class from all slides and indicators
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));
            
            // Calculate new index with wrapping
            slideIndex = (index + slides.length) % slides.length;
            
            // Add active class to current slide and indicator
            slides[slideIndex].classList.add('active');
            indicators[slideIndex].classList.add('active');

            // Restart auto-advance
            startAutoSlide();
        }

        function nextSlide() {
            showSlide(slideIndex + 1);
        }

        function prevSlide() {
            showSlide(slideIndex - 1);
        }

        function startAutoSlide() {
            // Clear any existing interval first
            if (slideInterval) {
                clearInterval(slideInterval);
            }
            slideInterval = setInterval(nextSlide, 5000);
        }

        // Add event listeners
        prevButton.addEventListener('click', () => {
            prevSlide();
        });

        nextButton.addEventListener('click', () => {
            nextSlide();
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Pause auto-advance on hover
        document.querySelector('.slideshow').addEventListener('mouseenter', () => {
            if (slideInterval) {
                clearInterval(slideInterval);
            }
        });

        // Resume auto-advance when mouse leaves
        document.querySelector('.slideshow').addEventListener('mouseleave', () => {
            startAutoSlide();
        });

        // Start the slideshow
        showSlide(0);
    </script>
</body>
</html>
