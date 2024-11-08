@extends('template.master')

@section('title')
    {{ ucwords(str_replace('_', ' ', 'edit_inventory_movement_configuration')) }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inventory_movement_configuration.index') }}">{{ ucwords(str_replace('_', ' ', 'inventory_movement_configuration')) }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">@yield('title')</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inventory_movement_configuration.update', $inventory_movement_configuration->id) }}" method="POST">
                            @csrf @method('PUT')

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">
                                    {{ ucwords(str_replace('_', ' ', 'name')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $inventory_movement_configuration->name) }}" required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="code">
                                    {{ ucwords(str_replace('_', ' ', 'code')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="code" name="code" value="{{ old("code", $inventory_movement_configuration->code) }}" required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="stock">
                                    {{ ucwords(str_replace('_', ' ', 'stock')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select name="stock" id="stock" class="form-control">
                                        <option value="In" {{ $inventory_movement_configuration->stock == 'In' ? 'selected' : '' }}>In</option>
                                        <option value="Out" {{ $inventory_movement_configuration->stock == 'Out' ? 'selected' : '' }}>Out</option>
                                        <option value="Any" {{ $inventory_movement_configuration->stock == 'Any' ? 'selected' : '' }}>Any</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="price_used">
                                    {{ ucwords(str_replace('_', ' ', 'price_used')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select name="price_used" id="price_used" class="form-control">
                                        <option value="buy_price" {{ $inventory_movement_configuration->price_used == 'buy_price' ? 'selected' : '' }}>buy_price</option>
                                        <option value="sell_price" {{ $inventory_movement_configuration->price_used == 'sell_price' ? 'selected' : '' }}>sell_price</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
