@php use Illuminate\Contracts\Auth\MustVerifyEmail; @endphp
<section class="profile-admin__section">
    <h2 class="profile-admin__section__title">
        {{ __('Information du profil') }}
    </h2>

    <p class="profile-admin__section__text">
        {{ __("Mettez à jour les informations de votre profil et l'adresse e-mail de votre compte.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="form">
        @csrf
        @method('patch')

        <div class="form__field">
            <x-breeze.input-label for="name" :value="__('Nom')"/>
            <x-breeze.text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name"/>
            <x-breeze.input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div class="form__field">
            <x-breeze.input-label for="email" :value="__('Adresse mail')"/>
            <x-breeze.text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username"/>
            <x-breeze.input-error class="mt-2" :messages="$errors->get('email')"/>

            @if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p>
                        {{ __("Votre adresse mail n'est pas vérifiée.") }}

                        <button form="send-verification" type="submit">
                            {{ __("Cliquer ici pour renvoyer le mail de vérification.") }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p>
                            {{ __("Un nouveau lien de vérification a été envoyé à votre adresse mail.") }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form__footer">
            <button type="submit">{{ __("Sauvegarder") }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >{{ __('Sauvegardé.') }}</p>
            @endif
        </div>
    </form>
</section>
