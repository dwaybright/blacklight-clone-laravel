<div class="container-fluid">
    <div class="form-row align-items-center my-5">
        <div class="col-10">
            <label class="sr-only" for="inlineFormInputName">Name</label>
            <input type="text" class="form-control" id="q" name="q" value="{{ $q ?? old('q') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</div>
