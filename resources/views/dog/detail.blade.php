@extends('layouts.app')
@section('title', 'Detail')

@push('style')
<style>
    body {
        background-color: #f8f9fa;
    }

    .breed-title {
        font-size: 2.2rem;
        font-weight: 600;
        margin: 40px auto 20px;
        text-align: center;
    }

    .image-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        padding: 20px;
    }

    .image-grid img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .image-grid img:hover {
        transform: scale(1.08);
    }

    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    }

    .back-button {
        display: block;
        text-align: left;
        margin: 40px 0 60px;
    }

    .back-button a {
        font-size: 24px;
        padding: 10px 25px;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .back-button a:hover {
        text-decoration: underline;
    }

</style>
@endpush

@section('content')
<div class="container">
    <div class="back-button">
        <a href="{{ url()->previous() }}"> > Back </a>
    </div>

    <h1 class="breed-title">{{ ucfirst(request()->segment(3)) }} Images</h1>

    @if($errMsg)
        <p class="text-center text-danger">{{ $errMsg }}</p>
    @else
        <div class="image-grid">
            @foreach($breedItems as $image)
                <img src="{{ $image }}" alt="Dog Image" onclick="showLightbox('{{ $image }}')">
            @endforeach
        </div>
    @endif

   
</div>

<div class="lightbox" id="lightbox" onclick="hideLightbox()">
    <img id="lightboxImage" src="" alt="Large Dog">
</div>
@endsection

@push('scripts')
<script>
    function showLightbox(src) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        lightboxImage.src = src;
        lightbox.style.display = 'flex';
    }

    function hideLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }
</script>
@endpush
