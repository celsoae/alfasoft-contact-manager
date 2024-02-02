@extends('layouts.main')

@section('title', 'Contacts - Details')

@section('content')
    <div class="row mb-2">
        <a href="{{ route('contacts.index') }}">
            <button class="btn btn-info"><i class="bi bi-arrow-return-left"></i>Back</button>
        </a>
    </div>
    <div class="row">
        <div class="ms-auto">
            <h2>Contact Details</h2>
        </div>
    </div>
    <div class="row d-flex">
        <label class="form-label">Name</label>
        <h3>{{$contact->getAttribute('name')}}</h3>
        <label class="form-label">Contact</label>
        <h3>{{$contact->getAttribute('contact')}}</h3>
        <label class="form-label">Email</label>
        <h3>{{$contact->getAttribute('email')}}</h3>
    </div>
@endsection
