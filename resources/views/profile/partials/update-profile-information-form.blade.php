<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("To update all any information please visit the e-Ticket offices located at HARAMBEE VIGILANCE HSE, Police Headquaters") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name:')" />
            <x-text-input id="name" name="name" type="text" disabled class="mt-1 block w-full" :value="old('name', $driver->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="idnumber" :value="__('National ID/ Alien Card Number:')" />
            <x-text-input id="idnumber" name="idnumber" type="text" disabled class="mt-1 block w-full" :value="old('idnumber', $driver->idnumber)" required autofocus autocomplete="idnumber" />
            <x-input-error class="mt-2" :messages="$errors->get('idnumber')" />
        </div>
        
        <div>
            <x-input-label for="licencenumber" :value="__('License Number:')" />
            <x-text-input id="licencenumber" name="licencenumber" type="text" disabled class="mt-1 block w-full" :value="old('licencenumber', $driver->licencenumber)" required autocomplete="licencenumber" />
            <x-input-error class="mt-2" :messages="$errors->get('licencenumber')" />
        </div>
        
        <div>
            <x-input-label for="phonenumber" :value="__('Phone Number:')" />
            <x-text-input id="phonenumber" name="phonenumber" type="text" disabled class="mt-1 block w-full" :value="old('phonenumber', $driver->phonenumber)" required autocomplete="phonenumber" />
            <x-input-error class="mt-2" :messages="$errors->get('phonenumber')" />
        </div>
        
        <div>
            <x-input-label for="dob" :value="__('Date of Birth:')" />
            <x-text-input id="dob" name="dob" type="date" disabled class="mt-1 block w-full" :value="old('dob', $driver->dob)" required autocomplete="dob" />
            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
        </div>
        
        <div>
            <x-input-label for="bloodgroup" :value="__('Blood Group:')" />
            <x-text-input id="bloodgroup" name="bloodgroup" type="text" disabled class="mt-1 block w-full" :value="old('bloodgroup', $driver->bloodgroup)" required autocomplete="bloodgroup" />
            <x-input-error class="mt-2" :messages="$errors->get('bloodgroup')" />
        </div>
        

        <div>
            <x-input-label for="email" :value="__('Email:')" />
            <x-text-input id="email" name="email" type="email" disabled class="mt-1 block w-full" :value="old('email', $driver->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>


    </form>
</section>