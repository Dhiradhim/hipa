
<script type="text/javascript"> 

$(document).ready(function() { 
$("#provinsi1").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten1").html(''); 
$("#kecamatan1").html(''); 
$("#kelurahan1").html(''); 
$("#kabupaten1").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan1").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan1").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi1").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi1").change(function(){ 
var prop_name = $("#provinsi1").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten1").html(''); 
$("#kecamatan1").html(''); 
$("#kelurahan1").html(''); 
$("#kabupaten1").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan1").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan1").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten1").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten1").change(function(){ 
var kabkota = $("#kabupaten1").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan1").html(''); $("#kelurahan1").html(''); 
$("#kecamatan1").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan1").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan1").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan1").change(function(){ 
var kec = $("#kecamatan1").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan1").html(''); 
$("#kelurahan1").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan1").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi2").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten2").html(''); 
$("#kecamatan2").html(''); 
$("#kelurahan2").html(''); 
$("#kabupaten2").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan2").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan2").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi2").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi2").change(function(){ 
var prop_name = $("#provinsi2").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten2").html(''); 
$("#kecamatan2").html(''); 
$("#kelurahan2").html(''); 
$("#kabupaten2").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan2").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan2").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten2").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten2").change(function(){ 
var kabkota = $("#kabupaten2").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan2").html(''); $("#kelurahan2").html(''); 
$("#kecamatan2").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan2").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan2").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan2").change(function(){ 
var kec = $("#kecamatan2").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan2").html(''); 
$("#kelurahan2").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan2").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi3").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten3").html(''); 
$("#kecamatan3").html(''); 
$("#kelurahan3").html(''); 
$("#kabupaten3").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan3").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan3").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi3").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi3").change(function(){ 
var prop_name = $("#provinsi3").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten3").html(''); 
$("#kecamatan3").html(''); 
$("#kelurahan3").html(''); 
$("#kabupaten3").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan3").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan3").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten3").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten3").change(function(){ 
var kabkota = $("#kabupaten3").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan3").html(''); $("#kelurahan3").html(''); 
$("#kecamatan3").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan3").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan3").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan3").change(function(){ 
var kec = $("#kecamatan3").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan3").html(''); 
$("#kelurahan3").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan3").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi4").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten4").html(''); 
$("#kecamatan4").html(''); 
$("#kelurahan4").html(''); 
$("#kabupaten4").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan4").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan4").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi4").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi4").change(function(){ 
var prop_name = $("#provinsi4").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten4").html(''); 
$("#kecamatan4").html(''); 
$("#kelurahan4").html(''); 
$("#kabupaten4").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan4").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan4").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten4").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten4").change(function(){ 
var kabkota = $("#kabupaten4").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan4").html(''); $("#kelurahan4").html(''); 
$("#kecamatan4").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan4").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan4").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan4").change(function(){ 
var kec = $("#kecamatan4").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan4").html(''); 
$("#kelurahan4").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan4").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi5").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten5").html(''); 
$("#kecamatan5").html(''); 
$("#kelurahan5").html(''); 
$("#kabupaten5").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan5").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan5").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi5").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi5").change(function(){ 
var prop_name = $("#provinsi5").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten5").html(''); 
$("#kecamatan5").html(''); 
$("#kelurahan5").html(''); 
$("#kabupaten5").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan5").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan5").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten5").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten5").change(function(){ 
var kabkota = $("#kabupaten5").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan5").html(''); $("#kelurahan5").html(''); 
$("#kecamatan5").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan5").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan5").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan5").change(function(){ 
var kec = $("#kecamatan5").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan5").html(''); 
$("#kelurahan5").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan5").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi6").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten6").html(''); 
$("#kecamatan6").html(''); 
$("#kelurahan6").html(''); 
$("#kabupaten6").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan6").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan6").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi6").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi6").change(function(){ 
var prop_name = $("#provinsi6").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten6").html(''); 
$("#kecamatan6").html(''); 
$("#kelurahan6").html(''); 
$("#kabupaten6").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan6").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan6").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten6").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten6").change(function(){ 
var kabkota = $("#kabupaten6").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan6").html(''); $("#kelurahan6").html(''); 
$("#kecamatan6").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan6").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan6").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan6").change(function(){ 
var kec = $("#kecamatan6").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan6").html(''); 
$("#kelurahan6").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan6").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi7").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten7").html(''); 
$("#kecamatan7").html(''); 
$("#kelurahan7").html(''); 
$("#kabupaten7").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan7").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan7").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi7").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi7").change(function(){ 
var prop_name = $("#provinsi7").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten7").html(''); 
$("#kecamatan7").html(''); 
$("#kelurahan7").html(''); 
$("#kabupaten7").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan7").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan7").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten7").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten7").change(function(){ 
var kabkota = $("#kabupaten7").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan7").html(''); $("#kelurahan7").html(''); 
$("#kecamatan7").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan7").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan7").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan7").change(function(){ 
var kec = $("#kecamatan7").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan7").html(''); 
$("#kelurahan7").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan7").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi8").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten8").html(''); 
$("#kecamatan8").html(''); 
$("#kelurahan8").html(''); 
$("#kabupaten8").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan8").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan8").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi8").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi8").change(function(){ 
var prop_name = $("#provinsi8").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten8").html(''); 
$("#kecamatan8").html(''); 
$("#kelurahan8").html(''); 
$("#kabupaten8").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan8").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan8").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten8").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten8").change(function(){ 
var kabkota = $("#kabupaten8").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan8").html(''); $("#kelurahan8").html(''); 
$("#kecamatan8").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan8").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan8").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan8").change(function(){ 
var kec = $("#kecamatan8").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan8").html(''); 
$("#kelurahan8").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan8").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi9").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten9").html(''); 
$("#kecamatan9").html(''); 
$("#kelurahan9").html(''); 
$("#kabupaten9").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan9").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan9").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi9").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi9").change(function(){ 
var prop_name = $("#provinsi9").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten9").html(''); 
$("#kecamatan9").html(''); 
$("#kelurahan9").html(''); 
$("#kabupaten9").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan9").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan9").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten9").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten9").change(function(){ 
var kabkota = $("#kabupaten9").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan9").html(''); $("#kelurahan9").html(''); 
$("#kecamatan9").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan9").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan9").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan9").change(function(){ 
var kec = $("#kecamatan9").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan9").html(''); 
$("#kelurahan9").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan9").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

$(document).ready(function() { 
$("#provinsi10").append('<option value="">Pilih Provinsi</option>'); 
$("#kabupaten10").html(''); 
$("#kecamatan10").html(''); 
$("#kelurahan10").html(''); 
$("#kabupaten10").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan10").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan10").append('<option value="">Pilih Kelurahan</option>'); 
url = 'get_prov.php'; 
$.ajax({ url: url, 
type: 'GET', 
dataType: 'json', 
success: function(result) { 
for (var i = 0; i < result.length; i++) 
$("#provinsi10").append('<option value="' + result[i].prop_name + '">' + result[i].prop_name + '</option>'); 
} 
}); 
}); 

$("#provinsi10").change(function(){ 
var prop_name = $("#provinsi10").val(); 
var url = 'get_kota.php?prop_name=' + prop_name; 
$("#kabupaten10").html(''); 
$("#kecamatan10").html(''); 
$("#kelurahan10").html(''); 
$("#kabupaten10").append('<option value="">Pilih Kabupaten</option>'); 
$("#kecamatan10").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan10").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kabupaten10").append('<option value="'+ result[i].kabkota +'">' + result[i].kabkota + '</option>'); 
} 
});  
}); 

$("#kabupaten10").change(function(){ 
var kabkota = $("#kabupaten10").val(); 
var url = 'get_kec.php?kabkota=' + kabkota; 
$("#kecamatan10").html(''); $("#kelurahan10").html(''); 
$("#kecamatan10").append('<option value="">Pilih Kecamatan</option>'); 
$("#kelurahan10").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kecamatan10").append('<option value="'+ result[i].kec +'">' + result[i].kec + '</option>'); 
} 
});  
}); 

$("#kecamatan10").change(function(){ 
var kec = $("#kecamatan10").val(); 
var url = 'get_kel.php?kec=' + kec; $("#kelurahan10").html(''); 
$("#kelurahan10").append('<option value="">Pilih Kelurahan</option>'); 
$.ajax({ url : url, 
type: 'GET', 
dataType : 'json', 
success : function(result){ 
for(var i = 0; i < result.length; i++) 
$("#kelurahan10").append('<option value="'+ result[i].id +'">' + result[i].kel + '</option>'); 
} 
});  
});

</script>
