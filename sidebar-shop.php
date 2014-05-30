<?php
if (!defined("ABSPATH")) die();
if ( mint_is_wc() ) {
	dynamic_sidebar( 'mint-woocommerce' );
}