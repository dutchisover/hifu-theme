(function($) {
  //ローディング
  $(window).on('load', function() {
    $('.loading').addClass('hide');
  });

  $(function() {
    //スムーズスクロール
    $('a[href^="#"]').on('click', function() {
      let speed = 400;
      let href = $(this).attr('href');
      let target = $(href == '#' || href == '' ? 'html' : href);
      let position = target.offset().top;
      $('body,html').animate({ scrollTop: position }, speed, 'swing');
      return false;
    });
  });

  //ナビクリック
  const navButton = $('#js-navButton');
  const gNav = $('.menu-gnav-container');
  navButton.on('click', function() {
    gNav.toggleClass('show');
    if ($(this).attr('aria-expanded') == 'false') {
      $(this).attr('aria-expanded', true);
    } else {
      $(this).attr('aria-expanded', false);
    }
  });
  gNav.find('.gNav_item').on('click', function() {
    gNav.removeClass('show');
    navButton.attr('aria-expanded', false);
  });

  //トップへ戻る
  const topReturn = $('#js-top_return');
  topReturn.on('click', function() {
    $('body, html').animate({ scrollTop: 0 }, 500);
    return false;
  });

  // eslint-disable-next-line no-irregular-whitespace
  //料金表　目次の自動生成
  const price_catalog = $('.price_catalog');
  let price_catalog_html = '';
  for (let i = 0; i < price_catalog.find('h3,h4').length; i++) {
    const nh = price_catalog.find('h3,h4').eq(i);
    const ht_tag = nh.prop('tagName');
    const nt_text = nh.text().replace(/ *\（[^)]*\） */g, '');
    if (ht_tag === 'H3') {
      price_catalog_html +=
        '<dl class="price_autolist">' +
        '<dt class="price_autolist_title">' +
        nt_text +
        '</dt>';
    } else if (ht_tag === 'H4') {
      nh.prop('id', 'anc' + i);
      price_catalog_html +=
        '<dd class="price_autolist_text">' +
        '<a class="price_autolist_link" href="#anc' +
        i +
        '">' +
        nt_text +
        '</a>' +
        '</dd>';
      if (
        price_catalog
          .find('h3,h4')
          .eq(i + 1)
          .prop('tagName') === 'H3'
      ) {
        price_catalog_html += '</dl>';
      }
    }
  }
  price_catalog
    .find('#js-price_list')
    .after(
      '<div class="price_auto" id="price_auto">' +
        price_catalog_html +
        '</div>',
    );

  // eslint-disable-next-line no-irregular-whitespace
  //料金表　メニューに戻る を自動追加
  const url_text = location.href;
  if (url_text.indexOf('price') != -1) {
    const h_tags = price_catalog.find('h3,h4,h5');
    const price_menuback =
      '<a class="price_menuback" href="#price_auto">メニューに戻る</a>';
    for (let i = 2; i < h_tags.length; i++) {
      if (
        h_tags.eq(i - 1).prop('tagName') !== 'H4' ||
        h_tags.eq(i - 1).prop('tagName') !== 'H3'
      ) {
        h_tags.eq(i).before(price_menuback);
      }
    }
    $('.wp-block-table:last').after(price_menuback);
  }

  //料金表　特定のclass付与
  const td = $('td');
  for (let i = 0; i < td.length; i++) {
    const td_eq = td.eq(i);
    const td_text = td_eq.text();
    console.log(td_text);
    if (td_text.match(/本$/)) {
      td_eq.addClass('num');
    }
    const em_text = td_eq.children('em').text();
    if (em_text.match(/トライアル/)) {
      td_eq.children('em').addClass('trial');
    }
    if (em_text.match(/回$/)) {
      td_eq.children('em').addClass('many');
      const em_num = em_text.split('回');
      td_eq.children('em').addClass('many-' + em_num[0]);
    }
  }

  //料金表　スマホ回数表示
  const coupon_table = $('.coupon');
  coupon_table.each(function(index, element) {
    const coupon_head_th = $(element).find('thead th');
    const coupon_body = $(element).find('tbody');
    for (let i = 1; i < coupon_head_th.length; i++) {
      const coupon_body_tr = coupon_body.find('tr');
      coupon_body_tr.each(function(index2, tr) {
        if (coupon_head_th.eq(i).text()) {
          $(tr)
            .find('td')
            .eq(i - 1)
            .attr('data-th', coupon_head_th.eq(i).text());
        } else {
          $(tr)
            .find('td')
            .eq(i - 1)
            .addClass('no_attr');
        }
      });
    }
  });

  // クリニックの画像スライド
  $(window).on('resize load scroll', function() {
    let width = $(window).width();
    if (width < 768) {
      $('.clinic_room')
        .not('.slick-initialized')
        .slick({
          autoplay: true,
          fade: true,
          dots: true,
          arrows: false,
        });
    }
    if (width >= 768) {
      $('.clinic_room').slick('unslick');
    }
  });

  //コラム一覧のカテゴリー切り替え
  $('.column_mNav_link').on('click', function() {
    const select_cat = $(this).attr('href');
    $('.column_mNav_link').removeClass('show');
    $('.column_wrapper').removeClass('show');
    $(this).addClass('show');
    $(select_cat).addClass('show');
    return false;
  });

  //コラムに自動リンク生成
  const link_key = [
    '医療脱毛',
    '永久脱毛',
    '全身脱毛',
    '医療ハイフ',
    '医療アートメイク',
  ];
  const link_page = '/';
  const link_tag = ['p'];

  for (let j = 0; j < link_tag.length; j++) {
    $('.single-column')
      .find(link_tag[j])
      .each(function() {
        const target_text = $(this).html();

        for (let i = 0; i < link_key.length; i++) {
          if (target_text.indexOf(link_key[i]) != -1) {
            const replace_text = target_text.replace(
              link_key[i],
              '<a class="reg" href="' + link_page + '">' + link_key[i] + '</a>',
            );
            $(this).html(replace_text);
            return false;
          }
        }
      });
  }

  //アーチ文字（脱毛）
  const archText = $('.style h2 em');
  archText.arctext({ radius: 80 });
})(jQuery);
