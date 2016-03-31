<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package spirits-cabinet
 */

$id = intval($_GET['id']);
$user_id = intval($_GET['user_id']);

$field_value = get_field('user_spirits_cabinet', 'user_' . $user_id);
$field_value[] = array('user_spirits_cabinet_id' => $id, 'user_spirits_cabinet_notes' => 'PHP submitted note');

update_field( 'user_spirits_cabinet', $field_value, 'user_' . $user_id );


?>
<p>RESPONSE MADE IT</p>