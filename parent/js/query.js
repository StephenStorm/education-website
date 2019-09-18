var object=document.getElementById("subject");
var province=document.getElementById("province");
var city=document.getElementById("city");
var fee_to=document.getElementById("fee_to");
var fee_from=document.getElementById("fee_from");
var age_from=document.getElementById("age_from");
var age_to=document.getElementById("age_to");
var replace=document.getElementById("replace");
document.getElementById("province").onchange=search;
document.getElementById("city").onchange=search;
document.getElementById("fee_to").onchange=search;
document.getElementById("fee_from").onchange=search;
document.getElementById("age_from").onchange=search;
document.getElementById("age_to").onchange=search;
function search(){
	var obj={'subject':subject.value,
	'province':province.value,
	'city':city.value,
	'fee_to':fee_to.value,
	'fee_from':fee_from.value,
	'age_from':age_from.value,
	'age_to':age_to.value};
	var data=JSON.stringify(obj);
	console.log(data);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
				 var x=JSON.parse(xmlhttp.responseText);
				 console.log(x);
					var tip;
					if(x.result){//更新页面内容
						tip="success";
						replace.innerHTML=x.result;
					}else{
						tip="抱歉，未找到所需的结果";
						// $(".modal-body").html(tip);
						// $('#myModal').modal('show');
						replace.innerHTML='<div class="row"><div class="col-md-3 col-md-offset-4 h3">抱歉，未找到所需的结果</div></div>';
					}					
				 }
			};
	xmlhttp.open("POST",'./search.php', true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +data);
}
subject.onchage=search;
province.onchange=search;
city.onchange=search;
fee_to.onchange=search;
fee_from.onchange=search;
age_from.onchange=search;
age_to.onchange=search;