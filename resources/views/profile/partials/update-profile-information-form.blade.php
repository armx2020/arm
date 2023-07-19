<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Редактирования профиля') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')



        <div class="flex flex-row">
            <div class="flex">
                @if( $user->image == null)
                <img class="h-20 w-20 rounded-full m-4 object-cover" src="{{ url('/image/user.png')}}" alt="{{ $user->firstname }} avatar">
                @else
                <img class="preview h-20 w-20 rounded-full m-4 object-cover" src="{{ asset('storage/'. $user->image) }}" alt="{{ $user->firstname }} avatar">
                @endif
            </div>

            <div class="flex items-center">
                <input name="image" type="file" id="image" class="shadow-sm sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block basis-full p-2.5"/>
            </div>
        </div>

        <div>
            <x-input-label for="firstname" :value="__('Имя')" />
            <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->firstname)" required autofocus autocomplete="firstname" />
            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Фамилия')" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" :value="old('lastname', $user->lastname)" required autofocus autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <div>
            <x-input-label for="viber" :value="__('Вайбер')" />
            <x-text-input id="viber" name="viber" type="text" class="mt-1 block w-full" :value="old('viber', $user->viber)" autofocus autocomplete="viber" />
            <x-input-error class="mt-2" :messages="$errors->get('viber')" />
        </div>

        <div>
            <x-input-label for="telegram" :value="__('Телеграм')" />
            <x-text-input id="telegram" name="telegram" type="text" class="mt-1 block w-full" :value="old('telegram', $user->telegram)" autofocus autocomplete="telegram" />
            <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
        </div>

        <div>
            <x-input-label for="vkontakte" :value="__('Вконтакте')" />
            <x-text-input id="vkontakte" name="vkontakte" type="text" class="mt-1 block w-full" :value="old('vkontakte', $user->vkontakte)" autofocus autocomplete="vkontakte" />
            <x-input-error class="mt-2" :messages="$errors->get('vkontakte')" />
        </div>

        <div>
            <x-input-label for="instagram" :value="__('Инстаграм')" />
            <x-text-input id="instagram" name="instagram" type="text" class="mt-1 block w-full" :value="old('instagram', $user->instagram)" autofocus autocomplete="instagram" />
            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
        </div>

        <div>
            <label for="user_city" class="text-sm font-medium text-gray-900 block mb-2">Город</label>
            <select name="user_city" class="w-full" style="border-color: rgb(209 213 219)" id="user_city">
                <option value='{{ $user->city->id }}'>{{ $user->city->name }}</option>
            </select>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Сохранено!') }}</p>
            @endif
        </div>
    </form>
    <script type='text/javascript'>
        $(document).ready(function() {
            // Initialize select2
            if ($("#user_city").length > 0) {
                $("#user_city").select2({
                    ajax: {
                        url: " {{ route('cities') }}",
                        type: "post",
                        delay: 250,
                        dataType: 'json',
                        data: function(params) {
                            return {
                                query: params.term, // search term
                                "_token": "{{ csrf_token() }}",
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    }
                });
            }
        });
    </script>
</section>