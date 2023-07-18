<x-guest-layout >
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name:')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- licencenumber -->
    <div>
        <x-input-label for="licencenumber" :value="__('Licence Number:')" />
        <x-text-input id="licencenumber" class="block mt-1 w-full" type="text" name="licencenumber" :value="old('licencenumber')" required autofocus autocomplete="licencenumber" />
        <x-input-error :messages="$errors->get('licencenumber')" class="mt-2" />
    </div>

    <!-- idnumber -->
    <div>
        <x-input-label for="idnumber" :value="__('National ID/ Alien Card Number:')" />
        <x-text-input id="idnumber" class="block mt-1 w-full" type="text" name="idnumber" :value="old('idnumber')" required autofocus autocomplete="idnumber" />
        <x-input-error :messages="$errors->get('idnumber')" class="mt-2" />
    </div>
<!-- phonenumber -->
<div>
<x-input-label for="phonenumber" :value="__('Phone Number:')" />
<div class="flex items-center">
    <span class=" dark:text-gray-300'">+254</span>
    <x-text-input id="phonenumber" class="block mt-1 ml-2 w-full" type="text" name="phonenumber" :value="old('phonenumber')" required autofocus autocomplete="phonenumber" placeholder="734411195"/>
</div>
<x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />
</div>

    <!-- dob -->
    <div>
        <x-input-label for="dob" :value="__('Date Of Birth:')" />
        <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required autofocus autocomplete="dob" />
        <x-input-error :messages="$errors->get('dob')" class="mt-2" />
    </div>

    <!-- bloodgroup -->
<!-- bloodgroup -->
<div>
<x-input-label for="bloodgroup" :value="__('Blood Group:')" />
<select id="bloodgroup" name="bloodgroup" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
    <option value="">Select Blood Group</option>
    <option value="A+">A-positive (A+)</option>
    <option value="A-">A-negative (A-)</option>
    <option value="B+">B-positive (B+)</option>
    <option value="B-">B-negative (B-)</option>
    <option value="AB+">AB-positive (AB+)</option>
    <option value="AB-">AB-negative (AB-)</option>
    <option value="O+">O-positive (O+)</option>
    <option value="O-">O-negative (O-)</option>
</select>
<x-input-error :messages="$errors->get('bloodgroup')" class="mt-2" />
</div>



    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email:')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password:')" />
        <div class="relative">
            <x-text-input id="password" class="block mt-1 w-full pr-10"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 cursor-pointer"
                id="password-toggle">
                <i class="fas fa-eye-slash text-gray-500" id="eye-icon"></i>
            </div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- password_confirmation -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password:')" />
        <div class="relative">
            <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="current-password_confirmation" />
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 cursor-pointer"
                id="password-toggle-confirm">
                <i class="fas fa-eye-slash text-gray-500" id="eye-icon-confirm"></i>
            </div>
        </div>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>
    

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-primary-button class="ml-4">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
    const passwordToggle = document.getElementById('password-toggle');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    const passwordToggleConfirm = document.getElementById('password-toggle-confirm');
    const passwordInputConfirm = document.getElementById('password_confirmation');
    const eyeIconConfirm = document.getElementById('eye-icon-confirm');

    passwordToggle.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle eye icon
        if (type === 'password') {
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }

        // Synchronize password confirmation field
        passwordInputConfirm.setAttribute('type', type);
        if (type === 'password') {
            eyeIconConfirm.classList.remove('fa-eye');
            eyeIconConfirm.classList.add('fa-eye-slash');
        } else {
            eyeIconConfirm.classList.remove('fa-eye-slash');
            eyeIconConfirm.classList.add('fa-eye');
        }
    });

    // Synchronize password confirmation field on load
    const initialType = passwordInput.getAttribute('type');
    passwordInputConfirm.setAttribute('type', initialType);
    if (initialType === 'password') {
        eyeIconConfirm.classList.remove('fa-eye');
        eyeIconConfirm.classList.add('fa-eye-slash');
    } else {
        eyeIconConfirm.classList.remove('fa-eye-slash');
        eyeIconConfirm.classList.add('fa-eye');
    }

    // Password validation
    const passwordValidationRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const passwordInputError = document.querySelector('.password-input-error');

    passwordInput.addEventListener('input', function () {
        const password = passwordInput.value;

        if (!passwordValidationRegex.test(password)) {
            passwordInputError.textContent = 'The password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, one symbol, and one number.';
        } else {
            passwordInputError.textContent = '';
        }
    });

    passwordInputConfirm.addEventListener('input', function () {
        const password = passwordInput.value;
        const confirmPassword = passwordInputConfirm.value;

        if (password !== confirmPassword) {
            passwordInputConfirm.setCustomValidity("Passwords do not match.");
        } else {
            passwordInputConfirm.setCustomValidity("");
        }
    });
</script>


</x-guest-layout>

