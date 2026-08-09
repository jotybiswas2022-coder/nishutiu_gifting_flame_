@extends('frontend.app')

@section('title', 'NishuTiu Gifting Flame — Give the Feeling, Not Just a Gift')

@section('content')

<style>
    /* ===== NishuTiu Gifting Flame — Homepage ===== */
    .nf-root {
        font-family: 'Inter', sans-serif;
        background: #FFF5F7;
        color: #1F1F1F;
        overflow-x: hidden;
    }

    .nf-serif { font-family: 'Playfair Display', serif; }
    .nf-cormorant { font-family: 'Cormorant Garamond', serif; }

    /* Hero */
    .nf-hero {
        position: relative;
        background:
            radial-gradient(1200px 600px at 85% -10%, rgba(255, 179, 193, 0.55), transparent 60%),
            radial-gradient(900px 500px at -10% 20%, rgba(255, 209, 102, 0.35), transparent 55%),
            linear-gradient(180deg, #FFF5F7 0%, #FFE3E9 100%);
        overflow: hidden;
        padding-top: 4rem;
        padding-bottom: 3rem;
    }

    .nf-hero::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(255, 77, 109, 0.18), transparent 65%);
        animation: nf-float 9s ease-in-out infinite;
    }

    .nf-hero::after {
        content: '\1F525';
        position: absolute;
        font-size: 10rem;
        left: 8%;
        bottom: -30px;
        opacity: 0.15;
        transform: rotate(-12deg);
    }

    @keyframes nf-float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-22px); }
    }

    .nf-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #C9184A;
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.25);
        border-radius: 999px;
        padding: 0.55rem 1.1rem;
        box-shadow: 0 6px 18px rgba(255, 77, 109, 0.12);
    }

    .nf-hero-title {
        font-size: clamp(2.6rem, 6vw, 4.6rem);
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -1.5px;
        color: #1F1F1F;
    }

    .nf-title-accent {
        color: #FF4D6D;
        font-style: italic;
        font-family: 'Cormorant Garamond', serif;
        font-weight: 600;
        letter-spacing: -0.5px;
        position: relative;
        display: inline-block;
    }

    .nf-title-accent::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: 2px;
        height: 10px;
        background: rgba(255, 209, 102, 0.5);
        z-index: -1;
        border-radius: 4px;
    }

    .nf-hero-sub {
        font-size: 1.15rem;
        color: #8A6E78;
        max-width: 560px;
        line-height: 1.7;
        font-family: 'Cormorant Garamond', serif;
    }

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

    .nf-btn-ghost {
        background: #FFFFFF;
        color: #C9184A;
        border: 1.5px solid rgba(255, 77, 109, 0.3);
    }

    .nf-btn-ghost:hover {
        background: #FFF;
        border-color: #FF4D6D;
        transform: translateY(-3px);
        color: #C9184A;
    }

    .nf-btn-gold {
        background: linear-gradient(135deg, #FFD166 0%, #FFB300 100%);
        color: #1F1F1F;
        box-shadow: 0 10px 26px rgba(255, 209, 102, 0.4);
    }

    .nf-btn-gold:hover {
        transform: translateY(-3px);
        color: #1F1F1F;
        box-shadow: 0 16px 34px rgba(255, 209, 102, 0.5);
    }

    /* Hero visual — gift box */
    .nf-gift-scene {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nf-gift-wrap {
        position: relative;
        width: 300px;
        height: 300px;
        animation: nf-gift-bob 6s ease-in-out infinite;
    }

    @keyframes nf-gift-bob {
        0%, 100% { transform: translateY(0) rotate(-2deg); }
        50% { transform: translateY(-18px) rotate(2deg); }
    }

    .nf-gift-lid {
        position: absolute;
        top: 34px;
        left: 50%;
        transform: translateX(-50%);
        width: 210px;
        height: 46px;
        border-radius: 14px;
        background: linear-gradient(135deg, #FF4D6D, #D6335A);
        box-shadow: 0 10px 24px rgba(255, 77, 109, 0.4);
        z-index: 2;
    }

    .nf-gift-lid::after {
        content: '';
        position: absolute;
        top: 7px;
        left: 50%;
        transform: translateX(-50%);
        width: 26px;
        height: 32px;
        background: #FFD166;
        border-radius: 6px;
    }

    .nf-gift-body {
        position: absolute;
        top: 74px;
        left: 50%;
        transform: translateX(-50%);
        width: 190px;
        height: 150px;
        border-radius: 10px;
        background: linear-gradient(135deg, #FFB3C1, #FF7B94);
        box-shadow: 0 20px 40px rgba(255, 77, 109, 0.3);
        z-index: 1;
    }

    .nf-gift-body::after {
        content: '';
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 130px;
        background: #FFD166;
        border-radius: 8px;
        box-shadow: 0 0 0 10px rgba(255, 209, 102, 0.25);
    }

    .nf-heart-float {
        position: absolute;
        font-size: 1.6rem;
        opacity: 0.85;
        animation: nf-heart-rise 5s ease-in-out infinite;
    }

    @keyframes nf-heart-rise {
        0% { transform: translateY(0) scale(1); opacity: 0; }
        15% { opacity: 0.9; }
        85% { opacity: 0.9; }
        100% { transform: translateY(-90px) scale(1.25); opacity: 0; }
    }

    .nf-heart-float:nth-child(1) { left: 8%;  bottom: 22%; animation-delay: 0s;  }
    .nf-heart-float:nth-child(2) { left: 24%; bottom: 10%; animation-delay: 1.4s; font-size: 1.1rem; }
    .nf-heart-float:nth-child(3) { left: 50%; bottom: 4%;  animation-delay: 2.4s; }
    .nf-heart-float:nth-child(4) { left: 74%; bottom: 16%; animation-delay: 0.8s; font-size: 1.2rem; }
    .nf-heart-float:nth-child(5) { left: 88%; bottom: 30%; animation-delay: 2s; }

    /* Marquee strip */
    .nf-marquee {
        background: #1F1F1F;
        color: #FFD166;
        overflow: hidden;
        padding: 0.85rem 0;
        border-top: 1px solid rgba(255, 209, 102, 0.3);
        border-bottom: 1px solid rgba(255, 209, 102, 0.3);
    }

    .nf-marquee-track {
        display: flex;
        gap: 3.5rem;
        white-space: nowrap;
        animation: nf-scroll 26s linear infinite;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        letter-spacing: 2px;
        font-style: italic;
    }

    @keyframes nf-scroll {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }

    .nf-marquee-track span i { color: #FF4D6D; margin: 0 0.5rem; }

    /* Section headers */
    .nf-section-tag {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #C9184A;
        background: #FFE3E9;
        border-radius: 999px;
        padding: 0.4rem 1rem;
        margin-bottom: 1rem;
    }

    .nf-section-title {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: clamp(1.9rem, 3.5vw, 2.8rem);
        letter-spacing: -0.5px;
        color: #1F1F1F;
    }

    .nf-section-sub {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        color: #8A6E78;
        max-width: 620px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Categories */
    .nf-cat-card {
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.12);
        border-radius: 24px;
        padding: 2.2rem 1.4rem;
        text-align: center;
        transition: all 0.35s ease;
        height: 100%;
    }

    .nf-cat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 22px 42px rgba(255, 77, 109, 0.14);
        border-color: rgba(255, 77, 109, 0.4);
    }

    .nf-cat-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 1.2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.9rem;
        color: #FFFFFF;
    }

    .nf-cat-card h5 { font-weight: 800; color: #1F1F1F; }
    .nf-cat-card p { color: #8A6E78; font-size: 0.9rem; }

    .nf-cat-link {
        color: #C9184A;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        letter-spacing: 1px;
    }

    .nf-cat-link i { transition: transform 0.3s ease; }
    .nf-cat-link:hover i { transform: translateX(5px); }

    /* Occasion cards */
    .nf-occasion-card {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        min-height: 360px;
        display: flex;
        align-items: flex-end;
        padding: 2rem;
        text-decoration: none;
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        box-shadow: 0 18px 40px rgba(31, 31, 31, 0.12);
    }

    .nf-occasion-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 28px 54px rgba(31, 31, 31, 0.2);
    }

    .nf-occasion-card .nf-occ-big {
        position: absolute;
        top: 1rem;
        right: 1.4rem;
        font-size: 6rem;
        opacity: 0.35;
        transition: transform 0.5s ease;
    }

    .nf-occasion-card:hover .nf-occ-big { transform: scale(1.15) rotate(8deg); }

    .nf-occ-chip {
        display: inline-block;
        background: #FFFFFF;
        color: #C9184A;
        font-weight: 800;
        font-size: 0.78rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        border-radius: 999px;
        padding: 0.4rem 0.9rem;
        margin-bottom: 0.6rem;
    }

    .nf-occasion-card h4 {
        color: #FFFFFF;
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 1.7rem;
        margin-bottom: 0.35rem;
    }

    .nf-occasion-card p { color: rgba(255, 255, 255, 0.85); font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; margin: 0; }

    /* How it works */
    .nf-step {
        position: relative;
        background: #FFFFFF;
        border-radius: 24px;
        padding: 2.2rem 1.6rem;
        border: 1px solid rgba(255, 77, 109, 0.1);
        height: 100%;
        transition: transform 0.3s ease;
    }

    .nf-step:hover { transform: translateY(-6px); }

    .nf-step-num {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, #FFD166, #FFB300);
        color: #1F1F1F;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 1.2rem;
        box-shadow: 0 8px 18px rgba(255, 209, 102, 0.35);
    }

    .nf-step h5 { font-weight: 700; color: #1F1F1F; }
    .nf-step p { color: #8A6E78; font-size: 0.93rem; margin: 0; }

    .nf-step-arrow {
        position: absolute;
        top: 2.2rem;
        right: -1.4rem;
        color: #FFB3C1;
        font-size: 1.5rem;
        z-index: 2;
    }

    /* Testimonials */
    .nf-quote-card {
        background: #FFFFFF;
        border-radius: 24px;
        padding: 2.2rem;
        border-top: 4px solid #FF4D6D;
        box-shadow: 0 18px 40px rgba(255, 77, 109, 0.1);
        height: 100%;
    }

    .nf-quote-card .bi-quote { font-size: 2rem; color: #FFD166; }
    .nf-quote-card p { font-family: 'Cormorant Garamond', serif; font-size: 1.15rem; font-style: italic; color: #1F1F1F; line-height: 1.6; }

    /* Banner CTA */
    .nf-cta {
        background:
            radial-gradient(700px 300px at 20% 0%, rgba(255, 209, 102, 0.35), transparent 60%),
            linear-gradient(135deg, #FF4D6D 0%, #C9184A 100%);
        border-radius: 32px;
        color: #FFFFFF;
        text-align: center;
        padding: 4.2rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .nf-cta .nf-cta-float { position: absolute; font-size: 2.4rem; opacity: 0.35; animation: nf-float 6s ease-in-out infinite; }
    .nf-cta .nf-cta-1 { top: 2rem; left: 3rem; }
    .nf-cta .nf-cta-2 { top: 1.4rem; right: 3.5rem; animation-delay: 1s; }
    .nf-cta .nf-cta-3 { bottom: 1.6rem; left: 8rem; animation-delay: 2s; font-size: 1.8rem; }

    /* Owner's info */
    .nf-owner-card {
        position: relative;
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.14);
        border-radius: 24px;
        padding: 2.4rem 1.6rem 2rem;
        text-align: center;
        transition: all 0.35s ease;
        height: 100%;
        box-shadow: 0 10px 28px rgba(255, 77, 109, 0.08);
        overflow: hidden;
    }

    .nf-owner-card::before {
        content: '';
        position: absolute;
        top: -60px;
        left: 50%;
        transform: translateX(-50%);
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 209, 102, 0.35), transparent 70%);
    }

    .nf-owner-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 26px 48px rgba(255, 77, 109, 0.18);
        border-color: rgba(255, 77, 109, 0.4);
    }

    .nf-owner-photo {
        position: relative;
        width: 108px;
        height: 108px;
        margin: 0 auto 1.2rem;
        border-radius: 50%;
        padding: 6px;
        background: linear-gradient(135deg, #FFD166, #FF4D6D);
        box-shadow: 0 14px 30px rgba(255, 77, 109, 0.25);
    }

    .nf-owner-photo img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #FFFFFF;
        display: block;
    }

    .nf-owner-name {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 1.25rem;
        color: #1F1F1F;
        margin-bottom: 0.25rem;
    }

    .nf-owner-role {
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.95rem;
        color: #8A6E78;
        margin-bottom: 1.1rem;
    }

    .nf-owner-social { display: flex; justify-content: center; gap: 0.6rem; }

    .nf-owner-social a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #C9184A;
        background: #FFE3E9;
        border: 1px solid rgba(255, 77, 109, 0.2);
        transition: all 0.3s ease;
        font-size: 1.05rem;
        text-decoration: none;
    }

    .nf-owner-social a:hover {
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        border-color: transparent;
        transform: translateY(-3px);
    }

    /* Latest items */
    .nf-item-card {
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.14);
        border-radius: 24px;
        overflow: hidden;
        height: 100%;
        transition: all 0.35s ease;
        box-shadow: 0 10px 28px rgba(255, 77, 109, 0.08);
        display: flex;
        flex-direction: column;
    }

    .nf-item-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 28px 50px rgba(255, 77, 109, 0.2);
        border-color: rgba(255, 77, 109, 0.4);
    }

    .nf-item-img {
        position: relative;
        aspect-ratio: 4 / 3;
        background: linear-gradient(135deg, #FFE3E9, #FFF0C2);
        overflow: hidden;
    }

    .nf-item-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .nf-item-card:hover .nf-item-img img { transform: scale(1.06); }

    .nf-item-noimg {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
    }

    .nf-item-flag {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 0.35rem 0.85rem;
        border-radius: 50rem;
        box-shadow: 0 6px 14px rgba(255, 77, 109, 0.35);
    }

    .nf-item-cat {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(4px);
        color: #C9184A;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 0.32rem 0.85rem;
        border-radius: 50rem;
        border: 1px solid rgba(255, 77, 109, 0.2);
    }

    .nf-item-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .nf-item-name {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 1.15rem;
        color: #1F1F1F;
        margin-bottom: 0.4rem;
    }

    .nf-item-desc {
        flex: 1;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        color: #8A6E78;
        margin-bottom: 1.1rem;
    }

    .nf-item-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.8rem;
    }

    .nf-item-price {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 1.35rem;
        color: #C9184A;
    }

    .nf-item-price small {
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        font-weight: 700;
        color: #A08A92;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .nf-item-btn {
        white-space: nowrap;
        border: none;
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        font-weight: 700;
        font-size: 0.82rem;
        padding: 0.55rem 1.1rem;
        border-radius: 50rem;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .nf-item-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(255, 77, 109, 0.4);
        color: #FFFFFF;
    }

    /* Customer reviews (screenshot frames) */
    .nf-reviews {
        background:
            radial-gradient(600px 380px at 12% 0%, rgba(255, 209, 102, 0.16), transparent 60%),
            radial-gradient(600px 420px at 90% 100%, rgba(255, 77, 109, 0.28), transparent 60%),
            linear-gradient(160deg, #2A0A14 0%, #4A1224 55%, #2A0A14 100%);
        color: #FFFFFF;
        overflow: hidden;
    }

    .nf-reviews .nf-section-tag {
        background: rgba(255, 209, 102, 0.14);
        color: #FFD166;
        border-color: rgba(255, 209, 102, 0.35);
    }

    .nf-reviews .nf-section-title { color: #FFFFFF; }
    .nf-reviews .nf-section-sub { color: #C9B8C0; }

    .nf-review-frame {
        position: relative;
        background: #FFFFFF;
        padding: 0.7rem 0.7rem 0;
        border-radius: 18px;
        box-shadow: 0 22px 44px rgba(0, 0, 0, 0.38);
        transform: rotate(-2deg);
        transition: all 0.35s ease;
        margin: 0;
    }

    .nf-review-frame:nth-child(3n) { transform: rotate(2deg); }
    .nf-review-frame:nth-child(2n) { transform: rotate(-1.2deg); }

    .nf-review-frame:hover {
        transform: rotate(0deg) translateY(-8px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
    }

    .nf-review-frame > a {
        display: block;
        overflow: hidden;
        border-radius: 12px;
    }

    .nf-review-frame img {
        width: 100%;
        display: block;
        aspect-ratio: 3 / 4;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .nf-review-frame:hover img { transform: scale(1.05); }

    .nf-review-frame figcaption {
        padding: 0.7rem 0.15rem 0.85rem;
    }

    .nf-review-name {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 0.92rem;
        color: #1F1F1F;
        margin-bottom: 0.1rem;
    }

    .nf-review-caption {
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.92rem;
        color: #6B5860;
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .nf-review-stamp {
        position: absolute;
        top: 12px;
        right: 0;
        background: linear-gradient(135deg, #FFD166, #FFB300);
        color: #1F1F1F;
        font-size: 0.6rem;
        font-weight: 800;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        padding: 0.32rem 0.85rem;
        border-radius: 50rem 0 0 50rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        z-index: 2;
    }

    .nf-review-empty {
        background: rgba(255, 255, 255, 0.06);
        border: 1px dashed rgba(255, 209, 102, 0.35);
        border-radius: 22px;
        padding: 3rem 2rem;
        max-width: 520px;
        margin: 0 auto;
        text-align: center;
    }

    .nf-review-empty h5 { font-family: 'Playfair Display', serif; font-weight: 800; color: #FFD166; }
</style>

<div class="nf-root">

    <!-- ===== HERO ===== -->
    <section class="nf-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="nf-eyebrow mb-3"><i class="bi bi-suit-heart-fill"></i> Love · Care · Beautiful Moments</span>
                    <h1 class="nf-hero-title mt-3 mb-4">
                        Some feelings deserve<br>
                        <span class="nf-title-accent">a gift of their own.</span>
                    </h1>
                    <p class="nf-hero-sub">
                        Warm, hand-chosen gifts wrapped in golden ribbons and gentle flames of emotion —
                        because the care behind a gift is the truest love language.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="#gifts" class="nf-btn nf-btn-primary">
                            <i class="bi bi-gift"></i> Discover Your Gift
                        </a>
                        <a href="#occasions" class="nf-btn nf-btn-ghost">
                            Browse Occasions <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-4 mt-5">
                        <div>
                            <div class="nf-serif fw-bold fs-3 text-danger">4.9<i class="bi bi-star-fill text-warning fs-6 ms-1"></i></div>
                            <small class="text-muted">2,400+ happy hearts</small>
                        </div>
                        <div class="vr"></div>
                        <div class="nf-serif fw-bold fs-3" style="color:#C9184A;">50K+</div>
                        <div class="small text-muted">gifts delivered<br>wrapped with love</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nf-gift-scene">
                        <div class="nf-gift-wrap">
                            <div class="nf-gift-lid"></div>
                            <div class="nf-gift-body"></div>
                            <span class="nf-heart-float">❤️</span>
                            <span class="nf-heart-float">💝</span>
                            <span class="nf-heart-float">🎁</span>
                            <span class="nf-heart-float">🥀</span>
                            <span class="nf-heart-float">✨</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== MARQUEE ===== -->
    <section class="nf-marquee">
        <div class="nf-marquee-track" aria-hidden="true">
            <span>Birthdays <i class="bi bi-balloon-fill"></i> Anniversaries <i class="bi bi-heart-fill"></i> Weddings <i class="bi bi-gem"></i> New Babies <i class="bi bi-emoji-sunglasses-fill"></i> Thank You <i class="bi bi-award-fill"></i> Just Because <i class="bi bi-flower1"></i></span>
            <span>Birthdays <i class="bi bi-balloon-fill"></i> Anniversaries <i class="bi bi-heart-fill"></i> Weddings <i class="bi bi-gem"></i> New Babies <i class="bi bi-emoji-sunglasses-fill"></i> Thank You <i class="bi bi-award-fill"></i> Just Because <i class="bi bi-flower1"></i></span>
        </div>
    </section>

    <!-- ===== LATEST ITEMS ===== -->
    <section id="latest" class="py-5" style="background:#FFF5F7;">
        <div class="container py-4">
            <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5">
                <div>
                    <span class="nf-section-tag">Latest Items</span>
                    <h2 class="nf-section-title mb-2">Fresh from <span style="color:#FF4D6D;">the heart</span></h2>
                    <p class="nf-section-sub mb-0">The newest gifts, wrapped with gold and ready to travel to a loved one.</p>
                </div>
                <a href="{{ route('items.index') }}" class="nf-cat-link">See all gifts <i class="bi bi-arrow-right"></i></a>
            </div>

            @if($latestItems->isNotEmpty())
                <div class="row g-4">
                    @foreach ($latestItems as $item)
                        @include('frontend.partials.item-card', ['item' => $item])
                    @endforeach
                </div>
            @else
                <div class="nf-owner-card text-center" style="max-width:640px;margin:0 auto;">
                    <div style="font-size:3rem;margin-bottom:0.6rem;">🎁</div>
                    <h5 class="nf-serif fw-bold">Fresh gifts are on the way</h5>
                    <p class="nf-section-sub">New treasures are being wrapped as we speak — check back soon.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ===== WHY US ===== -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="nf-section-tag">Why NishuTiu</span>
                <h2 class="nf-section-title">Gifts carried by <span style="color:#FF4D6D;">real emotion</span></h2>
                <p class="nf-section-sub">We don't just sell gifts — we translate your feelings into something someone can hold, smile at, and keep forever.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="nf-cat-card">
                        <div class="nf-cat-icon" style="background:linear-gradient(135deg,#FF4D6D,#C9184A);"><i class="bi bi-hand-thumbs-up-fill"></i></div>
                        <h5>Curated With Heart</h5>
                        <p>Every piece is hand-picked by our team to feel personal, meaningful, and just right for the moment.</p>
                        <a href="#gifts" class="nf-cat-link">Explore gifts <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="nf-cat-card">
                        <div class="nf-cat-icon" style="background:linear-gradient(135deg,#FFD166,#FFB300);"><i class="bi bi-box-seam-fill"></i></div>
                        <h5>Golden Touch Wrapping</h5>
                        <p>Signature ribbons, notes, and a warm un-boxing ritual that makes the moment unforgettable.</p>
                        <a href="#occasions" class="nf-cat-link">See the magic <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="nf-cat-card">
                        <div class="nf-cat-icon" style="background:linear-gradient(135deg,#FFB3C1,#FF7B94);"><i class="bi bi-truck"></i></div>
                        <h5>Careful Delivery</h5>
                        <p>Delivered on time, in pristine condition, with warmth — every single time, everywhere.</p>
                        <a href="#occasions" class="nf-cat-link">Plan a surprise <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== OCCASIONS ===== -->
    <section id="occasions" class="py-5" style="background:#FFE9EE;">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="nf-section-tag">Occasions</span>
                <h2 class="nf-section-title">For every moment that<br>deserves to be remembered</h2>
                <p class="nf-section-sub">Choose the feeling. We'll wrap it, ribbon it, and send the warmth along with it.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <a href="#gifts" class="nf-occasion-card" style="background:linear-gradient(160deg,#FF4D6D,#B3124B);">
                        <span class="nf-occ-big">🎂</span>
                        <div>
                            <span class="nf-occ-chip">Birthdays</span>
                            <h4>Make wishes golden</h4>
                            <p>Cakes of compliments, candles of joy & gifts that glow.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="#gifts" class="nf-occasion-card" style="background:linear-gradient(160deg,#C9184A 0%,#7A0B30 100%);">
                        <span class="nf-occ-big">💘</span>
                        <div>
                            <span class="nf-occ-chip">Love & Romance</span>
                            <h4>For the one you adore</h4>
                            <p>An intimate way to say the words your heart already knows.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="#gifts" class="nf-occasion-card" style="background:linear-gradient(160deg,#FFD56B,#F3A800);">
                        <span class="nf-occ-big">🎩</span>
                        <div>
                            <span class="nf-occ-chip" style="color:#8a6a00;">Anniversaries</span>
                            <h4 style="color:#1F1F1F;">A promise, rekindled</h4>
                            <p class="text-dark">Celebrate a story worth telling over and over.</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="#gifts" class="nf-occasion-card" style="background:linear-gradient(160deg,#FFB3C1,#E4688F);">
                        <span class="nf-occ-big">👶</span>
                        <div>
                            <span class="nf-occ-chip">New Beginnings</span>
                            <h4>Welcome tiny miracles</h4>
                            <p>Soft, sweet, and golden-feeling for fresh little moments.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== OWNERS ===== -->
    <section id="owners" class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="nf-section-tag">The Founders</span>
                <h2 class="nf-section-title">The hearts behind <span style="color:#FF4D6D;">NishuTiu</span></h2>
                <p class="nf-section-sub">Meet the people who warm every ribbon, write every note, and wrap every feeling with love.</p>
            </div>
            @if($owners->isNotEmpty())
                <div class="row g-4 justify-content-center">
                    @foreach ($owners as $owner)
                        <div class="col-sm-6 col-lg-3">
                            <div class="nf-owner-card">
                                <div class="nf-owner-photo">
                                    <img src="{{ route('owner.photo', $owner) }}" alt="{{ $owner->name }}" loading="lazy">
                                </div>
                                <h5 class="nf-owner-name">{{ $owner->name }}</h5>
                                <p class="nf-owner-role">Founder &amp; Owner</p>
                                <div class="nf-owner-social">
                                    @if($owner->facebook)
                                        <a href="{{ $owner->facebook }}" target="_blank" rel="noopener" title="Facebook"><i class="bi bi-facebook"></i></a>
                                    @endif
                                    @if($owner->instagram)
                                        <a href="{{ $owner->instagram }}" target="_blank" rel="noopener" title="Instagram"><i class="bi bi-instagram"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <div style="font-size:3rem;margin-bottom:0.6rem;">🕊️</div>
                    <h5 class="nf-serif fw-bold">Our founders are getting ready</h5>
                    <p class="nf-section-sub">Stay close — the faces behind the flame will appear here soon.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ===== TESTIMONIALS ===== -->
    <section id="gifts" class="py-5" style="background:linear-gradient(180deg,#FFF5F7 0%,#FFE9EE 100%);">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="nf-section-tag">Words of Love</span>
                <h2 class="nf-section-title">Hearts that received our gifts</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="nf-quote-card">
                        <i class="bi bi-quote"></i>
                        <p>"It wasn't just a gift — it was a feeling wrapped in ribbon. My fiancée cried, in the best way possible."</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="chatbox-user-avatar-icon me-2" style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#FFB3C1,#FF4D6D);display:flex;align-items:center;justify-content:center;color:#fff;"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <strong>Rafsan Ahmed</strong>
                                <div><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><small class="text-muted ms-1">Anniversary gift</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="nf-quote-card">
                        <i class="bi bi-quote"></i>
                        <p>"The golden wrapping alone felt like a dream. It's my whole family's go to for special dates now."</p>
                        <div class="d-flex align-items-center mt-3">
                            <div class="d-flex align-items-center justify-content-center me-2" style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#FFD166,#FFB300);color:#1F1F1F;"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <strong>Nusrat Jahan</strong>
                                <div><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><small class="text-muted ms-1">Birthday gift</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="nf-quote-card">
                        <i class="bi bi-quote"></i>
                        <p>"Worked with me to surprise my best friend across the city. The note was sealed like a little golden letter."</p>
                        <div class="d-flex align-items-center mt-3">
                            <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#C9E4FF,#4D8FD6);display:flex;align-items:center;justify-content:center;color:#fff;" class="me-2"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <strong>Arif Hossain</strong>
                                <div><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><small class="text-muted ms-1">Just because</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CUSTOMER REVIEWS ===== -->
    <section class="nf-reviews py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="nf-section-tag"><i class="bi bi-chat-quote"></i> Customer Reviews</span>
                <h2 class="nf-section-title">Screenshots from <span style="color:#FFD166;">real, happy hearts</span></h2>
                <p class="nf-section-sub">Precious proof straight from our customers — every frame is a real conversation with us.</p>
            </div>

            @if($customerReviews->isNotEmpty())
                <div class="row g-4 justify-content-center">
                    @foreach ($customerReviews as $review)
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <figure class="nf-review-frame">
                                <a href="{{ route('review.image', $review) }}" target="_blank" rel="noopener" title="Open full screenshot">
                                    <img src="{{ route('review.image', $review) }}" alt="Customer review screenshot" loading="lazy">
                                </a>
                                <figcaption>
                                    <div class="nf-review-name">{{ $review->customer_name ?: 'A happy customer' }}</div>
                                    @if($review->caption)
                                        <div class="nf-review-caption">{{ $review->caption }}</div>
                                    @endif
                                </figcaption>
                                <span class="nf-review-stamp">Customer Review</span>
                            </figure>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="nf-review-empty">
                    <div style="font-size:2.6rem;margin-bottom:0.5rem;">💌</div>
                    <h5>Screenshots coming soon</h5>
                    <p style="color:#C9B8C0;margin:0.5rem 0 0;">Real customer moments will be pinned here as they arrive.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ===== CTA BANNER ===== -->
    <section class="py-5">
        <div class="container">
            <div class="nf-cta">
                <span class="nf-cta-1">🕯️</span>
                <span class="nf-cta-2">🎀</span>
                <span class="nf-cta-3">🌹</span>
                <span class="nf-eyebrow mb-3" style="color:#1F1F1F;background:#FFF5F7;border-color:transparent;"><i class="bi bi-megaphone-fill"></i> Start the surprise</span>
                <h2 class="nf-serif fw-bold" style="font-size:clamp(1.8rem,3.5vw,2.8rem);">Let's wrap a feeling for them</h2>
                <p style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;max-width:560px;margin:0.8rem auto 1.8rem;color:rgba(255,255,255,0.9);">
                    Tell us who they are, and we'll turn it into a gift that says the things words can barely carry.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="#gifts" class="nf-btn nf-btn-gold">Start Choosing <i class="bi bi-gift"></i></a>
                    <a href="/contact" class="nf-btn" style="background:rgba(255,255,255,0.15);color:#fff;backdrop-filter:blur(4px);">Talk to us <i class="bi bi-chat-heart"></i></a>
                </div>
            </div>
        </div>
    </section>

</div>

@include('frontend.partials.footer')

@endsection