<div class="text-center w-[600px] mb-8">
    <a href="home" class="inline-flex items-center text-sm uppercase tracking-wider text-stone-500 hover:text-black font-bold transition-colors">
        ← Zurück zu Guessle
    </a>
</div>

<div class="w-[600px] min-h-[620px] bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] overflow-hidden text-left flex flex-col">
    
    <div class="flex flex-row select-none shrink-0 text-lg">
        <a href="login" class="w-1/2 py-4 text-center font-black uppercase bg-stone-100 text-stone-400 border-b-4 border-r-4 border-black hover:text-black transition-colors">
            Login
        </a>
        <div class="w-1/2 py-4 text-center font-black uppercase bg-white border-b-4 border-black">
            Register
        </div>
    </div>

    <form action="register-process.php" method="POST" class="p-10 space-y-6 flex-1 flex flex-col justify-between">
        <div class="space-y-5">
            <div>
                <label for="reg-username" class="block text-sm uppercase font-black tracking-wider mb-2">Benutzername</label>
                <input type="text" id="reg-username" name="username" required 
                    class="w-full p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold"
                    placeholder="Max von Schilksee">
            </div>

            <div>
                <label for="reg-email" class="block text-sm uppercase font-black tracking-wider mb-2">E-Mail Adresse</label>
                <input type="email" id="reg-email" name="email" required 
                    class="w-full p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold"
                    placeholder="deine@mail.de">
            </div>

            <div>
                <label for="reg-password" class="block text-sm uppercase font-black tracking-wider mb-2">Passwort</label>
                <input type="password" id="reg-password" name="password" required 
                    class="w-full p-4 bg-white border-4 border-black text-black font-mono text-base focus:outline-none focus:bg-stone-50 placeholder-stone-400 font-bold"
                    placeholder="Mindestens 8 Zeichen">
            </div>

            <div class="text-xs text-stone-500 uppercase tracking-wider leading-relaxed pt-2 font-bold">
                Mit der Registrierung akzeptierst du, dass wir Cookies für deinen Score lokal speichern. Nach der Anmeldung senden wir dir eine Bestätigungsmail.
            </div>
        </div>

        <button type="submit" class="w-full py-5 bg-black text-white hover:bg-stone-800 font-black text-base tracking-wide uppercase transition-colors text-center cursor-pointer mt-8">
            Account Erstellen →
        </button>
    </form>
</div>