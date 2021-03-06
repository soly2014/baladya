@extends('layouts.baladya')
@section('content')		
@include('partials.entete', [
'title' => trans('users.users'),
'icon' => 'dashboard',
'fil' =>  link_to('admin/users', trans('users.users'))
])
		
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th data-hide="phone">{{trans('users.code')}}</th>
					<th data-hide="phone">{{trans('users.name')}}</th>
					<th data-hide="phone">{{trans('users.email')}}</th>
					<th data-hide="phone">{{trans('users.contractor')}}</th>
					<th data-hide="phone">{{trans('users.permissions')}}</th>
					<th data-hide="phone">{{trans('users.last_login')}}</th>
					<th>{{trans('users.actions')}}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $user)

				<tr class="odd gradeX">
					<td>{{ $user->code }}</td>
					<td>{{ $user->first_name.' '.$user->last_name }}</td>
					<td>{{ $user->email }}</td>
					<td>
					@if($user->contractor_id != null)
					@if(App\Models\User::where('id','=',$user->contractor_id)->first())
						{{App\Models\User::where('id','=',$user->contractor_id)->first()->first_name.' '.App\Models\User::where('id','=',$user->contractor_id)->first()->last_name}}
					@endif
					@else
					-----------
					@endif
					</td>

					<td>
					@if($user->roles())
						{{$user->roles[0]->name }}
					@endif
					</td>
					<td>{{ $user->last_login }}</td>

					<td>
						<div class="col-lg-4">
							<a href="{{url('/admin/users')}}/{{ $user->id }}" class="btn btn-warning btn-sm btn-icon icon-left">
								<i class="entypo-eye"></i>
								{{trans('dashboard.details')}}
							</a>
						</div>

					<div class="col-lg-4">
						<a href="{{url('/admin/users')}}/{{ $user->id }}/edit" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i>
							{{trans('users.edit')}}
						</a>
						</div>


						<div class="col-lg-4">
						@if($user->roles[0]->id != 4)
						<form method="post" action="{{url('admin/users')}}/{{ $user->id }}" class="FormDelete">
						{{ method_field('DELETE') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" class="btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						مسح</button>
						</form>
						@else
						<button data-id="{{ $user->id }}" data-toggle="modal" data-target="#myModal" class="delete-product btn btn-danger btn-sm btn-icon icon-left">
						<i class="entypo-cancel"></i>
						مقاول</button>
						@endif
						</div>
						
					</td>
				</tr>
				

			@endforeach
			</tbody>
			<tfoot>
			<tr>
				<th data-hide="phone">{{trans('users.code')}}</th>
				<th data-hide="phone">{{trans('users.name')}}</th>
				<th data-hide="phone">{{trans('users.email')}}</th>
				<th data-hide="phone">{{trans('users.contractor')}}</th>
				<th data-hide="phone">{{trans('users.permissions')}}</th>
				<th data-hide="phone">{{trans('users.last_login')}}</th>
				<th>{{trans('users.actions')}}</th>
			</tr>
			</tfoot>
		</table>
		
		<br />		
		<a href="{{ url('/admin/users/create') }}" class="btn btn-primary">
			<i class="entypo-plus"></i>
			{{trans('users.create_user')}}
		</a>







    <!-- start DELETE modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
               
              <h4 class="modal-title" id="myModalLabel21">
                حذف
              <button  type="button" class="close " data-dismiss="modal" aria-hidden="true">
                ×
              </button>
              </h4>
            </div>
            <div class="modal-body">
              <!-- start modal body -->
                         <h5>لاحظ عند حذف المقاول يتم حذف جميع المشرفين لدا هذا المقاول</h5>
                     

                      </div>
                 </form>
           <div class="modal-footer">
                             <form role="form" id="form_delete">
                      <div class="form-group">

                      </div>
                      <div class="form-group">
                       <input type="hidden" id="product_id_delete" name="product_id" value="0">

                          <button type="button" class="btn btn-warning" data-dismiss="modal"> الغاء <i class="fa fa-remove" aria-hidden="true"></i>
                           
                          </button> 


                         <button class="btn btn-danger" id="submit_delete"> حذف <i class="fa fa-trash" aria-hidden="true"></i> </button>
                      </div>
                 </form>

           </div>
    
                    
              <!-- end modal body -->
            </div>
               
             
              
          </div>
          
        </div>
        
      </div>
      <!-- end DELETE modal -->


  <script type="text/javascript">
        
$(document).ready(function(){


      /*
      *
      * show delete modal  
      *
      */
      $('body').on('click','.delete-product',function(){

        var product = $(this).data('id');

          $('#product_id_delete').val(product);


      });

    /*
         *
         *  end showing delete modal
         *
    */




      /* start Deleting form */
        
        $('body').on('click','#submit_delete',function(){
              /* csrf protection on ajax 
         * 
         * see meta tag in solycrud.blade.php blade template
        */
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

        var id    = $('#product_id_delete').val();
        var url = '{{ url('admin/users') }}'+'/'+id;

        $.ajax({

        	url:url,
             type: 'DELETE',  // user.destroy

        	success:function (argument) {

                   location.reload();
        	},
        	error:function (argument) {

                   location.reload();
        	}



        });
                        return false;

      });
      /* End Deleting Form */


});

      </script>




@stop

	@section('scripts')
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var $table1 = jQuery('#table-1');

                // Initialize DataTable
                $table1.DataTable({
                    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "bStateSave": true
                });

                // Initalize Select Dropdown after DataTables is created
                $table1.closest('.dataTables_wrapper').find('select').select2({
                    minimumResultsForSearch: -1
                });
            });
        </script>




@stop