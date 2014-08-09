<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-globe"></i>自选股详情表</div>
		<div class="actions">
			<div class="btn-group">
				<a class="btn default" href="#" data-toggle="dropdown">
				自定义列	
				<i class="fa fa-angle-down"></i>
				</a>
				<div id="stock_detail_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
					<label><input type="checkbox" checked data-column="0">名称</label>
					<label><input type="checkbox" checked data-column="1">代码</label>
					<label><input type="checkbox" checked data-column="2">最新价</label>
					<label><input type="checkbox" checked data-column="3">涨跌额</label>
					<label><input type="checkbox" checked data-column="4">涨跌幅</label>
					<label><input type="checkbox" checked data-column="5">昨收/今开盘</label>
					<label><input type="checkbox" checked data-column="6">最高/最低价</label>
					<label><input type="checkbox" checked data-column="7">成交量</label>
					<label><input type="checkbox" checked data-column="8">市值</label>
					<label><input type="checkbox" checked data-column="9">市盈率</label>
					<label><input type="checkbox" checked data-column="10">盘前价格</label>
					<label><input type="checkbox" checked data-column="11">盘前涨跌幅</label>
				</div>
			</div>
		</div>
	</div>
	<div class="portlet-body">
		<table class="table table-hover table-full-width " id="stock_detail_table">
			<thead>
				<tr>
					<th>名称</th>
					<th>代码</th>
					<th>最新价</th>
					<th>涨跌额</th>
					<th>涨跌幅(%)</th>
					<th>昨收/今开盘</th>
					<th>最高/最低价</th>
					<th>成交量(万)</th>
					<th>市值(亿)</th>
					<th>市盈率</th>
					<th>盘前价格</th>
					<th>盘前涨跌幅(%)</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($price_details as $id=>$v) {?>
				<tr id='stock_<?php echo $v['lower_id'];?>' data-id='<?php echo $v['lower_id'];?>' class="stock_line <?php if($v['real_price_change_amount']>0) echo 'danger'; else if($v['real_price_change_amount']<0) echo 'success'; else echo 'active'; ?>">
					<td class='stock_detail_name'><?php echo htmlspecialchars($v['name']);?></td>
					<td class='stock_detail_upper_id'><?php echo htmlspecialchars($v['upper_id']);?></td>
					<td class='stock_detail_real_price'><?php echo htmlspecialchars($v['real_price']);?></td>
					<td class='stock_detail_real_price_change_amount'><?php echo htmlspecialchars($v['real_price_change_amount']);?></td>
					<td class='stock_detail_real_price_change_rate'><?php echo htmlspecialchars($v['real_price_change_rate']);?></td>
					<td class='stock_detail_yesterday_close_price'><?php echo htmlspecialchars($v['yesterday_close_price'])."/".htmlspecialchars($v['start_price']);?></td>
					<td class='stock_detail_highprice_today'><?php echo htmlspecialchars($v['highprice_today'])."/".htmlspecialchars($v['lowerprice_today']);?></td>
					<td class='stock_detail_real_share_amount'><?php echo htmlspecialchars(round($v['real_share_amount']/10000,2));?></td>
					<td class='stock_detail_market_cap'><?php echo htmlspecialchars(round($v['market_cap']/100000000,2));?></td>
					<td class='stock_detail_PE'><?php echo htmlspecialchars($v['PE']);?></td>
					<td class='stock_detail_after_hour_price'><?php echo htmlspecialchars($v['after_hour_price']);?></td>
					<td class='stock_detail_after_hour_price_change_rate'><?php echo htmlspecialchars($v['after_hour_price_change_rate']);?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>

<!--
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
-->

<script type="text/javascript" src="/js/remoteApi.js" ></script>
<link rel="stylesheet" href="/css/self_stock_detail.css" />
<link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css" />
<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
<script>
	jQuery(document).ready(function() {       
		// 表结构
	    var oTable = $('#stock_detail_table').dataTable( {           
	        "sDom" : "<'row'<'col-md-5 col-sm-12'i>r>t<'row'<'col-md-5 col-sm-12'><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
	        "aoColumnDefs": [
	        	{'bSortable': false, 'aTargets': [5] },
	        	{'bSortable': false, 'aTargets': [6] }
	        ],
	        //"sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-12 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
	    	"sScrollY": "390px",
	    	"sScrollX": "100%",
	    	"bScrollCollapse": true,
	        "bProcessing": true, // 打开处理中标签
            "aaSorting": [[4, 'asc']], // 默认第二列排序
            "bPaginate": false, // 关闭翻页
	        "oLanguage": {
            	"sProcessing": '<i class="fa fa-coffee"></i>&nbsp;Please wait...',
            	'sInfo' : '您关注了<strong>_TOTAL_</strong>只股票',
            	'sZeroRecords':'您还没有关注任何一只股票'
        	}
        });

        //jQuery('#sample_2_wrapper .dataTables_filter input').addClass("form-control input-small"); // modify table search input
        //jQuery('#sample_2_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        //jQuery('#sample_2_wrapper .dataTables_length select').select2(); // initialize select2 dropdown

        $('#stock_detail_column_toggler input[type="checkbox"]').change(function(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });

        // 更新股票板块的颜色
        var COLORS = ['danger','green','active']; // up down nochange
        function freshStockColor(content,stockInfo) {
            content.removeClass(COLORS[0]); 
            content.removeClass(COLORS[1]); 
            content.removeClass(COLORS[2]); 
            if(stockInfo.real_price>stockInfo.yesterday_close_price) color = COLORS[0];
            else if(stockInfo.real_price<stockInfo.yesterday_close_price) color = COLORS[1];
            else color = COLORS[2]
            //console.log(stockInfo.real_price,stockInfo.yesterday_close_price,stockInfo.real_price>stockInfo.yesterday_close_price,COLORS,color)
            content.addClass(color); 
        }

        // 刷新数据
        stockinfo_lock = false;
        function getStockInfo() {
            if(stockinfo_lock) return;
            stockinfo_lock=true;
            getparams = '';
            $("#stock_detail_table .stock_line").each(function(index) {
                getparams += "gb_"+$(this).data("id")+",";
            });
            if(getparams.length==0) {
                stockinfo_lock=false;
                return;
            }
            // 获取sina股票信息
            RemoteApi.jsapiCrossDomain("http://hq.sinajs.cn/?list="+getparams, function(){
                // 更新market信息
                $("#stock_detail_table .stock_line").each(function() {
                    id = $(this).data("id");
                    stockInfo = RemoteApi.getSinaStockDetail(id);
                    // 右侧栏
                    $(this).find(".stock_detail_name").html(stockInfo.name);
                    $(this).find(".stock_detail_upper_id").html(stockInfo.upper_id);
                    $(this).find(".stock_detail_real_price").html(stockInfo.real_price);
                    $(this).find(".stock_detail_real_price_change_amount").html(stockInfo.real_price_change_amount);
                    $(this).find(".stock_detail_real_price_change_rate").html(stockInfo.real_price_change_rate);
                    $(this).find(".stock_detail_yesterday_close_price").html(stockInfo.yesterday_close_price+"/"+stockInfo.start_price);
                    $(this).find(".stock_detail_highprice_today").html(stockInfo.highprice_today+"/"+stockInfo.lowerprice_today);
                    $(this).find(".stock_detail_real_share_amount").html((parseFloat(stockInfo.real_share_amount)/10000).toFixed(2));
                    $(this).find(".stock_detail_market_cap").html((parseFloat(stockInfo.market_cap)/100000000).toFixed(2));
                    $(this).find(".stock_detail_PE").html(stockInfo.PE);
                    $(this).find(".stock_detail_after_hour_price").html(stockInfo.after_hour_price);
                    $(this).find(".stock_detail_after_hour_price_change_rate").html(stockInfo.after_hour_price_change_rate);
                    freshStockColor($(this),stockInfo);
                });

            })
            stockinfo_lock=false;
        }
        setInterval(getStockInfo,2000)
	});
</script>


