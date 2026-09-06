<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Produk | {{ $company->seo_title ?: $company->company_name }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <meta name="description" content="{{ $company->seo_description ?: 'Produk digital '.$company->company_name }}">
        @if ($company->seo_keywords)<meta name="keywords" content="{{ $company->seo_keywords }}">@endif
        <link rel="canonical" href="{{ route('products.index') }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Produk | {{ $company->company_name }}">
        <meta property="og:description" content="{{ $company->seo_description ?: 'Produk digital '.$company->company_name }}">
        <meta property="og:url" content="{{ route('products.index') }}">
        @if ($company->seo_image)<meta property="og:image" content="{{ asset('storage/'.$company->seo_image) }}">@endif
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
                <a href="{{ route('portfolio.index') }}" class="transition hover:text-[var(--signal)]">Portofolio</a>
                <a href="{{ url('/') }}#kontak" class="rounded-full bg-[var(--ink)] px-5 py-3 text-white transition hover:bg-[var(--signal)]">Hubungi kami <span aria-hidden="true">↗</span></a>
            </nav>
        </header>

        <main>
            <section class="mx-auto max-w-7xl px-6 pb-16 pt-16 lg:px-10 lg:pt-24">
                <p class="text-xs font-bold uppercase tracking-[.24em] text-[var(--signal)]">Our products</p>
                <div class="mt-5 flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <h1 class="display-font max-w-3xl text-5xl font-bold leading-[.98] tracking-[-.04em] sm:text-7xl">Produk digital untuk pekerjaan nyata.</h1>
                    <p class="max-w-sm text-lg leading-7 text-[var(--muted)]">Jelajahi produk yang kami rancang agar bisnis bekerja lebih cepat, jelas, dan siap berkembang.</p>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 pb-24 lg:px-10">
                <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                    @forelse ($products as $product)
                        <article class="group overflow-hidden border border-[var(--line)] bg-white">
                            <div class="aspect-[16/9] overflow-hidden bg-[var(--mint)]">
                                @if ($product->image_path)
                                    <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @endif
                            </div>
                            <div class="p-6">
                                <p class="text-xs font-bold uppercase tracking-[.16em] text-[var(--signal)]">{{ $product->category ?: 'Digital product' }}</p>
                                <h2 class="display-font mt-4 text-xl font-bold">{{ $product->title }}</h2>
                                <p class="mt-3 text-sm leading-6 text-[var(--muted)]">{{ $product->summary }}</p>
                                @if ($product->product_url)
                                    <a href="{{ $product->product_url }}" target="_blank" rel="noreferrer" class="mt-5 inline-block text-sm font-bold">Lihat produk ↗</a>
                                @endif
                            </div>
                        </article>
                    @empty
                        <p class="border border-[var(--line)] bg-white p-8 text-[var(--muted)] sm:col-span-2 xl:col-span-4">Belum ada produk yang dipublikasikan.</p>
                    @endforelse
                </div>
                @if (method_exists($products, 'links'))
                    <div class="mt-12">{{ $products->links() }}</div>
                @endif
            </section>
        </main>

        <footer class="bg-[var(--ink)] text-white">
            <div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 px-6 py-8 text-sm sm:flex-row lg:px-10">
                <span>© {{ date('Y') }} {{ $company->company_name }}</span>
                <a href="{{ url('/') }}#kontak" class="font-semibold text-white/75 transition hover:text-white">Mulai proyek bersama ↗</a>
            </div>
        </footer>
    </body>
</html>
