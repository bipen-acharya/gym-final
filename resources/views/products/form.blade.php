<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" placeholder="Name" name="name"
        value="{{ isset($product) ? $product->name : '' }}">
    @if ($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
    @endif
</div>

<div class="form-group">
    <label for="price">Price (Rs)</label>
    <input type="number" class="form-control" placeholder="Price" name="price"
        value="{{ isset($product) ? $product->price : '' }}">
    @if ($errors->has('price'))
        <p class="text-danger">{{ $errors->first('price') }}</p>
    @endif
</div>

<div class="form-group">
    <label for="description">Short Description</label>
    <input type="text" class="form-control" placeholder="Short Description" name="description"
        value="{{ isset($product) ? $product->description : '' }}">
    @if ($errors->has('description'))
        <p class="text-danger">{{ $errors->first('description') }}</p>
    @endif
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control" name="image">
    @if (isset($product))
        <div class="img-box">
            <img src="{{ $product->getFirstMediaUrl() }}" alt="{{ $product->name }}" width="100" height="100">
        </div>
    @endif

    @if ($errors->has('image'))
        <p class="text-danger">{{ $errors->first('image') }}</p>
    @endif
</div>
