@extends('layouts.main')

@section('title', 'Contacts - Edit')

@section('content')
    <div class="row mb-2">
        <a href="{{ route('contacts.index') }}">
            <button class="btn btn-info"><i class="bi bi-arrow-return-left"></i>Back</button>
        </a>
    </div>
    <div class="row">
        <div class="ms-auto">
            <h3>Edit - {{$contact->getAttribute('name')}}</h3>
        </div>
    </div>
    <x-contact-form :action="route('contacts.update', $contact->id)" :update="true"
                    :name="$contact->getAttribute('name')"
                    :contact="$contact->getAttribute('contact')"
                    :email="$contact->getAttribute('email')"
    />
@endsection
