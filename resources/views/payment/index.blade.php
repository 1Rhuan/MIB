<x-layout>
    <div class="relative min-h-screen bg-zinc-950 flex items-center justify-center px-4 py-6">

        <!-- IMAGEM DE FUNDO COM BLUR -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/bg.png') }}" alt="Fundo" class="w-full h-full object-cover">
        </div>

        <div class="relative w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

            <!-- COLUNA ESQUERDA — QR CODE -->
            <div
                class="bg-zinc-900/50 backdrop-blur-lg border border-zinc-700/50 rounded-2xl p-6 md:p-8 shadow-2xl text-center">

                <h1 class="text-xl md:text-2xl font-bold mb-2">
                    Pagamento via Pix
                </h1>

                <p class="text-sm md:text-base text-zinc-400 mb-2">
                    Escaneie o QR Code abaixo para concluir o pagamento
                </p>

                <p class="text-xs md:text-sm mb-4">
                    <span
                        class="inline-flex items-center gap-1
                    bg-amber-500/10 text-amber-400
                    px-3 py-1 rounded-full font-semibold">
                        Expira em <span id="pix-timer">--:--</span>
                    </span>
                </p>

                <div class="bg-white p-3 md:p-4 rounded-xl inline-block">
                    <img src="data:image/png;base64,{{ $payment['qr_code_image'] }}" alt="QR Code Pix"
                        class="w-48 h-48 md:w-64 md:h-64 mx-auto">
                </div>

                <div class="mt-6">
                    <div class="relative bg-zinc-800/80 border border-zinc-700
                       rounded-lg px-3 py-2
                       font-mono text-sm text-zinc-200
                       overflow-hidden whitespace-nowrap text-ellipsis select-all"
                        id="pix-code">
                        {{ $payment['qr_code'] }}

                        <div
                            class="pointer-events-none absolute top-0 right-0 h-full w-10
                            bg-gradient-to-l from-zinc-800/80 to-transparent">
                        </div>
                    </div>

                    <button onclick="copyPix()"
                        class="mt-3 w-full bg-amber-500 hover:bg-amber-400
                       text-black py-3 rounded-lg
                       flex items-center justify-center gap-2
                       font-semibold transition">
                        Copiar código Pix
                    </button>

                    <p id="copy-feedback" class="mt-2 text-sm text-green-400 text-center hidden">
                        Código Pix copiado!
                    </p>
                </div>
            </div>

            <!-- COLUNA DIREITA — RESUMO DO PEDIDO -->
            <div
                class="bg-zinc-900/50 backdrop-blur-lg border border-zinc-700/50 rounded-2xl p-6 md:p-8 shadow-2xl flex flex-col justify-between">

                <div>
                    <h2 class="text-base md:text-lg font-semibold mb-4">
                        Resumo do Pedido
                    </h2>

                    <div class="text-sm text-zinc-400 space-y-2">
                        <div class="flex justify-between gap-4">
                            <span>Produto</span>
                            <span class="text-right">{{ $product['name'] }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span>Preço</span>
                        <span>
                            R$ {{ number_format($product['price'], 2, ',', '.') }}
                        </span>
                    </div>

                    @if ($product['discount'] > 0)
                        <div class="flex justify-between gap-4 text-green-400">
                            <span>Desconto</span>
                            <span>
                                - R$ {{ number_format($product['discount'], 2, ',', '.') }}
                            </span>
                        </div>
                    @endif

                    <div class="border-t border-zinc-700 my-4"></div>

                    <div class="flex justify-between text-lg md:text-xl font-bold">
                        <span>Total</span>
                        <span class="text-amber-400">
                            R$ {{ number_format($order['total_amount'], 2, ',', '.') }}
                        </span>
                    </div>
                </div>

                <p class="text-xs text-zinc-500 text-center mt-6">
                    Após o pagamento, a confirmação é automática.
                </p>
            </div>
        </div>
    </div>

    <script>
        const paymentReference = "{{ $order['reference'] }}";
        let remaining = Math.max(0, Math.floor({{ (int) $payment['expiresIn'] }}));
        const timerElement = document.getElementById('pix-timer');

        function copyPix() {
            const text = document.getElementById('pix-code').innerText;
            navigator.clipboard.writeText(text).catch(() => {});
            const feedback = document.getElementById('copy-feedback');
            feedback.classList.remove('hidden');
            setTimeout(() => feedback.classList.add('hidden'), 2500);
        }

        function renderRemaining(sec) {
            const minutes = Math.floor(sec / 60);
            const seconds = Math.floor(sec % 60);
            timerElement.textContent =
                String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
        }

        function updateTimer() {
            if (remaining <= 0) {
                timerElement.textContent = 'Expirado';
                timerElement.classList.remove('text-amber-400');
                timerElement.classList.add('text-red-500');
                clearInterval(timerInterval);
                return;
            }
            renderRemaining(remaining);
            remaining -= 1;
        }

        const interval = 5000;

        const statusInterval = setInterval(async () => {
            try {
                const res = await fetch(`/api/v1/order/${paymentReference}/status/`);
                const data = await res.json();

                if (data.status !== 'pending') {
                    clearInterval(statusInterval);
                    window.location.reload();
                }
            } catch (err) {
                console.error(err);
            }
        }, interval);

        updateTimer();
        const timerInterval = setInterval(updateTimer, 1000);
    </script>
</x-layout>
