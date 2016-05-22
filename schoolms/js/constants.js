var sys_roles = new Array();
sys_roles[0]=new Array("reader","浏览用户");
sys_roles[1]=new Array("operator","操作用户");
sys_roles[2]=new Array("admin","管理员");

var genders = new Array();
genders[0]=new Array("男","男");
genders[1]=new Array("女","女");

var validays = new Array();
validays[0]=new Array("10","10天");
validays[1]=new Array("20","20天");
validays[2]=new Array("30","30天");
validays[3]=new Array("-1","永远");

function get_sys_role(roleid) {
	for(var i=0;i<sys_roles.length;i++) {
		if(roleid == sys_roles[i][0]) {
			return sys_roles[i][1];
		}
	}
}

function get_validays(id) {
	for(var i=0;i<validays.length;i++) {
		if(id == validays[i][0]) {
			return validays[i][1];
		}
	}
}