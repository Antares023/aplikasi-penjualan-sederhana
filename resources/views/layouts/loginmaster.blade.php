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
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @stack('styles')
    
    <style>
        :root {
            --primary-50: #f0f9ff;
            --primary-100: #e0f2fe;
            --primary-200: #bae6fd;
            --primary-300: #7dd3fc;
            --primary-400: #38bdf8;
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --primary-800: #075985;
            --primary-900: #0c4a6e;
            --primary-950: #082f49;
            
            --secondary-500: #ec4899;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --sidebar-width: 260px;
            --header-height: 70px;
            --footer-height: 60px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius: 12px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
            height: 100vh;
        }
        
        /* Header - Glass Morphism Effect */
        .navbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            height: var(--header-height);
            z-index: 1030; /* Pastikan header selalu di atas */
            transition: var(--transition);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-700);
            transition: var(--transition);
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .navbar-brand:hover {
            color: var(--primary-900);
            transform: translateX(2px);
        }
        
        .navbar-brand .logo-icon {
            font-size: 1.5rem;
            color: var(--primary-500);
        }
        
        /* Sidebar - Modern Glass Effect */
        .sidebar {
            position: fixed;
            top: 0; /* Mulai dari bawah header */
            left: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            width: var(--sidebar-width);
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            z-index: 1025; /* Lebih rendah dari navbar */
            overflow-y: auto;
            padding-bottom: var(--footer-height);
            border-right: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .sidebar-content {
            min-height: calc(100vh - var(--header-height) - var(--footer-height));
            display: flex;
            flex-direction: column;
            padding: 1rem 0;
        }
        
        .sidebar .nav-link {
            color: #475569;
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 1rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary-500);
            transform: translateX(-100%);
            transition: var(--transition);
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
        }
        
        .sidebar .nav-link:hover {
            color: var(--primary-700);
            background: rgba(14, 165, 233, 0.1);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link:hover::before {
            transform: translateX(0);
        }
        
        .sidebar .nav-link.active {
            color: white;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-700));
            box-shadow: 0 4px 6px -1px rgba(14, 165, 233, 0.3);
        }
        
        .sidebar .nav-link.active::before {
            display: none;
        }
        
        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 12px;
            transition: var(--transition);
            font-size: 1.1rem;
        }
        
        .sidebar .nav-link.active i {
            color: white;
        }
        
        /* Main Content - Modern Layout */
/* Perbaikan untuk footer */
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
            /* Tambahkan ini */
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Pastikan main content tidak menutupi footer */
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
            z-index: 1010; /* Lebih rendah dari sidebar dan navbar */
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1040;
                padding-bottom: 0;
                background: rgba(255, 255, 255, 0.95);
            }
            
            .sidebar.show {
                transform: translateX(0);
                box-shadow: 2px 0 30px rgba(0, 0, 0, 0.2);
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
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-300);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-400);
        }
        
        /* Card styles - Modern with hover effect */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            overflow: hidden;
            background: white;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(14, 165, 233, 0.2);
            border-color: rgba(14, 165, 233, 0.2);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            color: white;
            font-weight: 600;
            border-bottom: none;
        }
        
        /* Button styles */
        .btn {
            border-radius: var(--border-radius);
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: var(--transition);
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            box-shadow: 0 4px 6px rgba(14, 165, 233, 0.2);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(14, 165, 233, 0.3);
        }
        
        /* Dropdown styles */
        .dropdown-menu {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 0.5rem;
            animation: fadeInDropdown 0.2s ease-out;
        }
        
        @keyframes fadeInDropdown {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-item {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            margin: 0.15rem 0;
            transition: var(--transition);
        }
        
        .dropdown-item:hover {
            background: var(--primary-100);
            color: var(--primary-700);
        }
        
        /* Avatar styles */
        .avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
            transition: var(--transition);
        }
        
        .avatar-sm {
            width: 36px;
            height: 36px;
        }
        
        .avatar-md {
            width: 48px;
            height: 48px;
        }
        
        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            color: white;
            font-weight: 600;
        }
        
        /* Badge styles */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 50rem;
        }
        
        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.65rem;
            background: var(--secondary-500);
            color: white;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }
        
        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .ripple {
            position: relative;
            overflow: hidden;
        }
        
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Floating action button */
        .fab {
            position: fixed;
            bottom: calc(var(--footer-height) + 20px);
            right: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.3);
            z-index: 1000;
            transition: var(--transition);
            cursor: pointer;
        }
        
        .fab:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 25px rgba(14, 165, 233, 0.4);
        }
        
        /* Modern input styles */
        .form-control {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }
        
        .form-control:focus {
            border-color: var(--primary-300);
            box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.15);
        }
        
        /* Table styles */
        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
        }
        
        .table thead th {
            background-color: var(--primary-600);
            color: white;
            border-bottom: none;
        }
        
        .table-hover tbody tr:hover {
            background-color: var(--primary-50);
        }
    </style>
</head>
<body>
    <!-- Fixed Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button class="sidebar-toggle me-2 d-lg-none btn btn-sm btn-primary">
                    <i class="fas fa-bars text-white"></i>
                </button>
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
                    <h6 class="mb-0 fw-bold">Unknown</h6>
                    <small class="text-muted">Need to Login</small>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item" data-aos="fade-right" data-aos-delay="100">
                        <a class="nav-link" href="{{ route('auth.register') }}">
                            <i class="fas fa-user-plus"></i>
                            <span>Register</span>
                        </a>
                    </li>
                    <li class="nav-item" data-aos="fade-right" data-aos-delay="200">
                        <a class="nav-link" href="{{ route('auth.login') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Login</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Scrollable Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Floating Action Button -->
    <div class="fab ripple" id="fabButton">
        <i class="fas fa-plus"></i>
    </div>

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
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
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
        
        // Ripple effect
        document.querySelectorAll('.ripple').forEach(element => {
            element.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.className = 'ripple-effect';
                
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = `${size}px`;
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
        
        // Floating action button click
        document.getElementById('fabButton').addEventListener('click', function() {
            // Show a toast notification
            const toast = document.createElement('div');
            toast.className = 'position-fixed bottom-0 end-0 p-3';
            toast.style.zIndex = '1100';
            
            const toastContent = document.createElement('div');
            toastContent.className = 'toast show';
            toastContent.role = 'alert';
            toastContent.setAttribute('aria-live', 'assertive');
            toastContent.setAttribute('aria-atomic', 'true');
            
            toastContent.innerHTML = `
                <div class="toast-header bg-primary text-white">
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    New action triggered from FAB!
                </div>
            `;
            
            toast.appendChild(toastContent);
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    @if($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "{{ $message }}",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
                background: 'var(--primary-50)',
                backdrop: `
                    rgba(14,165,233,0.2)
                    url("/images/nyan-cat.gif")
                    left top
                    no-repeat
                `
            }); 
        </script>
    @endif
    @if($message = Session::get('failed'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ $message }}",
                background: 'var(--primary-50)'
            });
        </script>
    @endif
</body>
</html>