<x-layout>
    <div class="relative min-h-screen bg-zinc-950 flex items-center justify-center px-4 py-6">

        <!-- IMAGEM DE FUNDO -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/bg.png') }}" alt="Fundo" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/70"></div>
        </div>

        <div class="relative w-full max-w-4xl">

            <div
                class="bg-zinc-900/60 backdrop-blur-xl border border-green-500/20
                        rounded-2xl p-8 shadow-2xl text-center">

                <!-- Ícone -->
                <div class="flex justify-center mb-6">
                    <div
                        class="w-20 h-20 rounded-full bg-green-500/10
                                flex items-center justify-center
                                border border-green-500/30">
                        <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" stroke-width="3"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <!-- Título -->
                <h1 class="text-2xl md:text-3xl font-bold text-green-400 mb-2">
                    Pagamento Confirmado!
                </h1>

                <p class="text-zinc-400 mb-6">
                    Recebemos seu pagamento com sucesso.
                </p>

                <!-- ALERTA DE ATIVAÇÃO MANUAL -->
                <div
                    class="bg-amber-500/10 border border-amber-500/30
                            text-amber-400 rounded-xl p-4 mb-8 text-sm">
                    O VIP é ativado manualmente por nossa equipe.
                    A liberação pode levar alguns minutos.
                </div>

                <!-- Detalhes -->
                <div class="bg-zinc-800/60 border border-zinc-700 rounded-xl p-6 text-left max-w-2xl mx-auto">

                    <h2 class="text-lg font-semibold mb-4 text-white">
                        Detalhes do Pedido
                    </h2>

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
                                {{ $product['name'] }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>Total Pago</span>
                            <span class="text-green-400 font-bold">
                                R$ {{ number_format($order['total_amount'], 2, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>Status</span>
                            <span class="text-amber-400 font-semibold">
                                Aguardando ativação manual
                            </span>
                        </div>

                    </div>
                </div>

                <!-- Próximos passos -->
                <div class="mt-8 space-y-4">

                    <p class="text-sm text-zinc-400">
                        Caso queira agilizar, envie o número do pedido no nosso Discord.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">

                        <a href="{{ route('home') }}"
                            class="bg-zinc-800 hover:bg-zinc-700
                                   border border-zinc-600
                                   px-6 py-3 rounded-lg font-semibold transition">
                            Voltar para Home
                        </a>

                        <a href="{{ config('services.discord.invite_url') }}" target="_blank"
                            class="flex items-center justify-center gap-3 bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 hover:scale-105 shadow-lg">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 127.14 96.36"
                                class="w-5 h-5 fill-white">
                                <path
                                    d="M107.7 8.07A105.15 105.15 0 0081.47 0a72.06 72.06 0 00-3.36 6.83 97.68 97.68 0 00-29.16 0A72.37 72.37 0 0045.6 0 105.89 105.89 0 0019.39 8.07C2.79 32.65-1.71 56.6.54 80.21a105.73 105.73 0 0032.17 16.15 77.7 77.7 0 006.88-11.08 68.42 68.42 0 01-10.83-5.16c.91-.67 1.8-1.36 2.66-2.08 20.73 9.46 43.19 9.46 63.68 0 .87.72 1.76 1.41 2.66 2.08a68.68 68.68 0 01-10.85 5.16 77.44 77.44 0 006.89 11.08A105.25 105.25 0 00126.6 80.2c2.63-27.38-4.49-51.14-18.9-72.13zM42.45 65.69c-6.29 0-11.46-5.72-11.46-12.77 0-7.05 5.05-12.77 11.46-12.77 6.42 0 11.58 5.72 11.46 12.77 0 7.05-5.04 12.77-11.46 12.77zm42.24 0c-6.29 0-11.46-5.72-11.46-12.77 0-7.05 5.05-12.77 11.46-12.77 6.42 0 11.58 5.72 11.46 12.77 0 7.05-5.04 12.77-11.46 12.77z" />
                            </svg>

                            Discord
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-layout>
