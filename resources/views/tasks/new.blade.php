@extends('layout.base')

@section('view')
<h3 class="page-title">
    {{ trans('tasks.titles.new') }}
</h3>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"></div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body form">
                <form action="/tasks/store" method="post" id="form_tasks" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">
                                {{ trans("tasks.fields.name") }} <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="name" value="{{Input::old("name")}}" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-3" style="text-align: left;">
                                <a href="/tasks" class="btn default">{{ trans('tasks.buttons.cancel') }}</a>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3" style="text-align: right;">
                                <button type="submit" class="btn green">{{ trans('tasks.buttons.register') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript_page')
<script>
    jQuery(document).ready(function($) {
        var app = new App();

        var rules = {
            name: {
                required: true
            },
            active: {
                required: true
            }
        };

        var messages = {
            name: {
                required: "<?php echo trans("tasks.validations.required") ?>"
            },
            active: {
                required: "<?php echo trans("tasks.validations.required") ?>"
            }
        };

        app.formValidate('#form_tasks', rules, messages);
    });
</script>
@stop