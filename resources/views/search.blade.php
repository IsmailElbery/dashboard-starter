<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'ar' ? 'ar' : 'en' }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ app()->getLocale() === 'ar' ? 'البحث' : 'Search' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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

        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-lg);
            align-items: start;
        }

        @media (max-width: 992px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }
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
            max-width: 700px;
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

        /* Form Card */
        .form-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: var(--spacing-xl);
            box-shadow: var(--shadow-md);
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: var(--neutral-900);
            margin-bottom: var(--spacing-sm);
        }

        .form-label .required {
            color: #dc3545;
            margin-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 4px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--neutral-300);
            border-radius: var(--radius-md);
            font-family: var(--font-family);
            font-size: 16px;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(0, 108, 53, 0.1);
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23737373' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: {{ app()->getLocale() === 'ar' ? 'left' : 'right' }} 16px center;
            padding-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}: 40px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 150px;
        }

        .form-hint {
            font-size: 14px;
            color: var(--neutral-500);
            margin-top: var(--spacing-xs);
        }

        .btn-submit {
            background: var(--primary-green);
            color: var(--white);
            border: none;
            padding: 16px 48px;
            border-radius: var(--radius-md);
            font-family: var(--font-family);
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover:not(:disabled) {
            background: var(--primary-green-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-submit:disabled {
            background: var(--neutral-300);
            cursor: not-allowed;
            transform: none;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .hidden {
            display: none !important;
        }

        /* Results Section */
        .results-section {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            min-height: 400px;
        }

        .results-header {
            padding: var(--spacing-md) var(--spacing-lg);
            background: linear-gradient(135deg, var(--primary-green-light), var(--primary-green));
            color: var(--white);
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .results-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .results-count-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .results-body {
            padding: var(--spacing-lg);
        }

        .results-empty {
            text-align: center;
            padding: var(--spacing-2xl) var(--spacing-lg);
            color: var(--neutral-500);
        }

        .results-empty-icon {
            font-size: 64px;
            margin-bottom: var(--spacing-md);
            opacity: 0.3;
        }

        .results-empty-text {
            font-size: 18px;
            font-weight: 600;
            color: var(--neutral-700);
        }

        .result-card {
            background: var(--neutral-100);
            border-radius: var(--radius-md);
            padding: var(--spacing-md);
            margin-bottom: var(--spacing-md);
            border-left: 4px solid var(--primary-green);
            transition: all 0.3s ease;
        }

        .result-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateX({{ app()->getLocale() === 'ar' ? '' : '-' }}4px);
        }

        .result-row {
            display: flex;
            margin-bottom: var(--spacing-sm);
            padding-bottom: var(--spacing-sm);
            border-bottom: 1px solid var(--neutral-300);
        }

        .result-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .result-label {
            font-weight: 700;
            color: var(--neutral-700);
            min-width: 120px;
            flex-shrink: 0;
        }

        .result-value {
            color: var(--neutral-900);
            word-break: break-word;
        }

        .result-timestamp {
            font-size: 12px;
            color: var(--neutral-500);
            margin-top: var(--spacing-sm);
            display: flex;
            align-items: center;
            gap: 4px;
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

            .form-card {
                padding: var(--spacing-md);
            }

            .btn-submit {
                padding: 14px 32px;
                font-size: 16px;
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
            <h1 class="page-title">{{ app()->getLocale() === 'ar' ? 'البحث المتقدم' : 'Advanced Search' }}</h1>
            <div class="divider" aria-hidden="true"></div>
            <p class="page-subtitle">
                {{ app()->getLocale() === 'ar' ? 'استخدم نموذج البحث أدناه للعثور على ما تبحث عنه بسهولة' : 'Use the search form below to easily find what you are looking for' }}
            </p>
        </div>

        <!-- Content Wrapper: Form + Results Side by Side -->
        <div class="content-wrapper">
            <!-- Search Form -->
            <div class="form-card">
                <form id="searchForm">
                    <!-- Search Type Dropdown -->
                    <div class="form-group">
                        <label for="search_type" class="form-label">
                            {{ app()->getLocale() === 'ar' ? 'نوع البحث' : 'Search Type' }}
                            <span class="required">*</span>
                        </label>
                        <select id="search_type" name="search_type" class="form-control" required>
                            <option value="">{{ app()->getLocale() === 'ar' ? 'اختر نوع البحث...' : 'Select search type...' }}</option>
                            <option value="option1">{{ app()->getLocale() === 'ar' ? 'الخيار الأول' : 'Option 1' }}</option>
                            <option value="option2">{{ app()->getLocale() === 'ar' ? 'الخيار الثاني' : 'Option 2' }}</option>
                            <option value="option3">{{ app()->getLocale() === 'ar' ? 'الخيار الثالث' : 'Option 3' }}</option>
                        </select>
                        <div class="form-hint">{{ app()->getLocale() === 'ar' ? 'اختر فئة البحث المناسبة' : 'Select the appropriate search category' }}</div>
                    </div>

                    <!-- Search Query Textarea -->
                    <div class="form-group">
                        <label for="search_query" class="form-label">
                            {{ app()->getLocale() === 'ar' ? 'استعلام البحث' : 'Search Query' }}
                            <span class="required">*</span>
                        </label>
                        <textarea id="search_query" name="search_query" class="form-control" required
                            placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل استعلام البحث هنا...' : 'Enter your search query here...' }}"></textarea>
                        <div class="form-hint">{{ app()->getLocale() === 'ar' ? 'قدم وصفًا تفصيليًا لما تبحث عنه (حد أقصى 1000 حرف)' : 'Provide a detailed description of what you are looking for (max 1000 characters)' }}</div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span id="btnText">{{ app()->getLocale() === 'ar' ? 'إرسال البحث' : 'Submit Search' }}</span>
                        <span class="spinner hidden" id="spinner"></span>
                    </button>
                </form>
            </div>

            <!-- Results Section -->
            <div class="results-section">
                <div class="results-header">
                    <h2 class="results-title">
                        <span>📋</span>
                        <span>{{ app()->getLocale() === 'ar' ? 'نتائج البحث' : 'Search Results' }}</span>
                    </h2>
                    <span class="results-count-badge hidden" id="resultsCountBadge">0</span>
                </div>
                <div class="results-body">
                    <div class="results-empty" id="resultsEmpty">
                        <div class="results-empty-icon">🔍</div>
                        <div class="results-empty-text">{{ app()->getLocale() === 'ar' ? 'لا توجد نتائج بعد' : 'No results yet' }}</div>
                        <p style="margin-top: 12px; color: var(--neutral-500);">
                            {{ app()->getLocale() === 'ar' ? 'قم بإرسال نموذج البحث لعرض النتائج هنا' : 'Submit the search form to view results here' }}
                        </p>
                    </div>
                    <div id="resultsContent" class="hidden"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer" role="contentinfo">
        <div class="footer-content">
            <p>© {{ date('Y') }} {{ app()->getLocale() === 'ar' ? 'جميع الحقوق محفوظة' : 'All rights reserved' }}</p>
        </div>
    </footer>

    <script>
        document.getElementById('searchForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const spinner = document.getElementById('spinner');
            const resultsContent = document.getElementById('resultsContent');
            const resultsEmpty = document.getElementById('resultsEmpty');
            const resultsCountBadge = document.getElementById('resultsCountBadge');

            // Get form data
            const formData = {
                search_type: document.getElementById('search_type').value,
                search_query: document.getElementById('search_query').value
            };

            // Disable button and show spinner
            submitBtn.disabled = true;
            btnText.textContent = '{{ app()->getLocale() === 'ar' ? 'جاري الإرسال...' : 'Submitting...' }}';
            spinner.classList.remove('hidden');
            resultsContent.classList.add('hidden');
            resultsEmpty.classList.remove('hidden');
            resultsCountBadge.classList.add('hidden');

            try {
                // Submit to API
                const response = await fetch('{{ route('search.submit') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (data.success) {
                    // Show success alert if SweetAlert is available
                    if (typeof showSuccessAlert === 'function') {
                        showSuccessAlert(data.message);
                    }

                    // Get current timestamp
                    const now = new Date();
                    const timestamp = now.toLocaleString('{{ app()->getLocale() === 'ar' ? 'ar-SA' : 'en-US' }}', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    // Display results in a nice card format
                    resultsContent.innerHTML = `
                        <div class="result-card">
                            <div class="result-row">
                                <span class="result-label">{{ app()->getLocale() === 'ar' ? 'نوع البحث:' : 'Search Type:' }}</span>
                                <span class="result-value">${data.data.search_type}</span>
                            </div>
                            <div class="result-row">
                                <span class="result-label">{{ app()->getLocale() === 'ar' ? 'الاستعلام:' : 'Query:' }}</span>
                                <span class="result-value">${data.data.search_query}</span>
                            </div>
                            <div class="result-row">
                                <span class="result-label">{{ app()->getLocale() === 'ar' ? 'عدد النتائج:' : 'Results Count:' }}</span>
                                <span class="result-value">${data.data.results_count}</span>
                            </div>
                            <div class="result-timestamp">
                                <span>🕒</span>
                                <span>${timestamp}</span>
                            </div>
                        </div>
                    `;

                    // Show results and hide empty state
                    resultsEmpty.classList.add('hidden');
                    resultsContent.classList.remove('hidden');
                    resultsCountBadge.textContent = data.data.results_count;
                    resultsCountBadge.classList.remove('hidden');

                    // Reset form
                    document.getElementById('searchForm').reset();
                } else {
                    if (typeof showErrorAlert === 'function') {
                        showErrorAlert(data.message || '{{ __("messages.error") }}');
                    } else {
                        alert(data.message || 'An error occurred');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                if (typeof showErrorAlert === 'function') {
                    showErrorAlert('{{ __("messages.error") }}');
                } else {
                    alert('An error occurred while submitting the form');
                }
            } finally {
                // Re-enable button and hide spinner
                submitBtn.disabled = false;
                btnText.textContent = '{{ app()->getLocale() === 'ar' ? 'إرسال البحث' : 'Submit Search' }}';
                spinner.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
