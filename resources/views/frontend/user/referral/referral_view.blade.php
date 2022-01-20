@extends('frontend.main_master')
@section('content')

<div class="body-content" style="margin-top: 10px;">
	<div class="container">
		<div class="row">
			 @include('frontend.common.user_sidebar')

       <div class="col-md-2">
       </div>

       <div class="col-md-8">

        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="table_return_order">
            <thead>
  
              <tr style="background: #e2e2e2;">
                <td class="col-md-1">
                  <label for=""> Date</label>
                </td>

                <td class="col-md-3">
                  <label for=""> Total</label>
                </td>

                <td class="col-md-3">
                  <label for=""> Downline ID</label>
                </td>


                <td class="col-md-2">
                  <label for=""> Invoice</label>
                </td>

                 <td class="col-md-1">
                  <label for=""> Coin Claimed </label>
                </td>

                 <td class="col-md-2">
                  <label for=""> Downline Name </label>
                </td>     
              </tr>
</thead>

<tbody>
              @foreach($orders as $order)
       <tr>
                <td class="col-md-1">
                  <label for=""> {{ $order->order_date }}</label>
                </td>

                <td class="col-md-3">
                  <label for=""> ${{ $order->amount }}</label>
                </td>


                 <td class="col-md-3">
                  <label for=""> {{ $order->payment_method }}</label>
                </td>

                <td class="col-md-2">
                  <label for=""> {{ $order->invoice_no }}</label>
                </td>

                 <td class="col-md-2">
                  <label for=""> {{ "coin claimed" }}</label>
                </td>

                 <td class="col-md-2">
                  <label for=""> {{ "coin claimed" }}</label>
                </td>
              </tr>
              @endforeach





        </tbody>
            
          </table>
          
        </div>




         
       </div> <!-- / end col md 8 -->

		 

		 
			
		</div> <!-- // end row -->
		
	</div>
	
</div>
 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready( function () {
    console.log("hi-1");
    console.log("hi-2");
    console.log("hi-3");

    $('#table_return_order').DataTable();

}); // end
</script>
@endsection