<style>
    .nf-shop-page {
        font-family: 'Inter', sans-serif;
        color: #1F1F1F;
        background: #FFF5F7;
    }

    .nf-shop-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #C9184A;
        background: #FFE3E9;
        padding: 0.45rem 1.1rem;
        border-radius: 50rem;
        border: 1px solid rgba(255, 77, 109, 0.2);
        margin-bottom: 0.9rem;
    }

    .nf-shop-title {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        font-size: clamp(1.9rem, 3.5vw, 2.8rem);
        line-height: 1.15;
        color: #1F1F1F;
        margin-bottom: 0.6rem;
    }

    .nf-shop-sub {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        color: #8A6E78;
        max-width: 620px;
    }

    /* Search */
    .nf-shop-search {
        position: relative;
        display: flex;
        align-items: center;
        max-width: 540px;
        margin: 1.4rem auto 2.4rem;
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.18);
        border-radius: 50rem;
        padding: 5px 6px 5px 0;
        box-shadow: 0 14px 34px rgba(255, 77, 109, 0.12);
        transition: all 0.3s ease;
    }

    .nf-shop-search:focus-within {
        border-color: #FF4D6D;
        box-shadow: 0 16px 40px rgba(255, 77, 109, 0.2);
    }

    .nf-shop-search > i {
        position: absolute;
        left: 1.1rem;
        color: #A08A92;
        font-size: 1rem;
    }

    .nf-shop-search input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 0.75rem 0.4rem 0.75rem 2.6rem;
        font-size: 0.95rem;
        color: #1F1F1F;
        min-width: 0;
    }

    .nf-shop-search input:focus {
        outline: none;
        box-shadow: none;
    }

    .nf-shop-search-btn {
        border: none;
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.65rem 1.4rem;
        border-radius: 50rem;
        white-space: nowrap;
        transition: all 0.3s ease;
    }

    .nf-shop-search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(255, 77, 109, 0.4);
    }

    /* Breadcrumb */
    .nf-shop-crumbs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        align-items: center;
        font-size: 0.82rem;
        color: #A08A92;
        margin-bottom: 1.2rem;
    }

    .nf-shop-crumbs a {
        color: #C9184A;
        text-decoration: none;
        font-weight: 600;
    }

    .nf-shop-crumbs a:hover {
        text-decoration: underline;
    }

    /* Category box (clickable) */
    .nf-cat-box {
        display: flex;
        align-items: center;
        gap: 1.1rem;
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.14);
        border-radius: 24px;
        padding: 1.2rem 1.4rem;
        text-decoration: none;
        color: #1F1F1F;
        box-shadow: 0 12px 30px rgba(255, 77, 109, 0.08);
        transition: all 0.35s ease;
        margin-bottom: 1.6rem;
    }

    .nf-cat-box:hover {
        transform: translateY(-4px);
        text-decoration: none;
        box-shadow: 0 24px 44px rgba(255, 77, 109, 0.18);
        border-color: rgba(255, 77, 109, 0.4);
    }

    .nf-cat-box-thumb {
        width: 60px;
        height: 60px;
        border-radius: 18px;
        object-fit: cover;
        flex-shrink: 0;
        border: 2px solid #FFFFFF;
        box-shadow: 0 8px 18px rgba(255, 77, 109, 0.25);
        background: #FFE3E9;
    }

    .nf-cat-box-info { flex: 1; min-width: 0; }

    .nf-cat-box-name {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        font-size: 1.25rem;
        color: #1F1F1F;
        margin-bottom: 0.1rem;
    }

    .nf-cat-box-desc {
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.95rem;
        color: #8A6E78;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .nf-cat-box-count {
        white-space: nowrap;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #C9184A;
        background: #FFE3E9;
        padding: 0.4rem 1rem;
        border-radius: 50rem;
    }

    .nf-cat-more {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        font-size: 0.9rem;
        color: #C9184A;
        text-decoration: none;
        transition: gap 0.3s ease;
    }

    .nf-cat-more:hover {
        color: #8A0F35;
        gap: 10px;
        text-decoration: none;
    }

    /* Category chips (category page) */
    .nf-cat-chips {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.6rem;
        margin-bottom: 2.2rem;
    }

    .nf-cat-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.55rem 1.15rem;
        border-radius: 50rem;
        background: #FFFFFF;
        border: 1px solid rgba(255, 77, 109, 0.2);
        color: #8A6E78;
        font-weight: 700;
        font-size: 0.82rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .nf-cat-chip small { font-weight: 600; opacity: 0.65; }

    .nf-cat-chip:hover {
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        border-color: transparent;
        transform: translateY(-2px);
        text-decoration: none;
        box-shadow: 0 10px 20px rgba(255, 77, 109, 0.3);
    }

    .nf-cat-chip.nf-cat-chip-active {
        background: linear-gradient(135deg, #FF4D6D, #C9184A);
        color: #FFFFFF;
        border-color: transparent;
        box-shadow: 0 10px 20px rgba(255, 77, 109, 0.3);
    }

    /* Item cards */
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
        text-decoration: none;
        color: inherit;
    }

    .nf-item-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 28px 50px rgba(255, 77, 109, 0.2);
        border-color: rgba(255, 77, 109, 0.4);
        color: inherit;
        text-decoration: none;
    }

    .nf-item-img {
        position: relative;
        aspect-ratio: 4 / 3;
        background: linear-gradient(135deg, #FFE3E9, #FFF0C2);
        overflow: hidden;
        text-decoration: none;
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
        font-size: 1.3rem;
        color: #C9184A;
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
        text-decoration: none;
    }

    .nf-shop-empty {
        background: #FFFFFF;
        border: 1px dashed rgba(255, 77, 109, 0.35);
        border-radius: 24px;
        padding: 3.5rem 2rem;
        max-width: 560px;
        margin: 0 auto;
        text-align: center;
    }

    .nf-shop-empty .nf-empty-icon {
        font-size: 3.2rem;
        margin-bottom: 0.7rem;
    }

    .nf-shop-empty h4 {
        font-family: 'Playfair Display', serif;
        font-weight: 800;
        color: #1F1F1F;
        margin-bottom: 0.5rem;
    }

    .nf-shop-empty p {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.05rem;
        color: #8A6E78;
        margin-bottom: 1.4rem;
    }
</style>