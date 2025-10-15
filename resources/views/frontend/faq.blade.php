@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-uppercase">Frequently Asked Question</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @php
        $faqs = [
        'UMUM',
        'PENGAJUAN INSENTIF',
        'PERTEMUAN ILMIAH',
        'RISTEK<br><small>PENELITIAN DAN PENGABDIAN</small>',
        'HKI<br><small>HAK KEKAYAAN INTELEKTUAL</small>',
        'ITHENTICATE / TURNITIN',
        'REPOSITORY & SINTA',
        'LAIN-LAIN'
        ];
        @endphp

        @foreach ($faqs as $faq)
        <div class="col">
            <div class="card shadow-sm border-0 h-100" style="background-color: #d6e4f0; position: relative;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-4"
                    style="min-height: 140px;">
                    <div class="w-100 d-flex justify-content-between">
                        <div style="height: 6px; width: 40px; background-color: #ffb703;"></div>
                        <div style="height: 6px; width: 60px; background-color: #023047;"></div>
                    </div>

                    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
                        <h5 class="card-title fw-bold" style="margin: 20px 0;" {!! str_contains($faq, '<' ) ? ''
                            : 'class="text-uppercase"' !!}>
                            {!! $faq !!}
                        </h5>
                    </div>

                    <div class="w-100 d-flex justify-content-between">
                        <div style="height: 10px; width: 20px; background-color: #6a994e;"></div>
                        <div style="height: 6px; width: 60px; background-color: #023047;"></div>
                        <div style="height: 6px; width: 40px; background-color: #ffb703;"></div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-5">
        <strong>SHARE</strong>
        <a class="btn btn-primary btn-sm mx-1" href="#"><i class="bi bi-facebook"></i> Facebook</a>
        <a class="btn btn-info btn-sm text-white" href="#"><i class="bi bi-twitter"></i> Twitter</a>
    </div>
</div>
@endsection