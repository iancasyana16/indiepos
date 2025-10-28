<x-layouts.login>
    <div class="bg-slate-600 flex items-center justify-center min-h-screen m-auto">
        <div class="bg-white rounded-md w-full max-w-sm p-6 mx-auto shadow-lg">
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
                @error('email')
                    <div class="text-red-600 text-sm mb-2 text-center">{{ $message }}</div>
                @enderror
                <x-label :for="'email'">Email</x-label>
                <x-input :type="'text'" :name="'email'" :placeholder="'Email'" required />

                <x-label :for="'password'">Password</x-label>
                <x-input :type="'password'" :name="'password'" :placeholder="'Password'" required />

                <x-button :type="'submit'" :variant="'primary'" :class="'w-full mt-4'">
                    Login
                </x-button>
            </form>
        </div>
    </div>
</x-layouts.login>