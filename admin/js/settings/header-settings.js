/*

	Header Settings Javascript

*/
jQuery(function($){
$(document).ready(function(){
	/*
		drag and sort UI for Settings page
	*/
	$( ".sortable" ).sortable({
	     revert: true,
	     update: function() {
			//save on the setting fields
			if($(this).attr("data-bindID") != undefined){
				var target = "#" + $(this).attr("data-bindID");
				$(target).val('');
				cloneSortItems(target);
			}
	     }
	   });
   $( ".draggable" ).draggable({
     connectToSortable: ".sortable",
     helper: "clone",
     revert: function(e){
     	if(e){
     		//if drop = success then hide it
     		$(this).hide();
     	}
     	$(".sortable").removeClass("target");
     },
     drag: function(){
     	$(this).removeClass("display-none");
     	$(".sortable").addClass("target");
     },
   });
   //end of drag and drop UI
   	/*
   	*	@desc clone all the items from sortable field into $target(para) as string and seperator by space
	*	@para target to recieve the clones, element should be in ID. exp "#hello"
	*	@return null
   	*/
	function cloneSortItems($target){
		$(".sortable >div").each(function(i){
			if (i == 0) {
				$($target).val($(this).text());
			}else{
				$($target).val($($target).val() + "," + $(this).text());
			};
		});
	}

   //double click to remove and put back to select option
   $(".sortable").on("dblclick",">div",function(){ 
		var button_text = $(this).text();
		var target = "#" + $(this).parents(".sortable").attr("data-bindID");
		$("#header_option_fields").val('');
		$(this).parents(".layout").find(".header-options .draggable").each(function(){
			if(button_text.replace(/\s/g, '') == $(this).text().replace(/\s/g, '')){
				$(this).show().css("display","inline-block");
				$(this).removeClass("display-none");
			}
		}); 
		$(this).remove();
		
		cloneSortItems(target);
   });
   /*
   	Select Layout event handle
   */
   $(".select-layout-option").on("change", function(){
		var selector = ".layout-" + $(".select-layout-option").val();
		$(".layout").hide();
		$(selector).show();
		var bindID = "#" + $(this).attr("data-bindID");
		$(bindID).val("layout-" + $(this).val());
		//reset header option fields, when layer change
		$(".draggable").removeClass("display-none");
		$( ".draggable" ).show().css("display","inline-block");
		$(".sortable").empty();

		$("#header_option_fields").val("");
   });
      /*
      	Select Menu Event
      */
      $(".select-menu-option").on("change", function(){
   		$("#header_menu_id").val($(this).val());
      });
   /*
	Switch Button for #fixed_header
   */
   	$('.switch-btn').on('click', function(){
		if($(this).hasClass("yes-please")){
			$(this).find(".round-block").animate({"left":"50%"},200);
			$(this).removeClass("yes-please");
			$("#fixed_header").val("false");
		}else{
			$(this).find(".round-block").animate({"left":"0"},200);
			$(this).addClass("yes-please");
			$("#fixed_header").val("true");
		}
	});
});
});

