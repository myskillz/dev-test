@extends('layouts.app')

@section('title', 'Home')

@push('style')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .search-container {
        margin-top: 100px;
        text-align: center;
    }

    .search-container h3 {
        font-size: 28px;
        margin-bottom: 30px;
    }

    #searchInput {
        padding: 12px 20px;
        font-size: 18px;
        min-width: 400px;
        border: 2px solid #ccc;
        border-radius: 30px;
    }

    .searchInput-icon {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #666;
    }

    .breed-list {
        margin-top: 50px;
        text-align: center;
    }

    .breed-list ul {
        list-style: none;
        padding: 0;
        display: inline-block;
        text-align: left;
    }

    .breed-list ul > li {
        margin-bottom: 15px;
    }

    .breed-list strong {
        color: #333;
        font-size: 18px;
    }

    .breed-list ul ul {
        margin-top: 5px;
    }

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .search-container {
        margin-top: 80px;
        text-align: center;
    }

    #searchInput {
        padding: 12px 20px;
        font-size: 18px;
        min-width: 400px;
        border: 2px solid #ccc;
        border-radius: 30px;
    }

    .searchInput-icon {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #666;
    }

    .breed-list {
        margin-top: 50px;
        text-align: center;
    }

    .breed-list ul {
        list-style: none;
        padding: 0;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        max-width: 1000px;
    }

    .breed-list ul > li {
        background-color: white;
        padding: 12px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-align: center;
    }

    .breed-list ul ul {
        margin-top: 10px;
        gap: 5px;  
    }
    form{
        margin:auto;
    }
    a{
        color: #333;
        text-decoration-line: none;
    }
    a:hover{
        text-decoration-line: underline
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="search-container">
        <h3>What pet are you looking for?</h3>
        <form class="position-relative d-inline-block w-100" style="max-width: 600px;">
            <input id="searchInput" class="form-control me-2" type="search" placeholder="Search for a dog breed..." aria-label="Search">
            <i class="ph ph-magnifying-glass searchInput-icon"></i>
        </form>
    </div>

    <div class="breed-list">
        <h3>All Dog Breeds</h3>

        @if($errMsg)
            <p style="color: red;">{{ $errMsg }}</p>
        @endif

        <hr class="w-25 mx-auto">

        <ul>
            @foreach($breedItems as $breed => $subbreeds)
                <li class="breed-item" data-breed="{{ strtolower($breed) }}">
                    <a href="/dog/breed/{{ strtolower($breed) }}"><strong>{{ ucfirst($breed) }}</strong></a>
                    @if (!empty($subbreeds))
                        <ul>
                            @foreach($subbreeds as $subbreed)
                                <li>{{ ucfirst($subbreed) }}</li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('searchInput').focus();

            const titles = [
                "Looking for a Dog Breed?",
                "Searching for a Cat Breed?",
                "What Dog Breed Fits You?",
                "Find Your Perfect Feline Companion",
                "Explore Cat Breeds by Trait",
                "Discover Rare Dog Breeds",
                "Which Breed is Right for Your Family?",
                "Find Cat Breeds with Unique Traits",
                "Discover Dogs by Size and Temperament"
            ];

            //const randomTitle = titles[Math.floor(Math.random() * titles.length)];
            document.getElementById('typewriterText').textContent = titles[0];
        });

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const breedItems = document.querySelectorAll('.breed-item');

            searchInput.addEventListener('input', function () {
                const searchText = searchInput.value.toLowerCase();

                breedItems.forEach(function (item) {
                    const breedName = item.dataset.breed;
                    if (breedName.includes(searchText)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
