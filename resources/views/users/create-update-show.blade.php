@php
    $disabled = $user->exists && Route::is('users.show');
@endphp

<x-app-layout :pageTitle="$pageTitle">
    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">

                    <x-app-title class="d-block" :pageTitle="__($pageTitle)"></x-app-title>

                    <x-cards.data :title="$pageTitle">
                        @if ($user->exists)
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            @else
                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf
                        @endif
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-12">
                                <x-forms.label for="name" value="{{ __('modules/user.name') }}" />
                                <x-forms.input type="text" name="name" id="name"
                                    placeholder="{{ __('modules/user.name') }}"
                                    value="{{ old('name', isset($user) ? $user->name : '') }}" :disabled="$disabled" />
                                <x-forms.input.error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <x-forms.label for="email" value="{{ __('modules/user.email') }}" />
                                <x-forms.input type="text" name="email" id="email"
                                    placeholder="{{ __('modules/user.email') }}"
                                    value="{{ old('email', isset($user) ? $user->email : '') }}" :disabled="$disabled" />
                                <x-forms.input.error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <x-forms.label for="status" value="{{ __('modules/user.status.title') }}" />
                                <x-forms.select fieldId="status" :fieldLabel="__('modules/user.status.title')" search="true"
                                    data-live-search="true" data-size="8" fieldName="status" fieldRequired="true"
                                    :disabled="$disabled">
                                    @foreach (\App\Enums\UserStatus::toArray() as $key => $value)
                                        <option value="{{ $value['id'] }}"
                                            @if ($user->exists && $user->status->getLabelText() == $value['name']) selected @endif>
                                            {{ $value['name'] }}</option>
                                    @endforeach
                                </x-forms.select>
                                <x-forms.input.error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                            @if (!$user->exists)
                                <div class="col-lg-6 col-md-6 col-12">
                                    <x-forms.label for="password" value="{{ __('modules/user.password') }}" />
                                    <x-forms.input type="password" name="password" id="password"
                                        placeholder="{{ __('modules/user.password') }}" :disabled="$disabled" />
                                    <x-forms.input.error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <x-forms.label for="password_confirmation"
                                        value="{{ __('modules/user.password_confirmation') }}" />
                                    <x-forms.input type="password" name="password_confirmation"
                                        id="password_confirmation"
                                        placeholder="{{ __('modules/user.password_confirmation') }}"
                                        :disabled="$disabled" />
                                </div>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-12">
                                <x-forms.primary-button class="btn-xs" type="submit" :disabled="$disabled">
                                    <i class="fa fa-save"></i> @lang('app.save')
                                </x-forms.primary-button>
                                <x-forms.link-secondary :link="route('users.index')" class="btn-xs">
                                    <i class="fa fa-arrow-left"></i> @lang('app.back')
                                </x-forms.link-secondary>
                            </div>
                        </div>
                        </form>
                    </x-cards.data>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
