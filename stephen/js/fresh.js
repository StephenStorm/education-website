function get_es_id(){
	var select = document.getElementById("selEs");
	console.log(select.options);
	var index=select.selectedIndex ;
	var es = select.options[index].value;
	document.getElementById("esid").value = es;
}