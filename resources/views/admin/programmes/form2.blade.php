@csrf
<div class="row">
    <div class="col-8">
        <div class="form-group">
            <label for="coursename">course name</label>
            <input type="text" name="coursename" id="coursename"
                   class="form-control @error('coursename') is-invalid @enderror"
                   placeholder="Course name">
            @error('coursename')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <input type="text" name="description" id="description"
                   class="form-control @error('description') is-invalid @enderror"
                   placeholder="description">
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type="text" name="id" id="id"
                   class="form-control @error('id') is-invalid @enderror"
                   placeholder="id"
                   hidden
                    value="{{ $programme->id }}">
            @error('id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <p>
            <button type="submit" id="submit" class="btn btn-success">Save record</button>
        </p>
    </div>

</div>
