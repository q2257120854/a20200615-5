<?php defined('PT_ROOT') || exit('Permission denied');?>
			<ul class="ul-odr">
                <?php $list=$this->pt->block->getdata('chapterlist',array('novelid'=>$novel['id']));?>
                <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>			
                <li><a href="<?php echo $loop['url_read'];?>"><span><?php echo $loop['name'];?></span><i class="icon icon-free">阅读</i></a></li>
               <?php endforeach; endif;?>
			</ul>
            
			<ul class="ul-rvt">
                <?php $list=$this->pt->block->getdata('chapterlist',array('novelid'=>$novel['id'],'sort'=>'desc'));?>
                <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>			
                <li><a href="<?php echo $loop['url_read'];?>"><span><?php echo $loop['name'];?></span><i class="icon icon-free">阅读</i></a></li>
               <?php endforeach; endif;?>
			</ul>

