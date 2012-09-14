<?php
/**
 * Plugins are described by creating a $plugin array which will be used
 * by the system that includes this file.
 */
$plugin = array(
  'title' => t('Program fees and assistance'),
  'content_types' => array('program_fees_and_assistance'),
  'single' => TRUE,
  'render callback' => 'uom_gshss_custom_program_fees_and_assistance_render',

  'icon' => 'icon_node.png',
  'description' => t('The fees and assistance information of the referenced program node.'),
  'required context' => new ctools_context_required(t('Node'), 'node'),
  'edit form' => 'uom_gshss_custom_program_fees_and_assistance_edit_form',
  'admin title' => 'uom_gshss_custom_program_fees_and_assistance_admin_title',

  'admin info' => 'uom_gshss_custom_program_fees_and_assistance_admin_info',
  'category' => t('Node'),
);

function uom_gshss_custom_program_fees_and_assistance_admin_title($subtype, $conf, $context = NULL) {
  $output = t('Fees and assistance');
  if ($conf['override_title'] && !empty($conf['override_title_text'])) {
    $output = filter_xss_admin($conf['override_title_text']);
  }
  return $output;
}

function uom_gshss_custom_program_fees_and_assistance_admin_info($subtype, $conf, $context = NULL) {
  $context = new stdClass();
  $context->data = new stdClass();
  $context->data->description = t('No context');
  $block = uom_gshss_custom_program_fees_and_assistance_render($subtype, $conf, array('Feed and assistance'), $context);
  return $block;
}

/**
 * Return a panel pane with content for a given program.
 */
function uom_gshss_custom_program_fees_and_assistance_render($subtype, $conf, $panel_args, $context) {
  $node = $context->data;
  $block = new stdClass();
  $block->module = 'uom_gshss_custom';

  $block->title = t('Fees and assistance');
  $block->content = '';
  $block->delta = 0;

  if (!empty($node->nid)) {
    if ($node->type == 'program') {
      $content = node_view($node, 'full');
      foreach ($conf['fields'] as $field) {
        $rows[] = array('title' => $content[$field]['#title'], 'value' => $content[$field][0]['#markup']);
      }
      $block->content = theme('table', array('header' => NULL, 'rows' => $rows));
    }
    $block->delta = $node->nid;
  }
  return $block;
}

function uom_gshss_custom_program_fees_and_assistance_edit_form($form, &$form_state) {
  $options = array();

  $fields = field_info_instances('node', 'program');
  foreach ($fields as $name => $field) {
    $form[$name]['field'] = array(
      '#type' => 'checkbox',
      '#title' => $field['label']
    );

    $form[$name]['weight'] = array(
      '#type' => 'weight',
      '#title' => $field['label']
    );

  }

  drupal_add_tabledrag('program-fees-and-assistance', 'order', 'sibling', 'order-field');

  return $form;
}

function uom_gshss_custom_program_fees_and_assistance_edit_form_submit($form, &$form_state) {
  $form_state['conf']['fields'] = array_filter($form_state['values']['fields']);
}
