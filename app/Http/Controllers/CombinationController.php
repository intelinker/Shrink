<?php

namespace App\Http\Controllers;

use App\Combination;
use Illuminate\Http\Request;

class CombinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array = array(1,2,3,4,5,6,7,8,9,10,11);
        $comb5 = $this->combination($array, 5);
        $comb4 = $this->combination($array, 4);
        $comb3 = $this->combination($array, 3);
        $comb2 = $this->combination($array, 2);
        $comb1 = $this->combination($array, 1);

        return view('results', ['comb5'=>$comb5, 'comb4'=>$comb4, 'comb3'=>$comb3, 'comb2'=>$comb2, 'comb1'=>$comb1,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Combination  $combination
     * @return \Illuminate\Http\Response
     */
    public function show(Combination $combination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Combination  $combination
     * @return \Illuminate\Http\Response
     */
    public function edit(Combination $combination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Combination  $combination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Combination $combination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Combination  $combination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Combination $combination)
    {
        //
    }

    // 组合
    function combination($a, $m) {
        $r = array();

        $n = count($a);
        if ($m <= 0 || $m > $n) {
            return $r;
        }

        for ($i=0; $i<$n; $i++) {
            $t = array($a[$i]);
            if ($m == 1) {
                $r[] = $t;
            } else {
                $b = array_slice($a, $i+1);
                $c = $this->combination($b, $m-1);
                foreach ($c as $v) {
                    $r[] = array_merge($t, $v);
                }
            }
        }

        return $r;
    }

    public function arrayCompare(/*$in_arraies*/) {
        //in_arraies 所有输入的数组的数组，二维数组，由n个5位数的数组组成
//        $com_array 用于比较的数组，小于或等于5
//        1.取出二维数组中的5位数组进行比较
        set_time_limit(0);
        $results = array();

        $in_arraies = array(array(3,4,7,9,11),array(2,4,5,6,9),array(1,2,3,6,11),array(1,2,4,6,9), array(2,3,5,6,10),
            array(2,4,5,9,10), array(1,2,6,8,10), array(4,5,6,8,11), array(1,4,8,10,11), array(2,4,7,8,10), array(2,4,6,9,10),
            array(2,4,6,8,9), array(2,4,7,9,10,11), array(1,6,7,9,10), array(1,4,8,9,11));
        $com_arraies = array();
        $array = array(1,2,3,4,5,6,7,8,9,10,11);
//        dd($array);

        for ($i = 1; $i <= 5; $i++) {
            $com_arraies = array_merge($com_arraies, $this->combination($array, $i));
        }
//        dd($com_arraies);


        $countInas = count($in_arraies);
        for ($i = 0; $i < count($com_arraies); $i ++) {
            $com_array = $com_arraies[$i];
            $countCom = count($com_array);

            $matchs = array(0,0,0,0,0,0);
            for ($j = 0; $j < $countInas; $j ++) { //com_array与所有输入数组比较
                $in_array = $in_arraies[$j];

                $match_count = 0;
                for ($k = 0; $k < count($com_array); $k++) { //com_array与in_array全面比较
                    $com = $com_array[$k];

                    for ($l = 0; $l < count($in_array); $l++) { //com_array中的一位数字遍历in_array
                        $in = $in_array[$l];
                        if ($com == $in) {
                            $match_count ++;
                            break;
                        }
                    }
                }
                array_splice($matchs, $match_count, 1, $matchs[$match_count] +1);
            }
//            if ($i == 7) dd($matchs);

            for ($m = 1; $m <= $countCom; $m ++ ) {
                $match = $matchs[$m];
                    if ($match == 0) {
                        $result = implode(",", $com_array).'选'.$m;
                        array_push($results, $result);
                    }
                    elseif ($m == $countCom && $match == $countInas) {
                        $result = implode(",", $com_array).'选0';
                        array_push($results, $result);
                    }
//                if (count($results) == 10) dd($matchs);

            }
        }
        return view('compare', ['results' => $results]);

    }
}







//        for ($k = 0; $k < count($com_arraies); $k++) {
//            $com_array = $com_arraies[$k];
//
//            for ($l = 0; $l < count($in_arraies); $l ++) {
//                $in_array = $in_arraies[$l];
////            2.按顺序取出5位数中的1位。$not_match列出一组匹配数的各个位置的匹配结果
////            $not_matchs = array(0, 0, 0, 0, 0);
//                $matchs = array(0, 0, 0, 0, 0, 0); //统计输入的所有数组与某一组合数组匹配数字数量，$matchs每一位，代表com_array和in_array匹配数字的数量
////                if ($k == 3)
////                dd($com_array);
//                for ($j = 0; $j < count($com_array); $j++) {  //
//                    $com = $com_array[$j];
//                    $match_count = 0; // 统计一组输入数与一组组合数比较，有几个相同
//
////                    dd($com_array);
//                    for ($i = 0; $i < count($in_array); $i++) {//                3.按顺序取出比较数组中的1位，与输入的数组中的1位进行比较，如果匹配，$com_array相应位置减1。不匹配，$com_array相应位置加1。
//
//                        $in = $in_array[$i];
//                        if ($in == $com) {
//                            $match_count ++;
//                            break;
//                        }
//                    }
////                    if ($j == count($com_array) -1) {
//                        array_splice($matchs, $match_count, 1, $matchs[$match_count] +1);
////                    }
//
//                    if ($j == 3) dd($matchs);
//                }
////                dd($matchs);
//
//                if ($l == count($in_arraies) -1) {
////                    array_splice($matchs, $match_count, 1, $matchs[$match_count] +1);
////                    if ($matchs[0] == count($com_array)) {
////                        $result = implode(",", $com_array)."选0" ;
////                        array_push($results, $result);
////                    } else
////                    dd($matchs);
//
//
//                        for ($k = 0; $k <= count($com_array); $k++) {
//                            $match = $matchs[$k];
//                            if ($match == 0) { //选择并统计不匹配的个数
////                                dd($matchs);
//
//                                $result = implode(",", $com_array).'选'.$k;
//                                array_push($results, $result);
//
//                                //简化算法
////                                array_push($results, $matchs);
//                                break;
//
//                            }
//                        }
//
//
//
//                    if (count($results) > 1000)
//                        dd($results);
//
//                }
//
////                if ($j == count($in_arraies) -1) {
////                    if ($matchs[0] == count($com_array)) {
////                        $result = implode(",", $com_array) + "选0" ;
////                    } else
////                        for ($k = 1; $k < count($com_array); $k++) {
////                            $match = $matchs[$k];
////                            if ($match == 0) { //选择并统计不匹配的个数
////                                $result = implode(",", $com_array) + "选" + $k;
////                            }
////                        }
////                    array_push($results, $result);
////                }
//            }
//        }