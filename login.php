<?php
session_start();
include 'con.php';
include 'assets.php';
include 'smtp/init.php';

// ─── Helpers ──────────────────────────────────────────────────────────────────

function setUserSession(int $userid, string $login_type): void {
    $_SESSION['id']         = session_id();
    $_SESSION['userid']     = $userid;
    $_SESSION['login_type'] = $login_type;
}

function updateLoginCount($con, int $userid): void {
    $date  = date("Y-m-d");
    $check = mysqli_query($con, "SELECT id, login_count FROM login_count_data WHERE userid='$userid' AND date='$date'");

    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
        $new = (int)$row['login_count'] + 1;
        mysqli_query($con, "UPDATE login_count_data SET login_count='$new' WHERE id='{$row['id']}'");
    } else {
        mysqli_query($con, "INSERT INTO login_count_data (userid, date) VALUES ('$userid', '$date')");
    }
}

// ─── Login Handler ────────────────────────────────────────────────────────────

$error_msg = '';

if (isset($_POST['login'])) {
    $mobile = VerifyData($_POST['mobile']);
    $pass   = VerifyData($_POST['pass']);

    if (empty($mobile) || empty($pass)) {
        $error_msg = 'Please fill mobile number and password.';
    } else {
        $sql    = mysqli_query($con, "SELECT * FROM user WHERE mobile='$mobile' AND pass='$pass'");
        $result = mysqli_fetch_assoc($sql);

        if ($result) {
            updateLoginCount($con, (int)$result['id']);

            $admin_token   = 'st_ijnbvcs3ergb8uhhb5tfc89hbuftccgfcveddgk';
            $student_token = 'st_kjjvgfh5242kvjjhgfnsjhfuygjhdfrtdggsdk';

            switch ((int)$result['type']) {
                case 1: // Branch Head / Admin
                case 2: // Staff
                    setUserSession((int)$result['id'], $admin_token);
                    header('Location: area_admin/');
                    exit;

                case 3: // Student
                    setUserSession((int)$result['id'], $student_token);
                    header('Location: area_s/');
                    exit;

                default:
                    $error_msg = 'Your login panel is under maintenance.';
            }
        } else {
            $error_msg = 'Mobile number or password is incorrect.';
        }
    }
}

// ─── Forget Password Handler ──────────────────────────────────────────────────

$forget_msg      = '';
$forget_msg_type = 'error';
$show_forget     = false;

if (isset($_POST['forget_password'])) {
    $show_forget = true;
    $user        = VerifyData($_POST['data_forget']);

    if (empty($user)) {
        $forget_msg = 'Please enter your registered email or mobile number.';
    } else {
        $sql_chk = mysqli_query($con, "SELECT * FROM user WHERE mobile='$user' OR email='$user'");
        $result  = mysqli_fetch_assoc($sql_chk);

        if ($result) {
            $rand_pass = rand(10000, 99999);
            mysqli_query($con, "UPDATE user SET pass='$rand_pass' WHERE id='{$result['id']}'");

            $text = '<!DOCTYPE html><html><head>
            <style>body{font-family:Arial,sans-serif;background:#f2f2f2;padding:20px;}
            .box{background:#fff;padding:24px;border-radius:6px;max-width:560px;margin:auto;}
            .btn{display:inline-block;background:#008CBA;color:#fff;padding:10px 24px;
                 border-radius:5px;text-decoration:none;}</style></head>
            <body><div class="box">
            <img src="' . $brand_logo . '" alt="Logo" style="max-width:180px;display:block;margin:0 auto 16px;">
            <h2 style="text-align:center;">' . $brand_name . '</h2>
            <p>Dear ' . htmlspecialchars($result['name']) . ',</p>
            <p>Your password reset request has been processed.</p>
            <p><strong>User ID:</strong> ' . $result['mobile'] . '</p>
            <p><strong>New Password:</strong> ' . $rand_pass . '</p>
            <p style="text-align:center;margin-top:20px;">
                <a href="' . $brand_link . 'login" class="btn">Login Now</a></p>
            <p style="font-size:12px;color:red;margin-top:16px;">
                If you did not request this, contact us at ' . $brand_email . '</p>
            </div></body></html>';

            $send = send_mail($result['email'], 'Password Reset — ' . $brand_name, $text);

            if ($send) {
                $forget_msg_type = 'success';
                $forget_msg      = 'New password sent to your registered email.';
            } else {
                $forget_msg = 'Server error. Please try again later.';
            }
        } else {
            $forget_msg = 'No account found with this mobile or email.';
        }
    }
}

// ─── Page data ────────────────────────────────────────────────────────────────

$q_web     = mysqli_query($con, "SELECT bread_img FROM website_data LIMIT 1");
$web_row   = mysqli_fetch_assoc($q_web);
$bread_img = $web_row['bread_img'] ?? 'img/background/Learning-bg.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($brand_name); ?> — Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'head.php'; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        /* ── Reset ────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #080a0f;
            --surface:   #0f1117;
            --surface2:  #171b24;
            --border:    rgba(255,255,255,0.07);
            --accent:    #4f8ef7;
            --accent2:   #7b5ef7;
            --text:      #e2e5ee;
            --muted:     #64748b;
            --danger:    #f87171;
            --success:   #34d399;
            --r:         13px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* hide site header/footer/navbar on this page */
        header, footer, .navbar, nav.navbar,
        .page-header, #topbar { display: none !important; }

        /* ── Two-column layout ────────────────────────────── */
        .auth-wrap {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ── LEFT: brand panel ────────────────────────────── */
        .auth-left {
            position: relative;
            overflow: hidden;
            background: #0b0e16;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 3.5rem;
        }

        /* ambient glow */
        .auth-left::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 70% 55% at 15% 25%, rgba(79,142,247,.14) 0%, transparent 65%),
                radial-gradient(ellipse 55% 70% at 85% 80%, rgba(123,94,247,.11) 0%, transparent 65%);
            pointer-events: none;
        }

        /* dot grid */
        .auth-left::after {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(rgba(255,255,255,.055) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
        }

        .lc { position: relative; z-index: 1; }

        .badge {
            display: inline-flex; align-items: center; gap: 9px;
            background: rgba(79,142,247,.08);
            border: 1px solid rgba(79,142,247,.2);
            border-radius: 100px;
            padding: 7px 16px;
            margin-bottom: 2.2rem;
            width: fit-content;
        }
        .badge-dot {
            width: 7px; height: 7px;
            background: var(--accent);
            border-radius: 50%;
            animation: blink 2.2s ease-in-out infinite;
        }
        .badge span {
            font-family: 'Syne', sans-serif;
            font-size: .75rem; font-weight: 600;
            letter-spacing: .09em; text-transform: uppercase;
            color: var(--accent);
        }
        @keyframes blink {
            0%,100%{ opacity:1; transform:scale(1); }
            50%    { opacity:.4; transform:scale(.75); }
        }

        .lc h2 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.9rem, 3.2vw, 2.8rem);
            font-weight: 800;
            line-height: 1.18;
            letter-spacing: -.025em;
            margin-bottom: 1.1rem;
        }
        .grad {
            background: linear-gradient(95deg, var(--accent) 0%, var(--accent2) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .lc p {
            font-size: .95rem; color: var(--muted);
            line-height: 1.72; max-width: 360px;
            margin-bottom: 2.75rem;
        }

        .features { display: flex; flex-direction: column; gap: 13px; }
        .feat {
            display: flex; align-items: center; gap: 11px;
            font-size: .875rem; color: #94a3b8;
        }
        .feat-icon {
            width: 34px; height: 34px; flex-shrink: 0;
            background: rgba(79,142,247,.08);
            border: 1px solid rgba(79,142,247,.18);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: .82rem;
        }

        /* ── RIGHT: form panel ────────────────────────────── */
        .auth-right {
            background: var(--surface);
            display: flex; align-items: center; justify-content: center;
            padding: 2.5rem 2rem;
            position: relative;
        }
        .auth-right::before {
            content: '';
            position: absolute; top: 0; left: 0;
            width: 1px; height: 100%;
            background: linear-gradient(to bottom, transparent, var(--border), transparent);
        }

        .auth-card {
            width: 100%; max-width: 400px;
            animation: fadeUp .45s ease both;
        }
        @keyframes fadeUp {
            from { opacity:0; transform:translateY(18px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* logo block */
        .logo-block { text-align: center; margin-bottom: 1.8rem; }
        .logo-block img {
            width: 68px; height: 68px; object-fit: cover;
            border-radius: 16px;
            border: 2px solid var(--border);
            box-shadow: 0 0 28px rgba(79,142,247,.18);
        }
        .logo-block h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem; font-weight: 700;
            letter-spacing: -.01em; margin-top: 12px;
        }
        .logo-block small { font-size: .8rem; color: var(--muted); }

        /* tabs */
        .tabs {
            display: flex;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px; padding: 4px;
            margin-bottom: 1.6rem;
        }
        .tab-btn {
            flex: 1; padding: 9px;
            border: none; background: transparent;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: .855rem; font-weight: 500;
            border-radius: 7px; cursor: pointer;
            transition: all .2s;
        }
        .tab-btn.active {
            background: var(--surface);
            color: var(--text);
            box-shadow: 0 1px 5px rgba(0,0,0,.5);
        }

        /* alerts */
        .msg {
            padding: 10px 13px; border-radius: 9px;
            font-size: .84rem; margin-bottom: 1.15rem;
            display: flex; align-items: flex-start; gap: 8px;
        }
        .msg-error   { background:rgba(248,113,113,.07); border:1px solid rgba(248,113,113,.22); color:var(--danger); }
        .msg-success { background:rgba(52,211,153,.07);  border:1px solid rgba(52,211,153,.22);  color:var(--success); }

        /* form */
        .fg { margin-bottom: 1rem; }
        .fg label {
            display: block;
            font-size: .79rem; font-weight: 500;
            color: #94a3b8; margin-bottom: 6px;
        }
        .iw { position: relative; }
        .iw .ico {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--muted); font-size: .85rem; pointer-events: none;
        }
        .iw input {
            width: 100%;
            padding: 11px 13px 11px 36px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 9px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: .875rem; outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .iw input:focus {
            border-color: rgba(79,142,247,.45);
            box-shadow: 0 0 0 3px rgba(79,142,247,.07);
        }
        .iw input::placeholder { color: #3d4557; }
        .eye-btn {
            position: absolute; right: 11px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: var(--muted); cursor: pointer;
            font-size: .8rem; padding: 3px;
            transition: color .2s;
        }
        .eye-btn:hover { color: var(--text); }

        /* submit */
        .btn-main {
            width: 100%; padding: 12px;
            background: linear-gradient(130deg, var(--accent) 0%, var(--accent2) 100%);
            border: none; border-radius: 9px;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: .92rem; font-weight: 700;
            letter-spacing: .025em;
            cursor: pointer; margin-top: .35rem;
            transition: opacity .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 18px rgba(79,142,247,.28);
        }
        .btn-main:hover  { opacity:.9; transform:translateY(-1px); box-shadow:0 6px 22px rgba(79,142,247,.38); }
        .btn-main:active { transform:translateY(0); }

        /* footer links */
        .foot-links {
            display: flex; justify-content: space-between; align-items: center;
            margin-top: 1.1rem;
            font-size: .8rem; color: var(--muted);
        }
        .foot-links a, .foot-links .lnk {
            color: var(--accent); text-decoration: none;
            font-weight: 500; cursor: pointer;
            transition: color .2s;
        }
        .foot-links a:hover, .foot-links .lnk:hover { color: #7ba8f9; }

        /* ── Mobile ───────────────────────────────────────── */
        @media (max-width: 768px) {
            .auth-wrap { grid-template-columns: 1fr; }
            .auth-left { display: none; }
            .auth-right { padding: 1.5rem 1.1rem; }
        }
    </style>
</head>
<body>

<div class="auth-wrap">

    <!-- ════ LEFT PANEL ════════════════════════════════════ -->
    <div class="auth-left">
        <div class="lc">

            <div class="badge">
                <div class="badge-dot"></div>
                <span>Management Portal</span>
            </div>

            <h2>
                Run Your Institute<br>
                <span class="grad">Smarter &amp; Faster</span>
            </h2>

            <p>
                Complete institute management — students, staff, fees,
                attendance, certificates &amp; LMS — all in one place.
            </p>

            <div class="features">
                <div class="feat"><div class="feat-icon">🎓</div><span>Student Enrollment &amp; Attendance</span></div>
                <div class="feat"><div class="feat-icon">💰</div><span>Fee Collection &amp; Wallet System</span></div>
                <div class="feat"><div class="feat-icon">📜</div><span>Certificate Generation &amp; Verification</span></div>
                <div class="feat"><div class="feat-icon">🏢</div><span>Multi-Branch Franchise Support</span></div>
                <div class="feat"><div class="feat-icon">📚</div><span>LMS — Videos, Docs &amp; Live Classes</span></div>
            </div>

        </div>
    </div>

    <!-- ════ RIGHT PANEL ═══════════════════════════════════ -->
    <div class="auth-right">
        <div class="auth-card">

            <!-- Logo -->
            <div class="logo-block">
                <img src="<?php echo htmlspecialchars($brand_logo); ?>" alt="Logo">
                <h1><?php echo htmlspecialchars($brand_name); ?></h1>
                <small>Sign in to continue</small>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab-btn <?php echo !$show_forget ? 'active' : ''; ?>"
                        onclick="showTab('login')">Sign In</button>
                <button class="tab-btn <?php echo $show_forget ? 'active' : ''; ?>"
                        onclick="showTab('forget')">Forgot Password</button>
            </div>

            <!-- ── Login form ─────────────────────────────── -->
            <div id="tab-login" style="display:<?php echo !$show_forget ? 'block' : 'none'; ?>">

                <?php if ($error_msg): ?>
                    <div class="msg msg-error">⚠️ <?php echo htmlspecialchars($error_msg); ?></div>
                <?php endif; ?>

                <form method="POST" autocomplete="off">
                    <div class="fg">
                        <label for="f_mobile">Mobile Number / User ID</label>
                        <div class="iw">
                            <span class="ico">📱</span>
                            <input type="text" id="f_mobile" name="mobile"
                                   placeholder="Enter your mobile number"
                                   value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : ''; ?>"
                                   required>
                        </div>
                    </div>

                    <div class="fg">
                        <label for="f_pass">Password</label>
                        <div class="iw">
                            <span class="ico">🔒</span>
                            <input type="password" id="f_pass" name="pass"
                                   placeholder="Enter your password" required>
                            <button type="button" class="eye-btn" id="eyeBtn"
                                    onclick="togglePass()">👁</button>
                        </div>
                    </div>

                    <button type="submit" name="login" value="login" class="btn-main">
                        Sign In &rarr;
                    </button>
                </form>

                <div class="foot-links">
                    <a href="registration">New here? Register</a>
                    <span class="lnk" onclick="showTab('forget')">Forgot password?</span>
                </div>
            </div>

            <!-- ── Forgot password form ───────────────────── -->
            <div id="tab-forget" style="display:<?php echo $show_forget ? 'block' : 'none'; ?>">

                <?php if ($forget_msg): ?>
                    <div class="msg msg-<?php echo $forget_msg_type; ?>">
                        <?php echo $forget_msg_type === 'success' ? '✅' : '⚠️'; ?>
                        <?php echo htmlspecialchars($forget_msg); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" autocomplete="off">
                    <div class="fg">
                        <label for="f_forget">Registered Email or Mobile</label>
                        <div class="iw">
                            <span class="ico">📧</span>
                            <input type="text" id="f_forget" name="data_forget"
                                   placeholder="Enter email or mobile number" required>
                        </div>
                    </div>

                    <button type="submit" name="forget_password" value="1" class="btn-main">
                        Send Reset Password &rarr;
                    </button>
                </form>

                <div class="foot-links">
                    <a href="registration">New here? Register</a>
                    <span class="lnk" onclick="showTab('login')">&larr; Back to Sign In</span>
                </div>
            </div>

        </div><!-- /.auth-card -->
    </div><!-- /.auth-right -->

</div><!-- /.auth-wrap -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="js/main.js"></script>
<script>
    function showTab(tab) {
        document.getElementById('tab-login').style.display  = tab === 'login'  ? 'block' : 'none';
        document.getElementById('tab-forget').style.display = tab === 'forget' ? 'block' : 'none';
        document.querySelectorAll('.tab-btn').forEach((el, i) => {
            el.classList.toggle('active', (tab === 'login' && i === 0) || (tab === 'forget' && i === 1));
        });
    }

    function togglePass() {
        const inp = document.getElementById('f_pass');
        const btn = document.getElementById('eyeBtn');
        inp.type   = inp.type === 'password' ? 'text' : 'password';
        btn.textContent = inp.type === 'password' ? '👁' : '🙈';
    }
</script>
</body>
</html>