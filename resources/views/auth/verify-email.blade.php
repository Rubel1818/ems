<x-guest-layout>
    <div class="min-h-fit flex flex-col items-center justify-center py-6 px-4">
        <div class="mb-6 text-indigo-600 dark:text-indigo-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 animate-bounce" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4 text-center">
            আপনার ইমেইল ভেরিফাই করুন
        </h2>

        <div class="mb-6 text-sm text-gray-600 dark:text-gray-400 text-center leading-relaxed">
            {{ __('নিবন্ধন করার জন্য আপনাকে ধন্যবাদ! শুরু করার আগে, আমরা আপনার ইমেইল ঠিকানায় একটি ভেরিফিকেশন লিঙ্ক পাঠিয়েছি। দয়া করে আপনার ইনবক্স চেক করুন এবং লিঙ্কটিতে ক্লিক করে অ্যাকাউন্টটি সক্রিয় করুন।') }}
            <br><br>
            <span class="font-semibold text-indigo-500">
                {{ __('যদি আপনি কোনো ইমেইল না পেয়ে থাকেন, তবে নিচের বাটনে ক্লিক করুন, আমরা আপনাকে পুনরায় লিঙ্ক পাঠিয়ে দেব।') }}
            </span>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 rounded-r-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm font-medium text-green-700 dark:text-green-400">
                        {{ __('রেজিস্ট্রেশনের সময় দেওয়া ইমেইলে একটি নতুন ভেরিফিকেশন লিঙ্ক পাঠানো হয়েছে।') }}
                    </p>
                </div>
            </div>
        @endif

        <div class="w-full flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <div>
                    <x-primary-button
                        class="w-full justify-center py-3 px-6 bg-indigo-600 hover:bg-indigo-700 shadow-lg transition-all duration-200 rounded-xl">
                        {{ __('ভেরিফিকেশন ইমেইল পুনরায় পাঠান') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                    class="w-full text-sm text-gray-600 dark:text-gray-400 hover:text-red-500 font-medium underline transition-colors duration-200 focus:outline-none">
                    {{ __('লগ আউট করুন') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
