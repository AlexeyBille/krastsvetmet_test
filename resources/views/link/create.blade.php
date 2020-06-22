@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Укорачиватель ссылок</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('store_link') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">Ссылка*</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"
                                           name="url" value="{{ old('url') }}" required>
                                    <small class="form-text text-muted"> Ссылка которую нужно укоротить </small>
                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="short_uri"
                                       class="col-md-4 col-form-label text-md-right">Короткая ссылка</label>
                                <div class="col-md-6">
                                    <input id="short_uri" type="text"
                                           class="form-control @error('short_uri') is-invalid @enderror"
                                           name="short_uri" value="{{ old('short_uri') }}">

                                    @error('short_uri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expires_at"
                                       class="col-md-4 col-form-label text-md-right">Срок жизни</label>

                                <div class="col-md-6">
                                    <input id="expires_at" type="datetime-local"
                                           class="form-control @error('expires_at') is-invalid @enderror"
                                           name="expires_at" value="{{ old('expires_at') }}">

                                    @error('expires_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_commercial"
                                               id="is_commercial" value="1" {{ old('is_commercial') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="is_commercial">Коммерческая ссылка</label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="timezone" id="timezone">

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Уменьшить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
