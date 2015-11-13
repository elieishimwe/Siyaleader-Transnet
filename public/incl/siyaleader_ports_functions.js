// (C) Copyright 2015 - Rupert Meyer <rupert@cooluma.co.za> - All Rights Reserved

$(document).ready(function(){

	//$("#cellphone").tokenInput("getContacts");



    $("#cellphone").tokenInput("getContacts", {
      tokenLimit: 1,
      animateDropdown: false,
      onResult: function (results) {

              if (results.length == 0)
              {

              	alert(results.length);
                  $("#cell").removeAttr("disabled");
                  $("#name").removeAttr("disabled");
                  $("#surname").removeAttr("disabled");


              }
              return results;
      },
      onAdd: function (results) {

                if(results.name)
                {
                    $("#cell").attr("disabled","disabled");
                    $("#name").attr("disabled","disabled");
                    $("#surname").attr("disabled","disabled");

                    $("#error_cellphone").html("");
                    $("#error_title").html("");
                    $("#error_language").html("");
                    $("#error_province").html("");



                    $("#cell").val(results.cellphone);
                    $("#name").val(results.firstname);
                    $("#surname").val(results.surname);
                    $("#repID").val(results.userID);



                }
                else {

                  $("#caseReportCaseForm #cellphone").val('');
                  $("#caseReportCaseForm #name").val('');
                  $("#caseReportCaseForm #surname").val('');
                  $("#caseReportCaseForm #id_number").val('');
                  $("#caseReportCaseForm #language").val('');
                  $("#caseReportCaseForm #province").val('');
                  $("#caseReportCaseForm #district").val('');
                  $("#caseReportCaseForm #municipality").val('');
                  $("#caseReportCaseForm #house_number").val('');
                  $("#caseReportCaseForm #ward").val('');
                  $("#caseReportCaseForm #area").val('');
                  $("#caseReportCaseForm #hseHolderId").val('');
                  $("#caseReportCaseForm #title").val('');
                  $("#caseReportCaseForm #position").val('');
                  $("#caseReportCaseForm #priority").val('');
                  $("#caseReportCaseForm #gender").val('');
                  $("#caseReportCaseForm #dob").val('');
                  $("#error_cellphone").html("");
                  $("#error_title").html("");
                  $("#error_language").html("");
                  $("#error_province").html("");
                  $("#error_district").html("");
                  $("#error_municipality").html("");
                  $("#error_ward").html("");
                  $("#error_name").html("");
                  $("#error_surname").html("");
                  $("#error_id_number").html("");
                  $("#error_position").html("");
                  $("#error_priority").html("");
                  $("#error_gender").html("");
                  $("#error_dob").html("");


                  $("#caseReportCaseForm #cellphone").removeAttr("disabled");
                  $("#caseReportCaseForm #name").removeAttr("disabled");
                  $("#caseReportCaseForm #surname").removeAttr("disabled");
                  $("#caseReportCaseForm #id_number").removeAttr("disabled");
                  $("#caseReportCaseForm #language").removeAttr("disabled");
                  $("#caseReportCaseForm #province").removeAttr("disabled");
                  $("#caseReportCaseForm #house_number").removeAttr("disabled");
                  $("#caseReportCaseForm #district").removeAttr("disabled");
                  $("#caseReportCaseForm #municipality").removeAttr("disabled");
                  $("#caseReportCaseForm #ward").removeAttr("disabled");
                  $("#caseReportCaseForm #area").removeAttr("disabled");
                  $("#caseReportCaseForm #title").removeAttr("disabled");
                  $("#caseReportCaseForm #position").removeAttr("disabled");
                  $("#caseReportCaseForm #priority").removeAttr("disabled");
                  $("#caseReportCaseForm #gender").removeAttr("disabled");
                  $("#caseReportCaseForm #dob").removeAttr("disabled");


                }

                return results;


    },
     onDelete: function (item) {

                  $("#caseReportCaseForm #cellphone").val('');
                  $("#caseReportCaseForm #name").val('');
                  $("#caseReportCaseForm #surname").val('');
                  $("#caseReportCaseForm #id_number").val('');
                  $("#caseReportCaseForm #language").val('');
                  $("#caseReportCaseForm #province").val('');
                  $("#caseReportCaseForm #district").val('');
                  $("#caseReportCaseForm #municipality").val('');
                  $("#caseReportCaseForm #house_number").val('');
                  $("#caseReportCaseForm #ward").val('');
                  $("#caseReportCaseForm #area").val('');
                  $("#caseReportCaseForm #title").val('');
                  $("#caseReportCaseForm #position").val('');
                  $("#caseReportCaseForm #priority").val('');
                  $("#caseReportCaseForm #gender").val('');
                  $("#caseReportCaseForm #dob").val('');
                  $("#caseReportCaseForm #hseHolderId").val('');
                  $("#caseReportCaseForm #cellphone").removeAttr("disabled");
                  $("#caseReportCaseForm #name").removeAttr("disabled");
                  $("#caseReportCaseForm #surname").removeAttr("disabled");
                  $("#caseReportCaseForm #id_number").removeAttr("disabled");
                  $("#caseReportCaseForm #language").removeAttr("disabled");
                  $("#caseReportCaseForm #province").removeAttr("disabled");
                  $("#caseReportCaseForm #district").removeAttr("disabled");
                  $("#caseReportCaseForm #municipality").removeAttr("disabled");
                  $("#caseReportCaseForm #house_number").removeAttr("disabled");
                  $("#caseReportCaseForm #ward").removeAttr("disabled");
                  $("#caseReportCaseForm #area").removeAttr("disabled");
                  $("#caseReportCaseForm #title").removeAttr("disabled");
                  $("#caseReportCaseForm #position").removeAttr("disabled");
                  $("#caseReportCaseForm #priority").removeAttr("disabled");
                  $("#caseReportCaseForm #gender").removeAttr("disabled");
                  $("#caseReportCaseForm #dob").removeAttr("disabled");
                  $("#error_cellphone").html("");
                  $("#error_title").html("");
                  $("#error_language").html("");
                  $("#error_province").html("");
                  $("#error_district").html("");
                  $("#error_municipality").html("");
                  $("#error_ward").html("");
                  $("#error_name").html("");
                  $("#error_surname").html("");
                  $("#error_id_number").html("");
                  $("#error_position").html("");
                  $("#error_priority").html("");
                  $("#error_gender").html("");
                  $("#error_dob").html("");

    }
  });







































	$("#category").change(function(){
	setCaptureBorder(document.getElementById('category').options[document.getElementById('category').selectedIndex].id);
	$.ajax({ dataType: "json",url:"ajax/getCategories.php?Action=getSubCats&Category=" +$(this).val()+ "", success: function(result){
		$('#sub_category').empty();
		$('#sub_sub_category').empty();
		if(result != "") $('#sub_category').append("<option value='0'>Please select ...</option><BR>");
		$.each(result, function(element, value) {

			$('#sub_category').append("<option value="+ element +">" + value + "</option><BR>");
			});
		}});
	});

	$("#sub_category").change(function(){
	$.ajax({ dataType: "json",url:"ajax/getCategories.php?Action=getSubSubCats&subCategory=" +$(this).val()+ "", success: function(result){
		$('#sub_sub_category').empty();
		if(result != "") $('#sub_sub_category').append("<option value='0'>Please select ...</option><BR>");
		$.each(result, function(element, value) {

			$('#sub_sub_category').append("<option value="+ element +">" + value  + "</option><BR>");
			});
		}});
	});
});


function resetControllers () {
	/*	document.getElementById('zoneGPSarray').value="";
		document.all.weatherSlide.value='0.8';
		document.all.closeFrameX.style.display='none';
		document.all.searchBox.focus();
	*/

		$("#zoneGPSarray").val("");
		$("#weatherSlide").val("0.8");
		$("#closeFrameX").css('display','none');
		$("#searchBox").focus();

		resetCheckBoxes();
		resetRadios();
}



function switchPriority ()
	{
		if(document.getElementById("prob_priority").value == "Urgent")
				{
					document.getElementById("prob_priority").value = "Critical";
					document.getElementById('prioritySpan').innerHTML = "&#9745;";
				}
		else	{
					document.getElementById("prob_priority").value = "Urgent";
					document.getElementById('prioritySpan').innerHTML = "&#9744;";
				}
	}

function switchMarkerLegend ()
	{
		if(markerLegendStatus == 0)
				{
					showMarkerLegend();
					markerLegendStatus = 1;
				}
		else	{
					hideMarkerLegend();
					markerLegendStatus = 0;
				}
	}

function showMarkerLegend ()
	{
		document.all.markerLegend.style.transform = "translatey(-510px)";
		markerLegendStatus = 1;
		document.all.weatherSticker.style.display = "none";
	}

function hideMarkerLegend ()
	{
		document.all.markerLegend.style.transform = "rotate(360deg)";
		markerLegendStatus = 0;
		document.all.weatherSticker.style.display = "block";
	}

function showWeather ()
{
	document.all.weatherFrame.style.transform = "translatex(-895px)";
	document.all.weatherSticker.style.display = "none";
}

function hideWeather ()
{
	document.all.weatherFrame.style.transform = "rotate(360deg)";
	document.all.weatherSticker.style.display = "block";
}

function showCMC ()
	{
		document.all.cmcFrame.style.transform = "translate(0px,1100px)";
		cmcFrameDown = 1;
		document.all.closeXB.src = "images/closexb.png";
		setTimeout("document.all.closeFrameX.style.display = 'flex'",2000);
	}

function hideCMC ()
	{
		document.all.closeXB.src = "images/closexb_off.png";
		document.all.closeFrameX.style.display = "none";
		document.all.cmcFrame.style.transform = "translate(0px,-1100px";
		cmcFrameDown = 0;
	}

function switchPhoto (photo,ibBorder)
		{
			if(photoFrameDown == 1)
					{
						hidePhoto(photo,ibBorder);
					}
			else	{
						showPhoto(photo,ibBorder);
					}
		}

function showPhoto (photo,ibBorder)
	{
		if(photo != "") {
		  photoPath = photo;
		}
		else {
		  photoPath = "http://41.216.130.6:8080/siyaleader-dbnports-mobileApp-api/port_backend/public/noimage.png";
		}
		document.all.thePhoto.src = photoPath;
//		document.all.thePhoto.style = "border-top:1px solid " + ibBorder + "";
//		document.all.thePhoto.style = "border-left:1px solid " + ibBorder + "";
//		document.all.thePhoto.style = "border-bottom:1px solid " + ibBorder + "";
		document.all.thePhoto.style.borderColor = ibBorder;

		if(document.all.thePhoto.offsetWidth > 600)
			{
				document.all.thePhoto.style.width = "600px";
//				document.all.casePhoto.style.width = "600px";
			}
		if(document.all.thePhoto.offsetHeight > 450)
			{
				document.all.thePhoto.style.height = "450px";
//							document.all.casePhoto.style.height = "450px";
			}


		document.all.casePhoto.style.transform = "translate(0px,695px)";
		photoFrameDown = 1;
	}

function hidePhoto (photo)
	{
		if(photoRotation == "0deg")
				{
					document.all.casePhoto.style.transform = "rotate(0deg)";
				}
		else	{
					document.all.casePhoto.style.transform = "rotate(270deg)";
				}

		photoFrameDown = 0;
	}

function rotatePhoto ()
{
	if(document.all.thePhoto.offsetWidth > 450)
		{

			document.all.thePhoto.style.width = "450px";
			var newWidth = document.all.thePhoto.offsetHeight;
			var newHeight = document.all.thePhoto.offsetWidth;


//	alert("width: " + newWidth + " height: " + newHeight);

			var photoLeft = Math.round((newHeight - document.all.thePhoto.offsetHeight) / 2) + "px";
			document.all.thePhoto.style.transform = "rotate(90deg) translate(0px, " + photoLeft + ")";
			photoRotation = "90deg";
			document.all.photoToolbar.style.width = newWidth + "px";
			document.all.photoTD.style.width = newWidth + "px";
			document.all.photoToolbarTD.style.width = newWidth + "px";
			document.all.photoTD.style.height = newHeight + "px";
			document.all.photoContainer.style.width = Math.round(newWidth + 6) + "px";
//		alert(document.getElementById("photoContainer").style.width);
			document.all.casePhoto.style.width = newWidth + "px";
		}
}

function resetCheckBoxes ()
	{
		for(i=0;i<catArray.length;i++)
			{
				eval("document.all." + catArray[i] + "CheckBox.checked = true");
			}
		document.all.toggleCheckBox.checked = true;
	}

function resetRadios () {

	for( i = 0; i < statusArray.length;i++) {
		/*eval("document.all.mc" + statusArray[i] + "Radio.checked = true");
		eval("document.all.me" + statusArray[i] + "Radio.checked = true");
		eval("document.all.mm" + statusArray[i] + "Radio.checked = true");
		eval("document.all.hk" + statusArray[i] + "Radio.checked = true");
		eval("document.all.tr" + statusArray[i] + "Radio.checked = true");*/

		$("#mc" + statusArray[i]).prop("checked", true);
		$("#me" + statusArray[i]).prop("checked", true);
		$("#mm" + statusArray[i]).prop("checked", true);
		$("#hk" + statusArray[i]).prop("checked", true);
		$("#tr" + statusArray[i]).prop("checked", true);


	}
}

function switchAllAssetOverlay()
	{
		if(allLocalityOverlayStatus == 0)
				{
					for(i = 0; i < localityOverlay.length; i++)
						{
							eval(localityOverlay[i]+"LocalityOverlay.setMap(map)");
							eval(localityOverlay[i]+"Span.innerHTML= '&#9745;'");
							eval(localityOverlay[i]+"LocalityOverlayStatus = 1");
						}
					allSpan.innerHTML = "&#9745";
					allLocalityOverlayStatus = 1;
				}
		else	{
					for(i = 0; i < localityOverlay.length; i++)
						{
							eval(localityOverlay[i]+"LocalityOverlay.setMap(null)");
							eval(localityOverlay[i]+"Span.innerHTML= '&#9744;'");
							eval(localityOverlay[i]+"LocalityOverlayStatus = 0");
						}
					allSpan.innerHTML = "&#9744";
					allLocalityOverlayStatus = 0;
				}
	}

function switchAssetOverlay(color)
	{
		if(eval(color+"LocalityOverlayStatus == 0"))
				{
					eval(color+"LocalityOverlay.setMap(map)");
					eval(color+"Span.innerHTML= '&#9745;'");
					eval(color+"LocalityOverlayStatus = 1");
				}
		else	{
					eval(color+"LocalityOverlay.setMap(null)");
					eval(color+"Span.innerHTML= '&#9744;'");
					eval(color+"LocalityOverlayStatus = 0");
				}
	}

function switchMenu() {

	if(portsMenu == 0) {

	/*	document.getElementById('portsMenu').style.display = "flex";
		document.getElementById('portsMenu').className="animated flipInY";
		portsMenu = 1;*/

		$("#portsMenu").css('display','flex');
		$("#portsMenu").addClass('animated flipInY');
		portsMenu = 1;
	}
	else  {
		/*document.getElementById('portsMenu').className='animated flipOutY';
		portsMenu = 0;*/

		$("#portsMenu").addClass('animated flipOutY')
		portsMenu = 0;

	}

}


function switchMainMenu() {

	if(mainMenu == 0) {

	/*	document.getElementById('mainMenu').style.display = "flex";
		document.getElementById('mainMenu').className="animated flipInY";
		mainMenu = 1;*/

		$("#mainMenu").css('display','flex');
		$("#mainMenu").addClass('animated flipInY');
		mainMenu = 1;

	}
	else {
		/*document.getElementById('mainMenu').className='animated flipOutY';
		mainMenu = 0;*/

		$("#mainMenu").addClass('animated flipOutY')
		mainMenu = 0;
	}

}


function switchLayerMenu()
	{
		if(layerMenu == 0)
				{
					document.getElementById('layerMenu').style.display = "flex";
					document.getElementById('layerMenu').className="animated flipInY";
					layerMenu = 1;

				}
		else	{
					document.getElementById('layerMenu').className='animated flipOutY';
					layerMenu = 0;
				}
	}

function killMenu ()
	{
		document.getElementById('mainMenu').className='animated flipOutY';
		mainMenu = 0;
	}

function killLayerMenu ()
	{
		document.getElementById('layerMenu').className='animated flipOutY';
		layerMenu = 0;
	}

function switchToPort (vars)
	{
		splitVars = vars.split(":");
		var port = splitVars[0];
		var zoom = splitVars[1];
		eval("map.panTo(" + port + ")");
		eval("map.setZoom(" + zoom + ")");
	}

function checkInput(ob)
	{
		var invalidChars = /[^0-9]/gi
		if(invalidChars.test(ob.value))
			{
    			ob.value = ob.value.replace(invalidChars,"");
      		}
	}

function closeInfoBoxes ()
	{
		for(var i = 0; i < infoBoxArray.length; i++)
			{
 				infoBoxArray[i].close();
 			}
	}

function toggleAllMarkers ()
	{
		if(allMarkers == 0)
				{
					showAllMarkers();
					allMarkers = 1;
					hideStatusSelects();
					for(i=0;i<catArray.length;i++)
						{
							eval("document.all." + catArray[i] + "CheckBox.checked = true");
 							eval(catArray[i] + "Status = 1");
						}
					for(i=0;i<statusArray.length;i++)
						{
							eval("document.all.mc" + statusArray[i] + "Radio.checked = true");
							eval("document.all.me" + statusArray[i] + "Radio.checked = true");
							eval("document.all.mm" + statusArray[i] + "Radio.checked = true");
							eval("document.all.hk" + statusArray[i] + "Radio.checked = true");
							eval("document.all.tr" + statusArray[i] + "Radio.checked = true");
						}
				}
		else	{
					hideAllMarkers();
					closeInfoBoxes();
					allMarkers = 0;
					hideStatusSelects();
					for(i=0;i<catArray.length;i++)
						{
							eval("document.all." + catArray[i] + "CheckBox.checked = false");
 							eval(catArray[i] + "Status = 0");
						}
					for(i=0;i<statusArray.length;i++)
						{
							eval("document.all.mc" + statusArray[i] + "Radio.checked = false");
							eval("document.all.me" + statusArray[i] + "Radio.checked = false");
							eval("document.all.mm" + statusArray[i] + "Radio.checked = false");
							eval("document.all.hk" + statusArray[i] + "Radio.checked = false");
							eval("document.all.tr" + statusArray[i] + "Radio.checked = false");
						}
				}
	}

function hideAllMarkers ()
	{
		for(c = 0; c < catArray.length; c++)
			{
				for(i = 0; i < eval(catArray[c] + "Array.length"); i++)
					{
						eval(catArray[c]+"Array")[i].setMap(null);
						markerCluster.removeMarker(eval(catArray[c]+"Array")[i]);
						eval(catArray[c]+"Status = 0");
					}
			}
		markerCluster.repaint();
	}

function showAllMarkers ()
	{
		for(c = 0; c < catArray.length; c++)
			{
				for(i = 0; i < eval(catArray[c] + "Array.length"); i++)
					{
						eval(catArray[c]+"Array")[i].setMap(map);
						markerCluster.addMarker(eval(catArray[c]+"Array")[i]);
						eval(catArray[c]+"Status = 1");
					}
			}
		markerCluster.repaint();
	}

function switchMarkers (cat)
	{
		if(eval(cat+"Status") == 1)
				{
					for(var i = 0; i < eval(cat+"Array.length"); i++)
						{
    						eval(cat+"Array")[i].setMap(null);
							markerCluster.removeMarker(eval(cat+"Array")[i]);
							eval(cat+"Status = 0");
							eval("document.getElementById('" +cat+ "StatusSelect').className='animated flipOutY'");
 						}
			//		hideStatusSelects();
				}
		else	{
					hideStatusSelects();
					for(var i = 0; i < eval(cat+"Array.length"); i++)
						{
    						eval(cat+"Array")[i].setMap(map);
							markerCluster.addMarker(eval(cat+"Array")[i], true);
							eval(cat+"Status = 1");
							eval("document.getElementById('" +cat +"StatusSelect').className='animated flipInY'");
							eval("document.getElementById('" +cat +"StatusSelect').style.display='flex'");
							for(s=0;s<statusArray.length;s++)
								{
									eval("document.all."+cat+ "" + statusArray[s] + "Radio.checked = true");
									eval(cat+ statusArray[s] + "Status = 1");
									eval(cat+ statusArray[s] + "RadioStatus = 1");
								}
 						}
					markerCluster.repaint();
				}
	}

function repositionMarkers ()
	{
	closeInfoBoxes();
	google.maps.event.trigger(map, 'click');
		for(i = 0; i < markers.length; i++)
			{
				markers[i].setPosition(coords[i]);
			}
		markerCluster.repaint();
	}

function switchStatusMarkers (stat)
	{
		if(eval(stat+"Status") == 1)
				{
					for(var i = 0; i < eval(stat+"Array.length"); i++)
						{
   							eval(stat+"Array")[i].setMap(null);
							markerCluster.removeMarker(eval(stat+"Array")[i]);
							eval(stat+"Status = 0");
 						}
				}
		else	{
					for(var i = 0; i < eval(stat+"Array.length"); i++)
						{
    						eval(stat+"Array")[i].setMap(map);
							markerCluster.addMarker(eval(stat+"Array")[i], true);
							eval(stat+"Status = 1");
 						}
					markerCluster.repaint();
				}
	}

function hideStatusSelects ()
	{
		for(i = 0; i < catArray.length; i++)
			{
				eval("document.getElementById('" +catArray[i]+ "StatusSelect').className='animated flipOutY'");
			//	eval("document.getElementById('" +cat+ "StatusSelect').className='animated flipOutY'");
			}
	}

function resetMarkerVisibility ()
	{
		setTimeout(function()  {  resetMarkers();  }, 100);
	}

function  resetMarkers ()
	{
		for(c = 0; c < catArray.length; c++)
			{
				var cat = catArray[c];
				if(eval(cat+"Status") == 0)
					{
						for(var i = 0; i < eval(cat+"Array.length"); i++)
							{
    							eval(cat+"Array")[i].setMap(null);
							}
					}
			}
	}

function toggleRadio (target)
	{
		if(eval(target+ "RadioStatus") == 1)
				{
					eval("document.all." +target+ "Radio.checked = false");
					eval(target+"RadioStatus = 0");
				}
		else	{
					eval("document.all." +target+ "Radio.checked = true");
					eval(target+"RadioStatus = 1");
				}
	}

function animateMarker (caseID)
	{
		if(eval("typeof marker_"+caseID+" !== 'undefined'"))
				{
					killMenu();
					killLayerMenu();
					if (eval("marker_"+caseID+".getAnimation() != null"))
							{
								eval("marker_"+caseID+".setAnimation(null)");
							}
					else	{
								eval("map.panTo(marker_"+caseID+".position)");
								map.setZoom(17);
    							eval("marker_"+caseID+".setAnimation(google.maps.Animation.BOUNCE)");
								setTimeout("stopAnimation("+caseID+")", 4000);
								eval("google.maps.event.trigger(marker_"+caseID+", 'click')");
								document.all.searchBox.value = "";
							}
					clearTimeout();
				}
		else 	{
					alert("Case number: " +caseID+ " does not exist");
					document.all.searchBox.value = "";
				}
	}

function switchNewCaseMarker (source,element)
	{
		if(newCaseMarkerStatus == 0)
				{
					document.getElementById('submitButton').disabled=false;
					switchToPort('DBN:13');
					document.getElementById('addCase').src ="images/cancel_case.png";
					document.getElementById('addCase').title = "Cancel new case creation ...";
			//		setCaptureBorder('#FFD205');
					document.getElementById("caseCapture").className = "animated flipInY";
					document.getElementById("caseCapture").style.display = "flex";
			//		document.getElementById('captureForm').reset();
					var mapCenter = map.getCenter();
					markerNew = new google.maps.Marker({ zindex:10000, position: mapCenter, icon: newCaseImage, draggable:true, title:'Drag marker to the case location ...', map: map });
					newCaseMarkerStatus = 1;
					var markDP = markerNew.getPosition().toString();
					markDP = markDP.replace('(','');
					markDP = markDP.replace(')','');

					iframeDoc.getElementById('GPS').value = markDP;

					google.maps.event.addListener(markerNew, 'drag', function()
						{
							markDP = markerNew.getPosition().toString();
							markDP = markDP.replace('(','');
							markDP = markDP.replace(')','');
							iframeDoc.getElementById('GPS').value = markDP;
						});
					markerNew.setAnimation(google.maps.Animation.BOUNCE);
					setTimeout("markerNew.setAnimation(null)", 2000);
				}
		else	{
					if(source == "icon")
						{
							askConfirm(element,source);
						}
				}
	}

function submitCaptureForm (map_center, map_zoom)
	{
		capture_map_center = map_center;
		capture_map_zoom = map_zoom;
		if(iframeDoc.getElementById('ccg_nam').value == "" || iframeDoc.getElementById('ccg_sur').value == "" || iframeDoc.getElementById('ccg_mob').value == "" || iframeDoc.getElementById('precinct').value == "" || iframeDoc.getElementById('category').value == "" || iframeDoc.getElementById('sub_category').value == "")
			{
				alert("WARNING ...\n\nPlease complete all the fields in the form ...");
				return;
			}
		iframeDoc.getElementById('captureForm').submit();
		markerNew.setMap(null);
		document.getElementById('caseCapture').className = "animated zoomOutLeft";
		newCaseMarkerStatus = 0;
		document.getElementById('addCase').src ="images/add_case.png";
		document.getElementById('addCase').title = "Add a new case ...";
		document.getElementById('caseCaptureSuccess').style.display = "flex";
		setTimeout("document.getElementById('caseCaptureSuccess').className = 'animated flipOutY'", 4000);
		document.getElementById('caseCaptureSuccess').className = "animated zoomInLeft";
		document.getElementById('ruSure').style.display = "none";
		document.getElementById('ruSure').className="animated bounceIn";
	}


function captureSuccess (newCaseId,newMarkerImage,newMarkerCoords,infoBoxBorder,imageCategory,boxContent)
	{


	//	alert(newCaseId + "," + newMarkerImage + "," + newMarkerCoords + "," + infoBoxBorder + "\n\n" +boxContent);
		var image = newMarkerImage;
		eval("var co_ords_" + newCaseId + " = new google.maps.LatLng(" + newMarkerCoords + ")");

		var boxText = document.createElement("div");
			boxText.style.cssText = "border:2px solid " + infoBoxBorder + ";  margin-top: 0px; background: #1c1c1c; padding: 3px; box-shadow:4px 4px 4px #000000";
			boxText.innerHTML = boxContent;

			var infoBoxOptions = {
		 		content: boxText
				,disableAutoPan: false
				,maxWidth: 0
				,pixelOffset: new google.maps.Size(-134, 0)
				,zIndex: null
				,boxStyle: {
			  		opacity: 1
			  		,width: "268px"
				 	}
				,closeBoxMargin: "3px 3px 3px 3px"
				,closeBoxURL: "images/closeX.png"
				,infoBoxClearance: new google.maps.Size(1, 1)
				,isHidden: false
				,pane: "floatPane"
				,enableEventPropagation: false
				};

				eval("var ib_" + newCaseId + " = new InfoBox(infoBoxOptions)");

				eval("infoBoxArray.push(ib_" + newCaseId + ")");

		eval("marker_" + newCaseId + " = new google.maps.Marker({ position: co_ords_" + newCaseId + ", map: map, icon: image, title:'Case Number: " + newCaseId + "',draggable:true })");

		markerNew.setMap(null);
		eval("marker_" + newCaseId + ".setAnimation(google.maps.Animation.BOUNCE)");
		setTimeout("marker_" + newCaseId + ".setAnimation(null)", 3000);

		eval("co_ords.push(co_ords_" + newCaseId + ")");

		eval("markers.push(marker_" + newCaseId + ")");

	//	eval("oms.addMarker(marker_" + newCaseId + ")");

		eval(imageCategory + "Array.push(marker_" + newCaseId + ")");
		eval(imageCategory + "PenArray.push(marker_" + newCaseId + ")");
		eval("google.maps.event.addListener(marker_" + newCaseId + ", 'click', function() {  ib_" + newCaseId + ".open(map, marker_" + newCaseId + ");  })");
	}





function askConfirm (element,source)
	{
		element = "" + element + "";
		source = "" + source + "";
		document.getElementById('ruSure').style.zIndex = "12";
		var theElement = document.getElementById(element);
		var position = getPosition(theElement);
		document.getElementById('RUS').innerHTML = 'ARE YOU SURE?';
		document.getElementById('ruSure').className='animated bounceIn';
		document.getElementById('submitButton').disabled = true;
		if(source == "icon")
				{
					document.getElementById('ruSure').style.top = (position.y - 26) + "px";;
					document.getElementById('ruSure').style.left = (position.x - 100) + "px";
					document.getElementById('ruSure').style.display='flex';
				}
		else	{
					document.getElementById('ruSure').style.top = (position.y - 26) + "px";;
					document.getElementById('ruSure').style.left = (position.x - 69) + "px";
					document.getElementById('ruSure').style.display='flex';
				}
	}

function getPosition(element)
	{
    	var xPosition = 0;
    	var yPosition = 0;
    	while(element)
    		{
    			xPosition += (element.offsetLeft - element.scrollLeft + element.clientLeft);
    			yPosition += (element.offsetTop - element.scrollTop + element.clientTop);
    			element = element.offsetParent;
    		}
    	return { x: xPosition, y: yPosition };
	}

function ruSure (val)
	{
		if(val == "Yes")
				{
					document.getElementById('RUS').innerHTML = "OVERBOARD!";
					document.getElementById('ruSure').className='animated bounceOut'; // Yes
					// setTimeout("switchNewCaseMarker()",850);
					setTimeout("document.getElementById('ruSure').style.zIndex = '10'", 1000);
					document.getElementById('submitButton').disabled = false;

					markerNew.setMap(null);
					iframeDoc.getElementById('captureForm').reset();
					iframeDoc.getElementById('captureContainer').style="display:block;width:485px;height:490px;overflow-y:auto;overflow-x:hidden;border-collapse:collapse;border:2px solid #FFD205";
					document.getElementById('caseCapture').style.right = "0";
					document.getElementById("caseCapture").className = "animated hinge";
					newCaseMarkerStatus = 0;
					document.getElementById('addCase').src ="images/add_case.png";
					document.getElementById('addCase').title = "Add a new case ...";
					setTimeout("document.getElementById('ruSure').style.zIndex = '10'", 1000);
					setTimeout("document.getElementById('caseCapture').style.right = '10px'", 2000);
				}
		else	{
					document.getElementById('submitButton').disabled = false;
					document.getElementById('RUS').innerHTML = "OK";
					document.getElementById('ruSure').className="animated bounceOut"; // Oops!
					setTimeout("document.getElementById('ruSure').style.zIndex = '10'", 1000);
				}
	}

function setCaptureBorder (col)
	{
		eval("document.getElementById('captureContainer').style='border:2px solid " + col +"'");
	//	if(col == '#ff0000') eval("document.getElementById('captureContainer').style='display:block;width:485px;height:490px;overflow-y:auto;overflow-x:hidden;border-collapse:collapse;border:2px solid " + col +"'");
	}

function allowDrop(ev)
	{
    	ev.preventDefault();
	}

function drag(ev)
	{
    	ev.dataTransfer.setData("text", ev.target.id);
	}

function drop(ev)
	{
		ev.preventDefault();
		var data = ev.dataTransfer.getData("text");
		ev.target.appendChild(document.getElementById(data));
	}

function stopAnimation (caseID)
	{
		eval("marker_"+caseID+".setAnimation(null)");
	}

function updateToolTip (content)
	{
		eval("document.all.toolTip.innerHTML= '" + content + "'");
	}

/*
// Add
localStorage.lastname = "Meyer";

//Retrieve
document.getElementById("result").innerHTML = localStorage.lastname;

//Remove
localStorage.removeItem("lastname");
*/

