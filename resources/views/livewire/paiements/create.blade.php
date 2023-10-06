<div id= "invoice" class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h4>
          <i class="fas fa-globe"></i> EGL, Inc.
          <small class="float-right">Date: {{now()}}</small>
        </h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>EGL, Inc.</strong><br>
          Thiès, Cité Sénghor<br>
          Sénégal<br>
          Phone: 00221 77 777 77 77<br>
          Email: test@test.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>{{$location->client->prenom}} {{$location->client->prenom}}</strong><br>
          {{$location->client->adresse}}<br>
          {{$location->client->pays}}<br>
          {{$location->client->telephone1}}<br>
          {{$location->client->email}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <br>
        <b>Order ID:</b> {{$location->id}}<br>
        <b>Payment Due:</b> {{now()}}<br>
        <b>Account:</b> 968-34567
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Article</th>
            <th>Serial #</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
             @forelse ($location->articles as $article)
             <tr>
             <td>{{$article->id}}</td>
             <td>{{$article->nom}}</td>
             <td>{{$article->noSerie}}</td>
             <td>{{$article->estDisponible}}</td>
             </tr>
             @empty
                <td colspan="4" class="text-center">Aucun articles selectionné</td> 
             @endforelse
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <img src="{{asset('images/credit/visa.png')}}" alt="Visa">
        <img src="{{asset('images/credit/mastercard.png')}}" alt="Mastercard">
        <img src="{{asset('images/credit/american-express.png')}}" alt="American Express">
        <img src="{{asset('images/credit/paypal2.png')}}" alt="Paypal">

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
          plugg
          dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tbody><tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr>
          </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-12">
        <button id="print" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
        <button type="button" wire:click='savePayment({{$location->id}})' class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
          Payment
        </button>
        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
          <i class="fas fa-download"></i> Generate PDF
        </button>
      </div>
    </div>

    <script>
        var myPrint = document.getElementById('print');
        var myInvoice = document.getElementById("invoice");
        myPrint.addEventListener("click", function(e){
          window.print()
        });    
    </script>

  </div>

  
  
  