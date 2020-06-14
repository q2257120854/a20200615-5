<?php defined('PT_ROOT') || exit('Permission denied');?><!-- 0 页面编码 -->
<div class="pt-set-info">
    <div class="line">
        <b><?php echo $rulename;?>：</b>
        <div style="display:inline-block;">
            <label>
                <label><textarea class="input-box w640 h75" ng-model="rule.<?php echo $rulekey;?>.rule"></textarea></label>
                <?php if(!empty($ruledesc)):?><br/><span class="Validform_checktip"><?php echo $ruledesc;?></span><?php endif;?>
            </label><br />
            <div style="height:<?php echo defaultvar($ruletype,'30','60');?>px;line-height:30px;margin-top:5px;">
                <?php if($ruletype==1):?>
                <label><input type="checkbox" ng-model="rule.<?php echo $rulekey;?>.ignorecase" ng-true-value="'1'"/>不区分大小写</label>
                <label><input type="checkbox" ng-model="rule.<?php echo $rulekey;?>.singleline" ng-true-value="'1'"/>单行模式</label><br />
                页面采集参数：<?php endif;?>
                页面编码：
                <label>
                    <select class="input-box" ng-model="rule.<?php echo $rulekey;?>.charset">
                        <option value="auto">自动判断</option>
                        <option value="utf-8">UTF-8</option>
                        <option value="gbk">GBK系列</option>
                    </select>
                </label>
                <input class="btn btn-primary btn-sm" type="button" value=" 页面错误标识 " ng-click="showerror('<?php echo $rulekey;?>')"/>
                <input class="btn btn-primary btn-sm" type="button" value=" 内容替换规则 " ng-click="showreplace('<?php echo $rulekey;?>')"  ng-hide="replace.<?php echo $rulekey;?> == 1"/>
                <input class="btn btn-default btn-sm" type="button" value=" 隐藏替换规则 " ng-click="hidereplace('<?php echo $rulekey;?>')"  ng-show="replace.<?php echo $rulekey;?> == 1"/>
                <input class="btn btn-success btn-sm" type="button" value=" 添加替换" ng-click="addreplace('<?php echo $rulekey;?>')"  ng-show="replace.<?php echo $rulekey;?> == 1"/>
            </div>
            <div class="ulli-list-table rule-replace" ng-show="replace.<?php echo $rulekey;?> == 1">
                <ul class="head">
                    <li class="w1">要替换的内容</li>
                    <li class="w1">替换后</li>
                    <li class="w2">参数</li>
                    <li class="w2">操作</li>
                </ul>
                <ul ng-repeat="list in rule.<?php echo $rulekey;?>.replace track by $index">
                    <li class="w1 f-tal">{{list.search}}&nbsp;</li>
                    <li class="w1 f-tal">{{list.replace}}&nbsp;</li>
                    <li class="w2">
                        <span class="label label-success" ng-show="list.type==1">正</span>
                        <span class="label label-success" ng-show="list.ignorecase==1">全</span>
                        <span class="label label-success" ng-show="list.singleline==1">单</span>&nbsp;
                    </li>
                    <li class="w2">
                        <a ng-click="editreplace('<?php echo $rulekey;?>',$index)"><i class="icon icon-edit"></i>编辑</a>
                        <a ng-click="delreplace('<?php echo $rulekey;?>',$index)"><i class="icon icon-trash"></i>删除</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>