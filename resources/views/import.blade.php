
<form action="{{ route('import.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" accept=".xlsx, .xls">
    <button type="submit">Importer</button>
</form>
