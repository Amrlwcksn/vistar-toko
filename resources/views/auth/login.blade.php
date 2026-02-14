<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VistarToko</title>
    <style>
        body {
            background: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }
        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 { margin-bottom: 1.5rem; text-align: center; color: #0f172a; font-size: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #64748b; font-size: 0.875rem; }
        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1rem;
            box-sizing: border-box; /* Fix for padding increasing width */
        }
        input:focus { outline: 2px solid #2563eb; border-color: transparent; }
        .btn {
            width: 100%;
            padding: 0.75rem;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1rem;
        }
        .btn:hover { background: #1e40af; }
        .error { color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Vistar Admin</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required autofocus>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
