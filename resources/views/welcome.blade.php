<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>反缩水</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/bootstrap.4.min.css"/>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 10px;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .close {
                width: 30px;
                height: 30px;
            }

            .my-col {
                min-width: 150px;
                font-size: 20px;
            }

            .count {
                font-size: 18px;
                color: green;
            }


        </style>
    </head>
    <body>
        <div class="container" style="margin-top: 10px">
            <div class="row">
                @for($i = 1; $i <= 11; $i++)
                    <div class="col" style="width: 50px; margin-top: 7px">
                        <input type="checkbox" class="custom-control-input" id="{{$i}}">
                        <label class="custom-control-label" for="{{$i}}" style="margin-left: 10px">{{$i}}</label>
                    </div>
                @endfor
                    <div class="col" style="width: 50px; margin-top: 7px"></div>
                    <button type="button" class="btn btn-info" style="outline: none" onclick="stringSubmit()">添加</button>
                    {{--<button type="button" class="btn btn-danger" style="outline: none; margin-left: 40px" onclick="computResult()">计算</button>--}}
            </div>

            <div class="row flex-center">

                <ul id="table" class="list-group" style="margin-top: 30px; width: 400px">
                    {{--<li id="data-1" class="list-group-item d-flex justify-content-between align-items-center">--}}
                        {{--<h2 class="data-string">1, 2, 3, 5, 7</h2>--}}
                        {{--<h4 ><span class="badge badge-warning badge-pill" style="color: white" id="1">x</span></h4>--}}
                    {{--</li>--}}
                </ul>

            </div>
        </div>

        <div class="count"></div>
        <div id="results" class="row" style="margin-top: 20px">
            {{--<div class="my-col">--}}
                {{--1 of 2--}}
            {{--</div>--}}
        </div>


        <script type="text/javascript" src="/js/jquery-3.3.1.js"></script>
        <script type="text/javascript">
            function stringSubmit() {
                var checks = $('.custom-control-input');
                var checksCount = 0;
                var selectString = '';
                // console.log("element: " + checks);

                for (var i=0; i< checks.length; i++) {
                    var check = checks[i];
                    if (check.checked) {
                        // console.log("element: " + check.id);
                        selectString = selectString + check.id + ", ";
                        checksCount ++;
                    }
                }
                if (checksCount != 5) {
                    alert("必须选中5个数，当前选择" + checksCount + "个");
                } else
                    {
                        var data = $('.data-string');
                        var ul = $('.list-group')[0];

                        var newRow = document.createElement("li");
                        newRow.id = "data-" + (data.length + 1)
                        newRow.className = "list-group-item d-flex justify-content-between align-items-center";
                        var newValue = document.createElement(("h2"));
                        newValue.textContent = selectString;
                        newValue.className = "data-string";
                        var newDelete = document.createElement("h4");
                        // newDelete.addEventListener("deleteValue('6')");
                        var newSpan = document.createElement("span");
                        // newSpan.onclick = deleteValue('65');
                        newSpan.textContent = "x";
                        newSpan.style = "color: white";
                        newSpan.id = (data.length + 1);
                        newSpan.className = "badge badge-warning badge-pill";
                        newDelete.appendChild(newSpan);
                        newRow.appendChild(newValue);
                        newRow.appendChild(newDelete);
                        // console.log("element: " + JSON.stringify(ul.length));
                        ul.appendChild(newRow);
                        computResult();
                    //
                    // console.log("element: " + data[0].textContent);

                    // var dataArray = [];
                    // for (var i=0; i < data.length; i++) {
                    //     console.log("element: " + JSON.stringify(data[i]));
                    //
                    //     dataArray.push(data[i]);
                    // }
                    // $.ajax({
                    //     type: "POST",
                    //     url:   "/input",
                    //     cache: false,
                    //     traditional: "true", //traditional这个必须设置
                    //     async:false,
                    //
                    //     data:{"array":dataArray},
                    //     dataType: "json",
                    //     success: function (ret) {
                    //
                    //     },
                    //     error: function (ret) {
                    //
                    //     }
                    // });

                }
            }

            $(".list-group").on("click", ".badge", function () {
                var delid = $(this).attr("id");
                var removed = $('#data-' + delid)[0];
                // alert(removed);
                removed.remove();
                computResult();
                // alert($(this).attr("id"));
                // $.app.product.displayProdu
                // ct($(this).attr("id"));
            });

            function computResult() {
                // var a = [1,2,3,4,5,6,7,8,9,10,11];
                // console.log(JSON.stringify(combination(a, 5)));
                var data = $('.data-string');
                var array = [];
                // console.log(data[0].textContent);
                for (var i=0; i<data.length; i++) {
                    var datum = data[i].textContent;
                    array.push(datum.split(', ', 5));
                }
                arrayCompare(array);
            }

            function combination(arr, num) {
                var r = [];
                (function f(t, a, n) {
                    if (n == 0) return r.push(t);
                    for (var i = 0, l = a.length; i <= l - n; i++) {
                        f(t.concat(a[i]), a.slice(i + 1), n - 1);
                    }
                })([], arr, num);
                return r;
            }

            function getArray() {

            }

            function arrayCompare(in_arraies) {
                //in_arraies 所有输入的数组的数组，二维数组，由n个5位数的数组组成
//        $com_array 用于比较的数组，小于或等于5
//        1.取出二维数组中的5位数组进行比较
                var resultsTag = $('#results')[0];
                resultsTag.innerHTML = "";

                if (in_arraies.length == 0) {
                    return;
                }

                var results = [];

                // var resultsCol = $('.my-col');
                // // console.log("results" + resultsCol);
                // for (var i=0; i<resultsCol.length; i++) {
                //     resultCol = resultsCol[i];
                //     resultsCol.remove();
                // }
                var com_arraies = [];
                var array = [1,2,3,4,5,6,7,8,9,10,11];
//        dd($array);

                for (var i = 1; i <= 5; i++) {
                    com_arraies = com_arraies.concat(combination(array, i));
                }

                var countInas = in_arraies.length;
                for (var i = 0; i < com_arraies.length; i ++) {
                    var com_array = com_arraies[i];
                    var countCom = com_array.length;

                    matchs = [0,0,0,0,0,0];
                    for (var j = 0; j < countInas; j ++) { //com_array与所有输入数组比较
                        var in_array = in_arraies[j];

                        var match_count = 0;
                        for (var k = 0; k < com_array.length; k++) { //com_array与in_array全面比较
                            var com = com_array[k];

                            for (var l = 0; l < in_array.length; l++) { //com_array中的一位数字遍历in_array
                                var inn = in_array[l];
                                if (com == inn) {
                                    match_count ++;
                                    break;
                                }
                            }
                        }
                        matchs.splice(match_count, 1, matchs[match_count] +1);
                    }
//            if ($i == 7) dd($matchs);

                    for (var m = 1; m < countCom; m ++ ) {
                        var match = matchs[m];
                        if (match == 0) {
                            var result = com_array.join(",") + '选' + m;
                            results.push(result);
                            appendResultTag(resultsTag, result);
                        }
                        else if (m == countCom && match == countInas) {
                            result = com_array.join(",") + '选0';
                            results.push(result);
                            appendResultTag(resultsTag, result);

                        }
//                if (count($results) == 10) dd($matchs);

                    }
                }
                if (results.length > 0) {
                    $('.count')[0].textContent = "结果：共" + results.length;
                }
                // console.log(results);


                // return view('compare', ['results' => $results]);

            }

            function appendResultTag(resultsTag, content) {
                // console.log(resultsTag);

                var resultTag = document.createElement("div");
                resultTag.className = "my-col";
                resultTag.textContent = content;
                resultsTag.appendChild(resultTag);
            }
        </script>

    </body>


</html>
