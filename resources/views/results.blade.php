<div>5位组合{{count($comb5)}}</div>

@foreach($comb5 as $results)
{{--    <div>{{count($results)}}</div>--}}
    <div>
        @foreach($results as $result)
            {{$result}}
        @endforeach
    </div>

@endforeach

<div>4位组合{{count($comb4)}}</div>

@foreach($comb4 as $results)
    {{--    <div>{{count($results)}}</div>--}}
    <div>
        @foreach($results as $result)
            {{$result}}
        @endforeach
    </div>
@endforeach

<div>3位组合{{count($comb3)}}</div>

@foreach($comb3 as $results)
    {{--    <div>{{count($results)}}</div>--}}
    <div>
        @foreach($results as $result)
            {{$result}}
        @endforeach
    </div>

@endforeach

<div>2位组合{{count($comb2)}}</div>

@foreach($comb2 as $results)
    {{--    <div>{{count($results)}}</div>--}}
    <div>
        @foreach($results as $result)
            {{$result}}
        @endforeach
    </div>

@endforeach

<div>1位组合{{count($comb1)}}</div>

@foreach($comb1 as $results)
    {{--    <div>{{count($results)}}</div>--}}
    <div>
        @foreach($results as $result)
            {{$result}}
        @endforeach
    </div>

@endforeach