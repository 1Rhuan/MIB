<x-layout>
  <div class="relative min-h-screen bg-zinc-950 flex items-center justify-center px-4 py-10">

    <!-- IMAGEM DE FUNDO -->
    <div class="absolute inset-0">
      <img src="{{ asset('images/bg.png') }}" alt="Fundo"
           class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/85 to-black/95"></div>
    </div>

    <div class="relative w-full max-w-2xl">

      <div
        class="bg-zinc-900/70 backdrop-blur-xl border border-zinc-800
                       rounded-3xl p-10 shadow-2xl text-center">

        <!-- Ícone -->
        <div class="flex justify-center mb-8">
          <div
            class="w-16 h-16 rounded-full bg-red-500/10
                               flex items-center justify-center
                               border border-red-500/30">
            <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor"
                 stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div>
        </div>

        <!-- Título -->
        <h1 class="text-2xl md:text-3xl font-bold text-red-400">
          Pagamento Expirado
        </h1>

        <p class="text-zinc-400 mt-3 mb-8 text-sm md:text-base">
          O prazo para pagamento via Pix foi encerrado.
        </p>

        <!-- Card Interno -->
        <div
          class="bg-zinc-800/60 border border-zinc-700
                           rounded-2xl p-6 text-left">

          <div class="space-y-4 text-sm">

            <div class="flex justify-between items-center">
              <span class="text-zinc-500">Pedido</span>
              <span class="text-white font-mono text-sm">
                                #{{ $order['reference'] }}
                            </span>
            </div>

            <div class="flex justify-between items-center">
              <span class="text-zinc-500">Produto</span>
              <span class="text-white text-right max-w-[60%] truncate">
                                {{ $product['title'] }}
                            </span>
            </div>

            <div class="flex justify-between items-center">
              <span class="text-zinc-500">Status</span>
              <span class="text-red-400 font-semibold">
                                Expirado
                            </span>
            </div>

          </div>

          <div class="mt-6 text-xs text-zinc-500 border-t border-zinc-700 pt-4">
            Nenhum valor foi cobrado.
            Você pode gerar um novo pagamento abaixo.
          </div>
        </div>

        <!-- Botões -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center items-center">

          <a href="{{ route('home') }}"
             class="group w-full sm:w-auto
          bg-zinc-800/80 hover:bg-zinc-700
          border border-zinc-700 hover:border-zinc-500
          text-zinc-300 hover:text-white
          px-6 py-3 rounded-xl font-semibold
          transition-all duration-300
          flex items-center justify-center gap-2">

            <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19l-7-7 7-7" />
            </svg>

            Voltar para Home
          </a>


          <a href="{{ route('checkout.show', $product['slug']) }}"
             class="w-full sm:w-auto bg-amber-500 hover:bg-amber-400
                               text-white px-6 py-3
                               rounded-xl font-semibold transition
                               shadow-lg shadow-amber-500/20">
            Gerar Novo Pagamento
          </a>

        </div>

      </div>
    </div>
  </div>
</x-layout>
