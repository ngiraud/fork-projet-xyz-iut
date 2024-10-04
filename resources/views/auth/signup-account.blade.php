<x-layout title="Rejoindre XYZ">
    <main class="auth container">
        <a href="/" class="logo">
            <h1>XYZ</h1>
        </a>

        <section class="block">
            <form action="{{ route('register', $code) }}" method="post" class="block-content signup-form space-y-8">
                @csrf

                <div class="title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z"
                              clip-rule="evenodd"/>
                    </svg>

                    <h1>Devenir membre XYZ</h1>
                </div>

                <div>
                    <label for="email">Invité par</label>
                    <div class="host">
                        <x-avatar size="medium" :src="$code->host->avatar" :alt="$code->host->name"/>
                        <div>
                            <h1>{{ $code->host->name }}</h1>
                            <h2>This is fake: {{ trans_choice('tracks.posts', 13) }}</h2>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="name">Nom</label>
                    <input id="name" name="name" type="text" placeholder="name" class="w-full" autocomplete="name" autofocus value="{{ old('name') }}">
                </div>

                <div>
                    <label for="email">Adresse email</label>
                    <input id="email" type="email" placeholder="email" class="w-full" name="email" autocomplete="email" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password" placeholder="•••••••••••••••" class="w-full">
                </div>

                <div>
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="•••••••••••••••" class="w-full">
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="error-message">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <button class="primary w-full">Devenir membre</button>
                </div>
            </form>
        </section>
    </main>
</x-layout>
