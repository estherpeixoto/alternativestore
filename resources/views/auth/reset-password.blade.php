<x-guest-layout>
    <div class="flex flex-col items-center justify-center h-full p-8">
        <div class="md:w-1/3">
            <x-title class="text-xl">Criar nova senha</x-title>

            <x-auth.validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}" />
                <input type="hidden" name="email" :value="old('email', $request->email)" required />

                <div>
                    <x-input id="password" class="block w-full mb-3.5" type="password" name="password" required placeholder="Senha" autofocus />
                    <small class="text-xs text-gray-500">Deve conter no mínimo 8 caracteres.</small>
                </div>

                <div class="mt-4">
                    <x-input id="password_confirmation" class="block w-full mb-3.5" type="password" name="password_confirmation" required placeholder="Confirmar Senha" />
                    <small class="text-xs text-gray-500">Ambas as senhas devem corresponder</small>
                </div>

                <x-button fullWidth="true" class="mt-5">Redefinir senha</x-button>
            </form>
        </div>
    </div>
</x-guest-layout>
