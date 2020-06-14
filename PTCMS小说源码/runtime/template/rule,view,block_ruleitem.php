<?php defined('PT_ROOT') || exit('Permission denied');?><div class="pt-set-info">
    <div class="line">
        <b><?php echo $rulename;?>：</b>
        <div style="display: inline-block">
            <div>
                <label><textarea class="input-box w640 h75" ng-model="rule.<?php echo $rulekey;?>.rule"></textarea></label>
            </div>
            <div style="height:30px;line-height:30px;margin-top:5px;">
                <label><input type="checkbox" ng-model="rule.<?php echo $rulekey;?>.ignorecase" ng-true-value="'1'"/>不区分大小写</label>
                <label><input type="checkbox" ng-model="rule.<?php echo $rulekey;?>.singleline" ng-true-value="'1'"/>单行模式</label>
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