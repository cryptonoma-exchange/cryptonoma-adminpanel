@extends('layouts.header')
@section('title', 'Plans')
@section('content')

<section class="content">
    <header class="content__title">
        <h1>All Plans</h1>
    </header>

    <div class="row mt-5">
        <div class="col-lg-12 float-end text-end text-right mb-2">
             <button class="btn btn-primary btn-md modalShow float-end text-end text-right" data-type="add" data-toggle="modal" data-target="#addModal"><i class="las la-plus"></i> @lang('Add New')</button>
        </div>
        <div class="col-lg-12">
            <div class="card b-radius--10 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Invest Amount')</th>
                                    <th>@lang('Interest')</th>
                                    <th>@lang('Time')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($plans as $plan)
                                <tr>
                                    <td data-label="@lang('Name')">{{ __($plan->name) }}</td>
                                    <td data-label="@lang('Invest Amount')">
                                        @if($plan->fixed_amount > 0)
                                        {{ $general->cur_sym }}{{ showAmount($plan->fixed_amount) }}
                                        @else
                                        <span class="text--primary">@lang('Minimum'):</span> {{ $general->cur_sym }}{{ showAmount($plan->minimum) }}
                                        <br>
                                        <span class="text--primary">@lang('Maximum'):</span> {{ $general->cur_sym }}{{ showAmount($plan->maximum) }}
                                        @endif
                                    </td>
                                    <td data-label="@lang('Interest')">
                                        {{ showAmount($plan->interest) }} @if($plan->interest_type == 1) % @else {{ $general->cur_text }} @endif
                                    </td>
                                    <td data-label="@lang('Time')">{{ $plan->time }} @lang('Hours')</td>
                                    <td data-label="@lang('Status')">
                                        @if($plan->status == 1)
                                            <span class="badge badge-success">@lang('Enabled')</span>
                                        @else
                                            <span class="badge badge-danger">@lang('Disabled')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <button class="btn btn-sm btn-primary modalShow" data-type="edit" data-toggle="modal" data-target="#editModal" data-resource="{{ $plan }}" data-action="{{ route('admin.plans.update',$plan->id) }}"><i class="las la-pen"></i> @lang('Edit')</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $emptyMessage }}</td>
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

    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">@lang('Add New Plan')</h5>
                <button type="button" class="close bg--danger text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
                </div>
                <form action="{{ route('admin.plans.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Invest type')</label>
                                    <select name="invest_type" class="form-control" required>
                                        <option value="1">@lang('Range')</option>
                                        <option value="2">@lang('Fixed')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row amount-fields"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Interest type')</label>
                                    <select name="interest_type" class="form-control" required>
                                        <option value="1">@lang('Percent')</option>
                                        <option value="2">@lang('Fixed')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Interest')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="interest" required>
                                        <span class="input-group-text interest-type"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Time')</label>
                                    <select name="time" class="form-control" required>
                                        <option value="">@lang('Select One')</option>
                                        @foreach($times as $time)
                                            <option value="{{ $time->time }}">{{ __($time->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Return type')</label>
                                    <select name="return_type" class="form-control" required>
                                        <option value="1">@lang('Lifetime')</option>
                                        <option value="2">@lang('Repeat')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="repeat-time row"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Plan')</h5>
                    <button type="button" class="close bg--danger text-white" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Invest type')</label>
                                    <select name="invest_type" class="form-control" required>
                                        <option value="1">@lang('Range')</option>
                                        <option value="2">@lang('Fixed')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row amount-fields"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Interest type')</label>
                                    <select name="interest_type" class="form-control" required>
                                        <option value="1">@lang('Percent')</option>
                                        <option value="2">@lang('Fixed')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Interest')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="interest" required>
                                        <span class="input-group-text interest-type"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Time')</label>
                                    <select name="time" class="form-control" required>
                                        @foreach($times as $time)
                                            <option value="{{ $time->time }}">{{ __($time->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Return type')</label>
                                    <select name="return_type" class="form-control" required>
                                        <option value="1">@lang('Lifetime')</option>
                                        <option value="2">@lang('Repeat')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="repeat-time row"></div>
                        <div class="form-group">
                            <label for="inputName">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" name="status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@push('child-scripts')
    <script>
        (function($){
            "use strict"

            $('.modalShow').on('click',function(){

                //get modal element
                if($(this).data('type') == 'add'){
                    var modal = $('#addModal');
                }else{
                    var modal = $('#editModal');
                }
                var plan = new HyipPlan(modal, $(this));

                modal.find('[name=invest_type]').change(function() {
                    plan.getInvestType($(this).val());
                }).change()

                modal.find('[name=interest_type]').change(function() {
                    plan.getInterestType($(this).val());
                }).change()

                modal.find('[name=return_type]').change(function() {
                    plan.getReturnType($(this).val());
                }).change()

                plan.setupEditModal();

            });


            class HyipPlan{
                constructor(modal,btn){
                    this.modal = modal;
                    this.btn = btn;
                    this.resource = btn.data('resource');
                    this.action = btn.data('action');

                    //this block for edit modal
                    if(this.resource){
                        //set amount
                        if(this.resource.fixed_amount <= 0){
                            this.modal.find('[name=invest_type]').val(1);
                        }else{
                            this.modal.find('[name=invest_type]').val(2);
                        }

                        //set interest type
                        if(this.resource.interest_type == 1){
                            this.modal.find('[name=interest_type]').val(1);
                        }else{
                            this.modal.find('[name=interest_type]').val(2);
                        }

                        //set repeat type
                        if(this.resource.life_time == 1){
                            this.modal.find('[name=return_type]').val(1);
                        }else{
                            this.modal.find('[name=return_type]').val(2);
                        }
                    }
                }

                getInvestType(type){
                    if(type == 1){
                        var html = `
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">@lang('Minimum Invest')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="minimum" required>
                                        <span class="input-group-text">{{ $general->cur_text }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">@lang('Maximum Invest')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="maximum" required>
                                        <span class="input-group-text">{{ $general->cur_text }}</span>
                                    </div>
                                </div>
                            </div>
                            `;
                    }else{
                        var html = `
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required">@lang('Amount')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="amount" required>
                                        <span class="input-group-text">{{ $general->cur_text }}</span>
                                    </div>
                                </div>
                            </div>
                            `;
                    }

                    this.modal.find('.amount-fields').html(html);
                }

                getInterestType(type){
                    console.log(type);
                    if(type == 1){
                        this.modal.find('.interest-type').text('%');
                    }else{
                        this.modal.find('.interest-type').text('{{ $general->cur_text }}');
                    }
                }

                getReturnType(type){
                    var html = ``;
                    if(type == 2){
                        var html = `
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required">@lang('Repeat Times')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="repeat_time" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Capital back')</label>
                                <select name="capital_back" class="form-control" required>
                                    <option value="1">@lang('Yes')</option>
                                    <option value="0">@lang('No')</option>
                                </select>
                            </div>
                        </div>
                        `;
                    }
                    this.modal.find('.repeat-time').html(html);
                }

                setupEditModal(){
                    var modal = this.modal;
                    var resource = this.resource;
                    if(resource){
                        modal.find('[name=name]').val(resource.name);
                        modal.find('[name=minimum]').val(parseFloat(resource.minimum).toFixed(2));
                        modal.find('[name=maximum]').val(parseFloat(resource.maximum).toFixed(2));
                        modal.find('[name=amount]').val(parseFloat(resource.fixed_amount).toFixed(2));
                        modal.find('[name=interest]').val(parseFloat(resource.interest).toFixed(2));
                        modal.find('[name=time]').val(resource.time);
                        modal.find('[name=repeat_time]').val(resource.repeat_time);
                        modal.find('[name=capital_back]').val(resource.capital_back);
                        modal.find('form').attr('action',this.btn.data('action'));
                        if (resource.status == 1) {
                            modal.find('[name=status]').bootstrapToggle('on');
                        } else {
                            modal.find('[name=status]').bootstrapToggle('off');
                        }
                    }
                }
            }

        })(jQuery);
    </script>
@endpush
