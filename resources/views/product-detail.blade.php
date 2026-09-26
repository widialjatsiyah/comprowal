<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $product->title }} | {{ $company->seo_title ?: $company->company_name }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <meta name="description" content="{{ $product->summary ?: $product->title }}">
        <link rel="canonical" href="{{ route('products.show', $product->id) }}">
        <meta property="og:type" content="product">
        <meta property="og:title" content="{{ $product->title }}">
        <meta property="og:description" content="{{ $product->summary }}">
        @if ($product->image_path)<meta property="og:image" content="{{ asset('storage/'.$product->image_path) }}">@endif
        <meta name="twitter:card" content="summary_large_image">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="site-shell min-h-screen">
        <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
            <a href="{{ url('/') }}" class="flex items-center gap-3" aria-label="{{ $company->company_name }}">
                @if ($company->logo_path)
                    <img src="{{ asset('storage/'.$company->logo_path) }}" alt="Logo {{ $company->company_name }}" class="h-11 w-11 rounded-xl object-contain">
                @else
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--signal)] text-xl font-bold text-white">{{ mb_strtoupper(mb_substr($company->company_name, 0, 1)) }}</span>
                @endif
                <span class="display-font text-lg font-bold tracking-tight">{{ $company->company_name }}</span>
            </a>
            <nav class="flex items-center gap-4 text-sm font-semibold sm:gap-8" aria-label="Navigasi utama">
                <a href="{{ url('/') }}" class="transition hover:text-[var(--signal)]">Home</a>
                <a href="{{ route('products.index') }}" class="transition hover:text-[var(--signal)]">Produk</a>
                <a href="{{ route('portfolio.index') }}" class="transition hover:text-[var(--signal)]">Portofolio</a>
                <a href="{{ url('/') }}#kontak" class="rounded-full bg-[var(--ink)] px-5 py-3 text-white transition hover:bg-[var(--signal)]">Hubungi kami <span aria-hidden="true">↗</span></a>
            </nav>
        </header>

        <main>
            <section class="mx-auto max-w-7xl px-6 pb-8 pt-8 lg:px-10 lg:pt-12">
                <a href="{{ route('products.index') }}" class="text-sm font-bold text-[var(--signal)] transition hover:underline">← Kembali ke produk</a>
            </section>

            <section class="mx-auto max-w-7xl px-6 pb-8 lg:px-10">
                <div class="grid gap-8 lg:grid-cols-2">
                    {{-- Image --}}
                    <div class="overflow-hidden border border-[var(--line)] bg-[var(--mint)]">
                        @if ($product->image_path)
                            <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->title }}" class="h-full w-full object-cover">
                        @else
                            <div class="flex aspect-[16/9] items-center justify-center">
                                <span class="display-font text-6xl font-bold text-[var(--line)]">{{ mb_strtoupper(mb_substr($product->title, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex flex-col justify-center">
                        <p class="text-xs font-bold uppercase tracking-[.24em] text-[var(--signal)]">{{ $product->category ?: 'Digital product' }}</p>
                        <h1 class="display-font mt-4 text-4xl font-bold leading-tight tracking-tight sm:text-5xl">{{ $product->title }}</h1>
                        <p class="mt-6 text-lg leading-7 text-[var(--muted)]">{{ $product->summary }}</p>

                        <div class="mt-6 flex items-center gap-4 text-sm text-[var(--muted)]">
                            <span class="flex items-center gap-1.5">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ number_format($product->views_count) }} dilihat
                            </span>
                        </div>

                        @if ($product->product_url)
                            <a href="{{ $product->product_url }}" target="_blank" rel="noreferrer" class="mt-8 inline-block w-fit rounded-full bg-[var(--ink)] px-6 py-3 text-sm font-bold text-white transition hover:bg-[var(--signal)]">Lihat produk ↗</a>
                        @endif
                    </div>
                </div>
            </section>

            {{-- Description --}}
            @if ($product->description)
                <section class="mx-auto max-w-7xl px-6 pb-24 lg:px-10">
                    <div class="border-t border-[var(--line)] pt-12">
                        <h2 class="display-font text-2xl font-bold">Tentang produk ini</h2>
                        <div class="prose mt-6 max-w-none text-[var(--muted)] leading-7">{!! nl2br(e($product->description)) !!}</div>
                    </div>
                </section>
            @endif
        </main>

        <footer class="bg-[var(--ink)] text-white">
            <div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 px-6 py-8 text-sm sm:flex-row lg:px-10">
                <span>© {{ date('Y') }} {{ $company->company_name }}</span>
                <a href="{{ url('/') }}#kontak" class="font-semibold text-white/75 transition hover:text-white">Mulai proyek bersama ↗</a>
            </div>
        </footer>
    </body>
</html>
