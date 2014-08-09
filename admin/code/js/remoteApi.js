var RemoteApi = function () {

    // 跨域名调用js
    // src remote接口
    // cb 回调函数
    var jsonp = function(src, cb) {
        $.ajaxSetup({
            cache: true
        });
        $.getScript(src,cb);
        $.ajaxSetup({
            cache: false
        });
        /*
        var script = document.createElement('script'),
            s = document.getElementsByTagName("head")[0];

        script.onreadystatechange = script.onload = function () {
            if (!script.readyState || /loaded|complete/i.test(script.readyState)) {
                script.onreadystatechange = script.onload = null;
                //script.parentNode.removeChild(script);

                cb();
            }
        };

        script.type = 'text/javascript';
        //alert(script)
        script.className = 'nouse';
        s.appendChild(script);
        script.src = src;
        */
    };

    var getSinaStockDetail = function(id) {
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
            'after_hour_price_change_amount' : parseFloat(seg2[23]),
            'close_time' : seg2[24],
            'after_hour_time' : seg2[25],
            'yesterday_close_price' : parseFloat(seg2[26]),
            'after_hour_share_amount' : parseInt(seg2[27])
        };
    };

    
    return {

        // 跨域名调用js
        // src remote接口
        // cb 回调函数
        jsapiCrossDomain : function(src, cb) {
            jsonp(src,cb);
        },

        // 解析新浪股票接口返回的数据
        // id 股票id 小写 例如 qihu
        getSinaStockDetail : function(id) {
            return getSinaStockDetail(id);
        }

    };

}();