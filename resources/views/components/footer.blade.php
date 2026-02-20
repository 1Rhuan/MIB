<footer class="bg-black border-t border-zinc-800 mt-20">
    <div class="max-w-6xl mx-auto px-6 py-10 text-center">

        <!-- Links -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-6 text-zinc-400 font-medium">

            {{-- <a href="/login" class="hover:text-white transition-colors duration-300">
                Entrar
            </a> --}}

            <a href="{{ config('services.discord.invite_url') }}" target="_blank"
                class="hover:text-indigo-400 transition-colors duration-300">
                Discord
            </a>

            <a href="{{ config('services.youtube.chanel_url') }}" target="_blank"
                class="hover:text-red-500 transition-colors duration-300">
                YouTube
            </a>

            <a href="{{ config('services.discord.invite_url') }}" target="_blank"
                class="hover:text-green-400 transition-colors duration-300">
                Suporte
            </a>

        </div>

        <!-- Linha separadora -->
        <div class="border-t border-zinc-800 my-8"></div>

        <!-- Direitos -->
        <p class="text-sm text-zinc-500">
            © {{ date('Y') }} MIB - Made In Brazil. Todos os direitos reservados.
        </p>

    </div>
</footer>
