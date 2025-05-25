<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Management</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons (اختياري) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        /* Navbar ثابت فوق */
        nav.navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030; /* أعلى من sidebar */
        }

        /* Sidebar ثابت تحت Navbar */
        .sidebar {
            position: fixed;
            top: 56px; /* ارتفاع Navbar */
            left: 0;
            width: 220px;
            height: calc(100vh - 56px); /* ياخد كامل ارتفاع الشاشة تحت Navbar */
            background-color: #f8f9fa;
            padding-top: 1rem;
            overflow-y: auto;
            border-right: 1px solid #dee2e6;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 0;
        }

        /* المحتوى بيبدأ من يمين sidebar وتحت navbar */
        .content {
            margin-left: 220px;
            margin-top: 56px;
            padding: 2rem;
            min-height: calc(100vh - 56px);
            background-color: #fff;
        }

        /* استجابة الشاشات الصغيرة */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                top: 0;
                border-right: none;
            }

            .content {
                margin-left: 0;
                margin-top: 0;
                padding: 1rem;
            }
            nav.navbar {
                position: relative;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold fs-4 text-primary" href="#">Student Management</a>

            <div>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a class="{{ request()->is('dashboard/admin') ? 'active' : '' }}" href="{{ url('/dashboard/admin') }}">
            <i class="bi bi-house-door"></i> Home
        </a>
        <a href="{{ url('/dashboard/admin/create') }}">
            <i class="bi bi-person-plus"></i> Create User
        </a>
        <a href="{{ url('/dashboard/courses') }}">
            <i class="bi bi-journal-bookmark"></i> Courses
        </a>
        <a href="{{ url('/dashboard/categories') }}">
            <i class="bi bi-tags"></i> Categories
        </a>
        <a href="{{ url('/dashboard/course-purchases') }}">
            <i class="bi bi-people"></i> User In Course
        </a>
        <a href="{{ url('/dashboard/videos') }}">
            <i class="bi bi-camera-video"></i> Videos
        </a>
        <a href="{{ url('/dashboard/payments') }}">
            <i class="bi bi-credit-card"></i> Payment
        </a>
    </div>

    <!-- Main content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
