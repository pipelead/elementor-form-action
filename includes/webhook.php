<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Ação de webhook do formulário Elementor.
 *
 * @since 1.0.0
 */
class Pipelead_Webhook_Action extends \ElementorPro\Modules\Forms\Classes\Action_Base {

    /**
     * Obtém o nome da ação.
     *
     * @since 1.0.0
     * @access public
     * @return string
     */
    public function get_name() {
        return 'pipelead_webhook';
    }

    /**
     * Obtém o rótulo da ação.
     *
     * @since 1.0.0
     * @access public
     * @return string
     */
    public function get_label() {
        return esc_html__( 'Pipelead (Beta)', 'pipelead-form-action' );
    }

    /**
     * Registra os controles da ação.
     *
     * @since 1.0.0
     * @access public
     * @param \Elementor\Widget_Base $widget
     */
    public function register_settings_section( $widget ) {

        $widget->start_controls_section(
            'section_pipelead_webhook',
            [
                'label' => esc_html__( 'Pipelead Webhook', 'pipelead-form-action' ),
                'condition' => [
                    'submit_actions' => $this->get_name(),
                ],
            ]
        );

        $widget->add_control(
            'pipelead_webhook_url',
            [
                'label' => esc_html__( 'Webhook URL', 'pipelead-form-action' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'https://app.pipelead.to/webhook/lead/abcdefgh123', 'pipelead-form-action' ),
            ]
        );

        $widget->end_controls_section();
    }


    /**
     * Executa a ação.
     *
     * @since 1.0.0
     * @access public
     * @param \ElementorPro\Modules\Forms\Classes\Form_Record  $record
     * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
     */
    public function run( $record, $ajax_handler ) {

        $settings = $record->get( 'form_settings' );

        // Certifique-se de que há uma URL de webhook.
        if ( empty( $settings['pipelead_webhook_url'] ) ) {
            return;
        }

        // Obtenha os dados enviados pelo formulário.
        $raw_fields = $record->get( 'fields' );

        // Normaliza os dados do formulário.
        $fields = [];
        foreach ( $raw_fields as $id => $field ) {
            $fields[ $id ] = $field['value'];
        }

        // Adiciona os campos extras
        $fields['current_uri'] = wp_get_referer();
        if ( ! session_id() ) {
            session_start();
        }
        $fields['referrer_uri'] = isset($_SESSION['referrer_uri']) ? esc_url_raw($_SESSION['referrer_uri']) : '';

        // Envia a solicitação para o webhook.
        wp_remote_post(
            $settings['pipelead_webhook_url'],
            [
                'method' => 'POST',
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => wp_json_encode( $fields ),
            ]
        );

    }

    /**
     * Limpa as configurações do formulário ao exportar.
     *
     * @since 1.0.0
     * @access public
     * @param array $element
     * @return array
     */
    public function on_export( $element ) {

        unset(
            $element['pipelead_webhook_url']
        );

        return $element;

    }

}
