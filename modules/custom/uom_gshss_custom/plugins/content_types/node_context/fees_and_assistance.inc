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
		if(!isset($content[$field]) || count($content[$field]) == 0) {
			// Even the field is selected, but it is empty or unset, so skip it.
			continue;
		}
        $rows[] = array('title' => $content[$field]['#title'], 'value' => $content[$field][0]['#markup']);
      }
      $block->content = theme('table', array('header' => NULL, 'rows' => $rows));
    }
    $block->delta = $node->nid;
  }
  return $block;
}

function uom_gshss_custom_program_fees_and_assistance_edit_form($form, &$form_state) {
  $conf = $form_state['conf'];

  $options = array();

  $fields = field_info_instances('node', 'program');
  foreach ($fields as $name => $field) {
    $options[$name] = array(
      'field' => $name,
      'label' => check_plain($field['label']),
      'widget' => $field['widget']['type'],
    );
  }

  $header = array('field' => t('Field'), 'label' => t('Label'), 'widget' => t('Widget'));

  $form['fields'] = array(
    '#type' => 'tableselect',
    '#header' => $header,
    '#options' => $options,
    '#default_value' => $conf['fields'],
  );

  return $form;
}

function uom_gshss_custom_program_fees_and_assistance_edit_form_submit($form, &$form_state) {
  $form_state['conf']['fields'] = array_filter($form_state['values']['fields']);
}
