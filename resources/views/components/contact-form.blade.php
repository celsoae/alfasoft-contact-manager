<div class="mb-3">
    <a href="{{ route('contacts.index') }}">
        <button class="btn btn-info"><i class="bi bi-arrow-return-left"></i> Voltar</button>
    </a>
</div>
<form action="{{$action}}" enctype="multipart/form-data" method="post">
    @csrf
    @if($update)
        @method('POST')
    @endif
    <div class="mb-3">
        <label class="form-label" id="firstName">Name</label>
        <input type="text" name="name" class="form-control w-50"
               @isset($name) value="{{$name}}" @endisset
        />
    </div>
    <div class="mb-3">
        <label class="form-label" id="contact">Contact</label>
        <input type="text" name="contact" class="form-control w-50"
               @isset($contact) value="{{$contact}}" @endisset
        />
    </div>
    <div class="mb-3">
        <label class="form-label" id="email">Email</label>
        <input type="text" name="email" class="form-control w-50"
               @isset($email) value="{{$email}}" @endisset
        />
    </div>
    <div class="mb-3">
        <button class="btn btn-primary">
            <i class="bi bi-save-fill"></i>Salvar
        </button>
    </div>
</form>
