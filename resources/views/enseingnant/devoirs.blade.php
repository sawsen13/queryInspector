
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
                <h3>Devoirs</h3>
                
              </div>
              
            </div>
          </div>
          <a class="btn btn-primary form-little-squirrel-control"
                    data-bs-toggle="modal" data-bs-target="#wnd" aria-haspopup="true" aria-expanded="false" role="button"
                     v-pre> <i class="fa fa-plus text-success"></i> Ajouter un devoir
                   </a>
          <section class="section">
            <div class="card">
              <div class="row grid-margin">
                  
                   
                </div>
              <div class="card-body">
                <table class="table table-striped" id="table1">
                  <thead>
                    <tr>
                      <th>Num de TP</th>
                      <th>date de début</th>
                      <th>date de fin</th>
                      <th>Promotion</th>

                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($devoirs as $devoir)
                    <tr>
                      <td>{{$devoir->num_tp}}</td>
                      <td>{{$devoir->date_debut}}</td>
                      <td>{{$devoir->date_fin}}</td>
                      <td>{{ optional($devoir->promotion)->libelle_pr }}</td>
                      <td>
                      <a href="{{ route('devoirssub', ['id_dev' => $devoir->id_dv]) }}" @click.prevent>
  <button class="btn btn-success mr-1" style="background-color: #28a745; color: #fff; border-color: #28a745;">
    <i class="fa fa-eye"></i> Voir
  </button>
</a><form method="POST" action="{{ route('devoirs.supp', $devoir->id_dv) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger delete" title='Delete'><i class="fa fa-times">Supprimer</i></button>
                                    </form>

                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
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
                    
                      
                    <form class="needs-validation" method="POST" action="{{ route('devoir.store') }}" novalidate enctype="multipart/form-data">
      @csrf
        
       <fieldset>

                      <div class="form-group">
                        <label for="firstname">Num de TP</label>
                        <input id="lastname" class="form-control" type="number" name="num_tp" required>

                      </div>
                      <div class="form-group">
  <label for="start_date">Date de début</label>
  <input id="start_date" class="form-control" type="datetime-local" name="date_debut" required>
</div>
<div class="form-group">
  <label for="start_date">Date de fin</label>
  <input id="start_date" class="form-control" type="datetime-local" name="date_fin" required>
</div>

<div class="form-group">
  <label for="pdf_file">Choisir un fichier</label>
  <input type="file" class="form-control-file" id="pdf_file" name="file" accept=".pdf,.doc,.docx">
</div>

                      <div class="form-group">
                        <label for="lastname">Pour :</label>
                       

                       <select name="promo" >
    <option value="">-- Select a promotion --</option>
    @foreach($promotions as $promotion)
    <option value="{{ $promotion->id_pr }}" >{{ $promotion->libelle_pr }}</option>
@endforeach

</select>
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
       

    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
    @endsection
