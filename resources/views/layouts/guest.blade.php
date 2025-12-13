<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Festivo')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Auth CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Hide scrollbars */
        * {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }

        *::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        
        body.login-page {
            height: 100vh;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }

        .auth-header {
            background: #173648;
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .auth-header .logo-circle {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .auth-header .logo-circle img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .auth-body {
            padding: 2rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #1C7FDD;
            box-shadow: 0 0 0 0.2rem rgba(28, 127, 221, 0.15);
        }

        .btn-primary {
            background: #1C7FDD;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0A5A99;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(28, 127, 221, 0.3);
        }

        .auth-link {
            color: #1C7FDD;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-link:hover {
            color: #0A5A99;
            text-decoration: underline;
        }

        .form-check-input:checked {
            background-color: #1C7FDD;
            border-color: #1C7FDD;
        }
    </style>

    @stack('styles')
</head>

<body class="@yield('body-class')">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
