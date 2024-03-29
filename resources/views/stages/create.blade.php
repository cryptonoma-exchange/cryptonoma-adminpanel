
@extends('layouts.header')
@section('title', 'Create New Stage')
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
                                    <h2 class="d-inline">Add New ICO/STO Stage</h2>
                                </div>
                                <div class="col-md-8 offset-md-2">
                                    <form method="POST" action="{{route('addstage')}}">
                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                
                                                <label for="">Select Token / Coin</label>

                                                <select class="form-control" id="token_id" name="token_id" required>

                                                    <option value=" ">Select Token / Coin</option>
                                                    
                                                    @foreach($coins as $coin)

                                                    <option value="{{ $coin->id }}">{{ $coin->coinname }}</option>

                                                    @endforeach

                                                </select>

                                            </div>
                                        </div>    

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Stage Title/Name</label>
                                                <input type="text" class="form-control" name="stage_name" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                          <div class="form-group col-md-4">
                                            <label>Total Token Issues</label>
                                            <input type="text" class="form-control" name="token" required>
                                            <small>Define how many tokens available for sale on stage.</small>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label>Base Token Price</label>
                                            <input type="text" class="form-control" name="price" required>
                                            <small>Define your token rate. Usually USD per token.</small>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label>Bonus</label>
                                            <input type="text" class="form-control" name="bonus" required>
                                          </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                              <label>Min Per Transaction</label>
                                              <input type="text" class="form-control" name="min" required>
                                              <small>Purchase min amount of token per tranx.</small>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label>Max Per Transaction</label>
                                              <input type="text" class="form-control" name="max" required>
                                              <small>Purchase max amount of token per tranx.</small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                              <label>Start Date</label>
                                              <input type="datetime-local" class="form-control" name="startdate" required>
                                              <small>Start date/time for sale. Can't purchase before time.</small>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label>End Date</label>
                                              <input type="datetime-local" class="form-control" name="enddate" required>
                                              <small>Finish date/time for sale. Can't purchase after time.</small>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                             <div class="form-group col-md-12">
                                            <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Description..."></textarea>
                                            </div>
                                        </div>

                                        <h4>Social Links</h4>
                                        <a id="add-social-link" class="btn btn-warning btn-xs text-right float-right">Add Social Link</a>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div id="social-links-container">
                                              
                                                 <div class="input-group">
                                                    <input type="text" name="social_links[]" class="form-control social-link" placeholder="Enter social link">
                                                  
                                                </div>
                                                    <
                                                </div>
                                            </div>

                                            

                                        </div>      



                                        <button type="submit" class="btn btn-primary">Add Stage</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('child-scripts')


    <script>
        $(document).ready(function(){
            // Add social link field
            $('#add-social-link').click(function(){
                var socialLinkField = '<div class="form-group">';
                socialLinkField += '<div class="input-group">';
                socialLinkField += '<input type="text" name="social_links[]" class="form-control social-link" placeholder="Enter social link">';
                socialLinkField += '<div class="input-group-append">';
                socialLinkField += '<button class="btn btn-danger remove-social-link" type="button">Remove</button>';
                socialLinkField += '</div></div></div>';
                $('#social-links-container').append(socialLinkField);
            });

            // Remove social link field
            $(document).on('click', '.remove-social-link', function(){
                $(this).closest('.form-group').remove();
            });
        });
    </script>

@endpush