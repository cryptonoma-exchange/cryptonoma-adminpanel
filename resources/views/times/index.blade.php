@extends('layouts.header')
@section('title', 'Time Settings')
@section('content')


<section class="content">
    <header class="content__title">
        <h1>Time Settings</h1>
    </header>


    <div class="row">

        <div class="col-lg-12 text-right text-end mb-2">
            
            <button class="btn btn-primary btn-md cuModalBtn" data-modal_title="@lang('Add New Time')">
        <i class="las la-plus"></i> @lang('Add New')
    </button>

        </div>

        <div class="col-lg-12">
            <div class="card b-radius--10 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">

                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Time')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($times as $time)
                                    <tr>
                                        <td data-label="@lang('S.N.')">{{ $loop->iteration }}</td>
                                        <td data-label="@lang('Name')">{{ __($time->name) }}</td>
                                        <td data-label="@lang('Time')">{{ __($time->time) }} @lang('Hours')</td>
                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-sm btn-primary cuModalBtn" data-modal_title="@lang('Update Time')" data-resource="{{ $time }}"><i class="las la-pen text--shadow"></i>@lang('Edit')</button>

                                            <button class="btn btn-sm btn-danger removeBtn" data-toggle="modal" data-target="#removeModal" data-id="{{ $time->id }}"><i class="las la-trash text--shadow"></i>@lang('Delete')</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

</section>    

    <div class="modal fade" id="cuModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close bg-danger text-white" data-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>

                <form action="{{ route('admin.times.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Hour')</label>
                            <div class="input-group">
                                <input type="text" name="time" class="form-control" required>
                                <span class="input-group-text">@lang('Hour')</span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Delete Time')</h5>
                <button type="button" class="close bg-danger text-white" data-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.times.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <h6>@lang('Are you sure to delete this time?')</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-dark">@lang('No')</button>
                        <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('child-scripts')
<script>
    (function($){
        "use strict";
        $('.removeBtn').on('click',function () {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'));
        });
    })(jQuery);
</script>
@endpush
