<?php
include "config/koneksi.php";

$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' LIMIT 1");
    $user  = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: index.php?page=dashboard_admin");
        } else {
            header("Location: index.php?page=home");
        }
        exit;
    } else {
        $error = true;
    }
}

$hour = date('H');
if ($hour >= 5 && $hour < 12) {
    $greeting = "Good Morning";
} elseif ($hour >= 12 && $hour < 18) {
    $greeting = "Good Afternoon";
} else {
    $greeting = "Good Evening";
}
?>

<style>
    /* CSS Variables berdasarkan Palette baru */
    :root {
        --primary-purple: #8B5CF6; /* Warna utama tombol */
        --dark-text: #111111;
        --border-color: #E5E7EB;
        --input-placeholder: #9CA3AF;
        --shadow: 0 10px 40px rgba(17, 17, 17, 0.1);
    }

    body {
        background-color: #ffffff;
        font-family: 'Inter', sans-serif;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-shell {
        display: grid;
        grid-template-columns: 1fr 1fr;
        width: 100%;
        max-width: 1200px;
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    /* Sisi Kiri  */
    .login-left {
        background: radial-gradient(circle at 5% 10%, #edddf3 0%, rgba(255,255,255,0) 30%),
                    radial-gradient(circle at 80% 80%, #bb90d2 0%, rgba(255,255,255,0) 40%),
                    radial-gradient(circle at 90% 40%, #e7e6ee 0%, rgba(255,255,255,0) 40%);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 60px;
        color: white;
    }

    .login-brand-group {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .brand-logo-placeholder {
        font-size: 2rem;
        font-weight: 800;
        background: #f6f6f6;
        color: var(--primary-purple);
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
        
    }

    .brand-text h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .brand-text p {
        margin: 0;
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .welcome-text h1 {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -2px;
        margin-bottom: 20px;
    }

    /* Sisi Kanan - Clean Form */
    .login-right {
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 60px;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
    }

    .login-card h2 {
    font-weight: 800; 
    font-size: 2.8rem; 
    margin-bottom: 15px;
    color: var(--dark-text);
    }

    .login-mini-desc {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 40px;
    }

    .login-error {
        background-color: #FEF2F2;
        color: #DC2626;
        padding: 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 20px;
        border: 1px solid #FEE2E2;
    }

    .login-field {
        margin-bottom: 20px;
    }

    .login-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--dark-text);
    }

    .login-input {
        width: 100%;
        padding: 14px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background-color: #fff;
        font-size: 1rem;
        transition: 0.3s;
    }

    .login-input::placeholder {
        color: var(--input-placeholder);
    }

    .login-input:focus {
        outline: none;
        border-color: var(--primary-purple);
        box-shadow: 0 0 0 4px #F5F3FF;
    }

    .btn-row {
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
    }

    .login-btn {
        width: 100%;
        padding: 16px;
        background-color: #8c7ace;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 5px 20px rgba(139, 92, 246, 0.2);
    }

    .login-btn:hover {
        background-color: #8166b1;
        transform: translateY(-2px);
    }

    .extra-links {
        font-size: 0.85rem;
        color: #888;
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .extra-links a {
        color: var(--primary-purple);
        text-decoration: none;
        font-weight: 600;
    }

    .system-footnote {
        text-align: center;
        font-size: 0.75rem;
        color: #aaa;
        margin-top: 60px;
        letter-spacing: 1px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .login-shell { grid-template-columns: 1fr; border-radius: 0; }
        .login-left { display: none; }
        body { background: #fff; }
    }

    .welcome-text p {
        color: #824a9c;
        font-size: 1rem;
        margin-top: 10px;
    }
    .welcome-text h1 {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -2px;
        margin-bottom: 20px;
        color: var(--dark-text);
        padding: 0;

    }
    
</style>

<div class="login-shell">
    <section class="login-left"> 
        <div class="welcome-text">
            <h1>Welcome <br> Back!</h1>
            <p style="font-size: 1rem; opacity: 0.9; margin-top: 20px;"><?php echo $greeting; ?> - Trendify</p>
        </div>
    </section>

    <section class="login-right">
        <div class="login-card">
            <h2>Login</h2>
            <p class="login-mini-desc">Welcome back! Discover the best distributed fashion management system.</p>

            <?php if ($error): ?>
                <div class="login-error">Email atau password salah, coba cek lagi ya.</div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="login-field">
                    <label class="login-label">Email Address</label>
                    <input type="email" name="email" class="login-input" placeholder="name@example.com" required>
                </div>

                <div class="login-field">
                    <label class="login-label">Password</label>
                    <input type="password" name="password" class="login-input" placeholder="Enter your password" required>
                </div>

                <div class="btn-row">
                    <button type="submit" class="login-btn">Sign In to Dashboard</button>
                    
                    <div class="extra-links">
                        <label style="display: flex; gap: 8px; align-items: center; color: #666; font-weight: 500;">
                            <input type="checkbox" style="accent-color: var(--primary-purple);"> Remember Me
                        </label>
                        <a href="#">Forgot Password?</a>
                    </div>
                </div>

                <div class="system-footnote">
                     © <?php echo date('Y'); ?> Trendify Fashion.
                </div>
            </form>
        </div>
    </section>
</div>