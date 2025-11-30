<script type="module">
// Wait for Vite to load Swal
document.addEventListener('DOMContentLoaded', function() {
    // Check if Swal is available, if not wait for it
    const initializeSweetAlert = () => {
        if (typeof window.Swal === 'undefined') {
            setTimeout(initializeSweetAlert, 50);
            return;
        }

        // SweetAlert Configuration
        const Toast = window.Swal.mixin({
            toast: true,
            position: '{{ app()->getLocale() === "ar" ? "top-start" : "top-end" }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', window.Swal.stopTimer)
                toast.addEventListener('mouseleave', window.Swal.resumeTimer)
            }
        });

        // Global SweetAlert function for success messages
        window.showSuccessAlert = function(message) {
            Toast.fire({
                icon: 'success',
                title: message
            });
        };

        // Global SweetAlert function for error messages
        window.showErrorAlert = function(message) {
            Toast.fire({
                icon: 'error',
                title: message
            });
        };

        // Global SweetAlert function for warning messages
        window.showWarningAlert = function(message) {
            Toast.fire({
                icon: 'warning',
                title: message
            });
        };

        // Global SweetAlert function for info messages
        window.showInfoAlert = function(message) {
            Toast.fire({
                icon: 'info',
                title: message
            });
        };

        // Global SweetAlert function for confirmation
        window.showConfirmAlert = function(options) {
            return window.Swal.fire({
                title: options.title || '{{ __("messages.are_you_sure") }}',
                text: options.text || '',
                icon: options.icon || 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: options.confirmButtonText || '{{ __("messages.yes_delete") }}',
                cancelButtonText: options.cancelButtonText || '{{ __("messages.cancel") }}',
                reverseButtons: {{ app()->getLocale() === 'ar' ? 'true' : 'false' }}
            });
        };

        // Display flash messages
        @if(session('success'))
            showSuccessAlert('{{ session('success') }}');
        @endif

        @if(session('error'))
            showErrorAlert('{{ session('error') }}');
        @endif

        @if(session('warning'))
            showWarningAlert('{{ session('warning') }}');
        @endif

        @if(session('info'))
            showInfoAlert('{{ session('info') }}');
        @endif

        @if($errors->any())
            let errorMessages = '<ul style="text-align: {{ app()->getLocale() === "ar" ? "right" : "left" }}; margin: 0; padding-left: 20px;">';
            @foreach($errors->all() as $error)
                errorMessages += '<li>{{ $error }}</li>';
            @endforeach
            errorMessages += '</ul>';

            window.Swal.fire({
                icon: 'error',
                title: '{{ __("messages.error") }}',
                html: errorMessages,
                confirmButtonText: '{{ __("messages.ok") }}'
            });
        @endif

        // Delete confirmation handler
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const itemName = this.getAttribute('data-item-name') || '';
                const itemType = this.getAttribute('data-item-type') || '{{ __("messages.item") }}';

                showConfirmAlert({
                    title: '{{ __("messages.are_you_sure") }}',
                    text: '{{ __("messages.cannot_revert") }}',
                    confirmButtonText: '{{ __("messages.yes_delete") }}',
                    cancelButtonText: '{{ __("messages.cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    };

    // Start initialization
    initializeSweetAlert();
});
</script>
