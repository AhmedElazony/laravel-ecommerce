@props(['countries', 'locales'])

@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item categories">Edit Profile</li>
@endsection


@section('content')
    <x-alert type="success" />

    <form action="{{ route('dashboard.profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="first_name" label="First Name" :old-value="$user->profile->first_name"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="last_name" label="Last Name" :old-value="$user->profile->last_name"/>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-md-6">
                <x-form.input name="birthday" type="date" label="Birthday" :old-value="$user->profile->birthday"/>
            </div>
            <div class="col-md-6">
                <x-form.input-radio name="gender" label="Gender" :options="['male', 'female']" :old-value="$user->profile->gender"/>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-md-6">
                <x-form.input name="street" type="text" label="Street Address" :old-value="$user->profile->street"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="city" label="City" :old-value="$user->profile->city"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="state" label="State" :old-value="$user->profile->state"/>
            </div>
            <div class="col-md-6">
                <x-form.input name="postal_code" label="Postal Code" :old-value="$user->profile->postal_code"/>
            </div>
        </div>
        <div class="form-row my-2">
            <div class="col-md-6">
                <x-form.select name="country" label="Country" :items="$countries" :old-value="$user->profile->country"/>
            </div>
            <div class="col-md-6">
                <x-form.select name="locale" label="Language" :items="$locales" :old-value="$user->profile->locale"/>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection
