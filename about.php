<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>

<style>
body {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    color: #ffffff;
    font-family: 'Inter', sans-serif;
}

.about-section {
    padding: 80px 0;
}

.about-title {
    font-family: 'product sans';
    font-size: 3rem;
    margin-bottom: 50px;
    text-align: center;
    color: #ffffff;
}

.about-card {
    background: #2d2d2d;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);
    border: 1px solid #4a4a4a;
    transition: transform 0.3s ease;
}

.about-card:hover {
    transform: translateY(-5px);
}

.about-icon {
    font-size: 3rem;
    color: #41bef4;
    margin-bottom: 20px;
}

.about-card h3 {
    font-family: 'product sans';
    color: #ffffff;
    margin-bottom: 15px;
}

.about-card p {
    color: #b3b3b3;
    line-height: 1.6;
}

.team-section {
    padding: 80px 0;
    background: #1a1a1a;
}

.team-card {
    background: #2d2d2d;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    margin-bottom: 30px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);
    border: 1px solid #4a4a4a;
}

.team-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin: 0 auto 20px;
    border: 3px solid #41bef4;
    object-fit: cover;
}

.team-card h4 {
    font-family: 'product sans';
    color: #ffffff;
    margin-bottom: 10px;
}

.team-card p {
    color: #b3b3b3;
    margin-bottom: 15px;
}

.social-links a {
    color: #41bef4;
    margin: 0 10px;
    font-size: 1.2rem;
    transition: color 0.3s ease;
}

.social-links a:hover {
    color: #ffffff;
}

.stats-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
}

.stat-card {
    text-align: center;
    padding: 30px;
}

.stat-number {
    font-family: 'product sans';
    font-size: 3rem;
    color: #41bef4;
    margin-bottom: 10px;
}

.stat-label {
    color: #b3b3b3;
    font-size: 1.2rem;
}
</style>

<div class="about-section">
    <div class="container">
        <h1 class="about-title">About Our Airline</h1>
        
        <div class="row">
            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="fa fa-plane"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>To provide safe, comfortable, and efficient air travel while maintaining the highest standards of service and customer satisfaction.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <h3>Global Reach</h3>
                    <p>Connecting people across continents with our extensive network of destinations and state-of-the-art fleet of aircraft.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="about-card">
                    <div class="about-icon">
                        <i class="fa fa-heart"></i>
                    </div>
                    <h3>Customer Focus</h3>
                    <p>Dedicated to providing exceptional service and creating memorable travel experiences for all our passengers.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Destinations</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Aircraft</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-number">1M+</div>
                    <div class="stat-label">Passengers</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">On-time Performance</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="team-section">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #ffffff; font-family: 'product sans';">Our Leadership Team</h2>
        
        <div class="row">
            <div class="col-md-4">
                <div class="team-card">
                    <img src="assets/images/team1.jpg" alt="CEO" class="team-img">
                    <h4>Pramodh Kumar</h4>
                    <p>Chief Executive Officer</p>
                    <div class="social-links">
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="team-card">
                    <img src="assets/images/team2.jpg" alt="COO" class="team-img">
                    <h4>Akhil</h4>
                    <p>Chief Operations Officer</p>
                    <div class="social-links">
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="team-card">
                    <img src="assets/images/team3.jpg" alt="CFO" class="team-img">
                    <h4>Naik</h4>
                    <p>Chief Financial Officer</p>
                    <div class="social-links">
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php subview('footer.php'); ?> 