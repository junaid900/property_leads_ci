<script src="<?php echo assets_dir();?>js/jquery.min.js"></script>
<script src="<?php echo assets_dir();?>js/popper.min.js"></script>
<script src="<?php echo assets_dir();?>js/bootstrap.min.js"></script>
<script src="<?php echo assets_dir();?>js/modernizr.min.js"></script>
<script src="<?php echo assets_dir();?>js/waves.js"></script>
<script src="<?php echo assets_dir();?>js/jquery.slimscroll.js"></script>
<script src="<?php echo assets_dir();?>js/jquery.nicescroll.js"></script>
<script src="<?php echo assets_dir();?>js/jquery.scrollTo.min.js"></script>
<!-- Chart JS -->
<script src="<?php echo assets_dir();?>plugins/moment/moment.js"></script>
<!--script src="<?php echo assets_dir();?>pages/chartjs.init.js"></script-->
 <!-- Required datatable js -->
<script src="<?php echo assets_dir();?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/buttons.bootstrap4.min.js"></script>

<script src="<?php echo assets_dir();?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?php echo assets_dir();?>plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<script src="<?php echo assets_dir();?>pages/form-advanced.js"></script>
        
<!-- App js -->

<script src="<?php echo assets_dir();?>plugins/datatables/jszip.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/buttons.print.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="<?php echo assets_dir();?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo assets_dir();?>pages/datatables.init.js"></script>



 <!--Summernote js-->
<script src="<?php echo assets_dir();?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo assets_dir();?>js/app.js"></script>
<!-- notification js -->
<script type="text/javascript" src="<?php echo assets_dir();?>bootstrap-growl.min.js"></script>
<script type="text/javascript" src="<?php echo assets_dir();?>notification/notification.js"></script>

       
<script>
    <?php if($this->session->flashdata('msg_success')){ ?>
		notify('fa fa-comments', 'success', 'Title ', '<?php echo $this->session->flashdata("msg_success")?>');
	<?php } else if($this->session->flashdata('msg_error')){ ?>
		notify('fa fa-comments', 'danger', 'Title ', '<?php echo $this->session->flashdata("msg_error")?>');
	<?php } else if($this->session->flashdata('msg_warning')){ ?>
		notify('fa fa-comments', 'warning', 'Title ', '<?php echo $this->session->flashdata("msg_warning")?>');
	<?php } else if($this->session->flashdata('msg_info')){ ?>
		notify('fa fa-comments', 'info', 'Title ', '<?php echo $this->session->flashdata("msg_info")?>');
	<?php } ?>
</script>
 <script>
    jQuery(document).ready(function(){
        $('.summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                 // set focus to editable area after initializing summernote
        });
    });
</script>
<?php if(!empty($page_name) && $page_name=='export_report' || $page_name=='dashboard'){ ?>
<!-- Chart JS -->
<?php if($page_name=='export_report'){?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkRI_T1EHnOseVgjpu5K-9Y91AohRky-U&libraries=visualization&v=weekly&channel=2" async ></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js?rev032"></script> 
<?php }else{ ?>
<!--script src="<?php echo assets_dir();?>plugins/chart.js/chart.min.js"></script-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js?rev032"></script> 
<?php } ?>
<script src="<?php echo assets_dir();?>plugins/moment/moment.js"></script>
<script src="<?php echo assets_dir();?>plugins/morris/morris.min.js"></script>
<script src="<?php echo assets_dir();?>plugins/raphael/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>


<?php } ?>
<?php if(!empty($page_name) && $page_name=='export_report' || $page_name=='dashboard'){ ?>

<script>
    <?php if(!empty($past_data_shown_allowed)){ ?>
    $(function(){
        $('#date-range').datepicker({
            startDate: '-<?php echo $past_data_shown_allowed; ?>m'
            //endDate: '+2d'
        }).on('changeDate', function(ev){
            //$('#sDate1').text($('#date-range').data('date'));
            $('#date-range').datepicker('hide');
        }); 
    });
    <?php }else{ ?>
    
    jQuery('#date-range').datepicker({
        toggleActive: true,
    }); 
    <?php } ?>
</script>
<?php } ?>
<?php if(!empty($page_name) && $page_name=='export_report'){ ?>
<script>

let map, heatmap;


/*
function getPoints(){
  return [
    new google.maps.LatLng(37.782551, -122.445368),
    new google.maps.LatLng(37.782745, -122.444586),
  ];    
} */
function initMap(arr,latitude,longitude) {
    console.log('lat');
    console.log(latitude,longitude);
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 13,
    center: { lat: latitude, lng: longitude },
    mapTypeId: "satellite",
  });
  
  heatmap = new google.maps.visualization.HeatmapLayer({
    data: arr,
    map: map,
  });
  
  document
    .getElementById("toggle-heatmap")
    .addEventListener("click", toggleHeatmap);
  document
    .getElementById("change-gradient")
    .addEventListener("click", changeGradient);
  document
    .getElementById("change-opacity")
    .addEventListener("click", changeOpacity);
  document
    .getElementById("change-radius")
    .addEventListener("click", changeRadius);
}

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  const gradient = [
    "rgba(0, 255, 255, 0)",
    "rgba(0, 255, 255, 1)",
    "rgba(0, 191, 255, 1)",
    "rgba(0, 127, 255, 1)",
    "rgba(0, 63, 255, 1)",
    "rgba(0, 0, 255, 1)",
    "rgba(0, 0, 223, 1)",
    "rgba(0, 0, 191, 1)",
    "rgba(0, 0, 159, 1)",
    "rgba(0, 0, 127, 1)",
    "rgba(63, 0, 91, 1)",
    "rgba(127, 0, 63, 1)",
    "rgba(191, 0, 31, 1)",
    "rgba(255, 0, 0, 1)",
  ];

  heatmap.set("gradient", heatmap.get("gradient") ? null : gradient);
}

function changeRadius() {
  heatmap.set("radius", heatmap.get("radius") ? null : 20);
}

function changeOpacity() {
  heatmap.set("opacity", heatmap.get("opacity") ? null : 0.2);
}
$(window).load(function(){

    $('#load').click(function(){

            html2canvas($('#map'), {
            useCORS: true,
                onrendered: function (canvas) {
                var dataUrl= canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");

                window.location.href = dataUrl;
                                    }
            });

    });
});

$(document).ready(function () {
    //06/01/2022
   // var today_date = moment().format('MM/DD/YYYY');
    //var starting_date = moment().subtract(1, 'months').format('MM/DD/YYYY');

   //  var starting_date = moment(today_date).subtract(24, 'months').format("MM/DD/YYYY");
    // console.log(starting_date);
    var today_date = moment().format('MM/DD/YYYY');
    <?php if(!empty($past_data_shown_allowed) && $past_data_shown_allowed>1){ ?>
    var starting_date = moment().subtract(<?php echo $past_data_shown_allowed; ?>, 'months').format("MM/DD/YYYY");
    <?php }else{ ?>
    var starting_date = moment().subtract(24, 'months').format("MM/DD/YYYY");
    <?php } ?>

   leads_by_house_situation(today_date,starting_date,'');
   listing_by_region(today_date,starting_date,'');
   avg_listing_by_duration();
   render_heat_map(today_date,starting_date,'');
   listing_per_type(today_date,starting_date,'');
   avg_selling_price(today_date,starting_date,'');
   avg_selling_per_region(today_date,starting_date,'');
   
   /* leads_by_house_situation('','','');
   listing_by_region('','','');
   avg_listing_by_duration();
   avg_percentage_listing_off();
   render_heat_map('','','');
   listing_per_type('','','');
   avg_selling_price('','','');
   avg_selling_per_region('','',''); */
});
var load_first_time = true;


function get_stats_by_date(){
    load_first_time = false;
    var start = $('#start').val();
    var end = $('#end').val();
    console.log(start);
    console.log(end);
    var report_type = $('#report_type').val();
    if(start!='' && end!='' && report_type==''){
        leads_by_house_situation(start,end,''); 
        listing_by_region(start,end,''); 
        render_heat_map(start,end,''); 
        listing_per_type(start,end,''); 
        avg_selling_price(start,end,'');
        avg_selling_per_region(start,end,'');
    }else if(start=='' && end=='' && report_type!=''){
        leads_by_house_situation('','',report_type); 
        listing_by_region('','',report_type); 
        render_heat_map('','',report_type); 
        listing_per_type('','',report_type); 
        avg_selling_price('','',report_type);
        avg_selling_per_region('','',report_type);
    }else if(start!='' && end!='' && report_type!=''){
        leads_by_house_situation(start,end,report_type); 
        listing_by_region(start,end,report_type); 
        render_heat_map(start,end,report_type); 
        listing_per_type(start,end,report_type); 
        avg_selling_price(start,end,report_type);
        avg_selling_per_region(start,end,report_type);
    }
    if(report_type =='lead'){
        $('.lead_listing').text('listing');
    }else if(report_type =='sold'){
        $('.lead_listing').text('sold');
    }else{
        $('.lead_listing').text('listing');
    }
    
}
function listing_per_type(start,end,report_type) {
    var region = $('#region_id').val();
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
  //  alert(load_first_time);
  //  console.log(region);
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/get_listing_per_type/<?php echo $param1.'/'.$param2;?>',
        data : {'start':start,'end':end,'report_type':report_type},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log('per region');
	    let labels_array = [];
	    let values_array = [];
	    Object.keys(result).map(function(key, index) {
	        console.log(key);
	        labels_array.push(result[key].house_types);
	        values_array.push(result[key].total_lead);
	    });
	  
	    var barChart = {
            labels: labels_array,
            datasets: [
                {
                    label: "Amount of listing per type",
                    backgroundColor: "#4385f5",
                    borderColor: "#2875f9",
                    borderWidth: 1,
                    hoverBackgroundColor: "#4385f5",
                    hoverBorderColor: "#2875f9",
                    data: values_array
                }
            ]
        };
        
        var barOpts = {
            plugins: {
                datalabels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 12,
                        min: 0,
                       stepSize: 2
                    }
                }]
            }
        };
        var ctx = $("#listing_per_type").get(0).getContext('2d');
      //   alert(load_first_time);
         if(load_first_time == true){   
             
	        var selector = $("#listing_per_type");
	        var container = $(selector).parent();
            var ww = selector.attr('width', $(container).width() );
         }
        new Chart($("#listing_per_type"), {type: 'bar', data: barChart, options: barOpts});
       
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}
function avg_selling_per_region(start,end,report_type) {
    var region = $('#region_id').val();
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
    
  //  console.log(region);
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/get_avg_selling_price_per_region/<?php echo $param1.'/'.$param2;?>',
        data : {'start':start,'end':end,'report_type':report_type},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log('per selling');
	    console.log(result);
	    
	    let labels_array = [];
	    let values_array = [];
	    Object.keys(result).map(function(key, index) {
	        console.log(key);
	        labels_array.push(result[key].postal_code);
	        values_array.push(result[key].soldPrice);
	    });
	  
	    var barChart = {
            labels: labels_array,
            datasets: [
                {
                    label: "Average listing price per region",
                    backgroundColor: "#4385f5",
                    borderColor: "#2875f9",
                    borderWidth: 1,
                    hoverBackgroundColor: "#4385f5",
                    hoverBorderColor: "#2875f9",
                    data: values_array
                }
            ]
        };
        
        var barOpts = {
            plugins: {
                datalabels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 12,
                        min: 0,
                       stepSize: 2
                    }
                }]
            }
        };
        var ctx = $("#avg_selling_per_region").get(0).getContext('2d');
         if(load_first_time == true){     
	        var selector = $("#avg_selling_per_region");
	        var container = $(selector).parent();
            var ww = selector.attr('width', $(container).width() );
         }
        new Chart($("#avg_selling_per_region"), {type: 'bar', data: barChart, options: barOpts});
       
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}

function avg_selling_price(start,end,report_type) {
    var region = $('#region_id').val();
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
    
  //  console.log(region);
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/get_avg_selling_price/<?php echo $param1.'/'.$param2;?>',
        data : {'start':start,'end':end,'report_type':report_type},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log('per selling');
	    console.log(result);
	    
	    let labels_array = [];
	    let values_array = [];
	    Object.keys(result).map(function(key, index) {
	        console.log(key);
	        labels_array.push(result[key].house_types);
	        values_array.push(result[key].soldPrice);
	    });
	  
	    var barChart = {
            labels: labels_array,
            datasets: [
                {
                    label: "Average listing price per type",
                    backgroundColor: "#4385f5",
                    borderColor: "#2875f9",
                    borderWidth: 1,
                    hoverBackgroundColor: "#4385f5",
                    hoverBorderColor: "#2875f9",
                    data: values_array
                }
            ]
        };
        
        var barOpts = {
            plugins: {
                datalabels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 12,
                        min: 0,
                       stepSize: 2
                    }
                }]
            }
        };
        var ctx = $("#avg_selling_per_type").get(0).getContext('2d');
         if(load_first_time == true){     
	        var selector = $("#avg_selling_per_type");
	        var container = $(selector).parent();
            var ww = selector.attr('width', $(container).width() );
         }
        new Chart($("#avg_selling_per_type"), {type: 'bar', data: barChart, options: barOpts});
       
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}

function render_heat_map(start,end,report_type) {
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/get_postal_codes/<?php echo $param1.'/'.$param2;?>',
        data : {'start':start,'end':end,'report_type':report_type},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log(result);
	    let latLong_array = [];
	    var first_lat;
	    var first_long =0;
	    let lat_arr = [];
	    let long_arr = [];
	    for(var i=0;i<result.length;i++){
	        var geocoder = new google.maps.Geocoder();
	        if(result[i].postal_code!=''){
                var address = result[i].postal_code;
                geocoder.geocode({ 'address': address }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        lat_arr.push(latitude);
                        long_arr.push(longitude);
                        first_lat=latitude;
                        first_long=longitude;
                       
                        latLong_array = [
                            new google.maps.LatLng(latitude, longitude),
                          ];
                     //   console.log("Latitude: " + latitude + "\nLongitude: " + longitude);
                    } else {
                    //    alert("Request failed.")
                    }
                });
	        }
	    }
	     
	    //console.log("Latitude:");
	   // console.log(lat_arr);
	    setTimeout(function(){ initMap(latLong_array,first_lat,first_long); }, 1000);
	     
	       
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}

function avg_percentage_listing_off(){
    var region = $('#region_id').val();
   //var region = '66000';
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
    $.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/listing_off/<?php echo $param1.'/'.$param2;?>',
        data : {'region':region,'house_types':house_types,'axis':axis},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	     console.log(reponse);
	    var result = JSON.parse(reponse);
	    console.log(result);
        let xValues =[];
        let yValues =[];
        if(result.Y.length>0){
         xValues = result.X;   
         yValues = result.Y;   
        }
        
        
    	  new Chart("estimate_is_off", {
              type: "line",
              data: {
                labels: xValues,
                datasets: [{
                 label: "%",
                  fill: false,
                  pointRadius: 2,
                  borderColor: "rgba(0,0,255,0.5)",
                  data: yValues
                }]
              },    
              options: {
                tooltips: {
                callbacks: {
                  label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    console.log(dataset);
                    return '('+dataset.data[tooltipItem.index]+' %)';
                  //  var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                  //  var total = meta.total;
                   // var currentValue = dataset.data[tooltipItem.index];
                //    var percentage = parseFloat((currentValue/total*100).toFixed(1));
                 //   return currentValue + ' (' + percentage + '%)';
                  },
                  title: function(tooltipItem, data) {
                    return data.labels[tooltipItem[0].index];
                  }
                }
              },  
                plugins: {
                    datalabels: {
                        display: false,
                    },
                },
                legend: {display: false},
              }
            }); 
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}

let avg_listing_array = [];
function avg_listing_by_duration() {
    var region = $('#region_id').val();
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
    
  //  console.log(region);
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/get_leads_month_wise/<?php echo $param1.'/'.$param2;?>',
        data : {'region':region,'house_types':house_types,'axis':axis},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log(result);
	    const duration_array = result.duration;
	    const postal_code_array = result.region;
	    avg_listing_array = postal_code_array;
	    var barChart = {
            labels: postal_code_array,
            datasets: [
                {
                    label: "Avg Listing By Duration",
                    backgroundColor: "#4385f5",
                    borderColor: "#2875f9",
                    borderWidth: 1,
                    hoverBackgroundColor: "#4385f5",
                    hoverBorderColor: "#2875f9",
                    data: duration_array
                }
            ]
        };
        
        var barOpts = {
            plugins: {
                datalabels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 12,
                        min: 0,
                       stepSize: 2
                    }
                }]
            }
        };
        if(house_types == '' || house_types == null){
            var ctx = $("#avg_listing_by_duration").get(0).getContext('2d');
             if(load_first_time == true){    
    	        var selector = $("#avg_listing_by_duration");
    	        var container = $(selector).parent();
                var ww = selector.attr('width', $(container).width() );
             }
            new Chart($("#avg_listing_by_duration"), {type: 'bar', data: barChart, options: barOpts});
        }else{
            var ctx = $("#avg_listing_by_house_type").get(0).getContext('2d');
             if(load_first_time == true){   
    	        var selector = $("#avg_listing_by_house_type");
    	        var container = $(selector).parent();
                var ww = selector.attr('width', $(container).width() );
             }
            new Chart($("#avg_listing_by_house_type"), {type: 'bar', data: barChart, options: barOpts});
        }
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}



let chart_ids_array = [];
let house_name_array = [];
function leads_by_house_situation(start,end,report_type) {
    	$.ajax({
    	    type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/leads_by_house_situation/<?php echo $param1.'/'.$param2;?>',
            data : {'start':start,'end':end,'report_type':report_type},
      	    success: OnSuccess_,
    	    error: OnErrorCall_
    	});
    
    	function OnSuccess_(reponse) {
    	     let result = JSON.parse(reponse);
    	     console.log('repee:');
    	     console.log(result);
    	     chart_ids_array = [];
             house_name_array = [];
    	      var house_situation ='';
    	     
    	      var div='';
    	      var counter = 1;
    	      $('#round_graphs').html(div);
    	       Object.keys(result).map(function(key, index) {
                  const leads_array = [];
    	          const house_situation_array = [];
                   Object.keys(result[key]).map(function(inkey, inindex) {
                      leads_array.push(result[key][inkey].leads_count);
                      house_situation_array.push(inkey);
                   });
                house_name_array.push(key);   
                   
                var ids = "'house_type_"+index+"'";
                div ='';
                div+='<div class="col-lg-4" >';
                div+=' <div class="card m-b-30">';
                div+='    <div class="card-body">';
                div+='        <h4 class="mt-0 header-title">'+key+'</h4>';
                div+='        <canvas id="house_type_'+index+'" height="260"></canvas>';
                div+='    </div>';
                div+='</div>';
                div+='</div>';
                $('#round_graphs').append(div);
                //donut chart
                var donutChart = {
                    labels: house_situation_array,
                    datasets: [
                        {
                            data: leads_array,
                            backgroundColor: [
                                "#64b5f6",
                                "#5ea3d9",
                                "#5891bc",
                                "#517e9e",
                                "#4b6c81",
                                "#455a64"
                            ],
                            hoverBackgroundColor: [
                                "#64b5f6",
                                "#5ea3d9",
                                "#5891bc",
                                "#517e9e",
                                "#4b6c81",
                                "#455a64"
                            ],
                            hoverBorderColor: "#fff"
                        }]
                };
                
                
                 var options = {
                    responsive: true,
                         tooltips: {
                            callbacks: {
                              label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                var total = meta.total;
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                                return currentValue + ' (' + percentage + '%)';
                              },
                              title: function(tooltipItem, data) {
                                return data.labels[tooltipItem[0].index];
                              }
                            }
                          },
                             plugins: {
                            datalabels: {
                                formatter: (value, ctx) => {
                                
                                  let sum = 0;
                                  let dataArr = ctx.chart.data.datasets[0].data;
                                  dataArr.map(data => {
                                       sum += parseFloat(data);
                                  });
                                  let percentage = (value*100 / sum).toFixed(2)+"%";
                                  return percentage;
                
                              
                                },
                                color: '#fff',
                                     }
                        }
                    };
               
                 chart_ids_array.push('house_type_'+index); 
                var ctx = $("#house_type_"+index).get(0).getContext('2d');
                if(load_first_time == true){    	   
                    var selector = $("#house_type_"+index);
                    var container = $(selector).parent();
                    var ww = selector.attr('width', $(container).width() );
                }
                new Chart(ctx, {type: 'pie', data: donutChart, options: options});
                   
             });
    	   
    	}
    	function OnErrorCall_(repo) {
    	  //  alert("Woops something went wrong, pls try later !");
    	}
    }
    let region_wise_array = [];
    function listing_by_region(start,end,report_type) {
    	$.ajax({
    	    type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/get_leads_region_wise/<?php echo $param1.'/'.$param2;?>',
            data : {'start':start,'end':end,'report_type':report_type},
      	    success: OnSuccess_,
    	    error: OnErrorCall_
    	});
    
    	function OnSuccess_(reponse) {
    	     var result = JSON.parse(reponse);
    	     const leads_array = [];
    	      const postal_code_array = [];
    	      var city ='';
    	     
    	      for(var i=0;i<result.length;i++){
                  leads_array.push(result[i].total_leads);
                  city ='';
                  if(result[i].city !='' && result[i].city !=null){
                    city =result[i].city;  
                  }
                  postal_code_array.push(result[i].postal_code+' '+city);
              }
              
           region_wise_array = postal_code_array;
        	var barChart = {
                labels: postal_code_array,
                datasets: [
                    {
                        label: "Lead Analytics",
                        backgroundColor: "#4385f5",
                        borderColor: "#2875f9",
                        borderWidth: 1,
                        hoverBackgroundColor: "#4385f5",
                        hoverBorderColor: "#2875f9",
                        data: leads_array
                    }
                ]
            };
            
            var barOpts = {
                plugins: {
                    datalabels: {
                        display: false,
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                           // max: 100,
                            min: 0,
                          //  stepSize: 10
                        }
                    }]
                }
            };
       
             var ctx = $("#bar").get(0).getContext('2d');
            if(load_first_time == true){    
    	        var selector = $("#bar");
    	        var container = $(selector).parent();
                var ww = selector.attr('width', $(container).width() );
             }
            new Chart($("#bar"), {type: 'bar', data: barChart, options: barOpts});
        
        //donut chart
        var donutChart = {
            labels: postal_code_array,
            datasets: [
                {
                    data: leads_array,
                    backgroundColor: [
                        "#455a64",
                        "#5ea3d9",
                        "#64b5f6",
                        "#5891bc",
                        "#517e9e",
                        "#4b6c81"
                    ],
                    hoverBackgroundColor: [
                        "#455a64",
                        "#5ea3d9",
                        "#64b5f6",
                        "#5891bc",
                        "#517e9e",
                        "#4b6c81"
                    ],
                    hoverBorderColor: "#fff"
                }]
        };
        
        var options = {
                  responsive: true,
                  tooltips: {
                    callbacks: {
                      label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                        var total = meta.total;
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat((currentValue/total*100).toFixed(1));
                        return currentValue + ' (' + percentage + '%)';
                      },
                      title: function(tooltipItem, data) {
                        return data.labels[tooltipItem[0].index];
                      }
                    }
                  },
                     plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                        
                          let sum = 0;
                          let dataArr = ctx.chart.data.datasets[0].data;
                          dataArr.map(data => {
                              sum += parseFloat(data);
                          });
                          let percentage = (value*100 / sum).toFixed(2)+"%";
                          return percentage;
        
                      
                        },
                        color: '#fff',
                             }
                }
            };
       
        var ctx = $("#doughnut").get(0).getContext('2d');
         if(load_first_time == true){    	    	   
            var selector = $("#doughnut");
            var container = $(selector).parent();
            var ww = selector.attr('width', $(container).width() );
        }
        new Chart(ctx, {type: 'pie', data: donutChart, options: options});
        
        
        
    	}
    	function OnErrorCall_(repo) {
    	  //  alert("Woops something went wrong, pls try later !");
    	}
    }
    
    
    let imagesArray = [];
    function exportPDf(){
        var doc = new jsPDF("p", "mm", "a4");
        var width = doc.internal.pageSize.width;
        var height = doc.internal.pageSize.height;
        
        
        doc.setFont("arial", "normal");
        doc.setTextColor(0, 151, 167); 
        doc.setFontSize(18);
        doc.text(10, 10, '<?php echo $broker_data->user_name; ?>');
        
        doc.setFont("arial", "normal");
        doc.setTextColor(243 ,47 ,83); 
        doc.setFontSize(12);
        doc.text(10, 15, '<?php echo $broker_data->address; ?>');
        
        var start = $('#start').val();
        var end = $('#end').val();
        if(start!='' && end!=''){
            doc.setFont("arial", "normal");
            doc.setTextColor(0 ,0 ,0); 
            doc.setFontSize(9);
            doc.text(10, 20, start+' to '+end); 
        }
        /*doc.setDrawColor(0, 0, 0); 
        doc.line(70, 17, parseInt(width) - 70, 17);
        
        doc.setFont("arial", "normal");
        doc.setTextColor(243, 47 ,83); 
        doc.setFontSize(12);
        doc.text(82, 20, '<?php echo $broker_data->address; ?>');*/
        
        if(chart_ids_array.length>0){
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, 28, 'Percentage of type of house');
            
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, 32, parseInt(width) - 10, 32);
        }
        var StartX = 15;
        var StartY = 35;
        if(chart_ids_array.length>0){
        for(var i=0;i<chart_ids_array.length;i++){ 
                if(i>0){
                    StartX = StartX + 60;
                    if(i%3==0){
                      StartY = StartY + 70;
                      StartX = 15;
                    }
                }
            
            id= chart_ids_array[i];
            var canvas = document.getElementById(id);
            image = canvas.toDataURL("image/png");
            doc.addImage(image, 'JPEG', StartX, StartY, parseInt(width) - 145, 52);
            
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(10);
            doc.text(StartX+20, StartY+60, house_name_array[i]);
            
        }
         }
        
        
       
        if(StartY >= 175){
            doc.addPage(); 
            StartX = 5;
            StartY = 20;
        }
        if(chart_ids_array.length>0){
            StartY = StartY + 90;
            StartX = 15;
        }
        
        if(region_wise_array.length>0){
            var canvasbar = document.getElementById('bar');
            var am_list_per_region = canvasbar.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Amount of listing per region');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 110, StartY-4);
            doc.addImage(am_list_per_region, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
           
            StartX = StartX + 90;
            
            var canvasPie = document.getElementById('doughnut');
            var pie_list_per_region = canvasPie.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(StartX+10, StartY-10, 'Amount of listing per region');
            doc.setDrawColor(0, 0, 0); 
            doc.line(StartX+10, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(pie_list_per_region, 'JPEG', StartX, StartY, parseInt(width) - 100, 55);
            
            if(StartY >= 175){
                doc.addPage(); 
                StartX = 15;
                StartY = 20;
            }else{
               StartY = StartY + 90; 
               StartX = 15;
            }
            var canvastype = document.getElementById('listing_per_type');
            var am_list_per_type = canvastype.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Amount of listing per type');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 110, StartY-4);
            doc.addImage(am_list_per_type, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
            StartX = StartX + 97;
            
            var canvasavg = document.getElementById('avg_selling_per_type');
            var am_selling_per_type = canvasavg.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(StartX, StartY-10, 'Avg listing price per type');
            doc.setDrawColor(0, 0, 0); 
            doc.line(StartX, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(am_selling_per_type, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
            if(StartY >= 175){
                doc.addPage(); 
                StartX = 15;
                StartY = 20;
            }else{
               StartY = StartY + 90; 
               StartX = 15;
            }
            var canvasperRegion = document.getElementById('avg_selling_per_region');
            var am_list_per_region = canvasperRegion.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Average listing per region');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 110, StartY-4);
            doc.addImage(am_list_per_region, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
            StartX = StartX + 97;
            
            var canvasisoff = document.getElementById('estimate_is_off');
            var am_is_off = canvasisoff.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(StartX, StartY-10, 'Avg % listing price is off');
            doc.setDrawColor(0, 0, 0); 
            doc.line(StartX, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(am_is_off, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
        }
        
        if(StartY >= 175){
            doc.addPage(); 
            StartX = 5;
            StartY = 20;
        }else{
           StartY = StartY + 90; 
           StartX = 10;
        }
        
        if(avg_listing_array.length>0){
            var canvasDuration = document.getElementById('avg_listing_by_duration');
            var avg_list_per_region = canvasDuration.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Avg Listing by Duration');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(avg_list_per_region, 'JPEG', StartX, StartY, parseInt(width) - 115, 60);
            
            var house_types = $('#house_types').val();
            if(house_types !=''){
                 StartX = StartX + 97;
            
                var canvasHouse = document.getElementById('avg_listing_by_house_type');
                var avg_list_by_house = canvasHouse.toDataURL("image/png");
                doc.addImage(avg_list_by_house, 'JPEG', StartX, StartY, parseInt(width) - 100, 60);
                
            }
        }
        $.ajax({
            type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/save_export',
            success: function(response) {
               
            }
        });
       
        doc.save('<?php echo $broker_data->user_name.'_'.date("d-m-Y"); ?>.pdf');
         
    }
    
</script>
<?php } ?>

<!---dashboard page stats--->
<?php if(!empty($page_name) && $page_name=='dashboard'){ ?>

<script>
 

$(document).ready(function () {
    var today_date = moment().format('MM/DD/YYYY');
    <?php if(!empty($past_data_shown_allowed) && $past_data_shown_allowed>1){ ?>
    var starting_date = moment().subtract(<?php echo $past_data_shown_allowed; ?>, 'months').format("MM/DD/YYYY");
    <?php }else{ ?>
    var starting_date = moment().subtract(24, 'months').format("MM/DD/YYYY");
    <?php } ?>
   listing_by_date(starting_date,today_date,'');
   listing_by_region(starting_date,today_date,'');
   avg_listing_by_region(starting_date,today_date,'');
   leads_by_house_situation(starting_date,today_date,'');   
  // leads_by_house_situation('','','free_standing_house');    
  // leads_by_house_situation('','','villa');
   //estimate_region_wise(today_date,starting_date,'');
  // listing_region_wise(today_date,starting_date,'');
  
   avg_listing_by_duration();
   listing_per_type(today_date,starting_date,'');
   avg_selling_price(today_date,starting_date,'');
   avg_selling_per_region(today_date,starting_date,'');
});

function saveAsPDF(id){
      var canvas = document.getElementById(id);
      image = canvas.toDataURL("image/png", 1.0).replace("image/png", "image/octet-stream");
      var link = document.createElement('a');
      link.download = id+".png";
      link.href = image;
      link.click();
    
}
var load_first_time = true;
function get_stats_by_date(){
     load_first_time = false;
     var start = $('#start').val();
     var end = $('#end').val();
     var broker_id = $('#broker_id').val();
     var report_type = $('#report_type').val();
     listing_by_date(start,end,broker_id,report_type);
     listing_by_region(start,end,broker_id,report_type);
     avg_listing_by_region(start,end,broker_id,report_type);
     leads_by_house_situation(start,end,broker_id,report_type);
    // listing_by_region(start,end,broker_id,report_type);
     listing_per_type(start,end,broker_id,report_type);
     avg_selling_price(start,end,broker_id,report_type);
     avg_selling_per_region(start,end,broker_id,report_type);
   /* if(broker_id !=''){
        
    }else if(start!='' && end!='' && report_type==''){
       // leads_by_house_situation(start,end,''); 
        listing_by_region(start,end,''); 
        listing_per_type(start,end,''); 
        avg_selling_price(start,end,'');
        avg_selling_per_region(start,end,'');
    }else if(start=='' && end=='' && report_type!=''){
      //  leads_by_house_situation('','',report_type); 
        listing_by_region('','',report_type); 
        listing_per_type('','',report_type); 
        avg_selling_price('','',report_type);
        avg_selling_per_region('','',report_type);
    }else if(start!='' && end!='' && report_type!=''){
       // leads_by_house_situation(start,end,report_type); 
        listing_by_region(start,end,report_type); 
        listing_per_type(start,end,report_type); 
        avg_selling_price(start,end,report_type);
        avg_selling_per_region(start,end,report_type);
    }*/
    if(report_type =='lead'){
        $('.lead_listing').text('listing');
    }else if(report_type =='sold'){
        $('.lead_listing').text('sold');
    }else{
        $('.lead_listing').text('listing');
    }
    
  //  alert('true');
   /* var start = $('#start').val();
    var end =  $('#end').val();
    var broker_id = $('#broker_id').val();
    if((start!='' && end!='') || broker_id !=''){
       listing_by_date(start,end,broker_id);
       listing_by_region(start,end,broker_id);
       avg_listing_by_region(start,end,broker_id);
       estimate_region_wise(start,end,broker_id);
       listing_region_wise(start,end,broker_id);
       leads_by_house_situation(start,end,broker_id);
    }else{
        listing_by_date('','','');
       listing_by_region('','','');
       avg_listing_by_region('','','');
       estimate_region_wise('','','');
       leads_by_house_situation('','',''); 
       listing_region_wise('','',''); 
    } */
}
/* start luck */

function listing_per_type(start,end,broker_id,report_type) {
    var region = $('#region_id').val();
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
  //  alert(load_first_time);
  //  console.log(region);
  
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_listing_per_type',
        data : {'start':start,'end':end,'broker_id':broker_id,'report_type':report_type},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log('per region');
	    let labels_array = [];
	    let values_array = [];
	    Object.keys(result).map(function(key, index) {
	        console.log(key);
	        labels_array.push(result[key].house_types);
	        values_array.push(result[key].total_lead);
	    });
	  
	    var barChart = {
            labels: labels_array,
            datasets: [
                {
                    label: "Amount of listing per type",
                    backgroundColor: "#4385f5",
                    borderColor: "#2875f9",
                    borderWidth: 1,
                    hoverBackgroundColor: "#4385f5",
                    hoverBorderColor: "#2875f9",
                    data: values_array
                }
            ]
        };
        
        var barOpts = {
            plugins: {
                datalabels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 12,
                        min: 0,
                       stepSize: 2
                    }
                }]
            }
        };
        var ctx = $("#listing_per_type").get(0).getContext('2d');
      //   alert(load_first_time);
         if(load_first_time == true){   
             
	        var selector = $("#listing_per_type");
	        var container = $(selector).parent();
            var ww = selector.attr('width', $(container).width() );
         }
        new Chart($("#listing_per_type"), {type: 'bar', data: barChart, options: barOpts});
       
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}

function avg_selling_price(start,end,broker_id,report_type) {
    var region = $('#region_id').val();
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
    
  //  console.log(region);
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_avg_selling_price',
        data : {'start':start,'end':end,'broker_id':broker_id,'report_type':report_type},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log('per selling');
	    console.log(result);
	    
	    let labels_array = [];
	    let values_array = [];
	    Object.keys(result).map(function(key, index) {
	        console.log(key);
	        labels_array.push(result[key].house_types);
	        values_array.push(result[key].soldPrice);
	    });
	  
	    var barChart = {
            labels: labels_array,
            datasets: [
                {
                    label: "Average listing price per type",
                    backgroundColor: "#4385f5",
                    borderColor: "#2875f9",
                    borderWidth: 1,
                    hoverBackgroundColor: "#4385f5",
                    hoverBorderColor: "#2875f9",
                    data: values_array
                }
            ]
        };
        
        var barOpts = {
            plugins: {
                datalabels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 12,
                        min: 0,
                       stepSize: 2
                    }
                }]
            }
        };
        var ctx = $("#avg_selling_per_type").get(0).getContext('2d');
         if(load_first_time == true){     
	        var selector = $("#avg_selling_per_type");
	        var container = $(selector).parent();
            var ww = selector.attr('width', $(container).width() );
         }
        new Chart($("#avg_selling_per_type"), {type: 'bar', data: barChart, options: barOpts});
       
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}

function avg_selling_per_region(start,end,broker_id,report_type) {
    var region = $('#region_id').val();
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
    
  //  console.log(region);
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_avg_selling_price_per_region',
        data : {'start':start,'end':end,'broker_id':broker_id,'report_type':report_type},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log('per selling');
	    console.log(result);
	    
	    let labels_array = [];
	    let values_array = [];
	    Object.keys(result).map(function(key, index) {
	        console.log(key);
	        labels_array.push(result[key].postal_code);
	        values_array.push(result[key].soldPrice);
	    });
	  
	    var barChart = {
            labels: labels_array,
            datasets: [
                {
                    label: "Average listing price per region",
                    backgroundColor: "#4385f5",
                    borderColor: "#2875f9",
                    borderWidth: 1,
                    hoverBackgroundColor: "#4385f5",
                    hoverBorderColor: "#2875f9",
                    data: values_array
                }
            ]
        };
        
        var barOpts = {
            plugins: {
                datalabels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 12,
                        min: 0,
                       stepSize: 2
                    }
                }]
            }
        };
        var ctx = $("#avg_selling_per_region").get(0).getContext('2d');
         if(load_first_time == true){     
	        var selector = $("#avg_selling_per_region");
	        var container = $(selector).parent();
            var ww = selector.attr('width', $(container).width() );
         }
        new Chart($("#avg_selling_per_region"), {type: 'bar', data: barChart, options: barOpts});
       
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}

function avg_percentage_listing_off(){
    var region = $('#region_id').val()
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
    $.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/listing_off',
        data : {'region':region,'house_types':house_types,'axis':axis},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	     console.log(reponse);
	    var result = JSON.parse(reponse);
	    console.log(result);
        let xValues =[];
        let yValues =[];
        if(result.Y.length>0){
         xValues = result.X;   
         yValues = result.Y;   
        }
        
        
    	  new Chart("estimate_is_off", {
              type: "line",
              data: {
                labels: xValues,
                datasets: [{
                 label: "%",
                  fill: false,
                  pointRadius: 2,
                  borderColor: "rgba(0,0,255,0.5)",
                  data: yValues
                }]
              },    
              options: {
                tooltips: {
                callbacks: {
                  label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    console.log(dataset);
                    return '('+dataset.data[tooltipItem.index]+' %)';
                  //  var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                  //  var total = meta.total;
                   // var currentValue = dataset.data[tooltipItem.index];
                //    var percentage = parseFloat((currentValue/total*100).toFixed(1));
                 //   return currentValue + ' (' + percentage + '%)';
                  },
                  title: function(tooltipItem, data) {
                    return data.labels[tooltipItem[0].index];
                  }
                }
              },  
                plugins: {
                    datalabels: {
                        display: false,
                    },
                },
                legend: {display: false},
              }
            }); 
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}
/* end of luck */


 /*
function listing_region_wise(start,end,broker_id) {
    
    	$.ajax({
    	    type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_listing_region_wise',
            data : {'start':start,'end':end,'broker_id':broker_id},
      	    success: OnSuccess_,
    	    error: OnErrorCall_
    	});
    
    	function OnSuccess_(reponse) {
    	      var result = JSON.parse(reponse);
    	      var postal_code_array = result.postal_code;
    	      var est_array = result.est;
    	  //    console.log(est_array);
    	     // var stuff = {y: '', a: 0, b: 0 , c: 0},
    	      const data_array= [];
    	      for(var i=0;i<postal_code_array.length;i++){
    	         var val =  est_array[postal_code_array[i]];
    	         data_array.push( {y: postal_code_array[i] , a: val.positive, b: val.negative , c: val.balance} );
    	      }
    	      console.log(data_array);
    	      $('#listing_off').html(' ');
    	     var barData = data_array;
           //this.createBarChart('morris-bar-example', $barData, 'y', ['a', 'b', 'c'], ['Est-Balance', 'Est-Negative' , 'Est-Positive'], ['#0097a7', '#ffbb44', '#f32f53']);
                  Morris.Bar({
                    element: 'listing_off',
                    data: barData,
                    xkey: 'y',
                    ykeys: ['a', 'b', 'c'],
                    labels: ['Est-Positive','Est-Negative','Est-Balance'],
                    gridLineColor: '#eef0f2',
                    barSizeRatio: 0.4,
                    resize: true,
                    hideHover: 'auto',
                    barColors: ['#ffbb44', '#f32f53','#0097a7']
                });
            

        
    	}
    	function OnErrorCall_(repo) {
    	    alert("Woops something went wrong, pls try later !");
    	}
    } 
   
function estimate_region_wise(start,end,broker_id) {
    
    	$.ajax({
    	    type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_estimate_region_wise',
            data : {'start':start,'end':end,'broker_id':broker_id},
      	    success: OnSuccess_,
    	    error: OnErrorCall_
    	});
    
    	function OnSuccess_(reponse) {
    	      var result = JSON.parse(reponse);
    	      var postal_code_array = result.postal_code;
    	      var est_array = result.est;
    	  //    console.log(est_array);
    	     // var stuff = {y: '', a: 0, b: 0 , c: 0},
    	      const data_array= [];
    	      for(var i=0;i<postal_code_array.length;i++){
    	         var val =  est_array[postal_code_array[i]];
    	         data_array.push( {y: postal_code_array[i] , a: val.positive, b: val.negative , c: val.balance} );
    	      }
    	      console.log(data_array);
    	      $('#estimate_off').html(' ');
    	     var barData = data_array;
           
            //this.createBarChart('morris-bar-example', $barData, 'y', ['a', 'b', 'c'], ['Est-Balance', 'Est-Negative' , 'Est-Positive'], ['#0097a7', '#ffbb44', '#f32f53']);
                  Morris.Bar({
                    element: 'estimate_off',
                    data: barData,
                    xkey: 'y',
                    ykeys: ['a', 'b', 'c'],
                    labels: ['Est-Positive','Est-Negative','Est-Balance'],
                    gridLineColor: '#eef0f2',
                    barSizeRatio: 0.4,
                    resize: true,
                    hideHover: 'auto',
                    barColors: ['#ffbb44', '#f32f53','#0097a7']
                });
            

        
    	}
    	function OnErrorCall_(repo) {
    	    alert("Woops something went wrong, pls try later !");
    	}
    } */
    
    


function listing_by_date(start,end,broker_id,report_type) {
    
    	$.ajax({
    	    type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_leads_date_wise',
            data : {'start':start,'end':end,'broker_id':broker_id,'report_type':report_type},
      	    success: OnSuccess_,
    	    error: OnErrorCall_
    	});
    
    	function OnSuccess_(reponse) {
    	      var result = JSON.parse(reponse);
    	     
    	      const leads_array = [];
    	      const date_array = [];
    	      for(var i=0;i<result.length;i++){
                  leads_array.push(result[i].total_leads);
                  //var date = new Date(result[i].type_changed_date);
                  date_array.push( moment(result[i].sold_date).format('DD-MMM')  );
              }
           
        	   var lineChart = {
                labels: date_array,
                datasets: [
                    {
                        label: "Lead Analytics",
                        fill: true,
                        lineTension: 0.5,
                        backgroundColor: "rgba(0, 151, 167, 0.2)",
                        borderColor: "#0097a7",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "#0097a7",
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 1,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "#0097a7",
                        pointHoverBorderColor: "#eef0f2",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data:leads_array
                    }
                ]
            };
    
            var lineOpts = {
                
                scales: {
                    yAxes: [{
                        ticks: {
                            max: 100,
                            min: 0,
                            stepSize: 10
                        }
                    }]
                }
            };
    
            var ctx = $("#lineChart").get(0).getContext('2d');
            if(load_first_time == true){      	   
    	        var selector = $("#lineChart");
    	        var container = $(selector).parent();
                var ww = selector.attr('width', $(container).width() );
            }
    	    new Chart(ctx, {type: 'line', data: lineChart, options: lineOpts});
        
    	}
    	function OnErrorCall_(repo) {
    	    alert("Woops something went wrong, pls try later !");
    	}
    } 
//start,end,broker_id,report_type  
let region_wise_array = [];
    function listing_by_region(start,end,broker_id,report_type) {
    	$.ajax({
    	    type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_leads_region_wise',
            data : {'start':start,'end':end,'broker_id':broker_id,'report_type':report_type},
      	    success: OnSuccess_,
    	    error: OnErrorCall_
    	});
    
    	function OnSuccess_(reponse) {
    	     var result = JSON.parse(reponse);
    	     const leads_array = [];
    	      const postal_code_array = [];
    	      var city ='';
    	     
    	      for(var i=0;i<result.length;i++){
                  leads_array.push(result[i].total_leads);
                  city ='';
                  if(result[i].city !='' && result[i].city !=null){
                    city =result[i].city;  
                  }
                  postal_code_array.push(result[i].postal_code+' '+city);
              }
              
           region_wise_array = postal_code_array;
        	var barChart = {
                labels: postal_code_array,
                datasets: [
                    {
                        label: "Lead Analytics",
                        backgroundColor: "#4385f5",
                        borderColor: "#2875f9",
                        borderWidth: 1,
                        hoverBackgroundColor: "#4385f5",
                        hoverBorderColor: "#2875f9",
                        data: leads_array
                    }
                ]
            };
            
            var barOpts = {
                 plugins: {
                    datalabels: {
                        display: false,
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                           // max: 100,
                            min: 0,
                          //  stepSize: 10
                        }
                    }]
                }
            };
       
             var ctx = $("#bar").get(0).getContext('2d');
            if(load_first_time == true){      
    	        var selector = $("#bar");
    	        var container = $(selector).parent();
                var ww = selector.attr('width', $(container).width() );
             }
            new Chart($("#bar"), {type: 'bar', data: barChart, options: barOpts});
        
        
        //donut chart
        var donutChart = {
            labels: postal_code_array,
            datasets: [
                {
                    data: leads_array,
                    backgroundColor: [
                        "#64b5f6",
                        "#5ea3d9",
                        "#5891bc",
                        "#517e9e",
                        "#4b6c81",
                        "#455a64"
                    ],
                    hoverBackgroundColor: [
                        "#64b5f6",
                        "#5ea3d9",
                        "#5891bc",
                        "#517e9e",
                        "#4b6c81",
                        "#455a64"
                    ],
                    hoverBorderColor: "#fff"
                }]
        };
        
        
          var options =  {
            responsive: true,
             tooltips: {
                callbacks: {
                  label: function(tooltipItem, data) {
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                    var total = meta.total;
                    var currentValue = dataset.data[tooltipItem.index];
                    var percentage = parseFloat((currentValue/total*100).toFixed(1));
                    return currentValue + ' (' + percentage + '%)';
                  },
                  title: function(tooltipItem, data) {
                    return data.labels[tooltipItem[0].index];
                  }
                }
              },
          }
        var ctx = $("#doughnut").get(0).getContext('2d');
        if(load_first_time == true){   	   
            var selector = $("#doughnut");
            var container = $(selector).parent();
            var ww = selector.attr('width', $(container).width() );
        }
        new Chart(ctx, {type: 'doughnut', data: donutChart, options: options});
        
        /*
             var options = {
            // All of my other bar chart option here
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
        */
        
        
    	}
    	function OnErrorCall_(repo) {
    	  //  alert("Woops something went wrong, pls try later !");
    	}
    }
    
     function avg_listing_by_region(start,end,broker_id,report_type) {
    	$.ajax({
    	    type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/avg_listing_by_region',
            data : {'start':start,'end':end,'broker_id':broker_id,'report_type':report_type},
      	    success: OnSuccess_,
    	    error: OnErrorCall_
    	});
    
    	function OnSuccess_(reponse) {
    	     var result = JSON.parse(reponse);
    	     const leads_array = [];
    	      const postal_code_array = [];
    	      var city ='';
    	     
    	      for(var i=0;i<result.length;i++){
                  leads_array.push(result[i].listing_price);
                  city ='';
                  if(result[i].city !='' && result[i].city !=null){
                    city =result[i].city;  
                  }
                  postal_code_array.push(result[i].postal_code+' '+city);
              }
              
           
        	var barChart = {
                labels: postal_code_array,
                datasets: [
                    {
                        label: "Avg Listing Price Per Region",
                        backgroundColor: "#4385f5",
                        borderColor: "#2875f9",
                        borderWidth: 1,
                        hoverBackgroundColor: "#4385f5",
                        hoverBorderColor: "#2875f9",
                        data: leads_array
                    }
                ]
            };
            
            var barOpts = {
                 plugins: {
                    datalabels: {
                        display: false,
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                           // max: 100,
                            min: 0,
                          //  stepSize: 10
                        }
                    }]
                }
            };
       
             var ctx = $("#avg_listing_by_region").get(0).getContext('2d');
            if(load_first_time == true){      
    	        var selector = $("#avg_listing_by_region");
    	        var container = $(selector).parent();
                var ww = selector.attr('width', $(container).width() );
             }
            new Chart($("#avg_listing_by_region"), {type: 'bar', data: barChart, options: barOpts});
         
    	}
    	function OnErrorCall_(repo) {
    	  //  alert("Woops something went wrong, pls try later !");
    	}
    }
//avg duration 
let avg_listing_array = [];
var listing_load =false;
function avg_listing_by_duration() {
    var region = $('#region_id').val();
    var house_types = $('#house_types').val();
    var axis = $('#axis').val();
    
  //  console.log(region);
	$.ajax({
	    type : 'POST',
        url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_leads_month_wise',
        data : {'region':region,'house_types':house_types,'axis':axis},
  	    success: OnSuccess_,
	    error: OnErrorCall_
	});

	function OnSuccess_(reponse) {
	    var result = JSON.parse(reponse);
	    console.log(result);
	    const duration_array = result.duration;
	    const postal_code_array = result.region;
	    avg_listing_array = postal_code_array;
	    var barChart = {
            labels: postal_code_array,
            datasets: [
                {
                    label: "Avg Listing By Duration",
                    backgroundColor: "#4385f5",
                    borderColor: "#2875f9",
                    borderWidth: 1,
                    hoverBackgroundColor: "#4385f5",
                    hoverBorderColor: "#2875f9",
                    data: duration_array
                }
            ]
        };
        
        var barOpts = {
            plugins: {
                datalabels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        max: 12,
                        min: 0,
                       stepSize: 2
                    }
                }]
            }
        };
        if(house_types == '' || house_types == null){
            var ctx = $("#avg_listing_by_duration").get(0).getContext('2d');
             if(load_first_time == true){    
    	        var selector = $("#avg_listing_by_duration");
    	        var container = $(selector).parent();
                var ww = selector.attr('width', $(container).width() );
             }
            new Chart($("#avg_listing_by_duration"), {type: 'bar', data: barChart, options: barOpts});
        }else{
            var ctx = $("#avg_listing_by_house_type").get(0).getContext('2d');
             if(listing_load == false){   
    	        var selector = $("#avg_listing_by_house_type");
    	        var container = $(selector).parent();
                var ww = selector.attr('width', $(container).width() );
                listing_load = true;
             }
            new Chart($("#avg_listing_by_house_type"), {type: 'bar', data: barChart, options: barOpts});
        }
         
     
	}
	function OnErrorCall_(repo) {
	  //  alert("Woops something went wrong, pls try later !");
	}
}
let chart_ids_array = [];
let house_name_array = [];
function leads_by_house_situation(start,end,broker_id,report_type) {
    	$.ajax({
    	    type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/leads_by_house_situation',
            data : {'start':start,'end':end,'broker_id':broker_id,'report_type':report_type},
      	    success: OnSuccess_,
    	    error: OnErrorCall_
    	});
    
    	function OnSuccess_(reponse) {
    	     let result = JSON.parse(reponse);
    	     console.log('repee:');
    	     console.log(result);
    	     chart_ids_array = [];
             house_name_array = [];
    	      var house_situation ='';
    	     
    	      var div='';
    	      var counter = 1;
    	      $('#round_graphs').html(div);
    	       Object.keys(result).map(function(key, index) {
                  const leads_array = [];
    	          const house_situation_array = [];
                   Object.keys(result[key]).map(function(inkey, inindex) {
                      leads_array.push(result[key][inkey].leads_count);
                      house_situation_array.push(inkey);
                   });
                house_name_array.push(key);   
                   
                var ids = "'house_type_"+index+"'";
                div ='';
                div+='<div class="col-lg-4" >';
                div+=' <div class="card m-b-30">';
                div+='    <div class="card-body">';
                div+='        <h4 class="mt-0 header-title">'+key+'</h4>';
                div+='        <canvas id="house_type_'+index+'" height="260"></canvas>';
                div+='    </div>';
                div+='</div>';
                div+='</div>';
                $('#round_graphs').append(div);
                //donut chart
                var donutChart = {
                    labels: house_situation_array,
                    datasets: [
                        {
                            data: leads_array,
                            backgroundColor: [
                                "#64b5f6",
                                "#5ea3d9",
                                "#5891bc",
                                "#517e9e",
                                "#4b6c81",
                                "#455a64"
                            ],
                            hoverBackgroundColor: [
                                "#64b5f6",
                                "#5ea3d9",
                                "#5891bc",
                                "#517e9e",
                                "#4b6c81",
                                "#455a64"
                            ],
                            hoverBorderColor: "#fff"
                        }]
                };
                
                
                 var options = {
                    responsive: true,
                         tooltips: {
                            callbacks: {
                              label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                var total = meta.total;
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                                return currentValue + ' (' + percentage + '%)';
                              },
                              title: function(tooltipItem, data) {
                                return data.labels[tooltipItem[0].index];
                              }
                            }
                          },
                             plugins: {
                            datalabels: {
                                formatter: (value, ctx) => {
                                
                                  let sum = 0;
                                  let dataArr = ctx.chart.data.datasets[0].data;
                                  dataArr.map(data => {
                                       sum += parseFloat(data);
                                  });
                                  let percentage = (value*100 / sum).toFixed(2)+"%";
                                  return percentage;
                
                              
                                },
                                color: '#fff',
                                     }
                        }
                    };
               
                 chart_ids_array.push('house_type_'+index); 
                var ctx = $("#house_type_"+index).get(0).getContext('2d');
                if(load_first_time == true){    	   
                    var selector = $("#house_type_"+index);
                    var container = $(selector).parent();
                    var ww = selector.attr('width', $(container).width() );
                }
                new Chart(ctx, {type: 'pie', data: donutChart, options: options});
                   
             });
    	   
    	}
    	function OnErrorCall_(repo) {
    	  //  alert("Woops something went wrong, pls try later !");
    	}
    }
 function exportDashboardPDf(){
        var doc = new jsPDF("p", "mm", "a4");
        var width = doc.internal.pageSize.width;
        var height = doc.internal.pageSize.height;
        
        
        doc.setFont("arial", "normal");
        doc.setTextColor(0, 151, 167); 
        doc.setFontSize(18);
        doc.text(10, 10, '<?php echo $user_dt->user_name; ?>');
        
        doc.setFont("arial", "normal");
        doc.setTextColor(243 ,47 ,83); 
        doc.setFontSize(12);
        doc.text(10, 15, '<?php echo $user_dt->address; ?>');
        
        var start = $('#start').val();
        var end = $('#end').val();
        if(start!='' && end!=''){
            doc.setFont("arial", "normal");
            doc.setTextColor(0 ,0 ,0); 
            doc.setFontSize(9);
            doc.text(10, 20, start+' to '+end); 
        }
       
        
        if(chart_ids_array.length>0){
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, 28, 'Percentage of type of house');
            
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, 32, parseInt(width) - 10, 32);
        }
        var StartX = 15;
        var StartY = 35;
        if(chart_ids_array.length>0){
        for(var i=0;i<chart_ids_array.length;i++){ 
                if(i>0){
                    StartX = StartX + 60;
                    if(i%3==0){
                      StartY = StartY + 70;
                      StartX = 15;
                    }
                }
            
            id= chart_ids_array[i];
            var canvas = document.getElementById(id);
            image = canvas.toDataURL("image/png");
            doc.addImage(image, 'JPEG', StartX, StartY, parseInt(width) - 145, 52);
            
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(10);
            doc.text(StartX+20, StartY+60, house_name_array[i]);
            
        }
         }
        
        
       
        if(StartY >= 175){
            doc.addPage(); 
            StartX = 5;
            StartY = 20;
        }
        if(chart_ids_array.length>0){
            StartY = StartY + 90;
            StartX = 15;
        }
        
        if(region_wise_array.length>0){
            var canvasbar = document.getElementById('bar');
            var am_list_per_region = canvasbar.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Amount of listing per region');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 110, StartY-4);
            doc.addImage(am_list_per_region, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
           
            StartX = StartX + 90;
            
            var canvasPie = document.getElementById('doughnut');
            var pie_list_per_region = canvasPie.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(StartX+10, StartY-10, 'Amount of listing per region');
            doc.setDrawColor(0, 0, 0); 
            doc.line(StartX+10, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(pie_list_per_region, 'JPEG', StartX, StartY, parseInt(width) - 100, 55);
            
            if(StartY >= 175){
                doc.addPage(); 
                StartX = 15;
                StartY = 20;
            }else{
               StartY = StartY + 90; 
               StartX = 15;
            }
            
            
            
            var canvastypes = document.getElementById('lineChart');
            var am_list_per_types = canvastypes.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Amount of listing');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 110, StartY-4);
            doc.addImage(am_list_per_types, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
            StartX = StartX + 97;
            
            var canvasavgs = document.getElementById('avg_listing_by_region');
            var am_selling_per_types = canvasavgs.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(StartX, StartY-10, 'Average Asking Price Per Region');
            doc.setDrawColor(0, 0, 0); 
            doc.line(StartX, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(am_selling_per_types, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
            if(StartY >= 175){
                doc.addPage(); 
                StartX = 15;
                StartY = 20;
            }else{
               StartY = StartY + 90; 
               StartX = 15;
            }
            
            var canvastype = document.getElementById('listing_per_type');
            var am_list_per_type = canvastype.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Amount of listing per type');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 110, StartY-4);
            doc.addImage(am_list_per_type, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
            StartX = StartX + 97;
            
            var canvasavg = document.getElementById('avg_selling_per_type');
            var am_selling_per_type = canvasavg.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(StartX, StartY-10, 'Avg listing price per type');
            doc.setDrawColor(0, 0, 0); 
            doc.line(StartX, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(am_selling_per_type, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
            if(StartY >= 175){
                doc.addPage(); 
                StartX = 15;
                StartY = 20;
            }else{
               StartY = StartY + 90; 
               StartX = 15;
            }
            var canvasperRegion = document.getElementById('avg_selling_per_region');
            var am_list_per_region = canvasperRegion.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Average listing per region');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 110, StartY-4);
            doc.addImage(am_list_per_region, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
            
            StartX = StartX + 97;
            
            var canvasisoff = document.getElementById('estimate_is_off');
            var am_is_off = canvasisoff.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(StartX, StartY-10, 'Avg % listing price is off');
            doc.setDrawColor(0, 0, 0); 
            doc.line(StartX, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(am_is_off, 'JPEG', StartX, StartY, parseInt(width) - 115, 55);
        }
        
        if(StartY >= 175){
            doc.addPage(); 
            StartX = 5;
            StartY = 20;
        }else{
           StartY = StartY + 90; 
           StartX = 10;
        }
        
        if(avg_listing_array.length>0){
            var canvasDuration = document.getElementById('avg_listing_by_duration');
            var avg_list_per_region = canvasDuration.toDataURL("image/png");
            doc.setFont("arial", "normal");
            doc.setTextColor(0, 0, 0); 
            doc.setFontSize(14);
            doc.text(10, StartY-10, 'Avg Listing by Duration');
            doc.setDrawColor(0, 0, 0); 
            doc.line(10, StartY-4, parseInt(width) - 10, StartY-4);
            doc.addImage(avg_list_per_region, 'JPEG', StartX, StartY, parseInt(width) - 115, 60);
            
            var house_types = $('#house_types').val();
            if(house_types !=''){
                 StartX = StartX + 97;
            
                var canvasHouse = document.getElementById('avg_listing_by_house_type');
                var avg_list_by_house = canvasHouse.toDataURL("image/png");
                doc.addImage(avg_list_by_house, 'JPEG', StartX, StartY, parseInt(width) - 100, 60);
                
            }
        }
        $.ajax({
            type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/export_report/save_export',
            success: function(response) {
               
            }
        });
       
        doc.save('<?php echo $user_dt->user_name.'_'.date("d-m-Y"); ?>.pdf');
         
    }

    function get_customer_data(postal_code,key){
           
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_leads_detail',
                data : {'postal_code':postal_code},
                success: function(response) {
                    $('#tbl_bd_'+key).html(response);
                    //$('#modal_ajax').toggle();
                }
            });
    }
    function get_regions(value){
        $('#accordion').html('<div class="row text-center"><div class="col-md-5"></div><div class="col-md-2"><div class="loaders" ></div></div></div>');
        $.ajax({
            type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_data_by_employee',
            data : {'id':value},
            success: function(response) {
                $('#accordion').html(response);
            }
        }); 
    }
    function get_employees(value){
        $.ajax({
            type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/dashboard_stats/get_employee_list',
            data : {'id':value},
            success: function(response) {
                $('#employee_id').html(response);
            }
        }); 
    }
</script>
<?php }?>
<script>
function revenue_field(value){
    $('#revenue').css('display','none');
    if(value=="customer"){
        $('#revenue').css('display','-webkit-inline-box');
    }
}


    $(document).on('click','.cb-value',function() {
        var mainParent = $(this).parent('.toggle-btn1');
        console.log($('.cb-value'));
        if($(mainParent).find('input.cb-value').is(':checked')) {
            $(mainParent).addClass('active');
            var user_id = $(this).val();
            //var user_id    =  $(this).attr('title');
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/update_status',
                data : {'id':user_id,'status':'Active'},
                success: function(response) {
                    //alert(response);
                    if(response == 'success'){
                        notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    }else{
                        notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                    }
                    //$('#modal_ajax').toggle();
                }
            });
        } else {
            $(mainParent).removeClass('active');
            var user_id = $(this).val();
            //var user_id    =  $(this).attr('title');
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/update_status',
                data : {'id':user_id,'status':'Inactive'},
                success: function(response) {
                    console.log(response);
                    if(response == 'success'){
                        notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    }else{
                        notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                    }
                    //$('#modal_ajax').toggle();
                }
            });
        }

    })
    
    function changeDate(param){
        var start_date = $('#datepicker-autoclose-two').val();
        var new_date = moment(start_date, "dd/mm/yyyy").add(param, 'M');
        $('#datepicker-autoclose').val(new_date.format('MM/DD/YYYY'));
    }
    
    
    function getTemplate(id) {
       $.ajax({
            type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/manage_template/get_template_data',
            // dataType: "json",
            data : {'id':id},
            success: function(response) {
                // console.log(response);
                data = $.parseJSON( response );
                $('#subject').val(data.subject);
                $('textarea#body').summernote('pasteHTML',data.body);
                // $('#template_body').val(data.body);
                // $('#template_body').html("hidsdss");
                // var data = json_decode(response);
                //  $("#template_subject").val(response);
                // console.log(response[0].subject);
                // var json_data =$.parseJSON(response);
                // console.log(json_data.subject);
                // $.each(response,function(key,value){
                //     console.log(value["subject"]);
                // });
            }
            
        });
        $('textarea#body').summernote('reset');
         
    }
      

   
    function submit_Lead(){
       
        var first_name =  $('#first_name').val();
        var last_name =  $('#last_name').val();
        var email =  $('#email').val();
        var code =  $('#code').val();
        var phone =  $('#phone').val();
        var house_type = $( "#house_type").val();
        var situation = $( "#situation").val();
        var est_price =  $('#est_price').val();
        var lst_price =  $('#lst_price').val();
        if(first_name ==''){
            notify('fa fa-comments', 'danger', 'Title ', 'Firstname is Required');
            
        }
        else if(last_name ==''){
          notify('fa fa-comments', 'danger', 'Title ', 'Last Name is Required');
        }
        else if(email ==''){
            notify('fa fa-comments', 'danger', 'Title ', 'Email ID is Required');
        }
        else if(code ==''){
           notify('fa fa-comments', 'danger', 'Title ', 'Postal Code is Required');
        }
        // else if(phone ==''){
        //   notify('fa fa-comments', 'danger', 'Title ', 'Phone Number is Required');
        // }
        else if(house_type =='' ||  house_type == null){
           notify('fa fa-comments', 'danger', 'Title ', 'House Type is Required');
        }
        else if(situation == '' || situation == null ){
            notify('fa fa-comments', 'danger', 'Title ', 'House Situation is Required');
        }
       /* else if(est_price ==''){
           notify('fa fa-comments', 'danger', 'Title ', 'Estimated Price is Required');
        }
        else if(lst_price ==''){
             notify('fa fa-comments', 'danger', 'Title ', 'Listing Price is Required');
        }*/
        else if(($('#check')[0].checked)){
            var subject  = $('#subject').val();
            var body  = $('textarea#body').val();
             if(subject =='' || body ==''){
                 notify('fa fa-comments', 'danger', 'Title ', 'Subject and Body of Email is required!');
                 $('#sendEmail').modal('show');
             }else if(subject !='' && body !=''){
                $('form[name=add_lead]').submit();
            }
            
        }
        else{
            
            $("#btn_add_lead").attr("type","submit");
        }
        
        
    
    }

   function CheckEmail(value,id){
		$.ajax({
			type : 'POST',    
			url : '<?php echo base_url(); ?>admin/userSystemEmail', 
			data : {'users_system_id':id,'email':value},
			success: function(response) {
				console.log(response);
				if(value !=''){
					if(response == 'exist'){
						$('#error_email').text('Email Already Exist');
						$('#btn_update_user').addClass('btnDisabled');
					}else{
						$('#error_email').text(' ');
						$('#btn_update_user').removeClass('btnDisabled');
					}
				}
			}
		});
	} 
	function CheckEmailExist(value){
		$.ajax({
			type : 'POST',    
			url : '<?php echo base_url(); ?>admin/userSystemEmailExist', 
			data : {'email':value},
			success: function(response) {
				console.log(response);
				if(value !=''){
					if(response == 'exist'){
						$('#error_email').text('Email Already Exist');
						$('#btn_update_user').addClass('btnDisabled');
					}else{
						$('#error_email').text(' ');
						$('#btn_update_user').removeClass('btnDisabled');
					}
				}
			}
		});
	} 
	function windowReload(){
	    location.reload();
	}
       /* if($('#check')[0].checked){
            var subject  = $('#subject').val();
            var body  = $('#body').val();
            if(subject =='' || body ==''){
                 notify('fa fa-comments', 'danger', 'Title ', 'subject and Body of Email is required!');
                 $('#sendEmail').modal('show');
                
            }else if(subject !='' && body !=''){
                $('form[name=add_lead]').submit();
            }
         }
         else{
          $("#btn_add_lead").attr("type", "submit");   
         }
         
        */
        
        
        
          /*  if($('#check')[0].checked){
                    $("input[name='btn']").prop("type","validate");
                    // $("#subject").attr("required", "true");
                    // $("textarea#body").attr("required", "true");
                     if ($('#subject,textarea#body').is(':empty')){
                       
                    }
                    // else{
                    //      $('#sendEmail').modal('hide');         
                    // }
                }
            
            else{
               
                $("input[name='btn']").prop("type","submit");
                
            } */
        
    
    
    
</script>

<script>


    $(document).on('click','.cb-value',function() {
        var mainParent = $(this).parent('.toggle-btn1');
        console.log($('.cb-value'));
        if($(mainParent).find('input.cb-value').is(':checked')) {
            $(mainParent).addClass('active');
            var user_id = $(this).val();
            //var user_id    =  $(this).attr('title');
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/update_status',
                data : {'id':user_id,'status':'Active'},
                success: function(response) {
                    //alert(response);
                    if(response == 'success'){
                        notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    }else{
                        notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                    }
                    //$('#modal_ajax').toggle();
                }
            });
        } else {
            $(mainParent).removeClass('active');
            var user_id = $(this).val();
            //var user_id    =  $(this).attr('title');
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/update_status',
                data : {'id':user_id,'status':'Inactive'},
                success: function(response) {
                    console.log(response);
                    if(response == 'success'){
                        notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    }else{
                        notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                    }
                    //$('#modal_ajax').toggle();
                }
            });
        }

    })
    
    function changeDate(param){
        var start_date = $('#datepicker-autoclose-two').val();
        var new_date = moment(start_date, "dd/mm/yyyy").add(param, 'M');
        $('#datepicker-autoclose').val(new_date.format('MM/DD/YYYY'));
    }
    
    
    function getTemplate(id) {
       $.ajax({
            type : 'POST',
            url : '<?php echo base_url(); ?><?=admin_ctrl()?>/manage_template/get_template_data',
            // dataType: "json",
            data : {'id':id},
            success: function(response) {
                // console.log(response);
                data = $.parseJSON( response );
                $('#subject').val(data.subject);
                $('textarea#body').summernote('pasteHTML',data.body);
           
            }
            
        });
        $('textarea#body').summernote('reset');
         
    }
      

   function save_language(id,lang){
    	var phrase_value = $('#phrase_'+id).val();
    	$.ajax({
    		type : 'POST',    
    		url : '<?php echo base_url(); ?>admin/edit_language/edit', 
    		data : {'phrase_id':id,'lang':lang,'phrase_value':phrase_value},
    		success: function(response) {
    			//alert(response);
    			if(response == 'success'){
    				notify('fa fa-comments', 'success', 'Title ', 'Successfully added!');
    			}else{
    				notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
    			}
    			//$('#modal_ajax').toggle();	
    		}
    	});
    }
    function changeLanguage(lang) {
        $.ajax({
            url:"<?php echo base_url(); ?>admin/change_language",
            type:'post',
            data:{lang:lang},
            success:function(response){
                console.log(response)
               // location.href="<?php echo base_url(); ?>";
            //  location.reload();
            }
        })
    }
   function CheckEmail(value,id){
		$.ajax({
			type : 'POST',    
			url : '<?php echo base_url(); ?>admin/userSystemEmail', 
			data : {'users_system_id':id,'email':value},
			success: function(response) {
				console.log(response);
				if(value !=''){
					if(response == 'exist'){
						$('#error_email').text('Email Already Exist');
						$('#btn_update_user').addClass('btnDisabled');
					}else{
						$('#error_email').text(' ');
						$('#btn_update_user').removeClass('btnDisabled');
					}
				}
			}
		});
	} 
	function CheckEmailExist(value){
		$.ajax({
			type : 'POST',    
			url : '<?php echo base_url(); ?>admin/userSystemEmailExist', 
			data : {'email':value},
			success: function(response) {
				console.log(response);
				if(value !=''){
					if(response == 'exist'){
						$('#error_email').text('Email Already Exist');
						$('#btn_update_user').addClass('btnDisabled');
					}else{
						$('#error_email').text(' ');
						$('#btn_update_user').removeClass('btnDisabled');
					}
				}
			}
		});
	} 
	function removeProduct(index){
	    $('#product_id_'+index).remove();
	}
	function clone_product(){
	    var index = $('.single_product').length;
	    var div='';
	    div+='<div class="single_product" id="product_id_'+index+'">';
	    div+='    <div class="col-md-12 text-center">';
	    div+='         <button class="btn btn-danger btn_add" onclick="removeProduct('+index+')"><i class="fa fa-minus"></i></button>';
	    div+='    </div>';
	    div+='    <div class="row">';
		div+='        <div class="col-sm-6 my-2">';
		div+='			<label class="col-sm-12 col-form-labell">标题<sup class="text-danger">*</sup>:</label>';
		div+='			<div class="col-sm-12">';
		div+='			    <input type="text" name="title[]" class="form-control" placeholder="" required>';
		div+='			</div>';
		div+='		</div>';
		div+='		<div class="col-sm-6 my-2">';
		div+='			<label class="col-sm-12 col-form-labell">字幕 <sup class="text-danger">*</sup>:</label>';
		div+='			<div class="col-sm-12">';
		div+='			    <input type="text" name="sub_title[]" class="form-control" placeholder="" required>';
		div+='			</div>';
		div+='		</div>';
		div+='		<div class="col-sm-6 my-2">';
		div+='		    <label class="col-sm-12 col-form-labell"> 图片<sup class="text-danger">*</sup>:</label>';
		div+='			<div class="col-sm-12">';
		div+='			    <input type="file" name="images['+index+'][]" class="form-control" placeholder="" multiple required>';
		div+='			</div>';
		div+='		</div>';
		div+='    </div>';
		div+='	<div class="row my-2" style="">';
		div+='		<div class="col-sm-12">';
		div+='		<label class="col-sm-12 col-form-label">描述<sup class="text-danger">*</sup>:</label>';
		div+='		<div class="col-sm-12">';
		div+='			<textarea rows="5" cols="5" name="description[]" class="form-control summernote" id="sum_note_'+index+'" placeholder="product description" required></textarea>';
		div+='		</div>';
		div+='		</div>';
		div+='	</div>';
		div+='</div>';
		$('.multi_product_section').append(div);
		 $('#sum_note_'+index).summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                 // set focus to editable area after initializing summernote
        });
	}
	function windowReload(){
	    location.reload();
	}
</script>