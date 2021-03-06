<?php
class novelsimilarblock extends Block {
    public function run($zym_12) {
        $zym_9 = I('novelname', 'str', '', $zym_12);
        $zym_8 = I('num', 'int', 10, $zym_12) + 1;
        $zym_7 = pt_strlen($zym_9);
        $zym_14 = $zym_5 = array();
        for ($zym_13 = $zym_7; $zym_13 > 0; $zym_13--) {
            $zym_15 = truncate($zym_9, $zym_13, '');
            $zym_6 = m('novelsearch_info')->where(array(
                'name' => array(
                    'like',
                    $zym_15 . '%'
                ) ,
                'status' => 1
            ))->getField('id', true);
            if (is_array($zym_6) and count($zym_6) > 0) {
                $zym_5 = array_unique(array_merge($zym_5, $zym_6));
                if (count($zym_5) >= $zym_8) {
                    break;
                }
            }
        }
        shuffle($zym_5);
        foreach ($zym_5 as $zym_10) {
            $zym_11 = dc::get('novelsearch_info', $zym_10);
            if ($zym_11['novel']['name'] == $zym_9) continue;
            $zym_14[] = $zym_11;
        }
        $zym_14 = array_slice($zym_14, 0, $zym_8 - 1);
        return $zym_14;
    }
}
?>
