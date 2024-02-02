@extends('layouts.main')

@section('title', 'Contacts - Create')

@section('content')
    <div class="row mb-2">
        <a href="{{ route('contacts.index') }}">
            <button class="btn btn-info"><i class="bi bi-arrow-return-left"></i>Back</button>
        </a>
    </div>
    <div class="row">
        <div class="ms-auto">
            <h3>Create Contact</h3>
        </div>
    </div>
    <x-contact-form :action="route('contacts.store')" :update="false"></x-contact-form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            VanillaMasker.maskInput(document.querySelector("#contact"), "(99) 9999-9999");
        });
    </script>
@endsection
