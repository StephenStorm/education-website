function clear_purchaserecords(self){
	var obj={'p_id':self.id};
	var data=JSON.stringify(obj);
	//console.log(data);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
				 var x=JSON.parse(xmlhttp.responseText);
				 console.log(x);
					var tip;
					if(x.result){
						var parent=self.parentNode.parentNode.parentNode;
						var rows=document.getElementsByClassName("record");
						for(var i=0;i<rows.length;i++){
							parent.removeChild(rows[i]);
						}
						rows=document.getElementsByTagName("hr");
						for(var i=1;i<rows.length;i++){
							parent.removeChild(rows[i]);
						}
						tip="success";
					}else{
						tip="false";
					}
					$(".modal-body").html(tip);
					$('#myModal').modal('show');
					
				 }
			};
	 xmlhttp.open("POST", "/parent/php/clear_purchaserecords.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("x=" +data);
}