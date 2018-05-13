{{--@php()--}}
    {{--set_time_limit(0);--}}
{{--@endphp--}}
共{{count($results)}}:<br>
@foreach($results as $result)
    {{$result}}<br>
@endforeach