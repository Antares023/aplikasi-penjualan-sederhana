<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Sistem Informasi') }} - @yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    @stack('styles')
    
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-light: #818cf8;
            --secondary-color: #f43f5e;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --sidebar-width: 240px;
            --header-height: 56px;
            --footer-height: 60px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            overflow-x: hidden;
            height: 100vh;
        }
        
        /* Header - Fixed Position */
        .navbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: var(--header-height);
            z-index: 1030;
            transition: var(--transition);
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color);
            transition: var(--transition);
        }
        
        .navbar-brand:hover {
            color: var(--primary-light);
            transform: translateX(2px);
        }
        
        /* Sidebar - Full Height with Footer Space */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            background: white;
            width: var(--sidebar-width);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            z-index: 1020;
            overflow-y: auto;
            padding-bottom: var(--footer-height); /* Add space for footer */
        }
        
        .sidebar-content {
            min-height: calc(100vh - var(--header-height) - var(--footer-height));
            display: flex;
            flex-direction: column;
        }
        
        .sidebar .nav-link {
            color: #64748b;
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            color: var(--primary-color);
            background: rgba(99, 102, 241, 0.1);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            color: white;
            background: var(--primary-color);
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.3);
        }
        
        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 12px;
            transition: var(--transition);
        }
        
        /* Main Content - Scrollable Area */
        .main-content {
            position: fixed;
            top: var(--header-height);
            left: var(--sidebar-width);
            right: 0;
            bottom: var(--footer-height);
            padding: 2rem;
            overflow-y: auto;
            transition: var(--transition);
            background-color: #f1f5f9;
        }
        
        /* Footer - Fixed Position */
        footer {
            position: fixed;
            bottom: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--footer-height);
            background: white;
            color: #64748b;
            padding: 1rem 2rem;
            transition: var(--transition);
            box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.05);
            z-index: 1030;
            display: flex;
            align-items: center;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1040;
                padding-bottom: 0;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                left: 0;
            }
            
            footer {
                left: 0;
            }
        }
        
        /* Smooth scroll behavior */
        .main-content {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar styles */
        .sidebar::-webkit-scrollbar,
        .main-content::-webkit-scrollbar {
            width: 8px;
        }
        
        .sidebar::-webkit-scrollbar-track,
        .main-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-thumb,
        .main-content::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover,
        .main-content::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
        
        /* Card styles */
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            overflow: hidden;
            background: white;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .btn {
            border-radius: 0.5rem;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: var(--transition);
        }
        
        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        .avatar-initial i {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Fixed Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <button class="sidebar-toggle me-2 d-lg-none">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Navbar Brand -->
                <a class="navbar-brand fw-bold" href="{{ route('dashboard.index') }}">
                    <span class="logo-icon">
                        <i class="fas fa-store"></i>
                    </span>
                    <span class="d-none d-md-inline">Aplikasi Penjualan</span>
                </a>
                
                <!-- Navbar Items -->
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar avatar-sm me-2">
                                    <div class="avatar-initial bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <span class="d-none d-md-inline">User</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end animate__animated animate__fadeIn" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user me-2"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2"></i> Settings
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Fixed Sidebar -->
    <div class="sidebar" data-aos="fade-right" data-aos-duration="500">
        <div class="sidebar-content">
            <div class="pt-4 px-3">
                <div class="text-center mb-4">
                    <div class="avatar avatar-md mx-auto mb-2">
                        <div class="avatar-initial">
                            <i class="fas fa-user-alt"></i>
                        </div>
                    </div>
                    <h6 class="mb-0 fw-bold">Admin User</h6>
                    <small class="text-muted">Administrator</small>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard.index') }}">
                            <i class="fas fa-home-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users"></i>
                            <span>Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-box"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Scrollable Main Content -->
    <main class="main-content animate__animated animate__fadeIn">
        @yield('content')
    </main>

    <!-- Fixed Footer -->
    <footer class="animate__animated animate__fadeInUp">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="container text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} <strong>Muhammad Ilham Ramdhani || 220511113.</strong> All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Mobile sidebar toggle
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
            
            // Add overlay when sidebar is open on mobile
            if (document.querySelector('.sidebar').classList.contains('show')) {
                const overlay = document.createElement('div');
                overlay.className = 'sidebar-overlay';
                overlay.style.position = 'fixed';
                overlay.style.top = '0';
                overlay.style.left = '0';
                overlay.style.right = '0';
                overlay.style.bottom = '0';
                overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
                overlay.style.zIndex = '1035';
                overlay.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.remove('show');
                    document.body.removeChild(overlay);
                });
                document.body.appendChild(overlay);
            } else {
                const overlay = document.querySelector('.sidebar-overlay');
                if (overlay) {
                    document.body.removeChild(overlay);
                }
            }
        });
        
        // Close sidebar when clicking on a link (mobile)
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    document.querySelector('.sidebar').classList.remove('show');
                    const overlay = document.querySelector('.sidebar-overlay');
                    if (overlay) {
                        document.body.removeChild(overlay);
                    }
                }
            });
        });
        
        // Adjust main content height on resize
        function adjustMainContentHeight() {
            const headerHeight = document.querySelector('.navbar').offsetHeight;
            const footerHeight = document.querySelector('footer').offsetHeight;
            document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);
            document.documentElement.style.setProperty('--footer-height', `${footerHeight}px`);
        }
        
        window.addEventListener('resize', adjustMainContentHeight);
        window.addEventListener('load', adjustMainContentHeight);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    @if($message = Session::get('success'))
        <script>
            Swal.fire({
            title: "{{ $message }}",
            icon: "success",
            draggable: true
            }); 
        </script>
    @endif
    @if($message = Session::get('failed'))
        <script>
            Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ $message }}",
            });
        </script>
    @endif
</body>
</html>