<div 
    class="flex flex-col bg-gray-800 h-screen"
    x-data="{
        showSubscribe: @entangle('showSubscribe'),
        showSuccess: @entangle('showSuccess'),
    }">
    <nav class="pt-5 flex justify-between container mx-auto text-indigo-200">
        <a href="/" class="text-4xl font-bold">
            <x-application-logo class="w-16 h-16 fill-current"></x-application-logo>
        </a>
        <div class="flex justify-end">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>
    <div class="flex container mx-auto items-center h-full">
        <div class="flex w-1/3 flex-col items-start">
            <h1 class="font-bold text-white text-5xl leading-tight mb-4">
            Landing page to subscribe
            </h1>
            <p class="text-indigo-200 textxl mb-10">
                We are using <span class="font-bold underline">TALL stack.</span> Would you mind subscribing?
            </p>
            <x-button 
            class="py-3 px-8 bg-red-500 hover:bg-red-600"
            x-on:click="showSubscribe = true">
                Subscribe
            </x-button>
        </div>
    </div>
        
    <x-modal class="bg-indigo-400" trigger="showSubscribe">
        <p class="text-white font-extrabold text-5xl text-center">
                Register you email.
            </p>
            <form 
            class="flex flex-col items-center p-24"
            wire:submit.prevent="subscribe">
                <x-input 
                    class="px-5 py-3 w-80 border border-blue-400" 
                    type="email" 
                    name="email" 
                    placeholder="Email address"
                    wire:model.defer="email"
                >
                </x-input>
                <span class="text-gray-100 text-xs">
                    {{
                        $errors->has('email')
                        ? $errors->first('email')
                        : 'We will send you a confirmation email.'
                    }}
                    
                </span>
                <x-button class="px-5 py-3 mt-5 w-80 bg-gray-800 justify-center">
                    <span class="animate-spin" wire:loading wire:target="subscribe">
                        &#9696;
                    </span>
                    <span wire:loading.remove wire:target="subscribe">
                        Get In
                    </span>
                </x-button>
            </form>
    </x-modal>

    <x-modal class="bg-green-500" trigger="showSuccess">
        <p class=" animate-pulse text-white font-extrabold text-9xl text-center">
                &check;
            </p>
            <p class="text-white font-extrabold text-5xl text-center mt-16">
                Great!
            </p>
            @if (request()->has('verified') && request()->verified == 1)
                <p class="text-white text-3xl text-center">
                    Email confirmed, good job.
                </p>
            @else
                <p class="text-white text-3xl text-center">
                    See you in your inbox.
                </p>
            @endif
    </x-modal>
</div>