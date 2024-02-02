@extends('layouts.main')

@section('title', 'Contacts - Create')

@section('content')
    <div class="row">
        <div class="ms-auto">
            <h3>Create Contact</h3>
        </div>
    </div>
    <x-contact-form :action="route('contacts.store')" :update="false"></x-contact-form>
@endsection
