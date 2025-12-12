<?php
include 'includes/session.php';
include 'includes/auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Agent Sierra Leone</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <main>
        <section id="hero">
            <div class="hero-content">
                <h1>⚽ Welcome to Football Agent Sierra Leone</h1>
                <p>Your premier partner for football talent management and representation in Sierra Leone. We connect players with opportunities and guide them through their professional careers.</p>
            </div>
        </section>

        <section>
            <h2>🎯 Our Services</h2>
            <div class="service-list">
                <div class="service">
                    <img src="https://images.unsplash.com/photo-1560272564-c83b66b1ad12?w=400&h=250&fit=crop" alt="Player Representation" style="width: 100%; height: 200px; object-fit: cover; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    <div style="font-size: 40px; margin-bottom: 15px;">🤝</div>
                    <h3>Player Representation</h3>
                    <p>Comprehensive representation for football players, including contract negotiations, transfer management, and career development.</p>
                </div>
                <div class="service">
                    <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=400&h=250&fit=crop" alt="Talent Scouting" style="width: 100%; height: 200px; object-fit: cover; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    <div style="font-size: 40px; margin-bottom: 15px;">🔍</div>
                    <h3>Talent Scouting</h3>
                    <p>Expert scouting services to identify promising young talent across Sierra Leone and connect them with professional opportunities.</p>
                </div>
                <div class="service">
                    <img src="https://images.unsplash.com/photo-1589487391730-58f20eb2c308?w=400&h=250&fit=crop" alt="Contract Negotiation" style="width: 100%; height: 200px; object-fit: cover; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    <div style="font-size: 40px; margin-bottom: 15px;">📝</div>
                    <h3>Contract Negotiation</h3>
                    <p>Professional negotiation services to ensure our clients receive fair compensation and favorable contract terms.</p>
                </div>
                <div class="service">
                    <img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?w=400&h=250&fit=crop" alt="Career Counseling" style="width: 100%; height: 200px; object-fit: cover; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    <div style="font-size: 40px; margin-bottom: 15px;">💼</div>
                    <h3>Career Counseling</h3>
                    <p>Personalized guidance on career planning, financial management, and personal development for football professionals.</p>
                </div>
            </div>
        </section>

        <section id="testimonials">
            <h2>💬 What Our Clients Say</h2>
            <div class="testimonial">
                <div style="font-size: 50px; margin-bottom: 15px;">⭐</div>
                <p style="font-size: 1.1em; line-height: 1.8;">"Football Agent Sierra Leone helped me secure my first professional contract. Their expertise and dedication made all the difference."</p>
                <cite style="font-size: 1.1em;">- Kai Kamara, Professional Player</cite>
            </div>
            <div class="testimonial">
                <div style="font-size: 50px; margin-bottom: 15px;">🏆</div>
                <p style="font-size: 1.1em; line-height: 1.8;">"Outstanding service and genuine care for players' careers. Highly recommended for any aspiring footballer in Sierra Leone."</p>
                <cite style="font-size: 1.1em;">- Mohamed Kallon, Youth Coach</cite>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>