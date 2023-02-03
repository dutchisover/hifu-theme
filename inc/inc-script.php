<?php
if (is_front_page()) { //トップページ専用読み込み
?>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script>
		(function($) {
			$(window).on("load resize", function() {
				const ww = $(window).width();
				if (ww < 769) {
					$("body").addClass("sp")
				} else {
					$("body").removeClass("sp")
				}
			})

			$(window).on("load", function() {
				$('.top_slick').addClass("load");
			});
			$('.slick_list').slick({
				dots: true,
				infinite: true,
				speed: 1500,
				fade: true,
				cssEase: 'ease-out',
				autoplay: true,
				autoplaySpeed: 5000,
				arrows: true,
				adaptiveHeight: true,
				focusOnSelect: true,
				pauseOnFocus: true,
				pauseOnHover: true,
				pauseOnDotsHover: true,
				lazyLoad: 'progressive',
			});

			$(".top_news_container").slick({
				arrows: false,
				vertical: true,
				autoplay: true,
				autoplaySpeed: 3000,
				focusOnSelect: true,
				pauseOnFocus: true,
				pauseOnHover: true,
			});

			$(".top_recommend_content").slick({
				centerMode: true,
				centerPadding: '30%',
				variableWidth: true,
				slidesToShow: 1,
				dots: true,
				infinite: true,
				speed: 500,
				cssEase: 'ease-out',
				autoplay: true,
				autoplaySpeed: 4000,
				arrows: true,
				focusOnSelect: true,
				pauseOnFocus: true,
				pauseOnHover: true,
				pauseOnDotsHover: true,
				lazyLoad: 'progressive',
				responsive: [{
					breakpoint: 768,
					settings: {
						centerPadding: '5%',
					}
				}],
			});

			$(document).on("click", ".sp .top_menu .menu_cat_title", function() {
				$(this).parent().toggleClass("close");
				$(this).next().fadeToggle(300, "swing", function() {
					// $(this).parent().toggleClass("close");
				});
			});

			$(".top_reserve_tel_name").each(function() {
				let tel_name = $(this).text().replace("（", "<br class='pc_none'>（");
				$(this).html(tel_name);
			});
		})(jQuery);
	</script>
<?php
}
//院別ページ専用読み込み
if (is_page()) {
?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<?php } ?>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/da8ee782c7.js" crossorigin="anonymous"></script>

<!-- アーチ文字 -->
<?php
$path = $_SERVER['REQUEST_URI'];
//var_dump($path);
if ($path === "/style/") {
	echo '<script src="' . get_template_directory_uri() . '/js/jquery.arctext.js"></script>';
}
?>


<script>
	// フォームボタンURL自動生成
	<?php global $line_qr; ?>
	$(function() {
		$('a[href="/reserve/"]').attr("href", "<?= $line_qr; ?>");
	})

	// フッター文字変更
	$(function() {
		$(".top_clinic_area").each(function() {
			let shinbi_name = $(this).text().replace("審美矯正歯科", "心斎橋");
			$(this).html(shinbi_name);
		});
	})
</script>



<!-- YTM -->
<script type="text/javascript">
	(function() {
		var tagjs = document.createElement("script");
		var s = document.getElementsByTagName("script")[0];
		tagjs.async = true;
		tagjs.src = "//s.yjtag.jp/tag.js#site=0MDFVIg";
		s.parentNode.insertBefore(tagjs, s);
	}());
</script>
<noscript>
	<iframe src="//b.yjtag.jp/iframe?c=0MDFVIg" width="1" height="1" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
</noscript>
