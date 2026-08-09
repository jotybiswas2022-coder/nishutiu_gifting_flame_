@extends('frontend.app')

@section('title', 'Contact | NishuTiu Gifting Flame')

@section('content')

<div class="nfc-page">

    <!-- Floating Bubbles Background -->
    <div class="nfc-bubbles">
        <div class="nfc-bubble"></div>
        <div class="nfc-bubble"></div>
        <div class="nfc-bubble"></div>
        <div class="nfc-bubble"></div>
        <div class="nfc-bubble"></div>
        <div class="nfc-bubble"></div>
    </div>

    <!-- Success Alert -->
    <div class="nfc-alert" id="nfSuccessAlert">
        <i class="bi bi-check-circle-fill"></i>
        <span>Your message was sent successfully!</span>
    </div>

    <section class="nfc-section">
        <div class="nfc-container">

            <div class="nfc-header nfc-fade-in">
                <span class="nfc-tag"><i class="bi bi-chat-heart-fill"></i> Contact</span>
                <h1 class="nfc-title">Talk to us — let's <span>wrap a feeling</span></h1>
                <p class="nfc-sub">Questions about an item, a custom order, or just want to say hello? We reply with warmth.</p>
            </div>

            <div class="nfc-grid">
                <!-- Info cards -->
                <div class="nfc-info nfc-fade-in">
                    @php
                        $hasInfo = $settings['gmail'] || $settings['whatsapp'] || $settings['facebook'] || $settings['instagram'];
                    @endphp
                    @if($settings['gmail'])
                        <a href="mailto:{{ $settings['gmail'] }}" class="nfc-info-card">
                            <div class="nfc-info-icon" style="background:linear-gradient(135deg,#FF4D6D,#C9184A);"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <h5>Email</h5>
                                <p>{{ $settings['gmail'] }}</p>
                            </div>
                        </a>
                    @endif

                    @if($settings['whatsapp'])
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener" class="nfc-info-card">
                            <div class="nfc-info-icon" style="background:linear-gradient(135deg,#2FA96B,#1E7D4F);"><i class="bi bi-whatsapp"></i></div>
                            <div>
                                <h5>WhatsApp</h5>
                                <p>{{ $settings['whatsapp'] }}</p>
                            </div>
                        </a>
                    @endif

                    @if($settings['facebook'])
                        <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener" class="nfc-info-card">
                            <div class="nfc-info-icon" style="background:linear-gradient(135deg,#4D8FD6,#2563EB);"><i class="bi bi-facebook"></i></div>
                            <div>
                                <h5>Facebook</h5>
                                <p>Message us on Facebook</p>
                            </div>
                        </a>
                    @endif

                    @if($settings['instagram'])
                        <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener" class="nfc-info-card">
                            <div class="nfc-info-icon" style="background:linear-gradient(135deg,#C9184A,#9D4EDD);"><i class="bi bi-instagram"></i></div>
                            <div>
                                <h5>Instagram</h5>
                                <p>Follow &amp; DM us</p>
                            </div>
                        </a>
                    @endif

                    @unless($hasInfo)
                        <div class="nfc-empty-info">
                            <i class="bi bi-envelope-fill"></i>
                            <p>Our contact details are on the way — reach us soon.</p>
                        </div>
                    @endunless
                </div>

                <!-- Form -->
                <div class="nfc-form-wrap nfc-fade-in">
                    <form id="nfContactForm" action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="nfc-errors">
                                @foreach ($errors->all() as $error)
                                    <div><i class="bi bi-exclamation-circle-fill"></i> {{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <div class="nfc-field">
                            <label for="nfName">Your Name</label>
                            <input type="text" id="nfName" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                        </div>

                        <div class="nfc-field">
                            <label for="nfEmail">Your Email</label>
                            <input type="email" id="nfEmail" name="email" placeholder="example@email.com" value="{{ old('email') }}" required>
                        </div>

                        <div class="nfc-field">
                            <label for="nfMessage">Message</label>
                            <textarea id="nfMessage" name="message" rows="6" placeholder="Tell us about the gift, the occasion, the feeling…" required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="nfc-submit-btn" id="nfContactSubmitBtn">
                            <i class="bi bi-send-fill"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@include('frontend.partials.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nfcObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry, index) {
                if (entry.isIntersecting) {
                    setTimeout(function () {
                        entry.target.classList.add('nfc-visible');
                    }, index * 80);
                    nfcObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.nfc-fade-in').forEach(function (el) { nfcObserver.observe(el); });

        const form = document.getElementById('nfContactForm');
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const alertBox = document.getElementById('nfSuccessAlert');
                const submitBtn = document.getElementById('nfContactSubmitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-send-fill"></i> Sending…';

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                })
                .then(function (res) {
                    if (!res.ok) throw new Error('Request failed');
                    return res.json();
                })
                .then(function (data) {
                    if (data.success) {
                        alertBox.classList.add('nfc-show');
                        alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        form.reset();
                        setTimeout(function () { alertBox.classList.remove('nfc-show'); }, 5000);
                    }
                })
                .catch(function () {
                    alertBox.classList.add('nfc-show');
                    alertBox.querySelector('span').textContent = 'Failed to send — please try again.';
                    setTimeout(function () {
                        alertBox.classList.remove('nfc-show');
                        alertBox.querySelector('span').textContent = 'Your message was sent successfully!';
                    }, 5000);
                })
                .finally(function () {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-send-fill"></i> Send Message';
                });
            });
        }
    });
</script>

<style>
    .nfc-page {
        font-family: 'Inter', sans-serif;
        color: #1F1F1F;
        background: #FFF5F7;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Floating bubbles */
    .nfc-bubbles {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
    }
    .nfc-bubble {
        position: absolute;
        background: rgba(255, 77, 109, 0.06);
        border-radius: 50%;
        animation: nfc-float-up 15s infinite ease-in-out;
    }
    .nfc-bubble:nth-child(1) { width: 80px; height: 80px; left: 8%; animation-delay: 0s; animation-duration: 12s; }
    .nfc-bubble:nth-child(2) { width: 55px; height: 55px; left: 25%; animation-delay: 2s; animation-duration: 14s; }
    .nfc-bubble:nth-child(3) { width: 100px; height: 100px; left: 50%; animation-delay: 4s; animation-duration: 16s; background: rgba(255, 209, 102, 0.07); }
    .nfc-bubble:nth-child(4) { width: 70px; height: 70px; left: 72%; animation-delay: 6s; animation-duration: 13s; }
    .nfc-bubble:nth-child(5) { width: 90px; height: 90px; left: 88%; animation-delay: 8s; animation-duration: 15s; background: rgba(255, 209, 102, 0.07); }
    .nfc-bubble:nth-child(6) { width: 45px; height: 45px; left: 40%; animation-delay: 3.5s; animation-duration: 11s; }

    @keyframes nfc-float-up {
        0% { bottom: -120px; opacity: 0; transform: translateX(0) rotate(0deg); }
        50% { opacity: 1; transform: translateX(50px) rotate(180deg); }
        100% { bottom: 100%; opacity: 0; transform: translateX(-50px) rotate(360deg); }
    }

    /* Success alert */
    .nfc-alert {
        position: fixed;
        top: -90px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #fff;
        padding: 14px 26px;
        border-radius: 50rem;
        box-shadow: 0 12px 32px rgba(255, 77, 109, 0.4);
        z-index: 1060;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        font-size: 0.92rem;
        transition: top 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        max-width: calc(100vw - 2rem);
        white-space: nowrap;
    }
    .nfc-alert.nfc-show { top: calc(var(--chatbox-navbar-height, 64px) + 14px); }

    .nfc-section {
        position: relative;
        z-index: 1;
        padding: 56px 20px;
    }
    .nfc-container { max-width: 1060px; margin: 0 auto; }

    .nfc-header { text-align: center; margin-bottom: 44px; }
    .nfc-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #C9184A;
        background: #FFE3E9;
        padding: 0.45rem 1.15rem;
        border-radius: 50rem;
        border: 1px solid rgba(255, 77, 109, 0.2);
        margin-bottom: 1rem;
    }
    .nfc-title {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: clamp(1.9rem, 3.6vw, 2.7rem);
        line-height: 1.15;
        color: #1F1F1F;
        margin: 0 0 0.6rem;
    }
    .nfc-title span { color: #FF4D6D; }
    .nfc-sub {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.18rem;
        color: #8A6E78;
        max-width: 560px;
        margin: 0 auto;
    }

    .nfc-grid {
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        gap: 32px;
        align-items: start;
    }

    /* Info cards */
    .nfc-info { display: flex; flex-direction: column; gap: 16px; }
    .nfc-info-card {
        background: #fff;
        border: 1px solid rgba(255, 77, 109, 0.14);
        border-radius: 18px;
        padding: 18px 20px;
        display: flex;
        gap: 16px;
        align-items: center;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 10px 26px rgba(255, 77, 109, 0.08);
        transition: all 0.3s ease;
    }
    .nfc-info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 36px rgba(255, 77, 109, 0.18);
        border-color: rgba(255, 77, 109, 0.4);
        text-decoration: none;
        color: inherit;
    }
    .nfc-info-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 6px 16px rgba(255, 77, 109, 0.28);
        font-size: 1.3rem;
    }
    .nfc-info-card h5 { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 1rem; margin: 0 0 2px; color: #1F1F1F; }
    .nfc-info-card p { margin: 0; font-size: 0.92rem; color: #6B5860; word-break: break-word; }

    .nfc-empty-info {
        background: #fff;
        border: 1px dashed rgba(255, 77, 109, 0.35);
        border-radius: 18px;
        padding: 24px;
        text-align: center;
        color: #8A6E78;
    }
    .nfc-empty-info i { font-size: 1.6rem; color: #FFB3C1; display: block; margin-bottom: 6px; }
    .nfc-empty-info p { margin: 0; font-family: 'Cormorant Garamond', serif; font-size: 1.05rem; }

    /* Form */
    .nfc-form-wrap {
        background: #fff;
        border: 1px solid rgba(255, 77, 109, 0.14);
        border-radius: 24px;
        padding: 34px;
        box-shadow: 0 18px 44px rgba(255, 77, 109, 0.12);
        position: relative;
        overflow: hidden;
    }
    .nfc-form-wrap::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #FF4D6D, #FFD166);
    }
    .nfc-errors {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 20px;
        font-size: 13px;
    }
    .nfc-field { margin-bottom: 20px; }
    .nfc-field label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
    }
    .nfc-field input,
    .nfc-field textarea {
        width: 100%;
        padding: 13px 16px;
        border: 2px solid #F1E3E7;
        border-radius: 12px;
        font-size: 15px;
        font-family: inherit;
        background: #FFF9FA;
        color: #1F1F1F;
        transition: border-color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
    }
    .nfc-field input:focus,
    .nfc-field textarea:focus {
        outline: none;
        border-color: #FF4D6D;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(255, 77, 109, 0.12);
    }
    .nfc-field input::placeholder,
    .nfc-field textarea::placeholder { color: #C9B8BE; }
    .nfc-field textarea { resize: vertical; min-height: 130px; }

    .nfc-submit-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #fff;
        border: none;
        border-radius: 50rem;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 10px 24px rgba(255, 77, 109, 0.35);
        transition: all 0.3s ease;
    }
    .nfc-submit-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(255, 77, 109, 0.45);
    }
    .nfc-submit-btn:disabled { opacity: 0.6; cursor: not-allowed; }

    /* Fade in */
    .nfc-fade-in { opacity: 0; transform: translateY(30px); transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
    .nfc-fade-in.nfc-visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 991.98px) {
        .nfc-grid { grid-template-columns: 1fr; }
        .nfc-info { flex-direction: row; flex-wrap: wrap; }
        .nfc-info-card { flex: 1 1 calc(50% - 8px); }
    }
    @media (max-width: 575.98px) {
        .nfc-section { padding: 36px 14px; }
        .nfc-form-wrap { padding: 22px; }
        .nfc-info-card { flex-basis: 100%; }
        .nfc-title { font-size: 1.6rem; }
    }
</style>

@endsection