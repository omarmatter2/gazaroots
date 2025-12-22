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


      <!-- donation Modal -->
  <div class="modal fade gr-donation-modal" id="donationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content gr-donation-modal__content">

        <div class="modal-header gr-donation-modal__header">
          <button type="button" class="gr-donation-modal__close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body gr-donation-modal__body">
          <div class="gr-donation-modal__grid">

            <!-- Left side (image / placeholder) -->
            <div class="gr-donation-modal__left">
              <!-- If you want an image, replace background in CSS or put <img> here -->
              <img src="{{asset('/website/assets/img/modal__left.svg')}}" alt="">
            </div>

            <!-- Right side (content) -->
            <div class="gr-donation-modal__right">

              <div class="gr-donation-box">
                @csrf

                <div class="gr-donation-header">
                  <h3 class="gr-donation-title">
                    <span>“Help us bring clean water to Gaza.”</span>
                  </h3>

                  <p class="gr-donation-desc">
                    Your donation, in any amount, can help build a well in Gaza
                  </p>
                </div>

                <!-- Amounts -->
                <div class="gr-donation-amounts">
                  <label class="gr-donation-option">
                    <input type="radio" name="donation_amount" value="5">
                    <span>5$</span>
                  </label>

                  <label class="gr-donation-option">
                    <input type="radio" name="donation_amount" value="10">
                    <span>10$</span>
                  </label>

                  <label class="gr-donation-option">
                    <input type="radio" name="donation_amount" value="20" checked>
                    <span>20$</span>
                  </label>

                  <label class="gr-donation-option">
                    <input type="radio" name="donation_amount" value="25">
                    <span>25$</span>
                  </label>

                  <label class="gr-donation-option">
                    <input type="radio" name="donation_amount" value="30">
                    <span>30$</span>
                  </label>

                  <label class="gr-donation-option">
                    <input type="radio" name="donation_amount" value="35">
                    <span>35$</span>
                  </label>

                  <label class="gr-donation-option">
                    <input type="radio" name="donation_amount" value="40">
                    <span>40$</span>
                  </label>

                  <label class="gr-donation-option">
                    <input type="radio" name="donation_amount" value="50">
                    <span>50$</span>
                  </label>

                  <!-- Custom amount -->
                  <label class="gr-donation-option gr-donation-option--custom">
                    <input type="radio" name="donation_amount" value="custom">
                    <span>+50$</span>
                  </label>
                </div>

                <!-- Custom input (hidden by default, shown only when custom selected) -->
                <div class="gr-donation-custom" id="grCustomAmountWrap">
                  <input id="grCustomAmountInput" type="number" placeholder="Enter amount" min="1">
                </div>

                <!-- Donation type -->
                <div class="gr-donation-type">
                  <p>Please choose your donation type.</p>

                  <label class="gr-radio">
                    <input type="radio" name="donation_type" value="one_time" checked>
                    <span class="gr-radio__circle"></span>
                    <span class="gr-radio__label">One-Time Donation</span>
                  </label>

                  <label class="gr-radio">
                    <input type="radio" name="donation_type" value="monthly">
                    <span class="gr-radio__circle"></span>
                    <span class="gr-radio__label">Monthly Donation</span>
                  </label>
                </div>

                <button class="gr-donation-btn" type="button" id="donation-submit-btn">
                  <span id="donation-btn-text">Confirm & Continue</span>
                  <span id="donation-btn-loading" style="display: none;">
                    <svg class="modal-spinner" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                      <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path>
                    </svg>
                    Processing...
                  </span>
                </button>

              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- assist Modal -->
  <div class="modal fade gr-donation-modal" id="assistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content gr-donation-modal__content">

        <div class="modal-header gr-donation-modal__header">
          <button type="button" class="gr-donation-modal__close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body gr-donation-modal__body">
          <div class="gr-donation-modal__grid">

            <!-- Left side (image / placeholder) -->
            <div class="gr-donation-modal__left">
              <!-- If you want an image, replace background in CSS or put <img> here -->
              <img src="{{asset('/website/assets/img/modal__left.svg')}}" alt="">
            </div>

            <!-- Right side (content) -->
            <div class="gr-donation-modal__right">

              <div class="gr-assist-box">
                <h2 class="gr-assist-title">REQUEST FOR ASSISTANCE</h2>

                <p class="gr-assist-desc">
                  Please fill out the form with accurate information so we can provide the appropriate assistance as
                  soon as possible.
                  <br />
                  <span>All information is kept strictly confidential.</span>
                </p>

                <form class="gr-assist-form" id="assist-form">
                  @csrf
                  <div class="gr-assist-field">
                    <input type="text" name="full_name" placeholder="Full Name" required />
                  </div>

                  <div class="gr-assist-field">
                    <input type="tel" name="phone" placeholder="Phone Number" required />
                  </div>

                  <div class="gr-assist-field">
                    <input type="email" name="email" placeholder="Email Address (Optional)" />
                  </div>

                  <div class="gr-assist-field gr-assist-field--select">
                    <select name="location" required>
                      <option value="" selected disabled>Location</option>
                      <option value="Gaza">Gaza</option>
                      <option value="North Gaza">North Gaza</option>
                      <option value="Middle Area">Middle Area</option>
                      <option value="Khan Younis">Khan Younis</option>
                      <option value="Rafah">Rafah</option>
                    </select>
                    <span class="gr-assist-select-icon"></span>
                  </div>

                  <div class="gr-assist-field">
                    <textarea name="message" rows="6" placeholder="Message.." required></textarea>
                  </div>

                  <button type="submit" class="gr-assist-btn" id="assist-submit-btn">
                    <span id="assist-btn-text">Confirm & Continue</span>
                    <span id="assist-btn-loading" style="display: none;">
                      <svg class="modal-spinner" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                        <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path>
                      </svg>
                      Submitting...
                    </span>
                  </button>
                </form>
              </div>



            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</section>

<style>
    .subscribe-spinner, .modal-spinner {
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
    .gr-donation-btn, .gr-assist-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .gr-donation-btn:disabled, .gr-assist-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
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

    // ========================================
    // DONATION MODAL - AJAX Handler
    // ========================================
    const donationBtn = document.getElementById('donation-submit-btn');
    const customAmountWrap = document.getElementById('grCustomAmountWrap');
    const customAmountInput = document.getElementById('grCustomAmountInput');

    // Show/hide custom amount input
    document.querySelectorAll('input[name="donation_amount"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'custom') {
                customAmountWrap.style.display = 'block';
                customAmountInput.focus();
            } else {
                customAmountWrap.style.display = 'none';
            }
        });
    });

    if (donationBtn) {
        donationBtn.addEventListener('click', async function() {
            const btnText = document.getElementById('donation-btn-text');
            const btnLoading = document.getElementById('donation-btn-loading');

            // Get selected amount
            const selectedAmount = document.querySelector('input[name="donation_amount"]:checked');
            if (!selectedAmount) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Please select an amount',
                    confirmButtonColor: '#3A5A33'
                });
                return;
            }

            let amount = selectedAmount.value;
            if (amount === 'custom') {
                amount = customAmountInput.value;
                if (!amount || amount < 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter a valid amount',
                        confirmButtonColor: '#3A5A33'
                    });
                    return;
                }
            }

            // Get donation type
            const donationType = document.querySelector('input[name="donation_type"]:checked')?.value || 'one_time';

            // Show loading
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline-flex';
            donationBtn.disabled = true;

            try {
                const response = await fetch('{{ route("donate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('#donationModal input[name="_token"]')?.value ||
                                       document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        amount: parseFloat(amount),
                        donation_type: donationType
                    })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('donationModal'));
                    if (modal) modal.hide();

                    Swal.fire({
                        icon: 'success',
                        title: 'Thank You!',
                        text: data.message,
                        confirmButtonColor: '#3A5A33'
                    });
                } else {
                    const errorText = data.message || Object.values(data.errors || {})[0]?.[0] || 'Something went wrong.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorText,
                        confirmButtonColor: '#3A5A33'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Network Error',
                    text: 'Please check your connection.',
                    confirmButtonColor: '#3A5A33'
                });
            } finally {
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
                donationBtn.disabled = false;
            }
        });
    }

    // ========================================
    // ASSISTANCE REQUEST MODAL - AJAX Handler
    // ========================================
    const assistForm = document.getElementById('assist-form');

    if (assistForm) {
        assistForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const btnText = document.getElementById('assist-btn-text');
            const btnLoading = document.getElementById('assist-btn-loading');
            const submitBtn = document.getElementById('assist-submit-btn');

            // Show loading
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline-flex';
            submitBtn.disabled = true;

            const formData = new FormData(assistForm);

            try {
                const response = await fetch('{{ route("assistance-request.store") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    body: JSON.stringify({
                        full_name: formData.get('full_name'),
                        phone: formData.get('phone'),
                        email: formData.get('email'),
                        location: formData.get('location'),
                        message: formData.get('message')
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('assistModal'));
                    if (modal) modal.hide();

                    // Reset form
                    assistForm.reset();

                    Swal.fire({
                        icon: 'success',
                        title: 'Request Submitted!',
                        text: data.message,
                        confirmButtonColor: '#3A5A33'
                    });
                } else {
                    const errorText = data.message || Object.values(data.errors || {})[0]?.[0] || 'Please fill all required fields.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorText,
                        confirmButtonColor: '#3A5A33'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Network Error',
                    text: 'Please check your connection.',
                    confirmButtonColor: '#3A5A33'
                });
            } finally {
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
                submitBtn.disabled = false;
            }
        });
    }
});
</script>
