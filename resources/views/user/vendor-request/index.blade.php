<x-guest-layout>
    <form method="POST" action="{{ route('user.vendor-request.update', Auth::user()->id) }}" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        <h1>Vendor Request</h1>
   
         <div>
            <x-input-label for="Document" :value="__('Document')" />
            <x-text-input id="document" class="block mt-1 w-full" type="file" name="document" :value="old('document')" required autofocus />
            <x-input-error :messages="$errors->get('document')" class="mt-2" />
        </div>


    




           <div class="mt-4">
            <x-input-label for="contact" :value="__('contact')" />
            <x-text-input id="contact" class="block mt-1 w-full" type="number" name="contact" :value="old('contact')" required autocomplete="contact" />
            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
        </div>




        <div class="flex items-center justify-end mt-4">
          

            <x-primary-button class="ms-4">
                {{ __('Send Request') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
