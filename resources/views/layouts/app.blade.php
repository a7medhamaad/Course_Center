<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'User Dashboard')</title>

    <!-- Bootstrap 5 RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #fff;
            border-radius: 20px;
            padding: 50px 40px;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 15px 30px rgba(38, 38, 38, 0.15);
            text-align: center;
            transition: box-shadow 0.3s ease;
        }

        .dashboard-container:hover {
            box-shadow: 0 25px 50px rgba(38, 38, 38, 0.25);
        }

        h2 {
            color: #222;
            font-weight: 800;
            margin-bottom: 50px;
            letter-spacing: 0.1em;
            font-size: 2.4rem;
        }

        .dashboard-links .card {
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease, color 0.3s ease;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 25px 0;
            color: #444;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            background-color: #f9f9f9;
            user-select: none;
        }

        .dashboard-links .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            color: #673ab7;
            background-color: #f0e9ff;
            text-decoration: none;
        }

        .dashboard-links .card i {
            font-size: 1.8rem;
            color: #673ab7;
            transition: color 0.3s ease;
        }

        .dashboard-links .card:hover i {
            color: #512da8;
        }

        .btn-logout {
            margin-top: 50px;
        }

        .btn-logout button {
            width: 180px;
            font-weight: 700;
            font-size: 1.2rem;
            border-radius: 50px;
            padding: 12px 0;
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.5);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-logout button:hover {
            background-color: #b71c1c;
            box-shadow: 0 8px 30px rgba(183, 28, 28, 0.7);
        }

        @media (max-width: 768px) {
            .dashboard-links .card {
                font-size: 1rem;
                padding: 20px 10px;
            }
            h2 {
                font-size: 1.8rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="dashboard-container">
    <h2>@yield('header')</h2>

    @yield('content')

    @auth
    <div class="btn-logout mt-4 d-flex justify-content-center">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
     @endauth
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- هنا أفضل استخدام @stack وليس @yield ليجمع أكثر من سكريبت --}}
@stack('scripts')

</body>
</html>
