<style>
    /* Footer (shared partial) */
    .nf-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 700;
        border-radius: 999px;
        padding: 0.9rem 1.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .nf-btn-primary {
        background: linear-gradient(135deg, #FF4D6D 0%, #C9184A 100%);
        color: #FFFFFF;
        box-shadow: 0 10px 26px rgba(255, 77, 109, 0.35);
    }

    .nf-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 34px rgba(255, 77, 109, 0.42);
        color: #fff;
    }

    .nf-footer {
        background: #1F1F1F;
        color: #C9B8BE;
        border-top: 1px solid rgba(255, 209, 102, 0.15);
    }

    .nf-footer h5 {
        color: #FFFFFF;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }

    .nf-footer a {
        color: #E8DCE0;
        text-decoration: none;
        display: inline-block;
        padding: 0.28rem 0;
        transition: color 0.25s ease;
    }

    .nf-footer a:hover { color: #FFD166; }

    .nf-footer-brand { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 1.7rem; color: #FF4D6D; }

    .nf-social {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(255, 77, 109, 0.15);
        color: #FFB3C1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.6rem;
        transition: all 0.3s ease;
    }

    .nf-social:hover { background: #FF4D6D; color: #FFFFFF; }

    .nf-footer-bottom { border-top: 1px solid rgba(255, 209, 102, 0.12); }
</style>

<footer class="nf-footer pt-5">
    <div class="container pt-3 pb-4">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="nf-footer-brand d-flex align-items-center gap-2 mb-3">
                    <div style="width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg,#FF4D6D,#C9184A);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;"><i class="bi bi-fire"></i></div>
                    <div>
                        <span class="nf-footer-brand">NishuTiu</span>
                        <div class="small" style="letter-spacing:2px;color:#FFD166;text-transform:uppercase;font-weight:600;">Gifting Flame</div>
                    </div>
                </div>
                <p style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;max-width:320px;">
                    A warm boutique that wraps feelings in golden ribbon, soft pink silk and the gentle flame of love.
                </p>
                <div class="mt-4">
                    @if($fb = \App\Models\Setting::get('facebook_page'))
                        <a href="{{ $fb }}" target="_blank" rel="noopener" class="nf-social" title="Facebook"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if($ig = \App\Models\Setting::get('instagram_page'))
                        <a href="{{ $ig }}" target="_blank" rel="noopener" class="nf-social" title="Instagram"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if($wa = \App\Models\Setting::get('whatsapp_number'))
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $wa) }}" target="_blank" rel="noopener" class="nf-social" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    @endif
                    @if($gm = \App\Models\Setting::get('gmail'))
                        <a href="mailto:{{ $gm }}" class="nf-social" title="Email"><i class="bi bi-envelope"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <h5>Shop</h5>
                <a href="/#gifts">Birthday Gifts</a><br>
                <a href="/#occasions">Anniversary Gifts</a><br>
                <a href="/#occasions">Wedding Gifts</a><br>
                <a href="/#gifts">Baby & New Baby</a><br>
                <a href="/#gifts">Just Because</a>
            </div>
            <div class="col-6 col-lg-2">
                <h5>Company</h5>
                <a href="/">Home</a><br>
                <a href="/contact">Contact</a><br>
                <a href="#">About the Flame</a><br>
                <a href="#">Delivery Care</a><br>
                <a href="#">Gift Notes</a>
            </div>
            <div class="col-lg-4">
                <h5>Keep the warmth near</h5>
                <p style="font-size:0.92rem;color:#C9B8C0;">The latest gifts, seasonal surprises and whispers of offers — straight in your inbox.</p>
                <div class="d-flex mt-3">
                    <input type="email" class="form-control" placeholder="Your email" style="border-radius:999px 0 0 999px;border:none;background:rgba(255,255,255,0.08);color:#fff;padding:0.7rem 1.2rem;">
                    <button class="btn nf-btn nf-btn-primary" style="border-radius:0 999px 999px 0;padding:0.7rem 1.4rem;box-shadow:none;">Join</button>
                </div>
            </div>
        </div>
    </div>
    <div class="nf-footer-bottom py-3">
        <div class="container d-flex flex-wrap justify-content-center gap-2 small" style="color:#8A6E78;">
            © {{ date('Y') }} NishuTiu Gifting Flame — Born from the heart, gifted with fire. <i class="bi bi-heart-fill" style="color:#FF4D6D;"></i>
        </div>
    </div>
</footer>