<?php
class PageBlock extends Block
{
    public function run($zym_8)
    {
        $zym_8['section'] = empty($zym_8['section']) ? 4 : $zym_8['section'];
        $zym_8['totalnum'] = empty($zym_8['totalnum']) ? 0 : $zym_8['totalnum'];
        $zym_8['pagesize'] = empty($zym_8['pagesize']) ? 10 : $zym_8['pagesize'];
        $zym_8['pagenum'] = ceil($zym_8['totalnum'] / $zym_8['pagesize']);
        $zym_8['maxpage'] = empty($zym_8['maxpage']) ? $zym_8['pagenum'] : min($zym_8['pagenum'], $zym_8['maxpage']);
        $zym_8['minpage'] = empty($zym_8['minpage']) ? 1 : $zym_8['minpage'];
        $zym_8['page'] = empty($zym_8['page']) ? min($zym_8['maxpage'], max($zym_8['minpage'], I('get.page', 'int', 1))) : $zym_8['page'];
        $zym_9['num'] = array();
        if ($zym_8['page'] == $zym_8['minpage']) {
            $zym_9['first'] = array('num' => 1, 'status' => 1);
            $zym_9['prev'] = array('num' => 1, 'status' => 1);
        } else {
            $zym_9['first'] = array('num' => 1, 'status' => 0);
            $zym_9['prev'] = array('num' => $zym_8['page'] - 1, 'status' => 0);
        }
        if ($zym_8['page'] == $zym_8['maxpage']) {
            $zym_9['last'] = array('num' => $zym_8['maxpage'], 'status' => 1);
            $zym_9['next'] = array('num' => $zym_8['maxpage'], 'status' => 1);
        } else {
            $zym_9['last'] = array('num' => $zym_8['maxpage'], 'status' => 0);
            $zym_9['next'] = array('num' => $zym_8['page'] + 1, 'status' => 0);
        }
        $zym_6 = $zym_8['page'] - $zym_8['section'];
        if ($zym_6 >= $zym_8['minpage']) {
            $zym_5 = $zym_8['page'] + $zym_8['section'];
            if ($zym_5 > $zym_8['maxpage']) {
                $zym_5 = $zym_8['maxpage'];
                $zym_6 = $zym_8['maxpage'] - 2 * $zym_8['section'];
                $zym_6 = $zym_6 < $zym_8['minpage'] ? $zym_8['minpage'] : $zym_6;
            }
        } else {
            $zym_6 = $zym_8['minpage'];
            $zym_5 = $zym_8['minpage'] + 2 * $zym_8['section'];
            $zym_5 = $zym_5 > $zym_8['maxpage'] ? $zym_8['maxpage'] : $zym_5;
        }
        for ($zym_7 = $zym_6; $zym_7 <= $zym_5; $zym_7++) {
            $zym_9['num'][] = array('num' => $zym_7, 'status' => $zym_7 == $zym_8['page'] ? 1 : 0);
        }
        $zym_9['totalnum'] = $zym_8['totalnum'];
        $zym_9['page'] = $zym_8['page'];
        $zym_9['pagenum'] = $zym_8['pagenum'];
        $zym_9['pagesize'] = $zym_8['pagesize'];
        return $zym_9;
    }
}
?>