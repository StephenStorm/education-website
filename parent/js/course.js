var stars1=document.querySelectorAll('.stars1 span');
	var info1=document.querySelector('.info1');
	var grades = ["极差","差","一般","良好","优秀"];
	var active1=-1;   //记录当前点击的是哪颗星星
 
	for(var i=0;i<stars1.length;i++){
		stars1[i].index=i;
		stars1[i].onmouseover=function(){setStar1(this.index);};
		stars1[i].onmouseout=function(){setStar1(active1);};
		stars1[i].onclick=setClick1;
	}
 
	function setStar1(nub){
		var name='';
		name='show2';
		for(var i=0;i<stars1.length;i++){
			stars1[i].className= i<=nub?name:'';
		}
		info1.style.display= nub<0? 'none':'block';
		info1.innerHTML=grades[nub];
	}
 
	function setClick1(){
		active1=this.index;
		document.getElementById("star_level1").value=active1+1;
	//	console.log("click");
	}
	var stars2=document.querySelectorAll('.stars2 span');
		var info2=document.querySelector('.info2');
		var active2=-1;   //记录当前点击的是哪颗星星
	 
		for(var i=0;i<stars2.length;i++){
			stars2[i].index=i;
			stars2[i].onmouseover=function(){setStar2(this.index);};
			stars2[i].onmouseout=function(){setStar2(active2);};
			stars2[i].onclick=setClick2;
		}
	 
		function setStar2(nub){
			var name='';
			name='show2';
			for(var i=0;i<stars2.length;i++){
				stars2[i].className= i<=nub?name:'';
			}
			info2.style.display= nub<0? 'none':'block';
			info2.innerHTML=grades[nub];
		}
		function setClick2(){
			active2=this.index;
			document.getElementById("star_level2").value=active2+1;
			}
		
function add_cart(self){
	var obj={'c_id':self.id,'length':document.getElementById("length").value};
	var data=JSON.stringify(obj);
	console.log(data);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
				 var x=JSON.parse(xmlhttp.responseText);
				 console.log(x);
					var tip;
					if(x.result){
						tip="success";
					}else{
						tip="false";
					}
					$(".modal-body").html(tip);
					$('#myModal').modal('show');
					
				 }
			};
	 xmlhttp.open("POST","/parent/php/add_cart.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +data);
}
function apply_lis(self){
	var ids=self.id.split('_');
	var obj={'p_id':ids[0],'c_id':ids[1]};
	var data=JSON.stringify(obj);
	console.log(data);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
				 var x=JSON.parse(xmlhttp.responseText);
				 console.log(x);
					var tip;
					if(x.result){
						tip="success";
						alert(tip);
						location.reload();
					}else{
						tip="false";
						alert(tip);
					}
										
				 }
			};
	 xmlhttp.open("POST","/parent/php/apply_lis.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +data);
}
function save_evaluation_course(self){
	var obj={'c_id':self.id,
	'score':document.getElementById('score1').value,
	'image':document.getElementById('file1').value,
	'text':document.getElementById("text1").value,
	'star_level':active1+1};
	var data=JSON.stringify(obj);
	console.log(data);
	return;
}
function save_evaluation_edu(self){
	return;
}