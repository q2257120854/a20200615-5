<?php
class downlistblock extends Block
{
    public function run($zym_10)
    {
        $zym_8 = $this->pt->input->param('novelid', 'int', 0, $zym_10);
		$type = $zym_10['type']?$zym_10['type']:0;
        if (!$zym_8)  {
          return array();
        }
            $zym_9 = $this->pt->model('novelsearch_down')->getolist($zym_8, $type);       
        return $zym_9;
    }
}
