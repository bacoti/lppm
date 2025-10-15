@extends('frontend.layouts.app')

@section('content')
    <div class="mb-5">
        {!! $content->body ?? '<p>Konten belum tersedia.</p>' !!}
    </div>
@endsection
