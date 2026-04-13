<h1>Register Venue</h1>

<form method="POST" action="{{ route('venue.store') }}">
    @csrf

    <input type="text" name="business_name" placeholder="Nama Usaha">
    <input type="text" name="phone_number" placeholder="Nomor Handphone">
    <textarea name="address" placeholder="Alamat"></textarea>

    <button type="submit">Daftar</button>
</form>
