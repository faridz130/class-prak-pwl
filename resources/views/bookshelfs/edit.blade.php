<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Bookshelf') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflowhidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray100">
                    <!-- CONTENT HERE -->
                    <form method="post" action="{{ route('bookshelf.update', $bookshelf->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="max-w-xl">
                            <x-input-label for="code" value="Code Buku" />
                            <x-text-input id="code" type="text" name="code" class="mt-1 block w-full"
                                value="{{ old('code', $bookshelf->code)}}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('code')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="name" value="Nama Buku" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full"
                                value="{{ old('name', $bookshelf->name)}}" required />
                            <x-input-error class=" mt-2" :messages="$errors->get('name')" />
                        </div>

                        <x-secondary-button tag="a" href="{{route('bookshelf.index')}}">Cancel</x-secondary-button>
                        <x-primary-button value="true">Update</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
