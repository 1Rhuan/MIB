<x-layout>

    <x-header />

    {{-- HERO COM VIDEO BACKGROUND --}}
    <section class="relative h-screen flex items-center justify-center text-center overflow-hidden">
        <video autoplay loop muted playsinline class="absolute w-full h-full object-cover">
            <source src="{{ asset('videos/bg.mp4') }}" type="video/mp4">
        </video>

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

        <div class="relative z-10 max-w-7xl mx-auto w-full px-6 grid md:grid-cols-2 items-center gap-12">

            {{-- LOGO --}}
            <div class="flex justify-center md:justify-start">
                <img src="{{ asset('images/logo.png') }}" alt="Logo MIB" class="w-124 md:w-130 drop-shadow-2xl">
            </div>

            {{-- TEXTO HERO --}}
            <div class="text-center md:text-left">
                <h2 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                    DOMINE O SERVIDOR
                </h2>

                <p class="text-lg md:text-xl text-gray-300 mb-10">
                    Entre para a elite. Tenha prioridade, benefícios exclusivos e destaque absoluto dentro do MIB.
                </p>

                {{-- BOTÕES HERO --}}
                <div class="flex flex-col sm:flex-row flex-wrap gap-6 justify-center md:justify-start mt-10">

                    <a href="#vips"
                        class="flex items-center justify-center gap-2 bg-yellow-500 text-black px-8 py-4 rounded-2xl font-bold shadow-xl hover:scale-105 transition-transform duration-300 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current">
                            <path d="M5 16L3 7l5 4 4-6 4 6 5-4-2 9H5zm0 2h14v2H5v-2z" />
                        </svg>

                        COMPRAR VIP
                    </a>

                    <a href="{{ config('services.discord.invite_url') }}" target="_blank"
                        class="flex items-center justify-center gap-3 bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 hover:scale-105 shadow-lg">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 127.14 96.36" class="w-5 h-5 fill-white">
                            <path
                                d="M107.7 8.07A105.15 105.15 0 0081.47 0a72.06 72.06 0 00-3.36 6.83 97.68 97.68 0 00-29.16 0A72.37 72.37 0 0045.6 0 105.89 105.89 0 0019.39 8.07C2.79 32.65-1.71 56.6.54 80.21a105.73 105.73 0 0032.17 16.15 77.7 77.7 0 006.88-11.08 68.42 68.42 0 01-10.83-5.16c.91-.67 1.8-1.36 2.66-2.08 20.73 9.46 43.19 9.46 63.68 0 .87.72 1.76 1.41 2.66 2.08a68.68 68.68 0 01-10.85 5.16 77.44 77.44 0 006.89 11.08A105.25 105.25 0 00126.6 80.2c2.63-27.38-4.49-51.14-18.9-72.13zM42.45 65.69c-6.29 0-11.46-5.72-11.46-12.77 0-7.05 5.05-12.77 11.46-12.77 6.42 0 11.58 5.72 11.46 12.77 0 7.05-5.04 12.77-11.46 12.77zm42.24 0c-6.29 0-11.46-5.72-11.46-12.77 0-7.05 5.05-12.77 11.46-12.77 6.42 0 11.58 5.72 11.46 12.77 0 7.05-5.04 12.77-11.46 12.77z" />
                        </svg>

                        Discord
                    </a>

                </div>
            </div>
        </div>
    </section>

    {{-- SEÇÃO DE VIPS --}}
    <section id="vips" class="py-32 bg-gradient-to-b from-black via-zinc-950 to-black relative">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,215,0,0.08),transparent_60%)]">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-5xl md:text-6xl font-extrabold mb-6">
                Planos VIP
            </h3>

            <p class="text-gray-400 text-lg mb-20 max-w-2xl mx-auto">
                Escolha o plano ideal e desbloqueie vantagens exclusivas dentro do servidor da MIB.
            </p>

            <div
                class="max-w-6xl mx-auto grid gap-10 items-stretch [grid-template-columns:repeat(auto-fit,minmax(320px,1fr))]">

                @foreach ($products ?? [] as $product)
                    @php
                        $isPopular = str_contains(strtolower($product->title), 'trimestral');
                    @endphp

                    <div
                        class="relative bg-zinc-900/80 backdrop-blur-md p-10 rounded-3xl border border-zinc-800 shadow-2xl transition-all duration-300
                                {{ $isPopular ? 'scale-110 border-yellow-500 shadow-yellow-500/20' : 'hover:scale-105' }}">

                        @if ($isPopular)
                            <div
                                class="absolute -top-4 left-1/2 -translate-x-1/2 bg-yellow-500 text-black px-6 py-1 rounded-full text-sm font-bold shadow-lg">
                                MAIS POPULAR
                            </div>
                        @endif

                        <h4 class="text-3xl font-bold mb-6 mt-4">
                            {{ $product->title }}
                        </h4>

                        @php
                            $finalPrice = $product->price;
                            if ($product->discount > 0) {
                                $finalPrice = $product->price - $product->discount;
                            }
                        @endphp

                        <div class="mb-6">
                            @if ($product->discount > 0)
                                <p class="text-gray-400 line-through text-xl">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </p>


                                <p class="text-5xl font-extrabold text-yellow-500">
                                    R$ {{ number_format($finalPrice, 2, ',', '.') }}
                                </p>


                                <span
                                    class="inline-block mt-2 bg-red-600 text-white text-xs px-3 py-1 rounded-full font-bold">
                                    - R${{ $product->discount }}
                                </span>
                            @else
                                <p class="text-5xl font-extrabold text-yellow-500">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </p>
                            @endif
                        </div>

                        <ul class="space-y-3 text-gray-300 mb-8 text-left">
                            @foreach ($product->benefits ?? [] as $benefit)
                                <li class="flex items-center gap-2">
                                    <span class="text-yellow-500">✔</span>
                                    {{ $benefit }}
                                </li>
                            @endforeach
                        </ul>

                        <p class="text-gray-400 mb-8 min-h-[60px]">
                            {{ $product->description }}
                        </p>

                        <a href="{{ route('checkout.show', $product->slug) }}"
                            class="block w-full bg-yellow-500 text-black py-4 rounded-2xl font-bold text-lg hover:opacity-90 transition">
                            Comprar Agora
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
