<?php
/**
 * barcode functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package barcode
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'barcode_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function barcode_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on barcode, use a find and replace
		 * to change 'barcode' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'barcode', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'barcode' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'barcode_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'barcode_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function barcode_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'barcode_content_width', 640 );
}
add_action( 'after_setup_theme', 'barcode_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function barcode_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'barcode' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'barcode' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'barcode_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function barcode_scripts() {
	wp_enqueue_style( 'barcode-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'barcode-style', 'rtl', 'replace' );


    wp_enqueue_style( 'animsition.css', get_template_directory_uri() . '/libs/animsition/animsition.css');



//    wp_enqueue_script('jquery');
    wp_enqueue_script( 'jquery.min.js', get_template_directory_uri() . '/libs/jquery/dist/jquery.min.js');
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js');
    wp_enqueue_script( 'bodymovin', get_template_directory_uri() . '/libs/bodymovin/build/player/bodymovin.min.js');
    wp_enqueue_script( 'js.cookie', get_template_directory_uri() . '/libs/js-cookie/src/js.cookie.js');
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/libs/swiper/dist/js/swiper.min.js');
    wp_enqueue_script( 'sidebar-sticky', get_template_directory_uri() . '/js/sidebar-sticky.js');
    wp_enqueue_script( 'waves-effect', get_template_directory_uri() . '/js/waves-effect.js');
    wp_enqueue_script( 'Inputmask', get_template_directory_uri() . '/libs/Inputmask/dist/jquery.inputmask.min.js');


    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/TiltHoverEffects/imagesloaded.pkgd.min.js');
    wp_enqueue_script( 'anime', get_template_directory_uri() . '/js/TiltHoverEffects/anime.min.js');
    wp_enqueue_script( 'animsition.js', get_template_directory_uri() . '/libs/animsition/animsition.js');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/TiltHoverEffects/main.js');




  


    // if( is_user_logged_in() ) {
        wp_enqueue_script( 'barcode-script-wc', get_template_directory_uri() . '/js/common-wc.js');

        // wp_enqueue_style( 'style-wc.css', get_template_directory_uri() . '/style-wc.css');

    // }else{
        // wp_enqueue_script('barcode-script', get_template_directory_uri() . '/js/common.js');
    // }

    $wnm_custom = array( 'stylesheet_directory_uri' => get_stylesheet_directory_uri() );
    wp_localize_script( 'barcode-script-wc', 'directory_uri', $wnm_custom );





	wp_enqueue_script( 'barcode-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'barcode_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



add_image_size( 'menu-min', 380, 500 , true );
add_image_size( 'interior', 335, 265 , true );
add_image_size( 'news', 520, 320 , true );



/** Register post type*/
function register_post_type_menu() {
    $labels = array(
        'name' => 'Продукты',
        'singular_name' => 'Продукты', // админ панель Добавить->Функцию
        'add_new' => 'Добавить продукт',
        'add_new_item' => 'Добавить новый продукт',
        'edit_item' => 'Редактировать продукты',
        'new_item' => 'Новый продукт',
        'all_items' => 'Все продукты',
        'view_item' => 'Просмотр продукта',
        'search_items' => 'Искать продукты',
        'not_found' =>  'Продуктов не найдено.',
        'not_found_in_trash' => 'В корзине нет продуктов.',
        'menu_name' => 'Продукты' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
//        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
//        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'taxonomies' => array('category'),
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-products', // иконка в меню
        'menu_position' => 30, // порядок в меню
        'supports' => array( 'title')
    );
    register_post_type('menu', $args);
}

// add_action( 'init', 'register_post_type_menu' ); // Использовать функцию только внутри хука init

function register_post_type_news() {
    $labels = array(
        'name' => 'Новости и акции',
        'singular_name' => 'Новости и акции', // админ панель Добавить->Функцию
        'add_new' => 'Добавить новости и акции',
        'add_new_item' => 'Добавить новые новости и акции',
        'edit_item' => 'Редактировать новости и акции',
        'new_item' => 'Новая новость и акция',
        'all_items' => 'Все новости и акции',
        'view_item' => 'Просмотр новости и акции',
        'search_items' => 'Искать новости и акции',
        'not_found' =>  'Новостей и акций не найдено.',
        'not_found_in_trash' => 'В корзине нет новостей и акций.',
        'menu_name' => 'Новости и акции' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
//        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
//        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'taxonomies' => array('category'),
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-excerpt-view', // иконка в меню
        'menu_position' => 30, // порядок в меню
        'supports' => array( 'title', 'editor' , 'thumbnail')
    );
    register_post_type('news', $args);
}

add_action( 'init', 'register_post_type_news' ); // Использовать функцию только внутри хука init



function register_post_type_settings() {
    $labels = array(
        'name' => 'Настройки сайта и&nbsp;прочее',
        'singular_name' => 'Настройки сайта и&nbsp;прочее', // админ панель Добавить->Функцию
        'add_new' => 'Добавить настройки',
        'add_new_item' => 'Добавить новые настройки',
        'edit_item' => 'Редактировать настройки',
        'new_item' => 'Новые настройки',
        'all_items' => 'Все настройки',
        'view_item' => 'Просмотр настроек',
        'search_items' => 'Искать настройки',
        'not_found' =>  'Настроек не найдено.',
        'not_found_in_trash' => 'В корзине нет Настроек.',
        'menu_name' => 'Настройки сайта и&nbsp;прочее' // ссылка в меню в админке
    );
    $args = array(
        'exclude_from_search' => true,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-wordpress-alt', // иконка в меню
        'menu_position' => 29 // порядок в меню
    ,'supports' => array( '' )
    );
    register_post_type('settings', $args);
}

add_action( 'init', 'register_post_type_settings' ); // Использовать функцию только внутри хука init







add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
function filter_plugin_updates( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    unset( $value->response['ajax-load-more/ajax-load-more.php'] );
    return $value;
}


add_filter ( 'wpcf7_autop_or_not' , '__return_false' );
// add_filter('wpcf7_form_elements', function($content) {
//     $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
//     $content = str_replace('<br />', '', $content);
//     return $content;
// });




add_filter('admin_footer', 'screen_test');
function screen_test(){
    $screen = get_current_screen();
    if($screen->base == 'flamingo_page_flamingo_inbound') {
        ?>
        <script>
            if(document.querySelector('table.message-fields tr:first-of-type td:nth-of-type(2) p')){
                var str = document.querySelector('table.message-fields tr:first-of-type td:nth-of-type(2) p');
                newText = str.textContent.replace(/\|/g, '<br>');
                str.innerHTML = newText;
                console.log('!');
            }

        </script>
        <?php
    }
}


function edit_admin_menus() {
    global $menu;
    global $submenu;

    if($menu[26][0] == 'Flamingo'){
        $menu[26][0] = 'Страница заказов';
    }
}
add_action( 'admin_menu', 'edit_admin_menus' );




// woocommerce
function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

add_filter('woocommerce_enqueue_styles', '__return_empty_array');


/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    ?>
    <a class="header__basket" href="<?php echo esc_url(wc_get_cart_url()); ?>">
        <span class="cur-basket">
            <?php
            global $woocommerce;
            echo number_format($woocommerce->cart->total, 0, '', ' ');
            ?>
        </span><span class="rur">р<span>уб.</span></span>
        <i class="btn-default waves-effect waves-light"></i>
        <?php
            if($woocommerce->cart->get_cart_contents_count() > 0){ ?>
                <span class="cur-basket-count"><?=$woocommerce->cart->get_cart_contents_count()?></span>
        <? } ?>
    </a>

    <?php
    $fragments['a.header__basket'] = ob_get_clean();


    ob_start();
    ?>
    <a href="<?php echo wc_get_cart_url(); ?>" class="fancy-modal__basket-header  waves-effect waves-light">
                <span class="cur-basket">
                         <?
                         global $woocommerce;
                         echo number_format($woocommerce->cart->total, 0, '', ' ');
                         ?>
                    </span><span class="rur">р<span>уб.</span></span>
        <i></i>
    </a>

    <?php
    $fragments['a.fancy-modal__basket-header'] = ob_get_clean();
    return $fragments;
}


add_action('wp_footer', 'ajax_add_tocart_event');
function ajax_add_tocart_event()
{
    ?>
    <script type="text/javascript">
        jQuery('body').on('added_to_cart', function (e, fragments, cart_hash, this_button) {
            $('.add-basket-message').addClass('active');

            setTimeout(function () {
                $('.add-basket-message').removeClass('active');
            }, 1000);
        });
    </script>
    <?php
}


function woocommerce_button_proceed_to_checkout()
{

    $new_checkout_url = WC()->cart->get_checkout_url();
    ?>
    <a href="<?php echo $new_checkout_url; ?>" class="basket__order-btn   waves-effect waves-light checkout-button button alt wc-forward">
        <?php _e('К оформлению', 'woocommerce'); ?></a>
    <?php
}



add_action( 'woocommerce_cart_coupon', 'custom_woocommerce_empty_cart_button' );
function custom_woocommerce_empty_cart_button() {
    echo '<a href="' . esc_url( add_query_arg( 'empty_cart', 'yes' ) ) . '" class="basket__remove-btn d-none d-md-flex waves-effect waves-silver"">Очистить корзину</a>';
    echo '<a href="' . esc_url( add_query_arg( 'empty_cart', 'yes' ) ) . '" class="basket__remove-btn d-md-none waves-effect waves-silver">Очистить</a>';
}

add_action( 'wp_loaded', 'custom_woocommerce_empty_cart_action', 20 );
function custom_woocommerce_empty_cart_action() {
    if ( isset( $_GET['empty_cart'] ) && 'yes' === esc_html( $_GET['empty_cart'] ) ) {
        WC()->cart->empty_cart();

        $referer  = wp_get_referer() ? esc_url( remove_query_arg( 'empty_cart' ) ) : wc_get_cart_url();
        wp_safe_redirect( $referer );
    }
}

add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
    if ( isset( $_GET['empty_cart'] ) ) {
        global $woocommerce;
        $woocommerce->cart->empty_cart();
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'cart';
        header("Location: http://$host$uri/$extra");
        die();
    }
}



add_action( 'woocommerce_after_checkout_validation', 'misha_one_err', 9999, 2);

function misha_one_err( $fields, $errors ){

    // if any validation errors
    if( !empty( $errors->get_error_codes() ) ) {

        // remove all of them
        foreach( $errors->get_error_codes() as $code ) {
            $errors->remove( $code );
        }

        // add our custom one
        $errors->add( 'validation', 'Пожалуйста, заполните все обязательные поля' );

    }

}




// function woo_discount_total(WC_Cart $cart) {

//     global $woocommerce;

//     $delivery_name = "";
//     $delivery_selected = [];
//     $available_methods = $woocommerce->shipping->get_packages();

//     if(isset($woocommerce->session)) {
//         $delivery_selected = $woocommerce->session->get("chosen_shipping_methods");
//     }

//     foreach($available_methods as $method) {
//         foreach($delivery_selected as $delivery) {
//             if(isset($method["rates"][$delivery])) {
//                 $delivery_name = $method["rates"][$delivery]->label;
//                 break;
//             }
//         }
//     }

//     if($delivery_name == "Самовывоз") {
//         $discount = $cart->subtotal * 0.1; // 0.1 - это 10%
//         $cart->add_fee("Фиксированная скидка в 10% за самовывоз ", -$discount);
//     }
// }
function woo_discount_total(WC_Cart $cart)
{

    global $woocommerce;

    $delivery_name = "";
    $delivery_selected = [];
    $available_methods = $woocommerce->shipping->get_packages();


    $pickup_discount = get_field('settings-pickup-discount', 94);
    $shipping_discount = get_field('settings-shipping-discount', 94);


    if (isset($woocommerce->session)) {
        $delivery_selected = $woocommerce->session->get("chosen_shipping_methods");
    }

    foreach ($available_methods as $method) {
        foreach ($delivery_selected as $delivery) {
            if (isset($method["rates"][$delivery])) {
                $delivery_name = $method["rates"][$delivery]->label;
                break;
            }
        }
    }

    if ($delivery_name == "Самовывоз") {

        if ($pickup_discount != '') {
            if (stristr($pickup_discount, '%') != FALSE) {
                $pickup_discount_res = $pickup_discount / 100;
                $discount = $cart->subtotal * $pickup_discount_res; // 0.1 - это 10%
                $cart->add_fee("Фиксированная скидка в $pickup_discount за самовывоз ", -$discount);
            } else {
                $cart->add_fee("Фиксированная скидка в $pickup_discount руб. за самовывоз ", -$pickup_discount);
            }
        }


    } elseif ($delivery_name == "Единая ставка" || $delivery_name == "Бесплатная доставка") {
        if ($shipping_discount != '') {
            if (stristr($shipping_discount, '%') != FALSE) {
                $shipping_discount__res = $shipping_discount / 100;
                $discount = $cart->subtotal * $shipping_discount__res; // 0.1 - это 10%
                $cart->add_fee("Фиксированная скидка в $shipping_discount за доставку ", -$discount);
            } else {
                $cart->add_fee("Фиксированная скидка в $shipping_discount руб. за доставку ", -$shipping_discount);
            }
        }


    }

}

add_action("woocommerce_cart_calculate_fees" , "woo_discount_total");











// SMS
function sendSMS($text){
    require_once 'SMS/sms.ru.php';

    $smsru = new SMSRU('071C02AD-6260-C519-64EF-446A8D2821FC'); // Ваш уникальный программный ключ, который можно получить на главной странице

    $data = new stdClass();
    $data->to = '79771892959';
    $data->text = $text; // Текст сообщения
// $data->from = ''; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
// $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
// $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
// $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
// $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
    $sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

    // if ($sms->status == "OK") { // Запрос выполнен успешно
    //     echo "Сообщение отправлено успешно. ";
    //     echo "ID сообщения: $sms->sms_id. ";
    //     echo "Ваш новый баланс: $sms->balance";
    // } else {
    //     echo "Сообщение не отправлено. ";
    //     echo "Код ошибки: $sms->status_code. ";
    //     echo "Текст ошибки: $sms->status_text.";
    // }
}


//add_action( 'woocommerce_checkout_order_processed', 'create_invoice_for_wc_order',  1, 1  );
add_action( 'woocommerce_new_order', 'create_invoice_for_wc_order',  1, 1  );
function create_invoice_for_wc_order( $order_id ) {
    $order = wc_get_order( $order_id );

    if ( $order ) {

        foreach( $order->get_items() as $products ) {
            $products[] = $products['name'] . "-" . $products['quantity'];
        }
        $product_list = implode( ', ', $products );

        sendSMS("Оформлен новый заказ");
    }


}



