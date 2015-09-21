/*

	Footer Settings Javascript

*/
jQuery(function($){
$(document).ready(function(){
	/*
		drag and sort UI for Settings page
	*/
	$( ".sortable" ).sortable({
		connectWith: ".sortable",
	     revert: true,
	     update: function() {
			//save on the setting fields
			if($(this).attr("data-bindID") != undefined){
				var target = "#" + $(this).attr("data-bindID");
				$(target).val('');
				cloneSortItems(target,$(this));
			}
			$(".sortable").removeClass("target");
	     },
	     sort: function(){
	     	$(".sortable").addClass("target");
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
	function cloneSortItems($target,$sortable){
		$sortable.find(">div").each(function(i){
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
		var sortable = $(this).parents(".sortable");
		$(target).val('');
		$(this).parents(".layout").find(".footer-options .draggable").each(function(){
			if(button_text.replace(/\s/g, '') == $(this).text().replace(/\s/g, '')){
				$(this).show().css("display","inline-block");
				$(this).removeClass("display-none");
			}
		}); 
		$(this).remove();
		
		cloneSortItems(target, sortable);
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
		//reset footer option fields, when layer change
		$(".draggable").removeClass("display-none");
		$( ".draggable" ).show().css("display","inline-block");
		$(".sortable").empty();

		// this will empty all the footer option fields when we change layout
		$("#footer_option_fields_1 , #footer_option_fields_2 , #footer_option_fields_3 , #footer_option_fields_4").val("");
   });
      /*
      	Select Menu Event
      */
      $(".select-menu-option").on("change", function(){
   		$("#footer_menu_id").val($(this).val());
      });

});
});

