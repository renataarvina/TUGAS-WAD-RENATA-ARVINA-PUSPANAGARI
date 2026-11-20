
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laundry-In</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #26364d;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(70, 90, 120, 0.08);
        }

        .logo {
            margin-bottom: 10px;
            color: #111827;
            font-size: 28px;
            font-weight: 800;
            text-align: center;
        }

        h2 {
            margin: 0 0 8px;
            text-align: center;
            color: #172b4d;
        }

        .description {
            margin-bottom: 30px;
            color: #64748b;
            text-align: center;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dbe3ef;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #111827;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #2d7ff9;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #1d65d8;
        }

        .error {
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 10px;
            background: #fee2e2;
            color: #dc2626;
            font-size: 14px;
        }

        .message {
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 10px;
            background: #e8f7f0;
            color: #16734b;
            font-size: 14px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="logo">Laundry-In</div>

        <h2>Login Admin & Petugas</h2>

        <p class="description">
            Silakan masuk untuk mengakses sistem inventaris mesin laundry.
        </p>

        @if (session('status'))
            <div class="message">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>

        </form>

    </div>

</body>
</html>
