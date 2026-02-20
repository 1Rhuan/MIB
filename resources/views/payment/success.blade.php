<x-layout>
    <div class="relative min-h-screen bg-zinc-950 flex items-center justify-center px-4 py-6">

        <!-- IMAGEM DE FUNDO -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/bg.png') }}" alt="Fundo" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/70"></div>
        </div>

      <div class="relative w-full max-w-2xl">

        <div
          class="bg-zinc-900/70 backdrop-blur-xl border border-zinc-800
               rounded-3xl p-10 shadow-2xl text-center">

          <!-- Ícone -->
          <div class="flex justify-center mb-8">
            <div
              class="w-16 h-16 rounded-full bg-green-500/10
                       flex items-center justify-center
                       border border-green-500/30">
              <svg class="w-8 h-8 text-green-400"
                   fill="none" stroke="currentColor"
                   stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7" />
              </svg>
            </div>
          </div>

          <!-- Título -->
          <h1 class="text-2xl md:text-3xl font-bold text-green-400">
            Pagamento Confirmado!
          </h1>

          <p class="text-zinc-400 mt-3 mb-8 text-sm md:text-base">
            Recebemos seu pagamento com sucesso.
          </p>

          <!-- Aviso -->
          <div
            class="bg-amber-500/10 border border-amber-500/30
                   text-amber-400 rounded-2xl p-4 mb-8 text-sm">
            O VIP é ativado manualmente por nossa equipe.
            A liberação pode levar alguns minutos.
          </div>

          <!-- Detalhes -->
          <div
            class="bg-zinc-800/60 border border-zinc-700
                   rounded-2xl p-6 text-left">

            <h2 class="text-base font-semibold mb-5 text-white">
              Detalhes do Pedido
            </h2>

            <div class="space-y-4 text-sm">

              <div class="flex justify-between items-center">
                <span class="text-zinc-500">Pedido</span>
                <span class="text-white font-mono">
                        #{{ $order['reference'] }}
                    </span>
              </div>

              <div class="flex justify-between items-center">
                <span class="text-zinc-500">Produto</span>
                <span class="text-white text-right max-w-[60%] truncate">
                        {{ $product['name'] }}
                    </span>
              </div>

              <div class="flex justify-between items-center">
                <span class="text-zinc-500">Total Pago</span>
                <span class="text-green-400 font-bold text-base">
                        R$ {{ number_format($order['total_amount'], 2, ',', '.') }}
                    </span>
              </div>

              <div class="flex justify-between items-center">
                <span class="text-zinc-500">Status</span>
                <span class="text-amber-400 font-semibold">
                        Aguardando ativação
                    </span>
              </div>

            </div>
          </div>

          <!-- Próximos passos -->
          <div class="mt-10 space-y-5">

            <p class="text-sm text-zinc-400">
              Caso queira agilizar, envie o número do pedido no nosso Discord.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">

              <!-- Botão Home -->
              <a href="{{ route('home') }}"
                 class="group w-full sm:w-auto
                          bg-zinc-800/80 hover:bg-zinc-700
                          border border-zinc-700 hover:border-zinc-500
                          text-zinc-300 hover:text-white
                          px-6 py-3 rounded-xl font-semibold
                          transition-all duration-300
                          flex items-center justify-center gap-2">

                <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1"
                     fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7" />
                </svg>

                Voltar para Home
              </a>

              <!-- Botão Discord -->
              <a href="{{ config('services.discord.invite_url') }}"
                 target="_blank"
                 class="group w-full sm:w-auto
                          flex items-center justify-center gap-3
                          bg-indigo-600 hover:bg-indigo-500
                          px-8 py-3 rounded-xl
                          font-semibold text-white
                          transition-all duration-300
                          shadow-lg shadow-indigo-600/20
                          hover:scale-[1.03]">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 127.14 96.36" class="w-5 h-5 fill-white">
                  <path
                    d="M107.7 8.07A105.15 105.15 0 0081.47 0a72.06 72.06 0 00-3.36 6.83 97.68 97.68 0 00-29.16 0A72.37 72.37 0 0045.6 0 105.89 105.89 0 0019.39 8.07C2.79 32.65-1.71 56.6.54 80.21a105.73 105.73 0 0032.17 16.15 77.7 77.7 0 006.88-11.08 68.42 68.42 0 01-10.83-5.16c.91-.67 1.8-1.36 2.66-2.08 20.73 9.46 43.19 9.46 63.68 0 .87.72 1.76 1.41 2.66 2.08a68.68 68.68 0 01-10.85 5.16 77.44 77.44 0 006.89 11.08A105.25 105.25 0 00126.6 80.2c2.63-27.38-4.49-51.14-18.9-72.13zM42.45 65.69c-6.29 0-11.46-5.72-11.46-12.77 0-7.05 5.05-12.77 11.46-12.77 6.42 0 11.58 5.72 11.46 12.77 0 7.05-5.04 12.77-11.46 12.77zm42.24 0c-6.29 0-11.46-5.72-11.46-12.77 0-7.05 5.05-12.77 11.46-12.77 6.42 0 11.58 5.72 11.46 12.77 0 7.05-5.04 12.77-11.46 12.77z" />
                </svg>

                Entrar no Discord
              </a>

            </div>
          </div>

        </div>
      </div>

    </div>
</x-layout>
