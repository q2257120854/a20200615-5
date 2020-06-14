<?php
class User_MarkModel extends Model {
{
    public function getvotenum($zym_8) {
        $zym_17 = 0;
        foreach ($zym_8 as $zym_9 => $zym_22) {
            $zym_6 = $this->get('novelsearch_info', $zym_9);
            if (isset($zym_6['novel']['name']) && $zym_6['last']['id'] > $zym_22) {
                $zym_17++;
            }
        }
        return $zym_17;
    }
    public function adduservote()
        {
            $uid = $_SESSION['uid'];
            $article_id = I('get.novelid', 'int', '0');//书本ID
            $initial_quantity = C('THANKED_INITIAL_QUANTITY');//点赞初始数量
            $customer_logic=new CustomerLogic();
            $result = $customer_logic->addLogic($uid, $article_id);//点赞逻辑方法
            if ($result['status'] == -1) {
                exit(json_encode($result));
            }
            if ($result['status'] == -2) {
                $data            = $result['result'];
                $del_where['id'] = $data['id'];
                $del             = $this->db->where($del_where)->delete();//删除
                if ($del) {
                    $thanked_number = ThankedCount($article_id, 1, $initial_quantity);
                    exit(json_encode(array('status' => 2, 'msg' => '取消点赞成功', 'thanked_number' => $thanked_number)));
                }
            }
            if ($article_id != null) {
                $db_data['all_ids']     = $article_id;
                $db_data['category_id'] = 3;
            }
            $db_data['user_id']     = $uid;
            $db_data['create_time'] = date('Y-m-d H:i:s');
            $add                    = $this->db->data($db_data)->add();
            if ($add) {
                $thanked_number = ThankedCount($article_id, 1, $initial_quantity);
                exit(json_encode(array('status' => 1, 'msg' => '点赞成功', 'thanked_number' => $thanked_number)));
            } else {
                exit(json_encode(array('status' => -404, 'msg' => '您的网络出现故障或我们服务器正在维修')));
            }
        }
}