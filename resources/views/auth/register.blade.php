@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('Prenom') }}</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>

                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="promotion" class="col-md-4 col-form-label text-md-end">{{ __('Promotion') }}</label>

                            <div class="col-md-6">
                            <select name="promotion" class="form-control @error('promotion') is-invalid @enderror" onchange="updateGroupes()">
    <option value="">-- Select a promotion --</option>
    @foreach($promotions as $promotion)
    <option value="{{ $promotion->id_pr }}" data-groupes="{{ $promotion->groupes->pluck('id_gr')->implode(',') }}">{{ $promotion->libelle_pr }}</option>
@endforeach

</select>

                                @error('promotion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
    <label for="groupe" class="col-md-4 col-form-label text-md-end">{{ __('Groupe') }}</label>
    <div class="col-md-6">
        <select name="groupe" class="form-control @error('groupe') is-invalid @enderror">
            <option value="">-- Select a groupe --</option>
            @if(isset($groupes))
                @foreach($groupes as $groupe)
                <option value="{{ $groupe->num_gr }}" @if(old('groupe')==$groupe->id_gr) selected="selected" @endif>{{ $groupe->num_gr }}</option>
                @endforeach
            @endif
        </select>

        @error('groupe')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

</div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateGroupes() {
    var promotionSelect = document.getElementsByName('promotion')[0];
    var groupesSelect = document.getElementsByName('groupe')[0];
    groupesSelect.innerHTML = '<option value="">-- Select a groupe --</option>'; // reset the options

    var groupesData = promotionSelect.options[promotionSelect.selectedIndex].getAttribute('data-groupes');
    var groupesArray = groupesData.split(',');
    var allGroupes = {!! json_encode($groupes) !!}; // get all groupes from PHP

    for (var i = 0; i < groupesArray.length; i++) {
        for (var j = 0; j < allGroupes.length; j++) {
            if (allGroupes[j].id_gr == groupesArray[i]) {
                var option = document.createElement('option');
                option.value = allGroupes[j].id_gr;
                option.text = allGroupes[j].num_gr;
                groupesSelect.add(option);
                break;
            }
        }
    }
}


</script>
@endsection
