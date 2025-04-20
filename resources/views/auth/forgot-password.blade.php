<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>DeepList - Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/phosphor-icons"></script>
</head>

<body class="bg-[#F8F9FE] font-[Inter] flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
        <div class="flex justify-center">
       <img class="flex " src="https://res.cloudinary.com/dwqblckdb/image/upload/v1745118222/scdomfyr1woiohwyhrrt.png" width="200px" alt="">
       </div>
            <p class="text-gray-500 mt-2">Password recovery</p>
        </div>

        <!-- Forgot Password Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                    <i class="ph-key"></i>
                    Reset Your Password
                </h2>
            </div>

            <div class="p-6">
                <div class="mb-6 text-gray-600 bg-indigo-50 p-4 rounded-xl">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all"
                                placeholder="your@email.com">
                            <i class="ph-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                            <i class="ph-arrow-left"></i> Back to login
                        </a>
                        
                        <button type="submit"
                            class="py-3 px-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:opacity-90 transition-all duration-200 flex items-center gap-2">
                            <i class="ph-paper-plane-right"></i>
                            Send Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
