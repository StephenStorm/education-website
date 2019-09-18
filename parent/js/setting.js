var s_name;
var p_id;
var tel=true;
var email=true;
p_id=document.getElementById("p_id").getAttribute('value');
var info=document.getElementsByClassName("info");
for(var i=0;i<info.length;i++){
	info[i].setAttribute("onchange","validate(this)");
}
function validate(self){//验证
	
}
function save(self){
	var info=['birth','sex','direction','fee_from','fee_to','province','city','district','other'];
	var obj={'p_id':p_id,'s_name':self.id};
	var nodes=document.getElementsByClassName(self.id);
	for(var i=0;i<nodes.length;i++){
		obj[info[i]]=nodes[i].value;		
	}
	var str=JSON.stringify(obj);
	//console.log(str);	
	mysubmit("/parent/php/modify.php",str);
	
}
function mysubmit(path,data){
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
	 xmlhttp.open("POST", path, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +data);
}
function save_parent(self){
	if(tel&&email){
		var obj={'p_id':p_id};
		obj['password']=document.getElementById("password").value;
		obj['tel']=document.getElementById("tel").value;
		obj['email']=document.getElementById('email').value;
		mysubmit("/parent/php/modify_parent.php",JSON.stringify(obj));
	}else{
		$(".modal-body").html("信息格式错误");
		$('#myModal').modal('show');
	}
}
function add(self){
	if(document.getElementById("new_delete")){
		return;
	}
	var insert_pos=self.parentNode;
	var target_parent=insert_pos.parentNode;
	node=document.createElement("div");
	node.className="row";
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
				 node.innerHTML=xmlhttp.responseText;
				 target_parent.insertBefore(node,insert_pos);
				 node=document.createElement("hr");
				 target_parent.insertBefore(node,insert_pos);
				 
	        }
	    };
	    xmlhttp.open("GET", "/parent/php/add.php", true);
	    xmlhttp.send();
	
}
function remove(self){
	s_name=self.getAttribute("id");
	if(s_name=='new_delete'){		
		target_del=self.parentNode.parentNode.parentNode;
		nextNode=target_del.nextSibling;
		target_parent=target_del.parentNode;
		target_parent.removeChild(target_del);
		target_parent.removeChild(nextNode);
		return;
	}
	var info={
		"p_id":p_id,"s_name":s_name
	};
	var str=JSON.stringify(info);
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				 var x=JSON.parse(xmlhttp.responseText);
				 var tip;
				 if(x.result){
					 target_del=self.parentNode.parentNode.parentNode;
					 nextNode=target_del.nextSibling;
					 target_parent=target_del.parentNode;
					 target_parent.removeChild(target_del);
					 target_parent.removeChild(nextNode);
					 tip="success";
				 }else{
					 tip="false";
				 }
				 $(".modal-body").html(tip);
				 $('#myModal').modal('show');
            }
        };
        xmlhttp.open("POST", "/parent/php/delete.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" +str);
}
function save_new(){
	if(!validate_new()){
		return;
	}
	var obj={};
	obj["p_id"]=p_id;
	obj['s_name']=document.getElementById("new_name").value;
	obj['sex']=document.getElementById("new_sex").value;
	obj['birth']=document.getElementById("new_birth").value;
	obj['direction']=document.getElementById("new_direction").value;
	obj['fee_from']=document.getElementById("new_fee_from").value;
	obj['fee_to']=document.getElementById("new_fee_to").value;
	obj['province']=document.getElementById("new_province").value;
	obj['city']=document.getElementById("new_city").value;
	obj['district']=document.getElementById("new_district").value;
	obj['other']=document.getElementById("new_other").value;
	var str=JSON.stringify(obj);
	//console.log(str);
	//mysubmit("/parent/php/insert_student.php",str);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
				 var x=JSON.parse(xmlhttp.responseText);
				 //console.log(x);
					var tip;
					if(x.result){
						tip="success";
						location.reload();
					}else{
						tip="false";
						$(".modal-body").html(tip);
						$('#myModal').modal('show');
					}					 
				 }
			};
	 xmlhttp.open("POST", "/parent/php/insert_student.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +str);
}
function validate_tel(self){
	var re =/^1[3,5-9]\d{9}$/;
	var classes=self.parentNode.className.split(" ");
	if (re.test(self.value)) {		
		if(classes[classes.length-1].includes("has-")){
			classes[classes.length-1]="has-success";
			self.parentNode.className=classes.join(" ");
		}else{
			self.parentNode.className+=" has-success";
		}
		tel=true;
	}else{
		if(classes[classes.length-1].includes("has-")){
			classes[classes.length-1]="has-error";
			self.parentNode.className=classes.join(" ");
		}else{
			self.parentNode.className+=" has-error";
		}
		tel=false;
	}
}
function validate_email(self){
	var re =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var classes=self.parentNode.className.split(" ");
	if (re.test(self.value)) {		
		if(classes[classes.length-1].includes("has-")){
			classes[classes.length-1]="has-success";
			self.parentNode.className=classes.join(" ");
		}else{
			self.parentNode.className+=" has-success";
		}
		email=true;
	}else{
		if(classes[classes.length-1].includes("has-")){
			classes[classes.length-1]="has-error";
			self.parentNode.className=classes.join(" ");
		}else{
			self.parentNode.className+=" has-error";
		}
		email=false;
	}
}
function validate_new(){//验证新建信息
	return true;
}