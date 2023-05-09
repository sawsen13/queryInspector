
@extends('layouts.MenuEnseignant')
@section('content')
<header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>

        <div class="page-heading">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Liste des etudiants</h3>
                
              </div>
              
            </div>
          </div>
          <section class="section">
            <div class="card">
              <div class="row grid-margin">
              <div class="card-header">{{ __('TP numero  ') }} : {{ $devoir->num_tp }}</div></div>
              <div class="card-body">
                <table class="table table-striped" id="table1">
                <thead>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Task submitted or not</th>
        <th>Groupe</th>
        <th>Note</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
@foreach ($etudiants as $etudiant)
    <tr>
        <td>{{ $etudiant->name }}</td>
        <td>{{ $etudiant->prenom }}</td>
        <td>
            @php
                $evaluation = $evaluations->where('etudiant', $etudiant->id)->first();
            @endphp
            @if ($evaluation)
                @if ($evaluation->soumis)
                    oui
                @else
                    non
                @endif
            @else
                N/A
            @endif
        </td>
        <td>{{ $etudiant->num_gr }}</td>
        <td>
            @if ($evaluation)
                {{ $evaluation->note }}
            @else
                00
            @endif
        </td>
        <td>
            @if ($evaluation)
                @if ($evaluation->soumis)
                <a href="" class="btn btn-primary">Analyser & noter</a>

                    <a href="{{ route('voir.code', $evaluation->id_ev) }}" class="btn btn-primary">Voir code</a>
                @endif
            @endif
        </td>
    </tr>
@endforeach
</tbody>


                </table>
              </div>
            </div></div>
          </section>
        </div>
       
      
                    
                  
                
         
        </div>
       

    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
    @endsection
