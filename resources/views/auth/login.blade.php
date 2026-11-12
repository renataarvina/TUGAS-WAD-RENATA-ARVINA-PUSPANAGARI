<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laundry-In</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f9fa;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: white;
            border: 1px solid #d9f0f0;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .logo {
            color: #159a9c;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #64748b;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #243b53;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 6px;
            background: #159a9c;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #117f81;
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: -12px;
            margin-bottom: 15px;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            background: #e8f7f0;
            color: #16734b;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <h1 class="logo">Laundry-In</h1>

        <p class="subtitle">
            Silakan login untuk mengakses sistem operasional laundry.
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

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button type="submit">
                Login
            </button>
        </form>

    </div>

</body>
</html>
