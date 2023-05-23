@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/client/landing.css') }}">
@endsection

@section('content')
    <!-- Home -->
    <section class="home" id="home">

        <div class="content">
            <h3>Kapan Nikah? Jangan Sampai Terlewat! Serahkan Semuanya pada <span> Nikah Yuk </span></h3>
            <a href="#contact" class="btn">Hubungi Kita</a>
        </div>

        <div class="swiper-container home-slider">
            <div class="swiper-wrapper">
                <!-- using unsplash image -->
                @for ($i = 0; $i < 7; $i++)
                    <div class="swiper-slide"><img src="https://source.unsplash.com/random/?wedding,married&seed{{ $i }}" alt=""></div>
                @endfor
            </div>
        </div>

    </section>

    <!-- Service -->
    <section class="service" id="service">

        <h1 class="heading"> <span>Layanan</span> Kita </h1>

        <div class="box-container">

            <!-- location -->
            <div class="box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Pilihan Lokasi</h3>
                <p>Jawa Timur, Jawa Barat, Jawa Tengah, DKI Jakarta, Bali, Daerah Istimewa Yogyakarta, Sumatera Utara, Kepulauan Riau.</p>
            </div>

            <!-- invitation -->
            <div class="box">
                <i class="fas fa-envelope"></i>
                <h3>Undangan</h3>
                <p>Tetapkan Gaya Unikmu! Undangannya Keren Abis! Ciptakan Kesan Eksklusif dengan Undangan Super Trendi dari Nikah Yuk.</p>
            </div>

            <!-- guest book -->
            <div class="box">
                <i class="fas fa-book"></i>
                <h3>Buku Tamu</h3>
                <p>Catat Jejak Momen Spesialmu! Buku Tamu yang Kece dan Unik dari Nikah Yuk Akan Membuat Setiap Pengunjung Tersenyum dan Ingin Berpartisipasi.</p>
            </div>

            <!-- entertainment -->
            <div class="box">
                <i class="fas fa-music"></i>
                <h3>Hiburan</h3>
                <p>Bikin Pesta Nikahmu Makin Seru! Hadirkan Hiburan yang Paling Kekinian dan Keren dari Nikah Yuk. Musik, Dance, dan Banyak Lagi untuk Menghibur Tamu-Tamu Terhormatmu!</p>
            </div>

            <!-- catering -->
            <div class="box">
                <i class="fas fa-utensils"></i>
                <h3>Makan Dan Minum</h3>
                <p>Jangan Sampai Ketinggalan Menu Spesial! Catering Makanan dan Minuman yang Menggugah Selera dari Nikah Yuk akan Membuat Tamu-Tamu Terpesona dengan Kelezatan yang Trendi dan Memikat.</p>
            </div>

            <!-- documentation -->
            <div class="box">
                <i class="fas fa-photo-video"></i>
                <h3>Dokumentasi</h3>
                <p>Abadikan Momen-Momen Tak Terlupakanmu! Layanan Dokumentasi dari Nikah Yuk Akan Mengabadikan Setiap Detik Bahagiamu dalam Gaya yang Kece dan Trendi. Hasilnya? Fotografi dan Video yang Menginspirasi!</p>
            </div>

            <!-- cake -->
            <div class="box">
                <i class="fas fa-birthday-cake"></i>
                <h3>Cake</h3>
                <p>Rasakan Kelezatan yang Luar Biasa! Cake yang Super Unik dan Keren dari Nikah Yuk akan Menambah Sentuhan Manis pada Hari Spesialmu. Jaminan Rasa yang Menggoda dan Tampilan yang Instagrammable!</p>
            </div>

        </div>

    </section>

    <!-- About -->
    <section class="about" id="about">

        <h1 class="heading"><span>Tentang</span> Kita </h1>

        <div class="row">

            <div class="image">
                <img src="https://source.unsplash.com/random/900x600/?team,people,work" alt="">
            </div>

            <div class="content">
                <h3>Kita Akan memberikan pesta yang spesial untuk anda</h3>
                <p>Kami adalah tim profesional di Nikah Yuk yang siap menghadirkan pengalaman pernikahan yang tak terlupakan bagi Anda. Kami berkomitmen untuk memberikan pesta pernikahan yang spesial, unik, dan trendi sesuai dengan impian dan keinginan Anda.</p>
                {{-- <p>Kami mengerti bahwa setiap pasangan memiliki cerita dan gaya pernikahan yang berbeda, dan itulah mengapa kami bekerja erat dengan Anda untuk menciptakan acara yang memenuhi harapan Anda. Dari undangan yang keren, dekorasi yang memukau, hingga hiburan yang seru, kami akan merencanakan setiap detail dengan teliti.</p> --}}
                <p>Percayakan pernikahan Anda kepada kami, dan kami akan berusaha keras untuk membuat momen berharga dalam hidup Anda menjadi tak terlupakan. Hubungi kami sekarang untuk konsultasi dan informasi lebih lanjut.</p>
                <a href="#contact" class="btn">Hubungi Kami</a>
            </div>

        </div>

    </section>

    <!-- Gallery -->
    <section class="gallery" id="gallery">

        <h1 class="heading"> <span>Galeri</span> Kami </h1>

        <div class="box-container">
            @for ($i = 0; $i < 8; $i++)
                <div class="box">
                    <img src="https://source.unsplash.com/random/900x600/?wedding,married&seed{{ $i }}" alt="">
                    {{-- <h3 class="title">Pernikahan</h3> --}}
                    {{-- <div class="icons">
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-share"></a>
                        <a href="#" class="fas fa-eye"></a>
                    </div> --}}
                </div>
            @endfor
        </div>

    </section>

    <!-- Price -->
    <section class="price" id="price">

        <h1 class="heading"> <span>Paket</span> Pernikahan </h1>

        <div class="box-container">

            <div class="box">
                <h3 class="title">Paket Kilat</h3>
                <h3 class="amount">Rp8.000.000</h3>
                <ul>
                    <li><i class="fas fa-check"></i> Akad & Pemberkatan</li>
                    <li> <i class="fas fa-check"></i> Venue & Dekorasi </li>
                    <li> <i class="fas fa-check"></i> Make Up Artist</li>
                    <li> <i class="fas fa-check"></i> Undangan </li>
                    <li> <i class="fas fa-check"></i> Jas & Gaun </li>
                    <li> <i class="fas fa-check"></i> Dokumentasi </li>
                    <li> <i class="fas fa-check"></i> KUA </li>
                    <li> <i class="fas fa-check"></i> MC </li>
                    <li> <i class="fas fa-check"></i> Snack </li>
                    <li> <i class="fas fa-times"></i> Makanan </li>
                    <li> <i class="fas fa-times"></i> Staycation </li>
                    <li> <i class="fas fa-times"></i> Honeymoon </li>
                </ul>
                <a href="#" class="btn">Dapatkan Paket</a>
            </div>

            <div class="box">
                <h3 class="title">Paket Xpress</h3>
                <h3 class="amount">Rp12.000.000</h3>
                <ul>
                    <li><i class="fas fa-check"></i> Akad & Pemberkatan</li>
                    <li> <i class="fas fa-check"></i> Venue & Dekorasi </li>
                    <li> <i class="fas fa-check"></i> Make Up Artist</li>
                    <li> <i class="fas fa-check"></i> Undangan </li>
                    <li> <i class="fas fa-check"></i> Jas & Gaun </li>
                    <li> <i class="fas fa-check"></i> Dokumentasi </li>
                    <li> <i class="fas fa-check"></i> KUA </li>
                    <li> <i class="fas fa-check"></i> MC </li>
                    <li> <i class="fas fa-check"></i> Snack </li>
                    <li> <i class="fas fa-check"></i> Makanan </li>
                    <li> <i class="fas fa-check"></i> Staycation </li>
                    <li> <i class="fas fa-times"></i> Honeymoon </li>
                </ul>
                <a href="#" class="btn">Dapatkan Paket</a>
            </div>

            <div class="box">
                <h3 class="title">Paket Honeymoon</h3>
                <h3 class="amount">Rp.18.000.000</h3>
                <ul>
                    <li><i class="fas fa-check"></i> Akad & Pemberkatan</li>
                    <li> <i class="fas fa-check"></i> Venue & Dekorasi </li>
                    <li> <i class="fas fa-check"></i> Make Up Artist</li>
                    <li> <i class="fas fa-check"></i> Undangan </li>
                    <li> <i class="fas fa-check"></i> Jas & Gaun </li>
                    <li> <i class="fas fa-check"></i> Dokumentasi </li>
                    <li> <i class="fas fa-check"></i> KUA </li>
                    <li> <i class="fas fa-check"></i> MC </li>
                    <li> <i class="fas fa-check"></i> Snack </li>
                    <li> <i class="fas fa-check"></i> Makanan </li>
                    <li> <i class="fas fa-check"></i> Staycation </li>
                    <li> <i class="fas fa-check"></i> Honeymoon </li>
                </ul>
                <a href="#" class="btn">Dapatkan Paket</a>
            </div>

        </div>

    </section>

    <!-- Review -->
    <section class="review" id="review">

        <h1 class="heading"> <span>review</span> Client </h1>

        <div class="review-slider swiper-container">
            <div class="swiper-wrapper">
                @foreach ($reviews as $review)
                    <div class="swiper-slide box">
                        <i class="fas fa-quote-right"></i>
                        <div class="user">
                            <img src="https://source.unsplash.com/random/900x600/?face&seed{{ $loop->index }}" alt="">
                            <div class="user-info">
                                <h3>{{ $review['name'] }}</h3>
                                <span>{{ $review['client_type'] }}</span>
                            </div>
                        </div>
                        <p>{{ $review['content'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <!-- Contact -->
    <section class="contact" id="contact">

        <h1 class="heading"> <span>Hubungi</span> Kita </h1>

        <form action="mailto:ndeva96@gmail.com" method="post" name="emailform" enctype="multipart/form-data">
            <div class="inputBox">
                <input type="text" placeholder="name">
                <input type="email" placeholder="email">
            </div>
            <div class="inputBox">
                <input type="number" placeholder="number">
                <input type="text" placeholder="subject">
            </div>
            <textarea name="" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="Kirim Pesan" class="btn">
        </form>

    </section>
@endsection

@section('js')
    <script src="{{ asset('js/client/landing.js') }}"></script>
@endsection
