<?php
/**
 * Plugin Name: Pipelead Form Action
 * Description: Adiciona uma nova ação de submissão ao formulário do Elementor que dispara um webhook.
 * Version: 0.0.1
 * Author: Pipelead
 * Text Domain: pipelead-form-action
 *
 * Requires Plugins: elementor, elementor-pro
 * Elementor tested up to: 3.21.0
 * Elementor Pro tested up to: 3.21.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Adiciona a nova ação de formulário após a submissão do formulário.
 *
 * @param ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar $form_actions_registrar
 * @return void
 */
function register_pipelead_form_action( $form_actions_registrar ) {

    include_once( __DIR__ .  '/includes/webhook.php' );

    $form_actions_registrar->register( new \Pipelead_Webhook_Action() );

}
add_action( 'elementor_pro/forms/actions/register', 'register_pipelead_form_action' );

/**
 * Inicia a sessão e salva o referrer na sessão.
 */
function pipelead_start_session() {
    if ( ! session_id() ) {
        session_start();
    }
    if ( ! isset( $_SESSION['referrer_uri'] ) && isset( $_SERVER['HTTP_REFERER'] ) ) {
        $_SESSION['referrer_uri'] = esc_url_raw( $_SERVER['HTTP_REFERER'] );
    }
}
add_action( 'init', 'pipelead_start_session' );
