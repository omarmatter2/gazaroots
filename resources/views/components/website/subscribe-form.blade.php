<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="gr-subscribe">
    <div class="container">
        <div class="gr-subscribe__box">
            <h2 class="gr-subscribe__title">
                Subscribe to Gaza Roots News
            </h2>

            <p class="gr-subscribe__desc">
                Enter your email to receive the latest updates and breaking news from Gaza
            </p>

            <form id="subscribe-form" class="gr-subscribe__form">
                @csrf
                <input
                    type="email"
                    name="email"
                    id="subscribe-email"
                    placeholder="Enter your email"
                    class="gr-subscribe__input"
                    required
                />

                <button type="submit" class="gr-subscribe__btn" id="subscribe-btn">
                    <span id="btn-loading" style="display: none;">
                        <svg class="subscribe-spinner" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3A5A33" stroke-width="2">
                            <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                            <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path>
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>
</section>

<style>
    .subscribe-spinner {
        animation: subscribe-spin 1s linear infinite;
    }
    @keyframes subscribe-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    #subscribe-btn.loading::before {
        display: none;
    }
    .gr-subscribe__input.error {
        border-color: #ef4444 !important;
    }
    .gr-subscribe__input.success {
        border-color: #10b981 !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('subscribe-form');
    if (!form) return;

    const emailInput = document.getElementById('subscribe-email');
    const submitBtn = document.getElementById('subscribe-btn');
    const btnLoading = document.getElementById('btn-loading');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Reset states
        emailInput.classList.remove('error', 'success');

        // Show loading
        btnLoading.style.display = 'inline-block';
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;

        try {
            const response = await fetch('{{ route("subscribe") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    email: emailInput.value
                })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                // Success - SweetAlert
                emailInput.value = '';
                Swal.fire({
                    icon: 'success',
                    title: 'Subscribed!',
                    text: data.message || 'Thank you for subscribing to our newsletter!',
                    confirmButtonColor: '#3A5A33',
                    timer: 4000,
                    timerProgressBar: true
                });
            } else {
                // Validation error - SweetAlert
                const errorText = data.message || data.errors?.email?.[0] || 'Something went wrong. Please try again.';
                emailInput.classList.add('error');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errorText,
                    confirmButtonColor: '#3A5A33'
                });
            }
        } catch (error) {
            emailInput.classList.add('error');
            Swal.fire({
                icon: 'error',
                title: 'Network Error',
                text: 'Please check your connection and try again.',
                confirmButtonColor: '#3A5A33'
            });
        } finally {
            // Hide loading
            btnLoading.style.display = 'none';
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
        }
    });

    // Remove error state on input
    emailInput.addEventListener('input', function() {
        this.classList.remove('error');
    });
});
</script>
