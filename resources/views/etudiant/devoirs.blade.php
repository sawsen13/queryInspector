use Carbon\Carbon;
@extends('layouts.MenuEtudiant')
@Section('content')
<header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>

        <div class="page-heading">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mes Devoirs</h3>
                <p class="text-subtitle text-muted">
                  
                </p>
              </div>
              
            </div>
          </div>
          <section class="section">
            <div class="card">
              
              <div class="card-body">
  <table class="table table-striped" id="table1">
    <thead>
      <tr>
        <th>Num de TP</th>
        <th>date de début</th>
        <th>date de fin</th>
        <th>Fiche TP</th>

        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
    @foreach($devoirs as $d)
    <tr>
        <td>{{ $d->num_tp }}</td>
        <td>{{ $d->date_debut }}</td>
        <td>{{ $d->date_fin }}</td>
        <td>
    @if($d->file)
        <a href="{{ route('download-devoir', $d->id_dv) }}" class="btn btn-primary">Telecharger</a>
    @else
        <span class="text-muted">Aucun fichier</span>
    @endif
</td>

        <td>
            @if($d->date_fin > now())
                @php 
                    $submission = $d->evaluation->where('etudiant', auth()->id())->first(); 
                @endphp
                @if(!$submission || !$submission->file) 
                    <form method="POST" action="{{ route('submit-devoir') }}" enctype="multipart/form-data" id="submit-form">
                        @csrf
                        <input type="hidden" name="devoir_id" value="{{ $d->id_dv }}">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" accept=".c">
                                <label class="custom-file-label" for="file">
</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Soumettre
</button>
                                <button class="btn btn-secondary" type="button" onclick="document.getElementById('submit-form').reset();">Annuler</button>
                            </div>
                        </div>
                    </form>
                @else
                    <div>Devoir soumis</div>
                    <form method="POST" action="{{ route('resubmit-devoir', $submission->id_ev) }}" enctype="multipart/form-data" id="submit-form">
                        @csrf
                        <input type="hidden" name="devoir_id" value="{{ $d->id_dv }}">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" accept=".c" >
                                <label class="custom-file-label" for="file"></label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Resoumettre</button>
                                <button class="btn btn-secondary" type="button" onclick="document.getElementById('resubmit-form').reset();">Annuler</button>
                            </div>
                        </div>
                    </form>
                @endif
            @else
                <td>Delai dépassé</td>
            @endif
        </td>
    </tr>
@endforeach


</tbody>






  </table>
</div>

            </div>
          </section>
        </div>
       
                 

                  <!-- Modal footer -->
                  

                </div>
              </div>
            </div>
      
                    
                  
                
         
        </div>
      </div>


      
   
      <script>
    document.getElementById("submit-form").addEventListener("submit", function(event){
        event.preventDefault();
        document.getElementById("submit-btn").style.display = "none";
        document.getElementById("cancel-btn").style.display = "none";
        document.getElementById("new-btn").style.display = "block";
        this.submit();
    });
</script>


    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
    <script src="assets/js/pages/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/pages/jquery.js"></script>
    @endsection
