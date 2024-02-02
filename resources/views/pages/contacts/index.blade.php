@extends('layouts.main')

@section('title', 'Contacts')

@section('content')
    <div class="row">
        <div class="ms-auto">
            <a href="{{route('contacts.create')}}">
                <button class="btn btn-success">Create</button>
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
                            <a href="{{route('contacts.edit', $contact->getAttribute('id'))}}">
                                <button type="button" class="btn btn-sm btn-warning">Edit</button>
                            </a>
                            <a href="{{route('contacts.delete', $contact->getAttribute('id'))}}">
                                <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            </a>
                            <a class="btn btn-sm btn-danger" id="deleteBtn-{{$contact->id}}">
                                <form action="{{route('contacts.delete', $contact)}}"
                                      method="POST" id="deleteForm-{{$contact->id}}">
                                    @csrf
                                    @method('DELETE')
                                    Excluir
                                </form>
                            </a>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        @if($contactsList->count() > 0)
        document.getElementById('deleteBtn-{{$contact->id}}').addEventListener('click', function () {
            Swal.fire({
                title: "Confirm delete of: '{{$contact->name}}'?",
                text: "Esta ação é irreverssível!",
                icon: 'warning',
                confirmButtonText: 'Confirmar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-{{$contact->id}}').submit();
                }
            });
        });
        @endif
    </script>
@endsection
