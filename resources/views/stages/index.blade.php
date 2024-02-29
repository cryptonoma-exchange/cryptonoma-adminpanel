
@extends('layouts.header')
@section('title', 'Stages')
@section('content')

        <div class="main-panel">
        <div class="content">
            <div class="page-inner">
               
                <div class="row">

                    <div class="col-lg-12">
        
                        @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                    </div>
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <h2 class="d-inline">Available ICO/STO Stage</h2>
                                        <a href="{{route('newstage')}}" class="float-right btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Stage</a>
                                    </div>
                                    @foreach ($stages as $stage)
                                    <div class="col-md-4 col-sm-12 text-dark">
                                        <div class="p-1 border rounded shadow-none card position-relative text-dark" x-data="{open: false, toggle() { this.open = ! this.open }}">
                                            <div class="p-3">
                                              <h3 class="card-category d-inline">
                                                {{$stage->stage_name}}
                                                @if ($stage->status == "active" && $stage->sales == "on")
                                                <span class="px-3 py-1 badge badge-success">RUNNING</span>
                                                @elseif($stage->status == "active" && $stage->sales != "on")
                                                <span class="px-3 py-1 badge badge-warning">PAUSED</span>
                                                @else
                                                <span class="px-3 py-1 badge badge-danger">EXPIRED</span>
                                                @endif 
                                              </h3> 
                                              @if ($stage->status == "active")
                                                  <a class="float-right cursor" @click="toggle()" @click.away = "open = false"><i class="fas fa-ellipsis-v"></i></a>
                                              @endif
                                              
                                            </div>
                                            <div class="row justify-content-center">
                                                
                                                <div class="col-md-12">

                                                    <hr>
                                                    
                                                <ul class="list-inline text-center">
                                                  
                                                  <li class="list-inline-item"><a class="btn btn-sm btn-primary" href="{{route('edit.stage', $stage->id)}}">UPDATE STAGE</a></li>
                                                  @if ($stage->sales != "on")
                                                  <li class="list-inline-item"><a class="btn btn-sm btn-info" href="{{route('resumesales', $stage->id)}}">RESUME SALES</a></li>

                                                  @else

                                                  <li class="list-inline-item"><a class="btn btn-sm btn-danger" href="{{route('pausesales', $stage->id)}}">PAUSE SALES</a></li>
                                                  @endif

                                                </ul>

                                                </div>
                                                
                                            </div>
                                            
                                            <div class="p-2 mt-2 text-center">
                                                <h4 class="text-dark" style="color:#000">{{$stage->coin->coinname}}</h4>
                                                <p class="text-dark" style="color: #000;">Token Issued:</p>
                                                <h1 class='text-primary'>{{$stage->token}}</h1>
                                                <small style="color: #000;">Available: {{$stage->token_avail}} Tokens</small> 
                                            </div>
                                            <hr>
                                            <div class="p-4 row text-center">
                                                <div class="col-6">
                                                    <p class="p-0 m-0" style="color: #000;">Base Price</p>
                                                    <h1 class='p-0 m-0 text-primary d-inline' style="color: #000;">{{$stage->price}}</h1>
                                                    <small style="color: #000;">USD</small>
                                                </div>
                                                <div class="col-6">
                                                    <p class="p-0 m-0" style="color: #000;">Base Bonus</p>
                                                    <h1 class='p-0 m-0 text-primary d-inline' style="color: #000;">{{$stage->bonus}}</h1>
                                                    <small style="color: #000;">USD</small>
                                                </div>
                                            </div>
                                            <hr >
                                            <div class='p-3 row'>
                                                <div class="col-6">
                                                    <p class="p-0 m-0" style="color: #000;">Start Date</p>
                                                    <h5 class='p-0 m-0 d-inline'>{{\Carbon\Carbon::parse($stage->start_date)->toDayDateTimeString()}}</h5>
                                                </div>
                                                <div class="col-6">
                                                    <p class="p-0 m-0" style="color: #000;">End Date</p>
                                                    <h5 class='p-0 m-0 d-inline'>{{\Carbon\Carbon::parse($stage->end_date)->toDayDateTimeString()}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection