@extends('partials.master')

@section('content')
<style>
    body {
        background-color: #ffffff;
        color: #000;
    }

    .about-header {
        background: linear-gradient(135deg,rgb(26, 72, 29), #66bb6a);
        color: white;
        padding: 60px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-header::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 40px;
        background: #ffffff;
        border-top-left-radius: 100% 20px;
        border-top-right-radius: 100% 20px;
    }

    .section {
        padding: 40px 20px;
    }

    .swiper {
        width: 100%;
        padding-top: 30px;
    }

    .swiper-wrapper {
        align-items: stretch;
    }

    .swiper-slide {
        background: #f9f9f9;
        text-align: center;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 100%;
    }

    .icon {
        font-size: 40px;
        color: #4caf50;
        margin-bottom: 15px;
    }
</style>

<div class="about-header">
    <h1>About Green Roots</h1>
    <p>Growing a greener future, together 🌱</p>
</div>

<div class="container section text-center">
    <p class="lead">
        Green Roots is a passionate project dedicated to selling and planting trees, one sapling at a time.
        Our mission is to make greenery accessible and beautiful in every home, school, and city.
    </p>
</div>

<div class="container section">
    <h3 class="text-center mb-4">Why People Love Us 💚</h3>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="icon"><i class="fas fa-seedling"></i></div>
                <h5>Sustainable Plants</h5>
                <p>All our trees are eco-sourced and thrive in local environments.</p>
            </div>

            <div class="swiper-slide">
                <div class="icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h5>Community Support</h5>
                <p>We work with schools and neighborhoods to create greener spaces.</p>
            </div>

            <div class="swiper-slide">
                <div class="icon"><i class="fas fa-truck"></i></div>
                <h5>Fast Delivery</h5>
                <p>Get your favorite trees delivered right to your doorstep — healthy and fast.</p>
            </div>

            <div class="swiper-slide">
                <div class="icon"><i class="fas fa-tree"></i></div>
                <h5>Expert Care Tips</h5>
                <p>Every tree comes with care instructions from our botanical experts.</p>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.mySwiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 4000,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
        }
    });
</script>
@endsection