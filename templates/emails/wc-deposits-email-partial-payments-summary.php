<?php
/**
 *  Email Original  Order details Summary
 *
 * This template displays a summary of original order details
 *
 * @package woocommerce-deposits/Templates
 * @version 2.5.0
 */



if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_align = is_rtl() ? 'right' : 'left';
?>
<h2>
	<?php


	_e('Partial Payments Summary','woocommerce-deposits');
	?>
</h2>

<div style="margin-bottom: 40px;">
	<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
		<thead>
			<tr>

            <tr>
                <th class="td" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>;"><?php esc_html_e('Payment','woocommerce-deposits'); ?> </th>
                <th class="td" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>;"><?php esc_html_e('Payment ID','woocommerce-deposits'); ?> </th>
                <th class="td" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>;"><?php esc_html_e('Status','woocommerce-deposits'); ?> </th>
                <th class="td" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>;"><?php esc_html_e('Amount','woocommerce-deposits'); ?> </th>

			</tr>
		</thead>
		<tbody>
        <?php foreach($schedule as $timestamp => $payment){

            if(!is_numeric($timestamp)){

                if($timestamp === 'unlimited'){
                    $date = __('Second Payment', 'woocommerce-deposits');
                } elseif($timestamp === 'deposit'){
                    $date = __('Deposit', 'woocommerce-deposits');
                } else {
                    $date = $timestamp;

                }

            } else {
                $date =  date('Y-M-d',$timestamp);
            }

            $payment_order = false;
            if(isset($payment['id']) && !empty($payment['id'])) $payment_order = wc_get_order($payment['id']);

            if(!$payment_order) continue;
            $payment_id = $payment_order ? $payment_order->get_order_number(): '-';
            $status = $payment_order ? wc_get_order_status_name($payment_order->get_status()) : '-';
            $amount = $payment_order ? $payment_order->get_total() : $payment['total'];

            ?>
            <tr class="order_item">
                <td class="td" style="text-align:<?php echo esc_attr( $text_align ); ?>; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
                <?php echo esc_html_e($date); ?>
                </td>
                <td class="td" style="text-align:<?php echo esc_attr( $text_align ); ?>; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
                    <?php echo esc_html_e($payment_id); ?>
                </td>
                <td class="td" style="text-align:<?php echo esc_attr( $text_align ); ?>; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
                    <?php echo esc_html_e($status); ?>

                </td>
                <td class="td" style="text-align:<?php echo esc_attr( $text_align ); ?>; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
                    <?php echo wc_price($amount); ?>
                </td>
            </tr>
        <?php
        } ?>
		</tbody>
		<tfoot>

		</tfoot>
	</table>
</div>

