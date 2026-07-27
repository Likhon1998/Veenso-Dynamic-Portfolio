<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Veenso</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Inter, system-ui, sans-serif;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1.5rem;
            background:
                radial-gradient(700px 360px at 20% 10%, rgba(124,92,252,0.25), transparent 60%),
                radial-gradient(600px 320px at 90% 90%, rgba(109,40,217,0.18), transparent 55%),
                #07070c;
            color: #f4f4f8;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #13131c;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 30px 80px rgba(0,0,0,0.45);
        }
        .brand { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; }
        .brand-mark {
            width: 42px; height: 42px; border-radius: 12px;
            display: grid; place-items: center;
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            font-weight: 800;
        }
        .brand strong { display: block; letter-spacing: 0.08em; }
        .brand small { color: #8b8b9a; font-size: 0.7rem; letter-spacing: 0.12em; }
        h1 { font-size: 1.35rem; margin-bottom: 0.35rem; }
        .sub { color: #8b8b9a; font-size: 0.875rem; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: 0.82rem; font-weight: 600; margin-bottom: 0.4rem; color: #d4d4de; }
        .form-control {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.08);
            background: #0c0c13;
            color: #fff;
        }
        .form-control:focus { outline: none; border-color: rgba(124,92,252,0.6); box-shadow: 0 0 0 3px rgba(124,92,252,0.15); }
        .checkbox-row { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #a1a1aa; margin: 1rem 0 1.25rem; }
        .checkbox-row input { accent-color: #7c5cfc; }
        .btn {
            width: 100%;
            padding: 0.8rem;
            border: 0;
            border-radius: 999px;
            background: linear-gradient(90deg, #8b5cf6, #6d28d9);
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }
        .flash { padding: 0.75rem 1rem; border-radius: 12px; margin-bottom: 1rem; font-size: 0.85rem; }
        .flash-error { background: rgba(239,68,68,0.12); color: #fca5a5; border: 1px solid rgba(239,68,68,0.25); }
        .flash-success { background: rgba(34,197,94,0.12); color: #86efac; border: 1px solid rgba(34,197,94,0.25); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">
            <div class="brand-mark">V</div>
            <div>
                <strong>VEENSO</strong>
                <small>GROWTH PARTNER</small>
            </div>
        </div>
        <h1>Welcome back</h1>
        <p class="sub">Sign in to your portfolio dashboard</p>

        @if (session('error'))
            <div class="flash flash-error">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', 'admin@veenso.com') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <label class="checkbox-row">
                <input type="checkbox" name="remember" value="1">
                Remember me
            </label>
            <button type="submit" class="btn">Sign In</button>
        </form>
    </div>
</body>
</html>
