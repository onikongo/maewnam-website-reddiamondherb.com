var product = {
	add : function(){
		var dlg = $("#modelDialog");
		var frm = $("#form_add_product");
		var valid = true;
		var errorMessage = "";
		
		if(frm.find("input[name=txtTitle]").val().length == 0){
			valid = false;
			errorMessage += "<li>Please input deal name</li>";
		}
		
		if(valid){
			
			var schedule = {};
			for(i in fn.app.product.schedule.data){
				schedule[i] = fn.app.product.schedule.data[i];
			}
			
			$.ajax({
				url: "apps/product/xhr/action-add-product.php",
				data : frm.serialize() + '&' + $.param({schedule : schedule}),
				type: "POST",
				dataType: "json",
				success: function(json){
					if(!json.success){
						valid = false;
						errorMessage += "<li>"+json.msg+"</li>";
					}
					
					var html = '';
					if(valid){
						fn.dialog.success("Save Complete",function(){
							fn.navigate('view');
						});
					}else{
						fn.dialog.caution(errorMessage);
								
					}
	
				}
			});
		}else{
			fn.dialog.caution(errorMessage);
		}
		
	},
	edit : function(){
		var dlg = $("#modelDialog");
		var frm = $("#form_add_product");
		var valid = true;
		var errorMessage = "";
		
		if(frm.find("input[name=txtTitle]").val().length == 0){
			valid = false;
			errorMessage += "<li>Please input deal name</li>";
		}
		
		if(valid){
			
			var schedule = {};
			for(i in fn.app.product.schedule.data){
				schedule[i] = fn.app.product.schedule.data[i];
			}
			
			$.ajax({
				url: "apps/product/xhr/action-edit-product.php",
				data : frm.serialize() + '&' + $.param({schedule : schedule}),
				type: "POST",
				dataType: "json",
				success: function(json){
					if(!json.success){
						valid = false;
						errorMessage += "<li>"+json.msg+"</li>";
					}
					
					var html = '';
					if(valid){
						fn.dialog.success("Save Complete",function(){
							fn.navigate('view');
						});
					}else{
						fn.dialog.caution(errorMessage);
								
					}
	
				}
			});
		}else{
			fn.dialog.caution(errorMessage);
		}
	},
	remove : function(){
		
	},
	schedule : {
		data : [],
		showTimebox : function(schedule){
			var s = '';
			var time_slot = [];
			for(i in schedule.schedule){
				var time_schedule = schedule.schedule[i];
				
				var found_position = -1;
				for(j in time_slot){
					if(time_slot[j].day == time_schedule[0]){
						found_position = j;
					}
				}
				
				var txtTime = "";
				if(time_schedule.length==1){
					txtTime = "All Day";
				}else{
					txtTime += time_schedule[1];
					txtTime += "-";
					txtTime += time_schedule[2];
				}
						
				if(found_position > -1){
					time_slot[found_position].time.push(txtTime);
				}else{
					time_slot.push({
						day : time_schedule[0],
						time : [txtTime]
					});
				}
			};
			
			var date_start = new Date(schedule.start);
			var date_end = new Date(schedule.end);
			var aWeek=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
			
			s += '<li class="list-group-item">';
				s += '<p>Date : '+date_start.format("F,d Y")+' - '+date_end.format("F,d Y")+'</p>';
				s += '<dl class="dl-horizontal">';
				
				for (i in time_slot){
					s += '<dt>' + aWeek[time_slot[i].day] +'</dt>';
					s += '<dd>';
						s += time_slot[i].time.join(',');
					s += '</dd>';		
				}
				s+= '</dl>';
				s+= '<span class="badge btn" onclick="($(this).parent().remove())">Remove</span>';
				s+= '<p>Exception : -</p>';
			s+= ' </li>';

			return s;
		},
		add : function(tab,id){
			$.ajax({
				url: "apps/product/view/dialog.schedule.add.php",
				type: "POST",
				dataType: "html",
				data:{id:id},
				success: function(html){
				$("body").append("<div id=\"dialog_add_schedule\"></div>");
					$("#dialog_add_schedule").html(html);
					$("#dialog_add_schedule").dialog({
						autoOpen : true,
						title : "Dialog Add Schedule",
						width : 1000,
						height : 650,
						modal : true,
						buttons : [
							{text : "Append Schedule", class: 'btn btn-primary pull-left', click: function() {
								fn.app.product.schedule.add_time_frame();
							}},
							{text : "Save", class: 'saveButtonClass btn btn-primary pull-right', click: function() {
								var valid = true;
								var errorMessage = "";
								
								if($("#add_schedule").find(".txstart").val().length == 0){
									valid = false;
									errorMessage += "<li>Please input Start Date</li>";
								}
								
								if($("#add_schedule").find(".txend").val().length == 0){
									valid = false;
									errorMessage += "<li>Please input End Date</li>";
								}
								
								if($("#add_schedule").find(".txseat").val().length == 0){
									valid = false;
									errorMessage += "<li>Please input Seat Number</li>";
								}
								
								if(valid){
									var time_schedule = [];
									var schedule = {
										branch : id,
										start : $("#add_schedule").find(".txstart").val(),
										end : $("#add_schedule").find(".txend").val(),
										seat : $("#add_schedule").find(".txseat").val(),
										schedule : [],
										exception : []
									}
									
									$(".weekItem").each(function(){
										if($(this).find(".chkDay").is(":checked")){
											time_schedule.push([
												$(this).find(".txtDay").val()
											]);
										}else{
											time_schedule.push([
												$(this).find(".txtDay").val(),
												$(this).find(".txtStartTime").val(),
												$(this).find(".txtEndTime").val()
											]);
										}
									});
									schedule.schedule = time_schedule;
									
									$(tab).find(".items_schedule").append(fn.app.product.schedule.showTimebox(schedule));
									fn.app.product.schedule.data.push(schedule);
									$("#dialog_add_schedule").dialog("destroy").remove();
								}else{
									fn.dialog.caution(errorMessage);
								}
							}},
							{text : "Cancel", class : "btn btn-default pull-right", click: function() { $("#dialog_add_schedule").dialog("destroy").remove(); }},
						],close: function(){
							$("#dialog_add_schedule").dialog("destroy").remove();
						}
					});
					
				}
			});
		},
		edit : function(){
			
		},
		remove : function(){
			
		},
		add_time_frame : function(){
			var aWeek = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
			var w ='';
			w += '<div class="weekItem row" style="margin-top:5px;">';
				w += '<label class="col-sm-1 control-label">Week</label>';
				w += '<div class="col-sm-2">';
						w += '<select class="form-control txtDay" name="weekday[]" id="weekday">';
						for(var i = 0; i< aWeek.length; i++){
							w += '<option value="'+ i +'">'+ aWeek[i] +'</option>';
						}
                        w += '</select>';
				w += '</div>';
				w += '<div class="col-sm-1">';
					w += '<input type="checkbox" class="chkDay" name="allday[]" id="allday" value="allday"> Day';
				w += '</div>';
				w += '<label class="col-sm-1 control-label">Start</label>';
				w += '<div class="col-sm-2">';
						w+= '<input type="time" class="form-control txtStartTime" id="txtStartTime" value="09:00:00">';
				w += '</div>';
				w += '<label class="col-sm-1 control-label">End</label>';
				w += '<div class="col-sm-2">';
						w+= '<input type="time" class="form-control txtEndTime" id="txtEndTime" value="18:00:00">';
				w += '</div>';
				
				w += '<div class="col-sm-2">';
					w += '<button type="button" class="btn btn-danger" onClick="$(this).parent().parent().remove();">';
						w += '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
					w += '</button>';
				w += '</div>';
			w += '</div>';
			$("#panelSchedule").append(w);
		},
		dialog_add : function(tab,id){
			$.ajax({
				url: "apps/product/view/dialog_add_schedule.php",
				type: "POST",
				dataType: "html",
				data:{id:id},
				success: function(html){
				$("body").append("<div id=\"dialog_add_schedule\"></div>");
					$("#dialog_add_schedule").html(html);
					$("#dialog_add_schedule").dialog({
						autoOpen : true,
						title : "Dialog Add Schedule",
						width : 1000,
						height : 650,
						modal : true,
						buttons : [
							{text : "Add Schedule", class: 'saveButtonClass btn btn-primary pull-right', click: function() {
								fn.app.product.schedule.add_time(tab,id);
							}},
							{text : "Cancel", class : "btn btn-default pull-right", click: function() { $("#dialog_add_schedule").dialog("destroy").remove(); }},
						],close: function(){
							$("#dialog_add_schedule").dialog("destroy").remove();
						}
					});
					
				}
			});
		}
	},
	dialog_hightlight : function(id,me){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/product/xhr/action-hightlight.php",
			data: {id:id},
			success : function(json)
			{
				//$(".hl").removeClass('btn-default');
				if($(me).hasClass('btn-danger'))
				{
					$(me).removeClass('btn-danger');
					$(me).addClass('btn-default');
				}
				else
				{
					$(me).addClass('btn-danger');
				}
				
			}
		});
	},
	append_brand : function(){
			var s = '';
			s += '<li class="list-group-item">';
				s += '<input type="hidden" name="bran[]" value="'+$("#proptype").val()+'">';
				s += $("#proptype option:selected").text();
				s += '<span class="badge" style="cursor:pointer" onclick="fn.app.product.pop(this)">Remove</span>';
				//s += ' <input type="number" name="numb['+$("#selbrand").val()+']" max="100" style="width:50px;">';
			s += '</li>';
			$("#ulTag").append(s);
		},
	pop : function(me){
		$(me).parent().remove();
	},
	dialog_photo : {
		open_elfinder : function(){
			window.open("apps/product/view/dialog_elfinder_photo.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			var s='';
			s += '<div class="col-md-4">';
				s += '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
					s += '<img src="'+val+'" data-src="'+val+'" alt="...">';
				s += '</a>';
			s += '<input type="hidden" name="txtPhoto[]" value="'+val+'">';
			s += '</div>';
			
			$("#container_thumbnail_photo").append(s);
			$("#cover").css({display:"none"});
		}
	},
	dialog_add_real:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/product/view/form_add_realestate.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
		
	},
	dialog_vdo : {
		open_elfinder : function(){
			window.open("apps/product/view/dialog_elfinder_vdo.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txtvdo").val(val);
		}
	},
	dialog_thumb : {
		open_elfinder : function(){
			window.open("apps/product/view/dialog_elfinder_thumb.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txtvdoPhotos").val(val);
		}
	},
	dialog_doc : {
		open_elfinder : function(){
			window.open("apps/product/view/dialog_elfinder_doc.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txtDoc").val(val);
		}
	},
	lookup_suppiler:function(id){
		//fn.app.stock.changed = true;
			var $btn = $("#btnLoading").button('loading');
			$.ajax({
				url: "apps/product/view/dialog_supplier_lookup.php",
				type: "POST",
				dataType: "html",
				data:{id:id},
				success: function(html){
				$("body").append("<div id=\"dialog_lookup\"></div>");
					$("#dialog_lookup").html(html);
					$("#dialog_lookup").dialog({
						autoOpen : true,
						title : "Supplier Lookup",
						width : 1000,
						height : 650,
						modal : true,
						buttons : [
							{text : "Add Item", class: 'saveButtonClass btn btn-primary pull-right', click: function() {
								var supp = $("#tblsupplierLookup tr").find("input[name=chk_supp]:checked").val();
								var arr = supp.split("|");
								
									$("#txtsuppid").val(arr[0]).trigger('change');
									$("#txtsuppName").val(arr[1]);
									$("#dialog_lookup").dialog("destroy").remove();
								
							}},
							{text : "Cancel", class : "btn btn-default pull-right", click: function() { $("#dialog_lookup").dialog("destroy").remove(); }},
						],close: function(){
							$("#dialog_lookup").dialog("destroy").remove();
						}
					});
					
					$("#tblsupplierLookup tbody").on( 'dblclick', 'tr', function () {
						$("input[name=chk_supp]").prop("checked",false);
						var input = $(this).find("input[name=chk_supp]");
						input.prop("checked",true);
						$("#dialog_lookup").parent().find(".saveButtonClass").click();
					});
					
					$btn.button('reset');
				}
			});
	},
	append_duration:function(){
		var s ='';
		
			s += '<div class="backapp form-group">';
				s += '<div class="form-group">';
					s += '<label for="txtPhoto" class="col-sm-2 control-label">Date Start</label>';
					s += '<div class="col-sm-4">';
						s += '<input type="date" id="date_start" name="date_start" class="form-control">';
					s += '</div>';
					s += '<label for="txtPhoto" class="col-sm-2 control-label">Date End</label>';
					s += '<div class="col-sm-4">';
						s += '<input type="date" id="date_end" name="date_end" class="form-control">';
					s += '</div>';
				s += '</div>';
				s += '<div class="form-group">';
					s += '<label for="txtPhoto" class="col-sm-2 control-label">Time Start</label>';
					s += '<div class="col-sm-4">';
						s += '<input type="time" id="time_start" name="time_start" class="form-control">';
					s += '</div>';
					s += '<label for="txtPhoto" class="col-sm-2 control-label">Time End</label>';
					s += '<div class="col-sm-4">';
						s += '<input type="time" id="time_end" name="time_end" class="form-control">';
					s += '</div>';
				s += '</div>';
				s += '<div class="form-group">';
					s += '<label for="txtPhoto" class="col-sm-2 control-label">Unit</label>';
					s += '<div class="col-sm-10">';
						s += '<input type="number" id="unit" name="unit" class="form-control">';
					s += '</div>';
				s += '</div>';
				
				s += '<div class="form-group">';
					s += '<label for="txtPhoto" class="col-sm-2 control-label"></label>';
					s += '<div class="col-sm-4">';
						s += '<a class="btn btn-danger" onClick="$(this).parent().parent().parent().remove();"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>';
					s += '</div>';
				s += '</div>';
				
			s += '</div>';
		$("#options").append(s);
	},
	dialog_save_product:function(){
		console.log(fn.app.product.schedule.data);
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/product/xhr/action-add-product.php",
					data: {
						form :$("#add_basic").serialize(),
						data : fn.app.product.schedule.data
					},
					success : function(json)
					{
						//window.location.reload();
					}
				});
		
	},
	dialog_update_product:function(){
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/product/xhr/action-edit-product.php",
					data: $("#edit_basic").serialize(),
					success : function(json)
					{
						//window.location.reload();
					}
				});
		
	},remove_product: function(){
		var item_selected = [];
		$("input[name=chk_real]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/product/xhr/action-remove-product.php',{items:item_selected},function(response){
				window.location = "?app=product";
			});
		}
		
	},
	dialog_approve:function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/product/view/form_approve.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
		
	},
	dialog_edit_product: function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/product/view/dialog.product.edit.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	update_customer:function(){
		if(document.getElementById("tx_pass").value!= document.getElementById("tx_repass").value)
		{
			alert("Password mismatch");
			document.getElementById("tx_repass").focus();
			return false;
		}
		else
		{
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/product/xhr/action-edit-customer.php",
					data: $("#edit_customer").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
		}
	},
	dialog_rate : function(id){
		$.ajax({
				url: "apps/product/view/form_rate.php",//url: "apps/product/view/dialog.product.rate.php",
				type: "POST",
				dataType: "html",
				data:{id:id},
				success: function(html){
				$("body").append("<div id=\"dialog_lookup\"></div>");
					$("#dialog_lookup").html(html);
					$("#dialog_lookup").dialog({
						autoOpen : true,
						title : "Rate Product",
						width : 400,
						modal : true,
						buttons : [
							{text : "Save", class: 'btn btn-primary pull-right', click: function() {
								$.ajax({
									type: "POST",
									dataType:"html",
									url: "apps/product/xhr/action-edit-rate.php",
									data: $("#ratestar").serialize(),
									success : function(json)
									{
										window.location.reload();
									}
								});
							}},
							{text : "Cancel", class : "btn btn-default pull-right", click: function() { $("#dialog_lookup").dialog("destroy").remove(); }},
						],close: function(){
							$("#dialog_lookup").dialog("destroy").remove();
						}
					});
				}
			});
	},
	append_week:function(){
		var sth;
		var w ='';
		w ='<div style="margin-top:5px;" >';
			w += '<label for="txtPhoto" class="col-sm-2 control-label">Week</label>';
                    w += '<div class="col-sm-10">';
                    	w += '<div class="col-md-2">';
                        w += '<select class="form-control" name="weekday[]" id="weekday">';
                        	w += '<option value="0">Sunday</option>';
                            w += '<option value="1">Monday</option>';
                            w += '<option value="2">Tuesday</option>';
                            w += '<option value="3">Wednesday</option>';
                            w += '<option value="4">Thursday</option>';
                            w += '<option value="5">Friday</option>';
                            w += '<option value="6">Saturday</option>';
                        w += '</select>';
                        w += '</div>';
                        w += '<div class="col-md-1">';
                        	w += '<input type="checkbox" name="allday[]" id="allday" value="allday"> Allday';
                        w += '</div>';
						 w += '<label for="txtPhoto" class="col-sm-1 control-label">Start Time</label>';
                         w += '<div class="col-md-1">';
                        	 w += '<select class="form-control " id="start_time_hour" name="start_time_hour[]">';
                             	w += '<option value="00">00</option>';
								w += '<option value="01">01</option>';
								w += '<option value="02">02</option>';
								w += '<option value="03">03</option>';
								w += '<option value="04">04</option>';
								w += '<option value="05">05</option>';
								w += '<option value="06">06</option>';
								w += '<option value="07">07</option>';
								w += '<option value="08">08</option>';
								w += '<option value="09">09</option>';
								w += '<option value="10">10</option>';
								w += '<option value="11">11</option>';
								w += '<option value="12">12</option>';
								w += '<option value="13">13</option>';
								w += '<option value="14">14</option>';
								w += '<option value="15">15</option>';
								w += '<option value="16">16</option>';
								w += '<option value="17">17</option>';
								w += '<option value="18">18</option>';
								w += '<option value="19">19</option>';
								w += '<option value="20">20</option>';
								w += '<option value="21">21</option>';
								w += '<option value="22">22</option>';
								w += '<option value="23">23</option>';
                             w += '</select>';
                         w += '</div>';
                         w += '<div class="col-md-1">';
                        	 w += '<select class="form-control " id="start_time_minute" name="start_time_minute[]">';
                           		w += '<option value="00">00</option>';
								w += '<option value="01">01</option>';
								w += '<option value="02">02</option>';
								w += '<option value="03">03</option>';
								w += '<option value="04">04</option>';
								w += '<option value="05">05</option>';
								w += '<option value="06">06</option>';
								w += '<option value="07">07</option>';
								w += '<option value="08">08</option>';
								w += '<option value="09">09</option>';
								w += '<option value="10">10</option>';
								w += '<option value="11">11</option>';
								w += '<option value="12">12</option>';
								w += '<option value="13">13</option>';
								w += '<option value="14">14</option>';
								w += '<option value="15">15</option>';
								w += '<option value="16">16</option>';
								w += '<option value="17">17</option>';
								w += '<option value="18">18</option>';
								w += '<option value="19">19</option>';
								w += '<option value="20">20</option>';
								w += '<option value="21">21</option>';
								w += '<option value="22">22</option>';
								w += '<option value="23">23</option>';
								w += '<option value="24">24</option>';
								w += '<option value="25">25</option>';
								w += '<option value="26">26</option>';
								w += '<option value="27">27</option>';
								w += '<option value="28">28</option>';
								w += '<option value="29">29</option>';
								w += '<option value="30">30</option>';
								w += '<option value="31">31</option>';
								w += '<option value="32">32</option>';
								w += '<option value="33">33</option>';
								w += '<option value="34">34</option>';
								w += '<option value="35">35</option>';
								w += '<option value="36">36</option>';
								w += '<option value="37">37</option>';
								w += '<option value="38">38</option>';
								w += '<option value="39">39</option>';
								w += '<option value="40">40</option>';
								w += '<option value="41">41</option>';
								w += '<option value="42">42</option>';
								w += '<option value="43">43</option>';
								w += '<option value="44">44</option>';
								w += '<option value="45">45</option>';
								w += '<option value="46">46</option>';
								w += '<option value="47">47</option>';
								w += '<option value="48">48</option>';
								w += '<option value="49">49</option>';
								w += '<option value="50">50</option>';
								w += '<option value="51">51</option>';
								w += '<option value="52">52</option>';
								w += '<option value="53">53</option>';
								w += '<option value="54">54</option>';
								w += '<option value="55">55</option>';
								w += '<option value="56">56</option>';
								w += '<option value="57">57</option>';
								w += '<option value="58">58</option>';
								w += '<option value="59">59</option>';
                             w += '</select>';
                         w += '</div>';
                         w += '<label for="txtPhoto" class="col-sm-1 control-label">End Time</label>';
                         w += '<div class="col-md-1">';
                        	 w += '<select class="form-control " id="end_time_hour" name="end_time_hour[]">';
                           		w += '<option value="00">00</option>';
								w += '<option value="01">01</option>';
								w += '<option value="02">02</option>';
								w += '<option value="03">03</option>';
								w += '<option value="04">04</option>';
								w += '<option value="05">05</option>';
								w += '<option value="06">06</option>';
								w += '<option value="07">07</option>';
								w += '<option value="08">08</option>';
								w += '<option value="09">09</option>';
								w += '<option value="10">10</option>';
								w += '<option value="11">11</option>';
								w += '<option value="12">12</option>';
								w += '<option value="13">13</option>';
								w += '<option value="14">14</option>';
								w += '<option value="15">15</option>';
								w += '<option value="16">16</option>';
								w += '<option value="17">17</option>';
								w += '<option value="18">18</option>';
								w += '<option value="19">19</option>';
								w += '<option value="20">20</option>';
								w += '<option value="21">21</option>';
								w += '<option value="22">22</option>';
								w += '<option value="23">23</option>';
                             w += '</select>';
                         w += '</div>';
                         w += '<div class="col-md-1">';
                        	 w += '<select class="form-control " id="end_time_minute" name="end_time_minute[]">';
                            	w += '<option value="00">00</option>';
								w += '<option value="01">01</option>';
								w += '<option value="02">02</option>';
								w += '<option value="03">03</option>';
								w += '<option value="04">04</option>';
								w += '<option value="05">05</option>';
								w += '<option value="06">06</option>';
								w += '<option value="07">07</option>';
								w += '<option value="08">08</option>';
								w += '<option value="09">09</option>';
								w += '<option value="10">10</option>';
								w += '<option value="11">11</option>';
								w += '<option value="12">12</option>';
								w += '<option value="13">13</option>';
								w += '<option value="14">14</option>';
								w += '<option value="15">15</option>';
								w += '<option value="16">16</option>';
								w += '<option value="17">17</option>';
								w += '<option value="18">18</option>';
								w += '<option value="19">19</option>';
								w += '<option value="20">20</option>';
								w += '<option value="21">21</option>';
								w += '<option value="22">22</option>';
								w += '<option value="23">23</option>';
								w += '<option value="24">24</option>';
								w += '<option value="25">25</option>';
								w += '<option value="26">26</option>';
								w += '<option value="27">27</option>';
								w += '<option value="28">28</option>';
								w += '<option value="29">29</option>';
								w += '<option value="30">30</option>';
								w += '<option value="31">31</option>';
								w += '<option value="32">32</option>';
								w += '<option value="33">33</option>';
								w += '<option value="34">34</option>';
								w += '<option value="35">35</option>';
								w += '<option value="36">36</option>';
								w += '<option value="37">37</option>';
								w += '<option value="38">38</option>';
								w += '<option value="39">39</option>';
								w += '<option value="40">40</option>';
								w += '<option value="41">41</option>';
								w += '<option value="42">42</option>';
								w += '<option value="43">43</option>';
								w += '<option value="44">44</option>';
								w += '<option value="45">45</option>';
								w += '<option value="46">46</option>';
								w += '<option value="47">47</option>';
								w += '<option value="48">48</option>';
								w += '<option value="49">49</option>';
								w += '<option value="50">50</option>';
								w += '<option value="51">51</option>';
								w += '<option value="52">52</option>';
								w += '<option value="53">53</option>';
								w += '<option value="54">54</option>';
								w += '<option value="55">55</option>';
								w += '<option value="56">56</option>';
								w += '<option value="57">57</option>';
								w += '<option value="58">58</option>';
								w += '<option value="59">59</option>';
                             w += '</select>';
                         w += '</div>';
                        w += '<div class="col-md-2">';
                        	w += '<button type="button" class="btn btn-danger" onClick="$(this).parent().parent().parent().remove();">';
                            	w += '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
                            w += '</button>';
                        w += '</div>';
                    w += '</div>';
		 w += '</div>';			
		$("#addweek").append(w);

	},
	append_Exception:function(){
		var s ='';
			s +='<div class="col-md-12" style="margin-top:5px;margin-left:-10px;" >';
				s +='<label for="txtPhoto" class="col-sm-2 control-label">Exception</label>';
				s +='<div class="col-sm-4">';
					s +='<input type="date" class="form-control" id="txt_exception" name="txt_exception[]" placeholder="Exception">';
				s +='</div>';
				s +='<div class="col-sm-2">';
					s +='<button type="button" class="btn btn-danger" onClick="$(this).parent().parent().remove();">';
						s +='<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
					s +='</button>';
				s +='</div>';
			s +='</div>';
			console.log(s);
		$("#addException").append(s);
	}
};

$.extend(fn.app,{product:product});
