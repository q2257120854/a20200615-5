{include file="public/head.tpl" hostname='我的工单'}

<div class="container-fluid u-pt-medium">
    <div class="page-content col-12">
        <div class="c-card u-mb-medium">
            <div class="c-card__head">
                 <h5 class="c-card__title">我的工单</h5>

            </div>
            <div class="table-container clearfix">
                <div id="tableTicketsList_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="listtable">
  
                        <table id="tableTicketsList" class="table table-list dataTable no-footer dtr-inline" aria-describedby="tableTicketsList_info" role="grid" style="width: 0px;">
                            <thead>
                                <tr role="row">
                                    <th style="text-align: left; padding-left: 30px; width: 0px;" class="sorting">{$lang['日期']}</th>
                                    
                                    <th class="sorting"  style="width: 0px;">{$lang['主题']}</th>
                                    <th class="sorting"  style="width: 0px;">{$lang['状态']}</th>
                                    <th class="sorting_desc" style="width: 0px;">{$lang['最近更新']}</th>
                                </tr>
                            </thead>
                            <tbody>
                                    {foreach from=$tickets item=ticket}
                    				<tr class="odd">
                                      <td><i class="fa fa-calendar"></i>&nbsp;<a href="{$ROOT}/ticket/detailed/{$ticket['id']}/">{$ticket['提交时间']}</a></td>
                                      <td><a href="{$ROOT}/ticket/detailed/{$ticket['id']}/">{$ticket['主题']}</a></td>
                                      <td><a href="{$ROOT}/ticket/detailed/{$ticket['id']}/">{$lang[$ticket['状态']]}</a></td>
                                      <td><a href="{$ROOT}/ticket/detailed/{$ticket['id']}/">{$ticket['最后时间']}</a></td>
                                    </tr>
                    				{/foreach}
                    				
                            </tbody>
                        </table>
                    </div>
                    <div class="dataTables_paginate paging_simple_numbers" id="tableTicketsList_paginate">
                        <ul class="pagination">
                            <li class="paginate_button previous disabled" aria-controls="tableTicketsList" tabindex="0" id="tableTicketsList_previous"><a href="{$t['上一页连接']}">上一页</a>
                            </li>
                            <li class="paginate_button next disabled" aria-controls="tableTicketsList" tabindex="0" id="tableTicketsList_next"><a href="{$t['下一页连接']}">下一页</a>
                            </li>
                        </ul>
                    </div>
                    <div class="dataTables_length" id="tableTicketsList_length">
                        <label>{$lang['总共']}:{$t['总页数']}{$lang['页']} {$lang['当前']}:{$t['当前页数']}{$lang['页']}</label>
                    </div>
                </div>
                <div class="text-center hidden" id="tableLoading">
                    <p><i class="fa fa-spinner fa-spin"></i> 加载中...</p>
                </div>
            </div>
        </div>
    </div>
</div>{include file="public/foot.tpl"}