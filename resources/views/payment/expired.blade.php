<x-layout>
    <div class="relative min-h-screen bg-zinc-950 flex items-center justify-center px-4 py-6">

        <!-- IMAGEM DE FUNDO -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/bg.png') }}" alt="Fundo" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/80"></div>
        </div>

        <div class="relative w-full max-w-4xl">

            <div
                class="bg-zinc-900/60 backdrop-blur-xl border border-red-500/20
                        rounded-2xl p-8 shadow-2xl text-center">

                <!-- Ícone -->
                <div class="flex justify-center mb-6">
                    <div
                        class="w-20 h-20 rounded-full bg-red-500/10
                                flex items-center justify-center
                                border border-red-500/30">
                        <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" stroke-width="3"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>

                <!-- Título -->
                <h1 class="text-2xl md:text-3xl font-bold text-red-400 mb-2">
                    Pagamento Expirado
                </h1>

                <p class="text-zinc-400 mb-6">
                    O prazo para pagamento via Pix foi encerrado.
                </p>

                <!-- Aviso -->
                <div
                    class="bg-zinc-800/60 border border-zinc-700
                            rounded-xl p-6 text-left max-w-2xl mx-auto">

                    <div class="space-y-3 text-sm text-zinc-400">

                        <div class="flex justify-between">
                            <span>Pedido</span>
                            <span class="text-white font-mono">
                                #{{ $order['reference'] }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>Produto</span>
                            <span class="text-white">
                                {{ $product['title'] }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>Status</span>
                            <span class="text-red-400 font-semibold">
                                Expirado
                            </span>
                        </div>

                    </div>

                    <div class="mt-6 text-sm text-zinc-500">
                        💡 Nenhum valor foi cobrado.
                        Você pode gerar um novo pagamento abaixo.
                    </div>

                </div>

                <!-- Botões -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">

                    <a href="{{ route('checkout.show', $product['slug']) }}"
                        class="bg-amber-500 hover:bg-amber-400
                               text-black px-6 py-3
                               rounded-lg font-semibold transition">
                        Gerar Novo Pagamento
                    </a>

                    <a href="{{ route('home') }}"
                        class="bg-zinc-800 hover:bg-zinc-700
                               border border-zinc-600
                               px-6 py-3 rounded-lg font-semibold transition">
                        Voltar para Home
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-layout>
