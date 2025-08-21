<form action="{{ route('admin.urls.store') }}" method="POST">
    @csrf

    <label>Judul</label>
    <input type="text" name="title">

    <label>URL Asli</label>
    <input type="url" name="original_url">

    <label>Bidang</label>
    <select name="bidang_id">
        @foreach($bidang as $b)
            <option value="{{ $b->id }}">{{ $b->nama_bidang }}</option>
        @endforeach
    </select>

    <label>Seksi</label>
    <select name="seksi_id">
        @foreach($seksi as $s)
            <option value="{{ $s->id }}">{{ $s->nama_seksi }}</option>
        @endforeach
    </select>

    <button type="submit">Simpan</button>
</form>
