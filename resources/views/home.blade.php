@extends('layouts.frontend.app')
@push('addon-script')
<script src="/template/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(function() {
        slide();
        infografis();
    });

    function slide() {
        $.ajax({
            url: 'https://bolmongkab.go.id/api/slider',
            type: "GET",
            dataType: "json",
            success: function(response) {
                $('.carousel-indicators').html("");
                $('.carousel-inner').html("");
                $.each(response.data.data, function(index, value) {
                    var classActive;

                    index == 0 ? classActive = 'active' : classActive = '';
                    $('.carousel-indicators').append(`<li data-target="#carouselExampleIndicators" data-slide-to="${index}" class="${classActive}"></li>`);
                    $('.carousel-inner').append(`<div class="carousel-item ${classActive}"><img class="d-block w-100" src="${value.image}" alt="" style="height:600px; object-fit:cover; object-position:center;"></div>`);
                });
            }
        });
    }

    function infografis() {
        $.ajax({
            url: 'https://bolmongkab.go.id/api/infografis',
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data.success == true) {
                    // alert('ok');
                }
            }
        });
    }
</script>
@endpush
@section('content')
<section id="blog" class="blog">
    <div class="container">

        <div class="section-title">
            <h2>News</h2>
        </div>

        <div class="row">
            <div class="col">
                <div class="row">
                    @foreach($news as $item)
                    <div class="col-12 d-flex align-items-stretch" data-aos="fade-up">
                        <article class="entry">
                            @if(Storage::disk('public')->exists($item->image ?? null))
                            <div class="entry-img">
                                <img src="{{ Storage::url($item->image ?? null) }}" alt="" class="img-fluid" style="height:350px; width:100%; object-fit:cover; object-position:center;">
                            </div>
                            @endif

                            <h2 class="entry-title">
                                <a href="{{ route('detail-news', $item->slug) }}">{{ $item->name }}</a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="icofont-user"></i> {{ $item->author->name }}</li>
                                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <time datetime="2021-03-25">{{ $item->created_at->diffForHumans() }}</time></li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    {{ Str::limit($item->body ?? null, 100) }}
                                </p>
                                <div class="read-more">
                                    <a href="{{ route('detail-news', $item->slug) }}">Selengkapnya</a>
                                </div>
                            </div>

                        </article><!-- End blog entry -->
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-4">
                <div class="mb-2">
                    {!! $profile->video_embed !!}
                </div>
                <div class="mt-2 mb-2">
                    <script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
                    <div id="gpr-kominfo-widget-container"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4 class="entry-title">Peraturan Bupati</h4>
                        <p>
                            <a href="/perbub/PERBUP NO 49 TAHUN 2021.pdf">PERBUB NO 49 TAHUN 2021</a>
                        </p>
                        <p>
                            <a href="/perbub/Lampiran 1 PERBUP No 49 Tahun 2021.pdf">LAMPIRAN 1 PERBUB NO 49 TAHUN 2021</a>
                        </p>
                        <p>
                            <a href="/perbub/Lampiran 2 PERBUP N0 49 Tahun 2021.pdf">LAMPIRAN 2 PERBUB NO 49 TAHUN 2021</a>
                        </p>
                        <p>
                            <a href="/perbub/Lampiran 3 PERBUP NO 49 Tahun 2021.pdf">LAMPIRAN 3 PERBUB NO 49 TAHUN 2021</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Blog Section -->

<section id="more" class="services">
    <div class="container">
        <div class="row">
            @if($information->count() > 0)
            <div class="col">
                <div class="section-title">
                    <h2>Information</h2>
                </div>
                @foreach($information as $item)
                <div class="row">
                    <div class="col-md-12">
                        <div class="icon-box d-flex align-items-center">
                            @if(Storage::disk('public')->exists($item->image ?? null))
                            <img src="{{ Storage::url($item->image ?? null ) }}" width="100" alt="">
                            @endif
                            <h4><a href="{{ route('information', $item->slug) }}">{{ $item->name ?? null }}</a></h4>
                            <p class="text-secondary">Event Date : {{ $item->event_date ?? null }} | Event Time : {{ $item->event_time ?? null }}</p>
                            <p>{{ Str::limit($item->body ?? null, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($events->count() > 0)
            <div class="col">
                <div class="section-title">
                    <!-- <p></p> -->
                    <h2>Events</h2>
                </div>
                @foreach($events as $item)
                <div class="row">
                    <div class="col">
                        <div class="icon-box align-items-center">
                            @if(Storage::disk('public')->exists($item->image ?? null))
                            <img src="{{ Storage::url($item->image ?? null ) }}" width="100" alt="">
                            @endif
                            <h4><a href="{{ route('event', $item) }}">{{ $item->name ?? null }}</a></h4>
                            <p class="text-secondary">Event Date : {{ $item->event_date ?? null }} | Event Time : {{ $item->event_time ?? null }}</p>
                            <p>{{ Str::limit($item->body ?? null, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="col">
            <div class="row">
                <div class="col">
                    <a href="/infografis/WhatsApp Image 2022-04-11 at 09.15.55.jpeg" target="_blank"><img src="/infografis/WhatsApp Image 2022-04-11 at 09.15.55.jpeg" style="width: 400px;" /></a>
                </div>
                <div class="col">
                    <a href="/infografis/WhatsApp Image 2022-04-11 at 09.15.56.jpeg" target="_blank"><img src="/infografis/WhatsApp Image 2022-04-11 at 09.15.56.jpeg" style="width: 400px;" /></a>

                </div>
            </div>
        </div>

    </div>
</section>

<section>
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <h1 class="h2 text-center">Pertanyaan yang Sering Ditanyakan (FAQ)</h1>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="accordion">
                <div class="card card-secondary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <div class="card-header">
                            <h4 class="h6 text-secondary">
                                Selain Kantor Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Bolaang Mongondow dimanakah unit atau outlet terdekat yang bisa dikunjungi oleh masyarakat / pelaku usaha. ?
                            </h4>
                        </div>
                    </a>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body text-secondary">
                            <ul>
                                <li>Service Ponit berada di Kantor Kecamatan Dumoga Utara</li>
                                <li>Service Point berada di Kantor Kecamatan Passi Barat</li>
                                <li>Service Point berada di Kantor Kecamatan Dumoga</li>
                                <li>Service Point berada di Kantor Kecamatan Poigar</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card card-secondary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="h6 text-secondary">
                                Apa saja persyaratan umum yang harus dibawah jika kita mengurus perizinan pada DPMPTSP Kabupaten Bolaang Mongondow. ?
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body text-secondary">
                            <ul>
                                <li>Surat Permohonan</li>
                                <li>FC. KTP Pemohon</li>
                                <li>FC. NPWP Pemohon / Perusahaan</li>
                                <li>FC. Akta Pendirian Perusahaan (PT, CV dan Koperasi)</li>
                                <li>FC. Sertifikat Badan Usaha (SBU)</li>
                                <li>FC. Sertifikat Tanah (untuk PBG)</li>
                                <li>FC. IMB/PBG</li>
                                <li>Gambar Bangunan (untuk PBG)</li>
                                <li>Rekomendasi dari Dinas Terkait</li>
                                <li>Pas Foto warna ukuran 4 x 6 1 lembar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection