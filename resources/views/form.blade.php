<form action="/create" method="post">
    @csrf
    <label for="name">Upload File(s): </label>
    <input type="file" name="file" id="file" wire:model="file" accept="file/pdf, image/png">

    @error('file')
    <span class="text-xs text-red-500">{{ $message }}</span>
    @enderror

    <button>Save</button>

</form>