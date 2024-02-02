@extends('layouts.main')

@section('title', 'Contacts')

@section('content')
    <div class="row">
        <div class="col-10">
            <form class="form-control w-25 py-2" action="{{ route('contacts.index') }}" method="GET">
                <input class="form-control my-2" type="text" name="search"
                       placeholder="Search by name" value="{{ old('search') }}">
                <div class="text-end">
                    <button class="btn btn-info btn-sm text-end" type="submit">
                        {{$search == '' ? 'Search' : 'Search / Clear'}}
                    </button>
                </div>
            </form>
        </div>
        @can('edit', \Illuminate\Support\Facades\Auth::user())
            <div class="col-2 d-flex justify-content-end">
                <a href="{{route('contacts.create')}}">
                    <button class="btn btn-success ms-auto mt-5">+ Create</button>
                </a>
            </div>
        @endcan
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <th class="col-3">Name</th>
            <th class="col-3">Contact</th>
            <th class="col-3">Email</th>
            @can('edit', \Illuminate\Support\Facades\Auth::user())
                <th class="col-2 text-end">Actions</th>
            @endcan
            </thead>
            <tbody>
            @foreach($contactsList as $contact)
                <tr>
                    <td>{{$contact->getAttribute('name')}}</td>
                    <td>{{$contact->getAttribute('contact')}}</td>
                    <td>{{$contact->getAttribute('email')}}</td>
                    @can('edit', \Illuminate\Support\Facades\Auth::user())
                        <td class="text-end">
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
                    @endcan
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
