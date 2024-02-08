@extends('layouts.header')
@section('title', 'Referral Level')
@section('content')

<section class="content">
    <header class="content__title">
        <h1>Referral Levels</h1>
    </header>

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

    @foreach($commissionTypes as $key => $type)
    <div class="col-lg-4 mb-4">
        <div class="card border--primary parent">
            <div class="card-header bg--primary">
                <h5 class="text-dark float-start" style="color:#000;">{{ __($type) }}

                     @if($general->$key == 0)
                    <a href="{{ route('admin.setting.referral.status',$key) }}" class="btn btn-success btn-sm text-end text-right float-right"><i class="las la-toggle-on"></i> @lang('Enable Now')</a>
                    @else
                    <a href="{{ route('admin.setting.referral.status',$key) }}" class="btn btn-danger btn-sm text-end text-right float-right"><i class="las la-toggle-off"></i> @lang('Disable Now')</a>
                    @endif

                </h5>
               
            </div>

            <div class="card-body">

                <ul class="list-group list-group-flush">
                @foreach($referrals->where('commission_type',$key) as $referral)
                    <li class="list-group-item d-flex flex-wrap justify-content-between text-dark text-inverse">
                        <span class="fw-bold text-dark text-inverse" style="color:#000;">@lang('Level') {{ $referral->level }}</span>
                        <span class="fw-bold text-dark text-inverse" style="color:#000;">{{ $referral->percent }}%</span>
                    </li>
                @endforeach
                </ul>

                <div class="form-group">
                    <label>@lang('Number of Level')</label>
                    <div class="input-group">
                        <input type="number" name="level" min="1" placeholder="Type a number & hit ENTER ↵" class="form-control">
                        <button type="button" class="btn btn--primary generate">@lang('Generate')</button>
                    </div>
                    <span class="text--danger required-message d-none">@lang('Please enter a number')</span>
                </div>

                <form action="{{ route('admin.setting.referral.store.level') }}" method="post" class="d-none levelForm">
                    @csrf
                    <input type="hidden" name="commission_type" value="{{ $key  }}">
                        <h6 class="text--danger mb-3">@lang('The Old setting will be removed after generating new')</h6>
                        <div class="form-group">
                            <div class="referralLevels"></div>
                        </div>
                    <button type="submit" class="btn btn--primary btn-block">@lang('Submit')</button>
                </form>

            </div>
        </div>
    </div>
    @endforeach
</div>

</section>


@endsection

@push('child-scripts')
    <script>
    (function($){
        "use strict"

        $('[name="level"]').on('focus', function(){
            $(this).on('keyup', function(e){
                if(e.which == 13){
                    generrateLevels($(this));
                }
            });
        });

        $(".generate").on('click', function () {
            let $this = $(this).parents('.card-body').find('[name="level"]');
            generrateLevels($this);
        });

        $(document).on('click', '.deleteBtn', function () {
            $(this).closest('.input-group').remove();
        });

        function generrateLevels($this){
            let numberOfLevel = $this.val();
            let parent = $this.parents('.card-body');
            let html = '';
            if (numberOfLevel && numberOfLevel > 0){
                parent.find('.levelForm').removeClass('d-none');
                parent.find('.required-message').addClass('d-none');

                for (var i = 1; i <= numberOfLevel; i++){
                    html += `
                    <div class="input-group mb-3">
                        <span class="input-group-text justify-content-center">@lang('Level')`+i+`</span>
                        <input type="hidden" name="level[]" value="`+i+`" required>
                        <input name="percent[]" class="form-control col-10" type="text" required placeholder="@lang('Level `+i+` Commission Percentage')">
                        <button class="btn btn-danger input-group-text deleteBtn" type="button"><i class=\'zmdi zmdi-delete\'></i></button>
                    </div>`
                }

                parent.find('.referralLevels').html(html);
            }else {
                parent.find('.levelForm').addClass('d-none');
                parent.find('.required-message').removeClass('d-none');
            }
        }

    })(jQuery);
    </script>
@endpush
