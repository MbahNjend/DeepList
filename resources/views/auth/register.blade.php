<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>DeepList - Register</title>
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
            <p class="text-gray-500 mt-2">Create your account to get started</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                    <i class="ph-user-plus"></i>
                    Create New Account
                </h2>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all"
                                placeholder="John Doe">
                            <i class="ph-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all"
                                placeholder="your@email.com">
                            <i class="ph-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all"
                                placeholder="••••••••">
                            <i class="ph-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all"
                                placeholder="••••••••">
                            <i class="ph-lock-key absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:opacity-90 transition-all duration-200 flex items-center justify-center gap-2 mt-6">
                        <i class="ph-user-plus"></i>
                        Register
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
