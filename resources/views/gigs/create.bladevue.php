@extends('layouts.inner')
@section('content')
{{ HTML::script('./js/front/tokenize2.js')}}
<script type="text/javascript">
    $(window).load(function () {
        $("#step_2").prop("disabled", false);
    });
    $(document).ready(function () {
        $("#gigform").validate();

        $("#category_id").change(function () { 
            var catid = $("#category_id").val();
            if(catid == ''){
                catid = '0';
            }
            $("#subcategory").load('/gigs/getsubcategorylist/' + catid);
        });
        // $("#div1").load('');
    });
  
</script>
<div class="main_dashboard" id="app">
<create-gig :catList="{{$catList}}" :skills="{{$skills}}"></create-gig>
</div>
<script type="text/javascript">
    $('.tokenize-custom-demo1').tokenize2({
                tokensAllowCustom: true
        });
</script>
@endsection