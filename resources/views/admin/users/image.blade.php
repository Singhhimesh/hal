@if($image = @file_get_contents('../public/images/userS/'.$image))
    <img @error('photo') is-invalid @enderror
        src="{{ url('images/userS/'.$image) }}" style="width:7rem;" alt="profilephoto"
        class="img-responsive img-circle" data-toggle="modal"
        data-target="#exampleStandardModal{{ $id }}">
@else
<img @error('photo') is-invalid @enderror
        src="{{ Avatar::create($name)->toBase64() }}" style="width:7rem;" alt="profilephoto"
        class="img-responsive img-circle" data-toggle="modal"
        data-target="#exampleStandardModal{{ $id }}">

@endif