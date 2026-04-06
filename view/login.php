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
    .login-page * {
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .login-page {
        --bg: #f5f5f7;
        --card: #ffffff;
        --text: #111111;
        --muted: #6b7280;
        --line: #e5e7eb;
        --accent: #8b5cf6;
        --accent-soft: #f3f0ff;
        --danger: #dc2626;
        --danger-bg: #fef2f2;
        --shadow: 0 20px 50px rgba(17, 17, 17, 0.08);

        min-height: 100vh;
        width: 100%;
        background: var(--bg);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .login-shell {
        width: 100%;
        max-width: 1240px;
        min-height: 700px;
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .login-left {
        padding: 72px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #ffffff;
    }

    .login-brand {
        font-size: 2.15rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        margin-bottom: 28px;
        color: var(--text);
    }

    .login-brand span {
        color: var(--accent);
    }

    .login-badge {
        display: inline-flex;
        align-items: center;
        width: fit-content;
        padding: 8px 14px;
        border-radius: 999px;
        background: var(--accent-soft);
        color: var(--accent);
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        margin-bottom: 26px;
    }

    .login-left h1 {
        font-size: 3.6rem;
        line-height: 1.05;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin-bottom: 18px;
        color: var(--text);
        max-width: 500px;
    }

    .login-left p {
        max-width: 560px;
        color: var(--muted);
        line-height: 1.9;
        font-size: 1.05rem;
        font-weight: 400;
    }

    .login-right {
        background: #fafafa;
        border-left: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 44px;
    }

    .login-card {
        width: 100%;
        max-width: 470px;
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: 24px;
        padding: 40px;
    }

    .login-mini {
        font-size: 0.72rem;
        color: var(--accent);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        margin-bottom: 12px;
    }

    .login-card h2 {
        font-size: 2.65rem;
        line-height: 1.05;
        margin-bottom: 12px;
        color: var(--text);
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .login-card p {
        color: var(--muted);
        font-size: 0.96rem;
        line-height: 1.75;
        margin-bottom: 24px;
        max-width: 320px;
    }

    .login-error {
        margin-bottom: 18px;
        padding: 14px 16px;
        border-radius: 14px;
        border: 1px solid #fecaca;
        background: var(--danger-bg);
        color: var(--danger);
        font-size: 0.9rem;
    }

    .login-field {
        margin-bottom: 18px;
    }

    .login-label {
        display: block;
        font-size: 0.86rem;
        font-weight: 600;
        margin-bottom: 8px;
        letter-spacing: 0.02em;
        color: #374151;
    }

    .login-input {
        width: 100%;
        height: 56px;
        border: 1px solid var(--line);
        border-radius: 12px;
        background: #fff;
        padding: 0 16px;
        font-size: 0.95rem;
        color: var(--text);
        transition: 0.2s ease;
    }

    .login-input::placeholder {
        color: #9ca3af;
    }

    .login-input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.10);
    }

    .login-btn {
        width: 100%;
        height: 56px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, #8b5cf6, #6d47d9);
        color: #fff;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 8px;
        transition: 0.2s ease;
    }

    .login-btn:hover {
        transform: translateY(-1px);
        opacity: 0.97;
    }

    .login-note {
        margin-top: 20px;
        text-align: center;
        color: var(--muted);
        font-size: 0.84rem;
    }

    @media (max-width: 992px) {
        .login-shell {
            grid-template-columns: 1fr;
            max-width: 760px;
            min-height: auto;
        }

        .login-left {
            padding: 42px 30px 24px;
        }

        .login-left h1 {
            font-size: 2.4rem;
            max-width: 100%;
        }

        .login-left p {
            max-width: 100%;
            font-size: 1rem;
        }

        .login-right {
            border-left: none;
            border-top: 1px solid var(--line);
            padding: 26px;
        }

        .login-card {
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .login-page {
            padding: 16px;
        }

        .login-left,
        .login-right {
            padding: 22px;
        }

        .login-card {
            padding: 24px 20px;
        }

        .login-brand {
            font-size: 1.5  rem;
        }

        .login-left h1 {
            font-size: 2rem;
        }

        .login-card h2 {
            font-size: 2rem;
        }

        .login-card p {
            max-width: 100%;
        }
    }
</style>

<div class="login-page">
    <div class="login-shell">
        <section class="login-left">
            <div class="login-brand">TRENDIFY<span>.</span></div>
            <div class="login-badge"><?php echo $greeting; ?></div>
            <h1>Trendify System</h1>
            <p>
                Sistem manajemen fashion berbasis database untuk mengelola produk,
                transaksi, dan pengguna dengan lebih terstruktur.
            </p>
        </section>

        <section class="login-right">
            <div class="login-card">
                <div class="login-mini">Welcome Back</div>
                <h2>Sign in</h2>
                <p>Masukkan email dan password untuk melanjutkan.</p>

                <?php if ($error): ?>
                    <div class="login-error">Email atau password salah.</div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="login-field">
                        <label class="login-label">Email</label>
                        <input type="email" name="email" class="login-input" placeholder="Enter your email" required>
                    </div>

                    <div class="login-field">
                        <label class="login-label">Password</label>
                        <input type="password" name="password" class="login-input" placeholder="Enter your password" required>
                    </div>

                    <button type="submit" class="login-btn">Login</button>

                    <div class="login-note">
                        TRENDIFY © <?php echo date('Y'); ?>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>