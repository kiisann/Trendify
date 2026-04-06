<style>
    :root {
        --primary-purple: #8B5CF6;
        --soft-purple: #F5F3FF;
        --dark-text: #111111;
        --bg-gray: #F9FAFB;
        --border-color: #E5E7EB;
    }

    /* Hero Section - Aesthetic & Fluid */
    .hero {
        background: radial-gradient(circle at 10% 20%, #B8A6FC 0%, transparent 40%),
                    radial-gradient(circle at 90% 80%, #FDF2F8 0%, transparent 40%),
                    radial-gradient(circle at 50% 50%, #F5F3FF 0%, transparent 50%),
                    #ffffff;
        padding: 150px 0; 
        border-bottom: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .hero-content h4 {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        font-weight: 700;
        color: var(--primary-purple);
        margin-bottom: 1.5rem;
    }

    .hero-content h1 {
        font-size: 4.5rem; 
        font-weight: 800;
        line-height: 1;
        letter-spacing: -3px;
        color: var(--dark-text);
        margin-bottom: 2rem;
    }

    .hero-content p {
        font-size: 1.2rem;
        color: #555;
        max-width: 500px;
        margin-bottom: 3rem;
        line-height: 1.6;
    }

   
    .btn-shop {
        background: #111111; 
        color: #fff;
        border-radius: 5px;
        padding: 20px 45px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: none;
        display: inline-block;
        text-decoration: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .btn-shop:hover {
        background: #B8A6FC;
        transform: translateY(-5px);
        color: #fff;
        box-shadow: 0 15px 15px rgba(139, 92, 246, 0.3);
    }
    .features-section {
        padding: 100px 0;
        background: #fff;
    }

    .feature-tag {
        font-weight: 700;
        color: var(--primary-purple);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
    }
</style>

<header class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 offset-md-1 hero-content">
                <h4>Trending Now</h4>
                <h1>Trendify <br> Fashion 2026</h1>
                <p>
                    Elevate your wardrobe with our latest curated collection. 
                    Simple, modern, and designed for your daily aesthetic.
                </p>
                <a href="?page=produk" class="btn btn-shop">Discover Collection</a>
            </div>
        </div>
    </div>
</header>

<section class="features-section">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4 mb-4">
                <span class="feature-tag">Quality</span>
                <h5 class="fw-bold mt-2">Premium Materials</h5>
            </div>
            <div class="col-md-4 mb-4">
                <span class="feature-tag">Shipping</span>
                <h5 class="fw-bold mt-2">Fast Delivery</h5>
            </div>
            <div class="col-md-4 mb-4">
                <span class="feature-tag">Support</span>
                <h5 class="fw-bold mt-2">24/7 Service</h5>
            </div>
        </div>
    </div>
</section>