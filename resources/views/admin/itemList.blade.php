@extends('layout.admin')
@section('content') 
<div class=" d-flex w-100 flex-shrink-0 py-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-bold text-center w-100">Item List</span>
</div>
<div align="right" class="my-3 mx-3 d-flex align-items-center">
  <i class="bi bi-search me-3"></i>
  <input type="search" class="form-control me-3"  name="search" id="form-search" placeholder="Search for Item Name or Item ID ">
  <div class="d-flex align-items-center">
      Showing
      <p id="total_records" class="mx-2 my-2 fw-bold text-success"> </p>  Records.
      </div>
</div>
      
          {{-- <div class="list-group list-group-flush border-bottom scrollarea " style="border-right:1px #f0eeee solid;">
            @if(count($data)>0)
            @foreach ($data as $info)
            <div class="list-group-item list-group-item-action  py-3" aria-current="true">
              <div class="d-flex align-items-center">
              
                <div class="me-3">
                  <img src="/itemImages/{{$info->itemImg}}" width="120px" height="120px" 
                    style="object-fit: cover; border:1px #121212 solid;" 
                    class="rounded-circle" >
                </div>
                <div class="d-flex align-items-center">
                  <small>
                    <ul style="list-style: none; margin-top: auto; margin-bottom:auto;">
                        <li><b>ID:</b> {{$info->id}}</li>
                        <li><b>Name:</b> {{$info->prodName}}</li>
                        <li><b>Details:</b> <textarea class="form-control" style="background: none; resize:none;" name="" id="" cols="10" rows="5" disabled>{{$info->prodDeets}}</textarea> </li>
                    </ul>
                  </small>
                  <small>
                    <ul class="pe-3" style="list-style: none;  margin-top: auto; margin-bottom:auto;">
                        <li><b>Condition:</b> {{$info->cond}}</li>
                        <li><b>Category:</b> {{$info->category}}</li>
                        <li><b>Type:</b> {{$info->type}}</li>
                        <li><b>Quantity:</b> {{$info->qty}}</li>
                        <li><b>Starting Price:</b> {{$info->initialPrice}} PHP</li>
                        <li><b>Buyout Price:</b> {{$info->buyPrice}} PHP</li> 
                    </ul>
                  </small>
                </div>
                <div>
                  <a href="list/{{$info->id}}/edit" class="userloggedbtn ms-5 px-5" style="font-size:15px;">Edit</a>
                </div>
                <div>
                    {!! Form::open(['action'=>['App\Http\Controllers\itemListController@destroy',$info->id],
                    'method'=>'POST'])!!}
                    {{ Form::hidden('_method','DELETE') }}
                    {{ Form::submit('Delete',
                    ['class' => 'text-danger userloggedbtn px-5 w-100',
                    'style'=>' background:none;
                                border-right: 1px #b6b5b5 solid;
                                border-left: 1px #b6b5b5 solid;
                                font-size:15px;'])}}
                    {!! Form::close() !!} 
                </div>
                @if ($info->qty<1)
                <div>
                  <small class="text-danger ms-5 ">Out Of Stock!</small>  
                </div>                    
                @else
                <div>
                  {!! Form::open(['action'=>['App\Http\Controllers\AuctionController@show',$info->id],
                  'method'=>'POST'])!!}
                      {{ Form::hidden('_method','GET') }}
                      {{ Form::submit('Post',['class' => 'btn userloggedbtn text-success ms-5', 'style' => 'font-size:15px;'])}}
                  {!! Form::close() !!} 
                </div>
                @endif
              </div>
            </div>
            @endforeach
            @else
            <p class="m-auto"> No Records Found! </p>
          @endif --}}
        
            <div id="item_list">
              
            </div>
         
          <script>
            $(document).ready(function(){
                    fetch_itemlist_data();
            
                    function fetch_itemlist_data(query = ''){
                        
                        $.ajax({
                            url:"{{ route('itemsearch')}}",
                            method:'GET',
                            data:{query:query},
                            dataType:'json',
                            success:function(data){
                                $('#item_list').html(data.table_data);
                                $('#total_records').text(data.total_data);
                            }
                        })
                    }
            
                    $(document).on('keyup','#form-search',function(){
                        var query  = $(this).val();
                        fetch_itemlist_data(query);
                    })
                })
              </script>
    @endsection
