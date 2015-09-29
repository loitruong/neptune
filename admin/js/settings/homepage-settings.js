/*

	Homepage Setting

*/
jQuery(function($){
$(document).ready(function(){
	$( ".sortable" ).sortable({
	    revert: true,
		update: function() {
			bannerInit();
		},
	});
	//add-banner
	$('.add-banner').on('click', function(){
		$(".slider").append(' <div class="banner clearfix"> <div class="banner-image"> <img class="img-responsive" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=Add+Banner&w=150&h=150"/> </div><div class="banner-fields"> <div class="field-group"> <label>Main Text</label> <input class="main-text" type="text"> </div><div class="field-group"> <label>Sub Text</label> <textarea class="sub-text"></textarea> </div><div class=field-group><label>Banner text at</label><select class=banner-text-side><option value=left>left side<option value=center>center side<option value=right>right side</select></div></div><div class="banner-remove"> <span class="dashicons dashicons-minus"></span> </div></div>');
	});
	//remove-banner
	$(".slider").on("click",".banner .banner-remove", function(){
		$(this).parent(".banner").fadeOut(function(){
			$(this).remove();
			bannerInit();
		});
	})
	
	//banner text on change
	$(".slider").on("change",".banner .main-text, .banner .sub-text, .banner .banner-text-side", function(){
		bannerInit();
	});
	$(".nav-tab").on("click", function(){
		$(".nav-tab").removeClass("nav-tab-active");
		$(this).addClass("nav-tab-active");
		var target = $(this).attr("data-target");
		$(".tab-content").hide();
		$(target).fadeIn(500);
	});




	/*
		wordpress add media button for slider
	*/
	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;
	$('.slider').on("click", ".banner-image >img",function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media  && attachment.type == "image") {
				//if($(".banner-image >img").length > 1 ) return;
				button.attr("src", attachment.sizes.thumbnail.url);
				button.attr("data-attachmentID", attachment.id);
				bannerInit();
			}
		}
		wp.media.editor.insert = function(){
			
		};
		wp.media.editor.open(button);
		//return false;
	});


	//banner initialize into option field
	function bannerInit(){
		var banner = [];
		$("#banner-option-field").val('');
		$(".slider .banner").each(function(){
			var attachmentID = $(this).find(".banner-image >img").attr("data-attachmentID");
			var mainText = $(this).find(".main-text").val();
			var subText = $(this).find(".sub-text").val();
			var sideText = $(this).find(".banner-text-side").val();
			var result = {
				"attachmentID" : attachmentID,
				"mainText" : mainText,
				"subText" : subText,
				"sideText" : sideText
			}
			banner.push(result);
		});
		$("#banner-option-field").val(JSON.stringify(banner));
	}
});
});

