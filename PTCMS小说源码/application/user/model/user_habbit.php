<?php
class User_HabbitModel extends Model {
    protected $default = ['pc' => '[]', 'wap' => '{"fontsize":16,"moon":0,"theme":"default","cache":5,"style":1}', 'app' => '[]', ];
    public function load($zym_7, $zym_6 = 'wap') {
        if (!in_array($zym_6, ['wap', 'pc', 'app'])) {
            return [];
        }
        if ($zym_7) {
            $zym_9 = $this->where(['userid' => $zym_7])->getfield($zym_6);
            if ($zym_9 === null) {
                $zym_5 = array_merge(['userid' => $zym_7], $this->default);
                $this->insert($zym_5);
                $zym_9 = $zym_5[$zym_6];
            }
        } else {
            $zym_9 = $this->default[$zym_6];
        }
        return (array)json_decode($zym_9);
    }
    public function loadreader($zym_7) {
        if ($zym_8 = $this->cookie->get('reader')) {
            return json_decode($zym_8, true);
        } else {
            return $this->load($zym_7, 'wap');;
        }
    }
    public function save($zym_7, $zym_9, $zym_6 = 'wap') {
        $zym_5 = $this->load($zym_7, $zym_6);
        $zym_5 = array_merge($zym_5, $zym_9);
        $this->cookie->set('reader', json_encode($zym_5));
        if ($zym_7) {
            return $this->where(['userid' => $zym_7])->update([$zym_6 => json_encode($zym_5) ]);
        }
    }
}
?>
