<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <x-seo 
        :title="$title ?? null" 
        :description="$description ?? null" 
        :image="$image ?? null"
        :product="$product ?? null"
    />

    <!-- Scripts & Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900 antialiased font-sans flex flex-col min-h-screen selection:bg-[#d32f2f] selection:text-white">
    
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Toast Container -->
    <div id="toast-container">
        @if(session('success'))
            <div class="toast-item toast-success" id="success-toast">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <div class="toast-content">
                    <span class="toast-title">Success</span>
                    <span class="toast-message">{{ session('success') }}</span>
                </div>
                <i class="bi bi-x toast-close" onclick="closeToast('success-toast')"></i>
            </div>
        @endif

        @if(session('error'))
            <div class="toast-item toast-error" id="error-toast">
                <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                <div class="toast-content">
                    <span class="toast-title">Error</span>
                    <span class="toast-message">{{ session('error') }}</span>
                </div>
                <i class="bi bi-x toast-close" onclick="closeToast('error-toast')"></i>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <script>
        // Toast logic
        function closeToast(id) {
            const toast = document.getElementById(id);
            if (toast) {
                toast.classList.add('hiding');
                setTimeout(() => toast.remove(), 500);
            }
        }

        // Auto-close toasts
        window.addEventListener('load', () => {
            const successToast = document.getElementById('success-toast');
            const errorToast = document.getElementById('error-toast');

            if (successToast) {
                setTimeout(() => closeToast('success-toast'), 4000);
            }
            if (errorToast) {
                setTimeout(() => closeToast('error-toast'), 4000);
            }
        });

        // Global function for JS-triggered toasts
        window.showToast = function(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if(!container) return;
            const id = 'toast-' + Date.now();
            const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
            
            const toastHtml = `
                <div class="toast-item toast-${type}" id="${id}">
                    <i class="bi ${icon} text-xl"></i>
                    <div class="toast-content">
                        <span class="toast-title">${type === 'success' ? 'Success' : 'Error'}</span>
                        <span class="toast-message">${message}</span>
                    </div>
                    <i class="bi bi-x toast-close" onclick="closeToast('${id}')"></i>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', toastHtml);
            setTimeout(() => closeToast(id), 4000);
        };
    </script>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true,
                    offset: 100
                });
            }
        });
    </script>
</body>
</html>
