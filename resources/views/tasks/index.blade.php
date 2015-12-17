@extends('layout.base')

@section('view')
<h3 class="page-title">
    {{ trans('tasks.titles.index') }}
</h3>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn btn-sm grey" href="/tasks/create">
                            <i class="fa fa-plus"></i> {{ trans('tasks.titles.new') }} </i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td style="text-align: center">{{ trans("tasks.fields.name") }}</td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center"></td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $tasks)
                            <tr class="odd gradeX">
                                <td style="text-align: center; vertical-align: middle;">{{$tasks->name}}</td>
                                <td style="text-align: center; vertical-align: middle; width: 50px;"><a href="{{$tasks->active ? '/tasks/'.$tasks->id.'/deactive' : '/tasks/'.$tasks->id.'/active'}}" class="btn btn-sm {{$tasks->active ? "green" : "red"}}" style="width: 35px; margin-right: 0px;"><i class="fa {{$tasks->active ? "fa-check" : "fa-times"}}"></i></a></td>
                                <td style="text-align: center; vertical-align: middle; width: 90px !important; padding: 5px 0 5px 5px;">
                                    <a href="/tasks/{{$tasks->id}}/edit" class="btn btn-sm yellow" style="width: 35px;">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" data-id="{{$tasks->id}}" class="btn btn-sm red deleteModal" style="width: 35px;">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript_page')
<script>
    jQuery(document).ready(function($) {
        var app = new App();
        app.orderedTableInit('.table', 0, 'asc');

        $(".deleteModal").on("click", function(){
            app.throwConfirmationModal('<?php echo trans('tasks.titles.delete'); ?>','<?php echo trans('tasks.notifications.delete_confirmation'); ?>','/tasks/delete', $(this).data("id"));
        });
    });
</script>
@stop