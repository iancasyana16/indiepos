<x-layouts.login>
    <div class="bg-slate-600 flex items-center justify-center min-h-screen m-auto">
        <div class="bg-white rounded-md w-lg p-5 mx-auto shadow-lg">
            <form action="">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
                <x-label :for="'email'">Email</x-label>
                <x-input :type="'text'" :name="'email'" :placeholder="'Email'" />
                <x-label :for="'password'">Password</x-label>
                <x-input :type="'password'" :name="'password'" :placeholder="'Password'" />
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline mb-2">Don't have an account? Register</a>
                <x-button :type="'submit'" :variant="'danger'" :class="'w-full'">Login</x-button>
            </form>
        </div>
    </div>
</x-layouts.login>