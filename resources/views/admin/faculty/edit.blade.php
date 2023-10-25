<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Faculty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('update.profile', ['id' => $faculty->id]) }}">
                    @csrf
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" value="{{ $faculty->name }}" autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" value="{{ $faculty->email }}" autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="newPassword" value="{{ __('New Password') }}" />
                        <x-input id="newPassword" class="block mt-1 w-full p-2" type="password" name="newPassword"/>
                    </div>

                    <div class="mt-4">
                        <x-label for="profile" value="{{ __('Profile') }}" />
                        <x-input id="profile" accept="image/*" class="block mt-1 w-full p-2" type="file" name="profile"/>
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <x-button>
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
