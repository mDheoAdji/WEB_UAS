@extends('layouts.app')

@section('title', 'Updatein | Baca Berita Online')

@section('content')
    <!-- swiper -->
    @php
        $bannerCount = count($banners);
    @endphp

    <div class="flex flex-wrap gap-4">
        @foreach ($banners as $banner)
            <div class="{{ $bannerCount === 1 ? 'w-full' : 'w-full md:w-1/2' }}">
                <a href="{{ route('news.show', $banner->news->slug) }}">
                    <div class="relative h-72 rounded-xl overflow-hidden shadow-lg">
                        <img src="{{ asset('storage/' . $banner->news->thumbnail) }}" alt="banner"
                            class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                        <div class="absolute bottom-0 left-0 z-20 p-4 text-white">
                            <div class="bg-primary text-xs px-3 py-1 rounded mb-2 inline-block">
                                {{ $banner->news->newsCategory->title }}
                            </div>
                            <h2 class="text-xl font-semibold">{{ $banner->news->title }}</h2>
                            <div class="flex items-center gap-2 mt-1">
                                <img src="{{ asset('storage/' . $banner->news->author->avatar) }}"
                                    class="w-5 h-5 rounded-full">
                                <span class="text-sm">{{ $banner->news->author->name }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>



    <!-- Berita Unggulan -->
    <div class="flex flex-col px-14 mt-10 ">
        <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
            <div class="font-bold text-2xl text-center md:text-left">
                <p>Berita Unggulan</p>
                <p>Untuk Kamu</p>
            </div>
        </div>
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
            @foreach ($featureds as $featured)
                <a href="{{ route('news.show', $featured->slug) }}">
                    <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
                        style="height: 100%">
                        <div
                            class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                            {{ $featured->newsCategory->title }}
                        </div>
                        <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt=""
                            class="w-full rounded-xl mb-3" style="height: 150px; object-fit: cover;">
                        <p class="font-bold text-base mb-1">{{ $featured->title }}</p>
                        <p class="text-slate-400">{{ \Carbon\Carbon::parse($featured->created_at)->format('d F Y') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Berita Terbaru -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-10">
        <div class="flex flex-col md:flex-row w-full mb-6">
            <div class="font-bold text-2xl text-center md:text-left">
                <p>Berita Terbaru</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-5">
            <!-- Berita Utama -->
            <div
                class="relative col-span-7 lg:row-span-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
                <a href="{{ route('news.show', $news[0]->slug) }}">
                    <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">
                        {{ $news[0]->newsCategory->title }}
                    </div>
                    <img src="{{ asset('storage/' . $news[0]->thumbnail) }}" alt="berita1" class="rounded-2xl"
                        style="height: 400px; width: 100%; object-fit: cover;">
                    <p class="font-bold text-xl mt-3">
                        {{ $news[0]->title }}
                    </p>
                    <p class="text-slate-400 text-base mt-1">
                        {!! \Str::limit($news[0]->content, 100) !!}
                    </p>
                    <p class="text-slate-400">{{ \Carbon\Carbon::parse($news[0]->created_at)->format('d F Y') }}</p>

                </a>
            </div>

            <!-- Berita 1 -->
            @foreach ($news->skip(1) as $new)
                <a href="{{ route('news.show', $new->slug) }}"
                    class="relative col-span-5 flex flex-col h-fit md:flex-row gap-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
                    <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-2 mt-2 absolute text-sm">
                        {{ $new->newsCategory->title }}
                    </div>
                    <img src="{{ asset('storage/' . $new->thumbnail) }}" alt="berita2" class="rounded-xl md:max-h-48"
                        style="width: 250px; object-fit: cover;">
                    <div class="mt-2 md:mt-0">
                        <p class="font-semibold text-lg">{{ $new->title }}</p>
                        <p class="text-slate-400 mt-3 text-sm font-normal">
                            {!! \Str::limit($new->content, 15) !!}
                        </p>
                        <p class="text-slate-400 text-sm mt-1">
                            {{ \Carbon\Carbon::parse($new->created_at)->format('d F Y') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>

    <!-- Author -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-10">
        <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
            <div class="font-bold text-2xl text-center md:text-left">
                <p>Kenali Penulis</p>
                <p>Terbaik Dari Kami</p>
            </div>
        </div>
        <div class="grid grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Author 1 -->
            @foreach ($authors as $author)
                <a href="{{ route('author.show', $author->username) }}">
                    <div
                        class="flex flex-col items-center border border-slate-200 px-4 py-8 rounded-2xl hover:border-primary hover:cursor-pointer">
                        <img src="{{ asset('storage/' . $author->avatar) }}" alt="" class="rounded-full w-24 h-24">
                        <p class="font-bold text-xl mt-4">{{ $author->name }}</p>
                        <p class="text-slate-400">{{ $author->news->count() }} Berita</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Pilihan Author -->
    <div class="flex flex-col px-14 mt-10 mb-10">
        <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
            <div class="font-bold text-2xl text-center md:text-left">
                <p>Pilihan Penulis</p>
            </div>
        </div>
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
            @foreach ($news as $choice)
                <a href="{{ route('news.show', $choice->slug) }}">
                    <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
                        style="height: 100%;">
                        <div
                            class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                            {{ $choice->newsCategory->title }}
                        </div>
                        <img src="{{ asset('storage/' . $choice->thumbnail) }}" alt=""
                            class="w-full rounded-xl mb-3" style="height: 200px; object-fit: cover;">
                        <p class="font-bold text-base mb-1">
                            {{ $choice->title }}
                        </p>
                        <p class="text-slate-400">{{ \Carbon\Carbon::parse($choice->created_at)->format('d F Y') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
