<form action="{{$action}}" enctype="multipart/form-data" method="post">
    @csrf
    @if($update)
        @method('PUT')
    @endif
    <div class="mb-3">
        <label class="form-label" id="firstName">Name</label>
        <input type="text" name="name" class="form-control w-50"
               @isset($name) value="{{$name}}" @endisset value="{{ old('name') }}"
        />
        @error('name')
        <div class="alert alert-danger w-50 form-text">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" id="contact">Contact</label>
        <input type="text" name="contact" class="form-control w-50" maxlength="9"
               @isset($contact) value="{{$contact}}" @endisset value="{{ old('contact') }}"
               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
        />
        @error('contact')
        <div class="alert alert-danger w-50 form-text">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" id="email">Email</label>
        <input type="text" name="email" class="form-control w-50"
               @isset($email) value="{{$email}}" @endisset value="{{ old('email') }}"
        />
        @error('email')
        <div class="form-text alert alert-danger w-50">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <button class="btn btn-primary">
            <i class="bi bi-save-fill"></i>Save
        </button>
    </div>
</form>

