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

        <x-form.field
            label="{{ __('Nom') }}"
            name="name"
            type="text"
            placeholder="{{ $user->name }}"
            value="{{ old('name', $user->name) }}"
            autocomplete="name"
            required
            :messages="$errors->get('name')"
            autofocus
        />

        <x-form.field
            label="{{ __('Adresse mail') }}"
            name="email"
            type="email"
            placeholder="{{ $user->email }}"
            value="{{ old('email', $user->email) }}"
            autocomplete="username"
            required
            :messages="$errors->get('email')"
        />

        @if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p>
                    {{ __("Votre adresse mail n'est pas vérifiée.") }}

                    <button form="send-verification" type="submit" class="button--white">
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

        <div class="form__footer">
            <button type="submit">{{ __("Sauvegarder") }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ display: true }"
                    x-show="display"
                    x-transition
                    x-init="setTimeout(() => display = false, 2000)"
                >{{ __('Sauvegardé.') }}</p>
            @endif
        </div>
    </form>
</section>
