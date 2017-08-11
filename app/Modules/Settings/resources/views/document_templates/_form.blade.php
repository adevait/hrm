<div class="form-group">
    {!! Form::label('name', trans('app.settings.document_templates.name').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('type', trans('app.settings.document_templates.type').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('type', document_template_types(), null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('template', trans('app.settings.document_templates.template').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('template', null, ['class' => 'form-control', 'id' => 'template']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('settings.document_templates.index')}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>
@section('additionalJS')
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script>
    tinymce.init({
        selector: '#template',
        doctype: '<!DOCTYPE html>',
        browser_spellcheck: true,
        valid_elements: '*[*]',
        theme : 'modern',
        skin :  'lightgray',
        height: '250',
        language : "en",
        plugins: "table",
        toolbar1: 'undo redo | styleselect | bold italic | link | image | alignleft aligncenter alignright',
        toolbar2 : '{{$toolbarStringified}}',
        setup : function(ed) {
            var toolbar2 = JSON.parse('{!!$toolbar!!}');
            if(typeof toolbar2 != 'undefined') {
                var n = Object.keys(toolbar2).length;
                for(var i = 0; i < n; i++) {
                    ed.addButton(toolbar2[i], {
                      text: toolbar2[i],
                      icon: false,
                      onclick: function (e) {
                        ed.insertContent('%'+$(e.target).text()+'%');
                      }
                    });
                }
            }
        }
    });
 </script>
@endsection