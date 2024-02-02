@extends('layouts.main')

@section('title', 'Contacts')

@section('content')
    <div class="row">
        <div class="col-10">
            <form action="{{ route('contacts.index') }}" method="GET">
                <input class="form-control w-25 my-2" type="text" name="search"
                       placeholder="Search by name" >
                <button class="btn btn-info btn-sm" type="submit">Search</button>
            </form>
        </div>
        <div class="col-2 d-flex justify-content-end">
            <a href="{{route('contacts.create')}}">
                <button class="btn btn-success ms-auto mt-5">+ Create</button>
            </a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Name</td>
                <td>Contact</td>
                <td>Email</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($contactsList as $contact)
                <tr>
                    <td>{{$contact->getAttribute('name')}}</td>
                    <td>{{$contact->getAttribute('contact')}}</td>
                    <td>{{$contact->getAttribute('email')}}</td>
                    <td class="col-1">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-sm btn-info"
                               href="{{route('contacts.show', $contact->getAttribute('id'))}}">
                                Show
                            </a>
                            <a class="btn btn-sm btn-warning"
                               href="{{route('contacts.edit', $contact->getAttribute('id'))}}">
                                Edit
                            </a>
                            <a class="btn btn-sm btn-danger" id="deleteBtn-{{$contact->id}}">
                                <form action="{{route('contacts.delete', $contact->id)}}"
                                      method="POST" id="deleteForm-{{$contact->id}}">
                                    @csrf
                                    @method('DELETE')
                                    Delete
                                </form>
                            </a>
                        </div>
                    </td>
                </tr>
                <script>
                    document.getElementById('deleteBtn-{{$contact->id}}').addEventListener('click', function () {
                        Swal.fire({
                            title: "Confirm delete of: '{{$contact->name}}'?",
                            icon: 'warning',
                            confirmButtonText: 'Confirm',
                            showCancelButton: true,
                            cancelButtonText: 'Cancel',
                            cancelButtonColor: '#d33'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('deleteForm-{{$contact->id}}').submit();
                            }
                        });
                    });
                </script>
            @endforeach
            </tbody>
        </table>
        {{$contactsList->links()}}
    </div>
@endsection
