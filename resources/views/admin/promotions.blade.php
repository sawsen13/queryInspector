
@extends('layouts.MenuAdmin')
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
                <h3>Promotions</h3>
                
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
               
              </div>
            </div>
          </div>
          <a class="btn btn-primary form-little-squirrel-control"
                    data-bs-toggle="modal" data-bs-target="#wnd" aria-haspopup="true" aria-expanded="false" role="button"
                     v-pre> <i class="fa fa-plus text-success"></i> Ajouter une Promotion
                   </a>
          <section class="section">
            <div class="card">
              <div class="row grid-margin">
                 
                    
                </div>
              <div class="card-body">
                <table class="table table-striped" id="table1">
                  <thead>
                    <tr>
                      <th>Libellé</th>
                      <th>Nombre des groupes</th>
                      <th>Nombre des etudiants</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($promotions as $promotion)

                    <tr>
                      <td>{{$promotion->libelle_pr}}</td>
                      <td>{{$promotion->groupes()->count()}}</td>
                      <td>{{$promotion->users()->where('role', 'etudiant')->count()}}</td>
                      <td>
                      <a href="{{ route('etudiants-a', ['id_pr' => $promotion->id_pr]) }}">
  <button class="btn btn-success mr-1" style="background-color: #28a745; color: #fff; border-color: #28a745;">
    <i class="fa fa-eye"></i> Voir
  </button>
</a>     


                                      <form method="POST" action="{{ route('promotions.supp', $promotion->id_pr) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger delete" title='Delete'><i class="fa fa-times">Supprimer</i></button>
                                    </form>


</td>
                    </tr>
                    @endforeach
                  </tbody>
                 
                                  
                                  

          
        <div class="modal" id="wnd">
              <div class="modal-dialog modal-md">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                 
                    <h3 class="font-sans-serif text-center fw-bold fs-1 text-dark mx-auto ms-8"> Remplir les informations </h3>
                    <a class="close"  data-bs-dismiss="modal"aria-label="Close">&times;</a> 
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body mx-auto">
                    <div class="row align-items-center mb-3">
                    
                      
             <form class="needs-validation" method="POST" action="{{ route('promotion.store') }}" novalidate>
      @csrf
        
       <fieldset>

                      <div class="form-group">
                        <label for="lastname">Année de début:</label>
                        <input id="lastname" class="form-control" type="year" name="annee_debut" required>
                      </div>
                      <div class="form-group">
                        <label for="lastname">Année de fin:</label>
                        <input id="lastname" class="form-control" type="year" name="annee_fin" required>
                      </div>
                      <div class="form-group">
                        <label for="lastname">Nombre de groupes:</label>
                        <input id="lastname" class="form-control" type="number" name="nbr_groupes" required>
                      </div>
                      
                      
                      <div class="input-group-icon ms-3 mb-3 mt-7">
          <button class="btn btn-primary form-little-squirrel-control" type="submit">Ajouter</button>
          <i class="fas fa-user-plus amber-text input-box-icon" style="color:white"></i>
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Annuler</button>
         </div>
                    </fieldset>
       
        
      </form>

                      


</div>
  </div>

                 

                  <!-- Modal footer -->
                  

                </div>
              </div>
            </div>
      
                    
                  
                
         
        </div>
      </div>
       

   <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/pages/jquery.js"></script>


    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
    @endsection
