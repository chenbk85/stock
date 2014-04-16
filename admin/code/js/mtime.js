function getStockTime() {
	var dd1=new Date(); 
	// 夏令时 -240
	// 冬令时 -300
	dd1.setMinutes(dd1.getMinutes()+dd1.getTimezoneOffset()-240); //取当地时间加上和格林威治的时差减要求地区和格林的时差分钟，这里是-300，代表美国东部纽约和格林的时差
	return dd1.getHours()+":"+dd1.getMinutes()+":"+dd1.getSeconds();
}

function getStockHour() {
	var dd1=new Date(); 
	// 夏令时 -240
	// 冬令时 -300
	dd1.setMinutes(dd1.getMinutes()+dd1.getTimezoneOffset()-240); //取当地时间加上和格林威治的时差减要求地区和格林的时差分钟，这里是-300，代表美国东部纽约和格林的时差
	return dd1.getHours();
}

function getStockMinute() {
	var dd1=new Date(); 
	// 夏令时 -240
	// 冬令时 -300
	dd1.setMinutes(dd1.getMinutes()+dd1.getTimezoneOffset()-240); //取当地时间加上和格林威治的时差减要求地区和格林的时差分钟，这里是-300，代表美国东部纽约和格林的时差
	return dd1.getMinutes();
}

function isOpen() {
	hour = getStockHour();
	minutes = getStockMinute();
	// 夏令时
	if((hour==21&&minutes>=30)||(hour==4&&minutes<30)||(hour>21||hour<4)) return true;
	else return false;
}