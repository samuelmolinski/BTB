/* Mint WooCommerce JS */
(function() {
	var MintWoocommerce = {
		init : function() {
			this.handleBasket();
			this.onCartItemRemove();
			this.onAddedToCart();
		},

		handleBasket : function() {
			jQuery("#mint-wc-cart").on("click", function() {
				jQuery(".mint-wc-cart-content").toggleClass("is-hidden");

				return false;
			});

			jQuery("body").on("click", function() {
				jQuery(".mint-wc-cart-content").addClass("is-hidden");
			});
		},

		onCartItemRemove : function() {
			jQuery("body").on("click", ".mint-cart-item-remove a", function() {
				var $this = jQuery(this);
				var current_item = $this.closest(".mint-cart-item");
				var href = $this.attr("href");
				var url = $this.data("mint-url");
				var params = href.replace(url + "?", ""); 
				var data = parseQuery(params);
				data.action = "mint_remove_cart_item";

				// show loader
				current_item.find(".mint_ajax_loader").removeClass("is-hidden");
				current_item.addClass("disabled").fadeTo(800, 0.3);

				jQuery.post(mint_options.ajax_url, data, function(resp) {
					current_item.find(".mint_ajax_loader").addClass("is-hidden"); // hide loader
					if(resp.success)
					{
						current_item.fadeOut("fast", function() {
							var length = jQuery(this).siblings(".mint-cart-item").length;

							if(length > 0)
							{
								jQuery(this).remove();	
							}
							else
							{
								jQuery(this).parent(".mint-wc-cart-items").html("No products in the cart.");
								jQuery("#mint-wc-cart").removeClass("mint-active-cart");
							}
						});
					}
					else
					{
						current_item.html(resp.data.msg).fadeTo(200, 1);
					}
				});

				return false;
			});
		},

		// call this after the item was added to the cart
		onAddedToCart : function(data) {
			var item_html = '\
				<div class="mint-cart-item media">\
					<div class="mint_ajax_loader is-hidden"></div>\
					<div class="pull-left">\
						<a href="%url%"><img width="60" height="70" src="%img_src%" class="attachment-shop_thumbnail wp-post-image" alt="" /></a>\
					</div>\
					<div class="media-body">\
						<h5 class="mint-wc-cart-title">%title%</h5>\
						<p class="mint-wc-cart-price">%price%</p>\
						<div class="mint-cart-item-remove">\
							<a href="%rem_url%" data-mint-url="%cart_url%"><span class="icon-cancel"></span></a>\
						</div>\
					</div>\
				</div>\
			';

			jQuery("body").on("added_to_cart", function(e, data) {
				jQuery("#mint-wc-cart").addClass("mint-active-cart"); // activate the cart basket
				jQuery(".mint-wc-cart-items").html(""); // clear the content of cart

				var data = data['div.widget_shopping_cart_content'];
				var items = jQuery(data).find(".product_list_widget li");
				var item_data = [];
				
				for(var i = 0; i < items.length; i++)
				{
					var item = jQuery(items[i]);

					item_data[i] = {};
					item_data[i].title     = jQuery.trim( item.find("a").text() );
					item_data[i].url       = item.find("a").attr("href");
					item_data[i].rem_url   = item.find("a").data("rem");
					item_data[i].cart_url  = item.find("a").data("mint-url");
					item_data[i].price     = item.find("span").html();
					item_data[i].img_src   = item.find("img").attr("src");

					var parse_item = MintWoocommerce.render(item_html, {
						title    : item_data[i].title,
						url      : item_data[i].url,
						price    : item_data[i].price,
						img_src  : item_data[i].img_src,
						rem_url  : item_data[i].rem_url,
						cart_url : item_data[i].cart_url
					});

					jQuery(".mint-wc-cart-items").append(parse_item);
				}
			});
		},

		render : function(html, data) {
			var newData = html;
			
			for(var x in data)
			{
				var patt = new RegExp("%"+x+"%");
				newData = newData.replace(patt, data[x]);
			}

			return newData;
		}
	};

	jQuery(function() {
		MintWoocommerce.init();
	});

})();