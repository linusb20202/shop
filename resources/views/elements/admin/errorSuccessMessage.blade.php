@if(count($errors) > 0 || Session::has('error_message') || isset($error_message))
    <div class="alert alert-block alert-danger" role="alert">
        
        @if(isset($error_message)) {{$error_message}} @endif
        
        @foreach($errors->all() as $error)
             {{$error}}<br/>
        @endforeach 
        
        @if(Session::has('error_message')) {{Session::get('error_message')}} @endif
    </div>
@endif

@if(Session::has('success_message')) 
    <div class="alert alert-success">
        
        {{Session::get('success_message')}} 
        {{Session::forget('success_message')}}
    </div>
@endif