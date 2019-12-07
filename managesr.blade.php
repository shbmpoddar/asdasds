@extends('layouts.app')

@section('content')
@section('title', '| Manage SR')

@include('user.sidebar')

<!-- Main content -->
<div class="content-wrapper">
  
  <!-- Page header -->
  <div class="page-header page-header-default" >
    <div class="page-header-content border-bottom border-bottom-danger">
      <div class="page-title">
        <h5>
         
          <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Sanction Requests</span> - My Pending SRs
          
        </h5>
      </div>
                    
      <div class="heading-elements">
        <a href="#" class="btn bg-primary-400  btn-rounded" data-toggle="modal" data-target="#modal_create_sr"><i class=" icon-user-plus position-left"></i>New Request</a>
      </div>
    </div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="icon-home2 position-left"></i> Sanction Request</a></li>        
        
        <li class="active">My Pending SRs </li>
      </ul>
    </div>
  </div>
  <!-- /page header -->

  
   

  <!-- Content area -->
  <div class="content">
    
    <!-- Basic datatable -->
    <div class="panel panel-flat border-bottom-success">
      <div class="panel-heading">
        
        <h5 class="panel-title">My Pending SRs</h5>
      </div>

      <div class="panel-body">
        
      </div>

      <table class="table datatable-responsive">
        <thead>
          <tr class="bg-teal">
            <th>#ID</th>
            <th>Title</th>
            <th>Amount</th>
            <th>Parked with</th>
            
            <th>Request Date</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>

          @foreach($sanctionrequests as $item)
          @if($item->deleted_at == "")
            <tr class="item{{$item->id}}">

              
              <td id="idcell"><a href="sanctionrequests/{{ $item->id }}">{{$item->id}}</a></td>
              <td id="titlecell"><a href="sanctionrequests/{{ $item->id }}">{{$item->title}}</a></td>
              <td id="amountcell">{{$item->amount}}</td>
              <td>{{app\User::where('id',$item->parkedwith)->first()->name}}</td>
              <td>
                 {{-- @if($item->status=="P")
                <span class="label label-danger">
                  {{"Pending"}}
                  </span>
                @elseif($item->status=="A")
                <span class="label label-primary">
                {{"Approved"}}
                </span>
                @elseif($item->status=="C")
                <span class="label label-success">
                {{"Closed"}}
                </span>
                @endif --}}
               

                <?php
                $timestamp = strtotime($item->created_at);
                $new_date = date("d-M-Y", $timestamp);

                ?>

                {{-- {{ $new_date }} --}}
                {{-- {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('Do MMM YYYY hh:mm a') }} --}}

             
                
              
             </td>
              {{-- <td class="text-center">
                <ul class="icons-list">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="icon-menu9"></i>
                    </a>


                         <li><a href="{{URL::to('/sanctionrequests/update',$item->id)}}" data-toggle="modal" data-target="#modal_edit_sr"><i class=" icon-pencil5 text-primary"></i> Edit</a></li>                   

                         <li><a href="{{URL::to('/sanctionrequests/destroy/'.$item->id)}}" data-method="delete"  data-toggle="modal"><i class=" icon-trash text-danger"></i> Delete </a></li>

                    </ul>
                  
                  </li>
                </ul>
              </td> --}}
              <td class="text-center">
                <ul class="icons-list">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="icon-menu9"></i>
                    </a>
    
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li><a href="{{URL::to('/sanctionrequests/',$item->id,'edit')}}" data-id="{{$item->id}}" data-toggle="modal" id="edit" data-target="#modal_edit_sr" ><i class=" icon-pencil5 text-primary" ></i> Edit</a></li>                                    

                         <li><a href="{{URL::to('/sanctionrequests/destroy/'.$item->id)}}" data-confirm="are you sure" onclick="confirm('are you sure');"  data-toggle="modal" data-method="delete"  data-toggle="modal"><i class=" icon-trash text-danger"></i> Delete </a></li>
                    
                    </ul>
                  </li>
                </ul>
              </td>
            </tr>
              
            </tr>
            @endif   
          @endforeach

        </tbody>
      </table>

      {{-- <script>
        $('.datatable-basic').DataTable({
          autoWidth: false,
          dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Search:</span> _INPUT_',
                lengthMenu: '<span>Records:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '→', 'previous': '←' }
            },
          
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            },

            //   "columnDefs": [
            //   { "width": "10%", "targets": 0 },
            //   { "width": "50%", "targets": 1 },
            //   { "width": "10%", "targets": 2 },
            //   { "width": "15%", "targets": 3 },
            //   { "width": "10%", "targets": 4 },
            //   { "width": "10%", "targets": 5 }
            // ],

                "order": [[ 0, "desc" ]],
                responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    targets:   6
                },
                { 
                    width: "100px",
                    targets: [6]
                },
                { 
                    orderable: false,
                    targets: [6]
                }
            ],
            order: [1, 'asc']        
        });
      </script> --}}

      @include('user.raisenewsrmodal')
      @include('user.editSrmodal')

      @include('partials.footer')
      

      <script src="{{ asset('js/unisym/editsr.js') }}"></script> 
   
    </div>
    <!-- /basic datatable -->

  </div>
  <!-- /content area -->

</div>
<!-- /main content -->    
@endsection



