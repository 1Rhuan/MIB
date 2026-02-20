<x-layout>
  <section class="min-h-screen bg-black text-white py-20 px-6">

    <div class="absolute inset-0 overflow-hidden">
      <img src="/images/bg.png"
           class="w-full h-full object-cover scale-110 opacity-30"
           alt="Background">

      <!-- Gradient overlay -->
      <div class="absolute inset-0 bg-gradient-to-b from-black via-black/80 to-black"></div>

      <!-- Glow effect -->
      <div class="absolute -top-40 left-1/2 -translate-x-1/2
              w-[700px] h-[700px]
              bg-yellow-500/10 blur-[150px] rounded-full">
      </div>
    </div>


    <div class="relative max-w-6xl mx-auto">

      <!-- HEADER -->
      <div class="text-center mb-14">
        <h2 class="text-5xl font-extrabold tracking-tight">
          Finalizar Compra
        </h2>
        <p class="text-zinc-400 mt-3">
          Preencha seus dados corretamente para ativação do VIP.
        </p>
      </div>

      <div class="grid lg:grid-cols-3 gap-12">

        <!-- FORMULÁRIO -->
        <div
          class="lg:col-span-2 bg-zinc-900/80 backdrop-blur-md p-10 rounded-3xl border border-zinc-800 shadow-2xl">

          <form method="POST" action="{{ route('checkout.process') }}" class="space-y-8">

            @csrf

            <input type="hidden" name="product_slug" value="{{ $product->slug }}">

            <!-- Nome + Email -->
            <div class="grid md:grid-cols-2 gap-6">

              <div>
                <label for="name" class="block mb-2 font-semibold text-zinc-300">
                  Nome Completo
                </label>

                <div class="relative">
                  <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-500"
                       fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A9 9 0 1118.364 4.56M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>

                  <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="ex: Michael Jackson"
                    class="pl-10 w-full bg-zinc-800/70 backdrop-blur-sm
                       border @error('name') border-red-500 @else border-zinc-700 @enderror
                       rounded-xl px-4 py-3
                       text-white placeholder-zinc-500
                       focus:outline-none
                       focus:ring-2
                       @error('name') focus:ring-red-500/50 @else focus:ring-yellow-500/70 @enderror
                       focus:border-yellow-500
                       transition-all duration-300"
                    required>
                </div>
                @error('name')
                <p class="mt-2 text-sm text-red-400">
                  {{ $message }}
                </p>
                @enderror
              </div>

              <div>
                <label for="email" class="block mb-2 font-semibold text-zinc-300">
                  Email
                </label>

                <div class="relative">
                  <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-500"
                       fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 12H8m8 0l-4 4m4-4l-4-4"/>
                  </svg>

                  <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="joao.almeida@email.com"
                    class="pl-10 w-full bg-zinc-800/70 backdrop-blur-sm
                        border @error('email') border-red-500 @else border-zinc-700 @enderror
                       rounded-xl px-4 py-3
                       text-white placeholder-zinc-500
                       focus:outline-none
                       focus:ring-2
                        @error('email') focus:ring-red-500/50 @else focus:ring-yellow-500/70 @enderror
                       focus:border-yellow-500
                       transition-all duration-300"
                    required>
                </div>
                @error('email')
                <p class="mt-2 text-sm text-red-400">
                  {{ $message }}
                </p>
                @enderror
              </div>


            </div>

            <!-- Plataforma + Player ID -->
            <div class="grid md:grid-cols-2 gap-6">

              <div>
                <label for="platform" class="block mb-2 font-semibold text-zinc-300">
                  Plataforma
                </label>

                <select
                  id="platform"
                  name="platform"
                  class="w-full bg-zinc-800/70 backdrop-blur-sm
                     border border-zinc-700
                     rounded-xl px-4 py-3
                     text-white
                     focus:outline-none
                     focus:ring-2 focus:ring-yellow-500/70
                     focus:border-yellow-500
                     transition-all duration-300"
                  required>

                  <option value="" disabled {{ old('platform') ? '' : 'selected' }}>Selecione...</option>
                  <option value="steam" {{ old('platform') === 'steam' ? 'selected' : '' }}>Steam</option>
                  <option value="epic_games" {{ old('platform') === 'epic_games' ? 'selected' : '' }}>Epic Games
                  </option>
                  <option value="xbox" {{ old('platform') === 'xbox' ? 'selected' : '' }}>Xbox</option>
                </select>
                @error('game_platform') <p
                  class="text-red-400 text-sm mt-2 list-disc list-inside space-y-1">
                  {{ $message }}</p>
                @enderror
              </div>

              <div>
                <label for="player_id" class="block mb-2 font-semibold text-zinc-300">
                  Player ID
                </label>

                <div class="relative">
                  <!-- Ícone -->
                  <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-zinc-500"
                       fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                  </svg>

                  <input
                    id="player_id"
                    type="text"
                    name="player_id"
                    value="{{ old('player_id') }}"
                    placeholder="Ex: 76561197960287930"
                    class="pl-10 w-full bg-zinc-800/70 backdrop-blur-sm
                       border @error('player_id') border-red-500 @else border-zinc-700 @enderror
                       rounded-xl px-4 py-3
                       text-white placeholder-zinc-500
                       focus:outline-none
                       focus:ring-2
                       @error('player_id') focus:ring-red-500/50 @else focus:ring-yellow-500/70 @enderror
                       focus:border-yellow-500
                       transition-all duration-300"
                    required>
                </div>

                @error('player_id')
                <p class="mt-2 text-sm text-red-400">
                  {{ $message }}
                </p>
                @enderror
              </div>
            </div>

            <!-- TERMOS -->
            <div class="space-y-3">

              <label class="flex items-start gap-3 text-sm text-zinc-400 cursor-pointer">
                <input type="checkbox" name="terms" value="1" required
                       class="mt-1 w-4 h-4 rounded border-zinc-600 bg-zinc-800 text-yellow-500 focus:ring-yellow-500">

                <span>
                    Eu li e concordo com os
                    <button type="button" onclick="openModal('termsModal')"
                            class="text-yellow-500 hover:text-yellow-400 underline">
                        Termos de Uso
                    </button>
                    e com a
                    <button type="button" onclick="openModal('refundModal')"
                            class="text-yellow-500 hover:text-yellow-400 underline">
                        Política de Reembolso
                    </button>.
                </span>
              </label>

              @error('terms')
              <p class="text-red-400 text-sm">{{ $message }}</p>
              @enderror

            </div>

            <!-- BOTÃO -->
            <button type="submit"
                    onclick="this.disabled=true; this.innerHTML='Processando...'; this.form.submit();"
                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-black py-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:scale-[1.02] shadow-lg shadow-yellow-500/20">
              Confirmar Pedido
            </button>


            <p class="text-center text-xs text-zinc-500">
              Após o pagamento, aguarde até o seu VIP ser ativado.
            </p>

          </form>
        </div>

        <!-- RESUMO DO PEDIDO -->
        <div
          class="bg-zinc-900/80 backdrop-blur-md p-8 rounded-3xl border border-zinc-800 shadow-2xl h-fit lg:sticky lg:top-10">

          <h3 class="text-2xl font-bold mb-6 text-center">
            Resumo do Pedido
          </h3>

          @php
            $discount = $product->discount ?? 0;
            $finalPrice = $product->price - $discount;
          @endphp

          <div class="space-y-4 text-gray-300">

            <div class="flex items-center gap-4 p-4 bg-zinc-800/60 rounded-xl border border-zinc-700">
              <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                ⭐
              </div>

              <div>
                <p class="text-sm text-zinc-400">Plano</p>
                <p class="font-semibold text-white">
                  {{ $product->title }}
                </p>
              </div>
            </div>


            @if ($discount > 0)
              <div class="flex justify-between text-gray-500">
                <span>Preço original</span>
                <span>R$ {{ number_format($product->price, 2, ',', '.') }}</span>
              </div>

              <div class="flex justify-between text-green-400">
                <span>Desconto</span>
                <span>- R$ {{ number_format($discount, 2, ',', '.') }}</span>
              </div>
            @endif

            <div
              class="border-t border-zinc-800 pt-4 flex justify-between text-2xl font-bold text-yellow-500">
              <span>Total</span>
              <span>R$ {{ number_format($finalPrice, 2, ',', '.') }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MODAL TERMOS -->
  <div id="termsModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 px-4">

    <div
      class="bg-zinc-900 border border-zinc-800 max-w-3xl w-full rounded-3xl p-8 shadow-2xl max-h-[85vh] overflow-y-auto">

      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Termos de Uso</h2>
        <button onclick="closeModal('termsModal')" class="text-zinc-400 hover:text-white text-xl">✕</button>
      </div>

      <div class="space-y-6 text-zinc-300 text-sm leading-relaxed">

        <div>
          <h3 class="font-semibold text-white mb-2">1. Aceitação</h3>
          <p>
            Ao adquirir qualquer produto neste site, o usuário declara que leu,
            compreendeu e concorda integralmente com estes Termos de Uso.
          </p>
        </div>

        <div>
          <h3 class="font-semibold text-white mb-2">2. Natureza do Serviço</h3>
          <p>
            Os produtos comercializados consistem em acessos VIP digitais para o servidor,
            podendo incluir benefícios como prioridade de entrada, slots exclusivos
            e vantagens internas.
          </p>
        </div>

        <div>
          <h3 class="font-semibold text-white mb-2">3. Responsabilidades do Usuário</h3>
          <ul class="list-disc list-inside space-y-1">
            <li>Fornecer informações corretas no momento da compra;</li>
            <li>Respeitar todas as regras do servidor;</li>
            <li>Não compartilhar ou comercializar o acesso adquirido.</li>
          </ul>
          <p class="mt-2">
            O descumprimento poderá resultar em suspensão ou banimento sem direito a reembolso.
          </p>
        </div>

        <div>
          <h3 class="font-semibold text-white mb-2">4. Disponibilidade</h3>
          <p>
            O servidor pode sofrer manutenções, atualizações ou instabilidades.
            Não garantimos disponibilidade ininterrupta do serviço.
          </p>
        </div>

        <div>
          <h3 class="font-semibold text-white mb-2">5. Alterações</h3>
          <p>
            Os benefícios dos planos poderão ser ajustados para manter o equilíbrio
            e funcionamento adequado do servidor.
          </p>
        </div>

        <p class="text-xs text-zinc-500 pt-4 border-t border-zinc-800">
          Última atualização: {{ now()->format('d/m/Y') }}
        </p>

      </div>
    </div>
  </div>

  <!-- MODAL REEMBOLSO -->
  <div id="refundModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 px-4">

    <div
      class="bg-zinc-900 border border-zinc-800 max-w-3xl w-full rounded-3xl p-8 shadow-2xl max-h-[85vh] overflow-y-auto">

      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Política de Reembolso</h2>
        <button onclick="closeModal('refundModal')" class="text-zinc-400 hover:text-white text-xl">✕</button>
      </div>

      <div class="space-y-6 text-zinc-300 text-sm leading-relaxed">

        <div>
          <h3 class="font-semibold text-white mb-2">1. Produto Digital</h3>
          <p>
            Os produtos vendidos são bens digitais de ativação imediata.
            Após a ativação do benefício VIP, considera-se o serviço como consumido.
          </p>
        </div>

        <div>
          <h3 class="font-semibold text-white mb-2">2. Não Elegíveis a Reembolso</h3>
          <ul class="list-disc list-inside space-y-1">
            <li>Arrependimento após ativação;</li>
            <li>Banimento por violação das regras;</li>
            <li>Erro no preenchimento de dados pelo comprador.</li>
          </ul>
        </div>

        <div>
          <h3 class="font-semibold text-white mb-2">3. Exceções</h3>
          <p>
            Reembolsos poderão ser analisados apenas em caso de falha técnica
            comprovada que impeça a ativação do benefício ou cobrança duplicada.
          </p>
        </div>

        <div>
          <h3 class="font-semibold text-white mb-2">4. Prazo</h3>
          <p>
            Solicitações devem ser realizadas em até 7 dias após a compra
            e serão analisadas em até 5 dias úteis.
          </p>
        </div>

        <p class="text-xs text-zinc-500 pt-4 border-t border-zinc-800">
          Última atualização: {{ now()->format('d/m/Y') }}
        </p>

      </div>
    </div>
  </div>

  <script>
    function openModal(id) {
      const modal = document.getElementById(id);
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.classList.add('overflow-hidden');
    }

    function closeModal(id) {
      const modal = document.getElementById(id);
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      document.body.classList.remove('overflow-hidden');
    }
  </script>

</x-layout>
