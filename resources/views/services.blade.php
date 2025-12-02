<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'ar' ? 'ar' : 'en' }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() === 'ar' ? 'الخدمات الإلكترونية' : 'Electronic Services' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* DGA Color Palette */
            --primary-green: #006C35;
            --primary-green-light: #008844;
            --primary-green-dark: #005028;
            --neutral-900: #1A1A1A;
            --neutral-700: #4A4A4A;
            --neutral-500: #737373;
            --neutral-300: #D4D4D4;
            --neutral-100: #F5F5F5;
            --white: #FFFFFF;

            /* Typography */
            --font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;

            /* Spacing */
            --spacing-xs: 8px;
            --spacing-sm: 16px;
            --spacing-md: 24px;
            --spacing-lg: 32px;
            --spacing-xl: 48px;
            --spacing-2xl: 64px;

            /* Border Radius */
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;

            /* Shadows */
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: var(--font-family);
            background: var(--neutral-100);
            color: var(--neutral-900);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: var(--primary-green-dark);
            border-bottom: 3px solid var(--primary-green);
            padding: var(--spacing-md) var(--spacing-lg);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            text-decoration: none;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: var(--primary-green);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 28px;
            font-weight: bold;
            box-shadow: var(--shadow-md);
        }

        .org-info {
            display: flex;
            flex-direction: column;
        }

        .org-name {
            font-size: 22px;
            font-weight: 700;
            color: var(--neutral-900);
        }

        .org-name-en {
            font-size: 14px;
            color: var(--neutral-500);
            font-weight: 400;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
            padding: var(--spacing-xl) var(--spacing-md);
            width: 100%;
        }

        /* Page Title Section */
        .page-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .page-title {
            font-size: 36px;
            font-weight: 700;
            color: var(--neutral-900);
            margin-bottom: var(--spacing-sm);
        }

        .page-subtitle {
            font-size: 18px;
            color: var(--neutral-700);
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .divider {
            width: 80px;
            height: 4px;
            background: var(--primary-green);
            margin: var(--spacing-md) auto;
            border-radius: 2px;
        }

        /* Search and Filter Section */
        .controls-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
            gap: var(--spacing-md);
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px {{ app()->getLocale() === 'ar' ? '48px 16px 12px' : '16px 48px 12px 16px' }};
            border: 2px solid var(--neutral-300);
            border-radius: var(--radius-md);
            font-family: var(--font-family);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(0, 108, 53, 0.1);
        }

        .search-icon {
            position: absolute;
            {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: var(--neutral-500);
        }

        .results-count {
            font-size: 16px;
            color: var(--neutral-700);
            font-weight: 600;
        }

        /* Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .card {
            background: var(--white);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .card-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--primary-green-light), var(--primary-green));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            color: var(--white);
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-badge {
            position: absolute;
            top: 12px;
            {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 12px;
            background: var(--primary-green);
            color: var(--white);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .card-content {
            padding: var(--spacing-md);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--neutral-900);
            margin-bottom: var(--spacing-sm);
            line-height: 1.4;
        }

        .card-description {
            font-size: 15px;
            color: var(--neutral-700);
            line-height: 1.7;
            flex: 1;
            margin-bottom: var(--spacing-md);
        }

        .no-results {
            text-align: center;
            padding: var(--spacing-2xl);
            color: var(--neutral-500);
            font-size: 18px;
        }

        .hidden {
            display: none !important;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-2xl);
            flex-wrap: wrap;
        }

        .pagination-info {
            font-size: 15px;
            color: var(--neutral-700);
            margin-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: var(--spacing-md);
        }

        .pagination-btn {
            background: var(--white);
            border: 2px solid var(--neutral-300);
            color: var(--neutral-900);
            padding: 10px 16px;
            border-radius: var(--radius-md);
            font-family: var(--font-family);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-width: 44px;
            justify-content: center;
        }

        .pagination-btn:hover:not(:disabled) {
            background: var(--primary-green);
            color: var(--white);
            border-color: var(--primary-green);
            transform: translateY(-2px);
        }

        .pagination-btn.active {
            background: var(--primary-green);
            color: var(--white);
            border-color: var(--primary-green);
        }

        .pagination-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Footer */
        .footer {
            background: var(--neutral-900);
            color: var(--white);
            padding: var(--spacing-lg);
            margin-top: auto;
            text-align: center;
            height: 10px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        .footer p {
            color: var(--neutral-300);
            font-size: 15px;
            /* margin: 4px 0; */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 28px;
            }

            .page-subtitle {
                font-size: 16px;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-md);
            }

            .controls-section {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                min-width: 100%;
            }

            .card-image {
                height: 180px;
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header" role="banner">
        <div class="header-content">
            <a href="{{ route('home') }}" class="logo-section" aria-label="{{ __('messages.home') }}">
                <!-- <div class="logo" aria-hidden="true">🇸🇦</div>
                <div class="org-info">
                    <div class="org-name">{{ app()->getLocale() === 'ar' ? 'الجهة الحكومية' : 'Government Entity' }}</div>
                    <div class="org-name-en">{{ app()->getLocale() === 'ar' ? 'Government Entity' : 'الجهة الحكومية' }}</div>
                </div> -->
                
                <img src="https://www.gadd.gov.sa/frontend/imgs/logo.svg" alt="الشعار" class="header-image">
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content" role="main">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ app()->getLocale() === 'ar' ? 'الخدمات الإلكترونية' : 'Electronic Services' }}</h1>
            <div class="divider" aria-hidden="true"></div>
            <p class="page-subtitle">
                {{ app()->getLocale() === 'ar' ? 'تصفح جميع الخدمات الإلكترونية المتاحة واختر الخدمة المناسبة لاحتياجاتك بكل سهولة ويسر' : 'Browse all available electronic services and choose the service that suits your needs with ease' }}
            </p>
        </div>

        <!-- Search and Controls -->
        <div class="controls-section">
            <div class="search-box">
                <input
                    type="search"
                    id="searchInput"
                    class="search-input"
                    placeholder="{{ app()->getLocale() === 'ar' ? 'ابحث عن الخدمة...' : 'Search for service...' }}"
                    aria-label="{{ __('messages.services') }}"
                >
                <span class="search-icon" aria-hidden="true">🔍</span>
            </div>
            <div class="results-count" id="resultsCount">
                {{ app()->getLocale() === 'ar' ? 'عرض' : 'Showing' }} <span id="showingCount">{{ $services->count() }}</span> {{ app()->getLocale() === 'ar' ? 'من أصل' : 'of' }} <span id="totalCount">{{ $services->count() }}</span> {{ app()->getLocale() === 'ar' ? 'خدمة' : 'services' }}
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="cards-grid" id="cardsGrid">
            @forelse($services as $service)
            <article class="card service-card" data-title="{{ strtolower($service->title) }}" data-description="{{ strtolower($service->description) }}">
                <div class="card-image">
                    @if($service->photo)
                        <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->title }}">
                    @else
                        <span aria-hidden="true">🔧</span>
                    @endif
                    <span class="card-badge">{{ __('messages.order') }}: {{ $service->order }}</span>
                </div>
                <div class="card-content">
                    <h2 class="card-title">{{ $service->title }}</h2>
                    <p class="card-description">
                        {{ Str::limit($service->description, 150) }}
                    </p>
                </div>
            </article>
            @empty
            <div class="no-results" style="grid-column: 1/-1;">
                {{ app()->getLocale() === 'ar' ? 'لا توجد خدمات متاحة حالياً' : 'No services available at the moment' }}
            </div>
            @endforelse
        </div>

        <div class="no-results hidden" id="noResults">
            {{ app()->getLocale() === 'ar' ? 'لم يتم العثور على نتائج' : 'No results found' }}
        </div>

        <!-- Pagination -->
        <nav class="pagination-container hidden" id="paginationContainer" role="navigation" aria-label="{{ app()->getLocale() === 'ar' ? 'التنقل بين الصفحات' : 'Pagination' }}">
            <button class="pagination-btn" id="prevBtn" aria-label="{{ app()->getLocale() === 'ar' ? 'الصفحة السابقة' : 'Previous page' }}">
                <span>{{ app()->getLocale() === 'ar' ? 'السابق' : 'Previous' }}</span>
            </button>

            <div id="pageButtons"></div>

            <button class="pagination-btn" id="nextBtn" aria-label="{{ app()->getLocale() === 'ar' ? 'الصفحة التالية' : 'Next page' }}">
                <span>{{ app()->getLocale() === 'ar' ? 'التالي' : 'Next' }}</span>
            </button>

            <div class="pagination-info" id="paginationInfo"></div>
        </nav>
    </main>

    <!-- Footer -->
    <footer class="footer" role="contentinfo">
        <div class="footer-content">
            <p>© {{ date('Y') }} {{ app()->getLocale() === 'ar' ? 'جميع الحقوق محفوظة' : 'All rights reserved' }}</p>
        </div>
    </footer>

    <script>
        // Pagination and Search Configuration
        const cardsPerPage = 12;
        let currentPage = 1;
        let filteredCards = [];

        const cardsGrid = document.getElementById('cardsGrid');
        const searchInput = document.getElementById('searchInput');
        const paginationContainer = document.getElementById('paginationContainer');
        const pageButtons = document.getElementById('pageButtons');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const paginationInfo = document.getElementById('paginationInfo');
        const noResults = document.getElementById('noResults');
        const showingCount = document.getElementById('showingCount');
        const totalCount = document.getElementById('totalCount');

        const allCards = Array.from(document.querySelectorAll('.service-card'));
        filteredCards = allCards;

        // Initialize
        if (allCards.length > cardsPerPage) {
            showPage(1);
        }

        // Search functionality
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase().trim();

            if (searchTerm === '') {
                filteredCards = allCards;
            } else {
                filteredCards = allCards.filter(card => {
                    const title = card.dataset.title;
                    const description = card.dataset.description;
                    return title.includes(searchTerm) || description.includes(searchTerm);
                });
            }

            currentPage = 1;
            showPage(1);
        });

        // Pagination functionality
        function showPage(page) {
            currentPage = page;
            const totalPages = Math.ceil(filteredCards.length / cardsPerPage);

            // Hide all cards
            allCards.forEach(card => card.classList.add('hidden'));

            // Show filtered cards for current page
            const start = (page - 1) * cardsPerPage;
            const end = start + cardsPerPage;
            const cardsToShow = filteredCards.slice(start, end);

            cardsToShow.forEach(card => card.classList.remove('hidden'));

            // Update counts
            showingCount.textContent = filteredCards.length;
            totalCount.textContent = allCards.length;

            // Show/hide no results message
            if (filteredCards.length === 0) {
                noResults.classList.remove('hidden');
                paginationContainer.classList.add('hidden');
            } else {
                noResults.classList.add('hidden');

                // Show/hide pagination
                if (totalPages > 1) {
                    paginationContainer.classList.remove('hidden');
                    updatePagination(totalPages);
                } else {
                    paginationContainer.classList.add('hidden');
                }
            }

            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updatePagination(totalPages) {
            // Update prev/next buttons
            prevBtn.disabled = (currentPage === 1);
            nextBtn.disabled = (currentPage === totalPages);

            // Generate page buttons
            pageButtons.innerHTML = '';
            const maxButtons = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
            let endPage = Math.min(totalPages, startPage + maxButtons - 1);

            if (endPage - startPage < maxButtons - 1) {
                startPage = Math.max(1, endPage - maxButtons + 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                const btn = document.createElement('button');
                btn.className = 'pagination-btn' + (i === currentPage ? ' active' : '');
                btn.textContent = i;
                btn.setAttribute('aria-label', `{{ app()->getLocale() === 'ar' ? 'الصفحة' : 'Page' }} ${i}`);
                if (i === currentPage) {
                    btn.setAttribute('aria-current', 'page');
                }
                btn.addEventListener('click', () => showPage(i));
                pageButtons.appendChild(btn);
            }

            // Update info text
            paginationInfo.textContent = `{{ app()->getLocale() === 'ar' ? 'الصفحة' : 'Page' }} ${currentPage} {{ app()->getLocale() === 'ar' ? 'من' : 'of' }} ${totalPages}`;
        }

        // Prev/Next button handlers
        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                showPage(currentPage - 1);
            }
        });

        nextBtn.addEventListener('click', () => {
            const totalPages = Math.ceil(filteredCards.length / cardsPerPage);
            if (currentPage < totalPages) {
                showPage(currentPage + 1);
            }
        });
    </script>
</body>
</html>
