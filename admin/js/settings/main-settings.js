/*

	Main Setting Page

*/
jQuery(function($){
$(document).ready(function(){
	/*
		Toggle Panel Event
	*/
	$(".toggle-panel .toggle-header").on("click", function(){
		var content = $(this).siblings(".toggle-content");
		var toggle = $(this).parents(".toggle-panel");
		content.stop();
		if(toggle.hasClass("active")){
			content.fadeOut(500);
			toggle.removeClass("active");
		}else{
			$(".toggle-panel").removeClass("active");
			$(".toggle-panel .toggle-content").hide();
			content.fadeIn(500);
			toggle.addClass("active");
		}
	});
	/*
	  Input option field event
	*/
	$(".input-option-field, #theme-color").on("change",function(){
		var target = "#" + $(this).attr("data-bindID");
		var value = $(this).val();
		$(target).val(value);
	})
	/*
		wordpress add media button
	*/
	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;
	$('.add-logo-setting').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media  && attachment.type == "image") {
				$(".logo-show").empty();
				if($(".logo-show >img").length > 1 ) return;
				$(".logo-show").append('<img class="img-responsive" data-bindID="'+ attachment.id +'" src="'+ attachment.sizes.thumbnail.url +'" width="'+ attachment.sizes.thumbnail.width +'" height="'+ attachment.sizes.thumbnail.height +'" >');
				$("#logo").val(attachment.id);
			}
		}
		wp.media.editor.insert = function(){
			//initialGalleryField();
		};
		wp.media.editor.open(button);
		//return false;
	});
	/*
		Pick Fonts
	*/
	$(".font-examples").css("font-family", pickFont($(".font-select").val()));
	$(".font-select").on("change", function(){
		var target = "#" + $(this).attr("data-bindID");
		var value = $(this).val();
		$(target).val(value);
		var font = "sans-serif";
		$(".font-examples").css("font-family", pickFont($(this).val()));
	});
	/*
	*	@desc this function will find the match of font string
	*	@para fontstring
	*	@return font-family string
	*/
	function pickFont($fontInput){
		font = "";
		switch($fontInput) {
		    case "open-sans":
		        font = "'Open Sans', sans-serif";
		        break;
		    case "lato":
		    	font = "'Lato', sans-serif";
		        break;
		 	case "pt-sans":
		 	    font = "'PT Sans', sans-serif";
		 	    break;
		 	case "droid-sans":
		 	    font = "'Droid Sans', sans-serif";
		 	    break;
		 	case "ubuntu":
		 	    font = "'Ubuntu', sans-serif";
		 	    break;
		 	case "ubuntu-mono":
		 	    font = "'Ubuntu Mono', sans-serif";
		 	    break;
		 	case "vollkorn":
		 	    font = "'Vollkorn', serif";
		 	    break;
		 	case "roboto":
		 	    font = "'Roboto', sans-serif";
		 	    break;    
		 	case "josefin-slab":
		 	    font = "'Josefin Slab', serif";
		 	    break;
		 	case "dancing-script":
		 	    font = "'Dancing Script', cursive";
		 	    break;
		 	default:
		 		font = "sans-serif";
		 		break;
		};
		return font;
	}
});
});

