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
                <h3>Mes Notes</h3>
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
      <th>Note</th>
    </tr>
  </thead>
  <tbody>
    @foreach($notes as $num_tp => $notesByTp)
      <tr>
        <td>TP {{ $num_tp }}</td>
        <td>
          @foreach($notesByTp as $note)
            {{ $note->note }}
          @endforeach
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


      
   


    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
    <script src="assets/js/pages/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/pages/jquery.js"></script>
    @endsection
