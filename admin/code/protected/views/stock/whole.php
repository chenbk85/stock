<div class='row'>
<div class="col-md-12">
<form class="form-inline stocksearch" role="form" action="/stock/whole" method="post">
	<div class="form-group ">
		<label class="sr-only" for="">股票代码</label>
		<input type="text" class="form-control stockinput" id="" name="ids" placeholder="输入股票代码">
        <span class="help-block">例如：PLUG,qihu,tsla,yy,bldp,fcel,scty,ccih,zbb,wbai</span>
	</div>
	<button  type="submit" class="btn btn-default blue sub_search">批量选股</button>
</form>						
</div>
</div>
<hr>



<!--BEGIN MAIN CONENT-->
<div class='row' style="position:relative;">
<div class="col-md-12">
<div class='row'>
<!--BEGIN LEFT CONENT-->
<div id="stock_pan">
<?php foreach($price_details as $id=>$v) {?>
<!--BEGIN ONE STOCK-->
<div class='row' id='stock_content_<?php echo htmlspecialchars($id);?>'> <div class="col-md-12">
<div class="portlet box stockportlet <?php if($v['real_price_change_amount']<0) echo Yii::app()->params['colors'][1]; elseif($v['real_price_change_amount']==0) echo Yii::app()->params['colors'][2]; else echo Yii::app()->params['colors'][0];?>">
	<div class="portlet-title" data-id="<?php echo htmlspecialchars($id);?>">
		<div class="caption">
            <i class="fa fa-reorder"></i>
            <span class="stockname"><?php echo htmlspecialchars($v['name']);?>(<?php echo htmlspecialchars(($id));?>)</span>&nbsp&nbsp
            <small class='stockdata'><?php echo htmlspecialchars($v['real_price'])."&nbsp&nbsp".htmlspecialchars($v['real_price_change_amount'])."&nbsp&nbsp(".htmlspecialchars($v['real_price_change_rate'])."%)";?> </small>
        </div>
		<div class="tools">
			<a href="" class="expand portletarrow"></a>
			<a href="" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
        <div class="portlet">
        <div class='row'> 
            <div class="stock_flash_div">
            <object type="application/x-shockwave-flash" data="http://i1.sinaimg.cn/cj/yw/flash/us0106wsa.swf" class="stock_flash"  >
                <param name="allowFullScreen" value="true">
                <param name="allowScriptAccess" value="always"><param name="wmode" value="transparent">
                <param name="freq" value="30">
                <param name="flashvars" value="symbol=usr_<?php echo htmlspecialchars($id);?>&amp;lastfive=50000">
            </object>
            </div> 
            <div class="stock_detail_div">
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">实时行情</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        <div class="hq_details" id="hqDetails">
                            <div class='after_hour_info'>
                                <span class='after_hour_head'> 盘后 </span>
                                <span class='after_hour_content'></span>
                            </div>
                            <table  border="0" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="b_right">详细行情</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>开盘：</th>
                                        <td class="detail_start_price" ><?php echo htmlspecialchars($v['start_price'])?></td>
                                        <th>前收盘：</th>
                                        <td class="b_right detail_yesterday_close_price"><?php echo htmlspecialchars($v['yesterday_close_price'])?></td>
                                    </tr>
                                    <tr>
                                        <th>成交量：</th>
                                        <td class="detail_real_share_amout"><?php echo htmlspecialchars(number_format($v['real_share_amount']/10000,2,'.',''))?>万</td>
                                        <th>区间：</th>
                                        <td class="b_right detail_price_interval"><?php echo htmlspecialchars($v['lowerprice_today'])?>-<?php echo htmlspecialchars($v['highprice_today'])?></td>
                                    </tr>
                                    <tr>
                                        <th>10日均量：</th>
                                        <td class="detail_stock_amount_10day"><?php echo htmlspecialchars(number_format($v['stock_amount_10day']/10000,2,'.',''))?>万</td>
                                        <th>52周区间：</th>
                                        <td class="b_right detail_price_interval_52week"><?php echo htmlspecialchars($v['lowerprice_52week'])?>-<?php echo htmlspecialchars($v['highprice_52week'])?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table border="0" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="space_left">基本面摘要</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="space_left" title="股价/每股收益TTM">市盈率：</th>
                                        <td class="detail_pe"><?php echo htmlspecialchars($v['PE'])?></td>
                                        <th>市值：</th>
                                        <td class="detail_market_cap"><?php if($v['market_cap']>100000000) echo number_format($v['market_cap']/100000000,2,'.','')."亿"; else echo number_format($v['market_cap']/10000,2,'.','')."万";?></td>
                                    </tr>
                                    <tr>
                                        <th class="space_left" title="每股收益：最近12个月的每股收益">每股收益：</th>
                                        <td class="detail_earning_per_share"><?php echo htmlspecialchars($v['earning_per_share'])?></td>
                                        <th>股本：</th>
                                        <td class="detail_capitalization"><?php if($v['capitalization']>100000000) echo number_format($v['capitalization']/100000000,2,'.','')."亿"; else echo number_format($v['capitalization']/10000,2,'.','')."万";?></td>
                                    </tr>
                                    <tr>
                                        <th class="space_left">贝塔系数：</th>
                                        <td>--</td>
                                        <th>股息/收益率：</th>
                                        <td>--/--</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
</div> </div>
<!--END ONE STOCK-->
<?php } ?>
</div>
<!--END LEFT CONENT-->

<!--BEGIN RIGHT CONENT-->
<div class="stock_right_sidebar">

</div> 
<!--END RIGHT CONENT-->
</div>
</div> 

<div id="sidebar">
<div id="sidebar_portlet" class=" portlet box grey">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i>选股组合</div>
        <div class="actions">
            <!--
            <div class="btn-group">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                Small button <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>
        -->
        </div>
    </div>
    <div class="portlet-body" >
        <!--add elem to stock group-->
        <!--<div id="sidebar_addstock_button" class="btn btn-block blue">
            <span class=""><i class="fa fa-plus"></i></span>
        </div>
        -->
        <div  class='sidebar_addstock_input input-group add_group_elem_div'> 
            <input id="suggestInputSearch" value='' type='text' class='form-control' placeholder='拼音/代码/名称'>
            <span class='input-group-btn'>
            <button class='btn blue groupadd_confirm' type='button'>增加</button>
            </span> 
        </div>
        <div>
            <!--sort: no up down-->
            <button style="" class='btn blue sort_btn' data-sort="no" type='button'><i class="iconfont sort_btn_img_left">&#983407;</i><i class="iconfont sort_btn_img_right">&#983408;</i></button>
        </div>
        <div class="scroller sidebar_scoller"  data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
            <ul id="sortable" style="padding:2px">
                <?php foreach($price_details as $id=>$v) {?>
                <li data-id="<?php echo htmlspecialchars($id)?>" class="sidebar_stock_block btn btn-block <?php if($v['real_price_change_amount']<0) echo Yii::app()->params['colors'][1]; elseif($v['real_price_change_amount']==0) echo Yii::app()->params['colors'][2]; else echo Yii::app()->params['colors'][0];?>">
                    <span class="stockname"><?php echo htmlspecialchars($v['name']);?></span>
                    <small class="stockprice"><?php echo htmlspecialchars($v['real_price']);?></small>
                    <small class="stockrate"><?php echo "(".htmlspecialchars($v['real_price_change_rate'])."%)"?></small>
                    <i class="stock_block_remove iconfont">&#983219;</i>
                    <small class="clearfix"></small>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<!--BEGIN CONTROL PANEL-->
<?php if(!empty($price_details)) {?>
<div >
    <button id="open_all_stock_panel" class="btn btn-default blue ">全部展开</button>
    <button id="close_all_stock_panel" class="btn btn-default blue ">全部关闭</button>
    <button id="page_go_top" type="button" class="btn btn-default blue"><i class="iconfont">&#983315;</i></button>

</div>
<?php }?>
<!--END CONTROL PANEL-->
</div> 
</div>
<!--END MAIN CONENT-->

<script src="http://vip.stock.finance.sina.com.cn/usstock/fusioncharts/Code/FusionCharts/FusionCharts.js" type="text/javascript"></script>   
<script type="text/javascript" src="/js/suggestFromSina.js"></script>
<script type="text/javascript"> 

    jQuery(document).ready(function() {    
        // common
        // 股票查询串cookie
        function saveUserQueryCookie() {
            val = $(".stockinput").val();
            $.cookie("stock_user_query",val,{ expires: 365 });
        }
        // 访问sina接口
        function jsonp(src, cb) {
            var script = document.createElement('script'),
                s = document.getElementsByTagName("head")[0];

            script.onreadystatechange = script.onload = function () {
                if (!script.readyState || /loaded|complete/i.test(script.readyState)) {
                    script.onreadystatechange = script.onload = null;
                    script.parentNode.removeChild(script);

                    cb();
                }
            };

            script.type = 'text/javascript';
            script.class = 'nouse';
            s.appendChild(script);
            script.src = src;
        }

        // 格式化数字为万，亿单位
        function formateAmount(str) {
            if(isNaN(str)) return str;
            if(str>100000000) return (parseFloat(str)/100000000).toFixed(2)+"亿";
            else if(str>10000)  return (parseFloat(str)/10000).toFixed(2)+"万";
            else return str;
        }

        // 更新股票板块的颜色
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


        // id stockid 如qihu, in 结果
        function splitSinaStockInfo(id) {
            seg1 = eval("hq_str_gb_"+id);
            if(seg1.length==0) return false;
            seg2 = seg1.split(",");
            if(seg2.length<5) {
                // error
                return false;
            }
            return {
                'lower_id' : id.toLowerCase(),
                'upper_id' : id.toUpperCase(),
                'name' : seg2[0],
                'real_price' : parseFloat(seg2[1]),
                'real_price_change_rate' : parseFloat(seg2[2]),
                'real_time' : seg2[3],
                'real_price_change_amount' : parseFloat(seg2[4]),
                'start_price' : parseFloat(seg2[5]),
                'highprice_today' : parseFloat(seg2[6]),
                'lowerprice_today' : parseFloat(seg2[7]),
                'highprice_52week' : parseFloat(seg2[8]),
                'lowerprice_52week' : parseFloat(seg2[9]),
                'real_share_amount' : parseInt(seg2[10]),
                'stock_amount_10day' : parseInt(seg2[11]),
                'market_cap' : parseFloat(seg2[12]),
                'earning_per_share' : parseFloat(seg2[13]),
                'PE' : seg2[14],
                't1' : seg2[15],
                't2' : seg2[16],
                't3' : seg2[17],
                't4' : seg2[18],
                'capitalization' : parseFloat(seg2[19]),
                't5' : seg2[20],
                'after_hour_price' : parseFloat(seg2[21]),
                'after_hour_price_change_rate' : parseFloat(seg2[22]),
                'after_hour_price_change_amount' : parseInt(seg2[23]),
                'close_time' : seg2[24],
                'after_hour_time' : seg2[25],
                'yesterday_close_price' : parseFloat(seg2[26]),
                'after_hour_share_amount' : parseInt(seg2[27])
            };
        }

        // 空股票详情板块
        function getEmptySockDetailPanel(id) {
            afterhour = "<div class='after_hour_info'><span class='after_hour_head'> 盘后 </span><span class='after_hour_content'></span></div>";
            content = "<div class='row' id='stock_content_"+id+"'> <div class='col-md-12'> " +
                "<div class='portlet box stockportlet "+COLORS[2]+"'>" +
                "<div class='portlet-title' data-id='"+id+"'>" +
                "<div class='caption'>" +
                "<i class='fa fa-reorder'></i><span class='stockname'></span>&nbsp&nbsp " +
                "<small class='stockdata'></small></div>" +

                "<div class='tools'> <a href='' class='expand portletarrow'></a> <a href='' class='remove'></a> </div> </div>" +
                "<div class='portlet-body'> <div class='portlet'> <div class='row'> <div class='stock_flash_div'>" +
                "<object type='application/x-shockwave-flash' data='http://i1.sinaimg.cn/cj/yw/flash/us0106wsa.swf' class='stock_flash'  >" +
                "<param name='allowFullScreen' value='true'> <param name='allowScriptAccess' value='always'><param name='wmode' value='transparent'> <param name='freq' value='30'> <param name='flashvars' value='symbol=usr_"+id+"&amp;lastfive=50000'>" +
                "</object> </div>" +
                "<div class='stock_detail_div'> <div class='tabbable-custom '> <ul class='nav nav-tabs '> <li class='active'><a href='#tab_5_1' data-toggle='tab'>实时行情</a></li>  </ul>" +
                "<div class='tab-content'> " +
                        "<div class='tab-pane active' id='tab_5_1'>" +
                        "<div class='hq_details' id='hqDetails'>"+
                            afterhour +
                            "<table  border='0' cellpadding='0' cellspacing='0'>"+
                                "<thead> <tr> <th colspan='4' class='b_right'>详细行情</th> </tr></thead>" +
                                "<tbody>" +
                                    "<tr> <th>开盘：</th> <td class='detail_start_price' ></td> <th>前收盘：</th> <td class='b_right detail_yesterday_close_price'></td> </tr>" +
                                    "<tr> <th>成交量：</th> <td class='detail_real_share_amout'></td> <th>区间：</th> <td class='b_right detail_price_interval'></td> </tr>"+
                                    "<tr> <th>10日均量：</th> <td class='detail_stock_amount_10day'></td> <th>52周区间：</th> <td class='b_right detail_price_interval_52week'></td> </tr>"+
                                "</tbody>" +
                            "</table> <hr>"+
                            "<table border='0' cellpadding='0' cellspacing='0'>"+
                                "<thead> <tr> <th colspan='4' class='space_left'>基本面摘要</th> </tr> </thead>" +
                                "<tbody> <tr> <th class='space_left' title='股价/每股收益TTM'>市盈率：</th> <td class='detail_pe'></td> <th>市值：</th> <td class='detail_market_cap'></td> </tr>"+
                                    "<tr> <th class='space_left' title='每股收益：最近12个月的每股收益'>每股收益：</th> <td class='detail_earning_per_share'></td> <th>股本：</th> <td class='detail_capitalization'></td> </tr>"+
                                    "<tr> <th class='space_left'>贝塔系数：</th> <td>--</td> <th>股息/收益率：</th> <td>--/--</td> </tr>"+
                                "</tbody>"+
                            "</table> </div> </div>"+
                    "</div> </div> </div> </div> </div> </div> </div> </div> </div>";
                    return content;
        }
        function getMultiEmptySockDetailPanel(ids) {
            content = "";
            for(x in ids) {
                content += getEmptySockDetailPanel(ids[x].id);
            }
            return content;
        }

        // 获取右侧栏空股票模块
        function getEmptySockBlock(id) {
            newblock = '<li data-id="'+id+'"class="sidebar_stock_block btn btn-block '+COLORS[2]+'">' +
            '<span class="stockname"></span> ' +
            '<small class="stockprice"></small>' +
            '<small class="stockrate"></small>' +
            '<i class="stock_block_remove iconfont">&#983219;</i>'+
            '<small class="clearfix"></small>' +
            '</li>';
            return newblock
        }
        function getMultiEmptySockBlock(ids) {
            content = "";
            for(x in ids) {
                content += getEmptySockBlock(ids[x].id);
            }
            return content;
        }

        // ---------------------------------------common data------------------------------
        // 颜色变量
        var COLORS = ['<?php echo Yii::app()->params["colors"][0]?>','<?php echo Yii::app()->params["colors"][1]?>','<?php echo Yii::app()->params["colors"][2]?>']; // up down nochange
        var DEFAULT_STOCKBLOCK = $("#sidebar #sortable ul").html();
        var DEFAULT_STOCKPAN = $("#stock_pan").html();



        // ----------------------------------股票查询框-------------------------------------------
        function idsInputRemoveOne(id) {
            ids = $("input[name='ids']").val();
            segs = ids.split(",");
            ret = "";
            for(s in segs) {
                if(segs[s]!=id) ret+=segs[s]+",";
            }
            ret=ret.substring(0,ret.length-1);
            $("input[name='ids']").val(ret);
        }
        function idsInputAddOne(id) {
            ids = $("input[name='ids']").val();
            $("input[name='ids']").val(id+","+ids);
        }
        ids = "<?php echo htmlspecialchars($ids);?>";
        $("input[name='ids']").val(ids);


        // ---------------------------------右侧栏股票板块控制-------------------------------
        function closeAllStockPortlet() {
            App.scrollTo(); // scroll to top
            $(".stockportlet").children(".portlet-body").slideUp(0);
            $(".stockportlet .portletarrow").removeClass("expand").addClass("collapse");
        }
        function openAllStockPortlet() {
            $(".stockportlet").children(".portlet-body").slideDown(0);
            $(".stockportlet .portletarrow").removeClass("collapse").addClass("expand");
        }
        function openOneStockPortlet(id) {
            $("#stock_content_"+id+" .portlet-body").slideDown(0);
            $("#stock_content_"+id + " .portletarrow").removeClass("collapse").addClass("expand");
        }
        function closeOneStockPortlet(id) {
            $("#stock_content_"+id+" .portlet-body").slideUp(0);
            $("#stock_content_"+id + " .portletarrow").removeClass("expand").addClass("collapse");
        }
        function openWhichStockPortlet(num) {
            $("#stock_content_"+id+" .portlet-body").slideDown(0);
            $("#stock_content_"+id + " .portletarrow").removeClass("collapse").addClass("expand");
        }
        //closeAllStockPortlet();
        $("#open_all_stock_panel").on("click",function() {
            openAllStockPortlet();
        });
        $("#close_all_stock_panel").on("click",function() {
            closeAllStockPortlet();
        });
        $('#page_go_top').on('click', function (e) {
            App.scrollTo();
            e.preventDefault();
        });

        $("#stock_pan").delegate(".portlet-title","click",function() {
            id = $(this).data("id");
            isopen = $("#stock_content_"+id+" .portletarrow").hasClass("expand");
            if(!isopen) openOneStockPortlet(id);
            else closeOneStockPortlet(id);
        });


        // -----------------------------------右侧边栏股票面板-----------------------------------------
        // 搜索
        var suggestServer = new SuggestServer();
        suggestServer.bind({
            "input": "suggestInputSearch",
            "default": "",
            "type": "us",
            "max": 10,
            "width": 220,
            "link": "http://biz.finance.sina.com.cn/suggest/lookup_n.php?strict=1&country=@type@&q=@code@",
            "head": ["选项",  "代码", "中文名称"],
            "body": [-1, 2, 4],
            "callback": null
        });


        var sideTop = $('#sidebar').offset().top-45;
        window.footTop = $('.footer').offset().top - parseFloat($('.footer').css('marginTop').replace(/auto/, 0));

        $(window).scroll(function(evt) {
            var y = $(this).scrollTop();
            // 右侧栏悬浮
            if(y > $("body").height() - $("#sidebar").height()-42){
                return;
            }
            if (y > sideTop) {
                $('#sidebar').css({
                    position: 'fixed',
                    top: '45px'
                });
            } else {
                $('#sidebar').css({
                    position: 'absolute',
                    top: 0
                });
            }
        });

        // 右侧栏股票方块拖动开关
        //$( "#sortable" ).sortable();
        //$( "#sortable" ).disableSelection();


        // stock group
        // add  event
        $("#sidebar_addstock_button").on("click",function() {
            content = "<div  class='sidebar_addstock_input input-group add_group_elem_div'> " +
                " <input value='' type='text' class='form-control' placeholder='输入股票代码'> " +
                " <span class='input-group-btn'> " +
                    "<button class='btn blue groupadd_confirm' type='button'>确定</button> " +
                "</span> " +
                "</div> ";
            $(this).after(content);
        });

        // 增加新股票
        function addStockPanel() {
            var fa = $("#sidebar .add_group_elem_div");
            var stock = fa.find("input").val().toLowerCase();
            var stockcode = "gb_"+stock;
            has = true;
            jsonp("http://hq.sinajs.cn/?list="+stockcode, function(){
                // 检测是否存在
                stockInfo = splitSinaStockInfo(stock);
                console.log(stock,stockInfo);
                if(!stockInfo) has=false;
                if(!has) {
                    return;
                }
                // 过滤重复
                has = false;
                $("#sidebar #sortable li").each(function(index) {
                    if($(this).data("id")==stock) has=true;
                });
                // 插入
                if(!has) {
                    // 插入右侧栏
                    newblock = getEmptySockBlock(stock);
                    DEFAULT_STOCKBLOCK = newblock + DEFAULT_STOCKBLOCK
                    $("#sidebar #sortable").prepend(newblock);
                    // 插入股票详情板块
                    newblock =getEmptySockDetailPanel(stock);
                    DEFAULT_STOCKPAN = newblock + DEFAULT_STOCKPAN
                    $("#stock_pan").prepend(newblock);
                    // 去除输入
                    fa.find("input").val("");
                    // 刷新股票信息
                    getStockInfo();
                    // 刷新查询框
                    idsInputAddOne(stock);
                    // 刷新股票cookie
                    saveUserQueryCookie();
                }
            });
        }
        // 新增股票
        $("#sidebar").delegate(".groupadd_confirm","click",function() {
            addStockPanel();
        });
        $("#sidebar").on("keydown",function(e) {
            if(event.keyCode==13){ 
                addStockPanel();
            }
        });
        // 删除股票
        $("#sidebar").delegate(".stock_block_remove","click",function(event) {
            event.stopPropagation();
            id = $(this).closest("li").data("id");
            $("#stock_content_"+id).remove();
            $(this).closest("li").remove();
            idsInputRemoveOne(id);
        });
        $("#stock_pan").delegate(".remove","click",function(event) {
            event.stopPropagation();
            event.preventDefault();
            id = $(this).closest(".portlet-title").data("id");
            $("#stock_content_"+id).remove();
            $("#sidebar li.sidebar_stock_block[data-id="+id+"]").remove();
            idsInputRemoveOne(id);
        });

        // 点击右侧栏股票单个
        $("#sidebar").delegate(".sidebar_stock_block","click",function() {
            stockid = $(this).data("id");
            openOneStockPortlet(stockid);
            $("html,body").animate({scrollTop:$("#stock_content_"+stockid).offset().top-45},400)
        });

        // 排序
        $("#sidebar").delegate(".sort_btn","click",function() {
            event.preventDefault();
            sort = $(this).data("sort");       

            stockarray = [];
            $("#sidebar #sortable li").each(function(index) {
                stockarray[index] = {
                    rate : $(this).find(".stockrate").text().match(/^\((.*)%\)$/)[1],
                    id : $(this).data("id")
                }
            });

            if(sort=="no") {
                // 保存默认列表
                DEFAULT_STOCKBLOCK = $("#sidebar #sortable").html();
                DEFAULT_STOCKPAN = $("#stock_pan").html();
                $(this).html("<i class='iconfont sort_btn_img_left'>&#983407;</i>");
                $(this).data("sort","up")
                stockarray.sort(function(a,b) {
                    return parseFloat(a.rate)<parseFloat(b.rate) ? 1 : -1; 
                });
                // 插入右侧栏
                content = getMultiEmptySockBlock(stockarray);
                $("#sidebar ul").html(content);
                // 插入股票详情
                content = getMultiEmptySockDetailPanel(stockarray);
                //$("#stock_pan").html(content);
            } else if (sort=="up") {
                $(this).html("<i class='iconfont sort_btn_img_right'>&#983408;</i>");
                $(this).data("sort","down")
                stockarray.sort(function(a,b) {
                    return parseFloat(a.rate)>parseFloat(b.rate) ? 1 : -1; 
                });
                // 插入右侧栏
                content = getMultiEmptySockBlock(stockarray);
                $("#sidebar ul").html(content);
                // 插入股票详情
                content = getMultiEmptySockDetailPanel(stockarray);
                //$("#stock_pan").html(content);
            } else {
                $(this).html("<i class='iconfont sort_btn_img_left'>&#983407;</i><i class='iconfont sort_btn_img_right'>&#983408;</i>");
                $(this).data("sort","no")
                $("#sidebar ul").html(DEFAULT_STOCKBLOCK);
                //$("#stock_pan").html(DEFAULT_STOCKPAN);
            }
            getStockInfo();
        });


        // 盘前价格
        if(isOpen()) $(".after_hour_info").css('display','none');
        else $(".after_hour_info").css('display','');

        // ------------------------------------定时器---------------------------------
        // 获取股票信息并更新页面
        stockinfo_lock = false;
        function getStockInfo() {
            if(stockinfo_lock) return;
            stockinfo_lock=true;
            getparams = '';
            $("#sidebar #sortable li").each(function(index) {
                getparams += "gb_"+$(this).data("id")+",";
            });
            if(getparams.length==0) {
                stockinfo_lock=false;
                return;
            }
            // 获取sina股票信息
            jsonp("http://hq.sinajs.cn/?list="+getparams, function(){
                $("#sidebar #sortable li").each(function() {
                    id = $(this).data("id")
                    stockInfo = splitSinaStockInfo(id);
                    // 右侧栏
                    $(this).find("small.stockprice").html(stockInfo.real_price);
                    $(this).find("small.stockrate").html("("+stockInfo.real_price_change_rate+"%)");
                    $(this).find("span.stockname").html(stockInfo.name);
                    freshStockColor($(this),stockInfo);

                    // 股票详情板块
                    $("#stock_content_"+id+" .after_hour_content").html(formateAmount(stockInfo.after_hour_price)+'&nbsp&nbsp('+formateAmount(stockInfo.after_hour_price_change_rate)+'%)');
                    if(stockInfo.after_hour_price_change_amount>0) $("#stock_content_"+id+" .after_hour_content").css('color','red')
                    if(stockInfo.after_hour_price_change_amount<0) $("#stock_content_"+id+" .after_hour_content").css('color','green')
                    //console.log(formateAmount(stockInfo.start_price));
                    content = stockInfo.real_price+'&nbsp&nbsp'+stockInfo.real_price_change_amount+'&nbsp&nbsp('+stockInfo.real_price_change_rate+'%)';
                    $("#stock_content_"+id+" small.stockdata").html(content);
                    $("#stock_content_"+id+" span.stockname").html(stockInfo.name+"("+id+")");
                    freshStockColor($("#stock_content_"+id+" .stockportlet"),stockInfo);
                    $("#stock_content_"+id+" .detail_market_cap").html(formateAmount(stockInfo.market_cap));
                    $("#stock_content_"+id+" .detail_price_interval").html(formateAmount(stockInfo.lowerprice_today)+"-"+formateAmount(stockInfo.highprice_today));
                    $("#stock_content_"+id+" .detail_start_price").html(formateAmount(stockInfo.start_price));
                    $("#stock_content_"+id+" .detail_real_share_amout").html(formateAmount(stockInfo.real_share_amount));
                    $("#stock_content_"+id+" .detail_yesterday_close_price").html(formateAmount(stockInfo.yesterday_close_price));
                    $("#stock_content_"+id+" .detail_pe").html(formateAmount(stockInfo.PE));
                    $("#stock_content_"+id+" .detail_stock_amount_10day").html(formateAmount(stockInfo.stock_amount_10day));
                    $("#stock_content_"+id+" .detail_price_interval_52week").html(formateAmount(stockInfo.lowerprice_52week)+"-"+formateAmount(stockInfo.highprice_52week));
                    $("#stock_content_"+id+" .detail_earning_per_share").html(formateAmount(stockInfo.earning_per_share));
                    $("#stock_content_"+id+" .detail_capitalization").html(formateAmount(stockInfo.capitalization));
                    //console.log(stockInfo);
                });
            })
            stockinfo_lock=false;
        }
        setInterval(getStockInfo,2000)
    });
/*
    //Instantiate the Chart 
    var chart_profit = new FusionCharts("http://vip.stock.finance.sina.com.cn/usstock/fusioncharts/Code/FusionCharts/ScrollCombiDY2D.swf", "profit", "460", "250", "0", "0");
    chart_profit.setTransparent("false");
    //Provide entire XML data using dataXML method
    chart_profit.setDataXML("
        <chart bgColor='#ffffff' alternateHGridColor='#d8d8d8' showBorder='0' palette='4' logoURL='http://www.sinaimg.cn/cj/sinaflashsource/sinalogo.png' logoAlpha='15'  logoPosition='CC' formatNumberScale='0' showValues='0' decimals='0'>
        <categories>
        <category name='2012年3季' /><category name='2012年4季' /><category name='2013年1季' /><category name='2013年2季' /><category name='2013年3季' />
        </categories>
        <dataset seriesName='总收入(百万美元)'><set value='50.37' /><set value='48.82' /><set value='46.59' /><set value='49.62' /><set value='47.56' /></dataset>
        <dataset seriesName='净利润(百万美元)'><set value='-15.40' /><set value='-21.08' /><set value='-3.14' /><set value='-9.33' /><set value='-24.63' /></dataset>
        <dataset seriesName='净利润率(%)' parentYAxis='S'><set value='-22' /><set value='-27' /><set value='-4' /><set value='-11' /><set value='-30' /></dataset>
        </chart>
    ");
    //Finally, render the chart.
    chart_profit.render("profitDiv");
    */
</script>