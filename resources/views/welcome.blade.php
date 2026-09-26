<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $company->seo_title ?: $company->company_name.' | Digital partner' }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <meta name="description" content="{{ $company->seo_description ?: $company->description }}">
        @if ($company->seo_keywords)<meta name="keywords" content="{{ $company->seo_keywords }}">@endif
        <link rel="canonical" href="{{ route('home') }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $company->seo_title ?: $company->company_name }}">
        <meta property="og:description" content="{{ $company->seo_description ?: $company->description }}">
        <meta property="og:url" content="{{ route('home') }}">
        @if ($company->seo_image)<meta property="og:image" content="{{ asset('storage/'.$company->seo_image) }}">@endif
        <meta name="twitter:card" content="summary_large_image">
        <script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => $company->company_name, 'description' => $company->seo_description ?: $company->description, 'url' => route('home'), 'logo' => $company->logo_path ? asset('storage/'.$company->logo_path) : null], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="site-shell min-h-screen">
        <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-10">
            <a href="#top" class="flex items-center gap-3" aria-label="{{ $company->company_name }}">
                @if ($company->logo_path)
                    <img src="{{ asset('storage/'.$company->logo_path) }}" alt="Logo {{ $company->company_name }}" class="h-11 w-11 rounded-xl object-contain">
                @else
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--signal)] text-xl font-bold text-white">{{ mb_strtoupper(mb_substr($company->company_name, 0, 1)) }}</span>
                @endif
                <span class="display-font text-lg font-bold tracking-tight">{{ $company->company_name }}</span>
            </a>
            <nav class="hidden items-center gap-8 text-sm font-semibold md:flex" aria-label="Navigasi utama">
                <a href="#layanan" class="transition hover:text-[var(--signal)]">Layanan</a>
                <a href="{{ route('portfolio.index') }}" class="transition hover:text-[var(--signal)]">Portofolio</a>
                <a href="{{ route('products.index') }}" class="transition hover:text-[var(--signal)]">Produk</a>
                <a href="#tentang" class="transition hover:text-[var(--signal)]">Tentang kami</a>
                <a href="#kontak" class="rounded-full bg-[var(--ink)] px-5 py-3 text-white transition hover:bg-[var(--signal)]">Mulai ngobrol <span aria-hidden="true">↗</span></a>
            </nav>
        </header>

        <main id="top">
            <section class="mx-auto grid max-w-7xl gap-14 px-6 pb-24 pt-12 lg:grid-cols-[1.05fr_.95fr] lg:items-center lg:px-10 lg:pb-32 lg:pt-20">
                <div class="reveal">
                    <p class="mb-7 flex items-center gap-3 text-xs font-bold uppercase tracking-[.24em] text-[var(--signal)]"><span class="h-2 w-2 rounded-full bg-[var(--signal)]"></span> Technology, made useful</p>
                    <h1 class="display-font max-w-3xl text-5xl font-bold leading-[.98] tracking-[-.04em] sm:text-7xl">{{ $company->tagline ?: 'Membangun masa depan digital, bersama.' }}</h1>
                    <p class="mt-8 max-w-xl text-lg leading-8 text-[var(--muted)]">{{ $company->description }}</p>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="#kontak" class="rounded-full bg-[var(--signal)] px-6 py-4 text-sm font-bold text-white transition hover:-translate-y-1 hover:shadow-xl">Ceritakan tantanganmu <span aria-hidden="true">↗</span></a>
                        <a href="#layanan" class="rounded-full border border-[var(--line)] px-6 py-4 text-sm font-bold transition hover:border-[var(--ink)]">Lihat layanan</a>
                    </div>
                </div>
                <div class="reveal reveal-delay relative min-h-[380px] overflow-hidden rounded-[2rem] bg-[var(--mint)] p-7 sm:min-h-[480px]">
                    <div class="absolute right-[-5%] top-[8%] h-56 w-56 rounded-full border-[24px] border-[var(--signal)] sm:h-72 sm:w-72"></div>
                    <div class="absolute bottom-[-15%] left-[-10%] h-64 w-64 rounded-full bg-[var(--ink)] sm:h-80 sm:w-80"></div>
                    <div class="relative flex h-full flex-col justify-between">
                        <div class="flex items-center justify-between text-xs font-bold uppercase tracking-[.2em]"><span>Independent digital studio</span><span>01 / 03</span></div>
                        <div class="relative z-10 max-w-xs text-white"><p class="display-font text-4xl font-bold leading-none">Ideas into infrastructure.</p><p class="mt-4 text-sm leading-6 text-white/70">Strategi, desain, dan engineering dalam satu tim yang fokus.</p></div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-6 pb-16 lg:px-10">
                <div class="flex flex-row  border-t border-[var(--line)]">
                    <div class="flex-1 py-6 text-center"><p class="display-font text-4xl font-bold">{{ $clientCount }}+</p><p class="mt-1 text-xs font-bold uppercase tracking-[.18em] text-[var(--muted)]">Total klien</p></div>
                    <div class="flex-1 py-6 text-center"><p class="display-font text-4xl font-bold">{{ $productCount }}+</p><p class="mt-1 text-xs font-bold uppercase tracking-[.18em] text-[var(--muted)]">Total produk</p></div>
                </div>
            </section>

            <section id="produk" class="border-y border-[var(--line)] bg-white/60">
                <div class="mx-auto max-w-7xl px-6 py-20 lg:px-10">
                    <div class="mb-12 flex flex-col justify-between gap-5 md:flex-row md:items-end"><div><p class="text-xs font-bold uppercase tracking-[.24em] text-[var(--signal)]">Products</p><h2 class="display-font mt-3 text-4xl font-bold tracking-tight">Produk yang siap digunakan.</h2></div><a href="{{ route('products.index') }}" class="w-fit rounded-full bg-[var(--ink)] px-5 py-3 text-sm font-bold text-white transition hover:bg-[var(--signal)]">Lihat semua produk <span aria-hidden="true">↗</span></a></div>
                    @if ($products->isNotEmpty())
                        <div class="product-carousel" data-product-count="{{ $products->count() }}">
                            <div class="product-track">
                                @foreach ($products as $product)
                                    <article class="product-card group overflow-hidden border border-[var(--line)] bg-[var(--paper)]">
                                        <div class="aspect-[16/9] overflow-hidden bg-[var(--mint)]">@if ($product->image_path)<a href="{{ route('products.show', $product->id) }}" class="block h-full w-full"><img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105"></a>@endif</div>
                                        <div class="p-6"><p class="text-xs font-bold uppercase tracking-[.16em] text-[var(--signal)]">{{ $product->category ?: 'Digital product' }}</p><h3 class="display-font mt-4 text-2xl font-bold"><a href="{{ route('products.show', $product->id) }}" class="transition hover:text-[var(--signal)]">{{ $product->title }}</a></h3><p class="mt-3 text-sm leading-6 text-[var(--muted)]">{{ $product->summary }}</p></div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="border border-[var(--line)] bg-[var(--paper)] p-8 text-[var(--muted)]">Belum ada produk yang dipublikasikan.</p>
                    @endif
                </div>
            </section>

            <section id="layanan" class="border-y border-[var(--line)] bg-white/60">
                <div class="mx-auto max-w-7xl px-6 py-20 lg:px-10">
                    <div class="mb-12 flex flex-col justify-between gap-5 md:flex-row md:items-end"><div><p class="text-xs font-bold uppercase tracking-[.24em] text-[var(--signal)]">What we do</p><h2 class="display-font mt-3 text-4xl font-bold tracking-tight">Teknologi tanpa kerumitan.</h2></div><p class="max-w-sm text-sm leading-6 text-[var(--muted)]">Kami mengubah kebutuhan bisnis menjadi produk digital yang jelas, cepat, dan berdampak.</p></div>
                    <div class="grid gap-px overflow-hidden border border-[var(--line)] bg-[var(--line)] md:grid-cols-3">
                        @forelse ($services as $index => $service)
                            <article class="bg-[var(--paper)] p-7 transition hover:bg-[var(--ink)] hover:text-white"><span class="text-sm font-bold text-[var(--signal)]">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><h3 class="display-font mt-16 text-2xl font-bold">{{ $service->title }}</h3><p class="mt-4 text-sm leading-6 opacity-65">{{ $service->summary }}</p></article>
                        @empty
                            <article class="bg-[var(--paper)] p-7 transition hover:bg-[var(--ink)] hover:text-white"><span class="text-sm font-bold text-[var(--signal)]">01</span><h3 class="display-font mt-16 text-2xl font-bold">Digital strategy</h3><p class="mt-4 text-sm leading-6 opacity-65">Peta jalan yang membuat keputusan teknologi lebih terarah.</p></article>
                            <article class="bg-[var(--paper)] p-7 transition hover:bg-[var(--ink)] hover:text-white"><span class="text-sm font-bold text-[var(--signal)]">02</span><h3 class="display-font mt-16 text-2xl font-bold">Product engineering</h3><p class="mt-4 text-sm leading-6 opacity-65">Produk web dan aplikasi yang dibangun untuk bertumbuh.</p></article>
                            <article class="bg-[var(--paper)] p-7 transition hover:bg-[var(--ink)] hover:text-white"><span class="text-sm font-bold text-[var(--signal)]">03</span><h3 class="display-font mt-16 text-2xl font-bold">Experience design</h3><p class="mt-4 text-sm leading-6 opacity-65">Pengalaman digital yang mudah dipahami dan disukai.</p></article>
                        @endforelse
                    </div>
                </div>
            </section>

            <section id="tentang" class="mx-auto max-w-7xl px-6 py-24 lg:px-10"><div class="grid gap-10 lg:grid-cols-2"><p class="display-font max-w-xl text-3xl font-semibold leading-tight sm:text-5xl">Kami percaya teknologi terbaik terasa sederhana bagi orang yang menggunakannya.</p><div class="border-l-2 border-[var(--signal)] pl-6 text-lg leading-8 text-[var(--muted)]"><p>{{ $company->description }}</p></div></div></section>

            @if ($projects->isNotEmpty())
                <section id="portofolio" class="mx-auto max-w-7xl px-6 py-24 lg:px-10">
                    <div class="mb-12 flex flex-col justify-between gap-5 md:flex-row md:items-end"><div><p class="text-xs font-bold uppercase tracking-[.24em] text-[var(--signal)]">Selected work</p><h2 class="display-font mt-3 text-4xl font-bold tracking-tight">Beberapa karya pilihan.</h2></div><a href="{{ route('portfolio.index') }}" class="w-fit rounded-full bg-[var(--ink)] px-5 py-3 text-sm font-bold text-white transition hover:bg-[var(--signal)]">Lihat semua portofolio <span aria-hidden="true">↗</span></a></div>
                    <div class="project-carousel">
                        <div class="project-track">
                            @foreach ($projects as $project)
                                <article class="project-card group overflow-hidden border border-[var(--line)] bg-white"><div class="aspect-[16/9] overflow-hidden bg-[var(--mint)]">@if ($project->image_path)<img src="{{ asset('storage/'.$project->image_path) }}" alt="{{ $project->title }}" class="h-full w-full transition duration-500 {{ ($project->media_type ?? 'image') === 'logo' ? 'object-contain p-12' : 'object-cover group-hover:scale-105' }}">@endif</div><div class="p-6"><div class="flex items-center justify-between gap-4 text-xs font-bold uppercase tracking-[.16em] text-[var(--signal)]"><span>{{ $project->category ?: 'Digital product' }}</span><span>{{ $project->client }}</span></div><h3 class="display-font mt-4 text-2xl font-bold">{{ $project->title }}</h3><p class="mt-3 text-sm leading-6 text-[var(--muted)]">{{ $project->summary }}</p>@if ($project->project_url)<a href="{{ $project->project_url }}" target="_blank" rel="noreferrer" class="mt-5 inline-block text-sm font-bold">Lihat proyek ↗</a>@endif</div></article>
                            @endforeach
                            @foreach ($projects as $project)
                                <article class="project-card group overflow-hidden border border-[var(--line)] bg-white" aria-hidden="true"><div class="aspect-[16/9] overflow-hidden bg-[var(--mint)]">@if ($project->image_path)<img src="{{ asset('storage/'.$project->image_path) }}" alt="" class="h-full w-full {{ ($project->media_type ?? 'image') === 'logo' ? 'object-contain p-12' : 'object-cover' }}">@endif</div><div class="p-6"><div class="flex items-center justify-between gap-4 text-xs font-bold uppercase tracking-[.16em] text-[var(--signal)]"><span>{{ $project->category ?: 'Digital product' }}</span><span>{{ $project->client }}</span></div><h3 class="display-font mt-4 text-2xl font-bold">{{ $project->title }}</h3><p class="mt-3 text-sm leading-6 text-[var(--muted)]">{{ $project->summary }}</p></div></article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if ($testimonials->isNotEmpty())
                <section class="border-y border-[var(--line)] bg-white/60 py-20">
                    <div class="mx-auto max-w-7xl px-6 lg:px-10">
                        <p class="text-xs font-bold uppercase tracking-[.24em] text-[var(--signal)]">Client voices</p>
                    </div>
                    <div class="testimonial-carousel mt-10" aria-label="Testimonial klien">
                        <div class="testimonial-track">
                            @foreach ($testimonials as $testimonial)
                                <figure class="testimonial-card border border-[var(--line)] bg-[var(--paper)] p-7">
                                    <blockquote class="display-font text-2xl font-semibold leading-tight">“{{ $testimonial->quote }}”</blockquote>
                                    <figcaption class="mt-8 text-sm text-[var(--muted)]"><strong class="text-[var(--ink)]">{{ $testimonial->client_name }}</strong>@if ($testimonial->client_role), {{ $testimonial->client_role }}@endif @if ($testimonial->company) · {{ $testimonial->company }}@endif</figcaption>
                                </figure>
                            @endforeach
                            @foreach ($testimonials as $testimonial)
                                <figure class="testimonial-card border border-[var(--line)] bg-[var(--paper)] p-7" aria-hidden="true">
                                    <blockquote class="display-font text-2xl font-semibold leading-tight">“{{ $testimonial->quote }}”</blockquote>
                                    <figcaption class="mt-8 text-sm text-[var(--muted)]"><strong class="text-[var(--ink)]">{{ $testimonial->client_name }}</strong>@if ($testimonial->client_role), {{ $testimonial->client_role }}@endif @if ($testimonial->company) · {{ $testimonial->company }}@endif</figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        </main>

        <footer id="kontak" class="bg-[var(--ink)] text-white"><div class="mx-auto max-w-7xl px-6 py-16 lg:px-10"><div class="grid gap-12 lg:grid-cols-2"><div><p class="text-xs font-bold uppercase tracking-[.24em] text-[var(--signal)]">Let’s build something useful</p><h2 class="display-font mt-4 max-w-lg text-4xl font-bold leading-tight sm:text-5xl">Punya ide yang ingin diwujudkan?</h2><div class="mt-8 flex flex-col gap-3 text-white/70"><a href="mailto:{{ $company->email }}" class="transition hover:text-white">{{ $company->email ?: 'Email belum diatur' }} <span aria-hidden="true">↗</span></a><span>{{ $company->phone ?: 'Telepon belum diatur' }}</span><span>{{ $company->address ?: 'Alamat belum diatur' }}</span></div></div><form action="{{ route('contact.store') }}" method="POST" class="grid gap-4 sm:grid-cols-2">@csrf @if (session('contact_sent'))<p class="sm:col-span-2 border border-emerald-300/40 bg-emerald-300/10 p-4 text-sm text-emerald-100">{{ session('contact_sent') }}</p>@endif @foreach (['name' => 'Nama lengkap', 'email' => 'Email', 'phone' => 'Nomor telepon'] as $field => $label)<label class="text-sm text-white/70 {{ $field === 'phone' ? 'sm:col-span-2' : '' }}">{{ $label }}<input type="{{ $field === 'email' ? 'email' : 'text' }}" name="{{ $field }}" value="{{ old($field) }}" {{ $field !== 'phone' ? 'required' : '' }} class="mt-2 w-full border border-white/20 bg-white/10 px-4 py-3 text-white outline-none placeholder:text-white/40 focus:border-[var(--signal)]"></label>@endforeach<label class="sm:col-span-2 text-sm text-white/70">Pesan<textarea name="message" rows="4" required class="mt-2 w-full border border-white/20 bg-white/10 px-4 py-3 text-white outline-none placeholder:text-white/40 focus:border-[var(--signal)]">{{ old('message') }}</textarea></label><button type="submit" class="w-fit bg-[var(--signal)] px-6 py-3 text-sm font-bold text-white transition hover:bg-white hover:text-[var(--ink)]">Kirim pesan ↗</button></form></div><div class="mt-16 border-t border-white/15 pt-6 text-sm text-white/45">© {{ date('Y') }} {{ $company->company_name }}. All rights reserved.</div></div></footer>
    </body>
</html>
